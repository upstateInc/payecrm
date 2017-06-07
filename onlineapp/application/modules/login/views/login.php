<section id="blue-container-login">
<div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4 margin-30">
           <div style="margin-top:60px;"></div>
           <h1 style="text-align:center">Login</h1>
           <p>&nbsp;</p>
             <div style="background:#fff; padding:20px 20px 20px 20px">
             <!-- content are start -->
             
             <div class="center-wrapper ng-scope" data-ng-app="phubapp">
    			<div class="center-content ng-scope" data-ng-controller="ShortFormCtrl">
    				<section class="panel bg-white no-b">
    					 <div class="p15 text-center">
                    		<img src="<?php echo base_url(); ?>asset/noimage.gif" style="height:100px; weight:100px; "/>
                    		 
                    		 <div class="alert-danger">
		                     <?php
		                      if($this->session->flashdata('wrongcred')) echo $this->session->flashdata('wrongcred');
		                     ?>
		                     </div>
		                     <br />
                                         	                    	
<?php echo form_open('login/login_check', array('role'=>"form", 'name'=>"phubfrm", 'method'=>"post", 'class'=>"ng-pristine ng-invalid ng-invalid-required") ); ?>
                    	
                        <input name="merchantFormId" value="" type="hidden">
                        <input name="user_name" data-ng-model="frm.username" required="" class="form-control ng-pristine ng-untouched ng-invalid ng-invalid-required" placeholder="Username" autofocus="" data-init-from-form="" type="email"/>
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_name.$dirty) &amp;&amp; phubfrm.user_name.$error.required">
							<li class="parsley-required">This field is required!</li>
						</ul>
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_name.$dirty) &amp;&amp; phubfrm.user_name.$error.email">
							<li class="parsley-required">Enter valid email!</li>
						</ul>		
		
				       <input name="user_pass" data-ng-model="frm.password" required="" class="form-control mt15 ng-pristine ng-untouched ng-invalid ng-invalid-required" placeholder="Password" value="" data-init-from-form="" data-ng-minlength="6" data-ng-maxlength="40" type="password">
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_pass.$dirty) &amp;&amp; phubfrm.user_pass.$error.required">
							<li class="parsley-required">This field is required!</li>
						</ul>
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_pass.$dirty) &amp;&amp; phubfrm.user_pass.$error.minlength">
							<li class="parsley-required">Password must be at least six characters long</li>
						</ul>
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_pass.$dirty) &amp;&amp; phubfrm.user_pass.$error.maxlength">
							<li class="parsley-required">Too long</li>
						</ul>
						   <div class="show mt15"></div>
       
                        <button class="btn btn-block btn-main" type="button" data-ng-click="submit(phubfrm)">Sign in</button>
                        
                        <div class="show mt15">
                            <div class="pull-right forgot-link">
                               Not Registered?  <a href="<?php echo base_url();?>signup"><font color="#7eb63b">Sign Up!</font></a>
                            </div>
                            <div class="pull-left forgot-link">
                                <a href="<?php echo base_url();?>login/forgot-password"><font color="#7eb63b">Forgot Password</font></a>
                            </div>
                        </div>                    
<?php echo form_close(); ?>
					</div>
    				</section>
    			</div>
    		 </div>	
             
             
             <!-- content are end -->
             </div>
        </div>
      </div>
    </div>

</section>