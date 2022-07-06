<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate extends CI_Controller {

    /** Layout used in this controller */
    public $layout_view = 'layouts/main';

    function __construct() {
        parent::__construct();
        $this->load->helper(array('ajaxpagination'));/** load helpers */
        $this->load->library(array('form_validation'));/** Load libraries */
        $this->load->model('Candidate_model', 'candidate');/** Load models */
        $this->load->model('Test_model', 'test');/** Load models */
        if (!isMasterAdmin() && !isClient() && !isStaff() && !isCandidate()) { /** Redirect to admin login page if not logged in or is not admin */
            return redirect('login', 'refresh');
        }
    }

    public function index() {
        $this->layout->view('candidate');
    }
    
    public function managecandidate() {
        $this->layout->view('candidate');
    }

    public function loadCandidate() {
        /** get loggedin user is from session */
        $userId = $this->session->userdata('logged_in')['user_id'];
        /** initialization for paging */
//        $page = $this->input->post('page', TRUE);
//        $current_page = $page;
//        $page -= 1;
//        $per_page = 10;
//        $start = $page * $per_page;
//        $limit = $per_page;
//        $offset = $start;
//        /** getting total record count */
//        $record_count = count($this->company->getClientList(null, null, null));
//        /** get record based on limit and offset */
//        $result_page_data = $this->company->getClientList(null, $limit, $offset);
        $result_page_data = $this->candidate->getCandidateList($userId);
//        $data = array(
//            'current_page' => $current_page,
//            'record_count' => $record_count,
//            'per_page' => $per_page,
//            'client_result' => $result_page_data
//        );
//        
        //$this->load->view('admin/_load-client-list', $data);/** Render view */
        $data = array(
            'candidateResult' => $result_page_data
        );
        $this->load->view('_load-candidate-list', $data);/** Render view */
    }
    
    public function update() {
        $candidateId = $this->uri->segment(3);
        $this->data['candidateData'] = $this->candidate->getCandidateInfo($candidateId);
        $post = $this->input->post();
        if ($post) {
            $this->form_validation->set_rules('full_name', 'full name', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('candidate-form', $this->data);
            } else {
                if ($this->candidate->updateCandidateInfo($post)) {
                    $this->session->set_flashdata('msg_success', 'Participant details updated successfully.');
                } else {
                    $this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
                }
                return redirect('candidate/managecandidate');
            }
        } else {
            $this->layout->view('candidate-form', $this->data);
        }
    }

    public function changeStatus() {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $post = $this->input->post();
        $participantId = $post['participant_id'];
        $status = $post['status'];
        if (!empty($post)) {
            $data = array(
                'status' => $status,
                'last_updated_by' => $loggedinUser,
                'updated_at' => getCurrentDatetime()
            );

            $this->db->where('id', $participantId);
            $this->db->update('user', $data);
            echo $status;
        }
        echo false;
    }
    
    public function test() {
        $candidateId = $this->session->userdata('logged_in')['user_id'];
        $this->data['testDetail'] = $this->test->getCandidateTestInfo($candidateId);
        $this->layout->view('test', $this->data);
    }
    
    public function details() {
        $candidateId = $this->session->userdata('logged_in')['user_id'];
        $this->data['candidateData'] = $this->candidate->getCandidateInfo($candidateId);
        $post = $this->input->post();
        if ($post) {
            $this->form_validation->set_rules('full_name', 'full name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('marital_status', 'marital status', 'trim|required|xss_clean');
            $this->form_validation->set_rules('gender', 'gender', 'trim|required|xss_clean');
            $this->form_validation->set_rules('age', 'age', 'trim|required|xss_clean');
            $this->form_validation->set_rules('nationality', 'nationality', 'trim|required|xss_clean');
            $this->form_validation->set_rules('id_passport_no', 'ID/Passport Number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone_no', 'phone number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('home_language', 'home language', 'trim|required|xss_clean');
            $this->form_validation->set_rules('current_job_title', 'current job title', 'trim|required|xss_clean');
            $this->form_validation->set_rules('working_experience', 'working experience', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('candidate-detail-form', $this->data);
            } else {
                if ($this->candidate->registerDetail($post)) {
                    $this->session->set_flashdata('msg_success', 'Your details updated successfully.');
                } else {
                    $this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
                }
                return redirect('candidate/details');
            }
        } else {
            $this->layout->view('candidate-detail-form', $this->data);
        }
    }
    
    public function register() {
        $candidateId = $this->session->userdata('logged_in')['user_id'];
        $this->data['candidateData'] = $this->candidate->getCandidateInfo($candidateId);
        $post = $this->input->post();
        if ($post) {
            $this->form_validation->set_rules('full_name', 'full name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('marital_status', 'marital status', 'trim|required|xss_clean');
            $this->form_validation->set_rules('gender', 'gender', 'trim|required|xss_clean');
            $this->form_validation->set_rules('age', 'age', 'trim|required|xss_clean');
            $this->form_validation->set_rules('nationality', 'nationality', 'trim|required|xss_clean');
            $this->form_validation->set_rules('id_passport_no', 'ID/Passport Number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone_no', 'phone number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('home_language', 'home language', 'trim|required|xss_clean');
            $this->form_validation->set_rules('current_job_title', 'current job title', 'trim|required|xss_clean');
            $this->form_validation->set_rules('working_experience', 'working experience', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('candidate-detail-form', $this->data);
            } else {
                if ($this->candidate->registerDetail($post)) {
                    return redirect('candidate/consent');
                } else {
                    $this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
                }
                return redirect('candidate/register');
            }
        } else {
            $this->layout->view('candidate-detail-form', $this->data);
        }
    }
    
    public function consent() {
            $this->layout->view('consent');
    }

}
