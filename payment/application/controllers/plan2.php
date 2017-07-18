<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan2 extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html'));
		$this->load->library(array('session','form_validation','authentication'));
		$this->load->model(array('common_model'));
		$this->ProductTable 	= 't_product';
	}
	
	public function index()
	{
		$data['message'] = ''; 
		$offset = 3;
		$limit =3;
		$where="companyID ='".COMPANYID."' and status='Y'";
		$data['ResultProduct'] 	= $this->common_model->get_all_records($this->ProductTable, $where, 'productPrice', 'ASC', $offset, $limit);
		$this->load->view('home',$data); 
	}
}

