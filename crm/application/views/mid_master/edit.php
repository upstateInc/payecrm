<?php $this->load->view('header');?>

            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>update" enctype="multipart/form-data">     
    <input type="hidden" name="id" id="id" value="<?php echo $query['id']; ?>" />
          	<div class="form-group">
			<label for="exampleInputEmail1">Payment Type*</label>
			<select class="form-control" id="paymentType" name="paymentType" required="required">
				<option value="">Select</option>
				<option value="credit_card" <?php if($query['paymentType']=="credit_card"){?> selected <?php } ?> >Credit Card</option>
				<option value="echecking" <?php if($query['paymentType']=="echecking"){?> selected <?php } ?>>EChecking</option>
			</select>
		</div>           
		<div class="form-group">
			<label for="exampleInputEmail1">Gateway*</label>
			<input type="text" class="form-control" id="gatewayID" name="gatewayID" placeholder="gateway" required="required" value="<?php echo $query['gatewayID']; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Gateway Type</label>
			<input type="text" class="form-control" id="gatewayType" name="gatewayType" placeholder="Gateway Type" value="<?php echo $query['gatewayType']; ?>" >	
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Program Name</label>
			<input type="text" class="form-control" id="programName" name="programName" placeholder="programName" value="<?php echo $query['programName']; ?>">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Directory</label>
			<input type="text" class="form-control" id="directory" name="directory" placeholder="Directory" value="<?php echo $query['directory']; ?>">
		</div>	
		<div class="form-group">
			<label for="exampleInputEmail1">Descriptor</label>
			<input type="text" class="form-control" id="descriptor" name="descriptor" placeholder="Descriptor" value="<?php echo $query['descriptor']; ?>">
		</div>			
		<div class="form-group">
			<label for="exampleInputEmail1">Username*</label>
			<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $query['username']; ?>">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Password*</label>
			<input type="text" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $query['password']; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Mid Number</label>
			<input type="text" class="form-control" id="mid_number" name="mid_number" placeholder="Mid Number" value="<?php echo $query['mid_number']; ?>">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Key</label>
			<input type="text" class="form-control" id="mid_key" name="mid_key" placeholder="Key" value="<?php echo $query['mid_key']; ?>">
		</div>			
		<div class="form-group">
			<label for="exampleInputEmail1">Link</label>
			<input type="text" class="form-control" id="link" name="link" placeholder="Link" value="<?php echo $query['link']; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Monthly Volume</label>
			<input type="text" class="form-control" id="monthly_volume" name="monthly_volume" placeholder="Monthly Volume" value="<?php echo $query['monthly_volume']; ?>">
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Daily Volume</label>
			<input type="text" class="form-control" id="daily_volume" name="daily_volume" placeholder="Daily Volume" value="<?php echo $query['daily_volume']; ?>">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Daily High Ticket Capture Limit*</label>
			<input type="number" class="form-control" id="dailyHighTicketCapture" name="dailyHighTicketCapture" placeholder="Daily High Ticket Capture Limit" value="<?php echo $query['dailyHighTicketCapture']; ?>" required>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Max Sales Amount*</label>
			<input type="number" step="any" class="form-control" id="MaxSalesAmount" name="MaxSalesAmount" placeholder="Max Sales Amount" value="<?php echo $query['MaxSalesAmount']; ?>" required>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Status*</label>
			<select class="form-control" id="status" name="status" required="required">
				<option value="">Select</option>
				<option value="Y" <?php if($query['status']=="Y"){?> selected="selected"<?php } ?> >Active</option>
				<option value="N" <?php if($query['status']=="N"){?> selected="selected"<?php } ?> >In-Active</option>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Visibility*</label>
			<select class="form-control" id="visibility" name="visibility" required="required">
				<option value="">Select</option>
				<option value="Y" <?php if($query['visibility']=="Y"){?> selected="selected"<?php } ?> >Y</option>
				<option value="N" <?php if($query['visibility']=="N"){?> selected="selected"<?php } ?> >N</option>
			</select>
		</div>		
		<div class="form-group">
			<label for="exampleInputEmail1">Cron*</label>
			<select class="form-control" id="cron" name="cron" required="required">
				<option value="">Select</option>
				<option value="Y" <?php if($query['cron']=="Y"){?> selected="selected"<?php } ?> >Y</option>
				<option value="N" <?php if($query['cron']=="N"){?> selected="selected"<?php } ?> >N</option>
			</select>
		</div>		
		<button type="submit" class="btn btn-default">Submit</button>
    </form> 
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		