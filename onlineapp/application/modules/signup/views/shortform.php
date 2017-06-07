<div class="phub-modal">
      <div class="phub-modal-shadow">
      </div>
      <div class="phub-modal-window">
      <!--  <p class="phub-modal-msg" id="phub-modal-msg">This is an alert box!</p> -->
        <!--<input class="phub-modal-button" value="OK" type="button"> -->
      </div>
    </div>
    <div data-ng-app="phubapp" class="app ng-scope">
        
<section id="blue-container-login">
<div class="container">
      <div class="row">
      <div class="col-md-2"></div>
        <div class="col-md-8 margin-30">
           <div style="margin-top:60px;"></div>
           <h1 style="text-align:center">Register with us</h1>
           <p>&nbsp;</p>
             <div style="background:#fff; padding:20px 20px 20px 20px">
             <!-- content are start -->



<!-- inner content wrapper -->
<div class="short-form">
    <div class="row ng-scope" data-ng-controller="ShortFormCtrl">
        <div class="col-xs-12" > 
            <h3 class="f3_color text-center">Business Information</h3>
            <h5 class="f5_text text-center">Fill up your business information.</h5>
            <br>
            <!-- 
            <form role="form" name="phubfrm" action="<?php //echo base_url();?>signup/saveform" data-ng-class="{'form-submitted':submitted}" novalidate="" method="POST" class="ng-pristine ng-invalid ng-invalid-required ng-valid-maxlength">
             -->
            <?php echo form_open('signup/saveform', array('role'=>"form", 
            		'name'=>"phubfrm", 
            		'data-ng-class'=>"{'form-submitted':submitted}", 
            		'novalidate'=>"", 
            		'method'=>"POST", 
            		'class'=>"ng-pristine ng-invalid ng-invalid-required ng-valid-maxlength")); ?>
			
			<input name="sid" value="<?php echo $_GET['signupid'];?>" type="hidden">
            <input name="merchantFormId" value="" type="hidden">
            
			<input name="ownershipEmail" value="" type="hidden">
            <div class="panel">
                <div class="panel-body">
                	<div class="col-lg-6">
                        <div class="form-group">
	                            <label for="Industry">What is your Industry?</label>
				 	
	<select name="industryId" data-ng-model="frm.industryId" data-orig-val="" required="" class="inline_gapping form-control" >
			<option value="" selected="selected">--Select--</option>
			<?php
				$industry=$this->db->query("Select * from t_industry where status='Y'");
				foreach($industry->result() as $row){					
					?>
					<option value="<?php echo $row->industry;?>"><?php echo $row->industry;?></option>
			<?php
				}				
			?>
	</select>
   
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.industryId.$dirty) &amp;&amp; phubfrm.industryId.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
	         <input name="industryName" value="" type="hidden">                                          
	                        <!-- ngIf: frm.potentialType=='Merchant Processing (High Risk)' -->
	                        
	                        <!-- ngIf: frm.potentialType!='Merchant Processing (High Risk)' && frm.potentialType!='Cash Advance' && frm.potentialType!='Check Processing' --><span data-ng-if="frm.potentialType!='Merchant Processing (High Risk)' &amp;&amp; frm.potentialType!='Cash Advance' &amp;&amp; frm.potentialType!='Check Processing'" data-ng-hide="1==1" class="ng-scope ng-hide">
	                            <input data-ng-model="frm.epiId" value="NA" data-init-from-form="" name="epiId" class="ng-pristine ng-untouched ng-valid" type="hidden"> 
	                            <input name="submittedTo" id="submittedTo" value="NA" type="text">
	                        </span><!-- end ngIf: frm.potentialType!='Merchant Processing (High Risk)' && frm.potentialType!='Cash Advance' && frm.potentialType!='Check Processing' -->
	                        <!-- ngIf: frm.potentialType=='Cash Advance' -->
	                        
	                        <!-- ngIf: frm.potentialType=='Check Processing' -->
	                        
	                        </div>
                    
                        <div class="form-group">
                            <label for="locationTimezone">Where Are You Located?</label>
	<select name="locationTimezoneTemp" data-ng-model="frm.locationTimezone" data-orig-val="" data-init-from-form="" class="inline_gapping form-control ng-pristine ng-untouched ng-invalid ng-invalid-required" required="">
			<option value="" selected="selected">--Select--</option>
					<optgroup label="-------Domestic-------">
				<option value="United States - Pacific">United States - Pacific</option>
					<!--  : -------Domestic------- -->
				<option value="United States - Mountain">United States - Mountain</option>
					<!-- -------Domestic------- : -------Domestic------- -->
				<option value="United States - Central">United States - Central</option>
					<!-- -------Domestic------- : -------Domestic------- -->
				<option value="United States - Eastern">United States - Eastern</option>
					<!-- -------Domestic------- : -------Domestic------- -->
						</optgroup>
					<optgroup label="-------Non US-------">
				<option value="Canada">Canada</option>
					<!-- -------Domestic------- : -------Non US------- -->
				<option value="Other">Other</option>
					<!-- -------Non US------- : -------Non US------- -->
						</optgroup><!--For change -->
	</select>
	<input name="locationTimezone" value="" type="hidden">

		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.locationTimezoneTemp.$dirty) &amp;&amp; phubfrm.locationTimezoneTemp.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="potentialType">What Services are you interested in?</label>
	<select name="potentialType" data-ng-model="frm.potentialType" data-orig-val="" required="" class="inline_gapping form-control ng-pristine ng-untouched ng-invalid ng-invalid-required" data-init-from-form="">
			<option value="" selected="selected">--Select--</option>
			<option value="Merchant Processing (High Risk)">Merchant Processing</option>
			<option value="Cash Advance">Cash Advance</option>
			<option value="Check Processing">eCheck</option>
			<option value="Chargeback Shield">Chargeback Shield</option>
	</select>

		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.potentialType.$dirty) &amp;&amp; phubfrm.potentialType.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
                            <input name="formType" value="" type="hidden">                           
                        </div>
                        <div class="form-group">
                            <label for="company">Company Name</label>
                            
                            
                             
                             
                             
        <input class="inline_gapping form-control ng-pristine ng-untouched ng-invalid ng-invalid-required ng-valid-maxlength" required="" name="company" placeholder="Company Name" data-ng-model="frm.company" data-ng-pattern="/^[a-zA-Z\. ]+$/" data-init-from-form="" type="text">                  
        <ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.company.$dirty) &amp;&amp; phubfrm.company.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>						
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.company.$dirty) &amp;&amp; phubfrm.company.$error.pattern">
			<li class="parsley-required">Company Name should be valid!</li>
		</ul>
                            
                      
                            <input name="dbaName" value="" type="hidden">
                            <p class="help-block" style="font-size:14px;">Registered legal Business name or DBA</p>
                        </div>
	                       
	                   </div>
                       <div>
                            <div class="form-group">
                                <label for="freeTrialOffer" class="mr10">Do you sell your product or service using a free trial offer?</label>
                                
                                <input name="freeTrialOffer" required="" data-ng-model="frm.freeTrialOffer" data-ng-change="changedTrialOffer()" value="Y" data-orig-val="N" data-init-from-form="" class="ng-pristine ng-untouched ng-valid ng-valid-required" type="radio">
                                <label for="minimal-radio-1">Yes</label>
                                <input name="freeTrialOffer" required="" data-ng-model="frm.freeTrialOffer" data-ng-change="changedTrialOffer()" value="N" data-orig-val="N" data-init-from-form="" class="ng-pristine ng-untouched ng-valid ng-valid-required" checked="checked" type="radio">
                                <label for="minimal-radio-1">No</label>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.freeTrialOffer.$dirty) &amp;&amp; phubfrm.freeTrialOffer.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
                            </div>
                       </div>
                </div>
            </div>
           
        <input class="btn btn-success btn-lg btn-block" data-ng-click="submit(phubfrm)" value="Continue" type="button">
        <?php echo form_close(); ?>
    <!-- </form> -->    				
    <div class="clear"></div>			
	<!-- /inner content wrapper -->
	
	<!-- content are end -->
             </div>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
</section>
</div>                 

                
                
              