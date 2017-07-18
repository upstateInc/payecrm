<?php
class Newsletter_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
		
	public function Email_exists($email) {
		$sql = "SELECT * FROM ".NEWSLETTER." WHERE subscriber_email='".$email."'" ;
		$query = $this->db->query($sql);
		$row = $query->num_rows(); 
		//echo $this->db->last_query();
		return $row;
	} // end of Retrive_User


	function download_subscriber_list($where_clause)
	{
			$this->db->select('subscriber_name, subscriber_email, rec_crt_date, is_active',false);
			$orderby_field = "subscriber_name";    
			$orderby = "ASC";
			if($where_clause != '')
			$this->db->where($where_clause);
			$this->db->from( NEWSLETTER);
			$this->db->order_by($orderby_field,$orderby);
			$query = $this->db->get();
			//echo $this->db->last_query(); exit;
			$this->to_excel($query,"subscriber_list");
	}
	
	function to_excel($query, $filename)
	{
			 //$headers = ''; // just creating the var for field headers to append to below
			 $data = ''; // just creating the var for field data to append to below
			 
			 $obj =& get_instance();
			 
			 $fields = $query->field_data();
			

			 if ($query->num_rows() == 0) {
				  echo '<p>The table appears to have no data.</p>';
			 } 
			 else {
				 //foreach ($fields as $field) {
					// $headers .= $field->name . "\t";
				 // }
				 $headers="Subscriber Name"."\t"."Subscriber Email"."\t"."Created on"."\t"."Active";
				  //print_r($headers); exit;
		   
			 //echo "<br>Hearder = ".$headers ; die();
				 
				  foreach ($query->result() as $row) {
					   $count = 0;
					   $line = '';
					   foreach($row as $value) {  
							$count++;                                         
							if ((!isset($value)) OR ($value == "")) {
								 $value = "\t";
							} else {
								 $value = str_replace('"', '""', $value);
								 $value = '"' . $value . '"' . "\t";
							}
							$line .= $value;
					   }
					   $data .= trim($line)."\n";
				  }
				  
				  $data = str_replace("\r","",$data);
								 
				  header("Content-type: application/x-msdownload");
				  header("Content-Disposition: attachment; filename=$filename.xls");
				  echo "$headers\n$data";  
			 }
	}
	
	function countAll($where_clause) {
		$this->db->select('id');
		$this->db->from('t_subscription');
		if($where_clause!='')
		$this->db->where($where_clause);
		$query = $this->db->get();  
		$tot_rec = $query->num_rows();
		return $tot_rec;

	}
	
	public function get_all_active_records($table_name, $where_clause,$offset,$limit) {
		//$this->db->order_by($order_by_fld,$order_by);
		$this->db->limit($limit,$offset);
		if($where_clause!='')
		$this->db->where($where_clause);
		//$this->db->where('is_active','Y');
		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query; 
	}
	


}