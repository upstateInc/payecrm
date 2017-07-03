<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mid_master extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html','file'));
		$this->load->library(array('session','authentication','form_validation','email','upload','image_lib','pagination'));
		$this->load->model(array('common_model'));
		$this->table = 't_midmaster';
		$this->viewfolder = 'mid_master/';
		$this->controllerFile = 'mid_master/';
		$this->namefile = 'Mid_Master';
	}
	public function index() {
		$message = '';
		$data = array();
		$order_by_fld = 'gatewayID';
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
		$where_clause = "";
		$data['id'] = '';		
		$data['companyID'] = '';
		$data['gatewayID'] = '';
		$data['directory'] = '';
		$data['programName'] = '';
		$data['decriptor'] = '';
		$data['status'] = '';
		$data['paymentType'] = '';
		//print_r($_POST);
		if($this->uri->segment(3) == '' && $this->uri->segment(2)!='index')
		{
			$this->session->set_userdata('id', '');			
			$this->session->set_userdata('companyID', '');
			$this->session->set_userdata('gatewayID', '');
			$this->session->set_userdata('directory', '');
			$this->session->set_userdata('programName', '');
			$this->session->set_userdata('decriptor', '');
			$this->session->set_userdata('status', '');
			$this->session->set_userdata('paymentType', '');
		}
		if($this->input->post('search')!= '')
		{
			
			$this->session->set_userdata('id', $this->input->post('id'));			
			$this->session->set_userdata('companyID', $this->input->post('companyID'));
			$this->session->set_userdata('gatewayID', $this->input->post('gatewayID'));
			$this->session->set_userdata('directory', $this->input->post('directory'));
			$this->session->set_userdata('programName', $this->input->post('programName'));
			$this->session->set_userdata('decriptor', $this->input->post('decriptor'));
			$this->session->set_userdata('status', $this->input->post('status'));
			$this->session->set_userdata('paymentType', $this->input->post('paymentType'));
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
		if($this->session->userdata('companyID') != '')
		{
			$companyID = $this->session->userdata('companyID');
			$where_clause .= "companyID LIKE '%$companyID%' AND ";
			$data['companyID'] = $companyID;
		}		
		if($this->session->userdata('gatewayID') != '')
		{
			$gatewayID = $this->session->userdata('gatewayID');
			$where_clause .= "gatewayID LIKE '%$gatewayID%' AND ";
			$data['gatewayID'] = $gatewayID;
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
		
		//$companyIDName = $this->common_model->get_all_records('t_gateway', '','id','ASC','','');
		$companyIDName = $this->db->query("Select distinct(companyID) from t_merchant order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
		$gateway = $this->db->query("Select distinct(gatewayID) as gatewayName from  t_midmaster where visibility='Y' order by gatewayID ASC");
		$data['gateway'] = $gateway;
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
		$row['paymentType'] = $this->input->post('paymentType') ;
		$row['gatewayID'] = $this->input->post('gatewayID') ;
		
		$row['directory'] = $this->input->post('directory') ;
		$row['descriptor'] = $this->input->post('descriptor') ;
		
		$row['gatewayType'] = $this->input->post('gatewayType') ;
		$row['programName'] = $this->input->post('programName'); 
		$row['username'] = $this->input->post('username');
		$row['password'] = $this->input->post('password');			
		$row['mid_number'] = $this->input->post('mid_number');			
		$row['mid_key'] = $this->input->post('mid_key');			
		$row['link'] = $this->input->post('link');			
		$row['monthly_volume'] = $this->input->post('monthly_volume');			
		$row['daily_volume'] = $this->input->post('daily_volume');			
		$row['MaxSalesAmount'] = $this->input->post('MaxSalesAmount');			
		$row['dailyHighTicketCapture'] = $this->input->post('dailyHighTicketCapture');			
		$row['status'] = $this->input->post('status');	
		$row['visibility'] = $this->input->post('visibility');	
		$row['cron'] = $this->input->post('cron');	
		$row['rec_crt_date'] = date('Y-m-d') ;
		
		if($row['gatewayID'] != '')
		{
			$gatewayID = $row['gatewayID'];
			$where_clause .= "gatewayID LIKE '%".$gatewayID."%' AND ";
		}		
		$where_clause  = substr($where_clause, 0, -4);
		$total_rows = $this->common_model->countAll($this->table,$where_clause);		
		if($total_rows > 0){
			$message = setMessage('Record Not Added.Record Already Exists.',"error");
			$this->session->set_flashdata('message', $message);
		}else{	
			$insert_id = $this->common_model->addRecord($this->table,$row);			
			$message = setMessage('Record added successfully.',"success");
			$this->session->set_flashdata('message', $message);
		}
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
		$row['paymentType'] = $this->input->post('paymentType') ;
		$row['gatewayID'] = $this->input->post('gatewayID') ;
		$row['gatewayType'] = $this->input->post('gatewayType') ;
		$row['programName'] = $this->input->post('programName'); 
		$row['username'] = $this->input->post('username');

		$row['directory'] = $this->input->post('directory') ;
		$row['descriptor'] = $this->input->post('descriptor') ;		
		
		$row['password'] = $this->input->post('password');			
		$row['mid_number'] = $this->input->post('mid_number');			
		$row['mid_key'] = $this->input->post('mid_key');			
		$row['link'] = $this->input->post('link');	
		$row['monthly_volume'] = $this->input->post('monthly_volume');			
		$row['daily_volume'] = $this->input->post('daily_volume');	
		$row['MaxSalesAmount'] = $this->input->post('MaxSalesAmount');
		$row['dailyHighTicketCapture'] = $this->input->post('dailyHighTicketCapture');
		$row['status'] = $this->input->post('status');					
		$row['visibility'] = $this->input->post('visibility');	
		$row['cron'] = $this->input->post('cron');
		
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
		$response="";	
		if($row['status']=='N'){
			$fetchrow = $this->common_model->Retrive_Record_By_Where_Clause($this->table,"id = '$id' ");
			$gatewayList = $this->db->query("Select distinct(companyID) from t_gateway where gatewayName='".$fetchrow['gatewayID']."'");
			foreach ($gatewayList->result() as $val){
					$response.=$val->companyID.'<br/>'; 
			}
			$response.="Is using the Gateway : ".$fetchrow['gatewayID']." You Want to Delete these Gateway Records?";
			$response.='<a href= "javascript:void(0);" onClick= deleteGateways("'.$fetchrow['gatewayID'].'");>Yes</a> ';
			$response.='<a href="'.base_url().$this->controllerFile.'">No</a>';
			$this->db->where('gatewayName', $fetchrow['gatewayID']);
			$this->db->update('t_gateway', $row);

		}
		echo $response;
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