<tbody id="creditCardArea">
	<tr>
		<th><span class="red">*</span> First Name</th>
		<td colspan="4"><input class="form-control" id="fname" name="fname" placeholder="Enter Customer First Name" required="" type="text" style="margin:5px 0 5px 10px;" /></td>
    </tr>	
	<tr>
		<th><span class="red">*</span> Last Name</th>
		<td><input class="form-control" id="lname" name="lname" placeholder="Enter Customer Last Name" required="" type="text" style="margin:5px 0 5px 10px;" /></td>
    </tr>
	<tr>
		<th><span class="red"></span> Your Contact Email</th>
		<td><input class="form-control" id="email" name="email" placeholder="Enter your email" type="text" style="margin:5px 0 5px 10px;" /></td>
	</tr>
	<tr>
		<th><span class="red"></span> Contact Phone</th>
		<td><input class="form-control" id="contact" name="contact" pattern="^(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}$" placeholder="XXX- XXX - XXXX" type="phone" style="margin:5px 0 5px 10px;" data-mask="999-999-9999" /></td>
    </tr>	
	<tr>
		<th><span class="red">*</span> Address</th>
		<td><input class="form-control" id="address" name="address" placeholder="Address" required="" type="address1" style="margin:5px 0 5px 10px;" /></td>
	</tr>
                <!--tr>
                    <th><span class="red">*</span> Country</th>
                    <td-->                    
                       <input type="hidden" name="country" id="country" value="US"/>                        
						<!--select class="form-control" id="acountry" name="acountry" onchange="ChangeState(this.value);ChangeText(this.options[this.selectedIndex].getAttribute('isoName'));" required="" style="margin:5px 0 5px 10px;" >
						<option value="">Select</option> 
                          <?php foreach($result->result() as $row) { ?>
                          <option value="<?php echo $row->id;?>" <?php if($row->id==888){ echo 'selected'; } ?> isoName="<?php echo $row->iso; ?>"><?php echo $row->printable_name; ?></option>
                          <?php } ?>
                     </select>
					 </td>
                </tr-->
                <tr>
                    <th><span class="red"></span> State</th>
                    <td>
                    <div id="statediv">
						<select class="form-control" id="state" name="state"  style="margin:5px 0 5px 10px;">
							<option value="">Select</option>
							<?php $resultState = $this->common_model->get_all_records('t_state', "`countryId` = '888'",'id','ASC',$offset,$limit);
							
							foreach($resultState->result() as $row) { ?>
								<option value="<?php echo $row->name;?>"><?php echo $row->name;?></option>;
							<?php } ?>		 
						</select>
					</div>
                    </td>
                </tr>
                <tr>
                    <th><span class="red"></span> City</th>
                    <td><input class="form-control" id="city" name="city" placeholder="Enter city"  type="text" style="margin:5px 0 5px 10px;" /></td>
                </tr>
                <tr>
                    <th><span class="red">*</span> Zip</th>
                    <td><input class="form-control" id="zip" name="zip" placeholder="Enter zip" required="" type="text" style="margin:5px 0 5px 10px;" /></td>
                </tr>
	<!--tr>
		<th><span class="red">*</span> Amount</th>
		<td><input class="form-control" id="amount" name="amount" placeholder="Enter Amount" required="" type="text" /></td>
    </tr-->				
					<tr>
						<th><span class="red">*</span> Card Type</th>
						<td>
							<select class="form-control creditCardClass" id="cardtype" name="cardtype" <?php if(CREDITCARDHIDDEN == 'N'){ ?> onchange="ChangeCardType(this.value);" <?php } ?> required  style="margin:5px 0 5px 10px;">
							<option value="">Select</option><option value="Visa">Visa</option>
							<option value="MasterCard">MasterCard</option>
							<option value="DinersClub">DinersClub</option>
							<option value="AmEx">AmEx</option>
							<option value="Discover">Discover</option>
							<option value="JCB">JCB</option>
							<option value="VisaElectron">VisaElectron</option>
							</select>
						</td>
					</tr>
					<tr>
						<th><span class="red">*</span> Name on Card</th>
						<td><input style="margin:5px 0 5px 10px;" class="form-control creditCardClass" id="nameoncard" name="nameoncard" placeholder="Name as it appears in card" type="text" required /></td>
					</tr>
					<tr>
						<th><span class="red">*</span> Card Number </th>
						<td id="creditCardInfoSection">
						<?php if(CREDITCARDHIDDEN == 'Y'){ ?>
						<input style="margin:5px 0 5px 10px;" class="form-control creditCardClass" id="cardnumber" name="cardnumber" pattern="[0-9]{13,16}" placeholder="Enter credit/debit card number here" type="password" onkeyup="ChangeCardNumber();" required />
						<?php } ?>
						<?php if(CREDITCARDHIDDEN == 'N'){ $this->load->view('normalCard'); } ?>
						</td>
					</tr>
					<tr>

						<th><span class="red">*</span> Card Expiration</th>
						<td><div class="col-xs-4" style=" padding:0;">
						<input style="margin:5px 0 5px 10px;" type="text" class="form-control creditCardClass" placeholder="MM" id="month" name="month" minlength=2 maxlength=2 required pattern="[0-9]{2}" />
						</div>
						<div class="col-xs-4">
						<input style="margin:5px 0 5px 10px;" minlength=2 maxlength=2 type="text" class="form-control creditCardClass" placeholder="YY" id="year" name="year" required pattern="[0-9]{2}">
						</div></td>
					</tr>					
					<tr>
						<th><span class="red">*</span> CVV Code :</th>
						<td><div class="col-xs-4">
                        <input style="margin:5px 0 5px -5px;" class="form-control creditCardClass" id="cvv" name="cvv" placeholder="CVV" <?php if(CREDITCARDHIDDEN == 'Y'){ ?> type="password" <?php }else{ ?> type="text" <?php } ?> pattern="[0-9]{3,4}" minlength=3 maxlength="4" required /></div></td>
					</tr>
                    <tr>
						<th>&nbsp;</th>
						<td>&nbsp;</td>
					</tr>

</tbody>
<script>

	/*jQuery(function($){
	  $("#contact").mask("999-999-9999"); 
	});*/
	$('.inputmask').inputmask({
		mask: '999-999-9999'
	})
</script>