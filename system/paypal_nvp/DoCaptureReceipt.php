<?php

/******************************************************
DoCaptureReceipt.php

Sends a DoCapture NVP API request to PayPal.

The code retrieves the authorization ID,amount and constructs
the NVP API request string to send to the PayPal server. The
request to PayPal uses an API Signature.

After receiving the response from the PayPal server, the
code displays the request and response in the browser. If
the response was a success, it displays the response
parameters. If the response was an error, it displays the
errors received.

Called by DoCapture.html.

Calls CallerService.php and APIError.php.

******************************************************/
// clearing the session before starting new API Call
/*session_unset();

require_once $_SERVER['DOCUMENT_ROOT'].'/system/NVP/CallerService.php';

session_start();*/


require($_SERVER['DOCUMENT_ROOT'].'/system/gateways/paypal/PaypalPro.php');

//$authorizationID=urlencode($_REQUEST['authorization_id']);
//$completeCodeType=urlencode($_REQUEST['CompleteCodeType']);
$completeCodeType=urlencode('Complete');
//$amount=urlencode($_REQUEST['amount']);
//$invoiceID=urlencode($_REQUEST['invoice_id']);
//$currency=urlencode($_REQUEST['currency']);
$currency=urlencode('USD');
$note=urlencode($_REQUEST['note']);



/* Construct the request string that will be sent to PayPal.
   The variable $nvpstr contains all the variables and is a
   name value pair string with & as a delimiter */
$nvpStr="&AUTHORIZATIONID=$authorizationID&AMT=$amount&COMPLETETYPE=$completeCodeType&CURRENCYCODE=$currency&NOTE=$note";



/* Make the API call to PayPal, using API signature.
   The API response is stored in an associative array called $resArray */
//$resArray=hash_call("DOCapture",$nvpStr);
$paypal = new PaypalPro;
$response = $paypal->hashCall("DOCapture",$nvpStr);
//print_r($response);
$ResultStatus = strtoupper($response["ACK"]);
echo $ResultStatus ;
//$reqArray=$_SESSION['nvpReqArray'];
if($ResultStatus=='SUCCESS'){
	$value = 'Settlement';
}
else{
	echo 'error';
	exit;
}

?>




