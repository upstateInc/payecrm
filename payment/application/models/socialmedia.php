<?php
class Socialmedia extends CI_Model {

	public function __construct() {

		parent::__construct();
	}


	function getAllRecords($order_name='order',$order_type='ASC') {
		//$orderby_field = "order";    
		//$orderby = "ASC";
		$this->db->select('*');
		$this->db->from(SOCIALMEDIA);
		$this->db->order_by($order_name,$order_type);		
		$query = $this->db->get(); 
		//echo $this->db->last_query(); 
		return $query; 
	} // end of getAllRecords
	
	function get_socialmedia_record($id)
	{
		$sql = "SELECT * from ".SOCIALMEDIA." where id=$id";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); 
		return $query->row_array();
	}
}