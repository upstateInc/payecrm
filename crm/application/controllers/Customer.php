<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html','dompdf', 'file'));
		$this->load->library(array('session','authentication','form_validation','email','upload','image_lib','pagination'));
		$this->load->model(array('adminuser','common_model','mail_model'));
		$this->authentication->is_loggedin($this->session->userdata('ADMIN_ID'));
		$this->authentication->is_superAdmin($this->session->userdata('ADMIN_TYPE'));
		$this->table = 't_customer';
		$this->table1 = LOGINDETILS;
		$this->table2 = LOGINFO;
		$this->tableGroup = 't_group';
		$this->tableCenter = 't_centerdb';
		$this->tableCenterGroup = 't_centerGroup';
		$this->viewfolder = 'customer/';
		$this->controllerFile = 'customer/';
		$this->namefile = 'Customer';
	}
	public function index() {
		$message = '';
		$data = array();
		$order_by_fld = 'id';
		$order_by =	'ASC';
		$offset = (int)$this->uri->segment(3,0);
		$limit = 20;
/**********************search*************************************/		
		$where_clause = "";
		$where_clause1 = "";
		if($this->session->userdata('ADMIN_GROUP_ID')!=""){
			$where_clause = '( ';
			$where_clause1 .= '( ';
			//$where_clause .= "groupId = '".$this->session->userdata('ADMIN_GROUP_ID')."' OR "; 
			$centerquery = $this->common_model->get_all_records($this->tableCenterGroup, 'groupId = '.$this->session->userdata('ADMIN_GROUP_ID').'', $order_by_fld, $order_by,'','');
			
			foreach($centerquery->result() as $row){
				$new_where_clause .= "companyID = '".$row->companyID."' OR ";
			}
			$where_clause  .= substr($new_where_clause, 0, -3);
			$where_clause1  .= substr($new_where_clause, 0, -3);
			$where_clause .= ' ) AND ';
			$where_clause1 .= ' ) AND ';
		}		
		if($this->session->userdata('ADMIN_COMPANYID')!=""){
			$where_clause = "companyID = '".$this->session->userdata('ADMIN_COMPANYID')."' AND "; 
			$where_clause1 = "companyID = '".$this->session->userdata('ADMIN_COMPANYID')."' AND "; 
		}
		/*if($this->session->userdata('ADMIN_TYPE')=='teamlead'){
			$where_clause .="type != 'superadmin' AND ";
		}*/
		$data['name'] = '';		
		$data['email'] = '';
		//print_r($_POST);
		if($this->input->post('hdnOrderByFld') != '')
		{
			$order_by_fld = $this->input->post('hdnOrderByFld');
			$this->session->set_userdata('order_by_fld', $order_by_fld);
			$order_by = $this->input->post('hdnOrderBy');
			$this->session->set_userdata('order_by', $order_by);
		}		
		if($this->uri->segment(3)!='')
		{
			$order_by_fld = $this->session->userdata('order_by_fld');
			$order_by = $this->session->userdata('order_by');
		}
		else
		{
			$this->session->set_userdata('order_by_fld', $order_by_fld);
			$this->session->set_userdata('order_by', $order_by);
		}
		if($this->uri->segment(3) == '' && $this->uri->segment(2)!='index')
		{
			$this->session->set_userdata('fname', '');			
			$this->session->set_userdata('lname', '');			
			$this->session->set_userdata('email', '');
			$this->session->set_userdata('companyID', '');
		}
		if($this->input->post('search')!= '')
		{
			
			$this->session->set_userdata('fname', $this->input->post('fname'));			
			$this->session->set_userdata('lname', $this->input->post('lname'));			
			$this->session->set_userdata('email', $this->input->post('email'));
			$this->session->set_userdata('companyID', $this->input->post('companyID'));
		}
		if($this->session->userdata('fname') != '')
		{
			$fname = $this->session->userdata('fname');
			$where_clause .= "fname LIKE '%".addslashes($fname)."%' AND ";
			$data['fname'] = $fname;
		}		
		if($this->session->userdata('lname') != '')
		{
			$lname = $this->session->userdata('lname');
			$where_clause .= "lname LIKE '%".addslashes($lname)."%' AND ";
			$data['lname'] = $lname;
		}
		if($this->session->userdata('companyID') != '')
		{
			$companyID = $this->session->userdata('companyID');
			$where_clause .= "companyID LIKE '%$companyID%' AND ";
			$data['companyID'] = $companyID;
		}
		if($this->session->userdata('email') != '')
		{
			$email = $this->session->userdata('email');
			$where_clause .= "customer_email LIKE '%".addslashes($email)."%' AND ";
			$data['email'] = $email;
		}
/**********************search*************************************/
		//$where_clause .= "(type ='superadmin')";	
		$where_clause  = substr($where_clause, 0, -4);		
		$total_rows = $this->common_model->countAll($this->table,$where_clause);
		$query = $this->common_model->get_all_records($this->table, $where_clause,$order_by_fld,$order_by,$offset,$limit);
		//echo $this->db->last_query();
		//Pagination config
		$config['base_url'] = base_url()."super_admin_user/index";
		$config['uri_segment'] = 3;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		
		$config['full_tag_open'] 	= '<div class="pagination">';
		$config['full_tag_close'] 	= '</div>';
		$config['full_tag_open'] 	= "<ul class='pagination'>";
		$config['full_tag_close'] 	= "</ul>";
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] 	= "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] 	= "<li>";
		$config['next_tagl_close'] 	= "</li>";
		$config['prev_tag_open'] 	= "<li>";
		$config['prev_tagl_close'] 	= "</li>";
		$config['first_tag_open'] 	= "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] 	= "<li>";
		$config['last_tagl_close'] 	= "</li>";
		$config['page_query_string'] = False;
		$this->pagination->initialize($config);
		$paginator = $this->pagination->create_links();
		///////////////////
		$data['message'] = $message;
		$data['paginator'] = $paginator;
		$data['query'] = $query;
		$companyIDName = $this->db->query("Select distinct(companyID) from t_centerdb where ".$where_clause1." visibility='Y' order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
		$this->load->view($this->viewfolder.'list',$data);
	}
	public function add() {
		$message = '';
		$data['message'] = $message;
		$order_by_fld = 'id';
		$order_by =	'ASC';		
		$whereGroup = "status = 'Y' AND ";
		$whereCompany = "status = 'Y' AND ";
		if($this->session->userdata('ADMIN_GROUP_ID')!=""){
			$whereGroup .= "id = '".$this->session->userdata('ADMIN_GROUP_ID')."' AND "; 
			$whereCompany = '( ';
			$centerquery = $this->common_model->get_all_records($this->tableCenterGroup, 'groupId = '.$this->session->userdata('ADMIN_GROUP_ID').'', $order_by_fld, $order_by,'','');
			
			foreach($centerquery->result() as $row){
				$new_where_clause .= "companyID = '".$row->companyID."' OR ";
			}
			$whereCompany  .= substr($new_where_clause, 0, -3);
			$whereCompany  .= ' ) AND ';			
		}		
		if($this->session->userdata('ADMIN_COMPANYID')!=""){
			$whereCompany .= "companyID = '".$this->session->userdata('ADMIN_COMPANYID')."' AND "; 
		}
		$whereGroup  	= substr($whereGroup, 0, -4);		
		$whereCompany  	= substr($whereCompany, 0, -4);		
		$data['groupQuery'] = $this->common_model->get_all_records($this->tableGroup, $whereGroup, 'groupName','ASC','','');
		
		$data['centerQuery'] = $this->common_model->get_all_records($this->tableCenter, $whereCompany, 'company_name','ASC','','');
		//echo $this->db->last_query();		
		$this->load->view($this->viewfolder.'/add',$data);
	}
	public function insert() {
			$row['name'] = $this->input->post('name'); 			
			$row['aliasName'] = $this->input->post('aliasName'); 			
			$row['email'] = $this->input->post('email'); 
			$row['phone'] = $this->input->post('phone');
			$row['address'] = $this->input->post('address');			
			$row['passwd'] = $this->common_model->base64En(2,$this->input->post('passwd'));
			$row['type'] = $this->input->post('type');
			$row['adminPermission'] = $this->input->post('adminPermission');
			$row['groupId'] = $this->input->post('groupId');
			$row['companyID'] = $this->input->post('companyID');
			$row['status'] = 'Y' ;
			$row['rec_crt_date'] = date('Y-m-d') ;
			$row['rec_up_date'] = date('Y-m-d') ;
			$row['ip_address'] = $_SERVER['REMOTE_ADDR'];
			$insert_id = $this->common_model->addRecord($this->table,$row);
				if($_FILES['image']['name']!="")
				{					
					$config['upload_path'] = FLD_PROFILE_IMAGE;					
					$config['allowed_types'] = 'jpg|jpeg|gif|png';
					$config['max_size']	= '0';
					$config['max_width'] = '0';
					$config['max_height'] = '0';
					$config['overwrite'] = TRUE;
					$file_name = $_FILES['image']['name'];
					$file_name = preg_replace(FILENAME_PATTERN,'_',$file_name);
					$config['file_name'] = $file_name;
					$config['orig_name'] = $_FILES['image']['name'];
					$config['image'] = $file_name;
					$this->upload->initialize($config);
					$this->upload->do_upload('image');
					//generate the thumb cover image from the main cover image
					$config['image_library'] = 'gd2';
					$config['source_image'] = FLD_PROFILE_IMAGE.$config['image'];
					$config['new_image'] = FLD_PROFILE_IMAGE."thumb/".$config['image'];
					$config['thumb_marker'] = '';
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = FALSE;
					$config['width'] = 70;
					$config['height'] = 70;
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$row_img['image'] = $config['image'];
					$update = $this->common_model->Update_Record($row_img,$this->table,$insert_id);
				}

				$message = setMessage('Record added successfully.',"success");
				$this->session->set_flashdata('message', $message);
				redirect(site_url($this->controllerFile));	
	}	//end of insert
	public function edit() {
		$message = '';
		$id = $this->uri->segment(3);
		$row = $this->common_model->Retrive_Record($this->table,$id);
		$data = array();
		$data['query'] = $row ;
		$data['message'] = $message;
		$order_by_fld = 'id';
		$order_by =	'ASC';		
		$whereGroup = "status = 'Y' AND ";
		$whereCompany = "status = 'Y' AND ";
		if($this->session->userdata('ADMIN_GROUP_ID')!=""){
			$whereGroup .= "id = '".$this->session->userdata('ADMIN_GROUP_ID')."' AND "; 
			$whereCompany = '( ';
			$centerquery = $this->common_model->get_all_records($this->tableCenterGroup, 'groupId = '.$this->session->userdata('ADMIN_GROUP_ID').'', $order_by_fld, $order_by,'','');
			
			foreach($centerquery->result() as $row){
				$new_where_clause .= "companyID = '".$row->companyID."' OR ";
			}
			$whereCompany  .= substr($new_where_clause, 0, -3);
			$whereCompany  .= ' ) AND ';			
		}		
		if($this->session->userdata('ADMIN_COMPANYID')!=""){
			$whereCompany .= "companyID = '".$this->session->userdata('ADMIN_COMPANYID')."' AND "; 
		}
		$whereGroup  	= substr($whereGroup, 0, -4);		
		$whereCompany  	= substr($whereCompany, 0, -4);		
		$data['groupQuery'] = $this->common_model->get_all_records($this->tableGroup, $whereGroup, 'groupName','ASC','','');
		$data['centerQuery'] = $this->common_model->get_all_records($this->tableCenter, $whereCompany, 'company_name','ASC','','');		
		$this->load->view($this->viewfolder.'/edit',$data);
	}
	function update() {
		$message_empty = '';
		$data = array();
		$id= $this->input->post('id');
		$row['name'] = $this->input->post('name') ;
		$row['aliasName'] = $this->input->post('aliasName') ;
		$row['email'] = $this->input->post('email'); 
		$row['phone'] = $this->input->post('phone');		
		$row['address'] = $this->input->post('address');					
		$row['passwd'] = $this->common_model->base64En(2,$this->input->post('passwd'));
		$row['type'] = $this->input->post('type');
		$row['adminPermission'] = $this->input->post('adminPermission');
		$row['groupId'] = $this->input->post('groupId');
		$row['companyID'] = $this->input->post('companyID');		
		$row['rec_up_date'] = date('Y-m-d') ;
		if($_FILES['image']['name']!="")
		{	
			if(file_exists(FLD_PROFILE_IMAGE.$this->input->post('old_img')))
			{
				@unlink(FLD_PROFILE_IMAGE.$this->input->post('old_img'));
				@unlink(FLD_PROFILE_IMAGE."thumb/".$this->input->post('old_img'));
			}
			$config['upload_path'] = FLD_PROFILE_IMAGE;
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['max_size']	= '0';
			$config['max_width'] = '0';
			$config['max_height'] = '0';
			$config['overwrite'] = TRUE;
			$file_name = $id."_".$_FILES['image']['name'];
			$file_name = preg_replace(FILENAME_PATTERN,'_',$file_name);
			$config['file_name'] = $file_name;
			$config['orig_name'] = $_FILES['image']['name'];
			$config['image'] = $file_name;
			$this->upload->initialize($config);
			$this->upload->do_upload('image');
			//generate the thumb cover image from the main cover image
			$config['image_library'] = 'gd2';
			$config['source_image'] = FLD_PROFILE_IMAGE.$config['image'];
			$config['new_image'] = FLD_PROFILE_IMAGE."thumb/".$config['image'];
			$config['thumb_marker'] = '';
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = FALSE;
			$config['width'] = 70;
			$config['height'] = 70;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$row['image'] = $config['image'];
		}
		$update = $this->common_model->Update_Record($row,$this->table,$id);
		$message = setMessage('Record updated successfully.',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));	
	}	// end of update
	function login_details(){
		$message = '';
		$data = array();
		$order_by_fld = 'id';
		$order_by =	'DESC';
		$offset = (int)$this->uri->segment(4,0);
		$adminId = $this->uri->segment(3);
		$limit = 50;
		/********************Display Details of the User*************************/
		$row = $this->common_model->Retrive_Record($this->table,$adminId);
		$data = array();
		$data['queryRow'] = $row ;
/**********************search*************************************/		
		$where_clause = "";
		$data['start_date'] = '';		
		$data['end_date'] = '';
		//print_r($_POST);
		if($this->uri->segment(2)!='index')
		{
			$this->session->set_userdata('start_date', '');			
			$this->session->set_userdata('end_date', '');
		}
		if($this->input->post('search')!= '')
		{
			
			$this->session->set_userdata('start_date', $this->input->post('start_date'));			
			$this->session->set_userdata('end_date', $this->input->post('end_date'));
		}
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') != '' )
		{
			$start_date = $this->session->userdata('start_date');
			$end_date = $this->session->userdata('end_date');
			$where_clause .= "loginTime between '$start_date' AND '$end_date' AND ";
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
		}
		
		/*('email');
			$where_clause .= "email LIKE '$email%' AND ";
			$data['email'] = $email;
		}*/
/**********************search*************************************/
		$where_clause .= "(adminId =".$adminId.")";		
		$total_rows = $this->common_model->countAll($this->table1,$where_clause);
		$query = $this->common_model->get_all_records($this->table1, $where_clause,$order_by_fld,$order_by,$offset,$limit);
		//echo $this->db->last_query();
		//Pagination config
		$config['base_url'] = base_url()."super_admin_user/login_details/".$adminId.'/';
		$config['uri_segment'] = 4;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		$paginator = $this->pagination->create_links();
		///////////////////
		$data['total_rows']=$total_rows;
		$data['message'] = $message;
		$data['paginator'] = $paginator;
		$data['query'] = $query;
		$this->load->view($this->viewfolder.'login_details',$data);	
	
	}
	function loginfo_details(){
		$message = '';
		$data = array();
		$order_by_fld = 'id';
		$order_by =	'DESC';
		$offset = (int)$this->uri->segment(4,0);
		$adminId = $this->uri->segment(3);
		$limit = 50;
		/********************Display Details of the User*************************/
		$row = $this->common_model->Retrive_Record($this->table,$adminId);
		$data = array();
		$data['queryRow'] = $row ;
/**********************search*************************************/		
		$where_clause = "";
		$data['name'] = '';		
		$data['email'] = '';
		//print_r($_POST);
		if($this->uri->segment(3) == '' && $this->uri->segment(2)!='index')
		{
			$this->session->set_userdata('name', '');			
			$this->session->set_userdata('email', '');
		}
		if($this->input->post('search')!= '')
		{
			
			$this->session->set_userdata('name', $this->input->post('name'));			
			$this->session->set_userdata('email', $this->input->post('email'));
		}
		if($this->session->userdata('name') != '')
		{
			$name = $this->session->userdata('name');
			$where_clause .= "name LIKE '$name%' AND ";
			$data['name'] = $name;
		}
		
		if($this->session->userdata('email') != '')
		{
			$email = $this->session->userdata('email');
			$where_clause .= "email LIKE '$email%' AND ";
			$data['email'] = $email;
		}
/**********************search*************************************/
		$where_clause .= "(adminId =".$adminId.")";		
		$total_rows = $this->common_model->countAll($this->table2,$where_clause);
		$query = $this->common_model->get_all_records($this->table2, $where_clause,$order_by_fld,$order_by,$offset,$limit);
		//echo $this->db->last_query();
		//Pagination config
		$config['base_url'] = base_url()."super_admin_user/loginfo_details/".$adminId.'/';
		$config['uri_segment'] = 4;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$config['full_tag_open'] = '<div class="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		$paginator = $this->pagination->create_links();
		$data['total_rows']=$total_rows;
		///////////////////
		$data['message'] = $message;
		$data['paginator'] = $paginator;
		$data['query'] = $query;
		$this->load->view($this->viewfolder.'loginfo_details',$data);	
	
	}
    function change_password()
    {
		//$row_sitesettings = this->common_model->Retrive_Record_By_Where_Clause(SITE_SETTINGS,"id ='1'");
		//$data['row_sitesettings'] = $row_sitesettings; 
    	$this->load->view($this->viewfolder.'change-password');
    }
    function update_password()
    {
    	$id = $this->session->userdata('ADMIN_ID');
		$old_password = $this->common_model->base64En(2,$this->input->post('old_password'));
		$numrec_password = $this->adminuser->get_user_passwordrecord($old_password);
		if($numrec_password > 0)
		{
			$row["password"] = $this->common_model->base64En(2,$this->input->post('password'));
			$this->common_model->Update_Record($row,$this->table,$id);
			$this->session->set_flashdata('message_success', 'Password changed successfully.');
			ci_redirect(base_url().$this->viewfolder.'change-password');
		}
		else
		{
			$this->session->set_flashdata('message_error', 'Give proper old password.');
			ci_redirect(base_url().$this->viewfolder.'change-password',$data);
		}
    }
	public function email_check() {
		$email = $this->input->post('email'); 
		$email_exist = $this->adminuser->Email_exists($this->input->post('email'));
		echo $email_exist;
	}
	public function username_check() {
		$username = $this->input->post('username'); 
		$username_exist = $this->adminuser->Username_exists($this->input->post('username'));
		echo $username_exist;
	}
	public function pop() {
		//$id = $this->uri->segment(4);
		$id = $this->input->post('id');
		$row = $this->common_model->Retrive_Record($this->table,$id);
		//$country_name = $this->common_model->Retrive_Record(COUNTRY,$row['country']);
		//$security_ques = $this->common_model->Retrive_Record(SECURITY_QUES,$row['security_question_id']);
		$data = array();
		$data['row'] = $row ;
		
		//$data['security_ques'] = $security_ques ;
		//$data['country_name'] = $country_name ;
		echo $this->load->view($this->viewfolder.'/view',$data);
	} //  end of pop_news
	public function download() {
	//to_excel($query, 'myfile'); // outputs myfile.xls
	//to_excel($query); // outputs exceloutput.xls
	// you could also use a model here
	$where_clause = "type = 'superadmin'";
	$type = 'superadmin';
	$this->adminuser->downadmin($where_clause,$type);  
	}
	public function downloadpdf() {
		$where_clause = "type = 'superadmin'";
		$query_users = $this->adminuser->getAllRecordsforpdf($where_clause);
		$data["query_users"] = $query_users;
		$data["list_title"] = 'customer Users';
		$html = $this->load->view($this->viewfolder.'/list_pdf',$data,true);
		pdf_create($html, 'superadmin');
		//$this->load->view('customer/admin_user/admin_user_list_pdf',$data);
	}
	public function change_is_active() {
		//$id = $this->uri->segment(4);
		//$value = $this->uri->segment(5);
		$id = $this->input->post('id') ; 
		$value = $this->input->post('val') ; 
		$row = array();
		$row['status'] = $value;
		$this->db->where('id', $id);
		$this->db->update($this->table, $row);
		echo 'success';
		//$this->session->set_flashdata('message', $message);
		//redirect(site_url($this->controllerFile));	
	}	// end ofchange_is_active
	function delete_single($id) {
	//echo $id;
		//$row_res = $this->common_model->Retrive_record(RESTAURANT,$id);
		$this->db->where('id', $id);
		$this->db->delete($this->table); 
		$message = setMessage('Record deleted successfully',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));
	}
}