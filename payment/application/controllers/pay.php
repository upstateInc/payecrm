<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pay extends CI_Controller {
	
	public function __construct() {
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");		
		parent::__construct();		
		$this->load->helper(array('url','form','html'));
		$this->load->library(array('session','form_validation','authentication'));
		$this->load->model(array('common_model'));
		$this->ProductTable = 't_product';
	}	
	public function index()
	{
		$data['message'] = ''; 
		$where="companyID ='".COMPANYID."' and status='Y'";		
		$data['ResultProduct'] 	= $this->common_model->get_all_records($this->ProductTable, $where,'productPrice','ASC',$offset,$limit);
		$this->load->view('pay',$data);
	}
	public function product_summery(){
		$id = $this->input->post('id');
		$row = $this->common_model->Retrive_Record($this->ProductTable,$id);
		$productName 				= $row['productName'];
		$productPrice 				= $row['productPrice'];
		$productDescription  		= $row['productDescription'];
		$ProductSupscriptionPeriod  = $row['ProductSupscriptionPeriod'];
		$ProductSupscriptionPeriod	= $ProductSupscriptionPeriod/30;
		$msg = '<p><b>Product name:</b> '.$productName.'</p>';
		$msg .= '<p><b>Product price:</b> $'.$productPrice.'</p>'; 		
		if( floor($ProductSupscriptionPeriod) == 0) {
			$ProductSupscriptionPeriod  =  'One Time';
		}
		if( floor($ProductSupscriptionPeriod) == 1) {
			$ProductSupscriptionPeriod  =   $ProductSupscriptionPeriod.' Month';
		}
		if( floor($ProductSupscriptionPeriod) > 1) {
			$ProductSupscriptionPeriod  =  $ProductSupscriptionPeriod.' Months';
		}
		$msg .= '<p><b>Product Supscription Period:</b> '.$ProductSupscriptionPeriod.' </p>';
		$msg .= '<p><b>Product Description:</b> '.$productDescription.'</p>';		
		$arr = array('msg' => $msg, 'price' => $productPrice);
   		echo json_encode($arr);		
	}
}

