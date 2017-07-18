<?php
class Homes extends CI_Model { 

	public function __construct() { 
		parent::__construct(); 
	}
	
	/*
	Name : loginCheck
	Purpose : to authentication
	Parameter : username and password
	Return : query;
	*/
	public function loginCheck($user_name,$password) 
	{
		//$sql = "SELECT id as id, email, type, status FROM ".ADMINUSER." WHERE email='".$user_name."' AND passwd='".$password."'" ;
		$sql = "SELECT * FROM ".ADMINUSER." WHERE email='".$user_name."' AND passwd='".$password."'" ;
		$query = $this->db->query($sql);
		return $query;
	} /* end of login check function */	

	

} /* end of class */
?>