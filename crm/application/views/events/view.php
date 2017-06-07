<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">                   
	<div class="contentpanel contentpanel-mediamanager">            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>insert" enctype="multipart/form-data">          
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1"><strong>Send By : </strong></label>
					<?php echo $row['senderName'].'('.$row['senderAliasName'].')'; ?>
				</div>
			</div>		  
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Subject : </strong></label>
			<?php echo $row['subject']; ?>
		</div>	 
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Message : </strong></label>
			<?php echo $row['message']; ?>
		</div>
    </form>
	
	<!-------------------Form Section Ends-------------------->
	</div>
</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>
<?php $this->load->view('footer');?>