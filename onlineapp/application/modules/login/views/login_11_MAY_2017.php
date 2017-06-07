<?php //error_reporting(0);?>



<script src='https://www.google.com/recaptcha/api.js'></script>
<body class="">

<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand img-responsive" href="index.php"><img src="https://www.payehub.com/img/logo.png" alt="Logo"></a>
        </div>
        <div class="navbar-collapse collapse">
        <p style="color:#FFF; margin-top:13px; margin-bottom:0px; text-align:right;"><i class="fa fa-phone"></i> 518-768-0000</p>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="index.php"><i class="fa fa-home home"></i></a></li>
            <li><a href="about.php">About</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Services<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="web-design.php">Web Design</a></li>
                <li><a href="company-formation.php">Company Formation</a></li>
                <li><a href="business-consulting.php">Business Consulting</a></li>
                <li><a href="software.php">Software</a></li>
                <!--<li><a href="crm.php">CRM</a></li> -->
                <!--<li><a href="pricing.php">Pricing</a></li>-->
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Merchants<b class="caret"></b></a>
              <ul class="dropdown-menu">
                
                <li><a href="high-risk-merchant-account-providers.php">High Risk Merchants</a></li>
                <li><a href="low-risk-merchant-account-providers.php">Low Risk Merchants</a></li>
                <li><a href="ecommerce-merchant-account-providers.php">E-commerce Merchants</a></li>
                <li><a href="international-merchant-account-providers.php">International Merchants</a></li>
                <li><a href="merchant-account-service-provider.php">Merchant Services</a></li>
                <li><a href="retail-merchant-accounts-service-provider.php">Retail Merchants</a></li>
              </ul>
            </li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Payments<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="ach-merchant-account-providers.php">ACH Processing</a></li>
                <li><a href="echeck.php">eCheck</a></li>
                <li><a href="online-credit-card-processing.php">Credit Card Processing</a></li>
                <li><a href="merchant-credit-card-chargeback.php">Chargebacks</a></li>
                <li><a href="controlcb.php">ControlCB</a></li>
                <!--<li><a href="pricing.php">Pricing</a></li>-->
              </ul>
            </li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Industries<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="adult-merchant-account.php">Adult</a></li>
                <li><a href="credit-repair-service-providers.php">Credit Repair</a></li>
                <li><a href="currency-exchange-service-providers.php">Currency Exchange</a></li>
                <li><a href="debt-collection-agency.php">Debt Collection</a></li>
                <li><a href="e-cigarette-merchant-accounts-services.php">E-Cigarette</a></li>
                <li><a href="ecommerce-merchant-account-providers.php">E-commerce</a></li>
                <li><a href="best-online-pharmacy-merchant-accounts.php">Online Pharmacy</a></li>
                <li><a href="prepaid-credit-cards-merchant-account.php">Pre-Paid Credit Cards</a></li>
                <li><a href="subscription.php">Subscription</a></li>
                <li><a href="best-tech-support-merchant-account-providers.php">Tech Support</a></li>
                <li><a href="telemarketing-merchant-account-service.php">Telemarketing</a></li>
                <li><a href="tobacco-merchant-account-service-provider.php">Tobacco</a></li>
                <li><a href="travel-merchant-account-service-provider.php">Travel &amp; Vacation</a></li>
              </ul>
            </li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Contact <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="contact.php">Contact Us</a></li>
                <!--<li><a href="/connect/welcome/getting_started">Getting Started</a></li>-->
                <li><a href="partners.php">Partners</a></li>
              </ul>
            </li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sign Up <b class="caret"></b></a>
              <ul class="dropdown-menu">
              	<!--li><a href="login.php">Login</a></li-->
              	<li><a href="https://www.payehub.com/onlineapp/">Login</a></li>
                <li><a href="https://www.payehub.com/onlineapp/">Register</a></li>
              </ul>
           </li>
              
            <!--<li class="sign-up"><a href="signup.php"><span class="orange"> Sign Up</span></a></li>-->
          </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

<?php
$tmp=base_url().'asset/app-login.jpg';
?>
	<!--background:#38c8e0;-->
	

	<div class="cover" style="background:#000;background-image:url(<?php echo "'".$tmp."'";?>);"></div>


<div class=""></div>

<div class="center-wrapper ng-scope" data-ng-app="phubapp">
    <div class="center-content ng-scope" data-ng-controller="ShortFormCtrl">
        
            <div class="col-xs-5 col-xs-offset-1 col-sm-2 col-sm-offset-3 col-md-1 col-md-offset-4">
<!-- <img src="http://www.payehub.com/img/logo.png" alt="" class="portal-logo"> -->
             <!--<center><a class="navbar-brand" href="index.php"><img src="http://www.payehub.com/img/logo.png" height="200" width="200" alt="Logo"></a>  </center>  <img src="<?php echo base_url();?>asset/atlas-login.png" alt="" class="portal-logo">-->
            </div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <section class="panel bg-white no-b">
                	<!-- 
                    <ul class="switcher-dash-action">
                        <li class="active" style="background:#fff"><a class="selected">Sign in</a></li>
                        <li><a href="<?php //echo base_url();?>login/forgot-password" class="">Forgot Password</a></li>
                    </ul>
                     -->
                     
                    <div class="p15">
                    
                    <div style="text-align: center; margin-bottom:-10px;">
                    <img src="<?php echo base_url(); ?>asset/noimage.gif" style="height:100px; weight:100px; "/>
                    <h3>Login</h3>
                    </div>
                    
                 
                     <div class="alert-danger">
                     <?php
                      if($this->session->flashdata('wrongcred')) echo $this->session->flashdata('wrongcred');
                     ?></div><br>
                    
                    
                        <!-- <form role="form" name="phubfrm" action="<?php //echo base_url();?>login/login_check" method="post" class="ng-pristine ng-invalid ng-invalid-required">  -->
                        
                        <?php echo form_open('login/login_check', array('role'=>"form", 'name'=>"phubfrm", 'method'=>"post", 'class'=>"ng-pristine ng-invalid ng-invalid-required") ); ?>
                        
                        <input name="merchantFormId" value="" type="hidden">
                        <input name="user_name" data-ng-model="frm.username" required="" class="form-control ng-pristine ng-untouched ng-invalid ng-invalid-required" placeholder="Username" autofocus="" data-init-from-form="" type="email">
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
		
		
		
		<!--<div class="show mt15">
<div class="g-recaptcha" data-sitekey="6LfCjA8UAAAAAKBr2xhFuwq_1U8EmUw06pPURU8K"></div>
      </div><br>-->
		
                         
                         <div class="show mt15">
                         </div>

       
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
 
  <script>
$("input").keypress(function(event) {
    if (event.which == 13) {
       
        $("button").click();
    }
});
</script>