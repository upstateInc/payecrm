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
			<label for="exampleInputEmail1"><strong>Center : </strong></label>
			<?php echo $row['companyID']; ?>
		</div>         
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Gateway : </strong></label>
			<?php echo $row['gatewayName']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Directory Name : </strong></label>
			<?php echo $row['directory']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Program Name : </strong></label>
			<?php echo $row['programName']; ?>
		</div><div class="form-group">
			<label for="exampleInputEmail1"><strong>Descriptor : </strong></label>
			<?php echo $row['decriptor']; ?>
		</div>
		
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Status :</strong> </label>
			<?php echo $row['status']; ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Created Date : </strong></label>
			<?php echo date('M d,Y',strtotime($row['rec_crt_date'])); ?>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Edited Date : </strong></label>
			<?php if($row['rec_update_date']>0){echo date('M d,Y',strtotime($row['rec_update_date']));} ?>
		</div>

	</div>
</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>  
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		