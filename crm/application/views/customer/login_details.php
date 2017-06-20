<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<link href="<?php echo base_url(); ?>css/datepicker.css" rel="stylesheet">
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
			
			<form class="form-inline well" role="form" name="frmSearch" id="frmSearch" action="<?php echo base_url().$this->controllerFile.'login-details/'.$this->uri->segment(3).'/'; ?>" method="POST" >
			<input type="hidden" name="search" value="search"/>
				<div class="form-group">
					<label class="sr-only" for="exampleInputEmail2">Start date</label>
					<input type="text" class="form-control" id="datepiker" name="start_date" placeholder="Start date" value="<?php echo $start_date; ?>">
				</div>



				<div class="form-group">
					<label class="sr-only" for="exampleInputEmail2">Start end</label>
					<input type="text" class="form-control" id="datepiker1" name="end_date" placeholder="End end" value="<?php echo $end_date; ?>">
				</div>

			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			<a href="<?php echo base_url().$this->controllerFile.'login-details/'.$this->uri->segment(3);?>" style="font-weight:bold">View All</a>
			</form>
<!-------------------------------------------------------------->			
            <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
                  <th>Login Time</th>
                  <th>Logout Time</th>
                  <th>Total Active Time</th>
                </tr>
              </thead>
              <tbody>
                
              <?php foreach ($query->result() as $row){   ?> 
                <tr>
                  <td><?php echo date('d M, Y H:i:s', strtotime($row->loginTime)); ?></td>
                  <td><?php if(strtotime($row->logoutTime)>0){ echo date('d M, Y H:i:s', strtotime($row->logoutTime));} ?></td>
                  <td>
				  <?php 
					if(strtotime($row->logoutTime)>0){
						$datetime1 = strtotime($row->loginTime);
						$datetime2 = strtotime($row->logoutTime);
						$init = $datetime2 - $datetime1;// == <seconds between the two times>
						/*$hours = $secs / 3600;
						echo $hours;
						$init = 685;*/
						$hours = floor($init / 3600);
						$minutes = floor(($init / 60) % 60);
						$seconds = $init % 60;
						echo "$hours Hrs : $minutes Mins : $seconds  secs";
						$totalTime+= $init;
					}	
					?>
				  </td>
                </tr>
               <?php } ?>  
                
              </tbody>
            </table>
			<?php
						$hoursTotal = floor($totalTime / 3600);
						$minutesTotal = floor(($totalTime / 60) % 60);
						$secondsTotal = $totalTime % 60;
						echo "<h1>Total Time - $hoursTotal Hrs : $minutesTotal Mins : $secondsTotal  secs</h1>";			
			?>
				
            </div>
		
		<?php echo $paginator; ?>			
    <?php } ?>
            
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>
        <script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>
   		<script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                $('#datepiker').datepicker({
                    format: "yyyy-mm-dd"
                }); 
				
				$('#datepiker1').datepicker({
                    format: "yyyy-mm-dd"
                });  
            
            });
        </script>
       
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