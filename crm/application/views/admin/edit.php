<?php $this->load->view('header');?>

            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>update" enctype="multipart/form-data">     
		<input type="hidden" name="id" id="id" value="<?php echo $query['id']; ?>" /> 
		<div class="form-group">
			<label for="exampleInputEmail1">First Name*</label>
			<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required="required" value="<?php echo $query['fname']; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Last Name*</label>
			<input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required="required" value="<?php echo $query['lname']; ?>" >
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Alias Name*</label>
			<input type="text" class="form-control" id="alias" name="alias" placeholder="Alias Name" required="required" value="<?php echo $query['alias']; ?>">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Password*</label>
			<input type="password" class="form-control" id="password" name="password" >
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Profile Image</label>
			<input type="file" class="form-control" id="image" name="image" >
			<?php if($query['image']!=""){?><img src="<?php echo base_url().FLD_PROFILE_IMAGE.'/thumb/'.$query['image'];?>"/><?php } ?>
		</div>	
		<div class="form-group">
		<label for="exampleInputEmail1">Phone #</label>
		<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number" value="<?php echo $query['phone']; ?>">
		</div>	
		  
		<div class="form-group">
			<label for="exampleInputEmail1">Address</label>
			<textarea name="address" class="form-control" id="address" placeholder="Address"><?php echo $query['address']; ?></textarea>
		</div>

		<div class="form-group">
		<label for="exampleInputEmail1">City</label>
		<input type="text" class="form-control" id="city" name="city" placeholder="City" <?php echo $query['city']; ?> >
		</div>		
		
		<div class="form-group">
		<label for="exampleInputEmail1">State</label>
		<input type="text" class="form-control" id="state" name="state" placeholder="State" <?php echo $query['state']; ?>>
		</div>		
		
		<div class="form-group">
		<label for="exampleInputEmail1">Country</label>
		<input type="text" class="form-control" id="country" name="country" placeholder="Country" <?php echo $query['country']; ?> >
		</div>		
		
		<div class="form-group">
		<label for="exampleInputEmail1">Zip</label>
		<input type="text" class="form-control" id="zip" name="zip" placeholder="Zip" <?php echo $query['zip']; ?> >
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Admin Type*</label>
				<select class="form-control" id="adminTypeId" name="adminTypeId" required="required">
				<option value="">Select</option>
				<?php 
				$adminTypeId = $this->db->query("select adminTypeId from t_adminAdminType where adminId=".$query['id'])->row()->adminTypeId;				
				if($this->session->userdata('ADMINTYPENAME') == "Super Admin"){
					$getAdminType=$this->db->query("select * from ".ADMINTYPE." where status='Y'");					
				}else{
					$getAdminType=$this->db->query("select * from ".ADMINTYPE." where status='Y' and type!='Super Admin'");
				}
				foreach($getAdminType->result() as $row)
				{ ?>
					<option <?php if($row->id==$adminTypeId){ echo 'selected';} ?> value="<?php echo $row->id;?>"><?php echo $row->type;?></option>
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
				$adminLevelId = $this->db->query("select adminLevelId from  t_adminAdminLevel where adminId=".$query['id'])->row()->adminLevelId;
				$getAdminLevel=$this->db->query("select * from ".ADMINLEVEL." where status='Y'");
				foreach($getAdminLevel->result() as $row)
				{ ?>
					<option <?php if($row->id==$adminLevelId){ echo 'selected';} ?> value="<?php echo $row->id;?>"><?php echo $row->level;?></option>
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
					<?php 
					$merchantId = $this->db->query("select merchantId from t_adminCompany where adminId=".$query['id'])->row()->merchantId;
					foreach($centerQuery->result() as $row){?>
						<option <?php if($row->id==$merchantId){ echo 'selected';} ?> value="<?php echo $row->id; ?>"><?php echo $row->company_name; ?></option>
					<?php } ?>
				</select>
		</div>
 
		<button type="submit" class="btn btn-default">Submit</button>  

      
      
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
		
		
		
		
		
		
		
		
		