<section class="layout">
<!-- main content -->
	<section class="main-content">
	<!-- content wrapper -->
		<div class="content-wrap">
			<div class="wrapper">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-10 col-md-offset-1">
					
					<h3 class="text-center">PayeHub Online Application Form Details</h3>
					
					<a href="<?php echo base_url() . 'admin/intake_user_list' ?>" class="btn btn-primary btn-xs">Back to list</a>
<!-- Stage 1 -->					
						<fieldset>
						<legend>Business/Onwer Info </legend>
						<h5>General Business Information</h5>					
						<div class="col-lg-6">						
							<div><label>Legal Business Name:</label> <?php echo $business['businessName']; ?></div>
							<div><label>Business Type:</label> <?php echo $business['businessType'];?></div>
							<div><label>Fedaral Tax ID:</label> <?php echo $business['taxId'];?></div>
						</div>						
						<div class="col-lg-6">
							<div><label>Company Trade Name (DBA):</label> <?php echo $business['tradeName'];?></div>
							<div><label>State of Incorporation:</label> <?php echo $business['corpState'];?></div>
							<div><label>Website URL:</label> <?php echo $business['websiteUrl'];?></div>
						</div>
						<div class="panel clearfix"></div>
						
						<h5>Business Address:</h5>					
						<div class="col-lg-8">
							<div><label>Address:</label> <?php echo $business['street'];?></div>
							<div><label>City:</label> <?php echo $business['city'];?></div>
							<div><label>State:</label> <?php echo $business['state'];?></div>
							<div><label>Pincode:</label> <?php echo $business['zip'];?></div>
						</div>						
						<div class="panel clearfix"></div>
						
						<h5>General Owner Info(Owner#1):</h5>					
						<div class="col-lg-6">
							<div><label>First Name:</label> <?php echo $business['ownerFName1'];?></div>
							<div><label>Drivers License or ID#:</label> <?php echo $business['drLicense'];?></div>
							<div><label>Email:</label> <?php echo $business['email'];?></div>
						</div>
						
						<div class="col-lg-6">
							<div><label>Last Name:</label> <?php echo $business['ownerLName1'];?></div>
							<div><label>Work Phone:</label> <?php echo $business['workPhone'];?></div>
						</div>
						<div class="panel clearfix"></div>
						
						<h5>General Owner Info(Owner#2):</h5>					
						<div class="col-lg-6">
							<div><label>First Name:</label> <?php echo $business['ownerFName2'];?></div>
							<div><label>Drivers License or ID#:</label> <?php echo $business[''];?></div>
							<div><label>Email:</label> <?php echo $business['email2'];?></div>
						</div>
						
						<div class="col-lg-6">
							<div><label>Last Name:</label> <?php echo $business['ownerLName2'];?></div>
							<div><label>Work Phone:</label> <?php echo $business['mobPhone'];?></div>
						</div>
						<div class="panel clearfix"></div>						
						</fieldset>
						
<!-- Stage 2 -->
						<fieldset>
						<legend>Billing Information</legend>
						<h5>Designated Administrator</h5>					
						<div class="col-lg-6">						
							<div><label>First Name:</label> <?php echo $billing['name1'];?></div>
							<div><label>Title:</label> <?php echo $billing['title'];?></div>
							<div><label>Email:</label> <?php echo $billing['email'];?></div>
						</div>						
						<div class="col-lg-6">
							<div><label>Last Name:</label> <?php echo $billing['name2'];?></div>
							<div><label>Phone:</label> <?php echo $billing['phone'];?></div>
						</div>
						<div class="panel clearfix"></div>
						
						
						<h5>Bank Account Info :</h5>					
						<div class="col-lg-6">
							<div><label>Banking Institution Name:</label> <?php echo $billing['bankName'];?></div>
							<div><label>Account Number:</label> <?php echo $billing['accountNo'];?></div>
						</div>
						
						<div class="col-lg-6">
							<div><label>Routing Number:</label> <?php echo $billing['routingNo'];?></div>
						</div>
						<div class="panel clearfix"></div>
						</fieldset>
						
<!-- Stage 3 -->
						<fieldset>
						<legend>Documentation</legend>
						<h5>Files:</h5>
						<div class="col-lg-6">
							<div><label>Document File:</label> <?php echo '';?></div>
						</div>
						<div class="panel clearfix"></div>
						</fieldset>
					
					</div>
				</div>
			</div>
	    </div>
    </section>    
</section>