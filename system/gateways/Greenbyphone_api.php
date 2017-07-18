<?php

	$url = 'https://www.greenbyphone.com/eCheck.asmx/OneTimeDraftRTV';
	 
	$ch = curl_init($url);
	 
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	 
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_TIMEOUT, 12);
	 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	 
	curl_setopt($ch, CURLOPT_POST, true);
	/** @var array $request_data */
	//Phone 
	$request_data = array(
				'Client_ID'		=>	'7555',
				'ApiPassword'	=>	'hv4kx9hp5at',
				'Name'			=>	$fname.' '.$lname,
				'EmailAddress'	=>	$email,
				'Phone'			=>	$contact,
				'PhoneExtension'=>	'',
				'Address1'		=>	$address,
				'Address2'		=>	'',
				'City'			=>	$city,
				'State'			=>	$state,
				'Zip'			=>	$zip,
				'Country'		=>	$country,
				'RoutingNumber'	=>	$insert['routingNumber'],
				'AccountNumber'	=>	$insert['accountNumber'],
				'BankName'		=>	$insert['bankName']	,
				'CheckMemo'		=>	$_REQUEST['checkMemo'],
				'CheckAmount'	=>	$product_price,
				'CheckDate'		=>	$insert['checkDate'],
				'CheckNumber'	=>	$insert['checkNumber'],
				//'x_delim_data'	=>	$_SESSION['agentName'],
				'x_delim_data'	=>	'',
				'x_delim_char'	=>	''
				//'x_delim_char'	=>	$_SESSION['ip']
	);
	 
	 
	$request_data_encoded = http_build_query($request_data);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $request_data_encoded);
	 
	$page_content = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$page_content = str_replace('xmlns="CheckProcessing"',"",$page_content);
	
	
	$arr = simplexml_load_string($page_content);
	$arr = (json_decode( json_encode($arr) , 1));
	/*echo '1';
	print_r($arr);
	exit;*/
	$result 				= $arr['Result'];
	$Check_ID 				= $arr['Check_ID'];
	$VerifyResult 				= $arr['VerifyResult'];
	$ResultDescription 			= $arr['ResultDescription'];
	
	$responsetext 	= $ResultDescription;
	$response_code 	= $VerifyResult;
	
	if($result == 0){
	
		$str 			= 1;
		$ssl_txn_id 	= $Check_ID;
		
		$avsresponse 	= '';
		$cvvresponse   	= '';
		
		$responsecode 	= 'RESPONSE CODE :'.$response_code." | AVS RESPONSE: ".$avsresponse." | CVV RESPONSE: ".$cvvresponse;
	}


?>