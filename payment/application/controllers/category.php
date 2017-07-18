<?php
class Category extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html'));
		$this->load->library(array('session','authentication','encryption','pagination'));
		$this->authentication->is_loggedin($this->session->userdata('ADMIN_ID'));
		$this->controllerFile	=	'category';
		$this->viewfolder 		= 	'category';
		$this->ProductTypeTable = 	't_productType';
		$this->ProductTable 	= 	't_productMaster';
		$this->ProductCompany 	= 	't_product';
		$this->categoryTable    =   't_category';
		$this->load->model(array('common_model'));
	}
	
	
	public function index() {
		$message = '';
		$data = array();
		$order_by_fld = 'id';
		$order_by =	'DESC';
		$offset = (int)$this->uri->segment(3,0);
		$limit = 20;
		
		$where_clause = "";
		
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
		/***************Search*****************/
		$data['category'] = '';
		$data['brandName'] = '';
		$data['genericName'] = '';
		if($this->uri->segment(3) == '' && $this->uri->segment(2)!='index')
		{
			$this->session->set_userdata('category', '');
			$this->session->set_userdata('brandName', '');
			$this->session->set_userdata('genericName', '');
		}
		if($this->input->post('search')!= '')
		{
			$this->session->set_userdata('category', $this->input->post('category'));
			$this->session->set_userdata('brandName', $this->input->post('brandName'));
			$this->session->set_userdata('genericName', $this->input->post('genericName'));
		}
		if($this->session->userdata('category') != '')
		{
			$category = $this->session->userdata('category');
			$where_clause .= "category = '".$category."' AND ";
			$data['category'] = $category;
		}		
		if($this->session->userdata('brandName') != '')
		{
			$brandName = $this->session->userdata('brandName');
			$where_clause .= "brandName = '".$brandName."' AND ";
			$data['brandName'] = $brandName;
		}		
		if($this->session->userdata('genericName') != '')
		{
			$genericName = $this->session->userdata('genericName');
			$where_clause .= "genericName = '".$genericName."' AND ";
			$data['genericName'] = $genericName;
		}
		$where_clause  = substr($where_clause, 0, -4);
		/*************************************/
		$data['result_product_type'] 	= $this->common_model->GetAll($this->ProductTypeTable);
		$total_rows 				    = $this->common_model->countAll($this->ProductTable,$where_clause);
		$config['base_url'] = base_url().$this->controllerFile."/index";
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
		$data['ResultProduct'] 	= $this->common_model->get_all_records($this->ProductTable, $where_clause,$order_by_fld,$order_by,$offset,$limit);
		$data['resultCategory'] 	= $this->common_model->get_all_records($this->categoryTable, '','name','ASC','','');
		$data['resultBrand'] 	= $this->db->query("Select distinct(brandName) from ".$this->ProductTable." order by brandName ASC ");
		$data['resultGeneric'] 	= $this->db->query("Select distinct(genericName) from ".$this->ProductTable." order by genericName ASC ");
		$this->load->view($this->viewfolder.'/list',$data);
		
	}
	function add(){
		$data['resultCategory'] 	= $this->common_model->get_all_records($this->categoryTable, '','name','ASC','','');
		$this->load->view($this->viewfolder.'/add',$data);
	}	
	function edit(){
		$data = array();		
		$message = '';
		$id = $this->uri->segment(3);
		$row = $this->common_model->Retrive_Record($this->ProductTable,$id);
		//echo $this->db->last_query();
		$data['resultCategory'] 	= $this->common_model->get_all_records($this->categoryTable, '','name','ASC','','');		
		$data['query'] = $row ;
		$data['message'] = $message;		
		$this->load->view($this->viewfolder.'/edit',$data);
	}
	public function insert(){
		$row['category'] = $this->input->post('category');
		$row['brandName'] = $this->input->post('brandName');
		$row['genericName'] = $this->input->post('genericName');
		$row['dosage'] = $this->input->post('dosage');
		$row['pack'] = $this->input->post('pack');
		$row['form'] = $this->input->post('form');
		$row['cost'] = $this->input->post('cost');
		$row['manufacturer'] = $this->input->post('manufacturer');
		$insert_id = $this->common_model->addRecord($this->ProductTable,$row);	
		$message = setMessage('Product added successfully.',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));	
	}	
	public function update(){
		$id = $this->input->post('id');
		$row['category'] = $this->input->post('category');
		$row['brandName'] = $this->input->post('brandName');
		$row['genericName'] = $this->input->post('genericName');
		$row['dosage'] = $this->input->post('dosage');
		$row['pack'] = $this->input->post('pack');
		$row['form'] = $this->input->post('form');
		$row['cost'] = $this->input->post('cost');
		$row['manufacturer'] = $this->input->post('manufacturer');
		$insert_id = $this->common_model->Update_Record($row,$this->ProductTable,$id);	
		$message = setMessage('Product Updated Successfully.',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));	
	}

}
// end of class
?>