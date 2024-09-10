<?php

class LeadStageController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model("LeadStage_model");
    }

    public function manageLeads()
    {

        $getList = $this->LeadStage_model->getdata("lead_stage", "", "", "", "", "", "");
        // print_r($getList); exit;

        $data = array(
            "getlist" => $getList,
        );

        $this->load->view("leadstage/managelist", $data);
    }


    public function create()
    {

        $data = array(

            "name" => set_value("name", $this->input->post("name")),
            "description" => set_value("description", $this->input->post("description")),
            "status" => set_value("status", $this->input->post("status")),
        );

        $this->load->view("leadstage/createleads", $data);

    }

    public function create_action()
    {

        $this->form_validation->set_rules("name", "Lead-stage tittle", "required");
        $this->form_validation->set_rules("description", "Description", "required");
        $this->form_validation->set_rules("status", "status", "required");

        if ($this->form_validation->run() == false) {

            $this->create();
        } else {

            $sourceexixt= $this->LeadStage_model->getData("lead_stage","s_title","s_title='".$this->input->post('name', TRUE)."'","","","","");
           
            if(!empty($sourceexixt)){
                $this->session->set_flashdata('warning', 'Leads is already exist');
                redirect("LeadtageController/create");
 
            }else{

            $data = array(
                "s_title" => $this->input->post("name"),
                "description" => $this->input->post("description"),
                "status" => $this->input->post("status"),
            );

            $this->LeadStage_model->SaveData("lead_stage", $data);
            $this->session->set_flashdata('success', 'Lead stage has been created successfully');

            redirect("LeadStageController/manageLeads");

        }
    }
    }

    public function update($id)
    {

        $getleadbyid = $this->LeadStage_model->getdata("lead_stage", "", "id='" . $id . "'", "", "", "", "1");

        // print_r($getleadbyid); exit;

        $data = array(
            "id" => set_value("id", $getleadbyid->id),
            "name" => set_value("name", $getleadbyid->s_title),
            "description" => set_value("description", $getleadbyid->description),
            "status" => set_value("status", $getleadbyid->status),
        );
        $this->load->view("leadstage/update", $data);
    }

    public function update_action()
    {

        $id = $this->input->post("id");
        $this->form_validation->set_rules("name", "Lead-stage tittle", "required");
        $this->form_validation->set_rules("description", "Description", "required");
        $this->form_validation->set_rules("status", "status", "required");

        if ($this->form_validation->run() == false) {
            $this->update($id);
        } else {


            $sourceexixt= $this->LeadStage_model->getData("lead_stage","s_title","s_title='".$this->input->post('name', TRUE)."'","","","","");
           

            $data = array(
                "s_title" => $this->input->post("name"),
                "description" => $this->input->post("description"),
                "status" => $this->input->post("status"),

            );

            $this->LeadStage_model->SaveData("lead_stage", $data, "id='" . $id . "'");
            $this->session->set_flashdata('success', 'Lead stage has been Updated successfully');

            redirect("LeadStageController/manageLeads");

        }
    

    }

    public function delete($id)
    {

        $getstage = $this->LeadStage_model->getdata("lead_stage", "", "id ='" . $id . "'", "", "", "", "1");

        $checkmap = $this->LeadStage_model->getdata("leads", "", "source_id='" . $id . "'", "", "", "", "");

        if (!empty($checkmap)) {
            $this->session->set_flashdata('warning', 'Lead stage is mapped with leads');

            redirect("LeadSourceController/managelist");

        } else {

            $this->LeadStage_model->DeleteData("lead_stage", "id ='" . $getstage->id . "'");
            $this->session->set_flashdata('error', 'Lead stage deleted successfully');

            redirect("LeadStageController/manageLeads");
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
						$getleadstage = $this->LeadStage_model->GetData("lead_stage","id","id='".$id[$i]."'","","","","");
						foreach($getleadstage as $getdata)
						{
							$getmapdata=$this->LeadStage_model->GetData("leads","id","stage_id ='".$getdata->id."'","","","","");
							if(!empty($getmapdata))
							{
								$nondel++;
							}
							else
							{
								$this->LeadStage_model->DeleteData("lead_stage","id ='".$getdata->id."'");
								$del++; 
							}
						}
					}  
					$massage= $del." leadStage record has been deleted"."<br/>".$nondel." leadStage record not deleted";
					$this->session->set_flashdata('error',$massage);
                    redirect("LeadStageController/manageLeads");
				}
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
                redirect("LeadStageController/manageLeads");
			}
		}
	}

    public function export()
	{
		$id = $this->input->post('collectid');
        // print_r($id); exit;
		$this->LeadStage_model->ExportData("lead_stage","s_title,description,status,created",$id);
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
                    redirect("LeadStageController/manageLeads");
                } else {
                    // File successfully uploaded
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];

                    // Open the uploaded CSV file
                    $file = fopen("assets/files/" . $filename, "r");
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
                   ////  print_r($importData_arr);
                   //  exit();
                    fclose($file);

                    $skip = 0;
                    // Insert import data into the database
                    foreach ($importData_arr as $Data) {
                        // Skip the first row (headers)
                        if ($skip != 0) {
                            // Check for duplicates
                            $duplication = $this->LeadStage_model->GetData("lead_stage", "s_title", "s_title='" . $Data[0] . "'");

                            if (!empty($duplication)) {
                                $dup++;
                            } else {
                                // Import data if no duplication
                                $this->LeadStage_model->ImportData($Data);
                            }
                        }
                        $skip++;
                    }

                    // Calculate and set flashdata for records
                    $totalrecords = count(file("assets/files/" . $filename));
                    $this->session->set_flashdata("warning", $dup . " duplicate lead source record found");
                    $recordimport = ($totalrecords - 1) - $dup;


                    $this->session->set_flashdata("success", $recordimport . " Records imported");
                    $this->session->set_flashdata("info", ($totalrecords - 1) . " Total records");

                    // Redirect to hobby list
                    redirect("LeadStageController/manageLeads");
                }
            } else {
                // Set error flashdata for no file selected
                $this->session->set_flashdata("error", "Please select a CSV file");
                redirect("LeadStageController/manageLeads");
            }
        }
    }
}
?>