<?php
	$companyID = "";
	date_default_timezone_set('US/Eastern');
	session_start();
	//$_REQUEST['companyID'];
	if(isset($_REQUEST['companyID'])){
		$_SESSION['companyIDreq']=$_REQUEST['companyID'];
	}
	$companyID = $_SESSION['companyIDreq'];

	//echo "SELECT * FROM t_centerdb WHERE `companyID` like '%".$companyID."%' and status='Y' ";
	if($companyID !=""){
		$centerExistSql = "SELECT * FROM t_centerdb WHERE `companyID` like '%".$companyID."%' and status='Y' ";
		$centerExistResult 	= mysqli_query($con_two,$centerExistSql);
		$totalCenter		= mysqli_num_rows($centerExistResult);
		$row = $centerExistResult->fetch_array(MYSQLI_ASSOC);
		//print_r($row);
		$systemSql = "SELECT * FROM t_system_settings WHERE `id` = 1 ";
		$systemResult 	= mysqli_query($con_two,$systemSql);
		$rowSystem = $systemResult->fetch_array(MYSQLI_ASSOC);	
		//////////////////////////////////////////////////////////////
		$tranactionMode=$row['tranactionMode'];
		$transactionUpdate=$row['transactionUpdate'];
		$duplicateAllowed=$row['duplicate'];
		$canCapture=$row['canCapture'];
		$canVoid=$row['canVoid'];
		$canRefund=$row['canRefund'];
		$canChargeback=$row['canChargeback'];
		$sendEmail=$row['sendEmail'];
		$technicianIDRequired=$row['technicianIDRequired'];
		$productNameShow=$row['productNameShow'];
		
		$service_type=$row['service_type'];
		$min_percentage=$row['min_percentage'];
		$max_percentage=$row['max_percentage'];
		$failedAttempts=$row['failedAttempts'];	
		$failedAttempts=$row['failedAttempts'];
		
		$dailyRefundLimits=$row['dailyRefundLimits'];
		$MidSelectionProcess=$row['MidSelectionProcess'];
			
		$SYSTEMMAXSALESALLOWED=$rowSystem['SYSTEMMAXSALESALLOWED'];
		$MIDSELECTION=$rowSystem['Mid_Selection'];
		
		define('TRANSACTIONUPDATE', 			$transactionUpdate);
		define('DUPLICATEALLOWED', 				$duplicateAllowed);
		define('CANCAPTURE', 					$canCapture);
		define('CANVOID', 						$canVoid);
		define('CANREFUND', 					$canRefund);
		define('CANCHARGEBACK', 				$canChargeback);
		define('SENDEMAIL', 					$sendEmail);
		define('TECHNICIANIDREQUIRED', 			$technicianIDRequired);
		define('PRODUCTNAMESHOW', 				$productNameShow);
		define('FAILEDATTEMPTS', 				$failedAttempts);
		
		define('COMPANYPDFNAME', 				$row['Company_PDF_Name']);
		define('COMPANYID', 					$row['companyID']);
		define('COMPANYNAME', 					$row['company_name']);
		define('COMPANYPHONE', 					$row['company_phonenumber']);
		define('COMPANYEMAIL', 					$row['company_email']);

		define('COMPANYFEEDBACKEMAIL', 			$row['company_feedback_emai']);
		define('SENDFEEDBACKFORM', 				$row['send_feedback_form']);
		define('COMPANYINVOICEEMAIL', 			$row['company_invoice_email']);
		define('COMPANYINVOICEPREFIX', 			$row['company_invoice_prefix']);
		define('ADDITIONALGROUPEMAIL', 			$row['Additional_Group_email1']);

		define('GORADBILLINGNUMBER', 			$row['Gorad_Billing_Number']);
		define('GORADEMAIL', 					$row['Gorad_email']);

		define('SERVICETYPE', 						$service_type);
		define('MINPERCENTAGE', 					$min_percentage);
		define('MAXPERCENTAGE', 					$max_percentage);
		define('FAILEDATTEMPTS', 					$failedAttempts);
		define('DAILYREFUNDLIMIT', 					$dailyRefundLimits);
		define('TECGNICIANIDREQUIRED', 				$technicianIdRequired);
		define('MIDSELECTIONPROCESS', 				$MidSelectionProcess);

		define('ORDEREMAIL', 					$row['orderEmail']);
		define('FEEDBACKEMAIL', 				$row['feedbackEmail']);
		define('WELCOMEMAIL', 					$row['welcomeEmail']);
		define('REFUNDEMAIL', 					$row['refundEmail']);	
		define('CREDITCARDHIDDEN', 				$row['CreditCard_Hidden']);	
		/////////////////////////System Parameter////////////////////
		define('SYSTEMMAXSALESALLOWED', 			$SYSTEMMAXSALESALLOWED);
		define('MIDSELECTION', 						$MIDSELECTION);
		////////////////////////////////////////////////////////////	
		
		//echo CREDITCARDHIDDEN;
		if($totalCenter == '0'){?>
			<style>
			.alert-danger {
				color: #a94442;
				background-color: #f2dede;
				border-color: #ebccd1;
			}
			.alert {
				padding: 15px;
				margin-bottom: 20px;
				border: 1px solid transparent;
				border-radius: 4px;
			}
			</style>
			<div class="alert alert-danger" style="text-align:center;"><h3>Your payment processing is temporary unavailable. Please contact management..</h3></div>

		<?php
		exit();
		}
	}else{ ?>
			<style>
			.alert-danger {
				color: #a94442;
				background-color: #f2dede;
				border-color: #ebccd1;
			}
			.alert {
				padding: 15px;
				margin-bottom: 20px;
				border: 1px solid transparent;
				border-radius: 4px;
			}
			</style>
			<div class="alert alert-danger" style="text-align:center;"><h3>No Company Selected.Go Back to The Company Plan Page, Select a Plan To Procced..</h3></div>
<?php
			exit();
	}
?>