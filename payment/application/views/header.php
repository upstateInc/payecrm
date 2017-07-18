<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
header('Access-Control-Allow-Origin:*');
?>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title>Sales and Support</title>
	<meta content="RAD Web Solutions" name="web application company" />
	<meta content="http://www.goradllc.com" name="url" />
    
	<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/css/datepicker.css" rel="stylesheet" type="text/css" />

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/jquery.maskedinput.js"></script>
    <script src="<?php echo base_url() ?>assets/jquery.signaturepad.js"></script>
    <script src="<?php echo base_url() ?>assets/json2.min.js"></script>

    <script>
	jQuery(function($){
	   //$("#phone").mask("(999) 999-9999");
	   //$("#contact").mask("(999) 999-9999");
	  $("#contact").mask("999-999-9999"); 
	});
    </script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/easyui.css">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.easyui.min.js"></script>    
</head>




<?php 
if($this->session->flashdata('message')!=''){
	$message = $this->session->flashdata('message');
}
if($message!=''){ echo $message; }
?>