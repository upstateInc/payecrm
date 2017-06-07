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
			<div class="well" style="padding:1px !important; background-color:#fff !important;">
			<!--input type="hidden" name="hdnOrderBy" id="hdnOrderBy" value="<?php echo $order_by; ?>"/>
			<input type="hidden" name="hdnOrderByFld" id="hdnOrderByFld" value="<?php echo $order_by_fld; ?>"/>						
			<input type="hidden" name="search" value="search"/>
			<div class="form-group">
			
			<select name="gatewayName" class="form-control">
				<option value="">Select Gateway</option>
				<?php foreach ($gateway->result() as $row){?>
					<option <?php if($gatewayName==$row->gatewayID){?> selected <?php } ?> value="<?php echo $row->gatewayID; ?>"><?php echo $row->gatewayID; ?></option>
				<?php } ?>
			</select>
			</div>
			
			<div class="form-group">
			
			<select name="companyID" class="form-control">
				<option value="">Select Center</option>
				<?php foreach ($companyIDName->result() as $row){?>
					<option <?php if($companyID==$row->companyID){?> selected <?php } ?> value="<?php echo $row->companyID; ?>"><?php echo $row->companyID; ?></option>
				<?php } ?>
			</select>
			</div>
			<div class="form-group">
				<select name="cardType" id="cardType" class="form-control">
				<option value="">Payment Type</option>
				<?php foreach ($cardTypeName->result() as $row){?>
					<option <?php if($cardType==$row->cardType){?> selected <?php } ?> value="<?php echo $row->cardType; ?>"><?php echo $row->cardType; ?></option>
				<?php } ?>
				</select>
			</div>			
			<div class="form-group">			
				<input type="text" id="datepiker" name="start_date" placeholder="Start date" value="<?php echo $start_date;?>" class="dp form-control">
			</div>
			<!--div class="form-group">			
				<input type="text" id="datepiker1" name="end_date" placeholder="End end" value="<?php echo $end_date;?>" class="dp form-control" >
			</div>
			<br/>
			<br/>			
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Customer Name</label>
			<input type="text" id="customer_name" name="customer_name" placeholder="Customer Name" value="<?php echo $customer_name;?>" class="form-control">
			</div-->			
			<!--div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">status</label>
			<select  name="status" class="form-control">
				<option value="">Select Status</option>
				<option value="Authorize" <?php if($status=='Authorize'){?> selected <?php } ?>>Authorize</option>
				<option value="Capture" <?php if($status=='Capture'){?> selected <?php } ?>>Capture</option>
				<option value="Sale" <?php if($status=='Sale'){?> selected <?php } ?> >Sale</option>				
			</select>
			</div-->
			
			<!--div class="form-group">
			
			<select class="form-control" id="validated" name="validated" >
				<option value="">Validated</option>
				<option value="Y" <?php if($validated=="Y"){?> selected="selected"<?php } ?>>Y</option>
				<option value="N" <?php if($validated=="N"){?> selected="selected"<?php } ?>>N</option>
			</select>
			</div-->
			

			<!--div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">status</label>
			<select  name="status" class="form-control">
				<option value="">Select Status</option>
				<option value="Authorize" <?php if($status=="Authorize"){?> selected <?php } ?> >Authorize</option>
				<option value="Capture" <?php if($status=="Capture"){?> selected <?php } ?>>Capture</option>
				<option value="Void" <?php if($status=="Void"){?> selected <?php } ?>>Void</option>
				<option value="Refund" <?php if($status=="Refund"){?> selected <?php } ?>>Refund</option>
				<option value="Sale" <?php if($status=="Sale"){?> selected="selected"<?php } ?>>Sale</option>
				<option value="Settlement" <?php if($status=="Settlement"){?> selected="selected"<?php } ?>>Settle</option>
				<option value="Failed" <?php if($status=="Failed"){?> selected="selected"<?php } ?>>Failed</option>
			</select>
			</div-->			


			<!--div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Customer Phone</label>
			<input type="text" id="customer_phone" name="customer_phone" placeholder="Customer Phone" value="<?php echo $customer_phone;?>" class="form-control">
			</div>
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Customer Email</label>
			<input type="text" id="customer_email" name="customer_email" placeholder="Customer Email" value="<?php echo $customer_email;?>" class="form-control">
			</div>
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Credit Card</label>
			<input type="text" id="cardNo" name="cardNo" placeholder="Credit Card No" value="<?php echo $cardNo;?>" class="form-control">
			</div-->			
			

			
			<!--div class="form-group">
			<h3>Validated? <input type="radio" value="Y"	name="validated" <?php if($validated=="Y"){?> checked <?php } ?> >Yes
			<input type="radio" value="N"	name="validated" <?php if($validated=="N"){?> checked <?php } ?> >No</h3>
			</div-->
		
			
			<!--div class="form-group">
				<input type="text" id="gatewayTransactionId" name="gatewayTransactionId" placeholder="Transaction Id" value="<?php echo $gatewayTransactionId;?>" class="form-control">
			</div-->	


			
			<!--div class="form-group">
				<input type="text" id="invoice_id" name="invoice_id" placeholder="Invoice No" value="<?php echo $invoice_id;?>" class="form-control">
			</div>
			<div class="form-group">
				<select name="paymentType" id="paymentType" class="form-control">
					<option value="">Payment Type</option>
					<option <?php if($paymentType=="credit_card"){?> selected  <?php } ?> value="credit_card">Credit Card</option>
					<option <?php if($paymentType=="echecking"){?> selected  <?php } ?> value="echecking">Echecking</option>
				</select>
			</div-->
		
			<!--div class="form-group">
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			</div>
		
			<div class="form-group">
				<a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><i class="fa fa-align-justify"></i> Clear </a>	
			</div-->			
			</div>
			</form>
				<?php //echo '<h4 style="text-align:center;color:#339933;">Total Sales : $'.number_format($queryTotalPrice, 2).'</h3>';?>	
			
			
<!-------------------------------------------------------------->
			<?php if($where_clause==""){ $where_clause = 1;}
			$totAuth=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and status="Authorize"')->row()->sum;
			$totCap=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and status="Capture"')->row()->sum;
			$totRef=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and status="Refund"')->row()->sum;
			$totSale=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and status="Sale"')->row()->sum;
			$totSettle=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and status="Settlement"')->row()->sum;
			$totVoid=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and status="Void"')->row()->sum;
			$totFailed=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and status="Failed"')->row()->sum;
			?>
			
			<h5 style="text-align:center;">
			<?php /*if($totAuth!=""){?> 
			<span style="color:#339933;">Auth: $<?php echo number_format($totAuth,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Authorize"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>
			<?php if($totCap!=""){?> 
			<span style="color:#339933;">Capture: $<?php echo number_format($totCap,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Capture"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php } ?>

			<?php if($totSale!=""){?> 
			<span style="color:#339933;">Sale : $<?php echo number_format($totSale,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Sale"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }*/?>

			<?php /*if($totVoid!=""){?> 
			<span style="color:#FF0000;">Void : $<?php echo number_format($totVoid,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Void"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>
			<?php if($totFailed!=""){?> 
			<span style="color:#FF0000;">Failed : $<?php echo number_format($totFailed,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Failed"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>
			</h5>
			<?php echo $where_clause;*/?>
			<!--h5 style="text-align:center;color:#339933;">
			<?php /*if($totSettle!=""){?> 
			<span style="color:#339933;">Settle: $<?php echo number_format($totSettle,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Settlement"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }*/?>
			<?php /*if($totRef!=""){?> 
			<span style="color:#FF0000;">Refund : $<?php echo number_format($totRef,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Refund"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }*/?>
			<?php /*$settleCnt=$this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Settlement"')->num_rows();?>
			<?php $refCnt=$this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Refund"')->num_rows();*/?>						
			<!--span style="color:#339933;">
			Total Sales: $<?php echo number_format($totSettle+$totRef,2);?>(<?php echo $settleCnt;?>)
			<!--Total Sales : $<?php echo number_format($totSettle+$totRef,2);?>(<?php echo $settleCnt+$refCnt;?>)
			</span-->
			</h5>
			<?php if($query->num_rows() > 0){?>
            <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
					<!--th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='gatewayID')?'bold':'normal'?>;" href="javascript: hdnSort('gatewayID','<?php echo $order_by; ?>');">Gateway</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='companyID')?'bold':'normal'?>;" href="javascript: hdnSort('companyID','<?php echo $order_by; ?>');">Center</a></th>
                    <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='rec_crt_date')?'bold':'normal'?>;" href="javascript: hdnSort('rec_crt_date','<?php echo $order_by; ?>');">Date</a></th-->
					
					<!--th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='company_name')?'bold':'normal'?>;" href="javascript: hdnSort('company_name','<?php echo $order_by; ?>');">Company</a></th-->
					
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='rec_crt_date')?'bold':'normal'?>;" href="javascript: hdnSort('rec_crt_date','<?php echo $order_by; ?>');">Date</a></th>
					
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_name')?'bold':'normal'?>;" href="javascript: hdnSort('customer_name','<?php echo $order_by; ?>');">Name</a></th>
					
					<th style="width:100px;"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_phone')?'bold':'normal'?>;" href="javascript: hdnSort('customer_phone','<?php echo $order_by; ?>');">Phone </a></th>
					
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='product_name')?'bold':'normal'?>;" href="javascript: hdnSort('product_name','<?php echo $order_by; ?>');">Email</a></th>
					
					<!--th ><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_email')?'bold':'normal'?>;" href="javascript: hdnSort('customer_email','<?php echo $order_by; ?>');">Product</a></th-->
					
					<th ><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='grossPrice')?'bold':'normal'?>;" href="javascript: hdnSort('grossPrice','<?php echo $order_by; ?>');">Amount</a></th>

					<!--th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='productDuration')?'bold':'normal'?>;" href="javascript: hdnSort('productDuration','<?php echo $order_by; ?>');">Duration</a></th>
					
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='securityProtection')?'bold':'normal'?>;" href="javascript: hdnSort('securityProtection','<?php echo $order_by; ?>');">Security</a></th>
					
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='totalDevices')?'bold':'normal'?>;" href="javascript: hdnSort('totalDevices','<?php echo $order_by; ?>');">Devices</a></th-->
					
					
					
					
					

					<!--th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='grossPrice')?'bold':'normal'?>;" href="javascript: hdnSort('grossPrice','<?php echo $order_by; ?>');">Amount</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='cardType')?'bold':'normal'?>;" href="javascript: hdnSort('cardType','<?php echo $order_by; ?>');">Payment</a></th-->
					<!--th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='validated')?'bold':'normal'?>;" href="javascript: hdnSort('validated','<?php echo $order_by; ?>');">Validated</a></th-->
					<!--th>Status</th-->
					<th colspan="2"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Action</a></th>
					
                </tr>
              </thead>
              <tbody>
                
              <?php foreach ($query->result() as $row){   ?> 
                <tr id="recordRow<?php echo $row->id; ?>" <?php if($row->status=="Refund" || $row->status=="Void" || $row->status=="Chargeback" || $row->status=="Failed"){?> class="redClass" <?php } ?> <?php if($row->status=="Failed" && $row->reason_descrption!=""){?> 
				title="<?php echo "Failure Reason : ".$row->reason_descrption;?>" <?php } ?>>
					<!--td><?php echo $row->gatewayID; ?></td>
					<td><?php echo $row->companyID; ?></td>
					<td><?php echo date('m-d-Y',strtotime($row->rec_crt_date));?></td-->
					
					<!--td><?php echo $row->company_name; ?></td-->
					<td><?php echo date('m-d-Y',strtotime($row->rec_crt_date));?></td>
					<td><?php echo $row->fname.' '.$row->lname; ?></td>
					<td><?php echo $row->customer_phone; ?></td>
					<td><?php echo $row->customer_email; ?></td>
					
					<!--td><?php echo $row->product_name; ?></td-->					
					
					<td><?php if($row->grossPrice < 0) echo '-$'. number_format(abs($row->grossPrice), 2); else echo '$'. number_format($row->grossPrice, 2); ?></td>
					
					<!--td><?php echo $row->productDuration; ?></td>
					
					<td><?php echo $row->securityProtection; ?></td>
					<td><?php echo $row->totalDevices; ?></td-->
					
					
					
					<!--td><?php echo '$'. number_format($row->grossPrice, 2); ?></td>
					<td><?php echo $row->cardType; ?></td-->
					<!--td><?php 
						if($row->validated=='Y'){ ?>
							<div id="statusDiv<?php echo $row->id; ?>">
							<a href='javascript: void(0);' onclick='javascript: change_status("<?php echo $row->id; ?>","N");'><?php print active_icon(); ?></a></div>
						<?php }else{ ?>
							<div id="statusDiv<?php echo $row->id; ?>">
							<a href='javascript: void(0)' onclick='javascript: change_status("<?php echo $row->id; ?>","Y");'><?php print inactive_icon(); ?></a></div>
						<?php	}
					?>
					</td-->
					<!--td><?php echo $row->status;?></td-->
					

                  
				
					<td >
				   <!---------------------------------------------------------------------------------------------------------->
					<div class="btn-group">
					<?php
					//if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ 
					?>
						<a href="<?php echo site_url($this->controllerFile.'edit/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></a>
					</div>	
						<!--a target="_blank" href="<?php echo site_url($this->controllerFile.'pop/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-search"></span></a-->
						<!--a href="#" class="btn btn-primary btn-xs" onclick="javascript:var r=confirm('Are you sure to delete?'); if(r==true) { window.location.href='<?php 
						echo site_url($this->controllerFile.'/delete_single/'.$row->id);?>'; }" ><span class="glyphicon glyphicon-trash"> Delete</span> </a-->
					<?php // } ?>
					</td>
					<td>
					<div class="btn-group">
						<a href="javascript:;" class="btn btn-info btn-xs" data-toggle="modal" data-target="#send_invoice" onclick="SetInvoiceId('<?php echo md5($row->id); ?>');"><span aria-hidden="true" class="fa fa-envelope-o"></span> Emails</a>
					</div>
                  </td>
                </tr>
               <?php } ?>  
                
              </tbody>
            </table>
           
            </div>
		
		<?php echo $paginator; ?>			
    <?php } ?>
            
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>

<!--------------------------------Email Popup--------------------------->
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
<!---------------------------------------------------------------------->
        
        
        

        
<script language="javascript">
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
function change_trans_status(id, val, name)
{
	//alert(val);	
	//$('#statusDiv'+id).html('<img src="<?php echo base_url(); ?>images/admin/loading.gif" alt=""/>');
	var r=confirm("Are you sure to change the state of transaction record for "+name+" ?"); 
	if (r == true) {	
	$.post('<?php echo base_url(); ?>master_success/change_trans_type', 'id='+id+'&val='+val, function(data){
		if(data) 
		{				
				$("#msgDiv").show("");
				//$('#msgDiv').html('Status Changed Successfully');
				$('#msgDiv').html(data);
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
				location.reload();					
		}
	});
	}
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
function change_status(id, val)
{	
	$('#statusDiv'+id).html('<img src="<?php echo base_url(); ?>images/admin/loading.gif" alt=""/>');
	$.post('<?php echo base_url().$this->controllerFile; ?>/change_is_active', 'id='+id+'&val='+val, function(data){
		if(data) 
		{
			if(val == 'Y')
			{
				var val2 = "'N'";
				var text = '<a href="javascript: void(0);" onclick="javascript: change_status('+id+','+val2+');"><?php print active_icon(); ?></a>';
				$('#statusDiv'+id).html(text);
				$("#msgDiv").show("");
				$('#msgDiv').html('Record activated successfully');
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
				
			}
			else
			{
				var val2 = "'Y'";
				var text = '<a href="javascript: void(0);" onclick="javascript: change_status('+id+','+val2+');"><?php print inactive_icon(); ?></a>';
				$('#statusDiv'+id).html(text);
				$("#msgDiv").show("");
				$('#msgDiv').html('Record inactivated successfully');
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
				
			}
		}
	});
}
</script>
<script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
	// When the document is ready
	$(document).ready(function () {
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
		
		
		
		
		
		
		
		
		
		