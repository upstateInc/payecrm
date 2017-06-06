<?php $this->load->view('header');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>insert" enctype="multipart/form-data">     
      		<div class="form-group">
			<label for="exampleInputEmail1">Payment Type*</label>
			<select class="form-control" id="paymentType" name="paymentType" required="required">
				<option value="">Select</option>
				<option value="credit_card">Credit Card</option>
				<option value="echecking">EChecking</option>
			</select>
		</div>    		
		<div class="form-group">
			<label for="exampleInputEmail1">Gateway*</label>
			<input type="text" class="form-control" id="gatewayID" name="gatewayID" placeholder="Gateway" required="required" value="">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Gateway Type</label>
			<input type="text" class="form-control" id="gatewayType" name="gatewayType" placeholder="Gateway Type" value="" >	
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Program Name</label>
			<input type="text" class="form-control" id="programName" name="programName" placeholder="Program Name" value="">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Directory</label>
			<input type="text" class="form-control" id="directory" name="directory" placeholder="Directory" value="">
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Descriptor</label>
			<input type="text" class="form-control" id="descriptor" name="descriptor" placeholder="Descriptor" value="">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Username*</label>
			<input type="text" class="form-control" id="username" name="username" placeholder="Username" required="required" value="">
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Password*</label>
			<input type="text" class="form-control" id="password" name="password" placeholder="Password" required="required" value="">
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Mid Number</label>
			<input type="text" class="form-control" id="mid_number" name="mid_number" placeholder="Mid Number" value="">
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Key</label>
			<input type="text" class="form-control" id="mid_key" name="mid_key" placeholder="Key" value="">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Link</label>
			<input type="text" class="form-control" id="link" name="link" placeholder="Link" value="">
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Monthly Volume</label>
			<input type="text" class="form-control" id="monthly_volume" name="monthly_volume" placeholder="Monthly Volume" value="">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Daily Volume</label>
			<input type="text" class="form-control" id="daily_volume" name="daily_volume" placeholder="Daily Volume" value="">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Daily High Ticket Capture Limit*</label>
			<input type="number" class="form-control" id="dailyHighTicketCapture" name="dailyHighTicketCapture" placeholder="Daily High Ticket Capture Limit" value="" required>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Max Sales Amount*</label>
			<input type="number" step="any" class="form-control" id="MaxSalesAmount" name="MaxSalesAmount" placeholder="Max Sales Amount" value="" required>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Status*</label>
			<select class="form-control" id="status" name="status" required="required">
				<option value="">Select</option>
				<option value="Y" >Active</option>
				<option value="N" >In-Active</option>
			</select>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Visibility*</label>
			<select class="form-control" id="visibility" name="visibility" required="required">
				<option value="">Select</option>
				<option value="Y" >Y</option>
				<option value="N" >N</option>
			</select>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Cron*</label>
			<select class="form-control" id="cron" name="cron" required="required">
				<option value="">Select</option>
				<option value="Y" >Y</option>
				<option value="N" >N</option>
			</select>
		</div>
      
      
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    
 
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		