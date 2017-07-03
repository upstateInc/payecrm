<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Invoice extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html','file'));
		$this->load->library(array('session','authentication','form_validation','email','upload','image_lib','pagination'));
		$this->load->model(array('common_model'));
		$this->tableCenter = 't_merchant';
		$this->table = 't_invoice';
		$this->viewfolder = 'invoice/';
		$this->controllerFile = 'invoice/';
		$this->namefile = 'invoice';
	}
	public function index() {
		$message = '';
		$data = array();
		$order_by_fld = 'id';
		$order_by =	'DESC';
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
		$where_clause = "(status like '%Refund%' or status like '%Settlement%' or status like '%Chargeback%') AND ";
		$data['id'] = '';		
		$data['companyID'] = '';
		$data['gatewayName'] = '';
		$data['directory'] = '';
		$data['programName'] = '';
		$data['decriptor'] = '';
		$data['status'] = '';
		$data['validated'] = '';
		$data['no_of_days'] = '';
		$data['selectedEmails1'] = '';
		$data['invoiceDay'] = '';
		$data['start_date'] = '';
		$data['end_date'] = '';
		$data['totChrgbakFee'] = '';
		$data['totRefundFee'] = '';
		$data['totWireFee'] = '';
		$data['totProcessingFee'] = '';
		$data['totACHFee'] = '';
		$data['totalReserve'] = '';
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
			$this->session->set_userdata('customer_phone', '');
			$this->session->set_userdata('customer_email', '');
			$this->session->set_userdata('cardNo', '');
			$this->session->set_userdata('cardType', '');
			$this->session->set_userdata('selectedEmails1', '');
			$this->session->set_userdata('no_of_days', '');
			$this->session->set_userdata('invoiceDay', '');
		}
		if($this->session->userdata('selectedEmails1') != '')
		{
			$data['selectedEmails1'] = $this->session->userdata('selectedEmails1');
		}		
		if($this->input->post('search')!= '')
		{
			
			$this->session->set_userdata('id', $this->input->post('id'));			
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
			$this->session->set_userdata('cardType', $this->input->post('cardType'));
			$this->session->set_userdata('no_of_days', $this->input->post('no_of_days'));
			$this->session->set_userdata('invoiceDay', $this->input->post('invoiceDay'));
		}
		if($this->session->userdata('companyID') != '')
		{
			$companyID = $this->session->userdata('companyID');
			$where_clause .= "companyID LIKE '%$companyID%' AND ";
			$data['companyID'] = $companyID;
		}			
		if($this->session->userdata('invoiceDay') != '')
		{
			$invoiceDay = $this->session->userdata('invoiceDay');
			$data['invoiceDay'] = $invoiceDay;
		}		
		if($this->session->userdata('no_of_days') != '')
		{
			//echo $no_of_days;
			//exit;
			$no_of_days = $this->session->userdata('no_of_days');
			/*$where_clause .= "companyID LIKE '%$companyID%' AND ";*/
			$data['no_of_days'] = $no_of_days;
		}		
		if($this->session->userdata('validated') != '')
		{
			$validated = $this->session->userdata('validated');
			$where_clause .= "validated LIKE '%$validated%' AND ";
			$data['validated'] = $validated;
		}
		if($this->session->userdata('customer_name') != '')
		{
			$customer_name = $this->session->userdata('customer_name');
			$where_clause .= "customer_name LIKE '%$customer_name%' AND ";
			$data['customer_name'] = $customer_name;
		}
		if($this->session->userdata('customer_phone') != '')
		{
			$customer_phone = $this->session->userdata('customer_phone');
			$where_clause .= "customer_phone LIKE '%$customer_phone%' AND ";
			$data['customer_phone'] = $customer_phone;
		}
		if($this->session->userdata('customer_email') != '')
		{
			$customer_email = $this->session->userdata('customer_email');
			$where_clause .= "customer_email LIKE '%$customer_email%' AND ";
			$data['customer_email'] = $customer_email;
		}
		if($this->session->userdata('cardNo') != '')
		{
			$cardNo = $this->session->userdata('cardNo');
			$where_clause .= "cardNo LIKE '%$cardNo' AND ";
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
			//print_r($status);
			//exit;
			
			foreach($status as $val){
				$where_status_clause .= "status like '%".$val."%' OR ";
				//$where_clause .= "status like '%$status%' AND ";
			}
			$where_clause .="(";
			$where_clause .= substr($where_status_clause, 0, -3);
			$where_clause .=") AND ";
			
			$data['status'] = $status;
		}
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') != '')
		{
			$start_date = $this->session->userdata('start_date');
			$parts = explode('/',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$yyyy_mm_dd1 = $parts[2] . '/' . $parts[0] . '/' . $parts[1];
			$where_clause .= "`rec_up_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$data['start_date'] = $start_date;
		}
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') == '')
		{
			$start_date = $this->session->userdata('start_date');
			//echo $start_date;
			$parts = explode('/',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$yyyy_mm_dd1 = $parts[2] . '/' . $parts[0] . '/' . $parts[1];
			$where_clause .= "`rec_up_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND `rec_up_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND";
			$data['start_date'] = $start_date;
		}
		
		if($this->session->userdata('end_date') != '')
		{
			$end_date = $this->session->userdata('end_date');
			$parts = explode('/',$end_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];			
			$yyyy_mm_dd1 = $parts[2] . '/' . $parts[0] . '/' . $parts[1];			
			$where_clause .= "`rec_up_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND ";
			$data['end_date'] = $end_date;
		}
		if($this->session->userdata('cardType') != '')
		{
			$cardType = $this->session->userdata('cardType');
			$where_clause .= "cardType LIKE '%$cardType%' AND ";
			$data['cardType'] = $cardType;
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
		$tempInvoiceGenerationId = $this->uri->segment(3);
		/*echo $id;
		exit;*/
		//$row = $this->common_model->Retrive_Record($this->table,$id);
		$where_clause = "tempInvoiceGenerationId like '%".$tempInvoiceGenerationId."%'";
		$query = $this->common_model->get_all_records('t_invoiceDebitCredit', $where_clause,'id','desc',$offset,$limit);
		$data = array();
		$data['tempInvoiceGenerationId'] = $tempInvoiceGenerationId;
		$data['query'] = $query ;
		$data['message'] = $message;
	
		$this->load->view($this->viewfolder.'/edit',$data);
	}
	public function addexpense(){
		$tempInvoiceGenerationId = $this->input->post('tempInvoiceGenerationId');
		$row['tempInvoiceGenerationId'] = $this->input->post('tempInvoiceGenerationId');		
		$row['credit'] = $this->input->post('credit');
		$row['name'] = $this->input->post('expensename');
		$row['price_each'] = $this->input->post('price_each');
		$row['quantity'] = $this->input->post('quantity');
		$row['total'] = $row['price_each']*$row['quantity'];
		$where_clause = "tempInvoiceGenerationId like '%".$tempInvoiceGenerationId."%'";
		$insert_id = $this->common_model->addRecord('t_invoiceDebitCredit',$row);
		$query = $this->common_model->get_all_records('t_invoiceDebitCredit', $where_clause,'id','desc',$offset,$limit);				
	}
	public function addDetailInvoice(){
		$data = array();
		$tempInvoiceGenerationId = $this->input->post('tempInvoiceGenerationId');
		$total_payout = $this->input->post('total_payout');
		$this->db->query("Delete from t_savedInvoice where tempInvoiceGenerationId ='".$tempInvoiceGenerationId."'");
		//echo $this->db->last_query();

		
		$row['tempInvoiceGenerationId'] = $tempInvoiceGenerationId;
		$row['total_payout'] = $total_payout;
		$row['INVOICECOMPANYID'] = $this->session->userdata('INVOICECOMPANYID');
		$row['STARTDATE'] = $this->session->userdata('STARTDATE');
		$row['NOOFDAYS'] = $this->session->userdata('NOOFDAYS');
		$row['ENDDATE'] = $this->session->userdata('ENDDATE');

		$row['COMMISSIONFEE'] = $this->session->userdata('COMMISSIONFEE');
		$row['TOTALSALE'] = $this->session->userdata('TOTALSALE');
		$row['TOTALGOODSALE'] = $this->session->userdata('TOTALGOODSALE');
		$row['PROCESSINGFEE'] = $this->session->userdata('PROCESSINGFEE');
		$row['REFUNDEACH'] = $this->session->userdata('REFUNDEACH');
		$row['NOREFUND'] = $this->session->userdata('NOREFUND');
		$row['TOTALREFUND'] = $this->session->userdata('TOTALREFUND');
		$row['CHARGEBACHEACH'] = $this->session->userdata('CHARGEBACHEACH');
		$row['NOCHARGEBACK'] = $this->session->userdata('NOCHARGEBACK');
		$row['TOTALCHARGEBACK'] = $this->session->userdata('TOTALCHARGEBACK');
		$row['ACHFEE'] = $this->session->userdata('ACHFEE');
		$row['WIREFEE'] = $this->session->userdata('WIREFEE');

		$row['NETCHARGEBACK'] = $this->session->userdata('NETCHARGEBACK');
		$row['NETREFUND'] = $this->session->userdata('NETREFUND');
		$row['TOTALGROSSSALE'] = $this->session->userdata('TOTALGROSSSALE');
		$row['NETDEDUCTION'] = $this->session->userdata('NETDEDUCTION');
		$row['INVOICETYPE'] = $this->session->userdata('INVOICETYPE');
		$row['TOTALRESERVE'] = $this->session->userdata('TOTALRESERVE');
		$row['RESERVEPERCENTAGE'] = $this->session->userdata('RESERVEPERCENTAGE');
		
		$parts=explode('/',$row['STARTDATE']);
		$newStartDate=$parts[2] . '-' . $parts[0] . '-' . $parts[1];	
		
		$nbr_of_reserve_weeks=$this->db->query("select nbr_of_reserve_weeks from t_centerdb where companyID='".$row['INVOICECOMPANYID']."'")->row()->nbr_of_reserve_weeks;
		$nbr_of_reserve_weeks=$nbr_of_reserve_weeks*7-1;	

		$row1['companyID']	=	$row['INVOICECOMPANYID'];
		$row1['start_date'] = $newStartDate;
		$row1['release_date'] = date('Y-m-d',strtotime("+".$nbr_of_reserve_weeks." days", strtotime($newStartDate)));
		$row1['amount']	=	$row['TOTALRESERVE'];	
		
		$insert_id = $this->common_model->addRecord('t_savedInvoice',$row);
		if($row1['amount'] > 0){
			$this->db->query("Delete from t_reserve_fees_weekly where companyID ='".$row1['companyID']."' and start_date='".$row1['start_date']."'");
			$insert_id1 = $this->common_model->addRecord('t_reserve_fees_weekly',$row1);
		}		
		$this->db->query("Update t_invoiceDebitCredit set invoiceID='".$insert_id."' where tempInvoiceGenerationId ='".$tempInvoiceGenerationId."'");
		
		$InvoiceCC = $this->db->query("select a.invoiceEmails from t_centerdb as a left join t_savedInvoice as b on a.companyID = b.INVOICECOMPANYID where b.tempInvoiceGenerationId like '%".$tempInvoiceGenerationId."%' ")->row()->invoiceEmails;
		

		echo 'success';
	}
	public function editDetailInvoice(){
		$tempInvoiceGenerationId = $this->input->post('tempInvoiceGenerationId');
		$row['total_payout'] = $this->input->post('total_payout');		
		//$row['total'] = $row['quantity']*$row['price_each'];
		$update = $this->common_model->Update_Record_ColumnName($row,'t_savedInvoice','tempInvoiceGenerationId',$tempInvoiceGenerationId);
		echo 'success';		
	}
	function update() {
		$message_empty = '';
		$data = array();
		$id= $this->input->post('id');
		$row['quantity'] = $this->input->post('quantity') ;
		$row['price_each'] = $this->input->post('price_each') ;
		$row['total'] = $row['quantity']*$row['price_each'];
		$update = $this->common_model->Update_Record($row,'t_invoiceDebitCredit',$id);
		echo 'success';

	}	// end of update
	function delete(){
		$data = array();
		$id= $this->input->post('id');	
		$this->db->query("Delete from t_invoiceDebitCredit where id='".$id."'");		
		echo 'success';
	}

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
	public function download(){
		/*print_r($_POST);
		exit;*/
/****************************************/	
		$data = array();
		$order_by_fld = 'rec_crt_date';
		$order_by =	'DESC';
		$offset = '';
		$limit = '';
		

		$where_clause = "";
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
		$this->session->set_userdata('cardType', $this->input->post('cardType'));		
		$this->session->set_userdata('companyID', $this->input->post('companyID'));
		$this->session->set_userdata('start_date', $this->input->post('start_date'));
		if($this->input->post('start_date')!=$this->input->post('end_date')){
			$this->session->set_userdata('end_date', $this->input->post('end_date'));
		}else{
			$this->session->set_userdata('end_date', '');
		}
		
		if($this->session->userdata('status') != '')
		{
			
			$status = $this->session->userdata('status');
			//print_r($status);
			//exit;
			//$where_clause .= "status like '%$status%' AND ";
			foreach($status as $val){
				$where_status_clause .= "status like '%".$val."%' OR ";
				//$where_clause .= "status like '%$status%' AND ";
			}
			$where_clause .="(";
			$where_clause .= substr($where_status_clause, 0, -3);
			$where_clause .=") AND ";			
			
			$data['status'] = $status;
		}
		if($this->session->userdata('gatewayName') != '')
		{
			$gatewayName = $this->session->userdata('gatewayName');
			$where_clause .= "gatewayID LIKE '%$gatewayName%' AND ";
			$data['gatewayName'] = $gatewayName;
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
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') != '')
		{
			$start_date = $this->session->userdata('start_date');
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$data['start_date'] = $start_date;

		}
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') == '')
		{
			$start_date = $this->session->userdata('start_date');
			//echo $start_date;
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND `rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND";
			$data['start_date'] = $start_date;
		}
		
		if($this->session->userdata('end_date') != '')
		{
			$end_date = $this->session->userdata('end_date');
			$parts = explode('-',$end_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];			
			$where_clause .= "`rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND ";
			$data['end_date'] = $end_date;
		}


		$where_clause  = substr($where_clause, 0, -4);
		/*$total_rows = $this->common_model->countAll($this->table,$where_clause);
		$query = $this->common_model->get_all_records($this->table, $where_clause,$order_by_fld,$order_by,$offset,$limit);*/

		if($where_clause!='')
		$this->db->where($where_clause);
		$this->db->select('id,companyID,gatewayID,rec_crt_date,customer_name,customer_phone,customer_email,customer_state,product_name,productDuration, grossPrice,status,cardType');
		$this->db->from($this->table);
		$query = $this->db->get();
	
/****************************************/		
		
		//$headers = ''; // just creating the var for field headers to append to below
		$data = ''; // just creating the var for field data to append to below
		$obj =& get_instance();
		//$fields = $query->field_data();
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
			$headers="Id"."\t"."Center"."\t"."Gateway"."\t"."Date"."\t"."Name"."\t"."Phone"."\t"."Email"."\t"."State"."\t"."Product"."\t"."Duration"."\t"."Price."."\t"."Status."."\t"."Card Type";
			foreach ($query->result() as $row) {
				if(is_array($pieceEmail)){
					if(in_array($row->id,$pieceEmail)){				
						$count = 0;
						$line = '';
						foreach($row as $value) {  
						$count++;                                         
						if ((!isset($value)) OR ($value == "")) {
							$value = "\t";
						} else {
							$value = str_replace('"', '""', $value);
							$value = '"' . $value . '"' . "\t";
						}
						$line .= $value;
							
						}
						$data .= trim($line)."\n";
					}
				}else{
					$count = 0;
					$line = '';
					foreach($row as $value) {  
					$count++;                                         
					if ((!isset($value)) OR ($value == "")) {
						$value = "\t";
					} else {
						$value = str_replace('"', '""', $value);
						$value = '"' . $value . '"' . "\t";
					}
					$line .= $value;
						
					}
					$data .= trim($line)."\n";					
				}
			}
			$data = str_replace("\r","",$data);
			//echo htmlentities("".trim($headers)."\n".$data.""); exit;
			//header("Content-type: application/x-msdownload");
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=invoice.xls");
			echo "Downloaded Records\n";
			echo "".trim($headers)."\n".$data."";  
			//echo "".trim($headers)."";  
			//$this->session->set_userdata('selectedEmails1', '');
			
		}		
	}
	public function saveEmailId(){
		$val	=	$this->input->post('val');
		$this->session->set_userdata('selectedEmails1', $val);
	}
	public function get_center_days(){
		$companyID = $this->input->post('companyID');
		$rowCompany = $this->common_model->Retrive_Record_By_Where_Clause('t_centerdb',"companyID like '%".$companyID."%'");
		//echo $rowCompany['invoice_period'];
		$arr['invoice_period'] = $rowCompany['invoice_period'];
		$arr['invoice_day'] = $rowCompany['invoice_day'];
		echo json_encode($arr);
		//echo json_encode(array("invoice_period" => $rowCompany['invoice_period'], "invoice_day" => $rowCompany['invoice_day']));
	}
	public function mypdf(){
		$data = array();

		$tempInvoiceGenerationId = $this->uri->segment(3);
		$where_clause = "tempInvoiceGenerationId like '%".$tempInvoiceGenerationId."%'";
		$query = $this->common_model->get_all_records('t_invoiceDebitCredit', $where_clause,'id','desc',$offset,$limit);
		$data['query'] = $query ;

		$row = $this->common_model->Retrive_Record_By_Where_Clause1('t_savedInvoice',$where_clause);
		$data['row'] = $row ;
		/*echo $this->db->last_query();
		exit;*/
		$html = $this->load->view($this->viewfolder.'invoice1',$data,true);
		pdf_create($html, 'invoice');
	}
	public function edit_saved_invoice() {
		$message = '';
		$data = array();
		$tempInvoiceGenerationId = $this->uri->segment(3);
		$where_clause = "tempInvoiceGenerationId like '%".$tempInvoiceGenerationId."%'";
		$query = $this->common_model->get_all_records('t_invoiceDebitCredit', $where_clause,'id','desc',$offset,$limit);
		$row = $this->common_model->Retrive_Record_By_Where_Clause1('t_savedInvoice',$where_clause);
		$data['row'] = $row ;
		$data['tempInvoiceGenerationId'] = $tempInvoiceGenerationId;
		$data['query'] = $query ;
		$data['message'] = $message;
	
		$this->load->view($this->viewfolder.'/edit_saved_invoice',$data);
	}	
	
	public function sendEmail(){
		$data = array();
		$tempInvoiceGenerationId = $this->input->post('tempInvoiceGenerationId');
		//$emailList = $this->input->post('emailList');
		$data = array();
		$InvoiceCC='';
		
		$email=$this->input->post('emailList');
		$InvoiceCC=$this->input->post('emailList');
		$tempInvoiceGenerationId = $this->input->post('tempInvoiceGenerationId');
		
		if($this->input->post('SendCompany')=='yes'){
			//$InvoiceCC INVOICECOMPANYID
			$InvoiceCC = $this->db->query("select a.invoiceEmails from t_centerdb as a left join t_savedInvoice as b on a.companyID = b.INVOICECOMPANYID where b.tempInvoiceGenerationId like '%".$tempInvoiceGenerationId."%' ")->row()->invoiceEmails;
		}
		//echo $InvoiceCC;
		//exit;
		$where_clause = "tempInvoiceGenerationId like '%".$tempInvoiceGenerationId."%'";
		$query = $this->common_model->get_all_records('t_invoiceDebitCredit', $where_clause,'id','desc',$offset,$limit);
		$data['query'] = $query ;

		$row = $this->common_model->Retrive_Record_By_Where_Clause1('t_savedInvoice',$where_clause);
		$data['row'] = $row ;
		/*echo $this->db->last_query();
		exit;*/
		require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/email_function.php");
		//$time = time();
		require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."dompdf/dompdf_config.inc.php");		
		
		//require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/pdf_template.php");
		

		$html = $this->load->view('invoice/invoice',$data,true);

		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();
		file_put_contents($tempInvoiceGenerationId.'.pdf', $dompdf->output());
		
		$emailContent = "Hello,<br>";
		$emailContent .= "Kindly find the Invoice Attached with this email.";
		
		$email1=explode(",",$email);
		foreach($email1 as $emailVal){		
			mail_file_attach( $emailVal, 'Invoice', $emailContent, COMPANYEMAIL, $tempInvoiceGenerationId.'.pdf',$InvoiceCC,'', '' );
		}
		unlink($tempInvoiceGenerationId.'.pdf');
		echo 'success';
	}	
	public function sendEmailsave(){
		$data = array();
		$tempInvoiceGenerationId = $this->input->post('tempInvoiceGenerationId');
		$total_payout = $this->input->post('total_payout');
		$email=$this->input->post('emailList');
		$this->db->query("Delete from t_savedInvoice where tempInvoiceGenerationId ='".$tempInvoiceGenerationId."'");
		//echo $this->db->last_query();

		
		$row['tempInvoiceGenerationId'] = $tempInvoiceGenerationId;
		$row['total_payout'] = $total_payout;
		$row['INVOICECOMPANYID'] = $this->session->userdata('INVOICECOMPANYID');
		$row['STARTDATE'] = $this->session->userdata('STARTDATE');
		$row['NOOFDAYS'] = $this->session->userdata('NOOFDAYS');
		$row['ENDDATE'] = $this->session->userdata('ENDDATE');

		$row['COMMISSIONFEE'] = $this->session->userdata('COMMISSIONFEE');
		$row['TOTALSALE'] = $this->session->userdata('TOTALSALE');
		$row['TOTALGOODSALE'] = $this->session->userdata('TOTALGOODSALE');
		$row['PROCESSINGFEE'] = $this->session->userdata('PROCESSINGFEE');
		$row['REFUNDEACH'] = $this->session->userdata('REFUNDEACH');
		$row['NOREFUND'] = $this->session->userdata('NOREFUND');
		$row['TOTALREFUND'] = $this->session->userdata('TOTALREFUND');
		$row['CHARGEBACHEACH'] = $this->session->userdata('CHARGEBACHEACH');
		$row['NOCHARGEBACK'] = $this->session->userdata('NOCHARGEBACK');
		$row['TOTALCHARGEBACK'] = $this->session->userdata('TOTALCHARGEBACK');
		$row['ACHFEE'] = $this->session->userdata('ACHFEE');
		$row['WIREFEE'] = $this->session->userdata('WIREFEE');

		$row['NETCHARGEBACK'] = $this->session->userdata('NETCHARGEBACK');
		$row['NETREFUND'] = $this->session->userdata('NETREFUND');
		$row['TOTALGROSSSALE'] = $this->session->userdata('TOTALGROSSSALE');
		$row['NETDEDUCTION'] = $this->session->userdata('NETDEDUCTION');
		$row['INVOICETYPE'] = $this->session->userdata('INVOICETYPE');
		$insert_id = $this->common_model->addRecord('t_savedInvoice',$row);
		$this->db->query("Update t_invoiceDebitCredit set invoiceID='".$insert_id."' where tempInvoiceGenerationId ='".$tempInvoiceGenerationId."'");
		
		$InvoiceCC = $this->db->query("select a.invoiceEmails from t_centerdb as a left join t_savedInvoice as b on a.companyID = b.INVOICECOMPANYID where b.tempInvoiceGenerationId like '%".$tempInvoiceGenerationId."%' ")->row()->invoiceEmails;
		
		//if($InvoiceCC != ""){
			$where_clause = "tempInvoiceGenerationId like '%".$tempInvoiceGenerationId."%'";
			$query = $this->common_model->get_all_records('t_invoiceDebitCredit', $where_clause,'id','desc',$offset,$limit);
			$data['query'] = $query ;

			$row = $this->common_model->Retrive_Record_By_Where_Clause1('t_savedInvoice',$where_clause);
			$data['row'] = $row ;
			require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/email_function.php");
			require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."dompdf/dompdf_config.inc.php");
			
			$html = $this->load->view('invoice/invoice',$data,true);

			$dompdf = new DOMPDF();
			$dompdf->load_html($html);
			$dompdf->render();
			file_put_contents($tempInvoiceGenerationId.'.pdf', $dompdf->output());
			
			$emailContent = "Hello,<br>";
			$emailContent .= "Kindly find the Invoice Attached with this email.";
			
			$email1=explode(",",$email);
			foreach($email1 as $emailVal){
				mail_file_attach( $emailVal, 'Invoice', $emailContent, COMPANYEMAIL, $tempInvoiceGenerationId.'.pdf',$InvoiceCC,'', '' );
			}
			unlink($tempInvoiceGenerationId.'.pdf');	
		//}
		echo 'success';
	}
	public function volumeReport(){
		$companyID=$_REQUEST['companyID'];
		$start_date=$_REQUEST['startdate'];
		$end_date=$_REQUEST['enddate'];
		
		$where_clause = "(status like '%Settlement%') AND ";
		$where_clause1 = "(status like '%Refund%') AND ";
		$where_clause2 = "(status like '%Chargeback%') AND ";
		if($companyID != '')
		{
			$where_clause .= "companyID LIKE '%$companyID%' AND ";
			$where_clause1 .= "companyID LIKE '%$companyID%' AND ";
			$where_clause2 .= "companyID LIKE '%$companyID%' AND ";
		}		
		if($start_date != '' && $end_date != '')
		{
			$parts = explode('/',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$yyyy_mm_dd1 = $parts[2] . '/' . $parts[0] . '/' . $parts[1];
			$where_clause .= "`rec_up_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$where_clause1 .= "`rec_up_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$where_clause2 .= "`rec_up_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
		}
		if($end_date != '')
		{
			$parts = explode('/',$end_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];			
			$yyyy_mm_dd1 = $parts[2] . '/' . $parts[0] . '/' . $parts[1];			
			$where_clause .= "`rec_up_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND ";
			$where_clause1 .= "`rec_up_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND ";
			$where_clause2 .= "`rec_up_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND ";
		}
		$where_clause  = substr($where_clause, 0, -4);	
		$where_clause1  = substr($where_clause1, 0, -4);	
		$where_clause2  = substr($where_clause2, 0, -4);	

		if($where_clause!='')
		/*$this->db->where($where_clause);
		$this->db->select('rec_up_date,rec_crt_date,customer_name,agent_name,grossPrice');
		$this->db->from($this->table);
		$query = $this->db->get();*/
		$query = $this->db->query("select DATE_FORMAT(rec_up_date,'%m-%d-%Y'),DATE_FORMAT(rec_crt_date,'%m-%d-%Y'),CONCAT(fname,lname) as name,agentName,concat('$', format(grossPrice, 2)) from ".$this->table." where ".$where_clause." order by rec_up_date,rec_crt_date,fname,lname ");
		
		$query1 = $this->db->query("select DATE_FORMAT(rec_up_date,'%m-%d-%Y'),DATE_FORMAT(rec_crt_date,'%m-%d-%Y'),CONCAT(fname,lname) as name,agentName,concat('$', format(grossPrice, 2)) from ".$this->table." where ".$where_clause1." order by rec_up_date,rec_crt_date,fname,lname ");
		
		$query2 = $this->db->query("select DATE_FORMAT(rec_up_date,'%m-%d-%Y'),DATE_FORMAT(rec_crt_date,'%m-%d-%Y'),CONCAT(fname,lname) as name,agentName,concat('$', format(grossPrice, 2)) from ".$this->table." where ".$where_clause2." order by rec_up_date,rec_crt_date,fname,lname ");
		
		$totRef=$this->db->query('SELECT concat("$", format(sum(grossPrice), 2)) as sum from '.$this->table.' where '.$where_clause1)->row()->sum;
		
		$totChrgBak=$this->db->query('SELECT concat("$", format(sum(grossPrice), 2)) as sum from '.$this->table.' where '.$where_clause2)->row()->sum;
		
		$totSettle=$this->db->query('SELECT concat("$", format(sum(grossPrice), 2)) as sum from '.$this->table.' where '.$where_clause)->row()->sum;		
		
		$data = ''; // just creating the var for field data to append to below
		$obj =& get_instance();

		require_once APPPATH .'third_party/PHPExcel/Classes/PHPExcel.php';		
		$objPHPExcel = new PHPExcel();
		
		$sheet = $objPHPExcel->getActiveSheet();
		$sheet->getColumnDimension('A')->setWidth(15);
		$sheet->getColumnDimension('B')->setWidth(15);
		$sheet->getColumnDimension('C')->setWidth(45);
		$sheet->getColumnDimension('D')->setWidth(45);
		$sheet->getColumnDimension('E')->setWidth(15);
       
	   $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
        $objPHPExcel->setActiveSheetIndex(0);
		
		$border_style= array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THICK,'color' => array('rgb' => '0000CD'),)));
		
		$border_style1= array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THICK,'color' => array('rgb' => '4169E1'),)));
		$sheet->getStyle("A1:E1")->applyFromArray($border_style);
		$sheet->getStyle("A2:E2")->applyFromArray($border_style);
		$sheet->getStyle("A3:E3")->applyFromArray($border_style);
		$sheet->getStyle("A4:E4")->applyFromArray($border_style);
		$sheet->getStyle("A5:E5")->applyFromArray($border_style1);
		
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Volume Report');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		
		$objPHPExcel->getActiveSheet()->setCellValue('A2', ''.$companyID.'');
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->mergeCells('A2:E2');
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
		
		$objPHPExcel->getActiveSheet()->setCellValue('A3', 'Processing Period : '.$start_date.' to '.$end_date.'')->getColumnDimension('A')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->mergeCells('A3:E3');
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		if ($query->num_rows() > 0){
			$objPHPExcel->getActiveSheet()->setCellValue('A4', 'Settled Transaction');
			$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(16);
			$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->mergeCells('A4:E4');
			$objPHPExcel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);				
			$row = 5;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'Settled Date');
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, 'Created Date');
			$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);			
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, 'Customer Name');
			$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, 'Agent Name');
			$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, 'Amount');
			$objPHPExcel->getActiveSheet()->getStyle('E'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('E'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$row ++;
			foreach($query->result() as $data)
			{
				$col = 0;
				foreach ($data as $value)
				{
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value)->getColumnDimension($col)->setAutoSize(true);
					$col++;
				}
				
				$row++;
			}
			$sheet->getStyle("A".$row.":E".$row)->applyFromArray($border_style);
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'Total');
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setSize(14);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);			
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, ''.$totSettle.'');
		}
		/************Refunded Transaction****************/
		if ($query1->num_rows() > 0){
			$row = $row+3;
			$sheet->getStyle("A".$row.":E".$row)->applyFromArray($border_style);
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'Refunded Transaction');
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setSize(16);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':E'.$row);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);				
			$row++;
			$sheet->getStyle("A".$row.":E".$row)->applyFromArray($border_style1);
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'Refunded Date');
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, 'Created Date');
			$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);			
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, 'Customer Name');
			$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, 'Agent Name');
			$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, 'Amount');
			$objPHPExcel->getActiveSheet()->getStyle('E'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('E'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$row++;
			foreach($query1->result() as $data)
			{
				$col = 0;
				foreach ($data as $value)
				{
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value)->getColumnDimension($col)->setAutoSize(true);
					$col++;
				}
	 
				$row++;
			}
			$sheet->getStyle("A".$row.":E".$row)->applyFromArray($border_style);
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'Total');
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setSize(14);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);			
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, ''.$totRef.'');
		}
		/***********************************************/
		/************Chargeback Transaction****************/
		if ($query2->num_rows() > 0){
			$row = $row+3;
			$sheet->getStyle("A".$row.":E".$row)->applyFromArray($border_style);
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'Chargeback Transaction');
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setSize(16);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':E'.$row);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);				
			$row++;
			$sheet->getStyle("A".$row.":E".$row)->applyFromArray($border_style1);
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'Chargeback Date');
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, 'Created Date');
			$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);			
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, 'Customer Name');
			$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, 'Agent Name');
			$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, 'Amount');
			$objPHPExcel->getActiveSheet()->getStyle('E'.$row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('E'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$row++;
			foreach($query2->result() as $data)
			{
				$col = 0;
				foreach ($data as $value)
				{
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value)->getColumnDimension($col)->setAutoSize(true);
					$col++;
				}
	 
				$row++;
			}
			$sheet->getStyle("A".$row.":E".$row)->applyFromArray($border_style);
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'Total');
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setSize(14);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getFont()->setBold(true);			
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, ''.$totChrgBak.'');			
		}
		/***********************************************/

		
		$objPHPExcel->setActiveSheetIndex(0);						  
		 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=export.xls");
		ob_end_clean();
		$objWriter->save('php://output');
		//load our new PHPExcel library
	}
}