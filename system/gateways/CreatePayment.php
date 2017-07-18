<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment. Please note that direct
// credit card payment and related features using the
// REST API is restricted in some countries.
// API used: /v1/payments/payment

//require __DIR__ . '/../bootstrap.php';
require($_SERVER['DOCUMENT_ROOT'].'/system/restPaypal/vendor/paypal/rest-api-sdk-php/sample/bootstrap.php');
use PayPal\Api\Address;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentCard;
use PayPal\Api\Transaction;

// The biggest difference between creating a payment, and authorizing a payment is to set the intent of payment
// to correct setting. In this case, it would be 'authorize'
$addr = new Address();
$addr->setLine1($insert['address'])
    ->setCity($insert['city'])
    ->setState($insert['state'])
    ->setPostalCode($insert['zip'])
    ->setCountryCode($insert['country'])
    ->setPhone($insert['contact']);

// ### PaymentCard
// A resource representing a payment card that can be
// used to fund a payment.
$card = new PaymentCard();
$card->setType($insert['cardtype'])
    ->setNumber($insert['cardnumber'])
    ->setExpireMonth($insert['month'])
    ->setExpireYear('20'.$insert['year'])
    ->setCvv2($insert['cvv'])
    ->setFirstName($insert['fname'])
    ->setBillingCountry($insert['country'])
    ->setLastName($insert['lname']);

// ### FundingInstrument
// A resource representing a Payer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$fi = new FundingInstrument();
$fi->setPaymentCard($card);

// ### Payer
// A resource representing a Payer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.
$payer = new Payer();
$payer->setPaymentMethod("credit_card")
    ->setFundingInstruments(array($fi));

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
//$amount = new Amount();
/*$amount->setCurrency("USD")
    ->setTotal(21)
    ->setDetails($details);*/
$amount->setCurrency("USD")
    ->setTotal($insert['product_price']);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid());

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
$payment = new Payment();
////////Sale/////////
if($tranactionMode=='Sale'){
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setTransactions(array($transaction));
}
////////Auth/////////
// Setting intent to authorize creates a payment
// authorization. Setting it to sale creates actual payment
if($tranactionMode=='Auth'){
$payment->setIntent("authorize")
    ->setPayer($payer)
    ->setTransactions(array($transaction));
}
// For Sample Purposes Only.
$request = clone $payment;

// ### Create Payment
// Create a payment by calling the payment->create() method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The return object contains the state.
try {
    $payment->create($apiContext);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    //ResultPrinter::printError('Create Payment Using Credit Card. If 500 Exception, try creating a new Credit Card using <a href="https://www.paypal-knowledge.com/infocenter/index?page=content&widgetview=true&id=FAQ1413">Step 4, on this link</a>, and using it.', 'Payment', null, $request, $ex);
	$ex->getMessage();
	$responsetext = $ex->getMessage();
    //exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
 ResultPrinter::printResult('Create Payment Using Credit Card', 'Payment', $payment->getId(), $request, $payment);
exit
			if($tranactionMode=='Sale'){
					/*$transaction_id 		= $payment->transactions[0]->related_resources->id;
					$transaction_time 		= $payment->transactions[0]->related_resources->create_time;
					$transaction_currency 	= $payment->transactions[0]->related_resources->amount->currency;
					$transaction_amount 	= $payment->transactions[0]->related_resources->amount->total;
					$transaction_method 	= $payment->payer->payment_method;
					$transaction_state 		= $payment->transactions[0]->related_resources->state;*/		
					$action_type='Settlement';
					//$_SESSION['tranactionModeDbVal']='Settlement';
					$captured_by = $agent_name;
					$captured_date = date('Y-m-d H:i:s');
			}else{
					$captured_by = '';
					$captured_date = '';
					$action_type = 'Authorize';				
			}
			//if($tranactionMode=='Auth'){
				 	$transaction_id 		= $payment->id;
					$transaction_time 		= $payment->create_time;
					$transaction_currency 	= $payment->transactions[0]->amount->currency;
					$transaction_amount 	= $payment->transactions[0]->amount->total;
					$transaction_method 	= $payment->payer->payment_method;
					
					$transaction_state 		= $payment->state;
					//$paymentState=$payment->state;
					/*$captured_by = '';
					$captured_date = '';*/
			//}
			$cvvresponse="";
			$avsresponse="";
			$response_code="";
			/*print_r($payment);
			exit; */
					//get payer details
				/*echo	$payer_first_name 		= $payment->payer->payer_info->first_name;
				echo	$payer_last_name 		= $payment->payer->payer_info->last_name;
				echo	$payer_email 			= $payment->payer->payer_info->email;
				echo	$payer_id				= $payment->payer->payer_info->payer_id;
					
					//get shipping details 
				echo	$shipping_recipient		= $payment->transactions[0]->item_list->shipping_address->recipient_name;
				echo	$shipping_line1			= $payment->transactions[0]->item_list->shipping_address->line1;
				echo	$shipping_line2			= $payment->transactions[0]->item_list->shipping_address->line2;
				echo	$shipping_city			= $payment->transactions[0]->item_list->shipping_address->city;
				echo	$shipping_state			= $payment->transactions[0]->item_list->shipping_address->state;
				echo	$shipping_postal_code	= $payment->transactions[0]->item_list->shipping_address->postal_code;
				echo	$shipping_country_code	= $payment->transactions[0]->item_list->shipping_address->country_code;		*/
				if($transaction_state=='created' || $transaction_state=='approved'){
						$str = 1;
						$ssl_txn_id = $transaction_id;
						$responsetext="Success";
						/*if($transaction_method=='completed'){

						}*/
				}
return $payment;

