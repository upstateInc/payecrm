<?php $this->load->view('header');?>
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
						
			<div class="form-group">
				<label class="sr-only" for="exampleInputEmail2">Customer Name</label>
				<input type="text" id="customer_name" name="customer_name" placeholder="Customer First Name/Last Name " value="<?php echo $customer_name;?>" class="form-control">
			</div>
			
			<div class="form-group">
				<label class="sr-only" for="exampleInputEmail2">Customer Phone</label>
				<input type="text" id="customer_phone" name="customer_phone" placeholder="Customer Phone" value="<?php echo $customer_phone;?>" class="form-control">
			</div>
			
			<div class="form-group">
				<input type="text" id="invoice_id" name="invoice_id" placeholder="Invoice No" value="<?php echo $invoice_id;?>" class="form-control">
			</div>
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Credit Card</label>
			<input type="text" id="cardNo" name="cardNo" placeholder="Last 4 Credit Card No" value="<?php echo $cardNo;?>" class="form-control">
			</div>	
<br/>			
<br/>
			<div class="form-group">
				<label class="sr-only" for="exampleInputEmail2">Customer ID</label>
				<input type="text" id="customerId" name="customerId" placeholder="Customer ID" value="<?php echo $customerId;?>" class="form-control">
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			</div>
			<div class="form-group">
				<a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><i class="fa fa-align-justify"></i> Clear</a> 
			</div>
			</div>
			</form>
			<?php //echo '<h4 style="text-align:center;color:#339933;">Total Sales : $'.number_format($queryTotalPrice, 2).'</h4>';?>
			
			<?php if($query->num_rows() >= $searchLimit && $where_clause!="" ){ ?>
				<div class="alert alert-danger">
					<strong>Your search resulted in too many records. You will need to add more information to your search to return more accurate records.</strong>
				</div>
			<?php } ?>
	
			<?php if($query->num_rows() > 0 && $where_clause!=""){?>
            <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
					
					
                    <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='rec_crt_date')?'bold':'normal'?>;" href="javascript: hdnSort('rec_crt_date','<?php echo $order_by; ?>');">Created</a></th>
					
					<!--th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='invoice_id')?'bold':'normal'?>;" href="javascript: hdnSort('invoice_id','<?php echo $order_by; ?>');">Invoice No.</a></th-->
					

					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_name')?'bold':'normal'?>;" href="javascript: hdnSort('customer_name','<?php echo $order_by; ?>');">Name</a></th>
					
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='gateway_descriptor')?'bold':'normal'?>;" href="javascript: hdnSort('gateway_descriptor','<?php echo $order_by; ?>');">Billing Company</a></th>
					
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_phone')?'bold':'normal'?>;" href="javascript: hdnSort('customer_phone','<?php echo $order_by; ?>');">Phone</a></th>
					
					
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='grossPrice')?'bold':'normal'?>;" href="javascript: hdnSort('grossPrice','<?php echo $order_by; ?>');">Amount</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Add Notes</a></th>
					<?php
					/*if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ 
					?>
					<th colspan="2"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Notes</a></th>
					<?php }*/ ?>
					
                </tr>
              </thead>
              <tbody>
                
              <?php foreach ($query->result() as $row){   ?> 
                <tr id="recordRow<?php echo $row->id; ?>" <?php if($row->status=="Refund" || $row->status=="Void" || $row->status=="Chargeback" || $row->status=="Failed"){?> class="redClass" <?php } ?> <?php if($row->status=="Failed" && $row->reason_descrption!=""){?> 
				title="<?php echo "Failure Reason : ".$row->reason_descrption;?>" <?php } ?>>
						
					
					
					<td><?php echo date('m-d-Y',strtotime($row->rec_crt_date));?></td>

					<!--td><?php echo substr($row->invoice_id, 3); ?></td-->					

					<td><?php echo $row->fname.' '.$row->lname; ?></td>
					<td><?php echo $row->gateway_descriptor; ?></td>
					
					<td><?php echo $row->customer_phone; ?></td>
					
					<td><?php if($row->grossPrice < 0) echo '$'. number_format(abs($row->grossPrice), 2); else echo '$'. number_format($row->grossPrice, 2); ?></td>
					<td>
					<?php
					/*$notes="";
					$notes=$this->db->query("select notes from t_customer_notes where master_id=".$row->id."")->row()->notes;
					echo stripslashes($notes);*/
					?>
					
					<!--textarea name="notes" id="notes<?php echo $row->id;?>" value="" rows="5" cols="30"></textarea>
					<input type="button" class="btn btn-primary btn-sm" name="add_notes" value="Add Notes" onclick="addNotes('<?php echo $row->id; ?>');" /-->
					<a href="<?php echo base_url().$this->controllerFile; ?>details/<?php echo $row->id;?>">Details</a>
					</td>
					
					               

				 
					
					
					<?php
					/*if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ 
					?>
					<td >
					<div class="btn-group">	
						
						<!--a href="<?php echo site_url($this->controllerFile.'pop/'.$row->id);?>" class="btn btn-primary btn-xs" target="_blank"><span class="glyphicon glyphicon-search"></span></a-->
						
						<!--------------------------------Emails---------------------------------->
						<div class="btn-group">
						
						 <a href="javascript:;" class="btn btn-info btn-xs" data-toggle="modal" data-target="#showDetails" onclick="showDetails('<?php echo $row->id; ?>');"><span aria-hidden="true" class="glyphicon glyphicon-search"></span></a>
						
						</div>
						<!--------------------------------Emails---------------------------------->
					</div>
					</td>
					<?php }*/ ?>
                   
                </tr>
               <?php } ?>  
                
              </tbody>
            </table>
           
            </div>
		
		<?php //echo $paginator; ?>			
    <?php } ?>
            
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>


 <!----------------------------------Modal--------------------------------------->
<div class="modal fade" id="showDetails" tabindex="-1" role="dialog" aria-labelledby="send_invoice" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Notes</h4>
			</div>                    
			<div class="modal-body" id="detailsView">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				
			</div>                    
		</div>
	</div>
</div>
<!----------------------------------Modal Ends---------------------------------->		

      
<script language="javascript">
function delete_single(id){
	//alert(id);
	var r = confirm("Are you sure to delete!");
	if (r == true) {
		
		$.post('<?php echo base_url().$this->controllerFile; ?>/delete_single', 'id='+id, function(data){
		if(data) 
		{
				/*$('#msgDiv').html(data);
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});	*/
				jQuery("#notesDisplay"+id).hide('slow');				
		}
		});
	} 
}
function showDetails(id){
	$.post('<?php echo base_url().$this->controllerFile; ?>/showDetails', 'id='+id, function(data){
		if(data) 
		{
			jQuery("#detailsView").html(data);
				/*$("#msgDiv").show("");
				$('#msgDiv').html('Status Changed Successfully');
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
				//alert("Tansaction record for "+name+" changed successfully");
				location.reload();	*/				
		}
		});
}
function addNotes(master_id){
	var notes=jQuery("#notes"+master_id).val();
	if(notes.length > 2){
	//alert(notes);
		$("#msgDiv").show("");
		$('#msgDiv').html('Request Sent.. Please wait For Response!');	
		$.post('<?php echo base_url().$this->controllerFile; ?>/addNotes', 'master_id='+master_id+'&notes='+notes, function(data){
		if(data) 
		{
				$('#msgDiv').html(data);
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
				//alert("Tansaction record for "+name+" changed successfully");
				//location.reload();	
				jQuery("#notes"+master_id).val('');				
		}
		});
	}else{
		$("#errMsgDiv").show("");
		$('#errMsgDiv').html("Enter Note First to Proceed.");
		$('#errMsgDiv').delay(3000).fadeOut('slow', function() {});
	}
}
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
						//$('#msgDiv').html('Status Changed Successfully');
						$('#msgDiv').html(data);
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
				//$('#msgDiv').html('Status Changed Successfully');
				$('#msgDiv').html(data);
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
				//$('#msgDiv').html('Status Changed Successfully');
				$('#msgDiv').html(data);
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
			//$('#msgDiv').html('Status Updated Successfully');
			
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
		
		
		
		
		
		
		
		
		
		