<?php
class Homes extends CI_Model
{
	public function __construct()
	{
		parent::__construct ();
	}
	
	/*
	 * Name : loginCheck
	 * Purpose : to authentication
	 * Parameter : username and password
	 * Return : query;
	 */
	public function loginCheck($user_name, $password)
	{
		$sql = "SELECT * FROM " . ADMINUSER . " WHERE email='" . $user_name . "' AND password='" . $password . "'";
		$query = $this->db->query ( $sql );
		return $query;
	} /* end of login check function */
	
	public function getMenu($parentId = 0)
	{
		$getModule = $this->db->query ( "select a.id as moduleId, a.module, a.parent, a.weightage, a.moduleLink, a.moduleDesc, a.imageClass
			from t_module as a 
			left join t_moduleAction as b on a.id = b.moduleId 
			left join t_action as c on b.actionId=c.id 
			left join t_adminModuleAction as d on b.id=d.moduleActionId 
			where 
			a.status='Y' and 
			b.status='Y' and 
			c.status='Y' and 
			d.status='Y' and 
			d.adminTypeId='" . $this->session->userdata ( 'ADMINTYPE' ) . "' and 
			d.adminLevelId='" . $this->session->userdata ( 'ADMINLEVEL' ) . "' and 
			b.actionId='1' and 
			a.parent=" . $parentId . " order by a.weightage asc
		" );
		return $getModule;
	}
} /* end of class */
?>