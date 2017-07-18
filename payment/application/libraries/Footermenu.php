<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Footermenu {
	
	public function get_all_footer_menu() {
	 	$this->ci =& get_instance();
		$level = 0;
		$this->ci->db->where("parent_id ='0' and is_active ='1'");
		$this->ci->db->select("*");
		$this->ci->db->from(FOOTER_MENU);
		$this->ci->db->order_by("order","ASC");
		$query = $this->ci->db->get();
		$sub_ids =  '';
		$menu = '';
		if ($query->num_rows() > 0)
		{
			$i = 0;
			foreach ($query->result() as $row)
			{
				$i++;
				$select_class = '';
				$sub_menu_sql = "SELECT * FROM ".FOOTER_MENU." WHERE parent_id='".$row->id."'" ;
				$sub_menu_query = $this->ci->db->query($sub_menu_sql);
				
				if($sub_menu_query->num_rows() > 0)
				{
					$sub_ids .= $row->id.',';
				}
				
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
					
				$menu .= '<li><a href="'.$link.'" style="text-decoration:none;"><h3>'.$row->title.'</h3></a>';
				$menu .= $this->get_all_footer_submenu($row->id,$level);
				$menu .= '</li>';
				
				if($i == 5){ $i = 0; $menu .= "</ul><ul>"; }
			}
		}
		return $menu; 
	}
	

	public function get_all_footer_submenu($id,$level) 
	{
		$submenu .= '<ul>';

		$where_clause = "parent_id ='".$id."' and is_active ='1'";
		$this->ci->db->where($where_clause);
		$this->ci->db->select("*");
		$this->ci->db->from(FOOTER_MENU);
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

			$submenu .= '<li><a href="'.$link.'">'.$row->title.'</a>';
			//$submenu .= $this->get_all_child_submenu($row->id);
			$submenu .= '</li>';
		}

		$submenu .= '</ul>';
		
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
					$link = base_url().'cms/view/'.$row->cms_slug;

				 $child_menu .= '<li><a href="'.$link.'">'.$row->title.'</a>';
				 $child_menu .= $this->get_all_child_submenu($row->id);
				 $child_menu .= '</li>';
			}
			$child_menu .= '</ul>';
		}
		
		return $child_menu;
	}
}

?>