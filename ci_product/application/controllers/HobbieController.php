<?php
class HobbieController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model('Hobby_model');
    }

    public function create()
    {

        $this->load->view("hobbies/createhobby");

    }



    public function createHobby_action()
    {

        $this->form_validation->set_rules("hobby", "hobby", "required");
        $this->form_validation->set_rules("status", "Status", "required");

        if ($this->form_validation->run() == false) {

            $this->load->view("hobbies/createhobby");

        } else {

            $checkexist = $this->Hobby_model->getData("hobbies", "hobby_title", "hobby_title='" . $this->input->post("hobby") . "'", "", "", "", "");

            if ($checkexist) {
                $this->session->set_flashdata("warning", "Hobby already Exist");
                redirect("HobbieController/create");

            } else {

                $inserthobby = array(
                    'token' => md5('Hobbies-token' . time() . rand(1000, 9999)),
                    "hobby_title" => ucwords($this->input->post("hobby")),
                    "status" => $this->input->post("status"),
                );
                // print_r($inserthobby); exit;
                $this->Hobby_model->SaveData("hobbies", $inserthobby);
                $this->session->set_flashdata("success", "Hobby cerated successfully");
                redirect("HobbieController/hobbylist");

            }

        }

    }


    public function hobbylist()
    {

        $hobbieslist["hobbys"] = $this->Hobby_model->GetData("hobbies", "", "", "hobby_title", "", "");
        // print_r($hobbieslist); exit;
        $this->load->view("hobbies/managehobby", $hobbieslist);
    }



    public function updateHobby($id)
    {


        $gethobby = $this->Hobby_model->getData("hobbies", "", "id='" . $id . "'", "", "", "", "1");
        //   print_r($gethobby->status); exit;

        $data = array(

            "hobby_title" => set_value("hobby", $gethobby->hobby_title),
            "status" => set_value("status", $gethobby->status),
            "id" => set_value("id", $gethobby->id),
        );

        $this->load->view("hobbies/updatehobby", $data);
    }

    public function updateHobby_Action()
    {

        $this->form_validation->set_rules("hobby", "hobby", "required|regex_match[/^[a-zA-Z- ]*$/]'");
        $this->form_validation->set_rules("status", "hobby", "required");

        $id = $this->input->post("id");

        if ($this->form_validation->run() == false) {

            $this->updateHobby($id);

        } else {

            $checkhobbytitle = $this->Hobby_model->GetData("hobbies", "", "hobby_title='" . $this->input->post('hobby_title', TRUE) . "' and id='" . $id . "'", "", "", "", "");
            if (!empty($checkhobbytitle)) {
                $this->session->set_flashdata('warning', 'Hobby is already exist');
                redirect('Hobbies/update/' . $id);
            } else {

                $updatehobby = array(

                    "hobby_title" => $this->input->post("hobby"),
                    "status" => $this->input->post("status"),
                );
                //    print_r($updatehobby); exit;

                $this->Hobby_model->SaveData("hobbies", $updatehobby, "id='" . $id . "'");
                $this->session->set_flashdata("success", "hobby Updated successfully");
                redirect("HobbieController/hobbylist");

            }
        }

    }




    public function delete($id)
    {
        // call delete function from model with id/token
        $gethobbydata = $this->Hobby_model->GetData("hobbies", "", "token ='" . $id . "'", "", "", "", "1");
        $gethobbymapdata = $this->Hobby_model->GetData("guests", "id", "hobby_id LIKE('%" . $gethobbydata->id . "%')", "", "", "", "");

        $gethobbymapdata1 = $this->Hobby_model->GetData("users", "id", "hobby LIKE('%" . $gethobbydata->id . "%')", "", "", "", "");
        if (!empty($gethobbymapdata) || !empty($gethobbymapdata1)) {
            $this->session->set_flashdata('warning', 'Hobby is already mapped');
            redirect("HobbieController/hobbylist");
        } else {
            $this->Hobbies_model->DeleteData("hobbies", "id ='" . $gethobbydata->id . "'");
            $this->session->set_flashdata('error', "Hobby record has been deleted successfully");
            redirect("HobbieController/hobbylist");
        }
    }

    public function deleteall_action()
    {
        if (isset($_POST['deleteall'])) {
            if (!empty($this->input->post('selector'))) {
                $id = $this->input->post('selector');
                if (!empty($id)) {
                    $del = 0;
                    $nondel = 0;
                    for ($i = 0; $i < count($id); $i++) {
                        $gethobbydata = $this->Hobby_model->GetData("hobbies", "id", "id='" . $id[$i] . "'", "", "", "", "");

                        foreach ($gethobbydata as $gethobby) {
                            $gethobby = $this->Hobby_model->GetData("guests", "id", "hobby_id LIKE('%" . $gethobby->id . "%')", "", "", "", "");

                            $gethobby1 = $this->Hobby_model->GetData("users", "id", "hobby LIKE('%" . $gethobbydata->id . "%')", "", "", "", "");
                            if (!empty($gethobby) || !empty($gethobby1)) {
                                $nondel++;
                            } else {
                                $this->Hobby_model->deleteHobby("hobbies", "id ='" . $gethobby->id . "'");
                                $del++;
                            }
                        }
                    }
                    $massage = $del . " hobby record has been deleted" . "<br/>" . $nondel . " hobby record not deleted";
                    $this->session->set_flashdata('error', $massage);
                    redirect("HobbieController/hobbylist");
                }
            } else {
                $this->session->set_flashdata('error', 'Check atleast one record to delete');
                redirect("HobbieController/hobbylist");
            }
        }
    }

    public function export()
    {
        $id = $this->input->post('hobbycollectid');
        //  print_r($id); exit;
        $this->Hobby_model->ExportData("hobbies", "hobby_title,status,created", $id);
    }


    
    public function import()
    {
        // Check if form was submitted
        if ($this->input->post('upload') != NULL) {
            // Check if a file was selected
            if (!empty($_FILES['file']['name'])) {
                // Upload configuration
                $config['upload_path'] = 'assets/files';
                $config['allowed_types'] = 'csv';
                $config['max_size'] = '1000';
                $config['file_name'] = $_FILES['file']['name'];

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Handle file upload
                if (!$this->upload->do_upload('file')) {
                    // Set error flashdata and redirect
                    $this->session->set_flashdata("error", "File not uploaded");
                    redirect('HobbieController/hobbylist');
                } else {
                    // File successfully uploaded
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];

                    // Open the uploaded CSV file
                    $file = fopen("assets/files/" . $filename, "r");
                    $i = 0;
                    $numberOfFields = 3; // Total number of fields
                    $importData_arr = array();
                    $dup = 0; // Variable to count duplicates

                    // Read the CSV file
                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);
                        // print_r($numberOfFields);
                        // print_r("======");
                        if ($numberOfFields == $num) {
                            $importData_arr[$i] = $filedata;
                        }
                        $i++;
                    }
                   ////  print_r($importData_arr);
                   //  exit();
                    fclose($file);

                    $skip = 0;
                    // Insert import data into the database
                    foreach ($importData_arr as $hobbyData) {
                        // Skip the first row (headers)
                        if ($skip != 0) {
                            // Check for duplicates
                            $hobbyduplication = $this->Hobby_model->GetData("hobbies", "hobby_title", "hobby_title='" . $hobbyData[0] . "'");

                            if (!empty($hobbyduplication)) {
                                $dup++;
                            } else {
                                // Import data if no duplication
                                $this->Hobby_model->ImportData($hobbyData);
                            }
                        }
                        $skip++;
                    }

                    // Calculate and set flashdata for records
                    $totalrecords = count(file("assets/files/" . $filename));
                    $this->session->set_flashdata("warning", $dup . " duplicate hobbies record found");
                    $recordimport = ($totalrecords - 1) - $dup;


                    $this->session->set_flashdata("success", $recordimport . " Records imported");
                    $this->session->set_flashdata("info", ($totalrecords - 1) . " Total records");

                    // Redirect to hobby list
                    redirect('HobbieController/hobbylist');
                }
            } else {
                // Set error flashdata for no file selected
                $this->session->set_flashdata("error", "Please select a CSV file");
                redirect('HobbieController/hobbylist');
            }
        }
    }

    public function updateStatus()
    {
        $id = $this->input->post('id');
        $hobby = $this->Hobby_model->getData("hobbies", "", "id='" . $id . "'", "", "", "", "1");

        if ($hobby->status == 'Pending') {
            $data = array('status' => 'Active');
        } elseif ($hobby->status == 'Active') {
            $data = array('status' => 'Block');
        } elseif ($hobby->status == 'Block') {
            $data = array('status' => 'Active');
        }

        if ($this->Hobby_model->update_status($id, $data)) {
            $response = array('status' => 'success', 'new_status' => $data['status']);
        } else {
            $response = array('status' => 'error');

        }

        echo json_encode($response);
    }

    public function addhobby()
    {

        $this->load->view("hobbies/addmorehobbies");
    }

    public function add_hobbies()
    {
        // Retrieve the posted hobby titles as an array
        $hobbies = $this->input->post('hobby_title');

        // Check if hobbies is an array and not empty
        if (is_array($hobbies) && !empty($hobbies)) {
            // Save the hobbies using the model
            $response = $this->Hobby_model->save_hobbies($hobbies);

            // Send a success response
            echo json_encode(['status' => 'success', 'message' => 'Hobbies saved successfully!']);
        } else {
            // Send an error response if no hobbies were provided
            echo json_encode(['status' => 'error', 'message' => 'No hobbies provided!']);
        }
        echo json_encode($response);
    }


}
?>