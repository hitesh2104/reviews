<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Jsp extends CI_Controller {

    /** Layout used in this controller */
    public $layout_view = 'layouts/main';

    function __construct() {
        parent::__construct();
        $this->load->helper(array('ajaxpagination', 'utility'));/** load helpers */
        $this->load->library(array('form_validation'));/** Load libraries */
		$this->load->library(array('Commanfunction'));/** Load libraries */
        $this->load->model('JSP_model', 'jsp');/** Load models */
        $this->load->model('Test_model', 'test');/** Load models */
        $this->load->model('Common_model', 'common');/** Load models */
        if (!isMasterAdmin() && !isClient() && !isStaff()) { /** Redirect to admin login page if not logged in or is not staff */
            return redirect('login', 'refresh');
        }
    }

    public function index() {
        $this->layout->view('jobSuccessProfile');
    }

    public function loadJSP() {
        $result_page_data = $this->jsp->getJspList();
        $data = array(
            'jspResult' => $result_page_data
        );
        $this->load->view('_load-jsp-list', $data);/** Render view */
    }

	public function jspSection($jspId = 0, $isClone = 0){
		$data['jspId'] = $jspId;
		$data['isClone'] = $isClone;

		// Set Validation Rules
		$rules = array();
		$rules[] = array("field"=>"job_family", "label"=>"Job family", "rules"=>"required" );			
		$rules[] = array("field"=>"job_title", "label"=>"Role Title", "rules"=>"required" );
					
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters("","<br>");
		//check validation
		if($this->form_validation->run() == true){
			$post = $this->input->post();
			
			$result = $this->jsp->checkJobTitle($post, $isClone);
			if($result != false){
				echo 1; die;
			}
			
			$this->jsp->addEditJSP($post);
			echo "jsp/";
			redirect("jsp/",'refresh');
	  	} 
		
		if($jspId > 0){
			$data['jspData'] = $this->jsp->getJSPData($jspId);
			$data['roleList'] = $this->jsp->getRoleListByFamily($data['jspData']);
		}
		
		$data['familyList'] = array();
		$familyList = $this->jsp->getFamilyList();
		if($familyList != false){ 
			foreach($familyList as $ddData){
				$data['familyList'][] = $ddData['job_family'];
			}
		}
		$data['competencyArr'] = $this->jsp->getCompetencyList();		
		$this->layout->view('jobSuccessProfile-form', $data);
	}		

	public function deleteJspRecord(){
		echo $this->jsp->deleteJSP($_POST['jspId']);
	}	
	
	public function createClone(){
		$cloneId = $this->input->post('cloneId');
		if($cloneId > 0){
			echo $this->jsp->createClone($cloneId);
		}else{
			echo 0;
		}
	}	

// Add new record for JSP dropdown
	public function addNewData(){
		$post = $this->input->post();
		if(!empty($post)){
			$post['jspId'] = 0;
			$result = $this->jsp->checkJobTitle($post, 0, 'jsp_family_data');
			if($result != false){
				echo 2; die;
			}else{
				echo $this->jsp->addNewData($post);
			}
		}else{
			echo 0;
		}
	}		
	
// Get role list by family
	public function getRoleListByFamily(){
		$post = $this->input->post();
		if(!empty($post)){
			$roleList = $this->jsp->getRoleListByFamily($post);
			$roleTitle = '<option value="">Please Select</option>';
			$roleTitle .= '<option value="0">Create New</option>';							
			/*if($roleList != false){
				foreach($roleList as $role){
					$roleTitle .= '<option value="'.$role['job_title'].'">'.$role['job_title'].'</option>';
				}
			}*/
			echo $roleTitle; 
		}else{
			echo 0;
		}
	}	
	
// Check job title in jsp table
	public function old_checkJobTitle(){
		$post = $this->input->post();
		if(!empty($post)){
			$result = $this->jsp->checkJobTitle($post);
			if($result != false){
				echo 1; die;
			}
		}
		echo 0;
	}			

}
