<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html'));
		$this->load->library(array('session','form_validation','authentication'));
		$this->load->model(array('homes','common_model'));
		$this->authentication->is_loggedin_form($this->session->userdata('ADMIN_ID'));
		$this->viewfolder = '';
	}
	
	public function index()
	{
		$data['message'] = ''; 
		$this->load->view('login',$data); 
	}
	
	public function login() 
	{

		$user_name = $this->input->post('email');
		$user_password = $this->input->post('password');
		//$user_password = $this->common_model->base64En(2,$user_password);
		$user_password = md5($user_password);
		
		/* checking validation */
		$this->form_validation->set_rules('email', 'Admin ID', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required'); 
		$this->form_validation->set_message('required', '%s can not be blank'); 
		/* end of validation checking */
		
		if ($this->form_validation->run() == FALSE) {  /* checking blank condition */	
			$data['message'] = ''; 
			$this->load->view('login',$data); 
		} else {
			$query = $this->homes->loginCheck($user_name,$user_password); 

			if ($query->num_rows() > 0) 
			{ 
				$row = $query->row(); 

				if($row->status=='Y')
				{
						$this->session->set_userdata('ADMIN_FNAME', $row->fname); 
						$this->session->set_userdata('ADMIN_LNAME', $row->lname); 
						$this->session->set_userdata('ADMIN_ALIASNAME', $row->alias); 
						$this->session->set_userdata('ADMIN_ID', $row->id); 
						$adminLevel=$this->db->query("select b.id,b.level from ".ADMINADMINLEVEL." as a left join ".ADMINLEVEL." as b on a.adminLevelId=b.id where a.adminId=".$this->session->userdata('ADMIN_ID'))->row();
						$adminType=$this->db->query("select b.id,b.type from ".ADMINADMINTYPE." as a left join ".ADMINTYPE." as b on a.adminTypeId=b.id where a.adminId=".$this->session->userdata('ADMIN_ID'))->row();
						$this->session->set_userdata('ADMINTYPE', $adminType->id);
						$this->session->set_userdata('ADMINLEVEL', $adminLevel->id);				
						
						$this->session->set_userdata('ADMINTYPENAME', $adminType->type);
						$this->session->set_userdata('ADMINLEVELNAME', $adminLevel->level);
						$this->session->set_userdata('ADMIN_IMG', $row->image);
						/*$this->session->set_userdata('ADMIN_TYPE', $row->type); 
						$this->session->set_userdata('ADMIN_IMG', $row->image); 
						$this->session->set_userdata('ADMIN_PERMISSION', $row->adminPermission); 
						$this->session->set_userdata('ADMIN_GROUP_ID', $row->groupId); 
						$this->session->set_userdata('ADMIN_COMPANYID', $row->companyID); 
						$this->session->set_userdata('ADMIN_NOMINEEID', $row->nomineeID); 
						$this->session->set_userdata('ADMIN_TECH_SUPPORT', $row->tech_support);
						$lastloginquery = $this->common_model->Retrive_Record_By_Where_Clause(LOGINDETILS,"adminId = '".$row->id."' order by id desc limit 0,1");
						if($lastloginquery['logoutTime']>0){
							$data['adminId'] = $row->id;
							$data['loginTime'] = date('y-m-d H:i:s');
							$insert_id = $this->common_model->addRecord(LOGINDETILS,$data);
							$this->session->set_userdata('LOGIN_ID', $insert_id);
						}else{
							$this->session->set_userdata('LOGIN_ID', $lastloginquery['id']);
						}*/
						ci_redirect(base_url().$this->viewfolder.'dashboard');  
				}
				else
				{
					$message = "Account is blocked.";
				}
			} 
			else { 
				$message = "Invalid username/password."; 
			} 
			 
			if($message != '') { 
				$message = setMessage($message,"error");
				$data['message'] = $message;
				//$this->session->set_flashdata('message', $message);
			}

			$username = "";
			$password = "";
			$data['username'] = $username;
			$data['password'] = $password;
			/*echo $message;
			exit;*/
			$this->load->view('login',$data); 
		}
	
	}   /* end of login */

	
}
