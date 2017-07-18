<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/utils/config/config.php');

$product_query = mysqli_query($con_one,"select a.*, b.productName, b.ProductSupscriptionPeriod, b.sku_name, b.sku_number from t_cart as a left join t_product as b on a.product_id = b.id where a.invoice_id='".$insert_invoive_id."'");

/*print_r($product_query);
exit;*/
$product_name=$ProductName;

if($phoneNo=="EnterNumber"){
	$phone =$phoneNoval;
}
if($phoneNo=="Blank"){
	$phone ="";
}

$pdf_htmlNew = '<div style="background:#ffffff;width: 700px; margin:20px auto; border-radius:5px; border:1px solid #666;font-family:Arial, Helvetica, sans-serif; position:relative; color:#666666; font-size:12px;">

<table width="100%" border="0" style="padding:20px 40px 0 40px;">

  <tr>

    <td colspan="2" >

    <table border="0" style="margin:0 auto; width:100%;">

      <tr>

        <td>';

$pdf_htmlNew .=		'<strong>'.$gateway_descriptor.' </strong><br><br/>';
		
		
$pdf_htmlNew .= '<strong>Quality Control & Billing Dept</strong><br/>
			<strong>'.$Gorad_Billing_Number.'</strong><br/>
			Please call for all billing and customer support inquires.<br/><br/>
		
		<span style="align:center;"><strong>This payment will appear on your billing statement as follows: </strong><br/></span><span style="align:center;"> <strong style="color:red;">'.$gateway_descriptor.'</strong> </span><br>

	</td>
	<td></td>
	</tr>
	<tr>
    	<td colspan="2"><hr size="2" color="#000000"></td>
    </tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td>Invoice Number: '.$orderid.'</td>

        <td><div style="text-align:right;">Invoice Date: '.date('M d,Y', strtotime($insertInvoice['rec_crt_date'])).' </div></td>

      </tr>

      <tr>

        <td colspan="2"><hr size="1" color="#000000"> </td>

        </tr>

      <tr>

        <td>  <div style="font-size:12px; color:#666666; line-height:17px;">

    Bill to: <br>

    '. ucfirst($fname).' '. ucfirst($lname).'<br>

    '. $address.' '. $address2.'<br>

    '. $city.', '. $state.' - '. $zip.', '.$country.'<br>

Email:<span style="color:#0066FF">'. $email.' </span><br>'; 
if($phoneNo=="EnterNumber"){
	$pdf_htmlNew .='Phone:<span style="color:#0066FF">'. $phoneNoval.' </span>';
}if($phoneNo=="Customer"){
	$pdf_htmlNew .='Phone:<span style="color:#0066FF">'. $phone.' </span>';
}
$pdf_htmlNew .= '</div> </td>

        <td><table width="200px;" style="float:right; border:1px solid #000000; background:#f5f5f5">

          <tr>

            <td><div align="right">Customer ID:</div></td>

            <td style="text-align:right;">'. $unique_pin.'</td>

          </tr>

        </table></td>

      </tr>

      <tr>

        <td colspan="2"><hr size="1" color="#000000"> </td>

        </tr>

      <tr>

        <td colspan="2">

        <table width="100%" border="0" cellpadding="2">

  <tr>

    <td style="width:50%"><strong align="center">Products &amp; Services</strong></td>

    <td><strong align="center">Term</strong></td>

    <td><div align="right"><strong>Pricing</strong></div></td>

  </tr>';



/***************Prouduct Listings**********************/
while($row = $product_query->fetch_array()){
	/*print_r($row);
	exit;*/
					$ip=$row['customer_ip'];
					$ProductSupscriptionPeriod  = floor($row['ProductSupscriptionPeriod']/30);
					if($ProductSupscriptionPeriod==0){
						$productSubscriptionPeriodDisplay="One Time";
					}else{
						$productSubscriptionPeriodDisplay=$ProductSupscriptionPeriod." month(s)";
					}					
					$pdf_htmlNew .='<tr>';
					/*if($productNameShow=='product'){
						$pdf_htmlNew .= '<td align="left" style="border:none;"><strong>'.$row['productName'].'</strong></td>';
					}*/
						$pdf_htmlNew .= '<td align="left" style="border:none;"><strong>'.$product_name.'</strong></td>';
					//$pdf_htmlNew .= '<td align="left" style="border:none;"><strong>'.$productSubscriptionPeriodDisplay.'</strong></td>';
						$pdf_htmlNew .= '<td align="left" style="border:none;"><strong>30 Days Refund Policy</strong></td>';
						$pdf_htmlNew .= '<td align="right" style="border:none;"><strong>$'.number_format($row['quantity']*$row['price_each'],2).'</strong></td>';
					$pdf_htmlNew .='</tr>';
				}
//$pdf_htmlNew .='<tr><td align="left" colspan="3">Training and Support Services</td></tr>';
/*************Prouduct Listings Ends*******************/
  
  
   /* if($insertInvoice['securityProtection'] > 0){
    $pdf_htmlNew .='<tr>
	<td>Security Protection</td>
    <td>';?>
	<?php $securityProtection=$insertInvoice['securityProtection']*12;?>
	<?php
	$pdf_htmlNew .= $securityProtection.' Months</td>
    <td><div align="right">Included</div></td>
    
  </tr>';}*/
	/*if($insertInvoice['totalDevices'] > 0){
  $pdf_htmlNew .='<tr>
    <td>Number of Devices</td>
    <td>'.$insertInvoice['totalDevices'];?>
	<?php
	if($insertInvoice['totalDevices']==1){
		$divNo=' Device';
	}else{
		$divNo=' Devices';
	}
	?>
	<?php
	$pdf_htmlNew .= $divNo.'</td>
    <td><div align="right">Included</div></td>
  </tr>';
	}*/
	$pdf_htmlNew .='<tr><td colspan="3"><hr></td></tr>';
  $pdf_htmlNew .='<tr>    
    <td><strong>TOTAL AMOUNT: </strong></td>
	<td>&nbsp;</td>
    <td><div align="right"><strong>$'. $product_price.'</strong></div></td>
    </tr>
	<tr><td colspan="3"><hr></td></tr>
  <tr>
    
    <td colspan="3"><hr size="1" color="#000000"> </td>
    
  </tr>

    <tr>
      
      <td colspan="3"><hr size="1" color="#000000"> </td>
      
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>

    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>

        </table>        </td>

        </tr>

      <br>

    </table></td>

  </tr>

  <tr>

    <td colspan="2"><hr size="2" color="#000000">   </td>

    </tr>

</table>

<div style="font-size:8px; color:#999999; font-style:italic; text-align:center;">

      <p>This is a computer generated invoice.<br>

<strong>Return Policy:</strong> At '.$gateway_descriptor.' we try and  deliver services perfectly each and every time. But in the off-chance that you need to return this order, please contact our Billing Department. Please help us in helping you. Terms and conditions apply.  </p>

 <p>Please contact us should you have any questions or need further assistance '.$gateway_descriptor.'

'.$Gorad_Billing_Number.' </p>

      <p> The services rendered and sold  are intended for end user usage and not for re-sale.</p>

  </div>

 </div>

 

 <div style="page-break-after:always;">...</div>

 

 

 <!-- Auth Start -->

 

 

 <div style="background:#ffffff;width: 700px; margin:20px auto; border-radius:5px; border:1px solid #666;font-family:Arial, Helvetica, sans-serif; position:relative; color:#666666; font-size:12px;">

<table width="100%" border="0" style="padding:20px 40px 0 40px;" >

  <tr>

    <td colspan="2" >

    <table border="0" style="margin:0 auto;">

      <tr>

       <td style="font-size:10px;">';


$pdf_htmlNew .=		'<strong>'.$gateway_descriptor.' </strong><br><br/>';
		


$pdf_htmlNew .= '<!--strong>For Technical Support and Training</strong><br/>
			<strong>'.$company_phonenumber.'</strong><br/>
			Please call for all technical support issues.<br/><br/-->

			<strong>Quality Control & Billing Dept</strong><br/>
			<strong>'.$Gorad_Billing_Number.'</strong><br/>
			Please call for all billing and customer support inquires.<br/><br/>
		
		<span style="align:center;"><strong>This payment will appear on your billing statement as follows: </strong><br/></span><span style="align:center;"> <strong style="color:red;">'.$gateway_descriptor.'</strong> </span><br>

</td>

        <td><div align="right"><!--img src="email/logo.png" style="padding:0;border:0;" alt="'.$companyID.'" title="'.$companyID.'"--></div></td>

      </tr>

        <tr>

    <td colspan="2"><hr size="2" color="#000000"></td>

  </tr>

      <tr>

        <td colspan="2">&nbsp;</td>

        </tr>

      <tr>

        <td>&nbsp;</td>

        <td>&nbsp;</td>

      </tr>

      <tr>

        <td colspan="2"><h2 align="center">Online Payment Authorization Summary</h2></td>

        </tr>

      <tr>

        <td colspan="2"><p> I do understand that my authorization signature in this document is a digital one and may not match with my original signature.</p>
        <p>I, <strong>'. $fname .' '. $lname .'</strong> authorize payment of <strong>USD $'. $product_price .' </strong>to <strong>'.$gateway_descriptor.'</strong> through my <strong>'; ?>
		
       <?php
	    
			
			if($PaymentType == 'credit_card'){
				$cardtype = $cardtype.' ending with the last four digits ';
				$cardnumber = $cardnumber;
			}
      
	  		if($PaymentType == 'echecking'){
				$cardtype = $BankName.' Checking Account and check number ';
				$cardnumber = $CheckNumber;
			}
    
		
		?>
		<?php 
		//$pdf_htmlNew .=$cardtype.'</strong> : <strong>'.substr($cardnumber, -4) .'</strong>  for the training and support services offered under the <strong>'.trim($product_name).'</strong>. I reside at<strong> '.$address.' '. $address2.', '.$city.', '.$state.'-'.$zip.'  '.$country.' </strong>and my phone number  is
		
		$pdf_htmlNew .=$cardtype.'</strong> : <strong>'.substr($cardnumber, -4) .'</strong>  for the <strong>'.trim($product_name).'</strong> item. I reside at<strong> '.$address.' '. $address2.', '.$city.', '.$state.'-'.$zip.'  '.$country.' </strong>';
		
		if($phone!=""){
			$pdf_htmlNew .='and my phone number  is <strong>'.str_replace(" ","",$phone).'</strong>.' ;
		}

		$pdf_htmlNew .='</p></td>
	
        </tr>

      <tr>

        <td>

        <table border="0">

  <tr>

    <td></td>

    <td>

    <div style="min-height:100px;"><br>

<br>

<br>

<br>

    </div>

    </td>

  </tr>

  <tr>

    <td><strong>'. $fname .'  '. $lname .'</strong></td>

  </tr>

</table>        </td>

        <td>

        <table style="float:right;">

  <tr>

    <td><div align="right">Customer IP:</div></td>



    <td><strong>'. $ip .'</strong></td>

  </tr>

  <tr>

    <td>&nbsp;</td>

    <td style="text-align:right;">&nbsp;</td>

  </tr>

  <tr>

    <td><div align="right">Date:</div></td>

    <td> <strong>'.date('M d,Y', strtotime($insertInvoice['rec_crt_date'])).'</strong></td>

  </tr>

</table>        </td>

      </tr>

	  <br>

    </table></td>

  </tr>

  <tr>

    <td colspan="2">

      <hr size="2" color="#000000">   </td>

    </tr>

</table>



<div style="font-size:8px; color:#999999; font-style:italic; text-align:center;">

      <p>Please contact us should you have any questions or need further assistance '.$gateway_descriptor.' - '.$Gorad_Billing_Number.' </p>

  </div>

 </div>

</div>';
/*echo $pdf_htmlNew;
exit;*/
?>





