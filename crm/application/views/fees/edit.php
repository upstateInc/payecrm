<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>update" enctype="multipart/form-data">     
    <input type="hidden" name="id" id="id" value="<?php echo $query['id']; ?>" />   
      	<div class="form-group">
			<label for="exampleInputEmail1">Fees Type*</label>
			<input type="text" class="form-control" id="fees_type" name="fees_type" placeholder="Fees Type" required="required" value="<?php echo $query['fees_type'];?>">
		</div>         
		<div class="form-group">
			<label for="exampleInputEmail1">Fee*</label>
			<input type="text" class="form-control" id="fee" name="fee" placeholder="Fee" required="required" value="<?php echo $query['fee'];?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Fee Type*</label>
			<select class="form-control" id="fee_type" name="fee_type" required="required">
				<option value="">Select</option>
				<option <?php if($query['fee_type']=="$"){?> selected="selected"<?php } ?> value="$" >$</option>
				<option <?php if($query['fee_type']=="%"){?> selected="selected"<?php } ?> value="%" >%</option>
			</select>
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