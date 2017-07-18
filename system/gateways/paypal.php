<?php
require('paypal/PaypalPro.php');
    $payableAmount = $insert['product_price'];
    $nameArray = explode(' ',$insert['nameoncard']);
    
    //Buyer information
    /*$firstName = $nameArray[0];
    $lastName = $nameArray[1];
    $city = $insert['city'];
    $zipcode = $insert['zip'];
    $countryCode = $insert['country'];*/
	
    $firstName = $fname;
    $lastName = $lname;
    $city = $city;
    $zipcode = $zip;
    $countryCode = $country;
    
    
    
    $custom = $companyID;
    $ipaddress = $insert['ip'];
    $invoice = $order_id;
    $phone = $contact;
	$CustomerEmail = $email;
    
    //Create an instance of PaypalPro class
    $paypal = new PaypalPro;
	
	//Payment details
	if($tranactionMode=='Auth'){
		$trnsMode = 'Authorization';
		$action_type = "Authorize";	
	}
	if($tranactionMode=='Sale'){ 
		$trnsMode = 'Sale';
		$action_type='Settlement';
	}
	//echo $trnsMode;
	//exit;
    $paypalParams = array(
        //'paymentAction' => 'Sale',
        'paymentAction' => $trnsMode,
        'amount' => $payableAmount,
        'currencyCode' => 'USD',
        'creditCardType' => $insert['cardtype'],
        'creditCardNumber' => $insert['cardnumber'],
        'expMonth' => $insert['month'],
        'expYear' => '20'.$insert['year'],
        'cvv' => $insert['cvv'],
        'firstName' => $firstName,
        'lastName' => $lastName,
        'city' => $city,
        'zip'	=> $zipcode,
        'countryCode' => $countryCode,
        'email' => $CustomerEmail,
        'custom' => $custom,
        'street' => $address,
        'state' => $state,
        'ipaddress' => $ipaddress,
        'invoice' => $invoice,
        'phone' => $phone,		
    );
	//print_r($paypalParams);
	//exit;
    $response = $paypal->paypalCall($paypalParams);
    $paymentStatus = strtoupper($response["ACK"]);	
	//print_r($response);
	//exit;
    if ($paymentStatus == "SUCCESS"){
		$data['status'] = 1;		
		$str = 1;
		
        $transactionID = $response['TRANSACTIONID'];        
		$ssl_txn_id = $transactionID;
        //Update order table with tansaction data & return the OrderID
        //SQL query goes here..........
		
        //$data['orderID'] = $OrderID;
    }else{
         $data['status'] = 0;
    }
	$response_code=$response["L_ERRORCODE0"];;
	$responsetext=$response["ACK"].$response["L_SHORTMESSAGE0"].$response["L_LONGMESSAGE0"];	
	$insertInvoice['cvvresponse'] = $response["CVV2MATCH"];	
	$insertInvoice['avsresponse'] = $response["AVSCODE"];	
	
    //echo json_encode($data);	//exit;

?>