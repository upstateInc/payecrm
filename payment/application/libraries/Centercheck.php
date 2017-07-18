<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Centercheck {
	function check($companyID){
		$ci=& get_instance();
		$ci->load->database();
		$ci->load->library("session");
		if($companyID!=""){
			$ci->session->set_userdata('companyID', $companyID);
		}
		//$centerExistSql = $ci->db->query("SELECT * FROM t_centerdb WHERE `companyID` like '%".$companyID."%' and status='Y'")->row();
		$centerExistSql = $ci->db->query("SELECT * FROM t_centerdb WHERE `companyID` like '%".$ci->session->userdata('companyID')."%' and status='Y'")->row();
		$systemSql = $ci->db->query("SELECT * FROM t_system_settings WHERE `id` = 1 ")->row();
		
		define('TRANSACTIONUPDATE', 			$centerExistSql->transactionUpdate);
		define('DUPLICATEALLOWED', 				$centerExistSql->duplicate);
		define('CANCAPTURE', 					$centerExistSql->canCapture);
		define('CANVOID', 						$centerExistSql->canVoid);
		define('CANREFUND', 					$centerExistSql->canRefund);
		define('CANCHARGEBACK', 				$centerExistSql->canChargeback);
		define('SENDEMAIL', 					$centerExistSql->sendEmail);
		define('TECHNICIANIDREQUIRED', 			$centerExistSql->technicianIDRequired);
		define('PRODUCTNAMESHOW', 				$centerExistSql->productNameShow);
		define('FAILEDATTEMPTS', 				$centerExistSql->failedAttempts);
		
		define('COMPANYPDFNAME', 				$centerExistSql->Company_PDF_Name);
		define('COMPANYID', 					$centerExistSql->companyID);
		define('COMPANYNAME', 					$centerExistSql->company_name);
		define('COMPANYPHONE', 					$centerExistSql->company_phonenumber);
		define('COMPANYEMAIL', 					$centerExistSql->company_email);

		define('COMPANYFEEDBACKEMAIL', 			$centerExistSql->company_feedback_emai);
		define('SENDFEEDBACKFORM', 				$centerExistSql->send_feedback_form);
		define('COMPANYINVOICEEMAIL', 			$centerExistSql->company_invoice_email);
		define('COMPANYINVOICEPREFIX', 			$centerExistSql->company_invoice_prefix);
		define('ADDITIONALGROUPEMAIL', 			$centerExistSql->Additional_Group_email1);

		define('GORADBILLINGNUMBER', 			$centerExistSql->Gorad_Billing_Number);
		define('GORADEMAIL', 					$centerExistSql->Gorad_email);

		define('SERVICETYPE', 					$centerExistSql->service_type);
		define('MINPERCENTAGE', 				$centerExistSql->min_percentage);
		define('MAXPERCENTAGE', 				$centerExistSql->max_percentage);
		
		define('DAILYREFUNDLIMIT', 				$centerExistSql->dailyRefundLimits);

		define('MIDSELECTIONPROCESS', 			$centerExistSql->MidSelectionProcess);
		
		define('ORDEREMAIL', 					$centerExistSql->orderEmail);
		define('FEEDBACKEMAIL', 				$centerExistSql->feedbackEmail);
		define('WELCOMEMAIL', 					$centerExistSql->welcomeEmail);
		define('REFUNDEMAIL', 					$centerExistSql->refundEmail);	
		define('CREDITCARDHIDDEN', 				$centerExistSql->CreditCard_Hidden);
	/////////////////////////System Parameter////////////////////
	define('SYSTEMMAXSALESALLOWED', 			$systemSql->SYSTEMMAXSALESALLOWED);
	define('MIDSELECTION', 						$systemSql->Mid_Selection);
	////////////////////////////////////////////////////////////			
	}
}
?>