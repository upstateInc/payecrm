<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Emails extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html','dompdf', 'file'));
		$this->load->library(array('session','authentication','form_validation','email','upload','image_lib','pagination'));
		$this->load->model(array('adminuser','common_model','mail_model'));
		$this->authentication->is_loggedin($this->session->userdata('ADMIN_ID'));
		$this->authentication->is_systemAdmin($this->session->userdata('ADMIN_PERMISSION'));
		$this->table = 't_invoice';
		$this->viewfolder = 'emails/';
		$this->controllerFile = 'emails/';
		$this->namefile = 'emails';
	}
	public function index() {
		$message = '';
		$data = array();
		$order_by_fld = 'fname';
		$order_by =	'ASC';
		$offset = (int)$this->uri->segment(3,0);
		$limit = 20;
		
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
		$data['gatewayName'] = '';
		$data['directory'] = '';
		$data['programName'] = '';
		$data['decriptor'] = '';
		$data['status'] = '';
		$data['validated'] = '';
		$data['grossPrice'] = '';
		$data['paymentType'] = '';
		$data['hideBadRecords'] = '';

		//print_r($_POST);
		if($this->uri->segment(3) == '' && $this->uri->segment(2)!='index')
		{
			$this->session->set_userdata('id', '');			
			$this->session->set_userdata('companyID', '');
			$this->session->set_userdata('validated', '');
			$this->session->set_userdata('gatewayName', '');
			$this->session->set_userdata('directory', '');
			$this->session->set_userdata('programName', '');
			$this->session->set_userdata('decriptor', '');
			$this->session->set_userdata('status', '');
			$this->session->set_userdata('start_date', '');
			$this->session->set_userdata('end_date', '');
			
			$this->session->set_userdata('customer_name', '');
			
			$this->session->set_userdata('paymentType', '');
			$this->session->set_userdata('grossPrice', '');
			
			$this->session->set_userdata('customer_phone', '');
			$this->session->set_userdata('customer_email', '');
			$this->session->set_userdata('cardNo', '');
			$this->session->set_userdata('selectedEmails1', '');
			$this->session->set_userdata('hideBadRecords', '');
		}
		if($this->session->userdata('selectedEmails1') != '')
		{
			$data['selectedEmails1'] = $this->session->userdata('selectedEmails1');
		}
		if($this->input->post('search')!= '')
		{			
			$this->session->set_userdata('id', $this->input->post('id'));			
			$this->session->set_userdata('paymentType', $this->input->post('paymentType'));
			$this->session->set_userdata('grossPrice', $this->input->post('grossPrice'));
			$this->session->set_userdata('companyID', $this->input->post('companyID'));
			$this->session->set_userdata('validated', $this->input->post('validated'));
			$this->session->set_userdata('gatewayName', $this->input->post('gatewayName'));
			$this->session->set_userdata('directory', $this->input->post('directory'));
			$this->session->set_userdata('programName', $this->input->post('programName'));
			$this->session->set_userdata('decriptor', $this->input->post('decriptor'));
			$this->session->set_userdata('status', $this->input->post('status'));
			$this->session->set_userdata('start_date', $this->input->post('start_date'));
			if($this->input->post('start_date')!=$this->input->post('end_date')){
				$this->session->set_userdata('end_date', $this->input->post('end_date'));
			}else{
				$this->session->set_userdata('end_date', '');
			}
			$this->session->set_userdata('customer_name', $this->input->post('customer_name'));
			$this->session->set_userdata('customer_phone', $this->input->post('customer_phone'));
			$this->session->set_userdata('customer_email', $this->input->post('customer_email'));
			$this->session->set_userdata('cardNo', $this->input->post('cardNo'));
			$this->session->set_userdata('hideBadRecords', $this->input->post('hideBadRecords'));
		}
		if($this->session->userdata('paymentType') == '' || $this->session->userdata('hideBadRecords') != ''){
			$this->session->set_userdata('paymentType', 'credit_card');
		}
		if($this->session->userdata('companyID') != '')
		{
			$companyID = $this->session->userdata('companyID');
			$where_clause .= "companyID LIKE '%$companyID%' AND ";
			$Custom_where_clause .= "companyID LIKE '%$companyID%' AND ";
			$data['companyID'] = $companyID;
		}		
		if($this->session->userdata('validated') != '')
		{
			$validated = $this->session->userdata('validated');
			$where_clause .= "validated LIKE '%$validated%' AND ";
			$Custom_where_clause .= "validated LIKE '%$validated%' AND ";
			$data['validated'] = $validated;
		}
		if($this->session->userdata('customer_name') != '')
		{
			$customer_name = $this->session->userdata('customer_name');
			$where_clause .= "(fname LIKE '%".$customer_name."%' or lname LIKE '%".$customer_name."%') AND ";
			$Custom_where_clause .= "customer_name LIKE '%$customer_name%' AND ";
			$data['customer_name'] = $customer_name;
		}
		if($this->session->userdata('customer_phone') != '')
		{
			$customer_phone = $this->session->userdata('customer_phone');
			$where_clause .= "customer_phone LIKE '%$customer_phone%' AND ";
			$Custom_where_clause .= "customer_phone LIKE '%$customer_phone%' AND ";
			$data['customer_phone'] = $customer_phone;
		}
		if($this->session->userdata('customer_email') != '')
		{
			$customer_email = $this->session->userdata('customer_email');
			$where_clause .= "customer_email LIKE '%$customer_email%' AND ";
			$Custom_where_clause .= "customer_email LIKE '%$customer_email%' AND ";
			$data['customer_email'] = $customer_email;
		}
		if($this->session->userdata('cardNo') != '')
		{
			$cardNo = $this->session->userdata('cardNo');
			$where_clause .= "cardNo LIKE '%$cardNo' AND ";
			$Custom_where_clause .= "cardNo LIKE '%$cardNo' AND ";
			$data['cardNo'] = $cardNo;
		}		
		if($this->session->userdata('gatewayName') != '')
		{
			$gatewayName = $this->session->userdata('gatewayName');
			$where_clause .= "gatewayID LIKE '%$gatewayName%' AND ";
			$Custom_where_clause .= "gatewayID LIKE '%$gatewayName%' AND ";
			$data['gatewayName'] = $gatewayName;
		}		
		if($this->session->userdata('grossPrice') != '')
		{
			$grossPrice = $this->session->userdata('grossPrice');
			$where_clause .= "grossPrice >= ".$grossPrice." AND ";
			//$Custom_where_clause .= "grossPrice >= ".$grossPrice." AND ";
			$data['grossPrice'] = $grossPrice;
		}		
		if($this->session->userdata('paymentType') != '')
		{
			$paymentType = $this->session->userdata('paymentType');
			$where_clause .= "paymentType = '".$paymentType."' AND ";
			$Custom_where_clause .= "paymentType = '".$paymentType."' AND ";
			$data['paymentType'] = $paymentType;
		}
		/*if($this->session->userdata('status') != '')
		{
			$status = $this->session->userdata('status');
			foreach($status as $val){
				$where_status_clause .= "status like '%".$val."%' OR ";
			}
			$where_clause .="(";
			$where_clause .= substr($where_status_clause, 0, -3);
			$where_clause .=") AND ";
			$data['status'] = $status;
		}*/
		if($this->session->userdata('status') != '')
		{
			$status = $this->session->userdata('status');
			$where_clause .= "status LIKE '%".$status."%' AND ";
			//$Custom_where_clause .= "status LIKE '%".$status."%' AND ";
			$data['status'] = $status;
		}
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') != '')
		{
			$start_date = $this->session->userdata('start_date');
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$Custom_where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$data['start_date'] = $start_date;
		}
		/*if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') == '')
		{
			$start_date = $this->session->userdata('start_date');
			//echo $start_date;
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND `rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND";
			$data['start_date'] = $start_date;
		}*/
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') == '')
		{
			$start_date = $this->session->userdata('start_date');
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			//$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND `rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND";
			//$where_clause1 .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND `rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND";		
			$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$Custom_where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$where_clause1 .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$data['start_date'] = $start_date;
		}		
		if($this->session->userdata('end_date') != '')
		{
			$end_date = $this->session->userdata('end_date');
			$parts = explode('-',$end_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];			
			$where_clause .= "`rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND ";
			$Custom_where_clause .= "`rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND ";
			$data['end_date'] = $end_date;
		}

/**********************search*************************************/
		$where_clause  = substr($where_clause, 0, -4);
		$Custom_where_clause  = substr($Custom_where_clause, 0, -4);
		
		if($this->session->userdata('hideBadRecords') != '' && $status=='Settlement')
		{
			$hideBadRecords = $this->session->userdata('hideBadRecords');
			$where_clause .= ' AND `gatewayTransactionId` not in (select `originalGatewayTransactionId` from '.$this->table.' where '.$Custom_where_clause.' and (status = "Refund" or status = "Chargeback") and originalGatewayTransactionId!="")';
			$data['hideBadRecords'] = $hideBadRecords;
		}		
		$total_rows = $this->common_model->countAll($this->table,$where_clause);
		$query = $this->common_model->get_all_records($this->table, $where_clause,$order_by_fld,$order_by,$offset,$limit);
		if($where_clause!=''){
			$data['queryTotalPrice'] = $this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause)->row()->sum;
		}else{
			$data['queryTotalPrice'] = $this->db->query('SELECT sum(grossPrice) as sum from '.$this->table)->row()->sum;
		}
		$data['total_rows'] = $total_rows;
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
		
		//$companyIDName = $this->db->query("Select distinct(companyID) from t_gateway order by companyID ASC");
		$companyIDName = $this->db->query("Select distinct(companyID) from ".$this->table." order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
		$gateway = $this->db->query("Select distinct(gatewayID) from  t_midmaster where visibility='Y' order by gatewayID ASC");
		$data['gateway'] = $gateway;
		
		$data['order_by_fld'] = $order_by_fld;
		$data['order_by'] = $order_by;
		$this->load->view($this->viewfolder.'list',$data);
	}


	public function edit() {
		$message = '';
		$id = $this->uri->segment(3);
		/*echo $id;
		exit;*/
		$row = $this->common_model->Retrive_Record($this->table,$id);
		$data = array();
		$data['query'] = $row ;
		$data['message'] = $message;
	
		$this->load->view($this->viewfolder.'/edit',$data);
	}
	function update() {
		$message_empty = '';
		$data = array();
		$id= $this->input->post('id');
		$row['validated'] = $this->input->post('validated') ;
		$row['rating'] = $this->input->post('rating') ;
		$row['comment'] = $this->input->post('comment') ;
		$row['qc_agentID'] = $this->session->userdata('ADMIN_ID');
		$row['qc_Date'] = date('Y-m-d H:i:s') ;
		//$row['status'] = $this->input->post('status') ;

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
		$row['validated'] = $value;
		$row['qc_agentID'] = $this->session->userdata('ADMIN_ID');
		$row['qc_Date'] = date('Y-m-d H:i:s') ;

		$this->db->where('id', $id);
		$this->db->update($this->table, $row);
		echo 'success';
	}	// end ofchange_is_active
	public function change_trans_type(){
		$id = $this->input->post('id') ; 
		$value = $this->input->post('val') ;
		$row = $this->common_model->Retrive_Record($this->table,$id);
		//$where_clause .= "status = '%$status%' AND ";
		$row_gateway = $this->common_model->Retrive_Record_By_Where_Clause('t_midmaster',"gatewayID like '%".$row['gatewayID']."%'");
		if($row_gateway['gatewayType']=='nmi'){
			include_once($_SERVER['DOCUMENT_ROOT'].'/system/refunds/'.$row_gateway['programName']);
			$gw = new gwapi;
			$gw->setLogin($row_gateway['username'],$row_gateway['password']);
			if($value == 'Void'){
				$gw->doVoid($row['gatewayTransactionId']);
			}
			if($value == 'Refund'){
				$gw->doRefund($row['gatewayTransactionId']);
			}
			$str = $gw->responses['response'];
		}

		//exit;
		/*$data = array();
		$data['row'] = $row ;*/
		unset($row['id']);
		unset($row['rec_crt_date']);
		unset($row['status']);
		$row['status'] = $value;
		array_push($row['status']);
		//print_r($row);		
		if($value == 'Refund'){
			$insert_id = $this->common_model->addRecord($this->table,$row);
		}
		//exit;
		$row = array();
		$row['status'] = $value;
		$row['qc_agentID'] = $this->session->userdata('ADMIN_ID');
		$row['qc_Date'] = date('Y-m-d H:i:s') ;

		$this->db->where('id', $id);
		$this->db->update($this->table, $row);
		
		echo 'success';
	}
	
	public function sent_mails(){
		error_reporting('E_ALL');
		$where_clause = "";
		$where_clause1 = "1 AND ";
		$subject=$this->input->post('msg_subject');
		$message=$this->input->post('message');
		$hideBadRecords=$this->input->post('hideBadRecords');
		$emailTemplate=$this->input->post('emailTemplate');
		/*print_r($_POST);
		exit;*/
		$data = array();
		$order_by_fld = 'id';
		$order_by =	'DESC';
		$offset = '';
		$limit = '';
		//$where_clause = "";
		$data['id'] = '';		
		$data['companyID'] = '';
		$data['gatewayName'] = '';
		$data['directory'] = '';
		$data['programName'] = '';
		$data['decriptor'] = '';
		$data['status'] = '';
		$data['validated'] = '';
		
		$this->session->set_userdata('gatewayName', $this->input->post('gatewayName'));	
		$this->session->set_userdata('status', $this->input->post('status'));		
		$this->session->set_userdata('companyID', $this->input->post('companyID'));
		$this->session->set_userdata('start_date', $this->input->post('start_date'));
		if($this->input->post('start_date')!=$this->input->post('end_date')){
			$this->session->set_userdata('end_date', $this->input->post('end_date'));
		}else{
			$this->session->set_userdata('end_date', '');
		}		
		if($this->session->userdata('companyID') != '')
		{
			$companyID = $this->session->userdata('companyID');
			$where_clause .= "companyID LIKE '%$companyID%' AND ";
			$where_clause1 .= "companyID LIKE '%$companyID%' AND ";
			$data['companyID'] = $companyID;
		}
		if($this->session->userdata('gatewayName') != '')
		{
			$gatewayName = $this->session->userdata('gatewayName');
			$where_clause .= "gatewayID LIKE '%$gatewayName%' AND ";
			$data['gatewayName'] = $gatewayName;
		}		
		/*if($this->session->userdata('status') != '')
		{
			
			$status = $this->session->userdata('status');
			foreach($status as $val){
				$where_status_clause .= "status like '%".$val."%' OR ";
				//$where_clause .= "status like '%$status%' AND ";
			}
			$where_clause .="(";
			$where_clause .= substr($where_status_clause, 0, -3);
			$where_clause .=") AND ";			
			
			$data['status'] = $status;
		}*/
		if($this->session->userdata('status') != '')
		{
			$status = $this->session->userdata('status');
			$where_clause .= "status LIKE '%".$status."%' AND ";
			$data['status'] = $status;
		}
		if($this->session->userdata('grossPrice') != '')
		{
			$grossPrice = $this->session->userdata('grossPrice');
			$where_clause .= "grossPrice >= ".$grossPrice." AND ";
			//$where_clause1 .= "grossPrice >= ".$grossPrice." AND ";
			$data['grossPrice'] = $grossPrice;
		}		
		if($this->session->userdata('paymentType') != '')
		{
			$paymentType = $this->session->userdata('paymentType');
			$where_clause .= "paymentType = '".$paymentType."' AND ";
			$where_clause1 .= "paymentType = '".$paymentType."' AND ";
			$data['paymentType'] = $paymentType;
		}		
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') != '')
		{
			$start_date = $this->session->userdata('start_date');
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$where_clause1 .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$data['start_date'] = $start_date;
		}
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') == '')
		{
			$start_date = $this->session->userdata('start_date');
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			//$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND `rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND";
			//$where_clause1 .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND `rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND";		
			$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$where_clause1 .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$data['start_date'] = $start_date;
		}
		
		if($this->session->userdata('end_date') != '')
		{
			$end_date = $this->session->userdata('end_date');
			$parts = explode('-',$end_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];			
			$where_clause .= "`rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND ";
			$where_clause1 .= "`rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND ";
			$data['end_date'] = $end_date;
		}
		$where_clause  = substr($where_clause, 0, -4);
		$where_clause1  = substr($where_clause1, 0, -4);
		if($where_clause!='')
		
		$this->db->where($where_clause);		//$this->db->select('id,companyID,gatewayID,rec_crt_date,customer_name,customer_phone,customer_email,customer_state,product_name,productDuration, grossPrice,cardType');
		$this->db->select('*');
		$this->db->from($this->table);
		$query = $this->db->get();
		if($status=='Settlement' && $hideBadRecords == 1){
			$query = $this->db->query('SELECT * FROM `t_invoice` WHERE '.$where_clause.' and `gatewayTransactionId` not in (select `originalGatewayTransactionId` from t_invoice where '.$where_clause1.' and (status = "Refund" or status = "Chargeback")  and originalGatewayTransactionId!="" ) order by customer_name asc ');
		}
		/*echo $this->db->last_query();
		exit;*/
		$newTollFreeNo = $this->db->query('SELECT newTollFreeNo FROM t_system_settings WHERE `id` = 1')->row()->newTollFreeNo;
		if ($query->num_rows() == 0) {
			echo '<p>The table appears to have no data.</p>';
		} 
		else {
			$pieceEmail="";
			if($this->session->userdata('selectedEmails1') != '')
			{
				$selectedEmails1 = $this->session->userdata('selectedEmails1');					
				$pieceEmail=explode(",",$selectedEmails1);
			}
			foreach ($query->result() as $row) {
/*********Initialization********************/
					$fetchedCompanyID =  "";
					$company_phonenumber	="";
					$Gorad_Billing_Number	="";
					$company_email			="";
					$Gorad_email			="";
					$company_name		    = "";
					$ICustomerID		    = "";
					$ProductId		    	= "";
					$gateway_descriptor		= "";
					$CreatedDAte			= "";
					$productDuration		= "";
					$PaymentType 	= "";
					$RoutingNumber	= "";
					$AccountNumber	= "";
					$BankName		= "";
					$CheckDate		= "";
					$CheckNumber	= "";
					$CheckMemo		= "";
					$securityProtection	=	"";
					$totalDevices		=	"";	
					$date				=	"";	
					$cardtype		= "";
					$cardnumber		= "";
					$ip  			= "";
					$agent_name         = "";
					$unique_pin         = "";
					$sign               = "";
					$orderid		    = "";
					$product_id 		= "";
					$product_name 		= "";
					$product_price 		= "";
					$SupscriptionPeriod	= "";
					$email 		= "";
					$phone 		= "";
					$name       = "";
					$fullname   = "";
					$fname 		= "";
					$lname   	= "";
					$address 	= "";
					$state 		= "";
					$city 		= "";
					$zip 		= "";
					$country 	= "";
					$agentID 	= "";
					$agent_name 	= "";
					$gatewayID 	= "";			
/*******************************************/
				//print_r($row);
				$fetchedCompanyID = $row->companyID;
				$rowCenter = $this->db->query("SELECT * FROM t_centerdb WHERE `companyID` = '".$fetchedCompanyID."'")->row_array();
				/************************************Creating Variables*********************************/
					$company_phonenumber	=$rowCenter['company_phonenumber'];
					$Gorad_Billing_Number	=$rowCenter['Gorad_Billing_Number'];
					$company_email			=$rowCenter['company_email'];
					$Gorad_email			=$rowCenter['Gorad_email'];
					$company_name		    = $rowCenter['company_name'];
					$ICustomerID		    = $row->customerId;
					$ProductId		    	= $row->productId;
					$gateway_descriptor		= $row->gateway_descriptor;
					$CreatedDAte			= $row->rec_crt_date;
					$productDuration		= $row->productDuration;
					/************************Echeque Payments****************/
					$PaymentType 	= $row->paymentType;
					$RoutingNumber	= $row->RoutingNumber;
					$AccountNumber	= $row->AccountNumber;
					$BankName		= $row->BankName;
					$CheckDate		= $row->CheckDate;
					$CheckNumber	= $row->CheckNumber;
					$CheckMemo		= $row->CheckMemo;
					/********************New Custom Fields*******************/
					$securityProtection	=	$row->securityProtection;
					$totalDevices		=	$row->totalDevices;	
					$date				=	$row->rec_crt_date;	
					/********************************************************/	
					$cardtype		= $row->cardType;
					$cardnumber		= $row->cardNo;
					$ip  			= $row->ip;
					$agent_name         = $row->agent_name;
					$unique_pin         = $row->customerId;
					$sign               = $row->sign;
					///////////////////////  Order Information  ////////////////////
					$orderid		    = $row->invoice_id;
					$product_id 		= $row->productId;
					$product_name 		= $row->product_name;
					$product_price 		= $row->grossPrice;
					$SupscriptionPeriod	= $row->productDuration/30;
					if( floor($SupscriptionPeriod) == 0) {
						$SupscriptionPeriod	= 'One time';
					}
					if( floor($SupscriptionPeriod) > 0) {
						$SupscriptionPeriod	= floor($SupscriptionPeriod).' months' ;
					}
					/////////////////  Billing Information   //////////////////////
					$email 		= $row->customer_email;
					$phone 		= $row->customer_phone;
					$name       = $row->customer_name;
					$fullname   = explode(" ", $name);
					$fname 		= $fullname[0];
					$lname   	= $fullname[1].' '.$fullname[2].' '.$fullname[3].' '.$fullname[4];
					$address 	= htmlspecialchars ($row->customer_address);
					$state 		= $row->customer_state;
					$city 		= htmlspecialchars ($row->customer_city);
					$zip 		= $row->customer_zip;
					$country 	= $row->customer_country;
					/////////////////  Card Information   //////////////////////
					$agentID 	= $row->agentID;
					$agent_name 	= $row->agent_name;
					$gatewayID 	= $row->gatewayID;				
				/************************************Creating Emails*************************************/
				
				//require_once($this->config->item('company_base_url').'emailRoutines');
					require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/email_function.php");
					
					$time = time();
					require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."dompdf/dompdf_config.inc.php");
					require_once ($_SERVER['DOCUMENT_ROOT'].'/system/utils/signature-to-image.php');
					////////////  Generating Image From E-Sign  /////////////////////
					$img = sigJsonToImage($sign);
					imagepng($img, $time.'.png');
					$img =  $time.'.png';
					
					if($emailTemplate==2){
						require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/pdf_template_new.php");								require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/order_email_template1.php");
					}
					if($emailTemplate==3){
						require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/feedback_email_template.php");
					}
					if($emailTemplate==1){
						require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/welcome_email_template.php");
					}
					//echo $_SERVER['DOCUMENT_ROOT'].'/system/'."email/New_Support_Phone_Number.php";
					if($emailTemplate==5){
						require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/refund_pdf_template.php");
						require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/refund_email_template1.php");
					}
					if($emailTemplate==4){
						require_once($_SERVER['DOCUMENT_ROOT'].'/system/email/New_Support_Phone_Number.php');
					}
//echo 'ok1';		
					if($emailTemplate==2 || $emailTemplate==5){
						$dompdf = new DOMPDF();
						$dompdf->load_html($pdf_html);
						$dompdf->render();
						file_put_contents($time.'.pdf', $dompdf->output());
					}
					//$email='dasgupta.rony@gmail.com';
					//echo $orderwelcome;
					//$orderwelcome1 ="This is test";
					if($emailTemplate==2){
						mail_file_attach( $email, 'Thank you for your purchase from '.$company_name.'!', $orderwelcome, $company_email, $time.'.pdf','','' );
					}
					if($emailTemplate==1){
						mail_smtp($email,'Welcome to '.$gateway_descriptor.'',$welcomeHtml,$company_email,$Gorad_email,"");
					}
					if($emailTemplate==3){
						mail_smtp($email,'Feedback and Authorization Email',$feedbackhtml,$company_email,$Gorad_email,"");	
					}
					if($emailTemplate==5){
						mail_file_attach( $email, 'Refund Confirmation', $orderwelcome, $company_email, $time.'.pdf',"","" );
					}
					if($emailTemplate==4){
						mail_smtp($email,'New Technical Support Phone Number '.$newTollFreeNo.'',$New_Support_Phone_Number,$company_email,$Gorad_email,"");	
					}
					unlink($time.'.pdf');
					unlink($time.'.png');
				/***************************************************************************************/
				//print_r($rowCenter);
				/*echo $row->customer_name.','.$row->customer_email.'<br/>';
				$this->load->library('email');
				$this->email->from($this->config->item('company_email'), $this->config->item('company_name'));
				$this->email->to($row->customer_email);
				$this->email->subject($subject);
				$this->email->set_mailtype("html");
				
				//$msg = 'Dear '.$row->customer_name.'<br/>';
				$msg = $message;
				require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/mass_email.php");
				$this->email->message($welcomeHtml);
				if(is_array($pieceEmail)){
					if(in_array($row->id,$pieceEmail)){
						$this->email->send();
					}
				}
				else{
					$this->email->send();
				}*/
			}
		}
		$message = setMessage('Email sent successfully.',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));		
	}
	/******************************Spreadsheet Download**********************************/
	public function download(){
		$where_clause = "";
		$where_clause1 = "1 AND ";
		$subject=$this->input->post('msg_subject');
		$message=$this->input->post('message');
		$hideBadRecords=$this->input->post('hideBadRecords');
		$emailTemplate=$this->input->post('emailTemplate');
		$data = array();
		$order_by_fld = 'id';
		$order_by =	'DESC';
		$offset = '';
		$limit = '';
		$data['id'] = '';		
		$data['companyID'] = '';
		$data['gatewayName'] = '';
		$data['directory'] = '';
		$data['programName'] = '';
		$data['decriptor'] = '';
		$data['status'] = '';
		$data['validated'] = '';
		
		$this->session->set_userdata('gatewayName', $this->input->post('gatewayName'));	
		$this->session->set_userdata('status', $this->input->post('status'));		
		$this->session->set_userdata('companyID', $this->input->post('companyID'));
		$this->session->set_userdata('start_date', $this->input->post('start_date'));
		if($this->input->post('start_date')!=$this->input->post('end_date')){
			$this->session->set_userdata('end_date', $this->input->post('end_date'));
		}else{
			$this->session->set_userdata('end_date', '');
		}		
		if($this->session->userdata('companyID') != '')
		{
			$companyID = $this->session->userdata('companyID');
			$where_clause .= "companyID LIKE '%$companyID%' AND ";
			$where_clause1 .= "companyID LIKE '%$companyID%' AND ";
			$data['companyID'] = $companyID;
		}
		if($this->session->userdata('gatewayName') != '')
		{
			$gatewayName = $this->session->userdata('gatewayName');
			$where_clause .= "gatewayID LIKE '%$gatewayName%' AND ";
			$data['gatewayName'] = $gatewayName;
		}		

		if($this->session->userdata('status') != '')
		{
			$status = $this->session->userdata('status');
			$where_clause .= "status LIKE '%".$status."%' AND ";
			$data['status'] = $status;
		}
		if($this->session->userdata('grossPrice') != '')
		{
			$grossPrice = $this->session->userdata('grossPrice');
			$where_clause .= "grossPrice >= ".$grossPrice." AND ";
			//$where_clause1 .= "grossPrice >= ".$grossPrice." AND ";
			$data['grossPrice'] = $grossPrice;
		}		
		if($this->session->userdata('paymentType') != '')
		{
			$paymentType = $this->session->userdata('paymentType');
			$where_clause .= "paymentType = '".$paymentType."' AND ";
			$where_clause1 .= "paymentType = '".$paymentType."' AND ";
			$data['paymentType'] = $paymentType;
		}		
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') != '')
		{
			$start_date = $this->session->userdata('start_date');
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$where_clause1 .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$data['start_date'] = $start_date;
		}
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') == '')
		{
			$start_date = $this->session->userdata('start_date');
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$where_clause1 .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$data['start_date'] = $start_date;
		}
		
		if($this->session->userdata('end_date') != '')
		{
			$end_date = $this->session->userdata('end_date');
			$parts = explode('-',$end_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];			
			$where_clause .= "`rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND ";
			$where_clause1 .= "`rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND ";
			$data['end_date'] = $end_date;
		}
		$where_clause  = substr($where_clause, 0, -4);
		$where_clause1  = substr($where_clause1, 0, -4);
		if($where_clause!='')
		
		$this->db->where($where_clause);		
		$this->db->select('*');
		$this->db->from($this->table);
		$query = $this->db->get();
		if($status=='Settlement' && $hideBadRecords == 1){
			$query = $this->db->query('SELECT * FROM `t_invoice` WHERE '.$where_clause.' and `gatewayTransactionId` not in (select `originalGatewayTransactionId` from t_invoice where '.$where_clause1.' and (status = "Refund" or status = "Chargeback") and originalGatewayTransactionId!="" ) order by customer_name asc ');
		}
		/*echo $this->db->last_query();
		exit;*/
		$newTollFreeNo = $this->db->query('SELECT newTollFreeNo FROM t_system_settings WHERE `id` = 1')->row()->newTollFreeNo;
		/*if ($query->num_rows() == 0) {
			echo '<p>The table appears to have no data.</p>';
		} 
		else {
			$pieceEmail="";
			if($this->session->userdata('selectedEmails1') != '')
			{
				$selectedEmails1 = $this->session->userdata('selectedEmails1');					
				$pieceEmail=explode(",",$selectedEmails1);
			}
			foreach ($query->result() as $row) {
				print_r($row);
			}
		}*/
		/****************************Preparing Excel******************************/
		$data = ''; // just creating the var for field data to append to below
		$obj =& get_instance();

		require_once APPPATH .'third_party/PHPExcel/Classes/PHPExcel.php';		
		$objPHPExcel = new PHPExcel();
		
		$sheet = $objPHPExcel->getActiveSheet();
		$sheet->getColumnDimension('A')->setWidth(30);
		$sheet->getColumnDimension('B')->setWidth(20);
		$sheet->getColumnDimension('C')->setWidth(20);
		$sheet->getColumnDimension('D')->setWidth(20);
		$sheet->getColumnDimension('E')->setWidth(20);
		$sheet->getColumnDimension('F')->setWidth(20);
		$sheet->getColumnDimension('G')->setWidth(20);
		$sheet->getColumnDimension('H')->setWidth(20);
		$sheet->getColumnDimension('I')->setWidth(20);
		$sheet->getColumnDimension('J')->setWidth(20);
		$sheet->getColumnDimension('K')->setWidth(20);
		
       
	   $objPHPExcel->getProperties()->setTitle("Download")->setDescription("none");
 
        $objPHPExcel->setActiveSheetIndex(0);
		
		$border_style= array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THICK,'color' => array('rgb' => '0000CD'),)));
		
		$border_style1= array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THICK,'color' => array('rgb' => '4169E1'),)));
		$sheet->getStyle("A1:K1")->applyFromArray($border_style);
		$sheet->getStyle("A2:K2")->applyFromArray($border_style);
		
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Fetched Records');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->mergeCells('A1:K1');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

		if ($query->num_rows() == 0) {
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'No Records Found');
			$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(20);
			$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->mergeCells('A2:K2');
			$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		} 
		else {			
			$pieceEmail="";
			if($this->session->userdata('selectedEmails1') != '')
			{
				$selectedEmails1 = $this->session->userdata('selectedEmails1');					
				$pieceEmail=explode(",",$selectedEmails1);
			}
			/****************************Headers*****************************/
			$rowCount = 2;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$rowCount, 'Crt Date');
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$rowCount, 'Update Date');
			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowCount)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);			
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$rowCount, 'Center');
			$objPHPExcel->getActiveSheet()->getStyle('C'.$rowCount)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$rowCount, 'Gateway');
			$objPHPExcel->getActiveSheet()->getStyle('D'.$rowCount)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$rowCount, 'Customer Name');
			$objPHPExcel->getActiveSheet()->getStyle('E'.$rowCount)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('E'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);			
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$rowCount, 'Email');
			$objPHPExcel->getActiveSheet()->getStyle('F'.$rowCount)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('F'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);			
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$rowCount, 'Phone');
			$objPHPExcel->getActiveSheet()->getStyle('G'.$rowCount)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('G'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);			
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$rowCount, 'Product');
			$objPHPExcel->getActiveSheet()->getStyle('H'.$rowCount)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('H'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);			
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$rowCount, 'Duration');
			$objPHPExcel->getActiveSheet()->getStyle('I'.$rowCount)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('I'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);			
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$rowCount, 'Price');
			$objPHPExcel->getActiveSheet()->getStyle('J'.$rowCount)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('J'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);			
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$rowCount, 'Staus');
			$objPHPExcel->getActiveSheet()->getStyle('K'.$rowCount)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('K'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			
			$rowCount ++;			
			/***************************************************************/
			foreach ($query->result() as $row) {
				//print_r($row);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$rowCount, date( 'M d,Y',strtotime($row->rec_crt_date)));
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);				
				
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$rowCount, date( 'M d,Y',strtotime($row->rec_up_date)));
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowCount)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);				
				
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$rowCount, $row->companyID);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowCount)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);				
				
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$rowCount, $row->gatewayID);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowCount)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);				
				
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$rowCount, $row->customer_name);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowCount)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('E'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);				
				
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$rowCount, $row->customer_email);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowCount)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('F'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);				
				
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$rowCount, $row->customer_phone);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowCount)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);				
				
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$rowCount, $row->product_name);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowCount)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('H'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);				
				
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$rowCount, $row->productDuration);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowCount)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('I'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);				
				
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$rowCount, $row->grossPrice);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowCount)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('J'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);				
				
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$rowCount, $row->status);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowCount)->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('K'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$rowCount ++;
			}
		}
		$objPHPExcel->setActiveSheetIndex(0);						  
		 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=fetched_records.xls");
		ob_end_clean();
		$objWriter->save('php://output');
		
		/*************************************************************************/
		
		/*$message = setMessage('Email sent successfully.',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));	*/	
	}	
	/************************************************************************************/
	public function saveEmailId(){
		$val	=	$this->input->post('val');
		$this->session->set_userdata('selectedEmails1', $val);
	}
}?>








