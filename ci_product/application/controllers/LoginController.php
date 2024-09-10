<?php

class LoginController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
		$this->load->library("form_validation");

	}

	public function index()
	{

		$totalguestcount=$this->Login_model->getdata("guests","id","user_id='".$this->session->userdata("id")."'","","","","");
		$totalguestCount=count($totalguestcount);

		//total admin for guest

		$totalguestcountforadmin=$this->Login_model->getdata("guests","id","","","","","");
		$totatadminguest=count($totalguestcountforadmin);



		$totalmaleguestcount=$this->Login_model->getdata("guests","id","user_id='".$this->session->userdata("id")."' and gender='Male'","","","","");
		$maleguestCount=count($totalmaleguestcount);

		//total male guest cont for admin

		$totalmaleguestcountforadmin=$this->Login_model->getdata("guests","id","gender='Male'","","","","");
		$maleguestCountforadmin=count($totalmaleguestcountforadmin);

		// print_r($maleguestCountforadmin); exit;


		$totalfemaleguestcount=$this->Login_model->getdata("guests","id","user_id='".$this->session->userdata("id")."' and gender='Female'","","","","");
		$femaleguestCount=count($totalfemaleguestcount);

		// total female guest count

		$totalfemaleguestcountforadmin=$this->Login_model->getdata("guests","id"," gender='Female'","","","","");
		$femaleguestCountforadmin=count($totalfemaleguestcountforadmin);
		// print_r($totalfemaleguestcountforadmin)


		//  print_r($guestCount); exit;

		$maleguest = $this->Login_model->GetData("guests","","user_id='".$this->session->userdata('id')."' and gender='Male'","created DESC","","5","");
		$femaleguest = $this->Login_model->GetData("guests","","user_id='".$this->session->userdata('id')."' and gender='Female'","created DESC","","5","");

		$activeuser = $this->Login_model->GetData("users","","status='Active'and role='User'","created DESC","","5","");

		// print_r($activeuser); exit;

		$blockeuser = $this->Login_model->GetData("users","","status='Block' and role='User'","created DESC","","5","");

		$pendingeuser = $this->Login_model->GetData("users","","status='Pending' and role='User'","created DESC","","5","");



		$data =array(
			"maleguest"=>$maleguest,
			"femaleguest"=>$femaleguest,
			"totalguestCount"=>$totalguestCount,
			"maleguestCount"=>$maleguestCount,
			"femaleguestCount"=>$femaleguestCount,
			"activeuser"=>$activeuser,
			"blockeuser"=>$blockeuser,
			"pendingeuser"=>$pendingeuser,
			"totatadminguest"=>$totatadminguest,
			"maleguestCountforadmin"=>$maleguestCountforadmin,
			"femaleguestCountforadmin"=>$femaleguestCountforadmin,


		);
		$this->load->view("dashboard",$data);
	}



	public function login()
	{

		$this->load->view("login");
	}

	public function loginAction()
	{

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {

			$this->load->view('login');
		} else {

			$email = $this->input->post('username');
			$password = $this->input->post('password');

			// print_r($email);
			// print_r($password);
			//  exit;

			$checkEmail = $this->Login_model->GetData("users", "", "email='" . $email . "'", "", "", "", "1");




			if (empty($checkEmail)) {

				$this->session->set_flashdata('error', 'Invalid Credentials');
				$this->load->view('login');
			} else {

				if ($checkEmail->password == $password) {

					if ($checkEmail->status == "Pending") {
						$this->session->set_flashdata('warning', 'Your account is pending for approval');
						redirect('LoginController/login');
					} elseif ($checkEmail->status == "Active") {

						$loguser = array(
							"user_id" => $checkEmail->id,
							"user_login" => date("Y-m-d H:i:s"),
							"ip_address" => $_SERVER['REMOTE_ADDR'],
							"access_details" => $_SERVER['HTTP_USER_AGENT']

						);
						$this->Login_model->saveData("user_access_logs", $loguser);

						$lastlog = array(
							"last_login" => date("Y-m-d H:i:s"),
							"last_ip" => $_SERVER['REMOTE_ADDR'],
							"access_details" => $_SERVER['HTTP_USER_AGENT']

						);

						$this->Login_model->saveData("users", $lastlog, "id ='" . $checkEmail->id . "'");

						$sessiondata = array(
							"id" => $checkEmail->id,
							"token" => $checkEmail->token,
							"name" => $checkEmail->name,
							"email" => $checkEmail->email,
							"role" => $checkEmail->role,
							"gender" => $checkEmail->gender,
							"status" => $checkEmail->status,
							"image" => $checkEmail->image,
						);
						$this->session->set_userdata($sessiondata);
						redirect('LoginController/index');

					} else {
						$this->session->set_flashdata('error', 'Your account has been blocked please contact admin');
						redirect('LoginController/login');

					}
				} else {
					$this->session->set_flashdata('error', 'Incorrect password');
					$this->load->view("login");

				}

			}

		}
	}

	public function logout()
	{

		$alluseraccesslog = $this->Login_model->getData("user_access_logs", "", "user_id = '" . $this->session->userdata('id') . "'", "user_login DESC", "", "", "", "");


		foreach ($alluseraccesslog as $alluserlogs) {
			$data = array(
				'user_logout' => date('Y-m-d H:i:s'),
			);
			$this->Login_model->saveData("user_access_logs", $data, "user_id = '" . $this->session->userdata('id') . "' and user_login = '" . $alluserlogs->user_login . "'");
			$array_item = array('id', 'token', 'name', 'email', 'role', 'gender', 'status');
			$this->session->unset_userdata($array_item);
			redirect('LoginController/login');
			session_destroy();
		}
	}

	public function register()
	{

		$this->load->view("register");
	}

	public function registerAction()
	{

		$this->create_validate();
		if ($this->form_validation->run() == FALSE) {

			$this->load->view('register');

		} else {

			if ($_FILES['image']['error'] == 0) {


				$config['upload_path'] = './uploads/userimage';
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
					// print_r($image); exit;

				}
			}

			$hobbies = $this->input->post('hobby[]');

			$insertdata = array(
				"token" => md5('Users-token' . time() . rand(1000, 9999)),
				"name" => $this->input->post('name'),
				"email" => $this->input->post('email'),
				"password" => $this->input->post('password'),
				"number" => $this->input->post('mobile'),
				"dob" => $this->input->post('date'),
				"city" => $this->input->post('select'),
				"address" => $this->input->post('address'),
				"image" => $image,
				"gender" => $this->input->post('gender'),
				"hobby" => implode(',', $hobbies),
				"created" => date("Y-m-d h:i:s"),
			);
			//  print_r($insertdata); exit;



			$this->Login_model->saveData("users", $insertdata);
			$this->session->set_flashdata('success', 'User created successfully');
			redirect(site_url('LoginController/login'));
		}

	}

	public function forgotpassword()
	{

		$this->load->view("forgotpassword");
	}

	public function forgotPassword_action()
	{


		$this->form_validation->set_rules('username', 'Email', 'required|valid_email');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view("forgotpassword");
		} else {
			$email = $this->input->post('username');
			$checkemail = $this->Login_model->getdata("users", "", "email='" . $email . "'", "", "", "", "1");


			if (!empty($checkemail->email) && ($checkemail->email === $email)) {
				if ($checkemail->status == "Active" || $checkemail->status == "Pending") {
					$otp = rand(100000, 999999); // Generate a 6-digit OTP
					$data = array(
						'otp' => $otp,
					);

					$this->Login_model->saveData("users", $data, "email='" . $checkemail->email . "'");

					// Prepare email
					$subject = "Password Reset OTP";
					$message = "Your OTP for password reset is: " . $otp;

					$config = array(
						'protocol' => 'smtp',
						'smtp_host' => 'ssl://smtp.gmail.com',
						'smtp_port' => '465',
						'smtp_timeout' => '7',
						'smtp_user' => 'pavanmohankar80@gmail.com',
						'smtp_pass' => 'hoedgdbojsxdyeku',
						'charset' => 'utf-8',
						'newline' => "\r\n",
						'mailtype' => 'text', // Change to html if needed
						'validation' => TRUE // bool whether to validate email or not  
					);
					$this->email->initialize($config);

					$this->load->library('email', $config);


					$this->email->from('pavanmohankar80@gmail.com', 'pavan');
					$this->email->to($checkemail->email);
					$this->email->subject($subject);
					$this->email->message($message);

					if (!$this->email->send()) {
						$error = $this->email->print_debugger(array('headers'));
						echo $error; // Print the error
						log_message('error', $error);
						$this->session->set_flashdata('error', 'Failed to send email. Please try again.');
						$this->load->view('forgotpassword');
					} else {
						$this->session->set_flashdata('success', 'OTP has been sent to your email.');
						redirect('LoginController/changenewpass');
					}

				} elseif ($checkemail->status == "Block") {
					$this->session->set_flashdata('error', 'User account is blocked');
					$this->load->view('forgotpassword');
				}

			} else {
				$this->session->set_flashdata('error', 'Email does not exist');
				redirect('LoginController/forgotpassword');
			}
		}

	}

	public function changenewpass()
	{
		$this->load->view("newconfirmpassword1");

	}

	public function changenewpass_action()
	{


		$this->form_validation->set_rules('otp', 'OTP', 'required');
		$this->form_validation->set_rules('pass', 'Password', 'required');
		$this->form_validation->set_rules('conpass', 'Password', 'required|matches[pass]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view("newconfirmpassword1");

		} else {

			$otp = $this->input->post('otp');

			$checkotp = $this->Login_model->getdata("users", "", "otp='" . $otp . "'", "", "", "", "1");


			if ($checkotp->password != $this->input->post('pass')) {

				if ($checkotp->otp == $this->input->post('otp')) {

					if ($this->input->post('pass') == $this->input->post('conpass')) {
						$data = array(
							'password' => $this->input->post('pass', TRUE)
						);

						$this->Login_model->saveData("users", $data, "otp='" . $otp . "'");


						$this->session->set_flashdata('success', 'Password saved successfully.');
						redirect('LoginController/login');
					} else {
						$this->session->set_flashdata('error', 'please enter valid check password.');
						$this->load->view('user/newconfirmpassword1');

					}
				} else {
					$this->session->set_flashdata('error', 'please enter valid otp.');
					$this->load->view('newconfirmpassword1');

				}

			} else {

				$this->session->set_flashdata('error', 'please enter new password .');
				$this->load->view('newconfirmpassword1');


			}
		}

	}

	public function create_validate()
	{

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('date', 'Date of birth', 'required');
		$this->form_validation->set_rules('hobby[]', 'hobbies', 'required');
		$this->form_validation->set_rules('gender', 'gender', 'required');

	}



}

?>