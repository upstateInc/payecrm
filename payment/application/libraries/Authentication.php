<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication {
    function is_loggedin($session_param)
    {
		if(empty($session_param)){
			ci_redirect(base_url());
			return false;
		}
	}
	function is_loggedin_form($session_param)
    {
		if(!empty($session_param)){
		$CI =& get_instance();
		//if($CI->session->userdata('ADMINREFFER')!="");
			ci_redirect(base_url().'dashboard');
			return false;
		}
	}
	/*************Employer Login****************/
	function employer_is_loggedin($session_param)
    {
		if(empty($session_param)){
			ci_redirect(base_url().'employer');
			return false;
		}
	}
	function employer_is_loggedin_form($session_param)
    {
		if(!empty($session_param)){
		$CI =& get_instance();
		//if($CI->session->userdata('ADMINREFFER')!="");
			ci_redirect(base_url().'employer/dashboard');
			return false;
		}
	}
	
	/******************************************/
	function user_is_loggedin($session_param)
    {
		if(empty($session_param)){
			ci_redirect(base_url());
			return false;
		}
	}
	function user_is_loggedin_form($session_param)
    {
		if(!empty($session_param)){
		$CI =& get_instance();
		//if($CI->session->userdata('ADMINREFFER')!="");
			ci_redirect(base_url().'dashboard');
			return false;
		}
	}
	function user_is_jobseeker($session_param)
	{
	 if($session_param != "jobseeker")
	 {
	  $CI =& get_instance();
	  if($session_param = "employer")
	  {
	   ci_redirect(base_url().'dashboard');
			return false;
			}
	    if($session_param = "admin")
	  {
	   ci_redirect(base_url().'admin/dashboard');
			return false;
			}		
	 }
	}
	function user_is_employer($session_param)
	{
	 if($session_param != "employer")
	 {
	  $CI =& get_instance();
	  if($session_param = "jobseeker")
	  {
	   ci_redirect(base_url().'dashboard');
			return false;
			}
	    if($session_param = "admin")
	  {
	   ci_redirect(base_url().'admin/dashboard');
			return false;
			}		
	 }
	}
	function admin_is_loggedin($session_param)
    {	
		/*$CI =& get_instance();
		$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		if($referer!=''){
			$CI->session->set_userdata('ADMINREFFER', $referer);
		}
		//echo $CI->session->userdata('ADMINREFFER');
		if(empty($session_param)){
			ci_redirect(base_url()."admin");
			return false;
		}*/
		if(empty($session_param)){
			//ci_redirect(base_url().'admin/home');
			return false;
		}
	}
	function admin_is_loggedin_form($session_param)
    {	
		
		if(!empty($session_param)){
		$CI =& get_instance();
		//if($CI->session->userdata('ADMINREFFER')!="");
			ci_redirect(base_url().'admin/dashboard');
			return false;
		}
	}
	
	
	function GetImage(){

    $ci=& get_instance();
    $ci->load->database();
 
    //select the required fields from the database
    $ci->db->select('image');
	
    //tell the db class the criteria
	$ci->db->where('user_id', $ci->session->userdata('USER_ID'));
 
    //supply the table name and get the data
    $query = $ci->db->get('t_userLogin');
 
    // return the full name;
    return $query->result(); 
        
    }
}

?>