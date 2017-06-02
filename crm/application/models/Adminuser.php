<?php
class Adminuser extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function get_user_passwordrecord($old_password)
	{
		$where_clause = "passwd = '".$old_password."' and id = ".$this->session->userdata('ADMIN_ID');
		$this->db->where($where_clause);
		$this->db->select('*');
		$this->db->from(USER);
		$query = $this->db->get();
		return $query->num_rows();
	}

		
	public function Email_exists($email) {
		$sql = "SELECT * FROM ".ADMINUSER." WHERE email='".$email."'" ;
		$query = $this->db->query($sql);
		$row = $query->num_rows(); 
		//echo $this->db->last_query();
		return $row;
	} // end of Retrive_User

	public function Username_exists($username) {
		$sql = "SELECT * FROM ".ADMINUSER." WHERE username='".$username."'" ;
		$query = $this->db->query($sql);
		$row = $query->num_rows(); 
		//echo $this->db->last_query();
		return $row;
	} // end of Retrive_User


	function downadmin($where_clause,$type)
	{
	
			$yes="Yes";
			$no="No";
			
			$this->db->select('name, email,phone,username,passwd,status,rec_crt_date,last_login',false);
			$orderby_field = "id";    
			$orderby = "ASC";
			//$where_clause = "U.type = 'superadmin' or U.type = 'admin'";
			$this->db->where($where_clause);
			$this->db->from(ADMINUSER);
			//$this->db->join(COUNTRY.' C','U.country = C.id','inner');
			$this->db->order_by($orderby_field,$orderby);
			$query = $this->db->get();
			//echo $this->db->last_query(); exit;
			$this->to_excel($query,$type);
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
				  $headers="Name"."\t"."Email"."\t"."Phone"."\t"."Fax"."\t"."Username"."\t"."Password"."\t"."Status"."\t"."Created."."\t"."Last-Login";
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
								 if($count==6)
								 $value = $this->base64De(2,$value);

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
	
	function getAllRecordsforpdf($where_clause)
	{
	
			$yes="Yes";
			$no="No";
			
			$this->db->select('name, type,email,phone,username,passwd,status,rec_crt_date,last_login',false);
			$orderby_field = "id";    
			$orderby = "ASC";
			//$where_clause = "U.type = 'superadmin' or U.type = 'admin'";
			$this->db->where($where_clause);
			$this->db->from(ADMINUSER);
			//$this->db->join(COUNTRY.' C','U.country = C.id','inner');
			$this->db->order_by($orderby_field,$orderby);
		// run joins, order by, where, or anything else here
			$query = $this->db->get();
			//echo $this->db->last_query(); exit;
			return $query;
	}

	public function base64De($num,$val) {
		for($i=0; $i<$num; $i++) {
			$val = base64_decode($val);
		}
		
		return $val;
	}








}