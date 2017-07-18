<?php require_once 'authorize.net/authorizenet-php-api-master/AuthorizeNet.php';
	//echo $username.','.$password;
	$sale = new AuthorizeNetAIM($username, $password);
	//$sale->setSandbox(true);
	$sale->setSandbox(false);
	$sale->setFields(
		array(
			'amount' => $product_price,
			'card_num' => $cardnumber,
			'exp_date' => $month.$year,
			'card_code' => $cvv
		)
	);
	
	/**************Customer Fields***************/
	$customer = (object)array();
	$customer->first_name = $fname;
	$customer->last_name = $lname;
	
	$customer->address = $address;
	$customer->city = $city;
	$customer->state = $state;
	$customer->zip = $zip;
	$customer->country = $country;
	$customer->phone = $contact;
	$customer->email = $email;
	$customer->cust_id = $customerId;
	$customer->customer_ip = $ip;
	$sale->setFields($customer);
	$sale->setFields("invoice_num", $order_id);
	/********************Custom Fields*****************/
	$sale->setCustomField("GatewayId", $gatewayID);
	$sale->setCustomField("CompanyId", $companyID);
	$sale->setCustomField("AgentId", $agentName);

	/*********************Product***********************/
	$sale->addLineItem(
	  $order_id, // Item Id
	  $singleProductName, // Item Name
	  $singleProductName, // Item Description
	  '1', // Item Quantity
	  $product_price, // Item Unit Price
	  'N' // Item taxable
	  );	
	/***************************************************/
	if($tranactionMode=='Auth'){
		$response = $sale->authorizeOnly();
	}
	if($tranactionMode=='Sale'){
		$response = $sale->authorizeAndCapture();
	}
	if ($response->approved) {
	//if ($response->response_code==1) {
		$str = 1;
		$responsetext 	= $response->response_reason_text;
		if($tranactionMode == "Auth" )
			$action_type = "Authorize";		
		if($tranactionMode == "Sale" )
			$action_type = "Sale";			
	} 
	else 
	{
		$str = 0;
		//echo $response->error_message;
		$responsetext 	= $response->response_reason_text.' '.$response->error_message;
		$action_type = "Failed";
	}
	$ssl_txn_id 	= $response->transaction_id;
	$response_code 	= $response->response_code;
	
	$response_code 	= 'RESPONSE CODE :'.$response->response_code;" | RESPONSE SUB CODE: ".$response->response_subcode." | RESPONSE REASON CODE: ".$response->response_reason_code;
	$avsresponse 	= $response->avs_response;
	$cvvresponse   	= $response->cavv_response;	

	/*print_r($response);
	exit;*/
?>
