<?php $this->load->view('header');?>

            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>update" enctype="multipart/form-data">     
		<input type="hidden" name="id" id="id" value="<?php echo $query['id']; ?>" /> 
		<div class="form-group">
			<label for="exampleInputEmail1">Module Name*</label>
			<input type="text" class="form-control" id="module" name="module" placeholder="First Name" required="required" value="<?php echo $query['module']; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Module Parent</label>
			<select class="form-control" id="parent" name="parent" required>
				<option value="0">Root</option>
				<?php
					$getModules=$this->db->query("select id, module from ".MODULE." where status='Y'");
					foreach($getModules->result() as $val){ ?>				
						<option <?php if($query['parent']==$val->id){ echo 'selected'; } ?> value="<?php echo $val->id;?>"><?php echo $val->module;?></option>
					<?php	
					}
				?>
			</select>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Module Weightage</label>
			<input type="text" class="form-control" id="weightage" name="weightage" placeholder="Module Weightage" value="<?php echo $query['weightage']; ?>" required>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Module Link</label>
			<input type="text" class="form-control" id="moduleLink" name="moduleLink" placeholder="Module Link" value="<?php echo $query['moduleLink']; ?>" required>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Module Description</label>
			<input type="text" class="form-control" id="moduleDesc" name="moduleDesc" placeholder="Module Description" value="<?php echo $query['moduleDesc']; ?>" required>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Module Image Class</label>
			<input type="text" class="form-control" id="imageClass" name="imageClass" placeholder="Module Image Class" value="<?php echo $query['imageClass']; ?>" required>
		</div>	

		<div class="form-group">
			<label for="exampleInputEmail1">Status*</label>
			<select class="form-control" id="status" name="status" required="required">
				<option value="">Select</option>
				<option value="Y" <?php if($query['status']=='Y'){ echo 'selected'; } ?> >Active</option>
				<option value="N" <?php if($query['status']=='N'){ echo 'selected'; } ?> >In-Active</option>
			</select>
		</div>
 
		<button type="submit" class="btn btn-default">Submit</button>  
      
    </form> 
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		