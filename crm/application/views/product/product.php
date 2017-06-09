<?php $this->load->view('header');?><?php $this->load->view('left');?><!--<script src="<?php echo base_url(); ?>editer/summernote.min.js"></script><link href="<?php echo base_url(); ?>editer/summernote.css" rel="stylesheet">--><div class="mainpanel">                    			<div class="contentpanel contentpanel-mediamanager">                       <?php  if($this->session->userdata('ADMIN_TYPE')=='superadmin' ){ ?>          <div class="clearfix">          		<div class="pull-right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddProductTypeModal"><span class="glyphicon glyphicon-plus"></span> Add New Product </button></div>          </div><br/>            <?php } ?>		<?php if($this->session->flashdata('success') != ''){ ?>        <div class="alert alert-success no-radius no-margin padding-sm" role="alert"><strong><i class="glyphicon glyphicon-ok"></i> Success: </strong><?php echo $this->session->flashdata('success'); ?>        </div>    <?php } ?>		<?php      if($ResultProduct->num_rows() == 0){	   		echo '<div class="alert alert-warning no-radius no-margin padding-sm" role="alert"><strong><i class="fa fa-warning"></i> Warning:</strong> No Records Found For Product Type. Please Add New. </div>';	  } 				 if($ResultProduct->num_rows() > 0){				 ?>			            <div class="table-responsive">                        <table class="table">              <thead>                <tr>                  <th>Type</th>                  <th>Name</th>                  <th>Price</th>                  <th>Period</th>                  <th># of support</th>                  <th>Description</th>                  <?php  if($this->session->userdata('ADMIN_TYPE')=='superadmin' || $this->session->userdata('ADMIN_TYPE')=='teamlead' || $this->session->userdata('ADMIN_TYPE')=='tech' || $this->session->userdata('ADMIN_TYPE')=='quality'){ ?>                  <th>Action</th>                  <?php } ?>                </tr>              </thead>              <tbody>                              <?php foreach ($ResultProduct->result() as $ProductRow){   ?>                 <tr>                  <td><?php						foreach ($result_product_type->result() as $product_type_row)						{							if($ProductRow->productType == $product_type_row->id){								echo $product_type_row->productTypeName;				  			}													}					?></td>                  <td><?php echo $ProductRow->productName; ?></td>                  <td>$<?php echo $ProductRow->productPrice; ?></td>                  <td><?php echo $ProductRow->ProductSupscriptionPeriod; ?> Days</td>                  <td><?php echo $ProductRow->no_of_support; ?></td>                  <td><?php echo $ProductRow->productDescription; ?></td>                  				 <?php  if($this->session->userdata('ADMIN_TYPE')=='superadmin' || $this->session->userdata('ADMIN_TYPE')=='teamlead' || $this->session->userdata('ADMIN_TYPE')=='tech' || $this->session->userdata('ADMIN_TYPE')=='quality'){ ?>				<td rowspan="2">                  <div class="btn-group">                      <!--button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#EditProductTypeModal" id="<?php echo $this->encryption->encode($ProductRow->id); ?>" onclick="abc();"><span class="glyphicon glyphicon-pencil"></span> Edit</button--> 					  					  <a href="<?php echo base_url("");?>product/edit?id=<?php echo $this->encryption->encode($ProductRow->id); ?>"class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span> Edit</a>                      <a href="<?php echo base_url(""); ?>product/product_delete?id=<?php echo $this->encryption->encode($ProductRow->id); ?>" class="btn btn-primary btn-xs" onclick="return confirm('Are you sure you want to delete this item?');"><span class="glyphicon glyphicon-trash"></span> Delete</a>                  	                                      </div>                </td>                <?php } ?>                </tr>                <tr>                  <td colspan="6"><a href="<?php echo str_replace("crm/","",base_url());?>payment.php?product=<?php echo $ProductRow->id; ?>" target="_blank"><?php echo str_replace("crm/","",base_url());?>payment.php?product=<?php echo $ProductRow->id; ?></a></td>                                                   </tr>               <?php } ?>                                </tbody>            </table>                       </div>				<?php echo $links; ?>			    <?php } ?>                                                           			</div>        </div><!-- mainpanel -->    </div><!-- mainwrapper --></section>		<!-- Add Product Type -->        <div class="modal fade" id="AddProductTypeModal" tabindex="-1" role="dialog" aria-labelledby="AddProductTypeModal" aria-hidden="true">          <div class="modal-dialog">            <div class="modal-content">              <div class="modal-header">                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>                <h4 class="modal-title" id="myModalLabel">Add Product</h4>              </div>                             <form role="form" action="<?php echo base_url(); ?>product/add-product" method="POST">               <div class="modal-body">                                    <div class="form-group">                    <label for="exampleInputEmail1">Product type*</label>                    <select name="productType" id="productType" class="form-control" required="required">                    	<option value="">Select product type</option>                        <?php						foreach ($result_product_type->result() as $product_type_row)						{							echo '<option value="'.$this->encryption->encode($product_type_row->id).'">'.$product_type_row->productTypeName.'</option>';						}						?>                    </select>                  </div>                                                      <div class="form-group">                    <label for="exampleInputEmail1">Product name*</label>                    <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" required="required">                  </div>                                    <div class="form-group">                    <label for="exampleInputEmail1">Product price*</label>                    <input type="text" class="form-control" id="productPrice" name="productPrice" placeholder="Enter product price" required="required">                  </div>                                    <div class="form-group">                    <label for="exampleInputEmail1">Product supscription period*</label>                    <input type="number" class="form-control" id="ProductSupscriptionPeriod" name="ProductSupscriptionPeriod" placeholder="Enter supscription period" required="required">                  </div>                                    <div class="form-group">                    <label for="exampleInputEmail1">Product number of support*</label>                    <input type="number" class="form-control" id="number_of_support" name="number_of_support" placeholder="Enter number of support for product" required="required">                  </div>                                    <div class="form-group">                   <label for="exampleInputEmail1">Product description</label>                   <textarea name="productDescription" class="form-control" id="productDescription" placeholder="Enter product description" required="required"></textarea>                  </div>                                </div>              <div class="modal-footer">                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                <button type="submit" class="btn btn-primary">Submit & Save</button>              </div>              </form>                          </div>          </div>        </div>                        <!-- Edit Product Type -->        <div class="modal fade" id="EditProductTypeModal" tabindex="-1" role="dialog" aria-labelledby="EditProductTypeModal" aria-hidden="true" onload="">          <div class="modal-dialog">            <div class="modal-content">              <div class="modal-header">                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>                <h4 class="modal-title" id="myModalLabel">Edit Product</h4>              </div>                             <form role="form" action="<?php echo base_url(); ?>product/update-product" method="POST">               <div class="modal-body">                                  <div id="EditProductArea"></div>                                  </div>              <div class="modal-footer">                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                <button type="submit" class="btn btn-primary">Save changes</button>              </div>              </form>                          </div>          </div>        </div>                <script type="text/javascript">			$("#2").addClass("active");			function abc(){				alert('ok');			}			function EditProduct(id){				//alert('ok');				$.get( 				 "<?php echo base_url(); ?>product/product_edit",				 { id:id },				 function(data) {					$('#EditProductArea').html(data);					editerload(id);				 }			  );			}						$(document).ready(function() {				$('#productDescription').summernote({				  toolbar: [					//[groupname, [button list]]					 					['style', ['bold', 'italic', 'underline', 'clear']],					['font', ['strikethrough']],					['fontsize', ['fontsize']],					['color', ['color']],					['para', ['ul', 'ol', 'paragraph']],					['height', ['height']],				  ]				});			});											</script>        		<?php $this->load->view('footer');?>