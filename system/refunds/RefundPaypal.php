<?php

    class KvPayPalRefund   {
        private $API_Username, $API_Password, $Signature, $API_Endpoint, $version;
        function __construct($mode = "sandbox")      {
            //if($mode == "live")    {
                $this->API_Username = "maria_api1.jdirectbuy.com";
                $this->API_Password = "L68WM8KC9JJDLH2X";
                $this->Signature = "AQU0e5vuZCvSg-XJploSa.sGUDlpAB.2zN.BgYys9rah0EH23ypgmVqj";
                $this->API_Endpoint = "https://api-3t.paypal.com/nvp";
           /* }   else     {
                $this->API_Username = "XXXXXXX_XXXX.XXXXXXX.XXX";
                $this->API_Password = "XXXXXXXXXXXXXXXX";                
                $this->Signature    = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX-XX-XXXXXXXXXXXX.XXXXXXXX";
                $this->API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
            }*/
            $this->version = "94.0";
        }

        function refundAmount($DataInArray)   {
			$this->API_UserName  = urlencode($this->API_Username);
            $this->API_Password  = urlencode($this->API_Password);
            $this->API_Signature = urlencode($this->Signature);

            $this->version = urlencode($this->version);
			
            if(trim(@$DataInArray['currencyCode'])=="")
                return array("ERROR_MESSAGE"=>"Currency Code is Missing");
            if(trim(@$DataInArray['refundType'])=="")
                return array("ERROR_MESSAGE"=>"Refund Type is Missing");
            if(trim(@$DataInArray['transactionID'])=="")
                return array("ERROR_MESSAGE"=>"Transaction ID is Missing");

            $Api_request = "&TRANSACTIONID={$DataInArray['transactionID']}&REFUNDTYPE={$DataInArray['refundType']}&CURRENCYCODE={$DataInArray['currencyCode']}";

            if(trim(@$DataInArray['invoiceID'])!="")
                $Api_request = "&INVOICEID={$DataInArray['invoiceID']}";

            if(isset($DataInArray['memo']))
                $Api_request .= "&NOTE={$DataInArray['memo']}";

            if(strcasecmp($DataInArray['refundType'], 'Partial') == 0)    {
                if(!isset($DataInArray['amount']))   {
                    return array("ERROR_MESSAGE"=>"For Partial Refund - It is essential to mention Amount");
                }    else     {
                    $Api_request = $Api_request."&AMT={$DataInArray['amount']}";
                }

                if(!isset($DataInArray['memo']))   {
                    return array("ERROR_MESSAGE"=>"For Partial Refund - It is essential to enter text for Memo");
                }
            }			           

            $curl_var = curl_init();
            curl_setopt($curl_var, CURLOPT_URL, $this->API_Endpoint);
            curl_setopt($curl_var, CURLOPT_VERBOSE, 1);

            curl_setopt($curl_var, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl_var, CURLOPT_SSL_VERIFYHOST, FALSE);

            curl_setopt($curl_var, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl_var, CURLOPT_POST, 1);

            $Api_request_final = "METHOD=RefundTransaction&VERSION={$this->version}&PWD={$this->API_Password}&USER={$this->API_UserName}&SIGNATURE={$this->API_Signature}$Api_request";

            curl_setopt($curl_var, CURLOPT_POSTFIELDS, $Api_request_final);

            // Get response from the server.
            $curlResponse = curl_exec($curl_var);

            if(!$curlResponse)
                return array("ERROR_MESSAGE"=>"RefundTransaction failed".curl_error($curl_var)."(".curl_errno($curl_var).")");

            // Extract the response details.
            $httpResponseAr = explode("&", $curlResponse);

            $aryResponse = array();
            foreach ($httpResponseAr as $i => $value)     {
                $tmpAr = explode("=", $value);
                if(sizeof($tmpAr) > 1)   {
                    $aryResponse[$tmpAr[0]] = urldecode($tmpAr[1]);
                }
            }

            if((0 == sizeof($aryResponse)) || !array_key_exists('ACK', $aryResponse))
                return array("ERROR_MESSAGE"=>"Invalid HTTP Response for POST request ($reqStr) to {$this->API_Endpoint}");
           // var_dump($aryResponse);
            return $aryResponse;
           
        }
    }

	
	// execution code. 

     $DataInArray['transactionID'] =  $gatewayTransactionId;
     $DataInArray['refundType'] = $refundType; //Partial or Full
     $DataInArray['currencyCode'] = "USD";
     $DataInArray['amount'] = $amount;
     $DataInArray['memo'] = "Memo for Refund";
     $DataInArray['invoiceID'] = "";
     print_r($DataInArray);
     $ref = new KvPayPalRefund();
     //$aryRes = $ref->KvRefundAmount($DataInArray);
     $aryRes = $ref->refundAmount($DataInArray);
     
     if($aryRes['ACK'] == "Success"){         
        $response = "Success";
     }else {
         $response = "Failure";
		 echo 'Failure';
		 exit;
     } 
	 //echo $response; 
	 print_r($aryRes);
	 //exit;
?>