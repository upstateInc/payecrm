<?php
class Faq_model extends CI_Model {

	public function __construct() {
	
		parent::__construct();
	}
	

	/*public function Retrive_record($table,$where_clause) {
		$sql = "SELECT * FROM ".$table." WHERE ".$where_clause."" ;
		$query = $this->db->query($sql);
		$row = $query->row_array(); 
		//echo $this->db->last_query();
		return $row;
	}*/

	public function record_change_id($table,$where_clause,$order_by_fld,$order_by,$offset,$limit) {	
		$this->db->order_by($order_by_fld,$order_by);
		$this->db->limit($limit,$offset);
		$this->db->where($where_clause);
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();
		//echo $this->db->last_query();
		foreach ($query->result() as $row){ 
		$id = $row->id;
		}
		//print_r($row); exit;
		return $id; 
	}


	function showOrderIcon($table,$id) {
		// retrive MAX and MIN banner_order 
		$query_order = "SELECT min(order_id) as `min_order`,max(order_id) as `max_order` FROM ".$table." WHERE 1";
		$rs_order = $this->db->query($query_order);
		$row_order = $rs_order->row_array(); 
		$min_order = $row_order['min_order'];
		$max_order = $row_order['max_order'];
		
		// retrive indivisual banner_order
		$query_order = "SELECT `order_id` FROM ".$table." WHERE `id` ='{$id}'";
		$rs_order    = $this->db->query($query_order);
		$row_order   =  $rs_order->row_array(); 
		$order = $row_order['order_id'];
		if($order==$max_order){
			$link="<img src='".base_url()."images/admin/priority_up.png' border='0' onclick=\"javascript:change_order('{$id}','decrease_order');\" style='cursor:pointer;' title='Increase Order' alt='Down'>";
		} else if($order==$min_order){
			$link="<img src='".base_url()."images/admin/priority_down.png' border='0' onclick=\"javascript:change_order('{$id}','increase_order');\" style='cursor:pointer;' title='Decrease Order' alt='Up'>";
		} else {
			$link="<img src='".base_url()."images/admin/priority_up.png' border='0' onclick=\"javascript:change_order('{$id}','decrease_order');\" style='cursor:pointer;' title='Increase Order' alt='Up'>&nbsp;&nbsp;<img src='".base_url()."images/admin/priority_down.png' border='0' onclick=\"javascript:change_order('{$id}','increase_order');\" style='cursor:pointer;' title='Decrease Order' alt='Down'>";
		}
		
		return($link);
}

function dispOrderIcon($table,$id) {
		// retrive MAX and MIN banner_order 
		$query_order = "SELECT min(order_id) as `min_order`,max(order_id) as `max_order` FROM ".$table." WHERE isdeleted = 'N'";
		$rs_order = $this->db->query($query_order);
		$row_order = $rs_order->row_array(); 
		$min_order = $row_order['min_order'];
		$max_order = $row_order['max_order'];
		
		// retrive indivisual banner_order
		$query_order = "SELECT `order_id` FROM ".$table." WHERE `id` ='{$id}'";
		$rs_order    = $this->db->query($query_order);
		$row_order   =  $rs_order->row_array(); 
		$order = $row_order['order_id'];
		if($order==$max_order){
			$link="<img src='".base_url()."images/admin/priority_up.png' border='0' onclick=\"javascript:change_order('{$id}','decrease_order');\" style='cursor:pointer;' title='Increase Order' alt='Down'>";
		} else if($order==$min_order){
			$link="<img src='".base_url()."images/admin/priority_down.png' border='0' onclick=\"javascript:change_order('{$id}','increase_order');\" style='cursor:pointer;' title='Decrease Order' alt='Up'>";
		} else {
			$link="<img src='".base_url()."images/admin/priority_up.png' border='0' onclick=\"javascript:change_order('{$id}','decrease_order');\" style='cursor:pointer;' title='Increase Order' alt='Up'>&nbsp;&nbsp;<img src='".base_url()."images/admin/priority_down.png' border='0' onclick=\"javascript:change_order('{$id}','increase_order');\" style='cursor:pointer;' title='Decrease Order' alt='Down'>";
		}
		
		return($link);
}
	
	
	
	
} // end of class