<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
                    
			<div class="contentpanel contentpanel-mediamanager"> 
            
          <div class="clearfix">
          		<div class="pull-right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddProductTypeModal"><span class="glyphicon glyphicon-plus"></span> Add New Product Type</button></div>
          </div><br/>  
	
	<?php if($this->session->flashdata('success') != ''){ ?>
        <div class="alert alert-success no-radius no-margin padding-sm" role="alert"><strong><i class="glyphicon glyphicon-ok"></i> Success: </strong><?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
	
	<?php
      if($ResultProductType->num_rows() == 0){
	   		echo '<div class="alert alert-warning no-radius no-margin padding-sm" role="alert"><strong><i class="fa fa-warning"></i> Warning:</strong> No Records Found For Product Type. Please Add New. </div>';
	  } 
		
		 if($ResultProductType->num_rows() > 0){
			
	 ?>
			
            <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
                  <th>Product type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                
              <?php foreach ($ResultProductType->result() as $ProductTypeRow){   ?> 
                <tr>
                  <td><?php echo $ProductTypeRow->productTypeName; ?> <?php if($ProductTypeRow->productTypeDescription != '') { echo ' - '.$ProductTypeRow->productTypeDescription; } ?></td>
                  <td>
                  <div class="btn-group">
                      <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#EditProductTypeModal" id="<?php echo $this->encryption->encode($ProductTypeRow->id); ?>" onclick="EditProductType(this.id);"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
                      <a href="<?php echo base_url(""); ?>product/product_type_delete?id=<?php echo $this->encryption->encode($ProductTypeRow->id); ?>" class="btn btn-primary btn-xs" onclick="return confirm('Are you sure you want to delete this item?');"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                   </div>
                  </td>
                </tr>
               <?php } ?>  
                
              </tbody>
            </table>
           
            </div>
		
		<?php echo $links; ?>			
    <?php } ?>
            
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>

		<!-- Add Product Type -->
        <div class="modal fade" id="AddProductTypeModal" tabindex="-1" role="dialog" aria-labelledby="AddProductTypeModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Product Type</h4>
              </div>
              
               <form role="form" action="<?php echo base_url(); ?>product/add-product-type" method="POST">
               <div class="modal-body">
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product type*</label>
                    <input type="text" class="form-control" id="product_type" name="product_type" placeholder="Enter product type" required="required">
                  </div>
                  
                 <div class="form-group">
                   <label for="exampleInputEmail1">Product type description</label>
                   <textarea name="product_type_description" class="form-control" id="product_type_description" placeholder="Enter product type description"></textarea>
                  </div>
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
              </form>
              
            </div>
          </div>
        </div>
        
        
        <!-- Edit Product Type -->
        <div class="modal fade" id="EditProductTypeModal" tabindex="-1" role="dialog" aria-labelledby="EditProductTypeModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Product Type</h4>
              </div>
              
               <form role="form" action="<?php echo base_url(); ?>product/update-product-type" method="POST">
               <div class="modal-body">
                  
                <div id="EditProductArea"></div>  
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
              </form>
              
            </div>
          </div>
        </div>

        
        <script>
			$("#2").addClass("active");
			function EditProductType(id){
				$.get( 
				 "<?php echo base_url(); ?>product/product_type_edit",
				 { id:id },
				 function(data) {
					$('#EditProductArea').html(data);
				 }
			  );
			}
			
		</script>
        
		<?php $this->load->view('footer');?>