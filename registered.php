<?php
if(isset($_POST['send_done']))
{
	//echo "<pre>"; print_r($_POST); exit;
	
	$google_url = 'https://www.google.com/recaptcha/api/siteverify';
	$secret = '6LcUGiUUAAAAADpBzzVFIOhB0JoCHemdKNUg9nfa';
	$response = $_POST ['g-recaptcha-response'];
	$url = $google_url . '?secret=' . $secret . '&response=' . $response;
	$curl = curl_init ();
	curl_setopt ( $curl, CURLOPT_URL, $url );
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt ( $curl, CURLOPT_TIMEOUT, 15 );
	curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
	curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, FALSE );
	$curlData = curl_exec ( $curl );
	curl_close ( $curl );
	$res = json_decode ( $curlData, TRUE );
	
	
	//echo '<pre>'; print_r($res); exit;
	
	error_log(print_r($res, 1));	
	if(isset($res['success']) && $res['success'] == 1 )
	{
		$fullname 		= $_POST['name'];
		$email 			= $_POST['email'];
		$country 		= $_POST['country'];
		$company_phone 	= $_POST['company_phone'];
		$number_of_user = $_POST['number_of_user'];
		
		$to = $email;
		$subject = 'WelCome to PayeCRM';
		$message = '
<html>
<head>
  <title>WelCome to PayeCRM</title>
</head>
<body>
  <p>Thanks for Registering with us. Our admin will get contacted with you soon.</p>
</body>
</html>
';
		// To send HTML mail, the Content-type header must be set
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		// Additional headers
		$headers[] = 'To: '.$fullname. $email;
		$headers[] = 'From: Welcome new user <noreply@payecrm.com>';
		//$headers[] = 'Cc: birthdayarchive@example.com';
		//$headers[] = 'Bcc: birthdaycheck@example.com';
		mail($to, $subject, $message, implode("\r\n", $headers));
		
		
		//mail to the admin
		$to = 'contact@payecrm.com';
		$subject = 'New user register';
		$message = '
<html>
<head>
  <title>New User register PayeCRM</title>
</head>
<body>
  <p></p>
<table>
    <tr>
      <td>Full Name: </td><td>'.$fullname.'</td>
    </tr>
	<tr>
      <td>Email: </td><td>'.$email.'</td>
    </tr>
    <tr>
      <td>Country: </td><td>'.$country.'</td>
    </tr>
	<tr>
      <td>Phone</td><td>'.$company_phone.'</td>
    </tr>
	<tr>
      <td>Number of User</td><td>'.$number_of_user.'</td>
    </tr>
  </table>
</body>
</html>
';	
		// To send HTML mail, the Content-type header must be set
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		// Additional headers
		$headers[] = 'To: '.$fullname. $email;
		$headers[] = 'From: Welcome new user <noreply@payecrm.com>';
		//$headers[] = 'Cc: birthdayarchive@example.com';
		//$headers[] = 'Bcc: birthdaycheck@example.com';
		mail($to, $subject, $message, implode("\r\n", $headers));
		
		$msg = "Registration successful";
	}	
	else 
	{
		$msg = "Invalid Captcha!";
	}
}

/*Captcha details (Start)*/
//Site key: 6LcUGiUUAAAAAOL8TLAt59LhTS7REkdDkIBjvXLi
//Secret key: 6LcUGiUUAAAAADpBzzVFIOhB0JoCHemdKNUg9nfa
/*Captcha details (End)*/
?>
<?php 
include_once("header.php");
?>   
<script src='https://www.google.com/recaptcha/api.js'></script>
 
  <!--About Content-->
  <section id="blue-container-onemonthform">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
          <h3 style="color:#d88027; font-size:36px; line-height:20px; text-align:center;">Get started with PayeCRM</h3>
          <p>&nbsp;</p>
          <p style="color:#ff0000; text-align:center;"><?php if(isset($msg)) echo $msg; ?></p>

          <div class="main-login main-center">
<form class="" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
<input type="hidden" name="send_done" value="1" />
                    <p>&nbsp;</p>
						
						<div class="form-group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="name" id="name" required placeholder="Full Name" value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="email" class="form-control" name="email" id="email"  placeholder="Email Address" required value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-map" aria-hidden="true"></i></span>	
									<?php //if(isset($_POST['country'])) echo $_POST['country'];?>								
                                    <select name="country" class="form-control" required>
										<option selected="" value="">Select a Country</option>
										<option value="Afganistan" <?php if(isset($_POST['country'])){ if($_POST['country'] == "Afganistan") echo "selected"; }?>>Afghanistan</option>
										<option value="Albania" <?php if(isset($_POST['country'])){ if($_POST['country'] == "Albania") echo "selected"; } ?>>Albania</option>										
										<option value="Algeria" <?php if(isset($_POST['country'])){ if($_POST['country'] == "Algeria") echo "selected" ; } else echo '';?>>Algeria</option>
										<option value="American Samoa" <?php if(isset($_POST['country'])){  if($_POST['country'] == "American Samoa") echo "selected" ; } else echo '';?>>American Samoa</option>
										<option value="Andorra" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Andorra") echo "selected" ; }?>>Andorra</option>
										<option value="Angola" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Angola") echo "selected" ; }?>>Angola</option>
										<option value="Anguilla" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Anguilla") echo "selected" ; }?>>Anguilla</option>
										<option value="Antigua and Barbuda" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Antigua and Barbuda") echo "selected" ; }?>>Antigua &amp; Barbuda</option>
										<option value="Argentina" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Argentina") echo "selected" ; }?>>Argentina</option>
										<option value="Armenia" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Armenia") echo "selected" ; }?>>Armenia</option>
										<option value="Aruba" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Aruba") echo "selected" ; }?>>Aruba</option>
										<option value="Australia" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Australia") echo "selected" ; }?>>Australia</option>
										<option value="Austria" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Austria") echo "selected" ; }?>>Austria</option>
										<option value="Azerbaijan" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Azerbaijan") echo "selected" ; }?>>Azerbaijan</option>
										<option value="Bahamas" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Bahamas") echo "selected" ; }?>>Bahamas</option>
										<option value="Bahrain" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Bahrain") echo "selected" ; }?>>Bahrain</option>
										<option value="Bangladesh" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Bangladesh") echo "selected" ; }?>>Bangladesh</option>
										<option value="Barbados" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Barbados") echo "selected" ; }?>>Barbados</option>
										<option value="Belarus" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Belarus") echo "selected" ; }?>>Belarus</option>
										<option value="Belgium" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Belgium") echo "selected" ; }?>>Belgium</option>
										<option value="Belize" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Belize") echo "selected" ; }?>>Belize</option>
										<option value="Benin" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Benin") echo "selected" ; }?>>Benin</option>
										<option value="Bermuda" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Bermuda") echo "selected" ; }?>>Bermuda</option>
										<option value="Bhutan" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Bhutan") echo "selected" ; }?>>Bhutan</option>
										<option value="Bolivia" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Bolivia") echo "selected" ; }?>>Bolivia</option>
										<option value="Bonaire" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Bonaire") echo "selected" ; }?>>Bonaire</option>
										<option value="Bosnia and Herzegovina" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Bosnia and Herzegovina") echo "selected" ; }?>>Bosnia &amp; Herzegovina</option>
										<option value="Botswana" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Botswana") echo "selected" ; }?>>Botswana</option>
										<option value="Brazil" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Brazil") echo "selected" ; }?>>Brazil</option>
										<option value="British Indian Ocean Ter" <?php if(isset($_POST['country'])){  if($_POST['country'] == "British Indian Ocean Ter") echo "selected" ; }?>>British Indian Ocean Ter</option>
										<option value="Brunei" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Brunei") echo "selected" ; }?>>Brunei</option>
										<option value="Bulgaria" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Bulgaria") echo "selected" ; }?>>Bulgaria</option>
										<option value="Burkina Faso" <?php if(isset($_POST['country'])){  if($_POST['country'] == "Burkina Faso") echo "selected" ; }?>>Burkina Faso</option>
										<option value="Burundi" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Burundi") echo "selected" ; }?>>Burundi</option>
										<option value="Cambodia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Cambodia") echo "selected" ; }?>>Cambodia</option>
										<option value="Cameroon" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Cameroon") echo "selected" ; }?>>Cameroon</option>
										<option value="Canada" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Canada") echo "selected" ; }?>>Canada</option>
										<option value="Canary Islands" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Canary Islands") echo "selected" ; }?>>Canary Islands</option>
										<option value="Cape Verde" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Cape Verde") echo "selected" ; }?>>Cape Verde</option>
										<option value="Cayman Islands" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Cayman Islands") echo "selected" ; }?>>Cayman Islands</option>
										<option value="Central African Republic" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Central African Republic") echo "selected" ; }?>>Central African Republic</option>
										<option value="Chad" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Chad") echo "selected" ; }?>>Chad</option>
										<option value="Channel Islands" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Channel Islands") echo "selected" ; }?>>Channel Islands</option>
										<option value="Chile" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Chile") echo "selected" ; }?>>Chile</option>
										<option value="China" <?php if(isset($_POST['country'])){  if($_POST['country']  == "China") echo "selected" ; }?>>China</option>
										<option value="Christmas Island" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Christmas Island") echo "selected" ; }?>>Christmas Island</option>
										<option value="Cocos Island" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Cocos Island") echo "selected" ; }?>>Cocos Island</option>
										<option value="Colombia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Colombia") echo "selected" ; }?>>Colombia</option>
										<option value="Comoros" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Comoros") echo "selected" ; }?>>Comoros</option>
										<option value="Congo" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Congo") echo "selected" ; }?>>Congo</option>
										<option value="Cook Islands" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Cook Islands") echo "selected" ; }?>>Cook Islands</option>
										<option value="Costa Rica" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Costa Rica") echo "selected" ; }?>>Costa Rica</option>
										<option value="Cote DIvoire" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Cote DIvoire") echo "selected" ; }?>>Cote D'Ivoire</option>
										<option value="Croatia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Croatia") echo "selected" ; }?>>Croatia</option>
										<option value="Cuba" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Cuba") echo "selected" ; }?>>Cuba</option>
										<option value="Curaco" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Curaco") echo "selected" ; }?>>Curacao</option>
										<option value="Cyprus" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Cyprus") echo "selected" ; }?>>Cyprus</option>
										<option value="Czech Republic" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Czech Republic") echo "selected" ; }?>>Czech Republic</option>
										<option value="Denmark" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Denmark") echo "selected" ; }?>>Denmark</option>
										<option value="Djibouti" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Djibouti") echo "selected" ; }?>>Djibouti</option>
										<option value="Dominica" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Dominica") echo "selected" ; }?>>Dominica</option>
										<option value="Dominican Republic" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Dominican Republic") echo "selected" ; }?>>Dominican Republic</option>
										<option value="East Timor" <?php if(isset($_POST['country'])){  if($_POST['country']  == "East Timor") echo "selected" ; }?>>East Timor</option>
										<option value="Ecuador" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Ecuador") echo "selected" ; }?>>Ecuador</option>
										<option value="Egypt" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Egypt") echo "selected" ; }?>>Egypt</option>
										<option value="El Salvador" <?php if(isset($_POST['country'])){  if($_POST['country']  == "El Salvador") echo "selected" ; }?>>El Salvador</option>
										<option value="Equatorial Guinea" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Equatorial Guinea") echo "selected" ; }?>>Equatorial Guinea</option>
										<option value="Eritrea" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Eritrea") echo "selected" ; }?>>Eritrea</option>
										<option value="Estonia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Estonia") echo "selected" ; }?>>Estonia</option>
										<option value="Ethiopia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Ethiopia") echo "selected" ; }?>>Ethiopia</option>
										<option value="Falkland Islands" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Falkland Islands") echo "selected" ; }?>>Falkland Islands</option>
										<option value="Faroe Islands" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Faroe Islands") echo "selected" ; }?>>Faroe Islands</option>
										<option value="Fiji" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Fiji") echo "selected" ; }?>>Fiji</option>
										<option value="Finland" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Finland") echo "selected" ; }?>>Finland</option>
										<option value="France" <?php if(isset($_POST['country'])){  if($_POST['country']  == "France") echo "selected" ; }?>>France</option>
										<option value="French Guiana" <?php if(isset($_POST['country'])){  if($_POST['country']  == "French Guiana") echo "selected" ; }?>>French Guiana</option>
										<option value="French Polynesia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "French Polynesia") echo "selected" ; }?>>French Polynesia</option>
										<option value="French Southern Ter" <?php if(isset($_POST['country'])){  if($_POST['country']  == "French Southern Ter") echo "selected" ; }?>>French Southern Ter</option>
										<option value="Gabon" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Gabon") echo "selected" ; }?>>Gabon</option>
										<option value="Gambia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Gambia") echo "selected" ; }?>>Gambia</option>
										<option value="Georgia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Georgia") echo "selected" ; }?>>Georgia</option>
										<option value="Germany" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Germany") echo "selected" ; }?>>Germany</option>
										<option value="Ghana" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Ghana") echo "selected" ; }?>>Ghana</option>
										<option value="Gibraltar" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Gibraltar") echo "selected" ; }?>>Gibraltar</option>
										<option value="Great Britain" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Great Britain") echo "selected" ; }?>>Great Britain</option>
										<option value="Greece" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Greece") echo "selected" ; }?>>Greece</option>
										<option value="Greenland" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Greenland") echo "selected" ; }?>>Greenland</option>
										<option value="Grenada" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Grenada") echo "selected" ; }?>>Grenada</option>
										<option value="Guadeloupe" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Guadeloupe") echo "selected" ; }?>>Guadeloupe</option>
										<option value="Guam" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Guam") echo "selected" ; }?>>Guam</option>
										<option value="Guatemala" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Guatemala") echo "selected" ; }?>>Guatemala</option>
										<option value="Guinea" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Guinea") echo "selected" ; }?>>Guinea</option>
										<option value="Guyana" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Guyana") echo "selected" ; }?>>Guyana</option>
										<option value="Haiti" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Haiti") echo "selected" ; }?>>Haiti</option>
										<option value="Hawaii" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Hawaii") echo "selected" ; }?>>Hawaii</option>
										<option value="Honduras" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Honduras") echo "selected" ; }?>>Honduras</option>
										<option value="Hong Kong" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Hong Kong") echo "selected" ; }?>>Hong Kong</option>
										<option value="Hungary" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Hungary") echo "selected" ; }?>>Hungary</option>
										<option value="Iceland" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Iceland") echo "selected" ; }?>>Iceland</option>
										<option value="India" <?php if(isset($_POST['country'])){  if($_POST['country']  == "India") echo "selected" ; }?>>India</option>
										<option value="Indonesia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Indonesia") echo "selected" ; }?>>Indonesia</option>
										<option value="Iran" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Iran") echo "selected" ; }?>>Iran</option>
										<option value="Iraq" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Iraq") echo "selected" ; }?>>Iraq</option>
										<option value="Ireland" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Ireland") echo "selected" ; }?>>Ireland</option>
										<option value="Isle of Man" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Isle of Man") echo "selected" ; }?>>Isle of Man</option>
										<option value="Israel" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Israel") echo "selected" ; }?>>Israel</option>
										<option value="Italy" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Italy") echo "selected" ; }?>>Italy</option>
										<option value="Jamaica" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Jamaica") echo "selected" ; }?>>Jamaica</option>
										<option value="Japan" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Japan") echo "selected" ; }?>>Japan</option>
										<option value="Jordan" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Jordan") echo "selected" ; }?>>Jordan</option>
										<option value="Kazakhstan" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Kazakhstan") echo "selected" ; }?>>Kazakhstan</option>
										<option value="Kenya" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Kenya") echo "selected" ; }?>>Kenya</option>
										<option value="Kiribati" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Kiribati") echo "selected" ; }?>>Kiribati</option>
										<option value="Korea North" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Korea North") echo "selected" ; }?>>Korea North</option>
										<option value="Korea South" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Korea South") echo "selected" ; }?>>Korea South</option>
										<option value="Kuwait" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Kuwait") echo "selected" ; }?>>Kuwait</option>
										<option value="Kyrgyzstan" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Kyrgyzstan") echo "selected" ; }?>>Kyrgyzstan</option>
										<option value="Laos" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Laos") echo "selected" ; }?>>Laos</option>
										<option value="Latvia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Latvia") echo "selected" ; }?>>Latvia</option>
										<option value="Lebanon" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Lebanon") echo "selected" ; }?>>Lebanon</option>
										<option value="Lesotho" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Lesotho") echo "selected" ; }?>>Lesotho</option>
										<option value="Liberia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Liberia") echo "selected" ; }?>>Liberia</option>
										<option value="Libya" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Libya") echo "selected" ; }?>>Libya</option>
										<option value="Liechtenstein" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Liechtenstein") echo "selected" ; }?>>Liechtenstein</option>
										<option value="Lithuania" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Lithuania") echo "selected" ; }?>>Lithuania</option>
										<option value="Luxembourg" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Luxembourg") echo "selected" ; }?>>Luxembourg</option>
										<option value="Macau" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Macau") echo "selected" ; }?>>Macau</option>
										<option value="Macedonia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Macedonia") echo "selected" ; }?>>Macedonia</option>
										<option value="Madagascar" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Madagascar") echo "selected" ; }?>>Madagascar</option>
										<option value="Malaysia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Malaysia") echo "selected" ; }?>>Malaysia</option>
										<option value="Malawi" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Malawi") echo "selected" ; }?>>Malawi</option>
										<option value="Maldives" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Maldives") echo "selected" ; }?>>Maldives</option>
										<option value="Mali" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Mali") echo "selected" ; }?>>Mali</option>
										<option value="Malta" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Malta") echo "selected" ; }?>>Malta</option>
										<option value="Marshall Islands" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Marshall Islands") echo "selected" ; }?>>Marshall Islands</option>
										<option value="Martinique" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Martinique") echo "selected" ; }?>>Martinique</option>
										<option value="Mauritania" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Mauritania") echo "selected" ; }?>>Mauritania</option>
										<option value="Mauritius" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Mauritius") echo "selected" ; }?>>Mauritius</option>
										<option value="Mayotte" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Mayotte") echo "selected" ; }?>>Mayotte</option>
										<option value="Mexico" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Mexico") echo "selected" ; }?>>Mexico</option>
										<option value="Midway Islands" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Midway Islands") echo "selected" ; }?>>Midway Islands</option>
										<option value="Moldova" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Moldova") echo "selected" ; }?>>Moldova</option>
										<option value="Monaco" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Monaco") echo "selected" ; }?> >Monaco</option>
										<option value="Mongolia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Mongolia") echo "selected" ; }?> >Mongolia</option>
										<option value="Montserrat" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Montserrat") echo "selected" ; }?> >Montserrat</option>
										<option value="Morocco" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Morocco") echo "selected" ; }?> >Morocco</option>
										<option value="Mozambique" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Mozambique") echo "selected" ; }?> >Mozambique</option>
										<option value="Myanmar" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Myanmar") echo "selected" ; }?> >Myanmar</option>
										<option value="Nambia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Nambia") echo "selected" ; }?> >Nambia</option>
										<option value="Nauru" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Nauru") echo "selected" ; }?> >Nauru</option>
										<option value="Nepal" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Nepal") echo "selected" ; }?> >Nepal</option>
										<option value="Netherland Antilles" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Netherland Antilles") echo "selected" ; }?> >Netherland Antilles</option>
										<option value="Netherlands" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Netherlands") echo "selected" ; }?> >Netherlands (Holland, Europe)</option>
										<option value="Nevis" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Nevis") echo "selected" ; }?> >Nevis</option>
										<option value="New Caledonia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "New Caledonia") echo "selected" ; }?> >New Caledonia</option>
										<option value="New Zealand" <?php if(isset($_POST['country'])){  if($_POST['country']  == "New Zealand") echo "selected" ; }?> >New Zealand</option>
										<option value="Nicaragua" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Nicaragua") echo "selected" ; }?> >Nicaragua</option>
										<option value="Niger" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Niger") echo "selected" ; }?> >Niger</option>
										<option value="Nigeria" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Nigeria") echo "selected" ; }?> >Nigeria</option>
										<option value="Niue" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Niue") echo "selected" ; }?> >Niue</option>
										<option value="Norfolk Island" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Norfolk Island") echo "selected" ; }?> >Norfolk Island</option>
										<option value="Norway" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Norway") echo "selected" ; }?> >Norway</option>
										<option value="Oman" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Oman") echo "selected" ; }?> >Oman</option>
										<option value="Pakistan" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Pakistan") echo "selected" ; }?> >Pakistan</option>
										<option value="Palau Island" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Palau Island") echo "selected" ; }?> >Palau Island</option>
										<option value="Palestine" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Palestine") echo "selected" ; }?> >Palestine</option>
										<option value="Panama" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Panama") echo "selected" ; }?> >Panama</option>
										<option value="Papua New Guinea" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Papua New Guinea") echo "selected" ; }?> >Papua New Guinea</option>
										<option value="Paraguay" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Paraguay") echo "selected" ; }?> >Paraguay</option>
										<option value="Peru" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Peru") echo "selected" ; }?> >Peru</option>
										<option value="Phillipines" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Phillipines") echo "selected" ; }?> >Philippines</option>
										<option value="Pitcairn Island" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Pitcairn Island") echo "selected" ; }?> >Pitcairn Island</option>
										<option value="Poland" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Poland") echo "selected" ; }?> >Poland</option>
										<option value="Portugal" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Portugal") echo "selected" ; }?> >Portugal</option>
										<option value="Puerto Rico" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Puerto Rico") echo "selected" ; }?> >Puerto Rico</option>
										<option value="Qatar" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Qatar") echo "selected" ; }?> >Qatar</option>
										<option value="Republic of Montenegro" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Republic of Montenegro") echo "selected" ; }?> >Republic of Montenegro</option>
										<option value="Republic of Serbia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Republic of Serbia") echo "selected" ; }?> >Republic of Serbia</option>
										<option value="Reunion" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Reunion") echo "selected" ; }?> >Reunion</option>
										<option value="Romania" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Romania") echo "selected" ; }?> >Romania</option>
										<option value="Russia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Russia") echo "selected" ; }?> >Russia</option>
										<option value="Rwanda" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Rwanda") echo "selected" ; }?> >Rwanda</option>
										<option value="St Barthelemy" <?php if(isset($_POST['country'])){  if($_POST['country']  == "St Barthelemy") echo "selected" ; }?> >St Barthelemy</option>
										<option value="St Eustatius" <?php if(isset($_POST['country'])){  if($_POST['country']  == "St Eustatius") echo "selected" ; }?> >St Eustatius</option>
										<option value="St Helena" <?php if(isset($_POST['country'])){  if($_POST['country']  == "St Helena") echo "selected" ; }?> >St Helena</option>
										<option value="St Kitts-Nevis" <?php if(isset($_POST['country'])){  if($_POST['country']  == "St Kitts-Nevis") echo "selected" ; }?> >St Kitts-Nevis</option>
										<option value="St Lucia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "St Lucia") echo "selected" ; }?> >St Lucia</option>
										<option value="St Maarten" <?php if(isset($_POST['country'])){  if($_POST['country']  == "St Maarten") echo "selected" ; }?> >St Maarten</option>
										<option value="St Pierre and Miquelon" <?php if(isset($_POST['country'])){  if($_POST['country']  == "St Pierre and Miquelon") echo "selected" ; }?> >St Pierre &amp; Miquelon</option>
										<option value="St Vincent and Grenadines" <?php if(isset($_POST['country'])){  if($_POST['country']  == "St Vincent and Grenadines") echo "selected" ; }?> >St Vincent &amp; Grenadines</option>
										<option value="Saipan" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Saipan") echo "selected" ; }?> >Saipan</option>
										<option value="Samoa" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Samoa") echo "selected" ; }?> >Samoa</option>
										<option value="Samoa American" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Samoa American") echo "selected" ; }?> >Samoa American</option>
										<option value="San Marino" <?php if(isset($_POST['country'])){  if($_POST['country']  == "San Marino") echo "selected" ; }?> >San Marino</option>
										<option value="Sao Tome and Principe" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Sao Tome and Principe") echo "selected" ; }?> >Sao Tome &amp; Principe</option>
										<option value="Saudi Arabia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Saudi Arabia") echo "selected" ; }?> >Saudi Arabia</option>
										<option value="Senegal" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Senegal") echo "selected" ; }?> >Senegal</option>
										<option value="Serbia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Serbia") echo "selected" ; }?> >Serbia</option>
										<option value="Seychelles" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Seychelles") echo "selected" ; }?> >Seychelles</option>
										<option value="Sierra Leone" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Sierra Leone") echo "selected" ; }?> >Sierra Leone</option>
										<option value="Singapore" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Singapore") echo "selected" ; }?> >Singapore</option>
										<option value="Slovakia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Slovakia") echo "selected" ; }?> >Slovakia</option>
										<option value="Slovenia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Slovenia") echo "selected" ; }?> >Slovenia</option>
										<option value="Solomon Islands" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Solomon Islands") echo "selected" ; }?> >Solomon Islands</option>
										<option value="Somalia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Somalia") echo "selected" ; }?> >Somalia</option>
										<option value="South Africa" <?php if(isset($_POST['country'])){  if($_POST['country']  == "South Africa") echo "selected" ; }?> >South Africa</option>
										<option value="Spain" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Spain") echo "selected" ; }?> >Spain</option>
										<option value="Sri Lanka" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Sri Lanka") echo "selected" ; }?> >Sri Lanka</option>
										<option value="Sudan" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Sudan") echo "selected" ; }?> >Sudan</option>
										<option value="Suriname" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Suriname") echo "selected" ; }?> >Suriname</option>
										<option value="Swaziland" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Swaziland") echo "selected" ; }?> >Swaziland</option>
										<option value="Sweden" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Sweden") echo "selected" ; }?> >Sweden</option>
										<option value="Switzerland" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Switzerland") echo "selected" ; }?> >Switzerland</option>
										<option value="Syria" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Syria") echo "selected" ; }?> >Syria</option>
										<option value="Tahiti" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Tahiti") echo "selected" ; }?> >Tahiti</option>
										<option value="Taiwan" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Taiwan") echo "selected" ; }?> >Taiwan</option>
										<option value="Tajikistan" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Tajikistan") echo "selected" ; }?> >Tajikistan</option>
										<option value="Tanzania" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Tanzania") echo "selected" ; }?> >Tanzania</option>
										<option value="Thailand" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Thailand") echo "selected" ; }?> >Thailand</option>
										<option value="Togo" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Togo") echo "selected" ; }?> >Togo</option>
										<option value="Tokelau" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Tokelau") echo "selected" ; }?> >Tokelau</option>
										<option value="Tonga" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Tonga") echo "selected" ; }?> >Tonga</option>
										<option value="Trinidad and Tobago" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Trinidad and Tobago") echo "selected" ; }?> >Trinidad &amp; Tobago</option>
										<option value="Tunisia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Tunisia") echo "selected" ; }?> >Tunisia</option>
										<option value="Turkey" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Turkey") echo "selected" ; }?> >Turkey</option>
										<option value="Turkmenistan" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Turkmenistan") echo "selected" ; }?> >Turkmenistan</option>
										<option value="Turks and Caicos Is" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Turks and Caicos Is") echo "selected" ; }?> >Turks &amp; Caicos Is</option>
										<option value="Tuvalu" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Tuvalu") echo "selected" ; }?> >Tuvalu</option>
										<option value="Uganda" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Uganda") echo "selected" ; }?> >Uganda</option>
										<option value="Ukraine" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Ukraine") echo "selected" ; }?> >Ukraine</option>
										<option value="United Arab Erimates" <?php if(isset($_POST['country'])){  if($_POST['country']  == "United Arab Erimates") echo "selected" ; }?> >United Arab Emirates</option>
										<option value="United Kingdom" <?php if(isset($_POST['country'])){  if($_POST['country']  == "United Kingdom") echo "selected" ; }?> >United Kingdom</option>
										<option value="United States of America" <?php if(isset($_POST['country'])){  if($_POST['country']  == "United States of America") echo "selected" ; }?> >United States of America</option>
										<option value="Uraguay" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Uraguay") echo "selected" ; }?> >Uruguay</option>
										<option value="Uzbekistan" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Uzbekistan") echo "selected" ; }?> >Uzbekistan</option>
										<option value="Vanuatu" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Vanuatu") echo "selected" ; }?> >Vanuatu</option>
										<option value="Vatican City State" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Vatican City State") echo "selected" ; }?> >Vatican City State</option>
										<option value="Venezuela" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Venezuela") echo "selected" ; }?> >Venezuela</option>
										<option value="Vietnam" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Vietnam") echo "selected" ; }?> >Vietnam</option>
										<option value="Virgin Islands (Brit)" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Virgin Islands (Brit)") echo "selected" ; }?> >Virgin Islands (Brit)</option>
										<option value="Virgin Islands (USA)" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Virgin Islands (USA)") echo "selected" ; }?> >Virgin Islands (USA)</option>
										<option value="Wake Island" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Wake Island") echo "selected" ; }?> >Wake Island</option>
										<option value="Wallis and Futana Is" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Wallis and Futana Is") echo "selected" ; }?> >Wallis &amp; Futana Is</option>
										<option value="Yemen" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Yemen") echo "selected" ; }?> >Yemen</option>
										<option value="Zaire" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Zaire") echo "selected" ; }?> >Zaire</option>
										<option value="Zambia" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Zambia") echo "selected" ; }?> >Zambia</option>
										<option value="Zimbabwe" <?php if(isset($_POST['country'])){  if($_POST['country']  == "Zimbabwe") echo "selected" ; }?> >Zimbabwe</option>
										<?php //*/ ?>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="company_phone" id="company_phone"  placeholder="Company Phone" required value="<?php if(isset($_POST['company_phone'])) echo $_POST['company_phone'];?>" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="number_of_user" id="number_of_user" placeholder="Number of User"  value="<?php if(isset($_POST['number_of_user'])) echo $_POST['number_of_user'];?>" />
								</div>
							</div>
						</div>
                        
                        <div class="form-group">
							<div class="cols-sm-10">
                               <div style="margin-left:8px;" class="g-recaptcha" data-sitekey="6LcUGiUUAAAAAOL8TLAt59LhTS7REkdDkIBjvXLi"></div>
                            </div>
                        </div>    

						<div class="form-group ">
							<button id="button" class="btn btn-primary btn-lg btn-block login-button">Register</button>                            
                            <p style="font-size:12px; color:#666; text-align:center;">1 month free · No credit card required · Secure site</p>
						</div>						
</form>
				</div>
          
        </div>
        
      </div>
    </div>
  </section>
  
  
  <!--Team Section-->
  
  
  
  <!--Message-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script>
 $(document).ready(function (e){ 
 
 $("#contact_message").keyup(function(ev){
 if(ev.keyCode==13)
 $("button").click();
 
 
 }
 );
 
    
        $("#contact-form").on('submit',(function(e){
        e.preventDefault();
        $.ajax({
        url: "contactform.php",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success: function(data){        
        if(data!='success'){
       $('.alert-danger').html("");
        //$('.alert-success').html("Message sent!");
        location.reload();
        //$('#contact_name').val('');
         //$('#contact_email').val('');
          //$('#contact_subject').val('');
           //$('#contact_message').val('');
        }
         else
         {
         //alert(data);
         $('.alert-success').html("");
         
        $('.alert-danger').html("Captcha is not verified");
        }
        },
        error: function(){} 	        
        });
        }));
        
    });   

</script> 
    
    <!--Content Section-->
     
 <?php include_once("footer.php");  ?>   
