<?php 
	date_default_timezone_set("UTC");
	/*************Time Calculation***************/
		date_default_timezone_set('US/Eastern');
		$date1=date('Y-m-d H:i:s');
		date_default_timezone_set("UTC");
		$date2=date('Y-m-d H:i:s');
		$diff = strtotime($date2) - strtotime($date1);			
	/********************************************/		
			
	$yesterday=date('Y-m-d',strtotime("-200 day"));
	$today=date('Y-m-d');
	$info = 'USER=maria_api1.jdirectbuy.com'
        .'&PWD=L68WM8KC9JJDLH2X'
        .'&SIGNATURE=AQU0e5vuZCvSg-XJploSa.sGUDlpAB.2zN.BgYys9rah0EH23ypgmVqj'
        .'&METHOD=TransactionSearch'
        .'&TRANSACTIONID='.$gatewayTransactionId.''
        .'&STARTDATE='.$yesterday.'T05:38:48Z'
        .'&ENDDATE='.$today.'T05:38:48Z'
        .'&VERSION=94';

$curl = curl_init('https://api-3t.paypal.com/nvp');
curl_setopt($curl, CURLOPT_FAILONERROR, true);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($curl, CURLOPT_POSTFIELDS,  $info);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_POST, 1);

$result = curl_exec($curl);

# Bust the string up into an array by the ampersand (&)
# You could also use parse_str(), but it would most likely limit out
$result = explode("&", $result);

# Loop through the new array and further bust up each element by the equal sign (=)
# and then create a new array with the left side of the equal sign as the key and the right side of the equal sign as the value
foreach($result as $value){
    $value = explode("=", $value);
    $temp[$value[0]] = $value[1];
}

# At the time of writing this code, there were 11 different types of responses that were returned for each record
# There may only be 10 records returned, but there will be 110 keys in our array which contain all the different pieces of information for each record
# Now create a 2 dimensional array with all the information for each record together
$returned_array=array();
for($i=0; $i < count($temp)/11 ; $i++){
    /*$returned_array[$i] = (
        "timestamp"         =    urldecode($result["L_TIMESTAMP".$i]),
        "timezone"          =    urldecode($result["L_TIMEZONE".$i]),
        "type"              =    urldecode($result["L_TYPE".$i]),
        "email"             =    urldecode($result["L_EMAIL".$i]),
        "name"              =    urldecode($result["L_NAME".$i]),
        "transaction_id"    =    urldecode($result["L_TRANSACTIONID".$i]),
        "status"            =    urldecode($result["L_STATUS".$i]),
        "amt"               =    urldecode($result["L_AMT".$i]),
        "currency_code"     =    urldecode($result["L_CURRENCYCODE".$i]),
        "fee_amount"        =    urldecode($result["L_FEEAMT".$i]),
        "net_amount"        =    urldecode($result["L_NETAMT".$i])
	);*/
	$date = str_replace("T", " ", urldecode($temp["L_TIMESTAMP".$i]));
	$date = str_replace("Z", "", $date);
	$newDate=date("Y-m-d H:i:s",strtotime($date)-$diff);
	$returned_array[$i]['timestamp'] = $newDate;
	$returned_array[$i]['type'] = urldecode($temp["L_TYPE".$i]);
	$returned_array[$i]['email'] = urldecode($temp["L_EMAIL".$i]);
	$returned_array[$i]['name'] = urldecode($temp["L_NAME".$i]);
	$returned_array[$i]['transaction_id'] = urldecode($temp["L_TRANSACTIONID".$i]);
	$returned_array[$i]['status'] = urldecode($temp["L_STATUS".$i]);
	$returned_array[$i]['amt'] = urldecode($temp["L_AMT".$i]);
	$returned_array[$i]['currency_code'] = urldecode($temp["L_CURRENCYCODE".$i]);
	$returned_array[$i]['fee_amount'] = urldecode($temp["L_FEEAMT".$i]);
	$returned_array[$i]['net_amount'] = urldecode($temp["L_NETAMT".$i]);
	
	/*echo $getResult="select * from t_invoice where gatewayTransactionId='".$returned_array[$i]['transaction_id']."'";
	echo '<br/>';
	$queryResult=mysqli_query($con_two, $getResult);			
	if(mysqli_num_rows($queryResult) < 1){
		echo $returned_array[$i]['transaction_id'];
	}	*/					
	
}
//print_r($returned_array);
//print_r($result);
//print_r($value);
//print_r($temp);
$gatewayTransactionId = $returned_array[0]['transaction_id'];
?>