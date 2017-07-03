<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Chargebacks extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html','file'));
		$this->load->library(array('session','authentication','form_validation','email','upload','image_lib','pagination'));
		$this->load->model(array('common_model'));
		$this->tableCenter = 't_merchant';
		$this->table = 't_invoice';
		$this->viewfolder = 'chargebacks/';
		$this->controllerFile = 'chargebacks/';
		$this->namefile = 'chargebacks';
	}
	public function index() {
		$message = '';
		$data = array();
		$order_by_fld = 'id';
		$order_by =	'DESC';
		$offset = (int)$this->uri->segment(3,0);
		$limit = 20;
		//echo $this->input->post('status');
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
		//$where_clause = "gatewayTransactionId !=  '' AND ";
		$where_clause = "status like '%Chargeback%' AND";
		$data['id'] = '';		
		$data['companyID'] = '';
		$data['gatewayName'] = '';
		$data['directory'] = '';
		$data['programName'] = '';
		$data['decriptor'] = '';
		$data['status'] = '';
		$data['start_date'] = '';
		$data['end_date'] = '';
		$data['fname'] = '';
		$data['lname'] = '';
		//print_r($_POST);
		if($this->uri->segment(3) == '' && $this->uri->segment(2)!='index')
		{
			$this->session->set_userdata('id', '');			
			$this->session->set_userdata('companyID', '');
			$this->session->set_userdata('gatewayName', '');
			$this->session->set_userdata('directory', '');
			$this->session->set_userdata('programName', '');
			$this->session->set_userdata('decriptor', '');
			$this->session->set_userdata('status', '');
			$this->session->set_userdata('start_date', '');
			$this->session->set_userdata('end_date', '');
			
			$this->session->set_userdata('fname', '');
			$this->session->set_userdata('lname', '');
			$this->session->set_userdata('customer_phone', '');
			$this->session->set_userdata('customer_email', '');
			$this->session->set_userdata('cardNo', '');
			
			$this->session->set_userdata('gatewayTransactionId', '');
			$this->session->set_userdata('invoice_id', '');
			$this->session->set_userdata('paymentType', '');
			$this->session->set_userdata('cardType', '');
		}
		if($this->input->post('search')!= '')
		{
			
			$this->session->set_userdata('id', $this->input->post('id'));			
			$this->session->set_userdata('companyID', $this->input->post('companyID'));
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
			$this->session->set_userdata('fname', $this->input->post('fname'));
			$this->session->set_userdata('lname', $this->input->post('lname'));
			$this->session->set_userdata('customer_phone', $this->input->post('customer_phone'));
			$this->session->set_userdata('customer_email', $this->input->post('customer_email'));
			$this->session->set_userdata('cardNo', $this->input->post('cardNo'));
			
			$this->session->set_userdata('gatewayTransactionId', $this->input->post('gatewayTransactionId'));
			$this->session->set_userdata('invoice_id', $this->input->post('invoice_id'));
			$this->session->set_userdata('paymentType', $this->input->post('paymentType'));
			$this->session->set_userdata('cardType', $this->input->post('cardType'));
		}
		if($this->session->userdata('gatewayTransactionId') != '')
		{
			$gatewayTransactionId = $this->session->userdata('gatewayTransactionId');
			$where_clause .= "gatewayTransactionId LIKE '%".addslashes($gatewayTransactionId)."%' AND ";
			$data['gatewayTransactionId'] = $gatewayTransactionId;
		}
		if($this->session->userdata('invoice_id') != '')
		{
			$invoice_id = $this->session->userdata('invoice_id');
			$where_clause .= "invoice_id LIKE '%".addslashes($invoice_id)."%' AND ";
			$data['invoice_id'] = $invoice_id;
		}
		if($this->session->userdata('paymentType') != '')
		{
			$paymentType = $this->session->userdata('paymentType');
			$where_clause .= "paymentType LIKE '%$paymentType%' AND ";
			$data['paymentType'] = $paymentType;
		}
		if($this->session->userdata('cardType') != '')
		{
			$cardType = $this->session->userdata('cardType');
			$where_clause .= "cardType LIKE '%$cardType%' AND ";
			$data['cardType'] = $cardType;
		}
		if($this->session->userdata('companyID') != '')
		{
			$companyID = $this->session->userdata('companyID');
			$where_clause .= "companyID LIKE '%$companyID%' AND ";
			$data['companyID'] = $companyID;
		}
		/*if($this->session->userdata('customer_name') != '')
		{
			$customer_name = $this->session->userdata('customer_name');
			$where_clause .= "customer_name LIKE '%".addslashes($customer_name)."%' AND ";
			$data['customer_name'] = $customer_name;
		}*/
		if($this->session->userdata('fname') != '')
		{
			$fname = $this->session->userdata('fname');
			$where_clause .= "fname LIKE '%".addslashes($fname)."%' AND ";
			$data['fname'] = $fname;
		}		
		if($this->session->userdata('lname') != '')
		{
			$lname = $this->session->userdata('lname');
			$where_clause .= "lname LIKE '%".addslashes($lname)."%' AND ";
			$data['lname'] = $lname;
		}		
		if($this->session->userdata('customer_phone') != '')
		{
			$customer_phone = $this->session->userdata('customer_phone');
			$where_clause .= "customer_phone LIKE '%".addslashes($customer_phone)."%' AND ";
			$data['customer_phone'] = $customer_phone;
		}
		if($this->session->userdata('customer_email') != '')
		{
			$customer_email = $this->session->userdata('customer_email');
			$where_clause .= "customer_email LIKE '%".addslashes($customer_email)."%' AND ";
			$data['customer_email'] = $customer_email;
		}
		if($this->session->userdata('cardNo') != '')
		{
			$cardNo = $this->session->userdata('cardNo');
			$where_clause .= "cardNo LIKE '%".addslashes($cardNo)."' AND ";
			$data['cardNo'] = $cardNo;
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
			$where_clause .= "status like '%$status%' AND ";
			$data['status'] = $status;
		}
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') != '')
		{
			$start_date = $this->session->userdata('start_date');
			$end_date = $this->session->userdata('end_date');
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			
			
			$end_parts = explode('-',$end_date);
			$yyyy_mm_dd1 = $end_parts[2] . '-' . $end_parts[0] . '-' . $end_parts[1];
			
			//$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$where_clause .= "(
				(
					rec_crt_date >=  '".$yyyy_mm_dd." 00:00:00'
					AND rec_crt_date <=  '".$yyyy_mm_dd1." 23:59:59'
				)
				OR (
					rec_up_date >=  '".$yyyy_mm_dd." 00:00:00'
					AND rec_up_date <=  '".$yyyy_mm_dd1." 23:59:59'
				)
			) AND";
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
		}
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') == '')
		{
			$start_date = $this->session->userdata('start_date');
			//echo $start_date;
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			//$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND `rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND";
			$where_clause .= "(
				(
					rec_crt_date >=  '".$yyyy_mm_dd." 00:00:00'
					AND rec_crt_date <=  '".$yyyy_mm_dd." 23:59:59'
				)
				OR (
					rec_up_date >=  '".$yyyy_mm_dd." 00:00:00'
					AND rec_up_date <=  '".$yyyy_mm_dd." 23:59:59'
				)
			) AND";
			$data['start_date'] = $start_date;
		}
		
		if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') != '')
		{
			$end_date = $this->session->userdata('end_date');
			$parts = explode('-',$end_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];			
			
			//$where_clause .= "`rec_crt_date` <= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$where_clause .= "(
				(
					rec_crt_date <=  '".$yyyy_mm_dd." 23:59:59'
				)
				OR (
					rec_up_date <=  '".$yyyy_mm_dd." 23:59:59'
				)
			) AND";
			$data['end_date'] = $end_date;
		}

/**********************search*************************************/
		$where_clause  = substr($where_clause, 0, -4);
		$total_rows = $this->common_model->countAll($this->table,$where_clause);
		$query = $this->common_model->get_all_records($this->table, $where_clause,$order_by_fld,$order_by,$offset,$limit);
		//echo $this->db->last_query();
		if($where_clause!=''){
			$data['queryTotalPrice'] = $this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause)->row()->sum;
		}else{
			$data['queryTotalPrice'] = $this->db->query('SELECT sum(grossPrice) as sum from '.$this->table)->row()->sum;
		}
		$data['total_rows'] = $total_rows;
		$data['where_clause']=$where_clause;
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
		
		$companyIDName = $this->db->query("Select distinct(companyID) from ".$this->tableCenter." where visibility='Y' order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
		$gateway = $this->db->query("Select distinct(gatewayID) from  t_midmaster where visibility='Y' order by gatewayID ASC");
		$data['gateway'] = $gateway;
		$cardTypeName = $this->db->query("Select distinct(cardType) from ".$this->table." where cardType!='' order by cardType ASC ");
		$data['cardTypeName'] = $cardTypeName;
		
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
		$this->db->where('id', $id);
		$this->db->update($this->table, $row);
		echo 'success';
	}	// end ofchange_is_active
	public function change_trans_type(){
		date_default_timezone_set('US/Eastern');
		$id = $this->input->post('id') ; 
		$value = $this->input->post('val') ;
		$recDate = $this->input->post('recDate') ;
		if($recDate!=""){
			$newRecDate = explode("-", $recDate);
			
			$recDate = $newRecDate[2].'-'.$newRecDate[0].'-'.$newRecDate[1];
		}
				
		$row = $this->common_model->Retrive_Record($this->table,$id);
		$originalGatewayTransactionId = $row['originalGatewayTransactionId'];

		/*$row_center = $this->common_model->Retrive_Record_By_Where_Clause('".$this->tableCenter."',"companyID like '%".$row['companyID']."%'");
		
		$config['hostname'] = $row_center['db_host'];
		$config['username'] = $row_center['db_username'];
		$config['password'] = $row_center['db_password'];
		$config['database'] = $row_center['db_name'];
		$config['dbdriver'] = "mysql";
		$config['dbprefix'] = "";
		$config['pconnect'] = FALSE;
		$config['db_debug'] = TRUE;
		$config['cache_on'] = FALSE;
		$config['cachedir'] = "";
		$config['char_set'] = "utf8";
		$config['dbcollat'] = "utf8_general_ci";

		
		
		$this->DB2=$this->load->database($config, TRUE);*/
		
		if($recDate==""){
			$rowInv['rec_crt_date'] = date("Y-m-d H:i:s");
			$rowMast['rec_crt_date'] = date("Y-m-d H:i:s");
			$rowInv['rec_up_date'] = date("Y-m-d H:i:s");
		}else{
			$rowInv['rec_crt_date'] = $recDate;
			$rowMast['rec_crt_date'] = $recDate;
			$rowInv['rec_up_date'] = $recDate;
		}			

		$rowMast['qc_agentID']=$this->session->userdata('ADMIN_NAME');
		$rowMast['qc_Date']=date('Y-m-d H:i:s');		
		$rowInv['qc_agentID']=$this->session->userdata('ADMIN_NAME');
		$rowInv['qc_Date']=date('Y-m-d H:i:s');			
		/*$this->db->where('originalGatewayTransactionId', $originalGatewayTransactionId);
		$update=$this->db->update("t_master_success", $rowMast);*/			
		
		$this->db->where('originalGatewayTransactionId', $originalGatewayTransactionId);
		$update1=$this->db->update("t_invoice", $rowInv);			

		if($update==1){
			echo 'success';
		}
	}
	
	
}




