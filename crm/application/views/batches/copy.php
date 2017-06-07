<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>insert" enctype="multipart/form-data"> 
		<div class="form-group">
			<label for="exampleInputEmail1">Center*</label>
			<input type="text" class="form-control" id="companyID" name="companyID" placeholder="companyID" required="required" value="<?php echo $query['companyID']; ?>">
		</div>         
		<div class="form-group">
			<label for="exampleInputEmail1">Gateway*</label>
			<input type="text" class="form-control" id="gatewayName" name="gatewayName" placeholder="gatewayName" required="required" value="<?php echo $query['gatewayName']; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Directory Structure*</label>
			<input type="text" class="form-control" id="directory" name="directory" placeholder="directory" required="required" value="<?php echo $query['directory']; ?>" >	
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Program Name*</label>
			<input type="text" class="form-control" id="programName" name="programName" placeholder="programName" required="required" value="<?php echo $query['programName']; ?>">
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Descriptor*</label>
			<input type="text" class="form-control" id="decriptor" name="decriptor" placeholder="decriptor" value="<?php echo $query['decriptor']; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Status*</label>
			<select class="form-control" id="status" name="status" required="required">
				<option value="">Select</option>
				<option value="Y" <?php if($query['status']=="Y"){?> selected="selected"<?php } ?> >Active</option>
				<option value="N" <?php if($query['status']=="N"){?> selected="selected"<?php } ?> >In-Active</option>
			</select>
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
    </form>
	</div>
</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>  
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		