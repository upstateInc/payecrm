<?php
class Dashboard extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html'));
		$this->load->library(array('session','authentication'));
		$this->authentication->is_loggedin($this->session->userdata('ADMIN_ID'));
		$this->viewfolder = '';
		$this->load->model(array('common_model'));
		$this->controllerFile = 'dashboard/';
		$this->namefile = 'dashboard';
	}
	
	function index() {
		$message = '';
		$data = array();
		$order_by_fld = 'id';
		$order_by =	'DESC';	
		$where_clause=array();
		$where_clause=array('status'=>'Y');
		//$where_clause .= "status='Y'";
		//$eventsquery = $this->common_model->get_all_records(EVENTS, $where_clause,$order_by_fld,$order_by,$offset,$limit);
		//$data['eventsquery']=$eventsquery;
		//echo $this->db->last_query();
		$this->load->view('dashboard',$data);
	}
	
}
// end of class
