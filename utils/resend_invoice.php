<?php
$previous = $_SERVER['HTTP_REFERER'];
ob_start();
require('config/config.php');

error_reporting('E_ALL');
$InvoiceID      =   $_REQUEST['TextInvoiceId'];
$InvoiceCC      =   $_REQUEST['InvoiceCC'];
$InvoiceBCC     =   $_REQUEST['InvoiceBCC'];

@$SendCustomer  =   $_REQUEST['SendCustomer'];
$AgentNote      =   $_REQUEST['AgentNote'];
$emailType		=	$_REQUEST['emailType'];

//print_r($emailType);
$phoneNo		=	$_REQUEST['phoneNo'];
$phoneNoval		=	$_REQUEST['phoneNoval'];
$ProductName		=	$_REQUEST['ProductName'];

// Get  invoice data
$InvoiceSql 		= "SELECT * FROM t_invoice WHERE md5(`id`) = '".$InvoiceID."' ";
$InvoiceResult 	    = mysqli_query($con_one,$InvoiceSql);
$InvoiceResultRow 	= mysqli_fetch_assoc($InvoiceResult);
//print_r($InvoiceResultRow);
//exit;

$insert_invoive_id		= $InvoiceResultRow['id'];
$companyID		    	= $InvoiceResultRow['companyID'];
$centerExistSql = "SELECT * FROM t_centerdb WHERE `companyID` like '%".$companyID."%'";
$centerExistResult 	= mysqli_query($con_one,$centerExistSql);
$rowCenter			= $centerExistResult->fetch_array(MYSQLI_ASSOC);
$company_phonenumber	=$rowCenter['company_phonenumber'];
$Gorad_Billing_Number	=$rowCenter['Gorad_Billing_Number'];
$company_email			=$rowCenter['company_email'];
$Gorad_email			=$rowCenter['Gorad_email'];
$Company_PDF_Name		= $rowCenter['Company_PDF_Name'];
if($_REQUEST['productNameShow']!=""){
	$productNameShow = $_REQUEST['productNameShow'];
}else{
	$productNameShow		= $rowCenter['productNameShow'];
}
$ICustomerID		    = $InvoiceResultRow['customerId'];
$ProductId		    	= $InvoiceResultRow['productId'];

$gateway_descriptor		= $InvoiceResultRow['gateway_descriptor'];

$company_name		    = $rowCenter['company_name'];

$productDuration		= $InvoiceResultRow['productDuration'];

/************************Echeque Payments****************/
$PaymentType 	= $InvoiceResultRow['paymentType'];
$RoutingNumber	= $InvoiceResultRow['RoutingNumber'];
$AccountNumber	= $InvoiceResultRow['AccountNumber'];
$BankName		= $InvoiceResultRow['BankName'];
$CheckDate		= $InvoiceResultRow['CheckDate'];
$CheckNumber	= $InvoiceResultRow['CheckNumber'];
$CheckMemo		= $InvoiceResultRow['CheckMemo'];
/********************************************************/

/********************New Custom Fields*******************/
$securityProtection	=	$InvoiceResultRow['securityProtection'];
$totalDevices		=	$InvoiceResultRow['totalDevices'];	
$date				=	$InvoiceResultRow['rec_crt_date'];	
/********************************************************/	

$cardtype		= $InvoiceResultRow['cardType'];
$cardnumber		= $InvoiceResultRow['cardNo'];


$ip  = $InvoiceResultRow['ip'];


// get agent name from company database

$agent_name         = $InvoiceResultRow['agent_name'];
$unique_pin         = $InvoiceResultRow['customerId'];
$sign               = $InvoiceResultRow['sign'];
//$ip			        = $InvoiceResultRow[14];

///////////////////////  Order Information  ////////////////////
$orderid		    = $InvoiceResultRow['invoice_id'];
$product_id 		= $InvoiceResultRow['productId'];
$product_name 		= $InvoiceResultRow['product_name'];
$product_price 		= $InvoiceResultRow['grossPrice'];
$securityProtection = $InvoiceResultRow['securityProtection'];
$totalDevices 		= $InvoiceResultRow['totalDevices'];

$SupscriptionPeriod	= $InvoiceResultRow['productDuration']/30;

if( floor($SupscriptionPeriod) == 0) {
    $SupscriptionPeriod	= 'One time';
}

if( floor($SupscriptionPeriod) > 0) {
    $SupscriptionPeriod	= floor($SupscriptionPeriod).' months' ;
}


/////////////////  Billing Information   //////////////////////
$fname 		= $InvoiceResultRow['fname'];
$lname 		= $InvoiceResultRow['lname'];
$email 		= $InvoiceResultRow['customer_email'];
$phone 		= $InvoiceResultRow['customer_phone'];


$address 	= htmlspecialchars ($InvoiceResultRow['customer_address']);

$state 		= $InvoiceResultRow['customer_state'];
$city 		= htmlspecialchars ($InvoiceResultRow['customer_city']);
$zip 		= $InvoiceResultRow['customer_zip'];
$country 	= $InvoiceResultRow['customer_country'];

/////////////////  Card Information   //////////////////////
$agentID 	= $InvoiceResultRow['agentID'];
$gatewayID 	= $InvoiceResultRow['gatewayID'];

$insertInvoice['rec_crt_date'] = $InvoiceResultRow['rec_crt_date'];
$insertInvoice['customer_phone'] = $InvoiceResultRow['customer_phone'];

$insertInvoice['securityProtection'] 	= $InvoiceResultRow['securityProtection'];
$insertInvoice['totalDevices'] 			= $InvoiceResultRow['totalDevices'];



require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/email_function.php");
$time = time();

require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."dompdf/dompdf_config.inc.php");

require_once 'signature-to-image.php';

////////////  Generating Image From E-Sign  /////////////////////
$img = sigJsonToImage($sign);
imagepng($img, $time.'.png');
$img =  $time.'.png';
////////////  End Generating Image From E-Sign  /////////////////////


////////////  Invoice & Auth Email Start  /////////////////////

	require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/pdf_template.php");
	require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/new_pdf_template.php");
	require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/order_email_template1.php");
	require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/order_email_template2.php");
	require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/feedback_email_template.php");
	require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/welcome_email_template.php");
	
	$dompdf = new DOMPDF();
	$dompdf->load_html($pdf_html);
	$dompdf->render();
	file_put_contents($time.'.pdf', $dompdf->output());

	$newTime = time();
	$dompdf = new DOMPDF();
	$dompdf->load_html($pdf_htmlNew);
	$dompdf->render();
	file_put_contents($newTime.'.pdf', $dompdf->output());


	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <'.$company_email.'>' . "\r\n";
	$headers .= 'Reply-To: <'.$Gorad_email.'>' . "\r\n";
	$headers .= 'Reply-To: <'.$company_email.'>' . "\r\n";
	$headers .= 'Cc: '.$InvoiceCC.'' . "\r\n";
	$headers .= 'Bcc: '.$InvoiceBCC.'' . "\r\n";
	
	
	if($SendCustomer == 'yes'){
		if (in_array("2", $emailType)) {
			mail_file_attach( $email, 'Thank you for your purchase from '.$company_name.'!', $orderwelcome, $company_email, $time.'.pdf',$InvoiceCC,$InvoiceBCC );
		}
		if (in_array("1", $emailType)) {
			mail($email,'Welcome to '.$gateway_descriptor.'',$welcomeHtml,$headers);
		}
		if (in_array("3", $emailType)) {
			mail($email,'Feedback and Authorization Email',$feedbackhtml,$headers);	
		}
		if (in_array("4", $emailType)) {
			mail_file_attach( $email, 'Thank you for your purchase from '.$company_name.'!', $orderwelcome1, $company_email, $newTime.'.pdf',$InvoiceCC,$InvoiceBCC );
		}		
	}
	else{
		if($InvoiceCC!=''){
			$email=$InvoiceCC;
		}else if($InvoiceBCC!=''){
			$email=$InvoiceBCC;
		}else{
			$email=$Gorad_email;
		}
		if (in_array("2", $emailType)) {
			mail_file_attach( $email, 'Thank you for your purchase from '.$company_name.'!', $orderwelcome, $company_email, $time.'.pdf',$InvoiceCC,$InvoiceBCC );
		}
		if (in_array("1", $emailType)) {
			mail($email,'Welcome to '.$company_name.'',$welcomeHtml,$headers);
		}
		if (in_array("3", $emailType)) {
			mail($email,'Feedback and Authorization Email',$feedbackhtml,$headers);	
		}
		if (in_array("4", $emailType)) {
			mail_file_attach( $email, 'Thank you for your purchase from '.$company_name.'!', $orderwelcome1, $company_email, $newTime.'.pdf',$InvoiceCC,$InvoiceBCC );
		}		
	}
		

unlink($time.'.pdf');
unlink($time.'.png');
unlink($newTime.'.png');

//echo "<script language=javascript> javascript:history.back();</script>";
header("Location:$previous");
exit();
?>








