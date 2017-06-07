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
			<input type="text" class="form-control" id="companyID" name="companyID" placeholder="Center" required="required" value="">
		</div>         
		<div class="form-group">
			<label for="exampleInputEmail1">Gateway*</label>
			<input type="text" class="form-control" id="gatewayName" name="gatewayName" placeholder="Gateway" required="required" value="">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Directory Structure*</label>
			<input type="text" class="form-control" id="directory" name="directory" placeholder="Directory Structure" required="required" value="" >	
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Program Name*</label>
			<input type="text" class="form-control" id="programName" name="programName" placeholder="Program Name" required="required" value="">
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Descriptor*</label>
			<input type="text" class="form-control" id="decriptor" name="decriptor" placeholder="Descriptor" value="">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Status*</label>
			<select class="form-control" id="status" name="status" required="required">
				<option value="">Select</option>
				<option value="Y" >Active</option>
				<option value="N" >In-Active</option>
			</select>
		</div>
      
      
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    
 
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		