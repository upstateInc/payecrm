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
			
			<!--div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">status</label>
			<select  name="status" class="form-control">
				<option value="">Select Status</option>
				<option value="Sale" <?php if($status=='Sale'){?> selected <?php } ?> >Sale</option>
				<option value="Refund" <?php if($status=='Refund'){?> selected <?php } ?>>Refund</option>
				<option value="Void" <?php if($status=='Void'){?> selected <?php } ?>>Void</option>
				<option value="Chargeback" <?php if($status=='Chargeback'){?> selected <?php } ?>>Chargeback</option>
			</select>
			</div-->
			
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Start date</label>
			<input type="text" id="datepiker" name="start_date" placeholder="Start date" value="<?php echo $start_date;?>" class="dp form-control">
			</div>

			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Start end</label>
			<input type="text" id="datepiker1" name="end_date" placeholder="End end" value="<?php echo $end_date;?>" class="dp form-control" >
			</div>
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Validated</label>
			<select class="form-control" id="validated" name="validated" >
				<option value="">Validated</option>
				<option value="Y" <?php if($validated=="Y"){?> selected="selected"<?php } ?>>Y</option>
				<option value="N" <?php if($validated=="N"){?> selected="selected"<?php } ?>>N</option>
			</select>
			</div>
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			<!--br/>
			<br/>
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Customer Name</label>
			<input type="text" id="customer_name" name="customer_name" placeholder="Customer Name" value="<?php echo $customer_name;?>" class="form-control">
			</div>
			<div class="form-group">
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
						
			
			</form>
                      <a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><i class="fa fa-align-justify"></i> Clear</a>
			</div>
			
			<?php echo '<h3 style="text-align:center;color:#339933;">Total Sales : $'.number_format($queryTotalPrice, 2).'</h4>';?>
			
<!-------------------------------------------------------------->	
			<?php if($query->num_rows() > 0){?>
            <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='gatewayID')?'bold':'normal'?>;" href="javascript: hdnSort('gatewayID','<?php echo $order_by; ?>');">Gateway</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='companyID')?'bold':'normal'?>;" href="javascript: hdnSort('companyID','<?php echo $order_by; ?>');">Center</a></th>
                    <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='rec_crt_date')?'bold':'normal'?>;" href="javascript: hdnSort('rec_crt_date','<?php echo $order_by; ?>');">Date</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_name')?'bold':'normal'?>;" href="javascript: hdnSort('customer_name','<?php echo $order_by; ?>');">Name</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_phone')?'bold':'normal'?>;" href="javascript: hdnSort('customer_phone','<?php echo $order_by; ?>');">Phone</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='product_name')?'bold':'normal'?>;" href="javascript: hdnSort('product_name','<?php echo $order_by; ?>');">Product</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='productDuration')?'bold':'normal'?>;" href="javascript: hdnSort('productDuration','<?php echo $order_by; ?>');">Duration</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='grossPrice')?'bold':'normal'?>;" href="javascript: hdnSort('grossPrice','<?php echo $order_by; ?>');">Price</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='cardType')?'bold':'normal'?>;" href="javascript: hdnSort('cardType','<?php echo $order_by; ?>');">Card</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='validated')?'bold':'normal'?>;" href="javascript: hdnSort('validated','<?php echo $order_by; ?>');">Validated</a></th>
					<!--th>Status</th-->
					<th colspan="2">Action</th>
                </tr>
              </thead>
              <tbody>
                
              <?php foreach ($query->result() as $row){   ?> 
                <tr id="recordRow<?php echo $row->id; ?>" <?php /*if($row->status=="Refund" || $row->status=="Void" || $row->status=="Chargeback"){?> class="redClass" <?php }*/ ?>>
					<td><?php echo $row->gatewayID; ?></td>
					<td><?php echo $row->companyID; ?></td>
					<td><?php echo date('m-d-Y',strtotime($row->rec_crt_date));?></td>
					<td><?php echo $row->customer_name; ?></td>
					<td><?php echo $row->customer_phone; ?></td>
					<td><?php echo $row->product_name; ?></td>
					<td><?php echo $row->productDuration; ?></td>
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
					<?php
					/*$current = strtotime(date("Y-m-d"));
					$timestamp = strtotime($row->rec_crt_date);
					$datediff = $timestamp - $current;
					$difference = floor($datediff/(60*60*24));
					?>
					<select id="status<?php echo $row->id; ?>" name="status" onchange='change_trans_status("<?php echo $row->id; ?>",this.value);' <?php if($row->status!="Sale" && $row->status!=""){?> disabled <?php } ?>>
						<option value="">Select Status</option>
						<option value="Sale" <?php if($row->status=="Sale"){?> selected="selected"<?php } ?>>Sale</option>
						<?php if($difference==0){?>
							<option value="Void" <?php if($row->status=="Void"){?> selected="selected"<?php } ?>>Void</option>	
						<?php }if($difference<0){ ?>
							<option value="Refund" <?php if($row->status=="Refund"){?> selected="selected"<?php } ?>>Refund</option>
							<option value="Chargeback" <?php if($row->status=="Chargeback"){?> selected="selected"<?php } ?>>Chargeback</option>
						<?php } ?>
					</select>
					<?php */ ?>
                  <div class="btn-group">
					<?php
					//if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ 
					?>
						<a href="<?php echo site_url($this->controllerFile.'edit/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></a>
						<a href="<?php echo site_url($this->controllerFile.'pop/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-search"></span></a>
						<!--a href="#" class="btn btn-primary btn-xs" onclick="javascript:var r=confirm('Are you sure to delete?'); if(r==true) { window.location.href='<?php 
						echo site_url($this->controllerFile.'/delete_single/'.$row->id);?>'; }" ><span class="glyphicon glyphicon-trash"> Delete</span> </a-->
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
function change_trans_status(id, val)
{
	//alert(val);	
	//$('#statusDiv'+id).html('<img src="<?php echo base_url(); ?>images/admin/loading.gif" alt=""/>');
	$.post('<?php echo base_url().$this->controllerFile; ?>change_trans_type', 'id='+id+'&val='+val, function(data){
		if(data) 
		{
				if(val=='Refund' || val=='Void' || val=='Chargeback'){
					//alert("recordRow"+id);
					$("#recordRow"+id+"").addClass('redClass');				
					$("#status"+id+"").attr('disabled', true);				
				}else{
					$("#recordRow"+id+"").removeClass('redClass');
				}
				$("#msgDiv").show("");
				$('#msgDiv').html('Status Changed Successfully');
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
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
		
		
		
		
		
		
		
		
		
		