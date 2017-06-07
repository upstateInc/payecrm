<div class="phub-modal">
      <div class="phub-modal-shadow">
      </div>
      <div class="phub-modal-window">
      <!--  <p class="phub-modal-msg" id="phub-modal-msg">This is an alert box!</p> -->
        <!--<input class="phub-modal-button" value="OK" type="button"> -->
      </div>
    </div>
    <div data-ng-app="phubapp" class="app ng-scope">
        
<section id="blue-container-login">
<div class="container">
      <div class="row">
      <div class="col-md-2"></div>
        <div class="col-md-8 margin-30">
           <div style="margin-top:60px;"></div>
           <h1 style="text-align:center">Register with us</h1>
           <p>&nbsp;</p>
             <div style="background:#fff; padding:20px 20px 20px 20px">
             <!-- content are start -->
                          
             <!-- inner content wrapper -->
<div class="">
    <div class="row ng-scope" data-ng-controller="ShortFormCtrl">
        <div class="col-xs-12">
            <h5 class="f5_text text-center">Sign up quickly by answering few basic questions.</h5>
            <br>
			<?php if($this->input->get('registeredId')):?>
			<div class="text-center"><?php echo "<font color='#ff0000'>Email already Registered!</font>";?></div>
			<?php endif;?>
			
            <!--  <form role="form" name="phubfrm" action="<?php //echo base_url();?>signup/savebasic" data-ng-class="{'form-submitted':submitted}" novalidate="" method="POST" class="ng-pristine ng-valid-full-name-split ng-invalid ng-invalid-required ng-valid-maxlength ng-valid-mask ng-valid-email ng-valid-minlength"> -->
            <?php echo form_open('signup/savebasic', array('role'=>"form", 'name'=>"phubfrm", 
            		'data-ng-class'=>"{'form-submitted':submitted}", 
            		'novalidate'=>"", 
            		'method'=>"POST", 
            		'class'=>"ng-pristine ng-valid-full-name-split ng-invalid ng-invalid-required ng-valid-maxlength ng-valid-mask ng-valid-email ng-valid-minlength")); ?>
             
                <div class="panel">

                    <div class="panel-body">
                          <div class="row pl10 pr10">

							
							
							   <div class="col-lg-6">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                   <input class="inline_gapping form-control ng-pristine ng-untouched ng-valid-email ng-invalid ng-invalid-required" placeholder="First Name" required="" data-ng-pattern="/^[a-zA-Z ]+$/" data-ng-model="frm.firstName" name="firstName" data-init-from-form="" value="<?php echo $resultarray[0]['name1'];?>" type="text">

							
						
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.firstName.$dirty) &amp;&amp; phubfrm.firstName.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
						
						
						
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.firstName.$dirty) &amp;&amp; phubfrm.firstName.$error.pattern">
			<li class="parsley-required">Name should be valid!</li>
		</ul>
						
					</div>
                </div>
           
<div class="col-lg-6">
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                  <input class="inline_gapping form-control ng-pristine ng-untouched ng-valid-email ng-invalid ng-invalid-required" placeholder="Last Name" required="" data-ng-pattern="/^[a-zA-Z\. ]+$/" data-ng-model="frm.lastName" data-ng-maxlength="40" name="lastName" data-init-from-form="" value="<?php echo $resultarray[0]['name2'];?>" type="text">
                  
                  			
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.lastName.$dirty) &amp;&amp; phubfrm.lastName.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		
		<!--<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.lastName.$dirty) &amp;&amp; phubfrm.lastName.$error.minlength">
			<li class="parsley-required">Minimum length is two!</li>
		</ul> -->
					
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.lastName.$dirty) &amp;&amp; phubfrm.lastName.$error.pattern">
			<li class="parsley-required">Name should be valid!</li>
		</ul>
						
					</div>
                </div>
							
							
                        </div>
                        <div class="row pl10 pr10">
                           <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="primaryCellPhone">Phone</label>
                                    <input class="inline_gapping form-control ng-pristine ng-untouched ng-valid-mask ng-invalid ng-invalid-required" data-ng-model="frm.primaryCellPhone" required="" name="primaryCellPhone" data-ui-mask="(999)-999-9999" value="" data-init-from-form="" placeholder="(___)-___-____" type="text">
                                   <!-- <input name="primaryCellPhone" value="" type="hidden"> -->
                                    <input name="mobileNumber" value="" type="hidden">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.primaryCellPhone.$dirty) &amp;&amp; phubfrm.primaryCellPhone.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input class="inline_gapping form-control ng-pristine ng-untouched ng-valid-email ng-invalid-required" placeholder="abc@domain.com" required="" data-ng-model="frm.email" data-ng-pattern="/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,64}$/" name="email" data-init-from-form="" type="text">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.email.$dirty) &amp;&amp; phubfrm.email.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.email.$dirty) &amp;&amp; phubfrm.email.$error.pattern">
			<li class="parsley-required">Enter valid email</li>
		</ul>
                                </div>
                            </div>
                        </div>
                        <div class="row pl10 pr10">  
                        
<!-------------------->
<div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password">Create a Password</label>
                                    <input class="inline_gapping form-control ng-pristine ng-untouched ng-invalid ng-invalid-required ng-valid-minlength ng-valid-maxlength" name="user_pass" required="" data-ng-minlength="6" data-ng-maxlength="40" data-ng-model="frm.password" placeholder="Password" type="password">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_pass.$dirty) &amp;&amp; phubfrm.user_pass.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_pass.$dirty) &amp;&amp; phubfrm.user_pass.$error.minlength">
			<li class="parsley-required">Too short</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_pass.$dirty) &amp;&amp; phubfrm.user_pass.$error.maxlength">
			<li class="parsley-required">Too long</li>
		</ul>
                                </div>
                            </div>							
                            <div class="col-lg-6"> 
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input data-match-val="frm.password" name="confirm_pass" class="inline_gapping form-control ng-pristine ng-untouched ng-isolate-scope ng-invalid ng-invalid-required" required="" data-ng-model="frm.confirmPassword" placeholder="Password" type="password">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.confirm_pass.$dirty) &amp;&amp; phubfrm.confirm_pass.$error.matchVal">
			<li class="parsley-required">Passwords don't match</li>
		</ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <input class="btn btn-success btn-lg btn-block" data-ng-click="submit(phubfrm)" value="Continue" type="button" />
            <?php echo form_close();?>    				
            <div class="clear"></div>			
                            
                    <!-- /inner content wrapper -->
             
             
             <!-- content are end -->
             </div>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
</section>
</div>