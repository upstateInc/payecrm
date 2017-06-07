<?php error_reporting(0); ?>
        <section class="layout">


<style>

@media print {
  a[href]:after {
    content: none !important;
  }
  
.wizard
    {
        display: none !important;
    }
	 #dontdisplayit
{
 display: block !important;
}

tr
{
spacing:6px;
}

td
{
padding:6px;
}
#notice
{
   display: none !important;
}
 .merchantform 
    {
        display: none !important;
    }
}

</style>

            <!-- main content -->
            <section class="main-content">

                <!-- content wrapper -->
                <div class="content-wrap">     

	<div class="wrapper">
		<div class="row">
			<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-10 col-md-offset-1">
					<h3 class="text-center">PayeHub Online Application Form</h3>
					<h5 id="notice" class="text-center">Take your few minutes to fill up all the fields below.</h5>
					<br>
					<div id="wizard" class="wizard">
					    <ul class="steps">
					        		<li data-target="#step1" class="">
					        		<span class="badge bg-info"></span><a href="<?php echo base_url();?>applicationForm/business?signupid=<?php echo $this->input->get('signupid');?>">Business/Onwer Info</a>
					        		</li><li data-target="#step2" class="active">
					        		<span class="badge bg-info"></span>Billing Information
					        		</li><li data-target="#step4" class="">
					        		<span class="badge bg-info"></span><a href="<?php echo base_url();?>applicationForm/document?signupid=<?php echo $this->input->get('signupid');?>">Documentation</a>
					        		</li><li data-target="#step5" class="">
					        		<span class="badge bg-info"></span><a href="<?php echo base_url();?>applicationForm/complete?signupid=<?php echo $this->input->get('signupid');?>">Completed</a>
					    </li></ul>
					    
					    
					 
				 
				    
					   <div class="actions btn-group">
					    <a class="btn btn-default btn-sm btn-next" href="//pdfcrowd.com/url_to_pdf/?use_print_media=1&pdf_name=Billing" >
					          Save as PDF<!-- <i class="fa fa-angle-left"></i>-->
					        </a>
					 
					   <a class="btn btn-default btn-sm btn-next" onclick="window.print();" >
					           Print<!-- <i class="fa fa-angle-left"></i>-->
					        </a>
					          
					       
					   
					  
					   
					        <a class="btn btn-default btn-sm btn-next" href="<?php echo base_url();?>applicationForm/business?signupid=<?php echo $this->input->get('signupid');?>">
					           <<<!-- <i class="fa fa-angle-left"></i>-->
					        </a>
					        
					        <a class="btn btn-default btn-sm btn-next" href="<?php echo base_url();?>applicationForm/document?signupid=<?php echo $this->input->get('signupid');?>">
					           <!-- <i class="fa fa-angle-right"></i>-->>>
					        </a>
					    </div> 
					</div>





<script type="text/javascript">
	merchantFormLocked = false;
</script>
<div class="merchantform phub-merchant-form " data-ng-app="phubapp">
	<div data-ng-controller="MerchantFormController" class="ng-scope">



<!-- form name="phubfrm" role="form" class="phub-merchant-form ng-pristine ng-valid-maxlength  ng-invalid-required ng-valid-mask ng-valid-email" method="post" action="<?php //echo base_url();?>" novalidate="" data-ng-class="{'form-submitted':submitted}" -->

<?php echo form_open('applicationForm/savebilling', array('name'=>"phubfrm", 'role'=>"form", 'class'=>"phub-merchant-form ng-pristine ng-valid-maxlength  ng-invalid-required ng-valid-mask ng-valid-email", 'method'=>"post", 'novalidate'=>"", 'data-ng-class'=>"{'form-submitted':submitted}")); ?>
	<input name="sid" class="phub-merchant-form-na" value="<?php echo $_GET['signupid'];?>" type="hidden">
	<input name="agentId" class="phub-merchant-form-na" value="0001" type="hidden">
		<input name="stage" value="Pre-Underwriting - Scrubbing" type="hidden">
		<input name="wasInPreUWScrubbingStage" value="Y" type="hidden">
		<input name="step" class="phub-merchant-form-na" value="step4" type="hidden">
	<div class="panel">
	    <header class="panel-heading">Designated Administrator</header>
	    <div class="panel-body">       
			  <div class="col-lg-6">
                <div class="form-group">
                    <label for="nameOfPrimaryContact1">First Name</label>
                  <?php echo $resultarrayb[0]['name1'];?>                  
                  <input class="form-control ng-pristine ng-untouched ng-valid-email  ng-invalid-required" placeholder="First Name" required="" data-ng-pattern="/^[a-zA-Z ]+$/" data-ng-model="frm.nameOfPrimaryContact1" name="nameOfPrimaryContact1" data-init-from-form="" value="<?php echo $resultarray[0]['name1'];?>" type="text">
                  
                  
							
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.nameOfPrimaryContact1.$dirty) &amp;&amp; phubfrm.nameOfPrimaryContact1.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
						
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.nameOfPrimaryContact1.$dirty) &amp;&amp; phubfrm.nameOfPrimaryContact1.$error.pattern">
			<li class="parsley-required">Name should be valid!</li>
		</ul>
						
					</div>
                </div>
           
<div class="col-lg-6">
                <div class="form-group">
                    <label for="nameOfPrimaryContact2">Last Name</label>
                  
                  
                   <input class="form-control ng-pristine ng-untouched ng-valid-email  ng-invalid-required" placeholder="Last Name" required="" data-ng-pattern="/^[a-zA-Z\. ]+$/" data-ng-model="frm.nameOfPrimaryContact2" name="nameOfPrimaryContact2" data-init-from-form="" value="<?php echo $resultarray[0]['name2'];?>" type="text">
                  		
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.nameOfPrimaryContact2.$dirty) &amp;&amp; phubfrm.nameOfPrimaryContact2.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
					
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.nameOfPrimaryContact2.$dirty) &amp;&amp; phubfrm.nameOfPrimaryContact2.$error.pattern">
			<li class="parsley-required">Name should be valid!</li>
		</ul>
						
					</div>
                </div>
			
	        <div class="col-lg-6">
	            <div class="form-group">
	                <label for="ownershipTitle">Title</label>
	                <div>
	                    <input class="form-control input-lg ng-pristine ng-untouched  ng-invalid-required ng-valid-maxlength" required="" data-ng-pattern="/^[a-zA-Z ]+$/" name="ownershipTitle" data-ng-model="frm.ownershipTitle" placeholder="Executive Officer,Managing Director etc." value="<?php echo $resultarray[0]['title'];?>" data-ng-maxlength="100" data-init-from-form="" type="text" >
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipTitle.$dirty) &amp;&amp; phubfrm.ownershipTitle.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipTitle.$dirty) &amp;&amp; phubfrm.ownershipTitle.$error.maxlength">
			<li class="parsley-required">Too long</li>
		</ul>
		
		
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipTitle.$dirty) &amp;&amp; phubfrm.ownershipTitle.$error.pattern">
			<li class="parsley-required">Enter valid title!</li>
		</ul>
	                </div>
	            </div>
	        </div>
	
	
	        <div class="col-lg-6">
	            <div class="form-group">
	                <label>Phone</label>
	                <input name="primaryCellPhoneTemp" required="" data-ng-model="frm.primaryCellPhone" class="form-control input-lg ng-pristine ng-untouched ng-valid ng-valid-mask ng-valid-required" value="<?php echo $resultarray[0]['phone'];?>" data-ui-mask="(999)-999-9999" data-init-from-form="" placeholder="(___)-___-____" type="text">
					 
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.primaryCellPhoneTemp.$dirty) &amp;&amp; phubfrm.primaryCellPhoneTemp.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
	            </div>
	        </div>
	        <div class="col-lg-6">
	            <div class="form-group">
	                <label for="businessEmail">Email</label>
	                <input required="" class="form-control input-lg ng-pristine ng-untouched ng-valid ng-valid-email ng-valid-required" name="businessEmail"  data-ng-model="frm.businessEmail" data-ng-pattern="/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,64}$/" placeholder="valid@email.com" value="<?php echo $resultarray[0]['email'];?>" data-init-from-form="" type="text">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessEmail.$dirty) &amp;&amp; phubfrm.businessEmail.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessEmail.$dirty) &amp;&amp; phubfrm.businessEmail.$error.pattern">
			<li class="parsley-required">Enter valid email</li>
		</ul>
	            </div>
	        </div> 
	
	    </div>
	    
	</div>
	
	<div class="panel">
	    <header class="panel-heading">Bank Account Info (required)</header>
	    <div class="panel-body">
	
	        <div class="col-lg-6">
	            <div class="form-group">
	                <label for="bankName">Banking Institution Name</label>
	                <div>
	                    <input name="bankName" data-ng-model="frm.bankName" required="" data-ng-pattern="/^[a-zA-Z ]+$/" class="form-control input-lg ng-pristine ng-untouched  ng-invalid-required ng-valid-maxlength" placeholder="Bank of America etc." value="<?php echo $resultarray[0]['bankName'];?>" data-ng-maxlength="100" data-init-from-form="" type="text">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.bankName.$dirty) &amp;&amp; phubfrm.bankName.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.bankName.$dirty) &amp;&amp; phubfrm.bankName.$error.maxlength">
			<li class="parsley-required">Too long</li>
		</ul>
		
		
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.bankName.$dirty) &amp;&amp; phubfrm.bankName.$error.pattern">
			<li class="parsley-required">Enter valid Banking Institution Name!</li>
		</ul>
	                </div>
	            </div>
	        </div>
	       
	        <div class="col-lg-6">
	            <div class="form-group">
	                <label for="transitRoutingNo">Routing Number</label>
	                <input name="transitRoutingNoTemp" required="" data-ng-model="ca.transitRoutingNo" class="form-control input-lg ng-pristine ng-untouched ng-valid-mask  ng-invalid-required" data-ui-mask="999999999" value="<?php echo $resultarray[0]['routingNo'];?>" data-init-from-form="" placeholder="_________" type="text">
					
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.transitRoutingNoTemp.$dirty) &amp;&amp; phubfrm.transitRoutingNoTemp.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
	            </div>
	        </div>
	        <br> 
	        <div class="col-lg-6">
	            <div class="form-group">
	            
	            
	            
	            <label for="accountNo">Account Number</label>
	             <input name="accountNo" required="" data-ng-model="frm.accountNo" class="form-control input-lg ng-pristine ng-untouched  ng-invalid-required ng-valid-maxlength" value="<?php echo $resultarray[0]['accountNo'];?>" placeholder="Account Number" data-ng-minlength="4" data-ng-maxlength="17"  data-init-from-form="" step="any" type="number">
	            
	            
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.accountNo.$dirty) &amp;&amp; phubfrm.accountNo.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.accountNo.$dirty) &amp;&amp; phubfrm.accountNo.$error.minlength">
			<li class="parsley-required">Enter valid account number!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.accountNo.$dirty) &amp;&amp; phubfrm.accountNo.$error.maxlength">
			<li class="parsley-required">Enter valid account number!</li>
		</ul>
	            
	            
	            
	            
	            <?php /* ?>  <!--  <label for="accountNo">Account Number</label>
	                <input name="accountNo" required="" data-ng-model="frm.accountNo" class="form-control input-lg ng-pristine ng-untouched  ng-invalid-required ng-valid-maxlength" value="<?php echo $resultarray[0]['accountNo'];?>" placeholder="0000000000" data-ng-maxlength="100" data-init-from-form="" step="any" type="number">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.accountNo.$dirty) &amp;&amp; phubfrm.accountNo.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.accountNo.$dirty) &amp;&amp; phubfrm.accountNo.$error.number">
			<li class="parsley-required">Numeric value required</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.transitRoutingNo.$dirty) &amp;&amp; phubfrm.transitRoutingNo.$error.maxlength">
			<li class="parsley-required">Too long</li>
		</ul>--><?php */ ?>
	            </div>
	        </div>
	    </div>
	</div>    
	<input class="btn btn-success btn-lg btn-block phub-merchant-form-na" data-ng-click="submit(phubfrm)" value="Continue" type="button">
<!--  </form> -->

<?php echo form_close(); ?>
	</div>
</div>    				<div class="clear"></div>			
                            
                    <!-- /inner content wrapper -->
<div id="dontdisplayit" style="display:none">
<img src="http://www.payecrm.com/build/images/logo.png" />
<div class="panel">
	    <header class="panel-heading">Designated Administrator</header>
	    <div class="panel-body">
	
	       
	       
	       
	        <table>
    <tr>
    <td><b>First Name:</b></td><td><?php echo $resultarray[0]['name1'];?></td>
    </tr>
     <tr>
     <td><b>Last Name:</b></td><td><?php echo $resultarray[0]['name2'];?></td>
    </tr>
     <tr>
    <td><b>Title:</b></td><td><?php echo $resultarray[0]['title'];?></td>
    </tr>
     <tr>
    <td><b>Phone:</b></td><td><?php echo $resultarray[0]['phone'];?></td>
    </tr>
    <tr>
    <td><b>Email:</b></td><td><?php echo $resultarray[0]['email'];?></td>
    </tr>
         </table>
	         </div>
	    
	</div>
	
	<div class="panel">
	    <header class="panel-heading">Bank Account Info (required)</header>
	    <div class="panel-body">
	
	
	
	
	      <table>
    <tr>
    <td><b>Banking Institution Name:</b></td><td><?php echo $resultarray[0]['bankName'];?></td>
    </tr>
     <tr>
     <td><b>Routing Number:</b></td><td><?php echo $resultarray[0]['routingNo'];?></td>
    </tr>
     <tr>
    <td><b>Account Number:</b></td><td><?php echo $resultarray[0]['accountNo'];?></td>
    </tr>
     
         </table>
	       
	    </div>
	    
	</div>                                     
    
    
    
    
    
</div>
