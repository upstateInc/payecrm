<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class export extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html','dompdf', 'file'));
		$this->load->library(array('session','authentication','form_validation','email','upload','image_lib','pagination'));
		$this->load->model(array('adminuser','common_model','mail_model'));
		$this->authentication->is_loggedin($this->session->userdata('ADMIN_ID'));
		$this->authentication->is_systemAdmin($this->session->userdata('ADMIN_PERMISSION'));
		//$this->table = 't_master_success';
		$this->table = 't_invoice';
		$this->viewfolder = 'export/';
		$this->controllerFile = 'export/';
		$this->namefile = 'export';
	}
	public function index() {
		$message = '';
		$data = array();
		$order_by_fld = 'id';
		$order_by =	'DESC';
		$offset = (int)$this->uri->segment(3,0);
		$limit = 20;
		
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
		$data['validated'] = '';
		//print_r($_POST);
		if($this->uri->segment(3) == '' && $this->uri->segment(2)!='index')
		{
			$this->session->set_userdata('id', '');			
			$this->session->set_userdata('companyID', '');
			$this->session->set_userdata('validated', '');
			$this->session->set_userdata('gatewayName', '');
			$this->session->set_userdata('directory', '');
			$this->session->set_userdata('programName', '');
			$this->session->set_userdata('decriptor', '');
			$this->session->set_userdata('status', '');
			$this->session->set_userdata('start_date', '');
			$this->session->set_userdata('end_date', '');
			
			$this->session->set_userdata('customer_name', '');
			$this->session->set_userdata('customer_phone', '');
			$this->session->set_userdata('customer_email', '');
			$this->session->set_userdata('cardNo', '');
			$this->session->set_userdata('cardType', '');
			$this->session->set_userdata('selectedEmails1', '');
		}
		if($this->session->userdata('selectedEmails1') != '')
		{
			$data['selectedEmails1'] = $this->session->userdata('selectedEmails1');
		}		
		if($this->input->post('search')!= '')
		{
			
			$this->session->set_userdata('id', $this->input->post('id'));			
			$this->session->set_userdata('companyID', $this->input->post('companyID'));
			$this->session->set_userdata('validated', $this->input->post('validated'));
			$this->session->set_userdata('gatewayName', $this->input->post('gatewayName'));
			$this->session->set_userdata('directory', $this->input->post('directory'));
			$this->session->set_userdata('programName', $this->input->post('programName'));
			$this->session->set_userdata('decriptor', $this->input->post('decriptor'));
			$this->session->set_userdata('status', $this->input->post('status'));
			$this->session->set_userdata('start_date', $this->input->post('start_date'));
			if($this->input->post('start_date')!=$this->input->post('end_date')){
				$this->session->set_userdata('end_date', $this->input->post('end_date'));
			}else{
				$this->session->set_userdata('end_date', '');
			}
			$this->session->set_userdata('customer_name', $this->input->post('customer_name'));
			$this->session->set_userdata('customer_phone', $this->input->post('customer_phone'));
			$this->session->set_userdata('customer_email', $this->input->post('customer_email'));
			$this->session->set_userdata('cardNo', $this->input->post('cardNo'));
			$this->session->set_userdata('cardType', $this->input->post('cardType'));
		}
		if($this->session->userdata('companyID') != '')
		{
			$companyID = $this->session->userdata('companyID');
			$where_clause .= "companyID LIKE '%$companyID%' AND ";
			$data['companyID'] = $companyID;
		}		
		if($this->session->userdata('validated') != '')
		{
			$validated = $this->session->userdata('validated');
			$where_clause .= "validated LIKE '%$validated%' AND ";
			$data['validated'] = $validated;
		}
		if($this->session->userdata('customer_name') != '')
		{
			$customer_name = $this->session->userdata('customer_name');
			$where_clause .= "customer_name LIKE '%$customer_name%' AND ";
			$data['customer_name'] = $customer_name;
		}
		if($this->session->userdata('customer_phone') != '')
		{
			$customer_phone = $this->session->userdata('customer_phone');
			$where_clause .= "customer_phone LIKE '%$customer_phone%' AND ";
			$data['customer_phone'] = $customer_phone;
		}
		if($this->session->userdata('customer_email') != '')
		{
			$customer_email = $this->session->userdata('customer_email');
			$where_clause .= "customer_email LIKE '%$customer_email%' AND ";
			$data['customer_email'] = $customer_email;
		}
		if($this->session->userdata('cardNo') != '')
		{
			$cardNo = $this->session->userdata('cardNo');
			$where_clause .= "cardNo LIKE '%$cardNo' AND ";
			$data['cardNo'] = $cardNo;
		}		
		if($this->session->userdata('gatewayName') != '')
		{
			$gatewayName = $this->session->userdata('gatewayName');
			$where_clause .= "gatewayID LIKE '%$gatewayName%' AND ";
			$data['gatewayName'] = $gatewayName;
		}
		if($this->session->userdata('status') != '')
		{
			$status = $this->session->userdata('status');
			//print_r($status);
			//exit;
			
			foreach($status as $val){
				$where_status_clause .= "status like '%".$val."%' OR ";
				//$where_clause .= "status like '%$status%' AND ";
			}
			$where_clause .="(";
			$where_clause .= substr($where_status_clause, 0, -3);
			$where_clause .=") AND ";
			
			$data['status'] = $status;
		}
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') != '')
		{
			$start_date = $this->session->userdata('start_date');
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$data['start_date'] = $start_date;
		}
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') == '')
		{
			$start_date = $this->session->userdata('start_date');
			//echo $start_date;
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND `rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND";
			$data['start_date'] = $start_date;
		}
		
		if($this->session->userdata('end_date') != '')
		{
			$end_date = $this->session->userdata('end_date');
			$parts = explode('-',$end_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];			
			$where_clause .= "`rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND ";
			$data['end_date'] = $end_date;
		}
		if($this->session->userdata('cardType') != '')
		{
			$cardType = $this->session->userdata('cardType');
			$where_clause .= "cardType LIKE '%$cardType%' AND ";
			$data['cardType'] = $cardType;
		}		

/**********************search*************************************/
		$where_clause  = substr($where_clause, 0, -4);
		$total_rows = $this->common_model->countAll($this->table,$where_clause);
		$query = $this->common_model->get_all_records($this->table, $where_clause,$order_by_fld,$order_by,$offset,$limit);
		//echo $this->db->last_query();
		if($where_clause!=''){
			$data['queryTotalPrice'] = $this->db->query('SELECT sum(grossPrice) as sum from '.$this->table.' where '.$where_clause)->row()->sum;
		}else{
			$data['queryTotalPrice'] = $this->db->query('SELECT sum(grossPrice) as sum from '.$this->table)->row()->sum;
		}
		$data['total_rows'] = $total_rows;
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
		
		$companyIDName = $this->db->query("Select distinct(companyID) from t_centerdb where visibility='Y' order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
		$gateway = $this->db->query("Select distinct(gatewayID) from  t_midmaster where visibility='Y' order by gatewayID ASC");
		$data['gateway'] = $gateway;
		$cardTypeName = $this->db->query("Select distinct(cardType) from ".$this->table." where cardType!='' order by cardType ASC ");
		$data['cardTypeName'] = $cardTypeName;		
		$data['order_by_fld'] = $order_by_fld;
		$data['order_by'] = $order_by;
		$this->load->view($this->viewfolder.'list',$data);
	}


	public function edit() {
		$message = '';
		$id = $this->uri->segment(3);
		/*echo $id;
		exit;*/
		$row = $this->common_model->Retrive_Record($this->table,$id);
		$data = array();
		$data['query'] = $row ;
		$data['message'] = $message;
	
		$this->load->view($this->viewfolder.'/edit',$data);
	}
	function update() {
		$message_empty = '';
		$data = array();
		$id= $this->input->post('id');
		$row['validated'] = $this->input->post('validated') ;
		$row['rating'] = $this->input->post('rating') ;
		$row['comment'] = $this->input->post('comment') ;
		$row['qc_agentID'] = $this->session->userdata('ADMIN_ID');
		$row['qc_Date'] = date('Y-m-d H:i:s') ;
		//$row['status'] = $this->input->post('status') ;

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
		$row['validated'] = $value;
		$row['qc_agentID'] = $this->session->userdata('ADMIN_ID');
		$row['qc_Date'] = date('Y-m-d H:i:s') ;

		$this->db->where('id', $id);
		$this->db->update($this->table, $row);
		echo 'success';
	}	// end ofchange_is_active
	public function change_trans_type(){
		$id = $this->input->post('id') ; 
		$value = $this->input->post('val') ;
		$row = $this->common_model->Retrive_Record($this->table,$id);
		//$where_clause .= "status = '%$status%' AND ";
		$row_gateway = $this->common_model->Retrive_Record_By_Where_Clause('t_midmaster',"gatewayID like '%".$row['gatewayID']."%'");
		if($row_gateway['gatewayType']=='nmi'){
			include_once($_SERVER['DOCUMENT_ROOT'].'/system/refunds/'.$row_gateway['programName']);
			$gw = new gwapi;
			$gw->setLogin($row_gateway['username'],$row_gateway['password']);
			if($value == 'Void'){
				$gw->doVoid($row['gatewayTransactionId']);
			}
			if($value == 'Refund'){
				$gw->doRefund($row['gatewayTransactionId']);
			}
			$str = $gw->responses['response'];
		}

		//exit;
		/*$data = array();
		$data['row'] = $row ;*/
		unset($row['id']);
		unset($row['rec_crt_date']);
		unset($row['status']);
		$row['status'] = $value;
		array_push($row['status']);
		//print_r($row);		
		if($value == 'Refund'){
			$insert_id = $this->common_model->addRecord($this->table,$row);
		}
		//exit;
		$row = array();
		$row['status'] = $value;
		$row['qc_agentID'] = $this->session->userdata('ADMIN_ID');
		$row['qc_Date'] = date('Y-m-d H:i:s') ;

		$this->db->where('id', $id);
		$this->db->update($this->table, $row);
		
		echo 'success';
	}
	public function download(){
		/*print_r($_POST);
		exit;*/
/****************************************/	
		$data = array();
		$order_by_fld = 'rec_crt_date';
		$order_by =	'DESC';
		$offset = '';
		$limit = '';
		

		$where_clause = "";
		$data['id'] = '';		
		$data['companyID'] = '';
		$data['gatewayName'] = '';
		$data['directory'] = '';
		$data['programName'] = '';
		$data['decriptor'] = '';
		$data['status'] = '';
		$data['validated'] = '';

		$this->session->set_userdata('gatewayName', $this->input->post('gatewayName'));
		$this->session->set_userdata('status', $this->input->post('status'));
		$this->session->set_userdata('cardType', $this->input->post('cardType'));		
		$this->session->set_userdata('companyID', $this->input->post('companyID'));
		$this->session->set_userdata('start_date', $this->input->post('start_date'));
		if($this->input->post('start_date')!=$this->input->post('end_date')){
			$this->session->set_userdata('end_date', $this->input->post('end_date'));
		}else{
			$this->session->set_userdata('end_date', '');
		}
		
		if($this->session->userdata('status') != '')
		{
			
			$status = $this->session->userdata('status');
			//print_r($status);
			//exit;
			//$where_clause .= "status like '%$status%' AND ";
			foreach($status as $val){
				$where_status_clause .= "status like '%".$val."%' OR ";
				//$where_clause .= "status like '%$status%' AND ";
			}
			$where_clause .="(";
			$where_clause .= substr($where_status_clause, 0, -3);
			$where_clause .=") AND ";			
			
			$data['status'] = $status;
		}
		if($this->session->userdata('gatewayName') != '')
		{
			$gatewayName = $this->session->userdata('gatewayName');
			$where_clause .= "gatewayID LIKE '%$gatewayName%' AND ";
			$data['gatewayName'] = $gatewayName;
		}
		if($this->session->userdata('cardType') != '')
		{
			$cardType = $this->session->userdata('cardType');
			$where_clause .= "cardType LIKE '%$cardType%' AND ";
			$data['cardType'] = $cardType;
		}			
		if($this->session->userdata('companyID') != '')
		{
			$companyID = $this->session->userdata('companyID');
			$where_clause .= "companyID LIKE '%$companyID%' AND ";
			$data['companyID'] = $companyID;
		}		
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') != '')
		{
			$start_date = $this->session->userdata('start_date');
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND ";
			$data['start_date'] = $start_date;

		}
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') == '')
		{
			$start_date = $this->session->userdata('start_date');
			//echo $start_date;
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$where_clause .= "`rec_crt_date` >= ' ".$yyyy_mm_dd." 00:00:00' AND `rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND";
			$data['start_date'] = $start_date;
		}
		
		if($this->session->userdata('end_date') != '')
		{
			$end_date = $this->session->userdata('end_date');
			$parts = explode('-',$end_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];			
			$where_clause .= "`rec_crt_date` <= ' ".$yyyy_mm_dd." 23:59:59' AND ";
			$data['end_date'] = $end_date;
		}


		$where_clause  = substr($where_clause, 0, -4);
		/*$total_rows = $this->common_model->countAll($this->table,$where_clause);
		$query = $this->common_model->get_all_records($this->table, $where_clause,$order_by_fld,$order_by,$offset,$limit);*/

		if($where_clause!='')
		$this->db->where($where_clause);
		$this->db->select('id,companyID,gatewayID,rec_crt_date,fname,lname,customer_phone,customer_email,customer_state, grossPrice,status,cardType');
		$this->db->from($this->table);
		$query = $this->db->get();
	
/****************************************/		
		
		//$headers = ''; // just creating the var for field headers to append to below
		$data = ''; // just creating the var for field data to append to below
		$obj =& get_instance();
		//$fields = $query->field_data();
		if ($query->num_rows() == 0) {
			echo '<p>The table appears to have no data.</p>';
		} 
		else {
			$pieceEmail="";
			if($this->session->userdata('selectedEmails1') != '')
			{
				$selectedEmails1 = $this->session->userdata('selectedEmails1');					
				$pieceEmail=explode(",",$selectedEmails1);
			}
			$headers="Id"."\t"."Center"."\t"."Gateway"."\t"."Date"."\t"."Firstname"."\t"."Lastname"."\t"."Phone"."\t"."Email"."\t"."State"."\t"."Price"."\t"."Status."."\t"."Card ";
			foreach ($query->result() as $row) {
				if(is_array($pieceEmail)){
					if(in_array($row->id,$pieceEmail)){				
						$count = 0;
						$line = '';
						foreach($row as $value) {  
						$count++;                                         
						if ((!isset($value)) OR ($value == "")) {
							$value = "\t";
						} else {
							$value = str_replace('"', '""', $value);
							$value = '"' . $value . '"' . "\t";
						}
						$line .= $value;
							
						}
						$data .= trim($line)."\n";
					}
				}else{
					$count = 0;
					$line = '';
					foreach($row as $value) {  
					$count++;                                         
					if ((!isset($value)) OR ($value == "")) {
						$value = "\t";
					} else {
						$value = str_replace('"', '""', $value);
						$value = '"' . $value . '"' . "\t";
					}
					$line .= $value;
						
					}
					$data .= trim($line)."\n";					
				}
			}
			$data = str_replace("\r","",$data);
			//echo htmlentities("".trim($headers)."\n".$data.""); exit;
			//header("Content-type: application/x-msdownload");
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=export.xls");
			echo "Downloaded Records\n";
			echo "".trim($headers)."\n".$data."";  
			//echo "".trim($headers)."";  
			//$this->session->set_userdata('selectedEmails1', '');
			
		}		
	}
	public function saveEmailId(){
		$val	=	$this->input->post('val');
		$this->session->set_userdata('selectedEmails1', $val);
	}
}?>








