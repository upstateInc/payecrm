<?php 
$this->load->view('header');
$this->load->view('left');
if($selectedEmails1!=""){
	$pieceEmail=explode(",",$selectedEmails1);
}
?>
<style>
	.redClass{color:red;}
</style>
<div class="mainpanel">
<?php
if($query->num_rows() == 0)
{
	echo '<div class="alert alert-warning no-radius no-margin padding-sm" role="alert"><strong><i class="fa fa-warning"></i> Warning:</strong> No Records Found.</div>';
}	

//0 for Sunday, 6 for Saturday
$monday= (int)date("w")-1; // monday=1;
//echo $pad;
$date = date('m/d/Y');
$date = strtotime($date);
$date = strtotime("-".$monday." day", $date);
$start_date = date('m/d/Y', $date);
?>
<!------------------------search section------------------------>			
			<div class="errSuccessRoutineMsg alert alert-warning no-radius no-margin padding-sm" style="display:none;"></div>
			<form class="form-inline" role="form" name="frmSearch" id="frmSearch" action="<?php echo base_url().$this->controllerFile; ?>generate" method="POST" >
			<div class="well">
			<input type="hidden" name="hdnOrderBy" id="hdnOrderBy" value="<?php echo $order_by; ?>"/>
			<input type="hidden" name="hdnOrderByFld" id="hdnOrderByFld" value="<?php echo $order_by_fld; ?>"/>						
			<input type="hidden" name="search" value="search"/>
			<input type="hidden" name="selectedEmails1" id="selectedEmails1" value="<?php echo $selectedEmails1;?>"/>
			<input type="hidden" name="invoiceDay" id="invoiceDay" value="<?php echo $invoiceDay;?>"/>
			
			<div class="form-group">			
				<input type="text" id="datepiker" name="start_date" placeholder="Start date" value="<?php echo $start_date;?>" class="dp form-control" required />
			</div>
			
			<div class="form-group" >
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Generate</button>
			</div>
			<div class="form-group" >
				<a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><i class="fa fa-align-justify"></i> Clear </a>
				</div>
			</form>	
			</div>
			


            
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>

<script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		
		$('#datepiker').datepicker({
			dateFormat: 'mm-dd-yyyy',
			minDate: new Date(),
		}); 
		$('.dp').on('change', function () {
			$('.datepicker').hide();
			var startDate = new Date($('#datepiker').val());
			
						
		});
	});

	$("#datepiker").on('change', function(){
		$("#datepiker11").val($(this).val());
	});	

</script>
        
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		