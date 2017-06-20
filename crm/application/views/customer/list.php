<?php $this->load->view('header');?>
<div class="mainpanel">
                    
			<div class="contentpanel contentpanel-mediamanager"> 
			
	
	<?php
      if($query->num_rows() == 0){
	   		echo '<div class="alert alert-warning no-radius no-margin padding-sm" role="alert"><strong><i class="fa fa-warning"></i> Warning:</strong> No Records Found.</div>';
	  } 
		
		 
			
	 ?>
<!------------------------search section------------------------>			
			<form class="form-inline well" role="form" name="frmSearch" id="frmSearch" action="<?php echo base_url().$this->controllerFile; ?>" method="POST" >
			<input type="hidden" name="hdnOrderBy" id="hdnOrderBy" value="<?php echo $order_by; ?>"/>
			<input type="hidden" name="hdnOrderByFld" id="hdnOrderByFld" value="<?php echo $order_by_fld; ?>"/>			
			<input type="hidden" name="search" value="search"/>
			<?php if($this->session->userdata('ADMIN_COMPANYID')==""){?>
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">companyID</label>
			<select name="companyID" class="form-control">
				<option value="">Select Center</option>
				<?php foreach ($companyIDName->result() as $row){?>
					<option <?php if($companyID==$row->companyID){?> selected <?php } ?> value="<?php echo $row->companyID; ?>"><?php echo $row->companyID; ?></option>
				<?php } ?>
			</select>
			</div>			
			<?php } ?>
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Last Name</label>
			<input type="text" class="form-control" name="fname" id="fname" value="<?php echo $fname; ?>" placeholder="First Name">
			</div>			
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Last Name</label>
			<input type="text" class="form-control" name="lname" id="lname" value="<?php echo $lname; ?>" placeholder="Last Name">
			</div>

			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Email</label>
			<input type="text" class="form-control" name="email" id="email" value="<?php echo $email;?>" placeholder="Email">
			</div>
			<div class="form-group">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			</div>
			<div class="form-group">
			<a href="<?php echo base_url().$this->controllerFile;?>" class="btn btn-primary"><i class="fa fa-align-justify"></i> Clear</a>
			</div>
			</form>
<!-------------------------------------------------------------->			
    <?php if($query->num_rows() > 0){ ?>
	<div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
				<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='companyID')?'bold':'normal'?>;" href="javascript: hdnSort('companyID','<?php echo $order_by; ?>');">Center</a></th>
                  <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='fname')?'bold':'normal'?>;" href="javascript: hdnSort('fname','<?php echo $order_by; ?>');">First Name</a></th>
				  <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='lname')?'bold':'normal'?>;" href="javascript: hdnSort('lname','<?php echo $order_by; ?>');">Last Name</a></th>
                  <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_email')?'bold':'normal'?>;" href="javascript: hdnSort('customer_email','<?php echo $order_by; ?>');">Email</a></th>
                  <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_phone')?'bold':'normal'?>;" href="javascript: hdnSort('customer_phone','<?php echo $order_by; ?>');">Phone</a></th>
                  <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_state')?'bold':'normal'?>;" href="javascript: hdnSort('customer_state','<?php echo $order_by; ?>');">State</a></th>
                  
				  
                  <!--th>Created On</th>
                  <th>Edited On</th>
                  <th>Status</th-->	  
                                 
				  <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Action</a></th>
                </tr>
              </thead>
              <tbody>
                
              <?php foreach ($query->result() as $row){   ?> 
                <tr>
				  <td><?php echo $row->companyID; ?></td>
                  <td><?php echo $row->fname; ?></td>
                  <td><?php echo $row->lname; ?></td>
                  <td><?php echo $row->customer_email; ?></td>
                  <td><?php echo $row->customer_phone; ?></td>
                  <td><?php echo $row->customer_state; ?></td>
                  
                 
                  <!--td><?php echo date('d M, Y', strtotime($row->rec_crt_date)); ?></td>
                  <td><?php echo date('d M, Y', strtotime($row->rec_up_date)); ?></td-->
                  <!--td><?php if($this->session->userdata('ADMIN_TYPE')=='superadmin' || $this->session->userdata('ADMIN_TYPE')=='teamlead')
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
					}?></td-->
                  <td>
					<div class="btn-group">
						<a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#show_details_record" onclick="recordDetails('<?php echo $row->id; ?>');"><span class="glyphicon glyphicon-search"></span></a>
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


		<!------------------------------------Details-----------------------------------> 
         <div class="modal fade" id="show_details_record" tabindex="-1" role="dialog" aria-labelledby="show_details_record" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Details</h4>
                    </div>
                        <div class="modal-body" id="">
							<div id="recordDetails"></div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                           
                        </div>
                </div>
            </div>
        </div>
		<!------------------------------------------------------------------------------>        
        
        

        
<script language="javascript">
	function recordDetails(id){		 
		$("#recordDetails").html('Loading..');
		$.post('<?php echo base_url().$this->controllerFile; ?>pop', 'id='+id, function(data){
			if(data) 
			{
				//$("#modalBodyLoad").html(data);				
				$("#recordDetails").html(data);		
				//e.preventDefault();
				//$("#dialog").html(data);				
			}
		});
		//location.reload();	
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
</script>
        
		<?php $this->load->view('footer');?>