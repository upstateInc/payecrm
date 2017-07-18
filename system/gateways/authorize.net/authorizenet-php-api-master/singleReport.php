<?php
    require_once 'AuthorizeNet.php';
	/*************Time Calculation***************/
		date_default_timezone_set('US/Eastern');
		$date1=date('Y-m-d H:i:s');
		date_default_timezone_set("UTC");
		$date2=date('Y-m-d H:i:s');
		$diff = strtotime($date2) - strtotime($date1);			
	/********************************************/		

	/**********************Fetching Authorize.Net Transaction From Master Database******************************/
	/****************Database Configuration**********************************/		
	$db_two_use 		= 'yes';
	$host_name_two 		= 'localhost';
	$db_username_two 	= "scare518_master";
	$db_password_two 	= "aAvv2CP+OF1T";
	$db_name_two		= "scare518_master";	
	$con_two = mysqli_connect($host_name_two,$db_username_two,$db_password_two,$db_name_two);
	
	/*******************************Fetching Transactions from Authorize.net Mids*******************************/
	$query="select a.gatewayTransactionId, b.username, b.password from t_invoice as a left join t_midmaster as b on a.gatewayID = b.gatewayID left join t_centerdb as c on a.companyID=c.companyID where b.gatewayType='authorize.net' and b.cron='Y' and a.status NOT IN('Refund','Void','Settlement','Chargeback','Failed') ";
	$queryResult= mysqli_query($con_two,$query);
	while($rowResult = mysqli_fetch_assoc($queryResult)) {
		//print_r($rowResult);
		$status="";
		$validated="";
		/**************************Sending Request to Gateway*******************************/
		$request = new AuthorizeNetTD($rowResult['username'], $rowResult['password']);
		$request->setSandbox(false);
		//print_r($request);
		$response = $request->getTransactionDetails($rowResult['gatewayTransactionId']);
		//print_r($response);
		echo "Status ".$response->xml->transaction->transactionStatus;
		
		if($response->xml->transaction->transactionStatus=="communicationError" || 
		$response->xml->transaction->transactionStatus=="declined" || 
		$response->xml->transaction->transactionStatus=="expired" || 
		$response->xml->transaction->transactionStatus=="generalError" || 
		$response->xml->transaction->transactionStatus=="failedReview"|| 
		$response->xml->transaction->transactionStatus=="settlementError"){
			$status="Failed";
			$validated = 'Y';
		}
		if($response->xml->transaction->transactionStatus=="voided" ){
			$status="Void";
			$validated = 'Y';
		}		
		if($response->xml->transaction->transactionStatus=="authorizedPendingCapture" ){
			$status="Authorize";
		}		
		if($response->xml->transaction->transactionStatus=="capturedPendingSettlement" ){
			$status="Capture";
		}		
		if($response->xml->transaction->transactionStatus=="settledSuccessfully" ){
			$status="Settlement";
			$validated = 'Y';
		}	
		//echo "Batch Id ".$response->xml->transaction->batch->batchId;
		//echo "Settlement Time UTC ".$response->xml->transaction->batch->settlementTimeUTC;
		$settled_date = date("Y-m-d H:i:s",strtotime($response->xml->transaction->batch->settlementTimeUTC)-$diff);
		//echo "EST :".$settled_date;		
		/*****************************************Updating The Database Records***********************************/
		if($status!=""){
			if($status=="Settlement"){
				if($validated == 'Y'){
					$sql="update t_invoice set status='".$status."', batch_id='".$response->xml->transaction->batch->batchId."', rec_up_date='".$settled_date."', validated='".$validated."' where gatewayTransactionId=".$rowResult['gatewayTransactionId']."";
				}else{
					$sql="update t_invoice set status='".$status."', batch_id='".$response->xml->transaction->batch->batchId."', rec_up_date='".$settled_date."' where gatewayTransactionId=".$rowResult['gatewayTransactionId']."";
				}			
			}else{
				if($validated == 'Y'){
					$sql="update t_invoice set status='".$status."', batch_id='".$response->xml->transaction->batch->batchId."', validated='".$validated."' where gatewayTransactionId=".$rowResult['gatewayTransactionId']."";
				}else{
					$sql="update t_invoice set status='".$status."', batch_id='".$response->xml->transaction->batch->batchId."' where gatewayTransactionId=".$rowResult['gatewayTransactionId']."";
				}
			}
			mysqli_query($con_two, $sql);
		}
		
		//echo $rowResult['gatewayTransactionId'].'<br/>';
	}
?>
