<?php $this->load->view('header');?>
<?php $this->load->view('left');?>

<div class="mainpanel">
                    
			<div class="contentpanel contentpanel-mediamanager"> 
            
          <div class="clearfix">
          		<div class="pull-right"><a href="<?php echo base_url(); ?>customer/add-customer" class="btn btn-primary" ><span class="glyphicon glyphicon-plus"></span> Add New Customer</a></div>
          </div><br/>  
	
	<?php if($this->session->flashdata('success') != ''){ ?>
        <div class="alert alert-success no-radius no-margin padding-sm" role="alert"><strong><i class="glyphicon glyphicon-ok"></i> Success: </strong><?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
	
	<?php
      if($ResultCustomer->num_rows() == 0){
	   		echo '<div class="alert alert-warning no-radius no-margin padding-sm" role="alert"><strong><i class="fa fa-warning"></i> Warning:</strong> No Records Found For Product Type. Please Add New. </div>';
	  } 
		
		 if($ResultCustomer->num_rows() > 0){
			
	 ?>
     
     
     <form class="form-inline well" role="form" method="POST" action="">
          
          <div class="form-group">
            <label class="sr-only" for="exampleInputEmail2">Customer PIN</label>
            <input type="text" class="form-control" id="CustomerPin" name="CustomerPin" placeholder="Search by Customer ID" value="<?php echo $CustomerPin;?>">
          </div>
          
          
           <div class="form-group">
            <label class="sr-only" for="exampleInputEmail2">Customer Phone</label>
            <input type="text" class="form-control" id="CustomerPhone" name="CustomerPhone" placeholder="Search by phone" value="<?php echo $CustomerPhone;?>">
          </div>
          
           <div class="form-group">
            <label class="sr-only" for="exampleInputEmail2">Customer Name</label>
            <input type="text" class="form-control" id="CustomerName" name="CustomerName" placeholder="Search by Customer Name" value="<?php echo $CustomerName;?>">
          </div> 
          
          <div class="form-group">
            <label class="sr-only" for="exampleInputEmail2">Customer Email</label>
            <input type="text" class="form-control" id="CustomerEmail" name="CustomerEmail" placeholder="Search by email" value="<?php echo $CustomerEmail;?>">
          </div>
 		        
          
          <?php  if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ ?>
          
          
          
          <!--div class="form-group">
          <select name="agetID" id="agetID" class="width200" >
            <option value="">Search by agent name</option>
            <?php
            foreach ($result_agent->result() as $result_agent_row)
            {
                echo '<option value="'.$this->encryption->encode($result_agent_row->id).'">'.$result_agent_row->aliasName.' ('.$result_agent_row->name.')'.'</option>';
            }
            ?>
            </select>
            
            <script>
                $(document).ready(function() { $("#agetID").select2(); });
            </script>
            </div--> 
       <?php } ?>
         
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
	  <a href="<?php echo base_url().$this->viewfolder;?>/all-customers" >View All</a>
    </form>
	
	
 	<br/>

			
            <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
                  <th>Registered By</th>
                  <?php  if($this->session->userdata('ADMIN_TYPE')!='teamlead'){ ?>
                  <th>Customer ID</th>
                  <?php } ?>
                  <th>Name</th>
                  <?php  if($this->session->userdata('ADMIN_TYPE')!='teamlead'){ ?>
                  <th>Email</th>
                  <th>Phone</th>
                  <?php } ?>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                
              <?php foreach ($ResultCustomer->result() as $CustomerRow){   ?> 
                <tr>
                  <td>
                  <?php
						foreach ($result_agent->result() as $agent_row)
						{
							if($agent_row->id == $CustomerRow->agentId){
								echo $agent_row->name;
				  			}
							
						}
					?>
                  </td>
                  
                  <?php  if($this->session->userdata('ADMIN_TYPE')!='teamlead'){ ?>
                  <td><?php echo $CustomerRow->pin; ?> </td>
                  <?php } ?>
                  
                  <td style=" text-transform:capitalize"><?php echo $CustomerRow->name; ?> </td>
                  
                  <?php  if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ ?>
                  <td><?php echo $CustomerRow->email; ?></td>
                  <?php } ?>
                  
                  <?php  if($this->session->userdata('ADMIN_TYPE')=='tech'){ ?>
                  <td><a href="javascript:;" id="email_<?php echo $this->encryption->encode($CustomerRow->id); ?>" onclick="ShowEmail(this.id,'<?php echo $this->encryption->encode($CustomerRow->id); ?>');">******@*****.com</a></td>
                  <?php } ?>
                  
                 
                  
                  <?php  if($this->session->userdata('ADMIN_TYPE')=='tech'){ ?>
                  <td><a href="javascript:;" id="phn_<?php echo $this->encryption->encode($CustomerRow->id); ?>" onclick="ShowPhone(this.id,'<?php echo $this->encryption->encode($CustomerRow->id); ?>');">*****<?php echo substr($CustomerRow->phone, -5); ?></a> </td>
                  <?php } ?>
                  
                  <?php  if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ ?>
                  <td><a href="javascript:;" ><?php echo $CustomerRow->phone; ?></a> </td>
                  <?php } ?>
                  
                  
                  
                  
                  <td>
                  <div class="btn-group">
                      <a href="<?php echo base_url(""); ?>customer/customer-details?id=<?php echo $this->encryption->encode($CustomerRow->id); ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-align-justify"></span> Details</a>
                      
					  <?php  if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ ?>
                      <a href="<?php echo base_url(""); ?>customer/customer_edit?id=<?php echo $this->encryption->encode($CustomerRow->id); ?>" class="btn btn-primary btn-xs"> <span class="glyphicon glyphicon-pencil"></span> Edit</a>
                      <a href="<?php echo base_url(""); ?>customer/customer_delete?id=<?php echo $this->encryption->encode($CustomerRow->id); ?>" class="btn btn-primary btn-xs" onclick="return confirm('Are you sure you want to delete this item?');"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                      <?php } ?> 
                       
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

		
        
        <script>
			$("#3").addClass("active");
			
			
			  function ShowPhone(DivId,id){
				//alert(DivId);
				  $.post( 
					 "<?php echo base_url(); ?>customer/get_phone",
					 { id: id },
					 function(data) {
						 //alert(data);
						//$(DivId).html(data);
						//document.getElementById(DivId).innerHTML(data);
						document.getElementById(DivId).textContent = data;
					 }
		
				  );
			  }
			  
			  function ShowEmail(DivId,id){
				//alert(DivId);
				  $.post( 
					 "<?php echo base_url(); ?>customer/get_email",
					 { id: id },
					 function(data) {
						 //alert(data);
						//$(DivId).html(data);
						//document.getElementById(DivId).innerHTML(data);
						document.getElementById(DivId).textContent = data;
					 }
		
				  );
			  }
			 
		 
			
			
		</script>
        
		<?php $this->load->view('footer');?>