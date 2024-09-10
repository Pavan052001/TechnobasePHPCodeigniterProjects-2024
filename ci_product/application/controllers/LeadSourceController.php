<?php
class LeadSourceController extends CI_Controller
{


    public function __construct()
    {

        parent::__construct();
        $this->load->model("LeadSource_model");
    }


    public function create()
    {


        $data = array(

            "name" => set_value("name", $this->input->post("name")),
            "description" => set_value("description", $this->input->post("description")),
            "status" => set_value("status", $this->input->post("status")),
        );

        $this->load->view("leadsource/createsource", $data);
    }

    public function create_action()
    {

        $this->form_validation->set_rules("name", "Lead-Source tittle", "required");
        $this->form_validation->set_rules("description", "Description", "required");
        $this->form_validation->set_rules("status", "status", "required");

        if ($this->form_validation->run() == false) {

            $this->create();
        } else {

            
           $sourceexixt= $this->LeadSource_model->getData("lead_sources","source_title","source_title='".$this->input->post('name', TRUE)."'","","","","");

           if(!empty($sourceexixt)){
               $this->session->set_flashdata('warning', 'Leads is already exist');
               redirect("LeadSourceController/create");

           }else{


            $data = array(
                "source_title" => ucfirst($this->input->post("name")),
                "description" => $this->input->post("description"),
                "status" => $this->input->post("status"),
            );

            $this->LeadSource_model->SaveData("lead_sources", $data);
            $this->session->set_flashdata("success", "Lead Source created successfully");
            redirect("LeadSourceController/managelist");
        }
    }
    }

    public function managelist()
    {
        $getlist = $this->LeadSource_model->GetData("lead_sources", "", "", "", "", "", "");

        $data = array(
            "getlist" => $getlist,
        );

        $this->load->view("leadsource/managelist", $data);


    }

    public function update($id)
    {

        $getleadbyid = $this->LeadSource_model->getdata("lead_sources", "", "id='" . $id . "'", "", "", "", "1");

        // print_r($getleadbyid); exit;

        $data = array(
            "id" => set_value("id", $getleadbyid->id),
            "name" => set_value("name", $getleadbyid->source_title),
            "description" => set_value("description", $getleadbyid->description),
            "status" => set_value("status", $getleadbyid->status),
        );
        $this->load->view("leadsource/update", $data);
    }

    public function update_action()
    {

        $id = $this->input->post("id");
        $this->form_validation->set_rules("name", "Lead-Source tittle", "required");
        $this->form_validation->set_rules("description", "Description", "required");
        $this->form_validation->set_rules("status", "status", "required");

        if ($this->form_validation->run() == false) {
            $this->update($id);
        } else {



            $sourceexixt= $this->LeadSource_model->getData("lead_sources","source_title","source_title='".$this->input->post('name', TRUE)."'","","","","");
            
 
            $data = array(
                "source_title" => ucfirst($this->input->post("name")),
                "description" => $this->input->post("description"),
                "status" => $this->input->post("status"),

            );

            $this->LeadSource_model->SaveData("lead_sources", $data, "id='" . $id . "'");
            $this->session->set_flashdata('success', 'Lead Source has been Updated successfully');

            redirect("LeadSourceController/managelist");

        }
    

    }

    public function delete($id)
    {

        $getsource = $this->LeadSource_model->getdata("lead_sources", "", "id ='" . $id . "'", "", "", "", "1");

        $checkmap = $this->LeadSource_model->getdata("leads", "", "source_id='" . $id . "'", "", "", "", "");

        if (!empty($checkmap)) {
            $this->session->set_flashdata('warning', 'Lead Source is mapped with leads');

            redirect("LeadSourceController/managelist");

        } else {

            $this->LeadSource_model->DeleteData("lead_sources", "id ='" . $getsource->id . "'");
            $this->session->set_flashdata('error', 'Lead Source deleted successfully');

            redirect("LeadSourceController/managelist");
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
						$getleadsource = $this->LeadSource_model->GetData("lead_sources","id","id='".$id[$i]."'","","","","");
						foreach($getleadsource as $getdata)
						{
							$getmapdata=$this->LeadSource_model->GetData("leads","id","source_id ='".$getdata->id."'","","","","");
							if(!empty($getmapdata))
							{
								$nondel++;
							}
							else
							{
								$this->LeadSource_model->DeleteData("lead_sources","id ='".$getdata->id."'");
								$del++; 
							}
						}
					}  
					$massage= $del." leadSource record has been deleted"."<br/>".$nondel." leadSource record not deleted";
					$this->session->set_flashdata('error',$massage);
                    redirect("LeadSourceController/managelist");
				}
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
                redirect("LeadSourceController/managelist");
			}
		}
	}

    public function export()
	{
		$id = $this->input->post('collectid');
        // print_r($id); exit;
		$this->LeadSource_model->ExportData("lead_sources","source_title,description,status,created",$id);
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
                            $duplication = $this->LeadSource_model->GetData("lead_sources", "source_title", "source_title='" . $Data[0] . "'");

                            if (!empty($duplication)) {
                                $dup++;
                            } else {
                                // Import data if no duplication
                                $this->LeadSource_model->ImportData($Data);
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
                    redirect("LeadSourceController/managelist");
                }
            } else {
                // Set error flashdata for no file selected
                $this->session->set_flashdata("error", "Please select a CSV file");
                redirect("LeadSourceController/managelist");
            }
        }
    }
}
?>