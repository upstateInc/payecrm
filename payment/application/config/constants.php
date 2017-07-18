<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);
/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
define('FOPEN_READ',					'rb');
define('FOPEN_READ_WRITE',				'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb');  // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',		'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',				'ab');
define('FOPEN_READ_WRITE_CREATE',			'a+b');
define('FOPEN_WRITE_CREATE_STRICT',			'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/****************Configuration Setting This Part Needs to be changed only when setting Up new Mid***************/
define('BASEURL', 					'https://www.systemcare247.com/payment/');
define('DBHOSTNAME', 					'localhost');
define('DBUSERNAME', 					'root');
define('DBPASSWORD', 					'');
define('DBNAME', 						'payecrm_master');

define('MASTERDBHOSTNAME', 				'localhost');
define('MASTERDBUSERNAME', 				'root');
define('MASTERDBPASSWORD', 				'');
define('MASTERDBNAME', 					'payecrm_master');

define('COMPANYBASEURL', 				'https://www.payecrm.com/payment/');



/***************/

$host_name_two 		= 'localhost';
$db_username_two 	= "root";
$db_password_two 	= "";
$db_name_two		= "payecrm_master";

$con_two = mysqli_connect($host_name_two,$db_username_two,$db_password_two,$db_name_two);
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
require_once($_SERVER['DOCUMENT_ROOT'].'/system/routine/centerStatusCheck.php');
/**************/


/* End of file constants.php */
/* Location: ./application/config/constants.php */

	












