<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Admin extends MX_Controller
{
	public function __construct()
	{
		parent::__construct ();
		
		$this->load->helper ( array (
				'url',
				'form'
		) );
		$this->load->driver ( 'session' );
		$this->load->database ();
		$this->load->model ( array (
				'Common_model'
		) );
		$this->load->library ( array (
				'session',
				'form_validation',
				'email'
		) );
		date_default_timezone_set ( 'America/New_York' );
	}
	
	public function index()
	{
		if( $this->session->userdata ( 'admin_id' ))
		{
			redirect ( "admin/intake_user_list" );
		}	
		$this->load->view ( "logintemplate/header" );
		$this->load->view ( "admin_login" );
		$this->load->view ( "logintemplate/footer" );
	}
	
	public function authorize_user()
	{
		$uname = $this->input->post('user_name');		
		//$user_password = base64_encode (  );
		$user_password = $this->Common_model->base64En ( 2, $this->input->post('user_pass'));		
		
		$query = $this->db->get_where ( 't_admin', array (
				'email' => $uname,
				'passwd' => $user_password
		) );
		$res = $query->result_array ();
		$no = $query->num_rows ();
		
		if ($no >= 1)
		{
			$sid = $res [0] ['id'];
			$sess_admin_arr = array (
					'admin_id' => $res [0] ['id'],
					'admin_email' => $res [0] ['email'],
					'admin_name' => $res [0] ['name']
			);
			$this->session->set_userdata ( $sess_admin_arr);			
			redirect ( "admin/intake_user_list" );
		}	
		else 
		{
			$this->session->set_flashdata ( 'wrongcred', 'Enter Proper Details!' );
			redirect ( 'admin/' );
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy ();
		redirect ( base_url () . 'admin' );
	}
	
	public function intake_user_list()
	{
		$this->load->view ( "template/admin_header" );		
		$query = $this->Common_model->GetAllWhere('t_business', array());		
		$data['rec'] = $query->result_array ();		
		$this->load->view ( "view_users", $data );
		$this->load->view ( "template/admin_footer" );
	}
	
	public function details()
	{
		$data = array();
		if (! $this->session->userdata ( 'admin_id' ))
		{
			redirect ( "admin" );
		}
		$sid = $this->uri->rsegment(3);
		
		$data ['business'] = $this->Common_model->GetAllWhere ( 't_business', array ('userId' => $sid) )->result_array ()[0];
		$data ['billing'] = $this->Common_model->GetAllWhere ( 't_billing', array (	'userId' => $sid) )->result_array ()[0];		
		#echo "<pre>"; print_r($data); exit;
		$this->load->view ( "template/admin_header" );
		$this->load->view ( "details_view", $data );
		$this->load->view ( "template/admin_footer" );
	}
	
	
}#end of class