<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public $sessionData;
	public function __construct(){
		parent::__construct();
		$this->load->model("home_model");
		$this->sessionData = $this->session->userdata();
		
	}
	
	public function php_info(){
		echo phpinfo();
	}

	public function index() {
		checkSession();
		
		$data['page_title'] = 'Home Page';
		$data['text'] = '';
		$this->load->view('include/header',$data);
		// get booking statistics 
		$this->load->model("booking_model");
		$data['booking_statistics'] = $this->booking_model->get_booking_statistics();
		$this->load->view('home',$data);
		$this->load->view('include/footer');
	}

	public function login()	{
		if($this->session->userdata('logged_in')=='1'){
			redirect("home/");
		}
		$data['page_title']="Login";
		$this->load->view('include/front_header',$data);
		$this->load->view('login',$data);
		$this->load->view('include/front_footer',$data);
	}
	
	public function login_check(){
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$login_check =  $this->home_model->login_check($username,$password);
		if($login_check['status'] == 1){
			
			$session_data = array(
				'is_admin'     => $login_check['status'],
				'user_id'      => $login_check['row']['id'],
				'firstname'    => $login_check['row']['firstname'],
				'lastname'     => $login_check['row']['lastname'],
				'full_name'    => $login_check['row']['fullname'],
				'email'        => $login_check['row']['email'],
				'added_by_admin' => $login_check['row']['added_by_admin'],
				'logged_in'    => '1',
				'user_role'=> $login_check['user_role']
			);

			$this->session->set_userdata($session_data);
			$status =  'success';
			$status_message = "";
		} else  {
			$status =  'invalid';
			$status_message = system_messages()['invalid_login_error'];
		}
		echo json_encode(array("status"=>$status,"message"=>$status_message));
		exit;
	}

	public function logout(){
		$sessionData = $this->session->userdata();		
		if($sessionData['is_admin']=='0'){
			maintain_login_history("",$sessionData['admin_id'],"web",2,$sessionData['ref_login_no']);
		}
		$session_data = array('logged_in' =>'', 'name' => '','username'=>'','admin_id'=>'','is_admin'=>'','user_role'=>'');
		$this->session->unset_userdata('logged_in');
		redirect("login");
	} 


	public function register(){
		if($this->session->userdata('logged_in')=='1'){
			redirect();
		}
		$data['form_action'] = base_url("home/register_user");
		$data['page_title']="Join Us";
		$data['province_options'] = province_list('html');
		$this->load->view('include/front_header',$data);
		$this->load->view('register_user',$data);
		$this->load->view('include/front_footer',$data);
	}

	public function register_user() {
		$post_data = $this->input->post(NULL, TRUE);
		no_form_input_specified($post_data);
		$register_user = $this->home_model->register_user($post_data);
		
		if($register_user){
			if($register_user == "e2"){
				$output = array('status'=>'error', 'message'=>'Entered email address already exists, please try with a different email.');
			} else {
				$output = array('status'=>'success', 'message'=>'Registration successful. We have emailed you the password for your account.');
			}
		} else {
			$output = array('status'=>'error', 'message'=>system_messages()['server_error_message']);
		}
		echo json_encode($output);
	}
	
	
	public function consent_form($candidate_id = NULL){
		
		$data['form_action'] = base_url("home/consent_form_submit/".$candidate_id);
		$data['page_title']="Join Us";
		$data['province_options'] = province_list('html');
		$this->load->view('include/front_header',$data);
		$this->load->view('consent_form',$data);
		$this->load->view('include/front_footer',$data);
	}
	
	public function consent_form_submit($candidate_id) {
		$post_data = $this->input->post(NULL, TRUE);
		no_form_input_specified($post_data);
		$register_user = $this->home_model->consent_form_submit($post_data, $candidate_id);
		
		if($register_user){
			if($register_user == "1") {
				$output = array('status'=>'success', 'message'=>'Consent Form Submitted');
			} else {
				$output = array('status'=>'error', 'message'=>system_messages()['server_error_message']);
			}
		} else {
			$output = array('status'=>'error', 'message'=>system_messages()['server_error_message']);
		}
		echo json_encode($output);
	}
	
	public function consent_success($candidate_id = NULL){
		
		$data['form_action'] = '';
		$data['page_title']="Join Us";
		$data['province_options'] = province_list('html');
		$this->load->view('include/front_header',$data);
		$this->load->view('consent_success',$data);
		$this->load->view('include/front_footer',$data);
	}
	

	function forgot_password(){
		if($this->session->userdata('logged_in')=='1'){
			redirect();
		}
		$data['form_action'] = base_url("home/forgot_password_submit");
		$data['page_title']="Forgot Password";
		$this->load->view('include/front_header',$data);
		$this->load->view('forget_password',$data);
		$this->load->view('include/front_footer',$data);
	}

	/* Forgot password function */
	function forgot_password_submit(){
		$email_address = $this->input->post("email");
		$response =  $this->home_model->forgot_password_submit($email_address);
		if($response['status'] == 1){
			$status = 'success';
			$status_message = "";
		} else if($response['status'] == 3){
			$status = 'inactive';
			$status_message = system_messages()['account_suspended'];
		} else if($response['status'] == 2){ 
			$status = 'deleted';
			$status_message = system_messages()['account_deleted'];
		} else {
			$status = 'invalid';
			$status_message = system_messages()['email_not_found'];
		}
		echo json_encode(array("status"=>$status,"message"=>$status_message));
		exit;
	}
	
	function update_password(){
		checkSession();
		$this->load->model('Registrations_model');
		$member_data = $this->Registrations_model->get_member_details($this->sessionData['admin_id']);
		$data['page_title']="Forgot Password";
		$data['submit_url'] = base_url("home/save_new_password/".$this->sessionData['admin_id']);
		$this->load->view('include/front_header',$data);
		$this->load->view('update_password',$data);
		$this->load->view('include/front_footer',$data);
	}
	
	public function save_new_password($member_id){
		$postData = $this->input->post(NULL, TRUE);
		$this->load->model('Registrations_model');
		$response = $this->Registrations_model->change_password($postData,$member_id);
		echo $response; die;
		
	}
}
