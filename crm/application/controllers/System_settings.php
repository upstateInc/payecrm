<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class System_settings extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html','file'));
		$this->load->library(array('session','authentication','form_validation','email','upload','image_lib','pagination'));
		$this->load->model(array('common_model'));

		$this->table = 't_system_settings';
		$this->viewfolder = 'system_settings/';
		$this->controllerFile = 'system_settings/';
		$this->namefile = 'system_settings';
	}
	public function index() {
		$message = '';
		$data = array();
		$order_by_fld = 'id';
		$order_by =	'ASC';
		$offset = (int)$this->uri->segment(3,0);
		$limit = 10;
		
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
		$where_clause = "id = 1 AND ";
		$data['id'] = '';		
		$data['email'] = '';
		$data['event'] = '';
		$data['directory'] = '';
		$data['programName'] = '';
		$data['decriptor'] = '';
		$data['status'] = '';
		$data['paymentType'] = '';
		//print_r($_POST);
		if($this->uri->segment(3) == '' && $this->uri->segment(2)!='index')
		{
				
			$this->session->set_userdata('email', '');
			$this->session->set_userdata('event', '');
			$this->session->set_userdata('directory', '');
			$this->session->set_userdata('programName', '');
			$this->session->set_userdata('decriptor', '');
			$this->session->set_userdata('status', '');
			$this->session->set_userdata('paymentType', '');
		}
		if($this->input->post('search')!= '')
		{
			
						
			$this->session->set_userdata('email', $this->input->post('email'));
			$this->session->set_userdata('event', $this->input->post('event'));
			$this->session->set_userdata('directory', $this->input->post('directory'));
			$this->session->set_userdata('programName', $this->input->post('programName'));
			$this->session->set_userdata('decriptor', $this->input->post('decriptor'));
			$this->session->set_userdata('status', $this->input->post('status'));
			$this->session->set_userdata('paymentType', $this->input->post('paymentType'));
		}

		if($this->session->userdata('status') != '')
		{
			$status = $this->session->userdata('status');
			$where_clause .= "status = '$status' AND ";
			$data['status'] = $status;
		}
		if($this->session->userdata('email') != '')
		{
			$email = $this->session->userdata('email');
			$where_clause .= "email LIKE '%".$email."%' AND ";
			$data['email'] = $email;
		}		
		if($this->session->userdata('event') != '')
		{
			$event = $this->session->userdata('event');
			$where_clause .= "event LIKE '%".$event."%' AND ";
			$data['event'] = $event;
		}
		if($this->session->userdata('directory') != '')
		{
			$directory = $this->session->userdata('directory');
			$where_clause .= "directory LIKE '%$directory%' AND ";
			$data['directory'] = $directory;
		}
		if($this->session->userdata('programName') != '')
		{
			$programName = $this->session->userdata('programName');
			$where_clause .= "programName LIKE '%$programName%' AND ";
			$data['programName'] = $programName;
		}
		if($this->session->userdata('decriptor') != '')
		{
			$decriptor = $this->session->userdata('decriptor');
			$where_clause .= "decriptor LIKE '%$decriptor%' AND ";
			$data['decriptor'] = $decriptor;
		}
		if($this->session->userdata('paymentType') != '')
		{
			$paymentType= $this->session->userdata('paymentType');
			$where_clause .= "paymentType LIKE '%$paymentType%' AND ";
			$data['paymentType'] = $paymentType;
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
	public function insert() {
		$row['email'] = $this->input->post('email') ;
		$row['event'] = $this->input->post('event');
		//$row['fee_type'] = $this->input->post('fee_type');		
		$row['status'] = $this->input->post('status');	
		//$row['rec_crt_date'] = date('Y-m-d') ;

		//$row['super_admin'] = '1' ;
		$insert_id = $this->common_model->addRecord($this->table,$row);
			
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
		$row['SYSTEMMAXSALESALLOWED'] = $this->input->post('SYSTEMMAXSALESALLOWED') ;
		$row['ECHECKINGALLOWED'] = $this->input->post('ECHECKINGALLOWED') ;
		$row['AuthorizedSaleAmount'] = $this->input->post('AuthorizedSaleAmount') ;
		$row['searchLimit'] = $this->input->post('searchLimit') ;
		$row['newTollFreeNo'] = $this->input->post('newTollFreeNo') ;
		$row['order_by'] = $this->input->post('order_by') ;
		$row['Mid_Selection'] = $this->input->post('Mid_Selection') ;	
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
		echo 'success';
	}	// end ofchange_is_active
	function delete_single($id) {
		$this->db->where('id', $id);
		$this->db->delete($this->table); 
		$message = setMessage('Record deleted successfully',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));
	}
}
