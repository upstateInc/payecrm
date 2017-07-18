<?php
$orderwelcome1 = '<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<!-- Emailer Start -->
<div style="background:#cccccc; width:100%; overflow:auto;font-family:Arial, Helvetica, sans-serif;">


<div style="background:#ffffff;width: 620px; margin:20px auto;border-radius:5px;">

<div style="width:600px; height:220px; margin:0 auto;background:#f5f5f5 url(https://www.goradllc.com/system/email/order.png) right 20px no-repeat;">

  <h1 style="color:#666; font-size:24px; font-weight:normal; width:45%; float: left; padding:0 20px;"> Order Confirmation <strong style="font-size:50px; display:block;text-shadow: 1px 1px 1px #000;">Thank You.</strong>



  <span style="font-size:12px; color:#666666;">
  <p>'.@$AgentNote.'</p>
  <p>Here are important details about your order.</p>
  <p>Questions? We are here to help.</p>

	<!--strong>For Technical Support and Training</strong><br/>
	<strong>'.$company_phonenumber.'</strong><br/>
	<strong>Please call for all technical support issues.<strong><br/><br/-->
	
	<strong>Quality Control & Billing Dept</strong><br/>
	<strong>'.$Gorad_Billing_Number.'</strong><br/>
	<strong>Please call for all billing and customer inquires.<strong><br/>
  </span> 
  </h1>
</div>

  <div style="width:40%; color:#666666; font-size:12px; ">
  
<table width="80%" cellpadding="4" border="0" style="background:#fff; margin:2px auto; filter: alpha(opacity=80);-moz-opacity:0.8;-khtml-opacity: 0.8;opacity: 0.8;">
  <tr>
    <td colspan="2">Order Number: '.$orderid.'</td>
    </tr>
  <tr>
    <td colspan="2">Customer Number: <strong>'.$unique_pin.'</strong></td>
    </tr>  
</table>

  </div>

<table width="100%" border="0">
  
  <tr>
    <td colspan="2" align="center"><div style="background:#0072b3;	border-top-right-radius: 4em;  color:#b5d3ff; font-size:11px; padding:5px 10px; margin:8px 0 8px 8px;"">
Copyright © '.date("Y").' '.$gateway_descriptor.'. All Rights Reserved
</div></td>
    </tr>
  
</table>


</div>
</div>

</div>
<!-- Emailer End -->

</body>
</html>';

?>










