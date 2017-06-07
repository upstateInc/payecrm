     <?php error_reporting(0);?>
        <section class="layout">

            <!-- main content -->
            <section class="main-content">

                <!-- content wrapper -->
                <div class="content-wrap">     
<!-- inner content wrapper -->
			
            <div class="wrapper">
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-2">
                            <h3 class="text-center">My Applications</h3>
                            <h5 class="text-center"></h5>
                            <br>

<?php /*?>

</a><?php */ ?>

<script type="text/javascript">
					merchantFormLocked = false;
</script>
<div class="merchantform phub-merchant-form " data-ng-app="phubapp">
	<div data-ng-controller="MerchantFormController" class="ng-scope">
		<div class="panel">
			<div class="panel-body">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>S No. </th>
							<!--<th>Application ID</th>-->
							<th>Applicant</th>
							<th>Email</th>
							<th>Company</th>
							<th>Created On</th>
							<th>Last Updated On</th>
						</tr>
					</thead>
					<tbody>
							
							<?php
							$lie=$this->session->userdata('loggedInEmail');
                   $qr=$this->db->query("select * from t_user where loggedInEmail='".$lie."'");	
                   $res=$qr->result_array();
$i=1;				   
                      foreach($res as $rs){				   
							?>
							
							<tr>
								<td><?php echo $i;?></td>
								<?php /* ?><td><?php echo $rs['id'];?></td><?php */ ?>
								<td><a style="color:#67A2C8" href="<?php echo base_url();?>applicationForm/details_view"><?php echo $rs['name'];?></a></td>
								<td><?php echo $rs['email'];?></td>
								<td><?php echo $rs['organization'];?></td>
								<td><?php echo $rs['date'];?></td>
								<td><?php if($rs['update']!="0000-00-00 00:00:00") echo $rs['update']; else echo $rs['date'];?></td>
							</tr>
							
					  <?php $i++; } ?>
							
							
					</tbody>
				</table>
			</div>
		</div>
<!--<a href="/control/ca-newform">New Form</a>-->	</div>
</div>    				<div class="clear"></div>			
                            
                    <!-- /inner content wrapper -->
