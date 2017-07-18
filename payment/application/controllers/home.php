<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct() {
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");				
		parent::__construct();
		$this->load->helper(array('url','form','html'));
		$this->load->library(array('session','form_validation','authentication'));
		$this->load->model(array('common_model'));
		$this->ProductTable 	= 't_product';
		$this->cartTable 		= 't_cart';
	}	
	public function index()
	{
		$data['message'] = ''; 
		$data['ResultProduct'] 	= $this->common_model->get_all_records($this->ProductTable, '','id','ASC',$offset,$limit);
		$this->load->view('home',$data); 
	}
	public function insertCart() 
	{
		/*echo '1'.SERVICETYPE;
		echo '2'.MINPERCENTAGE;
		echo '3'.MAXPERCENTAGE;
		exit;*/

		$id = $this->input->post('id');
		$row = $this->common_model->Retrive_Record($this->ProductTable,$id);

		/********************Service Type charge calculation************/
		$newProductPrice = $row['productPrice'];		
		if(SERVICETYPE!='None'){
			$randomPercentage=mt_rand(MINPERCENTAGE*10, MAXPERCENTAGE*10)/10;
		}
		if(SERVICETYPE=='Fee'){
			$newProductPrice = number_format($row['productPrice'] + ($row['productPrice'] * $randomPercentage/100),2);
		}		
		if(SERVICETYPE=='Discount'){
			$newProductPrice = number_format($row['productPrice'] - ($row['productPrice'] * $randomPercentage/100),2);
		}		
		/**************************************************************/
		
		$insertCart['customer_ip'] 		= $_SERVER['REMOTE_ADDR'];
		$insertCart['product_id'] 		= $this->input->post('id');
		$insertCart['quantity'] 		= $this->input->post('qty');
		//$insertCart['price_each'] 		= $row['productPrice'];
		$insertCart['price_each'] 		= $newProductPrice;
		$insertCart['rec_crt_date'] 	= date('y-m-d H:i:s');
		$getProductDetails=$this->db->query("select * from ".$this->ProductTable." where id=".$insertCart['product_id'])->row();
		$insertCart['productName'] = $getProductDetails->productName;
		$insertCart['ProductSupscriptionPeriod'] = $getProductDetails->ProductSupscriptionPeriod;
		$insertCart['no_of_support'] = $getProductDetails->no_of_support;
		$insertCart['productDescription'] = $getProductDetails->productDescription;
		$insertid = $this->common_model->Add_Record($insertCart,$this->cartTable);
		echo 'success';
	}	
}

