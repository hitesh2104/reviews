<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

    /** Layout used in this controller */
    public $layout_view = 'layouts/main';

    function __construct() {
        parent::__construct();
        $this->load->helper(array('ajaxpagination','utility'));/** load helpers */
        $this->load->library(array('form_validation'));/** Load libraries */
        $this->load->model('Project_model', 'project');/** Load models */
        $this->load->model('JSP_model', 'jsp');/** Load models */		
        $this->load->model('Test_model', 'test');/** Load models */
        $this->load->model('Common_model', 'common');/** Load models */
        if (!isMasterAdmin() && !isClient() && !isStaff()) { /** Redirect to admin login page if not logged in or is not staff */
            return redirect('login', 'refresh');
        }
    }

    public function index() {
        $this->layout->view('project');
    }

    public function manageproject() {
        $this->layout->view('project');
    }

    public function loadProject() {
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
        $result_page_data = $this->project->getProjectList();
//        $data = array(
//            'current_page' => $current_page,
//            'record_count' => $record_count,
//            'per_page' => $per_page,
//            'client_result' => $result_page_data
//        );
//        
        //$this->load->view('admin/_load-client-list', $data);/** Render view */
        $data = array(
            'projectResult' => $result_page_data
        );
        $this->load->view('_load-project-list', $data);/** Render view */
    }

    public function create() {
        $post = $this->input->post();
        
        $this->data['testList'] = $this->test->getMasterTestList();
		$this->data['familyList'] = $this->jsp->getFamilyTitleList();

        if ($post) {

            if($this->session->userdata('logged_in')['role'] != "master-admin")
            {
                if($this->session->userdata('logged_in')['role'] == "staff")
                {
                    $clientId=$this->session->userdata('logged_in')['created_by'];
                }
                else
                {
                    $clientId=$this->session->userdata('logged_in')['user_id'];
                }
                // if(!$this->project->checkClientCredit($clientId,$post))
                // {
                //     $this->session->set_flashdata('msg_error',"You or Your Client Have Not Enough Creadit.");
                //     return redirect('project/manageproject');
                // }
            }

            $this->form_validation->set_rules('project_name', 'project name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('project_description', 'project description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('start_date', 'start date', 'trim|required|xss_clean');
            if(empty($post['open_project']))
            {
               $this->form_validation->set_rules('end_date', 'end date', 'trim|required|xss_clean');
            }
            $this->form_validation->set_rules('test_list[]', 'test to be completed', 'required');
            // $this->form_validation->set_rules('step_1_report_type', 'step 1 report type', 'required');
            // $this->form_validation->set_rules('step_2_report_type', 'step 2 report type', 'required');
            $this->form_validation->set_rules('notification', 'notification', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('project-form', $this->data);
            } else {

                if ($post['btnsubmit'] == 'Create Project') {
                    if ($this->project->createProject($post)) {
                        $this->session->set_flashdata('msg_success', 'Project created successfully.');
                    } else {
                        $this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
                    }
                } elseif ($post['btnsubmit'] == 'Launch Project') {
                    if ($this->project->launchProject($post)) {
                        $this->session->set_flashdata('msg_success', 'Project launched successfully and Emails send to the Participants with instructions to do the tests.');
                    } else {
                        $this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
                    }
                }
                return redirect('project/manageproject');
            }
        } else {
            $this->layout->view('project-form', $this->data);
        }
    }

    public function update() {

        $projectId = $this->uri->segment(3);
        $this->data['projectData'] = $this->project->getProject($projectId);
        $this->data['candidate_count'] = $this->project->getProjectCandidateCount($projectId);
        $this->data['candidates'] = $this->project->getProjectCandidate($projectId);
        $this->data['testList'] = $this->test->getMasterTestList();
		$this->data['familyList'] = $this->jsp->getFamilyTitleList();
        $post = $this->input->post();
        if ($post) {

            $this->form_validation->set_rules('project_name', 'project name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('project_description', 'project description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('start_date', 'start date', 'trim|required|xss_clean');
            if(empty($post['open_project']))
            {
               $this->form_validation->set_rules('end_date', 'end date', 'trim|required|xss_clean');
            }
            if($this->project->getProject($projectId)[0]->status != "active")
            {
                $this->form_validation->set_rules('test_list[]', 'test to be completed', 'required');
            }

            //$this->form_validation->set_rules('step_1_report_type', 'step 1 report type', 'required');
            //$this->form_validation->set_rules('step_2_report_type', 'step 2 report type', 'required');
            $this->form_validation->set_rules('notification', 'notification', 'required');
            if ($this->form_validation->run() == FALSE) {
                var_dump( validation_errors());
            die();
                $this->layout->view('project-form-update', $this->data);
            } else {
                if ($post['btnsubmit'] == 'Launch Project') 
                {
                    if ($this->project->launchProjectUpdate($post)) {
                        $this->session->set_flashdata('msg_success', 'Project launched successfully and Emails send to the Participants with instructions to do the tests.');
                    } else {
                        $this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
                    }
                }

                if ($post['btnsubmit'] == 'Update Project') 
                {
                    if ($this->project->ProjectUpdate($post)) {
                        $this->session->set_flashdata('msg_success', 'Project Updated successfully and Emails send to the Participants with instructions to do the tests.');
                    } else {
                        $this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
                    }
                }

                return redirect('project/manageproject');
            }
        } else {
            $this->layout->view('project-form-update', $this->data);
        }
    }

    public function changeStatus()
    {
        $post=$this->input->post();
        if($this->project->changeStatus($post))
        {
            echo $post['status'];
        }
        else
        {
            echo "false";
        }
    }

    public function getProjectCandidate($id)
    {
        $this->data['id']=$id;
        $this->layout->view('project_candidate',$this->data);
    }

    public function generateLink($id)
    {
        $url = base_url().'login/signup/'.urlencode(base64_encode($id));
        $from = 'noreply@assessmenthouse.com';
        $to = $this->session->userdata('logged_in')['email'];
        $subject = 'Project Link';
        $emaliFilename = $this->config->item('dir_url') . "mailer/project_link.php";
        $data = file_get_contents($emaliFilename);
        $replace = array("[%USERNAME%]", "[%LINK%]");
        $username = empty($this->session->userdata('logged_in')['username']) ? 'User' : $this->session->userdata('logged_in')['username'] ;
        $replace_with = array($username, $url);
        $message = str_replace($replace, $replace_with, $data);
        if ($this->project->sendRegistrationMail($to, $from, $subject, $message)) {
            echo $url;
        }
    }

    public function sendRegistrationMail($to, $from, $subject, $message) {
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        }
        //show_error($this->email->print_debugger());
        return false;
    }

}
