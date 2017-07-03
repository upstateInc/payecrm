<?php
class Logout extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper(array('url'));
	}
	
	function index() {
		/*$id=$this->session->userdata('LOGIN_ID');
		$row['logoutTime']=date('y-m-d H:i:s');
		$update = $this->common_model->Update_Record($row,LOGINDETILS,$id);
		$this->session->unset_userdata('LOGIN_ID');
		$this->session->unset_userdata('ADMIN_ID');		
		$this->session->unset_userdata('ADMIN_NAME'); 
		$this->session->unset_userdata('ADMIN_ALIASNAME'); 
		$this->session->unset_userdata('ADMIN_TYPE'); 
		$this->session->unset_userdata('ADMIN_IMG');**/
		session_destroy();
		/*setcookie('AgentEmail', NULL, time() - (86400 * 30), '/', '.urinfosoft.com');	*/
				
		$message = "You are successfully logged out.";
		$this->session->set_flashdata('message', $message);
		ci_redirect(site_url(''));
	}
	
}
// end of class
