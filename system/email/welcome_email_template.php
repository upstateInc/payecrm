<?php
$welcomeHtml='<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<!-- Emailer Start -->
<div style="background:#cccccc; width:100%; overflow:auto;font-family:Arial, Helvetica, sans-serif;">
<div style="background:#ffffff;width: 620px; margin:20px auto;border-radius:5px;">
<div style="width:600px; height:400px; margin:0 auto; background: url(https://www.goradllc.com/system/email/cx.png)">';
if($Company_PDF_Name=='no'){
	$welcomeHtml .='<h1 style="color:#666;text-shadow: 1px 1px 1px #000; font-size:50px; font-weight:normal; width:50%; float: left; padding:0 20px;"> Welcome to <strong>'.$gateway_descriptor.'</strong></h1>';
}else if($Company_PDF_Name=='yes'){
	$welcomeHtml .='<h1 style="color:#666;text-shadow: 1px 1px 1px #000; font-size:50px; font-weight:normal; width:50%; float: left; padding:0 20px;"> Welcome to <strong>'.$company_name.'</strong></h1>';	
}
$welcomeHtml .='<div style="width:50%; color:#666666; font-size:13px; padding:0 15px; float:left;">
  <p>We are a software support team that is committed to delivering satisfaction to our customers. Our specialists, with the use of highly secure remote support tools, will manage your PC as if they were seated right next to you. We perform online computer repairs by deploying a suite of diagnostic and computer repair software to accurately find the root of any computer problems you\'re having and fix it quickly.</p>
  <p>Prior to commencing support, our team will simply explain what your PC\'s problems are and how we plan on reaching a resolution. All technical support tasks are carried out using industry and vendor recommended(Microsoft, Apple, etc.) best practices. And we\'re always here to help. Always. Our support team is the best in the industry and is available 24x7. email, chat or call toll free at <strong>*'.$company_phonenumber.' *</strong></p>
 
	<strong>*For Technical Support and Training*</strong><br/><br/>
	<strong>*'.$company_phonenumber.'*</strong><br/><br/>
	<strong>*Please call for all technical support issues.*</strong><br/><br/>
	
	<strong>*Quality Control & Billing Dept*</strong><br/><br/>
	<strong>*'.$Gorad_Billing_Number.'*</strong><br/><br/>
	<strong>*Please call for all billing and customer support inquires.*</strong><br/><br/>
 </div>
</div>
<table width="100%" border="0">
  <tr>
    <td colspan="2" align="center"><div style="background:#0072b3;	border-top-right-radius: 4em;  color:#b5d3ff; font-size:11px; padding:5px 10px; margin:8px 0 8px 8px;"">
Copyright © '.date('Y').' '.$gateway_descriptor.'. All Rights Reserved
</div></td>
    </tr>
</table>


</div>
</div>

</div>
<!-- Emailer End -->

</body>
</html>';
//echo $welcomeHtml;
?>











