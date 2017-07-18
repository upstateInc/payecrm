<?php
$feedbackhtml = '<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<!-- Emailer Start -->
<div style="background:#cccccc; width:100%; overflow:auto;font-family:Arial, Helvetica, sans-serif;">


<div style="background:#ffffff;width: 620px; margin:5px auto;border-radius:5px;">
<table width="100%" border="0">
  <tr>
    <td colspan="2"><div style="background:#0072b3;	border-top-left-radius: 4em; text-align:right; width:94%; float:right; color:#b5d3ff; font-size:11px; padding:5px 10px; margin:8px 8px 0 0;"></div></td>
    </tr>
</table>

<div style="width:600px; height:400px; margin:0 auto;">

  <div style="width:90%; color:#666666; font-size:12px; padding:0 20px; float:left;">
  <p>'.date('M d,Y').'</p>
<p>
  <tr>
	<td style="padding:0 20px; float:left;">
		<strong>Sales and Support</strong><br/>
		<strong>'.$company_phonenumber.'</strong><br/>
		<strong>Please call for all customer support issues.</strong><br/>
	</td>
  </tr>
</p>
<p>
  <tr>
	<td style="padding:0 20px; float:left;">
		<strong>Quality Control & Billing Dept</strong><br/>
		<strong>'.$Gorad_Billing_Number.'</strong><br/>
		<strong>Please call for all billing and customer inquires.</strong><br/>
	</td>
  </tr>
</p>

  <p>Dear '.$fname.' '.$lname.',</p>
  <p>We want to welcome you and thank you for joining our training and support services program.</p>
  <p>In order to confirm your purchase we want you to validate the plan you have selected.</p>
  <p>We hereby confirm that your payment of $ '.$product_price.' has been processed on '.date('M d,Y').' .</p>

  <p><span style="align:center;"><strong>This payment will appear on your billing statement as follows:</strong> </span><br/> <span style="align:center;"><strong style="color:red;">'.$gateway_descriptor.'</strong>. </span></p>
  <p>Customer IP Address : '.$ip.'</p>

  <p>I, <strong>'. $fname .' '. $lname .'</strong> authorize payment of <strong>USD $'. $product_price .' </strong>to <strong>'.$gateway_descriptor.'</strong> through my '.$cardtype.' ending with the last four digits: <strong>'.substr($cardnumber, -4) .'</strong>  for the training and support services offered under the <strong>'.trim($product_name).'</strong>. I reside at<strong> '.$address.' '. $address2.', '.$city.', '.$state.'-'.$zip.'  '.$country.' </strong>and my phone number  is <strong>'.str_replace(" ","",$phone).'</strong>.  </p>

  <p>Also we like you to spend few minutes filling out the quick feedback email.<br/>This will help us to improve our services to you.</p>
  <p>
  <strong>Feedback Questions:</strong></p>
  <p>1. Was your issue RESOLVED? (Yes/No)<br/>
	Answer:
  </p>
  <p>2. Was our technician helpful and professional? (Yes/No)<br/>
Answer:  
</p>
<p>3. How would you rate the technician? (1 is Lowest to 10 being the highest)<br/>
Answer:  
</p>
<p>4. Are you happy with the service that you received?  (Yes/No)<br/>
Answer:  
</p>
<p>
5. Did you authorize us to charge you credit/debit card for the payment of $'. $product_price. '?  (Yes/No)<br/>
Answer:  
</p>
<p>
6. Please provide us with any comments or suggestions to help us to improve our service to you?<br/>
Answer:
</p>
<p>
We look forward to building a great relationship with you.<br/>
We appreciate your business, time and patience.
</p>
<p>
Best Regards,
</p>';
if($Company_PDF_Name=='no'){
	$feedbackhtml .='<p>
	'.$gateway_descriptor.'<br/>
	'.$Gorad_Billing_Number.'
	</p>';
}
if($Company_PDF_Name=='yes'){
	$feedbackhtml .='<p>
	'.$company_name.'<br/>
	'.$company_phonenumber.'
	</p>';
}
$feedbackhtml .='</div>
  
</div>



<table width="100%" border="0">
  <tr>
    <td colspan="2" align="center"><div style="background:#0072b3;	border-top-right-radius: 4em;  color:#b5d3ff; font-size:11px; padding:5px 10px; margin:8px 0 8px 8px;"">';
if($Company_PDF_Name=='no'){
	$feedbackhtml .= 'Copyright © '.date('Y').' '.$gateway_descriptor.'. All Rights Reserved';
}	
if($Company_PDF_Name=='yes'){
	$feedbackhtml .= 'Copyright © '.date('Y').' '.$company_name.'. All Rights Reserved';
}
$feedbackhtml .='</div></td>
    </tr>
</table>


</div>
</div>

</div>
<!-- Emailer End -->

</body>
</html>';
//echo $feedbackhtml;
?>








