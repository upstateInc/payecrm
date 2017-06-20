<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
                    
			<div class="contentpanel contentpanel-mediamanager"> 
			<?php
			/*if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ 
			?>
			<div class="clearfix">
				<div class="pull-right">
				<a href="<?php echo site_url($this->controllerFile.'add');?>" class="btn btn-primary" data-toggle="modal" >
					<span class="glyphicon glyphicon-plus">
					</span> Add </a>
				</div>
			</div><br/>
			<?php }*/ ?>
	
	<?php /*if($this->session->flashdata('success') != ''){ ?>
        <div class="alert alert-success no-radius no-margin padding-sm" role="alert"><strong><i class="glyphicon glyphicon-ok"></i> Success: </strong><?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php }*/ ?>
	Showing Records For : <strong><?php echo $queryRow['aliasName'].'('.$queryRow['name'].')'; ?></strong>
	<?php
      if($query->num_rows() == 0){
	   		echo '<div class="alert alert-warning no-radius no-margin padding-sm" role="alert"><strong><i class="fa fa-warning"></i> Warning:</strong> No Records Found.</div>';
	  } 
		
		 if($query->num_rows() > 0){
			
	 ?>
	 
<!------------------------search section------------------------>
			
			<!--form class="form-inline well" role="form" name="frmSearch" id="frmSearch" action="<?php echo base_url().$this->controllerFile; ?>" method="POST" >
			<input type="hidden" name="search" value="search"/>
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Name</label>
			<input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" placeholder="Name">
			</div>

			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Email</label>
			<input type="text" class="form-control" name="email" id="email" value="<?php echo $email;?>" placeholder="Email">
			</div>

			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			<a href="<?php echo base_url();?>super-admin-user" style="font-weight:bold">View All</a>
			</form-->
<!-------------------------------------------------------------->			
            <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
                  <th>Action Url</th>
                  <th>Action Type</th>                  
                  <th>Action Info</th>
                  <th>Action Time</th>				  
                </tr>
              </thead>
              <tbody>
                
              <?php foreach ($query->result() as $row){   ?> 
                <tr>
                  <td><a href="<?php echo base_url().$row->action_url; ?>" target="_blank"><?php echo $row->action_url;?></a></td>
                  <td><?php if($row->action_type==0){ echo 'Browse'; } elseif($row->action_type==1){ echo 'Email Click'; } elseif($row->action_type==2){ echo 'Phone Click'; } ?></td>
                  <td><?php echo $row->action_info; ?></td>
                  <td><?php echo date('d M, Y H:i:s', strtotime($row->action_time)); ?></td>
                  
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
        
		<?php $this->load->view('footer');?>