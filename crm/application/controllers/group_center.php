<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Group_center extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html','dompdf', 'file'));
		$this->load->library(array('session','authentication','form_validation','email','upload','image_lib','pagination'));
		$this->load->model(array('adminuser','common_model','mail_model'));
		$this->authentication->is_loggedin($this->session->userdata('ADMIN_ID'));
		$this->authentication->is_systemAdmin($this->session->userdata('ADMIN_PERMISSION'));
		$this->table = 't_centerGroup';
		$this->viewfolder = 'group_center/';
		$this->controllerFile = 'group_center/';
		$this->namefile = 'group_center';
	}
	public function index() {
		$message = '';
		$data = array();
		$order_by_fld = 'id';
		$order_by =	'ASC';
		$offset = (int)$this->uri->segment(3,0);
		$limit = 5;
		
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
/**********************search*************************************/		
		$where_clause = "";
		$data['id'] = '';		
		$data['name'] = '';
		$data['status'] = '';
		$data['paymentType'] = '';
		//print_r($_POST);
		if($this->uri->segment(3) == '' && $this->uri->segment(2)!='index')
		{
			$this->session->set_userdata('id', '');			
			$this->session->set_userdata('groupId', '');
		}
		if($this->input->post('search')!= '')
		{			
			$this->session->set_userdata('id', $this->input->post('id'));			
			$this->session->set_userdata('groupId', $this->input->post('groupId'));
		}
		if($this->session->userdata('groupId') != '')
		{
			$groupId = $this->session->userdata('groupId');
			$where_clause .= "groupId = '".$groupId."' AND ";
			$data['groupId'] = $groupId;
		}
		if($this->session->userdata('status') != '')
		{
			$status = $this->session->userdata('status');
			$where_clause .= "status = '$status' AND ";
			$data['status'] = $status;
		}
		if($this->session->userdata('name') != '')
		{
			$name = $this->session->userdata('name');
			$where_clause .= "group_centerName LIKE '%$name%' AND ";
			$data['name'] = $name;
		}		
/**********************search*************************************/
		$where_clause  = substr($where_clause, 0, -4);
		$total_rows = $this->common_model->countAll($this->table,$where_clause);
		$query = $this->common_model->get_all_records($this->table, $where_clause,$order_by_fld,$order_by,$offset,$limit);
		//echo $this->db->last_query();
		//Pagination config
		$config['base_url'] = base_url().$this->controllerFile."index";
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
		
		$data['order_by_fld'] = $order_by_fld;
		$data['order_by'] = $order_by;
		
		$groupName = $this->db->query("Select * from  t_group where  status='Y' order by groupName ASC");
		$data['groupName'] = $groupName;
		
		$this->load->view($this->viewfolder.'list',$data);
	}
	public function add() {
		$message = '';
		$data['message'] = $message;
		$groupName = $this->db->query("Select * from  t_group where  status='Y' order by groupName ASC");
		$data['groupName'] = $groupName;
		$companyIDName = $this->db->query("Select distinct(companyID) from t_centerdb where visibility='Y' order by companyID ASC");
		$data['companyIDName'] = $companyIDName;			
		$this->load->view($this->viewfolder.'/add',$data);
	}
	public function insert(){
		$row['groupId'] = $this->input->post('groupId') ;
		$companyID = $this->input->post('companyID') ;
		foreach($companyID as $val){
			print_r($val);
			$check=$this->db->query("select id from t_centerGroup where companyID='".$val."' and groupId='".$row['groupId']."'")->row_array();
			if($check['id']==""){
				$row['companyID'] = $val;
				$insert_id = $this->common_model->addRecord('t_centerGroup',$row);
			}
		}
		$message = setMessage('Record added successfully.',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));	
	}	//end of insert
	public function edit(){
		$message = '';
		$id = $this->uri->segment(3);
		$row = $this->common_model->Retrive_Record($this->table,$id);
		$data = array();
		$data['query'] = $row ;
		$data['message'] = $message;
		$this->load->view($this->viewfolder.'/edit',$data);
	}
	public function copy(){
		$message = '';
		$id = $this->uri->segment(3);
		$row = $this->common_model->Retrive_Record($this->table,$id);
		$data = array();
		$data['query'] = $row ;
		$data['message'] = $message;
		$this->load->view($this->viewfolder.'/copy',$data);
	}
	function update() {
		$message_empty = '';
		$data = array();
		$id= $this->input->post('id');
		$row['group_centerName'] = $this->input->post('name') ;
		$row['status'] = $this->input->post('status');					
			
		$update = $this->common_model->Update_Record($row,$this->table,$id);
		$message = setMessage('Record updated successfully.',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));	

	}	// end of update

	public function pop() {
		$id = $this->uri->segment(3);
		$row = $this->common_model->Retrive_Record($this->table,$id);
		$data = array();
		$data['row'] = $row ;
		$this->load->view($this->viewfolder.'/view',$data);
	} //  end of pop_news

	public function change_is_active() {
		$id = $this->input->post('id') ; 
		$value = $this->input->post('val') ; 
		$row = array();
		$row['status'] = $value;
		$this->db->where('id', $id);
		$this->db->update($this->table, $row);

	}	// end ofchange_is_active
	function delete_single($id) {
		$this->db->where('id', $id);
		$this->db->delete($this->table); 
		$message = setMessage('Record deleted successfully',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));
	}
	function change_gateway_active(){
		$gatewayName = $this->input->post('gatewayName') ; 
		$this->db->where('gatewayName', $gatewayName);
		$this->db->delete('t_gateway'); 
		echo 'Gateway Records Deleted Successfully';
	}
	public function change_visibility() {
		$id = $this->input->post('id') ; 
		$value = $this->input->post('val') ; 
		$row = array();
		$row['visibility'] = $value;
		$this->db->where('id', $id);
		$this->db->update($this->table, $row);
		echo 'success';
	}	
}
?>






