<?php
function testXmlQuery($username,$password,$constraints)
{
    $transactionFields = array(
        'transaction_id',
        'transaction_type',
        'condition',
        'order_id',
        'authorization_code',
        'ponumber',
        'orderdescription',
        'avs_response',
        'csc_response',


        'first_name',
        'last_name',
        'address_1',
        'address_2',
        'company',
        'city',
        'state',
        'postal_code',
        'country',
        'email',
        'phone',
        'fax',
        'cell_phone',
        'customertaxid',
        'customerid',
        'website',

        'shipping_last_name',
        'shipping_address_1',
        'shipping_address_2',
        'shipping_company',
        'shipping_city',
        'shipping_state',
        'shipping_postal_code',
        'shipping_country',
        'shipping_email',
        'shipping_carrier',
        'tracking_number',

        'cc_number',
        'cc_hash',
        'cc_exp',
        'cc_bin',
        'avs_response',
        'csc_response',
        'cardholder_auth',

        'processor_id',

        'tax');
    // actionFields is used to validate the XML tags in the
    // action element
     $actionFields = array(
		 'batch_id',
		 'processor_batch_id',
		 'response_code',
		 'processor_response_text',
		 'processor_response_code',
         'amount',
         'action_type',
         'date',
         'success',
         'ip_address',
         'source',
         'response_text'
          );

    $postStr='username='.$username.'&password='.$password. $constraints;
    $url="https://secure.networkmerchants.com/api/query.php?". $postStr;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $postStr);
    curl_setopt($ch, CURLOPT_REFERER, "");
    //$response=array();
    $response = curl_exec($ch);
    curl_close($ch);
    //echo $response;

    return $arr = simplexml_load_string($response);
    //print_r($arr);
}

try {
	$db_two_use 		= 'yes';
	$host_name_two 		= 'localhost';
	$db_username_two 	= "goradllc_master";
	$db_password_two 	= "aAvv2CP+OF1T";
	$db_name_two		= "goradllc_master";
	$con_two = mysqli_connect($host_name_two,$db_username_two,$db_password_two,$db_name_two);
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$yesterday=date('Ymd',strtotime("-1 day"));
	//echo $yesterday;exit;
    //$constraints ="&start_date=20151210000000&end_date=20151210235959";
    $constraints = "&start_date=".$yesterday."000000&end_date=".$yesterday."235959";
	$query="select * from t_midmaster where gatewayType='nmi'";
	$gatewayResult= mysqli_query($con_two,$query);
	while($rowGateway = mysqli_fetch_assoc($gatewayResult)) {
		$result = testXmlQuery($rowGateway['username'],$rowGateway['password'],$constraints);
		echo '<pre>';
		print_r( $result);
		echo '</pre>';
		echo '<br/>';
	}


} catch (Exception $e) {

    //$e->outputText();
    $e->getMessage();

}