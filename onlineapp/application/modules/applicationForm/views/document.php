 <?php error_reporting(0); ?>

 <section class="layout">
 
  <style>

@media print {
  a[href]:after {
    content: none !important;
  }
  
#dontpls
    {
        display: none !important;
    }
    
    
    #upload
    {
        display: none !important;
    }
    
    #complete
    {
        display: none !important;
    }
    
    
	
	.wizard
    {
        display: none !important;
    }
	
    #dontdisplayit
{
 display: block !important;
}
.form-control 
{
width:41%;
display: inline !important;
border:none;
}
label
{

border:none;
}
tr
{
spacing:6px;
}

td
{
padding:6px;
}
    
}


</style>
 
<style>
 #form-doc-upload.upload-docs div.upload-docs-div {
    font-size: 1.2em !important;
   
    height:200px !important;
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
					<h5 id="upload" class="text-center">Upload your documents here.</h5>
					<br>
					<div id="wizard" class="wizard">
					    <ul class="steps">
					        		<li data-target="#step1" class="">
					        		<span class="badge bg-info"></span><a href="<?php echo base_url();?>applicationForm/business?signupid=<?php echo $this->input->get('signupid');?>">Business/Onwer Info</a>
					        		</li><li data-target="#step2" class="">
					        		<span class="badge bg-info"></span><a href="<?php echo base_url();?>applicationForm/billing?signupid=<?php echo $this->input->get('signupid');?>">Billing Information</a>
					        		</li><li data-target="#step4" class="active">
					        		<span class="badge bg-info"></span>Documentation
					        		</li><li data-target="#step5" class="">
					        		<span class="badge bg-info"></span><a href="<?php echo base_url();?>applicationForm/complete?signupid=<?php echo $this->input->get('signupid');?>">Completed</a>
					    </li></ul>
				    
					  <div class="actions btn-group">
					  
					 
					  
					  
					        <a class="btn btn-default btn-sm btn-next" href="<?php echo base_url();?>applicationForm/billing?signupid=<?php echo $this->input->get('signupid');?>">
					            <!--<i class="fa fa-angle-left"></i> --><<
					        </a>
					        
					        <a class="btn btn-default btn-sm btn-next" href="<?php echo base_url();?>applicationForm/complete?signupid=<?php echo $this->input->get('signupid');?>">
					           <!-- <i class="fa fa-angle-right"></i> -->>>
					        </a>
					    </div>
					</div>





<script type="text/javascript">
					merchantFormLocked = false;
</script>
<div class="merchantform phub-merchant-form " data-ng-app="phubapp">
	<div data-ng-controller="MerchantFormController" class="ng-scope">



<!-- hiding starts here.....  -->













<!-- hiding ends here.....  -->
<span id="dontpls">

<div class="panel">
	<div class="panel-body text-center">
		<h4>Download the attached pdf file, and upload it using the form below.</h4>
		
		
		
		
		<a href="//pdfcrowd.com/url_to_pdf/?use_print_media=1&pdf_name=ApplicationForm" class="btn btn-success mb20">Download pdf</a>
		<hr>
	</div>
 <div class="alert-danger" style="margin:0 0 0 0%"><center><font color="#ff0000" size="+1"><?php if($this->session->flashdata('error')) echo $this->session->flashdata('error'); ?></font></center></div>
	<div class="panel-body text-center">
		<!-- <form id="form-doc-upload" class="clearfix upload-docs phub-merchant-form-na ng-pristine ng-valid" method="post" enctype="multipart/form-data" action="<?php //echo base_url();?>">  -->
		
<?php echo form_open('applicationForm/savedocument', array('id'=>"form-doc-upload", 'class'=>"clearfix upload-docs phub-merchant-form-na ng-pristine ng-valid", 'method'=>"post", 'enctype'=>"multipart/form-data")); ?>
		     	 <div class="col-md-4 col-sm-12">     
		      		<div data-doctype="Voided Check And CC" class="upload-docs-div thumbnail drophandler not-uploaded dropzone clearfix">
		            	Drag &amp; Drop or Click Here to Upload Your Signed Voided Check And CC Document<br><small>(Valid formats:xps,txt,pdf,doc,docx,jpg, png and gif. File size not to exceed 10KB)</small><div class="dz-default dz-message"></div>
		      		</div>
		      	</div>
      				
			<div id="file-upload-progress" class="file-upload-progress"><p>100%</p><span></span></div>
			<div data-ng-hide="1==1" class="ng-hide">
			   <input name="sid" value="<?php echo $this->input->get('signupid');?>" type="hidden">
				
				<input id="uploaddocs-file-elm" name="file" type="file">
				
			 	
        		
				<input id="uploaddocs-submit-elm" name="submit" value="Upload" type="submit">
			</div>
<!-- 		</form> -->
<?php echo form_close(); ?>
	</div>
</div>

	<div class="panel">
	
		<div class="panel-body">
		&nbsp;<?php if($this->session->flashdata('upldlmt')) echo $this->session->flashdata('upldlmt');?>
			<h3>Uploaded Documents </h3>
			<table class="table table-striped table-hover uploaded-docs">
					<tbody>
					<?php
					
					   for($i=1;$i<=5;$i++){
					if($resultarray[0]["doc$i"]!="") {  
					
					$tmp=explode("_R_",$resultarray[0]["doc$i"]);
					$dtmp=date('Y/d_M',$tmp[0]);
					?>
					<tr>
						<td><i><?php echo $i;?>.</i></td><td><a href="<?php echo base_url().'uploads/'.$resultarray[0]['doc'.$i];?>" download="<?php echo $tmp[1];?>"><strong><?php echo $dtmp.'/'.$tmp[1];?></strong></a></td><td class="uploaded-doc-type">Voided Check And CC</td><td><a href="<?php echo base_url().'signup/deletedoc?doc='.$i."_@".$resultarray[0]["doc$i"];?>"><i class="fa fa-times" aria-hidden="true"></i></a> </td>
					</tr>
					   <?php } }?>
					
    		</tbody></table>
    	</div>
    </div>
</span>
<?php
$qr=$this->db->query('select * from t_billing where userId='.$_GET['signupid']);
$rs=$qr->result_array();
$bil=$rs[0]['name1'];
$qr=$this->db->query('select * from t_business where userId='.$_GET['signupid']);
$rs=$qr->result_array();
$bus=$rs[0]['businessName'];
?>

 <!-- <form role="form" name="phubfrm" class="phub-merchant-form ng-pristine ng-valid" method="post" action="<?php //echo base_url();?>applicationForm/complete?signupid=<?php //echo $_GET['signupid'];?>" novalidate="" data-ng-class="{'form-submitted':submitted}">
  -->
 <?php echo form_open('applicationForm/complete', array('role'=>"form", 'name'=>"phubfrm", 'class'=>"phub-merchant-form ng-pristine ng-valid",'method'=>"post", 'novalidate'=>"", 'data-ng-class'=>"{'form-submitted':submitted}") ); ?>
	<input name="business" class="phub-merchant-form-na" value="<?php echo $bus; ?>" type="hidden">
	<input name="billing" class="phub-merchant-form-na" value="<?php echo $bil; ?>" type="hidden">
	<input name="signupid" class="phub-merchant-form-na" value="<?php echo $_GET["signupid"]; ?>" type="hidden">
	<input id="complete" class="btn btn-success btn-lg btn-block phub-merchant-form-na" value="Complete" type="submit">
<?php echo form_close();?>	
<!-- </form> -->



<script language="javascript" type="text/javascript">
	jQuery(function(){
		var jUploadDivs = jQuery(".upload-docs-div");
		var jUploadDocForm = jQuery("#form-doc-upload");
		var jUploadDocType = jQuery("#uploaddocs-doctype-elm");
		var jUploadDocFile = jQuery("#uploaddocs-file-elm");
		var jUploadDocSubmit = jQuery("#uploaddocs-submit-elm");
		var jUploadDocProgress = jQuery("#file-upload-progress");
		var jUploadDocProgressPer = jUploadDocProgress.children("p");
		var jUploadDocProgressSpan = jUploadDocProgress.children("span");
		var fileUploadMuteX = false;
		jUploadDivs.on("click",function(e){
			e.preventDefault();
			console.log(this.getAttribute("id"));
			jUploadDocType.val(this.getAttribute("data-doctype"));
			jUploadDocFile.trigger('click');
		});

		jUploadDocFile.on("change",function(e){
			e.preventDefault();
			console.log("File status:" + jUploadDocFile.val());
			if(jUploadDocFile.val()){
				jUploadDocSubmit.trigger('click');
			}else{
				console.log("No File to upload");
			}
		});
		
		var updateProgressBar = function(percent){
			jUploadDocProgressPer.html(percent + "%");
		    jUploadDocProgressSpan.width(percent + "%");
		}
		window.updateProgressBar = updateProgressBar;
		
		jUploadDivs.bind('fileDropped', function(e, payload){
			if(!fileUploadMuteX){
				fileUploadMuteX = true;
				console.log("fileDropped event triggered",payload,e);
				var files = payload && payload.files ? payload.files : null;
				var obj = payload && payload.obj ? payload.obj : null;
				
				if(obj){
					jUploadDocType.val(obj.getAttribute("data-doctype"));
				}
				
				var fd = new FormData();
				for (var i = 0; i < files.length; i++){
			        
			        fd.append('file', files[i], files[i].name);
			 		console.log("Added file with name : " + files[i].name);
			        //var status = new createStatusbar(obj); //Using this we can set progress.
			        //status.setFileNameSize(files[i].name,files[i].size);
			        //sendFileToServer(fd,status);
				 
				}
				
				var formArr = jUploadDocForm.serializeArray();
				if(formArr && formArr.length > 0){
					for(var i = 0; i < formArr.length; i++){
						fd.append(formArr[i]["name"],formArr[i]["value"]);
						console.log("Added field [" + formArr[i]["name"] + ":" + formArr[i]["value"] + "]");
					}
				}
				window.jUploadDocProgress = jUploadDocProgress;
				jUploadDocProgress.show();
				
				jQuery.ajax({
					xhr: function() {
			            var xhrobj = jQuery.ajaxSettings.xhr();
			            if (xhrobj.upload) {
			                    xhrobj.upload.addEventListener('progress', function(event) {
			                        var percent = 0;
			                        var position = event.loaded || event.position;
			                        var total = event.total;
			                        if (event.lengthComputable) {
			                            percent = Math.ceil(position / total * 100);
			                        }
			                        //Set progress
			                        updateProgressBar(percent);
			                        console.log("Percent:",percent);
			                    }, false);
			                }
			            return xhrobj;
			        },
				  url: jUploadDocForm.attr("action"),
				  type: "POST",
				  data: fd,
				  processData: false,  // tell jQuery not to process the data
				  contentType: false,   // tell jQuery not to set contentType
				  cache: false,
	        	  success: function(data){
	        	  		updateProgressBar("100");
	        	  		jUploadDocProgress.hide();
	            		window.location=window.location;//.reload(false);
	            		fileUploadMuteX = false;         
	        	  },
	        	  error:function(data){
	        	  	updateProgressBar("0");
	        	  	jUploadDocProgress.hide();
	        	  	alert("Error in uploading file " + data);
	        	  	fileUploadMuteX = false;
	        	  }
	        	  
				});
			}else{
				alert("File upload in progress...");
			}
			
		})
		
		
	});
	
</script>	</div>
</div>    				<div class="clear"></div>			
                            
                    <!-- /inner content wrapper -->
 <div id="dontdisplayit" style="display:none">
 <img src="http://www.payecrm.com/build/images/logo.png" />
    <div class="panel clearfix">
        <header class="panel-heading">General Business Information</header>
        <div class="panel-body">
        <table>
    <tr>
    <td><b>Legal Business Name:</b></td><td><?php echo $resultarrayb[0]['businessName'];?></td>
    </tr>
     <tr>
     <td><b>Company Trade Name (DBA):</b></td><td><?php echo $resultarrayb[0]['tradeName'];?></td>
    </tr>
     <tr>
    <td><b>Business Type:</b></td><td><?php echo $resultarrayb[0]['businessType'];?></td>
    </tr>
     <tr>
    <td><b>State of Incorporation:</b></td><td><?php echo $resultarrayb[0]['corpState'];?></td>
    </tr>
    <tr>
   <td><b>Fedaral Tax ID:</b></td><td><?php echo $resultarrayb[0]['taxId'];?></td>
    </tr>
    <tr>
    <td><b>Website URL:</b></td><td><?php echo $resultarrayb[0]['websiteUrl'];?></td>
    </tr>
     </table>
         <?php /* ?>   <div class="col-lg-6">
                <div class="form-group">
                    <label for="businessName">Legal Business Name:</label>
                    <input class="form-control input-lg ng-pristine ng-untouched  ng-invalid-required ng-valid-maxlength" name="businessName" required="" data-ng-model="frm.businessName" value="<?php echo $resultarrayb[0]['businessName'];?>" placeholder="Your Business Name" data-ng-maxlength="100" data-init-from-form="" type="text">
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
                    <label for="dbaName">Company Trade Name (DBA):</label>
                    
                        <input name="dbaName" required="" class="form-control input-lg ng-pristine ng-untouched ng-valid ng-valid-required ng-valid-maxlength" placeholder="Doing Business As" data-ng-model="frm.dbaName" data-ng-maxlength="150" value="<?php echo $resultarrayb[0]['tradeName'];?>" data-init-from-form="" type="text">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.dbaName.$dirty) &amp;&amp; phubfrm.dbaName.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.dbaName.$dirty) &amp;&amp; phubfrm.dbaName.$error.maxlength">
			<li class="parsley-required">Too long</li>
		</ul>
                   
					
                </div>
            </div>
            <div class="col-lg-6">
                   
                        <label>Business Type:</label>
	<select name="businessType" data-ng-model="frm.businessType" data-orig-val="" data-init-from-form="" class="form-control mb10 ng-pristine ng-untouched  ng-invalid-required" required="">
			<option value="" <?php if($resultarrayb[0]['businessType']=="") echo "selected";?>>---Select---</option>
			<option value="Sole Proprietor" <?php if($resultarrayb[0]['businessType']=="Sole Proprietor") echo "selected";?> >Sole Proprietor</option>
			<option value="Partnership General/Limited" <?php if($resultarrayb[0]['businessType']=="Partnership General/Limited") echo "selected";?>>Partnership General/Limited</option>
			<option value="Corporation" <?php if($resultarrayb[0]['businessType']=="Corporation") echo "selected";?>>Corporation</option>
			<option value="Limited Liability Corp" <?php if($resultarrayb[0]['businessType']=="Limited Liability Corp") echo "selected";?>>Limited Liability Corp</option>
			<option value="Other" <?php if($resultarrayb[0]['businessType']=="Other") echo "selected";?>>Other</option>
	</select>

		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessType.$dirty) &amp;&amp; phubfrm.businessType.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
						
                   
            </div>
            
            
            
            
             <div class="col-lg-6">
                <label>State of Incorporation:</label>
	<select name="incorporatedStateTemp" data-ng-model="frm.incorporatedState" data-orig-val="" data-init-from-form="" class="form-control mb10 ng-pristine ng-untouched  ng-invalid-required" required="">
			<option value="<?php if($resultarrayb[0]['corpState']=="") echo ""; else echo $resultarrayb[0]['corpState'];?>"><?php if($resultarrayb[0]['corpState']=="") echo "--select--"; else echo $resultarrayb[0]['corpState'];?></option>
		
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
	

		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.incorporatedStateTemp.$dirty) &amp;&amp; phubfrm.incorporatedStateTemp.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="federalTaxId">Fedaral Tax ID:</label>
                    <input class="form-control input-lg ng-pristine ng-untouched ng-valid-mask  ng-invalid-required" data-ui-mask="99-9999999" required="" value="<?php echo $resultarrayb[0]['taxId'];?>" name="federalTaxIdTemp" data-ng-model="frm.federalTaxId" data-init-from-form="" placeholder="__-_______" type="text">
					
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.federalTaxIdTemp.$dirty) &amp;&amp; phubfrm.federalTaxIdTemp.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
                </div>
            </div>
           
           
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="exampleInputBusinessWebsiteURL">Website URL:</label>
                    <input name="websiteAddress" required="" data-ng-model="frm.websiteAddress" class="form-control input-lg ng-pristine ng-untouched  ng-invalid-required ng-valid-maxlength" data-ng-maxlength="200" data-init-from-form="" value="<?php echo $resultarrayb[0]['websiteUrl'];?>" data-ng-pattern="/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/|www\.)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/" placeholder="http://example.com" type="text">
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
            </div>   <?php */ ?>
        </div>
        
    </div> <!-- /panel -->
    <div class="panel">
        <header class="panel-heading">Business Address</header>
        <div class="panel-body">
    
    
    
    
    
    
    
    
    <table>
    <tr>
    <td><b>Street:</b></td><td><?php echo $resultarrayb[0]['street'];?></td>
    </tr>
     <tr>
     <td><b>City:</b></td><td><?php echo $resultarrayb[0]['city'];?></td>
    </tr>
     <tr>
    <td><b>State:</b></td><td><?php echo $resultarrayb[0]['state'];?></td>
    </tr>
     <tr>
    <td><b>ZIP:</b></td><td><?php echo $resultarrayb[0]['zip'];?></td>
    </tr>
   
     </table>
    
    
    
    
    
    
    
    
    
    
    <?php /* ?>
            <div class="col-lg-6">
                <div class="form-group">
                   
                     <label for="qq">Street:</label>
                    <input name="businessStreetAddress"  class="form-control mb10 ng-pristine ng-untouched  ng-invalid-required" required="" placeholder="Street" value="<?php echo $resultarrayb[0]['street'];?>" data-ng-model="frm.businessStreetAddress" data-init-from-form="" type="text">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessStreetAddress.$dirty) &amp;&amp; phubfrm.businessStreetAddress.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		
		
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessStreetAddress.$dirty) &amp;&amp; phubfrm.businessStreetAddress.$error.pattern">
			<li class="parsley-required">Use valid details</li>
		</ul>
		
		
		
		
		
		
		
					<label for="rr">City:</label>
					<input name="businessCity" class="form-control mb10 ng-pristine ng-untouched  ng-invalid-required" required="" data-ng-pattern="/^[a-zA-Z ]+$/" placeholder="City" data-ng-model="frm.businessCity" value="<?php echo $resultarrayb[0]['city'];?>" data-init-from-form="" type="text">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessCity.$dirty) &amp;&amp; phubfrm.businessCity.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessCity.$dirty) &amp;&amp; phubfrm.businessCity.$error.pattern">
			<li class="parsley-required">Enter valid city name!</li>
		</ul>
		
			<label for="ss">State:</label>			
	<select name="businessStateTemp" data-ng-model="frm.businessState" data-orig-val="" data-init-from-form="" class="form-control mb10 ng-pristine ng-untouched  ng-invalid-required" required="">
		
			<option value="<?php if($resultarrayb[0]['state']=="") echo ""; else echo $resultarrayb[0]['state'];?>"><?php if($resultarrayb[0]['state']=="") echo "--select state--"; else echo $resultarrayb[0]['state'];?></option>
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
                            
					
					
					
					<label for="zz">ZIP:</label>
					<input name="businessZip" class="form-control mb10 ng-pristine ng-untouched  ng-invalid-required" required="" placeholder="Zip" data-ng-model="frm.businessZip" value="<?php echo $resultarrayb[0]['zip'];?>" data-ng-minlength="5" data-ng-maxlength="6" data-init-from-form="" step="any" type="number">
                                   
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessZip.$dirty) &amp;&amp; phubfrm.businessZip.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessZip.$dirty) &amp;&amp; phubfrm.businessZip.$error.minlength">
			<li class="parsley-required">Enter valid zip!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessZip.$dirty) &amp;&amp; phubfrm.businessZip.$error.maxlength">
			<li class="parsley-required">Enter valid zip!</li>
		</ul>
					
					
					
					
					
				<!--- start  -->	
					<input name="businessZip" class="form-control input-lg mb10 ng-pristine ng-untouched  ng-invalid-required" required="" placeholder="Zip" data-ng-model="frm.businessZip" value="<?php echo $resultarrayb[0]['zip'];?>" data-init-from-form="" step="any" type="number">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessZip.$dirty) &amp;&amp; phubfrm.businessZip.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessZip.$dirty) &amp;&amp; phubfrm.businessZip.$error.number">
			<li class="parsley-required">Numeric value required</li>
		</ul>
                   <!--- end  -->
                </div>
            </div> <?php */ ?>
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
    <td><b>First Name:</b></td><td><?php echo $resultarrayb[0]['ownerFName1'];?></td>
    </tr>
     <tr>
     <td><b>Last Name:</b></td><td><?php echo $resultarrayb[0]['ownerLName1'];?></td>
    </tr>
     <tr>
    <td><b>Drivers License or ID:</b></td><td><?php echo $resultarrayb[0]['drLicense'];?></td>
    </tr>
     <tr>
    <td><b>Work Phone:</b></td><td><?php echo $resultarrayb[0]['workPhone'];?></td>
    </tr>
    <tr>
    <td><b>Email:</b></td><td><?php echo $resultarrayb[0]['email'];?></td>
    </tr>
     </table>
    



<?php /* ?>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="ownershipFirstName">First Name:</label>
                  
                   <input class="form-control ng-pristine ng-untouched ng-valid-email  ng-invalid-required" placeholder="First Name" required="" data-ng-pattern="/^[a-zA-Z ]+$/" data-ng-model="frm.ownershipFirstName" name="ownershipFirstName" data-init-from-form="" value="<?php echo $resultarrayb[0]['ownerFName1'];?>" type="text">
                  
                  
							
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
                    <label for="ownership2FirstName">Last Name:</label>
                  
                  
                  
                  <input class="form-control ng-pristine ng-untouched ng-valid-email  ng-invalid-required" placeholder="Last Name" required="" data-ng-pattern="/^[a-zA-Z\. ]+$/" data-ng-model="frm.ownershipLastName" data-ng-minlength="2" data-ng-maxlength="40" name="ownershipLastName" data-init-from-form="" value="<?php echo $resultarrayb[0]['ownerLName1'];?>" type="text">
                  
							
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
					<label for="ownershipDL">Drivers License or ID#:</label>
					<input name="ownershipDL" placeholder="Drivers License or ID#" class="form-control input-lg ng-pristine ng-untouched  ng-invalid-required" required="" placeholder="" data-ng-model="frm.ownershipDL" data-init-from-form="" type="text" value="<?php echo $resultarrayb[0]['drLicense'];?>">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipDL.$dirty) &amp;&amp; phubfrm.ownershipDL.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
				</div> 
			</div>
			
			
			 <div class="col-lg-6">
                <div class="form-group">
                    <label for="ownershipHomePhone">Work Phone:</label>
                    <input name="ownershipHomePhone" class="form-control input-lg ng-pristine ng-untouched ng-valid-mask  ng-invalid-required" required="" data-ui-mask="(999)-999-9999" data-ng-model="frm.ownershipHomePhone" data-init-from-form="" placeholder="(___)-___-____" type="text" value="<?php echo $resultarrayb[0]['workPhone'];?>">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipHomePhone.$dirty) &amp;&amp; phubfrm.ownershipHomePhone.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
                </div>
            </div>
            
			
			 <div class="col-lg-6">
                <div class="form-group">
                    <label for="ownershipEmail">Email:</label>
                    <input name="ownershipEmail" class="form-control input-lg ng-pristine ng-untouched ng-valid ng-valid-email ng-valid-required" required="" placeholder="valid@email.com" data-ng-model="frm.ownershipEmail" data-ng-pattern="/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,64}$/" data-init-from-form="" type="text" value="<?php echo $resultarrayb[0]['email'];?>">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipEmail.$dirty) &amp;&amp; phubfrm.ownershipEmail.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipEmail.$dirty) &amp;&amp; phubfrm.ownershipEmail.$error.pattern">
			<li class="parsley-required">Enter valid email</li>
		</ul>
                </div>
            </div>
			
			
		<?php */ ?>
			
		<br><br><br><br>		           			
           <p class="col-lg-12"><b>Owner#2(If Applicable)</b></p>
           
           
           
           
            <table>
    <tr>
    <td><b>First Name:</b></td><td><?php echo $resultarrayb[0]['ownerFName2'];?></td>
    </tr>
     <tr>
     <td><b>Last Name:</b></td><td><?php echo $resultarrayb[0]['ownerLName2'];?></td>
    </tr>
     <tr>
    <td><b>Email:</b></td><td><?php echo $resultarrayb[0]['email2'];?></td>
    </tr>
     <tr>
    <td><b>Mobile Phone:</b></td><td><?php echo $resultarrayb[0]['mobPhone'];?></td>
    </tr>
         </table>
           
           
           
           
           
           
           
           
           <?php /* ?>
           
           
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="ownership2FirstName">First Name:</label>
                  
							 <input class="form-control ng-pristine ng-untouched ng-valid-email  ng-invalid-required" placeholder="First Name" data-ng-pattern="/^[a-zA-Z ]+$/" data-ng-model="frm.ownership2FirstName" name="ownership2FirstName" data-init-from-form="" value="<?php echo $resultarrayb[0]['ownerFName2'];?>" type="text">
                  
						
						
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownership2FirstName.$dirty) &amp;&amp; phubfrm.ownership2FirstName.$error.pattern">
			<li class="parsley-required">Name should be valid!</li>
		</ul>
						
					</div>
                </div>
           
<div class="col-lg-6">
                <div class="form-group">
                    <label for="ownership2LastName">Last Name:</label>
                   <input class="form-control ng-pristine ng-untouched ng-valid-email  ng-invalid-required" placeholder="Last Name"  data-ng-pattern="/^[a-zA-Z\. ]+$/" data-ng-model="frm.ownership2LastName" name="ownership2LastName" data-init-from-form="" value="<?php echo $resultarrayb[0]['ownerLName2'];?>" type="text">
							
					
						<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownership2LastName.$dirty) &amp;&amp; phubfrm.ownership2LastName.$error.pattern">
			<li class="parsley-required">Name should be valid!</li>
		</ul>
						
					</div>
                </div>

 <div class="col-lg-6">
                <div class="form-group">
                    <label for="ownershipEmail2">Email:</label>
                    <input name="ownershipEmail2" class="form-control input-lg ng-pristine ng-untouched ng-valid ng-valid-email ng-valid-required" placeholder="valid@email.com" data-ng-model="frm.ownershipEmail2" data-ng-pattern="/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,64}$/" data-init-from-form="" type="text" value="<?php echo $resultarrayb[0]['email2'];?>">
		
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.ownershipEmail.$dirty) &amp;&amp; phubfrm.ownershipEmail2.$error.pattern">
			<li class="parsley-required">Enter valid email/li>
		</ul>
                </div>
            </div>
			
			
		
			
			           			<div class="col-lg-6">
                <div class="form-group">
                    <label for="ownership2HomePhone">Mobile Phone:</label>
                    <input name="ownership2HomePhone" class="form-control input-lg ng-pristine ng-untouched ng-valid ng-valid-mask" data-ui-mask="(999)-999-9999" data-ng-model="frm.ownership2HomePhone" data-init-from-form="" placeholder="(___)-___-____" type="text" value="<?php echo $resultarrayb[0]['mobPhone'];?>">
                    
                </div>
            </div>
<?php */ ?>

        </div>
        
    </div> <!-- /panel -->
    
    
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
	       
	       
	       
	       
	       
	       
			
			<?php /* ?>   <div class="col-lg-6">
                <div class="form-group">
                    <label for="nameOfPrimaryContact1">First Name:</label>
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
                    <label for="nameOfPrimaryContact2">Last Name:</label>
                  
                  
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
	                <label for="ownershipTitle">Title:</label>
	               
	                    <input class="form-control ng-pristine ng-untouched  ng-invalid-required" required="" data-ng-pattern="/^[a-zA-Z ]+$/" name="ownershipTitle" data-ng-model="frm.ownershipTitle" placeholder="Executive Officer,Managing Director etc." value="<?php echo $resultarray[0]['title'];?>" data-ng-maxlength="100" data-init-from-form="" type="text" >
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
	
	
	        <div class="col-lg-6">
	            <div class="form-group">
	                <label>Phone:</label>
	                <input name="primaryCellPhoneTemp" required="" data-ng-model="frm.primaryCellPhone" class="form-control input-lg ng-pristine ng-untouched ng-valid ng-valid-mask ng-valid-required" value="<?php echo $resultarray[0]['phone'];?>" data-ui-mask="(999)-999-9999" data-init-from-form="" placeholder="(___)-___-____" type="text">
					 
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.primaryCellPhoneTemp.$dirty) &amp;&amp; phubfrm.primaryCellPhoneTemp.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
	            </div>
	        </div>
	        <div class="col-lg-6">
	            <div class="form-group">
	                <label for="businessEmail">Email:</label>
	                <input required="" class="form-control input-lg ng-pristine ng-untouched ng-valid ng-valid-email ng-valid-required" name="businessEmail"  data-ng-model="frm.businessEmail" data-ng-pattern="/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,64}$/" placeholder="valid@email.com" value="<?php echo $resultarray[0]['email'];?>" data-init-from-form="" type="text">
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessEmail.$dirty) &amp;&amp; phubfrm.businessEmail.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.businessEmail.$dirty) &amp;&amp; phubfrm.businessEmail.$error.pattern">
			<li class="parsley-required">Enter valid email</li>
		</ul>
	            </div>
	        </div> 
	<?php */ ?>
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
	       
	
	
	
	
	
	
	
	<?php /* ?>
	
	
	        <div class="col-lg-6">
	            <div class="form-group">
	                <label for="bankName">Banking Institution Name:</label>
	               
	                    <input name="bankName" data-ng-model="frm.bankName" required="" data-ng-pattern="/^[a-zA-Z ]+$/" class="form-control ng-pristine ng-untouched  ng-invalid-required ng-valid-maxlength" placeholder="Bank of America etc." value="<?php echo $resultarray[0]['bankName'];?>" data-ng-maxlength="100" data-init-from-form="" type="text">
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
	       
	        <div class="col-lg-6">
	            <div class="form-group">
	                <label for="transitRoutingNo">Routing Number:</label>
	                <input name="transitRoutingNoTemp" required="" data-ng-model="ca.transitRoutingNo" class="form-control input-lg ng-pristine ng-untouched ng-valid-mask  ng-invalid-required" data-ui-mask="999999999" value="<?php echo $resultarray[0]['routingNo'];?>" data-init-from-form="" placeholder="_________" type="text">
					
		<ul class="parsley-errors-list filled ng-hide" data-ng-show="( submitted || phubfrm.transitRoutingNoTemp.$dirty) &amp;&amp; phubfrm.transitRoutingNoTemp.$error.required">
			<li class="parsley-required">This field is required!</li>
		</ul>
	            </div>
	        </div>
	        <br> 
	        <div class="col-lg-6">
	            <div class="form-group">
	            
	            
	            
	            <label for="accountNo">Account Number:</label>
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
		</ul>-->
	            </div>
	        </div> 
	
	
	<?php */ ?>
	
	
	
	
	    </div>
	    
	</div>                                     
    
    
    
    
    
</div>