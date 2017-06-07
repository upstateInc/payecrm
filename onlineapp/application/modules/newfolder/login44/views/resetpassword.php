<style>
.switcher-dash-action li a {
   
    width: 200% !important;
  
}

</style>
                <section class="panel bg-white no-b">
                    <ul class="switcher-dash-action">
                       <!-- <li class="active" style="background:#fff"><a href="<?php echo base_url();?>login" class="selected">Reset Passsword</a></li> -->
                     <li><a>Reset Passsword</a></li> 
                    </ul>
                    <div class="p15">
                        <form role="form" name="phubfrm" action="<?php echo base_url();?>login/resetpassword" method="post" class="ng-pristine ng-invalid ng-invalid-required">
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

                        <button class="btn btn-primary btn-lg btn-block" type="button" data-ng-click="submit(phubfrm)">Reset</button>
                    </form>
                </div>
            </section>
