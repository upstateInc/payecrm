<?php
class Menu_model extends CI_Model {

	public function __construct() {
	
		parent::__construct();
	}

	public function get_all_menu($selected,$where_clause,$table) {
		$level = 0;
		$this->db->order_by("order_id","ASC");
		$where_clause_2 = "parent_id ='0'".$where_clause;
		$this->db->where($where_clause_2);
		$this->db->select("*");
		$this->db->from($table);
		$query = $this->db->get();
		$menu_dropdown = '<select name="parent_id" style="width:210px;font-weight:normal"><option value="">-Root-</option>';
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{ 
				$menu_dropdown .= '<option value="'.$row->id.'" style="font-weight:bold;font-size:12px"';
				if($selected == $row->id)
					$menu_dropdown .= 'selected' ;

				$menu_dropdown .= '>'.$row->title.'</option>';
				$menu_dropdown .= $this->get_all_submenu($row->id,$level,$selected,$table,$where_clause);
			}
			$menu_dropdown .= '</select>';

		}
		
		//echo $menu_dropdown; 		
		//exit;
		//echo $this->db->last_query();
		return $menu_dropdown; 
	}

	public function get_all_submenu($id,$level,$selected,$table,$where_clause) {
		$level ++;
		$this->db->order_by("order_id","ASC");
		$where_clause_2 = "parent_id ='".$id."'".$where_clause;
		$this->db->where($where_clause_2);
		$this->db->select("*");
		$this->db->from($table);
		$query = $this->db->get();
		$submenu_dropdown = '';
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
				$submenu_dropdown .= '<option value="'.$row->id.'"';
				if($selected == $row->id)
					$submenu_dropdown .= 'selected' ;
				$submenu_dropdown .= '>'.$var.' '.$row->title.'</option>';
				$submenu_dropdown .= $this->get_all_submenu($row->id,$level,$selected,$table,$where_clause);
			}

		}
		//echo $this->db->last_query();
		return $submenu_dropdown; 
	}

	public function get_all_records($where_clause,$table) {	
		$this->db->order_by("order_id","ASC");
		if($where_clause != '')
			$this->db->where($where_clause);
		$this->db->select('M1.*, M2.title AS parent_title');
		$this->db->from($table.' AS M1 LEFT JOIN '.$table.' AS M2 ON M1.parent_id=M2.id');
		$query = $this->db->get();  
		//echo $this->db->last_query();
		return $query; 
	}

	public function get_all_menu_id($table) {
		$this->db->order_by("order_id","ASC");
		$this->db->where("parent_id ='0'");
		$this->db->select("*");
		$this->db->from($table);
		$query = $this->db->get();
		$menu_ids = '';
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{ 
				$menu_ids .= $row->id.',';
				$sub_menu_ids = $this->get_all_submenu_id($row->id,$table);
				$menu_ids .= $sub_menu_ids;
			}
			$menu_ids = substr($menu_ids,0,-1);

		}
		
		//print_r($menu_ids); 		
		//exit;
		//echo $this->db->last_query();
		return $menu_ids; 
	}

	public function get_all_submenu_id($parent_id,$table) {	
		$this->db->order_by("order_id","ASC");
		$where_clause = "parent_id = '".$parent_id."'" ;
			$this->db->where($where_clause);
		$this->db->select("*");
		$this->db->from($table);
		$query = $this->db->get(); 
		$sub_menu_ids = '';
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$sub_menu_ids .= $row->id.',';
				$sub_menu_ids .= $this->get_all_submenu_id($row->id,$table);
			}
		}
		//echo $this->db->last_query();
		return $sub_menu_ids; 
	}


	public function get_all_menu_list($table,$where_clause) {
		$level = 0;
		$this->db->order_by("order_id","ASC");
		$this->db->where($where_clause);
		//$this->db->where("parent_id ='0'");
		$this->db->select("*");
		$this->db->from($table);
		$query = $this->db->get();
		$menu_llist = '';
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{ 
				($row->status=='Y') ? $status = "<a href=".site_url($this->controllerFile.'/change-is-active/'.$row->id.'/N').">".active_icon()."</a>" : $status = "<a href=".site_url($this->controllerFile.'/change-is-active/'.$row->id.'/Y').">".inactive_icon()."</a>" ;

				$menu_llist .= '<tr>
				<td class="columnDataGrey" align="left"><b>'.stripslashes($row->title).'</b></td>
				<td class="columnDataGrey" align="left"><b>Root</b></td>
				<td class="columnDataGrey" align="left">'.$row->type.'</td>
				<td class="columnDataGrey" align="left">
				<input type="text" name="order[]" id="order_id_'.$row->order_id.'" value="'.$row->order_id.'" size="3" style="text-align:center"/>
				<input type="hidden" name="id[]" value="'.$row->id.'" />
				</td>
				<td class="columnDataGrey" align="left">';
					if($row->status=='Y'){ 
						$val = "'N'";
						$menu_llist .= '<div id="statusDiv'.$row->id.'">
						<a href="javascript: void(0);" onclick="javascript: change_status('.$row->id.','.$val.');">'.active_icon().'</a></div>';
					 }else{ 
						$val = "'Y'";
						$menu_llist .= '<div id="statusDiv'.$row->id.'">
						<a href="javascript: void(0);" onclick="javascript: change_status('.$row->id.','.$val.');">'.inactive_icon().'</a></div>';
						} 
				$menu_llist .= '</td>
				<td class="columnDataGrey" align="left">
				<a href="'.base_url().$this->controllerFile.'/edit/'.$row->id.'">'.edit_icon().'</a>';
				
				if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ 
				$menu_llist .= '<a href="#" onclick="javascript: chk_delete('.$row->id.');">'.delete_icon().'</a>';
				}
				$menu_llist .= '</td></tr>';
				$menu_llist .= $this->get_all_submenu_list($row->id,$level,$table);
			}
		}
		else
		{
			$menu_llist .= '<tr><td class="columnDataGrey" align="left" colspan="4">No Records Available</td></tr>';
		}
		return $menu_llist; 
	}


	public function get_all_submenu_list($id,$level,$table) {
		$level ++;
		$this->db->order_by("order_id","ASC");
		$where_clause = "M1.parent_id ='".$id."'";
		$this->db->where($where_clause);
		$this->db->select('M1.*, M2.title AS parent_title');
		$this->db->from($table.' AS M1 LEFT JOIN '.$table.' AS M2 ON M1.parent_id=M2.id');
		$query = $this->db->get();
		$submenu_list = '';
		$var = '-';
		for($i=0;$i<$level;$i++)
		{
			$var .= $var;
		}
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				
				$submenu_list .= '<tr>
				<td class="columnDataGrey" align="left">'.$var.stripslashes($row->title).'</td>
				<td class="columnDataGrey" align="left">'.$row->parent_title.'</td>
				<td class="columnDataGrey" align="left">'.$row->type.'</td>
				<td class="columnDataGrey" align="left">
				<input type="text" name="order[]" id="order_id_'.$row->order_id.'" value="'.$row->order_id.'" size="3" style="text-align:center"/>
				<input type="hidden" name="id[]" value="'.$row->id.'" />
				</td>
				<td class="columnDataGrey" align="left">';
					if($row->status=='Y'){ 
						$val = "'N'";
						$submenu_list .= '<div id="statusDiv'.$row->id.'">
						<a href="javascript: void(0);" onclick="javascript: change_status('.$row->id.','.$val.');">'.active_icon().'</a></div>';
					 }else{ 
						$val = "'Y'";
						$submenu_list .= '<div id="statusDiv'.$row->id.'">
						<a href="javascript: void(0);" onclick="javascript: change_status('.$row->id.','.$val.');">'.inactive_icon().'</a></div>';
						} 
				
				$submenu_list .= '</td>
				<td class="columnDataGrey" align="left">
				<a href="'.base_url().$this->controllerFile.'/edit/'.$row->id.'">'.edit_icon().'</a>';
				
				if($this->session->userdata('ADMIN_TYPE')=='superadmin'){ 
				$submenu_list .= '<a href="#" onclick="javascript: chk_delete('.$row->id.');">'.delete_icon().'</a>';
				}
				$submenu_list .= '</td></tr>';
				$submenu_list .= $this->get_all_submenu_list($row->id,$level,$table);
			}

		}
		//echo $this->db->last_query();
		return $submenu_list; 
	}


	function change_status_of_submenu($table,$id)
	{
		$this->db->where("parent_id ='".$id."'");
		$this->db->select("*");
		$this->db->from($table);
		$query = $this->db->get();

		//$query_submenu = $this->common_model->get_all_records($this->table, "parent_id ='".$id."'","id","ASC","","");
		//print_r($query_submenu->result()); exit;
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row_sub)
			{ 
				$row['status'] = 'N';
				$this->db->where('id', $row_sub->id);
				$this->db->update($table, $row);
				$this->change_status_of_submenu($table, $row_sub->id);
			}
		}
	}

	function delete_submenu($table, $id)
	{
		$this->db->where("parent_id ='".$id."'");
		$this->db->select("*");
		$this->db->from($table);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row_sub)
			{
				$this->db->where('id', $row_sub->id);
				$this->db->delete($table);
				$this->delete_submenu($table, $row_sub->id);
			}
		}
	}
	


	
	
} // end of class