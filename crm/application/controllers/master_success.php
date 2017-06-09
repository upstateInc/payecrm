<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Master_success extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html','file'));
		$this->load->library(array('session','authentication','form_validation','email','upload','image_lib','pagination'));
		$this->load->model(array('common_model'));

		$this->table = 't_invoice';
		$this->viewfolder = 'master_success/';
		$this->controllerFile = 'master_success/';
		$this->namefile = 'master_success';
		$this->tableCenter = 't_centerdb';
		$this->tableCenterGroup = 't_centerGroup';
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
		$where_clause = "";
		$where_clause1 = "";
		$where_clause2 = "";
		$data['id'] = '';		
		$data['companyID'] = '';
		$data['gatewayName'] = '';
		$data['directory'] = '';
		$data['programName'] = '';
		$data['decriptor'] = '';
		$data['status'] = '';
		//print_r($_POST);
		if($this->session->userdata('ADMIN_GROUP_ID')!=""){
			$where_clause .= '( ';
			$where_clause1 .= '( ';
			$centerquery = $this->common_model->get_all_records($this->tableCenterGroup, 'groupId = '.$this->session->userdata('ADMIN_GROUP_ID').'', 'id', 'ASC','','');
			
			foreach($centerquery->result() as $row){
				$new_where_clause .= "companyID = '".$row->companyID."' OR ";
			}
			$where_clause  .= substr($new_where_clause, 0, -3);
			$where_clause1  .= substr($new_where_clause, 0, -3);
			$where_clause .= ' ) AND ';
			$where_clause1 .= ' ) AND ';
		}		
		if($this->session->userdata('ADMIN_NOMINEEID')!=""){
			$where_clause .= '( ';
			$where_clause2 .= '( ';
			$midquery = $this->common_model->get_all_records('t_nomineeMid', 'nomineeID = '.$this->session->userdata('ADMIN_NOMINEEID').'', 'id', 'ASC','','');
			
			foreach($midquery->result() as $row){
				$new_where_clause .= "gatewayID = '".$row->gatewayID."' OR ";
			}
			$where_clause  .= substr($new_where_clause, 0, -3);
			$where_clause2  .= substr($new_where_clause, 0, -3);
			$where_clause .= ' ) AND ';
			$where_clause2 .= ' ) AND ';
		}		
		if($this->session->userdata('ADMIN_COMPANYID')!=""){
			$where_clause = "companyID = '".$this->session->userdata('ADMIN_COMPANYID')."' AND "; 
			$where_clause1 = "companyID = '".$this->session->userdata('ADMIN_COMPANYID')."' AND "; 
		}		
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
		
		$companyIDName = $this->db->query("Select distinct(companyID) from t_centerdb where ".$where_clause1." visibility='Y' order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
		/*if($this->session->userdata('ADMIN_GROUP_ID')=="" && $this->session->userdata('ADMIN_GROUP_ID')==""){
			$gateway = $this->db->query("Select distinct(gatewayID) from  t_gateway where ".$where_clause1." visibility='Y' order by gatewayID ASC");
		}else{*/
		$gateway = $this->db->query("Select distinct(gatewayID) from t_midmaster where ".$where_clause2." visibility='Y' order by gatewayID ASC");
		//echo $this->db->last_query();
		//}
		$data['gateway'] = $gateway;
		$cardTypeName = $this->db->query("Select distinct(cardType) from ".$this->table." where ".$where_clause1." cardType!='' order by cardType ASC ");
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
		//$id = $this->input->post('id');
		$row = $this->common_model->Retrive_Record($this->table,$id);
		$data = array();
		$data['row'] = $row ;
		$where_clause = "invoice_id='".$id."'";
		$data['product_query']=$this->db->query("select a.*, b.productName from t_cart as a left join t_product as b on a.product_id = b.id where a.invoice_id='".$id."'");
		//echo $this->db->last_query();
		echo $this->load->view($this->viewfolder.'/view',$data);
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
		$amount = $this->input->post('amount');
		$recDate = $this->input->post('recDate') ;
		if($recDate!=""){
			$newRecDate = explode("-", $recDate);
			
			$recDate = $newRecDate[2].'-'.$newRecDate[0].'-'.$newRecDate[1];
		}
		/*echo $recDate;
		exit;*/
				
		$row = $this->common_model->Retrive_Record($this->table,$id);
		$gatewayTransactionId = $row['gatewayTransactionId'];


		$row_gateway = $this->common_model->Retrive_Record_By_Where_Clause('t_midmaster',"gatewayID like '%".$row['gatewayID']."%'");
		if($row_gateway['gatewayType']=='nmi' && $value !="Chargeback"){
			include_once($_SERVER['DOCUMENT_ROOT'].'/system/refunds/'.$row_gateway['programName']);
			$gw = new gwapi;
			$gw->setLogin($row_gateway['username'],$row_gateway['password']);
			if($value == 'Void'){
				$gw->doVoid($row['gatewayTransactionId']);
			}
			if($value == 'Refund'){
				$gw->doRefund($row['gatewayTransactionId'],$amount);
			}
			if($value == 'Capture'){
				$gw->doCapture($row['gatewayTransactionId']);
				$captured_by = $this->session->userdata('ADMIN_NAME');
				$captured_date = date('Y-m-d H:i:s');							
			}			
			$str = $gw->responses['response'];
			$ssl_txn_id = $gw->responses['transactionid'];
		}
		if($row_gateway['gatewayType']=='paypal' && $value == 'Void'){
			$authorizationID=urlencode($gatewayTransactionId);
			/*include_once($_SERVER['DOCUMENT_ROOT'].'/system/merchant-sdk-php-master/samples/PaymentSettlements/DoVoid.php');
			exit;*/
			require_once($_SERVER['DOCUMENT_ROOT'].'/system/paypal_nvp/DoVoidReceipt.php');
		}		
		if($row_gateway['gatewayType']=='paypal' && $value == 'Capture'){
			$authorizationID=urlencode($gatewayTransactionId);
			$amount=urlencode($row['grossPrice']);
			$captured_by = $this->session->userdata('ADMIN_NAME');
			$captured_date = date('Y-m-d H:i:s');
			//include_once($_SERVER['DOCUMENT_ROOT'].'/system/merchant-sdk-php-master/samples/PaymentSettlements/DoCapture.php');
			require_once($_SERVER['DOCUMENT_ROOT'].'/system/paypal_nvp/DoCaptureReceipt.php');
			//require_once($_SERVER['DOCUMENT_ROOT'].'/system/paypal_nvp/abc.php');
			//echo 'ok';
			//echo $_SERVER['DOCUMENT_ROOT'].'/system/NVP/DoCaptureReceipt.php';
			//exit;
		}
		if($row_gateway['gatewayType']=='paypal' && $value == 'Refund'){
			include_once($_SERVER['DOCUMENT_ROOT'].'/system/gateways/report/paypalGetTransaction.php');
			//echo $row['grossPrice'].', '.$amount;
			if($row['grossPrice'] > $amount){				
				$refundType='Partial';
			}
			if($row['grossPrice'] == $amount)
			{
				$refundType='Full';
			}
			/*echo $refundType;
			exit;*/
			include_once($_SERVER['DOCUMENT_ROOT'].'/system/refunds/RefundPaypal.php');
			$ssl_txn_id = $aryRes['REFUNDTRANSACTIONID'];
			$value = 'Refund';
			/*echo 'ok';
			exit;*/
		}
		if($value == 'Refund'){
			$totPartialRedund=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where originalGatewayTransactionId="'.$row['gatewayTransactionId'].'" and status="Refund"')->row()->sum;
			$totalRefundLeft=$row['grossPrice']+$totPartialRedund-$amount;
			$grossPrice=0-$amount;
			unset($row['id']);
			unset($row['rec_crt_date']);
			unset($row['rec_up_date']);
			unset($row['status']);
			unset($row['grossPrice']);
			unset($row['gatewayTransactionId']);
			unset($row['locked']);
			unset($row['batch_id']);
			unset($row['reason_code']);
			unset($row['reason_descrption']);
			unset($row['validated']);
			unset($row['qc_agentID']);			
			unset($row['qc_Date']);			
			$row['locked'] = 'Y';
			$row['status'] = $value;
			$row['grossPrice'] = $grossPrice;
			$row['rec_crt_date'] = date("Y-m-d H:i:s");
			$row['rec_up_date'] = date("Y-m-d H:i:s");
			$row['gatewayTransactionId'] = $ssl_txn_id;
			$row['originalGatewayTransactionId'] = $gatewayTransactionId;
			$row['validated']='Y';
			$row['qc_agentID']=$this->session->userdata('ADMIN_NAME');
			$row['qc_Date']=date('Y-m-d H:i:s');
			
			$insert_id = $this->common_model->addRecord($this->table,$row);			
			
			
			if($totalRefundLeft==0){
				$rowMast['locked'] = "Y";
			}
			$rowMast['validated'] = "Y";
			$rowMast['qc_agentID']=$this->session->userdata('ADMIN_NAME');
			$rowMast['qc_Date']=date('Y-m-d H:i:s');			
			//$this->db->where('gatewayTransactionId', $gatewayTransactionId);
			$this->db->where('id', $id);
			$this->db->update($this->table, $rowMast);			
			
	
		}
		/*******************/
		else if($value == 'Chargeback'){
			$grossPrice=0-$row['grossPrice'];
			unset($row['id']);
			unset($row['rec_crt_date']);
			unset($row['rec_up_date']);
			unset($row['status']);
			unset($row['grossPrice']);
			unset($row['locked']);
			unset($row['validated']);
			unset($row['qc_agentID']);			
			unset($row['qc_Date']);			
			unset($row['gatewayTransactionId']);
			unset($row['batch_id']);
			unset($row['reason_code']);
			unset($row['reason_descrption']);			
			$row['locked'] = 'Y';
			$row['status'] = $value;
			if($recDate==""){
				$row['rec_crt_date'] = date("Y-m-d H:i:s");
				$row['rec_up_date'] = date("Y-m-d H:i:s");
			}else{
				$row['rec_crt_date'] = $recDate;
				$row['rec_up_date'] = $recDate;
			}
			$row['gatewayTransactionId'] = '';
			$row['originalGatewayTransactionId'] = $gatewayTransactionId;
			$row['grossPrice'] = $grossPrice;
			$row['validated']='Y';
			$row['qc_agentID']=$this->session->userdata('ADMIN_NAME');
			$row['qc_Date']=date('Y-m-d H:i:s');
			
			$insert_id = $this->common_model->addRecord($this->table,$row);			
			

			
			$rowMast['locked'] = "Y";
			$rowMast['validated'] = "Y";
			$rowMast['qc_agentID']=$this->session->userdata('ADMIN_NAME');
			$rowMast['qc_Date']=date('Y-m-d H:i:s');			
			$this->db->where('gatewayTransactionId', $gatewayTransactionId);
			$this->db->update($this->table, $rowMast);			
			


		}
		/******************/
		else{
		$row = array();
		$rowInv = array();
		if($value == 'Void'){
			$rowInv['sale_type']=2;	
			$row['validated'] = "Y";
			$row['qc_agentID']=$this->session->userdata('ADMIN_NAME');
			$row['qc_Date']=date('Y-m-d H:i:s');			
		}		
		$row['status'] = $value;
		$row['captured_by'] = $captured_by;
		$row['captured_date'] = $captured_date;		
		$row['rec_up_date']=date("Y-m-d H:i:s");
		$this->db->where('id', $id);
		$this->db->update($this->table, $row);

		}
		echo 'success';
	}
	public function change_center_status(){
		date_default_timezone_set("UTC");
		$gatewayTransactionId = $this->input->post('id') ; 
		$companyID = $this->input->post('companyID') ; 
		$gatewayID = $this->input->post('val') ;
		//echo 'well done';
		//exit;
		$row_center = $this->common_model->Retrive_Record_By_Where_Clause('t_centerdb',"companyID like '%".$companyID."%'");
		$centerStatus = $row_center['status'];
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

		$this->DB2=$this->load->database($config, TRUE);

		$row_transaction = $this->common_model->Retrive_Record_By_Where_Clause('t_master_success',"gatewayTransactionId like '%".$gatewayTransactionId."%'");		
		$row_gateway = $this->common_model->Retrive_Record_By_Where_Clause('t_midmaster',"gatewayID like '%".$gatewayID."%'");
		
		$username=$row_gateway['username'];
		$password=$row_gateway['password'];	
		$constraints = "&transaction_id=".$gatewayTransactionId."";
				
		$postStr='username='.$username.'&password='.$password. $constraints;
		//echo $postStr;
		$url="https://secure.networkmerchants.com/api/query.php?". $postStr;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, "");
		$response = curl_exec($ch);
		curl_close($ch);

		$arr = simplexml_load_string($response);	
		//echo $response;
		//print_r($arr);
		foreach($arr as $a)
		{
			$validated = 'N';
			$qc_agentID = '';
			$qc_Date = '';
			$cardType='CC';
			$paymentType='credit_card';			
			//print_r($a->action);
			$status="";
			$sale_type=0;
			$locked='N';
			$captured_by="";
			$captured_date="";			
			$cnt=count($a->action);
			$companyID=$a->merchant_defined_field[2];
			$transaction_id=$a->transaction_id;
			$original_transaction_id=$a->original_transaction_id;
			$product=trim(substr($a->order_description, 0, strrpos($a->order_description, '-')));
			$productId="";
			$getAgentId="";
			$getCustomerId="";
			for($i=0;$i<$cnt;$i++){			
				if($a->action[$i]->action_type=='sale' || $a->action[$i]->action_type=='capture'){
					$captured_by = $this->session->userdata('ADMIN_NAME');
					$captured_date = date("Y-m-d H:i:s",strtotime($a->action[$i]->date)-14400);						
				}	
			}				
			if($a->action[$cnt-1]->amount < 0 && $a->action[$cnt-1]->action_type=='settle'){
				$locked='Y';
				$sale_type=1;
				$status="Refund";					
			}
			if($a->action[$cnt-1]->amount < 0)	
			{
				$locked='Y';
				$sale_type=1;
			}
			if($a->action[$cnt-1]->action_type=='auth'){
				$status="Authorize";
			}			
			if($a->action[$cnt-1]->action_type=='refund' ){
				$status="Refund";
				$sale_type=1;
				$locked='Y';					
			}			
			if($a->action[$cnt-1]->action_type=='capture'){
				$status="Capture";					
			}			
			if($a->action[$cnt-1]->action_type=='sale'){
				$status="Sale";
			}			
			if($a->action[$cnt-1]->action_type=='void'){
				$status="Void";
				$sale_type=2;
				$locked='Y';
			}			
			if($a->action[$cnt-1]->action_type=='settle' && $a->action[$cnt-1]->amount > 0){
				$status="Settlement";
			}
			if($a->condition=='failed'){
				$status="Failed";
				$sale_type=2;
				$locked='Y';					
			}
			if($status=="Refund"){
				$cardType=mysqli_query($con_two,"select cardType from t_master_success where gatewayTransactionId = '".$original_transaction_id."'")->fetch_row()[0];
				if($cardType==''){
					$cardType='CC';
				}
			}
			$AgentName		=	$a->merchant_defined_field[1];
			$productName	=	$a->order_description;
			$customerEmail	=	$a->email;				
			if($centerStatus=='Y'){
				$getResult=$this->DB2->query("select * from t_invoice where gatewayTransactionId=".$transaction_id);
				//print_r($getResult);
				//echo $getResult->num_rows();
				//exit;
				if($getResult->num_rows() > 0){						
					if($sale_type > 0){
						echo $sql1=$this->DB2->query("update t_invoice set status='".$status."', batch_id='".$a->action[$cnt-1]->batch_id."', rec_up_date='".date("Y-m-d H:i:s",strtotime($a->action[$cnt-1]->date)-14400)."', sale_type=".$sale_type.", captured_by='".$captured_by."', captured_date='".$captured_date."' where gatewayTransactionId=".$transaction_id."");							
					}else{
						echo $sql1=$this->DB2->query("update t_invoice set status='".$status."', batch_id='".$a->action[$cnt-1]->batch_id."', rec_up_date='".date("Y-m-d H:i:s",strtotime($a->action[$cnt-1]->date)-14400)."', captured_by='".$captured_by."', captured_date='".$captured_date."' where gatewayTransactionId=".$transaction_id."");
					}
				}
				else{
					$productId=$this->DB2->query("select id from  t_product where productName like '%".$product."%'")->row(0);
					$getAgentId=$this->DB2->query("select id from t_admin where name like '%".$AgentName."%'")->row(0);
					$getCustomerId=$this->DB2->query("select id from t_customer where email like '%".$customerEmail."%'")->row(0);
					if($getCustomerId==""){
						$insertCustomer = "INSERT INTO t_customer (agentId,email,name,address,city,state,country,zip,phone,status,rec_crt_date,rec_up_date,refType)  VALUES (
						'".addslashes($getAgentId)."', 				 
						'".addslashes(strtolower($a->email))."', 
						'".addslashes($a->first_name.' '.$a->last_name)."',
						'".addslashes($a->address_1)."',
						'".addslashes($a->city)."',
						'".addslashes($a->state)."',
						'".addslashes($a->country)."',
						'".addslashes($a->postal_code)."',
						'".addslashes($a->phone)."',
						'Y',
						'".date("Y-m-d H:i:s",strtotime($a->action[0]->date)-14400)."',
						'".date("Y-m-d H:i:s",strtotime($a->action[0]->date)-14400)."',
						'0'
						)";
						$this->DB2->query($insertCustomer);
						$getCustomerId = $this->db->insert_id();
					}						
					$sqlInsertInvoice = "INSERT INTO t_invoice (
						companyID,
						invoice_id,
						customerId,
						agentID,
						productId,
						grossPrice,
						cardNo,
						gatewayID,
						gatewayTransactionId,
						sale_type,
						originalGatewayTransactionId,
						sourceCode,
						batch_id,
						`cardType`,
						`paymentType`,					
						reason_code,
						reason_descrption,
						rec_crt_date,
						rec_up_date,
						`captured_by`,
						`captured_date`,					
						status)  
						VALUES (				
					'".$a->merchant_defined_field[2]."',
					'".$a->order_id."',
					'".$getCustomerId."', 
					'".$getAgentId."',  
					'".$productId."',  
					'".$a->action[$cnt-1]->amount."',
					'".$a->cc_number."',
					'".$a->merchant_defined_field[0]."',
					'".$a->transaction_id."',
					'".$sale_type."',
					'".$a->original_transaction_id."',
					'cron file',
					'".$a->action[$cnt-1]->batch_id."',
					'".$cardType."',  					 
					'".$paymentType."', 				
					'".addslashes($a->action[$cnt-1]->response_code)."',
					'".addslashes($a->action[$cnt-1]->response_text)."',				
					'".date("Y-m-d H:i:s",strtotime($a->action[0]->date)-14400)."', 
					'".date("Y-m-d H:i:s",strtotime($a->action[$cnt-1]->date)-14400)."', 
					'".$captured_by."',
					'".$captured_date."', 				
					'".$status."'													
					)";	
					//mysqli_query($con_one, $sqlInsertInvoice);
					$this->DB2->query($sqlInsertInvoice);					
				}
				if($status=="Refund"){
					$sqllocked1 = $this->DB2->query("update t_invoice set `sale_type`= 1, where gatewayTransactionId=".$original_transaction_id."");
				}
			}
			////////////////Master Table///////////////////
			if($status=="Failed" || $status=="Void" || $status=="Refund" || $status=="Settlement"){
				$validated = 'Y';
			}
			$qc_agentID = $this->session->userdata('ADMIN_NAME');
			$qc_Date = date("Y-m-d H:i:s",strtotime($a->action[$cnt-1]->date)-14400);
				if($locked=='Y'){
					$sql=$this->db->query("update t_master_success set status='".$status."', batch_id='".$a->action[$cnt-1]->batch_id."', `locked`='".$locked."', rec_up_date='".date("Y-m-d H:i:s",strtotime($a->action[$cnt-1]->date)-14400)."', captured_by='".$captured_by."', captured_date='".$captured_date."', validated='".$validated."', qc_agentID='".$qc_agentID."', qc_Date='".$qc_Date."' where gatewayTransactionId=".$transaction_id."");
				}else{
					$sql= $this->db->query("update t_master_success set status='".$status."', batch_id='".$a->action[$cnt-1]->batch_id."', rec_up_date='".date("Y-m-d H:i:s",strtotime($a->action[$cnt-1]->date)-14400)."', captured_by='".$captured_by."', captured_date='".$captured_date."', validated='".$validated."', qc_agentID='".$qc_agentID."', qc_Date='".$qc_Date."' where gatewayTransactionId=".$transaction_id."");
				}
			if($status=="Refund"){
					$sqllocked = $this->db->query("update t_master_success set `locked`='Y', where gatewayTransactionId=".$original_transaction_id."");
			}									
		}		
		/*$rowInv['status']=$value;	
		$this->DB2->where('gatewayTransactionId', $gatewayTransactionId);
		$this->DB2->update("t_invoice", $rowInv);
		$this->db->where('gatewayTransactionId', $gatewayTransactionId);
		$this->db->update("t_master_success", $rowInv);	*/
		echo 'success';
	}
	public function check_status(){
		$gatewayTransactionId = $this->input->post('gatewayTransactionId') ; 
		$gatewayID = $this->input->post('gatewayID') ; 
		$companyID = $this->input->post('companyID') ; 
		
		$row_center = $this->common_model->Retrive_Record_By_Where_Clause('t_centerdb',"companyID like '%".$companyID."%'");
		//$row_transaction = $this->common_model->Retrive_Record_By_Where_Clause('t_master_success',"gatewayTransactionId like '%".$gatewayTransactionId."%'");		
		$row_gateway = $this->common_model->Retrive_Record_By_Where_Clause('t_midmaster',"gatewayID like '%".$gatewayID."%'");
		
		$username=$row_gateway['username'];
		$password=$row_gateway['password'];	
		$constraints = "&transaction_id=".$gatewayTransactionId."";
				
		$postStr='username='.$username.'&password='.$password. $constraints;
		//echo $postStr;
		$url="https://secure.networkmerchants.com/api/query.php?". $postStr;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, "");
		$response = curl_exec($ch);
		curl_close($ch);

		$arr = simplexml_load_string($response);	
		//echo $response;
		//print_r($arr);
		foreach($arr as $a)
		{
			//print_r($a->action);
			//echo $a->action[$cnt-1]->action_type;
			$cnt=count($a->action);
			$finalStatus=$a->action[$cnt-1]->action_type;	
			if($a->action[$cnt-1]->amount < 0 && $a->action[$cnt-1]->action_type=='settle'){
				$finalStatus="Refund";
			}
			if($a->action[$cnt-1]->action_type=='auth'){
				$finalStatus="Authorize";
			}			
			if($a->action[$cnt-1]->action_type=='refund' ){
				$finalStatus="Refund";
			}			
			if($a->action[$cnt-1]->action_type=='capture'){
				$finalStatus="Capture";					
			}			
			if($a->action[$cnt-1]->action_type=='sale'){
				$finalStatus="Sale";
			}			
			if($a->action[$cnt-1]->action_type=='void'){
				$finalStatus="Void";
			}			
			if($a->action[$cnt-1]->action_type=='settle' && $a->action[$cnt-1]->amount > 0){
				$finalStatus="Settle";
			}
			if($a->condition=='failed'){
				$finalStatus="Failed";
			}			
		}
		/*$config['hostname'] = $row_center['db_host'];
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
		$this->DB2=$this->load->database($config, TRUE);
		$rowCenter=$this->DB2->query("select * from t_invoice where gatewayTransactionId='".$gatewayTransactionId."'")->row_array();
		//print_r($rowCenter);
		//echo $rowCenter['status']
		
		if($rowCenter['status']=="Authorize") $rowCenterSatus="Authorize";
		if($rowCenter['status']=="Capture") $rowCenterSatus="Capture";
		if($rowCenter['status']=="Sale") $rowCenterSatus="Sale";
		if($rowCenter['status']=="Void") $rowCenterSatus="Void";
		if($rowCenter['status']=="Refund") $rowCenterSatus="Refund";
		if($rowCenter['status']=="Settlement") $rowCenterSatus="Settle";
		if($rowCenter['status']=="Failed") $rowCenterSatus="Failed";*/
		
		
		$StatusMsg='Gateway : '.ucfirst($finalStatus).'<br/>';
		//$StatusMsg .= 'Center : '.$rowCenterSatus.'<br/>';
		//$StatusMsg .= 'Master Transaction Status : '.$row_transaction['status'].'<br/>';
		$StatusMsg .= "<span style='margin:auto; display:table;'>";
		//$StatusMsg .= "<span title='Update Transaction' class='glyphicon glyphicon-pencil' onclick='change_center_status(".$gatewayTransactionId."','".$finalStatus."','".$companyID."')';></span>";
		//$StatusMsg .="<span title='Update Transaction' class='glyphicon glyphicon-pencil' onclick='change_center_status(".$gatewayTransactionId.",\"".$gatewayID."\",\"".$companyID."\");'></span>";
		$StatusMsg .= '<span title="Discard" class="glyphicon glyphicon-remove" onclick="discard('.$gatewayTransactionId.');"></span>';
		$StatusMsg .= "</span>";
		echo $StatusMsg;
	}	

}?>




