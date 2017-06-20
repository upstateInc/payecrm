<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>insert" enctype="multipart/form-data">     
       
      <div class="row">
          <div class="col-md-6">
       		<div class="form-group">
              <label for="exampleInputEmail1">Name*</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required">
              </div>
          </div>
		  <div class="col-md-6">
       		<div class="form-group">
              <label for="exampleInputEmail1">Alias Name*</label>
                <input type="text" class="form-control" id="aliasName" name="aliasName" placeholder="Alias Name" required="required">
              </div>
          </div>
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
	<label for="exampleInputEmail1">Profile Image</label>
	<input type="file" class="form-control" id="image" name="image" >
	</div>	
	<div class="form-group">
	<label for="exampleInputEmail1">Password*</label>
	<input type="password" class="form-control" id="passwd" name="passwd"  required="required">
	</div>
      
	<div class="form-group">
	<label for="exampleInputEmail1">Primary Phone number*</label>
	<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number" required="required">
	</div>	

      
	<div class="form-group">
        <label for="exampleInputEmail1">Address</label>
        <textarea name="address" class="form-control" id="address" placeholder="Address"></textarea>
      </div>
          
      <div class="form-group">
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
				<?php if($this->session->userdata('ADMIN_PERMISSION') == "system"){?>
                <option value="system">System Level</option>
				<?php } if($this->session->userdata('ADMIN_PERMISSION') != "company"){ ?>
                <option value="group">Group Level</option>
				<?php } ?>
                <option value="company" <?php if($this->session->userdata('ADMIN_COMPANYID')!=""){ echo 'selected'; }?> >Company Lavel</option>
          </select>
      </div>	  
	  <div class="form-group" id="groupDiv" style="display:none;">
		<label for="exampleInputEmail1">Group</label>
			<select class="form-control" id="groupId" name="groupId" >
                <option value="">Select</option>
				<?php foreach($groupQuery->result() as $row){?>
					<option value="<?php echo $row->id; ?>"><?php echo $row->groupName; ?></option>
				<?php } ?>
			</select>
      </div>	  
	  <div class="form-group" id="companyDiv" style="display:none;">
		<label for="exampleInputEmail1">Company</label>
			<select class="form-control" id="companyID" name="companyID" >
                <option value="">Select</option>
				<?php foreach($centerQuery->result() as $row){?>
					<option <?php if($this->session->userdata('ADMIN_COMPANYID')!="" && $this->session->userdata('ADMIN_COMPANYID') ==  $row->companyID){ echo 'selected'; }?> value="<?php echo $row->companyID; ?>"><?php echo $row->company_name; ?></option>
				<?php } ?>
			</select>
      </div>
      
      
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    
 
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>
<script type="text/javascript">
	function changePermissionType(){
		var adminPermission = jQuery("#adminPermission").val();
		if(adminPermission == 'group'){
			jQuery("#groupDiv").show();
		}else{
			jQuery("#groupDiv").hide();
			jQuery("#groupId").val('');
		}
		if(adminPermission == 'company'){
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