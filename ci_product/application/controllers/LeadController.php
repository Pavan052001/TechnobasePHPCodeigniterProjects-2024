<?php

class LeadController extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model("Leads_model");
        $this->load->library("form_validation");
    }


    public function create()
    {

        $getAllstage = $this->Leads_model->getData("lead_stage", "", "", "", "", "", "");
        $getAllsource = $this->Leads_model->getData("lead_sources", "", "", "", "", "", "");

        // print_r($getAllsource); exit;

        $data = array(
            'getAllsource' => $getAllsource,
            'getAllstage' => $getAllstage,
            'source_id' => set_value('source_id', $this->input->post('source_id')),
            'stage_id' => set_value('stage_id', $this->input->post('stage_id')),
            'name' => set_value('name', $this->input->post('name')),
            'email' => set_value('email', $this->input->post('email')),
            'number' => set_value('number', $this->input->post('number')),
            'status' => set_value('status', $this->input->post('status')),

        );

        $this->load->view("leads/createlead", $data);

    }

    public function create_action()
    {

        $this->form_validation->set_rules("name", "Lead name", "required");
        $this->form_validation->set_rules("email", "Email", "required");
        $this->form_validation->set_rules("number", "Mobile", "required");
        $this->form_validation->set_rules("status", "Status", "required");
        $this->form_validation->set_rules("source_id", "Lead Source", "required");
        $this->form_validation->set_rules("stage_id", "Lead Stage", "required");

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {

           $leadsexixt= $this->Leads_model->getData("leads","name","name='".$this->input->post('name', TRUE)."'","","","","");
            if(!empty($leadsexixt)){
                $this->session->set_flashdata('warning', 'Leads is already exist');
                redirect("LeadController/create");

            }else{

            $data = array(
                "source_id" => $this->input->post("source_id"),
                "stage_id" => $this->input->post("stage_id"),
                "name" => $this->input->post("name"),
                "email" => $this->input->post("email"),
                "phone" => $this->input->post("number"),
                "status" => $this->input->post("status"),
            );

            $this->Leads_model->savedata("leads", $data);
            $this->session->set_flashdata("success", "Lead has been created sucessfully");
            redirect("LeadController/getAlleads");
        }
    
    }
    }

    public function getAlleads()
    {

        $getalleads = $this->Leads_model->getlist(
            "leads",
            "leads.name,leads.status,leads.id,leads.phone,leads.email,lead_sources.source_title,lead_stage.s_title"
        );

        // print_r($getallleads); exit;

        $data = array(
            "getalleads" => $getalleads,
        );

        $this->load->view("leads/manageleads", $data);
    }

    public function update($id)
    {
        $getAllstage = $this->Leads_model->getData("lead_stage", "", "", "", "", "", "");
        $getAllsource = $this->Leads_model->getData("lead_sources", "", "", "", "", "", "");

        $getsinglelead = $this->Leads_model->getData("leads", "", "id= '" . $id . "'", "", "", "", "1");

        // print_r($getsinglelead); exit;

        $data = array(
            'getAllsource' => $getAllsource,
            'getAllstage' => $getAllstage,
            'source_id' => set_value('source_id', $getsinglelead->source_id),
            'stage_id' => set_value('stage_id', $getsinglelead->stage_id),
            "id" => set_value("id", $getsinglelead->id),
            'name' => set_value('name', $getsinglelead->name),
            'email' => set_value('email', $getsinglelead->email),
            'number' => set_value('number', $getsinglelead->phone),
            'status' => set_value('status', $getsinglelead->status),

        );

        $this->load->view("leads/update", $data);

    }

    public function update_action()
    {
        $id = $this->input->post('id');

        // print_r($id); exit;

        $this->form_validation->set_rules("name", "Lead name", "required");
        $this->form_validation->set_rules("email", "Email", "required");
        $this->form_validation->set_rules("number", "Mobile", "required");
        $this->form_validation->set_rules("status", "Status", "required");
        $this->form_validation->set_rules("source_id", "Lead Source", "required");
        $this->form_validation->set_rules("stage_id", "Lead Stage", "required");

        if ($this->form_validation->run() == false) {
            $this->update($id);
        } else {

            
           $leadsexixt= $this->Leads_model->getData("leads","name","name='".$this->input->post('name', TRUE)."'","","","","");
          


            $data = array(
                "stage_id" => $this->input->post("stage_id"),
                "source_id" => $this->input->post("source_id"),
                "name" => $this->input->post("name"),
                "email" => $this->input->post("email"),
                "phone" => $this->input->post("number"),
                "status" => $this->input->post("status"),
            );

            $this->Leads_model->saveData("leads", $data, "id='" . $id . "'");
            $this->session->set_flashdata("success", "Lead has been updated sucessfully");
            redirect("LeadController/getAlleads");
        }
    
    }

    public function delete($id)
    {

        $getdata = $this->Leads_model->getData("leads", "id", "id='" . $id . "'", "", "", "", "1");

        if (empty($getdata)) {

            $this->session->set_flashdata("warning", "unable to delete");
            redirect("LeadController/getAlleads");
        } else {
            $this->Leads_model->DeleteData("leads", "id= $getdata->id");
            $this->session->set_flashdata("error", "lead deleted successfully");
            redirect("LeadController/getAlleads");
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
						$getleads = $this->Leads_model->GetData("leads","id","id='".$id[$i]."'","","","","");
						foreach($getleads as $getleadsdata)
						{
							
							if(empty($getleadsdata))
							{
								$nondel++;
							}
							else
							{
								$this->Leads_model->DeleteData("leads","id ='".$getleadsdata->id."'");
								$del++; 
							}
						}
					}  
					$massage= $del." City record has been deleted"."<br/>".$nondel." City record not deleted";
					$this->session->set_flashdata('error',$massage);
                    redirect("LeadController/getAlleads");
				}
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
                redirect("LeadController/getAlleads");
			}
		}
	}

    public function export()
	{
		$id = $this->input->post('collectid');
        // print_r($id); exit;
		$this->Leads_model->ExportData("leads","source_title,s_title,name,email,phone,status,created",$id);
	}

    // public function import()
	// {
	// 	//if form submit or not
	// 	if($this->input->post('upload') != NULL){
	// 		//$data = array();
	// 		if($_FILES['file']['name']){
	// 			$config['upload_path'] = 'assets/files';
	// 			$config['allowed_types'] = 'csv';
	// 			$config['max_size'] = '1000';
	// 			$config['file_name'] = $_FILES['file']['name'];
	// 			$this->load->library('upload', $config);
	// 			$this->upload->initialize($config);
	// 			// print_r($this->upload->do_upload('file')); exit();
    //             if (!$this->upload->do_upload('file')){
	// 				redirect("LeadController/getAlleads");
					
	// 			}else{
	// 				$uploadData = $this->upload->data();
	// 				$filename = $uploadData['file_name'];
					
	// 				$file = fopen("assets/files/".$filename,"r");
	// 				$i = 0;

    //                 // print_r($file); exit;
	// 				$numberOfFields = 5; // total number of fields
	// 				$importData_arr = array();
    //                 while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
    //                     $num = count($filedata);
                      
    //                     if ($numberOfFields == $num) {
    //                         $importData_arr[$i] = $filedata;
    //                     }
    //                     $i++;

                    
    //                 }
    //                 //    print_r($importData_arr);
    //                 //    exit();
    //                 fclose($file);
	// 				$skip = 0; $dup = 0; $stagexist = 0 ; $sourcexist=0;
	// 				//insert import data
	// 				//print_r($importData_arr); exit();
	// 				foreach($importData_arr as $Data){	
	// 					//skip first row
	// 					if($skip != 0){
	// 						$checkexist = $this->Leads_model->GetData("lead_sources","id,source_title","id = '".$Data[0]."'","","","","");


    //                         $checkstageexist = $this->Leads_model->GetData("lead_stage","id,s_title","id = '".$Data[1]."'","","","","");
							
	// 						if(empty($checkexist) && empty($checkstageexist))
	// 						{
	// 							$stagexist++;

    //                             $sourcexist++;
	// 						}
	// 						else
	// 						{
	// 							$duplication = $this->Leads_model->Getallleads("leads","leads.name","leads.name='".$Data[2]."' and lead_sources.source_title='".$Data[0]."' and lead_stage.s_title='".$Data[1]."'");
	// 							if(!empty($duplication))
	// 							{
	// 								$dup++;
	// 							}
	// 							else
	// 							{
	// 								// foreach($checkexist as $exists)
	// 								// {							
	// 									$Data[0] = $checkexist->id;
    //                                     $Data[1]=$checkstageexist->id;
	// 								// }
	// 								//print_r($stateData); exit();
	// 								$this->Leads_model->ImportData($Data);									
	// 							}
	// 						}
	// 					}
	// 					$skip++;
	// 					}
	// 					$totalrecords = count(file("assets/files/".$filename));
	// 					$this->session->set_flashdata("warning",$dup." Duplicate states record found");
	// 					if(!empty($exist))
	// 					{	
	// 						$this->session->set_flashdata("error",$stagexist." Country not found");
	// 					}
	// 					if(!empty($checkexist->id) || $i > 0 )
	// 					{
	// 						$recordimport = ($totalrecords-1)-$dup-$stagexist;
	// 						$this->session->set_flashdata("success",$recordimport." Records imported");
	// 					}
	// 					$this->session->set_flashdata("info",($totalrecords-1)." Total records");
	// 					redirect("LeadController/getAlleads");
	// 			}
	// 		}else{
	// 			$this->session->set_flashdata("error","Please select csv file");	
	// 			redirect("LeadController/getAlleads");
	// 		}
	// 	}
	// }

    public function import()
    {
        if ($this->input->post('upload') != NULL) {
            if ($_FILES['file']['name']) {
                $config['upload_path'] = 'assets/files';
                $config['allowed_types'] = 'csv';
                $config['max_size'] = '1000'; // size in KB
                $config['file_name'] = $_FILES['file']['name'];
    
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
    
                if (!$this->upload->do_upload('file')) {
                    $this->session->set_flashdata("error", "File upload failed. Please try again.");
                    redirect("LeadController/getAlleads");
                } else {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $file = fopen("assets/files/" . $filename, "r");
                    if ($file === FALSE) {
                        $this->session->set_flashdata("error", "Failed to open the uploaded file.");
                        redirect("LeadController/getAlleads");
                    }
    
                    $i = 0;
                    $numberOfFields = 5; // total number of fields
                    $importData_arr = array();
    
                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);
                        if ($num == $numberOfFields) {
                            $importData_arr[] = $filedata;
                        }
                    }
                    // print_r($importData_arr); exit;
                    fclose($file);
    
                    $skip = 0;
                    $dup = 0;
                    $stagexist = 0;
                    $sourcexist = 0;
    
                    foreach ($importData_arr as $Data) {

                        if ($skip != 0) {
                            // Retrieve source and stage IDs
                            $checkexist = $this->Leads_model->GetData("lead_sources", "id, source_title", "source_title = '" . $Data[0] . "'","","","","1");

                            $checkstageexist = $this->Leads_model->GetData("lead_stage", "id, s_title", "s_title = '" . $Data[1] . "'","","","","1");
    
                            if (empty($checkexist) || empty($checkstageexist)) {
                                $sourcexist ++;
                                $stagexist ++;
                            } else {
                                // Ensure IDs are mapped correctly
                                $Data[0] = $checkexist->id; // or $checkexist->id if it's an object
                                $Data[1] = $checkstageexist->id; // or $checkstageexist->id if it's an object
    
                                // Check for duplicate records
                                $duplication = $this->Leads_model->Getallleads(
                                    "leads",
                                    "leads.name",
                                    "leads.name='" . $Data[2] . "' AND lead_sources.source_title='" . $Data[0] . "' AND lead_stage.s_title='" . $Data[1] . "'"
                                );
    
                                if (!empty($duplication)) {
                                    $dup++;
                                } else {
                                    // Insert the record into the database
                                    $this->Leads_model->ImportData($Data);
                                }
                            }
                        }
                        $skip++;
                    }
    
                    $totalrecords = count(file("assets/files/" . $filename)) - 1; // Subtract 1 for header row
                    $this->session->set_flashdata("info", "$totalrecords Total records processed.");
    
                    if ($dup > 0) {
                        $this->session->set_flashdata("warning", "$dup Duplicate records found.");
                    }
    
                    if ($stagexist > 0 || $sourcexist > 0) {
                        $this->session->set_flashdata("error", "$stagexist Stages and $sourcexist Sources not found.");
                    }
    
                    $recordimport = $totalrecords - $dup - $stagexist;
                    if ($recordimport > 0) {
                        $this->session->set_flashdata("success", "$recordimport Records successfully imported.");
                    }
    
                    redirect("LeadController/getAlleads");
                }
            } else {
                $this->session->set_flashdata("error", "Please select a CSV file to upload.");
                redirect("LeadController/getAlleads");
            }
        }
    }
    



}



?>