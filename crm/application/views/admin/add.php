<?php $this->load->view('header');?>

            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>insert" enctype="multipart/form-data">     
		<div class="form-group">
			<label for="exampleInputEmail1">First Name*</label>
			<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required="required">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Last Name*</label>
			<input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required="required">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Alias Name*</label>
			<input type="text" class="form-control" id="alias" name="alias" placeholder="Alias Name" required="required">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Email address*</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="required" onblur="email_check(this.value);" onkeypress="email_check(this.value);">
			<div class="alert alert-danger alert-error" id="emailreg" style="display:none;">
				<a href="#" class="close" data-dismiss="alert">&times;</a>
				<strong>Error!</strong> Email Already Exists.
			</div>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Password*</label>
			<input type="password" class="form-control" id="password" name="password"  required="required">
		</div>		
	
		<div class="form-group">
		<label for="exampleInputEmail1">Phone #</label>
		<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number" >
		</div>	
		  
		<div class="form-group">
			<label for="exampleInputEmail1">Address</label>
			<textarea name="address" class="form-control" id="address" placeholder="Address"></textarea>
		</div>

		<div class="form-group">
		<label for="exampleInputEmail1">City</label>
		<input type="text" class="form-control" id="city" name="city" placeholder="City" >
		</div>		
		
		<div class="form-group">
		<label for="exampleInputEmail1">State</label>
		<input type="text" class="form-control" id="state" name="state" placeholder="State" >
		</div>		
		
		<div class="form-group">
		<label for="exampleInputEmail1">Country</label>
		<input type="text" class="form-control" id="country" name="country" placeholder="Country" >
		</div>		
		
		<div class="form-group">
		<label for="exampleInputEmail1">Zip</label>
		<input type="text" class="form-control" id="zip" name="zip" placeholder="Zip" >
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Admin Type*</label>
				<select class="form-control" id="adminTypeId" name="adminTypeId" required="required">
				<option value="">Select</option>
				<?php 
				if($this->session->userdata('ADMINTYPENAME') == "Super Admin"){
					$getAdminType=$this->db->query("select * from ".ADMINTYPE." where status='Y'");					
				}else{
					$getAdminType=$this->db->query("select * from ".ADMINTYPE." where status='Y' and type!='Super Admin'");
				}
				foreach($getAdminType->result() as $row)
				{ ?>
					<option value="<?php echo $row->id;?>"><?php echo $row->type;?></option>
				<?php 
				}				
				?>
				</select>
		</div>
		
		<?php
		if($this->session->userdata('ADMINLEVELNAME') == "System"){	?>	
		<div class="form-group">
			<label for="exampleInputEmail1">Admin Level*</label>
				<select class="form-control" id="adminLevelId" name="adminLevelId" required="required" onchange="changePermissionType();">	
				<option value="">Select</option>
				<?php 
				$getAdminLevel=$this->db->query("select * from ".ADMINLEVEL." where status='Y'");
				foreach($getAdminLevel->result() as $row)
				{ ?>
					<option value="<?php echo $row->id;?>"><?php echo $row->level;?></option>
				<?php 
				}				
				?>
				</select>
		</div>
		<?php } ?>
	

		<div class="form-group" id="companyDiv" style="display:none;">
			<label for="exampleInputEmail1">Company</label>
				<select class="form-control" id="merchantId" name="merchantId" >
					<option value="">Select</option>
					<?php foreach($centerQuery->result() as $row){?>
						<!--option <?php if($this->session->userdata('ADMIN_COMPANYID')!="" && $this->session->userdata('ADMIN_COMPANYID') ==  $row->companyID){ echo 'selected'; }?> value="<?php echo $row->companyID; ?>"><?php echo $row->company_name; ?></option-->
						<option  value="<?php echo $row->id; ?>"><?php echo $row->company_name; ?></option>
					<?php } ?>
				</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Profile Image</label>
			<input type="file" class="form-control" id="image" name="image" >
		</div>  
		<button type="submit" class="btn btn-default">Submit</button>  
		  <!--div class="form-group">
			<label for="exampleInputEmail1">Admin Type*</label>
			 <select class="form-control" id="type" name="type" required="required">
					<option value="">Select</option>
					<option value="quality">Quality</option>
					<option value="sales">Sales</option>
					<?php if($this->session->userdata('ADMIN_TYPE')=='superadmin'){?>
					<option value="superadmin">Superadmin</option>
					<?php } ?>
					<option value="teamlead">Team Lead</option>
			  </select>
		  </div>
			
		  <div class="form-group" <?php if($this->session->userdata('ADMIN_COMPANYID')!=""){ ?> style="display:none;" <?php } ?>>
			<label for="exampleInputEmail1">Admin Permission*</label>
			 <select class="form-control" id="adminPermission" name="adminPermission" required="required" onchange="changePermissionType();">
					<option value="">Select</option>
					<?php if($this->session->userdata('ADMIN_PERMISSION') != "company"){ ?>
					<option value="group">Affiliate</option>
					<?php } ?>
					<option value="company"  <?php if($this->session->userdata('ADMIN_COMPANYID')!=""){ echo 'selected'; } ?> >Company </option>
					<?php if($this->session->userdata('ADMIN_PERMISSION') != "company"){ ?>
					<option value="nominee">Nominee</option>
					<?php } ?>
					<?php if($this->session->userdata('ADMIN_PERMISSION') == "system"){?>
					<option value="system">System</option>
					<?php } ?>
			  </select>
		  </div>	  

		  <div class="form-group" id="groupCommissionDiv"  style="display:none;" >
			<label for="exampleInputEmail1">Commission %</label>
				<input type="text" class="form-control" id="commission" name="commission" value="" />                
			</div-->
      
      
    </form>
    
 
            
                                   

    
<script type="text/javascript">
	function changePermissionType(){
		var adminPermission = jQuery("#adminLevelId").val();
		//alert(adminPermission);
		if(adminPermission == '3' ){
			jQuery("#groupDiv").show();
			jQuery("#groupCommissionDiv").show();
		}
		else if(adminPermission == '4' )
		{
			jQuery("#nomineeDiv").show();
			jQuery("#groupCommissionDiv").show();			
		}
		else{
			jQuery("#groupDiv").hide();
			jQuery("#nomineeDiv").hide();
			jQuery("#groupCommissionDiv").hide();
			jQuery("#groupId").val('');
		}
		if(adminPermission == '2'){
			jQuery("#companyDiv").show();
		}else{
			jQuery("#companyDiv").hide();
			jQuery("#companyID").val('');
		}
		//alert(adminPermission);
	}
	function email_check(email)
	{
		if(email!="")
		{
			$.post('<?php echo base_url();?>super-admin-user/email_check', 'email='+email, function(data){
				//alert(data);
				if(data>0){
					$("#emailreg").show("slow");
					$("#email_err").val("1");
					return false;
					}
				else {
					$("#email_err").val("0");
					}
			});  
		}
		else
		{
			$("#email_err").val("0");
		}
	}
</script> 
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		