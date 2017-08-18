<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class My_sales extends CI_Controller
{
	public function __construct()
	{
		parent::__construct ();
		$this->load->helper ( array (
				'url',
				'form',
				'html',
				'file' 
		) );
		$this->load->library ( array (
				'session',
				'authentication',
				'form_validation',
				'email',
				'upload',
				'image_lib',
				'pagination' 
		) );
		$this->load->model ( array (
				'common_model' 
		) );		
	}
	
	public function index()
	{
		$data = array();
		$this->load->view ( 'my_sales/index', $data );
	}
}