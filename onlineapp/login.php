<?php error_reporting(0);?>
<?php 
     echo base_url();
	 //exit();
	 
	 include('/connect/application/views/header.php');
	 //exit();
?>   


<style>
.navbar-brand img{
  
    height:50px !important;
    width:300% !important;
    margin:-20px 70% 0 -10%;
}

</style>
<script src='https://www.google.com/recaptcha/api.js'></script>
<body class="">

	<?php
$tmp=base_url().'asset/gps1.jpg';


?>
	<!--background:#38c8e0;--><div class="cover" style="background:#000;background-image:url(<?php echo "'".$tmp."'";?>);"></div>


    <div class=""></div>

<div class="center-wrapper ng-scope" data-ng-app="phubapp">
    <div class="center-content ng-scope" data-ng-controller="ShortFormCtrl">
        
            <div class="col-xs-5 col-xs-offset-1 col-sm-2 col-sm-offset-3 col-md-1 col-md-offset-4">
<img src="https://www.payehub.com/img/logo.png" alt="" class="portal-logo">



             <!--<center><a class="navbar-brand" href="index.php"><img src="http://www.payehub.com/img/logo.png" height="200" width="200" alt="Logo"></a>  </center>  <img src="<?php echo base_url();?>asset/atlas-login.png" alt="" class="portal-logo">-->
            </div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <section class="panel bg-white no-b">
                    <ul class="switcher-dash-action">
                        <li class="active" style="background:#fff"><a class="selected">Sign in</a></li>
                        <li><a href="<?php echo base_url();?>login/forgot-password" class="">Forgot Password</a></li>
                    </ul>
                     
                    <div class="p15">
                    
                 
                     <div class="alert-danger">
                     <?php
                      if($this->session->flashdata('wrongcred')) echo $this->session->flashdata('wrongcred');
                     ?></div><br>
                    
                    
                        <form role="form" name="phubfrm" action="<?php echo base_url();?>login/login_check" method="post" class="ng-pristine ng-invalid ng-invalid-required">
                        <input name="merchantFormId" value="" type="hidden">
                        <input name="user_name" data-ng-model="frm.username" required class="form-control input-lg ng-pristine ng-untouched ng-invalid ng-invalid-required" placeholder="Username" autofocus data-init-from-form="" type="email">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_name.$dirty) &amp;&amp; phubfrm.user_name.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_name.$dirty) &amp;&amp; phubfrm.user_name.$error.email">
			<li class="parsley-required">Enter valid email!</li>
		</ul>
		
		
                        <input name="user_pass" data-ng-model="frm.password" required class="form-control input-lg mt25 ng-pristine ng-untouched ng-invalid ng-invalid-required" placeholder="Password" value="" data-init-from-form="" data-ng-minlength="6" data-ng-maxlength="40" type="password">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_pass.$dirty) &amp;&amp; phubfrm.user_pass.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_pass.$dirty) &amp;&amp; phubfrm.user_pass.$error.minlength">
			<li class="parsley-required">Password must be at least six characters long</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.user_pass.$dirty) &amp;&amp; phubfrm.user_pass.$error.maxlength">
			<li class="parsley-required">Too long</li>
		</ul>
		
		
		
		<!--<div class="show mt25">
<div class="g-recaptcha" data-sitekey="6LfCjA8UAAAAAKBr2xhFuwq_1U8EmUw06pPURU8K"></div>
      </div><br>-->
		
		
                        <div class="show mt25">
                            <div class="pull-right forgot-link">
                               Not Registered?  <a href="<?php echo base_url();?>signup"><font color="#7eb63b">Sign Up!</font></a>
                            </div>
                        </div>
                         
       
       
       
                        <button class="btn btn-primary btn-lg btn-block" type="button" data-ng-click="submit(phubfrm)">Sign in</button>
                    </form>
                </div>
            </section>
 
  <script>
$("input").keypress(function(event) {
    if (event.which == 13) {
       
        $("button").click();
    }
});
</script>