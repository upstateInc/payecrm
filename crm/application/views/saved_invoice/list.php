<?php $this->load->view('header');?>


<div class="mainpanel">
	<!--div class="clearfix">
		<div class="pull-right"><a href="<?php echo site_url($this->controllerFile.'add');?>" class="btn btn-primary" data-toggle="modal" ><span class="glyphicon glyphicon-plus"></span> Add </a></div>                
	</div><br/-->		

	
	<?php
      if($query->num_rows() == 0){
	   		echo '<div class="alert alert-warning no-radius no-margin padding-sm" role="alert"><strong><i class="fa fa-warning"></i> Warning:</strong> No Records Found.</div>';
	  } 
		
		 
			
	 ?>
<!------------------------search section------------------------>
			
			<form class="form-inline" role="form" name="frmSearch" id="frmSearch" action="<?php echo base_url().$this->controllerFile; ?>" method="POST" >
			<div class="well">
			<input type="hidden" name="hdnOrderBy" id="hdnOrderBy" value="<?php echo $order_by; ?>"/>
			<input type="hidden" name="hdnOrderByFld" id="hdnOrderByFld" value="<?php echo $order_by_fld; ?>"/>			
			<input type="hidden" name="search" value="search"/>
			<?php if($this->session->userdata('ADMIN_COMPANYID')==""){ ?>
			<div class="form-group">			
				<select name="companyID" class="form-control" >
				<option value="">Select Center</option>
				<?php foreach ($companyIDName->result() as $row){?>
					<option <?php if($companyID==$row->companyID){ echo 'selected';}?> value="<?php echo $row->companyID; ?>"><?php echo $row->companyID; ?></option>
				<?php } ?>
				</select>
			</div>			
			<?php } ?>
			<div class="form-group">
			
			<input type="text" id="datepiker" name="start_date" placeholder="Start date" value="<?php echo $start_date;?>" class="dp form-control">
			</div>

			<div class="form-group">
			
			<input type="text" id="datepiker1" name="end_date" placeholder="End end" value="<?php echo $end_date;?>" class="dp form-control" >
			</div>			
			
		
			
			
			<div class="form-group">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			</div>
			
			<a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><i class="fa fa-align-justify"></i> Clear</a>
			
			</div>
			
			
<!-------------------------------------------------------------->
			
			<?php
			$InvoiceCC ="";
			if($query->num_rows() > 0){	?>		
            <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='INVOICECOMPANYID')?'bold':'normal'?>;" href="javascript: hdnSort('INVOICECOMPANYID','<?php echo $order_by; ?>');">Company</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Start Date</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">End Date</a></th>
					<?php if($this->session->userdata('ADMIN_COMPANYID')==""){ ?>
						<th ><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='status')?'bold':'normal'?>;" href="javascript: hdnSort('status','<?php echo $order_by; ?>');">Completed</a></th>	
					<?php } ?>
					<th colspan="5"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Action</a></th>
                </tr>
              </thead>
              <tbody>
                
              <?php foreach ($query->result() as $row){   ?> 
                <tr>
					<td ><?php echo $row->INVOICECOMPANYID; ?></td>
					<td ><?php echo $row->STARTDATE; ?></td>
					<td ><?php echo $row->ENDDATE; ?></td>
					<?php if($this->session->userdata('ADMIN_COMPANYID')==""){ ?>
					<td>
						<?php if($row->status=='Y'){ ?>
							<div id="statusDiv<?php echo $row->id; ?>">
							<a href='javascript: void(0);' onclick='javascript: change_status("<?php echo $row->id; ?>","N");'><?php print active_icon(); ?></a></div>
						<?php }else{ ?>
							<div id="statusDiv<?php echo $row->id; ?>">
							<a href='javascript: void(0)' onclick='javascript: change_status("<?php echo $row->id; ?>","Y");'><?php print inactive_icon(); ?></a></div>
						<?php	} ?>
					</td>
					<?php } ?>
					<td>
					<?php
					$query = $this->db->query("select invoiceEmails from ".$this->tableCenter."  where companyID like '%".$row->INVOICECOMPANYID."%' ");
					if ($query->num_rows() > 0) {			
						$InvoiceCC = $this->db->query("select invoiceEmails from ".$this->tableCenter."  where companyID like '%".$row->INVOICECOMPANYID."%' ")->row()->invoiceEmails;
					}
					?>					
					<!--div class="btn-group"-->
						<a href="<?php echo site_url('invoice/edit_saved_invoice/'.$row->tempInvoiceGenerationId);?>" class="btn btn-primary btn-xs" >
							<div id="editButton<?php echo $row->id; ?>">
								<?php if($row->status=='N' && $this->session->userdata('ADMIN_COMPANYID')==""){ ?>
									<span class="glyphicon glyphicon-pencil"></span>  
								<?php } ?>
								<?php if($row->status=='Y' || $this->session->userdata('ADMIN_COMPANYID')!=""){ ?>
									<span class="glyphicon glyphicon-search"></span>  
								<?php } ?>
							</div>
						</a>
					</td>
					<?php if($this->session->userdata('ADMIN_COMPANYID')==""){ ?>
					<td>
					
						<span <?php if($row->status=='Y'){ ?> style="display:none;"  <?php } ?> id="delete<?php echo $row->id;?>">
							<a href="#" class="btn btn-primary btn-xs" onclick="javascript:var r=confirm('Are you sure to delete?'); if(r==true) { window.location.href='<?php echo site_url($this->controllerFile.'/delete_single/'.$row->id);?>'; }" ><span class="glyphicon glyphicon-trash"> </span></a>
						</span>
					</td>
					<?php } ?>
					<td>
							<a href="<?php echo site_url('invoice/mypdf/'.$row->tempInvoiceGenerationId);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-download"></span>  </a>
					</td>
					<td>
							<a href="<?php echo site_url('invoice/volumeReport?companyID='.$row->INVOICECOMPANYID.'&startdate='.$row->STARTDATE.'&enddate='.$row->ENDDATE);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-download"></span> Volume </a>
					</td>
					<td>
							<a href="javascript:;" class="btn btn-info btn-xs" data-toggle="modal" data-target="#send_invoice" onclick="SetInvoiceId('<?php echo $row->tempInvoiceGenerationId; ?>','<?php echo $InvoiceCC; ?>');"><span aria-hidden="true" class="fa fa-envelope-o"></span> </a>
						<!--/div-->
					</td>
                </tr>
               <?php } ?>  
                
              </tbody>
            </table>
           
            </div>
		
		<?php echo $paginator; ?>			
    <?php } ?>
    </form>        
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>

        <div class="modal fade" id="send_invoice" tabindex="-1" role="dialog" aria-labelledby="send_invoice" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Send Invoice Email</h4>
                    </div>
                    <!--form id="resendInvoiceForm" method="POST" action="<?php echo $this->config->item('company_base_url'); ?>send_refund_invoice.php" --->
					<form id="resendInvoiceForm" method="POST" action="<?php echo base_url().$this->controllerFile; ?>send_invoice_email" >
                        <div class="modal-body" id="">

                            <input type="hidden" id="tempInvoiceGenerationId" name="tempInvoiceGenerationId" />
							
							<!--div class="form-group">
                            <label>Send copy to Company?</label>
								<input type="checkbox" value="yes" name="SendCompany">
							</div-->
                            <div class="form-group">
                                <label >Email Id to send Invoice (Multiple Separated By Comma)</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email ID"  >
                            </div>                           
							<div class="form-group">
                                <label >CC Email Id to send Invoice (Multiple Separated By Comma)</label>
                                <input type="text" class="form-control" id="InvoiceCC" name="InvoiceCC" placeholder="Email ID, To CC"  >
                            </div>							
							<div class="form-group">
                                <label >BCC Email Id to send Invoice (Multiple Separated By Comma)</label>
                                <input type="text" class="form-control" id="InvoiceBCC" name="InvoiceBCC" placeholder="Email ID, To BCC"  >
                            </div>							
							<div class="form-group">
                                <label >Notes</label>
                                <textarea class="form-control" id="notes" name="notes" placeholder="Notes"  ></textarea>
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

        
        
        

<script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>       
<script language="javascript">
   function SetInvoiceId(id,InvoiceCC){
		$('#tempInvoiceGenerationId').val(id);
		$('#InvoiceCC').val(InvoiceCC);
	}
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
				$("#delete"+id).hide();
				$("#editButton"+id).html("");
				$("#editButton"+id).html('<span class="glyphicon glyphicon-search"></span> View');
			}
			else
			{
				var val2 = "'Y'";
				var text = '<a href="javascript: void(0);" onclick="javascript: change_status('+id+','+val2+');"><?php print inactive_icon(); ?></a>';
				$('#statusDiv'+id).html(text);
				$("#msgDiv").show("");
				$('#msgDiv').html('Record inactivated successfully');
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
				$("#delete"+id).show();
				$("#editButton"+id).html("");
				$("#editButton"+id).html('<span class="glyphicon glyphicon-pencil"></span> Edit');				
			}
		}
	});
}
function edit(id){
	//alert(id);
	//window.location="http://stackoverflow.com";
	window.location="<?php echo site_url($this->controllerFile.'edit');?>"+'/'+id;
}
</script>
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		