<?php $this->load->view('header');?>
<?php $this->load->view('left');
//print_r($row);
?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Gateway Transaction Id :</strong> </label>
			<?php echo $row['gatewayTransactionId']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Status :</strong> </label>
			<?php echo $row['status']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Invoice Id : </strong></label>
			<?php echo $row['invoice_id']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Product : </strong></label>
			<?php echo $row['product_name']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer : </strong></label>
			<?php echo $row['customer_name']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Address : </strong></label>
			<?php echo $row['customer_address']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer City : </strong></label>
			<?php echo $row['customer_city']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer State : </strong></label>
			<?php echo $row['customer_state']; ?>
		</div>			
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Country : </strong></label>
			<?php echo $row['customer_country']; ?>
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Zip : </strong></label>
			<?php echo $row['customer_zip']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Email : </strong></label>
			<?php echo $row['customer_email']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Customer Phone : </strong></label>
			<?php echo $row['customer_phone']; ?>
		</div>			
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Card No : </strong></label>
			<?php echo substr($row['cardNo'],-4); ?>
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Gateway : </strong></label>
			<?php echo $row['gatewayID']; ?>
		</div>				
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Agent : </strong></label>
			<?php echo $row['agent_name']; ?>
		</div>			
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Prefix : </strong></label>
			<?php echo $row['prefix']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Center : </strong></label>
			<?php echo $row['companyID']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Amount : </strong></label>
			<?php echo $row['grossPrice']; ?>
		</div> 		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Action Type : </strong></label>
			<?php echo $row['action_type']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Response Text : </strong></label>
			<?php echo $row['response_text']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Response Code : </strong></label>
			<?php echo $row['response_code']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Batch Id : </strong></label>
			<?php echo $row['batch_id']; ?>
		</div>         
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Date : </strong></label>
			<?php echo date('M d,Y H:i:s',strtotime($row['rec_crt_date'])); ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Batched Date : </strong></label>
			<?php echo date('M d,Y H:i:s',strtotime($row['rec_up_date'])); ?>
		</div>


	</div>
</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>  
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		