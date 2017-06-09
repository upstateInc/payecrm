<?php 
ob_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Merchant extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html','file'));
		$this->load->library(array('session','authentication','form_validation','email','upload','image_lib','pagination'));
		$this->load->model(array('common_model'));
		$this->table = 't_merchant';
		$this->viewfolder = 'merchant/';
		$this->controllerFile = 'merchant/';
		$this->namefile = 'merchant';
	}
	public function index() {
		$message = '';
		$data = array();
		$order_by_fld = 'companyID';
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
		$data['gatewayName'] = '';
		$data['directory'] = '';
		$data['programName'] = '';
		$data['decriptor'] = '';
		$data['status'] = '';
		//print_r($_POST);
		if($this->uri->segment(3) == '' && $this->uri->segment(2)!='index')
		{
			$this->session->set_userdata('id', '');			
			$this->session->set_userdata('companyID', '');
			$this->session->set_userdata('gatewayName', '');
			$this->session->set_userdata('directory', '');
			$this->session->set_userdata('programName', '');
			$this->session->set_userdata('decriptor', '');
			$this->session->set_userdata('status', '');
		}
		if($this->input->post('search')!= '')
		{
			
			$this->session->set_userdata('id', $this->input->post('id'));			
			$this->session->set_userdata('companyID', $this->input->post('companyID'));
			$this->session->set_userdata('gatewayName', $this->input->post('gatewayName'));
			$this->session->set_userdata('directory', $this->input->post('directory'));
			$this->session->set_userdata('programName', $this->input->post('programName'));
			$this->session->set_userdata('decriptor', $this->input->post('decriptor'));
			$this->session->set_userdata('status', $this->input->post('status'));
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
		if($this->session->userdata('gatewayName') != '')
		{
			$gatewayName = $this->session->userdata('gatewayName');
			$where_clause .= "gatewayName LIKE '%$gatewayName%' AND ";
			$data['gatewayName'] = $gatewayName;
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
		$companyIDName = $this->db->query("Select distinct(companyID) from ".$this->table." where visibility='Y' order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
		$data['order_by_fld'] = $order_by_fld;
		$data['order_by'] = $order_by;
		$this->load->view($this->viewfolder.'list',$data);
	}
	public function add() {
		$message = '';
		$data['message'] = $message;
		$companyIDName = $this->db->query("Select distinct(companyID) from ".$this->table." order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		

		$this->load->view($this->viewfolder.'/add',$data);
	}
	public function insert() {
		$row['companyID'] = $this->input->post('companyID') ;
		$row['company_name'] = $this->input->post('company_name');			
		$row['company_email'] = $this->input->post('company_email');			
		$row['company_feedback_email'] = $this->input->post('company_feedback_email');			
		
		$row['company_invoice_email'] = $this->input->post('company_invoice_email');			
		$row['company_invoice_prefix'] = $this->input->post('company_invoice_prefix');			
		$row['Gorad_email'] = $this->input->post('Gorad_email');			
		$row['Gorad_Billing_Number'] = $this->input->post('Gorad_Billing_Number');			
		$row['company_phonenumber'] = $this->input->post('company_phonenumber');			
		$row['company_address1'] = $this->input->post('company_address1');			
		$row['company_Address2'] = $this->input->post('company_Address2');			
		$row['company_City'] = $this->input->post('company_City');			
		$row['company_State'] = $this->input->post('company_State');			
		$row['company_Zipcode'] = $this->input->post('company_Zipcode');			
		$row['Company_PDF_Name'] = $this->input->post('Company_PDF_Name');			
		$row['send_feedback_form'] = $this->input->post('send_feedback_form');			
		
		$row['Additional_Group_email1'] = $this->input->post('Additional_Group_email1');			
		$row['tranactionMode'] = $this->input->post('tranactionMode');			
		$row['transactionUpdate'] = $this->input->post('transactionUpdate');

		$row['duplicate'] = $this->input->post('duplicate');
		$row['canCapture'] = $this->input->post('canCapture');
		$row['canVoid'] = $this->input->post('canVoid');
		$row['canRefund'] = $this->input->post('canRefund');
		$row['canChargeback'] = $this->input->post('canChargeback');
		$row['sendEmail'] = $this->input->post('sendEmail');
		$row['technicianIDRequired'] = $this->input->post('technicianIDRequired');
		$row['productNameShow'] = $this->input->post('productNameShow');
				
		$row['invoice_period'] = $this->input->post('invoice_period');	
		$row['invoice_type'] = $this->input->post('invoice_type');
		
		$row['service_type'] = $this->input->post('service_type');	
		$row['min_percentage'] = $this->input->post('min_percentage');	
		$row['max_percentage'] = $this->input->post('max_percentage');		
		$row['failedAttempts'] = $this->input->post('failedAttempts');	
		$row['invoiceEmails'] = $this->input->post('invoiceEmails');
		$row['invoice_day'] = $this->input->post('invoice_day');			
		$row['rec_crt_date'] = date('Y-m-d H:i:s') ;
		$row['Max_Sales_Amount_Allowed'] = $this->input->post('Max_Sales_Amount_Allowed');	
		$row['MidSelectionProcess'] = $this->input->post('MidSelectionProcess');
		$row['orderEmail'] = $this->input->post('orderEmail');	
		$row['feedbackEmail'] = $this->input->post('feedbackEmail');	
		$row['welcomeEmail'] = $this->input->post('welcomeEmail');			
		//$row['super_admin'] = '1' ;
		$row['CreditCard_Hidden'] = $this->input->post('CreditCard_Hidden');
		$row['nbr_of_reserve_weeks'] = $this->input->post('nbr_of_reserve_weeks');
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
		$companyIDName = $this->db->query("Select distinct(companyID) from ".$this->table." order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
		$this->load->view($this->viewfolder.'/edit',$data);
	}
	public function copy(){
		$message = '';
		$id = $this->uri->segment(3);
		$row = $this->common_model->Retrive_Record($this->table,$id);
		$data = array();
		$data['query'] = $row ;
		$data['message'] = $message;
		$companyIDName = $this->db->query("Select distinct(companyID) from t_centerdb order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
		$this->load->view($this->viewfolder.'/copy',$data);
	}
	function update() {
		$message_empty = '';
		$data = array();
		$id= $this->input->post('id');
		if($this->input->post('companyID')!=""){
			$row['companyID'] = $this->input->post('companyID');
		}
		$row['company_name'] = $this->input->post('company_name');			
		$row['company_email'] = $this->input->post('company_email');			
		$row['company_feedback_email'] = $this->input->post('company_feedback_email');			
		
		$row['company_invoice_email'] = $this->input->post('company_invoice_email');			
		$row['company_invoice_prefix'] = $this->input->post('company_invoice_prefix');			
		$row['Gorad_email'] = $this->input->post('Gorad_email');			
		$row['Gorad_Billing_Number'] = $this->input->post('Gorad_Billing_Number');			
		$row['company_phonenumber'] = $this->input->post('company_phonenumber');			
		$row['company_address1'] = $this->input->post('company_address1');			
		$row['company_Address2'] = $this->input->post('company_Address2');			
		$row['company_City'] = $this->input->post('company_City');			
		$row['company_State'] = $this->input->post('company_State');			
		$row['company_Zipcode'] = $this->input->post('company_Zipcode');			
		$row['Company_PDF_Name'] = $this->input->post('Company_PDF_Name');			
		$row['send_feedback_form'] = $this->input->post('send_feedback_form');			
		$row['rec_update_date'] = date('Y-m-d H:i:s') ;
		
		$row['Additional_Group_email1'] = $this->input->post('Additional_Group_email1');			
		$row['tranactionMode'] = $this->input->post('tranactionMode');			
		$row['transactionUpdate'] = $this->input->post('transactionUpdate');			
		$row['duplicate'] = $this->input->post('duplicate');

		$row['canCapture'] = $this->input->post('canCapture');
		$row['canVoid'] = $this->input->post('canVoid');
		$row['canRefund'] = $this->input->post('canRefund');
		$row['canChargeback'] = $this->input->post('canChargeback');
		$row['sendEmail'] = $this->input->post('sendEmail');
		$row['invoice_period'] = $this->input->post('invoice_period');			
		$row['invoice_type'] = $this->input->post('invoice_type');
		$row['technicianIDRequired'] = $this->input->post('technicianIDRequired');
		$row['productNameShow'] = $this->input->post('productNameShow');
		$row['service_type'] = $this->input->post('service_type');	
		$row['min_percentage'] = $this->input->post('min_percentage');	
		$row['max_percentage'] = $this->input->post('max_percentage');			
		$row['failedAttempts'] = $this->input->post('failedAttempts');	
		$row['invoiceEmails'] = $this->input->post('invoiceEmails');
		$row['invoice_day'] = $this->input->post('invoice_day');
		$row['Max_Sales_Amount_Allowed'] = $this->input->post('Max_Sales_Amount_Allowed');	
		$row['MidSelectionProcess'] = $this->input->post('MidSelectionProcess');
		$row['orderEmail'] = $this->input->post('orderEmail');	
		$row['feedbackEmail'] = $this->input->post('feedbackEmail');	
		$row['welcomeEmail'] = $this->input->post('welcomeEmail');	
		$row['CreditCard_Hidden'] = $this->input->post('CreditCard_Hidden');
		$row['nbr_of_reserve_weeks'] = $this->input->post('nbr_of_reserve_weeks');
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
	public function change_visibility() {
		$id = $this->input->post('id') ; 
		$value = $this->input->post('val') ; 
		$row = array();
		$row['visibility'] = $value;
		$this->db->where('id', $id);
		$this->db->update($this->table, $row);
		//echo $this->db->last_query();
		echo 'success';
	}	// end ofchange_is_active	
}
?>














