<?php

function unique_pin(){
$ci =&get_instance();
$number = substr(number_format(time() * rand(),0,'',''),0,6);
$query = $ci->db->get_where('t_customer', array('pin' => $number));

	if ($query->num_rows() > 0)
	{
		unique_pin();
	}
	else
	{
		return $number ;
	}
}


function unique_transaction_code(){
$ci =&get_instance();
$number = substr(number_format(time() * rand(),0,'',''),4,6);
$query = $ci->db->get_where('t_transaction_code', array('transaction_code' => $number));

	if ($query->num_rows() > 0)
	{
		unique_transaction_code();
	}
	else
	{
		$data = array(
		   'transaction_code' => $number,
		   'agent_id'		  =>  $ci->session->userdata('ADMIN_ID')
		);
		
		$ci->db->insert('t_transaction_code', $data);
		return $number ;
	}
}


function case_identity(){
$ci =&get_instance();
$number = rand('11111','99999');
$query = $ci->db->get_where('t_case', array('case_identity' => $number));

	if ($query->num_rows() > 0)
	{
		case_identity();
	}
	else
	{
		return $number ;
	}
}

?>