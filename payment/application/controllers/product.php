<?php
class Product extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html'));
		$this->load->library(array('session','authentication','encryption','pagination'));
		$this->authentication->is_loggedin($this->session->userdata('ADMIN_ID'));
		$this->viewfolder 		= 'product';
		$this->ProductTypeTable = 't_productType';
		$this->ProductTable 	= 't_product';
		$this->load->model(array('common_model'));
	}
	
	
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
	
	function update_product(){
		
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
	}
	
}
// end of class
?>