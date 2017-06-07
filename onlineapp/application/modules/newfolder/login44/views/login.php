
                <section class="panel bg-white no-b">
                    <ul class="switcher-dash-action">
                        <li class="active" style="background:#fff"><a href="<?php echo base_url();?>login" class="selected">Sign in</a></li>
                        <li><a href="<?php echo base_url();?>login/forgot-password" class="">Forgot Password</a></li>
                    </ul>
                    <div class="p15">
                    
                    <span><?php if($this->session->flashdata('wrongcred')) echo $this->session->flashdata('wrongcred');?></span>
                    
                    
                    
                        <form role="form" name="phubfrm" action="<?php echo base_url();?>login/login_check" method="post" class="ng-pristine ng-invalid ng-invalid-required">
                        <input name="merchantFormId" value="" type="hidden">
                        <input name="user_name" data-ng-model="frm.username" required="" class="form-control input-lg ng-pristine ng-untouched ng-invalid ng-invalid-required" placeholder="Username" autofocus="" data-init-from-form="" type="text">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_name.$dirty) &amp;&amp; phubfrm.user_name.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
                        <input name="user_pass" data-ng-model="frm.password" required="" class="form-control input-lg mt25 ng-pristine ng-untouched ng-invalid ng-invalid-required" placeholder="Password" value="" data-init-from-form="" type="password">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_pass.$dirty) &amp;&amp; phubfrm.user_pass.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
                        <div class="show mt25">
                            <div class="pull-right forgot-link">
                                <a href="<?php echo base_url();?>signup">Not Registered? <font color="#7eb63b">Sign Up!</font></a>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-lg btn-block" type="button" data-ng-click="submit(phubfrm)">Sign in</button>
                    </form>
                </div>
            </section>
