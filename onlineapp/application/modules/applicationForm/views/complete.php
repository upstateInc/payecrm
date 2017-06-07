<?php error_reporting(0); ?>
        <!-- /top header -->

        <section class="layout">

            <!-- main content -->
            <section class="main-content">

                <!-- content wrapper -->
                <div class="content-wrap">     

	<div class="wrapper">
		<div class="row">
			<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-10 col-md-offset-1">
			<h3 class="text-center">PayeHub Online Application Form</h3>
					<!--<h1 class="text-center styled animated bounceIn"><font color="#8cc252">Congratulations!</font></h3>-->
					<h5 class="text-center styled animated bounceIn">Congratulations!</h5>
					<br>
					<div id="wizard" class="wizard">
					    <ul class="">
					        		<li data-target="#" class="">
					        		<span class="badge bg-info"></span><a href="<?php echo base_url();?>applicationForm/business?signupid=<?php echo $this->input->get_post('signupid');?>">Business/Onwer Info</a>
					        		</li><li data-target="#" class="">
					        		<span class="badge bg-info"></span><a href="<?php echo base_url();?>applicationForm/billing?signupid=<?php echo $this->input->get_post('signupid');?>">Billing Information</a>
					        		</li><li data-target="#" class="">
					        		<span class="badge bg-info"></span><a href="<?php echo base_url();?>applicationForm/document?signupid=<?php echo $this->input->get_post('signupid');?>">Documentation</a>
					        		</li><li data-target="#" class="active">
					        		<span class="badge bg-info"></span>Completed
					    </li></ul>
				    
					<div class="actions btn-group">
					        <a class="btn btn-default btn-sm btn-next" href="<?php echo base_url();?>applicationForm/document?signupid=<?php echo $this->input->get_post('signupid');?>">
					           <!-- <i class="fa fa-angle-left"></i>--><<
					        </a>
					        
					       <a class="btn btn-default btn-sm btn-next" href="#">
					           <!-- <i class="fa fa-angle-right"></i>-->&nbsp;&nbsp;&nbsp;&nbsp;
					        </a> 
					    </div>
					</div>





<script type="text/javascript">
					merchantFormLocked = false;
</script>
<div class="merchantform phub-merchant-form " data-ng-app="phubapp">
	<div data-ng-controller="MerchantFormController" class="ng-scope">



 
	<div class="panel">
		<div class="panel-body text-center">
      <div class="col-md-8 col-md-offset-2 mt25">
        <h1 class="mt0 mb0">Application Complete</h3>
      </div>
      <div class="col-md-8 col-md-offset-2 mt25 mb25">
      
      
      <?php /* ?><img src="<?php echo base_url().'asset/complete.png';?>" height="50" width="50" alt="Completed"/><?php */ ?>
      <span class="ti-marked-check-box big-icon styled animated bounceIn animated-checkmark"><i class="fa fa-check-square-o" aria-hidden="true"></i></span>
     
      </div>
      <div class="col-md-8 col-md-offset-2 mb20 col-md-8 col-md-offset-2">
        <h3></h3><p> You've completed your application process successfully.Now we will take care of your application request.</p>
      </div>
      <div class="col-md-8 col-md-offset-2 mb10">
	  
	  <?php
	  $sid=$resultarray[0]['id'];
	  
	  ?>
	  
        <p>Have more questions? You can email us at <a href="mailto:support@themearmada.com"><i class="fa fa-envelope-o"></i> support@payehub.com</a>. You can review your application by clicking <a href="<?php echo base_url();?>applicationForm/business?signupid=<?php echo $sid;?>"><font color="#67A2C8">here</font>.</a></p>
      </div>
    <div class="col-md-8 col-md-offset-2 mb10">
        <!--  <p>If you've got time, why not head over to our site and take a 
look at some of the other services we offer our merchants! Need working 
capital? Want to accept checks digitally and have funds transferred to 
you as early as the next day? Do you need Chargeback Prevention and 
Protection? This is just some of what we offer.</p>-->
        <a href="http://www.payehub.com/" class="btn btn-lg btn-success btn-block mb10 mt10">Continue to payehub.com</a>
      </div>
		</div>
	</div>	</div>
</div> 
 				