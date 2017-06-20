<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
                    
			<div class="contentpanel contentpanel-mediamanager"> 
            
          <div class="clearfix">
          		<div class="pull-right"><a href="<?php echo base_url(); ?>customer/all-customers" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> List all customer</a></div>
          </div><br/>  
	
	
	
	<form role="form" action="<?php echo base_url(); ?>customer/insert" method="POST">
      
      	<div class="row">
       
          			<div class="form-group">
                    <label for="exampleInputEmail1">Agent name*</label><br/>
                    <select name="agetID" id="agetID" class="width300" required="required">
                        <option value="">Select agent</option>
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
        
          
        </div>
      
      
       
      <div class="row">
          <div class="col-md-6">
       		<div class="form-group">
              <label for="exampleInputEmail1">First name</label>
                <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="First name" required="required">
              </div>
          </div>
          <div class="col-md-6">
          		 <div class="form-group">
                    <label for="exampleInputEmail1">Last name</label>
                    <input type="text" class="form-control" id="LastName" name="LastName" placeholder="First name" required="required">
                 </div>
          </div>
      </div>
            
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="required">
      </div>
      
      <div class="form-group">
        <label for="exampleInputEmail1">Phone number</label>
        <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="Phone number" required="required">
      </div>
      
      <div class="form-group">
        <label for="exampleInputEmail1">Address</label>
        <textarea name="address" required="required" class="form-control" id="address" placeholder="Address"></textarea>
      </div>
      
       <div class="row">
          
          <div class="col-md-4">
          		<div class="form-group">
                    <label for="exampleInputEmail1">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="City" required="required">
                 </div>
          </div>
          
          <div class="col-md-4">
          		 <div class="form-group">
                    <label for="exampleInputEmail1">State</label>
                    <input type="text" class="form-control" id="state" name="state" placeholder="State" required="required">
                 </div>
          </div>
          
          <div class="col-md-4">
          		 <div class="form-group">
                    <label for="exampleInputEmail1">Zip</label>
                    <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip" required="required">
                 </div>
          </div>
          
      </div>
      
      <div class="form-group">
      	 <select class="form-control" id="country" name="country" required="required">
                <option value="">Select</option>
                <option value="Canada">Canada</option>
                <option value="United States">United States</option>
          </select>
      </div>
      
      
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    
 
            
                                   
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