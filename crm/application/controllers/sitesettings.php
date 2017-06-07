<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitesettings extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url','form','html'));
		$this->load->library(array('session','authentication','form_validation','email'));
		$this->load->model(array('common_model'));
		$this->authentication->is_loggedin($this->session->userdata('ADMIN_ID'));
		$this->table = SITE_SETTINGS;
		$this->viewfolder = 'admin/sitesettings/';
		$this->row_sitesettings=$this->site_settings->settings();
	}
	
	public function index()
	{
		$id = 1;
		$whereCondition = 'id = '.$id;
		$row_sitesettings = $this->common_model->Retrive_Record_By_Where_Clause($this->table,$whereCondition);
		$data["row_sitesettings"] = $row_sitesettings;
		$this->load->view($this->viewfolder.'view',$data);
	}

	public function update_site_settings()
	{
		$id = $this->input->post('id');
		$row["company_email"] = $this->input->post('company_email');
		$row["support_email"] = $this->input->post('support_email');
		$row["feedback_email"] = $this->input->post('feedback_email');
		$row["admin_email"] = $this->input->post('admin_email');
		$row["company_name"] = addslashes($this->input->post('company_name'));
		$row["company_address"] = addslashes($this->input->post('company_address'));
		$row["city"] = addslashes($this->input->post('city'));
		$row["state"] = addslashes($this->input->post('state'));
		$row["zip"] = $this->input->post('zip');
		$row["country"] = addslashes($this->input->post('country'));
		$row["company_phone"] = $this->input->post('company_phone');
		$row["company_fax"] = $this->input->post('company_fax');
		$row["website_name"] = addslashes($this->input->post('website_name'));
		$row["footer_content"] = addslashes($this->input->post('footer_content'));
		$row["seo_title"] = addslashes($this->input->post('seo_title'));
		$row["seo_description"] = addslashes($this->input->post('seo_description'));
		$row["seo_keywords"] = addslashes($this->input->post('seo_keywords'));
		$row["last_updated "] = date('Y-m-d');
		
		$this->common_model->Update_Record($row,$this->table,$id);
		
		$this->session->set_flashdata('message', 'Site Settings Saved Successfully.');
		ci_redirect(base_url().$this->viewfolder);
						
	}
		
}

