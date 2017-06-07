<section id="blue-container-login">
<div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4 margin-30">
           <div style="margin-top:60px;"></div>
           <h1 style="text-align:center">Reset Password</h1>
           <p>&nbsp;</p>
             <div style="background:#fff; padding:20px 20px 20px 20px">
             <!-- content are start -->
             



<div class="center-wrapper ng-scope" data-ng-app="phubapp">
    <div class="center-content ng-scope" data-ng-controller="ShortFormCtrl">
            
                <section class="panel bg-white no-b">                    
                    <div class="p15 text-center">
                        <!-- 
                        <form role="form" name="phubfrm" action="<?php #echo base_url();?>login/resetpassword" method="post" class="ng-pristine ng-invalid ng-invalid-required">
                         -->
                        
<?php echo  form_open('login/resetpassword', array('role'=>"form", 'name'=>"phubfrm", 'method'=>"post", 'class'=>"ng-pristine ng-invalid ng-invalid-required")); ?>                        
                        <input name="merchantFormId" value="" type="hidden">
                        <input class="form-control input-lg mt25 ng-pristine ng-untouched ng-invalid ng-invalid-required" name="user_pass" required="" data-ng-minlength="6" data-ng-maxlength="40" data-ng-model="frm.password" placeholder="Password" type="password">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_pass.$dirty) &amp;&amp; phubfrm.user_pass.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_pass.$dirty) &amp;&amp; phubfrm.user_pass.$error.minlength">
			<li class="parsley-required">Too short</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_pass.$dirty) &amp;&amp; phubfrm.user_pass.$error.maxlength">
			<li class="parsley-required">Too long</li>
		</ul>
                         <input data-match-val="frm.password" name="confirm_pass" class="form-control input-lg mt25 ng-pristine ng-untouched ng-invalid ng-invalid-required" required="" data-ng-model="frm.confirmPassword" placeholder="Confirm Password" type="password">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.confirm_pass.$dirty) &amp;&amp; phubfrm.confirm_pass.$error.matchVal">
			<li class="parsley-required">Passwords don't match</li>
		</ul>
                        <div class="show mt25">
                            <div class="pull-right forgot-link">
                               <!-- <a href="http://localhost/payehub/signup">Not Signed Up?</a>-->
                            </div>
                        </div>
                        <button class="btn btn-block btn-main" type="button" data-ng-click="submit(phubfrm)">Reset</button>                    
<?php echo form_close(); ?>                    
                </div>
            </section>
          </div>
         </div>
      </div>
      
       <!-- content are end -->
             </div>
        </div>
      </div>
    </div>

</section>
           
