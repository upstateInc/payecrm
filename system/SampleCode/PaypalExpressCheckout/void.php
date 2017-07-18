<?php
  require 'vendor/autoload.php';
  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;

  define("AUTHORIZENET_LOG_FILE", "phplog");

  function payPalVoid($transactionId) {
    
    // Common setup for API credentials
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName(\SampleCode\Constants::MERCHANT_LOGIN_ID);
    $merchantAuthentication->setTransactionKey(\SampleCode\Constants::MERCHANT_TRANSACTION_KEY);
    $refId = 'ref' . time();

    $payPalType = new AnetAPI\PayPalType();
    $payPalType->setSuccessUrl("");
    $payPalType->setCancelUrl("");

    $paymentType = new AnetAPI\PaymentType();
    $paymentType->setPayPal($payPalType);

    $transactionRequest = new AnetAPI\TransactionRequestType();
    $transactionRequest->setTransactionType("voidTransaction");
    $transactionRequest->setPayment($paymentType);
    $transactionRequest->setRefTransId($transactionId);

    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId( $refId);
    $request->setTransactionRequest($transactionRequest);
    
    $controller = new AnetController\CreateTransactionController($request);

    $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
	
	if ($response != null)
    {
      $tresponse = $response->getTransactionResponse();
      if (($tresponse != null) && ($tresponse->getResponseCode()=="1") )   
      {
        echo "Void transaction SUCCESS TRANS ID  : " . $tresponse->getTransId() . "\n";
      }
      else
      {
        echo  "Void transaction ERROR : " . $tresponse->getResponseCode() . "\n";
      }    
    }
    else
    {
      echo  "Void transaction Null esponse returned";
    }

    return $response;
  }

  if(!defined('DONT_RUN_SAMPLES'))
    payPalVoid("2241706281");

  ?>