<?php
class Banner_model extends CI_Model {

	public function __construct() {
	
		parent::__construct();
	}

		public function getAllBannerList($table_name,$where_clause) {
			$this->db->order_by("id","desc");
			if($where_clause !='')
			$this->db->where($where_clause);
			$this->db->select('*');
			$this->db->from(BANNER);
			$query = $this->db->get();  
			return $query; 

		} // end of getallrecords

		public function getAllFeatureList($table_name,$where_clause) {
			$this->db->order_by("F.id","desc");
			if($where_clause !='')
			$this->db->where($where_clause);
			$this->db->select('F.*,C1.city_name,C2.title');
			$this->db->from(FEATURE_LISTING.' AS F INNER JOIN '.CITY.' AS C1 ON F.city_id=C1.id INNER JOIN '.CATEGORY.' AS C2 ON F.cat_id=C2.id');
			$query = $this->db->get();  
			return $query; 

		} // end of getallrecords

		public function get_all_category_on_bannerad($selected,$where_clause,$table) {
		$level = 0;
		$this->db->order_by("order_id","ASC");
		$where_clause_2 = "parent_id ='0'".$where_clause;
		$this->db->where($where_clause_2);
		$this->db->select("*");
		$this->db->from($table);
		$query = $this->db->get();
		$mode = "2";
		$cat_dropdown = '<select name="cat_id" id="cat_id" style="width:210px;font-weight:normal" onchange="javascript: showSlotDiv();">
		<option value="">-Select Category-</option>';
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{ 
				$cat_dropdown .= '<option value="'.$row->id.'" style="font-weight:bold;font-size:12px"';
				if($selected == $row->id)
					$cat_dropdown .= 'selected' ;

				$cat_dropdown .= '>'.$row->title.'</option>';
				$cat_dropdown .= $this->get_all_subcategory_on_bannerad($row->id,$level,$selected,$table,$where_clause);
			}

		}
		$cat_dropdown .= '</select>';
		
		//echo $cat_dropdown; 		
		//exit;
		//echo $this->db->last_query(); exit;
		return $cat_dropdown; 
	}

	public function get_all_subcategory_on_bannerad($id,$level,$selected,$table,$where_clause) {
		$level ++;
		$this->db->order_by("order_id","ASC");
		$where_clause_2 = "parent_id ='".$id."'".$where_clause;
		$this->db->where($where_clause_2);
		$this->db->select("*");
		$this->db->from($table);
		$query = $this->db->get();
		$subcat_dropdown = '';
		$var = '-';
		for($i=0;$i<$level;$i++)
		{
			$var .= $var;
		}
		//if($submenu != '')
			//$var = '--';
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{ 
				$subcat_dropdown .= '<option value="'.$row->id.'"';
				if($selected == $row->id)
					$subcat_dropdown .= 'selected' ;
				$subcat_dropdown .= '>'.$var.' '.$row->title.'</option>';
				$subcat_dropdown .= $this->get_all_subcategory_on_bannerad($row->id,$level,$selected,$table,$where_clause);
			}

		}
		//echo $this->db->last_query();
		return $subcat_dropdown; 
	}


	public function get_state_list($country_id, $state_id)
	{
		$where_clause = "country_id = '".$country_id."' AND status='Y'";
		$query_state = $this->common_model->get_all_records(STATE,$where_clause,'order_id','ASC',"","");
		
			$state_div = 	'<select name="state" id="state" style="width:210px;" onchange="getCountyList('.$country_id.',this.value);getCityList('.$country_id.',this.value);"><option value="">-Select State</option>';
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
		
		
			$county_div = 	'<select name="county" id="county" style="width:210px;" onchange="getCityList('.$country_id.','.$state_id.',this.value);"><option value="">-Select County</option>';						if ($query_county->num_rows() > 0){
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
			$city_div = 	'<select name="city" id="city" style="width:210px;" onchange="javascript: showSlotDiv();"><option value="">-Select City</option>';						
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

	

	public function getAllCAtEvent($cat_id) {
			$this->db->order_by("E.id","desc");
			$this->db->where("C1.cat_id = '".$cat_id."' AND E.status = 'A' AND E.feature_status = 'Y'");
			$this->db->select('E.*,C1.cat_id');
			$this->db->from(EVENT.' AS E INNER JOIN '.EVENT_CAT_REL.' AS C1 ON E.id=C1.event_id INNER JOIN '.CATEGORY.' AS C2 ON C1.cat_id=C2.id');
			$query = $this->db->get();  //echo $this->db->last_query();
			return $query; 

		} // end of getallrecords

		public function getAllCityEvent($city_id) {
			$this->db->order_by("E.id","desc");
			$this->db->where("E.city_id = '".$city_id."' AND E.status = 'A' AND E.feature_status = 'Y'");
			$this->db->select('E.*');
			$this->db->from(EVENT.' AS E INNER JOIN '.CITY.' AS C ON E.city_id=C.id');
			$query = $this->db->get();  //echo $this->db->last_query();
			return $query; 

		} // end of getallrecords


		public function adv_date_available($table,$where_clause, $orderby) {
			$this->db->order_by("exp_date",$orderby);
			$this->db->limit("1","0");
			if($where_clause!='')
			$this->db->where($where_clause);
			$this->db->select('*');
			$this->db->from($table);
			$query = $this->db->get();//echo $this->db->last_query();exit;
			return $query; 
		} // end of adv_date_available
	
	
} // end of class