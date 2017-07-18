<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_settings{
	public function settings(){
		$this->ci =& get_instance();
		$this->ci->db->where("id ='1'");
		$this->ci->db->from(SITE_SETTINGS);
		//$this->ci->db->order_by("order","ASC");
		$query = $this->ci->db->get();
		$row = $query->row_array();
		return $row;
		
	}

	public function mySiteFriends(){
		$this->ci->db->select('*');
		$this->ci->db->from(''.USER.' as a');
		$this->ci->db->join(''.FRIEND.' as b', 'a.id = b.friends_id', 'left' );
		$this->ci->db->where('email IS NOT NULL', null); 
		$this->ci->db->where('user_id', $this->ci->session->userdata('USER_ID')); 
		$this->ci->db->order_by("b.friends_id", "random");
		$query = $this->ci->db->get();
		$siteFriends = $query->result_array();
		return $siteFriends;
	}	
	public function social_media(){
		$this->ci->db->order_by("order_id","ASC");
		$this->ci->db->where("status ='Y'");
		$this->ci->db->select("*");
		$this->ci->db->from(SOCIALMEDIA);
		$social_query = $this->ci->db->get();
		return $social_query;		
	}


	public function get_all_header_menu() {
		//echo 'fsdfsdf'.$this->ci->controllerFile;
		$cusControlerFile=str_replace("_", "", $this->ci->controllerFile);
		$level = 0;
		$this->ci->db->order_by("order_id","ASC");
		$this->ci->db->where("parent_id ='0' and status ='Y'");
		$this->ci->db->select("*");
		$this->ci->db->from(HEADER_MENU);
		$query = $this->ci->db->get();
		$sub_ids =  '';
		$menu = '<ul id="nav" class="dropdown dropdown-horizontal">';
		$cat_slug = $this->ci->uri->segment(1);
		/*echo $this->ci->uri->segment(1);
		print_r($this->ci->uri->segment(1));
		echo 'fsdfsdf'.$cat_slug; */
		if($cat_slug !='')
			$this->ci->session->set_userdata('CAT_SLUG', $cat_slug);

		


		if ($query->num_rows() > 0)
		{
			$no = 0;
			foreach ($query->result() as $row)
			{ 
				$no++;
				$select_class = '';
				$sub_menu_sql = "SELECT * FROM ".HEADER_MENU." WHERE parent_id='".$row->id."' and status ='Y'" ;
				$sub_menu_query = $this->ci->db->query($sub_menu_sql);
				
				if($row->type == 'custom')
				{
					$link = $row->custom_link;
					
					$custom_title = $row->title;
					$custom_title = str_replace (" ", "", $custom_title);
					if($cusControlerFile==strtolower($custom_title))
						$select_class = 'class="active"';
				
				}
				if($row->type == 'cms'){
					$link = base_url().$row->cms_slug;
					$page_name =$this->ci->uri->segment(1);
					if($this->ci->controllerFile=='cms' && $page_name==$row->cms_slug)
						$select_class = 'class="selected"';
				}
				if($row->type == 'category'){
					$link = base_url().$row_city['slug'].'/events/'.$row->cat_slug;
					$page_name =$this->ci->uri->segment(1);
					
					if($this->ci->session->userdata('CAT_SLUG')==$row->cat_slug)
					//$select_class = 'class="selected"';
					$select_class = 'class="active"';

				}
				
				$menu .= '<li id="'.$row->id.'"><a href="'.$link.'" title="'.$row->title.'" '.$select_class;
				if($sub_menu_query->num_rows() > 0)
				{
					$menu .= ' rel="ddsubmenu'.$row->id.'"';
					$sub_ids .= $row->id.',';
				}
					
				$menu .= '>'.stripslashes($row->title).'</a>';			
				$sub_ids = substr($sub_ids,0,-1);
				$menu .=$this->get_all_child_submenu($row->id,$level,$row_city['slug']);
				$menu .='</li>';
			}
			$menu .= '</ul>';

		}
		
		//echo $menu_dropdown; 		
		//exit;
		//echo $this->db->last_query();
		return $menu; 
	}

	
	public function get_all_child_submenu($id,$level,$city)
	{
		$level++;
		$child_menu = '';
		$this->ci->db->order_by("order_id","ASC");
		$where_clause = "parent_id ='".$id."' and status='Y'";
		$this->ci->db->where($where_clause);
		$this->ci->db->select("*");
		$this->ci->db->from(HEADER_MENU);
		$query = $this->ci->db->get();
		//echo $this->db->last_query();


		$this->ci->db->where("id = '".$id."'");
		$this->ci->db->select("*");
		$this->ci->db->from(HEADER_MENU);
		$parent_query = $this->ci->db->get();
		$parent_cat = $parent_query->row_array();
		if($cat_slug !='')
			$this->ci->session->set_userdata('CAT_SLUG', $cat_slug);

		if($query->num_rows()>0)
		{

			$child_menu .= '<ul>';
			$count = 0;
			foreach ($query->result() as $row)
			{
				$count++;
				if($level>1 && $count==1)
					$style_class = 	'style="padding-left:65px"';
				else
					$style_class = '';
				if($row->type == 'custom')
					$link = $row->custom_link;
				if($row->type == 'cms')
					$link = base_url().$row->cms_slug;
				if($row->type == 'category')
					$link = base_url().$city.'/events/'.$parent_cat['cat_slug'].'/'.$row->cat_slug;

				 $child_menu .= '<li '.$style_class.' id="'.$row->id.'"><a href="'.$link.'">'.stripslashes($row->title).'</a>';
				 $child_menu .= $this->get_all_child_submenu($row->id,$level,$city);
				 $child_menu .= '</li>';
			}
			$child_menu .= '</ul>';
		}
		
		return $child_menu;
	}


	public function get_all_footer_menu() {
		$level = 0;
		$this->ci->db->order_by("order_id","ASC");
		$this->ci->db->where("parent_id ='0' and status ='Y'");
		$this->ci->db->select("*");
		$this->ci->db->from(FOOTER_MENU);
		$query = $this->ci->db->get();
		$sub_ids =  '';
		$menu = '';

		if($cat_slug !='')
			$this->ci->session->set_userdata('CAT_SLUG', $cat_slug);
		

		if ($query->num_rows() > 0)
		{
			$no = 0;
			foreach ($query->result() as $row)
			{ 
				$no++;
				$sub_menu_sql = "SELECT * FROM ".FOOTER_MENU." WHERE parent_id='".$row->id."' and status ='Y'" ;
				$sub_menu_query = $this->ci->db->query($sub_menu_sql);
				
				if($row->type == 'custom')
				{
					$link = $row->custom_link;
					$custom_title = $row->title;
					$custom_title = str_replace (" ", "", $custom_title);
				}
				if($row->type == 'cms'){
					$link = base_url().$row->cms_slug;
					$page_name =$this->ci->uri->segment(3);
				}
				if($row->type == 'category'){
					$link = base_url().$row_city['slug'].'/events/'.$row->cat_slug;
					$page_name =$this->ci->uri->segment(3);
				}
				
				$menu .= '<div class="footer_top_l"><h3>'.stripslashes($row->title).'</h3>';			
				//$sub_ids = substr($sub_ids,0,-1);
				$menu .=$this->get_all_child_footer_submenu($row->id,$level,$row_city['slug']);
				$menu .='</div>';
			}

		}
		
		//echo $menu_dropdown; 		
		//exit;
		//echo $this->db->last_query();
		return $menu; 
	}

	
	public function get_all_child_footer_submenu($id,$level,$city)
	{
		$level++;
		$child_menu = '';
		$this->ci->db->order_by("order_id","ASC");
		$where_clause = "parent_id ='".$id."' and status='Y'";
		$this->ci->db->where($where_clause);
		$this->ci->db->select("*");
		$this->ci->db->from(FOOTER_MENU);
		$query = $this->ci->db->get();
		//echo $this->db->last_query();


		$this->ci->db->where("id = '".$id."'");
		$this->ci->db->select("*");
		$this->ci->db->from(FOOTER_MENU );
		$parent_query = $this->ci->db->get();
		$parent_cat = $parent_query->row_array();

		if($query->num_rows()>0)
		{

			$child_menu .= '<p>';
			$count = 0;
			foreach ($query->result() as $row)
			{
				$count++;

				if($row->type == 'custom')
					$link = $row->custom_link;
				if($row->type == 'cms')
					$link = base_url().$row->cms_slug;
				if($row->type == 'category')
					$link = base_url().$city.'/events/'.$parent_cat['cat_slug'].'/'.$row->cat_slug;

				 $child_menu .= '<a href="'.$link.'">'.stripslashes($row->title).'</a><br />';
				 $child_menu .= $this->get_all_child_footer_submenu($row->id,$level,$city);
			}
			$child_menu .= '</p>';
		}
		
		return $child_menu;
	}



	public function chk_location_by_ip()
	{
			if (getenv('HTTP_X_FORWARDED_FOR')) 
				$ip=getenv('HTTP_X_FORWARDED_FOR');
			else
				$ip=getenv('REMOTE_ADDR');

			require_once("ip2locationlite/ip2locationlite.class.php");
			$ipLite = new ip2location_lite;
			$ipLite->setKey('02c2645d64707d74ef7be0a10aa5fbb161720e8a1654590a8eb9b7d0c7df8f8f');
			$locations = $ipLite->getCity($ip);
			$errors = $ipLite->getError();
			$city_name = strtolower($locations['cityName']);		
			$this->ci->db->where("city_name = '".$city_name."'");
			$this->ci->db->from(CITY);
			$query = $this->ci->db->get();
			$row = $query->row_array();
			$city_id  =  $row['id'];

			if($city_id == '')
				$city_id = 59;
			return $city_id;
	}

/*	public function more_cat()
	{
		$this->ci->db->select('C.*');
		$this->ci->db->where('M.cat_id IS NULL AND C.parent_id = 0 AND C.status = "Y"');
		$this->ci->db->from(CATEGORY.' AS C LEFT JOIN '.HEADER_MENU.' AS M ON M.cat_id = C.id');
		$query = $this->ci->db->get();

		return $query;
	}*/
	
}