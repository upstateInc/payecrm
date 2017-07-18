<select name="selectProduct" id="selectProduct" class="form-control" >
        <option value="">Select</option>
        <?php
		foreach($result->result() as $row) {
			/*print_r($row);
			echo $row->id;*/
			?>
			
			<option value="<?php echo $row->id;?>"><strong><?php echo $row->$productNameSelect.'  -  '.$row->dosage.'  -  $'.$row->amount;?></strong></option>
        <?php } ?> 
</select>