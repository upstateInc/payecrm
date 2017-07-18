<?php
class Member_model extends CI_Model {

	public function __construct() {
	
		parent::__construct();
	}

	public function checkLogin($username,$password) {
		$sql = "SELECT * FROM ".USER." WHERE (email='".$username."') AND (passwd='".$password."') " ;
		$query = $this->db->query($sql);
		return $query;
	}
	public function Email_exists($email) {
		$sql = "SELECT * FROM ".USER." WHERE email='".$email."'" ;
		$query = $this->db->query($sql);
		$row = $query->num_rows(); 
		//echo $this->db->last_query();
		return $row;
	} // end of Retrive_User	
	

	public function get_state_list($country_id, $state_id)
	{
		$where_clause = "country_id = '".$country_id."' AND status='Y'";
		$query_state = $this->common_model->get_all_records(STATE,$where_clause,'order_id','ASC',"","");
		
			$state_div = 	'<select name="state_id" id="state_id" style="width:305px;" onchange="getCountyList('.$country_id.',this.value);getCityList('.$country_id.',this.value);getZipList('.$country_id.',this.value);"><option value="">--</option>';
						if ($query_state->num_rows() > 0){
						 foreach ($query_state->result() as $row_state){ 
			$state_div .= 	'<option value="'.$row_state->id.'"';
							if($state_id==$row_state->id)
			$state_div .= 	'selected';

			$state_div .= 	'>'.$row_state->printable_name.'</option>';

						 } } 
			$state_div .= 	'</select>';
			
		//$data['query_state'] = $query_state;
		return $state_div;
	}

	public function get_county_list($country_id, $state_id,$county_id)
	{
		$where_clause = "country_id = '".$country_id."' AND state_id = '".$state_id."' AND status='Y'";
		$query_county = $this->common_model->get_all_records(COUNTY,$where_clause,'order_id','ASC',"","");
		
		
			$county_div = 	'<select name="county_id" id="county_id" style="width:305px;" onchange="getCityList('.$country_id.','.$state_id.',this.value);getZipList('.$country_id.','.$state_id.',this.value);"><option value="">--</option>';			
			if ($query_county->num_rows() > 0){
						 foreach ($query_county->result() as $row_county){ 
			$county_div .= 	'<option value="'.$row_county->id.'"';
							if($county_id==$row_county->id)
			$county_div .= 	'selected';

			$county_div .= 	'>'.$row_county->county_name.'</option>';
						 } }
			$county_div .= 	'</select>';
					
		//$data['query_state'] = $query_state;
		return $county_div;
	}

	public function get_city_list($country_id, $state_id,$county_id,$city_id)
	{
		$where_clause = "country_id = '".$country_id."' AND state_id ='".$state_id."' AND county_id = '".$county_id."' AND status='Y'";
		$query_city = $this->common_model->get_all_records(CITY,$where_clause,'order_id','ASC',"","");
		
			$mode = '1';
			$city_div = 	'<select name="city_id" id="city_id" style="width:305px;" onchange="javascript: getZipList('.$country_id.','.$state_id.',\''.$county_id.'\',this.value);"><option value="">--</option>';						
			if ($query_city->num_rows() > 0){
						 foreach ($query_city->result() as $row_city){ 
			$city_div .= 	'<option value="'.$row_city->id.'"';
							if($city_id==$row_city->id)
			$city_div .= 	'selected';

			$city_div .= 	'>'.$row_city->city_name.'</option>';
						 } }
			$city_div .= 	'</select>';

		return $city_div;
	}

	public function get_zip_list($country_id, $state_id,$county_id,$city_id, $zip_id)
	{
		$where_clause = "country_id = '".$country_id."' AND state_id ='".$state_id."' AND county_id = '".$county_id."' AND city_id = '".$city_id."' AND status='Y'";
		$query_zip = $this->common_model->get_all_records(ZIP,$where_clause,'order_id','ASC',"","");
		
			$mode = '1';
			$zip_div = 	'<select name="zip_code" id="zip_code" style="width:305px;"><option value="">--</option>';						
			if ($query_zip->num_rows() > 0){
						 foreach ($query_zip->result() as $row_zip){ 
			$zip_div .= 	'<option value="'.$row_zip->id.'"';
							if($zip_id==$row_zip->id)
			$zip_div .= 	'selected';

			$zip_div .= 	'>'.$row_zip->zip_code.'</option>';
						 } }
			$zip_div .= 	'</select>';

		return $zip_div;
	}

	public function getCaptcha($length)
	{
		
	$random= "";
	$data1 = "";
	srand((double)microtime()*1000000);
	$data1 = "9876549876542156012";
	$data1 .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	for($i = 0; $i < $length; $i++)
	{
		$random .= substr($data1, (rand()%(strlen($data1))), 1);
	}
	return $random;
	} 

	
	
} // end of class