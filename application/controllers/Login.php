<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form'), 'utility'); //Load helper
		$this->load->library('user_agent');
		checkBrowser();
		$this->load->library(array('form_validation')); //Load helper
		$this->load->model('Authentication_model', 'auth');
		$this->load->model('Project_model', 'project'); /** Load models */
		$this->load->model('User_model', 'user');
		$this->load->model('Candidate_model', 'candidate'); /** Load models */
		$this->load->library('encrypt');
		ini_set('display_errors', 0);
		if (isSystemAdmin() || isMasterAdmin() || isClient() || isStaff()) {
			/** Redirect to admin login page if not logged in or is not admin */
			return redirect('dashboard');
		}
	}

	public function index() {
		if ($this->input->post()) {
			/** For remember me */
			if ($this->input->post('remember')) {
				$year = time() + 60 * 60 * 24 * 15;
				$this->input->set_cookie('remember_email', $this->input->post('username'), $year); //set cookies
				$this->input->set_cookie('remember_password', $this->input->post('password'), $year); //set cookies
				$this->input->set_cookie('remember', $this->input->post('username'), $year); //set cookies
			} else {
				if (get_cookie('remember')) {
					delete_cookie("remember");
					delete_cookie("remember_email");
					delete_cookie("remember_password");
				}
			}

			$this->form_validation->set_rules('username', 'E-mail or username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			if ($this->form_validation->run() == FALSE) {

				$this->load->view('login');
			} else {
				$customer_data = array(
					'username' => trim($this->input->post('username')),
					'password' => md5($this->input->post('password')),
				);

				if ($this->auth->login($customer_data)) {
					if (isSystemAdmin() || isMasterAdmin() || isClient() || isStaff()) {
						return redirect('dashboard');
					} elseif (isCandidate()) {
						if ($this->session->userdata('logged_in')['is_update_profile'] == 1) {
							return redirect('candidate/test');
						} else {
							return redirect('candidate/register');
						}
					}
				}
				$this->session->set_flashdata('login_error', 'Incorrect email/username or password.');
				$this->load->view('login'); /** Render view */
			}
		} else {
			$this->load->view('login'); /** Render view */
		}
	}

	public function check_email() {
		if ($this->user->check_email()) {
			echo "true";
		} else {
			echo "false";
		}
	}

	public function forgot_password() {
		$result = $this->user->forgot_password();
		if ($result === true) {
			$this->session->set_flashdata('msg_success', 'Your New Password sent to your email');
			return redirect('login', 'refresh');
		} elseif ($result == "inactive") {
			$this->session->set_flashdata('msg_warning', 'Oops ! You account is temporary on hold.');
			return redirect('login', 'refresh');
		} else {
			$this->session->set_flashdata('msg_error', 'Oops ! Some Internal Error');
			return redirect('login', 'refresh');
		}
	}

	public function signUp($pid) {
		if (!empty($pid)) {
			$post = $this->input->post();
			if ($post) {
				$project_id = base64_decode(urldecode($pid));

				$project_data = $this->project->getProject($project_id);

				if (!empty($project_data[0]->id)) {

					$args['full_name'] = $post['first_name'] . " " . $post['last_name'];
					$args['email'] = $post['email'];
					$args['password'] = generatePassword();
					$args['phone_no'] = $post['phone_no'];
					$args['created_by'] = $project_data[0]->created_by;
					$args['master_user_id'] = $project_data[0]->created_by;
					$args['created_at'] = time();

					//$project_id=base64_decode(urldecode($pid));

					$project_data = $this->project->getProject($project_id);

					$testlist = $project_data[0]->test_list;

					$args['test_list'] = $testlist;
					$args['master_user_id'] = $project_data[0]->master_user_id;
					$args['client_user_id'] = $project_data[0]->client_user_id;
					$args['projectId'] = $project_id;
					$args['status'] = $project_data[0]->status == 'active' ? 'active' : 'inactive';
					$args['mtype'] = 'signup';
					$args['regi'] = 1;
					$launch_result = $this->project->launchCandidate($args);

					if ($launch_result) {
						$post['full_name'] = $post['first_name'] . " " . $post['last_name'];
						$post['id'] = $launch_result;

						if ($this->candidate->registerDetail($post)) {
							$session_data = array(
								'user_id' => $launch_result,
								'role' => "candidate",
								'username' => '',
								'full_name' => $post['first_name'] . " " . $post['last_name'],
								'email' => $post['email'],
								'credits' => 0,
								'is_update_profile' => 1,
								'master_user_id' => $project_data[0]->master_user_id,
								'created_by' => $project_data[0]->created_by,
								'client_user_id' => $project_data[0]->client_user_id,
							);
							$this->session->set_userdata('logged_in', $session_data);
						}

						return redirect('candidate/test');
					}
				} else {
					$this->session->set_flashdata('register_error', 'Your link has been expired or not avalilable');
				}
			}
			$data['project_id'] = $pid;
			$this->load->view('signup', $data);
		} else {

		}
	}

}
