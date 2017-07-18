<?php
class Location_model extends CI_Model {

	public function __construct() {

		parent::__construct();
	}
	
	public function get_all_city($where_clause, $order_by_fld, $order_by,$offset,$limit) {
		$this->db->order_by($order_by_fld,$order_by);
		$this->db->limit($limit,$offset);
		
		if($where_clause != '')
			$this->db->where($where_clause);
		$this->db->select('C.*, S.name As state,CO.printable_name As country',false);
		$this->db->from(CITY.' AS C LEFT JOIN '.STATE.' AS S ON C.stateId=S.id LEFT JOIN '.COUNTRY.' AS CO  ON C.countryId =CO.id');
		$query = $this->db->get();  
		//echo $this->db->last_query();
		return $query; 

	} // end of getallrecords
	
	public function get_all_county($where_clause, $order_by_fld, $order_by,$offset,$limit) {
		$this->db->order_by($order_by_fld,$order_by);
		$this->db->limit($limit,$offset);
		
		if($where_clause != '')
			$this->db->where($where_clause);
		$this->db->select('C.*, S.printable_name As state,CO.printable_name As country',false);
		$this->db->from(COUNTY.' AS C LEFT JOIN '.STATE.' AS S ON C.stateId=S.id LEFT JOIN '.COUNTRY.' AS CO  ON C.countryId =CO.id');
		$query = $this->db->get();  
		//echo $this->db->last_query();
		return $query; 

	} // end of getallrecords

	public function get_all_zip($where_clause, $order_by_fld, $order_by,$offset,$limit) {
		$this->db->order_by($order_by_fld,$order_by);
		$this->db->limit($limit,$offset);
		
		if($where_clause != '')
			$this->db->where($where_clause);
		$this->db->select('Z.*, C.city_name, S.name As state, CO.country_nm As country',false);
		$this->db->from(ZIP.' AS Z LEFT JOIN '.CITY.' AS C ON Z.city_id=C.id LEFT JOIN '.STATE.' AS S ON Z.state_id=S.id LEFT JOIN '.COUNTRY.' AS CO  ON Z.country_id =CO.id');
		$query = $this->db->get();  
		//echo $this->db->last_query();
		return $query; 

	} // end of getallrecords

	public function get_all_state($where_clause, $order_by_fld, $order_by,$offset,$limit) {
		$this->db->order_by($order_by_fld,$order_by);
		$this->db->limit($limit,$offset);
		
		if($where_clause != '')
			$this->db->where($where_clause);
		$this->db->select('S.*, C.printable_name As country',false);
		$this->db->from(STATE.' AS S LEFT JOIN '.COUNTRY.' AS C ON S.countryId =C.id');
		$query = $this->db->get();  
		//echo $this->db->last_query();
		return $query; 

	} // end of getallrecords
	
	
	public function getstate($table_name) {
		$this->db->order_by("a.order_id, b.printable_name");
		$this->db->where("a.status = 'Y'");
		$this->db->select('a.order_id AS country_order_id, a.printable_name as country_name, b . *');
		$this->db->from(COUNTRY.' a');
		//$this->db->from($table_name.' SD');
		$this->db->join($table_name.' b','a.id = b.countryId','LEFT');
		$query = $this->db->get(); 
		//$row = $query->row_array(); 
		//echo $this->db->last_query();
		return $query;
		//$tot_rec = $query->num_rows();
		//return $tot_rec;
		/*return array(
		'row' => $row,
		'tot_rec' => $tot_rec
		);*/
	}

	function add_new_country($country)
	{
		if($country !='')
		{
			$country_query = $this->common_model->Retrive_Record_By_Where_Clause(COUNTRY,"printable_name = '".$country."'");
			if(!$country_query)
			{
				$rowC['printable_name'] = $country;
				$slug = $country;
				$slug = str_replace("'", "", $slug);
				$slug = str_replace("&", "and", $slug);
				$pattern = array(' - ',' ','/','-');
				$replacement = '-';
				$slug = strtolower(str_replace($pattern, $replacement, $slug));
				$rowC['slug'] = $slug;

				$countryId = $this->common_model->addRecord(COUNTRY,$rowC);
				$rowC_up['order_id'] = $countryId;
				$this->common_model->Update_Record($rowC_up,COUNTRY,$countryId);
			}
			else{
				$countryId = $country_query['id'];
			}
		}
		else{
			$countryId = '';
		}

		return $countryId; 
	}


////////////////////////////////////state////////////////////////////////
	function add_new_state($state, $countryId)
	{
		if($state !='')
		{
			$state_query = $this->common_model->Retrive_Record_By_Where_Clause(STATE,"printable_name = '".$state."' AND countryId = '".$countryId."'");
			if(!$state_query)
			{
				$rowS['printable_name'] = $state;
				$rowS['countryId'] = $countryId;
				$slug = $state;
				$slug = str_replace("'", "", $slug);
				$slug = str_replace("&", "and", $slug);
				$pattern = array(' - ',' ','/','-');
				$replacement = '-';
				$slug = strtolower(str_replace($pattern, $replacement, $slug));
				$rowS['slug'] = $slug;
				$stateId = $this->common_model->addRecord(STATE,$rowS);
			}
			else{
				$stateId = $state_query['id'];
			}
		}
		else
			$stateId = '';

		return $stateId; 
	}


///////////////////////////////////county/////////////////////////////////////

	function add_new_county($county, $countryId, $stateId)
	{
		if($county != '')
		{
			$county_query = $this->common_model->Retrive_Record_By_Where_Clause(COUNTY,"county_name = '".$county."' AND countryId = '".$countryId."' AND stateId = '".$stateId."'");
			if(!$county_query)
			{
				$rowCO['county_name'] = $county;
				$rowCO['countryId'] = $countryId;
				$rowCO['stateId'] = $stateId;

				$slug = $county;
				$slug = str_replace("'", "", $slug);
				$slug = str_replace("&", "and", $slug);
				$pattern = array(' - ',' ','/','-');
				$replacement = '-';
				$slug = strtolower(str_replace($pattern, $replacement, $slug));
				$rowCO['slug'] = $slug;
				$county_id = $this->common_model->addRecord(COUNTY,$rowCO);
			}
			else{
				$county_id = $county_query['id'];
			}
		}
		else
			$county_id = '';

		return $county_id; 
	}

///////////////////////////////////////////city///////////////////////////////

	function add_new_city($city, $countryId, $stateId, $county_id)
	{
		if($city !='')
		{
			$city_query = $this->common_model->Retrive_Record_By_Where_Clause(CITY,"city_name = '".$city."' AND countryId = '".$countryId."' AND stateId = '".$stateId."'");
			if(!$city_query)
			{
				$rowCI['city_name'] = $city;
				$rowCI['countryId'] = $countryId;
				$rowCI['stateId'] = $stateId;
				$rowCI['county_id'] = $county_id;

				$slug = $city;
				$slug = str_replace("'", "", $slug);
				$slug = str_replace("&", "and", $slug);
				$pattern = array(' - ',' ','/','-');
				$replacement = '-';
				$slug = strtolower(str_replace($pattern, $replacement, $slug));
				$rowCI['slug'] = $slug;
				$city_id = $this->common_model->addRecord(CITY,$rowCI);
			}
			else{
				$city_id = $city_query['id'];
			}
		}
		else
			$city_id = '';

		return $city_id;
	}

	function add_new_zip($zip, $countryId, $stateId, $county_id, $city_id)
	{
		if($zip !='')
		{
			$zip_query = $this->common_model->Retrive_Record_By_Where_Clause(ZIP,"zip_code = '".$zip."' AND countryId = '".$countryId."' AND stateId = '".$stateId."' AND city_id = '".$city_id."'");
			if(!$zip_query)
			{
				$rowZ['zip_code'] = $zip;
				$rowZ['countryId'] = $countryId;
				$rowZ['stateId'] = $stateId;
				$rowZ['county_id'] = $county_id;
				$rowZ['city_id'] = $city_id;
				$zip_id = $this->common_model->addRecord(ZIP,$rowZ);
			}
			else{
				$zip_id = $zip_query['id'];
			}
		}
		else
			$zip_id = '';

		return $zip_id;
	}



	public function show_country_list($q)
	{
		$con_list = '';
		if(!$q) return;
		$country_list = $this->common_model->get_all_records(COUNTRY,"printable_name LIKE '%$q%' AND status = 'Y'","id","ASC","","");
			if($country_list->num_rows() > 0){
				$i = 0;
				foreach($country_list->result() as $row_country){
					$i++;
					$cname = stripslashes($row_country->printable_name);
					$con_list .= "$cname\n";
				}
			}
			else
			{
				$con_list = "No Country Found";
			}

			return $con_list;
	
	}	// end ofchange_is_active


	public function show_state_list($q, $country)
	{
		$st_list = '';
		$countryId = $this->common_model->Retrive_Record_By_Where_Clause(COUNTRY,"printable_name = '".$country."' AND status = 'Y'");
		if(!$q) return;
		$state_list = $this->common_model->get_all_records(STATE,"printable_name LIKE '%$q%' AND countryId = '".$countryId['id']."' AND status = 'Y'","id","ASC","","");
			if($state_list->num_rows() > 0){
				$i = 0;
				foreach($state_list->result() as $row_state){
					$i++;
					$sname = stripslashes($row_state->printable_name);
					$st_list .= "$sname\n";
				}
			}
			else
			{
				$st_list = "No State Found";
			}
			return $st_list;
	}
	public function show_county_list($q, $country, $state)
	{
		$cou_list = '';
		$countryId = $this->common_model->Retrive_Record_By_Where_Clause(COUNTRY,"printable_name = '".$country."' AND status = 'Y'");
		$stateId = $this->common_model->Retrive_Record_By_Where_Clause(STATE,"printable_name = '".$state."' AND status = 'Y'");
		if(!$q) return;
		$county_list = $this->common_model->get_all_records(COUNTY,"county_name LIKE '%$q%' AND countryId = '".$countryId['id']."' AND stateId = '".$stateId['id']."' AND status = 'Y'","id","ASC","","");
			if($county_list->num_rows() > 0){
				$i = 0;
				foreach($county_list->result() as $row_county){
					$i++;
					$cname = stripslashes($row_county->county_name);
					$cou_list .= "$cname\n";
				}
			}
			else
			{
				$cou_list = "No County Found";
			}

			return $cou_list;
	}
	public function show_city_list($q, $country, $state, $county)
	{
		$ci_list = '';
		$countryId = $this->common_model->Retrive_Record_By_Where_Clause(COUNTRY,"printable_name = '".$country."' AND status = 'Y'");
		$stateId = $this->common_model->Retrive_Record_By_Where_Clause(STATE,"printable_name = '".$state."' AND status = 'Y'");
		if($county!='')
		{
			$county_id = $this->common_model->Retrive_Record_By_Where_Clause(COUNTY,"county_name = '".$county."' AND status = 'Y'");
			$where_clause = " AND county_id = '".$county_id['id']."'";
		}
		if(!$q) return;
		$city_list = $this->common_model->get_all_records(CITY,"city_name LIKE '%$q%' AND countryId = '".$countryId['id']."'  AND stateId = '".$stateId['id']."' ".$where_clause." AND status = 'Y'","id","ASC","","");
			if($city_list->num_rows() > 0){
				$i = 0;
				foreach($city_list->result() as $row_city){
					$i++;
					$cname = stripslashes($row_city->city_name);
					$ci_list .= "$cname\n";
				}
			}
			else
			{
				$ci_list = "No City Found";
			}

			return $ci_list;
	}
	public function show_zip_list($q, $country, $state, $county, $city)
	{
		$z_list = '';
		$countryId = $this->common_model->Retrive_Record_By_Where_Clause(COUNTRY,"printable_name = '".$country."' AND status = 'Y'");
		$stateId = $this->common_model->Retrive_Record_By_Where_Clause(STATE,"printable_name = '".$state."' AND status = 'Y'");
		if($county!='')
		{
			$county_id = $this->common_model->Retrive_Record_By_Where_Clause(COUNTY,"county_name = '".$county."' AND status = 'Y'");
			$where_clause = " AND county_id = '".$county_id['id']."'";
		}
		$city_id = $this->common_model->Retrive_Record_By_Where_Clause(CITY,"city_name = '".$city."' AND status = 'Y'");
		if(!$q) return;
		$zip_list = $this->common_model->get_all_records(ZIP,"zip_code LIKE '%$q%' AND countryId = '".$countryId['id']."'  AND stateId = '".$stateId['id']."' ".$where_clause." AND city_id = '".$city_id['id']."' AND status = 'Y'","id","ASC","","");
			if($zip_list->num_rows() > 0){
				$i = 0;
				foreach($zip_list->result() as $row_zip){
					$i++;
					$cname = stripslashes($row_zip->zip_code);
					$z_list .= "$cname\n";
				}
			}
			else
			{
				$z_list = "No Zip Found";
			}
			return $z_list;
	}
	
}
//end of class
?>