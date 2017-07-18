<?php
//error_reporting(0);
require 'phpmailer/PHPMailerAutoload.php';

function mail_file( $to, $subject, $messagehtml, $from, $cc="", $Additional_Group_email1="") {
        
		
		$mail = new PHPMailer;
		$mail->Host       = "localhost"; // sets the SMTP server
		$mail->Port       = 25;         // set the SMTP port for the server		
		$mail->From = $from;
		$mail->FromName = $from;
		$mail->addAddress($to);     // Add a recipient
		$mail->addCC($Additional_Group_email1);
		$mail->isHTML(true);           // Set email format to HTML
		
		$mail->Subject = $subject;
		$mail->Body    = $messagehtml;
		$mail->AltBody = '';
		
		$mail->send();
		
    }
	

function mail_smtp( $to, $subject, $messagehtml, $from, $replyemail, $Additional_Group_email1="" ) {
        
		
		$mail = new PHPMailer;
		$mail->Host       = "localhost"; // sets the SMTP server
		$mail->Port       = 25;         // set the SMTP port for the server		
		$mail->From = $from;
		$mail->FromName = $from;
		$mail->addAddress($to);     // Add a recipient
		$mail->addCC($Additional_Group_email1);
                $mail->AddReplyTo($from);
                $mail->AddReplyTo($replyemail);
		$mail->isHTML(true);           // Set email format to HTML
		
		$mail->Subject = $subject;
		$mail->Body    = $messagehtml;
		$mail->AltBody = '';
		
		$mail->send();
		
    }

	
	function mail_file_attach( $to, $subject, $messagehtml, $from, $fileatt, $bcc, $company_invoice_email, $Additional_Group_email1="" ) {
        
		$mail = new PHPMailer;
		$mail->Host       = "localhost"; // sets the SMTP server
		$mail->Port       = 25;         // set the SMTP port for the server		
		$mail->From = $from;
		$mail->FromName = $from;
		$mail->addAddress($to);     // Add a recipient
		
		$mail->addCC($company_invoice_email);
		$mail->addCC($Additional_Group_email1);
		$mail->addBCC($bcc);
		
		$mail->addAttachment($fileatt);         // Add attachments
		$mail->isHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = $subject;
		$mail->Body    = $messagehtml;
		$mail->AltBody = '';
		
		$mail->send();

    }
	function mail_file_attach2( $to, $subject, $messagehtml, $from, $fileatt, $bcc, $company_invoice_email, $Additional_Group_email1="" ) {
        
		$mail = new PHPMailer;
		$mail->Host       = "localhost"; // sets the SMTP server
		$mail->Port       = 25;         // set the SMTP port for the server		
		$mail->From = $from;
		$mail->FromName = $from;
		
		$emailTo=explode(",",$to);
		foreach($emailTo as $emailVal){
			$mail->addAddress($emailVal);
		}		
		     // Add a recipient
		
		//$mail->addCC($company_invoice_email);
		//$mail->addCC($Additional_Group_email1);
		$emailCC=explode(",",$bcc);
		foreach($emailCC as $emailVal){
			$mail->addCC($emailVal);
		}
		$emailBCC=explode(",",$company_invoice_email);
		foreach($emailBCC as $emailVal){
			$mail->addBCC($emailVal);
		}
		//$mail->addBCC($bcc);
		
		$mail->addAttachment($fileatt);         // Add attachments
		$mail->isHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = $subject;
		$mail->Body    = $messagehtml;
		$mail->AltBody = '';
		
		$mail->send();

    }	
	
?>