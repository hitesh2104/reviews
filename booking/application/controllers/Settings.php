<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller 
{
	public $sessionData;
	public function __construct(){
		parent::__construct();
		checkSession();
		$this->load->model("Settings_model");
		$this->sessionData = $this->session->userdata();
		if($this->sessionData['is_admin'] == 0){
			redirect();
		}
	}
	
	public function index(){
		$data['page_title'] = "Settings";
		$data['active_menu'] = "settings";
		$this->load->view('include/head',$data);
		$this->load->view('settings',$data);
		$this->load->view('include/footer',$data);
	}

	public function manage_center_details() {
		$data['center_details']= $this->Settings_model->get_center_details(1);
		$data['page_title'] = "Manage Centre Details";
		$data['active_menu'] = "settings";
		$this->load->view('include/head',$data);
		$this->load->view('manage_center_details',$data);
		$this->load->view('include/footer',$data);
	}

	public function update_center_details() {
		$postData = $this->input->post(NULL, TRUE);
		no_form_input_specified($postData);
		if(isset($postData['center_name']) && $postData['center_name']!=''){
			$settings_update = $this->Settings_model->update_center_details(1,$postData);
			$output = array('status'=>'success');
			echo json_encode($output);
		}

	}
	
	public function versioning(){
		$data['page_title'] = "System Version Details";
		$data['active_menu'] = "settings";
		$data['system_version']= $this->Settings_model->get_system_versions();
		$this->load->view('include/head',$data);
		$this->load->view('versioning',$data);
		$this->load->view('include/footer',$data);
	}
	
	public function update_system_version(){
		$postData = $this->input->post(NULL, TRUE);
		no_form_input_specified($postData);
		$update_system_version = $this->Settings_model->update_system_version($postData);
		if($update_system_version > 0){
			$output = array('status'=>'success');
		} else {
			$output = array('status'=>'error');
		}
		echo json_encode($output);
	}
	
	
	
}
