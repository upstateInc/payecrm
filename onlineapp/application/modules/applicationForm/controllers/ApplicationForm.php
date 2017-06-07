<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class ApplicationForm extends MX_Controller
{
	public function __construct()
	{
		parent::__construct ();
		
		$this->load->helper ( array (
				'url',
				'form' 
		) );
		$this->load->driver ( 'session' );
		$this->load->database ();
		$this->load->model ( array (
				'Common_model' 
		) );
		$this->load->library ( array (
				'session',
				'form_validation',
				'email' 
		) );
		date_default_timezone_set ( 'America/New_York' );
	}
	public function pdf()
	{
		$license = '8tn5bf1o4lP5';
		$url = urlencode ( 'http://www.payehub.com/onlineapp/applicationForm/business?signupid=44' );
		
		$url = "http://pdfmyurl.com/login_api?license=$license&form_url=$url&form_fields[user]=menotforxhat@gmail.com&form_fields[password]=111111";
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 5 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		// header("Content-Disposition: attachment; filename=abc.pdf");
		// header('Content-type:application/pdf');
		// header("Content-Type: application/download");
		$tmp = curl_exec ( $ch );
		echo $tmp;
		// redirect('http://www.payehub.com/onlineapp/applicationForm/business?signupid=44');
	}
	
	public function business()
	{
		/*
		 * if(!$this->session->userdata('loggedInEmail'))
		 * {
		 * redirect("login");
		 * }
		 */
		$sid = $_GET ['signupid'];
		$this->load->view ( "template/header" );
		
		$data ['resultarray'] = $this->Common_model->GetAllWhere ( 't_business', array (
				'userId' => $sid 
		) );
		
		// var_dump($data['resultarrayb']);
		$this->load->view ( "business", $data );
		$this->load->view ( "template/footer" );
	}
	public function billing()
	{
		
		/*
		 * if(!$this->session->userdata('loggedInEmail'))
		 * {
		 * redirect("login");
		 * }
		 */
		$sid = $_GET ['signupid'];
		$this->load->view ( "template/header" );
		$data ['resultarray'] = $this->Common_model->GetAllWhere ( 't_billing', array (
				'userId' => $sid 
		) );
		$this->load->view ( "billing", $data );
		$this->load->view ( "template/footer" );
	}
	public function document()
	{
		
		/*
		 * if(!$this->session->userdata('loggedInEmail'))
		 * {
		 * redirect("login");
		 * }
		 */
		$sid = $_GET ['signupid'];
		$this->load->view ( "template/header" );
		$data ['resultarrayb'] = $this->Common_model->GetAllWhere ( 't_business', array (
				'userId' => $sid 
		) );
		$data ['resultarray'] = $this->Common_model->GetAllWhere ( 't_billing', array (
				'userId' => $sid 
		) );
		$this->load->view ( "document", $data );
		$this->load->view ( "template/footer" );
	}
	public function complete()
	{
		if (! $this->session->userdata ( 'loggedInEmail' ))
		{
			redirect ( "login" );
		}
		
		$sid = $this->input->get_post( 'signupid' );
		$res = $this->Common_model->GetAllWhere ( 't_billing', array (
				'userId' => $sid 
		) );
		
		if ($this->input->post ( 'business' ) != '' && $this->input->post ( 'billing' ) != '')
		{
			$this->session->set_userdata ( 'complete', 1 );
			
			$this->Common_model->updwhere ( 't_billing', array (
					'userId' => $sid 
			), array (
					'complete' => 'Y' 
			) );
		}
		
		if ($this->session->userdata ( 'complete' ) != '' || $res [0] ['complete'] == 'Y')
		{
			
			$sid = $this->input->get_post( 'signupid' );
			$this->load->view ( "template/header" );
			$data ['resultarray'] = $this->Common_model->GetAllWhere ( 't_user', array (
					'id' => $sid 
			) );
			$this->load->view ( "complete", $data );
			$this->load->view ( "template/footer" );
		}
		else
			redirect ( "applicationForm/business?signupid=" . $this->input->get_post( 'signupid' ) );
	}
	public function savedocument()
	{
		$fn = $_FILES ['file'] ['name'];
		$t = explode ( '.', $fn );
		
		// var_dump($_FILES);
		
		$sid = $this->input->post ( 'sid' );
		
		$res = $this->Common_model->GetAllWhere ( 't_billing', array (
				'userId' => $sid 
		) );
		$docno = "";
		for($n = 1; $n <= 5; $n ++)
		{
			if ($res [0] ["doc$n"] == "")
				$docno = $n;
			if ($docno != "")
				break;
		}
		
		if ($docno != "")
		{
			$date = date ( 'Y-m-d h:i:s' );
			$config ['upload_path'] = './uploads/';
			
			if ($t [1] == 'pdf' || $t [1] == 'xps')
				$config ['allowed_types'] = '*';
			else
				$config ['allowed_types'] = 'docx|txt|doc|gif|jpg|png';
			
			$config ['max_size'] = '100000';
			$config ['max_width'] = '1024';
			$config ['max_height'] = '768';
			$new_name = time () . "_R_" . $_FILES ["file"] ['name'];
			$config ['file_name'] = $new_name;
			$this->load->library ( 'upload', $config );
			
			if ($this->upload->do_upload ( 'file' ))
			{
				$data = $this->upload->data ();
				$name = $data ['file_name'];
				$doc = $name;
				$userdata = array (
						"doc$docno" => $doc 
				);
				$this->Common_model->updwhere ( 't_billing', array (
						'userId' => $sid 
				), $userdata );
				$this->Common_model->updwhere ( 't_user', array (
						'id' => $sid 
				), array (
						'update' => $date 
				) );				
				
				redirect ( "applicationForm/document?signupid=$sid" );
			}
			else
			{
				$error = array (
						'error' => $this->upload->display_errors () 
				);
				$this->session->set_flashdata ( 'error', $error ['error'] );
				if (count ( $t ) > 2)
					$this->session->set_flashdata ( "error", "File name shouldn't contain dot." );
				redirect ( "applicationForm/document?signupid=$sid" );
			}
		}
		else
		{
			$this->session->set_flashdata ( 'upldlmt', "<font color='#ff0000'>Uploading limit exceeded!</font>" );
			redirect ( "applicationForm/document?signupid=$sid" );
		}
	}
	public function savebusiness()
	{
		if (! $this->session->userdata ( 'loggedInEmail' ))
		{
			redirect ( "login" );
		}
		//echo "<pre>"; print_r($this->input->post() );exit;
		
		$date 					= date ( 'Y-m-d h:i:s' );
		$cid 					= $this->input->post ( 'cid' );
		$sid 					= $this->input->post ( 'sid' );
		$businessName 			= $this->input->post ( 'businessName' );
		$dbaName		 		= $this->input->post ( 'dbaName' );
		$businessType 			= $this->input->post ( 'businessType' );
		$federalTaxIdTemp 		= $this->input->post ( 'federalTaxIdTemp' );
		$incorporatedStateTemp 	= $this->input->post ( 'incorporatedStateTemp' );
		$websiteAddress 		= $this->input->post ( 'websiteAddress' );
		$businessStreetAddress 	= $this->input->post ( 'businessStreetAddress' );
		$businessCity 			= $this->input->post ( 'businessCity' );
		$businessStateTemp	 	= $this->input->post ( 'businessStateTemp' );
		$businessZip 			= $this->input->post ( 'businessZip' );
		$ownershipFirstName 	= $this->input->post ( 'ownershipFirstName' );		
		$ownershipLastName 		= $this->input->post ( 'ownershipLastName' );		
		$ownership2FirstName 	= $this->input->post ( 'ownership2FirstName' );
		$ownership2LastName 	= $this->input->post ( 'ownership2LastName' );		
		$ownershipHomePhone 	= $this->input->post ( 'ownershipHomePhone' );
		$ownership2HomePhone 	= $this->input->post ( 'ownership2HomePhone' );
		$ownershipEmail 		= $this->input->post ( 'ownershipEmail' );		
		$ownershipEmail2 		= $this->input->post ( 'ownershipEmail2' );		
		$ownershipDL 			= $this->input->post ( 'ownershipDL' );
		
		$userdata = array (
				'userId' => $sid,
				'businessName' => $businessName,
				'tradeName' => $dbaName,
				'businessType' => $businessType,
				'taxId' => $federalTaxIdTemp,
				'corpState' => $incorporatedStateTemp,
				'websiteUrl' => $websiteAddress,
				'street' => $businessStreetAddress,
				'city' => $businessCity,
				'state' => $businessStateTemp,
				'zip' => $businessZip,
				'ownerFName1' => $ownershipFirstName,
				'ownerLName1' => $ownershipLastName,
				'ownerFName2' => $ownership2FirstName,
				'ownerLName2' => $ownership2LastName,
				'workPhone' => $ownershipHomePhone,
				'mobPhone' => $ownership2HomePhone,
				'email' => $ownershipEmail,
				'email2' => $ownershipEmail2,
				'drLicense' => $ownershipDL 
		);
		
		// $this->Common_model->delrec('business',array('userId'=>$sid));
		// $insid=$this->Common_model->addrec('business',$userdata);
		
		$this->Common_model->updwhere ( 't_business', array (
				'userId' => $sid 
		), $userdata );
		$cdata = array (
				'company_name' => $businessName,
				'company_address1' => $businessStreetAddress,
				'company_City' => $businessCity,
				'company_State' => $businessStateTemp,
				'company_Zipcode' => $businessZip,
				'company_feedback_email' => $ownershipEmail,
				'company_invoice_email' => $ownershipEmail,
				'company_email' => $ownershipEmail,
				'company_phonenumber' => "1-" . $ownershipHomePhone,
				'invoiceEmails' => $ownershipEmail 
		);
		$this->Common_model->updwhere ( 't_centerdb', array (
				'userId' => $sid 
		), $cdata );
		
		$this->Common_model->updwhere ( 't_user', array (
				'id' => $sid 
		), array (
				'update' => $date 
		) );
		redirect ( "applicationForm/billing?signupid=$sid" );
	}
	
	public function savebilling()
	{
		
		if (! $this->session->userdata ( 'loggedInEmail' ))
		{
			redirect ( "login" );
		}	
		$date = date ( 'Y-m-d h:i:s' );
		$sid = $this->input->post ( 'sid' );
		
		$isinsert = $this->Common_model->GetAllWhere ( 't_billing', array (	'userId' => $sid) )[0];
		
		//error_log("isinsert = ".$isinsert);		
		//mail("payehub105@gmail.com", "test", "isinsert = "."print_r = ".print_r($isinsert, 1) );
		
		
		$nameOfPrimaryContact1 = $this->input->post ( 'nameOfPrimaryContact1' );
		$nameOfPrimaryContact2 = $this->input->post ( 'nameOfPrimaryContact2' );
		
		$ownershipTitle = $this->input->post ( 'ownershipTitle' );
		$primaryCellPhoneTemp = $this->input->post ( 'primaryCellPhoneTemp' );
		$businessEmail = $this->input->post ( 'businessEmail' );
		$bankName = $this->input->post ( 'bankName' );
		$transitRoutingNoTemp = $this->input->post ( 'transitRoutingNoTemp' );
		$accountNo = $this->input->post ( 'accountNo' );
		
		$userdata = array (
				'userId' => $sid,
				'name1' => $nameOfPrimaryContact1,
				'name2' => $nameOfPrimaryContact2,
				'title' => $ownershipTitle,
				'phone' => $primaryCellPhoneTemp,
				'email' => $businessEmail,
				'bankName' => $bankName,
				'routingNo' => $transitRoutingNoTemp,
				'accountNo' => $accountNo 
		);
		
		// $this->Common_model->delrec('billing',array('userId'=>$sid));
		// $insid=$this->Common_model->addrec('billing',$userdata);
		
		$this->Common_model->updwhere ( 't_billing', array (
				'userId' => $sid 
		), $userdata );
		$this->Common_model->updwhere ( 't_user', array (
				'id' => $sid 
		), array (
				'update' => $date 
		) );
		// $this->session->set_userdata('userId',$sid);		
		$this->merchant_api($sid, $isinsert['email'] );
		redirect ( "applicationForm/document?signupid=$sid" );
	}
	
	public function details_view()
	{
		$data = array();		
		if (! $this->session->userdata ( 'loggedInEmail' ))
		{
			redirect ( "login" );
		}		
		$sid = $this->session->userdata ( 'id' );
		
		$data ['business'] = $this->Common_model->GetAllWhere ( 't_business', array ('userId' => $sid) )[0];		
		$data ['billing'] = $this->Common_model->GetAllWhere ( 't_billing', array (	'userId' => $sid) )[0];		
		#echo "<pre>"; print_r($data); exit;		
		$this->load->view ( "template/header" );		
		$this->load->view ( "details_view", $data );
		$this->load->view ( "template/footer" );
	}
	
	public function islogin()
	{
		if ( $this->session->userdata ( 'loggedInEmail' ))
		{
			echo '<a href="https://www.payehub.com/onlineapp/login/logout">Logout</a>';
		}
		else
		{
			echo '<a href="https://www.payehub.com/onlineapp/">Login</a>';
		}
	}
	
	public function merchant_api($user_id, $isinsert)
	{
		$res = array();
		//$user_id = $this->input->get('user_id');	
		//mail("payehub105@gmail.com", "test", "print_r = ".print_r($isinsert, 1) );
		if($isinsert)
		{
			
		}
		else
		{
			$business = $this->Common_model->GetAllWhere ( 't_business', array ('userId' => $user_id) )[0];
			$billing = $this->Common_model->GetAllWhere ( 't_billing', array (	'userId' => $user_id) )[0];
			
			$res[]['company_name'] 				= $business['businessName'];
			$res[]['company_email'] 			= $billing['email'];
			$res[]['company_feedback_email'] 	= $billing['email'];
			$res[]['company_invoice_email'] 	= $billing['email'];
			$res[]['company_phonenumber'] 		= $billing['phone'];
			$res[]['company_address'] 			= $business['street'];
			$res[]['company_City'] 				= $business['city'];
			$res[]['company_State'] 			= $business['state'];
			$res[]['company_Zipcode'] 			= $business['zip'];
			//$res['status'] 					= $business['complete'];
			
			$data = http_build_query($res);
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://www.payecrm.com/merchantCreation.php");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($ch, CURLOPT_TIMEOUT, 2);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			$response = curl_exec($ch);
			curl_close($ch);
		}
		return ;		
	}	
}