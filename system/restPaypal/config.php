<?php
define('CLIENT_ID', 'AczDwGNSR0z1dXhmor7rJgQD4r-epSfoxAjG_8K2H3_Qyey_ye4JQteSFmhvynyqDgNAKUEyGr2XAdz_'); //your PayPal client ID
define('CLIENT_SECRET', 'EPAoPmarw-MNSEiEl0qFbhO8qw39cyLN-v8hHg2d0MWHIMN6d10PCajwdB_ZQve1_RghSWc6uGtdSdGu'); //PayPal Secret
//define('RETURN_URL', 'http://path-to-script/order_process.php'); //return URL where PayPal redirects user
//define('CANCEL_URL', 'http://path-to-script/payment_cancel.html'); //cancel URL
define('PP_CURRENCY', 'USD'); //Currency code
define('PP_MODE', 'sandbox'); //sandbox or live (sandbox requires testing credentials)
//define('PP_CONFIG_PATH', ''); //PayPal config path (sdk_config.ini)

//Enter MySQL details
/*$db_host 		= "localhost";
$db_username 	= "root";
$db_password 	= "";
$db_name 		= "sanwebe_demo";

//Open mySQL connection
$mysqli = new mysqli( $db_host, $db_username, $db_password, $db_name);
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}*/

?>