<?php
class Common_model extends CI_Model {

	public function __construct() {

		parent::__construct();
	}
	
	public function countAll($table_name,$where_clause) {
		if($where_clause != '')
		$this->db->where($where_clause);
		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get();  
		$tot_rec = $query->num_rows();
		//echo $this->db->last_query();
		return $tot_rec;
	} // end of countAll
	
	public function GetAll($table_name){
		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get(); 
		return $query;
	}
	
	
	public function countEmp($table_name) {
		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get();  
		$tot_rec = $query->num_rows();
		//echo $this->db->last_query();
		return $tot_rec;
	} // end of countAll
	
		public function countrow($table_name) {
		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get();  
		$tot_rec = $query->num_rows();
		//echo $this->db->last_query();
		return $tot_rec;
	} // end of countAll


	public function delfn($table_name, $id){
		$this->db->where('id', $id);
		$this->db->delete($table_name);
	}
	public function get_all_records($table_name, $where_clause,$order_by_fld,$order_by,$offset,$limit) {
		$this->db->order_by($order_by_fld,$order_by);
		$this->db->limit($limit,$offset);
		if($where_clause!='')
		$this->db->where($where_clause);
		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query; 

	} // end of get_all_records

	public function Retrive_Record_Column($table,$id,$column_name) {
		$this->db->where($column_name." = '".addslashes($id)."'");
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();  
		return $query; 

	}

	public function Retrive_record_by_slug($table,$slug) {
		$sql = "SELECT * FROM ".$table." WHERE slug='".addslashes($slug)."'" ;
		$query = $this->db->query($sql);
		$row = $query->row_array(); 
		//echo $this->db->last_query();
		return $row;
	} 

	public function Retrive_Record_By_Where_Clause($table,$where_clause) {
		$this->db->select('*');
		$this->db->from($table);
		if(!empty($where_clause))
		$this->db->where($where_clause);
		$query = $this->db->get();
		$row = $query->row_array();
		return $row;
		//$row = $query->row_array();
		//echo $this->db->last_query();
		//print_r($query);
		return $query;
		//echo $query->num_rows;
	}

	public function Retrive_Record_By_Where_Clause1($table,$where_clause) {
		$this->db->select('*');
		$this->db->from($table);
		if(!empty($where_clause))
		$this->db->where($where_clause);
		$query = $this->db->get();
		$row = $query->row_array();
		return $row;
		//$row = $query->row_array();
		//echo $this->db->last_query();
		//print_r($query);
		//return $query;
		//echo $query->num_rows;
	}
	
	public function Retrive_Record_By_Where_Clause2($table,$where_clause) {
		$this->db->select('*');
		$this->db->from($table);
		if(!empty($where_clause))
		$this->db->where($where_clause);
		$query = $this->db->get();
		return $query;
		//$row = $query->row_array();
		//echo $this->db->last_query();
		//print_r($query);
		//return $query;
		//echo $query->num_rows;
	}
	
	public function get_all_records_cms($table_name, $where_clause,$order_by_fld,$order_by,$offset,$limit) {
		$this->db->order_by($order_by_fld,$order_by);
		$this->db->limit($limit,$offset);
		if($where_clause!='')
		$this->db->where($where_clause);
		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get();  
		return $query; 

	} // end of get_all_records
	public function getallrecords($table_name) {
		$this->db->order_by("id","desc");
		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get();  
		return $query; 

	} // end of getallrecords
	
		public function getNewsComment($table_name,$id) {
		$this->db->order_by("id","desc");
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where('news_id',$id);
		$query = $this->db->get();  
		return $query; 

	} // end of getallrecords

	
	public function gettestimonial($table_name) {
		$this->db->select_max('id');
		$query = $this->db->get($table_name);
		$row = $query->row();
		$max_id = $row->id;
		//echo $max_id; 
		//print_r($query);
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where('id',$max_id);
		$query = $this->db->get();
		  
		return $query; 

	} // end of getallrecords

	
	public function getallrecords1($table_name) {
		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get();  
		return $query; 

	} // end of getallrecords
	
	
	public function getallrecords_orderedby($table_name,$orderd_by) {
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->order_by($orderd_by,"ASC");
		$query = $this->db->get();  
		return $query; 

	} // end of getallrecords
	
	public function get_job($table_name) {
		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query; 

	} // end of get_all_records
	
	public function get_jobs($table_name,$id) {
			
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where('id',$id);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query; 

	} // end of get_all_records
	
	public function delete_job($table_name,$id) {
			
		$this->db->where('id', $id);
		$this->db->delete($table_name);	
	} // end of get_all_records

	
	public function getnews($table_name) {
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->order_by("id","desc");
		$this->db->limit('7');


		$query = $this->db->get(); 
		return $query; 

	} // end of getallrecords

	public function getrecord($table_name,$where_clause) {
		$this->db->order_by("countryId","desc");
		$this->db->where("countryId = '$id'");
		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get(); 
		$row   = $query->result();
		return $row; 

	} // end of getallrecords

	/*
	Name: Add_Record
	Purpose: This function will insert record in a table
	Parameter: row, table
	return: insert id
	*/
	function Add_Record($row,$table) {
		$str = $this->db->insert_string($table, $row);        
		$query = $this->db->query($str);    
		$insertid = $this->db->insert_id();
		//echo $this->db->last_query(); exit;
		return $insertid;
	
	}	// end of Add_Record
	
	
	function insert_record($table,$row) {
		
		$this->db->insert($table, $row); 
		   
		$insertid = $this->db->insert_id();
		//echo $this->db->last_query(); exit;
		return $insertid;
	
	}	// end of Add_Record
	
	function insert($table,$row) {
		
		$this->db->insert($table, $row); 
		   
		    return 1;
			
	
	}	// end of Add_Record

	
	
	/*
	Name: Update_Record
	Purpose: This function will update record in a table
	Parameter: row, table, id
	return: null
	*/
	function subscription($row,$table,$email) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('email', $email);
		$query = $this->db->get();

		//$query = $this->db->get_where($table, array('email' => $email));
		if($query->num_rows() > 0)
		{
			return 2;
		}
		else
		{
		    $this->db->insert($table, $row);
		    return 1;
			
		}
		
	
	}	// end of Add_Record
	
	function forget_pass($row,$table,$email) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('email', $email);
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			
			return 1;
		}
		else
		{
		    return 2;
			
		}
	}	// end of Add_Record
	

	function loginCheck($table,$email) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('email', $email);
		$query = $this->db->get();
			
		return $query;
	}	
	
	
	function Update_Record($row,$table,$id)
	{
		$this->db->where('id', $id);
		$flag = $this->db->update($table, $row);
		return $flag;
		//echo $this->db->last_query(); exit;
	}	
	function Update_Record_byField($row,$table,$id,$columnName)
	{
		$this->db->where($columnName, $id);
		$flag = $this->db->update($table, $row);
		return $flag;
		//echo $this->db->last_query(); exit;
	}
	
	
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
		/*$sql = "SELECT * FROM ".$table." WHERE id='".addslashes($id)."'" ;
		$query = $this->db->query($sql);
		$row = $query->row_array(); 
		return $row;*/
	} 
	
		/*
		Name: get_all_country
		Purpose : This function will show all country.
		Parameter : sel_country_id 
		return : Dropdown with all country
	*/
	
	function get_all_country() {
		
		$orderby_field = "printable_name";    
		$orderby = "ASC";
		$this->db->select("*");
		$this->db->from(COUNTRY);
		$this->db->order_by($orderby_field,$orderby);		
		$query = $this->db->get(); 
		//echo $this->db->last_query(); 
		return $query;
	
	}  // end of get_all_country
	

	function getAllSocialmediaRecords() {
		$orderby_field = "order_id";    
		$orderby = "ASC";
		$where = "status = 'Y'";
		$this->db->select('*');
		$this->db->from(SOCIALMEDIA);
		$this->db->where($where);
		$this->db->order_by($orderby_field,$orderby);		
		$query = $this->db->get(); 
		//echo $this->db->last_query(); 
		return $query; 
	} // end of getAllRecords

	function dispbanner(){
		$orderby_field = "order";    
		$orderby = "ASC";
		$this->db->select("*");
		$this->db->where("is_active = '1'");
		$this->db->from(HOMEPAGEBANNER);
		$this->db->order_by($orderby_field,$orderby);		
		$query = $this->db->get();
		//echo $this->db->last_query(); 
		$result=$query->result();
		foreach($result as $row_homepagebanner){
			
			$target = "_parent";
			if($row_homepagebanner->open_option == '2') $target = "_blank";
			echo anchor($row_homepagebanner->link_url,img(array("src"=>FLD_HOMEPAGEBANNER.$row_homepagebanner->banner,"height"=>"338px", "width"=>"947px", "alt"=>$row_homepagebanner->alt_tag, "border"=>"0")),array("target"=>$target, "title"=>$row_homepagebanner->title_tag));

		}
	}
	function dispevents(){
		$orderby_field = "order";    
		$orderby = "ASC";
		//$this->db->select("*");
		$this->db->where("is_active = '1' and event_dt > CURDATE()");
		//$this->db->from();
		$this->db->order_by($orderby_field,$orderby);		
		$query = $this->db->get(EVENTSCHEDULE,3);
		//echo $this->db->last_query(); 
		$result=$query->result();
		
		//print_r($event_dt);

		$str="<ul>";
		foreach($result as $row_event){
			$event_dt= explode("/",date("d/M/Y",strtotime($row_event->event_dt))); 
			$description = strip_tags($row_event->description);
			if(strlen($description)>100) $description = substr($description,0,100)."...";
			$slug = $row_event->slug;
			$str .= "<li><div class=\"date\"><span> ".$event_dt[0]."</span><br />

                      ".$event_dt[1]." <br />

                     ".$event_dt[2]."</div>

                    <div class=\"event-content\">

					<p><a href='".site_url("events/$slug")."' style='text-decoration:none;'><strong>".$row_event->title."</strong></a></p>

					<p>".$description."</p>

					</div>

                  </li>";

		}
		$str .= "</ul>";
		echo $str;
	}
	
	function disptestimonials(){
		$orderby_field = "order";    
		$orderby = "ASC";
		//$this->db->select("*");
		$this->db->where("is_active = '1'");
		//$this->db->from();
		$this->db->order_by($orderby_field,$orderby);		
		$query = $this->db->get(TESTIMONIAL,2);
		//echo $this->db->last_query(); 
		$result=$query->result();
		
		//print_r($event_dt);

		$str="";
		foreach($result as $row_testimonial){
			$description = strip_tags($row_testimonial->testi_desc);
			if(strlen($description)>200) $description = substr($description,0,200)."...";
			$slug = $row_testimonial->slug;

			$str .= "<div class=\"events-bg\">
					 <p class=\"author\">".$row_testimonial->testi_title."</p>
					 <p class=\"testimonials\" style=\"margin-top:5px;\">".$description."</p>
					 <p class=\"author\">- ".$row_testimonial->from."</p>
					 <a href='".site_url("testimonials/$slug")."' class=\"testi_readmore\">Read more...</a>			  
					 </div>";	  

		}
		echo $str;
	}

	function addRecord($table,$row) {
	
		if(is_array($row)) {
			foreach($row as $key=>$val) {
				$row[$key] = $val;
			}
		}
		
		$str = $this->db->insert($table, $row);   
		//echo $this->db->last_query();
		$insertid = $this->db->insert_id();
		//exit;
		return $insertid;
	
	}	
	

	function showOrderIcon($table,$id) {
			// retrive MAX and MIN banner_order 
			$query_order = "SELECT min(`menu_order`) as `min_order`,max(`menu_order`) as `max_order` FROM ".$table." WHERE 1";
			$rs_order = $this->db->query($query_order);
			$row_order = $rs_order->row_array(); 
			$min_order = $row_order['min_order'];
			$max_order = $row_order['max_order'];
			
			// retrive indivisual banner_order
			$query_order = "SELECT `menu_order` FROM ".$table." WHERE `id` ='{$id}'";
			$rs_order    = $this->db->query($query_order);
			$row_order   =  $rs_order->row_array(); 
			$order = $row_order['menu_order'];
			if($order==$max_order){
				$link="<img src='".base_url()."images/admin/priority_up.png' border='0' onclick=\"javascript:change_order('{$id}','decrease_order');\" style='cursor:pointer;' title='Increase Order' alt='Down'>";
			} else if($order==$min_order){
				$link="<img src='".base_url()."images/admin/priority_down.png' border='0' onclick=\"javascript:change_order('{$id}','increase_order');\" style='cursor:pointer;' title='Decrease Order' alt='Up'>";
			} else {
				$link="<img src='".base_url()."images/admin/priority_up.png' border='0' onclick=\"javascript:change_order('{$id}','decrease_order');\" style='cursor:pointer;' title='Increase Order' alt='Up'>&nbsp;&nbsp;<img src='".base_url()."images/admin/priority_down.png' border='0' onclick=\"javascript:change_order('{$id}','increase_order');\" style='cursor:pointer;' title='Decrease Order' alt='Down'>";
			}
			
			return($link);
	}
	
	public function record_change_id($table,$where_clause,$order_by_fld,$order_by,$offset,$limit) {
		$id="";
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
		if($id!=""){
		return $id; }
	}
	
		public function getallsecurityquestions($table_name) {
		$this->db->order_by("order","asc");
		$this->db->select('*');
		$this->db->where("is_active = '1' ");
		$this->db->from($table_name);
		$query = $this->db->get();  
		return $query; 

	} // end of getall security question records
	public function getallsatest($table_name) {
		$this->db->order_by("test_id","desc");
		$this->db->select('*');
		$this->db->where("is_active = '1' ");
		$this->db->from($table_name);
		$query = $this->db->get();  
		return $query; 

	} // end of get all test records
	
	public function getstudentrecord($table_name,$id) {
		$this->db->order_by("U.id","desc");
		$this->db->where("SD.std_id = '$id'");
		$this->db->select('*');
		$this->db->from($table_name.' SD');
		$this->db->join(USER.' U','U.id = SD.std_id','INNER');
		$query = $this->db->get(); 
		$row = $query->row_array(); 
		return $row; 

	} // end of getallrecords
	
	function Update_Usertest_Record($row,$table,$user_id,$test_id,$package_id) {
		$this->db->where(array('usertest_packageid '=>$package_id,'usertest_userid'=>$user_id,'usertest_testid'=>$test_id,'usertest_completed'=>'0'));
		$this->db->update($table, $row);
		//echo $this->db->last_query(); 
	}
	
	function Get_Usertest_Record($user_id,$test_id,$package_id) {
		$sql = "SELECT * FROM ".USERTEST." WHERE usertest_packageid = $package_id and usertest_userid = $user_id and usertest_testid = $test_id and usertest_completed = '0'" ;
		$query = $this->db->query($sql);
		$row = $query->row_array(); 
		return $row;
	} 
	
	function Count_Usertest_Record($user_id,$test_id,$package_id) {
		$sql = "SELECT * FROM ".USERTEST." WHERE usertest_packageid = $package_id and usertest_userid = $user_id and usertest_testid = $test_id and usertest_completed = '0'" ;
		$query = $this->db->query($sql);
		$num_rows = $query->num_rows(); 
		return $num_rows;
	} 
	
	function email_body($socialmedias,$footer_content,$mid_content) {
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Standardized Tests Preparation</title>
		</head>
		
		<body>
			<table width="669" border="0" cellspacing="0" cellpadding="0" align="center" style="margin:0 auto; padding:0 0 10px 0; line-height:0; background-color:#ffffff; border:1px solid #CCCCCC;">
				  <tr>
					 <td align="left" valign="top" style="padding:12px 18px 40px 18px;">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td style=" padding:0; margin:0;" valign="top">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td align="left" valign="top"><img src="'.base_url().'images/newsletter/logo.jpg" alt="" border="0" /></td>
									<td>&nbsp;</td>
									<td align="right" valign="top">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										  <tr>
											<td align="right" height="47" valign="middle" style="font:bold 12px Tahoma; color:#535151; text-transform:uppercase; padding:0 6px 0 0;">
												Follow Us On:
												'.$socialmedias.' 
											</td>
										  </tr>								   
										</table>
									</td>
								  </tr>
								</table>
							</td>
						  </tr>
						  <tr>
							<td align="left" valign="top" height="4"></td>
						  </tr>
						  <tr>
							<td align="left" valign="top"><img src="'.base_url().'images/newsletter/banner.png" alt="" /></td>
						  </tr> 
						  <tr>
							<td align="left" valign="top" style="font:normal 13px/16px Tahoma; color:#535151;">
								'.$mid_content.'
								</td>
						  </tr>
						  <tr><td height="15"></td></tr>
						  <tr>
							<td align="left" valign="top" style="font:normal 13px/16px Tahoma; color:#174179;">
									<strong>Standardized Tests Preparation</strong><br />
								<a href="'.base_url().'" style="color:#174179; text-decoration:none;">www.standardizedtestspreparation.com</a>					
							</td>
		
						  </tr>
						</table>
					 </td>
				  </tr>
				  <tr>
					<td align="center" valign="top">
						<table width="659" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td style=" background:#174179; font:normal 12px Tahoma; color:#fff;" height="45" valign="middle" align="center">
							'.$footer_content.'					</td>
						  </tr>
						</table>
					</td>
				  </tr>
			</table>
		
		</body>
		</html>
		';
		
		return $body;
	} 
	
	function save_feedback($name,$mail,$feed_message)
    {
     //$sql="select * from sff_feedback where feed_email ='".$mail."'"; 
     // $query = $this->db->query($sql);
      $sql_insert="INSERT INTO ".FEEDBACK." SET feed_title ='".$name."',feed_email ='".$mail."',feed_message ='".$feed_message."',feed_date= '".date('Y-m-d')."'";
       $this->db->query($sql_insert);
       return true;
      
    }

	#Decription Function
	public function base64De($num,$val) {
		for($i=0; $i<$num; $i++) {
			$val = base64_decode($val);
		}
		
		return $val;
	}

	#Encryption Function
	public function base64En($num,$val) {
		for($i=0; $i<$num; $i++) {
			$val = base64_encode($val);
		}
		
		Return $val;
	}
	public function getRandomNumber($length)
	{
			
		$random= "";
		$data1 = "";
		srand((double)microtime()*1000000);
		$data1 = "9876549876542156012";
		$data1 .= "0123456789564542313216743132136864313";
		for($i = 0; $i < $length; $i++)
		{
			$random .= substr($data1, (rand()%(strlen($data1))), 1);
		}
		return $random;
	} 

	public function getVerifyNumber($length)
	{		
		$random= "";
		$data1 = "";
		srand((double)microtime()*1000000);
		$data1 = "0123456789";
		$data1 .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		for($i = 0; $i < $length; $i++)
		{
			$random .= substr($data1, (rand()%(strlen($data1))), 1);
		}
		return $random;
	} 

	public function getstate($table_name,$where_clause) {
		$this->db->order_by("a.order_id, b.printable_name");
		if($where_clause!='')
		$this->db->where($where_clause);
		$this->db->where("a.status = 'Y'");
		$this->db->select('a.order_id AS country_order_id, a.printable_name as country_name, b . *');
		$this->db->from(COUNTRY.' a');
		//$this->db->from($table_name.' SD');
		$this->db->join($table_name.' b','a.id = b.country_id','LEFT');
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
	/*public function get_all_records($table_name, $where_clause,$order_by_fld,$order_by,$offset,$limit) {
		$this->db->order_by($order_by_fld,$order_by);
		$this->db->limit($limit,$offset);
		if($where_clause!='')
		$this->db->where($where_clause);
		$this->db->select('*');
		$this->db->from($table_name);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query; 

	}*/
	public function countstate($table_name,$where_clause) {
		$this->db->order_by("a.order_id");
		if($where_clause!='')
		$this->db->where($where_clause);
		//$this->db->where("a.status = 'Y'");
		$this->db->select('a.order_id AS country_order_id, a.printable_name, b . *');
		$this->db->from(COUNTRY.' a');
		//$this->db->from($table_name.' SD');
		$this->db->join($table_name.' b','a.id = b.country_id','LEFT');
		$query = $this->db->get(); 
		$row = $query->row_array(); 
		//echo $this->db->last_query();
		//return $row;
		$tot_rec = $query->num_rows();
		return $tot_rec;
		/*return array(
		'row' => $row,
		'tot_rec' => $tot_rec
		);*/
	}
	public function countstateundercountry($table_name,$where_clause) {
		$this->db->order_by("a.order_id");
		if($where_clause!='')
		$this->db->where($where_clause);
		$this->db->where("a.status = 'Y'");
		$this->db->select('a.order_id AS country_order_id, a.printable_name, b . *');
		$this->db->from(COUNTRY.' a');
		//$this->db->from($table_name.' SD');
		$this->db->join($table_name.' b','a.id = b.country_id','INNER');
		$query = $this->db->get(); 
		$row = $query->row_array(); 
		//echo $this->db->last_query();
		//return $row;
		$tot_rec = $query->num_rows();
		return $tot_rec;
		/*return array(
		'row' => $row,
		'tot_rec' => $tot_rec
		);*/
	}
	
	public function countcityunderstate($where_clause) {
		$this->db->order_by("a.order_id");
		if($where_clause!='')
		$this->db->where($where_clause);
		//$this->db->where("a.status = 'Y'");
		$this->db->select('a.order_id AS country_order_id, a.printable_name, b . *');
		$this->db->from(STATE.' a');
		//$this->db->from($table_name.' SD');
		$this->db->join(CITY.' b','a.id = b.state_id','INNER');
		$query = $this->db->get(); 
		$row = $query->row_array(); 
		//echo $this->db->last_query();
		//return $row;
		$tot_rec = $query->num_rows();
		
		
		
		
		$this->db->order_by("a.order_id");
		if($where_clause!='')
		$this->db->where($where_clause);
		//$this->db->where("a.status = 'Y'");
		$this->db->select('a.order_id AS country_order_id, a.printable_name, b . *');
		$this->db->from(STATE.' a');
		//$this->db->from($table_name.' SD');
		$this->db->join(COUNTY.' b','a.id = b.state_id','INNER');
		$query1 = $this->db->get(); 
		$row1 = $query1->row_array(); 
		//echo $this->db->last_query();
		//return $row;
		$tot_rec1 = $query1->num_rows();
		
		$tot = $tot_rec1 + $tot_rec;
		
		return $tot;
		/*return array(
		'row' => $row,
		'tot_rec' => $tot_rec
		);*/
	}
	public function countcityundercounty($table_name,$where_clause) {
		$this->db->order_by("a.order_id");
		if($where_clause!='')
		$this->db->where($where_clause);
		//$this->db->where("a.status = 'Y'");
		$this->db->select('a.order_id AS country_order_id, a.county_name, b . *');
		$this->db->from(COUNTY.' a');
		//$this->db->from($table_name.' SD');
		$this->db->join($table_name.' b','a.id = b.county_id','INNER');
		$query = $this->db->get(); 
		$row = $query->row_array(); 
		//echo $this->db->last_query();
		//return $row;
		$tot_rec = $query->num_rows();
		return $tot_rec;
		/*return array(
		'row' => $row,
		'tot_rec' => $tot_rec
		);*/
	}
	public function countzipundercity($table_name,$where_clause) {
		$this->db->order_by("a.order_id");
		if($where_clause!='')
		$this->db->where($where_clause);
		//$this->db->where("a.status = 'Y'");
		$this->db->select('a.order_id AS country_order_id, a.city_name, b . *');
		$this->db->from(CITY.' a');
		//$this->db->from($table_name.' SD');
		$this->db->join($table_name.' b','a.id = b.city_id','INNER');
		$query = $this->db->get(); 
		$row = $query->row_array(); 
		//echo $this->db->last_query();
		//return $row;
		$tot_rec = $query->num_rows();
		return $tot_rec;
		/*return array(
		'row' => $row,
		'tot_rec' => $tot_rec
		);*/
	}

	function Update_Record_ColumnName($row,$table,$id,$column) {
		$this->db->where($column, $id);
		$this->db->update($table, $row);
	}
	
	public function Retrive_Education_Record_Column($table,$id,$column_name) {
		$this->db->where('a.'.$column_name." = '".addslashes($id)."'");
		$this->db->select('a.*');
		$this->db->from($table.' a');
		//$this->db->join(STATE.' b','a.state = b.id','LEFT');
		//$this->db->join(COUNTRY.' c','a.country = c.id','LEFT');
		$query = $this->db->get();  
		/*echo $this->db->last_query();
		exit;*/
		return $query; 
	}	
	public function Retrive_Education_Record_Row($table,$id,$column_name) {
		$this->db->where('a.'.$column_name." = '".addslashes($id)."'");
		$this->db->select('a.*,b.name,c.printable_name');
		$this->db->from($table.' a');
		$this->db->join(STATE.' b','a.state = b.id','LEFT');
		$this->db->join(COUNTRY.' c','a.country = c.id','LEFT');
		$query = $this->db->get(); 
		$row = $query->row();
		/*echo $this->db->last_query();
		exit;
		return $query; */
		return $row; 
	}
	public function Retrive_Employer_Record_Row($table,$id,$column_name) {
		$this->db->where('a.'.$column_name." = '".addslashes($id)."'");
		$this->db->select('a.*,b.name,c.printable_name');
		$this->db->from($table.' a');
		$this->db->join(STATE.' b','a.state = b.id','LEFT');
		$this->db->join(COUNTRY.' c','a.country = c.id','LEFT');
		$query = $this->db->get(); 
		$row = $query->row();
		/*echo $this->db->last_query();
		exit;
		return $query; */
		return $row; 
	}
	public function Retrieve_Job_Record_Row($table_name,$id,$column_name)
	{
		$this->db->where('a.'.$column_name." = '".addslashes($id)."'");
		$this->db->select('a.*,b.printable_name,c.name as state_name,d.name');
		$this->db->from($table_name.' a');
		$this->db->join(COUNTRY.' b','a.id = b.id','LEFT');
		$this->db->join(STATE.' c','a.id = c.id','LEFT');
		$this->db->join(POSITIONTYPE.' d','a.id = d.id','LEFT');
		$query = $this->db->get(); 
		$row = $query->row();
		return $row; 
	}
	public function Retrieve_all_job_Record($table_name,$order_by_fld,$order_by,$offset,$limit)
	{
		//$this->db->where($where_clause);
		$this->db->select('a.*,b.printable_name,c.name as state_name,d.name');
		$this->db->from($table_name.' a');
		$this->db->limit($limit,$offset);
		$this->db->order_by($order_by_fld, $order_by);
		$this->db->join(COUNTRY.' b','a.country = b.id','LEFT');
		$this->db->join(STATE.' c','a.state = c.id','LEFT');
		$this->db->join(POSITIONTYPE.' d','a.positionType = d.id','LEFT');
		$query = $this->db->get(); 
		//$row = $query->row();
		return $query; 
	}
	public function Retrieve_Employer($table_name,$id,$column_name)
	{
		$this->db->where('a.'.$column_name." = '".addslashes($id)."'");
		$this->db->select('a.*,b.printable_name,c.name as state_name,d.name as industry_name');
		$this->db->from($table_name.' a');
		$this->db->join(COUNTRY.' b','a.id = b.id','LEFT');
		$this->db->join(STATE.' c','a.id = c.id','LEFT');
		$this->db->join(INDUSTRY.' d','a.industry = d.id','LEFT');
		$query = $this->db->get(); 
		//$row = $query->row();
		return $query; 
	}
	public function Retrieve_Admin_Employer($table_name,$id,$column_name)
	{
		$this->db->where('a.'.$column_name." = '".addslashes($id)."'");
		$this->db->select('a.*,b.printable_name as country_name,c.name as state_name,d.name as industry_name');
		$this->db->from($table_name.' a');
		$this->db->join(COUNTRY.' b','a.country = b.id','LEFT');
		$this->db->join(STATE.' c','a.state = c.id','LEFT');
		$this->db->join(INDUSTRY.' d','a.industryType = d.id','LEFT');
		$query = $this->db->get(); 
		//$row = $query->row();
		return $query; 
	}
	public function Email_exists($email) {
		$sql = "SELECT * FROM ".USER." WHERE email='".$email."'" ;
		$query = $this->db->query($sql);
		$row = $query->num_rows(); 
		//echo $this->db->last_query();
		return $row;
	} // end of Retrive_User
	public function get_all_records_joined($where_clause,$table,$table1,$paredntId,$chilcId) {	
		$this->db->order_by("order_id","ASC");
		if($where_clause != '')
		$this->db->where($where_clause);
		$this->db->select('M1.*, M2.*');
		$this->db->from($table.' AS M1 LEFT JOIN '.$table1.' AS M2 ON M1.'.$paredntId.'=M2.'.$chilcId.'');
		$query = $this->db->get();  
		//echo $this->db->last_query();
		return $query; 
	}
	public function countAllJoined($where_clause,$table,$table1,$paredntId,$chilcId) {
		if($where_clause != '')
			$this->db->where($where_clause);
		$this->db->select('M1.*, M2.*');
		$this->db->from($table.' AS M1 LEFT JOIN '.$table1.' AS M2 ON M1.'.$paredntId.'=M2.'.$chilcId.'');
		$query = $this->db->get();  
		$tot_rec = $query->num_rows();
		//echo $this->db->last_query();
		return $tot_rec;
	} // end of countAll
	public function get_appliedjobs_records($table,$where_clause,$id)
	{
	 $this->db->where($where_clause);
	 $this->db->select('a.*,b.jobTitle,c.name as jobseeker_name');
	 $this->db->from($table.' a');
	 $this->db->join(JOBPOST.' b','a.jobId = b.id','b.userPostedId = '.$id.' ','LEFT');
	 $this->db->join(USER.' c','a.JobseekerId = c.id','LEFT');
	 $query=$this->db->get();
	 return $query;
	}
	
	public function get_employer_email($q){
		$sql = "SELECT email FROM t_employer WHERE email LIKE '%".$q."%' LIMIT 5";
		$query = $this->db->query($sql);
		$this->db->last_query();
		return $result_arr = $query->result();
	}
	
	public function get_functional_area($q){
		$sql = "SELECT name FROM ".FUNCTIONALAREA." WHERE name LIKE '%".$q."%'";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}
	
	public function get_jobKeyword($q){
		$sql = "SELECT jobTitle FROM ".JOBPOST." WHERE jobTitle LIKE '%".$q."%' LIMIT 5";
		$query = $this->db->query($sql);
		$this->db->last_query();
		return $result_arr = $query->result();
	}
	

    public function employer_skill($q){
		$sql = "SELECT skills FROM ".USER." WHERE skills LIKE '%".$q."%' LIMIT 10 ";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}	
	

	public function get_user_currentEmployer($q){
		$sql = "SELECT currentEmployer FROM ".USER." WHERE currentEmployer LIKE '%".$q."%' LIMIT 5 ";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}	
	
	public function get_user_previousEmployer($q){
		$sql = "SELECT previousEmployer FROM ".USER." WHERE previousEmployer LIKE '%".$q."%' LIMIT 5 ";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}	
	
	public function get_company($q){
		$sql = "SELECT company FROM ".EMPLOYER." WHERE company LIKE '%".$q."%'";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}	
	
	public function get_skill($q){
		$sql = "SELECT skills FROM ".SKILLS." WHERE skills LIKE '%".$q."%'  OR skills LIKE '%".$q."%' LIMIT 5 ";
		$query = $this->db->query($sql);
		$this->db->last_query();
		return $result_arr = $query->result();
	}
	
	public function get_user_industry($q){
		$sql = "SELECT name FROM ".INDUSTRY." WHERE name LIKE '%".$q."%' LIMIT 5";
		$query = $this->db->query($sql);
		$this->db->last_query();
		return $result_arr = $query->result();
	}
	
	public function get_degree($q){
		$sql = "SELECT degree FROM ".EDUCATION." WHERE degree LIKE '%".$q."%'";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}	
	public function get_institute($q){
		$sql = "SELECT institute FROM ".EDUCATION." WHERE institute LIKE '%".$q."%'";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}	
	public function get_certification($q){
		$sql = "SELECT certification FROM ".CERTIFICATION." WHERE certification LIKE '%".$q."%'";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}	

	public function get_city($q){
		$sql = "SELECT city_name FROM ".CITY." WHERE city_name LIKE '%".$q."%' LIMIT 5 ";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}	
	public function get_zip($q, $city){
		$sql = "SELECT zip_code FROM ".ZIP." WHERE zip_code LIKE '%".$q."%' and city_id = '".$city."' ";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
		echo $this->db->last_query();
	}
	public function get_preferred_location($q){
		$sql = "SELECT city_name FROM ".CITY." WHERE city_name LIKE '%".$q."%' and countryId = '99' ";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}
	
	public function emp_company($q){
		$sql = "SELECT company FROM ".EMPLOYERUSER." WHERE company LIKE '%".$q."%' LIMIT 5  ";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}
	
	public function emp_industryType($q){
		$sql = "SELECT industryType FROM ".EMPLOYERUSER." WHERE industryType LIKE '%".$q."%' LIMIT 5  ";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}
	
/****************Jobseeker Search****************************/	
	public function getSelectedJobseeker($table_name, $where_clause,$order_by_fld,$order_by,$offset,$limit) {
		$this->db->order_by($order_by_fld,$order_by);
		
		/////////// Edited June 24,2014 By Satyajit ////////////
		$this->db->order_by('status','ASC');
		$this->db->order_by('mobileVerification','ASC');
		$this->db->order_by('rec_up_date','DESC');
		////////////////////////////////////////////////////////
		
		$this->db->limit($limit,$offset);
		if($where_clause!='')
		$this->db->where($where_clause);
		$this->db->select('ID, mobileVerification, name, email, mobile, functionalArea, area_of_specialization, industry, workExperience, level, currentLocation, preferredLocation, skills, resumeTitle, course_highest_education, specialization_highest_education');
		$this->db->from($table_name);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query; 

	} // end of get_all_records
	public function countSelectedJobseeker($table_name,$where_clause) {
		if($where_clause != '')
			$this->db->where($where_clause);
		$this->db->select('ID');
		$this->db->from($table_name);
		$query = $this->db->get();  
		$tot_rec = $query->num_rows();
		//echo $this->db->last_query();
		return $tot_rec;
	} // end of countAll

	/////////////////Auto Complete Search Candidate page////////////////////////////
	public function functional_Area($q){
		$sql = "SELECT functionalArea FROM ".VWFUNCTIONALAREA." WHERE functionalArea LIKE '%".$q."%' LIMIT 5 ";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}
	
    public function area_Specialization($q){
		$sql = "SELECT specialization_highest_education FROM ".VWSPECIALIZATION." WHERE specialization_highest_education LIKE '%".$q."%' LIMIT 5 ";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}
    public function industry_user($q){
		$sql = "SELECT industry FROM ".VWINDUSTRY." WHERE industry LIKE '%".$q."%' LIMIT 5 ";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}
	
	public function user_level($q){
		$sql = "SELECT level FROM ".VWLEVEL." WHERE level LIKE '%".$q."%' LIMIT 5 ";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}
	
	public function user_currentEmployer($q){
		$sql = "SELECT currentEmployer FROM ".VWEMPINFO." WHERE currentEmployer LIKE '%".$q."%' LIMIT 5 ";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}
	
	public function user_course_highest_education($q){
		$sql = "SELECT course_highest_education FROM ".VWEDUCATION." WHERE course_highest_education LIKE '%".$q."%' LIMIT 5 ";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}
	
    public function preferredLocation($q){
		$sql = "SELECT currentLocation FROM ".VWLOCATION." WHERE currentLocation LIKE '%".$q."%' limit 0,10 ";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}
	
	public function emp_currentLocation($q){
		$sql = "SELECT currentLocation FROM ".VWCURRENTLOCATION." WHERE currentLocation LIKE '%".$q."%' limit 0,10 ";
		$query = $this->db->query($sql);
		return $result_arr = $query->result();
	}
	public function employerEmailExists($email) {
		$sql = "SELECT * FROM ".EMPLOYERUSER." WHERE email='".$email."'" ;
		$query = $this->db->query($sql);
		$row = $query->num_rows(); 
		//echo $this->db->last_query();
		return $row;
	} // end of Retrive_User
	////////////////////////////////////////////////////////////////////////////////
	
	public function Employer_Saved_Jobs($where_clause,$table,$table1,$offset,$limit) {	
		
		$this->db->select('*');
		$this->db->limit($limit,$offset);
		$this->db->from($table);
		$this->db->join($table1, $where_clause);
		$query = $this->db->get();
		return $query;
		
	}
	
	public function DuplicateMySQLRecord ($table, $id_field, $id) {
    // load the original record into an array
    $result = mysql_query("SELECT * FROM {$table} WHERE {$id_field}={$id}");
    $original_record = mysql_fetch_assoc($result);
    
    // insert the new record and get the new auto_increment id
    mysql_query("INSERT INTO {$table} (`{$id_field}`) VALUES (NULL)");
    $newid = mysql_insert_id();
    
    // generate the query to update the new record with the previous values
    $query = "UPDATE {$table} SET ";
    foreach ($original_record as $key => $value) {
        if ($key != $id_field) {
            $query .= '`'.$key.'` = "'.str_replace('"','\"',$value).'", ';
        }
    } 
    $query = substr($query,0,strlen($query)-2); // lop off the extra trailing comma
    $query .= " WHERE {$id_field}={$newid}";
    mysql_query($query);
    
    // return the new id
    return $newid;
}
	
	
}
//end of class
?>