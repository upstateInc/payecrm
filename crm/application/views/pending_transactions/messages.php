<?php $this->load->view('header');?>
<?php $this->load->view('left');
//print_r($row);
?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
<?php if ($result_notes->num_rows() > 0){ ?>
                
                <div class="table-responsive">
                    <table class="table table-striped">
                       <thead>
                        <tr>
							<th>Date</th>
							<th>Message</th>
							<th>Agent</th>
                          
                         </tr>
                      </thead>
                      
                      <tbody>
                        <?php foreach ($result_notes->result() as $case_row){ ?>
                        
                        <tr>
                          <td><?php echo date("M d, Y",strtotime($case_row->rec_crt_date)); ?></td>
                          <td><?php echo $case_row->notes; ?></td>
                          <td><?php echo $case_row->technicalSupportAgent; ?></td>
                          
                          
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                </div>
                <?php } ?>

	</div>
</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>  
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		