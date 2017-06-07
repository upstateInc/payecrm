<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
                    
	<div class="contentpanel contentpanel-mediamanager"> 
                
			<div class="well">
				<table>
				<tr>
				<td width="50%" >
                <h4><strong><?php echo $query['fname'].' '.$query['lname']; ?></strong>&nbsp;&nbsp;<small><strong>Customer ID:</strong> <?php echo $query['customerId']; ?></small></h4>
				</td>
				<td width="30%"></td>
				<td width="50%" align="right" >
					<a href="<?php echo base_url().$this->controllerFile; ?>index" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back</a>
				</td>
				</tr>
				<tr>
					<td height="10px;">
					<h5><strong>Email:</strong> <?php echo $query['customer_email']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Phone:</strong> <?php echo $query['customer_phone']; ?></h5>
					</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td height="10px;">
                <h5><strong>Address:</strong> <?php echo $query['customer_address']; ?>, <?php echo $query['customer_city']; ?>, <?php echo $query['customer_state']; ?>-<?php echo $query['customer_zip']; ?>, <?php echo $query['customer_country']; ?></h5>
				</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td height="10px;">
				<h4><strong>Billing Company Name: <?php echo $query['gateway_descriptor']; ?></strong></h4>
				</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td height="10px;">
						<strong>Product: </strong><?php echo $query['product_name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
						<strong>Duration: </strong><?php echo $query['productDuration']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
						<strong>Price:</strong> <?php echo '$'.$query['grossPrice']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					</td>
					<td>
						
					</td>
					<td>
						
					</td>
				</tr>
				<tr>
					<td height="10px;">
						<strong>Security lenght:</strong> <?php echo $query['securityProtection']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
						<strong>Device(s):</strong> <?php echo $query['totalDevices']; ?>
					</td>
					<td>
						
					</td>
					<td></td>
				</tr>
				</table>
				
            </div>
			
			
	 
	<!---------------------Form Section Starts-------------------------->
	           <div role="tabpanel">
           	  <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#all_invoice" aria-controls="all_invoice" role="tab" data-toggle="tab"> Validation</a></li>
                <li role="presentation"><a href="#all_case" aria-controls="all_case" role="tab" data-toggle="tab">Messages</a></li>
              </ul>
	<div class="tab-content">
	 <div role="tabpanel" class="tab-pane active" id="all_invoice">
	<form id="frmMain" name="frmMain" method="post" action="<?php echo base_url().$this->controllerFile;?>update" enctype="multipart/form-data">     
    <input type="hidden" name="id" id="id" value="<?php echo $query['id']; ?>" />  
	
		<div class="form-group">
		<label for="exampleInputEmail1">Pending Status </label>
		<select class="form-control" name="attention_required" >
					<?php if($query['status']=="Authorize"){ ?>
						<option value="" >None</option>
						<option value="Capture" <?php if($query['attention_required']=="Capture"){?> selected="selected"<?php } ?>>Capture</option>
						<option value="Void" <?php if($query['attention_required']=="Void"){?> selected="selected"<?php } ?>>Void</option>	
					<?php } ?>
		</select>
		</div>
				

		<div class="form-group">
			<label for="exampleInputEmail1">Validated</label>
			<select class="form-control" id="validated" name="validated" >
				<option value="">Select</option>
				<option value="Y" <?php if($query['validated']=="Y"){?> selected="selected"<?php } ?>>Y</option>
				<option value="N" <?php if($query['validated']=="N"){?> selected="selected"<?php } ?>>N</option>
			</select>
		</div>
		<!--div class="form-group">
			<label for="exampleInputEmail1">Rating</label>
			<select class="form-control" id="rating" name="rating" >
				<option value="">Select</option>
				<option value="1" <?php if($query['rating']==1){?> selected="selected"<?php } ?>>Poor</option>
				<option value="2" <?php if($query['rating']==2){?> selected="selected"<?php } ?>>Fair</option>
				<option value="3" <?php if($query['rating']==3){?> selected="selected"<?php } ?>>Good</option>
			</select>
		</div-->
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
			<label for="exampleInputEmail1">Message</label>
			<textarea class="form-control" id="comment" name="comment" placeholder="Message"></textarea>
		</div>

		<?php /*if($this->session->userdata('CANCELORCLEAR')=='N'){ ?>
		
			Attention Required<input type="checkbox" id="attention_required" name="attention_required" value="Y" <?php if($query['attention_required']=='Y'){ ?> checked <?php } ?> >
		
		<?php }*/ ?>
		<br/>
		<br/>
		<button type="submit" class="btn btn-default">Submit</button>
    </form>
	</div>
    <!------------------------------------------Existing Messages---------------------------------------------------->
				<div role="tabpanel" class="tab-pane" id="all_case">
				<?php if ($result_notes->num_rows() > 0){ ?>
               
                <div class="table-responsive">
                    <table class="table table-striped">
                       <thead>
                        <tr>
							<th>Date</th>
							<th>Reason</th>
							<th>Message</th>
							<th>Agent</th>
                          
                         </tr>
                      </thead>
                      
                      <tbody>
                        <?php foreach ($result_notes->result() as $case_row){ ?>
                        
                        <tr>
                          <td><?php echo date("M d, Y",strtotime($case_row->rec_crt_date)); ?></td>
                          <td><?php if($case_row->reason!=0){echo $this->db->query("select reason from t_qc_reasons where id=".$case_row->reason."")->row()->reason;} ?></td>
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
	<!---------------------------------------------------------------------------------------------------------->
	</div>
</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section>  

<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		