<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/*if($_SERVER['HTTP_HOST']=="192.168.0.129") 
{	$con = mysql_connect("localhost","root", "expinfo");	mysql_select_db("crm",$con);}else{	$con = mysql_connect("localhost","pairsysd_techin", "Techijobs1!#");	mysql_select_db("sirjobs",$con);}/*$cms_q = mysql_query("SELECT * FROM `cms` where status = 'Y'");if(mysql_num_rows($cms_q) > 0){
	while($cms_r = mysql_fetch_array($cms_q))
	{
		$route[$cms_r['slug']] = "cms/view/$1";
	}	
}*/
//mysql_close($con);


//$route['default_controller'] = "payment";
$route['default_controller'] = "plan";
$route['404_override'] = 'error_page';
$route['payment/success'] = "payment/success";
/*$route['employer'] = "employer/home";$route['employer/(:any)'] = "employer/$1";
$route['admin'] = "admin/home";
$route['admin/(:any)'] = "admin/$1";*/
//print_r($route);
//print_r($_SERVER);//error_reporting(E_ALL);
/* End of file routes.php */
/* Location: ./application/config/routes.php */