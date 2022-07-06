<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    /** Layout used in this controller */
    public $layout_view = 'layouts/main';

    function __construct() {
        parent::__construct();
        $this->load->helper(array('ajaxpagination', 'utility'));/** load helpers */
        $this->load->library(array('form_validation'));/** Load libraries */
        $this->load->model('User_model', 'user');/** Load models */
        if (!isSystemAdmin() && !isMasterAdmin() && !isClient() && !isStaff()) {
            return redirect('login', 'refresh');
        }
    }

    public function index() {
        $this->layout->view('system-admin/admin');
    }

    public function managemasteradmin() {
        $this->layout->view('master-admin');
    }

    public function loadMasterAdminList() {
        $result_page_data = $this->user->getMasterAdmintList();
        $data = array(
            'masterAdminResult' => $result_page_data
        );
        $this->load->view('_load-master-admin-list', $data);/** Render view */
    }

    public function masteradmincreate() {
        $this->data['testlist']=$this->user->getTestList();
        $post = $this->input->post();
        if ($post) {
            $this->form_validation->set_rules('full_name', 'master administrator name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'email', 'trim|valid_email|required|xss_clean');
            $this->form_validation->set_rules('phone_no', 'phone number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('credits', 'credit', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('master-admin-form');
            } else {
                if ($this->user->saveMasterAdmin($post)) {
                    $this->session->set_flashdata('msg_success', 'Master Adminstrator created successfully.');
                } else {
                    $this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
                }
                return redirect('user/managemasteradmin');
            }
        } else {
            $this->layout->view('master-admin-form',$this->data);
        }
    }

    public function masteradminupdate() {
        $masterAdminId = $this->uri->segment(3);
        $this->data['masterAdminData'] = $this->user->getUser($masterAdminId);
        $this->data['testlist']=$this->user->getTestList();
        $post = $this->input->post();
        if ($post) {
            $this->form_validation->set_rules('full_name', 'master administrator name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone_no', 'phone number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('credits', 'credit', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('master-admin-form', $this->data);
            } else {
                if ($this->user->updateMasterAdmin($post)) {
                    $this->session->set_flashdata('msg_success', 'Master Adminstrator updated successfully.');
                } else {
                    $this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
                }
                return redirect('user/managemasteradmin');
            }
        } else {
            $this->layout->view('master-admin-form', $this->data);
        }
    }

    public function changeStatus() {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $post = $this->input->post();
        if (!empty($post)) {
            $userId = $post['user_id'];
            $status = $post['status'];
            $data = array(
                'status' => $status,
                'last_updated_by' => $loggedinUser,
                'updated_at' => getCurrentDatetime()
            );
            $this->db->where('id', $userId);
            $this->db->update('user', $data);
            echo $status;
        }
        echo false;
    }

    public function loadAdmin() {
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
        $result_page_data = $this->user->getMasterAdmintList();
//        $data = array(
//            'current_page' => $current_page,
//            'record_count' => $record_count,
//            'per_page' => $per_page,
//            'client_result' => $result_page_data
//        );
//        
        //$this->load->view('admin/_load-client-list', $data);/** Render view */
        $data = array(
            'adminResult' => $result_page_data
        );
        $this->load->view('system-admin/_load-admin-list', $data);/** Render view */
    }

    public function delete($id)
    {
        if($this->user->delete($id))
        {
            return redirect('user/userlist');
        }
    }


    public function create() {
        $post = $this->input->post();
        if ($post) {
            $this->form_validation->set_rules('full_name', 'master administrator name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'email', 'trim|valid_email|required|xss_clean');
            $this->form_validation->set_rules('phone_no', 'phone number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('credits', 'credit', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('system-admin/admin-form');
            } else {
                if ($this->user->saveMasterAdmin($post)) {
                    $this->session->set_flashdata('msg_success', 'Master Adminstrator created successfully.');
                } else {
                    $this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
                }
                return redirect('system-admin/admin');
            }
        } else {
            $this->layout->view('system-admin/admin-form');
        }
    }

    public function update() {
        $masterAdminId = $this->uri->segment(4);
        $this->data['adminData'] = $this->user->getMasterAdmin($masterAdminId);
        $post = $this->input->post();
        if ($post) {
            $this->form_validation->set_rules('full_name', 'master administrator name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone_no', 'phone number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('credits', 'credit', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('system-admin/admin-form', $this->data);
            } else {
                if ($this->user->updateMasterAdmin($post)) {
                    $this->session->set_flashdata('msg_success', 'Master Adminstrator updated successfully.');
                } else {
                    $this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
                }
                return redirect('system-admin/admin');
            }
        } else {
            $this->layout->view('system-admin/admin-form', $this->data);
        }
    }
    
    public function userlist() {
        $this->layout->view('user');
    }

    public function loadUserList() {
        $result_page_data = $this->user->getUserList();
        $data = array(
            'userResult' => $result_page_data
        );
        $this->load->view('_load-user-list', $data);/** Render view */
    }

    public function resendLogin($id,$project_id)
    {
        if($this->user->resendLogin($id))
        {
            return redirect('project/getProjectCandidate/'.$project_id);
        }
    }



}