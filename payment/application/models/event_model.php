<?php
class Event_model extends CI_Model {

	public function __construct() {
	
		parent::__construct();
	}

	

	public function get_all_category($selected,$where_clause,$table) {
		$level = 0;
		$this->db->order_by("order_id","ASC");
		$where_clause_2 = "parent_id ='0'".$where_clause;
		$this->db->where($where_clause_2);
		$this->db->select("*");
		$this->db->from($table);
		$query = $this->db->get();
		$selected_ids = substr($selected,0,-1);
		$selected_ids_arr = explode(",",$selected_ids);
		$cat_dropdown = '<select name="category_title" id="category_title" style="width:210px;height:70px;font-weight:normal" multiple onchange="javascript: addCatId();seo_fld();">';
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{ 
				$cat_dropdown .= '<option value="'.$row->id.'" style="font-weight:bold;font-size:12px"';
				if(in_array($row->id,$selected_ids_arr))
					$cat_dropdown .= 'selected' ;

				$cat_dropdown .= '>'.$row->title.'</option>';
				$cat_dropdown .= $this->get_all_subcategory($row->id,$level,$selected_ids_arr,$table,$where_clause);
			}

		}
		$cat_dropdown .= '</select>';
		
		//echo $cat_dropdown; 		
		//exit;
		//echo $this->db->last_query();
		return $cat_dropdown; 
	}

	public function get_all_subcategory($id,$level,$selected_ids_arr,$table,$where_clause) {
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
				if(in_array($row->id,$selected_ids_arr))
					$subcat_dropdown .= 'selected' ;
				$subcat_dropdown .= '>'.$var.' '.$row->title.'</option>';
				$subcat_dropdown .= $this->get_all_subcategory($row->id,$level,$selected_ids_arr,$table,$where_clause);
			}

		}
		//echo $this->db->last_query();
		return $subcat_dropdown; 
	}

	
	
	public function get_cat_name($event_id)
	{
		$this->db->order_by("E.id","desc");
		$where_clause = "E.event_id = '".$event_id."'";
		$this->db->where($where_clause);
		$this->db->select('E.*,C.title');
		$this->db->from(EVENT_CAT_REL.' AS E INNER JOIN '.CATEGORY.' AS C ON E.cat_id=C.id');
		$query = $this->db->get();
		$cat_name = '';
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{ 
				$cat_name = $row->title.', '.$cat_name;
			}
			$cat_name = substr($cat_name,0,-2);
		}
		else
			$cat_name = 'N/A';
		return $cat_name; 
	}


	public function get_state_list($country_id, $state_id)
	{
		$where_clause = "country_id = '".$country_id."' AND status='Y'";
		$query_state = $this->common_model->get_all_records(STATE,$where_clause,'order_id','ASC',"","");
		
			$state_div = 	'<select name="state" id="state" style="width:210px;" onchange="getCountyList('.$country_id.',this.value);getCityList('.$country_id.',this.value);seo_fld();getZipList('.$country_id.',this.value);"><option value="">-Select State</option>';
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
		
		
			$county_div = 	'<select name="county" id="county" style="width:210px;" onchange="getCityList('.$country_id.','.$state_id.',this.value);getZipList('.$country_id.','.$state_id.',this.value);seo_fld();"><option value="">-Select County</option>';			
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
			$city_div = 	'<select name="city" id="city" style="width:210px;" onchange="javascript: getZipList('.$country_id.','.$state_id.',\''.$county_id.'\',this.value);seo_fld();"><option value="">-Select City</option>';						
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
			$zip_div = 	'<select name="zip_code" id="zip_code" style="width:210px;" onchange="javascript: seo_fld();"><option value="">-Select Zip</option>';						
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

	public function get_all_events($city, $cat, $where_clause_1, $offset, $limit)
	{
		$this->db->limit($limit,$offset);
		$this->db->order_by("E.id","ASC");
		$where_clause = "E.status = 'A' AND E.city_id ='".$city."'";
		if($where_clause_1 !='')
			$where_clause .= " AND ".$where_clause_1;

		if($cat !='')
			 $where_clause .= " AND C.slug = '".$this->session->userdata('CAT_SLUG')."'";
		else
			 $where_clause .= " AND C.slug = 'tonight'";

		$this->db->where($where_clause);
		$this->db->select("E.*,C.title AS cat_name");
		$this->db->from(EVENT.' AS E INNER JOIN '.EVENT_CAT_REL.' AS CR ON E.id = CR.event_id INNER JOIN '.CATEGORY.' AS C ON CR.cat_id = C.id');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query;		
	}

	public function countAllEvent($city, $cat, $where_clause_1) {
		$this->db->order_by("E.id","ASC");
		$where_clause = "E.status = 'A' AND E.city_id ='".$city."'";
		if($where_clause_1 !='')
			$where_clause .= "AND ".$where_clause_1;
		if($cat !='')
			 $where_clause .= " AND C.slug = '".$this->session->userdata('CAT_SLUG')."'";
		else
			 $where_clause .= " AND C.slug = 'tonight'";

		$this->db->where($where_clause);
		$this->db->select("E.*,C.title AS cat_name");
		$this->db->from(EVENT.' AS E INNER JOIN '.EVENT_CAT_REL.' AS CR ON E.id = CR.event_id INNER JOIN '.CATEGORY.' AS C ON CR.cat_id = C.id');
		$query = $this->db->get();
		$tot_rec = $query->num_rows();
		return $tot_rec;
	} // end of countAll


	public function get_all_this_week_events($city, $cat,$today,$week_last_date, $offset, $limit)
	{
		$e_id = '0';
		$no = 0;
			$thisweek_event = $this->common_model->get_all_records(EVENT, "status ='A' AND event_date >= '".date('Y-m-d')."' AND event_date <= '".date('Y-m-d',$week_last_date)."' AND city_id='".$city."'","id","ASC","","");	
			if($thisweek_event->num_rows() > 0){
			foreach($thisweek_event->result() as $rowE){
				$e_id .= ','.$rowE->id;
				$no++;
			}}
			$thisweek_rec_event = $this->common_model->get_all_records(EVENT, "status ='A' AND recurring_event = 'Y' AND city_id='".$city."'","id","ASC","","");
			if($thisweek_rec_event->num_rows() > 0){
			foreach($thisweek_rec_event->result() as $rowE){
				$thisweek_rec_event_date = $this->common_model->Retrive_Record_By_Where_Clause(EVENT_RECURRING, "event_date >= '".date('Y-m-d')."' AND event_date <= '".date('Y-m-d',$week_last_date)."' AND event_id = '".$rowE->id."'","id","ASC","","");
				if($thisweek_rec_event_date){
					$e_id .= ','.$thisweek_rec_event_date['event_id'];
					$no++;
				}
			}}
			//$e_id = "E.id IN($e_id)";

		$event_query = $this->common_model->get_all_records(EVENT, "id IN($e_id)","id","ASC",$offset,$limit);
		//echo $this->db->last_query();
		return $event_query;
	}

	public function get_all_this_weekend_events($city, $cat,$weekend_satday,$weekend_sunday, $offset, $limit)
	{
		$e_id = '0';
			$weekend_event = $this->common_model->get_all_records(EVENT, "status ='A' AND (event_date = '".$weekend_satday."' OR event_date = '".$weekend_sunday."') AND city_id='".$city."'","id","ASC","","");	
			if($weekend_event->num_rows() > 0){
			foreach($weekend_event->result() as $rowE){
				$e_id .= ','.$rowE->id;
			}}
			$weekend_rec_event = $this->common_model->get_all_records(EVENT, "status ='A' AND recurring_event = 'Y' AND city_id='".$city."'","id","ASC","","");
			if($weekend_rec_event->num_rows() > 0){
			foreach($weekend_rec_event->result() as $rowE){
				$weekend_rec_event_date = $this->common_model->Retrive_Record_By_Where_Clause(EVENT_RECURRING, "(event_date = '".$weekend_satday."' OR event_date = '".$weekend_sunday."') AND event_id = '".$rowE->id."'","id","ASC","","");
				if($weekend_rec_event_date)
					$e_id .= ','.$weekend_rec_event_date['event_id'];
			}}
			//$e_id = "E.id IN($e_id)";

		$event_query = $this->common_model->get_all_records(EVENT, "id IN($e_id)","id","ASC",$offset,$limit);
		//echo $this->db->last_query();
		return $event_query;
	}

	public function get_all_next_thirtyday_events($city, $cat, $today, $offset, $limit)
	{

		$thirtyday_value = $today + 30*(24 * 60 * 60);
		$today = date('Y-m-d');
		$thirtyday_date = date('Y-m-d', $thirtyday_value);
		
		$e_id = '0';
		$count = 0;
		$all_event_query = $this->common_model->get_all_records(EVENT, "status = 'A'  AND city_id ='".$city."'","id","ASC","","");
		if($all_event_query->num_rows() > 0){
			foreach($all_event_query->result() as $rowE){
				if($rowE->event_date >= $today && $rowE->event_date <= $thirtyday_date)
				{
					$e_id .= ','.$rowE->id;
				}
				else
				{
						$all_rec_event_query = $this->common_model->get_all_records(EVENT_RECURRING, "event_id ='".$rowE->id."' AND event_date >= '".$today."' && event_date <= '".$thirtyday_date."'","id","ASC","","");
						if($all_rec_event_query->num_rows > 0)
						{
							$e_id .= ','.$rowE->id;
						}

				}

			
			}
		}
		$event_query = $this->common_model->get_all_records(EVENT, "id IN($e_id)","id","ASC",$offset,$limit);

		//$event_query = $this->db->get();
		//echo $this->db->last_query();
		return $event_query;		
	}


	
	
} // end of class