<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<style>
	.redClass{color:red;}
</style>
<div class="mainpanel">
	<?php
      if($query->num_rows() == 0 && $query1->num_rows() == 0){
	   		echo '<div class="alert alert-warning no-radius no-margin padding-sm" role="alert"><strong><i class="fa fa-warning"></i> Warning:</strong> No Records Found.</div>';
	  } 
		
		
			
	 ?>
<!------------------------search section------------------------>			
			<div class="errSuccessRoutineMsg alert alert-warning no-radius no-margin padding-sm" style="display:none;"></div>
			<!------------------------------------------------------------>
			<form method="POST">
			<input type="hidden" name="totalNoRows" id="totalNoRows" value="<?php echo $totalNoRows;?>" />
			<input type="hidden" name="selectedHighTickets" id="selectedHighTickets" value="<?php echo $selectedHighTickets;?>" />
			<input type="hidden" name="totalSumGenerated" id="totalSumGenerated" value="<?php echo $totalSumGenerated;?>" />
			<input type="hidden" name="search" value="1"/>
			<div class="form-group" style="float:left;">
			<select  name="gatewayName" onchange="change_order_fld1('date','asc');this.form.submit();">
				<option value="">Select Gateway</option>
				<?php foreach ($gateway->result() as $row){?>
					<option <?php if($gatewayName==$row->gatewayID){?> selected <?php } ?> value="<?php echo $row->gatewayID; ?>"><?php echo $row->gatewayID; ?></option>
				<?php } ?>
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;
			</div>			
			<h5 style="text-align:center;">
			<div class="form-group" style="float:left;">
				<strong>&nbsp;&nbsp;Validated</strong> &nbsp;&nbsp;<input name="validated" value="Y" type="checkbox" <?php if($validated=='Y') echo 'checked';?> onclick="this.form.submit();" >
			</div>
			<div class="form-group" style="float:left;">
            <strong>&nbsp;&nbsp;Date : </strong> 
			Oldest &nbsp;&nbsp;<input type="radio" <?php if($order_fld=='date' && $order_by=='asc') echo 'checked';?> onclick="change_order_fld('date','asc');" >
			Newest &nbsp;&nbsp;<input type="radio" <?php if($order_fld=='date' && $order_by=='desc') echo 'checked';?> onclick="change_order_fld('date','desc');">
			&nbsp;&nbsp;&nbsp;&nbsp;
			</div>			
			<div class="form-group" style="float:left;">
            <strong>&nbsp;&nbsp;Amount : </strong> 
			Smallest &nbsp;&nbsp;<input type="radio" <?php if($order_fld=='amount' && $order_by=='asc') echo 'checked';?> onclick="change_order_fld('amount','asc');" >
			Largest &nbsp;&nbsp;<input type="radio" <?php if($order_fld=='amount' && $order_by=='desc') echo 'checked';?> onclick="change_order_fld('amount','desc');">
			&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			

			
			
			<!--div class="form-group" style="float:left;">
			<select name="ticket" onchange="this.form.submit();">
				<option value="">Select Tickets</option>
				<option value="1" <?php if($ticket==1) echo 'selected'; ?> >High</option>
				<option value="2" <?php if($ticket==2) echo 'selected'; ?> >Low</option>
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;
			</div-->

			
			
			<div class="form-group"  <?php if($authorizedShowHide=='Y'){ ?> style="display:none;!important" <?php }else{ ?> style="float:left;" <?php } ?> >
			<strong>&nbsp;&nbsp;Show Authorized</strong> &nbsp;&nbsp;<input name="authorizedShowHide" value="Y" type="radio" <?php if($authorizedShowHide=='Y') echo 'checked';?> onclick="this.form.submit();" >
			</div>
			
			
			
			<div class="form-group" style="float:left;">
			&nbsp;&nbsp;
				<a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><i class="fa fa-align-justify"></i> Clear</a> 
			</div>
			<div class="form-group" style="float:left;">
			&nbsp;&nbsp;
				<a href="javascript:void(0)" onclick="window.location.reload()" class="btn btn-primary"><i class="fa fa-align-justify"></i> Reload</a> 
			</div>

			</form>
			<?php if($gatewayName!=""){?>			
			<div class="form-group" style="float:left;">
			&nbsp;&nbsp;
				<a href="javascript:void(0)" onclick="captureAll();" class="btn btn-primary"><i class="fa fa-align-justify"></i> Capture</a> 
			</div>
			<?php } ?>
			</h5>
			<br/>
			<br/>
			<br/>
			<h5 style="text-align:center;">
            <?php 
				if($gatewayName==""){
					$gatewayView = $this->db->query("Select distinct(gatewayID),daily_volume,dailyHighTicketCapture from  t_midmaster where status='Y' and visibility='Y' order by gatewayID asc");				
				}else{
					$gatewayView = $this->db->query("Select distinct(gatewayID),daily_volume,dailyHighTicketCapture from  t_midmaster where gatewayID='".$gatewayName."'");
				}
			
			$numCnt=0;
			$totalAuth=0;			
			$totalCapture=0;			
			$totalSale=0;			
			$totalSettle=0;			
			$totalRefund=0;			
			$totalGoodSale=0;			
			$totalAuthLow=0;			
			$totalAuthHigh=0;			
			$totalMaxSales=0;			
			foreach ($gatewayView->result() as $row){
			if($numCnt%2==0){ $clr='#D4E6F1'; $backClr="#FFFFE0"; }else{  $clr='#F4F6F6'; $backClr="#FFF0F5";}
			$sumTot=""; 
			$sumTotCnt=""; 
			$dailyHighTicketCapture = $row->dailyHighTicketCapture;
			$daily_volume = $row->daily_volume;
			?>
			
			<?php 
			$SYSTEMMAXSALESALLOWED = $this->db->query('SELECT SYSTEMMAXSALESALLOWED FROM t_system_settings WHERE `id` = 1')->row()->SYSTEMMAXSALESALLOWED;
			$where_clause1 = " gatewayId='".$row->gatewayID."'"; 
			
			$MaxSales=$this->db->query('SELECT count(*) as cnt from '.$this->table.' where '.$where_clause1.' and grossPrice > '.$SYSTEMMAXSALESALLOWED.' and status="Authorize"')->row()->cnt;	
			$totAuth=$this->db->query('SELECT sum(grossPrice) as sum, count(*) as cnt from '.$this->table.' where '.$where_clause1.' and status="Authorize" group by gatewayID')->row();	
			//if($totAuth->cnt > 0 ){ 
			$MaxCapSales=$this->db->query('SELECT count(*) as cnt from '.$this->table.' where '.$where_clause1.' and grossPrice > '.$SYSTEMMAXSALESALLOWED.' and status="Capture"')->row()->cnt;	
			$totCapture=$this->db->query('SELECT sum(grossPrice) as sum, count(*) as cnt from '.$this->table.' where '.$where_clause1.' and status="Capture" group by gatewayID')->row();			
			?>
			<span style="background-color:<?php echo $backClr;?>;white-space:nowrap;">
			<span style="color:#339933;">
			<?php  echo $row->gatewayID.': '; ?>
			</span>
			
			<span style="color:#339933;">
				<?php 
					/*echo '('.$row->daily_volume.'),';
					$sumTotCnt+=$totAuth->cnt; 	
					$totalAuth+=$totAuth->sum;			
					if($totAuth->cnt > 0 )echo '($'.number_format($totAuth->sum,2).'),';*/
					echo 'Volume: ( $'.number_format($row->daily_volume,2).', '.$row->dailyHighTicketCapture.') ';
					$sumTotCnt+=$totAuth->cnt; 	
					$totalAuth+=$totAuth->sum;			
					if($totAuth->cnt > 0 )echo 'Auth: ($'.number_format($totAuth->sum,2).', '.$MaxSales.') ';
					if($gatewayName!=""){
					echo 'Selected: (<span id="totalSumClass">'.$selectedResult.'</span>) ';
					if($totCapture->cnt > 0 )echo 'Capture: ($'.number_format($totCapture->sum,2).', '.$MaxCapSales.') ';
					}					
				?>
			</span>		
			<!--span style="color:#339933;">
			 <?php echo '('.$MaxSales.')';?> 
			</span-->
			&nbsp;&nbsp;
			<!--br/-->
			
			<?php 
				$numCnt +=1;
			//}
			?> 
			</span>
			
			<?php } ?>
			<!--span style="color:#339933;">
			 <?php if($totalAuth > 0 )echo 'Total:$'.$totalAuth.'('.$sumTotCnt.')';?> 
			</span-->
			</h5>
			<!------------------------------------------------------------>
			<?php if($query->num_rows() > 0 || $query1->num_rows() > 0 ){?>
            <div class="table-responsive">
            
            <table class="table">
              <thead>
                <tr>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='gatewayID')?'bold':'normal'?>;" href="javascript: hdnSort('gatewayID','<?php echo $order_by; ?>');">Gateway</a></th>
					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='companyID')?'bold':'normal'?>;" href="javascript: hdnSort('companyID','<?php echo $order_by; ?>');">Center</a></th>
                    <th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='rec_crt_date')?'bold':'normal'?>;" href="javascript: hdnSort('rec_crt_date','<?php echo $order_by; ?>');">Created</a></th>
					

					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='customer_name')?'bold':'normal'?>;" href="javascript: hdnSort('customer_name','<?php echo $order_by; ?>');">Name</a></th>
					

					<th><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='grossPrice')?'bold':'normal'?>;" href="javascript: hdnSort('grossPrice','<?php echo $order_by; ?>');">Amount</a></th>
					
					<th ><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='validated')?'bold':'normal'?>;" href="javascript: hdnSort('validated','<?php echo $order_by; ?>');">Validation</a></th>

					<th ><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='status')?'bold':'normal'?>;" href="javascript: hdnSort('status','<?php echo $order_by; ?>');">Status</a></th>
					
					
					
					<th colspan="2"><a style="text-decoration:none;font-size:12px;font-weight:<?=($order_by_fld=='')?'bold':'normal'?>;" href="javascript: hdnSort('','<?php echo $order_by; ?>');">Show</a></th>
					
                </tr>
              </thead>
              <tbody>
                
				<?php 
				$noofHighTicketSales = 0;
				$totalSaleAmount = 0;
				foreach ($query->result() as $row){
					if($row->grossPrice >= $SYSTEMMAXSALESALLOWED ){
						$noofHighTicketSales += 1;
					}
					$totalSaleAmount += $row->grossPrice;
					$row_center = $this->common_model->Retrive_Record_By_Where_Clause('t_centerdb',"companyID like '%".$row->companyID."%'");
									  
				?> 
                <tr id="recordRow<?php echo $row->id; ?>" <?php if($row->status=="Refund" || $row->status=="Void" || $row->status=="Chargeback" || $row->status=="Failed"){?> class="redClass" <?php } ?> <?php if($row->status=="Failed" && $row->reason_descrption!=""){?> 
				title="<?php echo "Failure Reason : ".$row->reason_descrption;?>" <?php } ?>
				<?php /*if($gatewayName!="" && ($noofHighTicketSales > $dailyHighTicketCapture || $totalSaleAmount > $daily_volume  )){ ?> style="display:none;"
				<?php }*/ ?> >
					
					<td><?php echo $row->gatewayID; ?></td>
					<td><?php echo $row->companyID; ?></td>
					<td><?php echo date('m-d-Y',strtotime($row->rec_crt_date));?></td>
					<!--td><?php echo date('m-d-Y',strtotime($row->rec_up_date));?></td-->

					<td><?php echo $row->fname.' '.$row->lname; ?></td>
					<!--td><?php echo $row->customer_phone; ?></td-->
					<?php $productName = explode("-", $row->product_name);?>
					
					<td><?php if($row->grossPrice < 0) echo '$'. number_format(abs($row->grossPrice), 2); else echo '$'. number_format($row->grossPrice, 2); ?></td>
					<!--td><?php echo $row->cardType; ?></td-->
					
               <td><?php echo $row->validated; ?></td>

				 <td>
					<select id="status<?php echo $row->id; ?>" name="status" onchange='change_trans_status("<?php echo $row->id; ?>",this.value, "<?php echo preg_replace(" /[^A-Za-z0-9\-]/", " ", $row->fname); ?>");' <?php if($row->status!="Sale" && $row->status!="Capture" && $row->status!="Settlement" && $row->status!="Authorize" && $row->status!="" ){?> disabled <?php }if($row->lock=='Y'){?> disabled <?php } ?>>
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
						<button type="button" class="btn btn-success btn-xs" onclick='change_trans_status2("<?php echo $row->id; ?>","Chargeback", "<?php echo preg_replace(" /[^A-Za-z0-9\-]/", " ", $row->fname); ?>");'>Change</button>
						<button type="button" class="btn btn-danger btn-xs" onclick="location.reload();">Cancel</button>
					</span>
					
					<?php if($row->gatewayTransactionId!=""){?>
					<span id="refundAmount<?php echo $row->id; ?>" style="display:none;">
					<?php
					$totPartialRedund=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where originalGatewayTransactionId="'.$row->gatewayTransactionId.'"')->row()->sum;
					?>
						<input id="amount<?php echo $row->id; ?>" type="number" value="<?php echo $row->grossPrice+$totPartialRedund;?>" min="1"  max="<?php echo $row->grossPrice+$totPartialRedund;?>"/>
						<button type="button" class="btn btn-success btn-xs" onclick='change_trans_status3("<?php echo $row->id; ?>","Refund", "<?php echo preg_replace(" /[^A-Za-z0-9\-]/", " ", $row->fname); ?>");'>Change</button>
						<button type="button" class="btn btn-danger btn-xs" onclick="location.reload();">Cancel</button>
					</span>
					<?php } ?>
					
					</td>
					
					<td colspan="2">
                  <div class="btn-group">
					<?php
					if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ 
					if($gatewayName!=""){
					?>
						
						
						<!--a href="<?php echo site_url($this->controllerFile.'pop/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-search"> </span></a-->
						<input type="checkbox" name="allowedCapture" value="<?php echo $row->id; ?>" checked onchange="showhideResult('<?php echo $row->id; ?>','<?php echo $row->grossPrice;?>','high')" />
						
						
						
					<?php } }?>
                   </div>
                  </td>
                </tr>
				
			<?php  
			
			}
			
			foreach ($query1->result() as $row){
				//print_r($query1);
					if($row->grossPrice >= $SYSTEMMAXSALESALLOWED ){
						$noofHighTicketSales += 1;
					}
					$totalSaleAmount += $row->grossPrice;
					$row_center = $this->common_model->Retrive_Record_By_Where_Clause('t_centerdb',"companyID like '%".$row->companyID."%'");
									  
				?> 
                <tr id="recordRow<?php echo $row->id; ?>" <?php if($row->status=="Refund" || $row->status=="Void" || $row->status=="Chargeback" || $row->status=="Failed"){?> class="redClass" <?php } ?> <?php if($row->status=="Failed" && $row->reason_descrption!=""){?> 
				title="<?php echo "Failure Reason : ".$row->reason_descrption;?>" <?php } ?>
				<?php /*if($gatewayName!="" && ($noofHighTicketSales > $dailyHighTicketCapture || $totalSaleAmount > $daily_volume  )){ ?> style="display:none;"
				<?php }*/ ?> >
					
					<td><?php echo $row->gatewayID; ?></td>
					<td><?php echo $row->companyID; ?></td>
					<td><?php echo date('m-d-Y',strtotime($row->rec_crt_date));?></td>
					<!--td><?php echo date('m-d-Y',strtotime($row->rec_up_date));?></td-->

					<td><?php echo $row->fname.' '.$row->lname; ?></td>
					<!--td><?php echo $row->customer_phone; ?></td-->
					<?php $productName = explode("-", $row->product_name);?>
					
					<td><?php if($row->grossPrice < 0) echo '$'. number_format(abs($row->grossPrice), 2); else echo '$'. number_format($row->grossPrice, 2); ?></td>
					<!--td><?php echo $row->cardType; ?></td-->
					
               <td><?php echo $row->validated; ?></td>

				 <td>
					<select id="status<?php echo $row->id; ?>" name="status" onchange='change_trans_status("<?php echo $row->id; ?>",this.value, "<?php echo preg_replace(" /[^A-Za-z0-9\-]/", " ", $row->fname); ?>");' <?php if($row->status!="Sale" && $row->status!="Capture" && $row->status!="Settlement" && $row->status!="Authorize" && $row->status!="" ){?> disabled <?php }if($row->lock=='Y'){?> disabled <?php } ?>>
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
						<button type="button" class="btn btn-success btn-xs" onclick='change_trans_status2("<?php echo $row->id; ?>","Chargeback", "<?php echo preg_replace(" /[^A-Za-z0-9\-]/", " ", $row->fname); ?>");'>Change</button>
						<button type="button" class="btn btn-danger btn-xs" onclick="location.reload();">Cancel</button>
					</span>
					
					<?php if($row->gatewayTransactionId!=""){?>
					<span id="refundAmount<?php echo $row->id; ?>" style="display:none;">
					<?php
					$totPartialRedund=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where originalGatewayTransactionId="'.$row->gatewayTransactionId.'"')->row()->sum;
					?>
						<input id="amount<?php echo $row->id; ?>" type="number" value="<?php echo $row->grossPrice+$totPartialRedund;?>" min="1"  max="<?php echo $row->grossPrice+$totPartialRedund;?>"/>
						<button type="button" class="btn btn-success btn-xs" onclick='change_trans_status3("<?php echo $row->id; ?>","Refund", "<?php echo preg_replace(" /[^A-Za-z0-9\-]/", " ", $row->fname); ?>");'>Change</button>
						<button type="button" class="btn btn-danger btn-xs" onclick="location.reload();">Cancel</button>
					</span>
					<?php } ?>
					
					</td>
					
					<td colspan="2">
                  <div class="btn-group">
					<?php
					if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ 
					if($gatewayName!=""){
					?>
						
						
						<!--a href="<?php echo site_url($this->controllerFile.'pop/'.$row->id);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-search"> </span></a-->
						<input type="checkbox" name="allowedCapture" value="<?php echo $row->id; ?>" checked onchange="showhideResult('<?php echo $row->id; ?>','<?php echo $row->grossPrice;?>','low')" />
						
						
					<?php } } ?>
                   </div>
                  </td>
                </tr>
				
			<?php  
			
			}	

			
			
			
		
			?>  
                
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
	function change_order_fld1(order_fld,order_by){
		$.post('<?php echo base_url().$this->controllerFile; ?>change_order_fld', '&order_fld='+order_fld+'&order_by='+order_by, function(data){});
	}
	function captureAll(){
		var selected = new Array();
		$("input:checkbox[name=allowedCapture]:checked").each(function(){
			selected.push($(this).val());
		});
		//alert(selected);
		var r=confirm("Are you sure to change the state of transaction for selected Record?"); 
		if (r == true) {
			$.post('<?php echo base_url().$this->controllerFile; ?>/change_trans_type', 'selected='+selected+'&val=Capture', function(data){
				if(data) 
				{
					$("#msgDiv").show("");
					$('#msgDiv').html(data);
					$('#msgDiv').delay(5000).fadeOut('slow', function() {});
					location.reload();					
				}
			});
		}		
	}
	function showhideResult(id,recordGrossPrice,selectedTickets){
		var selectedHighTickets=jQuery("#selectedHighTickets").val();
		var existingNoRecords=jQuery("#totalNoRows").val();
		var newNoRecord=existingNoRecords-1;
		var existingTotalSum=jQuery("#totalSumGenerated").val();
		var newTotalSum=existingTotalSum-recordGrossPrice;
		jQuery("#totalNoRows").val(newNoRecord);
		jQuery("#totalSumGenerated").val(newTotalSum);
		if(selectedTickets=='high'){
			selectedHighTickets = selectedHighTickets-1;
			jQuery("#selectedHighTickets").val(selectedHighTickets);
		}
		jQuery("#totalSumClass").html("$"+newTotalSum.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+", "+selectedHighTickets);
		jQuery("#recordRow"+id).hide('slow');
	}	
	/*function captureAll(){
		var selected = new Array();
		$("input:checkbox[name=allowedCapture]:checked").each(function(){
			selected.push($(this).val());
		});
		//alert(selected);
		var r=confirm("Are you sure to change the state of transaction for selected Record?"); 
		if (r == true) {
			$.post('<?php echo base_url().$this->controllerFile; ?>/change_trans_type', 'selected='+selected+'&val=Capture', function(data){
				if(data) 
				{
					$("#msgDiv").show("");
					$('#msgDiv').html(data);
					$('#msgDiv').delay(5000).fadeOut('slow', function() {});
					location.reload();					
				}
			});
		}		
	}*/
	/*function showhideResult(id,recordGrossPrice){
		//alert(RecordGrossPrice);
		var existingNoRecords=jQuery("#totalNoRows").val();
		var newNoRecord=existingNoRecords-1;
		var existingTotalSum=jQuery("#totalSumGenerated").val();
		var newTotalSum=existingTotalSum-recordGrossPrice;
		jQuery("#totalNoRows").val(newNoRecord);
		jQuery("#totalSumGenerated").val(newTotalSum);
		//jQuery("#totalSumClass").html(newNoRecord+" Amount: $"+newTotalSum);
		jQuery("#totalSumClass").html(newNoRecord+" Amount: $"+newTotalSum.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
		jQuery("#recordRow"+id).hide('slow');
	}*/
	function change_order_by(value){
		//alert(value);
		$.post('<?php echo base_url().$this->controllerFile; ?>change_order_by', '&value='+value, function(data){
			if(data) 
			{
				$("#msgDiv").show("");
				$('#msgDiv').html(data);
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
				location.reload();					
			}
		});
	}	
	function change_order_fld(order_fld,order_by){
		//alert(value);
		$.post('<?php echo base_url().$this->controllerFile; ?>change_order_fld', '&order_fld='+order_fld+'&order_by='+order_by, function(data){
			if(data) 
			{
				$("#msgDiv").show("");
				$('#msgDiv').html(data);
				$('#msgDiv').delay(5000).fadeOut('slow', function() {});
				location.reload();					
			}
		});
	}	

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
		
		
		
		
		
		
		
		
		
		