<?php

class UserController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');

    }


    public function index()
    {
        $this->load->view("dashboard");
    }

    public function userprofile()
    {

         $userdata = $this->User_model->Getdata("users", "", "id='" . $_SESSION["id"] . "'", "", "", "", "1");

        $data = array(
            "id" => $userdata->id,
            "name" => $userdata->name,
            "email" => $userdata->email,
            "number" => $userdata->number,
            "dob" => $userdata->dob,
            "image" => $userdata->image,
            "gender" => $userdata->gender
        );
        //print_r($data); exit;

        $this->load->view("user/userprofile", $data);
    }


    public function userprofile_update()
    {

        // $this->input->post("id");

        $id = $_SESSION["id"];
        $this->form_validation->set_rules('name', 'Name', 'required');

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');
        $this->form_validation->set_rules('date', 'Date of birth', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("user/userprofile");

        } else {

            $getprofilephoto = $this->User_model->getData("users", "", "id ='" . $id . "'", "", "", "", "1");

            $oldimage = $getprofilephoto->image;

            if ($_FILES['image']['error'] == 0) {



                $config['upload_path'] = './uploads/userimage';
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
            $name = $this->input->post("name");
            $updateprofile = array(

                "name" => $this->input->post("name"),
                "email" => $this->input->post("email"),
                "dob" => $this->input->post("date"),
                "gender" => $this->input->post("gender"),
                "image" => $image,
            );
            // print_r($updateprofile); exit;
            $this->session->set_userdata('name', $name);

            $this->User_model->saveData("users", $updateprofile, "id='" . $id . "'");
            $this->session->set_flashdata('success', 'profile updated successfully');
            redirect("UserController/index");
        }

    }


    public function changePassword()
    {

        $this->load->view("user/changpassword");
    }

    public function changePassword_action()
    {

        $id = $_SESSION["id"];


        $this->form_validation->set_rules("oldpass", "Old Password", "required");
        $this->form_validation->set_rules("newpass", "New Password", "required");
        $this->form_validation->set_rules("conpass", "Repeat Password", "required");

        if ($this->form_validation->run() == false) {
            $this->load->view("user/changpassword");

        } else {
            $oldpass = $this->input->post("oldpass");
            $newpass = $this->input->post("newpass");
            $conpass = $this->input->post("conpass");
            $getpass = $this->User_model->getData("users", "", "id ='" . $id . "'", "", "", "", "1");

            if ($getpass->password != $oldpass) {
                $this->session->set_flashdata('error', 'old passowrd is not matched !!');
                $this->load->view("user/changpassword");
            } else {

                if ($newpass === $conpass) {

                    $password = array(
                        "password" => $newpass,
                    );
                    $this->User_model->savedata("users", $password, "id='" . $id . "'");
                    $this->session->set_flashdata('success', 'Password Changed successfully');
                    redirect("UserController/index");

                } else {
                    $this->session->set_flashdata('error', 'Password and confirm password are not same');
                    $this->load->view("user/changpassword");

                }

            }

        }
    }


    public function userList()
    {

        $allusers = $this->User_model->GetData("users", "", "role='User'", "", "", "", "");
        //    print_r($allusers); exit;

        $data = array(
            "allusers" => $allusers,
        );
        //    print_r($data); exit;

        $this->load->view("user/manageuser", $data);

    }

    public function create()
    {
        $allhobbies = $this->User_model->GetData("hobbies", "id,hobby_title", "status='Active'", "hobby_title", "", "");

        $data = array(
            'allhobbies' => $allhobbies,
            'hobby_id' => set_value('hobby_id', $this->input->post('hobby_id', TRUE)),
        );
        $this->load->view("user/createuser", $data);
    }

// my create
    // public function create_action()
    // {

    //     $this->form_validation->set_rules('name', 'Name', 'required');
    //     $this->form_validation->set_rules('hobby_id', 'hobbies', 'required');
    //     $this->form_validation->set_rules('email', 'Email', 'required');
    //     $this->form_validation->set_rules('number', 'Mobile', 'required');
    //     $this->form_validation->set_rules('gender', 'gender', 'required');
    //     $this->form_validation->set_rules('date', 'Date of birth', 'required');
    //     $this->form_validation->set_rules('status', 'Status', 'required');
    //     $this->form_validation->set_rules('hobby_id', 'hobbies', 'required');
    //     $this->form_validation->set_rules('image', 'profile', 'required');


    //     //  print_r($allhobbies); exit;
    //     if ($this->form_validation->run() == false) {

    //         if ($_FILES['image']['error'] == 0) {


    //             $config['upload_path'] = './uploads/userimage';
    //             $config['allowed_types'] = 'jpg|png';
    //             $config['max_size'] = 2048; // 2MB
    //             $config['max_width'] = 160000;
    //             $config['max_height'] = 120000;

    //             $this->load->library('upload', $config);
    //             $this->upload->initialize($config);

    //             if (!$this->upload->do_upload('image')) {
    //                 $error = array('error' => $this->upload->display_errors());

    //                 $this->load->view('register', $error);
    //                 $this->session->set_flashdata('error', 'Unable to upload Image ');
    //             } else {
    //                 $data = array('upload' => $this->upload->data());

    //                 $image = $data['upload']['file_name'];
    //                 // print_r($image); exit;

    //             }
    //         }

    //         // $hobbies = $this->input->post('hobby[]');

    //         $insertdata = array(

    //             "id" => md5('Users-token' . time() . rand(1000, 9999)),
    //             "name" => $this->input->post('name'),
    //             "email" => $this->input->post('email'),
    //             "password" => $this->input->post('password'),
    //             "number" => $this->input->post('mobile'),
    //             "dob" => $this->input->post('date'),
    //             "address" => $this->input->post('address'),
    //             "image" => $image,
    //             "gender" => $this->input->post('gender'),
    //         //    "hobby" => implode(", ", $this->input->post('hobby_id', TRUE)),
    //             "created" => date("Y-m-d h:i:s"),
    //         );
    //         //  print_r($insertdata); exit;



    //         $this->User_model->saveData("users", $insertdata);
    //         $this->session->set_flashdata('success', 'User created successfully');
    //         redirect(site_url('UserController/userlist'));
    //     } else {
    //         $this->session->set_flashdata('error', 'unable to create user successfully');
    //         redirect(site_url('UserController/create'));

    //     }
    // }


    public function create_action()
{
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('hobby_id[]', 'Hobbies', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('mobile', 'Mobile', 'required');
    $this->form_validation->set_rules('gender', 'Gender', 'required');
    $this->form_validation->set_rules('date', 'Date of birth', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    // $this->form_validation->set_rules('image', 'Upload Profile', 'required');
    $this->form_validation->set_rules('status', 'Status', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('error', 'Please fill in all required fields');
        $this->create();  // Assuming create() function loads the form view
    } else {
        if ($_FILES['image']['error'] == 0) {
            $config['upload_path'] = './uploads/userimage';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2048; // 2MB
            $config['max_width'] = 160000;
            $config['max_height'] = 120000;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect(site_url('UserController/create'));
            } else {
                $data = array('upload' => $this->upload->data());
                $image = $data['upload']['file_name'];
            }
        } else {
            $image = ''; // Handle cases where the image is not uploaded
        }

        $insertdata = array(
            "token" => md5('Users-token' . time() . rand(1000, 9999)),
            "name" => $this->input->post('name'),
            "email" => $this->input->post('email'),
            "password" => $this->input->post('password'),
            "number" => $this->input->post('mobile'),
            "dob" => $this->input->post('date'),
            "address" => $this->input->post('address'),
            "image" => $image,
            "gender" => $this->input->post('gender'),
            "hobby" => implode(", ", $this->input->post('hobby_id')),
            "created" => date("Y-m-d h:i:s"),
        );

        $this->User_model->saveData("users", $insertdata);
        $this->session->set_flashdata('success', 'User created successfully');
        redirect(site_url('UserController/userlist'));
    }
}



    public function UserUpdate($id)
    {

        $getUser = $this->User_model->getData("users", "", "id='" . $id . "'", "", "", "", "single");
        $allhobbies = $this->User_model->GetData("hobbies", "id,hobby_title", "status='Active'", "hobby_title", "", "");

        $data = array(
            "allhobbies" => $allhobbies,
            "name" => set_value("name", $getUser->name),
            "id" => set_value("id", $getUser->id),
            "email" => set_value("email", $getUser->email),
            "number" => set_value("number", $getUser->number),
            "image" => set_value("image", $getUser->image),
            "gender" => set_value("gender", $getUser->gender),
            "status" => set_value("status", $getUser->status),
            "dob" => set_value("date", $getUser->dob),
            'hobby_id' => set_value('hobby_id', explode(", ", $getUser->hobby)),
        );
        //  print_r($data);exit;

        $this->load->view("user/updateuser", $data);
    }

    public function userUpdate_Action()
    {

        $id = $this->input->post("id");


        // print_r($id); exit;
        $this->form_validation->set_rules('name', 'Name', 'required');
        //  $this->form_validation->set_rules('hobby_id', 'hobbies', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('number', 'Mobile', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('date', 'Date of birth', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');

        if ($this->form_validation->run() == false) {

            $this->UserUpdate($id);


        } else {

            $getprofilephoto = $this->User_model->getData("users", "", "id ='" . $id . "'", "", "", "", "1");

            $oldimage = $getprofilephoto->image;
            // print_r($oldimage); exit;

            if ($_FILES['image']['error'] == 0) {


                $config['upload_path'] = './uploads/userimage';
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
            $name = $this->input->post("name");
            $updateprofile = array(

                "name" => $this->input->post("name"),
                "email" => $this->input->post("email"),
                "dob" => $this->input->post("date"),
                "number" => $this->input->post("number"),
                "gender" => $this->input->post("gender"),
                "image" => $image,
                'hobby' => implode(", ", $this->input->post('hobby_id', TRUE)),
                "status" => $this->input->post("status"),
            );
            //  print_r($updateprofile); exit;
            $this->session->set_userdata('name', $name);

            $this->User_model->saveData("users", $updateprofile, "id='" . $id . "'");
            $this->session->set_flashdata('success', 'profile updated successfully');
            redirect("UserController/userList");
        }


    }


    public function viewUser($id)
    {

        $userdata = $this->User_model->getData("users", "", "id='" . $id . "'", "", "", "", "1");
        //   print_r($userdata); exit;

        $data = array(

            "userdata" => $userdata,
        );
        // print_r($data); exit;

        $this->load->view("user/viewuser", $data);

    }

    public function delete($id)
    {

        $getuser = $this->User_model->getData("users", "", "id='" . $id . "'", "", "", "", "1");

        $image = $getuser->image;

        // print_r($getuser); exit;


        if (empty($getuser)) {

            $this->session->set_flashdata("warning", "unable to delete");
            redirect("UserController/userList");
        } else {

            $this->User_model->delete("users", "id='" . $getuser->id . "'");
            unlink("uploads/userimage/" . $image);
            $this->session->set_flashdata("success", "user deleted successfully");

                redirect("UserController/userList");
    

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
						$getUserdata=$this->User_model->GetData("users","id","id='".$id[$i]."'","","","","");
						
						foreach($getUserdata as $getUser)
						{
							
							if(empty($getUserdata))
							{
								$nondel++;
							}
							else
							{
								$this->User_model->delete("users","id ='".$getUser->id."'");
								$del++; 
							}
						}
					}  
					$massage= $del." Guest record has been deleted"."<br/>".$nondel." Guest record not deleted";
					$this->session->set_flashdata('error',$massage);
					redirect('UserController/userList');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Check atleast one record to delete');
				redirect('UserController/userList');
			}
		}
	}

    public function export()
	{
		$this->User_model->ExportData("users","name,email,hobby,image,dob,gender,status,created","");
	}



public function updateStatus() {
    $id = $this->input->post('id');
    $hobby = $this->User_model->getData("users","","id='".$id."'","","","","1");

    if ($hobby->status == 'Pending') {
        $data = array('status' => 'Active');
    } elseif ($hobby->status == 'Active') {
        $data = array('status' => 'Block');
    } elseif ($hobby->status == 'Block') { 
        $data = array('status' => 'Active');
    }

    if ($this->User_model->update_status($id, $data)) {
        $response = array('status' => 'success', 'new_status' => $data['status']);	
    } else {
        $response = array('status' => 'error');
        
    }

    echo json_encode($response);
}
}


?>