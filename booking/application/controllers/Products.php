<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller 
{
	public $sessionData;
	public function __construct(){
		parent::__construct();
		checkSession();
		$this->load->model("product_model");
		$this->sessionData = $this->session->userdata();
		if(!is_admin()){
			redirect("home");
		}
	}
	
	public function view() {
		$data['page_title'] = "View Products";
		$data['active_menu'] = "product";
		
		// table 1 
		$data['page_job_title'] = "View Jobs";
		$data['data_source_1'] = base_url('products/get_all_jobs');
		$columns = array(
			array("col" => "id",         "class" => ""),
	//		array("col" => "Job Family", "class" => ""),
			array("col" => "Job title",  "class" => ""),
			array("col" => "Total Cost",     "class" => "no-sort"),
		);
		$data['table_job'] = generate_table_head($columns);
		
		// table 2 
		$data['page_assestment_title'] = "View Skills Assessments";
		$data['data_source_2'] = base_url('products/get_all_assessments');
		$columns = array(
			array("col" => "id",         "class" => ""),
			array("col" => "Type", "class" => ""),
			array("col" => "Description",  "class" => ""),
			array("col" => "Cost",      "class" => ""),
		//	array("col" => "Attachment",      "class" => "no-sort"),
		);
		$data['table_assessments'] = generate_table_head($columns);
		
		// table 3 
		$data['page_verification_title'] = "View Verifications";
		$data['data_source_3'] = base_url('products/get_all_verifications');
		$columns = array(
			array("col" => "id",         "class" => ""),
			array("col" => "Type", "class" => ""),
			array("col" => "Description",  "class" => ""),
			array("col" => "Cost",      "class" => ""),
			array("col" => "Attachment",      "class" => "no-sort"),
		);
		$data['table_verification'] = generate_table_head($columns);
		
		$this->load->view('include/header', $data);
		$this->load->view('products', $data);
		$this->load->view('include/footer', $data);
	}
	
	public function get_all_jobs(){
		$output = $this->product_model->get_all_jobs();	
		echo json_encode($output);
		die;
	}
	
	public function get_all_assessments(){
		$output = $this->product_model->get_all_assessments();	
		echo json_encode($output);
		die;
	}
	
	public function get_all_verifications(){
		$output = $this->product_model->get_all_verifications();	
		echo json_encode($output);
		die;
	}
	
	public function add_jobs(){
		$data['page_title'] = "Jobs";
		$data['short_message'] = "Add Job";
		$data['active_menu'] = "products";
		$data['btnSubmitText'] = "Add";
		$data['btnCancelUrl'] = base_url("products/view");
		$data['form_action'] = base_url('products/save_job');
		$data['redirect_url'] = base_url('products/view');
		$this->load->view('include/header',$data);
		$this->load->view('add_edit_jobs',$data);
		$this->load->view('include/footer',$data);
	}
	
	public function save_job(){
		$post_data = $this->input->post(NULL, TRUE);
		$response = $this->product_model->save_job($post_data);
		if($response ==1 ){
			$output = array("status"=>"success","message"=>"Job saved successfully");
		} else {
			$output = array("status"=>"error","message"=>"There was some error while updating, please try again.");
		}
		echo json_encode($output);
	}
	
	public function edit_jobs($job_id){
		if($job_id== ""){
			redirect("product/view");
		}
		$data['page_title'] = "Jobs";
		$data['short_message'] = "Edit Job";
		$data['active_menu'] = "products";
		$data['breadCrumbs'] = "Products";
		$data['btnSubmitText'] = "Update";
		$data['btnCancelUrl'] = base_url("products/view");
		$data['form_action'] = base_url('products/update_job/'.$job_id);
		$data['redirect_url'] = base_url('products/view');
		$data['job_data'] = $this->product_model->get_job_details($job_id);;
		$this->load->view('include/header',$data);
		$this->load->view('add_edit_jobs',$data);
		$this->load->view('include/footer',$data);
	}
	
	public function update_job($job_id){
		$post_data = $this->input->post(NULL, TRUE);
		$response = $this->product_model->update_job($post_data, $job_id);
		if($response ==1 ){
			$output = array("status"=>"success","message"=>"Job updated successfully");
		} else {
			$output = array("status"=>"error","message"=>"There was some error while updating, please try again.");
		}
		echo json_encode($output);
	}
	
	public function add_assessments(){
		$data['page_title'] = "Assessments";
		$data['short_message'] = "Add Assessments";
		$data['active_menu'] = "products";
		$data['breadCrumbs'] = "Products";
		$data['btnSubmitText'] = "Add";
		$data['btnCancelUrl'] = base_url("products/view");
		$data['form_action'] = base_url('products/save_assessments');
		$data['redirect_url'] = base_url('products/view');
		$data['type_list'] = get_type_dd("html");
		$this->load->view('include/header',$data);
		$this->load->view('add_edit_assessments',$data);
		$this->load->view('include/footer',$data);
	}
	
	public function save_assessments(){
		$post_data = $this->input->post(NULL, TRUE);
		$response = $this->product_model->save_assessments($post_data);
		if($response ==1 ){
			$output = array("status"=>"success","message"=>"Assessments saved successfully");
		} else {
			$output = array("status"=>"error","message"=>"There was some error while updating, please try again.");
		}
		echo json_encode($output);
	}
	
	public function edit_assessments($assessments_id){
		if($assessments_id== ""){
			redirect("product/view");
		}
		$data['page_title'] = "Jobs";
		$data['short_message'] = "Edit Assessments";
		$data['active_menu'] = "products";
		$data['btnSubmitText'] = "Update";
		$data['btnCancelUrl'] = base_url("products/view");
		$data['form_action'] = base_url('products/update_assessments/'.$assessments_id);
		$data['redirect_url'] = base_url('products/view');
		$data['assessments_data'] = $this->product_model->get_assesments_details($assessments_id);;
		$data['type_list'] = get_type_dd("html" , $data['assessments_data']['type']);
		$this->load->view('include/header',$data);
		$this->load->view('add_edit_assessments',$data);
		$this->load->view('include/footer',$data);
	}
	
	public function update_assessments($assessments_id){
		$post_data = $this->input->post(NULL, TRUE);
		$response = $this->product_model->update_assessments($post_data, $assessments_id);
		if($response ==1 ){
			$output = array("status"=>"success","message"=>"Assessments updated successfully");
		} else {
			$output = array("status"=>"error","message"=>"There was some error while updating, please try again.");
		}
		echo json_encode($output);
	}
	
	
	public function add_verifications(){
		$data['page_title'] = "Verifications";
		$data['short_message'] = "Add Verifications";
		$data['active_menu'] = "products";
		$data['breadCrumbs'] = "Products";
		$data['btnSubmitText'] = "Add";
		$data['btnCancelUrl'] = base_url("products/view");
		$data['form_action'] = base_url('products/save_verifications');
		$data['redirect_url'] = base_url('products/view');
		$this->load->view('include/header',$data);
		$this->load->view('add_edit_verifications',$data);
		$this->load->view('include/footer',$data);
	}
	
	public function save_verifications(){
		$post_data = $this->input->post(NULL, TRUE);
		$response = $this->product_model->save_verifications($post_data);
		if($response ==1 ){
			$output = array("status"=>"success","message"=>"Verifications saved successfully");
		} else {
			$output = array("status"=>"error","message"=>"There was some error while updating, please try again.");
		}
		echo json_encode($output);
	}
	
	public function edit_verifications($verification_id){
		if($verification_id== ""){
			redirect("product/view");
		}
		$data['page_title'] = "Jobs";
		$data['short_message'] = "Edit Verifications";
		$data['active_menu'] = "products";
		$data['btnSubmitText'] = "Update";
		$data['btnCancelUrl'] = base_url("products/view");
		$data['form_action'] = base_url('products/update_verifications/'.$verification_id);
		$data['redirect_url'] = base_url('products/view');
		$data['assessments_data'] = $this->product_model->get_verification_details($verification_id);;
		$this->load->view('include/header',$data);
		$this->load->view('add_edit_verifications',$data);
		$this->load->view('include/footer',$data);
	}
	
	public function update_verifications($verification_id){
		$post_data = $this->input->post(NULL, TRUE);
		$response = $this->product_model->update_verifications($post_data, $verification_id);
		if($response ==1 ){
			$output = array("status"=>"success","message"=>"Verifications updated successfully");
		} else {
			$output = array("status"=>"error","message"=>"There was some error while updating, please try again.");
		}
		echo json_encode($output);
	}
 
	
	
}
?>