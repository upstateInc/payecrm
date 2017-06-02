<?php $this->load->view('header');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>insert" enctype="multipart/form-data">     
 	
		<div class="form-group">
			<label for="exampleInputEmail1">Company PDF Name*</label>
			<select name="Company_PDF_Name" class="form-control" required>
				<option value="">Select</option>
				<option value="yes">Yes</option>
				<option value="no">No</option>
			</select>
		</div>
		
      <div class="form-group">
			<label for="exampleInputEmail1">Center*</label>
			<!--select name="companyID" class="form-control" required>
				<option value="">Select Center</option>
				<?php foreach ($companyIDName->result() as $row){?>
					<option value="<?php echo $row->companyID; ?>"><?php echo $row->companyID; ?></option>
				<?php } ?>
			</select-->
			<input type="text" class="form-control" id="companyID" name="companyID" placeholder="Company ID" required="required" value="">
		</div>         

		<div class="form-group">
			<label for="exampleInputEmail1">Company Name*</label>
			<input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" required="required" value="">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Company Phone*</label>
			<input type="text" class="form-control" id="company_phonenumber" name="company_phonenumber" placeholder="Company Phone"  value="">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Company Address 1</label>
			<input type="text" class="form-control" id="company_address1" name="company_address1" placeholder="Company Address 1" value="">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Company Address 2</label>
			<input type="text" class="form-control" id="company_Address2" name="company_Address2" placeholder="Company Address 2" value="">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Company City</label>
			<input type="text" class="form-control" id="company_City" name="company_City" placeholder="Company City" value="">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Company State</label>
			<input type="text" class="form-control" id="company_State" name="company_State" placeholder="Company State" value="">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Company Zipcode</label>
			<input type="text" class="form-control" id="company_Zipcode" name="company_Zipcode" placeholder="Company Zipcode" value="">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Company Email*</label>
			<input type="text" class="form-control" id="company_email" name="company_email" placeholder="Company Email" required="required"  value="">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Company Feedback Email</label>
			<input type="text" class="form-control" id="company_feedback_email" name="company_feedback_email" placeholder="Company Feedback Email"  value="">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Send Feedback Form*</label>
			<select name="send_feedback_form" class="form-control">
				<option value="">Select</option>
				<option value="Yes">Yes</option>
				<option value="No">No</option>
			</select>
			</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Company Invoice Email*</label>
			<input type="text" class="form-control" id="company_invoice_email" name="company_invoice_email" placeholder="Company Invoice Email"  value="">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Company Invoice Prefix*</label>
			<input type="text" class="form-control" id="company_invoice_prefix" name="company_invoice_prefix" placeholder="Company Invoice Email" value="">
		</div>
		<!--div class="form-group">
			<label for="exampleInputEmail1">Company Crm*</label>
			<input type="text" class="form-control" id="company_CRM" name="company_CRM" placeholder="Company CRM" required="required"  value="">
		</div-->		
		<div class="form-group">
			<label for="exampleInputEmail1">Gorad Email*</label>
			<input type="text" class="form-control" id="Gorad_email" name="Gorad_email" placeholder="Gorad Email" required="required"  value="">
		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Gorad Billing Number*</label>
			<input type="text" class="form-control" id="Gorad_Billing_Number" name="Gorad_Billing_Number" placeholder="Gorad Billing Number" required="required"  value="">
		</div>
		
		<!--div class="form-group">
			<label for="exampleInputEmail1">Database Host*</label>
			<input type="text" class="form-control" id="directory" name="db_host" placeholder="Database Host" required="required" value="" >	
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Database Username*</label>
			<input type="text" class="form-control" id="db_username" name="db_username" placeholder="Database Username" required="required" value="">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Database Password*</label>
			<input type="text" class="form-control" id="db_password" name="db_password" placeholder="Database Password" required="required"  value="">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Database Name*</label>
			<input type="text" class="form-control" id="db_name" name="db_name" placeholder="Database Name" required="required" value="">
		</div-->	
		<div class="form-group">
			<label for="exampleInputEmail1">Additional Group Email</label>
			<input type="text" class="form-control" id="Additional_Group_email1" name="Additional_Group_email1" placeholder="Group Emai" value="">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Tranaction Mode*</label>
			<select name="tranactionMode" id="tranactionMode" class="form-control" required>
				<option value="Auth">Auth</option>
				<option value="Sale">Sale</option>
			</select>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Transaction Update*</label>
			<select name="transactionUpdate" id="transactionUpdate" class="form-control" required>
				<option value="Y">Y</option>
				<option value="N">N</option>
			</select>		
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Dublicate Allowed*</label>
			<select name="duplicate" id="duplicate" class="form-control" required>
				<option value="Y"  >Y</option>
				<option value="N"  >N</option>
			</select>		
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Can Capture*</label>
			<select name="canCapture" id="canCapture" class="form-control" required>
				<option value="Y" >Y</option>
				<option value="N" > >N</option>
			</select>		
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Can Void*</label>
			<select name="canVoid" id="canVoid" class="form-control" required>
				<option value="Y"  >Y</option>
				<option value="N"  >N</option>
			</select>		
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Can Refund*</label>
			<select name="canRefund" id="canRefund" class="form-control" required>
				<option value="Y"  >Y</option>
				<option value="N"  >N</option>
			</select>		
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Can Chargeback*</label>
			<select name="canChargeback" id="canChargeback" class="form-control" required>
				<option value="Y"  >Y</option>
				<option value="N"  >N</option>
			</select>		
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Send Email*</label>
			<select name="sendEmail" id="sendEmail" class="form-control" required>
				<option value="Y"  >Y</option>
				<option value="N"  >N</option>
			</select>		
		</div>			
		<div class="form-group">
			<label for="exampleInputEmail1">Technician ID Required*</label>
			<select name="technicianIDRequired" id="technicianIDRequired" class="form-control" required>
				<option value="Y"  >Y</option>
				<option value="N"  >N</option>
			</select>		
		</div>		
		
		<div class="form-group">
			<label for="exampleInputEmail1">Show *</label>
			<select name="productNameShow" id="productNameShow" class="form-control" required>
				<option value="product" >Product Name</option>
				<option value="sku" >Sku Name</option>
				<option value="skuNo" >Sku No.</option>
			</select>		
		</div>	
		
		<div class="form-group">
			<label for="exampleInputEmail1">Invoice Period*</label>
			<input type="text" class="form-control" id="invoice_period" name="invoice_period" placeholder="Invoice Period" required="required" value="">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Invoice Type*</label>
			<select name="invoice_type" id="invoice_type" class="form-control" required>
				<option value="Net"  >Net</option>
				<option value="Gross"  >Gross</option>
			</select>
		</div>
		<!----------------------------------Center Fee-------------------------------->
		<div class="form-group">
			<label for="exampleInputEmail1">Service Type</label>
			<select class="form-control" id="service_type" name="service_type" >
				<option value="">Select</option>
				<option value="None" >None</option>
				<option value="Fee" >Fee</option>
				<option value="Discount" >Discount</option>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Min Percentage</label>
			<input type="text" class="form-control" id="min_percentage" name="min_percentage" placeholder="Min Percentage">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Max Percentage</label>
			<input type="text" class="form-control" id="max_percentage" name="max_percentage" placeholder="Max Percentage">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Failed Attempts</label>
			<input type="number" class="form-control" id="failedAttempts" name="failedAttempts" placeholder="Failed Attempts">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Invoice Mail Sending Address</label>
			<input type="text" class="form-control" id="invoiceEmails" name="invoiceEmails" placeholder="Multiple Email Ids seperated by comma"  value="">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Invoice Day</label>
			<select name="invoice_day" id="invoice_day" class="form-control" >
				<option value="0">Sunday</option>
				<option value="1">Monday</option>
				<option value="2">Tuesday</option>
				<option value="3">Wednesday</option>
				<option value="4">Thusday</option>
				<option value="5">Friday</option>
				<option value="6">Saturday</option>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Max Sales Amount Allowed</label>
			<input type="number" step="any" class="form-control" id="Max_Sales_Amount_Allowed" name="Max_Sales_Amount_Allowed" placeholder="Max Sales Amount AllowedMax Sales Amount Allowed" value="">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Mid Selection Process*</label>
			<select name="MidSelectionProcess" id="MidSelectionProcess" class="form-control" required>
				<option value="Y" >Y</option>
				<option value="N" >N</option>
			</select>		
		</div>
		<!------------------------------------Emails----------------------------------------->	
		<div class="form-group">
			<label for="exampleInputEmail1">Order Email Allowed*</label>
			<select name="orderEmail" id="orderEmail" class="form-control" required>
				<option value="Y"   >Y</option>
				<option value="N"  >N</option>
			</select>		
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Feedback Email Allowed*</label>
			<select name="feedbackEmail" id="feedbackEmail" class="form-control" required>
				<option value="Y"   >Y</option>
				<option value="N"  >N</option>
			</select>		
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Welcome Email Allowed*</label>
			<select name="welcomeEmail" id="welcomeEmail" class="form-control" required>
				<option value="Y"   >Y</option>
				<option value="N"  >N</option>
			</select>		
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Credit Card Hidden*</label>
			<select name="CreditCard_Hidden" id="CreditCard_Hidden" class="form-control" required>
				<option value="Y" >Y</option>
				<option value="N" >N</option>
			</select>		
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">No. of Reserve Weeks*</label>
			<input type="number" class="form-control" id="nbr_of_reserve_weeks" name="nbr_of_reserve_weeks" placeholder="No. of Reserve Weeks" value="">
		</div>			
		
      
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    
 
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		