<?php
function my_loginfo_function($action_type=0,$action_info=''){
	//echo $_SERVER['REQUEST_URI'];
	$CI =& get_instance();
	//echo $CI->router->class.'/'.$CI->router->method; 
	$row['adminId'] = $CI->session->userdata('ADMIN_ID');
	$row['action_url'] = $_SERVER['REQUEST_URI'];
	$row['action_info'] = $action_info;
	$row['action_type'] = $action_type;
	$row['action_time'] = date('y-m-d H:i:s');
	$CI->db->insert(LOGINFO,$row);
 }
?>