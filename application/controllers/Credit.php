<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Credit extends CI_Controller {

	/** Layout used in this controller */
	public $layout_view = 'layouts/main';

	function __construct() {
		parent::__construct();
		$this->load->helper(array('ajaxpagination', 'utility')); /** load helpers */
		$this->load->library(array('form_validation')); /** Load libraries */
		$this->load->model('Credit_model', 'credit'); /** Load models */
		$this->load->model('Common_model', 'common'); /** Load models */
		if (!isSystemAdmin() && !isMasterAdmin() && !isClient()) {
			return redirect('login', 'refresh');
		}
	}

	public function index() {
		$this->layout->view('credit-request');
	}

	public function managecreditrequest() {
		$this->layout->view('credit-request');
	}

	public function loadCreditRequest() {
		$userId = $this->session->userdata('logged_in')['user_id'];
		$result_page_data = $this->credit->getCreditRequestList($userId);

		$data = array(
			'creditResult' => $result_page_data,
		);
		$this->load->view('_load-credit-request-list', $data); /** Render view */
	}

	public function sendcreditrequest() {
		$post = $this->input->post();
		if ($post) {
			if ($this->credit->sendCreditRequest($post)) {
				$this->session->set_flashdata('msg_success', 'Credit request send successfully.');
			} else {
				$this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
			}
		}
		return redirect('credit/managecredit');
	}

	public function approvecreditrequest() {
		$post = $this->input->post();
		if ($post) {
			if ($this->credit->approveCreditRequest($post)) {
				$this->session->set_flashdata('msg_success', 'Credit request approved successfully.');
			} else {
				$this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
			}
		}
		return redirect('credit/managecreditrequest');
	}

	public function declinecreditrequest($id) {
		$post = $this->input->post();
		if ($this->credit->declineCreditRequest($id)) {
			$this->session->set_flashdata('msg_success', 'Credit request declined successfully.');
		}
		$this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
		return redirect('credit/managecreditrequest');
	}

	public function managecredit() {
		$userId = $this->session->userdata('logged_in')['user_id'];
		$this->data['userCredit'] = $this->common->getUserAvailableCredit($userId);
		$this->layout->view('credit', $this->data);
	}

	public function loadCredit() {
		$userId = $this->session->userdata('logged_in')['user_id'];
		$result_page_data = $this->credit->getRequestedCreditList($userId);

		$data = array(
			'creditResult' => $result_page_data,
		);
		$this->load->view('_load-credit-list', $data); /** Render view */
	}

}
