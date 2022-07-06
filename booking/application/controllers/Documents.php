<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Documents extends CI_Controller 
{
	public $sessionData;
	public function __construct(){
		parent::__construct();
		checkSession();
		$this->load->model("home_model");
		$this->sessionData = $this->session->userdata();
		
	}
	
	public function index(){
		$data['page_title'] = "Upload Documents";
		$data['short_message'] = "Please upload the following documents:";
		$data['active_menu'] = "candidate";
		$data['form_action'] = base_url('documents/save_uploaded_docs');
		$data['client_booking_detail'] = $this->home_model->get_client_booking();
		$data['verifications'] = explode(";", $data['client_booking_detail']['verification']);
		$data['verification_type'] = $this->home_model->get_verification_types($data['client_booking_detail']['verification']);
		
		$data['document_list'] =  $data['client_booking_detail']['candidates_document'];
		$data['btnSubmitText'] = "Submit Documents"; 
		$this->load->view('include/header', $data);
		$this->load->view('documents', $data);
		$this->load->view('include/footer', $data);
	}
	
	public function upload(){
		echo  $file_name = upload_documents('doc_upload'); 
		exit;
	}
	
	public function save_uploaded_docs(){
		$post_data = $this->input->post(NULL, TRUE);
		
		
		$type_of_doc = document_list();
		$uploaded_doc = array();
		if($post_data['previous_docs'] != ""){
			$uploaded_doc = json_decode($post_data['previous_docs'], true);
		} 
		foreach($type_of_doc as $doc => $doc_text ){
			$file_obj = $_FILES[$doc];
			if($file_obj['error']  == 0) {
				$uploaded_doc[$doc] = upload_documents($doc);
			}
		}
		
		if(!empty($uploaded_doc)){
			$res = $this->home_model->save_uploaded_doc($uploaded_doc);
			if($res > 0){
				$this->session->set_flashdata('msg', 'Documents submitted successfully');
			} else {
				$this->session->set_flashdata('msg', 'There was some error, Please try again.');
			}
		} else {
			$this->session->set_flashdata('msg', 'No updates in any documents.');
		}
		
		redirect('documents/');
	}
	
	
	
	public function remove_doc(){
		$post_data = $this->input->post(NULL, TRUE);
		if($post_data['file_path'] != ""){
			if(unlink($post_data['file_path'])){
				echo 1;
			} else {
				echo 0;
			}
		} else {
			echo 0;
		}
		exit;
	}
	
}