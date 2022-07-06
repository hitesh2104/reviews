<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

    /** Layout used in this controller */
    public $layout_view = 'layouts/main';

    function __construct() {
        parent::__construct();
        $this->load->helper(array('ajaxpagination', 'utility'));/** load helpers */
        $this->load->library(array('form_validation'));/** Load libraries */
        $this->load->model('User_model', 'user');/** Load models */
        if (!isClient() && !isStaff()) { /** Redirect to admin login page if not logged in or is not admin */
            return redirect('login', 'refresh');
        }
    }

    public function index() {
        $this->layout->view('staff');
    }

    public function managestaff() {
        $this->layout->view('staff');
    }

    public function loadStaff() {
        $creatorId = $this->session->userdata('logged_in')['user_id'];
        /** get loggedin user is from session */
        //$clientAdminId = $this->session->userdata('logged_in')['user_id'];
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
        $result_page_data = $this->user->getClientStaffList($creatorId);
//        $data = array(
//            'current_page' => $current_page,
//            'record_count' => $record_count,
//            'per_page' => $per_page,
//            'client_result' => $result_page_data
//        );
//        
        //$this->load->view('admin/_load-client-list', $data);/** Render view */
        $data = array(
            'staffResult' => $result_page_data
        );
        $this->load->view('_load-staff-list', $data);/** Render view */
    }

    public function create() {
        $this->data['testlist']=$this->user->getTestList();
        $this->data['testlist']=$this->user->getMasterTestList();
        $post = $this->input->post();
        if ($post) {
            $this->form_validation->set_rules('full_name', 'full name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'email', 'trim|valid_email|required|xss_clean');
            $this->form_validation->set_rules('phone_no', 'phone number', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('staff-form');
            } else {
                if ($this->user->createStaff($post)) {
                    $this->session->set_flashdata('msg_success', 'Staff registered successfully and their login crediantial were mailed to their provided email address.');
                } else {
                    $this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
                }
                return redirect('staff/managestaff');
            }
        } else {
            $this->layout->view('staff-form',$this->data);
        }
    }

    public function update() {
        $this->data['testlist']=$this->user->getTestList();
        $this->data['testlist']=$this->user->getMasterTestList();
        $staffId = $this->uri->segment(3);
        $this->data['staffData'] = $this->user->getUser($staffId);
        $post = $this->input->post();
        if ($post) {
            $this->form_validation->set_rules('full_name', 'full name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone_no', 'phone number', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('staff-form', $this->data);
            } else {
                if ($this->user->updateStaff($post)) {
                    $this->session->set_flashdata('msg_success', 'Staff details updated successfully.');
                } else {
                    $this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
                }
                return redirect('staff/managestaff');
            }
        } else {
            $this->layout->view('staff-form', $this->data);
        }
    }
    
    public function account() {
        $staffId = $this->session->userdata('logged_in')['user_id'];
        $staffData = $this->user->getUser($staffId);
        $this->data['clientData'] = $this->user->getUser($staffData[0]->created_by);
        $this->data['staffData'] = $staffData;
        $post = $this->input->post();
        if ($post) {
            $this->form_validation->set_rules('full_name', 'full name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone_no', 'phone number', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('staff-account', $this->data);
            } else {
                if ($this->user->updateStaff($post)) {
                    $this->session->set_flashdata('msg_success', 'Your account information updated successfully.');
                } else {
                    $this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
                }
                return redirect('staff/account');
            }
        } else {
            $this->layout->view('staff-account', $this->data);
        }
    }

    public function changeStatus() {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $post = $this->input->post();
        $staffId = $post['staff_id'];
        $status = $post['status'];
        if (!empty($post)) {
            $data = array(
                'status' => $status,
                'last_updated_by' => $loggedinUser,
                'updated_at' => getCurrentDatetime()
            );
            $this->db->where('id', $staffId);
            $this->db->update('user', $data);
            echo $status;
        }
        echo false;
    }

}
