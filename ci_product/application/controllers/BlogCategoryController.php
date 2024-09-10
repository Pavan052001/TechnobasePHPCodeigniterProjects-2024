<?php
class BlogCategoryController extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model("BlogCategory_model");
    }

    public function getAllbogcat()
    {

        $allbogcat = $this->BlogCategory_model->GetData("blog_categories", "", "", "", "", "", "");

        $data = array(
            "allbogcat" => $allbogcat,

        );
        $this->load->view("bogCats/managelist", $data);


    }

    public function create()
    {

        $data = array(
            "name" => set_value("name", $this->input->post("name")),
            "description" => set_value("description", $this->input->post("description")),
            "status" => set_value("status", $this->input->post("status")),
        );

        $this->load->view("bogCats/createbogcat", $data);
    }

    public function create_action()
    {

        $this->form_validation->set_rules("name", "Tittle", "required");
        $this->form_validation->set_rules("description", "Description", "required");
        $this->form_validation->set_rules("status", "Status", "required");

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
                "title" => $this->input->post("name"),
                "description" => $this->input->post("description"),
                "status" => $this->input->post("status"),

            );

            $this->BlogCategory_model->SaveData("blog_categories", $data);
            $this->session->set_flashdata("success", "Blog category created successfully");
            redirect("BlogCategoryController/getAllbogcat");
        }
    }

    public function update($id)
    {

        $getblogcat = $this->BlogCategory_model->getdata("blog_categories", "", "id='" . $id . "'", "", "", "", "1");
        $data = array(
            'id' => set_value("id", $getblogcat->id),
            'name' => set_value("name", $getblogcat->title),
            'description' => set_value("description", $getblogcat->description),
            'status' => set_value("status", $getblogcat->status),
        );

        $this->load->view("bogCats/update", $data);

    }

    public function update_action()
    {
        $id = $this->input->post("id");

        $this->form_validation->set_rules("name", "Tittle", "required");
        $this->form_validation->set_rules("description", "Description", "required");
        $this->form_validation->set_rules("status", "Status", "required");

        if ($this->form_validation->run() == false) {
            $this->update($id);

        } else {

            $data = array(

                'title' => $this->input->post("name"),
                'description' => $this->input->post("description"),
                'status' => $this->input->post("status"),
            );

            $this->BlogCategory_model->savedata("blog_categories", $data, "id='" . $id . "'");
            $this->session->set_flashdata("success", "Blog category Updated successfully");
            redirect("BlogCategoryController/getAllbogcat");

        }


    }

    public function delete($id)
    {

        $getcat = $this->BlogCategory_model->getData("blog_categories", "", "id='" . $id . "'", "", "", "", "1");

        $checkmap = $this->BlogCategory_model->getData("blogs", "", "blog_cat_id='" . $getcat->id . "'", "", "", "", "1");

        if (!empty($checkmap)) {

            $this->session->set_flashdata("warning", "Blog category is mapped ");
            redirect("BlogCategoryController/getAllbogcat");

        } else {

            $this->BlogCategory_model->delete("blog_categories", "id='" . $getcat->id . "'");
            $this->session->set_flashdata("error", "Blog category deleted successfully ");
            redirect("BlogCategoryController/getAllbogcat");


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
						$getblogscat = $this->BlogCategory_model->GetData("blog_categories","id","id='".$id[$i]."'","","","","");
						foreach($getblogscat as $getdata)
						{
                            $checkmap = $this->BlogCategory_model->GetData("blogs","","blog_cat_id='".$getdata->id."'","","","","");
							
							if(!empty($checkmap))
							{
								$nondel++;
							}
							else
							{
								$this->BlogCategory_model->Delete("blog_categories","id ='".$getdata->id."'");
								$del++; 
							}
						}
					}  
					$massage= $del." blog category record has been deleted"."<br/>".$nondel."  blog category record not deleted";
					$this->session->set_flashdata('error',$massage);
                    redirect("BlogCategoryController/getAllbogcat");
				}
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
                redirect("BlogCategoryController/getAllbogcat");
			}
		}
	}

    public function export()
	{
		$id = $this->input->post('blogcategoryid');
        // print_r($id); exit;
		$this->BlogCategory_model->ExportData("blog_categories","title,description,status,created",$id);
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
                    foreach ($importData_arr as $Data) {
                        // Skip the first row (headers)
                        if ($skip != 0) {
                            // Check for duplicates
                            $duplication = $this->BlogCategory_model->GetData("blog_categories", "title,description", "title='" . $Data[0] . "'  and description='".$Data[1]."'");

                            if (!empty($duplication)) {
                                $dup++;
                            } else {
                                // Import data if no duplication
                                $this->BlogCategory_model->ImportData($Data);
                            }
                        }
                        $skip++;
                    }

                    // Calculate and set flashdata for records
                    $totalrecords = count(file("assets/files/" . $filename));
                    $this->session->set_flashdata("warning", $dup . " duplicate Blog category record found");
                    $recordimport = ($totalrecords - 1) - $dup;


                    $this->session->set_flashdata("success", $recordimport . " Records imported");
                    $this->session->set_flashdata("info", ($totalrecords - 1) . " Total records");

                   
                    redirect('BlogCategoryController/getAllbogcat');
                }
            } else {
                // Set error flashdata for no file selected
                $this->session->set_flashdata("error", "Please select a CSV file");
                redirect('BlogCategoryController/getAllbogcat');
            }
        }
    }

}
?>