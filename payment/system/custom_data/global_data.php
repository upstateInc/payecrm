<?php
session_start();
ob_start();
error_reporting(E_ALL ^ E_NOTICE);
//error_reporting( 0 );
//date_default_timezone_set('UTC');
$timezone = "Asia/Calcutta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
//Tables
define('ADMINUSER','t_admin');
define('USER','t_user');
define('LOGINDETILS','t_logindetails');
define('LOGINFO','t_loginfo');
define('EMPLOYERUSER','t_employer');
define('SITE_SETTINGS','t_settings');
define('CMS','cms');
define('BANNER','banner');
define('COUNTY','county');
define('SOCIALMEDIA','t_socialmedia');
define('POSITIONTYPE','t_position_type');
define('INDUSTRY','t_industry');
define('COUNTRY','t_country');
define('STATE','t_state');
define('CITY','t_city');
define('ZIP','t_zip');
define('HEADER_MENU','t_headerMenu');
define('FOOTER_MENU','t_footerMenu');
define('FEATURE_LISTING','feature_listing');
define('FEATURE_EMPLOYER','t_featured_employer');
define('CATEGORY','t_category');
define('SKILLS','t_skills');
define('JOBPOST','t_jobPosting');
define('EDUCATION','t_education');
define('EVENT','event');
define('EVENT_IMAGE','event_image');
define('CERTIFICATION','t_certification');
define('RESUME','t_resume');
define('EMPLOYER','t_employerInfo');
define('WORKAUTHORIZATION','t_workAuthorizarion');
define('EMPLOYMENTTYPE','t_employmentType');
define('AD_SETTINGS','t_ad_settings');
define('NEWSLETTER','t_newsletter');
define('DASHBOARD_CMS','t_dashboard_cms');
define('POLL','t_poll');
define('POLL_QUESTION','t_poll_question');
define('POLL_OPTION','t_poll_option');
define('JOBAPPLIED','t_appliedJobs');
define('JOBSAVED','t_savedJobs');
define('FUNCTIONALAREA','t_functionalArea');
define('AREAOFSPECIALIZATION','t_areaSpecialization');
define('EDUCATIONLIST','t_educationList');
define('RESUMETYPE','t_resumeType');
define('SAMPLERESUME','t_sample');
define('MESSAGES','t_messages');
define('SENTMESSAGES','t_sent_messages');
define('SUPPORTTICKET','t_supportticket');
define('EVENTS','t_events');
// Upload Path
define("FLD_PROFILE_IMAGE", "upload/profileimage/");
define("FLD_SUPPORT_TICKET", "upload/supportticket/");

///////////////views//////////////////////
define('VWMESSAGE','vw_message');
define('VWCASEREPORT','vw_casereport');
define('VWSUPPORTTICKET','vw_supportticket ');


//utility
define('FILENAME_PATTERN','/[\s,$#&\+\-()\[\];\'~`]/');

define('str_SITE_URL','http://sirjobs.com/');
define('str_SITE_URL_ADMIN','http://sirjobs.com/admin/');
define('str_ADMIN_SITE_TITLE','Sirjobs :: Administrator Control Panel'); 
define('str_SITE_TITLE','Sirjobs');


//General setting
define('CUR_DATE',date('Y-m-d'));
define('CUR_DATETIME',date('Y-m-d H:i:s'));
define('ADMIN_EMAIL','superadminadmin@admin.com');
define('CONTACT_US_EMAIL','superadminadmin@admin.com');

/*define('BASEURL', 'https://www.goradllc.com/template/crm/');
define('DBHOSTNAME', 'localhost');
define('DBUSERNAME', 'goradllc_templat');
define('DBPASSWORD', '}dCiSKoXr@bz');
define('DBNAME', 'goradllc_template');
define('COMPANYBASEURL', 'https://www.goradllc.com/template/');
define('COMPANYNAME', 'Company Name');
define('COMPANYEMAIL', 'norply@company.com');

$allow = array('');
if(!in_array($_SERVER['REMOTE_ADDR'], $allow) && !in_array($_SERVER["HTTP_X_FORWARDED_FOR"], $allow)) {
	header("Location: http://www.goradllc.com"); //redirect
	exit();
}*/

define('SHOW',5);
