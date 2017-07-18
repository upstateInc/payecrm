<?php
require($_SERVER['DOCUMENT_ROOT'].'/system/gateways/paypal/PaypalPro.php');


$note=urlencode($_REQUEST['note']);

$nvpStr="&AUTHORIZATIONID=$authorizationID&NOTE=$note";

$paypal = new PaypalPro;
$response = $paypal->hashCall("DOVoid",$nvpStr);

$ResultStatus = strtoupper($response["ACK"]);

if($ResultStatus=='SUCCESS'){
	echo 'Success';
}
else{
	echo 'error';
	exit;
}
?>