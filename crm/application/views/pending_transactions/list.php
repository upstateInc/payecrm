<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<style>
	.redClass{color:red;}
</style>
<div class="mainpanel">
	<?php
      if($query->num_rows() == 0){
	   		echo '<div class="alert alert-warning no-radius no-margin padding-sm" role="alert"><strong><i class="fa fa-warning"></i> Warning:</strong> No Records Found.</div>';
	  } 
		
		
			
	 ?>
<!------------------------search section------------------------>			
			<div class="errSuccessRoutineMsg alert alert-warning no-radius no-margin padding-sm" style="display:none;"></div>
			<!--form class="form-inline" role="form" name="frmSearch" id="frmSearch" action="<?php echo base_url().$this->controllerFile; ?>" method="POST" >
			<div class="well">
			<input type="hidden" name="hdnOrderBy" id="hdnOrderBy" value="<?php echo $order_by; ?>"/>
			<input type="hidden" name="hdnOrderByFld" id="hdnOrderByFld" value="<?php echo $order_by_fld; ?>"/>						
			<input type="hidden" name="search" value="search"/>
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">gatewayName</label>
			<select name="gatewayName" class="form-control">
				<option value="">Select Gateway</option>
				<?php foreach ($gateway->result() as $row){?>
					<option <?php if($gatewayName==$row->gatewayID){?> selected <?php } ?> value="<?php echo $row->gatewayID; ?>"><?php echo $row->gatewayID; ?></option>
				<?php } ?>
			</select>
			</div>
			
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
			<label class="sr-only" for="exampleInputEmail2">Start date</label>
			<input type="text" id="datepiker" name="start_date" placeholder="Start date" value="<?php echo $start_date;?>" class="dp form-control">
			</div>

			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Start end</label>
			<input type="text" id="datepiker1" name="end_date" placeholder="End end" value="<?php echo $end_date;?>" class="dp form-control" >
			</div>			
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Customer Name</label>
			<input type="text" id="customer_name" name="customer_name" placeholder="Customer Name" value="<?php echo $customer_name;?>" class="form-control">
			</div>


			
			<br/>
			<br/>			
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">status</label>
			<select  name="status" class="form-control">
				<option value="">Select Status</option>
				<option value="Authorize" <?php if($status=="Authorize"){?> selected <?php } ?> >Authorize</option>
				<option value="Capture" <?php if($status=="Capture"){?> selected <?php } ?>>Capture</option>
				<option value="Void" <?php if($status=="Void"){?> selected <?php } ?>>Void</option>
				<option value="Refund" <?php if($status=="Refund"){?> selected <?php } ?>>Refund</option>
				<option value="Sale" <?php if($status=="Sale"){?> selected="selected"<?php } ?>>Sale</option>
				<option value="Settlement" <?php if($status=="Settlement"){?> selected="selected"<?php } ?>>Settle</option>
				<option value="Failed" <?php if($status=="Failed"){?> selected="selected"<?php } ?>>Failed</option>
				<option value="Chargeback" <?php if($status=="Chargeback"){?> selected="selected"<?php } ?>>Chargeback</option>
			</select>
			</div>
			<div class="form-group">
				<select name="cardType" id="cardType" class="form-control">
				<option value="">Payment Type</option>
				<?php foreach ($cardTypeName->result() as $row){?>
					<option <?php if($cardType==$row->cardType){?> selected <?php } ?> value="<?php echo $row->cardType; ?>"><?php echo $row->cardType; ?></option>
				<?php } ?>
				</select>
			</div>
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Customer Phone</label>
			<input type="text" id="customer_phone" name="customer_phone" placeholder="Customer Phone" value="<?php echo $customer_phone;?>" class="form-control">
			</div>
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Customer Email</label>
			<input type="text" id="customer_email" name="customer_email" placeholder="Customer Email" value="<?php echo $customer_email;?>" class="form-control">
			</div>		
			<div class="form-group">
			<label class="sr-only" for="exampleInputEmail2">Credit Card</label>
			<input type="text" id="cardNo" name="cardNo" placeholder="Credit Card No" value="<?php echo $cardNo;?>" class="form-control">
			</div>

			
<br/>
<br/>
			<div class="form-group">
				<input type="text" id="invoice_id" name="invoice_id" placeholder="Invoice No" value="<?php echo $invoice_id;?>" class="form-control">
			</div>		
			<div class="form-group">
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
			</div>
			<div class="form-group">
				<a href="<?php echo base_url(); ?>master_success/" class="btn btn-primary"><i class="fa fa-align-justify"></i> Clear</a> 
			</div>
			</div>
			</form-->
			
			
<!-------------------------------------------------------------->
			<?php /* if($where_clause==""){ $where_clause = 1;}
			$totAuth=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and status="Authorize"')->row()->sum;
			$totCap=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and status="Capture"')->row()->sum;
			$totRef=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and status="Refund"')->row()->sum;
			$totChrgBak=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and status="Chargeback"')->row()->sum;
			$totSale=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and status="Sale"')->row()->sum;
			$totSettle=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and status="Settlement"')->row()->sum;
			$totVoid=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and status="Void"')->row()->sum;
			$totFailed=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and status="Failed"')->row()->sum;
			$totEchk=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause.' and paymentType="echecking" and (status="Authorize" or status="Capture" or status="Sale" )')->row()->sum;
			?>
			
			<h5 style="text-align:center;">
			<?php if($totEchk!=""){?> 
			<span style="color:#339933;">Echecking: $<?php echo number_format($totEchk,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and paymentType="echecking" and (status="Authorize" or status="Capture" or status="Sale" )' )->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>			
			<?php if($totAuth!=""){?> 
			<span style="color:#339933;">Auth: $<?php echo number_format($totAuth,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Authorize"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>
			<?php if($totCap!=""){?> 
			<span style="color:#339933;">Capture: $<?php echo number_format($totCap,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Capture"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>

			<?php if($totSale!=""){?> 
			<span style="color:#339933;">Sale: $<?php echo number_format($totSale,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Sale"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>

			<?php if($totVoid!=""){?> 
			<span style="color:#FF0000;">Void: $<?php echo number_format($totVoid,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Void"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>
			<?php if($totFailed!=""){?> 
			<span style="color:#FF0000;">Failed: $<?php echo number_format($totFailed,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Failed"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>
			</h5>
			<?php //echo $where_clause;?>
			<h5 style="text-align:center;color:#339933;">
			
			<?php if($totSettle!=""){?> 
			<span style="color:#339933;">Settle: $<?php echo number_format($totSettle,2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Settlement"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>
			<?php if($totRef!=""){?> 
			<span style="color:#FF0000;">Refund: $<?php echo number_format(abs($totRef),2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Refund"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>			
			<?php if($totChrgBak!=""){?> 
			<span style="color:#FF0000;">Chargeback: $<?php echo number_format(abs($totChrgBak),2);?>(<?php echo $this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Chargeback"')->num_rows();?>)</span>&nbsp;&nbsp;
			<?php }?>
			<?php $settleCnt=$this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Settlement"')->num_rows();?>
			<?php $refCnt=$this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Refund"')->num_rows();?>			
			<?php $chrgbakCnt=$this->db->query('SELECT * from '.$this->table.' where '.$where_clause.' and status="Chargeback"')->num_rows();?>			
			<span style="color:#339933;">
			Total Sales: $<?php echo number_format($totSettle+$totRef+$totChrgBak,2);?>(<?php echo $settleCnt+$refCnt+$chrgbakCnt;?>)
			</span>
			</h5>
			<?php */ ?>
			<?php if($query->num_rows() > 0){?>
            <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='gatewayID')?'bold':'normal'?>;" href="javascript: hdnSort('gatewayID','<?php echo $order_by; ?>');">Gateway</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='companyID')?'bold':'normal'?>;" href="javascript: hdnSort('companyID','<?php echo $order_by; ?>');">Center</a></th>
                    <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='rec_crt_date')?'bold':'normal'?>;" href="javascript: hdnSort('rec_crt_date','<?php echo $order_by; ?>');">Created</a></th>
					<!--th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='rec_up_date')?'bold':'normal'?>;" href="javascript: hdnSort('rec_up_date','<?php echo $order_by; ?>');">Updated</a></th-->

					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_name')?'bold':'normal'?>;" href="javascript: hdnSort('customer_name','<?php echo $order_by; ?>');">Name</a></th>
					<!--th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_phone')?'bold':'normal'?>;" href="javascript: hdnSort('customer_phone','<?php echo $order_by; ?>');">Phone</a></th-->
					

					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='grossPrice')?'bold':'normal'?>;" href="javascript: hdnSort('grossPrice','<?php echo $order_by; ?>');">Amount</a></th>
					<!--th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='cardType')?'bold':'normal'?>;" href="javascript: hdnSort('cardType','<?php echo $order_by; ?>');">Payment</a></th-->
					

					<th ><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='status')?'bold':'normal'?>;" href="javascript: hdnSort('status','<?php echo $order_by; ?>');">Status</a></th>
					
					<th ><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='status')?'bold':'normal'?>;" href="javascript: hdnSort('status','<?php echo $order_by; ?>');">Pending Status</a></th>
					
					<th colspan="2"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Action</a></th>
					
                </tr>
              </thead>
              <tbody>
                
              <?php foreach ($query->result() as $row){   
						$row_center = $this->common_model->Retrive_Record_By_Where_Clause('t_centerdb',"companyID like '%".$row->companyID."%'");
									  
			  ?> 
                <tr id="recordRow<?php echo $row->id; ?>" <?php if($row->status=="Refund" || $row->status=="Void" || $row->status=="Chargeback" || $row->status=="Failed"){?> class="redClass" <?php } ?> <?php if($row->status=="Failed" && $row->reason_descrption!=""){?> 
				title="<?php echo "Failure Reason : ".$row->reason_descrption;?>" <?php } ?>>
					
					<td><?php echo $row->gatewayID; ?></td>
					<td><?php echo $row->companyID; ?></td>
					<td><?php echo date('m-d-Y',strtotime($row->rec_crt_date));?></td>
					<!--td><?php echo date('m-d-Y',strtotime($row->rec_up_date));?></td-->

					<td><?php echo $row->fname.''.$row->lname; ?></td>
					<!--td><?php echo $row->customer_phone; ?></td-->
					<?php $productName = explode("-", $row->product_name);?>
					
					<td><?php if($row->grossPrice < 0) echo '$'. number_format(abs($row->grossPrice), 2); else echo '$'. number_format($row->grossPrice, 2); ?></td>
					<!--td><?php echo $row->cardType; ?></td-->
					
               

				 <td>
					<select id="status<?php echo $row->id; ?>" name="status" onchange='change_trans_status("<?php echo $row->id; ?>",this.value, "<?php echo preg_replace(" /[^A-Za-z0-9\-]/", " ", $row->customer_name); ?>");' <?php if($row->status!="Sale" && $row->status!="Capture" && $row->status!="Settlement" && $row->status!="Authorize" && $row->status!="" ){?> disabled <?php }if($row->lock=='Y'){?> disabled <?php } ?>>
						<?php if($row->status=="Authorize"){?>
							<option value="Authorize" <?php if($row->status=="Authorize"){?> selected="selected"<?php } ?>>Authorize</option>
							<option value="Capture" <?php if($row->status=="Capture"){?> selected="selected"<?php } ?>>Capture</option>
							<option value="Void" <?php if($row->status=="Void"){?> selected="selected"<?php } ?>>Void</option>	
						<?php } ?>
						<?php if($row->status=="Capture"){?>
							<option value="Capture" <?php if($row->status=="Capture"){?> selected="selected"<?php } ?>>Capture</option>
							<option value="Void" <?php if($row->status=="Void"){?> selected="selected"<?php } ?>>Void</option>	
						<?php } ?>
						<?php if($row->status=="Sale"){?>
							<option value="Sale" <?php if($row->status=="Sale"){?> selected="selected"<?php } ?>>Sale</option>
							<option value="Void" <?php if($row->status=="Void"){?> selected="selected"<?php } ?>>Void</option>
							<?php if($row->paymentType=="echecking"){?>}
							<option value="Settlement" <?php if($row->status=="Settlement"){?> selected="selected"<?php } ?>>Settle</option>
							<?php } ?>
						<?php }?>
						<?php if($row->status=="Settled"){?>
							<option value="Settled" <?php if($row->status=="Settled"){?> selected="selected"<?php } ?>>Settled</option>
							<option value="Refund" <?php if($row->status=="Refund"){?> selected="selected"<?php } ?>>Refund</option>
						<?php } ?>
						<?php if($row->status=="Void"){?>
							<option value="Void" <?php if($row->status=="Void"){?> selected="selected"<?php } ?>>Void</option>
						<?php } ?>
						<?php if($row->status=="Refund"){?>
							<option value="Refund" <?php if($row->status="Refund"){?> selected="selected"<?php } ?>>Refund</option>
						<?php } ?>						
						<?php if($row->status=="Chargeback"){?>
							<option value="Chargeback" <?php if($row->status="Chargeback"){?> selected="selected"<?php } ?>>Chargeback</option>
						<?php } ?>
						<?php if($row->status=="Settlement"){?>
							<option value="Settlement" <?php if($row->status=="Settlement"){?> selected="selected"<?php } ?>>Settle</option>
							<option value="Refund" <?php if($row->status=="Refund"){?> selected="selected"<?php } ?>>Refund</option>
							<option value="Chargeback" <?php if($row->status=="Chargeback"){?> selected="selected"<?php } ?>>Chargeback</option>
						<?php } ?>
						<?php if($row->status=="Failed"){?>
							<option value="Failed" <?php if($row->status="Failed"){?> selected="selected"<?php } ?>>Failed</option>
						<?php } ?>
					</select>
					
					<span id="dateChargeback<?php echo $row->id; ?>" style="display:none;">
						<input type="text" id="datepiker<?php echo $row->id; ?>" placeholder="Select Date" class="dp dtpkr form-control input-sm">
						<button type="button" class="btn btn-success btn-xs" onclick='change_trans_status2("<?php echo $row->id; ?>","Chargeback", "<?php echo preg_replace(" /[^A-Za-z0-9\-]/", " ", $row->customer_name); ?>");'>Change</button>
						<button type="button" class="btn btn-danger btn-xs" onclick="location.reload();">Cancel</button>
					</span>
					
					<?php if($row->gatewayTransactionId!=""){?>
					<span id="refundAmount<?php echo $row->id; ?>" style="display:none;">
					<?php
					$totPartialRedund=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where originalGatewayTransactionId="'.$row->gatewayTransactionId.'"')->row()->sum;
					?>
						<input id="amount<?php echo $row->id; ?>" type="number" value="<?php echo $row->grossPrice+$totPartialRedund;?>" min="1"  max="<?php echo $row->grossPrice+$totPartialRedund;?>"/>
						<button type="button" class="btn btn-success btn-xs" onclick='change_trans_status3("<?php echo $row->id; ?>","Refund", "<?php echo preg_replace(" /[^A-Za-z0-9\-]/", " ", $row->customer_name); ?>");'>Change</button>
						<button type="button" class="btn btn-danger btn-xs" onclick="location.reload();">Cancel</button>
					</span>
					<?php } ?>
					
					</td>
					<td>
						<select name="attention_required" id="attention_required" onchange='change_pending_status("<?php echo $row->id; ?>",this.value);'>
							<option value="">None</option>
							<option selected ><?php echo $row->attention_required;?></option>
						</select>
					</td>
					<td colspan="2">
                  <div class="btn-group">
					<?php
					if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ 
					?>
						
						
						<a href="<?php echo site_url($this->controllerFile.'pop/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-search"> Details</span></a>
						<a href="<?php echo site_url($this->controllerFile.'messages/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-search"> Messages</span></a>
						
						<!--------------------------------Emails---------------------------------->
						<!--div class="btn-group">
						<!--------------------------Refund Email------------------------------>
						<?php /*if($row->status=="Refund"){?>
                          <a href="javascript:;" class="btn btn-info btn-xs" data-toggle="modal" data-target="#send_refund_invoice" onclick="SetInvoiceId('<?php echo md5($row->id); ?>');"><span aria-hidden="true" class="fa fa-envelope-o"></span>Email</a>
						  
						<?php }else{ ?> 
						<!------------------------General Emails------------------------------->
						  <a href="javascript:;" class="btn btn-info btn-xs" data-toggle="modal" data-target="#send_invoice" onclick="SetInvoiceId('<?php echo md5($row->id); ?>');"><span aria-hidden="true" class="fa fa-envelope-o"></span> Emails</a>
						<?php } */?>
						<!--/div>
						<!--------------------------------Emails---------------------------------->
					<?php } ?>
                   </div>
                  </td>
                </tr>
			<?php  } ?>  
                
              </tbody>
            </table>
           
            </div>
		
		<?php echo $paginator; ?>			
    <?php } ?>
            
            
                                   
			</div>
        </div><!-- mainpanel -->
    </div><!-- mainwrapper -->
</section>


        <!-- Modal -->
        <div class="modal fade" id="send_invoice" tabindex="-1" role="dialog" aria-labelledby="send_invoice" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Resend the following Emails</h4>
                    </div>
                    <form id="resendInvoiceForm" method="POST" action="<?php echo $this->config->item('company_base_url'); ?>resend_invoice.php" >
                        <div class="modal-body" id="">

                            <input type="hidden" id="TextInvoiceId" name="TextInvoiceId" />
							<div class="form-group">
								<label>Welcome</label>
								<input type="checkbox" id="emailType" name="emailType[]" value="1">
								<label>Invoice</label>
								<input type="checkbox" id="emailType" name="emailType[]" value="2">
								<label>Feedback</label>
								<input type="checkbox" id="emailType" name="emailType[]" value="3">
							</div>
							<div class="form-group">
                            <label>Send copy to Customer?</label>
								<input type="checkbox" value="yes" name="SendCustomer">
							</div>
                            <div class="form-group">
                                <label >To Be CC (Multiple Separated By Comma)</label>
                                <input type="text" class="form-control" id="InvoiceCC" name="InvoiceCC" placeholder="Email ID, To CC"  >
                            </div>

                            <div class="form-group">
                                <label >To Be BCC (Multiple Separated By Comma)</label>
                                <input type="text" class="form-control" id="InvoiceBCC" name="InvoiceBCC" placeholder="Email ID, To BCC" >
                            </div>
                            <br>
                            <div class="form-group">
                                <label >Agent Note (It will reflect in email)</label>
                                <input type="text" class="form-control" id="AgentNote" name="AgentNote" placeholder="Agent Note" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		<!-------------------------------Refund-------------------------------------->
        <div class="modal fade" id="send_refund_invoice" tabindex="-1" role="dialog" aria-labelledby="send_invoice" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Send Refund Email</h4>
                    </div>
                    <form id="resendInvoiceForm" method="POST" action="<?php echo $this->config->item('company_base_url'); ?>send_refund_invoice.php" >
                        <div class="modal-body" id="">

                            <input type="hidden" id="RefundInvoiceId" name="RefundInvoiceId" />
							
							<div class="form-group">
                            <label>Send copy to Customer?</label>
								<input type="checkbox" value="yes" name="SendCustomer">
							</div>
                            <div class="form-group">
                                <label >To Be CC (Multiple Separated By Comma)</label>
                                <input type="text" class="form-control"  name="InvoiceCC" placeholder="Email ID, To CC"  >
                            </div>

                            <div class="form-group">
                                <label >To Be BCC (Multiple Separated By Comma)</label>
                                <input type="text" class="form-control"  name="InvoiceBCC" placeholder="Email ID, To BCC" >
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>		
		<!--------------------------------------------------------------------------->

      
<script language="javascript">
	function change_pending_status(id,val){
		$.post('<?php echo base_url(); ?>customer_support/change_pending_status', 'id='+id+'&val='+val, function(data){
			if(data) 
			{
				$("#msgDiv").show("");
				$('#msgDiv').html(data);
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
				location.reload();					
			}
		});			
	}
   function SetInvoiceId(id){
		$('#TextInvoiceId').val(id);
		$('#RefundInvoiceId').val(id);
	}
	$('#resendInvoiceForm').submit(function() {
		var total=$(this).find('input[name="emailType[]"]:checked').length;
		//alert(total);
		if(total<1){
			alert("Select at least 1 Email Type");
			return false;
		}
	});	
	function changeProduct (invoice_id, companyID, productPeriod, productId){
		//alert(productId);
		var r=confirm("Are you sure to change the Product of Record?");
		if (r == true) {
			$.post('<?php echo base_url().$this->controllerFile; ?>changeProduct', 'invoice_id='+invoice_id+'&companyID='+companyID+'&productId='+productId+"&productPeriod="+productPeriod, function(data){
				if(data) 
				{
					$("#msgDiv").show("");
					$('#msgDiv').html('Product Information Changed Successfully');
					$('#msgDiv').delay(5000).fadeOut('slow', function() {});
					location.reload();					
				}
			});			
		}
	}
	function changeProductInfo (id, invoice_id, companyID){
		var r=confirm("Are you sure to change the Product Information?");
		if (r == true) {
			var productId = jQuery("#productId"+id).val();
			var product_name = jQuery("#product_name"+id).val();
			var productPeriod = jQuery("#productPeriod"+id).val();
			var productDuration = jQuery("#productDuration"+id).val();

			$.post('<?php echo base_url().$this->controllerFile; ?>changeProductInfo', 'invoice_id='+invoice_id+'&companyID='+companyID+'&productId='+productId+'&product_name='+product_name+'&productPeriod='+productPeriod+'&productDuration='+productDuration, function(data){
				if(data) 
				{
					$("#msgDiv").show("");
					$('#msgDiv').html('Product Information Changed Successfully');
					$('#msgDiv').delay(5000).fadeOut('slow', function() {});
					location.reload();					
				}
			});			
		}
	}
	function check_status(gatewayTransactionId,gatewayID,companyID){
	$('.bolt').show();
	$('#bolt'+gatewayTransactionId).html('<img src="<?php echo base_url(); ?>images/loading.gif" alt=""/>');
	$.post('<?php echo base_url().$this->controllerFile; ?>check_status', 'gatewayTransactionId='+gatewayTransactionId+'&gatewayID='+gatewayID+'&companyID='+companyID, function(data){		
		$('#bolt'+gatewayTransactionId).html('');
		$('#bolt'+gatewayTransactionId).hide("slow");
		$('.statInfo').hide("slow");
		$('#statInfo'+gatewayTransactionId).html(data);
		$('#statInfo'+gatewayTransactionId).show("slow");
	});
}
function discard(gatewayTransactionId){	
	$('#statInfo'+gatewayTransactionId).hide("slow");
	$('#bolt'+gatewayTransactionId).show("slow");
}
function change_trans_status(id, val, name)
{
		if(val=='Chargeback'){
			var r=confirm("Are you sure to change the state of transaction record for "+name+" and use Present Date?"); 
		}else{
			var r=confirm("Are you sure to change the state of transaction record for "+name+" ?"); 
		}
		if (r == true) {
			if(val=='Refund'){
				jQuery("#refundAmount"+id+"").show();
			}
			else{
				$.post('<?php echo base_url(); ?>master_success/change_trans_type', 'id='+id+'&val='+val, function(data){
					if(data) 
					{
						$("#msgDiv").show("");
						//$('#msgDiv').html('Status Changed Successfully');
						$('#msgDiv').html(data);
						$('#msgDiv').delay(5000).fadeOut('slow', function() {});
						//alert("Tansaction record for "+name+" changed successfully");
						location.reload();					
					}
				});
			}
		}else if(r == false && val=='Chargeback'){
			//alert('ok');
			jQuery("#dateChargeback"+id+"").show();
		}
}
function change_trans_status2(id, val, name){
	var recDate=jQuery("#datepiker"+id+"").val();
	//alert(date);
	$.post('<?php echo base_url(); ?>master_success/change_trans_type', 'id='+id+'&val='+val+'&recDate='+recDate, function(data){
		if(data) 
		{
				$("#msgDiv").show("");
				//$('#msgDiv').html('Status Changed Successfully');
				$('#msgDiv').html(data);
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
				//alert("Tansaction record for "+name+" changed successfully");
				location.reload();					
		}
	});
}
function change_trans_status3(id, val, name){
	var amount=jQuery("#amount"+id+"").val();
	//alert(amount);
	//alert(date);
	$.post('<?php echo base_url(); ?>master_success/change_trans_type', 'id='+id+'&val='+val+'&amount='+amount, function(data){
		if(data) 
		{
				$("#msgDiv").show("");
				//$('#msgDiv').html('Status Changed Successfully');
				$('#msgDiv').html(data);
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
				//alert("Tansaction record for "+name+" changed successfully");
				location.reload();					
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
function change_center_status(id, val, companyID)
{	
	$('#statusDiv'+id).html('<img src="<?php echo base_url(); ?>images/admin/loading.gif" alt=""/>');
	$.post('<?php echo base_url().$this->controllerFile; ?>change_center_status', 'id='+id+'&val='+val+'&companyID='+companyID, function(data){
		if(data) 
		{
			$("#msgDiv").show("");
			
			$('#msgDiv').delay(5000).fadeOut('slow', function() {});
			alert("Status Updated Successfully");
			location.reload();
		}
	});
}
</script>
<script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
	// When the document is ready
	$(document).ready(function () {
		$('.dtpkr').datepicker({
			format: "mm-dd-yyyy"
		});
		$('#datepiker1').datepicker({
			format: "mm-dd-yyyy"
		});
		
		$('#datepiker').datepicker({
			format: "mm-dd-yyyy",
			minDate: new Date(),
		});
		
		$('.dp').on('change', function () {
			$('.datepicker').hide();
			var startDate = new Date($('#datepiker').val());
			var endDate = new Date($('#datepiker1').val());
			if(startDate!="" && endDate!=''){
				if (startDate > endDate){
					//alert('End Date Connot be Less than Start Date');
					// Do something
					jQuery(".errSuccessRoutineMsg").show();
					jQuery(".errSuccessRoutineMsg").html('End Date Connot be Less than Start Date');
					jQuery("#datepiker1").val("");
					setTimeout(function() {
						$('.errSuccessRoutineMsg').fadeOut('fast');
					}, 5000);
				}
			}			
		});
	});
</script>
        
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		