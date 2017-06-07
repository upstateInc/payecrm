<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>index" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>update" enctype="multipart/form-data">     
    <input type="hidden" name="id" id="id" value="<?php echo $query['id']; ?>" />   
		<div class="form-group">
			<label for="exampleInputEmail1">Company</label>
			<select name="companyID" class="form-control">
				<option value="">Select Center</option>
				<?php 
				$companyIDName = $this->db->query("Select distinct(companyID) from t_centerdb where visibility='Y' order by companyID ASC");
				foreach ($companyIDName->result() as $row){?>
					<option <?php if($query['companyID']==$row->companyID){?> selected <?php } ?> value="<?php echo $row->companyID; ?>"><?php echo $row->companyID; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail2">Gateway</label>
			<select name="gatewayID" class="form-control">
				<option value="">Select Gateway</option>
				<?php 
				$gateway = $this->db->query("Select distinct(gatewayID) from t_midmaster where visibility='Y' order by gatewayID ASC");
				foreach ($gateway->result() as $row){?>
					<option <?php if($query['gatewayID']==$row->gatewayID){?> selected <?php } ?> value="<?php echo $row->gatewayID; ?>"><?php echo $row->gatewayID; ?></option>
				<?php } ?>
			</select>			
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Invoice No.</label>
			<input type="text" class="form-control" id="invoice_id" name="invoice_id" placeholder="Invoice No." value="<?php echo $query['invoice_id']; ?>" />
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Transaction Id</label>
			<input type="text" class="form-control" id="gatewayTransactionId" name="gatewayTransactionId"  value="<?php echo $query['gatewayTransactionId']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Agent ID.</label>
			<input type="text" class="form-control" id="agentID" name="agentID"  value="<?php echo $query['agentID']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Agent Nane</label>
			<input type="text" class="form-control" id="agentName" name="agentName"  value="<?php echo $query['agentName']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Customer First Nane</label>
			<input type="text" class="form-control" id="fname" name="fname"  value="<?php echo $query['fname']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Customer Last Nane</label>
			<input type="text" class="form-control" id="lname" name="lname"  value="<?php echo $query['lname']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Email</label>
			<input type="text" class="form-control" id="customer_email" name="customer_email"  value="<?php echo $query['customer_email']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Address</label>
			<input type="text" class="form-control" id="customer_address" name="customer_address"  value="<?php echo $query['customer_address']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">City</label>
			<input type="text" class="form-control" id="customer_city" name="customer_city"  value="<?php echo $query['customer_city']; ?>" />
		</div>
		<div class="form-group">
			<label for="exampleInputEmail2">State</label>
			<select name="customer_state" class="form-control">
				<option value="">Select State</option>
				<?php 
				$state = $this->db->query("Select distinct(name) from t_state where status='Y' and countryId='888' order by name ASC");
				foreach ($state->result() as $row){?>
					<option <?php if($query['customer_state']==$row->name){?> selected <?php } ?> value="<?php echo $row->name; ?>"><?php echo $row->name; ?></option>
				<?php } ?>
			</select>			
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Zip</label>
			<input type="text" class="form-control" id="customer_zip" name="customer_zip"  value="<?php echo $query['customer_zip']; ?>" />
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Phone</label>
			<input type="text" class="form-control" id="customer_phone" name="customer_phone"  value="<?php echo $query['customer_phone']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Amount</label>
			<input type="text" class="form-control" id="grossPrice" name="grossPrice"  value="<?php echo $query['grossPrice']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">CardNo</label>
			<input type="text" class="form-control" id="cardNo" name="cardNo"  value="<?php echo $query['cardNo']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Card Type</label>
			<input type="text" class="form-control" id="cardType" name="cardType"  value="<?php echo $query['cardType']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Response Code</label>
			<input type="text" class="form-control" id="reason_code" name="reason_code"  value="<?php echo $query['reason_code']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Response Text</label>
			<input type="text" class="form-control" id="reason_descrption" name="reason_descrption"  value="<?php echo $query['reason_descrption']; ?>" />
		</div>			
		<div class="form-group">
			<label for="exampleInputEmail1">IP Address</label>
			<input type="text" class="form-control" id="ip" name="ip"  value="<?php echo $query['ip']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Descriptor</label>
			<input type="text" class="form-control" id="gateway_descriptor" name="gateway_descriptor"  value="<?php echo $query['gateway_descriptor']; ?>" />
		</div>		
				
		<div class="form-group">
			<label for="exampleInputEmail1">Routing Number</label>
			<input type="text" class="form-control" id="RoutingNumber" name="RoutingNumber"  value="<?php echo $query['RoutingNumber']; ?>" />
		</div>		
				<div class="form-group">
			<label for="exampleInputEmail1">Account Number</label>
			<input type="text" class="form-control" id="AccountNumber" name="AccountNumber"  value="<?php echo $query['AccountNumber']; ?>" />
		</div>		
				<div class="form-group">
			<label for="exampleInputEmail1">Bank Name</label>
			<input type="text" class="form-control" id="BankName" name="BankName"  value="<?php echo $query['BankName']; ?>" />
		</div>		
		
		<div class="form-group">
			<label for="exampleInputEmail1">Check Date</label>
			<input type="text" class="form-control" id="CheckDate" name="CheckDate"  value="<?php echo $query['CheckDate']; ?>" />
		</div>			
		<div class="form-group">
			<label for="exampleInputEmail1">Check Number</label>
			<input type="text" class="form-control" id="CheckNumber" name="CheckNumber"  value="<?php echo $query['CheckNumber']; ?>" />
		</div>			
		<div class="form-group">
			<label for="exampleInputEmail1">PaymentType</label>
			<input type="text" class="form-control" id="paymentType" name="paymentType"  value="<?php echo $query['paymentType']; ?>" />
		</div>			
		<div class="form-group">
			<label for="exampleInputEmail1">Cvv Response</label>
			<input type="text" class="form-control" id="cvvresponse" name="cvvresponse"  value="<?php echo $query['cvvresponse']; ?>" />
		</div>			
		<div class="form-group">
			<label for="exampleInputEmail1">Avs Response</label>
			<input type="text" class="form-control" id="avsresponse" name="avsresponse"  value="<?php echo $query['avsresponse']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Original Transaction Id(In case of Refund)</label>
			<input type="text" class="form-control" id="originalGatewayTransactionId" name="originalGatewayTransactionId"  value="<?php echo $query['originalGatewayTransactionId']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Source</label>
			<input type="text" class="form-control" id="sourceCode" name="sourceCode"  value="<?php echo $query['sourceCode']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Batch Id</label>
			<input type="text" class="form-control" id="batch_id" name="batch_id"  value="<?php echo $query['batch_id']; ?>" />
		</div>		
		
		<div class="form-group">
			<label for="exampleInputEmail1">Status</label>
			<select class="form-control" id="status" name="status" >
				<option value="">Select</option>
				<option value="Authorize" <?php if($query['status']=="Authorize"){?> selected="selected"<?php } ?>>Authorize</option>
				<option value="Capture" <?php if($query['status']=="Capture"){?> selected="selected"<?php } ?>>Capture</option>
				<option value="Void" <?php if($query['status']=="Void"){?> selected="selected"<?php } ?>>Void</option>
				<option value="Sale" <?php if($query['status']=="Sale"){?> selected="selected"<?php } ?>>Sale</option>
				<option value="Settlement" <?php if($query['status']=="Settlement"){?> selected="selected"<?php } ?>>Settlement</option>
				<option value="Refund" <?php if($query['status']=="Refund"){?> selected="selected"<?php } ?>>Refund</option>
				<option value="Chargeback" <?php if($query['status']=="Chargeback"){?> selected="selected"<?php } ?>>Chargeback</option>
				<option value="Failed" <?php if($query['status']=="Failed"){?> selected="selected"<?php } ?>>Failed</option>				
			</select>
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Captured By</label>
			<input type="text" class="form-control" id="captured_by" name="captured_by"  value="<?php echo $query['captured_by']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Captured Date( yyyy-mm-dd)</label>
			<input type="text" class="form-control" id="captured_date" name="captured_date"  value="<?php echo $query['captured_date']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Create Date( yyyy-mm-dd)</label>
			<input type="text" class="form-control" id="rec_crt_date" name="rec_crt_date"  value="<?php echo $query['rec_crt_date']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Update Date( yyyy-mm-dd)</label>
			<input type="text" class="form-control" id="rec_up_date" name="rec_up_date"  value="<?php echo $query['rec_up_date']; ?>" />
		</div>			
		<div class="form-group">
			<label for="exampleInputEmail1">Qc Agent</label>
			<input type="text" class="form-control" id="qc_agentID" name="qc_agentID"  value="<?php echo $query['qc_agentID']; ?>" />
		</div>			
		<div class="form-group">
			<label for="exampleInputEmail1">Qc Date( yyyy-mm-dd)</label>
			<input type="text" class="form-control" id="qc_Date" name="qc_Date"  value="<?php echo $query['qc_Date']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Chargeback Validation</label>
			<select class="form-control" id="chargeback_validation" name="chargeback_validation" >
				<option value="">Select</option>
				<option value="Y" <?php if($query['chargeback_validation']=="Y"){?> selected="selected"<?php } ?>>Y</option>
				<option value="N" <?php if($query['chargeback_validation']=="N"){?> selected="selected"<?php } ?>>N</option>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Chargeback Validation Date( yyyy-mm-dd)</label>
			<input type="text" class="form-control" id="chargeback_validation_date" name="chargeback_validation_date"  value="<?php echo $query['chargeback_validation_date']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Chargeback Agent</label>
			<input type="text" class="form-control" id="chargeback_agentID" name="chargeback_agentID"  value="<?php echo $query['chargeback_agentID']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Attention Required</label>
			<input type="text" class="form-control" id="attention_required" name="attention_required"  value="<?php echo $query['attention_required']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Security Protection</label>
			<input type="text" class="form-control" id="securityProtection" name="securityProtection"  value="<?php echo $query['securityProtection']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Total Devices</label>
			<input type="text" class="form-control" id="totalDevices" name="totalDevices"  value="<?php echo $query['totalDevices']; ?>" />
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Locked</label>
			<select class="form-control" id="locked" name="locked" >
				<option value="">Select</option>
				<option value="Y" <?php if($query['locked']=="Y"){?> selected="selected"<?php } ?>>Y</option>
				<option value="N" <?php if($query['locked']=="N"){?> selected="selected"<?php } ?>>N</option>
			</select>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Validated</label>
			<select class="form-control" id="validated" name="validated" >
				<option value="">Select</option>
				<option value="Y" <?php if($query['validated']=="Y"){?> selected="selected"<?php } ?>>Y</option>
				<option value="N" <?php if($query['validated']=="N"){?> selected="selected"<?php } ?>>N</option>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Rating</label>
			<select class="form-control" id="rating" name="rating" >
				<option value="">Select</option>
				<?php 
				for($i=1;$i<=10;$i++){?>
					<option value="<?php echo $i;?>" <?php if($query['rating']==$i){?> selected="selected"<?php } ?>><?php echo $i;?></option>
				<?php } ?>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Comment</label>
			<textarea class="form-control" id="comment" name="comment" placeholder="Comment"><?php echo $query['comment']; ?></textarea>
		</div>
		

		<button type="submit" class="btn btn-default">Submit</button>
    </form>
	</div>
</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>  
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		