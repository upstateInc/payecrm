<?php $this->load->view('header');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url(); ?>product" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url();?>product/insert" enctype="multipart/form-data">     
    

		<div class="form-group">
			
            <select name="category" id="category" class="form-control" required>
            <option value="">Select Category</option>	
			<?php foreach($resultCategory->result() as $val){?>
				 <option <?php if($category==$val->id){ ?> selected <?php } ?>value="<?php echo $val->id;?>"><?php echo $val->name;?></option>
			<?php } ?>
            </select>
        </div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Brand Name</label>
			<input class="form-control" id="brandName" name="brandName" placeholder="Brand Name" value="" required >
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Generic Name</label>
			<input class="form-control" id="genericName" name="genericName" placeholder="Brand Name" value="" required >
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Dosage</label>
			<input class="form-control" id="dosage" name="dosage" placeholder="Dosage" value="" required >
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Pack</label>
			<input class="form-control" id="pack" name="pack" placeholder="Pack" value="">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Form</label>
			<input class="form-control" id="form" name="form" placeholder="Form" value="">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Cost</label>
			<input type="number" class="form-control" id="cost" name="cost" placeholder="Cost" value="" required min="0.1" step="0.01" >
		</div>			
		<div class="form-group">
			<label for="exampleInputEmail1">Manufacturer</label>
			<input class="form-control" id="manufacturer" name="manufacturer" placeholder="Manufacturer" value="">
		</div>		
		<button type="submit" class="btn btn-default">Submit</button>
    </form>
	</div>
</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>  
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		