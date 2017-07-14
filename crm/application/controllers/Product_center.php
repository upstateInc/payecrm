<?php
class Product_center extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html'));
		$this->load->library(array('session','authentication','encryption','pagination'));
		$this->controllerFile	=	'product-center';
		$this->tableCenter = 't_merchant';
		$this->viewfolder 		= 	'product_center';
		$this->ProductTypeTable = 	't_productType';
		$this->ProductTable 	= 	't_product';
		$this->table			= 	't_product';
		$this->ProductCompany 	= 	't_product';
		$this->categoryTable    =   't_category';
		$this->namefile 		= 	'product_center';
		$this->tableCenterGroup = 't_centerGroup';
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
		//$where_clause = "CompanyID ='".COMPANYID."' AND ";
		$where_clause1 = "";
		if($this->session->userdata('ADMIN_GROUP_ID')!=""){
			$where_clause .= '( ';
			$where_clause1 .= '( ';
			$centerquery = $this->common_model->get_all_records($this->tableCenterGroup, 'groupId = '.$this->session->userdata('ADMIN_GROUP_ID').'', 'id', 'ASC','','');
			
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
		$data['productName'] = '';
		$data['order_by'] = '';
		$data['order_by_fld'] = '';
		$data['companyID'] = '';
		if($this->uri->segment(3) == '' && $this->uri->segment(2)!='index')
		{
			$this->session->set_userdata('category', '');
			$this->session->set_userdata('brandName', '');
			$this->session->set_userdata('productName', '');	
			$this->session->set_userdata('companyID', '');
		}
		if($this->input->post('search')!= '')
		{
			$this->session->set_userdata('category', $this->input->post('category'));
			$this->session->set_userdata('brandName', $this->input->post('brandName'));
			$this->session->set_userdata('productName', $this->input->post('productName'));	
			$this->session->set_userdata('companyID', $this->input->post('companyID'));
		}
		if($this->session->userdata('companyID') != '')
		{
			$companyID = $this->session->userdata('companyID');
			$where_clause .= "companyID LIKE '%$companyID%' AND ";
			$data['companyID'] = $companyID;
		}		
		if($this->session->userdata('productName') != '')
		{
			$productName = $this->session->userdata('productName');
			$where_clause .= "productName like '%".$productName."%' AND ";
			$data['productName'] = $productName;
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
		$total_rows 				    = $this->common_model->countAll($this->ProductCompany,$where_clause);
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
		$data['ResultProduct'] 	= $this->common_model->get_all_records($this->ProductCompany, $where_clause,$order_by_fld,$order_by,$offset,$limit);
		//$data['resultCategory'] 	= $this->common_model->get_all_records($this->categoryTable, '','name','ASC','','');
		//$data['resultBrand'] 	= $this->db->query("Select distinct(brandName) from ".$this->ProductTable." order by brandName ASC ");
		//$data['resultGeneric'] 	= $this->db->query("Select distinct(genericName) from ".$this->ProductTable." order by genericName ASC ");	
		$companyIDName = $this->db->query("Select distinct(companyID) from ".$this->tableCenter."  where ".$where_clause1." visibility='Y' order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
		
		$this->load->view($this->viewfolder.'/list',$data);
		
	}
	function add(){
		$data['resultCategory'] 	= $this->common_model->get_all_records($this->categoryTable, '','name','ASC','','');
		$companyIDName = $this->db->query("Select distinct(companyID) from ".$this->tableCenter."  where ".$where_clause1." visibility='Y' order by companyID ASC");
		$data['companyIDName'] = $companyIDName;		
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
	function copy(){
		$data = array();		
		$message = '';
		$id = $this->uri->segment(3);
		$row = $this->common_model->Retrive_Record($this->ProductTable,$id);
		//echo $this->db->last_query();
		$data['resultCategory'] 	= $this->common_model->get_all_records($this->categoryTable, '','name','ASC','','');		
		$data['query'] = $row ;
		$data['message'] = $message;		
		$this->load->view($this->viewfolder.'/copy',$data);
	}
	
	public function insert(){
		$row['productName'] = $this->input->post('productName');
		$row['dosage'] = $this->input->post('dosage');
		$row['pack'] = $this->input->post('pack');
		$row['form'] = $this->input->post('form');
		$row['amount'] = $this->input->post('amount');
		$row['sku_name'] = $this->input->post('sku_name');
		$row['sku_number'] = $this->input->post('sku_number');
		if($this->session->userdata('ADMIN_COMPANYID')!=""){
			$row['companyID'] = $this->session->userdata('ADMIN_COMPANYID');
		}else if($this->input->post('companyID')!=""){
			$row['companyID'] = $this->input->post('companyID');
		}
		$insert_id = $this->common_model->addRecord($this->ProductTable,$row);	
		$message = setMessage('Product added successfully.',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));	
	}	
	public function update(){
		$id = $this->input->post('id');
		$row['productName'] = $this->input->post('productName');
		$row['dosage'] = $this->input->post('dosage');
		$row['pack'] = $this->input->post('pack');
		$row['form'] = $this->input->post('form');
		$row['amount'] = $this->input->post('amount');
		$row['sku_name'] = $this->input->post('sku_name');
		$row['sku_number'] = $this->input->post('sku_number');
		
		$insert_id = $this->common_model->Update_Record($row,$this->ProductTable,$id);	
		$message = setMessage('Product Updated Successfully.',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));	
	}
	function delete_single($id) {
		$this->db->where('id', $id);
		$this->db->delete($this->table); 
		$message = setMessage('Record deleted successfully',"success");
		$this->session->set_flashdata('message', $message);
		redirect(site_url($this->controllerFile));
	}	
/******************************************************************/	
	function list_product() {
		
		
		
		$data['result_product_type'] 	= $this->common_model->GetAll($this->ProductTypeTable);
		$total_rows 				    = $this->common_model->countAll($this->ProductTable,$where_clause);
		$offset 						= (int)$this->uri->segment(3,0);
		$limit 							= 20;
		//Pagination config
		$config['base_url'] 		= base_url()."product/list-product/";
		$config['uri_segment']  	= 3;
		$config['total_rows'] 		= $total_rows;
		$config['per_page'] 		= $limit;
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
				
		$this->pagination->initialize($config);
		$paginator 					= $this->pagination->create_links();
		$data['links'] 				= $paginator;
		$data['ResultProduct'] 	= $this->common_model->get_all_records($this->ProductTable, '','id','DESC',$offset,$limit);
		$this->load->view($this->viewfolder.'/product',$data);
		
	}
		
	
	function product_type() {
		
		if($this->session->userdata('ADMIN_TYPE')=='tech' and $this->session->userdata('ADMIN_TYPE')=='sales'){
			redirect(base_url("").'dashboard', 'refresh');
		}
		
		$total_rows 				    = $this->common_model->countAll($this->ProductTable,$where_clause);
		$offset 						= (int)$this->uri->segment(3,0);
		$limit 							= 20;
		//Pagination config
		$config['base_url'] 		= base_url()."product/product_type/";
		$config['uri_segment']  	= 3;
		$config['total_rows'] 		= $total_rows;
		$config['per_page'] 		= $limit;
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
				
		$this->pagination->initialize($config);
		$paginator 					= $this->pagination->create_links();
		$data['links'] 				= $paginator;
		$data['ResultProductType'] 	= $this->common_model->get_all_records($this->ProductTypeTable, '','id','DESC',$offset,$limit);
		$this->load->view($this->viewfolder.'/product_type',$data);
	}
	
	function add_product(){
		
		if($this->session->userdata('ADMIN_TYPE')=='tech' and $this->session->userdata('ADMIN_TYPE')=='sales'){
			redirect(base_url("").'dashboard', 'refresh');
		}
		
		$insert['productType']					=	$this->encryption->decode($this->input->post("productType"));
		$insert['productName']					=	$this->input->post("productName");
		$insert['productPrice']					=	$this->input->post("productPrice");
		$insert['ProductSupscriptionPeriod']	=	$this->input->post("ProductSupscriptionPeriod");
		$insert['no_of_support']				=	$this->input->post("number_of_support");
		$insert['productDescription']			=	$this->input->post("productDescription");
		
		$insert['rec_crt_date']					=	date('c');
		$insert['rec_up_date']					=	date('c');
		
		$this->common_model->Add_Record($insert,$this->ProductTable);
		// success
		$this->session->set_flashdata('success', 'Product added successfully');
		redirect('product/list-product', 'refresh');
		
	}
	
	
	
	function add_product_type(){
		
		if($this->session->userdata('ADMIN_TYPE')=='tech' and $this->session->userdata('ADMIN_TYPE')=='sales'){
			redirect(base_url("").'dashboard', 'refresh');
		}
		
		$insert['productTypeName']				=	$this->input->post("product_type");
		$insert['productTypeDescription']		=	$this->input->post("product_type_description");
		$insert['rec_crt_date']					=	date('c');
		$insert['rec_up_date']					=	date('c');
		$this->common_model->Add_Record($insert,$this->ProductTypeTable);
		// success
		$this->session->set_flashdata('success', 'Product type added successfully');
		redirect('product/product-type', 'refresh');
	}
	
	function product_type_delete(){
		
		if($this->session->userdata('ADMIN_TYPE')=='tech' and $this->session->userdata('ADMIN_TYPE')=='sales'){
			redirect(base_url("").'dashboard', 'refresh');
		}
		
		$id		 	= $this->encryption->decode($this->input->get('id'));
		$this->common_model->delfn($this->ProductTypeTable,$id);
		
		// success
		$this->session->set_flashdata('success', 'Product type deleted successfully');
		redirect('product/product-type', 'refresh');
	}
	
	function product_delete(){
		
		
		
		$id		 	= $this->encryption->decode($this->input->get('id'));
		$this->common_model->delfn($this->ProductTable,$id);
		
		// success
		$this->session->set_flashdata('success', 'Product type deleted successfully');
		redirect('product/list-product', 'refresh');
	}
	
	function product_type_edit(){
		
		if($this->session->userdata('ADMIN_TYPE')=='tech' and $this->session->userdata('ADMIN_TYPE')=='sales'){
			redirect(base_url("").'dashboard', 'refresh');
		}
		
		$id		 	= $this->encryption->decode($this->input->get('id'));
		$ResultProductType = $this->common_model->Retrive_Record_By_Where_Clause2($this->ProductTypeTable,array('id'=>$id));
		foreach ($ResultProductType->result() as $ProductTypeRow){   
		echo '<div class="form-group">
				<label for="exampleInputEmail1">Product type*</label>
				<input type="text" class="form-control" id="product_type" name="product_type" placeholder="Enter product type" required="required" value="'.$ProductTypeRow->productTypeName.'">
			  </div>
               <input type="hidden" name="id" value="'.$this->encryption->encode($id).'" />   
			  <div class="form-group">
			   <label for="exampleInputEmail1">Product type description</label>
			   <textarea name="product_type_description" class="form-control" id="product_type_description" placeholder="Enter product type description">'.$ProductTypeRow->productTypeDescription.'</textarea>
			  </div>';
		}
	}
	
	function product_edit(){
		
		if($this->session->userdata('ADMIN_TYPE')=='tech' and $this->session->userdata('ADMIN_TYPE')=='sales'){
			redirect(base_url("").'dashboard', 'refresh');
		}
		
		$id		 				= $this->encryption->decode($this->input->get('id'));
		$result_product_type 	= $this->common_model->GetAll($this->ProductTypeTable);
		
		$ResultProduct = $this->common_model->Retrive_Record_By_Where_Clause2($this->ProductTable,array('id'=>$id));
		
		foreach ($ResultProduct->result() as $ProductRow){   
				
				echo '<div class="form-group">
                    <label for="exampleInputEmail1">Product type*</label>
                    <select name="productType" id="productType" class="form-control" required="required">
                    	<option value="">Select product type</option>';
                       
						foreach ($result_product_type->result() as $product_type_row)
						{
							if($ProductRow->productType == $product_type_row->id){
							echo '<option value="'.$this->encryption->encode($product_type_row->id).'" selected>'.$product_type_row->productTypeName.'</option>';
							}
							else
							{
								echo '<option value="'.$this->encryption->encode($product_type_row->id).'" >'.$product_type_row->productTypeName.'</option>';
							}
						}
						
                echo  '</select>
                  </div>
                  
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product name*</label>
                    <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" required="required" value="'.$ProductRow->productName.'">
                  </div>
				  
				  <input type="hidden" name="id" value="'.$this->encryption->encode($ProductRow->id).'" />
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product price*</label>
                    <input type="text" class="form-control" id="productPrice" name="productPrice" placeholder="Enter product price" required="required" value="'.$ProductRow->productPrice.'">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product supscription period*</label>
                    <input type="number" class="form-control" id="ProductSupscriptionPeriod" name="ProductSupscriptionPeriod" placeholder="Enter supscription period" required="required" value="'.$ProductRow->ProductSupscriptionPeriod.'">
                  </div>
				  
				  <div class="form-group">
                    <label for="exampleInputEmail1">Product number of support*</label>
                    <input type="number" class="form-control" id="number_of_support" name="number_of_support" placeholder="Enter number of support for product" required="required" value="'.$ProductRow->no_of_support.'">
                  </div>
                  
                  <div class="form-group">
                   <label>Product description</label>
                   <textarea name="productDescription" class="form-control" id="productDescription'.$this->encryption->encode($ProductRow->id).'" placeholder="Enter product description" required="required">'.$ProductRow->productDescription.'</textarea>
                  </div>
				  
				  <script>
				  function editerload(id) {
						$("#productDescription"+id+"").summernote({
						  toolbar: [
							//[groupname, [button list]]
							 
							["style", ["bold", "italic", "underline", "clear"]],
							["font", ["strikethrough"]],
							["fontsize", ["fontsize"]],
							["color", ["color"]],
							["para", ["ul", "ol", "paragraph"]],
							["height", ["height"]],
						  ]
						});
				  }
				  </script>';
		}
	}
	
	
	
	function update_product_type(){
		
		if($this->session->userdata('ADMIN_TYPE')=='tech' and $this->session->userdata('ADMIN_TYPE')=='sales'){
			redirect(base_url("").'dashboard', 'refresh');
		}
		
		$id		 								=   $this->encryption->decode($this->input->post('id'));
		$insert['productTypeName']				=	$this->input->post("product_type");
		$insert['productTypeDescription']		=	$this->input->post("product_type_description");
		$insert['rec_up_date']					=	date('c');
		$this->common_model->Update_Record($insert,$this->ProductTypeTable,$id);
		// success
		$this->session->set_flashdata('success', 'Product type updated successfully');
		redirect('product/product-type', 'refresh');
	}
	
	/*function update_product(){
		
		if($this->session->userdata('ADMIN_TYPE')=='tech' and $this->session->userdata('ADMIN_TYPE')=='sales'){
			redirect(base_url("").'dashboard', 'refresh');
		}
		
		$id		 								=   $this->encryption->decode($this->input->post('id'));
		
		$insert['productType']					=	$this->encryption->decode($this->input->post("productType"));
		$insert['productName']					=	$this->input->post("productName");
		$insert['productPrice']					=	$this->input->post("productPrice");
		$insert['ProductSupscriptionPeriod']	=	$this->input->post("ProductSupscriptionPeriod");
		$insert['productDescription']			=	$this->input->post("productDescription");
		$insert['no_of_support']				=	$this->input->post("number_of_support");
		$insert['rec_up_date']					=	date('c');
		
		$this->common_model->Update_Record($insert,$this->ProductTable,$id);
		// success
		$this->session->set_flashdata('success', 'Product updated successfully');
		redirect('product/list-product', 'refresh');
	}*/
	public function add_all_product(){
		$ResultProduct 	= $this->common_model->get_all_records($this->ProductTable, '','id','DESC','','');
		foreach ($ResultProduct->result() as $row){	
			$insertCart['category'] = $row->category;				
			$insertCart['brandName'] = $row->brandName;					
			$insertCart['genericName'] = $row->genericName;
			$insertCart['dosage'] = $row->dosage;
			$insertCart['pack'] = $row->pack;
			$insertCart['form'] = $row->form;
			$insertCart['cost'] = $row->cost;
			$insertCart['manufacturer'] = $row->manufacturer;	
			$insertCart['companyID'] = COMPANYID;	
			$insertCart['orginalProductId'] = $row->id;
			$rowSearch = $this->common_model->Retrive_Record_By_Where_Clause($this->ProductCompany,'orginalProductId = "'.$row->id.'" and companyID="'.COMPANYID.'"');
			if(empty($rowSearch)){
				$insertid = $this->common_model->Add_Record($insertCart,$this->ProductCompany);
			}
		}
		$this->session->set_flashdata('success', 'Product updated successfully');
		redirect('product', 'refresh');		
	}
	public function addSelectedProduct(){
		$addSelectedProduct = $this->input->post("selected");
		//exit;
		$addSelectedProductEach = explode(",",$addSelectedProduct);
		foreach($addSelectedProductEach as $val){
			$id=$val;
			$row = $this->common_model->Retrive_Record_By_Where_Clause($this->ProductTable,'id = "'.$id.'"');
			$insertCart['category'] = $row['category'];				
			$insertCart['brandName'] = $row['brandName'];					
			$insertCart['genericName'] = $row['genericName'];
			$insertCart['dosage'] = $row['dosage'];
			$insertCart['pack'] = $row['pack'];
			$insertCart['form'] = $row['form'];
			$insertCart['cost'] = $row['cost'];
			$insertCart['manufacturer'] = $row['manufacturer'];	
			$insertCart['companyID'] = COMPANYID;
			$insertCart['orginalProductId'] = $row['id'];
			$rowSearch = $this->common_model->Retrive_Record_By_Where_Clause($this->ProductCompany,'orginalProductId = "'.$row['id'].'" and companyID="'.COMPANYID.'"');
			//print_r($rowSearch);
			if(empty($rowSearch)){
				$insertid = $this->common_model->Add_Record($insertCart,$this->ProductCompany);
			}
		}
		//echo $id;
		echo "Product Added To Company";
	}
	public function change_is_active() {
		$id = $this->input->post('id') ; 
		$value = $this->input->post('val') ; 
		$row = array();
		$row['status'] = $value;

		$this->db->where('id', $id);
		$this->db->update($this->ProductCompany, $row);
		echo 'success';
	}	// end ofchange_is_active
	public function update_product(){
		$id = $this->input->post('id');
		$update['cost'] = $this->input->post('cost');
		$update['amount'] = $this->input->post('amount');
		$update['sku_number'] = $this->input->post('sku_number');
		//$this->db->query("Update ".$this->ProductCompany." set cost='".$cost."',sku_number='".$sku_number."' where id='".$id."'");
		$this->common_model->Update_Record($update,$this->ProductCompany,$id);
		//echo $this->db->last_query();
		echo 'Product Updated Successfully';
	}
}
// end of class
?>