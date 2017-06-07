<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">                   
	<div class="contentpanel contentpanel-mediamanager">            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>insert" enctype="multipart/form-data">          
		<div class="form-group">
			<label for="exampleInputEmail1">Subject*(Only for reference to keep track of the message. This will not be shown in the dashboard.)</label>
			<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required="required">
		</div>	 
		<div class="form-group">
			<label for="exampleInputEmail1">Message*</label>
			<textarea name="message" class="form-control" id="message" placeholder="Message" required="required" ></textarea>
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
    </form>
	<!-------------------Form Section Ends-------------------->
	</div>
</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>
<?php $this->load->view('footer');?>