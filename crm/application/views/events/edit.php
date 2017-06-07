<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
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
	<label for="exampleInputEmail1">Alternate Phone number</label>
	<input type="text" class="form-control" id="secondaryPhone" name="secondaryPhone" placeholder="Alternate Phone number" value="<?php echo $query['secondaryPhone']; ?>">
	</div>
      
	<div class="form-group">
        <label for="exampleInputEmail1">Address</label>
        <textarea name="address" class="form-control" id="address" placeholder="Address"><?php echo $query['address']; ?></textarea>
      </div>
          
      <div class="form-group">
		<label for="exampleInputEmail1">Admin Type*</label>
      	 <select class="form-control" id="type" name="type" required="required">
                <option value="">Select</option>
                <option value="admin" <?php if($query['type']=="admin"){?> selected="selected"<?php } ?> >Admin</option>
                <option value="quality" <?php if($query['type']=="quality"){?> selected="selected"<?php } ?> >Quality</option>
                <option value="sales" <?php if($query['type']=="sales"){?> selected="selected"<?php } ?> >Sales</option>
                <option value="superadmin" <?php if($query['type']=="superadmin"){?> selected="selected"<?php } ?> >Superadmin</option>
                <option value="tech" <?php if($query['type']=="tech"){?> selected="selected"<?php } ?> >Tech</option>
          </select>
      </div>
      
      
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    
 
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>
      
		<?php $this->load->view('footer');?>