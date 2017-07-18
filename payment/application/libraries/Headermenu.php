<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Headermenu {

	
public function get_all_header_menu() {
	 $this->ci =& get_instance();
		$level = 0;
		$this->ci->db->where("parent_id ='0' and is_active ='1'");
		$this->ci->db->select("*");
		$this->ci->db->from(HEADER_MENU);
		$this->ci->db->order_by("order","ASC");
		$query = $this->ci->db->get();
		$sub_ids =  '';
		$menu = '<div class="navigation_l" id="ddtopmenubar"><ul>';
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{ 
				$select_class = '';
				$sub_menu_sql = "SELECT * FROM ".HEADER_MENU." WHERE parent_id='".$row->id."' and is_active ='1'" ;
				$sub_menu_query = $this->ci->db->query($sub_menu_sql);
				
				if($row->type == 'custom')
				{
					$link = $row->custom_link;
					$current_action =  $this->ci->router->fetch_class();
					if($current_action==strtolower($row->title))
						$select_class = 'style="background:#00C7FF;"';
				
				}else
				{
					$cms_id = $row->cms_id;
					$slug_sql = "SELECT * FROM ".CMS." WHERE id='".$cms_id."' and status = 'Y'" ;
					$slug_query = $this->ci->db->query($slug_sql);
					$row_slug = $slug_query->row_array();
					$cms_slug = $row_slug["slug"];
					
					//$link = base_url().'cms/view/'.$row->cms_slug;
					$link = base_url().'cms/'.$cms_slug;
					if($cms_slug == "") $link = "#";
					$page_name = $this->ci->uri->segment(2);
					//if($page_name==$row->cms_slug)
					if($page_name==$cms_slug && $cms_slug!="")
						$select_class = 'style="background:#00C7FF;"';
				}

				$menu .= '<li id="'.$row->id.'"><a href="'.$link.'" title="'.$row->title.'" '.$select_class;
				if($sub_menu_query->num_rows() > 0)
				{
					$menu .= ' rel="ddsubmenu'.$row->id.'"';
					$sub_ids .= $row->id.',';
				}
					
				$menu .= '>'.$row->title.'</a></li>';
			}
			$menu .= '</ul></div>';

			$sub_ids = substr($sub_ids,0,-1);
			$menu .=$this->get_all_header_submenu($sub_ids,$level);
		}
		
		//echo $menu_dropdown; 		
		//exit;
		//echo $this->ci->db->last_query();
		return $menu; 
	}
	

	public function get_all_header_submenu($sub_ids,$level) 
	{
		$submenu = '';
		$sub_id_arr = explode(",",$sub_ids);
		for($i=0;$i< count($sub_id_arr); $i++)
		{
			$id = $sub_id_arr[$i];
			$submenu .= '<ul id="ddsubmenu'.$id.'" class="ddsubmenustyle">';

			$where_clause = "parent_id ='".$id."' and is_active ='1'";
			$this->ci->db->where($where_clause);
			$this->ci->db->select("*");
			$this->ci->db->from(HEADER_MENU);
			$this->ci->db->order_by("order","ASC");
			$query = $this->ci->db->get();
			//echo $this->ci->db->last_query();
			
			foreach ($query->result() as $row)
			{ 
				if($row->type == 'custom')
					$link = $row->custom_link;
				else
				{
					$cms_id = $row->cms_id;
					$slug_sql = "SELECT * FROM ".CMS." WHERE id='".$cms_id."' and status = 'Y'" ;
					$slug_query = $this->ci->db->query($slug_sql);
					$row_slug = $slug_query->row_array();
					$cms_slug = $row_slug["slug"];
					
					//$link = base_url().'cms/view/'.$row->cms_slug;
					$link = base_url().'cms/'.$cms_slug;
					if($cms_slug == "") $link = "#";
				}

				$submenu .= '<li id="'.$row->id.'"><a href="'.$link.'">'.$row->title.'</a>';
				$submenu .= $this->get_all_child_submenu($row->id);
				$submenu .= '</li>';
			}
	
			$submenu .= '</ul>';
		}

		return $submenu;
	}

	public function get_all_child_submenu($id)
	{
		$child_menu = '';
		$where_clause = "parent_id ='".$id."' and is_active='1'";
		$this->ci->db->where($where_clause);
		$this->ci->db->select("*");
		$this->ci->db->from(HEADER_MENU);
		$this->ci->db->order_by("order","ASC");
		$query = $this->ci->db->get();
		
		if($query->num_rows()>0)
		{
			$child_menu .= '<ul>';
			foreach ($query->result() as $row)
			{
				if($row->type == 'custom')
					$link = $row->custom_link;
				else
				{
					$cms_id = $row->cms_id;
					$slug_sql = "SELECT * FROM ".CMS." WHERE id='".$cms_id."' and status = 'Y'" ;
					$slug_query = $this->ci->db->query($slug_sql);
					$row_slug = $slug_query->row_array();
					$cms_slug = $row_slug["slug"];
					
					//$link = base_url().'cms/view/'.$row->cms_slug;
					$link = base_url().'cms/'.$cms_slug;
					if($cms_slug == "") $link = "#";
				}

				 $child_menu .= '<li id="'.$row->id.'"><a href="'.$link.'">'.$row->title.'</a>';
				 $child_menu .= $this->get_all_child_submenu($row->id);
				 $child_menu .= '</li>';
			}
			$child_menu .= '</ul>';
		}
		
		return $child_menu;
	}
}

?>