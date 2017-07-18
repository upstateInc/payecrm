<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {
	
	public function __construct() {
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");				
		parent::__construct();
		$this->load->helper(array('url','form','html'));
		$this->load->library(array('session','form_validation'));
		$this->load->model(array('common_model','common_model'));
		$this->ProductTable 	= 't_product';
		$this->transactionCodeTable = 't_transaction_code';
		$this->adminTable       = 't_admin';
		$this->TableCustomer 	= 't_customer';
		$this->TableMidmaster 	= 't_midmaster';
		$this->centerTable      = 't_centerdb';
		$this->invoiceTable     = 't_invoice';
		$this->actionTable      = 't_action_type';
		$this->categoryTable    = 't_category';
		$this->cartTable 		= 't_cart';
		$this->controller = 'payment/';
		//$this->centercheck->check(COMPANYID);
	}	
	public function index()
	{
		/*$RefProductID = $_REQUEST['product'];
		$this->session->set_userdata('RefProductID', $RefProductID); 

		$product_row 						= $this->common_model->Retrive_Record($this->ProductTable,$RefProductID);*/

		$data['productName'] 				= $product_row['productName'];
		$data['productPrice'] 				= $product_row['productPrice'];
		$data['ProductSupscriptionPeriod']  = $product_row['ProductSupscriptionPeriod'];
		$data['ProductSupscriptionPeriod']	= $ProductSupscriptionPeriod/30;
		
		if($_REQUEST['price'] != ''){
			$data['productPrice'] = $_REQUEST['price'];
		}
		$data['message'] = ''; 
		$data['result'] = $this->common_model->get_all_records('t_country', 'status = "Y"' ,'id','ASC',$offset,$limit);
		$where="companyID ='".COMPANYID."' and status='Y'";
		$data['ResultProduct'] 	= $this->common_model->get_all_records($this->ProductTable, $where,'productName','ASC',$offset,$limit);
		$data['resultCategory'] 	= $this->common_model->get_all_records($this->categoryTable, '','name','ASC',$offset,$limit);
		
		$data['gateway_result'] = $this->common_model->get_all_records_joined('M1.*',"M1.companyID ='".COMPANYID."' and M1.`status` = 'Y' and M2.paymentType = 'credit_card'" ,'t_gateway', ' t_midmaster', 'gatewayID', 'gatewayID','M1.gatewayID','ASC',$offset,$limit);
		$data['product_cart'] = $this->db->query('select a.id as cartID,a.*,b.* from t_cart as a left join t_product as b on a.product_id=b.id where a.customer_ip="'.$_SERVER['REMOTE_ADDR'].'" and a.status="0"');
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
		//$row = $this->common_model->Retrive_Record('t_gateway',$id);
		$row = $this->common_model->Retrive_Record_By_Where_Clause('t_midmaster','gatewayID like "%'.$id.'%"');
		
		echo json_encode(array('gatewayName' => $row['gatewayID'],'directory' => $row['directory'],'programName' => $row['programName'],'descriptor' => $row['descriptor']));			
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
			   
			   //$gateway_result = $this->common_model->get_all_records('t_gateway', "companyID ='".COMPANYID."' and `status` = 'Y' and paymentType = '".$PaymentType."'" ,'id','ASC',$offset,$limit);
			   $gateway_result = $this->common_model->get_all_records_joined('M1.*',"M1.companyID ='".COMPANYID."' and M1.`status` = 'Y' and M2.paymentType = '".$PaymentType."'" ,'t_gateway', ' t_midmaster', 'gatewayID', 'gatewayID','M1.gatewayID','ASC',$offset,$limit);
				foreach($gateway_result->result() as $gateway_row) {
					$disp .= "<option value='".$gateway_row->gatewayID."'>". $gateway_row->gatewayID."</option>";
				}
			   
	$disp .="</select></td></tr>";
	echo $disp;	
	}
	public function process(){
		//error_reporting(0);
		//print_r($_POST);
		//exit;
		if($this->input->post("product_price")=="" || $this->input->post("product_price")==0){
			$message = setMessage('Transaction Unsuccessful. Please Select Product First To Proceed.',"error");
			$this->session->set_flashdata('message', $message);
			redirect(site_url($this->controller));
			exit;
		}		
		$order_id = time();
		/**************************Customer General Details********************/
		$insert['fname']				= $this->input->post("fname");
		$insert['lname']				= $this->input->post("lname");
		$insert['email']				= $this->input->post("email");
		$insert['contact']				= $this->input->post("contact");
		$insert['address']				= $this->input->post("address");
		$insert['country']				= $this->input->post("country");
		$insert['state']				= $this->input->post("state");
		$insert['city']					= $this->input->post("city");
		$insert['zip']					= $this->input->post("zip");

		/*************************Payment Related Data**************************/
		$insert['companyID']			= COMPANYID;
		$insert['gatewayID']			= $this->input->post("gatewayID");
		//$insert['decriptor']			= $this->input->post("descriptor");

		$insert['programName']			= $this->input->post("programName");
		$insert['agentid']				= $this->input->post("agentid");
		$insert['PaymentType']			= $this->input->post("PaymentType");

		/***************************Credit Card Details*************************/
		$insert['cardtype']				= $this->input->post("cardtype");
		$insert['nameoncard']			= $this->input->post("nameoncard");
		if($this->input->post("cardnumber") !=""){
		$insert['cardnumber']			= $this->input->post("cardnumber");
		}
		else if($this->input->post("cardnumber") == ""){
			$insert['cardnumber']			= $this->input->post("creditcard1").$this->input->post("creditcard2").$this->input->post("creditcard3").$this->input->post("creditcard4");
		}
		$insert['cvv']					= $this->input->post("cvv");
		$insert['month']				= $this->input->post("month");
		$insert['year']					= $this->input->post("year");
		
		/*********************Echecking Details**********************************/
		$insert['routingNumber']		= $this->input->post("routingNumber");
		$insert['accountNumber']		= $this->input->post("accountNumber");
		$insert['bankName']				= $this->input->post("bankName");
		$insert['checkDate']			= $this->input->post("checkDate");
		$insert['checkNumber']			= $this->input->post("checkNumber");
		$insert['checkMemo']			= $this->input->post("checkMemo");
		
		/************************Other Details***********************************/
		$insert['ip']					=  $_SERVER['REMOTE_ADDR'];
		$insert['product_price']		= $this->input->post("product_price");
		$singleProductName				= $this->input->post("singleProductName");
		$cartID							= $this->input->post("cartID");
		
		//$this->TableCustomer
		$customerId = $this->db->query("select id from ".$this->TableCustomer."  where customer_email like '%".$insert['email']."%' or customer_phone like '%".$insert['contact']."%'")->row()->id;
		//echo $this->db->last_query();
		//exit;
		if($customerId != ""){
			$insertInvoice['customerId'] = $customerId;		
			//echo $customerId;
			//exit;
		}else{
	
			$insertCustomer['companyID'] = COMPANYID;
			$insertCustomer['fname'] = $insert['fname'];
			$insertCustomer['lname'] = $insert['lname'];
			$insertCustomer['customer_email'] = $insert['email'];
			$insertCustomer['customer_address'] = $insert['address'];
			$insertCustomer['customer_city'] = $insert['city'];
			$insertCustomer['customer_state'] = $insert['state'];
			$insertCustomer['customer_country'] = $insert['country'];
			$insertCustomer['customer_zip'] = $insert['zip'];
			$insertCustomer['customer_phone'] = $insert['contact'];
			$insertCustomer['rec_crt_date'] = date('Y-m-d H:i:s');
			
			$insert_customer_id = $this->common_model->Add_Record($insertCustomer,$this->TableCustomer);
			$insertInvoice['customerId'] = $insert_customer_id;
		}
		
		$agentName = $this->db->query("select b.name from ".$this->transactionCodeTable." as a left join ".$this->adminTable." as b on a.agent_id=b.id where transaction_code='".$insert['agentid']."'")->row()->name;
		
		$agentPrimaryId = $this->db->query("select b.id from ".$this->transactionCodeTable." as a left join ".$this->adminTable." as b on a.agent_id=b.id where transaction_code='".$insert['agentid']."'")->row()->id;
		if($agentName==""){
			$agentName = 'Missing';
		}
		/*****************************Fetching Center Details*************************************/
		$where_clause_center = "companyID = '".addslashes(COMPANYID)."'";
		$rowCenter = $this->common_model->Retrive_Record_By_Where_Clause($this->centerTable,$where_clause_center);
		//print_r($rowCenter);
		$company_invoice_prefix = $rowCenter['company_invoice_prefix'];
		$tranactionMode 		= $rowCenter['tranactionMode'];
		$company_name 			= $rowCenter['company_name'];		
		//$daily_volume 			= $rowCenter['daily_volume'];
		//$tranactionMode="Sale";
		date_default_timezone_set('US/Eastern');
		/////////////////////////////////////////Mid Selection///////////////////////////////////
		if(MIDSELECTIONPROCESS=='Y'){
			if($tranactionMode=="Auth"){
				if($insert['product_price'] > SYSTEMMAXSALESALLOWED){
					//$listGateways = $this->db->query("Select distinct gatewayID from t_midmaster as b where b.gatewayID NOT IN ( select gatewayID from t_invoice as a where (a.status='Authorize' and  a.grossPrice > ".SYSTEMMAXSALESALLOWED." group by a.gatewayID ) and b.status='Y' and b.paymentType = '".$_REQUEST['PaymentType']."' and b.MaxSalesAmount > '".$insert['product_price']."' order by gatewayID");
					$listGateways = $this->db->query("Select distinct gatewayID from t_midmaster as b where b.gatewayID NOT IN ( select gatewayID from t_invoice as a where a.status='Authorize' and  a.grossPrice > ".SYSTEMMAXSALESALLOWED." group by a.gatewayID ) and b.status='Y' and b.paymentType = '".$_REQUEST['PaymentType']."' and b.MaxSalesAmount > '".$insert['product_price']."' order by gatewayID");
					if($listGateways->num_rows()==0){
						$listGateways = $this->db->query("Select distinct(a.gatewayID) as gatewayID, count(*) as cnt  from  t_midmaster as a left join t_invoice as b on a.gatewayID=b.gatewayID where a.visibility='Y' and a.status='Y' and b.grossPrice > ".SYSTEMMAXSALESALLOWED." and b.status='Authorize' and a.paymentType = '".$_REQUEST['PaymentType']."' and a.MaxSalesAmount > '".$insert['product_price']."' group by a.gatewayID  order by cnt asc");
						
					}				
				}else{
					if(MIDSELECTION=='N'){
						$listGateways = $this->db->query("Select distinct gatewayID from t_midmaster as b where b.gatewayID NOT IN ( select gatewayID from t_invoice as a where a.status='Authorize' group by a.gatewayID having sum(a.grossPrice) > 0) and b.status='Y' and b.paymentType = '".$_REQUEST['PaymentType']."' and b.MaxSalesAmount > '".$insert['product_price']."' order by gatewayID");
						if($listGateways->num_rows()==0){
							$listGateways = $this->db->query("Select distinct(a.gatewayID) as gatewayID, sum(b.grossPrice) as sum  from  t_midmaster as a left join t_invoice as b on a.gatewayID=b.gatewayID where a.visibility='Y' and a.status='Y' and b.status='Authorize' and a.paymentType = '".$_REQUEST['PaymentType']."' and a.MaxSalesAmount > '".$insert['product_price']."' group by a.gatewayID order by sum asc");
						}
					}
					if(MIDSELECTION=='Y'){
					/**************************************/	
						$listGateways = $this->db->query("Select distinct gatewayID from t_midmaster as b where b.gatewayID NOT IN ( select gatewayID from t_invoice as a where a.status='Authorize' and a.grossPrice <= ".SYSTEMMAXSALESALLOWED." group by a.gatewayID having sum(a.grossPrice) > 0) and b.status='Y' and b.paymentType = '".$_REQUEST['PaymentType']."' and b.MaxSalesAmount > '".$insert['product_price']."' order by gatewayID");
						if($listGateways->num_rows()==0){
							$listGateways = $this->db->query("Select distinct(a.gatewayID) as gatewayID, sum(b.grossPrice) as sum  from  t_midmaster as a left join t_invoice as b on a.gatewayID=b.gatewayID where a.visibility='Y' and a.status='Y' and b.status='Authorize' and b.grossPrice <= ".SYSTEMMAXSALESALLOWED." and a.paymentType = '".$_REQUEST['PaymentType']."' and a.MaxSalesAmount > '".$insert['product_price']."' group by a.gatewayID order by sum asc");
						}					
					/**************************************/	
					}
				}
			}
			if($tranactionMode=="Sale"){
					$listGateways = $this->db->query("Select distinct gatewayID from t_midmaster as b where b.gatewayID NOT IN ( select gatewayID from t_invoice as a where (a.status='Capture' or a.status='Sale' or (a.status='Settlement' and a.rec_crt_date > '".date('Y-m-d')." 00:00:00') ) group by a.gatewayID having sum(a.grossPrice) > 0) and b.status='Y' and b.paymentType = '".$_REQUEST['PaymentType']."' and b.MaxSalesAmount > '".$insert['product_price']."' order by gatewayID");
					if($listGateways->num_rows()==0){
						$listGateways = $this->db->query("Select distinct(a.gatewayID) as gatewayID, a.daily_volume, sum(b.grossPrice) as sum  from  t_midmaster as a left join t_invoice as b on a.gatewayID=b.gatewayID where a.visibility='Y' and a.status='Y' and (b.status='Capture' or b.status='Sale' or (b.status='Settlement' and b.rec_crt_date > '".date('Y-m-d')." 00:00:00')) and a.paymentType = '".$_REQUEST['PaymentType']."' and a.MaxSalesAmount > '".$insert['product_price']."' group by a.gatewayID having sum < a.daily_volume order by sum asc");
					}				
			}
			//echo $this->db->last_query();
			//exit;
			//$insert['gatewayID'] = $listGateways;
			$rowCount = 1;
			$start_date = date('m-01-Y');
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			
			$end_date = date('m-d-Y');			
			$end_parts = explode('-',$end_date);
			$yyyy_mm_dd1 = $end_parts[2] . '-' . $end_parts[0] . '-' . $end_parts[1];
			
			foreach($listGateways->result() as $val){
				//print_r($val);
				//echo $val->gatewayID;
				/**************************Getting The Sum of Settle Sale and Capture Values of Mid*******************************/
				$grossSum =$this->db->query("Select sum(grossPrice) as sum from t_invoice where gatewayID='".$val->gatewayID."' and rec_up_date >=  '".$yyyy_mm_dd." 00:00:00' AND rec_up_date <=  '".$yyyy_mm_dd1." 23:59:59' and (status='Settlement' or status='Sale' or status='Capture')")->row()->sum;
				
				/*********************************Getting Monly value of Mid*****************************************************/
				$monthly_value=$this->db->query("Select monthly_volume from t_midmaster where gatewayID='".$val->gatewayID."'")->row()->monthly_volume;
				
				if($listGateways->num_rows() < 2){
					$insert['gatewayID'] = $val->gatewayID;
					$rowCount++;
				}
				if($monthly_value > $grossSum && $rowCount==1){
					$insert['gatewayID'] = $val->gatewayID;
				}
				if($monthly_value > $grossSum){
					$rowCount++;
				}				
			}
		}
		if($insert['gatewayID']==""){
			$responsetext = "No Gateway Selected";
		}	
		$insert['gatewayID'];	
		/*echo $insert['gatewayID'];
		exit;*/
		/////////////////////////////////////////////////////////////////////////////////////////
		$where_clause_gateway = "gatewayID = '".addslashes($insert['gatewayID'])."'";
		$rowGateway = $this->common_model->Retrive_Record_By_Where_Clause($this->TableMidmaster,$where_clause_gateway);
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
		$insert['decriptor'] = $rowGateway['descriptor']; 
		
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
		//$agentID = $insert['agentid'];
		$agentID = $agentName;
		$companyID = COMPANYID;
		$order_id = $company_invoice_prefix.$order_id;
		$responsetext = 'Error Processing Transaction';
		
		$allowedPayment = 0 ;
		$failedAttempts = FAILEDATTEMPTS;
		$systemEmail=$this->db->query("SELECT GROUP_CONCAT(email) as systemEmail FROM `t_admin` WHERE `adminPermission` = 'system' group by adminPermission")->row()->systemEmail;
		$goodSaleExists = $this->db->query("select * from ".$this->invoiceTable." where cardNo='".$insert['cardnumber']."' and (status='Capture' or status='Sale' or status='Authorize' or status='Settlement')")->num_rows();
		if($goodSaleExists > 0){
			
			$comments="Name: ".$fname." ".$lname."<br/> Email : ".$email."<br/> Card No: ".$cardnumber."";
			
			require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/email_function.php");
			require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/warningEmail.php");
			//mail_smtp(GORADEMAIL,'Duplicate Notification',$warningEmail,COMPANYEMAIL,'','');			
			mail_file_attach2(GORADEMAIL,'Duplicate Notification',$warningEmail,COMPANYEMAIL,'',$systemEmail,COMPANYEMAIL,'');			
		}
		$rowcountFailed = $this->db->query("select * from ".$this->invoiceTable." where cardNo='".$insert['cardnumber']."' and status='Failed'")->num_rows();
		if($failedAttempts == 0){
			$allowedPayment = 1;
		}else if($failedAttempts > $rowcountFailed){
			$allowedPayment = 1;
		}
		/***************************Including the Api file***********************/
		if($allowedPayment == 1){
			require_once($_SERVER['DOCUMENT_ROOT'].'/system/gateways/'.$programName);
		}else{
			$responsetext = 'You can not process this transaction with this credit card after '.$failedAttempts.' attempts.  The system admin will be notified on the next attempt.  Thank you.';
			$to='stephen.lapoint@gmail.com';
			$subject='Payment tried with card exceeding failure limit.';
			$msg="Payment tried with card exceeding failure limit.\n";
			$msg .="Details : \n";
			$msg .="First Name : ".$fname." \n";
			$msg .="Last name : ".$lname." \n";
			$msg .="Card No : ".$insert['cardnumber']." \n";
			$msg .="Agent : ".$agentName." \n";
			$msg .="Company Id : ".$companyID." \n";
			mail($to,$subject,$msg);
		}
		//$str = '1';
		//$ssl_txn_id = '0';
		if($str != '1'){
			$action_type="failed";
			$validated='Y';
		}		
		if($ssl_txn_id==""){
			$action_type="failed";
			$validated='Y';
		}
		//if($ssl_txn_id!=""){
		/**************************Inserting Into Invoice Table****************************/
			$insertInvoice['companyID'] = COMPANYID;
			$insertInvoice['invoice_id'] = $order_id;
			//$insertInvoice['customerId'] = $insertid;
			//$insertInvoice['customerId'] = $unique_pin;
			//$insertInvoice['agentID'] = $agentID;
			$insertInvoice['agentID'] = $agentPrimaryId;
			$insertInvoice['agentName'] = $agentName;
			
			$insertInvoice['fname'] = $insert['fname'];
			$insertInvoice['lname'] = $insert['lname'];
			$insertInvoice['customer_email'] = $insert['email'];
			$insertInvoice['customer_address'] = $insert['address'];
			$insertInvoice['customer_city'] = $insert['city'];
			$insertInvoice['customer_state'] = $insert['state'];
			$insertInvoice['customer_country'] = $insert['country'];
			$insertInvoice['customer_zip'] = $insert['zip'];
			$insertInvoice['customer_phone'] = $insert['contact'];
			$phone = $insert['contact'];
			$insertInvoice['cardType'] = $insert['cardtype'];
			$insertInvoice['cardNo'] = $insert['cardnumber'];
			$insertInvoice['gatewayID'] = $gatewayID;
			$insertInvoice['gatewayTransactionId'] = $ssl_txn_id;
			//$insertInvoice['sign'] = $insert['output'];
			$insertInvoice['gateway_descriptor'] =$insert['decriptor'];
			//$insertInvoice['company_name'] = $company_name;
			//$insertInvoice['productDuration'] = $insert['SupscriptionPeriod'];
			$insertInvoice['RoutingNumber'] = $insert['routingNumber'];
			$insertInvoice['AccountNumber'] = $insert['accountNumber'];
			$insertInvoice['BankName'] = $insert['bankName'];	
			$insertInvoice['CheckDate'] = $insert['checkDate'];
			$insertInvoice['CheckNumber'] = $insert['checkNumber'];
			$insertInvoice['CheckMemo'] = $insert['checkMemo'];
			$insertInvoice['paymentType'] = $paymentType;
			/*$insertInvoice['securityProtection'] = $insert['securityProtection'];
			$insertInvoice['totalDevices'] = $insert['totalDevices'];*/
			$insertInvoice['cvvresponse'] = $cvvresponse;
			$insertInvoice['avsresponse'] = $avsresponse;
			$insertInvoice['grossPrice'] = $product_price;
			$insertInvoice['reason_code']	= $response_code;
			$insertInvoice['reason_descrption']	= $responsetext;;
			//$insertInvoice['final_action_type'] = $action_type;
			$insertInvoice['sourceCode']			= $_SERVER['HTTP_HOST'];
			$insertInvoice['status'] = $action_type;
			$insertInvoice['rec_crt_date'] = date('Y-m-d H:i:s');
			$insertInvoice['expDate'] = $month.$year;
			$insertInvoice['cvv'] = $cvv;			
			$insertInvoice['totalDevices'] = $this->input->post("totalDevices");
			$insertInvoice['securityProtection'] = $this->input->post("securityProtection");

			
			$insert_invoive_id = $this->common_model->Add_Record($insertInvoice,$this->invoiceTable);
			//$insert_invoive_id = $this->common_model->Add_Record($insert,$this->invoiceTable);
			//$this->actionTable
			
			/*$insertAction['transaction_id'] = $ssl_txn_id;
			$insertAction['response_code']	= $response_code;
			$insertAction['response_text']	= $responsetext;
			$insertAction['action_type']	= $action_type;
			$insertAction['amount']			= $product_price;
			$insertAction['source']			= $_SERVER['HTTP_HOST'];
			$insertAction['agentId']		= $agentID;
			$insertAction['ip_address']		= $insert['ip'];
			$insertAction['rec_crt_date']	= date('Y-m-d H:i:s');
			
			$insert_action_id = $this->common_model->Add_Record($insertAction,$this->actionTable);*/
			
			if($str == '1'){
				foreach($cartID	as $val){
					//$insert_invoive_id;
					$this->db->query("Update ".$this->cartTable." set status='1', invoice_id='".$insert_invoive_id."' where id='".$val."'" );
				}
				$gateway_descriptor=$insert['decriptor'];
				$Gorad_Billing_Number=GORADBILLINGNUMBER;
				$sign=$insert['output'];
				$agent_name=$agentName;
				$ip	= $insert['ip'];
				$orderid = $order_id;
				$Company_PDF_Name 		= COMPANYPDFNAME;
				$company_phonenumber 	= COMPANYPHONE;
				$company_email			= COMPANYEMAIL; 
				$company_feedback_email = COMPANYFEEDBACKEMAIL;
				$send_feedback_form 	= SENDFEEDBACKFORM; 
				$company_invoice_email	= COMPANYINVOICEEMAIL;
				$company_invoice_prefix = COMPANYINVOICEPREFIX;
				$Additional_Group_email1= ADDITIONALGROUPEMAIL;
				$Gorad_email 			= GORADEMAIL;
				$Gorad_Billing_Number   = GORADBILLINGNUMBER;				
				$SENDEMAIL   			= SENDEMAIL;				
				$company_name   		= COMPANYNAME;				
				$productNameShow   		= PRODUCTNAMESHOW;	

			if($ssl_txn_id!=""){	
				
				require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/email_function.php");
				$time = time();
				require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."dompdf/dompdf_config.inc.php");
				//require_once 'signature-to-image.php';					
				////////////  Generating Image From E-Sign  /////////////////////
				/*$img = sigJsonToImage($sign);
				imagepng($img, $time.'.png');
				$img =  $time.'.png';*/
				////////////  End Generating Image From E-Sign  /////////////////////
				
				////////////  Invoice & Auth Email Start  /////////////////////
				require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/pdf_template.php");
				
				$dompdf = new DOMPDF();
				$dompdf->load_html($pdf_html);
				$dompdf->render();
				file_put_contents($time.'.pdf', $dompdf->output());

				if($SENDEMAIL=='Y'){
					require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/order_email_template1.php");		
					mail_file_attach( $email, 'Order Status', $orderwelcome, $company_email, $time.'.pdf',$Gorad_email,$company_invoice_email, $Additional_Group_email1 );
					
					require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/feedback_email_template.php");
					require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/welcome_email_template.php");

					mail_smtp($email,'Welcome to '.$gateway_descriptor.'',$welcomeHtml,$company_email,$Gorad_email,$Additional_Group_email1);
					mail_smtp($email,'Feedback and Authorization Email',$feedbackhtml,$company_email,$Gorad_email,$Additional_Group_email1);
				}
				
				/************************/
				unlink($time.'.pdf');
			}
				//echo 'test1';
				//exit;
				//unlink($time.'.png');
				//echo '<h1 style="color:#060; text-align:center">Payment Successful</h1>';
				//$message = setMessage('Payment Successfull.',"success");
				/********************************************************/
					$this->session->set_userdata('gateway_descriptor', $gateway_descriptor);
					$this->session->set_userdata('customer_name', ucfirst($fname).' '. ucfirst($lname));
					$this->session->set_userdata('address', $address);
					$this->session->set_userdata('orderid', $orderid);
					$this->session->set_userdata('city', $city);
					$this->session->set_userdata('state', $state);
					$this->session->set_userdata('zip', $zip);
					$this->session->set_userdata('country', $country);
					$this->session->set_userdata('email', $email);
					$this->session->set_userdata('insert_invoive_id', $insert_invoive_id);
					
					$this->session->set_userdata('product_price', $product_price);
					
					
				/********************************************************/
				//$this->load->view('success',$data);				
				redirect(site_url('payment/success', $data));
				exit;
			}else{
				$this->session->set_userdata('response_code', $response_code);
				$this->session->set_userdata('responsetext', $responsetext);
				$message = setMessage($responsetext,"error");
				redirect(site_url('payment/failure', $data));
				exit;
			}						
		//}else{
			$this->session->set_userdata('response_code', $response_code);
			$this->session->set_userdata('responsetext', $responsetext);			
			$message = setMessage($responsetext,"error");
			redirect(site_url('payment/failure', $data));
			exit;
		//}
		//$this->session->set_flashdata('message', $message);		
		//redirect(site_url('payment').'?product='.$insert['product_id'].'&price='.$insert['product_price']);			
		//redirect(site_url('payment'));	
		//redirect(site_url($this->controllerFile));
	}
	public function success(){
		$this->load->view('success',$data);
	}	
	public function failure(){
		$this->load->view('failure',$data);
	}
	public function credit_card(){
		/*echo 'hi';
		exit; */
		$data['message'] = ''; 
		$data['result'] = $this->common_model->get_all_records('t_country', 'status = "Y"' ,'id','ASC',$offset,$limit);		
		$this->load->view('credit_card',$data);
	}
	public function echecking(){
		$data['message'] = ''; 
		$data['result'] = $this->common_model->get_all_records('t_country', 'status = "Y"' ,'id','ASC',$offset,$limit);		
		$this->load->view('echecking',$data);
	}
	public function changeProduct(){
		$productNameSelect = $_REQUEST['productNameSelect'];
		$data['productNameSelect'] = $productNameSelect;
		$categorySelect = $_REQUEST['categorySelect'];	
		//$where="companyID ='".COMPANYID."' and status='Y'";
		$data['result'] = $this->common_model->get_all_records($this->ProductTable, "`category` = '".$categorySelect."' and companyID ='".COMPANYID."' and status='Y'",$productNameSelect,'ASC',$offset,$limit);
		/*echo '<select name="selectProduct" id="selectProduct" class="form-control" >';
        echo '<option value="">Select</option>';
        foreach($result->result() as $row) {
			echo  '<option value="'.$row->id.'"><strong>'.$row->$productNameSelect.'  -  '.$row->dosage.'  -  $'.$row->amount.'</strong></option>';
        } 
    	echo '</select>';	*/
		//echo $this->db->last_query();
		echo $this->load->view("selectProduct",$data);
	}
	public function insertCart() 
	{
		$id = $this->input->post('selectProduct');
		$row = $this->common_model->Retrive_Record($this->ProductTable,$id);

		/********************Service Type charge calculation************/
		$newProductPrice = $row['productPrice'];		
		if(SERVICETYPE!='None'){
			$randomPercentage=mt_rand(MINPERCENTAGE*10, MAXPERCENTAGE*10)/10;
		}
		if(SERVICETYPE=='Fee'){
			$newProductPrice = number_format($row['productPrice'] + ($row['productPrice'] * $randomPercentage/100),2);
		}		
		if(SERVICETYPE=='Discount'){
			$newProductPrice = number_format($row['productPrice'] - ($row['productPrice'] * $randomPercentage/100),2);
		}		
		/**************************************************************/		
		
		$insertCart['customer_ip'] 		= $_SERVER['REMOTE_ADDR'];
		$insertCart['product_id'] 		= $id;
		$insertCart['quantity'] 		= '1';
		//$insertCart['price_each'] 		= $row['productPrice'];
		$insertCart['price_each'] 		= $newProductPrice;
		$insertCart['rec_crt_date'] 	= date('y-m-d H:i:s');
		$insertid = $this->common_model->Add_Record($insertCart,$this->cartTable);
		$data['product_cart'] = $this->db->query('select a.id as cartID,a.*,b.* from t_cart as a left join t_product as b on a.product_id=b.id where a.customer_ip="'.$_SERVER['REMOTE_ADDR'].'" and a.status="0"');
		echo $this->load->view('cartArea', $data);
	}
	public function updateItem(){
		$id= $this->input->post('id');
		$rowCart['quantity']   = $this->input->post('quantity');
		$rowCart['price_each'] = $this->input->post('price_each');
		$this->db->where('id', $id);
		$this->db->update($this->cartTable, $rowCart);	
		$data['product_cart'] = $this->db->query('select a.id as cartID,a.*,b.* from t_cart as a left join t_product as b on a.product_id=b.id where a.customer_ip="'.$_SERVER['REMOTE_ADDR'].'" and a.status="0" ');
		echo $this->load->view('cartArea', $data);			
	}	
	public function removeItem(){
		$id= $this->input->post('id');
		$this->db->query('delete from '.$this->cartTable.' where id="'.$id.'"');
		$data['product_cart'] = $this->db->query('select a.id as cartID,a.*,b.* from t_cart as a left join t_product as b on a.product_id=b.id where a.customer_ip="'.$_SERVER['REMOTE_ADDR'].'" and a.status="0"');
		echo $this->load->view('cartArea', $data);		
	}
	public function amex(){
		$data['message'] = ''; 
		$this->load->view('amex',$data);
	}	
	public function normalCard(){
		$data['message'] = ''; 
		$this->load->view('normalCard',$data);
	}
	public function insertPay() 
	{
		$id = $this->input->post('product');
		$price = $this->input->post('price');
		/*echo $id;
		exit;*/
		$row = $this->common_model->Retrive_Record($this->ProductTable,$id);
		$insertCart['customer_ip'] 		= $_SERVER['REMOTE_ADDR'];
		$insertCart['product_id'] 		= $id;
		$insertCart['quantity'] 		= '1';
		$insertCart['price_each'] 		= $price;
		$insertCart['rec_crt_date'] 	= date('y-m-d H:i:s');
		$insertid = $this->common_model->Add_Record($insertCart,$this->cartTable);
		//$data['product_cart'] = $this->db->query('select a.id as cartID,a.*,b.* from t_cart as a left join t_product as b on a.product_id=b.id where a.customer_ip="'.$_SERVER['REMOTE_ADDR'].'" and a.status="0"');
		//echo $this->load->view('cartArea', $data);
		redirect(site_url('payment', $data));
	}	
}

