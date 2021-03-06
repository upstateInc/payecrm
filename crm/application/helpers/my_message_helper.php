<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function add_icon() {	
$CI =& get_instance();	
$CI->load->helper('html');	
$image_properties = array(	    'src' => 'images/admin/smiley_add.png',	    'alt' => 'Add',	    'title' => 'Add',	    'border' => '0'	);	
return img($image_properties);
}
function edit_icon() {
	$CI =& get_instance();	
	$CI->load->helper('html');	
	$image_properties = array(	    'src' => 'images/admin/icon_edit.gif',	    'alt' => 'Edit',	    'title' => 'Edit',	    'border' => '0'	);
	return img($image_properties);
	}
function delete_icon() {
	$CI =& get_instance();	
	$CI->load->helper('html');	
	$image_properties = array(	    'src' => 'images/admin/icon_delete.png',	    'alt' => 'Delete',	    'title' => 'Delete',	    'border' => '0'	);	
	return img($image_properties);
}
function view_icon() {
	$CI =& get_instance();	
	$CI->load->helper('html');	
	$image_properties = array(	    'src' => 'images/admin/file_view.png',	    'alt' => 'View',	    'title' => 'View',	    'border' => '0'	);	
	return img($image_properties);
}
function active_icon() {	
	$CI =& get_instance();	
	$CI->load->helper('html');	
	$image_properties = '<span class="glyphicon glyphicon-ok" aria-hidden="true">';	
	//return img($image_properties);
	return $image_properties;
}
function inactive_icon() {	
	$CI =& get_instance();	
	$CI->load->helper('html');	
	$image_properties = '<span class="glyphicon glyphicon-remove" aria-hidden="true">';	
	//return img($image_properties);
	return $image_properties;
}
function featured_icon() {	
	$CI =& get_instance();	
	$CI->load->helper('html');	
	$image_properties = array(	    'src' => 'images/admin/thumbs_up.gif',	    'alt' => '',	    'title' => '',	    'border' => '0'	);	
	return img($image_properties);}
function non_featured_icon() {	$CI =& get_instance();	
$CI->load->helper('html');	$image_properties = array(	    'src' => 'images/admin/thumbs_down.gif',	    'alt' => '',	    'title' => '',	    'border' => '0'	);	
return img($image_properties);}function up_arrow_icon() {	
$CI =& get_instance();	
$CI->load->helper('html');	
$image_properties = array(	    'src' => 'images/admin/sortup.gif',	    'alt' => '',	    'title' => '',	    'border' => '0'	);	
return img($image_properties);}
function down_arrow_icon() {	
$CI =& get_instance();	
$CI->load->helper('html');	
$image_properties = array(	    'src' => 'images/admin/sortdown.gif',	    'alt' => '',	    'title' => '',	    'border' => '0'	);	
return img($image_properties);
}
function priority_up_icon() {	
$CI =& get_instance();	
$CI->load->helper('html');	
$image_properties = array(	    'src' => 'images/priority_up.png',	    'alt' => '',	    'title' => '',	    'border' => '0'	);	
return img($image_properties);}
function priority_down_icon() {	
$CI =& get_instance();	$CI->load->helper('html');	
$image_properties = array(	    'src' => 'images/priority_down.png',	    'alt' => '',	    'title' => '',	    'border' => '0'	);	

return img($image_properties);}

function setMessage($message_string,$message_type){
	switch($message_type) {	
		case "success":			
		return '<span id="msgSuccessSpan" class="label label-success" >'.$message_string.'</span>';			
		break;		
		case "error":			
		return '<span id="msgErrorSpan" class="label label-danger" >'.$message_string.'</span>';			
		break;		
		case "info":			
		return '<span class="label label-info" >'.$message_string.'</span>';			
		break;		
		default:			
		return '<span class="label label-primary" >'.$message_string.'</span>';	
	}
}
	/*function setMessage($message_string,$message_type) {	switch($message_type) {				case "success":			return '<span style="color:green;">'.$message_string.'</span>';			break;		case "error":			return '<span style="color:red;">'.$message_string.'</span>';			break;		case "info":			return '<span style="color:blue;">'.$message_string.'</span>';			break;		default:			return '<span style="color:blue;">'.$message_string.'</span>';	}}*/
	function no_image() {	
	$CI =& get_instance();	
	$CI->load->helper('html');	
	$image_properties = array(	    'src' => 'images/no_image.png',	    'alt' => '',	    'title' => '',	    'border' => '0'	);	
	return img($image_properties);
	}