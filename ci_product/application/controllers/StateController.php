<?php
class StateController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("state_model");
        $this->load->library("form_validation");
    }

    public function managelist()
    {
        $allstates = $this->state_model->GetStatesData("states", "states.id,states.token,states.state_name,states.status,countries.country_name", "states.country_id=countries.id");

        $data = array(

            "allstate" => $allstates,

        );

        $this->load->view("states/managestate", $data);
    }

    public function create()
    {
        $allcountries = $this->state_model->GetData("countries", "id,country_name", "status='Active'", "country_name", "", "");

        $data = array(

            "allcountries" => $allcountries,
            "country_id" => set_value("country_id", $this->input->post("country_id")),
            "name" => set_value("name", $this->input->post("name")),
            "status" => set_value("status", $this->input->post("status")),
        );
        // print_r($data); exit;

        $this->load->view("states/createstate", $data);
    }

    public function create_action()
    {

        $this->form_validation->set_rules("name", "Name", "required");
        $this->form_validation->set_rules("status", "status", "required");
        $this->form_validation->set_rules("country_id", "Country", "required");


        if ($this->form_validation->run() == false) {
            $this->create();

        } else {
            $stateexits = $this->state_model->GetData("states", "", "state_name='" . $this->input->post("name") . "' and country_id ='" . $this->input->post("country_id") . "' ", "", "", "", "");

            print_r($stateexits);

            if (!empty($stateexits)) {

                $this->session->set_flashdata("warning", "state already exist");
                redirect("StateController/create");

            } else {

                $data = array(
                    'token' => md5('States-token' . time() . rand(1000, 9999)),
                    "country_id" => $this->input->post("country_id"),
                    "state_name" => $this->input->post("name"),
                    "status" => $this->input->post("status"),
                );

                $this->state_model->saveData("states", $data);
                redirect("StateController/managelist");
                $this->session->set_flashdata("success", "state created successfully");
            }

        }
    }

    public function update($id)
    {

        $getsingleState = $this->state_model->GetData("states", "", "id='" . $id . "'", "", "", "", "1", );
        $allcountries = $this->state_model->GetData("countries", "id,country_name", "status='Active'", "country_name", "", "");

        $data = array(
            "allCountries" => $allcountries,
            'id' => set_value('id', $getsingleState->id),
            'country_id' => set_value('country_id', $getsingleState->country_id),
            'state_name' => set_value('name', $getsingleState->state_name),
            'status' => set_value('status', $getsingleState->status)
        );


        $this->load->view("states/update", $data);
    }

    public function update_action()
    {

        $id = $this->input->post("id");

        $this->form_validation->set_rules("country_id", "Country", "required");
        $this->form_validation->set_rules("name", "State name", "required");
        $this->form_validation->set_rules("status", "status", "required");

        if ($this->form_validation->run() == false) {
            $this->update($id);

        } else {

            //   $getstate =  $this->state_model->GetData("states","","state_name='".$this->input->post("name")."'","","","","");

            //   if(!empty($getstate)){
            //     $this->session->set_flashdata('warning','State is already exist');
            // 				redirect('StateController/update/'.$id);
            //   }else{

            $data = array(
                "country_id" => $this->input->post("country_id"),
                "state_name" => $this->input->post("name"),
                "status" => $this->input->post("status"),
            );

            $this->state_model->saveData("states", $data, "id='" . $id . "'");
            $this->session->set_flashdata("success", "state has been updated successfully !");
            redirect("StateController/managelist");
        }

        //     }

    }

    public function deleteState($id)
    {

        $getState = $this->state_model->GetData("states", "", "id='" . $id . "'", "", "", "", "1");

        $checkCity = $this->state_model->GetData("cities", "", "state_id='" . $getState->id . "'", "", "", "", "");
        $checkguest = $this->state_model->GetData("guests", "", "state_id='" . $getState->id . "'", "", "", "", "");

        //  print_r($getState); exit;

        if (!empty($checkCity) || !empty($checkguest)) {
            $this->session->set_flashdata('warning', 'State is already mapped');
            redirect('StateController/managelist');
        } else {
            $this->state_model->delete("states", "id ='" . $getState->id . "'");
            $this->session->set_flashdata('error', 'State has been deleted successfully');
            redirect('StateController/managelist');
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
						$getcity = $this->state_model->GetData("states","id","id='".$id[$i]."'","","","","");
                       
						foreach($getcity as $getdata)
						{
                            $getguest = $this->state_model->GetData("guests","id","state_id='".$getdata->id."'","","","","");
                            $checkmap = $this->state_model->GetData("cities","","state_id='".$getdata->id."'","","","","");
							if(!empty($checkmap) && !empty($getguest))
							{
								$nondel++;
							}
							else
							{
								$this->state_model->delete("states","id ='".$getdata->id."'");
								$del++; 
							}
						}
					}  
					$massage= $del." City record has been deleted"."<br/>".$nondel." City record not deleted";
					$this->session->set_flashdata('error',$massage);
					redirect('StateController/managelist');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
				redirect('StateController/managelist');
			}
		}
	}

    public function export()
	{
		$id = $this->input->post('statecollectid'); 
        // print_r($id); exit;
		$this->state_model->ExportData("states","country_name,state_name,status,created",$id);
	}

    public function import()
	{
		//if form submit or not
		if($this->input->post('upload') != NULL){
			//$data = array();
			if($_FILES['file']['name']){
				$config['upload_path'] = 'assets/files';
				$config['allowed_types'] = 'csv';
				$config['max_size'] = '1000';
				$config['file_name'] = $_FILES['file']['name'];
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				// print_r($this->upload->do_upload('file')); exit();
                if (!$this->upload->do_upload('file')){
					$this->session->set_flashdata("error","File not uploaded");
					redirect('StateController/managelist');
					
				}else{
					$uploadData = $this->upload->data();
					$filename = $uploadData['file_name'];
					//reading upload file

                    // print_r($filename); exit;
					$file = fopen("assets/files/".$filename,"r");
					$i = 0;

                    // print_r($file); exit;
					$numberOfFields = 2; // total number of fields
					$importData_arr = array();
                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);
                       //  print_r($numberOfFields);
                        // print_r("======");
                        if ($numberOfFields == $num) {
                            $importData_arr[$i] = $filedata;
                        }
                        $i++;

                    
                    }
                    //   print_r($importData_arr);
                    //   exit();
                    fclose($file);
					$skip = 0; $dup = 0; $countryexist = 0 ;
					//insert import data
					//print_r($importData_arr); exit();
					foreach($importData_arr as $stateData){	
						//skip first row
						if($skip != 0){
							$checkcountryexist = $this->state_model->GetData("countries","id,country_name","id = '".$stateData[0]."'","","","","");
							//print_r($this->db->last_query()); exit();
							if(empty($checkcountryexist))
							{
								$countryexist++;
							}
							else
							{
								$stateduplication = $this->state_model->GetStatesData("states","states.state_name","states.state_name='".$stateData[1]."' and countries.country_name='".$stateData[0]."'");
								if(!empty($stateduplication))
								{
									$dup++;
								}
								else
								{
									foreach($checkcountryexist as $countryexists)
									{							
										$stateData[0] = $countryexists->id;
									}
									//print_r($stateData); exit();
									$this->state_model->ImportData($stateData);									
								}
							}
						}
						$skip++;
						}
						$totalrecords = count(file("assets/files/".$filename));
						$this->session->set_flashdata("warning",$dup." Duplicate states record found");
						if(!empty($countryexist))
						{	
							$this->session->set_flashdata("error",$countryexist." Country not found");
						}
						if(!empty($checkcountryexist->id) || $i > 0 )
						{
							$recordimport = ($totalrecords-1)-$dup-$countryexist;
							$this->session->set_flashdata("success",$recordimport." Records imported");
						}
						$this->session->set_flashdata("info",($totalrecords-1)." Total records");
						redirect('StateController/managelist');
				}
			}else{
				$this->session->set_flashdata("error","Please select csv file");	
				redirect('StateController/managelist');
			}
		}
	}



}
?>