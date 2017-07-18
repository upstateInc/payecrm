<?php
class Commonmaster_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->db = $this->load->database('master', TRUE); 
	}
	public function get_all_records($table_name, $where_clause,$order_by_fld,$order_by,$offset,$limit) {
		$master = $this->load->database('master', TRUE); 
		$master->order_by($order_by_fld,$order_by);
		$master->limit($limit,$offset);
		if($where_clause!='')
		$master->where($where_clause);
		$master->select('*');
		$master->from($table_name);
		$query = $master->get();
		//echo $master->last_query();
		return $query; 

	} // end of get_all_records
	function Retrive_Record($table,$id) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('id', addslashes($id));
		$query = $this->db->get();
		$row = $query->row_array();
		$cnt = $query->num_rows ();
		//echo $cnt; 
		if($cnt>0){
			return $row;
		}	
	}
	public function Retrive_Record_By_Where_Clause($table,$where_clause) {
		$this->db->select('*');
		$this->db->from($table);
		if(!empty($where_clause))
		$this->db->where($where_clause);
		$query = $this->db->get();
		$row = $query->row_array();
		return $row;
	}	
}	