<?php $this->load->view('header');?>
        <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
          
			<div class="col-md-1 col-sm-1 col-xs-12 pull-right margine_top_20">
				<a href="<?php echo base_url().$this->controllerFile;?>add"><button type="button" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</button></a>
			</div>
          
			<div class="x_panel">
                  <div class="x_content">
                    <form role="form" name="frmSearch" id="frmSearch" action="<?php echo base_url().$this->controllerFile; ?>" method="POST" >
						<input type="hidden" name="hdnOrderBy" id="hdnOrderBy" value="<?php echo $order_by; ?>"/>
						<input type="hidden" name="hdnOrderByFld" id="hdnOrderByFld" value="<?php echo $order_by_fld; ?>"/>			
						<input type="hidden" name="search" value="search"/>
						<?php if($this->session->userdata('ADMIN_COMPANYID')==""){?>
						<div class="col-md-3 col-sm-3 col-xs-12 margine_bottom_5">
						<label class="sr-only" for="exampleInputEmail2">companyID</label>
						<select name="companyID" class="form-control">
							<option value="">Select Center</option>
							<?php foreach ($companyIDName->result() as $row){?>
								<option <?php if($companyID==$row->companyID){?> selected <?php } ?> value="<?php echo $row->companyID; ?>"><?php echo $row->companyID; ?></option>
							<?php } ?>
						</select>
						</div>			
						<?php } ?>
						<div class="col-md-3 col-sm-3 col-xs-12 margine_bottom_5">
						<label class="sr-only" for="exampleInputEmail2">Name</label>
						<input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" placeholder="Name">
						</div>

						<div class="col-md-3 col-sm-3 col-xs-12 margine_bottom_5">
						<label class="sr-only" for="exampleInputEmail2">Email</label>
						<input type="text" class="form-control" name="email" id="email" value="<?php echo $email;?>" placeholder="Email">
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>						
							<a href="<?php echo base_url().$this->controllerFile;?>" class="btn btn-primary"><i class="fa fa-align-justify"></i> Clear</a>
						</div>
					</form>
                  </div>
            </div>
<!-------------------------------------------------------------->			
            <?php if($query->num_rows() > 0){	?>
			<div class="table-responsive">
            
            <table class="table table-striped jambo_table bulk_action">
              <thead>
                <tr>
                  <th  class="column-title"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='fname')?'bold':'normal'?>;" href="javascript: hdnSort('fname','<?php echo $order_by; ?>');">Name</a></th>
                  <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='email')?'bold':'normal'?>;" href="javascript: hdnSort('email','<?php echo $order_by; ?>');">Email</a></th>
                  <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='phone')?'bold':'normal'?>;" href="javascript: hdnSort('phone','<?php echo $order_by; ?>');">Phone</a></th>
                  <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='type')?'bold':'normal'?>;" href="javascript: hdnSort('type','<?php echo $order_by; ?>');">Type</a></th>
                  <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='level')?'bold':'normal'?>;" href="javascript: hdnSort('level','<?php echo $order_by; ?>');">Level</a></th>
				  <!--th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='groupId')?'bold':'normal'?>;" href="javascript: hdnSort('groupId','<?php echo $order_by; ?>');">Affiliates/Nominees</a></th-->
				  <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='companyID')?'bold':'normal'?>;" href="javascript: hdnSort('companyID','<?php echo $order_by; ?>');">Merchant</a></th>
                  <!--th>Created On</th>
                  <th>Edited On</th>
                  <th>Status</th-->	  
                  <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='status')?'bold':'normal'?>;" href="javascript: hdnSort('status','<?php echo $order_by; ?>');">Status</a></th>                 
				  <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Action</a></th>
                </tr>
              </thead>
              <tbody>
                
				<?php 
				$i=0;
				foreach ($query->result() as $row){  
					if($i%2==0){$rowType="even";}else{$rowType="odd";}
				?> 
                <tr class="<?php echo $rowType;?> pointer">
                  <td><?php echo $row->fname.' '.$row->lname; ?></td>
                  <td><?php echo $row->email; ?></td>
                  <td><?php echo $row->phone; ?></td>
                  <td><?php echo $row->type; ?></td>
                  <td><?php echo $row->level; ?></td>
                  <!--td><?php if($row->adminPermission=="group"){ echo "affiliate"; } else echo $row->adminPermission; ?></td>
                  <td><?php  
				  if($row->groupId!=""){
					$groupName=$this->db->query("select groupName from  t_group where id='".$row->groupId."'")->row_array();
					echo $groupName['groupName'];
				  }
				  if($row->nomineeID!=""){
					$groupNomineeName=$this->db->query("select groupName from t_nomineeGroup where id='".$row->nomineeID."'")->row_array();
					echo $groupNomineeName['groupName'];
				  }
				  ?></td-->
                  <td><?php echo $row->companyID; ?></td>
                  <!--td><?php echo date('d M, Y', strtotime($row->rec_crt_date)); ?></td>
                  <td><?php echo date('d M, Y', strtotime($row->rec_up_date)); ?></td-->
					<td><?php 
						if($row->status=='Y'){ ?>
							<div id="statusDiv<?php echo $row->id; ?>">
							<a href='javascript: void(0);' onclick='javascript: change_status("<?php echo $row->id; ?>","N");'><?php print active_icon(); ?></a></div>
						<?php }else{ ?>
							<div id="statusDiv<?php echo $row->id; ?>">
							<a href='javascript: void(0)' onclick='javascript: change_status("<?php echo $row->id; ?>","Y");'><?php print inactive_icon(); ?></a></div>
						<?php } ?>
					</td>
					<td class=" last" align="center">
						<a href="<?php echo site_url($this->controllerFile.'edit/'.$row->id);?>" class="btn btn-info btn-xs" ><i class="fa fa-pencil"></i></a>
				
						<a href="#" class="btn btn-primary btn-xs" onclick="javascript:var r=confirm('Are you sure to delete?'); if(r==true) { window.location.href='<?php 
						echo site_url($this->controllerFile.'/delete_single/'.$row->id);?>'; }" ><i class="fa fa-trash-o"></i> </a>
					</td>
                </tr>
               <?php $i++; } ?>  
                
              </tbody>
            </table>
           
            </div>
		
		<?php echo $paginator; ?>			
    <?php } ?>
            
            
                                   
			
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->



        
        
        

        
<script language="javascript">
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