<?php
class Mail_model extends CI_Model {

	public function __construct() {
	
		parent::__construct();
	}
	
	public function mail_content($username,$mailContent,$title='') {
	
		$msg = '<html>
		<head>
		<style>
		table {
			display: table;
			border-collapse: separate;
			border-spacing: 0;
			border: 0;
			background:#f1f1f1;
		} 
		</style>
		</head>
		
		<body>
		<p>&nbsp;</p>
		<table width="700px;" align="center" border="0" cellpadding="0" cellspacing="2">
		  <tr style="background:#2c3544; color:#ffffff;">
			<td style="padding:20px;"><a href="http://www.techejobs.com" target="_blank"><img src="http://techejobs.com/assets/images/logo.png" style="border:none;" /></a></td>
			<td style="padding:20px;" width="200"> <div align="right">Helpline : 1-888-720-JOBS</div></td>
		  </tr>
		  <tr>
			<td colspan="2" style="padding:20px;">
			<div style="width:100%; text-align:center; color:#333333; border-bottom:1px solid #cccccc;">
			<h1>'.$title.'</h1>
			</div>
			<div style="font: normal 12px Arial, Helvetica, sans-serif; color:#666;">
		
		   <p style="font-size:18px; line-height:30px; text-align:center;">'.$mailContent.'</p>
			
			 
		</div>    </td>
		  </tr>
		
		  <tr style="background:#2c3544; color:#ffffff;">
			<td colspan="2"><p align="center">Visit our Help center or Email us at sales@techejobs.com for any assistance you may require.</p></td>
		  </tr>
		</table>
		<p>&nbsp;</p>
		
		</body>
		</html>
		';
	
	return $msg;

	}

	
	
	
} // end of class