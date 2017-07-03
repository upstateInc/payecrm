<?php 
ob_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Modules extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html','file'));
		$this->load->library(array('session','authentication','form_validation','email','upload','image_lib','pagination'));
		$this->load->model(array('common_model'));
		/*$this->authentication->is_loggedin($this->session->userdata('ADMIN_ID'));
		$this->authentication->is_systemAdmin($this->session->userdata('ADMIN_PERMISSION'));*/
		$this->table = MODULE;
		$this->viewfolder = 'modules/';
		$this->controllerFile = 'modules/';
		$this->namefile = 'modules';
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
		$data['module'] = '';
		$data['status'] = '';
		$data['paymentType'] = '';
		//print_r($_POST);
		if($this->uri->segment(3) == '' && $this->uri->segment(2)!='index')
		{
			$this->session->set_userdata('id', '');			
			$this->session->set_userdata('module', '');
		}
		if($this->input->post('search')!= '')
		{			
			$this->session->set_userdata('id', $this->input->post('id'));			
			$this->session->set_userdata('module', $this->input->post('module'));
		}
		if($this->session->userdata('id') != '')
		{
			$id = $this->session->userdata('id');
			$where_clause .= "id = '$id' AND ";
			$data['id'] = $id;
		}
		if($this->session->userdata('status') != '')
		{
			$status = $this->session->userdata('status');
			$where_clause .= "status = '$status' AND ";
			$data['status'] = $status;
		}
		if($this->session->userdata('module') != '')
		{
			$module = $this->session->userdata('module');
			$where_clause .= "module LIKE '%".$module."%' AND ";
			$data['module'] = $module;
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
		$this->load->view($this->viewfolder.'list',$data);
	}
	public function add() {
		$message = '';
		$data['message'] = $message;
		$this->load->view($this->viewfolder.'/add',$data);
	}	
	public function editPerm() {
		$message = '';
		$id = $this->uri->segment(3);
		$row = $this->common_model->Retrive_Record($this->table,$id);
		$data = array();
		$data['query'] = $row ;
		$data['message'] = $message;
		$this->load->view($this->viewfolder.'/editPerm',$data);
	}
	public function editPermUpdate(){
		$insert_id = $this->input->post('id');
		$action=$this->input->post('action');
		$permission=$this->input->post('permission');		
		$this->db->query("Delete from t_moduleAction where 	moduleId=".$insert_id);
		foreach($action as $val){
			$newRow['moduleId']=$insert_id;
			$newRow['actionId']=$val;
			$moduleActionInsert_id=$this->common_model->addRecord('t_moduleAction',$newRow);
			foreach($permission as $permissionVal){
				$premissionValues=explode(",",$permissionVal);
				//print_r($premissionValues);
				$actionId=$premissionValues[0];
				$adminLevelId=$premissionValues[1];
				$adminTypeId=$premissionValues[2];
				if($val==$actionId){
					$adminaction['adminTypeId']=$adminTypeId;
					$adminaction['adminLevelId']=$adminLevelId;
					$adminaction['moduleActionId']=$moduleActionInsert_id;
					$adminModuleActionInsert_id=$this->common_model->addRecord('t_adminModuleAction',$adminaction);
				}
			}
		}
		
			
		$message = setMessage('Record added successfully.',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));		
	}
	public function insert() {
		$row['module'] = $this->input->post('module') ;
		$row['parent'] = $this->input->post('parent') ;
		$row['weightage'] = $this->input->post('weightage') ;
		$row['moduleLink'] = $this->input->post('moduleLink') ;
		$row['moduleDesc'] = $this->input->post('moduleDesc') ;
		$row['imageClass'] = $this->input->post('imageClass') ;
		$row['status'] = $this->input->post('status');	
		$action=$this->input->post('action');
		$permission=$this->input->post('permission');
		$insert_id = $this->common_model->addRecord($this->table,$row);
		foreach($action as $val){
			$newRow['moduleId']=$insert_id;
			$newRow['actionId']=$val;
			$moduleActionInsert_id=$this->common_model->addRecord('t_moduleAction',$newRow);
			foreach($permission as $permissionVal){
				$premissionValues=explode(",",$permissionVal);
				//print_r($premissionValues);
				$actionId=$premissionValues[0];
				$adminLevelId=$premissionValues[1];
				$adminTypeId=$premissionValues[2];
				if($val==$actionId){
					$adminaction['adminTypeId']=$adminTypeId;
					$adminaction['adminLevelId']=$adminLevelId;
					$adminaction['moduleActionId']=$moduleActionInsert_id;
					$adminModuleActionInsert_id=$this->common_model->addRecord('t_adminModuleAction',$adminaction);
				}
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
		$id=$this->input->post('id');
		$row['module'] = $this->input->post('module') ;
		$row['parent'] = $this->input->post('parent') ;
		$row['weightage'] = $this->input->post('weightage') ;
		$row['moduleLink'] = $this->input->post('moduleLink') ;
		$row['moduleDesc'] = $this->input->post('moduleDesc') ;
		$row['imageClass'] = $this->input->post('imageClass') ;
		$row['status'] = $this->input->post('status');						
			
		$update = $this->common_model->Update_Record($row,$this->table,$id);
		/*echo $this->db->last_query();
		exit;*/
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