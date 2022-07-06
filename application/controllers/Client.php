<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

    /** Layout used in this controller */
    public $layout_view = 'layouts/main';

    function __construct() {
        parent::__construct();
        $this->load->helper(array('ajaxpagination', 'utility'));/** load helpers */
        $this->load->library(array('form_validation'));/** Load libraries */
        $this->load->model('User_model', 'user');/** Load models */
       if (!isSystemAdmin() && !isMasterAdmin()) { /** Redirect to admin login page if not logged in or is not admin */
           return redirect('login', 'refresh');
       }
    }

    public function index() {
        $this->layout->view('client');
    }

    public function manageclient() {
        $this->layout->view('client');
    }

//    public function index() {
//        $customer_id = $this->session->userdata('logged_in')['id'];
//        $loggedin_customer_email = $this->session->userdata('logged_in')['email'];
//        $this->data['make_data'] = $this->Vehicle_model->get_make();
//        
//        //get vehicle_id from url
//        $vehicle_id = $this->uri->segment(4);
//        $this->data['vehicle_data'] = $this->Vehicle_model->get_vehicle($vehicle_id);
//
//        if ($this->input->post()) {
//            $this->form_validation->set_rules('make', 'make', 'trim|required|xss_clean');
//            $this->form_validation->set_rules('model', 'model', 'trim|required|xss_clean');
//            $this->form_validation->set_rules('registration_no', 'vehicle registration', 'trim|required|xss_clean');
//            $this->form_validation->set_rules('color', 'color', 'trim|required|xss_clean');
//            $this->form_validation->set_rules('type', 'type', 'trim|required|xss_clean');
//            if ($this->form_validation->run() == FALSE) {
//                $this->layout->view('customer/vehicle', $this->data);
//            } else {
//                $save_post = array(
//                    'vehicle_id' => $vehicle_id,
//                    'customer_id' => $customer_id,
//                    'make' => trim(addslashes($this->input->post('make'))),
//                    'model' => trim(addslashes($this->input->post('model'))),
//                    'registration_no' => trim(addslashes($this->input->post('registration_no'))),
//                    'color' => trim(addslashes($this->input->post('color'))),
//                    'type' => trim($this->input->post('type')),
//                    'updated_by' => $loggedin_customer_email
//                );
//
//                if (empty($vehicle_id)) { //INSERT VEHICHE
//                    if ($this->Vehicle_model->save_vehicle($save_post)) {
//                        $this->session->set_flashdata('success_msg', 'Vehicle saved successfully.');
//                        redirect('customer/vehicle');
//                    }
//                } else { //UPDATE VEHICHE
//                    if ($this->Vehicle_model->update_vehicle($save_post)) {
//                        $this->session->set_flashdata('success_msg', 'Vehicle updated successfully.');
//                        redirect('customer/vehicle');
//                    }
//                }
//
//                $this->session->set_flashdata('error_msg', 'Unable to save vehicle, please try again.');
//                redirect('customer/vehicle');
//            }
//        } else {
//            $this->layout->view('customer/vehicle', $this->data);
//        }
//    }

    public function loadClient() {
        $creatorId = $this->session->userdata('logged_in')['user_id'];
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
        $result_page_data = $this->user->getMasterAdminClientList($creatorId);
//        $data = array(
//            'current_page' => $current_page,
//            'record_count' => $record_count,
//            'per_page' => $per_page,
//            'client_result' => $result_page_data
//        );
//        
        //$this->load->view('admin/_load-client-list', $data);/** Render view */
        $data = array(
            'clientResult' => $result_page_data
        );
        $this->load->view('_load-client-list', $data);/** Render view */
    }

    public function check_creadit()
    {
        if($this->session->userdata('logged_in')['role'] == "system-admin")
        {
            echo "true";
        }
        else
        {
    
            if($this->user->check_creadit())
            {
                echo "true";
            }
            else
            {
                echo "false";
            }
        }
        
    }

    public function create() {
        $this->data['testlist']=$this->user->getMasterTestList();
        $post = $this->input->post();
        if ($post) {
            $this->form_validation->set_rules('client_name', 'client name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('full_name', 'full name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'email', 'trim|valid_email|required|xss_clean');
            $this->form_validation->set_rules('phone_no', 'phone number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('account_email', 'account email', 'trim|valid_email|required|xss_clean');
            $this->form_validation->set_rules('vat_tax_no', 'vat/tax number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('company_address', 'company address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('credits', 'credits', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('client-form');
            } else {
                if ($this->user->saveClient($post)) {
                    $this->session->set_flashdata('msg_success', 'Client registered successfully.');
                } else {
                    $this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
                }
                return redirect('client/manageclient');
            }
        } else {
            $this->layout->view('client-form', $this->data);
        }
    }

    public function update() {
        
        if(is_numeric($this->uri->segment(3)))
        {
            $this->someProblem();
        }

        $clientId =  (string)base64_decode($this->uri->segment(3));
        
        if(!is_numeric($clientId))
        {
            $this->someProblem();
        }

        $this->data['clientData'] = $this->user->getUser($clientId);
        
        if(empty($this->data['clientData']))
        {
            $this->someProblem();
        }


        $this->data['testlist']=$this->user->getMasterTestList();
        $post = $this->input->post();
        if ($post) {
            $this->form_validation->set_rules('client_name', 'client name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('full_name', 'full name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone_no', 'phone number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('account_email', 'account email', 'trim|valid_email|required|xss_clean');
            $this->form_validation->set_rules('vat_tax_no', 'vat/tax number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('company_address', 'company address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('credits', 'credits', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('client-form', $this->data);
            } else {
                if ($this->user->updateClient($post)) {
                    $this->session->set_flashdata('msg_success', 'Client updated successfully.');
                } else {
                    $this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
                }
                return redirect('client/manageclient');
            }
        } else {
            $this->layout->view('client-form', $this->data);
        }
    }

    public function changeStatus() {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $post = $this->input->post();
        if (!empty($post)) {
            $clientId = $post['client_id'];
            $status = $post['status'];
            $data = array(
                'status' => $status,
                'last_updated_by' => $loggedinUser,
                'updated_at' => getCurrentDatetime()
            );
            $this->db->where('id', $clientId);
            $this->db->update('user', $data);
            echo $status;
        }
        echo false;
    }

    public function someProblem()
    {
        $this->session->set_flashdata('msg_warning', 'Opps! something went wrong, please try again.');
        return redirect('client/manageclient');
    }

}
