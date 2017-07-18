<?php
	function unique_pin(){
		$CI =& get_instance();
		$number = substr(number_format(time() * rand(),0,'',''),0,6);
		$query = $CI->db->query("SELECT * FROM t_customer WHERE customerId = '".$number."'");  
		$num = $query->num_rows();
		if( $num > 0){
			unique_pin();
		}
		else
		{ 
			return $number ; 
		}
	}
?>