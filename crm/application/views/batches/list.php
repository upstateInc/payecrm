<?php $this->load->view('header');?>
<?php $this->load->view('left');
//print_r($companyIDName);
?>
<div class="mainpanel">
                    
			

	
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
				<div class="form-group">
				<label class="sr-only" for="exampleInputEmail2">gatewayName</label>
				<select name="gatewayName" class="form-control">
					<option value="">Select Gateway</option>
					<?php foreach ($gateway->result() as $row){?>
						<option <?php if($gatewayName==$row->gatewayName){?> selected <?php } ?> value="<?php echo $row->gatewayName; ?>"><?php echo $row->gatewayName; ?></option>
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

				<div class="form-group">
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
				</div>
				<div class="form-group">
				<a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><i class="fa fa-align-justify"></i> Clear</a>
				</div>
			</div>
			<?php //echo '<h4 style="text-align:center;color:#339933;">Grand Total for Selected Filters: $'.number_format($queryTotalPrice, 2).'</h4>';?>
			<?php if($where_clause==""){ $where_clause = 1;}?>
			
			<?php 
			$totAuth=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and action_type="auth"')->row()->sum;
			$totCap=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and action_type="capture"')->row()->sum;
			$totRef=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and (action_type="refund" or (grossPrice<0 and action_type="settle"))')->row()->sum;
			$totSale=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and action_type="sale"')->row()->sum;
			$totSettle=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and action_type="settle" and grossPrice>0')->row()->sum;
			$totVoid=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and action_type="void"')->row()->sum;
			$totFailed=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and status="failed"')->row()->sum;
			?>
			

			<h5 style="text-align:center;color:#339933;">
				<?php if($totSettle!=""){?> 
				<span style="color:#339933;">Settle: $<?php echo number_format($totSettle,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and action_type="settle" and grossPrice>0')->num_rows();?>)</span>&nbsp;&nbsp;
				<?php }?>
				<?php if($totRef!=""){?> 
				<span style="color:#FF0000;">Refund: $<?php echo number_format($totRef,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and (action_type="refund" or (grossPrice<0 and action_type="settle"))')->num_rows();?>)</span>&nbsp;&nbsp;
				<?php }?>
				<span style="color:#339933;">Total Sales: $<?php echo number_format($totSettle+$totRef,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause)->num_rows();?>)</span>
			</h5>
<!-------------------------------------------------------------->
			<?php
			if($query->num_rows() > 0){	?>		
            <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
                	<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='rec_up_date')?'bold':'normal'?>;" href="javascript: hdnSort('rec_up_date','<?php echo $order_by; ?>');">Batch Date</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='gatewayID')?'bold':'normal'?>;" href="javascript: hdnSort('gatewayID','<?php echo $order_by; ?>');">Gateway</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='companyID')?'bold':'normal'?>;" href="javascript: hdnSort('companyID','<?php echo $order_by; ?>');">Center</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='action_type')?'bold':'normal'?>;" href="javascript: hdnSort('action_type','<?php echo $order_by; ?>');">Action</a></th>
					<!--th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='gatewayTransactionId')?'bold':'normal'?>;" href="javascript: hdnSort('gatewayTransactionId','<?php echo $order_by; ?>');">Transaction Id</a></th-->
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='invoice_id')?'bold':'normal'?>;" href="javascript: hdnSort('invoice_id','<?php echo $order_by; ?>');">Invoice Id</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_name')?'bold':'normal'?>;" href="javascript: hdnSort('customer_name','<?php echo $order_by; ?>');">Name</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:normal">Card</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='rec_crt_date')?'bold':'normal'?>;" href="javascript: hdnSort('rec_crt_date','<?php echo $order_by; ?>');">Date</a></th>
					<th><a style="text-align:center;text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='grossPrice')?'bold':'normal'?>;" href="javascript: hdnSort('grossPrice','<?php echo $order_by; ?>');">Amount</a></th>
					<!--a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='status')?'bold':'normal'?>;" href="javascript: hdnSort('status','<?php echo $order_by; ?>');">Status</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='response_text')?'bold':'normal'?>;" href="javascript: hdnSort('response_text','<?php echo $order_by; ?>');">Response</a></th-->
					<th></th>	  
					<!--th>Action</th-->
                </tr>
              </thead>
              <tbody>
                
              <?php foreach ($query->result() as $row){   ?> 
                <tr <?php if($row->grossPrice<0 || $row->status=='failed' || $row->status=='canceled'){?> style="color:#FF0000;" <?php } ?>>
                	<td ><?php echo date('m-d-y',strtotime($row->rec_up_date)); ?></td>
					<td ><?php echo $row->gatewayID; ?></td>
					<td ><?php echo $row->companyID; ?></td>
					<td ><?php if($row->grossPrice<0){echo 'refund';} else echo $row->action_type; ?></td>
					<!--td ><?php echo $row->gatewayTransactionId; ?></td-->
					<td ><?php echo $row->invoice_id; ?></td>
					<td ><?php echo $row->customer_name; ?></td>
					<td ><?php echo substr($row->cardNo,-4); ?></td>
					<td ><?php echo date('m-d-y H:i:s',strtotime($row->rec_crt_date)); ?></td>
					<td ><?php echo '$'. number_format($row->grossPrice,2); ?></td>
					
					<!--td ><?php echo $row->status; ?></td>
					<td ><?php echo $row->response_text; ?></td-->
					<td>
						<a target="_blank" href="<?php echo site_url($this->controllerFile.'pop/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-search"></span></a>					
					</td>
					<!--td>
					<div class="btn-group">
					<?php
					if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ 
					?>
						<a href="<?php echo site_url($this->controllerFile.'pop/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-search"></span> View</a>
						<a href="<?php echo site_url($this->controllerFile.'edit/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span> Edit</a>
						<a href="<?php echo site_url($this->controllerFile.'copy/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span> Copy</a>
						<a href="#" class="btn btn-primary btn-xs" onclick="javascript:var r=confirm('Are you sure to delete?'); if(r==true) { window.location.href='<?php 
						echo site_url($this->controllerFile.'/delete_single/'.$row->id);?>'; }" ><span class="glyphicon glyphicon-trash"> Delete</span> </a>
					<?php } ?>
                   </div>
                  </td-->
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


        
        
        

        
<script language="javascript">
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
function edit(id){
	//alert(id);
	//window.location="http://stackoverflow.com";
	window.location="<?php echo site_url($this->controllerFile.'edit');?>"+'/'+id;
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
		
		
		
		
		
		
		