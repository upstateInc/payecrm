<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="javascript:void(0);" onclick="location.reload();" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Reload </a></div>
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>update" enctype="multipart/form-data">     
    <input type="hidden" name="id" id="id" value="<?php echo $query['id']; ?>" />   
      <div class="row">
          <div class="col-md-6">
       		<div class="form-group">
              <label for="exampleInputEmail1">Name*</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="required" value="<?php echo $query['name']; ?>">
              </div>
          </div>
		  <div class="col-md-6">
       		<div class="form-group">
              <label for="exampleInputEmail1">Alias Name*</label>
                <input type="text" class="form-control" id="aliasName" name="aliasName" placeholder="Alias Name" required="required" value="<?php echo $query['aliasName']; ?>">
              </div>
          </div>
      </div>
            
	<div class="form-group">
	<label for="exampleInputEmail1">Email address*</label>
	<input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="required" value="<?php echo $query['email']; ?>" >
	
	</div>	
	<div class="form-group">
	<label for="exampleInputEmail1">Profile Image</label>
	<input type="file" class="form-control" id="image" name="image" >
	<?php if($query['image']!=""){?><img src="<?php echo base_url().FLD_PROFILE_IMAGE.'/thumb/'.$query['image'];?>"/><?php } ?>
	</div>	
	<div class="form-group">
	<label for="exampleInputEmail1">Password*</label>
	<input type="password" class="form-control" id="passwd" name="passwd"  required="required" value="<?php echo $this->common_model->base64De(2,$query['passwd']); ?>">
	</div>
      
	<div class="form-group">
	<label for="exampleInputEmail1">Primary Phone number*</label>
	<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number" required="required" value="<?php echo $query['phone']; ?>">
	</div>	

      
	<div class="form-group">
        <label for="exampleInputEmail1">Address</label>
        <textarea name="address" class="form-control" id="address" placeholder="Address"><?php echo $query['address']; ?></textarea>
      </div>
          
      <div class="form-group">
		<label for="exampleInputEmail1">Admin Type*</label>
      	 <select class="form-control" id="type" name="type" required="required">
                <option value="">Select</option>
                
                <option value="quality" <?php if($query['type']=="quality"){?> selected="selected"<?php } ?> >Quality</option>
                <option value="sales" <?php if($query['type']=="sales"){?> selected="selected"<?php } ?> >Sales</option>
				<?php if($this->session->userdata('ADMIN_TYPE')=='superadmin'){?>
                <option value="superadmin" <?php if($query['type']=="superadmin"){?> selected="selected"<?php } ?> >Superadmin</option>
				<?php } ?>
                <option value="teamlead" <?php if($query['type']=="teamlead"){?> selected="selected"<?php } ?> >Team lead</option>
          </select>
      </div>
	  <div <?php if($this->session->userdata('ADMIN_COMPANYID')!=""){ ?> style="display:none;" <?php } ?> >
	  <div class="form-group">
		<label for="exampleInputEmail1">Admin Permission*</label>
      	 <select class="form-control" id="adminPermission" name="adminPermission" required="required" onchange="changePermissionType();">
			<?php if($this->session->userdata('ADMIN_PERMISSION') == "system"){?>
                <option value="system" <?php if($query['adminPermission']=="system"){ echo 'selected'; }?> >System Level</option>
			<?php } if($this->session->userdata('ADMIN_PERMISSION') != "company"){ ?>
                <option value="group" <?php if($query['adminPermission']=="group"){ echo 'selected'; }?> >Group Level</option>
			<?php } ?>
                <option value="company" <?php if($query['adminPermission']=="company"){ echo 'selected'; }?> >Company Lavel</option>
          </select>
      </div>
	  
	  <div class="form-group" id="groupDiv"  <?php if($query['groupId']==""){?> style="display:none;" <?php } ?>>
		<label for="exampleInputEmail1">Group</label>
			<select class="form-control" id="groupId" name="groupId" >
                <option value="">Select</option>
				<?php foreach($groupQuery->result() as $row){?>
					<option <?php if($query['groupId']==$row->id){ echo 'selected'; }?> value="<?php echo $row->id; ?>"><?php echo $row->groupName; ?></option>
				<?php } ?>
			</select>
      </div>	  
	  <div class="form-group" id="companyDiv" <?php if($query['companyID']==""){?> style="display:none;" <?php } ?>>
		<label for="exampleInputEmail1">Company</label>
			<select class="form-control" id="companyID" name="companyID" >
                <option value="">Select</option>
				<?php foreach($centerQuery->result() as $row){?>
					<option <?php if($query['companyID']==$row->companyID){ echo 'selected'; }?> value="<?php echo $row->companyID; ?>"><?php echo $row->company_name; ?></option>
				<?php } ?>
			</select>
      </div>      
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
</script>	
		<?php $this->load->view('footer');?>