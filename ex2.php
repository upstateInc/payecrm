<?php 
if(count($_POST) > 0)
{
	/*$p = implode(" ",$_POST);
	$m = mail('payehub105@gmail.com', 'cURL POST', $p);
	echo "The mail $m";*/
	error_log(print_r($_POST, 1) );
}

echo "post  is empty";

?>