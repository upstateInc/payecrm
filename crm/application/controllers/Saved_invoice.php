<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Saved_invoice extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html','dompdf', 'file'));
		$this->load->library(array('session','authentication','form_validation','email','upload','image_lib','pagination'));
		$this->load->model(array('common_model'));
		$this->tableCenter = 't_merchant';
		$this->table = 't_savedInvoice';
		$this->viewfolder = 'saved_invoice/';
		$this->controllerFile = 'saved_invoice/';
		$this->namefile = 'saved_invoice';
		$this->tableCenterGroup = 't_centerGroup';
	}
	public function index() {
		$message = '';
		$data = array();
		/*$order_by_fld = 'INVOICECOMPANYID';
		$order_by =	'ASC';*/
		//$order_by_fld = STR_TO_DATE(STARTDATE,"%m/%d/%Y").' DESC, INVOICECOMPANYID ASC';
		$order_by_fld = 'STARTDATE DESC, INVOICECOMPANYID ASC';
		//$order_by =	'DESC';
		$order_by =	'';
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
		$where_clause1 = "";
		$data['id'] = '';		
		$data['companyID'] = '';
		$data['fees_type'] = '';
		$data['directory'] = '';
		$data['programName'] = '';
		$data['decriptor'] = '';
		$data['status'] = '';
		$data['paymentType'] = '';
		$data['start_date'] = '';
		$data['end_date'] = '';
		//print_r($_POST);
		if($this->session->userdata('ADMIN_GROUP_ID')!=""){
			$where_clause .= '( ';
			$where_clause1 .= '( ';
			$centerquery = $this->common_model->get_all_records($this->tableCenterGroup, 'groupId = '.$this->session->userdata('ADMIN_GROUP_ID').'', 'id', 'ASC','','');
			
			foreach($centerquery->result() as $row){
				$new_where_clause .= "INVOICECOMPANYID = '".$row->companyID."' OR ";
				$new_where_clause1 .= "companyID = '".$row->companyID."' OR ";
			}
			$where_clause  .= substr($new_where_clause, 0, -3);
			$where_clause1  .= substr($new_where_clause1, 0, -3);
			$where_clause .= ' ) AND ';
			$where_clause1 .= ' ) AND ';
		}
		if($this->session->userdata('ADMIN_COMPANYID')!=""){
			$where_clause = "INVOICECOMPANYID = '".$this->session->userdata('ADMIN_COMPANYID')."' AND "; 
			$where_clause1 = "companyID = '".$this->session->userdata('ADMIN_COMPANYID')."' AND "; 
		}
		if($this->uri->segment(3) == '' && $this->uri->segment(2)!='index')
		{
			$this->session->set_userdata('id', '');			
			$this->session->set_userdata('companyID', '');
			$this->session->set_userdata('fees_type', '');
			$this->session->set_userdata('directory', '');
			$this->session->set_userdata('programName', '');
			$this->session->set_userdata('decriptor', '');
			$this->session->set_userdata('status', '');
			$this->session->set_userdata('paymentType', '');
			$this->session->set_userdata('start_date', '');
			$this->session->set_userdata('end_date', '');			
		}
		if($this->input->post('search')!= '')
		{
			
			$this->session->set_userdata('id', $this->input->post('id'));			
			$this->session->set_userdata('companyID', $this->input->post('companyID'));
			$this->session->set_userdata('fees_type', $this->input->post('fees_type'));
			$this->session->set_userdata('directory', $this->input->post('directory'));
			$this->session->set_userdata('programName', $this->input->post('programName'));
			$this->session->set_userdata('decriptor', $this->input->post('decriptor'));
			$this->session->set_userdata('status', $this->input->post('status'));
			$this->session->set_userdata('paymentType', $this->input->post('paymentType'));
			$this->session->set_userdata('start_date', $this->input->post('start_date'));
			if($this->input->post('start_date')!=$this->input->post('end_date')){
				$this->session->set_userdata('end_date', $this->input->post('end_date'));
			}else{
				$this->session->set_userdata('end_date', '');
			}			
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
			$where_clause .= "INVOICECOMPANYID LIKE '%$companyID%' AND ";
			$data['companyID'] = $companyID;
		}		
		if($this->session->userdata('fees_type') != '')
		{
			$fees_type = $this->session->userdata('fees_type');
			$where_clause .= "fees_type LIKE '%$fees_type%' AND ";
			$data['fees_type'] = $fees_type;
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
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') != '')
		{
			$start_date = $this->session->userdata('start_date');
			$end_date = $this->session->userdata('end_date');
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			
			
			$end_parts = explode('-',$end_date);
			$yyyy_mm_dd1 = $end_parts[2] . '-' . $end_parts[0] . '-' . $end_parts[1];
			
			$where_clause .= "(
				DATE_FORMAT(STR_TO_DATE(STARTDATE, '%m/%d/%Y'), '%Y-%m-%d') >=  '".$yyyy_mm_dd."'
				AND DATE_FORMAT(STR_TO_DATE(STARTDATE, '%m/%d/%Y'), '%Y-%m-%d') <=  '".$yyyy_mm_dd1."'
			) AND";
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
		}
		if($this->session->userdata('start_date') != '' && $this->session->userdata('end_date') == '')
		{
			$start_date = $this->session->userdata('start_date');
			$parts = explode('-',$start_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$where_clause .= "(
				DATE_FORMAT(STR_TO_DATE(STARTDATE, '%m/%d/%Y'), '%Y-%m-%d') >=  '".$yyyy_mm_dd."'					
			) AND";
			$data['start_date'] = $start_date;
		}
		
		if($this->session->userdata('start_date') == '' && $this->session->userdata('end_date') != '')
		{
			$end_date = $this->session->userdata('end_date');
			$parts = explode('-',$end_date);
			$yyyy_mm_dd = $parts[2] . '-' . $parts[0] . '-' . $parts[1];			
			$where_clause .= "(
				DATE_FORMAT(STR_TO_DATE(STARTDATE, '%m/%d/%Y'), '%Y-%m-%d') <=  '".$yyyy_mm_dd."'
			) AND";
			$data['end_date'] = $end_date;
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
		
		//$companyIDName = $this->common_model->get_all_records('t_center_fees', '','id','ASC','','');
		//$companyIDName = $this->db->query("Select distinct(companyID) from ".$this->tableCenter."  where visibility='Y' order by companyID ASC");
		//$data['companyIDName'] = $companyIDName;
		$companyIDName = $this->db->query("Select distinct(companyID) from ".$this->tableCenter."  where ".$where_clause1." visibility='Y' order by companyID ASC");
		$data['companyIDName'] = $companyIDName;
		$center_fees = $this->db->query("Select distinct(fees_type) as center_feesName from   t_fees where status='Y' order by fees_type ASC");
		$data['center_fees'] = $center_fees;
		$data['order_by_fld'] = $order_by_fld;
		$data['order_by'] = $order_by;
		$this->load->view($this->viewfolder.'list',$data);
	}
	public function add() {
		$message = '';
		$data['message'] = $message;
		$companyIDName = $this->db->query("Select distinct(companyID) from ".$this->tableCenter."  where visibility='Y' order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
		$center_fees = $this->db->query("Select distinct(fees_type) as center_feesName from   t_fees where status='Y' order by fees_type ASC");
		$data['center_fees'] = $center_fees;		
		$this->load->view($this->viewfolder.'/add',$data);
	}
	public function insert() {
		$row['companyID'] = $this->input->post('companyID') ;
		$row['fees_type'] = $this->input->post('fees_type') ;
		$row['fee'] = $this->input->post('fee');			
		$row['fee_type'] = $this->input->post('fee_type');			
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
		$companyIDName = $this->db->query("Select distinct(companyID) from ".$this->tableCenter."  where visibility='Y' order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
		$center_fees = $this->db->query("Select distinct(fees_type) as center_feesName from   t_fees where status='Y' order by fees_type ASC");
		$data['center_fees'] = $center_fees;		
		$this->load->view($this->viewfolder.'/edit',$data);
	}
	public function copy(){
		$message = '';
		$id = $this->uri->segment(3);
		$row = $this->common_model->Retrive_Record($this->table,$id);
		$data = array();
		$data['query'] = $row ;
		$data['message'] = $message;
		$companyIDName = $this->db->query("Select distinct(companyID) from ".$this->tableCenter."  where visibility='Y' order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
		$center_fees = $this->db->query("Select distinct(fees_type) as center_feesName from   t_fees where status='Y' order by fees_type ASC");
		$data['center_fees'] = $center_fees;		
		$this->load->view($this->viewfolder.'/copy',$data);
	}
	function update() {
		$message_empty = '';
		$data = array();
		$id= $this->input->post('id');
		$row['companyID'] = $this->input->post('companyID') ;
		$row['fees_type'] = $this->input->post('fees_type') ;		
		$row['fee'] = $this->input->post('fee') ;
		$row['fee_type'] = $this->input->post('fee_type');
		$row['status'] = $this->input->post('status');					
		//$row['rec_update_date'] = date('Y-m-d H:i:s') ;
			
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
		$this->db->delete('t_savedInvoice'); 
		$message = setMessage('Record deleted successfully',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));
	}
	function send_invoice_email(){
		$data = array();
		$InvoiceCC='';
		
		$email=$this->input->post('email');
		$InvoiceCC=$this->input->post('InvoiceCC');
		$InvoiceBCC=$this->input->post('InvoiceBCC');
		$notes=$this->input->post('notes');
		//exit;
		$tempInvoiceGenerationId = $this->input->post('tempInvoiceGenerationId');
		
		/*if($this->input->post('SendCompany')=='yes'){
			//$InvoiceCC INVOICECOMPANYID
			$InvoiceCC = $this->db->query("select a.invoiceEmails from ".$this->tableCenter."  as a left join t_savedInvoice as b on a.companyID = b.INVOICECOMPANYID where b.tempInvoiceGenerationId like '%".$tempInvoiceGenerationId."%' ")->row()->invoiceEmails;
		}*/
		//echo $InvoiceCC;
		//exit;
		$where_clause = "tempInvoiceGenerationId like '%".$tempInvoiceGenerationId."%'";
		$query = $this->common_model->get_all_records('t_invoiceDebitCredit', $where_clause,'id','desc',$offset,$limit);
		$data['query'] = $query ;

		$row = $this->common_model->Retrive_Record_By_Where_Clause1('t_savedInvoice',$where_clause);
		$data['row'] = $row ;
		/*echo $this->db->last_query();
		exit;*/
		require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/email_function.php");
		//$time = time();
		require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."dompdf/dompdf_config.inc.php");		
		
		//require_once($_SERVER['DOCUMENT_ROOT'].'/system/'."email/pdf_template.php");
		

		$html = $this->load->view('invoice/invoice',$data,true);

		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();
		file_put_contents($tempInvoiceGenerationId.'.pdf', $dompdf->output());
		
		$emailContent = "Hello,<br>";
		$emailContent .= "Kindly find the Invoice Attached with this email.<br>";
		$emailContent .= $notes;
		
		/*$email1=explode(",",$email);
		foreach($email1 as $emailVal){
			mail_file_attach( $emailVal, 'Invoice', $emailContent, COMPANYEMAIL, $tempInvoiceGenerationId.'.pdf',$InvoiceCC,'', '' );
		
		}*/
		mail_file_attach2( $email, 'Invoice', $emailContent, COMPANYEMAIL, $tempInvoiceGenerationId.'.pdf',$InvoiceCC,$InvoiceBCC );
		unlink($tempInvoiceGenerationId.'.pdf');
		echo "<script language=javascript> javascript:history.back();</script>";		
		
		//pdf_create($html, 'invoice');	
/**********************Email Block*******************************/
//require ('../class.phpmailer.php');
/*require $_SERVER['DOCUMENT_ROOT'].'/system/email/phpmailer/PHPMailerAutoload.php';
try {
        $mail = new PHPMailer(true); //New instance, with exceptions enabled

        $body             = $emailContent;
        $body             = preg_replace('/\\\\/','', $body); //Strip backslashes

        $mail->IsSMTP();                           // tell the class to use SMTP
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->Port       = 25;                    // set the SMTP server port
        $mail->Host       = "localhost"; // SMTP server
       // $mail->Username   = "EMAIL USER ACCOUNT";     // SMTP server username
       // $mail->Password   = "EMAIL USER PASSWORD";            // SMTP server password

        $mail->IsSendmail();  // tell the class to use Sendmail

        $mail->AddReplyTo(COMPANYEMAIL,"Udriveon");

        $mail->From       = COMPANYEMAIL;
        $mail->FromName   = 'Udriveon';

        $to = $email;

        $mail->AddAddress($to);

        $mail->Subject  = "Invoice";

        //$mail->ConfirmReadingTo = "someone@something.com"; //this is the command to request for read receipt. The read receipt email will send to the email address.
		$mail->addCC($InvoiceCC);
		$mail->addBCC($InvoiceBCC);
		$mail->addAttachment($fileatt);
        //$mail->AltBody    = "Please return read receipt to me."; // optional, comment out and test
       // $mail->WordWrap   = 80; // set word wrap

        $mail->MsgHTML($body);

        $mail->IsHTML(true); // send as HTML

        $mail->Send();
        echo 'Message has been sent.';
} catch (phpmailerException $e) {
        echo $e->errorMessage();
}	*/	
	}
}
?>








