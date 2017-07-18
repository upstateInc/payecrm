<tbody id="echeckingArea" >
	<tr>
		<th><span class="red">*</span> First Name</th>
		<td><input class="form-control" id="fname" name="fname" placeholder="Enter Customer First Name" required="" type="text" /></td>
    </tr>	
	<tr>
		<th><span class="red">*</span> Last Name</th>
		<td><input class="form-control" id="lname" name="lname" placeholder="Enter Customer Last Name" required="" type="text" /></td>
    </tr>
	<tr>
		<th><span class="red">*</span> Your Contact Email</th>
		<td><input class="form-control" id="email" name="email" placeholder="Enter your email" required="" type="text" /></td>
	</tr>
	<tr>
		<th><span class="red">*</span> Contact Phone</th>
		<td><input class="form-control" id="contact" name="contact" pattern="^(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}$" placeholder="XXX- XXX - XXXX" required="" type="phone" /></td>
    </tr>
	<tr>
		<th><span class="red">*</span> Medication</th>
		<td><input class="form-control" id="medication" name="medication" placeholder="Enter Medication" required="" type="text" /></td>
    </tr>
	<!--tr>
		<th><span class="red">*</span> Quantity</th>
		<td><input class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" required="" type="text" /></td>
    </tr>
	<tr>
		<th><span class="red">*</span> Amount</th>
		<td><input class="form-control" id="amount" name="amount" placeholder="Enter Amount" required="" type="text" /></td>
    </tr-->
	<tr>
	  <th><span class="red">*</span> Account #</th>
	  <td>
		<input type="text" name="accountNumber" class="form-control echeckingClass" placeholder="Enter Account Number">
	  </td>
	</tr>	
	<tr>
	  <th><span class="red">*</span> Routing #</th>
	  <td>
		<input type="text" name="routingNumber" class="form-control echeckingClass" placeholder="Enter Routing Number">
	  </td>
	</tr>
	<tr>
	  <th><span class="red">*</span> Check #</th>
	  <td>
		<input type="text" name="checkNumber" class="form-control echeckingClass"  onkeyup="SetCheckNumber(this.value);" placeholder="Enter Check Number">
	  </td>
	</tr>
	<tr>
		<th><span class="red">*</span> Account Type</th>
		<td><input class="form-control" id="account_type" name="account_type" placeholder="Enter Account Type" required="" type="text" /></td>
    </tr>	
	<tr>
	  <th><span class="red">*</span> Bank Name</th>
	  <td>
		<input type="text" name="bankName" id="bankName" class="form-control echeckingClass" placeholder="Enter Bank Name">
	  </td>
	</tr>	
	<tr>
	  <th><span class="red">*</span> Bank Address</th>
	  <td>
		<input type="text" name="bankAddress" id="bankAddress" class="form-control echeckingClass" placeholder="Enter Bank Address">
	  </td>
	</tr>	
	<tr>
	  <th><span class="red">*</span> Name on the Check</th>
	  <td>
		<input type="text" name="nameoncheck" id="nameoncheck" class="form-control echeckingClass" placeholder="Enter Name on Check">
	  </td>
	</tr>
	<tr>
		<th><span class="red">*</span> Shipping Address</th>
		<td><input class="form-control" id="address" name="address" placeholder="Shipping address" required="" type="address1" /></td>
	</tr>

		<tr>
			<th><span class="red">*</span> Country</th>
			<td>                    
			   <input type="hidden" name="country" id="country" />                        
				<select class="form-control" id="acountry" name="acountry" onchange="ChangeState(this.value);ChangeText(this.options[this.selectedIndex].getAttribute('isoName'));" required="">
				<option value="">Select</option> 
				  <?php foreach($result->result() as $row) { ?>
				  <option value="<?php echo $row->id; ?>" isoName="<?php echo $row->iso; ?>"><?php echo $row->printable_name; ?></option>
				  <?php } ?>
			 </select>
			 </td>
		</tr>
		<tr>
			<th><span class="red">*</span> State</th>
			<td>
			<div id="statediv"><select class="form-control" id="state" name="state" required=""><option value="">Select</option> </select></div>
			</td>
		</tr>
	<tr>
		<th><span class="red">*</span> City</th>
		<td><input class="form-control" id="city" name="city" placeholder="Enter city" required="" type="text" /></td>
	</tr>		
	<tr>
		<th><span class="red">*</span> Zip </th>
		<td><input class="form-control" id="zip" name="zip" placeholder="Enter Zip" required="" type="text" /></td>
	</tr>	
	<!--tr>
	  <th><span class="red">*</span> Check Date</th>
	  <td>
		<input type="text" name="checkDate" id="CheckDate" class="form-control hasDatepicker echeckingClass" placeholder="Enter Check Date">
	  </td>
	</tr>

	<tr>
	  <th valign="top">Check Memo</th>
	  <td>
		<input type="text" name="checkMemo" class="form-control" placeholder="For training and support services" value="For training and support services">
		
	  </td-->
	</tr>
</tbody>
<script>
	jQuery(function($){
	  $("#contact").mask("999-999-9999"); 
	});
</script>