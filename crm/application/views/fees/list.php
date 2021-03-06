<?php $this->load->view('header');?>
<?php $this->load->view('left');
//print_r($companyIDName);
?>

<div class="mainpanel">
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo site_url($this->controllerFile.'add');?>" class="btn btn-primary" data-toggle="modal" ><span class="glyphicon glyphicon-plus"></span> Add </a></div>                
	</div><br/>		

	
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
				<input type="text" class="form-control" name="fees_type" id="fees_type" value="<?php echo $fees_type; ?>"/>	
			</div>
			
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">status</label>
			<select class="form-control" name="status">
				<option value="">Select Status</option>
				<option value="Y" <?php if($status=='Y'){ echo 'selected'; }?>>Active</option>
				<option value="N" <?php if($status=='N'){ echo 'selected'; }?>>In-Active</option>
			</select>
			</div>
			
		
			
			
			<div class="form-group">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			</div>
			
			<a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><i class="fa fa-align-justify"></i> Clear</a>
			
			</div>
			
			
<!-------------------------------------------------------------->
			
			<?php
			if($query->num_rows() > 0){	?>		
            <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='fees_type')?'bold':'normal'?>;" href="javascript: hdnSort('fees_type','<?php echo $order_by; ?>');">Fees</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='fee')?'bold':'normal'?>;" href="javascript: hdnSort('fee','<?php echo $order_by; ?>');">Fee</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Status</a></th>	  
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Action</a></th>
                </tr>
              </thead>
              <tbody>
                
              <?php foreach ($query->result() as $row){   ?> 
                <tr>
					<td ><?php echo $row->fees_type; ?></td>
					<td ><?php echo $row->fee_type.$row->fee; ?></td>
					
					
					<td><?php if($this->session->userdata('ADMIN_TYPE')=='superadmin')
					{
						if($row->status=='Y'){ ?>
							<div id="statusDiv<?php echo $row->id; ?>">
							<a href='javascript: void(0);' onclick='javascript: change_status("<?php echo $row->id; ?>","N");'><?php print active_icon(); ?></a></div>
						<?php }else{ ?>
							<div id="statusDiv<?php echo $row->id; ?>">
							<a href='javascript: void(0)' onclick='javascript: change_status("<?php echo $row->id; ?>","Y");'><?php print inactive_icon(); ?></a></div>
						<?php	}
					}
					else
					{
						echo ($row->status=='Y') ? active_icon() : inactive_icon() ;
					}?></td>
					
					<td>
					<div class="btn-group">
					<?php
					if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ 
					?>
						<!--a target="_blank" href="<?php echo site_url($this->controllerFile.'pop/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-search"></span> View</a-->
						<a target="_blank" href="<?php echo site_url($this->controllerFile.'edit/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span> Edit</a>
						
						<a href="#" class="btn btn-primary btn-xs" onclick="javascript:var r=confirm('Are you sure to delete?'); if(r==true) { window.location.href='<?php 
						echo site_url($this->controllerFile.'/delete_single/'.$row->id);?>'; }" ><span class="glyphicon glyphicon-trash"> Delete</span> </a>
					<?php } ?>
                   </div>
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
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		