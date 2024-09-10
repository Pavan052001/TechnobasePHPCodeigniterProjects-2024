<?php
class CityController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("City_model");
        $this->load->model("Country_model");
        $this->load->library("form_validation");
    }

    public function managelist()
    {
        $allcities = $this->City_model->GetCitiesData("cities", "cities.id,cities.token,cities.city_name,cities.status,states.state_name,countries.country_name");
        
        //    print_r($allcities); exit;    

        $data = array(

            "allcities" => $allcities,
        );
        $this->load->view("cities/managecities", $data);
    }


    public function create()
    {

        $getAllstate = $this->City_model->GetData("states", "id,state_name", "status='Active'", "", "", "", "");
        $getAllcountry = $this->City_model->GetData("countries", "id,country_name", "status='Active'", "", "", "", "");


        $data = array(
            "getallState" => $getAllstate,
            "getAllcountry"=>$getAllcountry,
            'country_id' => set_value('country_id', $this->input->post('country_id', TRUE)),
            'state_id' => set_value('state_id', $this->input->post('state_id', TRUE)),
            'city_name' => set_value('city_name', $this->input->post('name', TRUE)),
            'status' => set_value('status', $this->input->post('status', TRUE))
        );

        $this->load->view("cities/createcity", $data);
    }

    public function create_action()
    {

        $this->form_validation->set_rules("name", "City Name", "required");
        $this->form_validation->set_rules("state_id", "State", "required");
        $this->form_validation->set_rules("status", "status", "required");

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {

            $checkcityname = $this->City_model->GetData("cities", "", "city_name='" . $this->input->post('name', TRUE) . "' and state_id='" . $this->input->post('state_id', TRUE) . "'", "", "", "", "");
            if (!empty($checkcityname)) {
                $this->session->set_flashdata('warning', 'City is already exist');
                redirect('CityController/create');
            } else {
                $data = array(
                    "city_name" => $this->input->post('name'),
                    "state_id" => $this->input->post('state_id'),
                    "country_id"=> $this->input->post("country_id"),
                    "status" => $this->input->post('status'),
                );
                // print_r($data); exit;

                $this->City_model->saveData("cities", $data);
                $this->session->set_flashdata("success", "City created successfully");
                redirect("CityController/managelist");


            }
        }
    }

    public function update($id)
    {

        $getCity = $this->City_model->getData("cities", "", "id='" . $id . "'", "", "", "", "1");

        $allstates = $this->City_model->GetData("states", "id,state_name", "status='Active'", "state_name", "", "");
        $getAllcountry = $this->City_model->GetData("countries", "id,country_name", "status='Active'", "", "", "", "");

        $data = array(

            "getallstate" => $allstates,
            "getAllcountry"=>$getAllcountry,
            "id" => set_value("state_id", $getCity->id),
            "state_id" => set_value("state_id", $getCity->state_id),
            "country_id" => set_value("country_id", $getCity->country_id),
            "name" => set_value("name", $getCity->city_name),
            "status" => set_value("status", $getCity->status),
        );

        $this->load->view("cities/update", $data);

    }

    public function update_action()
    {

        $id = $this->input->post("id");
        // print_r($id); exit;
        $this->form_validation->set_rules("country_id", "Country", "required");
        $this->form_validation->set_rules("state_id", "state", "required");
        $this->form_validation->set_rules("name", "city Name", "required");
        $this->form_validation->set_rules("status", "status", "required");

        if ($this->form_validation->run() == false) {

            $this->update($id);

        } else {

            $data = array(
                'state_id' => $this->input->post("state_id", TRUE),
                'country_id' => $this->input->post("country_id", TRUE),
                'city_name' => ucwords($this->input->post("name", TRUE)),
                'status' => $this->input->post("status", TRUE),
            );

            $this->City_model->SaveData("cities", $data, "id='" . $id . "'");
            // print_r($data); exit;
            $this->session->set_flashdata("success", "city updated successfully");
            redirect("CityController/managelist");
        }
    }

    public function deletecity($id)
    {

        $getcity = $this->City_model->GetData("cities", "", "id='" . $id . "'", "", "", "", "1");
        $getcheck= $this->City_model->GetData("guests", "", "city_id='" . $getcity->id. "'", "", "", "", "1");
        if(!empty($getcheck)){
            $this->session->set_flashdata('warning', 'City is mapped with guest');
            redirect("CityController/managelist");

        }else{
            $this->City_model->Delete("cities", "id ='" . $getcity->id . "'");
        $this->session->set_flashdata('error', 'City has been deleted successfully');
        redirect("CityController/managelist");
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
						$getcity = $this->City_model->GetData("cities","id","id='".$id[$i]."'","","","","");
						foreach($getcity as $getcitydata)
						{
							$checkguest = $this->City_model->GetData("guests","id","city_id='".$getcitydata->id."'","","","","");
							if(!empty($checkguest))
							{
								$nondel++;
							}
							else
							{
								$this->City_model->delete("cities","id ='".$getcitydata->id."'");
								$del++; 
							}
						}
					}  
					$massage= $del." City record has been deleted"."<br/>".$nondel." City record not deleted";
					$this->session->set_flashdata('error',$massage);
					redirect("CityController/managelist");
				}
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
				redirect("CityController/managelist");
			}
		}
	}


    public function export()
	{
		$id = $this->input->post('cityidcollect');

        // print_r($id); exit;
		$this->City_model->ExportData("cities","state_name,country_name,city_name,status,created",$id);
	}

    public function updateStatus() {
        $id = $this->input->post('id');
        $hobby = $this->City_model->getData("cities","","id='".$id."'","","","","1");
    
        if ($hobby->status == 'Pending') {
            $data = array('status' => 'Active');
        } elseif ($hobby->status == 'Active') {
            $data = array('status' => 'Block');
        } elseif ($hobby->status == 'Block') { 
            $data = array('status' => 'Active');
        }
    
        if ($this->City_model->update_status("cities",$data,$id)) {
            $response = array('status' => 'success', 'new_status' => $data['status']);	
        } else {
            $response = array('status' => 'error');
            
        }
    
        echo json_encode($response);
    }

    public function import()
{
    if($this->input->post('upload') != NULL){
        if($_FILES['file']['name']){
            $config['upload_path'] = 'assets/files';
            $config['allowed_types'] = 'csv';
            $config['max_size'] = '1000';
            $config['file_name'] = $_FILES['file']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')){
                $this->session->set_flashdata("error","File not uploaded");
                redirect('CityController/managelist');
            } else {
                $uploadData = $this->upload->data();
                $filename = $uploadData['file_name'];
                $file = fopen("assets/files/".$filename,"r");
                $i = 0;
                $numberOfFields = 5; // total number of fields
                $importData_arr = array();
                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                    $num = count($filedata);
                    if ($numberOfFields == $num) {
                        $importData_arr[$i] = $filedata;
                    }
                    $i++;
                }

                // print_r($importData_arr); exit;
                fclose($file);
                $skip = 0; $dup = 0; $countryexist = 0; $stateexist = 0;
                foreach($importData_arr as $cityData){    
                    if($skip != 0){
                        $checkcountryexist = $this->City_model->GetData("countries","id,country_name","country_name= '".$cityData[0]."'","","","","1");
                        if(empty($checkcountryexist))
                        {
                            $countryexist++;
                        }
                        else
                        {

                             $checkstateexist = $this->City_model->GetData("states","id,state_name","state_name = '".$cityData[1]."'","","","","1");
                            
                            if(empty($checkstateexist))
                            {
                                $stateexist++;
                            }
                            else
                            {
                                $cityduplication = $this->City_model->GetCitiesexportData("cities","cities.city_name,states.state_name,countries.country_name","cities.city_name='".$cityData[2]."' ","1");
                                if(!empty($cityduplication))
                                {
                                    $dup++;
                                }
                                else
                                {
                                    $cityData[0] = $checkcountryexist->id;
                                    $cityData[1] = $checkstateexist->id;
                                    $this->City_model->ImportData($cityData);                                    
                                }
                            }
                        }
                    }
                    $skip++;
                }
                $totalrecords = count(file("assets/files/".$filename));
                $this->session->set_flashdata("warning",$dup." Duplicate cities record found");
                if(!empty($countryexist) || !empty($stateexist))
                {    
                    $this->session->set_flashdata("error",$countryexist." Country not found, ".$stateexist." State not found");
                }
                $recordimport = ($totalrecords-1)-$dup-$countryexist-$stateexist;
                $this->session->set_flashdata("success",$recordimport." Records imported");
                $this->session->set_flashdata("info",($totalrecords-1)." Total records");
                redirect('CityController/managelist');
            }
        } else {
            $this->session->set_flashdata("error","Please select csv file");    
            redirect('CityController/managelist');
        }
    }
}

// public function import()
// {
//     if($this->input->post('upload') != NULL){
//         if($_FILES['file']['name']){
//             $config['upload_path'] = 'assets/files';
//             $config['allowed_types'] = 'csv';
//             $config['max_size'] = '1000';
//             $config['file_name'] = $_FILES['file']['name'];
//             $this->load->library('upload', $config);
//             $this->upload->initialize($config);
//             if (!$this->upload->do_upload('file')){
//                 $this->session->set_flashdata("error","File not uploaded: " . $this->upload->display_errors());
//                 redirect('CityController/managelist');
//             } else {
//                 $uploadData = $this->upload->data();
//                 $filename = $uploadData['file_name'];
//                 $file = fopen("assets/files/".$filename,"r");
//                 $i = 0;
//                 $numberOfFields = 5; // total number of fields
//                 $importData_arr = array();
//                 while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
//                     $num = count($filedata);
//                     if ($numberOfFields == $num) {
//                         $importData_arr[$i] = $filedata;
//                     }
//                     $i++;
//                 }
                
//                 fclose($file);
                
//                 $skip = 0; $dup = 0; $countryexist = 0; $stateexist = 0; $inserted = 0;
//                 foreach($importData_arr as $cityData){    
//                     if($skip != 0){ // Skip header row
//                         $checkcountryexist = $this->City_model->GetData("countries","id,country_name","country_name = '".$cityData[1]."'","","","","");
//                         if(empty($checkcountryexist))
//                         {
//                             $countryexist++;
//                             //continue; // Skip to next iteration if country doesn't exist
//                         }
                        
//                         $checkstateexist = $this->City_model->GetData("states","id,state_name","state_name = '".$cityData[0]."'","","","","");
//                         if(empty($checkstateexist))
//                         {
//                             $stateexist++;
//                           //  continue; // Skip to next iteration if state doesn't exist
//                         }
                        
//                         $cityduplication = $this->City_model->GetData("cities","id","city_name='".$cityData[2]."'");
//                         if(!empty($cityduplication))
//                         {
//                             $dup++;
//                           //  continue; // Skip to next iteration if city already exists
//                         }
//                         // If we reach here, we can insert the city
//                         $cityData[1] = $checkcountryexist->id;
//                         $cityData[0] = $checkstateexist->id;
//                         $this->City_model->ImportData($cityData);
//                         $inserted++;
//                     }
//                     $skip++;
//                 }
                
                
//                  $totalrecords = count($importData_arr) - 1; // Subtract 1 for header row
//                 $this->session->set_flashdata("warning", $dup . " Duplicate cities record found");
//                 if($countryexist > 0 || $stateexist > 0)
//                 {    
//                     $this->session->set_flashdata("error", $countryexist . " Country not found, " . $stateexist . " State not found");
//                 }
//                 $this->session->set_flashdata("success", $inserted . " Records imported successfully");
//                 // $this->session->set_flashdata("info", $totalrecords . " Total records processed");
//                 redirect('CityController/managelist');
//             }
//         } else {
//             $this->session->set_flashdata("error","Please select csv file");    
//             redirect('CityController/managelist');
//         }
//     }
// }

}



?>