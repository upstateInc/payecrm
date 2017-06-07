<?php $this->load->view('header');?>
<?php $this->load->view('left');?>
<div class="mainpanel">
	<?php 
		//echo $_SERVER['HTTP_REFERER']; 
		$lastURL = substr(strrchr($_SERVER['HTTP_REFERER'], "/"), 1);
	?>                   
	<div class="contentpanel contentpanel-mediamanager"> 
            
	<div class="clearfix">
	<?php if($lastURL=='saved_invoice'){ ?>
		<div class="pull-right"><a href="<?php echo base_url().$lastURL; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	<?php } else { ?>
		<div class="pull-right"><a href="<?php echo base_url().$this->controllerFile; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> Back </a></div>
	<?php } ?>	
	</div><br/>  
	<!---------------------Form Section Starts-------------------------->
<table id="tbl_content_area" width="100%" border="0" cellspacing="0" cellpadding="5">
	<tr><td height="1px"></td></tr>
	<tr>
      <!--td align="center" valign="middle" bgcolor="#FFFFFF" style="border:1px dotted #999999;" height="100%"--->
	  <!--Dotted Line Removed-->
      <td align="center" valign="middle" bgcolor="#FFFFFF" >
	  	 <table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
		  <tr>
            <td style="width:100%;" valign="top" align="left">
                <div class="sub_heading">
                    <table width="100%">
                        <tr>
                          <td align="left" style="padding-top:10px;">
                          
                          
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                          <tr>
                            <td><img src="<?php echo base_url();?>images/invoice_logo.jpg" alt="" /> <?php //echo COMPANYNAME;?></td>
                                                      </tr>
                          <tr>
									<td>&nbsp;</td>
								</tr>
						  <tr>
                            <td><strong>Company Name:</strong> <?php echo $row['INVOICECOMPANYID'];?></td>
                          </tr>
                          <tr>
                            <td><strong>Processing Period:</strong>  <?php echo $row['STARTDATE'];?> to <?php echo $row['ENDDATE'];?></td>
                          </tr>
                          <tr>
                            <td><strong>Days in Arrears:</strong> <?php echo $row['NOOFDAYS'];?></td>
                          </tr>
                          <tr>
                            <td><strong>According to the Service Agreement:</strong></td>
                          </tr>
                        </table>
                        <table>
								<tr>
									<td>&nbsp;</td>
								</tr>								
								<tr>
									<td>&nbsp;</td>
								</tr>								

                        </table>                          
                          
                            
                              
                              
     <table width="100%" style="border: 0px solid rgb(153, 153, 153);" cellpadding="1" cellspacing="0" >
      <tr>
          <td width="30%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style="" ><strong>Invoice</strong></td>
          <td width="10%" align="right" class="td_tab_main" bgcolor="#eeeeee" style=""><strong></strong></td>
          <td width="20%" align="right"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Rate</strong></td>
          <td width="20%" align="right"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Quantity</strong></td>
          <td width="20%" align="right"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Total</strong></td>
      </tr>
      <tr>
        <td>Gross Settled Volume</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">$ <?php echo $row['TOTALSALE'];?></td>
      </tr>	
      <tr <?php if($row['INVOICETYPE']=="Gross"){ ?> style="display:none;" <?php } ?> >
        <td >Refunds</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">$ <?php echo $row['NETREFUND'];?></td>
      </tr>
      <tr <?php if($row['INVOICETYPE']=="Net"){ ?> style="display:none;" <?php } ?> >
        <td >Processing Fee</td>
        <td align="right">&nbsp;</td>
        <td align="right"><?php echo $row['COMMISSIONFEE'];?>%</td>
        <td align="right">$ <?php echo $row['TOTALGOODSALE'];?></td>
        <td align="right">$ <?php echo $row['PROCESSINGFEE'];?></td>
      </tr> 
	  <tr <?php if($row['INVOICETYPE']=="Net"){ ?> style="display:none;" <?php } ?> >
        <td >Rolling Reserve</td>
        <td align="right">&nbsp;</td>
        <td align="right"><?php echo $row['RESERVEPERCENTAGE'];?>%</td>
        <td align="right">$ <?php echo $row['TOTALGOODSALE'];?></td>
        <td align="right">$ <?php echo number_format($row['TOTALRESERVE'],2);?></td>
      </tr>	  
	  <tr>
        <td colspan="4" bgcolor="#eeeeee" >Net Settled Volume</td>
        <td align="right" bgcolor="#eeeeee" >$ <?php echo $row['TOTALGOODSALE'];?></td>
      </tr>	  
      <tr <?php if($row['INVOICETYPE']=="Gross"){ ?> style="display:none;" <?php } ?> >
        <td >Processing Fee</td>
        <td align="right">&nbsp;</td>
        <td align="right"><?php echo $row['COMMISSIONFEE'];?>%</td>
        <td align="right">$ <?php echo $row['TOTALGOODSALE'];?></td>
        <td align="right">$ <?php echo $row['PROCESSINGFEE'];?></td>
      </tr>
	  <tr <?php if($row['INVOICETYPE']=="Gross"){ ?> style="display:none;" <?php } ?> >
        <td >Rolling Reserve</td>
        <td align="right">&nbsp;</td>
        <td align="right"><?php echo $row['RESERVEPERCENTAGE'];?>%</td>
        <td align="right">$ <?php echo $row['TOTALGOODSALE'];?></td>
        <td align="right">$ <?php echo number_format($row['TOTALRESERVE'],2);?></td>
      </tr>	  
      <tr <?php if($row['INVOICETYPE']=="Net"){ ?> style="display:none;" <?php } ?> >
        <td  >Refunds</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">$ <?php echo $row['NETREFUND'];?></td>
      </tr>
      <tr>
        <td>Refund Fee</td>
        <td align="right">&nbsp;</td>
        <td align="right">$ <?php echo $row['REFUNDEACH'];?></td>
        <td align="right"><?php echo $row['NOREFUND'];?></td>
        <td align="right">$ <?php echo $row['TOTALREFUND'];?></td>
      </tr>
      <tr>
        <td >Chargeback Fee</td>
        <td align="right">&nbsp;</td>
        <td align="right">$ <?php echo $row['CHARGEBACHEACH'];?></td>
        <td align="right"><?php echo $row['NOCHARGEBACK'];?></td>
        <td align="right">$ <?php echo $row['TOTALCHARGEBACK'];?></td>
      </tr>
	  <?php if($row['ACHFEE']>0){?> 
      <tr>
        <td >ACH Fee</td>
        <td align="right">&nbsp;</td>
        <td align="right">$ <?php echo $row['ACHFEE'];?></td>
        <td align="right">1</td>
        <td align="right">$ <?php echo $row['ACHFEE'];?></td>
      </tr>
	  <?php } ?>
	  <?php if($row['WIREFEE']>0){?>
      <tr>
        <td >Wire Fee</td>
        <td align="right">&nbsp;</td>
        <td align="right">$ <?php echo strtok($row['WIREFEE'],'.');?></td>
        <td align="right">1</td>
        <td align="right">$ <?php echo $row['WIREFEE'];?></td>
      </tr>
	  <?php } ?>
	  <tr>
		<td colspan="5" style="border:1px solid #000;" ></td>
	  </tr>	  
      <tr>
        <td  bgcolor="#eeeeee"><strong>Invoice Amount</strong></td>
        <td bgcolor="#eeeeee" >&nbsp;</td>
        <td bgcolor="#eeeeee" >&nbsp;</td>
        <td bgcolor="#eeeeee" >&nbsp;</td>
        <td align="right" bgcolor="#eeeeee"><strong>$ <?php echo $row['NETDEDUCTION'];?></strong></td>
      </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>	  
      </table>
      <table width="100%" style="border: 0px solid rgb(153, 153, 153);" cellpadding="1" cellspacing="0" >
      <tr>
        <td bgcolor="#eeeeee" colspan="4" style="border-bottom:1px solid #000;"><strong>Payment</strong></td>

        <td bgcolor="#eeeeee" align="right" style="border-bottom:1px solid #000;"><strong>Total</strong></td>
      </tr>
      <!--tr>
        <td >Carried Over Last Statement</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">$ -</td>
      </tr-->
      <tr>
        <td >Net Settled Volume</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">$ <?php echo $row['TOTALGOODSALE'];?></td>
      </tr>
      <tr>
        <td >Chargebacks</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">$ <?php echo $row['NETCHARGEBACK'];?></td>
      </tr>
      <tr>
        <td >Invoice Amount</td>
        <td colspan="3">&nbsp;</td>
        <td style="text-align:right;">$ -<?php echo $row['NETDEDUCTION'];?></td>
	  </tr>
	  <tr>
        <td bgcolor="#eeeeee" >Rolling Reserve Payment</td>
        <td bgcolor="#eeeeee" align="right">&nbsp;</td>
        <td bgcolor="#eeeeee" align="right">&nbsp;</td>
        <td bgcolor="#eeeeee" align="right">&nbsp;</td>
        <td bgcolor="#eeeeee" align="right"> - </td>
      </tr>		  
      <tr>
        <td bgcolor="#eeeeee">Additional Items</td>
        <td bgcolor="#eeeeee" align="right">&nbsp;</td>
        <td bgcolor="#eeeeee" align="right">&nbsp;</td>
        <td bgcolor="#eeeeee" align="right">&nbsp;</td>
        <td bgcolor="#eeeeee" align="right">&nbsp;</td>
      </tr>
      </table>
     
      <table width="100%" style="border:0px solid rgb(153, 153, 153);" cellpadding="1" cellspacing="0" > 
      <!--tr>
        <td width="30%" style="border-top:1px solid #000;text-align:left;">Sum Net</td>
        <td width="10%" align="right" style="border-top:1px solid #000;text-align:right;">&nbsp;</td>
        <td width="20%" align="right" style="border-top:1px solid #000;text-align:right;">&nbsp;</td>
        <td width="10%" align="right" style="border-top:1px solid #000;text-align:right;">&nbsp;</td>
        <td width="20%" align="right" style="border-top:1px solid #000; text-align:right;">$ <?php echo $row['TOTALGROSSSALE'];?></td>
      </tr-->

		<?php 
		$totalGross = str_replace(",","",$row['TOTALGROSSSALE']);
		$totalNetRed = str_replace(",","",$row['NETDEDUCTION']);
		//$totalGross = floatval($row['TOTALGROSSSALE']); $totalNetRed = floatval($row['NETDEDUCTION']); echo $totalGross-$totalNetRed;
		$NetNotSettled=$totalGross-$totalNetRed;
		//echo ;
		?>
		
      
	  <?php  
	  if($row['status']=='N'){
		if($this->session->userdata('ADMIN_COMPANYID')==""){  
		  ?>
		<tr>
		<input type="hidden" id="tempInvoiceGenerationId" name="tempInvoiceGenerationId" value="<?php echo $tempInvoiceGenerationId;?>" />
		<td width="30%">Credit : <input type="checkbox" id="credit" name="credit" value="Y" checked /> Name <input type="text" id="expensename" name="expensename" /> </td>
		<td width="30%">Price Each : $ <input type="number" id="price_each" name="price_each" step="0.01" min=0/></td>
		<td width="10%">Quantity <input type="number" id="quantity" name="quantity" min=0 style="width:50px;" /> </td>
		<td width="10%"><input type="button" class="btn btn-primary btn-xs" name="Add" value="Add" onclick="addNew();" /></td>
		<td width ="20%"></td>
		</tr>
	  <?php } } ?>
      <tr>
        <td >&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right"></td>
      </tr>		
		<?php if($query->num_rows() > 0){
			$i=0;
			$moreTotalDeduction = 0;
			?>
			<tr style="background:#7e99ac;color:#fff">
				<th width="20%">Additional Item</th>
				<th width="30%">Rate</th>
				<th width="10%">Quantity</th>
				<th width="10%">Total</th>
				<th align="right" width="20%">Action</th>				
			</tr>
			
			<?php
			foreach ($query->result() as $row1){
				$i+=1;
				if($i%2==0){
					$color = '#eaeef1';
				}else{
					$color = '#d5d9dc';
				}
				if($row1->credit=='Y'){
					$moreTotalDeduction=$moreTotalDeduction+$row1->total;
				}
				else if($row1->credit=='N'){
					$moreTotalDeduction=$moreTotalDeduction-$row1->total;
				}
				?>
				<tr style="background:<?php echo $color;?>">
					<td width="20%" ><?php echo $row1->name;if($row1->credit=='Y'){ echo '(Cr.)'; }else{ echo '(Dr.)';} ?></td>
					<td width="30%"> $ <input type="text" id="price_each<?php echo $row1->id; ?>" value="<?php echo $row1->price_each; ?>"/></td>
					<td width="10%" > <input type="text" id="quantity<?php echo $row1->id; ?>" value="<?php echo $row1->quantity; ?>"/></td>
					<td width="10%" ><?php echo '$ '.$row1->total; ?></td>
					<td width="20%" >
					<?php if($row['status']=='N'){
						if($this->session->userdata('ADMIN_COMPANYID')==""){
						?>
						<a href="javascript:void(0);" onclick="edit(<?php echo $row1->id;?>);" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></a>
						<a href="javascript:void(0);" onclick="deleteRec(<?php echo $row1->id;?>);" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-remove"></span></a>
					<?php } } ?>
					</td>
				</tr>
		<?php } } 
		
		?>
	<input type="hidden" id="total_payout" name="total_payout" value="<?php echo number_format($NetNotSettled - $moreTotalDeduction,2);?>"/>
      <!--tr>
	  
        <td >Settlement Amount</td>
        <td colspan="3">&nbsp;</td>
        <td align="right">$ <?php echo number_format($NetNotSettled - $moreTotalDeduction,2);?></td>
      </tr>
      <tr>
        <td >% Approved for Payout</td>
        <td colspan="3">&nbsp;</td>
        <td style="text-align:right;">100%</td>
      </tr-->
      <tr>
        <td colspan="4" bgcolor="#eeeeee" style="border-top:1px solid #000; border-bottom:1px double #000; height:30px;"><strong>Final Amount Due</strong></td>
        <td  bgcolor="#eeeeee" align="right" style="border-top:1px solid #000; border-bottom:1px double #000;"><strong>$ <?php echo number_format($NetNotSettled - $moreTotalDeduction,2);?></strong></td>
      </tr>
	  <tr><td colspan="5" height="10px;"></td></tr>
	  	<tr>
		<?php if($row['status']=='N'){
			if($this->session->userdata('ADMIN_COMPANYID')==""){
			?>
		<td >
		<input type="button" class="btn btn-primary btn-xs" onclick="addDetailInvoice();" name="save" value="Save Invoice"/> 
		
		</td>
		<?php } } ?>
		<td>
			<a href="<?php echo base_url().$this->controllerFile.'mypdf/'.$tempInvoiceGenerationId; ?>" class="btn btn-primary btn-xs">Download Invoice</a>
		</td>
		<!--td width="10%" id="Invoice_button"> 
			  
		</td-->
		<?php 
		
		$InvoiceCC = $this->db->query("select invoiceEmails from t_centerdb where companyID like '%".$row['INVOICECOMPANYID']."%' ")->row()->invoiceEmails;
		//echo $this->db->last_query();
		?>
		<!--td  id="showEmail" colspan="3">
			<input type="text" class="form-control" name="emailList" id="emailList" value="<?php echo $InvoiceCC;?>" />
			
			
		</td-->
		<td>
			<!--a href="javascript:void(0);" onclick="sendMail();" class="btn btn-primary btn-xs" >Send</a-->
			<a href="javascript:void(0);" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#send_invoice" >Email Invoice</a>
		</td>
		<td></td>
		<td>
		<a href="<?php echo site_url('invoice/volumeReport?companyID='.$row['INVOICECOMPANYID'].'&startdate='.$row['STARTDATE'].'&enddate='.$row['ENDDATE']);?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-download"></span> Volume Report</a>
		</td>
	</tr>
    </table>
    
                              
                              
                       </td>
                    </tr>
                </table>
                </div>
            </td>
		  </tr>
		 </table>
	  </td>
    </tr>
	<tr><td height="10px;"></td></tr>
	
	<!--------------------------------------Volume Report------------------------------------------->
	<?php			
		$companyID=$row['INVOICECOMPANYID'];
		$start_date=$row['STARTDATE'];
		$end_date=$row['ENDDATE'];
		
		$where_clause = "(status like '%Settlement%') AND ";
		$where_clause1 = "(status like '%Refund%') AND ";
		$where_clause2 = "(status like '%Chargeback%') AND ";
		if($companyID != '')
		{
			$where_clause .= "companyID LIKE '%$companyID%' AND ";
			$where_clause1 .= "companyID LIKE '%$companyID%' AND ";
			$where_clause2 .= "companyID LIKE '%$companyID%' AND ";
		}		
		if($start_date != '' && $end_date != '')
		{
			$parts = explode('/',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$yyyy_mm_dd1 = $parts[2] . '/' . $parts[0] . '/' . $parts[1];
			$where_clause .= "`rec_up_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$where_clause1 .= "`rec_up_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$where_clause2 .= "`rec_up_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
		}
		if($end_date != '')
		{
			$parts = explode('/',$end_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];			
			$yyyy_mm_dd1 = $parts[2] . '/' . $parts[0] . '/' . $parts[1];			
			$where_clause .= "`rec_up_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND ";
			$where_clause1 .= "`rec_up_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND ";
			$where_clause2 .= "`rec_up_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND ";
		}
		$where_clause  = substr($where_clause, 0, -4);	
		$where_clause1  = substr($where_clause1, 0, -4);	
		$where_clause2  = substr($where_clause2, 0, -4);	

		if($where_clause!='')
		$query = $this->db->query("select rec_up_date,rec_crt_date,fname,lname,agentName,grossPrice from ".$this->table." where ".$where_clause." order by rec_up_date,rec_up_date,fname,lname");
		
		$query1 = $this->db->query("select rec_up_date,rec_crt_date,fname,lname,agentName,grossPrice from ".$this->table." where ".$where_clause1." order by rec_up_date,rec_up_date,fname,lname");
		
		$query2 = $this->db->query("select rec_up_date,rec_crt_date,fname,lname,agentName,grossPrice from ".$this->table." where ".$where_clause2." order by rec_up_date,rec_up_date,fname,lname");
		
		$totRef=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause1)->row()->sum;
		
		$totChrgBak=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause2)->row()->sum;
		
		$totSettle=$this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause)->row()->sum;
	?>
	<table width="100%" style="border: 0px solid rgb(153, 153, 153);" cellpadding="1" cellspacing="0" >
	<tr>
		<td colspan="5" align="center" bgcolor="#eeeeee" ><strong>Volume Report</strong></td>
	</tr>
	<tr><td colspan="5" height="5px;"></td></tr>
	<tr><td colspan="5" align="center" bgcolor="#eeeeee" ><strong>Company : <?php echo $companyID;?></strong></td></tr>
	<tr><td colspan="5" height="5px;" ></td></tr>
	<tr><td colspan="5" align="center" bgcolor="#eeeeee" ><strong>Processing Period : <?php echo $start_date.' to '.$end_date;?></strong></td></tr>
	<tr><td colspan="5" height="5px;" ></td></tr>
	
	<?php if ($query->num_rows() > 0){ ?>
		<tr><td colspan="5" align="center" bgcolor="#eeeeee"><strong>Settled Transactions</strong></td></tr>
		<tr><td colspan="5" height="5px;" ></td></tr>		
      <tr>
          <td width="20%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style="" ><strong>Settled Date</strong></td>
          <td width="20%" align="left" class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Creation Date</strong></td>
          <td width="25%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Customer Name</strong></td>
          <td width="25%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Agent Name</strong></td>
          <td width="10%" align="right"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Amount</strong></td>
      </tr>
	  <?php foreach ($query->result() as $row){ ?>
      <tr>
        <td align="left"><?php echo date("m-d-Y", strtotime($row->rec_up_date)); ?></td>
        <td align="left"><?php echo date("m-d-Y", strtotime($row->rec_crt_date)); ?></td>
        <td align="left"><?php echo $row->fname,lname; ?></td>
        <td align="left"><?php echo $row->agentName; ?></td>
        <td align="right"><?php echo '$ '.number_format($row->grossPrice,2); ?></td>
      </tr>			
	<?php } ?>
		<tr>
			<td colspan="4" align="left" bgcolor="#eeeeee"><strong>Total</strong></td>
			<td align="right" bgcolor="#eeeeee"><strong><?php echo '$ '.number_format($totSettle,2);?></strong></td>
		</tr>
		<tr><td colspan="5" height="5px;" ></td></tr>	
	<?php } ?>
		<?php if ($query1->num_rows() > 0){ ?>
		<tr><td colspan="5" align="center" bgcolor="#eeeeee"><strong>Refunded Transactions</strong></td></tr>
		<tr><td colspan="5" height="5px;" ></td></tr>
      <tr>
          <td width="20%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style="" ><strong>Refund Date</strong></td>
          <td width="20%" align="left" class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Creation Date</strong></td>
          <td width="25%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Customer Name</strong></td>
          <td width="25%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Agent Name</strong></td>
          <td width="10%" align="right"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Amount</strong></td>
      </tr>
	  <?php foreach ($query1->result() as $row){ ?>
      <tr>
        <td align="left"><?php echo date("m-d-Y", strtotime($row->rec_up_date)); ?></td>
        <td align="left"><?php echo date("m-d-Y", strtotime($row->rec_crt_date)); ?></td>
        <td align="left"><?php echo $row->fname,lname; ?></td>
        <td align="left"><?php echo $row->agentName; ?></td>
        <td align="right"><?php echo '$ '.number_format($row->grossPrice,2); ?></td>
      </tr>	
	<?php } ?>
	  	<tr>
			<td colspan="4" align="left" bgcolor="#eeeeee"><strong>Total</strong></td>
			<td align="right" bgcolor="#eeeeee"><strong><?php echo '$ '.number_format($totRef,2);?></strong></td>
		</tr>
		<tr><td colspan="5" height="5px;" ></td></tr>	
	<?php } ?>	
	<?php if ($query2->num_rows() > 0){ ?>
		<tr><td colspan="5" align="center" bgcolor="#eeeeee"><strong>Chargeback Transactions</strong></td></tr>
		<tr><td colspan="5" height="5px;" ></td></tr>
      <tr>
          <td width="20%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style="" ><strong>Chargeback Date</strong></td>
          <td width="20%" align="left" class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Creation Date</strong></td>
          <td width="25%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Customer Name</strong></td>
          <td width="25%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Agent Name</strong></td>
          <td width="10%" align="right"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Amount</strong></td>
      </tr>
	  <?php foreach ($query2->result() as $row){ ?>
      <tr>
        <td align="left"><?php echo date("m-d-Y", strtotime($row->rec_up_date)); ?></td>
        <td align="left"><?php echo date("m-d-Y", strtotime($row->rec_crt_date)); ?></td>
        <td align="left"><?php echo $row->fname,lname; ?></td>
        <td align="left"><?php echo $row->agentName; ?></td>
        <td align="right"><?php echo '$ '.number_format($row->grossPrice,2); ?></td>
      </tr>
	<?php } ?>
		<tr>
			<td colspan="4" align="left" bgcolor="#eeeeee"><strong>Total</strong></td>
			<td align="right" bgcolor="#eeeeee"><strong><?php echo '$ '.number_format($totChrgBak,2);?></strong></td>
		</tr>
		<tr><td colspan="5" height="5px;" ></td></tr>	
	<?php } ?>
	<!--------------------Rolling Reserve---------------------->
	<?php 	
			$totalRollingReserveValue = 0;
			$getRollingReserve=$this->db->query("select * from t_reserve_fees_weekly where status='Y' and companyID='".$companyID."'");
			if($getRollingReserve->num_rows()>0){ ?>
				<tr><td colspan="3" align="center" bgcolor="#eeeeee"><strong>Rolling Reverse Transactions</strong></td></tr>
				<tr><td colspan="3" height="5px;" ></td></tr>
				<tr>
					<td width="20%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style="" ><strong>Start Date</strong></td>
					<td width="20%" align="left" class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Release Date</strong></td>
					<td width="25%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Amount</strong></td>
				</tr>
				<?php foreach ($getRollingReserve->result() as $rowRolling){ 
				$totalRollingReserveValue +=$rowRolling->amount;
				//print_r($rowRolling);
				?>
				<tr>
					<td align="left"><?php echo date("m-d-Y", strtotime($rowRolling->start_date)); ?></td>
					<td align="left"><?php echo date("m-d-Y", strtotime($rowRolling->release_date)); ?></td>
					<td align="left"><?php echo '$'.number_format($rowRolling->amount,2); ?></td>
				</tr>
				<?php  } ?>
				<?php
				if( $totalRollingReserveValue > 0 ){
				?>
				<tr>
					<td align="left" colspan="2" class="td_tab_main" bgcolor="#eeeeee" ><strong>Total Reserves :</strong></td>
					<td align="left" class="td_tab_main" bgcolor="#eeeeee"  >$<?php echo number_format($totalRollingReserveValue,2);?> </td>
				</tr>
				<?php
				}
			}
	?>	
	</table>
	<!-----------------------------------Volume Report Ends----------------------------------------->
	
  </table>

	
	</div>
</div><!-- mainpanel -->
</div><!-- mainwrapper -->
</section> 

        <div class="modal fade" id="send_invoice" tabindex="-1" role="dialog" aria-labelledby="send_invoice" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Send Invoice Email</h4>
                    </div>
                    <form id="resendInvoiceForm" method="POST" action="<?php echo base_url();?>saved_invoice/send_invoice_email" >
                        <div class="modal-body" id="">

                            <input type="hidden" id="tempInvoiceGenerationId" name="tempInvoiceGenerationId" value="<?php echo $tempInvoiceGenerationId; ?>" />
							
                            <div class="form-group">
                                <label >Email Id to send Invoice (Multiple Separated By Comma)</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email ID" value="<?php echo $InvoiceCC; ?>" required >
                            </div>                           
							<div class="form-group">
                                <label >CC Email Id to send Invoice (Multiple Separated By Comma)</label>
                                <input type="text" class="form-control" id="InvoiceCC" name="InvoiceCC" placeholder="Email ID, To CC"  >
                            </div>							
							<div class="form-group">
                                <label >BCC Email Id to send Invoice (Multiple Separated By Comma)</label>
                                <input type="text" class="form-control" id="InvoiceBCC" name="InvoiceBCC" placeholder="Email ID, To BCC"  >
                            </div>							
							<div class="form-group">
                                <label >Notes</label>
                                <textarea class="form-control" id="notes" name="notes" placeholder="Notes"  ></textarea>
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

<script type="text/javascript"> 
  /* function SetInvoiceId(id,InvoiceCC){
		$('#tempInvoiceGenerationId').val(id);
		$('#InvoiceCC').val(InvoiceCC);
	}*/
	function addDetailInvoice(){
		var tempInvoiceGenerationId = jQuery("#tempInvoiceGenerationId").val();
		var total_payout = jQuery("#total_payout").val();
		var r=confirm("Are you sure want to Save the Invoice?");
		if (r == true) {
			$.post('<?php echo base_url().$this->controllerFile; ?>editDetailInvoice', 'tempInvoiceGenerationId='+tempInvoiceGenerationId+"&total_payout="+total_payout, function(data){
				if(data) 
				{
					$("#msgDiv").show("");
					$('#msgDiv').html('Invoice Added Successfully');
					$('#msgDiv').delay(5000).fadeOut('slow', function() {});
					//location.reload();					
				}
			});
		}		
		jQuery("#Invoice_button").show();
	}
	function sendMail(){
		var tempInvoiceGenerationId = jQuery("#tempInvoiceGenerationId").val();
		var emailList = jQuery("#emailList").val();
		var total_payout = jQuery("#total_payout").val();
		/*var r=confirm("Are you sure want to Save the Invoice?");
		if (r == true) {*/
			$.post('<?php echo base_url().$this->controllerFile; ?>sendEmail', 'tempInvoiceGenerationId='+tempInvoiceGenerationId+"&total_payout="+total_payout+"&emailList="+emailList, function(data){
				if(data) 
				{
					$("#msgDiv").show("");
					$('#msgDiv').html('Email Send Successfully');
					$('#msgDiv').delay(5000).fadeOut('slow', function() {});
					//location.reload();					
				}
			});
		//}		
		//jQuery("#Invoice_button").show();
	}	
	function edit(id){ 
		//alert(id);
		var r=confirm("Are you sure want to modify the record?");
		if (r == true) {
			var price_each = jQuery("#price_each"+id).val();
			var quantity = jQuery("#quantity"+id).val();
			$.post('<?php echo base_url().$this->controllerFile; ?>update', 'id='+id+"&price_each="+price_each+"&quantity="+quantity, function(data){
				if(data) 
				{
					$("#msgDiv").show("");
					$('#msgDiv').html('Expenses Added Successfully');
					$('#msgDiv').delay(5000).fadeOut('slow', function() {});
					location.reload();					
				}
			});
		}
	} 
	
	function deleteRec(id){
		var r=confirm("Are you sure want to delete the record?");
		if (r == true) {
		$.post('<?php echo base_url().$this->controllerFile; ?>delete', 'id='+id, function(data){
				if(data) 
				{
					$("#msgDiv").show("");
					$('#msgDiv').html('Expenses Added Successfully');
					$('#msgDiv').delay(5000).fadeOut('slow', function() {});
					location.reload();					
				}
			});			
		}
	}
	function addNew(){
		var creditChk = $("#credit").is(':checked');
		//alert(creditChk);
		if(creditChk == true){
			//alert('checked');
			var credit = 'Y';
		}
		if(creditChk == false){
			var credit = 'N';
			//alert('not checked');
		}
		//alert(credit);
		var r=confirm("Are you sure to Add Expenses?");
		if (r == true) {
			var tempInvoiceGenerationId = jQuery("#tempInvoiceGenerationId").val();
			/*if($("#credit").is(':checked')){
				//alert('ok');
				var credit = 'Y';
			}else{
				var credit = 'N';
			}*/
			var expensename = jQuery("#expensename").val();
			var price_each = jQuery("#price_each").val();
			var quantity = jQuery("#quantity").val();		
			$.post('<?php echo base_url().$this->controllerFile; ?>addexpense', 'tempInvoiceGenerationId='+tempInvoiceGenerationId+'&credit='+credit+'&expensename='+expensename+"&price_each="+price_each+"&quantity="+quantity, function(data){
				if(data) 
				{
					$("#msgDiv").show("");
					$('#msgDiv').html('Expenses Added Successfully');
					$('#msgDiv').delay(5000).fadeOut('slow', function() {});
					location.reload();					
				}
			});			
		}		
	}
	function addDeduction(){
		var deduction=jQuery("#deduction").val();
		var newDeduction = Number(deduction)+1;
		jQuery("#deduction").val(""+newDeduction+"");
		jQuery("#addBlock").append('<div id="deductionDiv'+deduction+'" class="form-group"><label>Name</label> : <input type="text" name="name[]" /> <label >Rate Each</label> : $ <input type="number" name="rate[]" step="0.01" min=0 /> <label >Quantity </label> : <input type="number" name="quantity[]" min=0 /> <a href="javascript:void(0);" onclick="removeDiv('+deduction+')">Remove</a></div>');
	}
	function removeDiv(deductionRemove){
		//alert(deductionRemove);
		jQuery("#deductionDiv"+deductionRemove).remove();
	}
</script> 
<?php $this->load->view('footer');?>
		
		
		
		
		
		
		
		
		
		