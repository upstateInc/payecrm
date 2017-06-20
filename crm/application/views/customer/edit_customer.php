<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
                    
			<div class="contentpanel contentpanel-mediamanager"> 
            
          <div class="clearfix">
          		<div class="pull-right"><a href="<?php echo base_url(); ?>customer/all-customers" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> List all customer</a></div>
          </div><br/>  
	
	
	<?php foreach ($result_customer->result() as $row){ ?>

	<form role="form" action="<?php echo base_url(); ?>customer/update_customer" method="POST">
        
        <input type="hidden" id="customerID" name="customerID" value="<?php echo $this->encryption->encode($row->id); ?>" />
      	<div class="row">
       
          			<div class="form-group">
                    <label for="exampleInputEmail1">Agent name*</label><br/>
                    <select name="agetID" id="agetID" class="width300" required="required">
                        <option value="">Select agent</option>
                        <?php
                        foreach ($result_agent->result() as $result_agent_row)
                        {
                            if($row->agentId == $result_agent_row->id){
							echo '<option value="'.$this->encryption->encode($result_agent_row->id).'" selected>'.$result_agent_row->aliasName.' ('.$result_agent_row->name.')'.'</option>';
							}
							else
							{
							echo '<option value="'.$this->encryption->encode($result_agent_row->id).'" >'.$result_agent_row->aliasName.' ('.$result_agent_row->name.')'.'</option>';
							}
                        }
                        ?>
                    </select>
                    
                    <script>
                        $(document).ready(function() { $("#agetID").select2(); });
                    </script>
        
          
        </div>
      
      
       
    
     <div class="form-group">
      <label for="exampleInputEmail1">First name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required" value="<?php echo $row->name; ?>">
     </div>
     
            
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="required" value="<?php echo $row->email; ?>">
      </div>
      
      <div class="form-group">
        <label for="exampleInputEmail1">Phone number</label>
        <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="Phone number" required="required" value="<?php echo $row->phone; ?>">
      </div>
      
      <div class="form-group">
        <label for="exampleInputEmail1">Address</label>
        <textarea name="address" required="required" class="form-control" id="address" placeholder="Address"><?php echo $row->address; ?></textarea>
      </div>
      
       <div class="row">
          
          <div class="col-md-4">
          		<div class="form-group">
                    <label for="exampleInputEmail1">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="City" required="required" value="<?php echo $row->city; ?>">
                 </div>
          </div>
          
          <div class="col-md-4">
          		 <div class="form-group">
                    <label for="exampleInputEmail1">State</label>
                    <input type="text" class="form-control" id="state" name="state" placeholder="State" required="required" value="<?php echo $row->state; ?>">
                 </div>
          </div>
          
          <div class="col-md-4">
          		 <div class="form-group">
                    <label for="exampleInputEmail1">Zip</label>
                    <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip" required="required" value="<?php echo $row->zip; ?>">
                 </div>
          </div>
          
      </div>
      
     <div class="form-group">
        <label for="exampleInputEmail1">Country</label>
        <input type="text" class="form-control" id="country" name="country" placeholder="Country" required="required" value="<?php echo $row->country; ?>">
     </div>
      
      
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <?php } ?>
 
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>

		
        

        
        <script>
			$("#3").addClass("active");
			function EditProductType(id){
				$.get( 
				 "<?php echo base_url(); ?>product/product_type_edit",
				 { id:id },
				 function(data) {
					$('#EditProductArea').html(data);
				 }
			  );
			}
			agetName
		</script>
        
		<?php $this->load->view('footer');?>