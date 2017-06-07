<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class events extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html','dompdf', 'file'));
		$this->load->library(array('session','authentication','form_validation','email','upload','image_lib','pagination'));
		$this->load->model(array('adminuser','common_model','mail_model'));
		$this->authentication->is_loggedin($this->session->userdata('ADMIN_ID'));
		$this->table = EVENTS;
		//$this->tableview = VWMESSAGE;
		$this->viewfolder = 'events/';
		$this->controllerFile = 'events/';
		$this->namefile = 'Events';
	}
	public function index() {
		if($this->session->userdata('ADMIN_TYPE')!='superadmin')
		redirect(base_url());
		$userId=$this->session->userdata('ADMIN_ID');
		$message = '';
		$data = array();
		$order_by_fld = 'id';
		$order_by =	'DESC';
		$offset = (int)$this->uri->segment(3,0);
		$limit = 20;
/**********************search*************************************/		
		$where_clause = "";
		$data['subject'] = '';
		//print_r($_POST);
		if($this->uri->segment(3) == '' && $this->uri->segment(2)!='index')
		{
			$this->session->set_userdata('subject', '');
		}
		if($this->input->post('search')!= '')
		{
			$this->session->set_userdata('subject', $this->input->post('subject'));
		}
		if($this->session->userdata('subject') != '')
		{
			$subject = $this->session->userdata('subject');
			$where_clause .= "subject LIKE '%$subject%' ";
			$data['subject'] = $subject;
		}
/**********************search*************************************/
		$where_clause .= "";		
		$total_rows = $this->common_model->countAll($this->table,$where_clause);
		$query = $this->common_model->get_all_records($this->table, $where_clause,$order_by_fld,$order_by,$offset,$limit);
		//echo $this->db->last_query();
		//Pagination config
		$config['base_url'] = base_url().$this->controllerFile."index";
		$config['uri_segment'] = 3;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		$paginator = $this->pagination->create_links();
		///////////////////
		$data['message'] = $message;
		$data['paginator'] = $paginator;
		$data['query'] = $query;
		$this->load->view($this->viewfolder.'list',$data);
	}
	public function add() {
		$data = array();
		$message = '';
		$data['message'] = $message;		
		$this->load->view($this->viewfolder.'/add',$data);		
	}
	public function insert() {
	//print_r($_POST); exit;
	
			$row['createdby'] = $this->session->userdata('ADMIN_ID'); 			
			$row['subject'] = $this->input->post('subject'); 			
			$row['message'] = $this->input->post('message'); 
			$row['rec_crt_date'] = date('Y-m-d H:i:s') ;
			$row['rec_up_date'] = date('Y-m-d H:i:s') ;
			$insert_id = $this->common_model->addRecord($this->table,$row);
			
			$message = setMessage('Record added successfully.',"success");
			$this->session->set_flashdata('message', $message);
			redirect(site_url($this->controllerFile));	
	}	//end of insert
	public function pop() {
		$id = $this->uri->segment(3);
		$sentmessageid = $this->uri->segment(4);
		
		$updateRow['status']='read';
		if($this->session->userdata('ADMIN_TYPE')!='superadmin'){
			$this->common_model->Update_Record($updateRow,$this->table1,$sentmessageid);
		}
		//echo $this->db->last_query();
		$row = $this->common_model->Retrive_Record($this->tableview,$id);
		$data = array();
		$data['row'] = $row ;
		$this->load->view($this->viewfolder.'/view',$data);
	} //  end of pop_news

	function delete_single($id) {
	//echo $id;
		//$row_res = $this->common_model->Retrive_record(RESTAURANT,$id);
		$this->db->where('id', $id);
		$this->db->delete($this->table); 
		$message = setMessage('Record deleted successfully',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));
	}
	public function change_status() {
		$id = $this->input->post('id') ; 
		$value = $this->input->post('val') ;
		
		$row = array();
		$row['status'] = $value;
		$row['rec_up_date'] = date('Y-m-d H:i:s') ;
		$this->db->where('id', $id);
		$this->db->update($this->table, $row);
		echo 'success';
	}	// end of change status	
}