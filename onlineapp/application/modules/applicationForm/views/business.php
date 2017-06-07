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
   .merchantform 
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
					        		<li data-target="#step1" class="active">
					        		<span class="badge bg-info"></span>Business/Onwer Info
					        		</li><li data-target="#step2" class="">
					        		<span class="badge bg-info"></span><a href="<?php echo base_url();?>applicationForm/billing?signupid=<?php echo $this->input->get('signupid');?>">Billing Information</a>
					        		</li><li data-target="#step4" class="">
					        		<span class="badge bg-info"></span><a href="<?php echo base_url();?>applicationForm/document?signupid=<?php echo $this->input->get('signupid');?>">Documentation</a>
					        		</li><li data-target="#step5" class="">
					        		<span class="badge bg-info"></span><a href="<?php echo base_url();?>applicationForm/complete?signupid=<?php echo $this->input->get('signupid');?>">Completed</a>
					    </li></ul>
				     

        
 
					   <div class="actions btn-group">
					    <a class="btn btn-default btn-sm btn-next" href="//pdfcrowd.com/url_to_pdf/?use_print_media=1&pdf_name=Business">
					          Save as PDF<!-- <i class="fa fa-angle-left"></i>-->
					        </a>
					    <a class="btn btn-default btn-sm btn-next" onclick="window.print();" >
					           Print<!-- <i class="fa fa-angle-left"></i>-->
					        </a>
					  
					        <a class="btn btn-default btn-sm btn-next" href="">
					           <!-- <i class="fa fa-angle-left"></i> -->&nbsp;&nbsp;&nbsp;&nbsp;
					        </a>
					        
					        
					        
					        
					        
					        <a class="btn btn-default btn-sm btn-next" href="<?php echo base_url();?>applicationForm/billing?signupid=<?php echo $this->input->get('signupid');?>">
					           <!-- <i class="fa fa-angle-right"></i> -->>>
					        </a>
					    </div>
					</div>

<script type="text/javascript">
	merchantFormLocked = false;
</script>
<div class="merchantform phub-merchant-form " data-ng-app="phubapp">
	<div data-ng-controller="MerchantFormController" class="ng-scope">

<?php //echo $_SESSION['hi']; 
echo $this->session->userdata('hi');?>

<!-- 
<form name="phubfrm" role="form" class="phub-merchant-form ng-pristine ng-valid-full-name-split  ng-invalid-required ng-valid-maxlength ng-valid-mask ng-valid-email" method="post" action="<?php //echo base_url();?>applicationForm/savebusiness" novalidate="" data-ng-class="{'form-submitted':submitted}">
 -->

<?php echo form_open('applicationForm/savebusiness', array('name'=>"phubfrm", 
		'role'=>"form", 
		'class'=>"phub-merchant-form ng-pristine ng-valid-full-name-split  ng-invalid-required ng-valid-maxlength ng-valid-mask ng-valid-email", 
		'method'=>"post", 
		'novalidate'=>"",
		'data-ng-class'=>"{'form-submitted':submitted}") ); ?>
    <input name="sid" class="phub-merchant-form-na" value="<?php if($this->input->get('signupid')!="") echo $this->input->get('signupid'); else echo "10";?>" type="hidden">
    
    
    <input name="cid" class="phub-merchant-form-na" value="<?php if($this->input->get('signupid')!="") echo $resultarray[0]['id']; else echo "10";?>" type="hidden">
    
    
    
	<input name="merchantFormId" class="phub-merchant-form-na" value="257112" type="hidden">
	<input name="agentId" class="phub-merchant-form-na" value="0001" type="hidden">
	
    <div class="panel clearfix">
        <header class="panel-heading">General Business Information</header>
        <div class="panel-body">
    
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="businessName">Legal Business Name</label>
                    <input class="form-control input-lg ng-pristine ng-untouched  ng-invalid-required ng-valid-maxlength" name="businessName" required="" data-ng-model="frm.businessName" value="<?php echo $resultarray[0]['businessName'];?>" placeholder="Your Business Name" data-ng-maxlength="100" data-init-from-form="" type="text">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessName.$dirty) &amp;&amp; phubfrm.businessName.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessName.$dirty) &amp;&amp; phubfrm.businessName.$error.maxlength">
			<li class="parsley-required">Too long</li> 
		</ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="dbaName">Company Trade Name (DBA)</label>
                    <div>
                        <input name="dbaName" required="" class="form-control input-lg ng-pristine ng-untouched ng-valid ng-valid-required ng-valid-maxlength" placeholder="Doing Business As" data-ng-model="frm.dbaName" data-ng-maxlength="150" value="<?php echo $resultarray[0]['tradeName'];?>" data-init-from-form="" type="text">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.dbaName.$dirty) &amp;&amp; phubfrm.dbaName.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.dbaName.$dirty) &amp;&amp; phubfrm.dbaName.$error.maxlength">
			<li class="parsley-required">Too long</li>
		</ul>
                    </div>
					
                </div>
            </div>
            <div class="col-lg-6">
                   
                        <label>Business Type</label>
	<select name="businessType" data-ng-model="frm.businessType" data-orig-val="" data-init-from-form="" class="form-control mb10 ng-pristine ng-untouched  ng-invalid-required" required="">
			<option value="" <?php if($resultarray[0]['businessType']=="") echo "selected";?>>---Select---</option>
			<option value="Sole Proprietor" <?php if($resultarray[0]['businessType']=="Sole Proprietor") echo "selected";?> >Sole Proprietor</option>
			<option value="Partnership General/Limited" <?php if($resultarray[0]['businessType']=="Partnership General/Limited") echo "selected";?>>Partnership General/Limited</option>
			<option value="Corporation" <?php if($resultarray[0]['businessType']=="Corporation") echo "selected";?>>Corporation</option>
			<option value="Limited Liability Corp" <?php if($resultarray[0]['businessType']=="Limited Liability Corp") echo "selected";?>>Limited Liability Corp</option>
			<option value="Other" <?php if($resultarray[0]['businessType']=="Other") echo "selected";?>>Other</option>
	</select>

		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessType.$dirty) &amp;&amp; phubfrm.businessType.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
						
                   
            </div>
            
            
            
            
             <div class="col-lg-6">
                <label>State of Incorporation</label>
	<select name="incorporatedStateTemp" data-ng-model="frm.incorporatedState" data-orig-val="" data-init-from-form="" class="form-control mb10 ng-pristine ng-untouched  ng-invalid-required" required="">
			<option value="<?php 
			if($resultarray[0]['corpState']=="") 
				echo ""; 
			else 
				echo $resultarray[0]['corpState'];?>"><?php 
			if($resultarray[0]['corpState']=="") 
				echo "--select--"; 
			else echo $resultarray[0]['corpState'];?></option>
				<option value="Armed Forces Americas">Armed Forces Americas</option>
				<option value="Armed Forces Europe">Armed Forces Europe</option>
				<option value="Alaska">Alaska</option>
				<option value="Alabama">Alabama</option>
				<option value="Armed Forces Pacific">Armed Forces Pacific</option>
				<option value="Arkansas">Arkansas</option>
				<option value="Arizona">Arizona</option>
				<option value="California">California</option>
				<option value="Colorado">Colorado</option>
				<option value="Connecticut">Connecticut</option>
				<option value="District of Columbia">District of Columbia</option>
				<option value="Delaware">Delaware</option>
				<option value="Florida">Florida</option>
				<option value="Georgia">Georgia</option>
				<option value="Guam">Guam</option>
				<option value="Hawaii">Hawaii</option>
				<option value="Iowa">Iowa</option>
				<option value="Idaho">Idaho</option>
				<option value="Illinois">Illinois</option>
				<option value="Indiana">Indiana</option>
				<option value="Kansas">Kansas</option>
				<option value="Kentucky">Kentucky</option>
				<option value="Louisiana">Louisiana</option>
				<option value="Massachusetts">Massachusetts</option>
				<option value="Maryland">Maryland</option>
				<option value="Maine">Maine</option>
				<option value="Michigan">Michigan</option>
				<option value="Minnesota">Minnesota</option>
				<option value="Missouri">Missouri</option>
				<option value="Mississippi">Mississippi</option>
				<option value="Montana">Montana</option>
				<option value="North Carolina">North Carolina</option>
				<option value="North Dakota">North Dakota</option>
				<option value="Nebraska">Nebraska</option>
				<option value="New Hampshire">New Hampshire</option>
				<option value="New Jersey">New Jersey</option>
				<option value="New Mexico">New Mexico</option>
				<option value="Nevada">Nevada</option>
				<option value="New York">New York</option>
				<option value="Ohio">Ohio</option>
				<option value="Oklahoma">Oklahoma</option>
				<option value="Oregon">Oregon</option>
				<option value="Pennsylvania">Pennsylvania</option>
				<option value="Puerto Rico">Puerto Rico</option>
				<option value="Rhode Island">Rhode Island</option>
				<option value="South Carolina">South Carolina</option>
				<option value="South Dakota">South Dakota</option>
				<option value="Tennessee">Tennessee</option>
				<option value="Texas">Texas</option>
				
				<option value="Utah">Utah</option>
				<option value="Virginia">Virginia</option>
				<option value="Virgin Islands">Virgin Islands</option>
				<option value="Vermont">Vermont</option>
				<option value="Washington">Washington</option>
				<option value="Wisconsin">Wisconsin</option>
				<option value="West Virginia">West Virginia</option>
				<option value="Wyoming">Wyoming</option>
				<option value="Canada">Canada</option>
	</select>
	

		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.incorporatedStateTemp.$dirty) &amp;&amp; phubfrm.incorporatedStateTemp.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="federalTaxId">Fedaral Tax ID</label>
                    <input class="form-control input-lg ng-pristine ng-untouched ng-valid-mask  ng-invalid-required" data-ui-mask="99-9999999" required="" value="<?php echo $resultarray[0]['taxId'];?>" name="federalTaxIdTemp" data-ng-model="frm.federalTaxId" data-init-from-form="" placeholder="__-_______" type="text">
					
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.federalTaxIdTemp.$dirty) &amp;&amp; phubfrm.federalTaxIdTemp.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
                </div>
            </div>
           
           
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="exampleInputBusinessWebsiteURL">Website URL</label>
                    <input name="websiteAddress" required="" data-ng-model="frm.websiteAddress" class="form-control input-lg ng-pristine ng-untouched  ng-invalid-required ng-valid-maxlength" data-ng-maxlength="200" data-init-from-form="" value="<?php echo $resultarray[0]['websiteUrl'];?>" data-ng-pattern="/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/|www\.)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/" placeholder="http://example.com" type="text">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.websiteAddress.$dirty) &amp;&amp; phubfrm.websiteAddress.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>

                 <ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.websiteAddress.$dirty) &amp;&amp; phubfrm.websiteAddress.$error.pattern">
			<li class="parsley-required">Enter valid url!</li>
		</ul>   



		
		<!--<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.websiteAddress.$dirty) &amp;&amp; phubfrm.websiteAddress.$error.url">
			<li class="parsley-required">Enter valid url!</li>
		</ul>-->
		
                </div>
            </div>
        </div>
        
    </div> <!-- /panel -->
    <div class="panel">
        <header class="panel-heading">Business Address</header>
        <div class="panel-body">
    
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Address</label>
                    
                    <input name="businessStreetAddress"  class="form-control mb10 ng-pristine ng-untouched  ng-invalid-required" required="" placeholder="Street" value="<?php echo $resultarray[0]['street'];?>" data-ng-model="frm.businessStreetAddress" data-init-from-form="" type="text">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessStreetAddress.$dirty) &amp;&amp; phubfrm.businessStreetAddress.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		
		
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessStreetAddress.$dirty) &amp;&amp; phubfrm.businessStreetAddress.$error.pattern">
			<li class="parsley-required">Use valid details</li>
		</ul>
	
		
		
					
					<input name="businessCity" class="form-control mb10 ng-pristine ng-untouched  ng-invalid-required" required="" data-ng-pattern="/^[a-zA-Z ]+$/" placeholder="City" data-ng-model="frm.businessCity" value="<?php echo $resultarray[0]['city'];?>" data-init-from-form="" type="text">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessCity.$dirty) &amp;&amp; phubfrm.businessCity.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessCity.$dirty) &amp;&amp; phubfrm.businessCity.$error.pattern">
			<li class="parsley-required">Enter valid city name!</li>
		</ul>
		
						
	<select name="businessStateTemp" data-ng-model="frm.businessState" data-orig-val="" data-init-from-form="" class="form-control mb10 ng-pristine ng-untouched  ng-invalid-required" required="">
		
			<option value="<?php if($resultarray[0]['state']=="") echo ""; else echo $resultarray[0]['state'];?>"><?php if($resultarray[0]['state']=="") echo "--select state--"; else echo $resultarray[0]['state'];?></option>
				<option value="Armed Forces Americas">Armed Forces Americas</option>
				<option value="Armed Forces Europe">Armed Forces Europe</option>
				<option value="Alaska">Alaska</option>
				<option value="Alabama">Alabama</option>
				<option value="Armed Forces Pacific">Armed Forces Pacific</option>
				<option value="Arkansas">Arkansas</option>
				<option value="Arizona">Arizona</option>
				<option value="California">California</option>
				<option value="Colorado">Colorado</option>
				<option value="Connecticut">Connecticut</option>
				<option value="District of Columbia">District of Columbia</option>
				<option value="Delaware">Delaware</option>
				<option value="Florida">Florida</option>
				<option value="Georgia">Georgia</option>
				<option value="Guam">Guam</option>
				<option value="Hawaii">Hawaii</option>
				<option value="Iowa">Iowa</option>
				<option value="Idaho">Idaho</option>
				<option value="Illinois">Illinois</option>
				<option value="Indiana">Indiana</option>
				<option value="Kansas">Kansas</option>
				<option value="Kentucky">Kentucky</option>
				<option value="Louisiana">Louisiana</option>
				<option value="Massachusetts">Massachusetts</option>
				<option value="Maryland">Maryland</option>
				<option value="Maine">Maine</option>
				<option value="Michigan">Michigan</option>
				<option value="Minnesota">Minnesota</option>
				<option value="Missouri">Missouri</option>
				<option value="Mississippi">Mississippi</option>
				<option value="Montana">Montana</option>
				<option value="North Carolina">North Carolina</option>
				<option value="North Dakota">North Dakota</option>
				<option value="Nebraska">Nebraska</option>
				<option value="New Hampshire">New Hampshire</option>
				<option value="New Jersey">New Jersey</option>
				<option value="New Mexico">New Mexico</option>
				<option value="Nevada">Nevada</option>
				<option value="New York">New York</option>
				<option value="Ohio">Ohio</option>
				<option value="Oklahoma">Oklahoma</option>
				<option value="Oregon">Oregon</option>
				<option value="Pennsylvania">Pennsylvania</option>
				<option value="Puerto Rico">Puerto Rico</option>
				<option value="Rhode Island">Rhode Island</option>
				<option value="South Carolina">South Carolina</option>
				<option value="South Dakota">South Dakota</option>
				<option value="Tennessee">Tennessee</option>
				<option value="Texas">Texas</option>
				<option value="84057">84057</option>
				<option value="Utah">Utah</option>
				<option value="Virginia">Virginia</option>
				<option value="Virgin Islands">Virgin Islands</option>
				<option value="Vermont">Vermont</option>
				<option value="Washington">Washington</option>
				<option value="Wisconsin">Wisconsin</option>
				<option value="West Virginia">West Virginia</option>
				<option value="Wyoming">Wyoming</option>
				<option value="Canada">Canada</option>
	</select>
	<input name="businessState" value="" type="hidden">

		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessStateTemp.$dirty) &amp;&amp; phubfrm.businessStateTemp.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
                            
					
					
					
					
					<input name="businessZip" class="form-control mb10 ng-pristine ng-untouched  ng-invalid-required" required="" placeholder="Zip" data-ng-model="frm.businessZip" value="<?php echo $resultarray[0]['zip'];?>" data-ng-minlength="5" data-ng-maxlength="6" data-init-from-form="" step="any" type="number">
                                   
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessZip.$dirty) &amp;&amp; phubfrm.businessZip.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessZip.$dirty) &amp;&amp; phubfrm.businessZip.$error.minlength">
			<li class="parsley-required">Enter valid zip!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessZip.$dirty) &amp;&amp; phubfrm.businessZip.$error.maxlength">
			<li class="parsley-required">Enter valid zip!</li>
		</ul>
					
					
					
					
					
					<?php /* ?>	
					<input name="businessZip" class="form-control input-lg mb10 ng-pristine ng-untouched  ng-invalid-required" required="" placeholder="Zip" data-ng-model="frm.businessZip" value="<?php echo $resultarray[0]['zip'];?>" data-init-from-form="" step="any" type="number">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessZip.$dirty) &amp;&amp; phubfrm.businessZip.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessZip.$dirty) &amp;&amp; phubfrm.businessZip.$error.number">
			<li class="parsley-required">Numeric value required</li>
		</ul>
                    <?php */ ?>	
                </div>
            </div>
            <div class="col-lg-6">
            </div>
        </div>    
    </div> <!-- /panel -->
     <div class="panel">
        <header class="panel-heading">General Owner Info</header>
        <div class="panel-body">
<p class="col-lg-12"><b>Owner#1</b></p>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="ownershipFirstName">First Name</label>
                  
                   <input class="form-control ng-pristine ng-untouched ng-valid-email  ng-invalid-required" placeholder="First Name" required="" data-ng-pattern="/^[a-zA-Z ]+$/" data-ng-model="frm.ownershipFirstName" name="ownershipFirstName" data-init-from-form="" value="<?php echo $resultarray[0]['ownerFName1'];?>" type="text">
                  
                  
							
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipFirstName.$dirty) &amp;&amp; phubfrm.ownershipFirstName.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
						
						
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipFirstName.$dirty) &amp;&amp; phubfrm.ownershipFirstName.$error.pattern">
			<li class="parsley-required">Name should be valid!</li>
		</ul>
						
					</div>
                </div>
           
<div class="col-lg-6">
                <div class="form-group">
                    <label for="ownership2FirstName">Last Name</label>
                  
                  
                  
                  <input class="form-control ng-pristine ng-untouched ng-valid-email  ng-invalid-required" placeholder="Last Name" required="" data-ng-pattern="/^[a-zA-Z\. ]+$/" data-ng-model="frm.ownershipLastName" data-ng-minlength="2" data-ng-maxlength="40" name="ownershipLastName" data-init-from-form="" value="<?php echo $resultarray[0]['ownerLName1'];?>" type="text">
                  
							
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipLastName.$dirty) &amp;&amp; phubfrm.ownershipLastName.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
						
						
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipLastName.$dirty) &amp;&amp; phubfrm.ownershipLastName.$error.pattern">
			<li class="parsley-required">Name should be valid!</li>
		</ul>
						
					</div>
                </div>

			            <div class="col-lg-6">
				<div class="form-group">
					<label for="ownershipDL">Drivers License or ID#</label>
					<input name="ownershipDL" placeholder="Drivers License or ID#" class="form-control input-lg ng-pristine ng-untouched  ng-invalid-required" required="" placeholder="" data-ng-model="frm.ownershipDL" data-init-from-form="" type="text" value="<?php echo $resultarray[0]['drLicense'];?>">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipDL.$dirty) &amp;&amp; phubfrm.ownershipDL.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
				</div> 
			</div>
			
			
			 <div class="col-lg-6">
                <div class="form-group">
                    <label for="ownershipHomePhone">Work Phone</label>
                    <input name="ownershipHomePhone" class="form-control input-lg ng-pristine ng-untouched ng-valid-mask  ng-invalid-required" required="" data-ui-mask="(999)-999-9999" data-ng-model="frm.ownershipHomePhone" data-init-from-form="" placeholder="(___)-___-____" type="text" value="<?php echo $resultarray[0]['workPhone'];?>">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipHomePhone.$dirty) &amp;&amp; phubfrm.ownershipHomePhone.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
                </div>
            </div>
            
			
			 <div class="col-lg-6">
                <div class="form-group">
                    <label for="ownershipEmail">Email</label>
                    <input name="ownershipEmail" class="form-control input-lg ng-pristine ng-untouched ng-valid ng-valid-email ng-valid-required" required="" placeholder="valid@email.com" data-ng-model="frm.ownershipEmail" data-ng-pattern="/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,64}$/" data-init-from-form="" type="text" value="<?php echo $resultarray[0]['email'];?>">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipEmail.$dirty) &amp;&amp; phubfrm.ownershipEmail.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipEmail.$dirty) &amp;&amp; phubfrm.ownershipEmail.$error.pattern">
			<li class="parsley-required">Enter valid email</li>
		</ul>
                </div>
            </div>
			
			
		
			
			           			
           <p class="col-lg-12"><b>Owner#2(If Applicable)</b></p>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="ownership2FirstName">First Name</label>
                  
							 <input class="form-control ng-pristine ng-untouched ng-valid-email  ng-invalid-required" placeholder="First Name" data-ng-pattern="/^[a-zA-Z ]+$/" data-ng-model="frm.ownership2FirstName" name="ownership2FirstName" data-init-from-form="" value="<?php echo $resultarray[0]['ownerFName2'];?>" type="text">
                  
						
						
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownership2FirstName.$dirty) &amp;&amp; phubfrm.ownership2FirstName.$error.pattern">
			<li class="parsley-required">Name should be valid!</li>
		</ul>
						
					</div>
                </div>
           
<div class="col-lg-6">
                <div class="form-group">
                    <label for="ownership2LastName">Last Name</label>
                   <input class="form-control ng-pristine ng-untouched ng-valid-email  ng-invalid-required" placeholder="Last Name"  data-ng-pattern="/^[a-zA-Z\. ]+$/" data-ng-model="frm.ownership2LastName" name="ownership2LastName" data-init-from-form="" value="<?php echo $resultarray[0]['ownerLName2'];?>" type="text">
							
					
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownership2LastName.$dirty) &amp;&amp; phubfrm.ownership2LastName.$error.pattern">
			<li class="parsley-required">Name should be valid!</li>
		</ul>
						
					</div>
                </div>

 <div class="col-lg-6">
                <div class="form-group">
                    <label for="ownershipEmail2">Email</label>
                    <input name="ownershipEmail2" class="form-control input-lg ng-pristine ng-untouched ng-valid ng-valid-email ng-valid-required" placeholder="valid@email.com" data-ng-model="frm.ownershipEmail2" data-ng-pattern="/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,64}$/" data-init-from-form="" type="text" value="<?php echo $resultarray[0]['email2'];?>">
		
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipEmail.$dirty) &amp;&amp; phubfrm.ownershipEmail2.$error.pattern">
			<li class="parsley-required">Enter valid email/li>
		</ul>
                </div>
            </div>
			
			
		
			
			           			<div class="col-lg-6">
                <div class="form-group">
                    <label for="ownership2HomePhone">Mobile Phone</label>
                    <input name="ownership2HomePhone" class="form-control input-lg ng-pristine ng-untouched ng-valid ng-valid-mask" data-ui-mask="(999)-999-9999" data-ng-model="frm.ownership2HomePhone" data-init-from-form="" placeholder="(___)-___-____" type="text" value="<?php echo $resultarray[0]['mobPhone'];?>">
                    
                </div>
            </div>


        </div>
        
    </div> <!-- /panel -->

    <input class="btn btn-success btn-lg btn-block phub-merchant-form-na" data-ng-click="submit(phubfrm)" value="Continue" type="button">
    
<!-- </form> -->	

<?php echo form_close(); ?>
</div>
</div>    				

<div class="clear"></div>


 <div id="dontdisplayit" style="display:none">
 <img src="http://www.payecrm.com/build/images/logo.png" />
     <div class="panel clearfix">
        <header class="panel-heading">General Business Information</header>
        <div class="panel-body">
        <table>
    <tr>
    <td><b>Legal Business Name:</b></td><td><?php echo $resultarray[0]['businessName'];?></td>
    </tr>
     <tr>
     <td><b>Company Trade Name (DBA):</b></td><td><?php echo $resultarray[0]['tradeName'];?></td>
    </tr>
     <tr>
    <td><b>Business Type:</b></td><td><?php echo $resultarray[0]['businessType'];?></td>
    </tr>
     <tr>
    <td><b>State of Incorporation:</b></td><td><?php echo $resultarray[0]['corpState'];?></td>
    </tr>
    <tr>
   <td><b>Fedaral Tax ID:</b></td><td><?php echo $resultarray[0]['taxId'];?></td>
    </tr>
    <tr>
    <td><b>Website URL:</b></td><td><?php echo $resultarray[0]['websiteUrl'];?></td>
    </tr>
     </table>

   </div>
        
    </div> <!-- /panel -->
    <div class="panel">
        <header class="panel-heading">Business Address</header>
        <div class="panel-body">
    <table>
    <tr>
    <td><b>Street:</b></td><td><?php echo $resultarray[0]['street'];?></td>
    </tr>
     <tr>
     <td><b>City:</b></td><td><?php echo $resultarray[0]['city'];?></td>
    </tr>
     <tr>
    <td><b>State:</b></td><td><?php echo $resultarray[0]['state'];?></td>
    </tr>
     <tr>
    <td><b>ZIP:</b></td><td><?php echo $resultarray[0]['zip'];?></td>
    </tr>
   
     </table>
    
      <div class="col-lg-6">
            </div>
        </div>    
    </div> <!-- /panel -->
     <div class="panel">
        <header class="panel-heading">General Owner Info</header>
        <div class="panel-body">
<p class="col-lg-12"><b>Owner#1</b></p>




  <table>
    <tr>
    <td><b>First Name:</b></td><td><?php echo $resultarray[0]['ownerFName1'];?></td>
    </tr>
     <tr>
     <td><b>Last Name:</b></td><td><?php echo $resultarray[0]['ownerLName1'];?></td>
    </tr>
     <tr>
    <td><b>Drivers License or ID:</b></td><td><?php echo $resultarray[0]['drLicense'];?></td>
    </tr>
     <tr>
    <td><b>Work Phone:</b></td><td><?php echo $resultarray[0]['workPhone'];?></td>
    </tr>
    <tr>
    <td><b>Email:</b></td><td><?php echo $resultarray[0]['email'];?></td>
    </tr>
     </table>
    
    
    
    	<br><br><br><br>	           			
           <p class="col-lg-12"><b>Owner#2(If Applicable)</b></p>
           
           
           
           
            <table>
    <tr>
    <td><b>First Name:</b></td><td><?php echo $resultarray[0]['ownerFName2'];?></td>
    </tr>
     <tr>
     <td><b>Last Name:</b></td><td><?php echo $resultarray[0]['ownerLName2'];?></td>
    </tr>
     <tr>
    <td><b>Email:</b></td><td><?php echo $resultarray[0]['email2'];?></td>
    </tr>
     <tr>
    <td><b>Mobile Phone:</b></td><td><?php echo $resultarray[0]['mobPhone'];?></td>
    </tr>
         </table>
             </div>
        
    </div> <!-- /panel -->
    
    
    
    </div>

			
                            
                    <!-- /inner content wrapper -->
 

  	