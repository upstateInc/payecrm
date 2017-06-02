<?php
	error_reporting(0);
	session_start();
    
    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
		if(isset($_POST['pageAction'])){
			$recaptcha_secret="6LdqJSAUAAAAAMXYSOeMoFnF6dhqQWkdZvy6irjt";
			$url = "https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response'];
			$ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
			$tmp= curl_exec($ch);
			$contents=json_decode($tmp);
			if (!$contents->success)
			{
				$_SESSION['errorMessage']="Captcha is not verified!";		 
			}
			else
			{


			function formatPhoneNumber($phoneNumber) {
				$phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);

				if(strlen($phoneNumber) > 10) {
					$countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
					$areaCode = substr($phoneNumber, -10, 3);
					$nextThree = substr($phoneNumber, -7, 3);
					$lastFour = substr($phoneNumber, -4, 4);

					$phoneNumber = '+'.$countryCode.' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
				}
				else if(strlen($phoneNumber) == 10) {
					$areaCode = substr($phoneNumber, 0, 3);
					$nextThree = substr($phoneNumber, 3, 3);
					$lastFour = substr($phoneNumber, 6, 4);

					$phoneNumber = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
				}
				else if(strlen($phoneNumber) == 7) {
					$nextThree = substr($phoneNumber, 0, 3);
					$lastFour = substr($phoneNumber, 3, 4);

					$phoneNumber = $nextThree.'-'.$lastFour;
				}

				return $phoneNumber;
			}		
			$newPhNo=formatPhoneNumber($_POST['contact_phone']);
		
				$to = 'info@payecrm.com';
				$subject = $_POST['contact_subject'];
				$txt="<strong>Name:</strong> ".$_POST['contact_name']."<br/><strong>Email:</strong> ".$_POST['contact_email']."<br/><strong>Phone:</strong> ".$newPhNo."<br/><strong>Message:</strong> ".$_POST['contact_message'];
				
				$headers = "From:".$_POST['contact_email']."" . "\r\n" .
				"Content-Type: text/html";

				mail($to,$subject,$txt,$headers);
				$_SESSION['successMessage']="Message sent Successfully!"; 
				$_POST['contact_name']="";
				$_POST['contact_email']="";
				$_POST['contact_phone']="";
				$_POST['contact_subject']="";
				$_POST['contact_message']="";
			}
		}
    }    	
?>
<?php include_once("header.php");  ?>
<script src='https://www.google.com/recaptcha/api.js'></script> 
<div class="wrapper">

<section id="content">

            <div class="container">
                <h2 class="h3_font" style="text-align:left !important;">Contact Us</h2>
				
                <div class="row">

                    <div class="col-md-8">
                        
                            <h4><b>SEND A MESSAGE</b></h4>
                        
						<div class="alert-success"><?php echo $_SESSION['successMessage']; $_SESSION['successMessage']="";?></div>
						<div class="alert-danger"><?php echo $_SESSION['errorMessage']; $_SESSION['errorMessage']="";?></div>
                        <form method="POST">
						<input type="hidden" name="pageAction" value="contact">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input type="text" name="contact_name" id="contact_name" class="form-control input-lg" placeholder="Your Name*" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="email" name="contact_email" id="contact_email" class="form-control input-lg" placeholder="Your Email*" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" name="contact_phone" id="contact_phone" class="form-control input-lg" placeholder="Your Phone">
                                </div>
                                <div class="form-group col-xs-12">
                                    <input type="text" name="contact_subject" id="contact_subject" class="form-control input-lg" placeholder="Subject">
                                </div>

                                <div class="form-group col-xs-12">
                                    <textarea class="form-control" name="contact_message" id="contact_message" rows="11" placeholder="Your Message*" required></textarea>
                                </div>
								<div class="form-group col-xs-12 text-left">
								<div class="g-recaptcha" data-sitekey="6LdqJSAUAAAAAKEiB8Ji3dtRdYAFHVeY_Fk6iWci"></div>
								</div>
                                <div class="form-group col-xs-12 text-left">
                                    <button type="submit" class="btn-main">SEND EMAIL</button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <div class="col-md-4">
                        <div class="padding15">
                            <h4><b>OUR OFFICE</b></h4>
                        </div>
                        <p><i class="fa fa-map-marker fa-fw"></i> 911 Central Ave. <br><span style="margin-left:25px;"></span>Suite 162 <br><span style="margin-left:25px;"></span>Albany, NY 12203</p> 
                       <!-- <p><i class="fa fa-phone fa-fw"></i> +1-800-000-0000</p> -->
                        <p><i class="fa fa-envelope fa-fw"></i> info@PayeCRM.com</p>

                    </div>
                    
                    <div class="col-md-4">
                        <img src="build/images/contact-us.jpg" alt="" class="img-responsive support_img"> 

                    </div>

                </div>

            </div>



        </section>

</div> 
  
<?php include_once("footer.php");  ?>