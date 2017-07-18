<?php
  require 'vendor/autoload.php';
  //require '../sdk-php-1.9.2/autoload.php';
  //require 'path/to/anet_php_sdk/autoload.php';
  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;
  define("AUTHORIZENET_LOG_FILE", "phplog");
  
  // Common Set Up for API Credentials
  $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
  $merchantAuthentication->setName( "4T4Ysn67"); 
  $merchantAuthentication->setTransactionKey("6gp6D9K9Cez62vWW");
  $refId = 'ref' . time();
  $request = new AnetAPI\GetTransactionDetailsRequest();
  $request->setMerchantAuthentication($merchantAuthentication);
  $request->setTransId("60103318807");
  $controller = new AnetController\GetTransactionDetailsController($request);
  $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
  if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
  {
      echo "SUCCESS: Transaction Status:" . $response->getTransaction()->getTransactionStatus() . "\n";
      echo "                Auth Amount:" . $response->getTransaction()->getAuthAmount() . "\n";
      echo "                   Trans ID:" . $response->getTransaction()->getTransId() . "\n";
   }
  else
  {
      echo "ERROR :  Invalid response\n";
      echo "Response : " . $response->getMessages()->getMessage()[0]->getCode() . "  " .$response->getMessages()->getMessage()[0]->getText() . "\n";
      
  }
  ?>