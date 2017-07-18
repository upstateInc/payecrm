 <?php 
 if($product_cart->num_rows() > 0){
 ?>
 <table width="100%" border="1" id="myTable" class="tablesorter">
 <thead>
  <tr>
    <!--th class="table_left table_th table_th_width_3">Category</th>
	<th class="table_th table_th_width_1">Brand Name</th>
	<th class="table_th table_th_width_1">Generic Name</th-->
	<th class="table_th table_th_width_1">Name</th>
	<th class="table_th table_th_width_4">Dosage</th>
	<th class="table_th table_th_width_4">Package</th>
	<th class="table_th table_th_width_4">Quantity</th>
	<th class="table_center table_th table_th_width_3">Amount</th>
	<th class="table_center table_th table_th_width_4">Total</th>
    <th class="table_th table_th_width_4">Update</th>
    <th class="table_th table_th_width_4">Delete</th>
  </tr>
  </thead>
	<?php 
	$i=0;
	foreach($product_cart->result() as $val){
		$i+=1;	
		if($i%2==0){
			$colourCode="d5d9dc";
		}else{
			$colourCode="eaeef1";
		}
		$productPrice =$productPrice+($val->price_each*$val->quantity); 
		$singleProductName=$val->productName;
	?> 
		<tr style="background:#<?php echo $colourCode;?>">			
			<!--td><?php echo $this->db->query("select name from t_category where id='".$val->category."'")->row()->name; ?></td>
			<td><?php echo $val->brandName;?></td>
			<td><?php echo $val->genericName;?></td-->
			<td><?php echo $val->productName;?></td>
			<td style="text-align:center;" ><?php echo $val->dosage;?></td>
			<td style="text-align:center;" ><?php echo $val->form;?></td>
			<td style="text-align:center;" ><input id="quantity<?php echo $val->cartID;?>" type="number" min=1  style="width:50px;" value="<?php echo $val->quantity;?>"/></td>
			<td style="text-align:center;" >$<input id="price_each<?php echo $val->cartID;?>" type="number" step="0.01" min=0 style="width:65px;" value="<?php echo sprintf('%0.2f',$val->price_each);?>"/></td>
			<td style="text-align:right;"><?php echo '$'.sprintf('%0.2f',$val->quantity * $val->price_each);?></td>
			<td style="text-align:center;"><a href="javascript:void(0);" onclick="updateItem('<?php echo $val->cartID;?>','<?php echo $val->quantity;?>','<?php echo $val->price_each;?>');"><img src="<?php echo base_url();?>assets/img/edit.png"></a></td>
			<td style="text-align:center;"><a href="javascript:void(0);" onclick="removeItem('<?php echo $val->cartID;?>');"><img src="<?php echo base_url();?>assets/img/delete.png"></span></a></td>
			
		</tr>
		<input type="hidden" name="cartID[]" value="<?php echo $val->cartID;?>"/>
	<?php } ?>
	
</table>
<table width="100%" >
<tr><td width="72%"><strong>Grand Total</strong></td><td width="28%"><strong><?php echo 'USD $'.sprintf('%0.2f',$productPrice);?></strong></td></tr>
<input type="hidden" name="product_price" value="<?php echo $productPrice; ?>"/>
<input type="hidden" name="singleProductName" value="<?php echo $singleProductName; ?>"/>
</table>
<?php } ?>
