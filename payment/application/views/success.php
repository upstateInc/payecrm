<!DOCTYPE HTML>
<html lang="en">
<!-- Mirrored from themearmada.com/demos/sharkfin/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Jun 2015 08:15:09 GMT -->
<head>
  <meta charset="utf-8">
	<title>Payment Successful</title>
 	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
  

<style>
 .table td, th{ border:none !important; padding:4px 8px !important;}
 #radial-center {
	background-color: #bfb3d6;
	background-image: url(images/radial_bg.png);
	background-position: center center;
	background-repeat: no-repeat;
	background: -webkit-gradient(radial, center center, 0, center center, 460, from(#f7f5f6), to(#bfb3d6));
	background: -webkit-radial-gradient(circle, #ffffff, #bfb3d6);
	background: -moz-radial-gradient(circle, #ffffff, #bfb3d6);
	background: -ms-radial-gradient(circle, #ffffff, #bfb3d6);
}
</style> 
</head>
<?php
$invoiceQuery = $this->db->query("select * from t_invoice where id='".$this->session->userdata('insert_invoive_id')."'")->row();
//print_r($invoiceQuery);
	$securityProtection=$invoiceQuery->securityProtection;
	$totalDevices=$invoiceQuery->totalDevices;
?>
  <body style="background:#ffffe6;">
    <section>
      <div class="container tec">
         <div class="col-md-2">&nbsp;</div>
         
            <div class="col-md-8">
            <fieldset id="radial-center" style="border: 1px solid #c0c0c0 !important; margin: 0; padding: 0 24px;">
           <p>&nbsp;</p>
           <p style="font-size:35px; font-weight:bold; text-align:center; color:#40b70c;">Payment Successful</p>
           <p style="font-size:20px; font-weight:bold; text-align:center;">This payment will appear on your billing statement as follows:</p>
           <p style="font-size:30px; font-weight:bold; text-align:center; color:#e0084a;"><?php echo $this->session->userdata('gateway_descriptor');?></p>
           
           <p>&nbsp;</p>
        
           
           <table class="table" style="border:none;">
            <tbody>
              <tr>
                <td>Invoice Number: <?php echo $this->session->userdata('orderid');?></td>
                <td>&nbsp;</td>
                <td align="right">Invoice Date: <?php echo date("F j, Y");?></td>
              </tr>
              <tr>
                <td>Bill to:</td>
                <td>&nbsp;</td>
                <td align="right">Customer ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $this->session->userdata('insert_invoive_id');?></td>
              </tr>
              <tr>
                <td><?php echo $this->session->userdata('customer_name');?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><?php echo $this->session->userdata('address');?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><?php echo $this->session->userdata('city').', '.$this->session->userdata('state').' - '.$this->session->userdata('zip');?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Email: <a href="mailto:<?php echo $this->session->userdata('email');?>"><?php echo $this->session->userdata('email');?></a></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </tbody>
          </table>
          
          <!--2nd table-->
          
          <table class="table">
            <tbody>
              <tr>
                <th>Products & Services</th>
                <!--th style="text-align:center !important;">Sku No.</th>
                <th style="text-align:center !important;">Sku Name</th>
                <th style="text-align:center !important;">Quantiy</th-->
				<th></th>
				<th></th>				
                <th style="text-align:center !important;">Term</th>
                <th style="text-align:right !important;">Pricing</th>
              </tr>
			  <?php
				$product_query = $this->db->query("select a.*, b.productName, b.ProductSupscriptionPeriod, b.sku_name, b.sku_number from t_cart as a left join t_product as b on a.product_id = b.id where a.invoice_id='".$this->session->userdata('insert_invoive_id')."'");			
				foreach($product_query->result() as $rowProducts){ 
					$ProductSupscriptionPeriod  = floor($rowProducts->ProductSupscriptionPeriod/30);
					if($ProductSupscriptionPeriod==0){
						$productSubscriptionPeriodDisplay="One Time";
					}else{
						$productSubscriptionPeriodDisplay=$ProductSupscriptionPeriod." month(s)";
					}								
				?>
				  <tr>
					<td><?php echo $rowProducts->productName;?>: <br>Training and Support Services</td>
					<!--td align="center"><?php echo $rowProducts->sku_number;?></td>
					<td align="center"><?php echo $rowProducts->sku_name;?></td>
					<td align="center"><?php echo $rowProducts->quantity;?></td-->
					<td></td>
					<td></td>					
					<td align="center"><?php echo $productSubscriptionPeriodDisplay;?></td>
					<td align="right">$<?php echo $rowProducts->quantity*$rowProducts->price_each;?></td>
				  </tr>
  				<?php }	?> 
				
			<?php 
			if($securityProtection > 0){ ?>
			<?php $securityProtection=$securityProtection*12;?>
					<tr>
						<td>Security Protection</td>
						<td></td>
						<td></td>						
						<td align="center"><?php echo $securityProtection.' Months'; ?></td>
						<td align="right">Included</td>
					</tr> 
			 <?php } ?>
			  <?php if($totalDevices > 0){ ?>
					  <tr>
						<td>Number of Devices</td>
						<td></td>
						<td></td>						
						<td align="center"><?php echo $totalDevices; 
							if($totalDevices==1){
								echo ' Device';
							}else{
								echo ' Devices';
							}
						?></td>
						<td align="right">Included</td>
					  </tr>	
			<?php } ?>
			  
              <tr>
                <td colspan="5"><hr style="border:1px solid #333;"></td>
              </tr>
              <tr>
                <td><strong>TOTAL AMOUNT :</strong></td>
                <td></td>
                <td></td>
                <td></td>
                <td align="right"><strong>$<?php echo $this->session->userdata('product_price');?></strong></td>
              </tr>
              <tr>
                <td><strong>&nbsp;</strong></td>
                <td>&nbsp;</td>
                <td align="right"><strong>&nbsp;</strong></td>
              </tr>
              <tr>
                <td><strong>&nbsp;</strong></td>
                <td>&nbsp;</td>
                <td align="right"><strong>&nbsp;</strong></td>
              </tr>
              
            </tbody>
          </table>
          
        
        <!--<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>-->
            </fieldset>
        </div>
         
         <div class="col-md-2">&nbsp;</div>
      </div>
    </section>
    
    
    
    
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  </body>
</html>
 
 
 
  
     
