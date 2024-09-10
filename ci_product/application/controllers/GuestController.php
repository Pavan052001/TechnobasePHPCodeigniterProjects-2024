<?php
class GuestController extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model("Guest_model");
        $this->load->library("form_validation");
    }



// admin users
    public function getguest()
    {
       
        $guestdata = $this->Guest_model->managelist("guests", "users.name as username,guests.name,guests.email_address,guests.dob,guests.id,guests.dob,guests.gender,guests.photo,guests.status,cities.city_name,countries.country_name,states.state_name,hobbies.hobby_title");

        //   print_r($guestdata); exit;
        $data = array(
            "guestdata" => $guestdata,
        );
        $this->load->view("guest/guestlist", $data);
    }

    public function getlist()
    {
        $user_id = $_SESSION["id"];

        $getall = $this->Guest_model->guestManagelist("guests", "guests.name,guests.email_address,guests.dob,guests.id,guests.dob,guests.gender,guests.photo,guests.status,cities.city_name,countries.country_name,states.state_name,hobbies.hobby_title", $user_id);

        $data = array(
            "getall" => $getall,
        );
        $this->load->view("guest/list", $data);
    }

    public function create()
    {

        $allhobbies = $this->Guest_model->getData("hobbies", "id,hobby_title", "status='Active'", "hobby_title", "", "");

        $getallcountry = $this->Guest_model->getData("countries", "id,country_name", "status='Active'", "", "", "");

        $getallstates = $this->Guest_model->getData("states", "id,state_name", "status='Active'", "", "", "");

        $allcities = $this->Guest_model->getData("cities", "id,city_name", "status='Active'", "", "", "", "");

        // print_r($getallstates); exit;

        $data = array(
            "allcities" => $allcities,
            "getallstates" => $getallstates,
            "getallcountry" => $getallcountry,
            "allhobbies" => $allhobbies,
            "name" => set_value("name", $this->input->post("name")),
            "email" => set_value("email", $this->input->post("email")),
            "number" => set_value("number", $this->input->post("number")),
            "address" => set_value("address", $this->input->post("address")),
            "country_id" => set_value("country_id", $this->input->post("country_id")),
            "state_id" => set_value("state_id", $this->input->post("state_id")),
            "city_id" => set_value("city_id", $this->input->post("city_id")),
            "date" => set_value("date", $this->input->post("date")),
            "status" => set_value("status", $this->input->post("status")),
            "gender" => set_value("gender", $this->input->post("gender")),
            'hobby_id' => set_value('hobby_id', $this->input->post('hobby_id', TRUE)),
            'details_about_guest'=>set_value("details_about_guest",$this->input->post("details_about_guest")),


        );
        $this->load->view("guest/createguest", $data);
    }

    public function create_action()
    {

        $id = $_SESSION["id"];

        // print_r($id); exit;

        $this->form_validation->set_rules("name", "Your Name", "required|regex_match[/^[a-zA-Z- ]*$/]");
        $this->form_validation->set_rules("email", "Email", "required|valid_email|is_unique[guests.email_address]");
        // $this->form_validation->set_rules("number","Mobile","required");
        $this->form_validation->set_rules("address", "Address", "required");
        $this->form_validation->set_rules("country_id", "Country", "required");
        $this->form_validation->set_rules("state_id", "State", "required");
        $this->form_validation->set_rules("city_id", "City", "required");
        $this->form_validation->set_rules("status", "Status", "required");
        $this->form_validation->set_rules("gender", "Gender", "required");
        $this->form_validation->set_rules("date", "date", "required");
        $this->form_validation->set_rules('hobby_id[]', 'hobbies', 'required');
        $this->form_validation->set_rules('details_about_guest','Details_about','required');


        if ($this->form_validation->run() == false) {
            $this->create();

        } else {

          $checkemail=  $this->Guest_model->getdata("guests","","email_address='".$this->input->post("email")."'","","","","");

           if($checkemail){

            $this->session->set_flashdata("warning", "email already exist");
            redirect("GuestController/create");
           }else{

            if ($_FILES['image']['error'] == 0) {

                $config['upload_path'] = './uploads/guestimage';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = 2048; // 2MB
                $config['max_width'] = 160000;
                $config['max_height'] = 120000;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());

                    $this->load->view('register', $error);
                    $this->session->set_flashdata('error', 'Unable to upload Image ');
                } else {
                    $data = array('upload' => $this->upload->data());

                    $image = $data['upload']['file_name'];
                }


                $data = array(
                    'token' => md5('Guests-token' . time() . rand(1000, 9999)),
                    'user_id' => $id,
                    'name' => ucfirst($this->input->post('name')),
                    'email_address' => $this->input->post('email'),
                    'dob' => $this->input->post("date"),
                    'address' => $this->input->post('address'),
                    'gender' => $this->input->post('gender'),
                    'country_id' => $this->input->post('country_id'),
                    'state_id' => $this->input->post('state_id'),
                    'city_id' => $this->input->post('city_id'),
                    'hobby_id' => implode(', ', $this->input->post('hobby_id', TRUE)),
                    'photo' => $image,
                    'status' => $this->input->post("status"),
                    'details_about_guest'=>$this->input->post('details_about_guest'),

                );


                //  print_r($data); exit;
                $this->Guest_model->saveData("guests", $data);

                if ($_SESSION['role'] == 'Admin') {
                    $this->session->set_flashdata("success", "Guest created successfully");
                    redirect("GuestController/getguest");
                } else {

                    $this->session->set_flashdata("success", "Guest created successfully");
                    // redirect("GuestController/getguest");
                    if ($_SESSION["role"] == "Admin") {
                        redirect("GuestController/getlist");
                    } else {
                        redirect("GuestController/getlist");
                    }
                }

            }

        }
           }

    }


    public function getstates()
    {
        $country_id = $this->input->post("country_id");
        $states = $this->Guest_model->get_states($country_id);

        $data = [];
        $data['states'] = $states;

        //  echo  $stateString =$this->load->view("select_states",$data,true);
        $stateString = $this->load->view("select_states", $data, true);
        $response['states'] = $stateString;
        echo json_encode($response);

    }

    public function getcities()
    {
        $state_id = $this->input->post("state_id");
        $cities = $this->Guest_model->get_cities($state_id);

        $data = [];
        $data['cities'] = $cities;

        //  echo  $stateString =$this->load->view("select_states",$data,true);
        $stateString = $this->load->view("select_cities", $data, true);
        $response['cities'] = $stateString;
        echo json_encode($response);

    }



    public function update($id)
    {

        // print_r($id); exit;

        $getsingleguests = $this->Guest_model->getData("guests", "", "id='" . $id . "'", "", "", "", "single");
        // print_r($getsingleguests); exit;
        if (!empty($getsingleguests)) {
            $allhobbies = $this->Guest_model->getData("hobbies", "id,hobby_title", "status='Active'", "hobby_title", "", "");
            $allcountries = $this->Guest_model->getData("countries", "id,country_name", "status='Active'", "country_name", "", "");
            $allstates = $this->Guest_model->getData("states", "id,state_name", "status='Active'", "state_name", "", "");
            $allcities = $this->Guest_model->getData("cities", "id,city_name", "status='Active'", "city_name", "", "");
            $data = array(
                'allhobbies' => $allhobbies,
                'getallcountry' => $allcountries,
                'getallstates' => $allstates,
                'allcities' => $allcities,
                'id' => set_value("id", $getsingleguests->id),
                'name' => set_value('name', $getsingleguests->name),
                'email' => set_value('email', $getsingleguests->email_address),
                'address' => set_value('address', $getsingleguests->address),
                 'details_about_guest' =>  set_value('details_about_guest',$getsingleguests->details_about_guest),
                'date' => set_value('date', $getsingleguests->dob),
                'gender' => set_value('gender', $getsingleguests->gender),
                'country_id' => set_value('country_id', $getsingleguests->country_id),
                'state_id' => set_value('state_id', $getsingleguests->state_id),
                'city_id' => set_value('city_id', $getsingleguests->city_id),
                'hobby_id' => set_value('hobby_id', explode(",", $getsingleguests->hobby_id)),
                "photo" => set_value('photo', $getsingleguests->photo),
                'status' => set_value('status', $getsingleguests->status)
            );

            $this->load->view("guest/update", $data);
        }
    }

    public function update_action()
    {

        $id = $this->input->post("id");
        // print_r($id); exit;

        $this->form_validation->set_rules("name", "Your Name", "required|regex_match[/^[a-zA-Z- ]*$/]");
        $this->form_validation->set_rules("email", "Email", "required");
        // $this->form_validation->set_rules("number","Mobile","required");
        $this->form_validation->set_rules("address", "Address", "required");
        $this->form_validation->set_rules("country_id", "Country", "required");
        $this->form_validation->set_rules("state_id", "State", "required");
        $this->form_validation->set_rules("city_id", "City", "required");
        $this->form_validation->set_rules("status", "Status", "required");
        $this->form_validation->set_rules("gender", "Gender", "required");
        $this->form_validation->set_rules("date", "date", "required");


        if ($this->form_validation->run() == false) {

            $this->update($id);

        } else {

            $oldcountryimage = $this->Guest_model->GetData("Guests", "", "id ='" . $id . "'", "", "", "", "1");

            $oldimage = $oldcountryimage->photo;
            //  print_r($oldimage); exit ;
            if ($_FILES['image']['error'] == 0) {

                $config['upload_path'] = './uploads/guestimage';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = 2048; // 2MB
                $config['max_width'] = 16000;
                $config['max_height'] = 12000;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    $error = array('error' => $this->upload->display_errors());

                    $this->load->view('register', $error);
                    $this->session->set_flashdata('error', 'Unable to upload Image ');
                } else {

                    if (file_exists('./uploads/guestimage/' . $oldimage)) {
                        unlink('./uploads/userimage/' . $oldimage);
                    }
                    $data = array('upload' => $this->upload->data());

                    $image = $data['upload']['file_name'];
                }
            } else {
                $image = $oldimage;

            }
            $data = array(
                "name" => $this->input->post("name"),
                "email_address" => $this->input->post("email"),
                "address" => $this->input->post("address"),
                "gender" => $this->input->post("gender"),
                "country_id" => $this->input->post("country_id"),
                "state_id" => $this->input->post("state_id"),
                "city_id" => $this->input->post("city_id"),
                'hobby_id' => implode(", ", $this->input->post('hobby_id', TRUE)),
                "photo" => $image,
                "status" => $this->input->post("status"),
                "details_about_guest"=>$this->input->post("details_about_guest"),


            );

            //  print_r($data); exit;
            $this->Guest_model->savedata("guests", $data, "id='" . $id . "'");
            $this->session->set_flashdata("success", "Guest updated successfully");

            if ($_SESSION["role"] == "Admin") {
                redirect("GuestController/getguest");
            } else {
                redirect("GuestController/getlist");
            }

        }
    }

    public function delete($id)
    {

        $getguest = $this->Guest_model->getData("guests", "", "id='" . $id . "'", "", "", "", "1");

        $image = $getguest->photo;


        if (empty($getguest)) {

            $this->session->set_flashdata("warning", "unable to delete");
            redirect("GuestController/getlist");
        } else {

            $this->Guest_model->delete("guests", "id='" . $getguest->id . "'");
            unlink("uploads/guestimage/" . $image);
            $this->session->set_flashdata("success", "guest deleted successfully");

            if ($_SESSION["role"] == "Admin") {
                redirect("GuestController/getguest");
            } else {
                redirect("GuestController/guestlist");

            }


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
                        $getguest = $this->Guest_model->GetData("guests", "id", "id='" . $id[$i] . "'", "", "", "", "");
                        $image = $getguest->image;
                        foreach ($getguest as $getdata) {


                            if (empty($getguest)) {
                                $nondel++;
                            } else {
                                $this->Guest_model->Delete("guests", "id ='" . $getdata->id . "'");

                                unlink("uploads/guestimage/" . $image);
                                $del++;
                            }
                        }
                    }
                    $massage = $del . " guests record has been deleted" . "<br/>" . $nondel . " guests record not deleted";
                    $this->session->set_flashdata('error', $massage);

                    if ($_SESSION["role"] == "Admin") {
                        redirect("GuestController/getlist");
                    } else {
                        redirect("GuestController/guestlist");

                    }
                }
            } else {
                $this->session->set_flashdata('error', 'Check atleast one record to delete');
                redirect("GuestController/getlist");
            }
        }
    }


    public function view($id)
    {

        $guestdata = $this->Guest_model->getData("guests", "", "id='" . $id . "'", "", "", "", "1");
        //   print_r($userdata); exit;

        $data = array(

            "guestdata" => $guestdata,
        );
        // print_r($data); exit;

        $this->load->view("guest/profile", $data);

    }

  

//     public function export()
// {
//     $id = $this->input->post('collectid');
//     // print_r($id); exit;
//     $this->Guest_model->ExportData(
//         "users",
//         "country_name,state_name,city_name,name,email_address,address,dob,gender,hobby_title,photo,status,created",
//         $id
//     );
// }

public function export()
{
    $id = $this->input->post('collectid');
    // print_r($id); exit;
  $this->Guest_model->ExportData("guests","username,name,email_address,address,details_about_guest,dob,gender,country,state,city,hobby",$id);
//    print_r($data); exit;
}

public function updateStatus() {
    $id = $this->input->post('id');
    $hobby = $this->Guest_model->getData("guests","","id='".$id."'","","","","1");

    if ($hobby->status == 'Pending') {
        $data = array('status' => 'Active');
    } elseif ($hobby->status == 'Active') {
        $data = array('status' => 'Block');
    } elseif ($hobby->status == 'Block') { 
        $data = array('status' => 'Active');
    }

    if ($this->Guest_model->update_status("guests",$data,$id)) {
        $response = array('status' => 'success', 'new_status' => $data['status']);	
    } else {
        $response = array('status' => 'error');
        
    }

    echo json_encode($response);
}

public function import()
    {
        //if form submit or not
        if ($this->input->post('upload') != NULL) {
            //$data = array();
            if ($_FILES['file']['name']) {
                $config['upload_path'] = 'assets/files';
                $config['allowed_types'] = 'csv';
                $config['max_size'] = '1000';
                $config['file_name'] = $_FILES['file']['name'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                // print_r($this->upload->do_upload('file')); exit();
                if (!$this->upload->do_upload('file')) {
                    $this->session->set_flashdata("error", "File not uploaded");
                    redirect("GuestController/getguest");
                } else {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    //reading upload file
                    $file = fopen("assets/files/" . $filename, "r");
                    $i = 0;
                    $numberOfFields = 11; // total number of fields
                    $importData_arr = array();
                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);
                        if ($numberOfFields == $num) {
                            for ($c = 0; $c < $num; $c++) {
                                $importData_arr[$i][] = $filedata[$c];
                            }
                        }
                        $i++;
                    }
                    // print_r($importData_arr);
                    // exit;
                    fclose($file);
                    $skip = 0;
                    $dup = 0;
                    $countryexist = 0;
                    $stateexist = 0;
                    $cityexist = 0;
                    $hobbyexist = 0;
                    //insert import data
                    //print_r($importData_arr); exit();
                    foreach ($importData_arr as $userData) {
                        //skip first row
                        if ($skip != 0) {
                            $checkstateexist = $this->Guest_model->getdata("states", "id,state_name", "state_name = '" . $userData[1] . "'", "", "", "", "");
                            $checkcountryexist = $this->Guest_model->getdata("countries", "id,country_name", "country_name = '" . $userData[0] . "'", "", "", "", "");
                            $checkcityexist = $this->Guest_model->getdata("cities", "id,city_name", "city_name = '" . $userData[2] . "'", "", "", "", "");
                            $checkhobbyexist = $this->Guest_model->getdata("hobbies", "id,hobby_title", "hobby_title = '" . $userData[3] . "'", "", "", "", "");



                            // print_r($checkstateexist);
                            // exit;

                            //print_r($this->db->last_query()); exit();
                            if (empty($checkstateexist)  && empty($checkcountryexist) && empty($checkcityexist) && empty($checkhobbyexist)) {
                                $countryexist++;
                                $stateexist++;
                                $cityexist++;
                                $hobbyexist++;
                            } else {
                                $Userduplication = $this->Guest_model->GetGuestsexportData("guests", "cities.city_name,states.state_name,countries.country_name,hobbies.hobby_title", "guests.name='" . $userData[5] . "'","1");


                                if (!empty($Userduplication)) {
                                    $dup++;
                                } else {
                                    foreach ($checkcountryexist as $countryexists) {
                                        $userData[0] = $countryexists->id;
                                    }
                                    foreach ($checkstateexist as $stateexists) {
                                        $userData[1] = $stateexists->id;
                                    }
                                    foreach ($checkcityexist as $cityexists) {
                                        $userData[2] = $cityexists->id;
                                    }
                                    foreach ($checkhobbyexist as $hobbyexists) {
                                        $userData[3] = $hobbyexists->id;
                                    }
                                    //print_r($stateData); exit();
                                    $this->Guest_model->ImportData($userData);
                                }
                            }
                        }
                        $skip++;
                    }
                    $totalrecords = count(file("assets/files/" . $filename));
                    // print_r($totalrecords);
                    // exit();
                    $this->session->set_flashdata("warning", $dup . " Duplicate users record found");
                    if (!empty($countryexist) && !empty($stateexist) && !empty($cityexist) && !empty($hobbyexist)) {
                        $this->session->set_flashdata("error", $countryexist . $stateexist . $cityexist . $hobbyexist . " Country, state, city, hobby not found");
                    }
                    if (!empty($checkcountryexist->id) || $i > 0) {
                        $recordimport = ($totalrecords - 1) - $dup - $countryexist;
                        $this->session->set_flashdata("success", $recordimport . " Records imported");
                    } elseif (!empty($checkstateexist->id) || $i > 0) {
                        $recordimportstate = ($totalrecords - 1) - $dup - $stateexist;
                        $this->session->set_flashdata("success", $recordimportstate . " Records imported");
                    } elseif (!empty($checkcityexist->id) || $i > 0) {
                        $recordimportcity = ($totalrecords - 1) - $dup - $cityexist;
                        $this->session->set_flashdata("success", $recordimportcity . " Records imported");
                    } elseif (!empty($checkhobbyexist->id) || $i > 0) {
                        $recordimporthobby = ($totalrecords - 1) - $dup - $hobbyexist;
                        $this->session->set_flashdata("success", $recordimporthobby . " Records imported");
                    }
                    $this->session->set_flashdata("info", ($totalrecords - 1) . " Total records");
                    redirect("GuestController/getguest");
                }
            } else {
                $this->session->set_flashdata("error", "Please select csv file");
                redirect("GuestController/getguest");
            }
        }
    }



}

?>