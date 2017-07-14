<?php $this->load->view('header');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/easyui.css">
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.easyui.min.js"></script>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
			
	
	<?php
	//print_r($ResultProduct);
      if($ResultProduct->num_rows() == 0){
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
			<label class="sr-only" for="exampleInputEmail2">companyID</label>
			<select name="companyID" class="form-control">
				<option value="">Select Center</option>
				<?php foreach ($companyIDName->result() as $row){?>
					<option <?php if($companyID==$row->companyID){?> selected <?php } ?> value="<?php echo $row->companyID; ?>"><?php echo $row->companyID; ?></option>
				<?php } ?>
			</select>
			</div>
			
			<div class="form-group">
				<input type="text" name="productName" value="<?php echo $productName; ?>" class="form-control" />
			</div>
			
			<div class="form-group">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			</div>
			<div class="form-group">
			
			<a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><i class="fa fa-align-justify"></i> Clear</a>
			</div>
			<br/>
			<br/>
				
			<div class="form-group">
				<label class="sr-only" for="exampleInputEmail2">companyID</label>
				<select name="companyID1" id="companyID1" onchange="checkCompany(this.value)" class="form-control">
					<option value="">Select Center To Add Product</option>
					<?php foreach ($companyIDName->result() as $row){?>
						<option value="<?php echo $row->companyID; ?>"><?php echo $row->companyID; ?></option>
					<?php } ?>
				</select>
			</div>
			
			</div>
			
			
<!-------------------------------------------------------------->
			<?php
			if($ResultProduct->num_rows() > 0){	?>		
            <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='companyID')?'bold':'normal'?>;" href="javascript: hdnSort('companyID','<?php echo $order_by; ?>');">Center</a></th>
					
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='productName')?'bold':'normal'?>;" href="javascript: hdnSort('productName','<?php echo $order_by; ?>');">Product Name</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='ProductSupscriptionPeriod')?'bold':'normal'?>;" href="javascript: hdnSort('ProductSupscriptionPeriod','<?php echo $order_by; ?>');">Subscription Period</a></th>
					<th>
					<a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='no_of_support')?'bold':'normal'?>;" href="javascript: hdnSort('no_of_support','<?php echo $order_by; ?>');">No of Support</a>
					</th>
					
					</th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='amount')?'bold':'normal'?>;" href="javascript: hdnSort('amount','<?php echo $order_by; ?>');">Amount</a></th>
					
					
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='sku_name')?'bold':'normal'?>;" href="javascript: hdnSort('sku_name','<?php echo $order_by; ?>');">Sku Name</a></th>
					
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='sku_number')?'bold':'normal'?>;" href="javascript: hdnSort('sku_number','<?php echo $order_by; ?>');">Sku No</a></th>
					<th colspan="2">
						<a style="text-decoration:none;font-size:12px;">Action</a>
					</th>
					<th>
					<!--input type="button" name="Check_All" value="Check All" onClick="Check(document.frmSearch.product_id)" /-->
					<a href="#" id="productAddButton" class="btn btn-primary" disabled data-toggle="modal" onclick="addSelected();" ><span class="glyphicon glyphicon-plus"></span> Add Selected</a></th>
                </tr>
              </thead>
              <tbody>
                
              <?php foreach ($ResultProduct->result() as $row){   ?> 
                <tr>
					<td><?php echo $row->companyID; ?></td>
					<td><?php echo $row->productName; ?></td>					
					<td><?php echo $row->ProductSupscriptionPeriod; ?></td>
					<td><?php echo $row->no_of_support; ?></td>
					
					<td><?php echo sprintf('%0.2f',$row->productPrice); ?></td>
										
					<td><input type="text" id="sku_name<?php echo $row->id;?>" value="<?php echo $row->sku_name; ?>"/></td>
					<td><input type="text" id="sku_number<?php echo $row->id;?>" value="<?php echo $row->sku_number; ?>"/></td>
					<td>
					<a href="javascript:void(0);" onclick="update_product('<?php echo $row->id;?>');" class="btn btn-primary">Save</span></a>					
					</td>
					<td>
					
						<?php if($row->status=='Y'){ ?>
							<div id="statusDiv<?php echo $row->id; ?>">
							<a href='javascript: void(0);' onclick='javascript: change_status("<?php echo $row->id; ?>","N");'><?php print active_icon(); ?></a></div>
						<?php }else{ ?>
							<div id="statusDiv<?php echo $row->id; ?>">
							<a href='javascript: void(0)' onclick='javascript: change_status("<?php echo $row->id; ?>","Y");'><?php print inactive_icon(); ?></a></div>
						<?php	} ?>
					
					</td>
					<!--td><a href="<?php echo site_url($this->controllerFile.'/edit/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span> </a></td-->
					<td ><input type="checkbox" name="product_id" value="<?php echo $row->id;?>"/></td>		
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
function update_product(id){
	var sku_number = jQuery("#sku_number"+id).val();
	var sku_name = jQuery("#sku_name"+id).val();
	$.post('<?php echo base_url().$this->controllerFile; ?>/update_product', 'id='+id+"&cost="+cost+"&sku_name="+sku_name+"&sku_number="+sku_number, function(data){
		if(data) 
		{
			alert(data);
			//location.reload();
		}
	});		
}
function checkCompany(companyID){
	if(companyID != ""){ 
		$("#productAddButton").removeAttr("disabled");
	}else{
		$("#productAddButton").attr("disabled", true);
	}
}
function Check(chk)
{
	//document.frmSearch.product_id
	if(document.frmSearch.Check_All.value=="Check All"){
		for (i = 0; i < chk.length; i++)
		chk[i].checked = true ;
		document.frmSearch.Check_All.value="UnCheck All";
	}else{
		for (i = 0; i < chk.length; i++)
		chk[i].checked = false ;
		document.frmSearch.Check_All.value="Check All";
	}
}
function addSelected(){
	var companyID = $("#companyID1").val();
	/*var checkedValue = document.querySelector('.product_id:checked').value;
	alert(checkedValue);*/
	var selected = new Array();
	$("input:checkbox[name=product_id]:checked").each(function(){
		selected.push($(this).val());
	});
	//$(selected).serializeArray()
	//alert(selected);
	$.post('<?php echo base_url().$this->controllerFile; ?>/addSelectedProduct', 'selected='+selected+'&companyID='+companyID, function(data){
		if(data) 
		{
			alert(data);
			//location.reload();
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
function change_visibility(id, val)
{	
	$('#visibilityDiv'+id).html('<img src="<?php echo base_url(); ?>images/admin/loading.gif" alt=""/>');
	$.post('<?php echo base_url().$this->controllerFile; ?>/change_visibility', 'id='+id+'&val='+val, function(data){
		if(data) 
		{
			if(val == 'Y')
			{
				var val2 = "'N'";
				var text = '<a href="javascript: void(0);" onclick="javascript: change_visibility('+id+','+val2+');"><?php print active_icon(); ?></a>';
				$('#visibilityDiv'+id).html(text);
				$("#msgDiv").show("");
				$('#msgDiv').html('Record updated successfully');
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
				
			}
			else
			{
				var val2 = "'Y'";
				var text = '<a href="javascript: void(0);" onclick="javascript: change_visibility('+id+','+val2+');"><?php print inactive_icon(); ?></a>';
				$('#visibilityDiv'+id).html(text);
				$("#msgDiv").show("");
				$('#msgDiv').html('Record updated successfully');
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
		
		
		
		
		
		
		