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
			<label for="exampleInputEmail1">Validated</label>
			<select class="form-control" id="validated" name="validated" >
				<option value="">Select</option>
				<option value="Y" <?php if($query['validated']=="Y"){?> selected="selected"<?php } ?>>Y</option>
				<option value="N" <?php if($query['validated']=="N"){?> selected="selected"<?php } ?>>N</option>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Rating</label>
			<select class="form-control" id="rating" name="rating" >
				<option value="">Select</option>
				<?php 
				for($i=1;$i<=10;$i++){?>
					<option value="<?php echo $i;?>" <?php if($query['rating']==$i){?> selected="selected"<?php } ?>><?php echo $i;?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Comment</label>
			<textarea class="form-control" id="comment" name="comment" placeholder="Comment"><?php echo $query['comment']; ?></textarea>
		</div>
		<!--div class="form-group">
			<label for="exampleInputEmail1">Status</label>
			<select class="form-control" id="status" name="status" >
				<option value="">Select Status</option>
				<option value="Capture" <?php if($query['status']=="Capture"){?> selected="selected"<?php } ?>>Capture</option>
				<option value="Sale" <?php if($query['status']=="Sale"){?> selected="selected"<?php } ?>>Sale</option>
				<option value="Refund" <?php if($query['status']=="Refund"){?> selected="selected"<?php } ?>>Refund</option>
				<option value="Credit" <?php if($query['status']=="Credit"){?> selected="selected"<?php } ?>>Credit</option>
				<option value="Authorize" <?php if($query['status']=="Authorize"){?> selected="selected"<?php } ?>>Authorize</option>
				<option value="Void" <?php if($query['status']=="Void"){?> selected="selected"<?php } ?>>Void</option>
				<option value="Verify" <?php if($query['status']=="Verify"){?> selected="selected"<?php } ?>>Verify</option>
				<option value="Settlement" <?php if($query['status']=="Settlement"){?> selected="selected"<?php } ?>>Settlement</option>
				<option value="Return" <?php if($query['status']=="Return"){?> selected="selected"<?php } ?>>Return</option>
				<option value="Decrypt" <?php if($query['status']=="Decrypt"){?> selected="selected"<?php } ?>>Decrypt</option>
			</select>
		</div-->

		<button type="submit" class="btn btn-default">Submit</button>
    </form>
	</div>
</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>  
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		