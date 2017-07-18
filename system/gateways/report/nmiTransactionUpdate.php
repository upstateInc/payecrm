<?php
function testXmlQuery($username,$password,$constraints)
{
    $transactionFields = array(
        'transaction_id',
        'transaction_type',
        'condition',
        'order_id',
        'authorization_code',
        'ponumber',
        'orderdescription',
        'avs_response',
        'csc_response',


        'first_name',
        'last_name',
        'address_1',
        'address_2',
        'company',
        'city',
        'state',
        'postal_code',
        'country',
        'email',
        'phone',
        'fax',
        'cell_phone',
        'customertaxid',
        'customerid',
        'website',

        'shipping_last_name',
        'shipping_address_1',
        'shipping_address_2',
        'shipping_company',
        'shipping_city',
        'shipping_state',
        'shipping_postal_code',
        'shipping_country',
        'shipping_email',
        'shipping_carrier',
        'tracking_number',
		'cc_type',
        'cc_number',
        'cc_hash',
        'cc_exp',
        'cc_bin',
        'avs_response',
        'csc_response',
        'cardholder_auth',

        'processor_id',

        'tax');
    // actionFields is used to validate the XML tags in the
    // action element
     $actionFields = array(
 		 'batch_id',
		 'processor_batch_id',
		 'response_code',    
         'amount',
         'action_type',
         'date',
         'success',
         'ip_address',
         'source',
         'response_text'
          );

    $postStr='username='.$username.'&password='.$password. $constraints;
    $url="https://secure.networkmerchants.com/api/query.php?". $postStr;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_REFERER, "");
    $response = curl_exec($ch);
    curl_close($ch);
    return $arr = simplexml_load_string($response);
}

try {
	$db_two_use 		= 'yes';
	$host_name_two 		= 'localhost';
	$db_username_two 	= "scare518_master";
	$db_password_two 	= "aAvv2CP+OF1T";
	$db_name_two		= "scare518_master";	

	$con_two = mysqli_connect($host_name_two,$db_username_two,$db_password_two,$db_name_two);
	date_default_timezone_set("UTC");
	$yesterday=date('Ymd',strtotime("-1 day"));
	$today=date('YmdHis');

    $constraints = "&start_date=".$yesterday."000000&end_date=".$today."";
    //$constraints = "&start_date=20150601000000&end_date=".$today."";
	$query="select * from t_midmaster where gatewayType='nmi' and cron='Y'";
	$gatewayResult= mysqli_query($con_two,$query);
	while($rowGateway = mysqli_fetch_assoc($gatewayResult)) {
		$result = testXmlQuery($rowGateway['username'],$rowGateway['password'],$constraints);
		foreach($result as $a)
		{
			/*************Time Calculation***************/
				date_default_timezone_set('US/Eastern');
				$date1=date('Y-m-d H:i:s');
				date_default_timezone_set("UTC");
				$date2=date('Y-m-d H:i:s');
				$diff = strtotime($date2) - strtotime($date1);			
			/********************************************/				
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
			if($transaction_id!=""){
				for($i=0;$i<$cnt;$i++){			
					if($a->action[$i]->action_type=='sale'){
						$captured_by = 'Cron';
						$captured_date = date("Y-m-d H:i:s",strtotime($a->action[$i]->date)-$diff);						
					}
					if($a->action[$i]->action_type=='capture'){
						$captured_by = 'Cron';
						$captured_date = date("Y-m-d H:i:s",strtotime($a->action[$i]->date)-$diff);						
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
					$cardType=mysqli_query($con_two,"select cardType from t_invoice where gatewayTransactionId = '".$original_transaction_id."'")->fetch_row()[0];
					if($cardType==''){
						$cardType='CC';
					}
				}
				$AgentName		=	$a->merchant_defined_field[1];
				$productName	=	$a->order_description;
				$customerEmail	=	$a->email;
				$centerStatus=mysqli_query($con_two ,"select status from t_centerdb where  companyID='".$companyID."'")->fetch_row()[0];
				$centerStatus1=mysqli_query($con_two ,"select * from t_centerdb where  companyID='".$companyID."'");
				$rowcount=mysqli_num_rows($centerStatus1);	
				if($rowcount > 0){		
					if($centerStatus=='Y'){
						$getResult="select * from t_invoice where gatewayTransactionId=".$transaction_id;
						$queryResult=mysqli_query($con_two, $getResult);
						$productId=mysqli_query($con_two,"select id from  t_product where productName like '%".$product."%'")->fetch_row()[0];
						$getAgentId=mysqli_query($con_two,"select id from t_admin where name like '%".$AgentName."%'")->fetch_row()[0];
					////////////////Master Table///////////////////
					if($status=="Failed" || $status=="Void" || $status=="Refund" || $status=="Settlement"){
						$validated=mysqli_query($con_two,"select validated from t_invoice where gatewayTransactionId = '".$transaction_id."'")->fetch_row()[0];
						if($validated=='N'){
							$validated = 'Y';
						}
						$qc_agentID=mysqli_query($con_two,"select qc_agentID from t_invoice where gatewayTransactionId = '".$transaction_id."'")->fetch_row()[0];
						if($qc_agentID==""){
							$qc_agentID = 'api';
						}
						$qc_Date=mysqli_query($con_two,"select qc_Date from t_invoice where gatewayTransactionId = '".$transaction_id."'")->fetch_row()[0];
						if($qc_Date=='0000-00-00 00:00:00'){
							$qc_Date = date("Y-m-d H:i:s",strtotime($a->action[$cnt-1]->date)-$diff);
						}
					}
					$getResult="select * from t_invoice where gatewayTransactionId=".$transaction_id;
					$queryResult=mysqli_query($con_two, $getResult);			
					if(mysqli_num_rows($queryResult) > 0){
						if($locked=='Y'){
							echo $sql="update t_invoice set status='".$status."', batch_id='".$a->action[$cnt-1]->batch_id."', `locked`='".$locked."', rec_up_date='".date("Y-m-d H:i:s",strtotime($a->action[$cnt-1]->date)-$diff)."', captured_by='".$captured_by."', captured_date='".$captured_date."', validated='".$validated."', qc_agentID='".$qc_agentID."', qc_Date='".$qc_Date."' where gatewayTransactionId=".$transaction_id."";
						}else{
							echo $sql="update t_invoice set status='".$status."', batch_id='".$a->action[$cnt-1]->batch_id."', rec_up_date='".date("Y-m-d H:i:s",strtotime($a->action[$cnt-1]->date)-$diff)."', captured_by='".$captured_by."', captured_date='".$captured_date."', validated='".$validated."', qc_agentID='".$qc_agentID."', qc_Date='".$qc_Date."' where gatewayTransactionId=".$transaction_id."";
						}
						mysqli_query($con_two, $sql);
					}				
					else{
						/******************Customer Table*******************/
						$getCustomerId=mysqli_query($con_two,"select id from t_customer where customer_email like '%".$customerEmail."%'")->fetch_row()[0];
						if($getCustomerId==""){
							echo $insertCustomer = "INSERT INTO t_customer (companyID,fname,lname,customer_email,customer_address,customer_city,customer_state,customer_country,customer_zip,customer_phone,rec_crt_date)  VALUES (
							'".$a->merchant_defined_field[2]."',
							'".addslashes(trim($a->first_name))."',
							'".addslashes(trim($a->last_name))."',								
							'".addslashes(strtolower($a->email))."', 								
							'".addslashes($a->address_1)."',
							'".addslashes($a->city)."',
							'".addslashes($a->state)."',
							'".addslashes($a->country)."',
							'".addslashes($a->postal_code)."',
							'".addslashes($a->phone)."',
							'".date("Y-m-d H:i:s",strtotime($a->action[0]->date)-$diff)."'								
							)";
							mysqli_query($con_two, $insertCustomer);
							$getCustomerId = mysqli_insert_id($con_two);
						}						
						/***************************************************/
						echo $sqlInsertMaster = "INSERT INTO `t_invoice` (
							`companyID` ,
							`gatewayID` ,
							`agentID`,
							`agent_name` ,
							`invoice_id` ,
							`customerId` ,
							`fname` ,
							`lname` ,
							`customer_email` ,
							`customer_address` ,
							`customer_city` ,
							`customer_state` ,
							`customer_country` ,
							`customer_zip` ,
							`customer_phone` ,
							`productId` ,
							`product_name` ,
							`grossPrice` ,
							`cardNo` ,				
							`gatewayTransactionId` ,
							`reason_code`,	
							`reason_descrption`,
							`originalGatewayTransactionId`,
							`locked`,
							`sourceCode`,
							`batch_id`,
							`cardType`,
							`paymentType`,
							`status`,
							`captured_by`,
							`captured_date`,				
							`rec_crt_date`,				
							`rec_up_date`,				
							`validated`,				
							`qc_agentID`,				
							`qc_Date`				
							)
						VALUES (
							'".$a->merchant_defined_field[2]."',
							'".$a->merchant_defined_field[0]."',  
							'".$getAgentId."',
							'".$a->merchant_defined_field[1]."', 	
							'".$a->order_id."',
							'".$getCustomerId."',
							'".addslashes(trim($a->first_name))."', 
							'".addslashes(trim($a->last_name))."', 
							'".addslashes($a->email)."',
							'".addslashes($a->address_1)."',
							'".addslashes($a->city)."',
							'".addslashes($a->state)."', 
							'".addslashes($a->country)."',	
							'".$a->postal_code."',  	  					  
							'".$a->phone."',					
							'".$productId."',					
							'".addslashes($a->order_description)."',
							'".$a->action[$cnt-1]->amount."',
							'".$a->cc_number."',
							'".$a->transaction_id."', 
							'".addslashes($a->action[$cnt-1]->response_code)."',
							'".addslashes($a->action[$cnt-1]->response_text)."',
							'".$a->original_transaction_id."',
							'".$locked."',
							'cron file',
							'".$a->action[$cnt-1]->batch_id."',					
							'".$cardType."',  					 
							'".$paymentType."',  					 
							'".$status."',
							'".$captured_by."',
							'".$captured_date."', 					
							'".date("Y-m-d H:i:s",strtotime($a->action[0]->date)-$diff)."',  
							'".date("Y-m-d H:i:s",strtotime($a->action[$cnt-1]->date)-$diff)."',
							'".$validated."',
							'".$qc_agentID."',
							'".$qc_Date."'
						)";
						mysqli_query($con_two, $sqlInsertMaster);
					}
					if($status=="Refund"){
							$totPartialRedund=mysqli_query($con_two,"select sum(grossPrice) as sum from t_invoice where originalGatewayTransactionId = '".$original_transaction_id."'")->fetch_row()[0];
							$orginalGrossValue=mysqli_query($con_two,"select grossPrice as sum from t_invoice where gatewayTransactionId = '".$original_transaction_id."'")->fetch_row()[0];
							$remaining=$orginalGrossValue+$totPartialRedund;
							if($remaining==0){
								$newlocked='Y';
							}else {
								$newlocked='N';
							}
							$sqllocked = "update t_invoice set `locked`='".$newlocked."' where gatewayTransactionId=".$original_transaction_id."";
							mysqli_query($con_two, $sqllocked);
					}
				}
				}
			}
		}
	}
}
	
catch (Exception $e) {
    $e->getMessage();
}