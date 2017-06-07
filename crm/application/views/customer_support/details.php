<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
            
      
      <div class="row">
          <div class="col-md-12">
          	  
            
            <div class="well">
				<table>
				<tr>
				<td width="50%" >
                <h4><strong><?php echo $result_customer['fname'].' '.$result_customer['lname']; ?></strong>&nbsp;&nbsp;<small><strong>Customer ID:</strong> <?php echo $result_customer['customerId']; ?></small></h4>
				</td>
				<td width="50%" align="right" >
					<a href="<?php echo base_url().$this->controllerFile; ?>index" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back</a>
				</td>
				</tr>
				<tr>
					<td height="10px;">
					<h5><strong>Email:</strong> <?php echo $result_customer['customer_email']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Phone:</strong> <?php echo $result_customer['customer_phone']; ?></h5>
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td height="10px;">
                <h5><strong>Address:</strong> <?php echo $result_customer['customer_address']; ?>, <?php echo $result_customer['customer_city']; ?>, <?php echo $result_customer['customer_state']; ?>-<?php echo $result_customer['customer_zip']; ?>, <?php echo $result_customer['customer_country']; ?></h5>
				</td>
					<td>
					</td>
				</tr>
				<tr>
					<td height="10px;">
				<h4><strong>Billing Company Name: <?php echo $result_customer['gateway_descriptor']; ?></strong></h4>
				</td>
					<td>
					</td>
				</tr>
				</table>
				
            </div>
            
           <div role="tabpanel">
           	  <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#all_invoice" aria-controls="all_invoice" role="tab" data-toggle="tab"> Invoice</a></li>
                <li role="presentation"><a href="#all_case" aria-controls="all_case" role="tab" data-toggle="tab">Support Call Notes</a></li>
              </ul>
 
            
            <div class="tab-content">
            
                <div role="tabpanel" class="tab-pane active" id="all_invoice">
                
                <h3>Invoice</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                       <thead>
                        <tr>
                          <th>Date</th>
                          <!--th>Invoice Number</th>
                          <th>Sale By</th-->
                          
                          <th>Price</th>
						  
						  <th>Status</th>
						  <th>Pending Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        
                        
                        <tr>
							<td><?php echo date("M d, Y",strtotime($result_customer['rec_crt_date'])); ?>
							
                          <td>$<?php echo $result_customer['grossPrice']; ?></td>
						  
						  <td><?php echo $result_customer['status']; ?></td>
						  <td>
						  <select id="status<?php echo $result_customer['id']; ?>" name="status" onchange='change_pending_status("<?php echo $result_customer['id']; ?>",this.value, "<?php echo preg_replace(" /[^A-Za-z0-9\-]/", " ", $result_customer['customer_name']); ?>");' >
						<option value="" >None</option>
						<?php if($result_customer['status']=="Authorize"){?>							
							<option value="Capture" <?php if($result_customer['attention_required']=="Capture"){?> selected="selected"<?php } ?>>Capture</option>
							<option value="Void" <?php if($result_customer['attention_required']=="Void"){?> selected="selected"<?php } ?>>Void</option>	
						<?php } ?>
						<?php if($result_customer['status']=="Capture"){?>
							
							<option value="Void" <?php if($result_customer['attention_required']=="Void"){?> selected="selected"<?php } ?>>Void</option>	
						<?php } ?>
						<?php if($result_customer['status']=="Sale"){?>
							
							<option value="Void" <?php if($result_customer['attention_required']=="Void"){?> selected="selected"<?php } ?>>Void</option>
							
						<?php }?>
						<?php if($result_customer['status']=="Settled"){?>
							
							<option value="Refund" <?php if($result_customer['attention_required']=="Refund"){?> selected="selected"<?php } ?>>Refund</option>
						<?php } ?>
						
						<?php if($result_customer['status']=="Settlement"){?>
							<option value="Refund" <?php if($result_customer['attention_required']=="Refund"){?> selected="selected"<?php } ?>>Refund</option>
							<option value="Chargeback" <?php if($result_customer['attention_required']=="Chargeback"){?> selected="selected"<?php } ?>>Chargeback</option>
						<?php } ?>
						
					</select>
						  </td>
                           <td>     
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_case" onclick="AddCaseDetails('<?php echo $result_customer['id']; ?>');">Add Support Call Notes</button>
                           </td>    
                          </td>
                        </tr>
                       
                      </tbody>
                    </table>
                </div>
                
				</div>        
           
            
            	<div role="tabpanel" class="tab-pane" id="all_case">
				<?php if ($result_notes->num_rows() > 0){ ?>
                <h3>Calls</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                       <thead>
                        <tr>
							<th>Date</th>
							<th>Reason</th>
							<th>Call</th>
							<th>Agent</th>
                          
                         </tr>
                      </thead>
                      
                      <tbody>
                        <?php foreach ($result_notes->result() as $case_row){ ?>
                        
                        <tr>
                          <td><?php echo date("M d, Y",strtotime($case_row->rec_crt_date)); ?></td>
                          <td><?php if($case_row->reason!=0){ echo $this->db->query("select reason from t_qc_reasons where id=".$case_row->reason."")->row()->reason; } ?></td>
                          <td><?php echo $case_row->notes; ?></td>
                          <td><?php echo $case_row->technicalSupportAgent; ?></td>
                          
                          
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                </div>
                <?php } ?>
                </div>
                
            </div>
      
          </div>
		 
          
      </div>
      
      
      
      
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>

	     
        
        <!-- Add Case Modal -->
        
        
        <!-- Add Product Type -->
        <div class="modal fade" id="add_case" tabindex="-1" role="dialog" aria-labelledby="add_case" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Support Call Notes</h4>
              </div>
              
               <form role="form" action="<?php echo base_url().$this->controllerFile; ?>addNotes" method="POST">
              <input type="hidden" id="master_id" name="master_id" />
              			   
               <div class="modal-body">
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Reason</label>
					<select name="reason" id="reason" class="form-control">
					<option value="0">Select</option>
					<?php 
						$reason=$this->db->query("select * from t_qc_reasons where status='Y'");
						foreach($reason->result() as $row){ ?>
						<option value="<?php echo $row->id;?>"><?php echo $row->reason;?></option>
					<?php		
						}
					?>
					</select>
                  </div>                  
				  <div class="form-group">
                    <label for="exampleInputEmail1">Support Call Notes *</label>
                    <textarea class="form-control" id="notes" name="notes" placeholder="Enter Support Call Notes" required="required" cols="5"rows="10"></textarea>
                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Call</button>
              </div>

              </form>
              
            </div>
          </div>
        </div>
        
        
        
       
        <script>
		function change_pending_status(id, val, name)
		{			
				$.post('<?php echo base_url().$this->controllerFile; ?>change_pending_status', 'id='+id+'&val='+val, function(data){
					if(data) 
					{
						$("#msgDiv").show("");
						$('#msgDiv').html(data);
						$('#msgDiv').delay(5000).fadeOut('slow', function() {});
						location.reload();					
					}
				});					
		}
		
				$(document).ready(function() {
					AddNote();
				});
		
			function AddNote(){
				$.post( 
				 "<?php echo base_url(); ?>customer/note",
				 { customerID:'<?php echo $this->input->get("id"); ?>',note:$("#note").val() },
				 function(data) {
					$('#notedata').html(data);
					$("#note").val('');
				 }
			  );
			}
			
			function AddCaseDetails(id){
				$("#master_id").val(id);
				
			}
			
		</script>
        
        
        <script>
			
			
			  function ShowPhone(DivId,id){
				//alert(DivId);
				  $.post( 
					 "<?php echo base_url(); ?>customer/get_phone",
					 { id: id },
					 function(data) {
						 //alert(data);
						//$(DivId).html(data);
						//document.getElementById(DivId).innerHTML(data);
						document.getElementById(DivId).textContent = data;
					 }
		
				  );
			  }
			  
			  function ShowEmail(DivId,id){
				//alert(DivId);
				  $.post( 
					 "<?php echo base_url(); ?>customer/get_email",
					 { id: id },
					 function(data) {
						 //alert(data);
						//$(DivId).html(data);
						//document.getElementById(DivId).innerHTML(data);
						document.getElementById(DivId).textContent = data;
					 }
		
				  );
			  }
			 
		 
			$(document).ready(function() {
				if(location.hash) {
					$('a[href=' + location.hash + ']').tab('show');
				}
				$(document.body).on("click", "a[data-toggle]", function(event) {
					location.hash = this.getAttribute("href");
				});
			});
			$(window).on('popstate', function() {
				var anchor = location.hash || $("a[data-toggle=tab]").first().attr("href");
				$('a[href=' + anchor + ']').tab('show');
			});
			
		</script>
       
        
		<?php $this->load->view('footer');?>