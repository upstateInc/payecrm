<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* this function change xml objects into array */
function objectsIntoArray($arrObjData, $arrSkipIndices = array())
{
    $arrData = array();
   
    // if input is object, convert into array
    if (is_object($arrObjData)) {
        $arrObjData = get_object_vars($arrObjData);
    }
   
    if (is_array($arrObjData)) {
        foreach ($arrObjData as $index => $value) {
            if (is_object($value) || is_array($value)) {
                $value = objectsIntoArray($value, $arrSkipIndices); // recursive call
            }
            if (in_array($index, $arrSkipIndices)) {
                continue;
            }
            $arrData[$index] = $value;
        }
    }
    return $arrData;
}


/* this function directly from akismet.php by Matt Mullenweg.  *props* */
function AtD_http_post($request, $host, $path, $port = 80)
{
	$http_request  = "POST $path HTTP/1.0\r\n";
	$http_request .= "Host: $host\r\n";
	$http_request .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$http_request .= "Content-Length: " . strlen($request) . "\r\n";
	$http_request .= "User-Agent: AtD/0.1\r\n";
	$http_request .= "\r\n";
	$http_request .= $request;
	
	$response = '';
	if( false != ( $fs = @fsockopen($host, $port, $errno, $errstr, 10) ) )
	{
	fwrite($fs, $http_request);
	
	while ( !feof($fs) )
	{
	 $response .= fgets($fs);
	}
	fclose($fs);
	$response = explode("\r\n\r\n", $response, 2);
	}
	return $response;
}