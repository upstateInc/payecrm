<?php $this->load->view('header');
?>
<?php $this->load->view('left');?>
<style>
	.redClass{color:red;}
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
				<input class="form-control" type="number" min="5" id="seconds" name="seconds" placeholder="Seconds" value="<?php echo $seconds;?>" >
			</div>			
			
			<!--div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">gatewayName</label>
			<select name="gatewayName" class="form-control">
				<option value="">Select Gateway</option>
				<?php foreach ($gateway->result() as $row){?>
					<option <?php if($gatewayName==$row->gatewayID){?> selected <?php } ?> value="<?php echo $row->gatewayID; ?>"><?php echo $row->gatewayID; ?></option>
				<?php } ?>
			</select>
			</div>

			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">companyID</label>
			<select name="companyID" class="form-control">
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
			<br/-->			
	
			<div class="form-group">
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			</div>
			<div class="form-group">
				<a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><i class="fa fa-align-justify"></i> Clear</a> 
			</div>
			</div>
			</form>
			
			
<!-------------------------------------------------------------->
			
			
			<?php if($query->num_rows() > 0){?>
            <div class="table-responsive">
            
            <table class="table" style="width:60%;" >
              <thead>
                <tr>
					<th style="text-align:left"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='gatewayID')?'bold':'normal'?>;" href="javascript: hdnSort('gatewayID','<?php echo $order_by; ?>');">Mid Name</a></th>
					
					<th style="text-align:center"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Monthly Volume</a></th>
					
					<th style="text-align:center"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Daily Volume</a></th>
					
					<th style="text-align:center"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Max Sales Amount</a></th>
					
					<th style="text-align:center"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Max Sales</a></th>
					
					<th style="text-align:right"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Authorize</a></th>
                   
				   <th style="text-align:right"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Capture</a></th>
					
					
					<th style="text-align:right"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Sale</a></th>
					
					
					<th style="text-align:right"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Settlement</a></th>
					
					<!--th style="text-align:right"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Refund</a></th-->
					
					
					<!--th style="text-align:right"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');" >Total Sale</a></th-->
					
					
                </tr>
              </thead>
              <tbody>
                
            <?php 
			//if($companyID=="" && $gatewayName==""){
				//$gatewayView = $this->db->query("Select distinct(a.gatewayID) as gatewayID, sum(b.grossPrice) as sum  from  t_midmaster as a left join t_invoice as b on a.gatewayID=b.gatewayID where a.visibility='Y' and b.status='Authorize' group by a.gatewayID order by sum desc");
				//echo $this->db->last_query();
				//$gatewayView = $this->db->query("Select distinct(a.gatewayID) as gatewayID, sum(b.grossPrice) as sum  from  t_midmaster as a left join t_invoice as b on a.gatewayID=b.gatewayID where a.visibility='Y' group by a.gatewayID order by sum desc");
				$gatewayView = $this->db->query("Select distinct(gatewayID) from  t_midmaster where visibility='Y' order by gatewayID asc");
				
			//}
			/*if($companyID!=""){
				$gatewayView = $this->db->query("Select distinct(gatewayName) as gatewayID from  t_gateway where companyID='".$companyID."' and status='Y' order by gatewayID ASC");
			}
			if($gatewayName!=""){
				$gatewayView = $this->db->query("Select distinct(gatewayID) from  t_midmaster where gatewayId='".$gatewayName."' order by gatewayID ASC");
			}*/
			if($where_clause==""){ $where_clause = 1;}
			$numCnt=0;
			$totalAuth=0;			
			$totalCapture=0;			
			$totalSale=0;			
			$totalSettle=0;			
			$totalRefund=0;			
			$totalGoodSale=0;			
			foreach ($gatewayView->result() as $row){
			if($numCnt%2==0){ $clr='#D4E6F1'; }else{  $clr='#F4F6F6'; }
			$sumTot=""; 
			$sumTotCnt=""; 
			
			?>
			<tr bgcolor="<?php echo $clr;?>">
			<?php 
			$SYSTEMMAXSALESALLOWED = $this->db->query('SELECT SYSTEMMAXSALESALLOWED FROM t_system_settings WHERE `id` = 1')->row()->SYSTEMMAXSALESALLOWED;
			$where_clause1 = $where_clause." and gatewayId='".$row->gatewayID."'"; 
			$monthly_limit=$this->db->query('SELECT monthly_volume from t_midmaster where gatewayId="'.$row->gatewayID.'"')->row()->monthly_volume;
			$daily_volume=$this->db->query('SELECT daily_volume from t_midmaster where gatewayId="'.$row->gatewayID.'"')->row()->daily_volume;
			$MaxSalesAmount=$this->db->query('SELECT MaxSalesAmount from t_midmaster where gatewayId="'.$row->gatewayID.'"')->row()->MaxSalesAmount;
			$MaxSales=$this->db->query('SELECT count(*) as cnt from t_invoice where '.$where_clause1.' and grossPrice > '.$SYSTEMMAXSALESALLOWED.' and status="Authorize"')->row()->cnt;			
			?>
			<td style="color:#1B4F72;" ><?php echo $row->gatewayID; ?></td>
			<td style="color:#145A32;" align="center"> <?php echo '$'.number_format($monthly_limit,2);?> </td>
			<td style="color:#145A32;" align="center"> <?php echo '$'.number_format($daily_volume,2);?> </td>
			<td style="color:#145A32;" align="center"> <?php echo '$'.number_format($MaxSalesAmount,2);?> </td>
			<td style="color:#145A32;" align="center"> <?php echo $MaxSales;?> </td>
			<?php

			$totAuth=$this->db->query('SELECT sum(grossPrice) as sum, count(*) as cnt from '.$this->table.' where '.$where_clause1.' and status="Authorize" group by gatewayID')->row();
			//print_r($totAuth);
			//echo $this->db->last_query();
			echo '<td style="color:#145A32;" align="right" >'; 
			$sumTot+=$totAuth->sum; 
			$sumTotCnt+=$totAuth->cnt; 	
			$totalAuth+=$totAuth->sum;			
			if($totAuth->cnt > 0 )echo '$'.number_format($totAuth->sum,2);
			echo '</td>';
			
			$totCap=$this->db->query('SELECT sum(grossPrice) as sum , count(*) as cnt from '.$this->table.' where '.$where_clause1.' and status="Capture" group by gatewayID')->row();
			
			
			$sumTot+=$totCap->sum; 
			$sumTotCnt+=$totCap->cnt;
			$totalCapture+=$totCap->sum;
			?>
				<td style="color:#145A32;" align="right">
					<?php if($totCap->cnt > 0 )echo '$'.number_format($totCap->sum,2);?>
				</td>
			<?php
			$totChargeback=$this->db->query('SELECT sum(grossPrice) as sum , count(*) as cnt from '.$this->table.' where '.$where_clause1.' and status="Chargeback"')->row();
			
			
			
			$totSale=$this->db->query('SELECT sum(grossPrice) as sum , count(*) as cnt from '.$this->table.' where '.$where_clause1.' and status="Sale" group by gatewayID')->row();
					
			
			$sumTot+=$totSale->sum; 
			$sumTotCnt+=$totSale->cnt;
			$totalSale+=$totSale->sum;
			?>
				<td style="color:#145A32;" align="right">
					<?php if($totSale->cnt > 0 )echo '$'.number_format($totSale->sum,2);?>
				</td>
			<?php						
			$totSettle=$this->db->query('SELECT sum(grossPrice) as sum , count(*) as cnt from '.$this->table.' where '.$where_clause1.' and status="Settlement"')->row();
						
			
			$sumTot+=$totSettle->sum; 
			$sumTotCnt+=$totSettle->cnt;
			$totalSettle+=$totSettle->sum;
			?>
				<td style="color:#145A32;" align="right">
					<?php if($totSettle->cnt > 0 )echo '$'.number_format($totSettle->sum,2);?>
				</td>			
			<?php
			$totVoid=$this->db->query('SELECT sum(grossPrice) as sum , count(*) as cnt from '.$this->table.' where '.$where_clause1.' and status="Void"')->row();
			
			

			$totRef=$this->db->query('SELECT sum(grossPrice) as sum , count(*) as cnt from '.$this->table.' where '.$where_clause1.' and status="Refund"')->row();
						
			 
			$sumTot+=$totRef->sum; 
			$sumTotCnt+=$totRef->cnt; 
			$totalRefund+=$totRef->sum;
			
			
			$totalGoodSale += $sumTot;
			/*echo '<td style="color:#145A32;" align="right">';
			if($sumTot > 0){
			echo '$'.number_format($sumTot,2);
			}
			echo '</td>';*/

			
			echo '</tr>';
			$numCnt +=1;
			}
			?>  
				<tr bgcolor="#eeeeee">
					<td align="left"><strong>Total</strong></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td align="right" style="color:#145A32;"><?php if($totalAuth != 0) echo '$'.number_format($totalAuth,2); ?></td>
					<td align="right" style="color:#145A32;"><?php if($totalCapture != 0) echo '$'.number_format($totalCapture,2); ?></td>
					<td align="right" style="color:#145A32;"><?php if($totalSale != 0) echo '$'.number_format($totalSale,2); ?></td>
					<td align="right" style="color:#145A32;"><?php if($totalSettle != 0) echo '$'.number_format($totalSettle,2); ?></td>
					
					<!--td align="right" style="color:#145A32;"><?php if($totalGoodSale != 0)  echo '$'.number_format($totalGoodSale,2); ?></td-->
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


        <!-- Modal -->
        <div class="modal fade" id="send_invoice" tabindex="-1" role="dialog" aria-labelledby="send_invoice" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Resend the following Emails</h4>
                    </div>
                    <form id="resendInvoiceForm" method="POST" action="<?php echo $this->config->item('company_base_url'); ?>resend_invoice.php" >
                        <div class="modal-body" id="">

                            <input type="hidden" id="TextInvoiceId" name="TextInvoiceId" />
							<div class="form-group">
								<label>Welcome</label>
								<input type="checkbox" id="emailType" name="emailType[]" value="1">
								<label>Invoice</label>
								<input type="checkbox" id="emailType" name="emailType[]" value="2">
								<label>Feedback</label>
								<input type="checkbox" id="emailType" name="emailType[]" value="3">
							</div>
							<div class="form-group">
                            <label>Send copy to Customer?</label>
								<input type="checkbox" value="yes" name="SendCustomer">
							</div>
                            <div class="form-group">
                                <label >To Be CC (Multiple Separated By Comma)</label>
                                <input type="text" class="form-control" id="InvoiceCC" name="InvoiceCC" placeholder="Email ID, To CC"  >
                            </div>

                            <div class="form-group">
                                <label >To Be BCC (Multiple Separated By Comma)</label>
                                <input type="text" class="form-control" id="InvoiceBCC" name="InvoiceBCC" placeholder="Email ID, To BCC" >
                            </div>
                            <br>
                            <div class="form-group">
                                <label >Agent Note (It will reflect in email)</label>
                                <input type="text" class="form-control" id="AgentNote" name="AgentNote" placeholder="Agent Note" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		<!-------------------------------Refund-------------------------------------->
        <div class="modal fade" id="send_refund_invoice" tabindex="-1" role="dialog" aria-labelledby="send_invoice" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Send Refund Email</h4>
                    </div>
                    <form id="resendInvoiceForm" method="POST" action="<?php echo $this->config->item('company_base_url'); ?>send_refund_invoice.php" >
                        <div class="modal-body" id="">

                            <input type="hidden" id="RefundInvoiceId" name="RefundInvoiceId" />
							
							<div class="form-group">
                            <label>Send copy to Customer?</label>
								<input type="checkbox" value="yes" name="SendCustomer">
							</div>
                            <div class="form-group">
                                <label >To Be CC (Multiple Separated By Comma)</label>
                                <input type="text" class="form-control"  name="InvoiceCC" placeholder="Email ID, To CC"  >
                            </div>

                            <div class="form-group">
                                <label >To Be BCC (Multiple Separated By Comma)</label>
                                <input type="text" class="form-control"  name="InvoiceBCC" placeholder="Email ID, To BCC" >
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>		
		<!--------------------------------------------------------------------------->

      
<script language="javascript">
	window.onload=function(){ 
		var seconds =jQuery("#seconds").val();
		if(seconds !=""){
			window.setTimeout(document.frmSearch.submit.bind(document.frmSearch), seconds*1000);
		}
	};
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
</script>
        
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		