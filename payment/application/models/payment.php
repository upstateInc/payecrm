<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html'));
		$this->load->library(array('session','form_validation'));
		$this->load->model(array('common_model','commonmaster_model'));
		$this->ProductTable 	= 't_product';
		$this->transactionCodeTable = 't_transaction_code';
		$this->adminTable       = 't_admin';
		$this->TableCustomer 	= 't_customer';
		$this->TableMidmaster 	= 't_midmaster';
		$this->centerTable      = 't_centerdb';
	}	
	public function index()
	{
		$RefProductID = $_REQUEST['product'];
		$this->session->set_userdata('RefProductID', $RefProductID); 

		$product_row 						= $this->common_model->Retrive_Record($this->ProductTable,$RefProductID);

		$data['productName'] 				= $product_row['productName'];
		$data['productPrice'] 				= $product_row['productPrice'];
		$data['ProductSupscriptionPeriod']  = $product_row['ProductSupscriptionPeriod'];
		$data['ProductSupscriptionPeriod']	= $ProductSupscriptionPeriod/30;
		
		if($_REQUEST['price'] != ''){
			$data['productPrice'] = $_REQUEST['price'];
		}
		$data['message'] = ''; 
		$data['result'] = $this->common_model->get_all_records('t_country', 'status = "Y"' ,'id','ASC',$offset,$limit);
		$data['ResultProduct'] 	= $this->common_model->get_all_records($this->ProductTable, '','id','ASC',$offset,$limit);
		
		$data['gateway_result'] = $this->commonmaster_model->get_all_records('t_gateway', "companyID ='".COMPANYID."' and `status` = 'Y' and paymentType = 'credit_card'" ,'id','ASC',$offset,$limit);
		
		$this->load->view('payment',$data);
	}
	public function statelist(){
		$countryid = $_REQUEST['countryid'];	
		$result = $this->common_model->get_all_records('t_state', "`countryId` = '".$countryid."'",'id','ASC',$offset,$limit);
		echo '<select name="state" id="state" class="form-control" required >';
        echo '<option value="">Select</option>';
         foreach($result->result() as $row) {
        echo  '<option value="'.$row->name.'">'.$row->name.'</option>';
          } 
    	echo '</select>';		
	}
	public function getGatewayDetails(){
		$id = $_REQUEST['id'];		
		$row = $this->commonmaster_model->Retrive_Record('t_gateway',$id);		
		echo json_encode(array('gatewayName' => $row['gatewayName'],'directory' => $row['directory'],'programName' => $row['programName'],'decriptor' 	=> $row['decriptor']));			
	}
	public function paymentType(){
	/****/
	$PaymentType = $_REQUEST['PaymentType'];
	$gateway_result = "SELECT * FROM t_gateway WHERE companyID='".COMPANYID."' and `status` = 'Y' and paymentType = '".$PaymentType."";
	$disp='<tr>
		<th><span class="red">*</span> Gateway</th>
		<td>
			<select class="form-control" id="gatewayName" name="gatewayName" required="" onchange="ChangeGatewayDetails(this.value);">
			<option value="">Select Gateway</option>';	
			   
			   $gateway_result = $this->commonmaster_model->get_all_records('t_gateway', "companyID ='".COMPANYID."' and `status` = 'Y' and paymentType = '".$PaymentType."'" ,'id','ASC',$offset,$limit);
				foreach($gateway_result->result() as $gateway_row) {
					$disp .= "<option value='".$gateway_row->id."'>". $gateway_row->gatewayName."</option>";
				}
			   
	$disp .="</select></td></tr>";
	echo $disp;	
	}
	public function process(){
		//print_r($_POST);
		$order_id = time();
		$insert['fname']				= $this->input->post("fname");
		$insert['lname']				= $this->input->post("lname");
		$insert['email']				= $this->input->post("email");
		$insert['contact']				= $this->input->post("contact");
		$insert['address']				= $this->input->post("address");
		$insert['address2']				= $this->input->post("address2");
		$insert['country']				= $this->input->post("country");
		$insert['acountry']				= $this->input->post("acountry");
		$insert['state']				= $this->input->post("state");
		$insert['city']					= $this->input->post("city");
		$insert['zip']					= $this->input->post("zip");
		$insert['gatewayID']			= $this->input->post("gatewayID");
		$insert['decriptor']			= $this->input->post("decriptor");
		$insert['directory']			= $this->input->post("directory");
		$insert['programName']			= $this->input->post("programName");
		$insert['agentid']				= $this->input->post("agentid");
		$insert['PaymentType']			= $this->input->post("PaymentType");
		$insert['gatewayName']			= $this->input->post("gatewayName");
		$insert['cardtype']				= $this->input->post("cardtype");
		$insert['nameoncard']			= $this->input->post("nameoncard");
		$insert['cardnumber']			= $this->input->post("cardnumber");
		$insert['cvv']					= $this->input->post("cvv");
		$insert['month']				= $this->input->post("month");
		$insert['year']					= $this->input->post("year");
		$insert['routingNumber']		= $this->input->post("routingNumber");
		$insert['bankName']				= $this->input->post("bankName");
		$insert['checkDate']			= $this->input->post("checkDate");
		$insert['checkNumber']			= $this->input->post("checkNumber");
		$insert['checkMemo']			= $this->input->post("checkMemo");
		$insert['ip']					= $this->input->post("ip");
		$insert['output']				= $this->input->post("output");
		$insert['product_name']			= $this->input->post("product_name");
		$insert['product_price_each']	= $this->input->post("product_price_each");
		$insert['product_price']		= $this->input->post("product_price");
		$insert['product_id']			= $this->input->post("product_id");
		$insert['SupscriptionPeriod']	= $this->input->post("SupscriptionPeriod");
		$insert['quantity']				= $this->input->post("quantity");
		$insert['securityProtection']	= $this->input->post("securityProtection");
		$insert['totalDevices']			= $this->input->post("totalDevices");		
		
		$agentName = $this->db->query("select b.name from ".$this->transactionCodeTable." as a left join ".$this->adminTable." as b on a.agent_id=b.id where transaction_code='".$insert['agentid']."'")->row()->name;
		if($agentName==""){
			$agentName = 'Missing';
		}
		$where_clause_email = "email = '".addslashes($insert['email'])."'";
		$total_rows_email	= $this->common_model->countAll($this->TableCustomer,$where_clause_email);
		if($total_rows_email > 0){
			$rowCustomer = $this->common_model->Retrive_Record_By_Where_Clause($this->TableCustomer,$where_clause_email);
			$insertid=$rowCustomer['id'];
		}
		else{
			$insertCustomer['agentId'] 		= $insert['agentid'];
			$insertCustomer['companyID'] 	= COMPANYID;
			$insertCustomer['email'] 		= $insert['email'];
			$insertCustomer['fname'] 		= $insert['fname'];
			$insertCustomer['lname'] 		= $insert['lname'];
			$insertCustomer['address'] 		= $insert['address'];
			$insertCustomer['city'] 		= $insert['city'];
			$insertCustomer['state'] 		= $insert['state'];
			$insertCustomer['country'] 		= $insert['country'];
			$insertCustomer['zip'] 			= $insert['zip'];
			$insertCustomer['phone'] 		= $insert['contact'];
			$insertCustomer['rec_crt_date'] = date('Y-m-d H:i:s');
			$insertCustomer['ip_address'] 	= $insert['ip'];
			
			$insertid = $this->common_model->Add_Record($insertCustomer,$this->TableCustomer);
		}
		$where_clause_gateway = "gatewayID = '".addslashes($insert['gatewayID'])."'";
		$rowGateway = $this->commonmaster_model->Retrive_Record_By_Where_Clause($this->TableMidmaster,$where_clause_gateway);
		//echo $this->db->last_query();
		//print_r($rowGateway);
		/**********Variables for Making Connection with Gateway***********/
		$gatewayType	=	$rowGateway['gatewayType']; 
		$programName	=	$rowGateway['programName']; 
		$username		=	$rowGateway['username']; 
		$password		=	$rowGateway['password']; 
		$mid_number		=	$rowGateway['mid_number'];  
		$mid_key		=	$rowGateway['mid_key']; 
		$paymentType	=	$rowGateway['paymentType']; 

		/*****************************Fetching Center Details*************************************/
		$where_clause_center = "companyID = '".addslashes(COMPANYID)."'";
		$rowCenter = $this->commonmaster_model->Retrive_Record_By_Where_Clause($this->centerTable,$where_clause_center);
		print_r($rowCenter);
		$company_invoice_prefix = $rowCenter['company_invoice_prefix'];
		$tranactionMode 		= $rowCenter['tranactionMode'];
		
		/*****************Variables for Payment API************************/
		$fname = $insert['fname'];
		$lname = $insert['lname'];
		$address = $insert['address'];
		$city = $insert['city'];
		$state = $insert['state'];
		$zip = $insert['zip'];
		$country = $insert['country'];
		$contact = $insert['contact'];
		$email = $insert['email'];
		$product_name = $insert['product_name'];
		$product_price = $insert['product_price'];
		$cardnumber = $insert['cardnumber'];
		$month = $insert['month'];
		$year = $insert['year'];
		$cvv = $insert['cvv'];
		$gatewayID = $insert['gatewayID'];
		$agentID = $insert['agentid'];
		$companyID = COMPANYID;
		$order_id = $company_invoice_prefix.$order_id 
		require_once($_SERVER['DOCUMENT_ROOT'].'/system/gateways/'.$programName);
		print_r($r);
	}
}

