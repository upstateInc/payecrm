<body class="bg-primary phub-theme">
	<div class="cover" style="background-image: url()"></div>


<style>
.bg-primary {
   color: #515e72 !important; 
   
}

</style>


    <div class=""></div>




    <div class="center-wrapper ng-scope" data-ng-app="phubapp">
        <div class="center-content ng-scope" data-ng-controller="ShortFormCtrl">
                <div class="col-xs-5 col-xs-offset-1 col-sm-2 col-sm-offset-3 col-md-1 col-md-offset-4">
               <!-- <img src="<?php echo base_url();?>asset/portal-logo.png" alt="" class="portal-logo">-->
                </div>
				
				
                <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
				
                    <section class="panel bg-white no-b">
                        <ul class="switcher-dash-action">
                            <li><a href="<?php echo base_url();?>login" class="selected">Sign in</a>
                            </li>
                            <li class="active"><a href="#" class="">Forgot Password</a>
                            </li>
                        </ul>
                        <div class="p15">
                        <div><center><?php if($this->session->flashdata('lostpwd')) echo $this->session->flashdata('lostpwd');?></center></div>
						<div><center><?php if($this->session->flashdata('emailnotfound')) echo "<font color='#ff0000'>Email doesn't exist!</font>";?></center></div>
				
                            <p class="text-center"><font color="#67A2C8">Lost your password? Please enter your email address. You will receive a link to create a new password.

</font></p>
                            <form role="form" name="phubfrm" action="<?php echo base_url();?>login/vemail" method="post" class="ng-pristine ng-valid-email ng-invalid ng-invalid-required">
                                
                                <input name="user_name" class="form-control input-lg ng-pristine ng-untouched ng-valid-email ng-invalid ng-invalid-required" data-ng-model="frm.username" required="" placeholder="Email address" autofocus="" type="email">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_name.$dirty) &amp;&amp; phubfrm.user_name.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_name.$dirty) &amp;&amp; phubfrm.user_name.$error.email">
			<li class="parsley-required">Not a valid email</li>
		</ul>
                                <button class="btn btn-primary btn-lg btn-block mt25" type="button" data-ng-click="submit(phubfrm)">Submit</button>
                            </form>
                        </div>
                    </section>
                   