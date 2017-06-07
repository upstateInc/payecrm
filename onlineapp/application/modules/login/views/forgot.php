<section id="blue-container-login">
<div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4 margin-30">
           <div style="margin-top:60px;"></div>
           <h1 style="text-align:center">Forget Password</h1>
           <p>&nbsp;</p>
             <div style="background:#fff; padding:20px 20px 20px 20px">
             <!-- content are start -->
             
              <div class="center-wrapper ng-scope" data-ng-app="phubapp">
        	   <div class="center-content ng-scope" data-ng-controller="ShortFormCtrl">
        	      <section class="panel bg-white no-b">
        	      <div class="alert-success"><?php if($this->session->flashdata('lostpwd')) echo $this->session->flashdata('lostpwd');?></div>
						<div class="alert-danger" style="background-color: transparent; text-align: center; font-size: 18px; line-height: 32px;"><?php if($this->session->flashdata('emailnotfound')) echo "Email doesn't exist!";?></div>
        	      		<p class="text-center" style="color: #67A2C8; font-size:13px">Enter your email address. You will receive a link to reset your password.</p>
<?php echo form_open('login/vemail', array('role'=>"form",'name'=>"phubfrm", 'method'=>"post", 'class'=>"ng-pristine ng-valid-email ng-invalid ng-invalid-required")); ?>
		<input name="user_name" class="form-control ng-pristine ng-untouched ng-valid-email ng-invalid ng-invalid-required" data-ng-model="frm.username" required="" placeholder="Email address" autofocus="" type="email">		
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_name.$dirty) &amp;&amp; phubfrm.user_name.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_name.$dirty) &amp;&amp; phubfrm.user_name.$error.email">
			<li class="parsley-required">Not a valid email</li>
		</ul>
		<button class="btn btn-main btn-block mt25" type="button" data-ng-click="submit(phubfrm)">Submit</button>
		<div class="show mt25">
			<div class="pull-right forgot-link">
	        	Not Registered?  <a href="<?php echo base_url();?>signup"><font color="#7eb63b">Sign Up!</font></a>
			</div>
	        <div class="pull-left forgot-link">
	        	<a href="<?php echo base_url();?>login"><font color="#7eb63b">Login</font></a>
			</div>
		</div>                            
<?php echo form_close();?>        	      		
        	      </section>	
        	   </div>
        	  </div>        	
             
             <!-- content are end -->
             </div>
        </div>
      </div>
    </div>

</section>