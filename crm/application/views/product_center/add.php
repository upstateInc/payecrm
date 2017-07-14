<?php $this->load->view('header');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url(); ?>product-center" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>/insert" enctype="multipart/form-data"> 
		<?php if($this->session->userdata('ADMIN_COMPANYID')==""){?>
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">companyID</label>
			<select name="companyID" class="form-control">
				<option value="">Select Center</option>
				<?php foreach ($companyIDName->result() as $row){?>
					<option value="<?php echo $row->companyID; ?>"><?php echo $row->companyID; ?></option>
				<?php } ?>
			</select>
			</div>
			<?php } ?>
		<div class="form-group">
			<label for="exampleInputEmail1">Product Name</label>
			<input class="form-control" id="productName" name="productName" placeholder="Product Name" value="" required >
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Dosage</label>
			<input class="form-control" id="dosage" name="dosage" placeholder="Dosage" value=""  >
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
			<label for="exampleInputEmail1">SKU Name</label>
			<input class="form-control" id="sku_name" name="sku_name" placeholder="SKU Name" value="" >
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">SKU No</label>
			<input class="form-control" id="sku_number" name="sku_number" placeholder="SKU Number" value="" required >
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Amount</label>
			<input type="number" class="form-control" id="amount" name="amount" placeholder="Amount" value=""  min="0.1" step="0.01" >
		</div>			
		
		<button type="submit" class="btn btn-default">Submit</button>
    </form>
	</div>
</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>  
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		