<?php 
$this->load->view('header');
if($where_clause==""){ $where_clause = 1;}
?>
<?php $this->load->view('left');?>
<style>
	.redClass{color:red;}
	.table tbody {
		height: 400px;
		overflow: auto;
	}
	.table thead > tr,.table tbody{
		display:block;	
	}
</style>
<div class="mainpanel">
	<?php
      if($query->num_rows() == 0){
	   		echo '<div class="alert alert-warning no-radius no-margin padding-sm" role="alert"><strong><i class="fa fa-warning"></i> Warning:</strong> No Records Found.</div>';
	  } 
		
		
			
	 ?>
<!------------------------search section------------------------>			
			<div class="errSuccessRoutineMsg alert alert-warning no-radius no-margin padding-sm" style="display:none;"></div>
			<form class="form-inline" role="form" name="frmSearch" id="frmSearch" action="<?php echo base_url().$this->controllerFile; ?>" method="POST" >
			<div class="well">
			<input type="hidden" name="hdnOrderBy" id="hdnOrderBy" value="<?php echo $order_by; ?>"/>
			<input type="hidden" name="hdnOrderByFld" id="hdnOrderByFld" value="<?php echo $order_by_fld; ?>"/>						
			<input type="hidden" name="search" value="search"/>
			
			<div class="form-group"><?php //echo date('Y-m-d',strtotime('-1 Monday'));?>
				<select name="select_report" class="form-control" onchange="this.form.submit()">				
					<option value="">Select Report</option>					
					<option value="3" <?php if($select_report==3)echo 'selected';?>>Current Day</option>
					<option value="2" <?php if($select_report==2)echo 'selected';?> >Current Week</option>
					<option value="1" <?php if($select_report==1)echo 'selected';?> >Current Month</option>
					<option value="4" <?php if($select_report==4)echo 'selected';?>>Current Year</option>				
				</select>
			</div>
			
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">gatewayName</label>
			<select name="gatewayName" id="gatewayName" class="form-control">
				<option value="">Select Gateway</option>
				<?php foreach ($gateway->result() as $row){?>
					<option <?php if($gatewayName==$row->gatewayID){?> selected <?php } ?> value="<?php echo $row->gatewayID; ?>"><?php echo $row->gatewayID; ?></option>
				<?php } ?>
			</select>
			</div>

			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">companyID</label>
			<select name="companyID" id="companyID" class="form-control">
				<option value="">Select Center</option>
				<?php foreach ($companyIDName->result() as $row){?>
					<option <?php if($companyID==$row->companyID){?> selected <?php } ?> value="<?php echo $row->companyID; ?>"><?php echo $row->companyID; ?></option>
				<?php } ?>
			</select>
			</div>
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Start date</label>
			<input type="text" id="datepiker" name="start_date" placeholder="Start date" value="<?php echo $start_date;?>" class="dp form-control">
			</div>

			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Start end</label>
			<input type="text" id="datepiker1" name="end_date" placeholder="End end" value="<?php echo $end_date;?>" class="dp form-control" >
			</div>			

			<br/>
			<br/>					
	
			<div class="form-group" >
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			</div>
			<div class="form-group" >
				<a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><i class="fa fa-align-justify"></i> Clear</a> 
			</div>
			</form>
			<!--br/>
			<br/-->
			<!--form name="frmGenerate" id="frmGenerate" action="<?php echo base_url().$this->controllerFile.'download'; ?>" method="POST" >
			<input type="hidden" name="gatewayName" id="gatewayName1" value="<?php echo $gatewayName;?>"/>
			<input type="hidden" name="companyID" id="companyID1" value="<?php echo $companyID;?>"/>
			<input type="hidden" name="start_date" id="datepiker11" value="<?php echo $start_date;?>"/>
			<input type="hidden" name="end_date" id="datepiker111" value="<?php echo $end_date;?>"/>			
			<div class="form-group">				
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-download"></span> Download Spreadsheet</button>
			</div>	
			</form-->
			
			</div>
			
		
			
<!-------------------------------------------------------------->
			
			
			<?php if($query->num_rows() > 0){?>
            <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
					<th style="text-align:left;width:100px;" ><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='companyID')?'bold':'normal'?>;" href="javascript: hdnSort('companyID','<?php echo $order_by; ?>');">Center</a></th>
					<th style="text-align:left;width:250px;"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Reason Description</a></th>
					<th style="text-align:left;width:250px;"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Reason Code</a></th>
					<th style="text-align:right;width:150px;"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Failed Amount</a></th>
                    <th style="text-align:left;width:100px;"></th>										
                </tr>
              </thead>
              <tbody>
                
            <?php 
			if($companyID=="" && $gatewayName==""){
				$gatewayView = $this->db->query("Select distinct(companyID) from t_centerdb where visibility='Y' order by companyID ASC");
			}
			if($companyID!=""){
				$gatewayView = $this->db->query("Select distinct(companyID) from t_centerdb where companyID='".$companyID."' order by companyID ASC");
			}
			if($gatewayName!=""){
				$gatewayView = $this->db->query("Select distinct(companyID) from t_gateway where gatewayName='".$gatewayName."' order by companyID ASC");
			}
			
			$numCnt=0;
			$totalAuth=0;			
			$totalCapture=0;			
			$totalSale=0;			
			$totalSettle=0;			
			$totalRefund=0;			
			$totalChargeback=0;			
			$totalGoodSale=0;
			$sumTotFailedCnt=0;			
			foreach ($gatewayView->result() as $row){
			if($numCnt%2==0){ $clr='#D4E6F1'; }else{  $clr='#F4F6F6'; }
			$sumTot=""; 
			$sumTotCnt=""; 
			
			?>
			<tr>
			<?php $where_clause1 = $where_clause." and companyID='".$row->companyID."'"; 
			$CurrentCompany=$row->companyID;
			?>
			<td style="color:#1B4F72;width:100px;" ><?php echo $row->companyID; ?></td>
			<td style="width:250px;"></td>
			<td style="width:250px;"></td>			
			<?php
			$totFailed=$this->db->query('SELECT sum(grossPrice) as sum , count(*) as cnt from '.$this->table.' where '.$where_clause1.' and status="Failed"')->row();?>
						
			<td style="color:#E74C3C;" align="right">
			<?php
			
			$sumTotFailedCnt+=$totFailed->cnt;
			$totalFailed+=$totFailed->sum;
			if($totFailed->cnt > 0 )echo '$'.number_format($totFailed->sum,2).'('.$totFailed->cnt.')';
						

			?> 
			</td>
			<td style="width:100px;">
				<button class="btn btn-success btn-xs" data-parent="#resultArea"  id="gatewayItem<?php echo $row->companyID;?>" data-toggle="collapse" data-target=".<?php echo $row->companyID; ?>" aria-expanded="false" aria-controls="collapseExample" >+</button>
			</td>
			</tr>
			<?php
				$individualDesc=$this->db->query("SELECT Count(*) as cnt,`reason_code`,`reason_descrption`, SUM(  `grossPrice` ) as sum FROM `t_invoice` WHERE status='Failed' and `companyID`='".$row->companyID."' group by `reason_descrption`");
				foreach($individualDesc->result() as $centerRow){
			?>
				<tr class="collapse <?php echo $row->companyID;?>">
					<td style="width:100px;"></td>
					<td style="width:250px;"><?php echo $centerRow->reason_descrption;?></td>
					<td style="width:250px;" ><?php echo $centerRow->reason_code;?></td>
					<td style="color:#E74C3C;width:150px;" align="right"><?php echo '$'.number_format($centerRow->sum,2).'('.$centerRow->cnt.')';?></td>
					<td style="width:100px;"></td>
				</tr>
			<?php } } ?>
				<tr bgcolor="#eeeeee">
					<td style="width:100px;" align="left" ><strong>Total</strong></td>
					<td style="width:250px;"></td>
					<td style="width:250px;"></td>
					<td style="width:150px;color:#E74C3C;" align="right" ><?php if($totalFailed != 0)  echo '$'.number_format($totalFailed,2).'('.$sumTotFailedCnt.')'; ?></td>
					<td style="width:100px;"></td>
				</tr>
              </tbody>
            </table>
           
            </div>
		
		<?php //echo $paginator; ?>			
		<?php } ?>
            
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>


        

      
<script language="javascript">
	$('button').click(function(){
		$(this).text(function(i,old){
			return old=='+' ?  '-' : '+';
		});
	});
   function SetInvoiceId(id){
		$('#TextInvoiceId').val(id);
		$('#RefundInvoiceId').val(id);
	}
	$('#resendInvoiceForm').submit(function() {
		var total=$(this).find('input[name="emailType[]"]:checked').length;
		//alert(total);
		if(total<1){
			alert("Select at least 1 Email Type");
			return false;
		}
	});	
	function changeProduct (invoice_id, companyID, productPeriod, productId){
		//alert(productId);
		var r=confirm("Are you sure to change the Product of Record?");
		if (r == true) {
			$.post('<?php echo base_url().$this->controllerFile; ?>changeProduct', 'invoice_id='+invoice_id+'&companyID='+companyID+'&productId='+productId+"&productPeriod="+productPeriod, function(data){
				if(data) 
				{
					$("#msgDiv").show("");
					$('#msgDiv').html('Product Information Changed Successfully');
					$('#msgDiv').delay(5000).fadeOut('slow', function() {});
					location.reload();					
				}
			});			
		}
	}
	function changeProductInfo (id, invoice_id, companyID){
		var r=confirm("Are you sure to change the Product Information?");
		if (r == true) {
			var productId = jQuery("#productId"+id).val();
			var product_name = jQuery("#product_name"+id).val();
			var productPeriod = jQuery("#productPeriod"+id).val();
			var productDuration = jQuery("#productDuration"+id).val();

			$.post('<?php echo base_url().$this->controllerFile; ?>changeProductInfo', 'invoice_id='+invoice_id+'&companyID='+companyID+'&productId='+productId+'&product_name='+product_name+'&productPeriod='+productPeriod+'&productDuration='+productDuration, function(data){
				if(data) 
				{
					$("#msgDiv").show("");
					$('#msgDiv').html('Product Information Changed Successfully');
					$('#msgDiv').delay(5000).fadeOut('slow', function() {});
					location.reload();					
				}
			});			
		}
	}
	function check_status(gatewayTransactionId,gatewayID,companyID){
	$('.bolt').show();
	$('#bolt'+gatewayTransactionId).html('<img src="<?php echo base_url(); ?>images/loading.gif" alt=""/>');
	$.post('<?php echo base_url().$this->controllerFile; ?>check_status', 'gatewayTransactionId='+gatewayTransactionId+'&gatewayID='+gatewayID+'&companyID='+companyID, function(data){		
		$('#bolt'+gatewayTransactionId).html('');
		$('#bolt'+gatewayTransactionId).hide("slow");
		$('.statInfo').hide("slow");
		$('#statInfo'+gatewayTransactionId).html(data);
		$('#statInfo'+gatewayTransactionId).show("slow");
	});
}
function discard(gatewayTransactionId){	
	$('#statInfo'+gatewayTransactionId).hide("slow");
	$('#bolt'+gatewayTransactionId).show("slow");
}
function change_trans_status(id, val, name)
{
		if(val=='Chargeback'){
			var r=confirm("Are you sure to change the state of transaction record for "+name+" and use Present Date?"); 
		}else{
			var r=confirm("Are you sure to change the state of transaction record for "+name+" ?"); 
		}
		if (r == true) {
			if(val=='Refund'){
				jQuery("#refundAmount"+id+"").show();
			}
			else{
				$.post('<?php echo base_url().$this->controllerFile; ?>change_trans_type', 'id='+id+'&val='+val, function(data){
					if(data) 
					{
						$("#msgDiv").show("");
						$('#msgDiv').html('Status Changed Successfully');
						$('#msgDiv').delay(5000).fadeOut('slow', function() {});
						//alert("Tansaction record for "+name+" changed successfully");
						location.reload();					
					}
				});
			}
		}else if(r == false && val=='Chargeback'){
			//alert('ok');
			jQuery("#dateChargeback"+id+"").show();
		}
}
function change_trans_status2(id, val, name){
	var recDate=jQuery("#datepiker"+id+"").val();
	//alert(date);
	$.post('<?php echo base_url().$this->controllerFile; ?>change_trans_type', 'id='+id+'&val='+val+'&recDate='+recDate, function(data){
		if(data) 
		{
				$("#msgDiv").show("");
				$('#msgDiv').html('Status Changed Successfully');
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
				//alert("Tansaction record for "+name+" changed successfully");
				location.reload();					
		}
	});
}
function change_trans_status3(id, val, name){
	var amount=jQuery("#amount"+id+"").val();
	//alert(amount);
	//alert(date);
	$.post('<?php echo base_url().$this->controllerFile; ?>change_trans_type', 'id='+id+'&val='+val+'&amount='+amount, function(data){
		if(data) 
		{
				$("#msgDiv").show("");
				$('#msgDiv').html('Status Changed Successfully');
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
				//alert("Tansaction record for "+name+" changed successfully");
				location.reload();					
		}
	});
}
function hdnSort(name, type)
{
	//alert(name);
	document.frmSearch.hdnOrderByFld.value = name;
	if(type == 'ASC')
		document.frmSearch.hdnOrderBy.value = 'DESC';
	else
		document.frmSearch.hdnOrderBy.value = 'ASC';
	document.frmSearch.submit();
}
function change_center_status(id, val, companyID)
{	
	$('#statusDiv'+id).html('<img src="<?php echo base_url(); ?>images/admin/loading.gif" alt=""/>');
	$.post('<?php echo base_url().$this->controllerFile; ?>change_center_status', 'id='+id+'&val='+val+'&companyID='+companyID, function(data){
		if(data) 
		{
			/*if(val == 'Y')
			{
				var val2 = "'N'";
				var text = '<?php print active_icon(); ?>';
				$('#statusDiv'+id).html(text);
				$("#msgDiv").show("");
				$('#msgDiv').html('Center Record Status Changed Successfully');
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
				
			}
			else
			{
				var val2 = "'Y'";
				var text = '<a href="javascript: void(0);" onclick="javascript: change_status('+id+','+val2+');"><?php print inactive_icon(); ?></a>';
				$('#statusDiv'+id).html(text);
				$("#msgDiv").show("");
				$('#msgDiv').html('Center Record Status Changed Successfully');
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
				
			}*/
			$("#msgDiv").show("");
			$('#msgDiv').html('Status Updated Successfully');
			$('#msgDiv').delay(5000).fadeOut('slow', function() {});
			alert("Status Updated Successfully");
			location.reload();
		}
	});
}
</script>
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
	
	$("#gatewayName").on('change', function(){
		$("#gatewayName1").val($(this).val());
	});		
	$("#companyID").on('change', function(){
		$("#companyID1").val($(this).val());
	});	
	$("#datepiker").on('change', function(){
		$("#datepiker11").val($(this).val());
	});	
	$("#datepiker1").on('change', function(){
		$("#datepiker111").val($(this).val());
	});	
	
</script>
        
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		