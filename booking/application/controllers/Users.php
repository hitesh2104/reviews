<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller 
{
	public $sessionData;
	public function __construct(){
		parent::__construct();
		checkSession();
		$this->load->model("user_model");
		$this->sessionData = $this->session->userdata();
		
	}
	
	public function profile(){
		
		if($this->uri->segment(3)=='edit'){
			$data['user_id'] = $this->session->userdata("admin_id");
			
			$data['page_title'] = "Edit Profile";
			$data['active_menu'] = "user";
			$data['profile_action'] = base_url('users/profile/update');
			$data['change_password_action'] = base_url('users/change_password');
			$data['submit_btn_text'] = 'Update';
			$data['breadcrumbs'] = "Edit";
			$data['user_details'] = $this->user_model->get_user(current_user_id());
			$data['province_options'] = province_list('html', $data['user_details']['province']);
			if(empty($data['user_details'])){
				redirect("/home");
			}
			$this->load->view('include/header',$data);
			$this->load->view('profile',$data);
			$this->load->view('include/footer',$data);
			
		} 
		else if($this->uri->segment(3)=='update'){
			$post_data = $this->input->post(NULL, TRUE);
			no_form_input_specified($post_data);
			echo $output = $this->user_model->update_user($post_data);
			die;
		}
		
	}
	
	public function change_password(){
		$post_data = $this->input->post(NULL, TRUE);
		no_form_input_specified($post_data);
		echo $output = $this->user_model->change_password($post_data,current_user_id());
		die;
	}
	
	
	public function manager($action) {
		if(!is_admin()){
			redirect("home");
		}
		if($action == "add"){
			$data['page_title'] = "Add Manager";
			$data['active_menu'] = "clients";
			$data['form_action'] = base_url("users/manager_add");
			$data['province_options'] = province_list('html');
			$data['btnSubmitText'] = "Add";
			$data['btnCancelUrl'] = base_url("users/view");
			$this->load->view('include/header', $data);
			$this->load->view('add_edit_manager', $data);
			$this->load->view('include/footer', $data);
		}
	}
	
	public function manager_add(){
		report_error();
		$post_data = $this->input->post(NULL, TRUE);
		no_form_input_specified($post_data);
		echo $output = $this->user_model->manager_add($post_data);
		die;
	}
	
	
	public function view() {
		if(is_client()){
			redirect("home");
		}
		$data['page_title'] = "View Clients";
		$data['active_menu'] = "clients";
		$data['data_source'] = base_url('users/get_all_members');
		
		
		$columns = array(
		//	array("col" => "id",         "class" => ""),
			array("col" => "Dealership Name", "class" => ""),
			array("col" => "Town & City", "class" => ""),
			array("col" => "fullname",  "class" => ""),
			array("col" => "Email",      "class" => ""),
			array("col" => "Phone",      "class" => "no-sort"),
			array("col" => "Bookings in progress",     "class" => "no-sort col-md-1"),
			array("col" => "Bookings completed",     "class" => "no-sort col-md-1"),
			array("col" => "Total Cost",     "class" => "no-sort col-md-1"),
		);
		$data['table_elements'] = generate_table_head($columns);
		$this->load->view('include/header', $data);
		$this->load->view('member', $data);
		$this->load->view('include/footer', $data);
	}
	
	public function get_all_members(){
		$output = $this->user_model->get_all_members();	
		echo json_encode($output);
		die;
	}
	
	public function candidates(){
		if(is_candidate()){
			redirect("home");
		}
		$data['page_title'] = "View Candidates";
		$data['active_menu'] = "candidate";
		$data['data_source'] = base_url('users/get_all_candidates/0');
		
		
		$columns = array(
			array("col" => "id",         "class" => ""),
			array("col" => "Full Name", "class" => ""),
			array("col" => "ID Number", "class" => ""),
			array("col" => "Email Address", "class" => ""),
			array("col" => "Cellphone", "class" => ""),
	//		array("col" => "Client",      "class" => ""),
			array("col" => "Job Title",     "class" => "no-sort"),
			array("col" => "Date",     "class" => "no-sort"),
			array("col" => "Declined Consent",     "class" => "no-sort"),
			array("col" => "Reports",     "class" => "no-sort"),
			// array("col" => "Action",     "class" => "no-sort"),
		);
		$data['table_elements'] = generate_table_head($columns);
		$this->load->view('include/header', $data);
		$this->load->view('candidates', $data);
		$this->load->view('include/footer', $data);
	}
	
	public function get_all_candidates($booking_id = NULL, $within_booking = 0){
		$output = $this->user_model->get_all_candidates($booking_id, $within_booking);	
		echo json_encode($output);
		die;
	}
	
	public function save_document(){
		$post_data = $this->input->post(NULL, TRUE);
		if(isset($post_data['files']) && $post_data['files']!=""){
			echo $output = $this->user_model->save_report($post_data, $post_data['popup_client_id']);	
			die;
		}
	}
	
	public function get_reports($candidate_id = NULL){
		if($candidate_id == 0 && $candidate_id == ""){
			echo json_encode(array("status"=>0));
			exit;
		}
		$client_reports = $this->user_model->get_user($candidate_id);
		$html = "";
		$this->load->model('booking_model');
		$client_consent_form = $this->booking_model->consent_form_detail($candidate_id);
		if(isset($client_consent_form) && $client_consent_form!=""){
			foreach($client_consent_form as $form_data){
				$html .= '<div class="uploaded_file col-sm-12">
				<div class="file_name col-sm-6"><a href="'.base_url('bookings/get_candidate_consent_form/'.$candidate_id.'/'.$form_data['cfs_id']).'" target="_blank" >Consent Form Report (PDF download) </a></div>
				<div class="clearfix"></div> <hr />
				</div>';	
			}
		}
		
		if($client_reports!=""){
			$report_arr = json_decode($client_reports['candidates_reports'], true);
			
			foreach($report_arr as $report){
				$extra = "";
				if(is_admin()){
					$extra = '<div class="file_remove_box col-sm-3">
					<button type="button" class="remove_this_document btn btn-danger"  data-file_path="'. $report . '"><i class="fa fa-trash-o"></i> Remove </button>
					</div> ';
				}
				$html .= '<div class="uploaded_file col-sm-12">
				<div class="file_name col-sm-6"><a href="'.base_url($report).'" download>'.basename($report).'</a></div>
				<input type="hidden" name="files[]" value="'.$report.'" />
				'.$extra.'
				<div class="clearfix"></div> <hr />
				</div>';	
			}
		} 
		echo $html;
	}

	public function get_documents($candidate_id = NULL){
		// report_error();
		if($candidate_id == 0 && $candidate_id == ""){
			echo json_encode(array("status"=>0));
			exit;
		}
		
		$this->load->model("home_model");
		$client_booking_detail = $this->home_model->get_client_booking($candidate_id);
		$html = '';
		
		$more_html = '';

		$more_html.='<table class="table table-bordered table-responsive">    
		<thead>
		<tr>
		<td> <b> Document  Type  </b></td>
		<td> <b>Document Name   </b></td>
		<td> <b> Action  </b></td>
		</tr>
		</thead>
		<tbody>';
		if($client_booking_detail['candidates_document'] != "" ){
			
			$doc_list = json_decode($client_booking_detail['candidates_document'], true);
			$document_list = document_list();
			
			foreach($doc_list as $key => $document){ 
				if($document!=""){
					
					$temp = explode("-##-", $document);
					$original_name =  $temp[1];
					$file_path = str_replace(" ", '%20', $document);
					$file_path = str_replace("#", '%23', $document);
					$base_filename = basename($file_path);
					$part = pathinfo($base_filename);
					$view_path = "";
					if($part['extension'] == 'pdf'){
						$view_path = base_url("users/view_doc/".$base_filename);
					} else if($part['extension'] == 'png' || $part['extension'] == 'jpg' || $part['extension'] == 'jpeg'){
						$view_path = base_url($file_path);
					}
					$more_html.= '<tr>
					<td>  '.$document_list[$key].'  </td>
					<td> '. $original_name .'   </td>
					<td>  
					<a href="'.$view_path.'" target="_blank" > View </a>   &nbsp;| &nbsp;
					<a href="'.base_url("users/download_doc/".$base_filename).'" > Download </a>   
					</td>
					</tr>';
				}
			}
		}  else {
			$more_html.='<tr><td colspan="3" class="text-center"><b >No Documents Uploaded</b></td></tr>';	
		}
		$more_html.='</tbody>
		</table>';

		echo  json_encode(array("status"=>1, 'verification_list' => $html, 'uploaded_docs' => $more_html));
		exit;
	}	

	public function download_doc($file_path){
		ob_start();
		$file_full_path = "uploads/pdf/". urldecode($file_path);
		$file_url = base_url($file_full_path);
		$file_base_name = basename($file_url);
		header ("Content-type: octet/stream");
		header ("Content-disposition: attachment; filename=" . str_replace(" ", "_", $file_base_name) . ";");
		header ("Content-Length: " . filesize($file_full_path));
		readfile($file_full_path);
		die();
	}

	public function view_doc($file_path){
		ob_start();
		$file_full_path = "uploads/pdf/". urldecode($file_path);
		header ("Content-type: application/pdf");
		header ("Content-disposition: inline; filename=" . base_url($file_full_path) . ";");
		header ("Content-Length: " . filesize($file_full_path));
		readfile($file_full_path);
		die();
		
	}


	public function test_mail(){
		new_registration_mail('Meenesh Jain','j.meenesh@gmail.com','123567890');
	}
}

?>