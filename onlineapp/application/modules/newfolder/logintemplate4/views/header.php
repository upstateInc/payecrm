<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}</style>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>PayeHub Payment Application </title>

        <script async="" src="<?php echo base_url();?>asset/analytics.js"></script><script type="text/javascript" src="<?php echo base_url();?>asset/jquery-1.js"></script>
    <link rel="icon" type="image/png" href="http://www.payehub.com/connect/img/favicon.png"/>
  
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/toastr.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/bootstrap.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/font-awesome.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/themify-icons.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/animate.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/jquery-ui.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/palette.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/font.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/main.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/short-form.css" type="text/css">
	  		<link rel="stylesheet" href="<?php echo base_url();?>asset/phubfront.css" type="text/css">
  
     <link rel="stylesheet" href="<?php echo base_url();?>asset/agent.css" type="text/css">
	
	
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
  
  
    <? if($_SERVER['PHP_SELF']=="/index.php"){ ?>
	<title>Payehub offers the best merchant account for your business</title>
	<meta name="description" content="Payehub is a merchant account service that provides echeck payment processing solutions to all high risk internet retail merchants. Various ecommerce services are opting for merchant accounts with us.">
	<meta name="description" content="">
	
  <? } else if($_SERVER['PHP_SELF']=="/ach-merchant-account-providers.php"){?>
	<title>Payehub provides an Ach merchant account to help companies transact business</title>
    <meta name="description" content="Payehub provides ACH merchant accounts to various companies for taking payments through e-checks and process them.It even enables them to process financial transactions of various forms.">
	
  <? } else if($_SERVER['PHP_SELF']=="/adult-merchant-account.php"){?>
	<title>Payehub offers Adult Merchant Accounts to run adult entertainment smoothly</title>
    <meta name="description" content="Payehub gives you more confidence to run your adult entertainment business by providing an Adult Merchant Account.It makes things easier to process much higher fees">
    
    <? } else if($_SERVER['PHP_SELF']=="/merchant-credit-card-chargeback.php"){?>
	<title>Payehub shares vital information on merchant credit card chargeback</title>
    <meta name="description" content="Payehub teaches a business owner to utilize a merchant account in protecting the image of his business. A merchant credit card chargeback is treated as fraudulent.">
    
    <? } else if($_SERVER['PHP_SELF']=="/online-credit-card-processing.php"){?>
	<title>Payehub understands the true necessity of Online credit card processing</title>
    <meta name="description" content="Payehub shows the need for online credit card processing as businesses are trying to receive secure payments. Processing such payments saves time.">
    
    <? } else if($_SERVER['PHP_SELF']=="/credit-repair-service-providers.php"){?>
	<title>Payehub renders quality services towards credit repair service providers</title>
    <meta name="description" content="Payehub helps credit repair service providers with a merchant account. We understand the challenges they face with transactions worth huge amounts involving borrowers and lenders.">
    
    <? } else if($_SERVER['PHP_SELF']=="/e-cigarette-merchant-accounts-services.php"){?>
	<title>Payehub E-Cigarette Merchant Account Services are a must for cigarette makers</title>
    <meta name="description" content="Payehub provides E-cigarette Merchant Account Services to e-cig manufacturers. These accounts help them process business transactions more smoothly and accurately.">
    
    <? } else if($_SERVER['PHP_SELF']=="/ecommerce-merchant-account-providers.php"){?>
	<title>Payehub Ecommerce merchant account providers help numerous trading platforms</title>
    <meta name="description" content="Payehub is one of the ecommerce merchant account providers that support multiple trading platforms process financial transactions in bulk. These providers contribute much towards ensuring a better service to the end user.">
    
    <? } else if($_SERVER['PHP_SELF']=="/high-risk-merchant-account-providers.php"){?>
	<title>Payehub high risk merchant account providers ensure safe and secured transactions</title>
    <meta name="description" content="Payehub serves eminent businesses as high risk merchant account providers.  Such accounts help reduce the amount of financial risks carried by a business.">
    
    <? } else if($_SERVER['PHP_SELF']=="/international-merchant-account-providers.php"){?>
	<title>Payehub international merchant account providers serve a much broader clientele</title>
    <meta name="description" content="Payehub is one of the rare international merchant account providers that assist global clients. International merchant accounts help these businesses cater to the needs of a much broader clientele.">
    
    <? } else if($_SERVER['PHP_SELF']=="/low-risk-merchant-account-providers.php"){?>
	<title>Payehub is among the best low risk merchant account providers</title>
    <meta name="description" content="Payehub is among low risk merchant account providers that help reduce risks concerning a wide variety of businesses. Most of the merchants are opting for these accounts to cope with payments bearing risks.">
    
    <? } else if($_SERVER['PHP_SELF']=="/merchant-account-service-provider.php"){?>
	<title>Payehub is an effective merchant account service provider</title>
    <meta name="description" content="Payehub acts as a merchant account service provider that caters to most of our modern trading needs. They would help protect the financial security of a business while processing their payments.">
    
    <? } else if($_SERVER['PHP_SELF']=="/best-online-pharmacy-merchant-accounts.php"){?>
	<title>Payehub develops the best online pharmacy merchant accounts</title>
    <meta name="description" content="Payehub is known for providing the best online Pharmacy Merchant Accounts to Pharmacies. These accounts help pharmacies accept payments online and protect their business transactions.">
    
    <? } else if($_SERVER['PHP_SELF']=="/tobacco-merchant-account-service-provider.php"){?>
	<title>Payehub is an efficient tobacco merchant account service provider</title>
    <meta name="description" content="Payehub acts as a tobacco merchant account service provider offering unique benefits to tobacco merchants. Merchant accounts have made it easier to process payments in multiple currencies online.">
    
    <? } else if($_SERVER['PHP_SELF']=="/travel-merchant-account-service-provider.php"){?>
	<title>Payehub yields great service as a travel merchant account service provider</title>
    <meta name="description" content="Payehub has gained much popularity as a travel merchant account service provider of late. Merchants opting for our travel merchant accounts have witnessed an increase in sales volume all of a sudden.">
    
    <? } else if($_SERVER['PHP_SELF']=="/telemarketing-merchant-account-service.php"){?>
	<title>Payehub provides an efficient telemarketing merchant account service</title>
    <meta name="description" content="Payehub enables telemarketing merchants to receive credit card transactions over the phone and online. All we need is a good credit card history to provide you with an account.">
    
    <? } else if($_SERVER['PHP_SELF']=="/prepaid-credit-cards-merchant-account.php"){?>
	<title>A Payehub prepaid credit cards merchant account yields flexible options</title>
    <meta name="description" content="Your prepaid credit cards merchant account with Payehub helps you cope with multiple currencies at once. Opting for this account helps in expanding your business pretty quickly.">
    
    <? } else if($_SERVER['PHP_SELF']=="/retail-merchant-accounts-service-provider.php"){?>
	<title>Payehub is an advanced retail merchant accounts service provider</title>
    <meta name="description" content="Payehub has included specific features in their retail merchant accounts to turn retail trade smoother. Retailers of different sorts can now call upon this retail merchant accounts service provider.">
    
    <? } else if($_SERVER['PHP_SELF']=="/best-tech-support-merchant-account-providers.php"){?>
	<title>Payehub is one of the best tech support merchant account providers</title>
    <meta name="description" content="Payehub assists tech support companies with an efficient merchant account. By registering with the best tech support merchant account providers you may avail the benefits.">
    
    <? } else if($_SERVER['PHP_SELF']=="/echeck.php"){?>
	<title>Payehub echeck processing helps improve the old payment mechanism</title>
    <meta name="description" content="Payehub provides merchants with a non-cash payment option via echecks. These echecks help you perform bank transactions with ease and security.">
    
    <? } else if($_SERVER['PHP_SELF']=="/about.php"){?>
	<title>Payehub yields credible payment processing solutions for the modern day merchants</title>
    <meta name="description" content="Payehub provides an advanced card processing solution to global merchants. A wide network of banking partners helps our clients to accept payments in multiple currencies from their customers.">
    
    <? } else if($_SERVER['PHP_SELF']=="/controlcb.php"){?>
	<title>Payehub provides chargeback abatement under ControlCB</title>
    <meta name="description" content="Payehub helps numerous global merchants with chargeback abatement services through ControlCB. Apart from controlling chargebacks, our professionals even help in preventing frauds.">
    
    <? } else if($_SERVER['PHP_SELF']=="/currency-exchange-service-providers.php"){?>
	<title>Payehub provides Currency Exchange Accounts to high risk merchants</title>
    <meta name="description" content="Payehub understands the rules governing currency exchange accounts. We provide high-risk merchants with currency exchange accounts to process credit card payments more flexibly.">
    
    <? } else if($_SERVER['PHP_SELF']=="/debt-collection-agency.php"){?>
	<title>Payehub assists debt collection agencies in accepting payments on delinquent accounts</title>
    <meta name="description" content="Payehub understands the stress involved in collecting debts and interacting with borrowers. Payehub assists debt collection agencies in transacting business with flexible payments.">
    
    <? } else if($_SERVER['PHP_SELF']=="/subscription.php"){?>
	<title>Payehub subscription merchant accounts ensure a secured payment gateway</title>
    <meta name="description" content="Payehub has strengthened its ecommerce clientele by providing them with subscription merchant accounts that yield a reliable credit card processing solution.">
    
    <? } else if($_SERVER['PHP_SELF']=="/partners.php"){?>
	<title>Payehub helps in protection and expansion of business</title>
    <meta name="description" content="Payehub helps in business expansion by offering a referral program. This program ensures protection of your accounts in the long run.">
    
    <? } else if($_SERVER['PHP_SELF']=="/security.php"){?>
	<title>Payehub utilizes reserve to curb financial risks</title>
    <meta name="description" content="Payehub provides a high risk merchant reserve to counter unforeseen financial risks. These funds help balance charge-backs and other losses.">
    
    <? } else if($_SERVER['PHP_SELF']=="/privacy-policy.php"){?>
	<title>Payehub follows a stringent privacy policy for better services</title>
    <meta name="description" content="Payehub.com builds confidence and trust of users by following our specific privacy policy. We urge users to abide by the terms of this policy.">
    
    
	
  <? }else{ ?>
  <title>PayeHub</title>
  <? } ?>
  
  <link rel="icon" type="image/png" href="img/favicon.png"/>
  
  
  

  <!-- Styles -->
  <link rel="stylesheet" href="css/jquery.bxslider.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
  

 	<link rel="stylesheet" href="css/bootstrap.min.css">
  	<link rel="stylesheet" href="css/main.css">
  	<link rel="stylesheet" href="css/custom-styles.css">
	<link href="datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

  
  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../../apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../../apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../../apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="../../apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="../../favicon.php">
  
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68172138-1', 'auto');
  ga('send', 'pageview');

</script>
  
  
  
</head>

