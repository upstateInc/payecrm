<?php
error_reporting ( 0 );
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class PayeHubApplications extends MX_Controller
{
	public function __construct()
	{
		parent::__construct ();
		$this->load->helper ( 'form', 'url' );
		$this->load->driver ( 'session' );
		$config ['upload_path'] = './uploads/';
		$config ['allowed_types'] = 'doc|docx|pdf|txt|jpg';
		$config ['max_size'] = '10000';
		$config ['max_width'] = '1024';
		$config ['max_height'] = '768';
		$this->load->database ();
		$this->load->library ( 'upload', $config );
		$this->load->library ( 'email' );
	}
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * http://example.com/index.php/welcome
	 * - or -
	 * http://example.com/index.php/welcome/index
	 * - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * 
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view ( "template/header" );
		$this->load->view ( "merchant-form" );
		$this->load->view ( "template/footer" );
	}
}
