<table id="tbl_content_area" width="100%" border="0" cellspacing="0" cellpadding="5">
	<tr><td height="1px"></td></tr>
	<tr>
      <td align="center" valign="middle" bgcolor="#FFFFFF" style="" >
	  	 <table width="100%" >
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
                            <td><strong>Processing Period:</strong> <?php echo $row['STARTDATE'];?> to <?php echo $row['ENDDATE'];?></td>
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
                          
                            
                              
                              
     <table width="100%" >
      <tr>
          <td width="40%" align="left"   bgcolor="#eeeeee" style="" ><strong>Invoice</strong></td>
          <!--td width="10%" align="right"  bgcolor="#eeeeee" style=""><strong></strong></td-->
          <td width="20%" align="right"  bgcolor="#eeeeee" style=""><strong>Rate</strong></td>
          <td width="20%" align="right"   bgcolor="#eeeeee" style=""><strong>Quantity</strong></td>
          <td width="20%" align="right"   bgcolor="#eeeeee" style=""><strong>Total</strong></td>
      </tr>
      <tr>
        <td>Gross Settled Volume</td>
        <!--td align="right">&nbsp;</td-->
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">$ <?php echo $row['TOTALSALE'];?></td>
      </tr>	
	  <?php if($row['INVOICETYPE']=="Net"){?>
      <tr >
        <td >Refunds</td>
        <!--td align="right">&nbsp;</td-->
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">$ <?php echo $row['NETREFUND'];?></td>
      </tr>
	  <?php } ?>
	  <?php if($row['INVOICETYPE']=="Gross"){ ?>
      <tr >
        <td>Processing Fee</td>
        <!--td align="right">&nbsp;</td-->
        <td align="right"><?php echo $row['COMMISSIONFEE'];?>%</td>
        <td align="right">$ <?php echo $row['TOTALGOODSALE'];?></td>
        <td align="right">$ <?php echo $row['PROCESSINGFEE'];?></td>
      </tr>	 
	  <tr >
        <td>Rolling Reserve</td>
        <!--td align="right">&nbsp;</td-->
        <td align="right"><?php echo $row['RESERVEPERCENTAGE'];?>%</td>
        <td align="right">$ <?php echo $row['TOTALGOODSALE'];?></td>
        <td align="right">$ <?php echo number_format($row['TOTALRESERVE'],2);?></td>
      </tr>		  
	<?php } ?>	  
	  <tr>
        <td bgcolor="#eeeeee" colspan="3" >Net Settled Volume</td>
        <!--td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td-->
        <td bgcolor="#eeeeee" align="right">$ <?php echo $row['TOTALGOODSALE'];?></td>
      </tr>	
	<?php if($row['INVOICETYPE']=="Net"){ ?> 	  
      <tr >
        <td>Processing Fee</td>
        <!--td align="right">&nbsp;</td-->
        <td align="right"><?php echo $row['COMMISSIONFEE'];?>%</td>
        <td align="right">$ <?php echo $row['TOTALGOODSALE'];?></td>
        <td align="right">$ <?php echo $row['PROCESSINGFEE'];?></td>
      </tr>
	  <tr >
        <td>Rolling Reserve</td>
        <!--td align="right">&nbsp;</td-->
        <td align="right"><?php echo $row['RESERVEPERCENTAGE'];?>%</td>
        <td align="right">$ <?php echo $row['TOTALGOODSALE'];?></td>
        <td align="right">$ <?php echo number_format($row['TOTALRESERVE'],2);?></td>
      </tr>	  
	<?php } ?>
	<?php if($row['INVOICETYPE']=="Gross"){?>
      <tr >
        <td >Refunds</td>
        <!--td align="right">&nbsp;</td-->
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">$ <?php echo $row['NETREFUND'];?></td>
      </tr>	 
	<?php } ?> 
      <!--tr>
        <td>Bank Fee</td>
        <td align="right">&nbsp;</td>
        <td align="right">0.00%</td>
        <td align="right">&nbsp;</td>
        <td align="right">$ -</td>
      </tr-->
      <tr>
        <td>Refund Fee</td>
        <!--td align="right">&nbsp;</td-->
        <td align="right">$ <?php echo $row['REFUNDEACH'];?></td>
        <td align="right"><?php echo $row['NOREFUND'];?></td>
        <td align="right">$ <?php echo $row['TOTALREFUND'];?></td>
      </tr>
      <tr>
        <td >Chargeback Fee</td>
        <!--td align="right">&nbsp;</td-->
        <td align="right">$ <?php echo $row['CHARGEBACHEACH'];?></td>
        <td align="right"><?php echo $row['NOCHARGEBACK'];?></td>
        <td align="right">$ <?php echo $row['TOTALCHARGEBACK'];?></td>
      </tr>
	  <?php if($row['ACHFEE']>0){?> 
      <tr>
        <td >ACH Fee</td>
        <!--td align="right">&nbsp;</td-->
        <td align="right">$ <?php echo $row['ACHFEE'];?></td>
        <td align="right">1</td>
        <td align="right">$ <?php echo $row['ACHFEE'];?></td>
      </tr>
	  <?php } ?>
	  <?php if($row['WIREFEE']>0){?>
      <tr>
        <td >Wire Fee</td>
        <!--td align="right">&nbsp;</td-->
        <td align="right">$ <?php echo strtok($row['WIREFEE'], '.');?></td>
        <td align="right">1</td>
        <td align="right">$ <?php echo $row['WIREFEE'];?></td>
      </tr>
	  <?php } ?>
	  <tr>
		<td colspan="4" style="" ></td>
	  </tr>	  
      <tr>
        <td  bgcolor="#eeeeee" colspan="3"><strong>Invoice Amount</strong></td>
        <!--td bgcolor="#eeeeee" >&nbsp;</td>
        <td bgcolor="#eeeeee" >&nbsp;</td>
        <td bgcolor="#eeeeee" >&nbsp;</td-->
        <td align="right" bgcolor="#eeeeee"><strong>$ <?php echo $row['NETDEDUCTION'];?></strong></td>
      </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>	  
      </table>
      <table width="100%"  >
      <tr>
        <td width="80%" bgcolor="#eeeeee" colspan="3"><strong>Payment</strong></td>
        <!--td align="right" style="">&nbsp;</td>
        <td align="right" style="">&nbsp;</td>
        <td align="right" style="">&nbsp;</td-->
        <td width="20%" align="right" bgcolor="#eeeeee" style=""><strong>Total</strong></td>
      </tr>
      <!--tr>
        <td >Carried Over Last Statement</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">$ -</td>
      </tr-->
      <tr>
        <td colspan="3" >Net Settled Volume</td>
        <!--td bgcolor="#eeeeee" align="right">&nbsp;</td>
        <td bgcolor="#eeeeee" align="right">&nbsp;</td>
        <td bgcolor="#eeeeee" align="right">&nbsp;</td-->
        <td align="right">$ <?php echo $row['TOTALGOODSALE'];?></td>
      </tr>
      <tr>
        <td colspan="3" >Chargebacks</td>
        <!--td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td-->
        <td align="right">$ <?php echo $row['NETCHARGEBACK'];?></td>
      </tr>
      <tr>
        <td >Invoice Amount</td>
        <td colspan="2">&nbsp;</td>
        <td style="text-align:right;">$ -<?php echo $row['NETDEDUCTION'];?></td>
      </tr>
	  <tr>
        <td bgcolor="#eeeeee" >Rolling Reserve Payment</td>
        <td bgcolor="#eeeeee" align="right" colspan="2">&nbsp;</td>
        <td bgcolor="#eeeeee" align="text-align:right"> - </td>
      </tr>	  
      <!--tr>
        <td >PPC Calls</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">$ 80.00</td>
      </tr-->
      <!--tr>
        <td >Additional Items</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr-->
      </table>
     
      <table width="100%"  > 
      <!--tr>
        <td width="30%" style="border-top:1px solid #000;text-align:left;">Sum Net</td>
        <td width="10%" align="right" style="border-top:1px solid #000;text-align:right;">&nbsp;</td>
        <td width="20%" align="right" style="border-top:1px solid #000;text-align:right;">&nbsp;</td>
        <td width="20%" align="right" style="border-top:1px solid #000;text-align:right;">&nbsp;</td>
        <td width="20%" align="right" style="border-top:1px solid #000; text-align:right;">$ <?php echo $row['TOTALGROSSSALE'];?></td>
      </tr-->

	  		<?php if($query->num_rows() > 0){
			$i=0;
			$moreTotalDeduction = 0;
			?>
			<tr >
				<td width="40%" bgcolor="#eeeeee" style="text-align:left;"><strong>Additional Items</strong></td>
				<!--td width="10%" bgcolor="#eeeeee" align="right" style="text-align:right;"></td-->
				<td width="20%" bgcolor="#eeeeee" align="right" style="text-align:right;"><strong>Rate</strong></td>
				<td width="20%" bgcolor="#eeeeee" align="right" style="text-align:right;"><strong>Quantity</strong></td>
				<td width="20%" bgcolor="#eeeeee" align="right" style="text-align:right;"><strong>Total</strong></td>
								
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
					<td width="30%" style="text-align:left;"><?php echo $row1->name;if($row1->credit=='Y'){ echo '(Cr.)'; }else{ echo '(Dr.)';} ?></td>
					<!--td width="10%" align="right" style="text-align:right;"></td-->
					<td width="20%" align="right" style="text-align:right;"> $ <?php echo strtok($row1->price_each, '.'); ?></td>
					<td width="20%" align="right" style="text-align:right;"> <?php echo $row1->quantity; ?></td>
					<td width="20%" align="right" style="text-align:right;"><?php echo '$ '.$row1->total; ?></td>
					
				</tr>
		<?php } } ?>
      <!--tr>
        <td >Settlement Amount</td>
        <td colspan="3">&nbsp;</td>
        <td align="right">$ <?php echo $row['total_payout'];?></td>
      </tr>
      <tr>
        <td >% Approved for Payout</td>
        <td colspan="3">&nbsp;</td>
        <td style="text-align:right;">100%</td>
      </tr-->
      <tr>
        <td width="80%" colspan="3" bgcolor="#eeeeee" ><strong>Final Amount Due</strong></td>
        <td width="20%" bgcolor="#eeeeee" align="right" style=""><strong>$ <?php echo $row['total_payout'];?></strong></td>
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
	<tr><td  align="center">Thank You for your business!</td></tr>
	<!----------------------------------------------------------------------->
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td></tr>
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
		$query = $this->db->query("select rec_up_date,rec_crt_date,fname,lname,agentName,grossPrice from t_invoice where ".$where_clause." order by rec_up_date,rec_up_date,fname,lname");
		
		$query1 = $this->db->query("select rec_up_date,rec_crt_date,fname,lname,agentName,grossPrice from t_invoice where ".$where_clause1." order by rec_up_date,rec_up_date,fname,lname");
		
		$query2 = $this->db->query("select rec_up_date,rec_crt_date,fname,lname,agentName,grossPrice from t_invoice where ".$where_clause2." order by rec_up_date,rec_up_date,fname,lname");
		
		$totRef=$this->db->query('SELECT sum(grossPrice) as sum from t_invoice where '.$where_clause1)->row()->sum;
		
		$totChrgBak=$this->db->query('SELECT sum(grossPrice) as sum from t_invoice where '.$where_clause2)->row()->sum;
		
		$totSettle=$this->db->query('SELECT sum(grossPrice) as sum from t_invoice where '.$where_clause)->row()->sum;
	?>
	<table width="100%" style="border: 0px solid rgb(153, 153, 153);" cellpadding="1" cellspacing="0" >
	<tr><td colspan="5"></td></tr>
	<tr><td colspan="5"></td></tr>
	<tr>
		<td colspan="5" align="center"  ><strong>Volume Report</strong></td>
	</tr>
	<tr><td colspan="5" height="5px;"></td></tr>
	<tr><td colspan="5" align="center"  ><strong>Company : <?php echo $companyID;?></strong></td></tr>
	<tr><td colspan="5" height="5px;" ></td></tr>
	<tr><td colspan="5" align="center"  ><strong>Processing Period : <?php echo $start_date.' to '.$end_date;?></strong></td></tr>
	<tr><td colspan="5" height="5px;" ></td></tr>
	
	<?php if ($query->num_rows() > 0){ ?>
		<tr><td colspan="5" align="center" ><strong>Settled Transactions</strong></td></tr>
		<tr><td colspan="5" height="5px;" ></td></tr>		
      <tr>
          <td width="17%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style="" ><strong>Settled Date</strong></td>
          <td width="17%" align="left" class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Creation Date</strong></td>
          <td width="25%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Customer Name</strong></td>
          <td width="25%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Agent Name</strong></td>
          <td width="15%" align="right"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Amount</strong></td>
      </tr>
	  <?php 
	  $numCnt=0;
	  foreach ($query->result() as $row){ 
	  if($numCnt%2==0){ $clr='#D4E6F1'; }else{  $clr='#F4F6F6'; }
	  ?>
      <tr>
        <td align="left" bgcolor="<?php echo $clr;?>"><?php echo date("m-d-Y", strtotime($row->rec_up_date)); ?></td>
        <td align="left" bgcolor="<?php echo $clr;?>"><?php echo date("m-d-Y", strtotime($row->rec_crt_date)); ?></td>
        <td align="left" bgcolor="<?php echo $clr;?>"><?php echo $row->fname,lname; ?></td>
        <td align="left" bgcolor="<?php echo $clr;?>"><?php echo $row->agentName; ?></td>
        <td align="right" bgcolor="<?php echo $clr;?>"><?php echo '$ '.number_format($row->grossPrice,2); ?></td>
      </tr>			
		<?php 
		$numCnt +=1;
		} 
		?>
		<tr>
			<td colspan="4" align="left" bgcolor="#eeeeee"><strong>Total</strong></td>
			<td align="right" bgcolor="#eeeeee"><strong><?php echo '$ '.number_format($totSettle,2);?></strong></td>
		</tr>
		<tr><td colspan="5" height="5px;" ></td></tr>	
	<?php } ?>
		<?php 
		
		if ($query1->num_rows() > 0){ 
		$numCnt=0;
		?>
		<tr><td colspan="5" align="center" ><strong>Refunded Transactions</strong></td></tr>
		<tr><td colspan="5" height="5px;" ></td></tr>
      <tr>
          <td width="17%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style="" ><strong>Refund Date</strong></td>
          <td width="17%" align="left" class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Creation Date</strong></td>
          <td width="25%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Customer Name</strong></td>
          <td width="25%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Agent Name</strong></td>
          <td width="15%" align="right"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Amount</strong></td>
      </tr>
	  <?php foreach ($query1->result() as $row){ 
		if($numCnt%2==0){ $clr='#D4E6F1'; }else{  $clr='#F4F6F6'; }
	  ?>
      <tr>
        <td align="left" bgcolor="<?php echo $clr;?>"><?php echo date("m-d-Y", strtotime($row->rec_up_date)); ?></td>
        <td align="left" bgcolor="<?php echo $clr;?>"><?php echo date("m-d-Y", strtotime($row->rec_crt_date)); ?></td>
        <td align="left" bgcolor="<?php echo $clr;?>"><?php echo $row->fname,lname; ?></td>
        <td align="left" bgcolor="<?php echo $clr;?>"><?php echo $row->agentName; ?></td>
        <td align="right" bgcolor="<?php echo $clr;?>"><?php echo '$ '.number_format($row->grossPrice,2); ?></td>
      </tr>	
	<?php 
	$numCnt +=1;
	} ?>
	  	<tr>
			<td colspan="4" align="left" bgcolor="#eeeeee"><strong>Total</strong></td>
			<td align="right" bgcolor="#eeeeee"><strong><?php echo '$ '.number_format($totRef,2);?></strong></td>
		</tr>
		<tr><td colspan="5" height="5px;" ></td></tr>	
	<?php } ?>	
	<?php if ($query2->num_rows() > 0){
			$numCnt=0;
	?>
		<tr><td colspan="5" align="center" ><strong>Chargeback Transactions</strong></td></tr>
		<tr><td colspan="5" height="5px;" ></td></tr>
      <tr>
          <td width="17%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style="" ><strong>Chargeback Date</strong></td>
          <td width="17%" align="left" class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Creation Date</strong></td>
          <td width="25%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Customer Name</strong></td>
          <td width="25%" align="left"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Agent Name</strong></td>
          <td width="15%" align="right"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Amount</strong></td>
      </tr>
	  <?php foreach ($query2->result() as $row){ 
		if($numCnt%2==0){ $clr='#D4E6F1'; }else{  $clr='#F4F6F6'; }
	  ?>
      <tr>
        <td align="left" bgcolor="<?php echo $clr;?>"><?php echo date("m-d-Y", strtotime($row->rec_up_date)); ?></td>
        <td align="left" bgcolor="<?php echo $clr;?>"><?php echo date("m-d-Y", strtotime($row->rec_crt_date)); ?></td>
        <td align="left" bgcolor="<?php echo $clr;?>"><?php echo $row->fname,lname; ?></td>
        <td align="left" bgcolor="<?php echo $clr;?>"><?php echo $row->agentName; ?></td>
        <td align="right" bgcolor="<?php echo $clr;?>"><?php echo '$ '.number_format($row->grossPrice,2); ?></td>
      </tr>
	<?php 
		$numCnt +=1;
	} 
	?>
		<tr>
			<td colspan="4" align="left" bgcolor="#eeeeee"><strong>Total</strong></td>
			<td align="right" bgcolor="#eeeeee"><strong><?php echo '$ '.number_format($totChrgBak,2);?></strong></td>
		</tr>
		<tr><td colspan="5" height="5px;" ></td></tr>	
	<?php 
	
	} 
	?>
	<!--------------------Rolling Reserve---------------------->
	<?php 
			$totalRollingReserveValue = 0;
			$getRollingReserve=$this->db->query("select * from t_reserve_fees_weekly where status='Y' and companyID='".$companyID."'");
			if($getRollingReserve->num_rows()>0){ ?>
				<tr><td colspan="5" align="center" bgcolor="#eeeeee"><strong>Rolling Reverse Transactions</strong></td></tr>
				<tr><td colspan="5" height="5px;" ></td></tr>
				<tr>
					<td  align="left" colspan="2" class="td_tab_main" bgcolor="#eeeeee" style="" ><strong>Start Date</strong></td>
					<td  align="left" colspan="2" class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Release Date</strong></td>
					<td  align="left"  class="td_tab_main" bgcolor="#eeeeee" style=""><strong>Amount</strong></td>
				</tr>
				<?php foreach ($getRollingReserve->result() as $rowRolling){ 
				$totalRollingReserveValue +=$rowRolling->amount;
				?>
				<tr>
					<td colspan="2" align="left"><?php echo date("m-d-Y", strtotime($rowRolling->start_date)); ?></td>
					<td colspan="2" align="left"><?php echo date("m-d-Y", strtotime($rowRolling->release_date)); ?></td>
					<td align="left"><?php echo '$'.number_format($rowRolling->amount,2); ?></td>
					<!--td align="left"><?php echo date("m-d-Y", strtotime($getReserve->end_date)); ?></td-->
				</tr>
				<?php  } ?>
				<?php
				if( $totalRollingReserveValue > 0 ){
				?>
					<tr>
						<td align="left" colspan="4" class="td_tab_main" bgcolor="#eeeeee" ><strong>Total Reserves :</strong></td>
						<td align="left" class="td_tab_main" bgcolor="#eeeeee"  >$<?php echo number_format($totalRollingReserveValue,2);?> </td>
					</tr>
				<?php
				}							
			}
	?>	
	</table>
	<!-----------------------------------Volume Report Ends----------------------------------------->
  </table>
