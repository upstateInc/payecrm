<?php
error_reporting ( 0 );
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Signup extends MX_Controller
{
	public function __construct()
	{
		parent::__construct ();
		$this->load->helper ( 'form', 'url' );
		$this->load->driver ( 'session' );
		$this->load->model ( array (
				'Common_model' 
		) );
		$this->load->database ();
		$this->load->library ( array (
				'session',
				'form_validation',
				'email' 
		) );
		date_default_timezone_set ( 'America/New_York' );
	}
	
	public function index()
	{
		/*
		 * if($_SESSION['loggedInEmail'])
		 * {
		 * $email=$_SESSION['loggedInEmail'];
		 * }
		 */
		$this->load->view ( "logintemplate/header" );
		$this->load->view ( "signup" );
		$this->load->view ( "logintemplate/footer" );
	}
	public function savebasic()
	{
		$date = date ( 'Y-m-d h:i:s A' );
		
		$fullName = $this->input->post ( 'firstName' ) . " " . $this->input->post ( 'lastName' );
		$primaryCellPhone = $this->input->post ( 'primaryCellPhone' );
		$email = $this->input->post ( 'email' );
		if ($this->session->userdata ( 'loggedInEmail' ))
			$lie = $this->session->userdata ( 'loggedInEmail' );
		else
			$lie = $email;
		
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_rules ( 'email', 'Email address', 'trim|is_unique[t_user.email]' );
		if ($this->form_validation->run () == true)
		{
			
			$PASSWORD = base64_encode ( $this->input->post ( 'user_pass' ) );			
			// base64_encode($string);
			
			$userdata = array (
					'name' => $fullName,
					'email' => $email,
					'phone' => $primaryCellPhone,
					'password' => $PASSWORD,
					'date' => $date,
					'loggedInEmail' => $lie 
			);
			$idd = $this->Common_model->addrec ( 't_user', $userdata );
			
			$cid = $this->Common_model->addrec ( 't_business', array (
					'userId' => $idd 
			) );
			
			$this->Common_model->addrec ( 't_centerdb', array (
					'userId' => $idd,
					'companyID' => $cid,
					'status' => 'P',
					'visibility' => 'N' 
			) );
			
			$this->Common_model->addrec ( 't_billing', array (
					'userId' => $idd 
			) );
			
			$sessdata = array (
					'cid' => $cid,
					'id' => $idd,
					'name' => $fullName,
					'email' => $email,
					'phone' => $primaryCellPhone,
					'password' => $PASSWORD,
					'date' => $date,
					'loggedInEmail' => $lie 
			);
			
			$this->session->set_userdata ( $sessdata );
			
			redirect ( "signup/business?signupid=$idd" );
		}
		else
		{
			redirect ( "signup/?registeredId=$email" );
		}
	}
	public function saveform()
	{
		$sid = $this->input->post ( 'sid' );
		$company = $this->input->post ( 'company' );
		$locationTimezoneTemp = $this->input->post ( 'locationTimezoneTemp' );
		$potentialType = $this->input->post ( 'potentialType' );
		$industryId = $this->input->post ( 'industryId' );
		$freeTrialOffer = $this->input->post ( 'freeTrialOffer' );
		
		$userdata = array (
				'organization' => $company,
				'location' => $locationTimezoneTemp,
				'service' => $potentialType,
				'industry' => $industryId,
				'freetrial' => $freeTrialOffer 
		);
		$this->Common_model->updwhere ( 't_user', array (
				'id' => $sid 
		), $userdata );
		
		redirect ( "applicationForm/business?signupid=$sid" );
	}
	public function deletedoc()
	{
		$sid = $this->session->userdata ( 'id' );
		$doc = $this->input->get ( 'doc' );
		$tmp = explode ( '_@', $doc );
		$no = $tmp [0];
		$this->Common_model->updwhere ( 't_billing', array (
				'userId' => $sid 
		), array (
				'doc' . $no => "" 
		) );
		redirect ( "applicationForm/document?signupid=$sid" );
	}
	public function business()
	{
		if (! $this->session->userdata ( 'loggedInEmail' ))
		{
			redirect ( "login" );
		}
		
		$this->load->view ( "logintemplate/header" );
		$this->load->view ( "shortform" );
		$this->load->view ( "logintemplate/footer" );
	}
}
