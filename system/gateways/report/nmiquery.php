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
	$db_username_two 	= "scare518_master";
	$db_password_two 	= "aAvv2CP+OF1T";
	$db_name_two		= "scare518_master";
	$con_two = mysqli_connect($host_name_two,$db_username_two,$db_password_two,$db_name_two);
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	date_default_timezone_set("UTC");
	$yesterday=date('Ymd',strtotime("-1 day"));
	$today=date('YmdHis');
	//echo $yesterday;exit;
    //$constraints ="&start_date=20151210000000&end_date=20151210235959";
    $constraints = "&start_date=".$yesterday."000000&end_date=".$today."";
    //$constraints = "&start_date=20150601000000&end_date=".$today."";
	$query="select * from t_midmaster where gatewayType='nmi' and status='Y'";
	$gatewayResult= mysqli_query($con_two,$query);
	while($rowGateway = mysqli_fetch_assoc($gatewayResult)) {
		//print_r($rowGateway);
		//echo $rowGateway['username'].' '.$rowGateway['password'].'<br/>';
	
	//exit;
    //$result = testXmlQuery('bronzesable3','Adidas@23',$constraints);
		$result = testXmlQuery($rowGateway['username'],$rowGateway['password'],$constraints);
	/*echo '<pre>';
    print_r( $result);
	echo '</pre>';
	echo '<br/>';*/

		foreach($result as $a)
		{
			$transaction_id=$a->transaction_id;
			$getResult="select * from t_batchDetails where gatewayTransactionId=".$transaction_id;
			$queryResult=mysqli_query($con_two, $getResult);
			if(mysqli_num_rows($queryResult) < 1){
				$cnt=count($a->action);
				if($a->action[$cnt-1]->action_type=="settle"){
					$cnt=count($a->action);
					$sql = "INSERT INTO `t_batchDetails` (
					`gatewayTransactionId` ,
					`status` ,
					`invoice_id` ,
					`product_name` ,
					`customer_name` ,
					`customer_address` ,
					`customer_city` ,
					`customer_state` ,
					`customer_country` ,
					`customer_zip` ,
					`customer_email` ,
					`customer_phone` ,
					`cardNo` ,
					`gatewayID` ,
					`agent_name` ,
					`prefix`,
					`companyID` ,
					`grossPrice` ,
					`action_type` ,
					`response_text`,
					`response_code`,
					`batch_id`,
					`rec_crt_date`,
					`rec_up_date`
					)
					VALUES (
						'".$a->transaction_id."',  
						'".addslashes($a->condition)."',  
						'".addslashes($a->order_id)."',  
						'".addslashes($a->order_description)."',  
						'".addslashes($a->first_name.' '.$a->last_name)."',  
						'".addslashes($a->address_1)."',  
						'".addslashes($a->city)."',  
						'".addslashes($a->state)."', 
						'".addslashes($a->country)."',	
						'".addslashes($a->postal_code)."',  	  
						'".addslashes($a->email)."',  
						'".addslashes($a->phone)."',  
						'".addslashes($a->cc_number)."',  
						'".addslashes($a->merchant_defined_field[0])."',  
						'".addslashes($a->merchant_defined_field[1])."',  
						'".addslashes(substr($a->order_id, 0, 3))."',  
						'".addslashes($a->merchant_defined_field[2])."',  
						'".addslashes($a->action->amount)."',  
						'".addslashes($a->action[$cnt-1]->action_type)."',  
						'".addslashes($a->action[$cnt-1]->response_text)."',
						'".addslashes($a->action[$cnt-1]->response_code)."',
						'".$a->action[$cnt-1]->batch_id."', 
						'".date("Y-m-d H:i:s",strtotime($a->action[0]->date)-14400)."',
						'".date("Y-m-d H:i:s",strtotime($a->action[$cnt-1]->date)-14400)."'
					)";
					if($a->transaction_id!=""){
						mysqli_query($con_two, $sql);
					}
				}	
			}
		}
	}


} catch (Exception $e) {

    //$e->outputText();
    $e->getMessage();

}