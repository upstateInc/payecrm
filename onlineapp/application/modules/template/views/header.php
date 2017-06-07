<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}</style>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>PayeHub Payment Application</title>

    <link rel="icon" type="image/png" href="http://www.payehub.com/connect/img/favicon.png"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/bootstrap.css" type="text/css">
	  		<!--link rel="stylesheet" href="<?php echo base_url();?>asset/font-awesome.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/themify-icons.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/animate.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/jquery-ui.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/chosen.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/palette.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/font.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/main.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/short-form.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/toastr_002.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/dropzone.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/toastr.css" type="text/css"-->
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/main.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/phubfront.css" type="text/css">
      		<link rel="stylesheet" href="<?php echo base_url();?>asset/agent.css" type="text/css">
	
	
			<script async src="<?php echo base_url();?>asset/analytics.js"></script>
        	<script type="text/javascript" src="<?php echo base_url();?>asset/jquery-1.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/jquery-ui.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/bootstrap.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/getDependentDropdownValues.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/moment.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/moment-timezone-with-data.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/angular.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/ui-utils.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/angular-moment.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/jquery.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/jquery_003.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/jquery_004.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/jquery_002.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/fastclick.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/toastr.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/chosen.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/selectall.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/phubangular.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/phubangularcommon.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>asset/functions.js"></script>
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
  </script>
  <script src="<?php echo base_url();?>asset/2106540060.js"></script>
  
  <style>
  
  </style>
</head>


<body class="short-form phub-theme">


    <div class="phub-modal">
      <div class="phub-modal-shadow">
      </div>
      <div class="phub-modal-window">
      <!--  <p class="phub-modal-msg" id="phub-modal-msg">This is an alert box!</p> -->
        <!--<input class="phub-modal-button" value="OK" type="button"> -->
      </div>
    </div>
    <div data-ng-app="phubapp" class="app ng-scope">
        <!-- top header -->
        
        
        <header class="header header-fixed navbar">

          <div class="brand">

                <!-- logo -->
                  <a href="<?php echo base_url();?>signup/" class="navbar-brand">
                  	<img src="http://payehub.com/img/logo.png" alt="phub "> 
					
	                    <span class="heading-font">
	                       
	                    </span>
                  </a>
                <!-- /logo -->
            </div> 

            <ul class="nav navbar-nav navbar-right">
                
                <li data-ng-class="{'off-right':1,'open':opensignin==1}" class="off-right">
                    <a href="#signin-link" data-ng-init="opensignin=0" data-ng-click="opensignin=1-opensignin" data-toggle="collapse">
                <img src="<?php echo base_url();?>asset/faceless.jpg" class="header-avatar img-circle" alt="user" title="user"> 
							<span class="hidden-xs ml10">Option</span>	
                      <i class="fa fa-caret-down" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight">
                        	<li><?php if($this->session->userdata('loggedInEmail')){?>
							<a href="<?php echo base_url();?>login/logout">Logout (<?php echo $this->session->userdata('loggedInEmail');?>)</a><?php } else {?><a href="<?php echo base_url();?>login">Login</a><?php } ?></li>
                        <?php if($this->session->userdata('loggedInEmail')){?>
                        <li><a href="<?php echo base_url();?>applicationForm/details_view">My Application</a></li>
                        
                        	<?php } ?>
                    </ul>
                </li>
                
                
            </ul>

        </header> 
           
        <!-- /top header -->
