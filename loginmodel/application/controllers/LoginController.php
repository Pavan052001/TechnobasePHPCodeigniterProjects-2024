<?php

class LoginController extends CI_Controller{

    public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
		$this->load->library("form_validation");

	}

    public function index(){

        $this->load->view("login");
    }


    public function loginAction()
    {
        
            $this->validate();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $email = $this->input->post('username');
            $password = $this->input->post('password');
    
            $checkEmail = $this->Login_model->GetData("users", "", "email='" . $email . "'", "", "", "", "1");
    
            if (empty($checkEmail)) {
                $this->session->set_flashdata('error', 'Invalid Credentials');
                $this->load->view('login');
            } else {

                // Check if account is already blocked
                if ($checkEmail->status == 'Block') {
                    $this->session->set_flashdata('error', 'Your account has been blocked. Please contact admin.');
                    redirect('LoginController/index');
                    return;
                }
    
                // Check if maximum  attempts try
                if ($checkEmail->attempts >= 3) {
                    $data = array(
                        "status" =>"block",
                    );
                    $this->Login_model->updateData("users", $data, "email='" . $email . "'");
                    $this->session->set_flashdata('error', 'Your account has been blocked due to multiple failed login attempts. Please contact admin.');
                    redirect('LoginController/login');
                    return;
                }
    
                if ($checkEmail->password == $password) {
                    // Reset attempts on successful login

                    $data = array(
                        "attempts" =>0,
                    );
                    $this->Login_model->updateData("users", $data, "email='" . $email . "'");
    
                    if ($checkEmail->status == "Pending") {
                        $this->session->set_flashdata('warning', 'Your account is pending approval');
                        redirect('LoginController/login');
                    } elseif ($checkEmail->status == "Active") {
                        $sessiondata = array(
                           
                            "name" => $checkEmail->name,
                           
                        );
                        $this->session->set_userdata($sessiondata);
                        redirect('LoginController/dashboard');
                    }
                } else {
                    // Increment attempts when enter wrong password
                    $new_attempts = $checkEmail->attempts + 1;

                    $data = array(
                        "attempts"=> $new_attempts,
                    );
                    $this->Login_model->updateData("users", $data, "email='" . $email . "'");

                    $data = array(
                        "user_id" =>$checkEmail->id,
                        "attempts"=> $new_attempts,
                        "attempt_try"=>date("Y-m-d h:i:s"),
                    );

                    $this->Login_model->saveData("user_log",$data);

                    
                    $attempts_left = 3 - $new_attempts;
                    
                    if ($attempts_left > 0) {
                        $message = "Incorrect password. ";

                        $message .= ($attempts_left > 1) ? "You have {$attempts_left} attempts left." : "This is your last attempt before your account is blocked.";
                        $this->session->set_flashdata('error', $message);
                    } else {

                        // continue three wrong attempt 0 in database

                        $data = array(
                            "status" =>"Block",
                            "attempts"=> 0,
                        );
   
                        $this->Login_model->updateData("users",$data, "email='" . $email . "'");


                        $this->session->set_flashdata('error', 'Your account has been blocked due to multiple failed login attempts. Please contact admin.');
                    }
                    
                    $this->load->view("login");
                }
            }
        }
    }

     public function dashboard(){

        echo "Welcome" ." ".$_SESSION["name"];
     }

     public function validate(){

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
     }


}

?>