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
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">status</label>
			<select  name="status" class="form-control">
				<option value="">Select Status</option>
				<option value="Authorize" <?php if($status=='Authorize'){?> selected <?php } ?>>Authorize</option>
				<option value="Capture" <?php if($status=='Capture'){?> selected <?php } ?>>Capture</option>
				<option value="Sale" <?php if($status=='Sale'){?> selected <?php } ?> >Sale</option>				
			</select>
			</div>
			
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
		
			<div class="form-group">
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			</div>
		
			<div class="form-group">
				<a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><i class="fa fa-align-justify"></i> Clear </a>	
			</div>			
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
			<?php if($totAuth!=""){?> 
			<span style="color:#339933;">Auth: $<?php echo number_format($totAuth,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Authorize"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>
			<?php if($totCap!=""){?> 
			<span style="color:#339933;">Capture: $<?php echo number_format($totCap,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Capture"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>

			<?php if($totSale!=""){?> 
			<span style="color:#339933;">Sale : $<?php echo number_format($totSale,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Sale"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>

			<?php /*if($totVoid!=""){?> 
			<span style="color:#FF0000;">Void : $<?php echo number_format($totVoid,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Void"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>
			<?php if($totFailed!=""){?> 
			<span style="color:#FF0000;">Failed : $<?php echo number_format($totFailed,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Failed"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>
			</h5>
			<?php echo $where_clause;*/?>
			<!--h5 style="text-align:center;color:#339933;">
			<?php if($totSettle!=""){?> 
			<span style="color:#339933;">Settle: $<?php echo number_format($totSettle,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Settlement"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>
			<?php /*if($totRef!=""){?> 
			<span style="color:#FF0000;">Refund : $<?php echo number_format($totRef,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Refund"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }*/?>
			<?php $settleCnt=$this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Settlement"')->num_rows();?>
			<?php $refCnt=$this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Refund"')->num_rows();?>						
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
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='gatewayID')?'bold':'normal'?>;" href="javascript: hdnSort('gatewayID','<?php echo $order_by; ?>');">Gateway</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='companyID')?'bold':'normal'?>;" href="javascript: hdnSort('companyID','<?php echo $order_by; ?>');">Center</a></th>
                    <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='rec_crt_date')?'bold':'normal'?>;" href="javascript: hdnSort('rec_crt_date','<?php echo $order_by; ?>');">Date</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='fname')?'bold':'normal'?>;" href="javascript: hdnSort('fname','<?php echo $order_by; ?>');">Name</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_phone')?'bold':'normal'?>;" href="javascript: hdnSort('customer_phone','<?php echo $order_by; ?>');">Phone</a></th>
					
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='grossPrice')?'bold':'normal'?>;" href="javascript: hdnSort('grossPrice','<?php echo $order_by; ?>');">Amount</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='cardType')?'bold':'normal'?>;" href="javascript: hdnSort('cardType','<?php echo $order_by; ?>');">Payment Type</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='validated')?'bold':'normal'?>;" href="javascript: hdnSort('validated','<?php echo $order_by; ?>');">Validated</a></th>
					<!--th>Status</th-->
					<th colspan="2"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Action</a></th>
					
                </tr>
              </thead>
              <tbody>
                
              <?php foreach ($query->result() as $row){   ?> 
                <tr id="recordRow<?php echo $row->id; ?>" <?php if($row->status=="Refund" || $row->status=="Void" || $row->status=="Chargeback" || $row->status=="Failed"){?> class="redClass" <?php } ?> <?php if($row->status=="Failed" && $row->reason_descrption!=""){?> 
				title="<?php echo "Failure Reason : ".$row->reason_descrption;?>" <?php } ?>>
					<td><?php echo $row->gatewayID; ?></td>
					<td><?php echo $row->companyID; ?></td>
					<td><?php echo date('m-d-Y',strtotime($row->rec_crt_date));?></td>
					<td><?php echo $row->fname.' '.$row->lname; ?></td>
					<td><?php echo $row->customer_phone; ?></td>

					<td><?php echo '$'. number_format($row->grossPrice, 2); ?></td>
					<td><?php echo $row->cardType; ?></td>
					<td><?php 
						if($row->validated=='Y'){ ?>
							<div id="statusDiv<?php echo $row->id; ?>">
							<a href='javascript: void(0);' onclick='javascript: change_status("<?php echo $row->id; ?>","N");'><?php print active_icon(); ?></a></div>
						<?php }else{ ?>
							<div id="statusDiv<?php echo $row->id; ?>">
							<a href='javascript: void(0)' onclick='javascript: change_status("<?php echo $row->id; ?>","Y");'><?php print inactive_icon(); ?></a></div>
						<?php	}
					?>
					</td>
					<!--td><?php echo $row->status;?></td-->
                  <td>
					
                  
				   <!------------------------------------------Void/Refund---------------------------------------------------->
				   <?php
					$row_gateway = $this->common_model->Retrive_Record_By_Where_Clause('t_midmaster',"gatewayID like '%".$row->gatewayID."%'");
					//print_r($row_gateway);
					if($row_gateway['gatewayType']=='nmi'){
					$current = strtotime(date("Y-m-d"));
					$timestamp = strtotime($row->rec_crt_date);
					$datediff = $timestamp - $current;
					$difference = floor($datediff/(60*60*24));
					?>
					<select id="status<?php echo $row->id; ?>" name="status" onchange='change_trans_status("<?php echo $row->id; ?>",this.value, "<?php echo preg_replace(" /[^A-Za-z0-9\-]/", " ", $row->customer_name); ?>");' <?php if($row->status!="Sale" && $row->status!="Capture" && $row->status!="Settlement" && $row->status!="Authorize" && $row->status!="" ){?> disabled <?php }if($row->lock=='Y'){?> disabled <?php } ?>>
						<?php if($row->status=="Authorize"){?>
							<option value="Authorize" <?php if($row->status=="Authorize"){?> selected="selected"<?php } ?>>Authorize</option>
							<option value="Capture" <?php if($row->status=="Capture"){?> selected="selected"<?php } ?>>Capture</option>
							<option value="Void" <?php if($row->status=="Void"){?> selected="selected"<?php } ?>>Void</option>	
						<?php } ?>
						<?php if($row->status=="Capture"){?>
							<option value="Capture" <?php if($row->status=="Capture"){?> selected="selected"<?php } ?>>Capture</option>
							<option value="Void" <?php if($row->status=="Void"){?> selected="selected"<?php } ?>>Void</option>	
						<?php } ?>
						<?php if($row->status=="Sale"){?>
							<option value="Sale" <?php if($row->status=="Sale"){?> selected="selected"<?php } ?>>Sale</option>
							<option value="Void" <?php if($row->status=="Void"){?> selected="selected"<?php } ?>>Void</option>
						<?php }?>
						<?php if($row->status=="Settled"){?>
							<option value="Settled" <?php if($row->status=="Settled"){?> selected="selected"<?php } ?>>Settled</option>
							<option value="Refund" <?php if($row->status=="Refund"){?> selected="selected"<?php } ?>>Refund</option>
						<?php } ?>
						<?php if($row->status=="Void"){?>
							<option value="Void" <?php if($row->status=="Void"){?> selected="selected"<?php } ?>>Void</option>
						<?php } ?>
						<?php if($row->status=="Refund"){?>
							<option value="Refund" <?php if($row->status="Refund"){?> selected="selected"<?php } ?>>Refund</option>
						<?php } ?>
						<?php if($row->status=="Settlement"){?>
							<option value="Settlement" <?php if($row->status=="Settlement"){?> selected="selected"<?php } ?>>Settle</option>
							<option value="Refund" <?php if($row->status=="Refund"){?> selected="selected"<?php } ?>>Refund</option>
						<?php } ?>
						<?php if($row->status=="Failed"){?>
							<option value="Failed" <?php if($row->status="Failed"){?> selected="selected"<?php } ?>>Failed</option>
						<?php } ?>
					</select>
					<?php }else if($row_gateway['link']!=''){?>
						<a target="_blank" href="<?php echo $row_gateway['link'];?>">Gateway Link</a>
					<?php }else{ ?>
						NA
					<?php } ?>
					</td>
					<td>
				   <!---------------------------------------------------------------------------------------------------------->
				   <div class="btn-group">
					<?php
					//if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ 
					?>
						<a target="_blank" href="<?php echo site_url($this->controllerFile.'edit/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></a>
						<a target="_blank" href="<?php echo site_url($this->controllerFile.'pop/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-search"></span></a>
						
					<?php // } ?>
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


        
        
        

        
<script language="javascript">
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
				$('#msgDiv').html('Status Changed Successfully');
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
		
		
		
		
		
		
		
		
		
		