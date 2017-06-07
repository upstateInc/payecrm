<?php $this->load->view('header');?>
<?php $this->load->view('left');
//print_r($row);
?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>index" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
<?php 
 if($product_query->num_rows() > 0){
 ?>
 <table width="100%" border="1" id="myTable" class="tablesorter">
 <thead>
  <tr>
    <!--th class="table_left table_th table_th_width_3">Category</th>
	<th class="table_th table_th_width_1">Brand Name</th>
	<th class="table_th table_th_width_1">Generic Name</th-->
	<th class="table_th table_th_width_1">Product Name</th>
	<th class="table_th table_th_width_4">Quantity</th>
	<th class="table_center table_th table_th_width_3">Amount</th>
	<th class="table_center table_th table_th_width_4">Total</th>

  </tr>
  </thead>
	<?php 
	$i=0;
	foreach($product_query->result() as $val){
		$i+=1;	
		if($i%2==0){
			$colourCode="d5d9dc";
		}else{
			$colourCode="eaeef1";
		}
		$productPrice =$productPrice+($val->price_each*$val->quantity); 
	?> 
		<tr style="background:#<?php echo $colourCode;?>">			
			<td><?php echo $val->productName; ?></td>
			<!--td><?php echo $val->brandName;?></td>
			<td><?php echo $val->genericName;?></td-->
			<td style="text-align:center;" ><?php echo $val->quantity;?></td>
			<td style="text-align:center;" >$<?php echo sprintf('%0.2f',$val->price_each);?></td>
			<td style="text-align:right;"><?php echo '$'.sprintf('%0.2f',$val->quantity * $val->price_each);?></td>
		</tr>
	<?php } ?>	
</table>
 <?php } ?>
<br/> 
<br/> 
<?php if($this->session->userdata('ADMIN_COMPANYID')==""){ ?>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Center : </strong></label>
			<?php echo $row['companyID']; ?>
		</div> 
<?php } ?>
<?php if($this->session->userdata('ADMIN_PERMISSION') == "system"){ ?>        
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Gateway : </strong></label>
			<?php echo $row['gatewayID']; ?>
		</div>
<?php } ?>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Agent Id : </strong></label>
			<?php echo $row['agentID']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Agent Name : </strong></label>
			<?php echo $row['agentName']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Invoice Id : </strong></label>
			<?php echo $row['invoice_id']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Id : </strong></label>
			<?php echo $row['customerId']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Name : </strong></label>
			<?php echo $row['fname'].' '.$row['lname']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Email : </strong></label>
			<?php echo $row['customer_email']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Address : </strong></label>
			<?php echo $row['customer_address']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer City : </strong></label>
			<?php echo $row['customer_city']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>customer_state : </strong></label>
			<?php echo $row['customer_state']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Country : </strong></label>
			<?php echo $row['customer_country']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Zip : </strong></label>
			<?php echo $row['customer_zip']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Phone :</strong> </label>
			<?php echo $row['customer_phone']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Product Id : </strong></label>
			<?php echo $row['productId']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Product Name : </strong></label>
			<?php echo $row['product_name']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Gross Price : </strong></label>
			<?php echo $row['grossPrice']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Card No :</strong> </label>
			<?php echo $row['cardNo']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Card Type : </strong></label>
			<?php echo substr($row['cardType'],-4); ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Gateway Transaction Id :</strong> </label>
			<?php echo $row['gatewayTransactionId']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Reason Code : </strong></label>
			<?php echo $row['reason_code']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Reason Descrption :</strong> </label>
			<?php echo $row['reason_descrption']; ?>
		</div>
		<!--div class="form-group">
			<label for="exampleInputEmail1"><strong>Sign : </strong></label>
			<?php echo $row['sign']; ?>
		</div-->
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Ip : </strong></label>
			<?php echo $row['ip']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Paid : </strong></label>
			<?php echo $row['paid']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Duplicate : </strong></label>
			<?php echo $row['duplicate']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Tran Type : </strong></label>
			<?php echo $row['tran_type']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Validated :</strong> </label>
			<?php echo $row['validated']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Rating :</strong> </label>
			<?php if($row['rating']>0){echo $row['rating'];} ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Comment : </strong></label>
			<?php echo $row['comment']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Billing Company Name : </strong></label>
			<?php echo $row['gateway_descriptor']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Company Name : </strong></label>
			<?php echo $row['company_name']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Product Duration :</strong> </label>
			<?php echo $row['productDuration']; ?>
		</div>
		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Routing Number :</strong> </label>
			<?php echo $row['RoutingNumber']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Account Number :</strong> </label>
			<?php echo $row['AccountNumber']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Bank Name :</strong> </label>
			<?php echo $row['BankName']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Check Date :</strong> </label>
			<?php echo $row['CheckDate']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Check Number :</strong> </label>
			<?php echo $row['CheckNumber']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Check Memo :</strong> </label>
			<?php echo $row['CheckMemo']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Payment Type :</strong> </label>
			<?php if($row['paymentType']=='credit_card'){ echo 'Credit Card';}else if($row['paymentType']=='echecking'){ echo 'EChecking';} ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Security Protection :</strong> </label>
			<?php echo $row['securityProtection']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Total Devices :</strong> </label>
			<?php echo $row['totalDevices']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Original Gateway Transaction Id :</strong> </label>
			<?php echo $row['originalGatewayTransactionId']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Source of Transaction :</strong> </label>
			<?php echo $row['sourceCode']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Batch Id :</strong> </label>
			<?php echo $row['batch_id']; ?>
		</div>
		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Status :</strong> </label>
			<?php echo $row['status']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Transaction Date : </strong></label>
			<?php echo $row['rec_crt_date']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Captured Date : </strong></label>
			<?php if($row['captured_date']!="0000-00-00 00:00:00") echo $row['captured_date']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Captured By : </strong></label>
			<?php echo $row['captured_by']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Final Status Date : </strong></label>
			<?php echo $row['rec_up_date']; ?>
		</div>

	</div>
</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>  
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		