<?php
require($_SERVER['DOCUMENT_ROOT'].'/system/restPaypal/vendor/paypal/rest-api-sdk-php/sample/bootstrap.php');

use PayPal\Api\Amount;
use PayPal\Api\CreditCard;
use PayPal\Api\Details;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\PayerInfo;
use PayPal\Api\Address;
use PayPal\Api\ShippingAddress;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;



$addr = new Address();
$addr->setLine1("3909 Witmer Road")
	->setLine2("Niagara Falls")
	->setCity("Niagara Falls")
	->setState("NY")
	->setPostalCode("14305")
	->setCountryCode("US")
	->setPhone("716-298-1822");
	
$shipping_address = new ShippingAddress();

$shipping_address->setCity('Niagara Falls');
$shipping_address->setCountryCode('US');
$shipping_address->setPostalCode('14305');
$shipping_address->setLine1('3909 Witmer Road');
$shipping_address->setState('NY');
$shipping_address->setPhone('716-298-1822');
$shipping_address->setRecipientName('Joe Shopper');	

// ### CreditCard
// A resource representing a credit card that can be
// used to fund a payment.
$card = new CreditCard();
$card->setType("visa")
    ->setNumber("4148529247832259")
    ->setExpireMonth("11")
    ->setExpireYear("2019")
    ->setCvv2("012")
    ->setFirstName("Joe")
    ->setLastName("Shopper");

// ### FundingInstrument
// A resource representing a Payer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$fi = new FundingInstrument();
$fi->setCreditCard($card);

// ### Payer
// A resource representing a Payer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.
$payer = new Payer();
$payer->setPaymentMethod("credit_card")
    ->setFundingInstruments(array($fi));
$payer_info = new PayerInfo();
$payer_info->setEmail('test@gmail.com');
$payer_info->setBillingAddress($addr);
$payer->setPayerInfo($payer_info);

// ### Itemized information
// (Optional) Lets you specify item wise
// information
$item1 = new Item();
$item1->setName('Ground Coffee 40 oz')
    ->setDescription('Ground Coffee 40 oz')
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setTax(0)
    ->setPrice(12.00);
/*$item2 = new Item();
$item2->setName('Granola bars')
    ->setDescription('Granola Bars with Peanuts')
    ->setCurrency('USD')
    ->setQuantity(5)
    ->setTax(0.2)
    ->setPrice(2);*/

$itemList = new ItemList();
//$itemList->setItems(array($item1, $item2));
$itemList->setItems(array($item1))
		->setShippingAddress($shipping_address);
// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
$details = new Details();
$details->setShipping(0)
    ->setTax(0)
    ->setSubtotal(12.00);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency("USD")
    ->setTotal(12)
    ->setDetails($details);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it. 
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Payment Description")
    ->setCustom("Company ID")
    ->setInvoiceNumber(uniqid());

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setTransactions(array($transaction));

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
 	ResultPrinter::printError('Create Payment Using Credit Card. If 500 Exception, try creating a new Credit Card using <a href="https://ppmts.custhelp.com/app/answers/detail/a_id/750">Step 4, on this link</a>, and using it.', 'Payment', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
 ResultPrinter::printResult('Create Payment Using Credit Card', 'Payment', $payment->getId(), $request, $payment);

return $payment;