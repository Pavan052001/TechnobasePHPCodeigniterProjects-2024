<?php
class BlogsController extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model("Blogs_model");
        $this->load->library("form_validation");

    }

    public function create()
    {

        $getblogcat = $this->Blogs_model->GetData("blog_categories", "", "", "", "", "", "");

        $data = array(
            "getblogcat" => $getblogcat,
            "blogcat_id" => set_value("blogcat_id", $this->input->post("blogcat_id")),
            "name" => set_value("name", $this->input->post("name")),
            "content" => set_value("content", $this->input->post("content")),
            "status" => set_value("name", $this->input->post("status")),
        );

        $this->load->view("blogs/createblog", $data);
    }

    public function create_action()
    {

        $this->form_validation->set_rules("blogcat_id", "select Blog-category", "required");
        $this->form_validation->set_rules("name", "Blog Title", "required");
        $this->form_validation->set_rules("content", "Content", "required");
        $this->form_validation->set_rules("status", "Status", "required");

        if ($this->form_validation->run() == false) {
            $this->create();

        } else {

            if ($_FILES['image']['error'] == 0) {

                $config['upload_path'] = './uploads/blogsimage';
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
            }

            $data = array(
                "blog_title" => $this->input->post("name"),
                "content" => $this->input->post("content"),
                "blog_cat_id" => $this->input->post("blogcat_id"),
                "image" => $image,
                "status" => $this->input->post("status"),
            );

            $this->Blogs_model->SaveData("blogs", $data);
            $this->session->set_flashdata("success", "blog created successfully");
            redirect("BlogsController/getalldata");

        }
    }

    public function getalldata()
    {
        $alldata = $this->Blogs_model->getlist("blogs", "blogs.id,blogs.blog_title,blogs.content,blogs.image,blogs.status,blog_categories.title");

        //   print_r($alldata); exit;

        $data = array(
            'alldata' => $alldata,
        );
        $this->load->view("blogs/manageblogs", $data);

    }

    public function update($id)
    {

        $getblogcat = $this->Blogs_model->GetData("blog_categories", "", "", "", "", "", "");

        $getblog = $this->Blogs_model->GetData("blogs", "", "id='" . $id . "'", "", "", "", "1");

        $data = array(
            "getblogcat" => $getblogcat,
            "blogcat_id" => set_value("blogcat_id", $getblog->blog_cat_id),
            "id" => set_value("id", $getblog->id),
            "name" => set_value("name", $getblog->blog_title),
            "content" => set_value("content", $getblog->content),
            "image" => set_value("image", $getblog->image),
            "status" => set_value("status", $getblog->status),
        );

        $this->load->view("blogs/update", $data);

    }

    public function update_action()
    {

        $id = $this->input->post("id");

        // print_r($id);exit;

        $this->form_validation->set_rules("blogcat_id", "select Blog-category", "required");
        $this->form_validation->set_rules("name", "Blog Title", "required");
        $this->form_validation->set_rules("content", "Content", "required");
        $this->form_validation->set_rules("status", "Status", "required");

        if ($this->form_validation->run() == false) {
            $this->update($id);
        } else {

            $oldblogimage = $this->Blogs_model->GetData("blogs", "", "id ='" . $id . "'", "", "", "", "1");

            $oldimage = $oldblogimage->image;

            // print_r($oldimage); exit ;


            if ($_FILES['image']['error'] == 0) {


                $config['upload_path'] = './uploads/blogsimage';
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

                    if (file_exists('./uploads/blogsimage/' . $oldimage)) {
                        unlink('./uploads/blogsimage/' . $oldimage);
                    }
                    $data = array('upload' => $this->upload->data());

                    $image = $data['upload']['file_name'];
                }
            } else {
                $image = $oldimage;

            }

            $data = array(

                "blog_title" => $this->input->post("name"),
                "content" => $this->input->post("content"),
                "blog_cat_id" => $this->input->post("blogcat_id"),
                "image" => $image,
                "status" => $this->input->post("status"),

            );

            $this->Blogs_model->savedata("blogs", $data, "id='" . $id . "'");
            $this->session->set_flashdata("success", "blog update successfully");
            redirect("BlogsController/getalldata");
        }


    }

    public function delete($id)
    {

        $getdata = $this->Blogs_model->getdata("blogs", "", "id='" . $id . "'", "", "", "", "1");

        $image = $getdata->image;

        if (empty($getdata)) {
            $this->session->set_flashdata("warning", "unable to delete blog");
            redirect("BlogsController/getalldata");

        } else {
            if (!empty($image)) {
                unlink("uploads/blogsimage/" . $image);
                $this->Blogs_model->delete("blogs", "id='" . $getdata->id . "'");
                $this->session->set_flashdata("success", "blog deleted successfully");
                redirect("BlogsController/getalldata");

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
						$getblogs = $this->Blogs_model->GetData("blogs","id,image","id='".$id[$i]."'","","","","");
                        $image =$getblogs->image;
						foreach($getblogs as $getdata)
						{
							
							if(empty($getdata))
							{
								$nondel++;
							}
							else
							{
								$this->Blogs_model->delete("blogs","id ='".$getdata->id."'");

                                unlink("uploads/blogsimage/" . $image);
								$del++; 
							}
						}
					}  
					$massage= $del." leadSource record has been deleted"."<br/>".$nondel." leadSource record not deleted";
					$this->session->set_flashdata('error',$massage);
                    redirect("BlogsController/getalldata");
				}
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
                redirect("BlogsController/getalldata");
			}
		}
	}

    public function export()
	{
		$id = $this->input->post('blogid');
        // print_r($id); exit;
		$this->Blogs_model->ExportData("blogs","blog_title,title,,content,status,created",$id);
	}


    public function import()
    {
        if ($this->input->post('upload') != NULL) {
            if ($_FILES['file']['name']) {
                $config['upload_path'] = 'assets/files';
                $config['allowed_types'] = 'csv';
                $config['max_size'] = '1000';
                $config['file_name'] = $_FILES['file']['name'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
    
                if (!$this->upload->do_upload('file')) {
                    $this->session->set_flashdata("error", "File not uploaded");
                    redirect('StateController/managelist');
                } else {
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $file = fopen("assets/files/" . $filename, "r");
                    $i = 0;
                    $numberOfFields = 3; // total number of fields
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
                    $skip = 0;
                    $dup = 0;
                    $exist = 0;
    
                    foreach ($importData_arr as $Data) {
                        if ($skip != 0) {
                            $checkexist = $this->Blogs_model->GetData("blog_categories", "id,title", "title = '" . $Data[0] . "'", "", "", "", "");
                            // print_r($checkexist); exit;
                            if (empty($checkexist)) {
                                $exist++;
                            } else {
                                $duplication = $this->Blogs_model->GetproductexportData("blogs", "blogs.blog_title ,blogs.content", "blogs.blog_title='" . $Data[1] . "' and blog_categories.title='" . $Data[0] . "'");
                                if (!empty($duplication)) {
                                    $dup++;
                                } else {
                                    foreach ($checkexist as $exist) {
                                        $Data[0] = $exist->id;
                                    }
                                    $this->Blogs_model->ImportData($Data);
                                }
                            }
                        }
                        $skip++;
                    }
    
                    $totalrecords = count(file("assets/files/" . $filename));
                    $this->session->set_flashdata("warning", $dup . " Duplicate record found");
                    if (!empty($exist)) {
                        $this->session->set_flashdata("error", $exist . " blog not found");
                    }
                    if (!empty($checkcountryexist->id) || $i > 0) {
                        $recordimport = ($totalrecords - 1) - $dup - $exist;
                        $this->session->set_flashdata("success", $recordimport . " Records imported");
                    }
                    $this->session->set_flashdata("info", ($totalrecords - 1) . " Total records");
                    redirect("BlogsController/getalldata");
                }
            } else {
                $this->session->set_flashdata("error", "Please select csv file");
                redirect("BlogsController/getalldata");
            }
        }
    }

}

?>