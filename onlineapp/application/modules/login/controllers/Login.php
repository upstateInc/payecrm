<?php
//error_reporting ( 0 );
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Login extends MX_Controller
{
	public function __construct()
	{
		parent::__construct ();
		$this->load->helper ( 'form', 'url' );
		$this->load->driver ( 'session' );
		$config ['upload_path'] = './uploads/';
		$config ['allowed_types'] = 'doc|docx|pdf|txt|jpg';
		$config ['max_size'] = '10000';
		$config ['max_width'] = '1024';
		$config ['max_height'] = '768';
		$this->load->database ();
		$this->load->library ( 'upload', $config );
		$this->load->library ( array (
				'email',
				'session' 
		) );
		$this->load->model ( array (
				'Common_model' 
		) );
	}
	public function index()
	{
		if ($this->session->userdata ( 'id' ))
		{
			redirect ( base_url () . "applicationForm/business?signupid=" . $this->session->userdata ( 'id' ) );
		}
		
		$this->load->view ( "logintemplate/header" );
		$this->load->view ( "login" );
		$this->load->view ( "logintemplate/footer" );
	}
	public function forgot_password()
	{
		$this->load->view ( "logintemplate/header" );
		$this->load->view ( "forgot" );
		$this->load->view ( "logintemplate/footer" );
	}
	public function reset_password()
	{
		$tmp = $_GET ['resetid'];
		$em = base64_decode ( $tmp );
		$this->session->set_userdata ( 'email', $em );
		$this->load->view ( "logintemplate/header" );
		$this->load->view ( "resetpassword" );
		$this->load->view ( "logintemplate/footer" );
	}
	function logout()
	{
		$this->session->sess_destroy ();
		redirect ( base_url () . 'login' );
	}
	public function login_check()
	{
		$uname = $_POST ['user_name'];		
		$passwd = base64_encode ( $_POST ['user_pass'] );
		$query = $this->db->get_where ( 't_user', array (
				'email' => $uname,
				'password' => $passwd 
		) );
		$res = $query->result_array ();
		$no = $query->num_rows ();
		if ($no >= 1)
		{
			$sid = $res [0] ['id'];
			$sessarr = array (
					'id' => $res [0] ['id'],
					'email' => $res [0] ['email'],
					'name' => $res [0] ['name'],
					'loggedInEmail' => $res [0] ['loggedInEmail'] 
			);
			$this->session->set_userdata ( $sessarr );
			
			redirect ( "applicationForm/business?signupid=$sid" );
		}
		$this->session->set_flashdata ( 'wrongcred', '<center>Enter Proper Details!</center>' );
		redirect ( '/login/' );
	}
	public function vemail()
	{
		$uemail = $_POST ["user_name"];
		$query = $this->db->get_where ( 't_user', array (
				"email" => $uemail 
		) );
		$no = $query->num_rows ();
		if ($no >= 1)
		{
			$query = $this->db->get_where ( 't_user', array (
					"email" => $uemail 
			) );
			$res = $query->result_array ();
			$em = $res [0] ['email'];
			$rid = base64_encode ( $em );
			$pid = $res [0] ['password'];
			$config ['protocol'] = 'smtp';
			$config ['smtp_host'] = 'ssl://smtp.googlemail.com';
			$config ['smtp_port'] = 465;
			$config ['smtp_user'] = "payehubsupport@payehub.com";
			$config ['smtp_pass'] = "@payehubsupport";
			$this->load->library ( 'email', $config );
			$this->email->set_mailtype ( 'html' );
			$this->email->set_newline ( "\r\n" );
			$this->email->from ( 'payehubsupport@payehub.com', 'payehub' );
			$this->email->to ( $uemail );
			$this->email->subject ( 'Password Reset Link' );
			$this->email->message ( "<a href='" . base_url () . "login/reset-password?resetid=$rid'>Go to reset your password!</a>" );
			$this->email->send ();
			
			$this->session->set_userdata ( 'email', $uemail );
			$this->session->set_flashdata ( 'lostpwd', "<a href='https://mail.google.com/mail/u/0/#inbox'>Go to your mail box..</a>" );
			redirect ( base_url () . 'login/forgot-password' );
		}
		else
		{
			$this->session->set_flashdata ( 'emailnotfound', 1 );
			redirect ( base_url () . 'login/forgot-password' );
		}
	}
	public function resetpassword()
	{
		$email = $this->session->userdata ( 'email' );
		$pwd = base64_encode ( $this->input->post ( 'user_pass' ) );
		// echo $pwd;
		$userdata = array (
				'password' => $pwd 
		);
		$this->Common_model->updwhere ( 't_user', array (
				'email' => $email 
		), $userdata );
		$retval = $this->Common_model->collectAll ( 't_user', $email );
		$sid = $retval [0] ['id'];
		$data ['email'] = $retval [0] ['email'];
		$data ['password'] = $retval [0] ['password'];
		$data ['name'] = $retval [0] ['name'];
		$data ['loggedInEmail'] = $retval [0] ['loggedInEmail'];
		
		$this->session->set_userdata ( $data );
		redirect ( base_url () . "applicationForm/business?signupid=$sid" );
	}
}
