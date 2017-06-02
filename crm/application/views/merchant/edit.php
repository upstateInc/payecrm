<?php $this->load->view('header');?>

            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>update" enctype="multipart/form-data">     
		<input type="hidden" name="id" id="id" value="<?php echo $query['id']; ?>" /> 
		<div class="form-group">
			<label for="exampleInputEmail1">Company PDF Name*</label>
			<select name="Company_PDF_Name" class="form-control" required>
				<option value="">Select</option>
				<option value="yes" <?php if($query['Company_PDF_Name']=='yes'){?> selected  <?php } ?> >Yes</option>
				<option value="no" <?php if($query['Company_PDF_Name']=='no'){?> selected  <?php } ?>>No</option>
			</select>
		</div>
		
      <div class="form-group">
			<label for="exampleInputEmail1">Center* </label>
			<?php if($query['companyID'] == "" || $query['companyID'] == '0'){?>
				<input type="text" class="form-control" required name="companyID"/>
			<?php } else  { ?>
			<select name="companyID" class="form-control" required disabled>
				<option value="">Select Center</option>
				<?php foreach ($companyIDName->result() as $row){?>
					<option <?php if($query['companyID']==$row->companyID){?> selected  <?php } ?> value="<?php echo $row->companyID; ?>"><?php echo $row->companyID; ?></option>
				<?php } ?>
			</select>
			<?php } ?>
		</div>         

		<div class="form-group">
			<label for="exampleInputEmail1">Company Name*</label>
			<input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" required="required" value="<?php echo $query['company_name']; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Company Phone*</label>
			<input type="text" class="form-control" id="company_phonenumber" name="company_phonenumber" placeholder="Company Phone"  value="<?php echo $query['company_phonenumber']; ?>">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Company Address</label>
			<input type="text" class="form-control" id="company_address" name="company_address" placeholder="Company Address 1" value="<?php echo $query['company_address']; ?>">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Company City</label>
			<input type="text" class="form-control" id="company_City" name="company_City" placeholder="Company City" value="<?php echo $query['company_City']; ?>">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Company State</label>
			<input type="text" class="form-control" id="company_State" name="company_State" placeholder="Company State" value="<?php echo $query['company_State']; ?>">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Company Zipcode</label>
			<input type="text" class="form-control" id="company_Zipcode" name="company_Zipcode" placeholder="Company Zipcode" value="<?php echo $query['company_Zipcode']; ?>">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Company Email*</label>
			<input type="text" class="form-control" id="company_email" name="company_email" placeholder="Company Email" required="required"  value="<?php echo $query['company_email']; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Company Feedback Email</label>
			<input type="text" class="form-control" id="company_feedback_email" name="company_feedback_email" placeholder="Company Feedback Email"  value="<?php echo $query['company_feedback_email']; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Send Feedback Form*</label>
			<select name="send_feedback_form" class="form-control">
				<option value="">Select</option>
				<option value="Yes" <?php if($query['send_feedback_form']=='Yes'){?> selected  <?php } ?>>Yes</option>
				<option value="No" <?php if($query['send_feedback_form']=='No'){?> selected  <?php } ?>>No</option>
			</select>
			</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Company Invoice Email*</label>
			<input type="text" class="form-control" id="company_invoice_email" name="company_invoice_email" placeholder="Company Invoice Email"  value="<?php echo $query['company_invoice_email']; ?>">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Company Invoice Prefix*</label>
			<input type="text" class="form-control" id="company_invoice_prefix" name="company_invoice_prefix" placeholder="Company Invoice Email" value="<?php echo $query['company_invoice_prefix']; ?>">
		</div>
		
		<div class="form-group">
			<label for="exampleInputEmail1">Gorad Email*</label>
			<input type="text" class="form-control" id="Gorad_email" name="Gorad_email" placeholder="Gorad Email" required="required"  value="<?php echo $query['Gorad_email']; ?>">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Gorad Billing Number*</label>
			<input type="text" class="form-control" id="Gorad_Billing_Number" name="Gorad_Billing_Number" placeholder="Gorad Billing Number" required="required"  value="<?php echo $query['Gorad_Billing_Number']; ?>">
		</div>
		
	
		<div class="form-group">
			<label for="exampleInputEmail1">Additional Group Email</label>
			<input type="text" class="form-control" id="Additional_Group_email1" name="Additional_Group_email1" placeholder="Group Emai" value="<?php echo $query['Additional_Group_email1']; ?>">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Tranaction Mode*</label>
			<select name="tranactionMode" id="tranactionMode" class="form-control" required>
				<option value="Auth" <?php if($query['tranactionMode']=="Auth"){?> selected <?php } ?> >Auth</option>
				<option value="Sale" <?php if($query['tranactionMode']=="Sale"){?> selected <?php } ?> >Sale</option>
			</select>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Transaction Update*</label>
			<select name="transactionUpdate" id="transactionUpdate" class="form-control" required>
				<option value="Y" <?php if($query['transactionUpdate']=="Y"){?> selected <?php } ?> >Y</option>
				<option value="N" <?php if($query['transactionUpdate']=="N"){?> selected <?php } ?> >N</option>
			</select>		
		</div>			
		<div class="form-group">
			<label for="exampleInputEmail1">Dublicate Allowed*</label>
			<select name="duplicate" id="duplicate" class="form-control" required>
				<option value="Y" <?php if($query['duplicate']=="Y"){?> selected <?php } ?> >Y</option>
				<option value="N" <?php if($query['duplicate']=="N"){?> selected <?php } ?> >N</option>
			</select>		
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Can Capture*</label>
			<select name="canCapture" id="canCapture" class="form-control" required>
				<option value="Y" <?php if($query['canCapture']=="Y"){?> selected <?php } ?> >Y</option>
				<option value="N" <?php if($query['canCapture']=="N"){?> selected <?php } ?> >N</option>
			</select>		
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Can Void*</label>
			<select name="canVoid" id="canVoid" class="form-control" required>
				<option value="Y" <?php if($query['canVoid']=="Y"){?> selected <?php } ?> >Y</option>
				<option value="N" <?php if($query['canVoid']=="N"){?> selected <?php } ?> >N</option>
			</select>		
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Can Refund*</label>
			<select name="canRefund" id="canRefund" class="form-control" required>
				<option value="Y" <?php if($query['canRefund']=="Y"){?> selected <?php } ?> >Y</option>
				<option value="N" <?php if($query['canRefund']=="N"){?> selected <?php } ?> >N</option>
			</select>		
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Send Email*</label>
			<select name="sendEmail" id="sendEmail" class="form-control" required>
				<option value="Y" <?php if($query['sendEmail']=="Y"){?> selected <?php } ?> >Y</option>
				<option value="N" <?php if($query['sendEmail']=="N"){?> selected <?php } ?> >N</option>
			</select>		
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Technician ID Required*</label>
			<select name="technicianIDRequired" id="technicianIDRequired" class="form-control" required>
				<option value="Y"  <?php if($query['technicianIDRequired']=="Y"){?> selected <?php } ?> >Y</option>
				<option value="N"  <?php if($query['technicianIDRequired']=="N"){?> selected <?php } ?> >N</option>
			</select>		
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Can Chargeback*</label>
			<select name="canChargeback" id="canChargeback" class="form-control" required>
				<option value="Y" <?php if($query['canChargeback']=="Y"){?> selected <?php } ?> >Y</option>
				<option value="N" <?php if($query['canChargeback']=="N"){?> selected <?php } ?> >N</option>
			</select>		
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Show *</label>
			<select name="productNameShow" id="productNameShow" class="form-control" required>
				<option value="product" <?php if($query['productNameShow']=="product"){?> selected <?php } ?> >Product Name</option>
				<option value="sku" <?php if($query['productNameShow']=="sku"){?> selected <?php } ?> >Sku Name</option>
				<option value="skuNo" <?php if($query['productNameShow']=="skuNo"){?> selected <?php } ?> >Sku No.</option>
			</select>		
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Invoice Period*</label>
			<input type="text" class="form-control" id="invoice_period" name="invoice_period" placeholder="Invoice Period" required="required" value="<?php echo $query['invoice_period']; ?>">
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Invoice Type*</label>
			<select name="invoice_type" id="invoice_type" class="form-control" required>
				<option value="Net" <?php if($query['invoice_type']=="Net"){?> selected <?php } ?> >Net</option>
				<option value="Gross" <?php if($query['invoice_type']=="Gross"){?> selected <?php } ?> >Gross</option>
			</select>
		</div>	
		<!----------------------------------Center Fee-------------------------------->
		<div class="form-group">
			<label for="exampleInputEmail1">Service Type</label>
			<select class="form-control" id="service_type" name="service_type" >
				<option value="">Select</option>
				<option <?php if($query['service_type']=="None"){?> selected="selected"<?php } ?> value="None" >None</option>
				<option <?php if($query['service_type']=="Fee"){?> selected="selected"<?php } ?> value="Fee" >Fee</option>
				<option <?php if($query['service_type']=="Discount"){?> selected="selected"<?php } ?> value="Discount" >Discount</option>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Min Percentage</label>
			<input type="text" class="form-control" id="min_percentage" name="min_percentage" placeholder="Min Percentage"  value="<?php echo $query['min_percentage'];?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Max Percentage</label>
			<input type="text" class="form-control" id="max_percentage" name="max_percentage" placeholder="Max Percentage"  value="<?php echo $query['max_percentage'];?>">
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Failed Attempts</label>
			<input type="number" class="form-control" id="failedAttempts" name="failedAttempts" placeholder="Failed Attempts" value="<?php echo $query['failedAttempts'];?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Invoice Mail Sending Address</label>
			<input type="text" class="form-control" id="invoiceEmails" name="invoiceEmails" placeholder="Multiple Email Ids seperated by comma"  value="<?php echo $query['invoiceEmails'];?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Invoice Day</label>
			<select name="invoice_day" id="invoice_day" class="form-control" >
				<option value="0" <?php if($query['invoice_day']==0){ echo 'selected'; }?> >Sunday</option>
				<option value="1" <?php if($query['invoice_day']==1){ echo 'selected'; }?> >Monday</option>
				<option value="2" <?php if($query['invoice_day']==2){ echo 'selected'; }?> >Tuesday</option>
				<option value="3" <?php if($query['invoice_day']==3){ echo 'selected'; }?> >Wednesday</option>
				<option value="4" <?php if($query['invoice_day']==4){ echo 'selected'; }?> >Thusday</option>
				<option value="5" <?php if($query['invoice_day']==5){ echo 'selected'; }?> >Friday</option>
				<option value="6" <?php if($query['invoice_day']==6){ echo 'selected'; }?> >Saturday</option>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Max Sales Amount Allowed</label>
			<input type="number" step="any" class="form-control" id="Max_Sales_Amount_Allowed" name="Max_Sales_Amount_Allowed" placeholder="Max Sales Amount AllowedMax Sales Amount Allowed" value="<?php echo $query['Max_Sales_Amount_Allowed'];?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Mid Selection Process*</label>
			<select name="MidSelectionProcess" id="MidSelectionProcess" class="form-control" required>
				<option value="Y" <?php if($query['MidSelectionProcess']=="Y"){?> selected <?php } ?>  >Y</option>
				<option value="N" <?php if($query['MidSelectionProcess']=="N"){?> selected <?php } ?> >N</option>
			</select>		
		</div>
		<!------------------------------------Emails----------------------------------------->	
		<div class="form-group">
			<label for="exampleInputEmail1">Order Email Allowed*</label>
			<select name="orderEmail" id="orderEmail" class="form-control" required>
				<option value="Y" <?php if($query['orderEmail']=="Y"){?> selected <?php } ?>  >Y</option>
				<option value="N" <?php if($query['orderEmail']=="N"){?> selected <?php } ?> >N</option>
			</select>		
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Feedback Email Allowed*</label>
			<select name="feedbackEmail" id="feedbackEmail" class="form-control" required>
				<option value="Y" <?php if($query['feedbackEmail']=="Y"){?> selected <?php } ?>  >Y</option>
				<option value="N" <?php if($query['feedbackEmail']=="N"){?> selected <?php } ?> >N</option>
			</select>		
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Welcome Email Allowed*</label>
			<select name="welcomeEmail" id="welcomeEmail" class="form-control" required>
				<option value="Y" <?php if($query['welcomeEmail']=="Y"){?> selected <?php } ?>  >Y</option>
				<option value="N" <?php if($query['welcomeEmail']=="N"){?> selected <?php } ?> >N</option>
			</select>		
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Credit Card Hidden*</label>
			<select name="CreditCard_Hidden" id="CreditCard_Hidden" class="form-control" required>
				<option value="Y" <?php if($query['CreditCard_Hidden']=="Y"){?> selected <?php } ?>  >Y</option>
				<option value="N" <?php if($query['CreditCard_Hidden']=="N"){?> selected <?php } ?> >N</option>
			</select>		
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">No. of Reserve Weeks*</label>
			<input type="number" class="form-control" id="nbr_of_reserve_weeks" name="nbr_of_reserve_weeks" placeholder="No. of Reserve Weeks" value="<?php echo $query['nbr_of_reserve_weeks'];?>">
		</div>
 
		<button type="submit" class="btn btn-default">Submit</button>  
      
    </form> 
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		