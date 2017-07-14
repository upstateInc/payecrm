<?php $this->load->view('header');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url(); ?>product-center" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>/update" enctype="multipart/form-data">     
    <input type="hidden" name="id" id="id" value="<?php echo $query['id']; ?>" />   
			
			
		<div class="form-group">
			<label for="exampleInputEmail1">Product Name</label>
			<input type="text" class="form-control" id="productName" name="productName" placeholder="Product Name" value="<?php echo $query['productName']; ?>" required >
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Subscription Period</label>
			<input type="number" class="form-control" id="ProductSupscriptionPeriod" name="ProductSupscriptionPeriod" placeholder="Dosage" value="<?php echo $query['ProductSupscriptionPeriod']; ?>"  >
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">No of Support</label>
			<input type="number" class="form-control" id="no_of_support" name="no_of_support" placeholder="No of Support" value="<?php echo $query['no_of_support']; ?>">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Description</label>
			<input class="form-control" id="productDescription" name="productDescription" placeholder="Form" value="<?php echo $query['productDescription']; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Discount</label>
			<input type="number" step="any" class="form-control" id="discount" name="discount" placeholder="Form" value="<?php echo $query['discount']; ?>">
		</div>
				
		<div class="form-group">
			<label for="exampleInputEmail1">SKU Name</label>
			<input type="text" class="form-control" id="sku_name" name="sku_name" placeholder="SKU Name" value="<?php echo $query['sku_name']; ?>">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">SKU No</label>
			<input type="text" class="form-control" id="sku_number" name="sku_number" placeholder="SKU Number" value="<?php echo $query['sku_number']; ?>">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Amount</label>
			<input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Amount" value="<?php echo $query['productPrice']; ?>" required min="0.1" step="0.01" >
		</div>			
		
		

		<button type="submit" class="btn btn-default">Submit</button>
    </form>
	</div>
</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>  
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		