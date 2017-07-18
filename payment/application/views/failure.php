<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from themearmada.com/demos/sharkfin/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Jun 2015 08:15:09 GMT -->
<head>
  <meta charset="utf-8">

 	<!--<link rel="stylesheet" href="css/bootstrap.min.css">-->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">

<style>
 .table td, th{ border:none !important; padding:4px 8px !important;}
 #radial-center {
	background-color: #bfb3d6;
	background-image: url(images/radial_bg.png);
	background-position: center center;
	background-repeat: no-repeat;
	background: -webkit-gradient(radial, center center, 0, center center, 460, from(#f7f5f6), to(#bfb3d6));
	background: -webkit-radial-gradient(circle, #ffffff, #bfb3d6);
	background: -moz-radial-gradient(circle, #ffffff, #bfb3d6);
	background: -ms-radial-gradient(circle, #ffffff, #bfb3d6);
}
</style> 
</head>
  <body style="background:#ffffe6;">
    <section>
      <div class="container tec">
         <div class="col-md-2">&nbsp;</div>
         
            <div class="col-md-8">
            <fieldset id="radial-center" style="border: 1px solid #c0c0c0 !important; margin: 0; padding: 0 24px;">
           <p>&nbsp;</p>
           <p>&nbsp;</p>
           <p style="font-size:35px; font-weight:bold; text-align:center; color:#e40d45;">Payment Failed</p>
           <p style="font-size:20px; font-weight:bold; text-align:center;">We're unable to process your payment right now. Please try again later.</p>
           <p style="font-size:30px; font-weight:bold; text-align:center; color:#e0084a;">Error Code: <?php echo $this->session->userdata('response_code');?></p>
           <p style="font-size:30px; font-weight:bold; text-align:center; color:#e0084a;">Error Message: <?php echo $this->session->userdata('responsetext');?></p>
           <p>&nbsp;</p>
           <p>&nbsp;</p>
		   	<script type="text/javascript">
		var count = 10;
		//var redirect = "<?php echo $base_url; ?>payment.php?product=<?php echo @$_SESSION['RefProductID']; ?>";
		var redirect = "payment";
		 
		function countDown(){
			var timer = document.getElementById("timer");
			if(count > 0){
				count--;
				timer.innerHTML = "You're going back to payment page in "+count+" seconds.";
				setTimeout("countDown()", 1000);
			}else{
				window.location.href = redirect;
			}
		}
	</script> 
           <p style="text-align:center;"><h3 style="text-align:center;"> <span id="timer"><script type="text/javascript">countDown();</script></span></h3></p>
        
        <!--<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>-->
            </fieldset>
        </div>
         
         <div class="col-md-2">&nbsp;</div>
      </div>
    </section>
    
    
    
    
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

  </body>
</html>
 
 
 
  
     
