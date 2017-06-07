<?php
class Common_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct ();
	}
	public function updwhere($table_name, $where_clause, $updata)
	{
		$this->db->where ( $where_clause );
		
		$this->db->update ( $table_name, $updata );
	}
	public function collectAll($table_name, $email)
	{
		$this->db->select ( "*" );
		
		$this->db->from ( $table_name );
		
		$this->db->where ( array (
				'email' => $email 
		) );
		
		$rr = $this->db->get ();
		
		return $rr->result_array ();
	}
	public function addrec($table_name, $adata)
	{
		$this->db->insert ( $table_name, $adata );
		
		$id = $this->db->insert_id ();
		
		return $id;
	}
	public function countAll($table_name, $where_clause)
	{
		if ($where_clause != '')
			
			$this->db->where ( $where_clause );
		
		$this->db->select ( '*' );
		
		$this->db->from ( $table_name );
		
		$query = $this->db->get ();
		
		$tot_rec = $query->num_rows ();
		
		// echo $this->db->last_query();
		
		return $tot_rec;
	} // end of countAll
	public function GetAllWhere($table_name, $where_clause)
	{
		if ($where_clause != '')
			
			$this->db->where ( $where_clause );
		
		$this->db->select ( '*' );
		
		$this->db->from ( $table_name );
		
		$query = $this->db->get ();
		
		return $query;
	} // end of countAll
	public function checkEmp($empid, $id)
	{
		$sql = "SELECT * FROM t_seekerview WHERE (employer_id='" . $empid . "') AND seeker_id='" . $id . "' ";
		
		$query = $this->db->query ( $sql );
		
		return $query;
	}
	public function checkMail($id)
	{
		$sql = "SELECT * FROM send_mail WHERE (seeker_id='" . $id . "') AND status='Y' ";
		
		$query = $this->db->query ( $sql );
		
		return $query;
	}
	public function get_all_record($table_name, $where_array)
	{
		$res = $this->db->get_where ( $table_name, $where_array );
		
		return $res->result ();
	}
	public function delfn($table_name, $id)
	{
		$this->db->where ( 'id', $id );
		
		$this->db->delete ( $table_name );
	}
	public function delSource($table_name, $id)
	{
		$this->db->where ( 'news_id', $id );
		
		$this->db->delete ( $table_name );
	}
	public function Update_Record3($row, $table, $id)
	
	{
		$this->db->where ( 'seeker_id', $id );
		
		$flag = $this->db->update ( $table, $row );
		
		return $flag;
		
		// echo $this->db->last_query(); exit;
	}
	public function Update_Record4($row, $table, $id)
	
	{
		$this->db->where ( 'employer_id', $id );
		
		$flag = $this->db->update ( $table, $row );
		
		return $flag;
		
		// echo $this->db->last_query(); exit;
	}
	public function get_records_from_sql($sql)
	
	{
		
		// $sql = "SELECT * FROM ".$table_name." WHERE id=".$id;
		$query = $this->db->query ( $sql );
		
		return $query->result ();
	}
	public function count_records($table_name, $where_clause, $field, $fieldVal)
	{
		$where_clause .= " AND " . $field . " = '" . $fieldVal . "'";
		
		// echo $where_clause;
		
		// exit;
		
		// $this->db->order_by($order_by_fld,$order_by);
		
		// $this->db->limit($limit,$offset);
		
		if ($where_clause != '')
			
			$this->db->where ( $where_clause );
		
		// $this->db->distinct();
		
		$this->db->select ( '*' );
		
		$this->db->from ( $table_name );
		
		$query = $this->db->get ();
		
		// echo $this->db->last_query();
		
		// exit;
		
		// return $query;
		
		return $query->num_rows ();
	} // end of get_all_records
	public function get_all_distinct_records($table_name, $field)
	{
		$this->db->distinct ();
		
		$this->db->select ( $field );
		
		$this->db->order_by ( $field, "asc" );
		
		$this->db->from ( $table_name );
		
		$query = $this->db->get ();
		
		// echo $this->db->last_query();
		
		// exit;
		
		return $query;
	} // end of get_all_records
	  
	// #--------------------------------@1st-October-2015-SOM-Starts------------------------------##
	public function get_all_records($table_name, $where_clause = '', $order_by_fld = '', $order_by = '', $offset = '', $limit = '')
	{
		if ($order_by_fld != '' && $order_by != '')
		{
			
			$this->db->order_by ( $order_by_fld, $order_by );
		}
		
		if ($offset != '' && $limit != '')
		{
			
			$this->db->limit ( $limit, $offset );
		}
		
		if ($where_clause != '')
			
			$this->db->where ( $where_clause );
		
		$this->db->select ( '*' );
		
		$this->db->from ( $table_name );
		
		$query = $this->db->get ();
		
		return $query;
	}
	
	// #--------------------------------@1st-October-2015-SOM-Ends-------------------------------##
	public function get_skills_records($table_name)
	{
		$this->db->order_by ( 'skill_name', 'ASC' );
		
		$this->db->select ( '*' );
		
		$this->db->from ( $table_name );
		
		$query = $this->db->get ();
		
		return $query;
	} // end of get_all_records
	public function get_all_jobs($table_name, $where_clause, $limit)
	{
		$sql = 'select * from ' . $table_name . ' where ' . $where_clause . ' limit ' . $limit;
		
		$query = $this->db->query ( $sql );
		
		// echo $this->db->last_query();
		
		return $query->result ();
	} // end of get_all_records
	public function get_preview($table_name, $where_clause, $order_by_fld, $order_by, $offset, $limit)
	{
		$sql = "SELECT id,resume,resumeSummery FROM $table_name WHERE uid='$where_clause'";
		
		$query = $this->db->query ( $sql );
		
		return $query->result_array ();
	} // end of get_all_records
	public function get_user_preview($table_name, $where_clause, $order_by_fld, $order_by, $offset, $limit)
	{
		$sql1 = "SELECT * FROM $table_name WHERE id='$where_clause'";
		
		$query1 = $this->db->query ( $sql1 );
		
		return $query1;
	} // end of get_all_records
	public function get_country($table_name, $where_clause, $order_by_fld, $order_by, $offset, $limit)
	{
		
		// echo $table_name;
		
		// exit;
		
		// echo $where_clause;
		
		// exit;
		$sql2 = "SELECT * FROM $table_name WHERE id='$where_clause'";
		
		$query2 = $this->db->query ( $sql2 );
		
		return $query2->result_array ();
	} // end of get_all_records
	public function get_work_authorization($table_name, $where_clause, $order_by_fld, $order_by, $offset, $limit)
	{
		$sql3 = "SELECT * FROM $table_name WHERE id='$where_clause'";
		
		$query3 = $this->db->query ( $sql3 );
		
		return $query3->result_array ();
	} // end of get_all_records
	public function get_job_classification($table_name, $where_clause, $order_by_fld, $order_by, $offset, $limit)
	{
		
		// echo $where_clause;
		
		// exit;
		$sql4 = "SELECT * FROM $table_name WHERE id='$where_clause'";
		
		$query4 = $this->db->query ( $sql4 );
		
		return $query4->result_array ();
	} // end of get_all_records
	public function get_state($table_name, $where_clause, $order_by_fld, $order_by, $offset, $limit)
	{
		
		// echo $table_name;
		
		// exit;
		$sql5 = "SELECT * FROM $table_name WHERE id='$where_clause'";
		
		$query5 = $this->db->query ( $sql5 );
		
		return $query5->result_array ();
	} // end of get_all_records
	public function get_degree($table_name, $where_clause, $order_by_fld, $order_by, $offset, $limit)
	{
		$sql6 = "SELECT * FROM $table_name WHERE id='$where_clause'";
		
		$query6 = $this->db->query ( $sql6 );
		
		return $query6->result_array ();
	} // end of get_all_records
	public function get_cpresume($table_name, $where_clause, $order_by_fld, $order_by, $offset, $limit)
	{
		$sql7 = "SELECT * FROM $table_name WHERE uid='$where_clause'";
		
		$query7 = $this->db->query ( $sql7 );
		
		return $query7->result_array ();
	} // end of get_all_records
	
	/*
	 *
	 * public function Retrive_Record_Column($table,$id,$column_name) {
	 *
	 * $this->db->where($column_name." = '".addslashes($id)."'");
	 *
	 * $this->db->select('*');
	 *
	 * $this->db->from($table);
	 *
	 * $query = $this->db->get();
	 *
	 * return $query;
	 *
	 *
	 *
	 * }
	 *
	 */
	public function Retrive_record_by_slug($table, $slug)
	{
		$sql = "SELECT * FROM " . $table . " WHERE slug='" . addslashes ( $slug ) . "'";
		
		$query = $this->db->query ( $sql );
		
		$row = $query->row_array ();
		
		// echo $this->db->last_query();
		
		return $row;
	}
	public function Retrive_Record_By_Where_Clause($table, $where_clause)
	{
		$this->db->select ( '*' );
		
		$this->db->from ( $table );
		
		if (! empty ( $where_clause ))
			
			$this->db->where ( $where_clause );
		
		$query = $this->db->get ();
		
		$row = $query->row_array ();
		
		return $row;
		
		// $row = $query->row_array();
		
		// echo $this->db->last_query();
		
		// print_r($query);
		
		return $query;
		
		// echo $query->num_rows;
	}
	public function Retrive_Record_By_Where_Clause1($table, $where_clause)
	{
		$this->db->select ( '*' );
		
		$this->db->from ( $table );
		
		if (! empty ( $where_clause ))
			
			$this->db->where ( $where_clause );
		
		$query = $this->db->get ();
		
		return $query;
		
		// $row = $query->row_array();
		
		// echo $this->db->last_query();
		
		// print_r($query);
		
		// return $query;
		
		// echo $query->num_rows;
	}
	public function get_all_records_cms($table_name, $where_clause, $order_by_fld, $order_by, $offset, $limit)
	{
		$this->db->order_by ( $order_by_fld, $order_by );
		
		$this->db->limit ( $limit, $offset );
		
		if ($where_clause != '')
			
			$this->db->where ( $where_clause );
		
		$this->db->select ( '*' );
		
		$this->db->from ( $table_name );
		
		$query = $this->db->get ();
		
		return $query;
	} // end of get_all_records
	public function getallrecords($table_name)
	{
		$this->db->order_by ( "id", "desc" );
		
		$this->db->select ( '*' );
		
		$this->db->from ( $table_name );
		
		$query = $this->db->get ();
		
		return $query;
	} // end of getallrecords
	public function getallrecords1($table_name)
	{
		$this->db->select ( '*' );
		
		$this->db->from ( $table_name );
		
		$query = $this->db->get ();
		
		return $query;
	} // end of getallrecords
	public function getrecord($table_name, $where_clause)
	{
		$this->db->order_by ( "countryId", "desc" );
		
		$this->db->where ( "countryId = '$id'" );
		
		$this->db->select ( '*' );
		
		$this->db->from ( $table_name );
		
		$query = $this->db->get ();
		
		$row = $query->result ();
		
		return $row;
	} // end of getallrecords
	public function getNewsComment($table_name, $id)
	{
		$this->db->order_by ( "id", "desc" );
		
		$this->db->select ( '*' );
		
		$this->db->from ( $table_name );
		
		$this->db->where ( 'news_id', $id );
		
		$query = $this->db->get ();
		
		return $query;
	} // end of getNewsComment
	
	/*
	 *
	 * Name: Add_Record
	 *
	 * Purpose: This function will insert record in a table
	 *
	 * Parameter: row, table
	 *
	 * return: insert id
	 *
	 */
	function Add_Record($row, $table)
	{
		$str = $this->db->insert_string ( $table, $row );
		
		$query = $this->db->query ( $str );
		
		$insertid = $this->db->insert_id ();
		
		// echo $this->db->last_query(); exit;
		
		return $insertid;
	} // end of Add_Record
	
	/*
	 *
	 * Name: Update_Record
	 *
	 * Purpose: This function will update record in a table
	 *
	 * Parameter: row, table, id
	 *
	 * return: null
	 *
	 */
	
	// function New_Add_Record() {
	
	//
	
	// //$title=$this->input->post('title');
	
	// $email=$this->input->post('email');
	
	// $password=$this->input->post('password');
	
	// $data=array(
	
	// 'email'=>$email,
	
	// 'password'=>$password
	
	// );
	
	// $this->db->insert('t_user',$data);
	
	// }
	function insertQ($row)
	{
		
		// $email = $_POST['email'];
		
		// $pass = $_POST['pass'];
		
		// $this->db->query("INSERT INTO questions VALUES('','$email','$qText','','')");
		
		// $this->db->insert('t_user', array('email' =>$email, 'password' => $pass));
		
		// $data=array(
		
		// 'email'=>$email,
		
		// 'password'=>$pass
		
		// );
		
		// $allowedexts=array("JPEG","JPG","PNG","GIF","DOC","DOCX","jpeg","jpg","png","gif","doc","docx");
		
		// $extension=explode(".",$_FILES['file']['name']);
		
		// $exts=end($extension);
		
		//
		
		// if(($_FILES['file']['size']<50000000) && in_array($exts,$allowedexts))
		
		// {
		
		// $newname=date('d-m-y')."_".time().".".$exts;
		
		//
		
		// move_uploaded_file($_FILES['file']['tmp_name'],base_url().'upload/'.$newname);
		
		// //$path="uploads/".$newname;
		
		// }
		$insertid = $this->db->insert ( 't_user', $row );
	}
	function Update_Record($row, $table, $id)
	
	{
		$this->db->where ( 'id', $id );
		
		$flag = $this->db->update ( $table, $row );
		
		return $flag;
		
		// echo $this->db->last_query(); exit;
	}
	function Update_Rcrd($row, $table, $id)
	
	{
		$this->db->where ( 'uid', $id );
		
		$flag = $this->db->update ( $table, $row );
		
		return $flag;
		
		// echo $this->db->last_query(); exit;
	}
	function Update_news($row, $table, $id)
	
	{
		$this->db->where ( 'news_id', $id );
		
		$flag = $this->db->update ( $table, $row );
		
		return $flag;
		
		// echo $this->db->last_query(); exit;
	}
	public function Update_Record1($row_data, $table)
	
	{
		
		// $this->db->where('id', $id);
		
		// print_r($row_data);
		$flag = $this->db->update ( $table, $row_data );
		
		return $flag;
		
		// echo $this->db->last_query(); exit;
	}
	function Retrive_Record($table, $id)
	{
		$this->db->select ( '*' );
		
		$this->db->from ( $table );
		
		$this->db->where ( 'id', addslashes ( $id ) );
		
		$query = $this->db->get ();
		
		$row = $query->row_array ();
		
		$cnt = $query->num_rows ();
		
		// echo $cnt;
		
		if ($cnt > 0)
		{
			
			return $row;
		}
		
		/*
		 * $sql = "SELECT * FROM ".$table." WHERE id='".addslashes($id)."'" ;
		 *
		 * $query = $this->db->query($sql);
		 *
		 * $row = $query->row_array();
		 *
		 * return $row;
		 */
	}
	
	/*
	 *
	 * Name: get_all_country
	 *
	 * Purpose : This function will show all country.
	 *
	 * Parameter : sel_country_id
	 *
	 * return : Dropdown with all country
	 *
	 */
	
	// $query_order = "SELECT `menu_order` FROM ".$table." WHERE `id` ='{$id}'";
	public function getnews($table_name)
	{
		$this->db->select ( '*' );
		
		$this->db->from ( $table_name );
		
		$this->db->order_by ( "id", "desc" );
		
		$this->db->limit ( '2' );
		
		$query = $this->db->get ();
		
		return $query;
	} // end of getallrecords
	public function getAllNews($table_name)
	{
		$this->db->select ( '*' );
		
		$this->db->from ( $table_name );
		
		$this->db->order_by ( "id", "desc" );
		
		$this->db->limit ( '9' );
		
		$query = $this->db->get ();
		
		return $query;
	} // end of getallrecords
	function get_all_country()
	{
		$orderby_field = "printable_name";
		
		$orderby = "ASC";
		
		$this->db->select ( "*" );
		
		$this->db->from ( COUNTRY );
		
		$this->db->order_by ( $orderby_field, $orderby );
		
		$query = $this->db->get ();
		
		// echo $this->db->last_query();
		
		return $query;
	} // end of get_all_country
	function insert_record($table, $row)
	{
		$this->db->insert ( $table, $row );
		
		$insertid = $this->db->insert_id ();
		
		// echo $this->db->last_query(); exit;
		
		return $insertid;
	} // end of Add_Record
	function insert_newsComment($table, $row)
	{
		$this->db->insert ( $table, $row );
		
		return 1;
	} // end of Add_Record
	public function get_newsDetails($table_name, $id)
	{
		$this->db->select ( '*' );
		
		$this->db->from ( $table_name );
		
		$this->db->where ( 'id', $id );
		
		$query = $this->db->get ();
		
		// echo $this->db->last_query();
		
		return $query;
	} // end of get_all_records
	function getAllSocialmediaRecords()
	{
		$orderby_field = "order_id";
		
		$orderby = "ASC";
		
		$where = "status = 'Y'";
		
		$this->db->select ( '*' );
		
		$this->db->from ( SOCIALMEDIA );
		
		$this->db->where ( $where );
		
		$this->db->order_by ( $orderby_field, $orderby );
		
		$query = $this->db->get ();
		
		// echo $this->db->last_query();
		
		return $query;
	} // end of getAllRecords
	function dispbanner()
	{
		$orderby_field = "order";
		
		$orderby = "ASC";
		
		$this->db->select ( "*" );
		
		$this->db->where ( "is_active = '1'" );
		
		$this->db->from ( HOMEPAGEBANNER );
		
		$this->db->order_by ( $orderby_field, $orderby );
		
		$query = $this->db->get ();
		
		// echo $this->db->last_query();
		
		$result = $query->result ();
		
		foreach ( $result as $row_homepagebanner )
		{
			
			$target = "_parent";
			
			if ($row_homepagebanner->open_option == '2')
				$target = "_blank";
			
			echo anchor ( $row_homepagebanner->link_url, img ( array (
					"src" => FLD_HOMEPAGEBANNER . $row_homepagebanner->banner,
					"height" => "338px",
					"width" => "947px",
					"alt" => $row_homepagebanner->alt_tag,
					"border" => "0" 
			) ), array (
					"target" => $target,
					"title" => $row_homepagebanner->title_tag 
			) );
		}
	}
	function dispevents()
	{
		$orderby_field = "order";
		
		$orderby = "ASC";
		
		// $this->db->select("*");
		
		$this->db->where ( "is_active = '1' and event_dt > CURDATE()" );
		
		// $this->db->from();
		
		$this->db->order_by ( $orderby_field, $orderby );
		
		$query = $this->db->get ( EVENTSCHEDULE, 3 );
		
		// echo $this->db->last_query();
		
		$result = $query->result ();
		
		// print_r($event_dt);
		
		$str = "<ul>";
		
		foreach ( $result as $row_event )
		{
			
			$event_dt = explode ( "/", date ( "d/M/Y", strtotime ( $row_event->event_dt ) ) );
			
			$description = strip_tags ( $row_event->description );
			
			if (strlen ( $description ) > 100)
				$description = substr ( $description, 0, 100 ) . "...";
			
			$slug = $row_event->slug;
			
			$str .= "<li><div class=\"date\"><span> " . $event_dt [0] . "</span><br />

                      " . $event_dt [1] . " <br />

                     " . $event_dt [2] . "</div>

                    <div class=\"event-content\">

					<p><a href='" . site_url ( "events/$slug" ) . "' style='text-decoration:none;'><strong>" . $row_event->title . "</strong></a></p>

					<p>" . $description . "</p>

					</div>

                  </li>";
		}
		
		$str .= "</ul>";
		
		echo $str;
	}
	function disptestimonials()
	{
		$orderby_field = "order";
		
		$orderby = "ASC";
		
		// $this->db->select("*");
		
		$this->db->where ( "is_active = '1'" );
		
		// $this->db->from();
		
		$this->db->order_by ( $orderby_field, $orderby );
		
		$query = $this->db->get ( TESTIMONIAL, 2 );
		
		// echo $this->db->last_query();
		
		$result = $query->result ();
		
		// print_r($event_dt);
		
		$str = "";
		
		foreach ( $result as $row_testimonial )
		{
			
			$description = strip_tags ( $row_testimonial->testi_desc );
			
			if (strlen ( $description ) > 200)
				$description = substr ( $description, 0, 200 ) . "...";
			
			$slug = $row_testimonial->slug;
			
			$str .= "<div class=\"events-bg\">
					 <p class=\"author\">" . $row_testimonial->testi_title . "</p>
					 <p class=\"testimonials\" style=\"margin-top:5px;\">" . $description . "</p>
					 <p class=\"author\">- " . $row_testimonial->from . "</p>
					 <a href='" . site_url ( "testimonials/$slug" ) . "' class=\"testi_readmore\">Read more...</a>			  
					 </div>";
		}
		
		echo $str;
	}
	function addRecord($table, $row)
	{
		if (is_array ( $row ))
		{
			
			foreach ( $row as $key => $val )
			{
				
				$row [$key] = $val;
			}
		}
		
		$str = $this->db->insert ( $table, $row );
		
		// echo $this->db->last_query();
		
		$insertid = $this->db->insert_id ();
		
		// exit;
		
		return $insertid;
	}
	function showOrderIcon($table, $id)
	{
		
		// retrive MAX and MIN banner_order
		$query_order = "SELECT min(`menu_order`) as `min_order`,max(`menu_order`) as `max_order` FROM " . $table . " WHERE 1";
		
		$rs_order = $this->db->query ( $query_order );
		
		$row_order = $rs_order->row_array ();
		
		$min_order = $row_order ['min_order'];
		
		$max_order = $row_order ['max_order'];
		
		// retrive indivisual banner_order
		
		$query_order = "SELECT `menu_order` FROM " . $table . " WHERE `id` ='{$id}'";
		
		$rs_order = $this->db->query ( $query_order );
		
		$row_order = $rs_order->row_array ();
		
		$order = $row_order ['menu_order'];
		
		if ($order == $max_order)
		{
			
			$link = "<img src='" . base_url () . "images/admin/priority_up.png' border='0' onclick=\"javascript:change_order('{$id}','decrease_order');\" style='cursor:pointer;' title='Increase Order' alt='Down'>";
		}
		else if ($order == $min_order)
		{
			
			$link = "<img src='" . base_url () . "images/admin/priority_down.png' border='0' onclick=\"javascript:change_order('{$id}','increase_order');\" style='cursor:pointer;' title='Decrease Order' alt='Up'>";
		}
		else
		{
			
			$link = "<img src='" . base_url () . "images/admin/priority_up.png' border='0' onclick=\"javascript:change_order('{$id}','decrease_order');\" style='cursor:pointer;' title='Increase Order' alt='Up'>&nbsp;&nbsp;<img src='" . base_url () . "images/admin/priority_down.png' border='0' onclick=\"javascript:change_order('{$id}','increase_order');\" style='cursor:pointer;' title='Decrease Order' alt='Down'>";
		}
		
		return ($link);
	}
	public function record_change_id($table, $where_clause, $order_by_fld, $order_by, $offset, $limit)
	{
		$id = "";
		
		$this->db->order_by ( $order_by_fld, $order_by );
		
		$this->db->limit ( $limit, $offset );
		
		$this->db->where ( $where_clause );
		
		$this->db->select ( '*' );
		
		$this->db->from ( $table );
		
		$query = $this->db->get ();
		
		// echo $this->db->last_query();
		
		foreach ( $query->result () as $row )
		{
			
			$id = $row->id;
		}
		
		// print_r($row); exit;
		
		if ($id != "")
		{
			
			return $id;
		}
	}
	public function getallsecurityquestions($table_name)
	{
		$this->db->order_by ( "order", "asc" );
		
		$this->db->select ( '*' );
		
		$this->db->where ( "is_active = '1' " );
		
		$this->db->from ( $table_name );
		
		$query = $this->db->get ();
		
		return $query;
	} // end of getall security question records
	public function getallsatest($table_name)
	{
		$this->db->order_by ( "test_id", "desc" );
		
		$this->db->select ( '*' );
		
		$this->db->where ( "is_active = '1' " );
		
		$this->db->from ( $table_name );
		
		$query = $this->db->get ();
		
		return $query;
	} // end of get all test records
	public function getstudentrecord($table_name, $id)
	{
		$this->db->order_by ( "U.id", "desc" );
		
		$this->db->where ( "SD.std_id = '$id'" );
		
		$this->db->select ( '*' );
		
		$this->db->from ( $table_name . ' SD' );
		
		$this->db->join ( USER . ' U', 'U.id = SD.std_id', 'INNER' );
		
		$query = $this->db->get ();
		
		$row = $query->row_array ();
		
		return $row;
	} // end of getallrecords
	function Update_Usertest_Record($row, $table, $user_id, $test_id, $package_id)
	{
		$this->db->where ( array (
				'usertest_packageid ' => $package_id,
				'usertest_userid' => $user_id,
				'usertest_testid' => $test_id,
				'usertest_completed' => '0' 
		) );
		
		$this->db->update ( $table, $row );
		
		// echo $this->db->last_query();
	}
	function Get_Usertest_Record($user_id, $test_id, $package_id)
	{
		$sql = "SELECT * FROM " . USERTEST . " WHERE usertest_packageid = $package_id and usertest_userid = $user_id and usertest_testid = $test_id and usertest_completed = '0'";
		
		$query = $this->db->query ( $sql );
		
		$row = $query->row_array ();
		
		return $row;
	}
	function Count_Usertest_Record($user_id, $test_id, $package_id)
	{
		$sql = "SELECT * FROM " . USERTEST . " WHERE usertest_packageid = $package_id and usertest_userid = $user_id and usertest_testid = $test_id and usertest_completed = '0'";
		
		$query = $this->db->query ( $sql );
		
		$num_rows = $query->num_rows ();
		
		return $num_rows;
	}
	function email_body($socialmedias, $footer_content, $mid_content)
	{
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
									<td align="left" valign="top"><img src="' . base_url () . 'images/newsletter/logo.jpg" alt="" border="0" /></td>
									<td>&nbsp;</td>
									<td align="right" valign="top">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										  <tr>
											<td align="right" height="47" valign="middle" style="font:bold 12px Tahoma; color:#535151; text-transform:uppercase; padding:0 6px 0 0;">
												Follow Us On:
												' . $socialmedias . ' 
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
							<td align="left" valign="top"><img src="' . base_url () . 'images/newsletter/banner.png" alt="" /></td>
						  </tr> 
						  <tr>
							<td align="left" valign="top" style="font:normal 13px/16px Tahoma; color:#535151;">
								' . $mid_content . '
								</td>
						  </tr>
						  <tr><td height="15"></td></tr>
						  <tr>
							<td align="left" valign="top" style="font:normal 13px/16px Tahoma; color:#174179;">
									<strong>Standardized Tests Preparation</strong><br />
								<a href="' . base_url () . '" style="color:#174179; text-decoration:none;">www.standardizedtestspreparation.com</a>					
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
							' . $footer_content . '					</td>
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
	function save_feedback($name, $mail, $feed_message)
	
	{
		
		// $sql="select * from sff_feedback where feed_email ='".$mail."'";
		
		// $query = $this->db->query($sql);
		$sql_insert = "INSERT INTO " . FEEDBACK . " SET feed_title ='" . $name . "',feed_email ='" . $mail . "',feed_message ='" . $feed_message . "',feed_date= '" . date ( 'Y-m-d' ) . "'";
		
		$this->db->query ( $sql_insert );
		
		return true;
	}
	
	// Decription Function
	public function base64De($num, $val)
	{
		for($i = 0; $i < $num; $i ++)
		{
			
			$val = base64_decode ( $val );
		}
		
		return $val;
	}
	
	// Encryption Function
	public function base64En($num, $val)
	{
		for($i = 0; $i < $num; $i ++)
		{
			
			$val = base64_encode ( $val );
		}
		
		Return $val;
	}
	public function getRandomNumber($length)
	
	{
		$random = "";
		
		$data1 = "";
		
		srand ( ( double ) microtime () * 1000000 );
		
		$data1 = "9876549876542156012";
		
		$data1 .= "0123456789564542313216743132136864313";
		
		for($i = 0; $i < $length; $i ++)
		
		{
			
			$random .= substr ( $data1, (rand () % (strlen ( $data1 ))), 1 );
		}
		
		return $random;
	}
	public function getVerifyNumber($length)
	
	{
		$random = "";
		
		$data1 = "";
		
		srand ( ( double ) microtime () * 1000000 );
		
		$data1 = "0123456789";
		
		$data1 .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		
		for($i = 0; $i < $length; $i ++)
		
		{
			
			$random .= substr ( $data1, (rand () % (strlen ( $data1 ))), 1 );
		}
		
		return $random;
	}
	public function getstate($table_name, $where_clause)
	{
		$this->db->order_by ( "a.order_id, b.printable_name" );
		
		if ($where_clause != '')
			
			$this->db->where ( $where_clause );
		
		$this->db->where ( "a.status = 'Y'" );
		
		$this->db->select ( 'a.order_id AS country_order_id, a.printable_name as country_name, b . *' );
		
		$this->db->from ( COUNTRY . ' a' );
		
		// $this->db->from($table_name.' SD');
		
		$this->db->join ( $table_name . ' b', 'a.id = b.country_id', 'LEFT' );
		
		$query = $this->db->get ();
		
		// $row = $query->row_array();
		
		// echo $this->db->last_query();
		
		return $query;
		
		// $tot_rec = $query->num_rows();
		
		// return $tot_rec;
		
		/*
		 * return array(
		 *
		 * 'row' => $row,
		 *
		 * 'tot_rec' => $tot_rec
		 *
		 * );
		 */
	}
	
	/*
	 * public function get_all_records($table_name, $where_clause,$order_by_fld,$order_by,$offset,$limit) {
	 *
	 * $this->db->order_by($order_by_fld,$order_by);
	 *
	 * $this->db->limit($limit,$offset);
	 *
	 * if($where_clause!='')
	 *
	 * $this->db->where($where_clause);
	 *
	 * $this->db->select('*');
	 *
	 * $this->db->from($table_name);
	 *
	 * $query = $this->db->get();
	 *
	 * //echo $this->db->last_query();
	 *
	 * return $query;
	 *
	 *
	 *
	 * }
	 */
	public function countstate($table_name, $where_clause)
	{
		$this->db->order_by ( "a.order_id" );
		
		if ($where_clause != '')
			
			$this->db->where ( $where_clause );
		
		// $this->db->where("a.status = 'Y'");
		
		$this->db->select ( 'a.order_id AS country_order_id, a.printable_name, b . *' );
		
		$this->db->from ( COUNTRY . ' a' );
		
		// $this->db->from($table_name.' SD');
		
		$this->db->join ( $table_name . ' b', 'a.id = b.country_id', 'LEFT' );
		
		$query = $this->db->get ();
		
		$row = $query->row_array ();
		
		// echo $this->db->last_query();
		
		// return $row;
		
		$tot_rec = $query->num_rows ();
		
		return $tot_rec;
		
		/*
		 * return array(
		 *
		 * 'row' => $row,
		 *
		 * 'tot_rec' => $tot_rec
		 *
		 * );
		 */
	}
	public function countstateundercountry($table_name, $where_clause)
	{
		$this->db->order_by ( "a.order_id" );
		
		if ($where_clause != '')
			
			$this->db->where ( $where_clause );
		
		$this->db->where ( "a.status = 'Y'" );
		
		$this->db->select ( 'a.order_id AS country_order_id, a.printable_name, b . *' );
		
		$this->db->from ( COUNTRY . ' a' );
		
		// $this->db->from($table_name.' SD');
		
		$this->db->join ( $table_name . ' b', 'a.id = b.country_id', 'INNER' );
		
		$query = $this->db->get ();
		
		$row = $query->row_array ();
		
		// echo $this->db->last_query();
		
		// return $row;
		
		$tot_rec = $query->num_rows ();
		
		return $tot_rec;
		
		/*
		 * return array(
		 *
		 * 'row' => $row,
		 *
		 * 'tot_rec' => $tot_rec
		 *
		 * );
		 */
	}
	public function countcityunderstate($where_clause)
	{
		$this->db->order_by ( "a.order_id" );
		
		if ($where_clause != '')
			
			$this->db->where ( $where_clause );
		
		// $this->db->where("a.status = 'Y'");
		
		$this->db->select ( 'a.order_id AS country_order_id, a.printable_name, b . *' );
		
		$this->db->from ( STATE . ' a' );
		
		// $this->db->from($table_name.' SD');
		
		$this->db->join ( CITY . ' b', 'a.id = b.state_id', 'INNER' );
		
		$query = $this->db->get ();
		
		$row = $query->row_array ();
		
		// echo $this->db->last_query();
		
		// return $row;
		
		$tot_rec = $query->num_rows ();
		
		$this->db->order_by ( "a.order_id" );
		
		if ($where_clause != '')
			
			$this->db->where ( $where_clause );
		
		// $this->db->where("a.status = 'Y'");
		
		$this->db->select ( 'a.order_id AS country_order_id, a.printable_name, b . *' );
		
		$this->db->from ( STATE . ' a' );
		
		// $this->db->from($table_name.' SD');
		
		$this->db->join ( COUNTY . ' b', 'a.id = b.state_id', 'INNER' );
		
		$query1 = $this->db->get ();
		
		$row1 = $query1->row_array ();
		
		// echo $this->db->last_query();
		
		// return $row;
		
		$tot_rec1 = $query1->num_rows ();
		
		$tot = $tot_rec1 + $tot_rec;
		
		return $tot;
		
		/*
		 * return array(
		 *
		 * 'row' => $row,
		 *
		 * 'tot_rec' => $tot_rec
		 *
		 * );
		 */
	}
	public function countcityundercounty($table_name, $where_clause)
	{
		$this->db->order_by ( "a.order_id" );
		
		if ($where_clause != '')
			
			$this->db->where ( $where_clause );
		
		// $this->db->where("a.status = 'Y'");
		
		$this->db->select ( 'a.order_id AS country_order_id, a.county_name, b . *' );
		
		$this->db->from ( COUNTY . ' a' );
		
		// $this->db->from($table_name.' SD');
		
		$this->db->join ( $table_name . ' b', 'a.id = b.county_id', 'INNER' );
		
		$query = $this->db->get ();
		
		$row = $query->row_array ();
		
		// echo $this->db->last_query();
		
		// return $row;
		
		$tot_rec = $query->num_rows ();
		
		return $tot_rec;
		
		/*
		 * return array(
		 *
		 * 'row' => $row,
		 *
		 * 'tot_rec' => $tot_rec
		 *
		 * );
		 */
	}
	public function countzipundercity($table_name, $where_clause)
	{
		$this->db->order_by ( "a.order_id" );
		
		if ($where_clause != '')
			
			$this->db->where ( $where_clause );
		
		// $this->db->where("a.status = 'Y'");
		
		$this->db->select ( 'a.order_id AS country_order_id, a.city_name, b . *' );
		
		$this->db->from ( CITY . ' a' );
		
		// $this->db->from($table_name.' SD');
		
		$this->db->join ( $table_name . ' b', 'a.id = b.city_id', 'INNER' );
		
		$query = $this->db->get ();
		
		$row = $query->row_array ();
		
		// echo $this->db->last_query();
		
		// return $row;
		
		$tot_rec = $query->num_rows ();
		
		return $tot_rec;
		
		/*
		 * return array(
		 *
		 * 'row' => $row,
		 *
		 * 'tot_rec' => $tot_rec
		 *
		 * );
		 */
	}
	function Update_Record_ColumnName($row, $table, $id, $column)
	{
		$this->db->where ( $column, $id );
		
		$this->db->update ( $table, $row );
	}
	public function Retrive_Education_Record_Column($table, $id, $column_name)
	{
		$this->db->where ( 'a.' . $column_name . " = '" . addslashes ( $id ) . "'" );
		
		$this->db->select ( 'a.*,b.name,c.printable_name' );
		
		$this->db->from ( $table . ' a' );
		
		$this->db->join ( STATE . ' b', 'a.state = b.id', 'LEFT' );
		
		$this->db->join ( COUNTRY . ' c', 'a.country = c.id', 'LEFT' );
		
		$query = $this->db->get ();
		
		/*
		 * echo $this->db->last_query();
		 *
		 * exit;
		 */
		
		return $query;
	}
	public function Retrive_Education_Record_Row($table, $id, $column_name)
	{
		$this->db->where ( 'a.' . $column_name . " = '" . addslashes ( $id ) . "'" );
		
		$this->db->select ( 'a.*,b.name,c.printable_name' );
		
		$this->db->from ( $table . ' a' );
		
		$this->db->join ( STATE . ' b', 'a.state = b.id', 'LEFT' );
		
		$this->db->join ( COUNTRY . ' c', 'a.country = c.id', 'LEFT' );
		
		$query = $this->db->get ();
		
		$row = $query->row ();
		
		/*
		 * echo $this->db->last_query();
		 *
		 * exit;
		 *
		 * return $query;
		 */
		
		return $row;
	}
	public function Retrive_Employer_Record_Row($table, $id, $column_name)
	{
		$this->db->where ( 'a.' . $column_name . " = '" . addslashes ( $id ) . "'" );
		
		$this->db->select ( 'a.*,b.name,c.printable_name' );
		
		$this->db->from ( $table . ' a' );
		
		$this->db->join ( STATE . ' b', 'a.state = b.id', 'LEFT' );
		
		$this->db->join ( COUNTRY . ' c', 'a.country = c.id', 'LEFT' );
		
		$query = $this->db->get ();
		
		$row = $query->row ();
		
		/*
		 * echo $this->db->last_query();
		 *
		 * exit;
		 *
		 * return $query;
		 */
		
		return $row;
	}
	public function Retrieve_Job_Record_Row($table_name, $id, $column_name)
	
	{
		$this->db->where ( 'a.' . $column_name . " = '" . addslashes ( $id ) . "'" );
		
		$this->db->select ( 'a.*,b.printable_name,c.name as state_name,d.name' );
		
		$this->db->from ( $table_name . ' a' );
		
		$this->db->join ( COUNTRY . ' b', 'a.country = b.id', 'LEFT' );
		
		$this->db->join ( STATE . ' c', 'a.state = c.id', 'LEFT' );
		
		$this->db->join ( POSITIONTYPE . ' d', 'a.positionType = d.id', 'LEFT' );
		
		$query = $this->db->get ();
		
		$row = $query->row ();
		
		return $row;
	}
	public function Retrieve_all_job_Record($table_name, $order_by_fld, $order_by, $offset, $limit)
	
	{
		
		// $this->db->where($where_clause);
		$this->db->select ( 'a.*,b.printable_name,c.name as state_name,d.name' );
		
		$this->db->from ( $table_name . ' a' );
		
		$this->db->limit ( $limit, $offset );
		
		$this->db->order_by ( $order_by_fld, $order_by );
		
		$this->db->join ( COUNTRY . ' b', 'a.country = b.id', 'LEFT' );
		
		$this->db->join ( STATE . ' c', 'a.state = c.id', 'LEFT' );
		
		$this->db->join ( POSITIONTYPE . ' d', 'a.positionType = d.id', 'LEFT' );
		
		$query = $this->db->get ();
		
		// $row = $query->row();
		
		return $query;
	}
	public function Retrieve_Employer($table_name, $id, $column_name)
	
	{
		$this->db->where ( 'a.' . $column_name . " = '" . addslashes ( $id ) . "'" );
		
		$this->db->select ( 'a.*,b.printable_name,c.name as state_name' );
		
		$this->db->from ( $table_name . ' a' );
		
		$this->db->join ( COUNTRY . ' b', 'a.country = b.id', 'LEFT' );
		
		$this->db->join ( STATE . ' c', 'a.state = c.id', 'LEFT' );
		
		// $this->db->join(INDUSTRY.' d','a.industry = d.id','LEFT');
		
		$query = $this->db->get ();
		
		// $row = $query->row();
		
		return $query;
	}
	public function Retrieve_Admin_Employer($table_name, $id, $column_name)
	
	{
		$this->db->where ( 'a.' . $column_name . " = '" . addslashes ( $id ) . "'" );
		
		$this->db->select ( 'a.*,b.printable_name as country_name,c.name as state_name,d.name as industry_name' );
		
		$this->db->from ( $table_name . ' a' );
		
		$this->db->join ( COUNTRY . ' b', 'a.country = b.id', 'LEFT' );
		
		$this->db->join ( STATE . ' c', 'a.state = c.id', 'LEFT' );
		
		$this->db->join ( INDUSTRY . ' d', 'a.industryType = d.id', 'LEFT' );
		
		$query = $this->db->get ();
		
		// $row = $query->row();
		
		return $query;
	}
	public function Email_exists($email)
	{
		$sql = "SELECT * FROM " . USER . " WHERE email='" . $email . "'";
		
		$query = $this->db->query ( $sql );
		
		$row = $query->num_rows ();
		
		// echo $this->db->last_query();
		
		return $row;
	} // end of Retrive_User
	public function employerEmailExists($email)
	{
		$sql = "SELECT * FROM " . EMPLOYERUSER . " WHERE email='" . $email . "'";
		
		$query = $this->db->query ( $sql );
		
		$row = $query->num_rows ();
		
		// echo $this->db->last_query();
		
		return $row;
	} // end of Retrive_User
	public function subscriptionEmailExists($email)
	{
		$sql = "SELECT * FROM t_subscription WHERE email='" . $email . "'";
		
		$query = $this->db->query ( $sql );
		
		$row = $query->num_rows ();
		
		// echo $this->db->last_query();
		
		return $row;
	} // end of Retrive_User
	public function get_all_records_joined($where_clause, $table, $table1, $paredntId, $chilcId)
	{
		$this->db->order_by ( "order_id", "ASC" );
		
		if ($where_clause != '')
			
			$this->db->where ( $where_clause );
		
		$this->db->select ( 'M1.*, M2.*' );
		
		$this->db->from ( $table . ' AS M1 LEFT JOIN ' . $table1 . ' AS M2 ON M1.' . $paredntId . '=M2.' . $chilcId . '' );
		
		$query = $this->db->get ();
		
		// echo $this->db->last_query();
		
		return $query;
	}
	public function countAllJoined($where_clause, $table, $table1, $paredntId, $chilcId)
	{
		if ($where_clause != '')
			
			$this->db->where ( $where_clause );
		
		$this->db->select ( 'M1.*, M2.*' );
		
		$this->db->from ( $table . ' AS M1 LEFT JOIN ' . $table1 . ' AS M2 ON M1.' . $paredntId . '=M2.' . $chilcId . '' );
		
		$query = $this->db->get ();
		
		$tot_rec = $query->num_rows ();
		
		// echo $this->db->last_query();
		
		return $tot_rec;
	} // end of countAll
	public function get_appliedjobs_records($table, $where_clause, $id)
	
	{
		$this->db->where ( $where_clause );
		
		$this->db->select ( 'a.*,b.jobTitle,c.name as jobseeker_name' );
		
		$this->db->from ( $table . ' a' );
		
		$this->db->join ( JOBPOST . ' b', 'a.jobId = b.id', 'b.userPostedId = ' . $id . ' ', 'LEFT' );
		
		$this->db->join ( USER . ' c', 'a.JobseekerId = c.id', 'LEFT' );
		
		$query = $this->db->get ();
		
		return $query;
		
		// echo $this->db->last_query();
	}
	public function get_city($q)
	{
		$sql = "SELECT city_name FROM " . CITY . " WHERE city_name LIKE '%" . $q . "%' LIMIT 5 ";
		
		$query = $this->db->query ( $sql );
		
		return $result_arr = $query->result ();
	}
	public function search($table_name, $fname, $email)
	{
		if ($fname != "" and $email != "")
		
		{
			
			$this->db->where ( 'fname', $fname );
			
			$this->db->where ( 'email', $email );
			
			$this->db->select ( '*' );
			
			$this->db->from ( $table_name );
			
			$query = $this->db->get ();
			
			return $query;
		}
		
		elseif ($fname != "")
		
		{
			
			$this->db->where ( 'fname', $fname );
			
			$this->db->select ( '*' );
			
			$this->db->from ( $table_name );
			
			$query = $this->db->get ();
			
			return $query;
		}
		
		else
		
		{
			
			$this->db->where ( 'email', $email );
			
			$this->db->select ( '*' );
			
			$this->db->from ( $table_name );
			
			$query = $this->db->get ();
			
			return $query;
		}
	} // end of get_all_records
	
	/* -------------------------SOM-9-Sep-2015-starts----------------------------- */
	public function deleteAsPerCustomField($table_name, $field, $id)
	{
		$this->db->where ( $field, $id );
		
		$this->db->delete ( $table_name );
	}
	public function addRecordCustom($table_name, $data)
	{
		$this->db->insert ( $table_name, $data );
	}
	public function getJobSeekerResumeBuilderBasicInfo()
	{
		$sql = '
		SELECT a.*
		FROM 	`t_build_resume` as a
		WHERE 	a.`seeker_id`=' . $this->session->userdata ( 'JOBSEEKER_ID' );
		
		$query = $this->db->query ( $sql );
		
		return $query->result ();
	}
	public function getJobSeekerResumeBuilderSkillInfo()
	{
		$sql = '
		SELECT b.*
		FROM 	`t_build_resume` as a,
				`t_build_resume_skills` as b
		WHERE 	a.`seeker_id`=' . $this->session->userdata ( 'JOBSEEKER_ID' ) . ' AND 
				a.`status`="y" AND a.`id`=b.`build_resume_id`';
		
		$query = $this->db->query ( $sql );
		
		return $query->result ();
	}
	public function getJobSeekerResumeBuilderWorkInfo()
	{
		$sql = '
		SELECT b.*
		FROM 	`t_build_resume` as a,
				`t_build_resume_work_exp` as b
		WHERE 	a.`seeker_id`=' . $this->session->userdata ( 'JOBSEEKER_ID' ) . ' AND 
				a.`status`="y" AND a.`id`=b.`build_resume_id`';
		
		$query = $this->db->query ( $sql );
		
		return $query->result ();
	}
	public function getJobSeekerResumeBuilderProInfo()
	{
		$sql = '
		SELECT b.*
		FROM 	`t_build_resume` as a,
				`t_build_resume_project` as b
		WHERE 	a.`seeker_id`=' . $this->session->userdata ( 'JOBSEEKER_ID' ) . ' AND 
				a.`status`="y" AND a.`id`=b.`build_resume_id`';
		
		$query = $this->db->query ( $sql );
		
		return $query->result ();
	}
	public function getJobSeekerResumeBuilderEduInfo()
	{
		$sql = '
		SELECT b.*
		FROM 	`t_build_resume` as a,
				`t_build_resume_study` as b
		WHERE 	a.`seeker_id`=' . $this->session->userdata ( 'JOBSEEKER_ID' ) . ' AND 
				a.`status`="y" AND a.`id`=b.`build_resume_id`';
		
		$query = $this->db->query ( $sql );
		
		return $query->result ();
	}
	public function getJobSeekerResumeBuilderCertInfo()
	{
		$sql = '
		SELECT b.*
		FROM 	`t_build_resume` as a,
				`t_build_resume_certification` as b
		WHERE 	a.`seeker_id`=' . $this->session->userdata ( 'JOBSEEKER_ID' ) . ' AND 
				a.`status`="y" AND a.`id`=b.`build_resume_id`';
		
		$query = $this->db->query ( $sql );
		
		return $query->result ();
	}
	public function UpdateCustomizedRecord($table, $data, $id)
	{
		$this->db->where ( 'id', $id );
		
		$this->db->update ( $table, $data );
	}
	public function getSpecificFieldFromTable($field, $table, $whereField = '', $whereValue = '', $distinct = '')
	{
		$sql = '';
		
		if ($distinct == 'distinct')
		{
			
			$sql = "SELECT distinct(" . $field . ") FROM `" . $table . "` ";
		}
		else
		{
			
			$sql = "SELECT " . $field . " FROM `" . $table . "` ";
		}
		
		if ($whereField != '' && $whereValue != '')
		{
			
			$sql .= " WHERE " . $whereField . " = '" . $whereValue . "' ";
		}
		
		$query = $this->db->query ( $sql );
		
		return $query->result ();
	}
	public function Retrive_Record_Column($table, $id, $column_name, $arg_order = '')
	{
		$this->db->where ( $column_name . " = '" . addslashes ( $id ) . "'" );
		
		$this->db->select ( '*' );
		
		$this->db->from ( $table );
		
		if ($arg_order != '')
		{
			
			$this->db->order_by ( $arg_order, "desc" );
		}
		
		$query = $this->db->get ();
		
		return $query;
	}
	
	/* ----------------------SOM-9-Sep-2015-ends----------------------------- */
}

// end of class

?>