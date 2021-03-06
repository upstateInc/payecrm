<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reserve_fees extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html','file'));
		$this->load->library(array('session','authentication','form_validation','email','upload','image_lib','pagination'));
		$this->load->model(array('common_model'));

		$this->table = 't_reserve_fees_weekly';
		$this->viewfolder = 'reserve_fees/';
		$this->controllerFile = 'reserve_fees/';
		$this->namefile = 'reserve_fees';
	}
	public function index() {
		$message = '';
		$data = array();
		$order_by_fld = 'start_date,companyID';
		$order_by =	'ASC';
		$offset = (int)$this->uri->segment(3,0);
		$limit = 10;
		
		if($this->input->post('hdnOrderByFld') != '')
		{
			$order_by_fld = $this->input->post('hdnOrderByFld');
			$this->session->set_userdata('order_by_fld', $order_by_fld);
			$order_by = $this->input->post('hdnOrderBy');
			$this->session->set_userdata('order_by', $order_by);
		}
		if($this->uri->segment(3)!='')
		{
			$order_by_fld = $this->session->userdata('order_by_fld');
			$order_by = $this->session->userdata('order_by');
		}
		else
		{
			$this->session->set_userdata('order_by_fld', $order_by_fld);
			$this->session->set_userdata('order_by', $order_by);
		}		
/**********************search*************************************/		
		$where_clause = "";
		$data['id'] = '';		
		$data['companyID'] = '';
		$data['fees_type'] = '';
		$data['directory'] = '';
		$data['programName'] = '';
		$data['decriptor'] = '';
		$data['status'] = '';
		$data['paymentType'] = '';
		//print_r($_POST);
		if($this->uri->segment(3) == '' && $this->uri->segment(2)!='index')
		{
			$this->session->set_userdata('id', '');			
			$this->session->set_userdata('companyID', '');
			$this->session->set_userdata('fees_type', '');
			$this->session->set_userdata('directory', '');
			$this->session->set_userdata('programName', '');
			$this->session->set_userdata('decriptor', '');
			$this->session->set_userdata('status', '');
			$this->session->set_userdata('paymentType', '');
		}
		if($this->input->post('search')!= '')
		{
			
			$this->session->set_userdata('id', $this->input->post('id'));			
			$this->session->set_userdata('companyID', $this->input->post('companyID'));
			$this->session->set_userdata('fees_type', $this->input->post('fees_type'));
			$this->session->set_userdata('directory', $this->input->post('directory'));
			$this->session->set_userdata('programName', $this->input->post('programName'));
			$this->session->set_userdata('decriptor', $this->input->post('decriptor'));
			$this->session->set_userdata('status', $this->input->post('status'));
			$this->session->set_userdata('paymentType', $this->input->post('paymentType'));
		}
		if($this->session->userdata('id') != '')
		{
			$id = $this->session->userdata('id');
			$where_clause .= "id = '$id' AND ";
			$data['id'] = $id;
		}
		if($this->session->userdata('status') != '')
		{
			$status = $this->session->userdata('status');
			$where_clause .= "status = '$status' AND ";
			$data['status'] = $status;
		}
		if($this->session->userdata('companyID') != '')
		{
			$companyID = $this->session->userdata('companyID');
			$where_clause .= "companyID LIKE '%$companyID%' AND ";
			$data['companyID'] = $companyID;
		}		
		if($this->session->userdata('fees_type') != '')
		{
			$fees_type = $this->session->userdata('fees_type');
			$where_clause .= "fees_type LIKE '%$fees_type%' AND ";
			$data['fees_type'] = $fees_type;
		}
		if($this->session->userdata('directory') != '')
		{
			$directory = $this->session->userdata('directory');
			$where_clause .= "directory LIKE '%$directory%' AND ";
			$data['directory'] = $directory;
		}
		if($this->session->userdata('programName') != '')
		{
			$programName = $this->session->userdata('programName');
			$where_clause .= "programName LIKE '%$programName%' AND ";
			$data['programName'] = $programName;
		}
		if($this->session->userdata('decriptor') != '')
		{
			$decriptor = $this->session->userdata('decriptor');
			$where_clause .= "decriptor LIKE '%$decriptor%' AND ";
			$data['decriptor'] = $decriptor;
		}
		if($this->session->userdata('paymentType') != '')
		{
			$paymentType= $this->session->userdata('paymentType');
			$where_clause .= "paymentType LIKE '%$paymentType%' AND ";
			$data['paymentType'] = $paymentType;
		}		
/**********************search*************************************/
		$where_clause  = substr($where_clause, 0, -4);
		$data['where_clause'] = $where_clause;
		$total_rows = $this->common_model->countAll($this->table,$where_clause);
		$query = $this->common_model->get_all_records($this->table, $where_clause,$order_by_fld,$order_by,$offset,$limit);
		//echo $this->db->last_query();
		//Pagination config
		$config['base_url'] = base_url().$this->controllerFile."index";
		$config['uri_segment'] = 3;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		
		$config['full_tag_open'] 	= '<div class="pagination">';
		$config['full_tag_close'] 	= '</div>';
		$config['full_tag_open'] 	= "<ul class='pagination'>";
		$config['full_tag_close'] 	= "</ul>";
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] 	= "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] 	= "<li>";
		$config['next_tagl_close'] 	= "</li>";
		$config['prev_tag_open'] 	= "<li>";
		$config['prev_tagl_close'] 	= "</li>";
		$config['first_tag_open'] 	= "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] 	= "<li>";
		$config['last_tagl_close'] 	= "</li>";
		$config['page_query_string'] = False;
		$this->pagination->initialize($config);
		$paginator = $this->pagination->create_links();
		///////////////////
		$data['message'] = $message;
		$data['paginator'] = $paginator;
		$data['query'] = $query;
		
		//$companyIDName = $this->common_model->get_all_records('t_center_fees', '','id','ASC','','');
		$companyIDName = $this->db->query("Select distinct(companyID) from t_centerdb where status='Y' order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
		$center_fees = $this->db->query("Select distinct(fees_type) as center_feesName from   t_fees where status='Y' order by fees_type ASC");
		$data['center_fees'] = $center_fees;
		$data['order_by_fld'] = $order_by_fld;
		$data['order_by'] = $order_by;
		$this->load->view($this->viewfolder.'list',$data);
	}
	public function add() {
		$message = '';
		$data['message'] = $message;
		$companyIDName = $this->db->query("Select distinct(companyID) from t_centerdb where status='Y' order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
		$this->load->view($this->viewfolder.'/add',$data);
	}
	public function insert() {
		//print_r($_POST);
		//exit;
		$nbr_of_reserve_weeks=$this->db->query("select nbr_of_reserve_weeks from t_centerdb where companyID='".$this->input->post('companyID')."'")->row()->nbr_of_reserve_weeks;
		$nbr_of_reserve_weeks=$nbr_of_reserve_weeks*7-1;
		//echo $nbr_of_reserve_weeks;
		$parts = explode('-',$this->input->post('start_date'));
		$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
		
		$row['companyID'] = $this->input->post('companyID') ;		
		$row['start_date'] = $yyyy_mm_dd;;
		$row['end_date'] = date('Y-m-d',strtotime("+".$nbr_of_reserve_weeks." days", strtotime($yyyy_mm_dd)));
		$row['status'] = $this->input->post('status');	
		//$row['rec_crt_date'] = date('Y-m-d') ;
		//exit;
		//$row['super_admin'] = '1' ;
		$getid=$this->db->query("select id from ".$this->table." where start_date <= '".$row['start_date']."' and end_date >= '".$row['start_date']."' and companyID='".$row['companyID']."'")->row()->id;
		if($getid==""){
			$insert_id = $this->common_model->addRecord($this->table,$row);	
			$message = setMessage('Record added successfully.',"success");
		}else{
			$message = setMessage('Record not Added.',"error");
		}
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));	
	}	//end of insert
	public function edit(){
		$message = '';
		$id = $this->uri->segment(3);
		$row = $this->common_model->Retrive_Record($this->table,$id);
		$data = array();
		$data['query'] = $row ;
		$data['message'] = $message;
		$companyIDName = $this->db->query("Select distinct(companyID) from t_centerdb where status='Y' order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
		$this->load->view($this->viewfolder.'/edit',$data);
	}
	public function copy(){
		$message = '';
		$id = $this->uri->segment(3);
		$row = $this->common_model->Retrive_Record($this->table,$id);
		$data = array();
		$data['query'] = $row ;
		$data['message'] = $message;
		$companyIDName = $this->db->query("Select distinct(companyID) from t_centerdb where status='Y' order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
				
		$this->load->view($this->viewfolder.'/copy',$data);
	}
	function update() {
		$message_empty = '';
		$data = array();
		$id= $this->input->post('id');
		
		/*$nbr_of_reserve_weeks=$this->db->query("select nbr_of_reserve_weeks from t_centerdb where companyID='".$this->input->post('companyID')."'")->row()->nbr_of_reserve_weeks;
		$nbr_of_reserve_weeks=$nbr_of_reserve_weeks*7-1;*/
		//echo $nbr_of_reserve_weeks;
		$parts = explode('-',$this->input->post('payment_date'));
		$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
		//$row['companyID'] = $this->input->post('companyID') ;		
		$row['payment_date'] = $yyyy_mm_dd;;
		//$row['end_date'] = date('Y-m-d',strtotime("+".$nbr_of_reserve_weeks." days", strtotime($yyyy_mm_dd)));
		$row['status'] = 'N';			
		//$row['status'] = $this->input->post('status');			
	
		$update = $this->common_model->Update_Record($row,$this->table,$id);
		$message = setMessage('Record updated successfully.',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));	

	}	// end of update

	public function pop() {
		$id = $this->uri->segment(3);
		$row = $this->common_model->Retrive_Record($this->table,$id);
		$data = array();
		$data['row'] = $row ;
		$this->load->view($this->viewfolder.'/view',$data);
	} //  end of pop_news

	public function change_is_active() {
		$id = $this->input->post('id') ; 
		$value = $this->input->post('val') ; 
		$row = array();
		$row['status'] = $value;
		$this->db->where('id', $id);
		$this->db->update($this->table, $row);
		echo 'success';
	}	// end ofchange_is_active
	function delete_single($id) {
		$this->db->where('id', $id);
		$this->db->delete($this->table); 
		$message = setMessage('Record deleted successfully',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));
	}
	function addFees(){
		$companyID = $this->input->post('companyID');
		$fees = $this->db->query("Select * from t_fees where fees_type!='ACH'");
		foreach($fees->result() as $val){
			$Id="";
			$Id=$this->db->query("select id from t_center_fees where companyID='".$companyID."' and fees_type='".$val->fees_type."'")->row()->id;
			if($Id==""){
				$row['companyID'] 		= $companyID;
				$row['fees_type'] 		= $val->fees_type;		
				$row['fee'] 			= $val->fee;		
				$row['fee_type'] 		= $val->fee_type;		
				$row['status'] 			= 'Y';	
				$insert_id = $this->common_model->addRecord($this->table,$row);					
			}
		}
		echo 'Fess added to Center';	
	}
}