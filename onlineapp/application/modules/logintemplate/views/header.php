<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}</style>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>PayeHub Payment Application </title>

        <script async="" src="<?php echo base_url();?>asset/analytics.js"></script><script type="text/javascript" src="<?php echo base_url();?>asset/jquery-1.js"></script>
    	<link rel="icon" type="image/png" href="http://www.payehub.com/connect/img/favicon.png"/>
    	  		
	  		<link rel="stylesheet" href="https://www.payehub.com/css/bootstrap.min.css" type="text/css">
	  		<link rel="stylesheet" href="https://www.payehub.com/css/main.css" type="text/css">
	  		<!-- <link rel="stylesheet" href="<?php #echo base_url();?>asset/main.css" type="text/css">  -->	  		
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/phubfront.css" type="text/css">
	  		
	  		<link rel="stylesheet" href="https://www.payehub.com/css/font-awesome.min.css" type="text/css">
			<link rel="stylesheet" href="<?php echo base_url();?>asset/utility.css" type="text/css">
			<link rel="stylesheet" href="https://www.payehub.com/css/custom-styles.css">
	
			<script type="text/javascript" src="<?php echo base_url();?>asset/jquery-ui.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/bootstrap.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/getDependentDropdownValues.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/moment.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/moment-timezone-with-data.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/angular.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/ui-utils.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/angular-moment.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/toastr.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/icheck.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/notifications.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/jquery.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/jquery_003.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/jquery_004.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/jquery_002.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/fastclick.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/selectall.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/phubangular.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/phubangularcommon.js"></script>
			<!-- script type="text/javascript" src="<?php //echo base_url();?>asset/functions.js"></script>  -->
			
			<script type="text/javascript" src="<?php echo base_url();?>asset/offscreen.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/angular-chosen.js"></script>
  
  <script type="text/javascript">
  	  var merchantForm = {};
  	  var setFormMetaVal = function(metaObj, metaKey, metaVal){
  	  	if (typeof (merchantForm[metaObj]) === "undefined"){
  	  		merchantForm[metaObj] = {};
  	  	}
  	  	merchantForm[metaObj][metaKey] = metaVal;
  	  }
  	  
  	  var getFormMetaVal = function(metaObj){
  	  	if (typeof (merchantForm[metaObj]) === "undefined"){
  	  		return null;
  	  	}else{
  	  		return merchantForm[metaObj];
  	  	}
  	  }
  	  
  	  window.onloadFnList = [];
		window.onload = function() {
			//console.log("initing onload");
			for(var fnName in onloadFnList){
				//console.log(fnName);
				onloadFnList[fnName]();
			}
		};

	var base_url = '<?php echo base_url(); ?>';		
  </script>
  
  
  
<style>
.alert-danger {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
}
.alert-success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
}
</style>
  
  
  
  <script src="<?php echo base_url();?>asset/2106540060.js"></script>
  

  <title>PayeHub</title>

  
  <link rel="icon" type="image/png" href="img/favicon.png"/>

  
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68172138-1', 'auto');
  ga('send', 'pageview');    
</script>

<script src='https://www.google.com/recaptcha/api.js'></script>

  
</head>
<body class="">
<div id="top-navbar-container-base"><!-- The top main menu --></div>

