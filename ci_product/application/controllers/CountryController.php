<?php

class CountryController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Country_model');
        $this->load->library("form_validation");

    }



    public function countrylist()
    {

        $getcountry["country"] = $this->Country_model->GetData("countries", "", "", "country_name", "", "", "");

        $this->load->view("countries/managecountry", $getcountry);
    }

    public function create()
    {

        $this->load->view("countries/createcountry");
    }

    public function create_Action()
    {

        $this->form_validation->set_rules("name", "Country Name", "required");
        $this->form_validation->set_rules("code", "Country code", "required");
        // $this->form_validation->set_rules("image","Country Flag","required");
        if($_FILES['image']['error']==4)
        {
            $this ->form_validation->set_rules('image','Country Flag','required');
        } 
        $this->form_validation->set_rules("status", "status", "required");

        if ($this->form_validation->run() == false) {

            $this->load->view("countries/createcountry");

            $this->session->set_flashdata("error", "country not saved");


        } else {

            $checkcountryname = $this->Country_model->GetData("countries", "country_name,country_flag", "country_name='" . $this->input->post('name', TRUE) . "'", "", "", "", "");
            if (!empty($checkcountryname)) {
                $this->session->set_flashdata('warning', 'Country is already exist');
                redirect('CountryController/countrylist');
            } else {


                if ($_FILES['image']['error'] == 0) {

                    $config['upload_path'] = './uploads/flag';
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

                    $inserCountry = array(

                        "country_name" => $this->input->post("name"),
                        "country_code" => $this->input->post("code"),
                        "country_flag" => $image,
                        "status" => $this->input->post("status"),
                    );

                    // print_r($inserCountry); exit;

                    $this->Country_model->saveData("countries", $inserCountry);

                    $this->session->set_flashdata('success', 'Country has been created successfully');
                    redirect("CountryController/countrylist");

                }
            }
        }

    }

    public function updateCountry($id)
    {

        $setCountry = $this->Country_model->GetData("countries", " ", "id='" . $id . "'", "", "", "", "1");

        $data = array(
            "id" => set_value('id', $setCountry->id),
            "name" => set_value("name", $setCountry->country_name),
            "code" => set_value("code", $setCountry->country_code),
            "image" => set_value("image", $setCountry->country_flag),
            "status" => set_value("status", $setCountry->status),
        );
        $this->load->view("countries/updatecountry", $data);
    }

    public function update_action()
    {

        $id = $this->input->post("id");
        // print_r($id); exit;

        $this->form_validation->set_rules("name", "Name", "required");
        $this->form_validation->set_rules("code", "code", "required");

        $this->form_validation->set_rules("status", "status", "required");

        if ($this->form_validation->run() == false) {

            $this->updateCountry($id);

        } else {

            $oldcountryimage = $this->Country_model->GetData("countries", "", "id ='" . $id . "'", "", "", "", "1");

            $oldimage = $oldcountryimage->country_flag;

            // print_r($oldimage); exit ;


            if ($_FILES['image']['error'] == 0) {


                $config['upload_path'] = './uploads/flag';
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

                    if (file_exists('./uploads/userimage/' . $oldimage)) {
                        unlink('./uploads/userimage/' . $oldimage);
                    }
                    $data = array('upload' => $this->upload->data());

                    $image = $data['upload']['file_name'];
                }
            } else {
                $image = $oldimage;

            }

            $updatecountry = array(

                "country_name" => $this->input->post("name"),
                "country_code" => $this->input->post("code"),
                "country_flag" => $image,
                "status" => $this->input->post("status"),
            );

            // print_r($updatecountry); exit;

            $this->Country_model->savedata("countries", $updatecountry, "id='" . $id . "'");
            $this->session->set_flashdata('success', 'Country has been Updated successfully');

            redirect("CountryController/countrylist");


        }



    }

    public function delete($id)
    {

        $getcountry = $this->Country_model->GetData("countries", "id,country_flag", "id='" . $id . "'", "", "", "", "1");

        $country_flag = $getcountry->country_flag;
        $checkmapcountry = $this->Country_model->GetData("states", "", "country_id='" . $getcountry->id . "'", "", "", "", "");

        $checkmapguest = $this->Country_model->GetData("guests", "", "country_id='" . $getcountry->id . "'", "", "", "", "");

        if (empty($getcountry)) {
            redirect("CountryController/countrylist");
        } else {
            if (!empty($checkmapcountry)||  !empty($checkmapcountry)) {
                $this->session->set_flashdata('warning', 'Country is already mapped');
                redirect("CountryController/countrylist");
            } else {
                if (!empty($country_flag)) {
                    //Remove record from table
                    $this->Country_model->deleteCountry("countries", "id ='" . $getcountry->id . "'");
                    // Remove attachment from folder 
                    unlink("uploads/flag/" . $country_flag);
                    $this->session->set_flashdata('success', 'Country has been deleted successfully');
                    redirect("CountryController/countrylist");
                }else{
                    $this->Country_model->deleteCountry("countries", "id ='" . $getcountry->id . "'");
                    // Remove attachment from folder 
                    $this->session->set_flashdata('success', 'Country has been deleted successfully');
                    redirect("CountryController/countrylist");

                }
            }
        }
    }

    public function deleteall_action()
	{	
		if(isset($_POST['deleteall']))
		{
			if(!empty($this->input->post('selector')))
			{
				$id = $this->input->post('selector');
				if(!empty($id))
				{	$del=0;$nondel=0;
					for($i=0;$i<count($id);$i++)
					{
						$getcountry = $this->Country_model->GetData("countries","id","id='".$id[$i]."'","","","","");
						foreach($getcountry as $getdata)
						{
							
                            $checkmap = $this->Country_model->GetData("states","","country_id='".$getdata->id."'","","","","");
                            $checkguest = $this->Country_model->GetData("guests","","country_id='".$getdata->id."'","","","","");
							if(!empty($checkmap) || !empty($checkguest))
							{
								$nondel++;
							}
							else
							{
								$this->Country_model->deleteCountry("countries","id ='".$getdata->id."'");
								$del++; 
							}
						}
					}  
					$massage= $del." City record has been deleted"."<br/>".$nondel." City record not deleted";
					$this->session->set_flashdata('error',$massage);
                    redirect("CountryController/countrylist");
				}
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
                redirect("CountryController/countrylist");
			}
		}
	}

    public function export()
	{
		$id = $this->input->post('countrycollectid');
        // print_r($id); exit;
		$this->Country_model->ExportData("countries","country_name,country_code,status,created",$id);
	}

    public function updateStatus() {
        $id = $this->input->post('id');
        $hobby = $this->Country_model->getData("countries","","id='".$id."'","","","","1");
    
        if ($hobby->status == 'Pending') {
            $data = array('status' => 'Active');
        } elseif ($hobby->status == 'Active') {
            $data = array('status' => 'Block');
        } elseif ($hobby->status == 'Block') { 
            $data = array('status' => 'Active');
        }
    
        if ($this->Country_model->update_status($id, $data)) {
            $response = array('status' => 'success', 'new_status' => $data['status']);	
        } else {
            $response = array('status' => 'error');
            
        }
    
        echo json_encode($response);
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
                    redirect('CountryController/countrylist');
                } else {
                    // File successfully uploaded
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];

                    // print_r($filename); exit;

                   

                    // Open the uploaded CSV file
                    $file = fopen("assets/files/" . $filename, "r");

                    // print_r($file); exit;
                    $i = 0;
                    $numberOfFields = 2; // Total number of fields
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
                    //  print_r($importData_arr);
                    //  exit();
                    fclose($file);

                    $skip = 0;
                    // Insert import data into the database
                    foreach ($importData_arr as $countryData) {
                        // Skip the first row (headers)
                        if ($skip != 0) {
                            // Check for duplicates
                            $duplication = $this->Country_model->GetData("countries", "country_name", "country_name='" . $countryData[0] . "'");

                            if (!empty($duplication)) {
                                $dup++;
                            } else {
                                // Import data if no duplication
                                $this->Country_model->ImportData($countryData);
                            }
                        }
                        $skip++;
                    }

                    // Calculate and set flashdata for records
                    $totalrecords = count(file("assets/files/" . $filename));
                    $this->session->set_flashdata("warning", $dup . " duplicate country record found");
                    $recordimport = ($totalrecords - 1) - $dup;


                    $this->session->set_flashdata("success", $recordimport . " Records imported");
                    $this->session->set_flashdata("info", ($totalrecords - 1) . " Total records");

                    // Redirect to hobby list
                    redirect('CountryController/countrylist');
                }
            } else {
                // Set error flashdata for no file selected
                $this->session->set_flashdata("error", "Please select a CSV file");
                redirect('CountryController/countrylist');
            }
        }
    }


}

?>