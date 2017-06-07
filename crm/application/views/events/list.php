<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
                    
			<div class="contentpanel contentpanel-mediamanager"> 
			<?php
			if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ 
			?>
			<div class="clearfix">
			<div class="pull-right"><a href="<?php echo site_url($this->controllerFile.'add');?>" class="btn btn-primary" data-toggle="modal" ><span class="glyphicon glyphicon-plus"></span> Add </a></div>
			</div><br/>
			<?php } ?>
	
	<?php /*if($this->session->flashdata('success') != ''){ ?>
        <div class="alert alert-success no-radius no-margin padding-sm" role="alert"><strong><i class="glyphicon glyphicon-ok"></i> Success: </strong><?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php }*/ ?>
	
	<?php
      if($query->num_rows() == 0){
	   		echo '<div class="alert alert-warning no-radius no-margin padding-sm" role="alert"><strong><i class="fa fa-warning"></i> Warning:</strong> No Records Found.</div>';
	  } 
		
		 if($query->num_rows() > 0){
			
	 ?>
<!------------------------search section------------------------>			
			<form class="form-inline well" role="form" name="frmSearch" id="frmSearch" action="<?php echo base_url().$this->controllerFile; ?>" method="POST" >
			<input type="hidden" name="search" value="search"/>
			
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Subject</label>
			<input type="text" class="form-control" name="subject" id="subject" value="<?php echo $subject;?>" placeholder="Subject">
			</div>

			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			<a href="<?php echo base_url().$this->controllerFile;?>" style="font-weight:bold">View All</a>
			</form>
<!-------------------------------------------------------------->			
            <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Created On</th>
                  <th>Edited On</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                
              <?php foreach ($query->result() as $row){   ?> 
                <tr>
                  <td><?php echo $row->subject; ?></td>
                  <td><?php echo $row->message; ?></td>
                  <td><?php echo date('d M, Y', strtotime($row->rec_crt_date)); ?></td>
                  <td><?php echo date('d M, Y', strtotime($row->rec_up_date)); ?></td>
				  <?php
					if($this->session->userdata('ADMIN_TYPE')=='superadmin'){					
					?>
				  <td>
                  <div class="col-md-6">
					<select class="form-control" id="status" name="status" onChange="change_status(<?php echo $row->id;?>,this.value);" >
						<option value="Y" <?php if($row->status=='Y'){?> selected="selected" <?php } ?>>Active</option>
						<option value="N" <?php if($row->status=='N'){?> selected="selected" <?php } ?>>Inactive</option>					
					</select>
				  </div>
				  
				   <div class="col-md-6">
						<a href="#" class="btn btn-primary btn-xs" onclick="javascript:var r=confirm('Are you sure to delete?'); if(r==true) { window.location.href='<?php 
						echo site_url($this->controllerFile.'/delete_single/'.$row->id);?>'; }" ><span class="glyphicon glyphicon-trash"> Delete</span> </a>                      

				  
				  </div>
				  </td>
						
					<?php } ?>
                   
                  
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
	//alert(id);	
	$.post('<?php echo base_url().$this->controllerFile; ?>/change_status', 'id='+id+'&val='+val, function(data){
		if(data) 
		{
			alert('Status Changed Successfully');	
		}
	});
}
</script>
        
		<?php $this->load->view('footer');?>