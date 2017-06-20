<link href="<?php echo base_url();?>css/admin-styles.css" rel="stylesheet" type="text/css" />
			    <table width="100%" border="0" cellspacing="0" cellpadding="4" >
					  <tr>
						<td align="center" valign="top">
                           <table width="100%" border="0" cellspacing="0" cellpadding="3">
								<tr><td colspan="2" align="left" class="data_heading"><h2></h2></td></tr>						  
							   <tr>
								<td width="280" align="left" valign="top" class="field_title2"><strong>Company Id : </strong></td>
								<td width="447" align="left" valign="left" class="entry_field"><?php echo $row['companyID'];?></td>
							  </tr>
							  <tr>
								<td width="280" align="left" valign="top" class="field_title2"><strong>First Name : </strong></td>
								<td width="447" align="left" valign="left" class="entry_field"><?php echo $row['fname'];?></td>
							  </tr>
							  <tr>
								<td width="280"  align="left" valign="top" class="field_title2"><strong>Last Name : </strong></td>
								<td align="left" valign="left"  class="entry_field"><?php echo $row['lname'];?></td>
							  </tr>
							  <tr>
								<td width="280"  align="left" valign="top" class="field_title2"><strong>Email : </strong></td>
								<td align="left" valign="left"  class="entry_field"><?php echo $row['customer_email'];?></td>
							  </tr>
							  <tr>
								<td width="280"  align="left" valign="top" class="field_title2"><strong>Address : </strong></td>
								<td align="left" valign="left"  class="entry_field"><?php echo $row['customer_address'];?></td>
							  </tr>
							  <tr>
								<td width="280"  align="left" valign="top" class="field_title2"><strong>City : </strong></td>
								<td align="left" valign="left"  class="entry_field"><?php echo $row['customer_city'];?></td>
							  </tr>
							  <tr>
								<td width="280"  align="left" valign="top" class="field_title2"><strong>State : </strong></td>
								<td align="left" valign="left"  class="entry_field"><?php echo $row['customer_state'];?></td>
							  </tr>
							  <tr>
								<td width="280"  align="left" valign="top" class="field_title2"><strong>Country : </strong></td>
								<td align="left" valign="left"  class="entry_field"><?php echo $row['customer_country'];?></td>
							  </tr>
							  <tr>
								<td width="280"  align="left" valign="top" class="field_title2"><strong>Zip : </strong></td>
								<td align="left" valign="left"  class="entry_field"><?php echo $row['customer_zip'];?></td>
							  </tr>
							  <tr>
								<td width="280"  align="left" valign="top" class="field_title2"><strong>Phone : </strong></td>
								<td align="left" valign="left"  class="entry_field"><?php if($row['customer_phone']!='') echo $row['customer_phone']; else echo 'N/A'; ?></td>
							  </tr>
							  
							<tr>
								<td width="280"  align="left" valign="top" class="field_title2"><strong>Created : </strong></td>
								<td align="left" valign="left"  class="entry_field"><?php echo date('d M,Y',strtotime($row['rec_crt_date'])); ?></td>
							  </tr>
							  
							  </table>
						</td>
					  </tr>
					</table>
	 