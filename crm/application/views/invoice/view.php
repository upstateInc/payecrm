<?php $this->load->view('header');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>index" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Center : </strong></label>
			<?php echo isset($row['companyID']) ?  $row['companyID']: ''; ?>
		</div>         
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Gateway : </strong></label>
			<?php echo isset($row['gatewayID']) ?  $row['gatewayID']: ''; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Agent Id : </strong></label>
			<?php echo isset($row['agentID']) ?  $row['agentID']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Agent Name : </strong></label>
			<?php echo isset($row['agent_name']) ? $row['agent_name'] : ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Invoice Id : </strong></label>
			<?php echo isset($row['invoice_id']) ?  $row['invoice_id']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Id : </strong></label>
			<?php echo isset($row['customerId']) ?  $row['customerId']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Name : </strong></label>
			<?php echo isset($row['customer_name']) ?  $row['customer_name']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Email : </strong></label>
			<?php echo isset($row['customer_email']) ?  $row['customer_email']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Address : </strong></label>
			<?php echo isset($row['customer_address']) ?  $row['customer_address']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer City : </strong></label>
			<?php echo isset($row['customer_city']) ?  $row['customer_city']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>customer_state : </strong></label>
			<?php echo isset($row['customer_state']) ?  $row['customer_state']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Country : </strong></label>
			<?php echo isset($row['customer_country']) ?  $row['customer_country']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Zip : </strong></label>
			<?php echo isset($row['customer_zip']) ?  $row['customer_zip']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Phone :</strong> </label>
			<?php echo isset($row['customer_phone']) ?  $row['customer_phone']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Product Id : </strong></label>
			<?php echo isset($row['productId']) ?  $row['productId']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Product Name : </strong></label>
			<?php echo isset($row['product_name']) ?  $row['product_name']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Gross Price : </strong></label>
			<?php echo isset($row['grossPrice']) ?  $row['grossPrice']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Card No :</strong> </label>
			<?php echo isset($row['cardNo']) ?  $row['cardNo']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Card Type : </strong></label>
			<?php echo isset($row['cardType']) ?  substr($row['cardType'],-4): ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Gateway Transaction Id :</strong> </label>
			<?php echo isset($row['gatewayTransactionId']) ?  $row['gatewayTransactionId']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Reason Code : </strong></label>
			<?php echo isset($row['reason_code']) ?  $row['reason_code']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Reason Descrption :</strong> </label>
			<?php echo isset($row['reason_descrption']) ?  $row['reason_descrption']: ''; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Ip : </strong></label>
			<?php echo isset($row['ip']) ?  $row['ip']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Paid : </strong></label>
			<?php echo isset($row['paid']) ?  $row['paid']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Duplicate : </strong></label>
			<?php echo isset($row['duplicate']) ?  $row['duplicate']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Tran Type : </strong></label>
			<?php echo isset($row['tran_type']) ?  $row['tran_type']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Validated :</strong> </label>
			<?php echo isset($row['validated']) ?  $row['validated']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Rating :</strong> </label>
			<?php if($row['rating']>0){echo $row['rating'];} ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Comment : </strong></label>
			<?php echo isset($row['comment']) ?  $row['comment']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Gateway Descriptor : </strong></label>
			<?php echo isset($row['gateway_descriptor']) ?  $row['gateway_descriptor']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Company Name : </strong></label>
			<?php echo isset($row['company_name']) ?  $row['company_name']: ''; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Product Duration :</strong> </label>
			<?php echo isset($row['productDuration']) ?  $row['productDuration']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Status :</strong> </label>
			<?php echo isset($row['status']) ?  $row['status']: ''; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Transaction Date : </strong></label>
			<?php echo isset($row['rec_crt_date']) ?  $row['rec_crt_date']: ''; ?>
		</div>

	</div>
</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>  
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		