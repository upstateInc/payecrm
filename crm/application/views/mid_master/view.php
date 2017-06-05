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
			<label for="exampleInputEmail1"><strong>Payment Type : </strong></label>
			<?php if($row['paymentType']=='credit_card'){ echo 'Credit Card';}else if($row['paymentType']=='echecking'){ echo 'EChecking';} ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Gateway : </strong></label>
			<?php echo $row['gatewayID']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Gateway Type : </strong></label>
			<?php echo $row['gatewayType']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Program Name : </strong></label>
			<?php echo $row['programName']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Username : </strong></label>
			<?php echo $row['username']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Password : </strong></label>
			<?php echo $row['password']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Mid Number : </strong></label>
			<?php echo $row['mid_number']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Key : </strong></label>
			<?php echo $row['mid_key']; ?>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Link : </strong></label>
			<?php echo $row['link']; ?>
		</div>
		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Status :</strong> </label>
			<?php echo $row['status']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Created Date : </strong></label>
			<?php echo date('M d,Y',strtotime($row['rec_crt_date'])); ?>
		</div>
		

	</div>
</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>  
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		