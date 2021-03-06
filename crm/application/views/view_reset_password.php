<!DOCTYPE html>
<html>  
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> PayeCRM:forget password</title>

<link rel="icon" href="build/images/favicon.ico" type="image/x-icon" sizes="16x16 32x32 64x64"/>
<link rel="shortcut icon" href="build/images/favicon.png" type="image/x-icon" sizes="16x16 32x32 64x64"/>
   <!-- CSS Global -->
    <link href="<?php echo base_url();?>css-login/bootstrap.min.css" rel="stylesheet">
          <!-- Custom styling plus plugins -->
    <link href="<?php echo base_url();?>css-login/custom.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css-login/home.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css-login/range-slider.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css-login/custom-styles.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>css-login/font-awesome-4.0.3/css/font-awesome.min.css">
    
    

  
    
        <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'></head>
    
  
<head>

<style>
.modal-dialog{z-index: 100000;}
</style>

  <body>
<header>
 <div class="navbar navbar-default" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span></button>
        <a class="navbar-brand" href="https://www.payecrm.com/"><img src="<?php echo base_url();?>images/logo-payecrm.png" class="img-responsive" alt="..."></a>
         <span class="tagline"> Payment Software</span> 
         </div>
      <div class="collapse navbar-collapse navbar-ex1-collapse">          
        <ul class="nav navbar-nav" style="margin-left:10%;">
        <li class="hidden-sm"><a href="https://www.payecrm.com/about.php">About</a></li>
         <li class="hidden-sm"><a href="https://www.payecrm.com/features.php">Features</a></li>
        <li class="hidden-sm"><a href="https://www.payecrm.com/pricing.php">Pricing</a></li>
        <li class="hidden-sm"><a href="https://www.payecrm.com/request-demo.php">Request Demo</a></li>
     </ul>
      <ul class="nav navbar-nav navbar-right">
               <li><a href="https://www.payecrm.com/crm/"><button type="button" class="btn btn-primary"><strong>Sign Up</strong></button></a>  </li>
         </ul>
     </div>
    </div>
  </div> 
  </header>
<div style="clear:both;"></div>

   <!-- Header End -->
<section>
<div class="container">
<div id="wrapper">
      <div class="row">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

      <div id="" class="animate form">
        <section class="login_content">
			<?php if($message)  echo $message; ?>
			<?php if($this->session->flashdata('wrongcred')) echo $this->session->flashdata('wrongcred');?>
			<div>
                <h2 style="font-size:36px;"><img src="<?php echo base_url();?>images/logo.png" alt=""> PayeCRM</h2>

              </div>
              
          <!-- form method="POST" action="<?php //echo base_url()?>home/login">  -->
          
<?php echo form_open('home/reset_password_send', array('method'=>"POST")); ?>
            <h1>Reset password</h1>
            
            <!-- <div>
              <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Old Password" required/>
            </div> -->
            <div>
              <input type="password" id="new_password" name="new_password" class="form-control" placeholder="New Password" required/>
            </div>
            <div>
              <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" required/>
            </div>
            <div style="width:100%;">
			  <input type="submit" name="submit" value="Reset" class="btn btn-default login_submit" />
            </div>
            <div style="width:100%;">
            <a class="login_reset_pass" href="<?php echo base_url()?>home/login">Login</a> &nbsp;&nbsp; Not Registered?&nbsp;<a class="login_reset_pass" href="#">Sign Up!</a>
              
             
            </div>
            <div class="clearfix"></div>
            <input type="hidden" name="user_id" value="<?php echo $user_id;?>" />
<?php echo form_close();?>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
      
  </div>
</div>
</div>  
</section>
	<!-- Footer -->
<div style="clear:both;"></div>

	<!-- Footer -->
<footer>
      <div class="container">
      <div class="row">
       <div class="col-sm-4 copyright">
            Copyright 2017 -<strong> &copy; PayeCRM</strong> &nbsp;&nbsp; |  &nbsp;&nbsp; All Rights Reserved 
        </div>
          <div class="col-sm-7 flink">
           <a href="https://www.payecrm.com/faq.php">Faq's</a> |  
           <a href="https://www.payecrm.com/terms-of-service.php">Terms of Service</a> | 
           <a href="https://www.payecrm.com/privacy-statement.php">Privacy Statement</a> |
           <a href="https://www.payecrm.com/request-demo.php">Request Demo</a> |
           <a href="https://www.payecrm.com/sitemap.php">Sitemap</a> |
           <a href="https://www.payecrm.com/contact-us.php">Contact Us</a>
          </div>
      </div>  
    </div>
    </footer>

    <!-- Copyright -->
     <!-- / .container -->   


    <!-- JavaScript
    ================================================== -->
<!-- JS Global -->
    <script src="build/js/jquery.min.js"></script>
    <script src="build/js/bootstrap.min.js"></script>
    <script src="build/js/range-slider.js"></script>
    
    <!-- JS Plugins -->
    <!--<script src="build/js/scrolltopcontrol.js"></script>-->
    
	<script>
/*    $(function() {
      $('#demo').submit(function(event) {
        var form = $(this);
        $.ajax({
          type: form.attr('method'),
          url: form.attr('action'),
          data: form.serialize()
        }).done(function() {
          // Optionally alert the user of success here...
		  $('#DemoModalDiv').modal('hide');
		  alert('We have received your request and we will get back to you soon');
		  
        }).fail(function() {
          // Optionally alert the user of an error here...
		  alert('error');
        });
        event.preventDefault(); // Prevent the form from submitting via the browser.
      });
    });*/   
    </script>
  </body>
</html>
