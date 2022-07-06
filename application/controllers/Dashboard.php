<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    //Layout used in this controller
    public $layout_view = 'layouts/main';

    function __construct() {
        parent::__construct();
        $this->load->helper(array('ajaxpagination', 'utility'));/** load helpers */
        $this->load->model('Common_model', 'common');/** Load models */
        if (!isSystemAdmin() && !isMasterAdmin() && !isClient() && !isStaff() && !isCandidate()) {
            return redirect('login', 'refresh');
        }
        // var_dump($_SESSION);        
    }

    public function index() {

        $userId = $this->session->userdata('logged_in')['user_id'];
        $this->data['masterAdminCount'] = $this->common->getMasterAdminCount();
        $this->data['incommingCreditRequest'] = $this->common->getIncommingCreditRequestCount($userId);
        $this->data['clientCount'] = $this->common->getClientCountByMasterAdmin($userId);
        $this->data['registerCandidateCount'] = $this->common->getRegisteredCandidateCount();
        $this->data['projectCount'] = $this->common->getTotalProjectCreated();
        $this->data['userCredit'] = $this->common->getUserAvailableCredit($userId);
        $this->data['staffCount'] = $this->common->getTotalStaffByClient($userId);
        $this->data['projectCount'] = $this->common->getProjectCountByCreator($userId);
        $this->data['candidateCount'] = $this->common->getTotalCandidateRegisteredByCreator($userId);
		$this->data['jspCount'] = $this->common->getJSPCountByCreator($userId);
        $this->layout->view('dashboard', $this->data);
    }

    public function change_password()
    {
        $userId = $this->session->userdata('logged_in')['user_id'];
        $oldpassword=md5($this->input->post("oldpass"));
        $newpassword=md5($this->input->post("newpass"));
        $this->data['message']='';
        if($this->input->post("oldpass")!="" && $this->input->post("newpass") != "")
        {
            $result=$this->common->check_password($userId,$oldpassword);
            if($result == 1)
            {
                $data=array('password' => $newpassword);
                $this->common->changePassword($userId,$data);
                $this->data['message']='<div class="alert alert-success alert-dismissable">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <strong>Success!</strong> Password Change Successfully.
                                        </div>';
            }
            if($result == 0)
            {
                $this->data['message']='<div class="alert alert-danger alert-dismissable">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <strong>Error!</strong> Old Password Not Match.
                                        </div>';
            }
        }

        $this->layout->view('change_password',$this->data);
    }

    public function my_account()
    {
        $userId = $this->session->userdata('logged_in')['user_id'];
        $this->data['user_details']=$this->common->getMyAccount($userId);
        $this->layout->view('my_account',$this->data);
    }

    public function logout() {
        $this->load->model('Authentication_model', 'auth');
        if ($this->auth->logout()) {
            return redirect('login');
        }
    }

}
