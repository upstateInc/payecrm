<?php $this->load->view('header');?>
<?php $this->load->view('left');
if($selectedEmails1!=""){
	$pieceEmail=explode(",",$selectedEmails1);
	//print_r($pieceEmail);
}
?>
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
			<input type="hidden" name="selectedEmails1" id="selectedEmails1" value="<?php echo $selectedEmails1;?>"/>
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">gatewayName</label>
			<select name="gatewayName" class="form-control input-sm" id="gatewayName">
				<option value="">Select Gateway</option>
				<?php foreach ($gateway->result() as $row){?>
					<option <?php if($gatewayName==$row->gatewayID){?> selected <?php } ?> value="<?php echo $row->gatewayID; ?>"><?php echo $row->gatewayID; ?></option>
				<?php } ?>
			</select>
			</div>
			
			<div class="form-group">
			
			<select name="companyID" class="form-control input-sm" id="companyID">
				<option value="">Select Center</option>
				<?php foreach ($companyIDName->result() as $row){?>
					<option <?php if($companyID==$row->companyID){?> selected <?php } ?> value="<?php echo $row->companyID; ?>"><?php echo $row->companyID; ?></option>
				<?php } ?>
			</select>
			</div>

			
			<div class="form-group">
			
			<input type="text" id="datepiker" name="start_date" placeholder="Start date" value="<?php echo $start_date;?>" class="dp form-control input-sm">
			</div>

			<div class="form-group">
			
			<input type="text" id="datepiker1" name="end_date" placeholder="End end" value="<?php echo $end_date;?>" class="dp form-control input-sm" >
			</div>			

			<div class="form-group">			
			<input type="text" id="grossPrice" name="grossPrice" placeholder="Sale Price" value="<?php echo $grossPrice;?>" class="input-sm" >
			</div>

			
			<br/>
			<br/>
			<div class="form-group">
				<label class="sr-only" for="exampleInputEmail2">status</label>
				<select  name="status" class="form-control input-sm" id="status">
					<option value="">Select Status</option>
					<option value="Authorize" <?php if($status=="Authorize"){?> selected <?php } ?> >Authorize</option>
					<option value="Capture" <?php if($status=="Capture"){?> selected <?php } ?>>Capture</option>
					<option value="Chargeback" <?php if($status=="Chargeback"){?> selected <?php } ?>>Chargeback</option>
					<option value="Void" <?php if($status=="Void"){?> selected <?php } ?>>Void</option>
					<option value="Refund" <?php if($status=="Refund"){?> selected <?php } ?>>Refund</option>
					<option value="Sale" <?php if($status=="Sale"){?> selected="selected"<?php } ?>>Sale</option>
					<option value="Settlement" <?php if($status=="Settlement"){?> selected="selected"<?php } ?>>Settle</option>
					<option value="Failed" <?php if($status=="Failed"){?> selected="selected"<?php } ?>>Failed</option>
				</select>
			</div>				
			<!--div class="form-group" style="float:left;">
				<label class="checkbox-inline"><input class="form-control" type="checkbox" name="status[]" value="Authorize" <?php if(is_array($status)){if(in_array('Authorize',$status)){ echo "checked"; } } ?>>Authorize</label>
				<label class="checkbox-inline"><input class="form-control" type="checkbox" name="status[]" value="Capture" <?php if(is_array($status)){if(in_array('Capture',$status)){ echo "checked"; } } ?>>Capture</label>
				<label class="checkbox-inline"><input class="form-control" type="checkbox" name="status[]" value="Chargeback" <?php if(is_array($status)){if(in_array('Chargeback',$status)){ echo "checked"; } } ?>>Chargeback</label>
				<label class="checkbox-inline"><input class="form-control" type="checkbox" name="status[]" value="Failed" <?php if(is_array($status)){if(in_array('Failed',$status)){ echo "checked"; } } ?> >Failed</label>				
				<label class="checkbox-inline"><input class="form-control" type="checkbox" name="status[]" value="Refund" <?php if(is_array($status)){if(in_array('Refund',$status)){ echo "checked"; } } ?> >Refund</label>
				<label class="checkbox-inline"><input class="form-control" type="checkbox" name="status[]" value="Sale" <?php if(is_array($status)){if(in_array('Sale',$status)){ echo "checked"; } } ?> >Sale</label>
				<label class="checkbox-inline"><input class="form-control" type="checkbox" name="status[]" value="Settlement" <?php if(is_array($status)){if(in_array('Settlement',$status)){ echo "checked"; } } ?> >Settle</label>
				<label class="checkbox-inline"><input class="form-control" type="checkbox" name="status[]" value="Void" <?php if(is_array($status)){if(in_array('Void',$status)){ echo "checked"; } } ?> >Void</label>
			</div-->
			<div class="form-group">
				<select name="paymentType" class="form-control input-sm" id="paymentType">
					<option value="">Select Payment Type</option>					
					<option value="credit_card" <?php if($paymentType=="credit_card"){ echo 'selected'; } ?> >Credit Card</option>		<option value="echecking" <?php if($paymentType=="echecking"){ echo 'selected'; } ?> >Echecking</option>
				</select>
			</div>	

			<div class="form-group" >
				<strong>Omit Refund/Chargeback Records:</strong> 
				<input type="checkbox" name="hideBadRecords" id="hideBadRecords" value="1" <?php if($hideBadRecords==1){ echo 'checked'; }?> >
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			</div>
			<div class="form-group">
				<a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><i class="fa fa-align-justify"></i> Clear </a>
			</div>			
			</form>
			</div>
			<br/>
			<div class="well">			
				<form class="form-inline" role="form" name="frmSearch" id="frmSearch" action="<?php echo base_url().$this->controllerFile; ?>sent_mails" method="POST" >

				<div class="form-group" style="float:left;">
					<!--input type="text" id="msg_subject" name="msg_subject" placeholder="Message Subject" value="" class="form-control"-->
					<?php $emailTemplate=$this->db->query("select id,name from t_email_template where status='Y'");?>
					<select name="emailTemplate" class="form-control input-sm" id="emailTemplate" required>
						<option value="">Select Template</option>
						<?php foreach ($emailTemplate->result() as $row){?>
							<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
						<?php } ?>
					</select>
				</div>
				<!--div class="form-group">
					<textarea id="message" name="message" placeholder="Message" class="form-control input-lg" rows="1" cols="50"></textarea>
				</div-->

				<input type="hidden" name="companyID" id="companyID1" value="<?php echo $companyID;?>"/>
				<input type="hidden" name="start_date" id="datepiker11" value="<?php echo $start_date;?>"/>
				<input type="hidden" name="end_date" id="datepiker111" value="<?php echo $end_date;?>"/>
				<input type="hidden" name="status" id="status1" value="<?php echo $status;?>"/>
				<input type="hidden" name="gatewayName" id="gatewayName1" value="<?php echo $gatewayName;?>"/>
				<input type="hidden" name="selectedEmails" id="selectedEmails" value="<?php echo $selectedEmails1;?>"/>
				<input type="hidden" name="grossPrice" id="grossPrice1" value="<?php echo $grossPrice;?>"/>
				<input type="hidden" name="paymentType" id="paymentType1" value="<?php echo $paymentType;?>"/>
				<input type="hidden" name="hideBadRecords" id="hideBadRecords1" value="<?php echo $hideBadRecords;?>"/>
				<div class="form-group" style="float:left;">
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Send Emails</button>
				</div>

				</form>
				<form class="form-inline" role="form" name="frmSearch" id="frmSearch" action="<?php echo base_url().$this->controllerFile; ?>download" method="POST" >
					<input type="hidden" name="companyID" id="companyID2" value="<?php echo $companyID;?>"/>
					<input type="hidden" name="start_date" id="datepiker12" value="<?php echo $start_date;?>"/>
					<input type="hidden" name="end_date" id="datepiker112" value="<?php echo $end_date;?>"/>
					<input type="hidden" name="status" id="status2" value="<?php echo $status;?>"/>
					<input type="hidden" name="gatewayName" id="gatewayName2" value="<?php echo $gatewayName;?>"/>
					<input type="hidden" name="selectedEmails" id="selectedEmails2" value="<?php echo $selectedEmails1;?>"/>
					<input type="hidden" name="grossPrice" id="grossPrice2" value="<?php echo $grossPrice;?>"/>
					<input type="hidden" name="paymentType" id="paymentType2" value="<?php echo $paymentType;?>"/>
					<input type="hidden" name="hideBadRecords" id="hideBadRecords2" value="<?php echo $hideBadRecords;?>"/>
					<div class="form-group" >
					<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Download Spreadsheet</button>
					</div>				
				</form>
			</div>
			
			
			
<!-------------------------------------------------------------->	
			<?php if($query->num_rows() > 0){?>
            <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
					<!--th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='gatewayID')?'bold':'normal'?>;" href="javascript: hdnSort('gatewayID','<?php echo $order_by; ?>');">Gateway</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='companyID')?'bold':'normal'?>;" href="javascript: hdnSort('companyID','<?php echo $order_by; ?>');">Center</a></th-->
                    <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='rec_crt_date')?'bold':'normal'?>;" href="javascript: hdnSort('rec_crt_date','<?php echo $order_by; ?>');">Date</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_name')?'bold':'normal'?>;" href="javascript: hdnSort('customer_name','<?php echo $order_by; ?>');">Name</a></th>
					<!--th>Phone</th-->
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_email')?'bold':'normal'?>;" href="javascript: hdnSort('customer_email','<?php echo $order_by; ?>');">Email</a></th>
					
					<!--th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='product_name')?'bold':'normal'?>;" href="javascript: hdnSort('product_name','<?php echo $order_by; ?>');">Product</a></th>
					
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='productDuration')?'bold':'normal'?>;" href="javascript: hdnSort('productDuration','<?php echo $order_by; ?>');">Duration</a></th-->
					
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='grossPrice')?'bold':'normal'?>;" href="javascript: hdnSort('grossPrice','<?php echo $order_by; ?>');">Price</a></th>
					
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='cardType')?'bold':'normal'?>;" href="javascript: hdnSort('cardType','<?php echo $order_by; ?>');">Card</a></th>
					
					<!--th>State</th-->
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='status')?'bold':'normal'?>;" href="javascript: hdnSort('status','<?php echo $order_by; ?>');">Status</a></th>
					<!--th></th-->
					<!--th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='validated')?'bold':'normal'?>;" href="javascript: hdnSort('validated','<?php echo $order_by; ?>');">Validated</a></th>
					<!--th>Status</th>
					<th colspan="2">Action</th-->
                </tr>
              </thead>
              <tbody>
                
              <?php foreach ($query->result() as $row){   ?> 
                <tr id="recordRow<?php echo $row->id; ?>" <?php if($row->status=="Refund" || $row->status=="Void" || $row->status=="Chargeback" || $row->status=="Failed"){?> class="redClass" <?php } ?>>
					<!--td><?php echo $row->gatewayID; ?></td>
					<td><?php echo $row->companyID; ?></td-->
					<td><?php echo date('m-d-Y',strtotime($row->rec_crt_date));?></td>
					<td><?php echo $row->fname.' '.$row->lname; ?></td>
					<!--td><?php echo $row->customer_phone; ?></td-->
					<td><?php echo $row->customer_email; ?></td>
					<!--td><?php echo $row->product_name; ?></td>
					<td><?php echo $row->productDuration; ?></td-->
					<td><?php echo '$'. number_format(abs($row->grossPrice), 2); ?></td>
					<td><?php echo $row->cardType; ?></td>
					<!--td><?php echo $row->customer_state; ?></td-->
					<td><?php echo $row->status; ?></td>
					<!--td><input type="checkbox" id="check<?php echo $row->id;?>" name="customerEmail" value="<?php echo $row->id; ?>" <?php if(is_array($pieceEmail)){if(in_array($row->id,$pieceEmail)){ echo "checked disabled"; } } ?> onclick="makedRecord('<?php echo $row->id; ?>');"></td-->
					
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
function makedRecord(id){
	document.getElementById("check"+id).disabled= true;
    var TheTextBox = document.getElementById("selectedEmails");
    selectedEmails.value = TheTextBox.value + ',' + id;
    selectedEmails1.value = TheTextBox.value + ',' + id;
	var newVal = document.getElementById("selectedEmails");
	$.post('<?php echo base_url().$this->controllerFile; ?>saveEmailId', 'val='+newVal.value, function(data){
	});	
	
}
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
	$("#companyID").on('change', function(){
		$("#companyID1").val($(this).val());
		$("#companyID2").val($(this).val());
	});	
	$("#datepiker").on('change', function(){
		$("#datepiker11").val($(this).val());
		$("#datepiker12").val($(this).val());
	});	
	$("#datepiker1").on('change', function(){
		$("#datepiker111").val($(this).val());
		$("#datepiker112").val($(this).val());
	});
	$("#gatewayName").on('change', function(){
		$("#gatewayName1").val($(this).val());
		$("#gatewayName2").val($(this).val());
	});	
	$("#status").on('change', function(){
		$("#status1").val($(this).val());
		$("#status2").val($(this).val());
	});	
	$("#grossPrice").on('change', function(){
		$("#grossPrice1").val($(this).val());
		$("#grossPrice2").val($(this).val());
	});	
	$("#paymentType").on('change', function(){
		$("#paymentType1").val($(this).val());
		$("#paymentType2").val($(this).val());
	});	
	$("#hideBadRecords").on('change', function(){
		$("#hideBadRecords1").val($(this).val());
		$("#hideBadRecords2").val($(this).val());
	});
</script>
        
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		