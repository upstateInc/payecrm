<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
	<strong>Center : </strong><?php echo $query['companyID'];?><br/>
	<strong>Start Date :</strong> <?php echo date("m-d-Y", strtotime($query['start_date']));?><br/>
	<strong>Release Date :</strong> <?php echo date("m-d-Y", strtotime($query['release_date']));?><br/>
	<strong>Amount :</strong> <?php echo '$'.number_format($query['amount'],2);?><br/>
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>update" enctype="multipart/form-data">     
    <input type="hidden" name="id" id="id" value="<?php echo $query['id']; ?>" /> 
	    <!--div class="form-group">
			<label for="exampleInputEmail1">Center*</label>
			<select name="companyID" class="form-control" required>
				<option value="">Select Center</option>
				<?php foreach ($companyIDName->result() as $row){?>
					<option <?php if($query['companyID']==$row->companyID){ echo 'selected';}?> value="<?php echo $row->companyID; ?>"><?php echo $row->companyID; ?></option>
				<?php } ?>
			</select>
		</div-->    
		<?php
		$parts = explode('-',$query['payment_date']);
		$yyyy_mm_dd =  $parts[1] . '-' . $parts[2]. '-' .$parts[0];
        ?>
		<div class="form-group">
			<label for="exampleInputEmail1"><strong>Payment Date*</strong></label>
			<input type="text" class="form-control" id="datepiker" name="payment_date" placeholder="Payment Date" required="required" value="<?php if($parts[1]!="00") echo $yyyy_mm_dd;?>">
		</div>

		<!--div class="form-group">
			<label for="exampleInputEmail1">Status*</label>
			<select class="form-control" id="status" name="status" required="required">
				<option value="">Select</option>
				<option value="Y" <?php if($query['status']=="Y"){?> selected="selected"<?php } ?> >Active</option>
				<option value="N" <?php if($query['status']=="N"){?> selected="selected"<?php } ?> >In-Active</option>
			</select>
		</div-->
      
      
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    
 
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>
  <script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
	// When the document is ready
	$(document).ready(function () {
		$('.dtpkr').datepicker({
			format: "mm-dd-yyyy"
		});
		$('#datepiker1').datepicker({
			format: "mm-dd-yyyy"
		});
		
		$('#datepiker').datepicker({
			format: "mm-dd-yyyy",
			minDate: new Date(),
		});
		
		$('.dp').on('change', function () {
			$('.datepicker').hide();
			var startDate = new Date($('#datepiker').val());
			var endDate = new Date($('#datepiker1').val());
			if(startDate!="" && endDate!=''){
				if (startDate > endDate){
					//alert('End Date Connot be Less than Start Date');
					// Do something
					jQuery(".errSuccessRoutineMsg").show();
					jQuery(".errSuccessRoutineMsg").html('End Date Connot be Less than Start Date');
					jQuery("#datepiker1").val("");
					setTimeout(function() {
						$('.errSuccessRoutineMsg').fadeOut('fast');
					}, 5000);
				}
			}			
		});
	});
</script>    
		<?php $this->load->view('footer');?>