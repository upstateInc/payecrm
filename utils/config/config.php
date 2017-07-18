<?php
error_reporting(E_ALL);
		/////////////////////////  Global Variables  //////////////////////
		$base_url 		= 'https://www.payecrm.com/crm/';   //will be used to reference the call center home directory.

		/////////// Company variables that will be used for web pages, invoices and customer feedback pages.  //////////////////
		$Company_PDF_Name 	= 'yes';

		
		///////////////  Database Connection Variables For Company Database  /////////////////
		$db_one_use 		= 'yes';
		$host_name_one 		= 'localhost'; // If you dont want to insert data to primary company database
		$db_username_one 	= "root";
		$db_password_one 	= "";
		$db_name_one		= "payecrm_master";
		

				
		////////////////////////////  Do Not Change Any Thing In Below Code    /////////////////////
		$con_one = mysqli_connect($host_name_one,$db_username_one,$db_password_one,$db_name_one);
		if (mysqli_connect_errno()) {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		/*$company_email = 'template@udriveon.com';
		$Gorad_email   = 'template@udriveon.com';*/
?>