<?php
define('E_FATAL',  E_ERROR | E_USER_ERROR | E_PARSE | E_CORE_ERROR | 
        E_COMPILE_ERROR | E_RECOVERABLE_ERROR);

define('ENV', 'dev');

//Custom error handling vars
define('DISPLAY_ERRORS', TRUE);
//define('DISPLAY_ERRORS', FALSE);
define('ERROR_REPORTING', E_ALL | E_STRICT);
define('LOG_ERRORS', TRUE);

register_shutdown_function('shut');

set_error_handler('handler');

//Function to catch no user error handler function errors...
function shut(){
    $error = error_get_last();
    //if($error && ($error['type'] & E_FATAL)){
        handler($error['type'], $error['message'], $error['file'], $error['line']);
    //}
}
function handler( $errno, $errstr, $errfile, $errline ) {
	$typestr='';
    switch ($errno){
        case E_ERROR: // 1 //
            $typestr = 'E_ERROR'; break;
        case E_WARNING: // 2 //
            $typestr = 'E_WARNING'; break;
        case E_PARSE: // 4 //
            $typestr = 'E_PARSE'; break;
        case E_NOTICE: // 8 //
            $typestr = 'E_NOTICE'; break;
        case E_CORE_ERROR: // 16 //
            $typestr = 'E_CORE_ERROR'; break;
        case E_CORE_WARNING: // 32 //
            $typestr = 'E_CORE_WARNING'; break;
        case E_COMPILE_ERROR: // 64 //
            $typestr = 'E_COMPILE_ERROR'; break;
        case E_CORE_WARNING: // 128 //
            $typestr = 'E_COMPILE_WARNING'; break;
        case E_USER_ERROR: // 256 //
            $typestr = 'E_USER_ERROR'; break;
        case E_USER_WARNING: // 512 //
            $typestr = 'E_USER_WARNING'; break;
        case E_USER_NOTICE: // 1024 //
            $typestr = 'E_USER_NOTICE'; break;
        case E_STRICT: // 2048 //
            $typestr = 'E_STRICT'; break;
        case E_RECOVERABLE_ERROR: // 4096 //
            $typestr = 'E_RECOVERABLE_ERROR'; break;
        case E_DEPRECATED: // 8192 //
            $typestr = 'E_DEPRECATED'; break;
        case E_USER_DEPRECATED: // 16384 //
            $typestr = 'E_USER_DEPRECATED'; break;        
		case '': // 16384 //
            $typestr = 'Error'; break;
    }

    //$message = '<b>'.$typestr.': </b>'.$errstr.' in <b>'.$errfile.'</b> on line <b>'.$errline.'</b><br/>';
    $message = 'Error Message : <b>'.$typestr.': </b>'.$errstr.' in <b>'.$errfile.'</b> on line <b>'.$errline.'</b><br/>';

    /*if(($errno & E_FATAL) && ENV === 'production'){

        //header('Location: 500.html');
        //header('Status: 500 Internal Server Error');
		echo $message;
    }

    if(!($errno & ERROR_REPORTING))
        return;

    if(DISPLAY_ERRORS)*/
        //printf('%s', $message);
		//echo $message;
		///////////////  Database Connection Variables For Gorad LLC Master Database  ///////////////
		if($errstr!=""){
			date_default_timezone_set('US/Eastern');
			$db_two_use 		= 'yes';
			$host_name_two 		= 'localhost';
			$db_username_two 	= "goradllc_master";
			$db_password_two 	= "aAvv2CP+OF1T";
			$db_name_two		= "goradllc_master";
			$con_two = mysqli_connect($host_name_two,$db_username_two,$db_password_two,$db_name_two);
			$sqlNotification = "INSERT INTO t_notification (notification, notification_type, program_name, Line_number, comments, rec_crt_date)
			values(
				'".addslashes($typestr)."',
				'".addslashes($errstr)."',
				'".addslashes($errfile)."',
				'".addslashes($errline)."',
				'".addslashes($message)."',
				'".date('Y-m-d H:i:s')."'
			)
			";
			mysqli_query($con_two, $sqlNotification);
		}		
    //Logging error on php file error log...
    if(LOG_ERRORS)
        error_log(strip_tags($message), 0);
}
	function logSql($companyID="", $notification_type="", $program_name="", $Line_number="", $comments=""){
		date_default_timezone_set('US/Eastern');
		$db_two_use 		= 'yes';
		$host_name_two 		= 'localhost';
		$db_username_two 	= "goradllc_master";
		$db_password_two 	= "aAvv2CP+OF1T";
		$db_name_two		= "goradllc_master";
		$con_two = mysqli_connect($host_name_two,$db_username_two,$db_password_two,$db_name_two);		
		$sqlQueryNotification = "INSERT INTO t_notification (companyID, notification, notification_type, program_name, Line_number, comments, rec_crt_date)
			values(
				'".addslashes($companyID)."',
				'".addslashes($notification_type)."',
				'".addslashes($notification_type)."',
				'".addslashes($program_name)."',
				'".addslashes($Line_number)."',
				'".addslashes($comments)."',
				'".date('Y-m-d H:i:s')."'
			)
			";
			mysqli_query($con_two, $sqlQueryNotification);
	}

ob_start();
ob_end_flush();

?>
