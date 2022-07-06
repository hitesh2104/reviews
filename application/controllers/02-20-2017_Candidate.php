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
        $this->load->model('JSP_model', 'jsp');/** Load models */		
        $this->load->model('Project_model', 'project');/** Load models */
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

    public function candidate_details($id)
    {
        $this->data['general_details'] = $this->candidate->getCandidateInfo($id);
		$this->data['projectData'] = $this->project->getProject($this->data['general_details'][0]->fk_project_id);
        $this->data['test_details']=$this->test->getCandidateTestList($id);
        $this->layout->view('candidate_open',$this->data);
    }

    public function update_test($id)
    {
        $this->candidate->update_test($id);
        return redirect(base_url()."candidate/candidate_details/$id");
    }

    public function exe_summary(){
        ob_start();
        $this->data['post'] = $_POST;
		$creaditTestIdList = "";

        if(!empty($this->data['post']['content'])){
            $this->candidate->update_summary($this->data['post']['content'],$this->data['post']['user_id']);
			
        }else{
            $this->data['post']['content'] = $this->candidate->select_summary($this->data['post']['user_id']);
        }

		$this->data['projectData'] = $this->project->getProject($_POST['project_id']);
		if(!empty($this->data['projectData'][0]->job_success_profile)){
			$familyRol = $this->data['projectData'][0]->job_success_profile;
			if(explode(" (", $familyRol)){
				$cmpList = explode(" (", $familyRol);
				$family = $cmpList[0];
				$role = str_replace(')', '', isset($cmpList[1])?$cmpList[1]:'');
			}
			$this->data['jspData'] = $this->jsp->getJSPDataByFamilyRoleName($family, $role);
		}
	
		
		$this->data['test_details']=$this->test->getCandidateTestList($this->data['post']['user_id']);
		$this->data['miraRules']=$this->test->getMiraTestResultRules($this->data['post']['user_id']);
		
		if(!empty($this->data['test_details'])){
            foreach($this->data['test_details'] as $test){ 
				if($test->status=="completed"){
					
					// creadit section
					if($this->candidate->checkTest($test->fk_test_id, $_POST['user_id'])){
						//it's okey
					}else {
						$creaditTestIdList .= $test->fk_test_id.",";
					}
					
					if ($test->test_short_name == 'BECi') {
						$this->data['test_code'] = $this->test->getTestCode();
						$this->data['test_ans'] = $this->test->getAnsData($_POST['user_id']);
						
					}elseif ($test->test_short_name == 'MIRa') {
						$this->data['score2']  = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);
						
					}elseif ($test->test_short_name == 'LAP') {
                    	$this->data['Secscore3'] = $this->getResult3($_POST['user_id']);
                    	$this->data['score3']  = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);
						
                	}elseif ($test->test_short_name == 'DIP') {
						
                	}elseif ($test->test_short_name == 'IPT') {
						
	                }elseif ($test->test_short_name == 'OPT') {
						
	                }elseif ($test->test_short_name == 'VST') {
                   		$this->data['score7']  = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);
	                    if($this->data['score7']==0 || $this->data['score7']== ""){
    		                $this->data['score7']=1;   
            	        }
	                    if($this->data['score7'] > 10){
		                     $this->data['score7']==10;
        	            }
						
            	    }elseif ($test->test_short_name == 'NST') {
	                    $this->data['score8']  = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);  
						if($this->data['score8']==0 || $this->data['score8']== ""){
							$this->data['score8'] = 1;   
						}
						if($this->data['score8'] > 10){
							$this->data['score8'] = 10;
						} 
						
					}elseif ($test->test_short_name == 'DST') {
                    	$this->data['Secscore9'] = $this->getResult9($_POST['user_id']);
	                    $this->data['score9']  = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);  
    	                if($this->data['score9']==0 || $this->data['score9']== ""){
	    		            $this->data['score9']=1;   
    	                }
                	    if($this->data['score9'] > 10) {
	                        $this->data['score9']==10;
    	                }    
						
                	}elseif ($test->test_short_name == 'AST') {
                    	$this->data['score10']  = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);
	                    if($this->data['score10']==0 || $this->data['score10']== "") {
    		                $this->data['score10']=1;   
            	        }
	                    if($this->data['score10'] > 10) {
    	                    $this->data['score10']==10;
        	            }
						
            	    }elseif ($test->test_short_name == 'MST') {
    	                $this->data['score11']  = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);
						
					}elseif ($test->test_short_name == 'EST') {
	                    $this->data['Secscore12'] = $this->getResult12($_POST['user_id']);
    	                $this->data['score12'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);
                    	if($this->data['score12']==0 || $this->data['score12']== ""){
                    		$this->data['score12']=1;   
	                    }
    	                if($this->data['score12'] > 10){
	                        $this->data['score12']==10;
    	                }
        	        }
            	}
			}
        }
		
		$creaditTestIdList = rtrim($creaditTestIdList,",");
	 
		if($this->test->creadit_combine_varification($creaditTestIdList)) {
			$message = "You have not enough credit to download report. Please Contact Your Administrator";
			echo "<script>alert('$message');</script>";
			echo "<script>window.close();</script>";
			return false;
			/* echo "window.location.href =  . base_url(candidate/candidate_details/$this->data['uid']); </script>";*/
		} else {
			if($this->test->updateCombineCreadit($creaditTestIdList)){
				if($this->candidate->updateTestList($creaditTestIdList, $_POST['user_id'])){
					// its ok
				}
			}else {
				$message = "Problem In credit updation";
				echo "<script>alert('$message');";
				echo "window.location.href = '" . base_url() . "candidate/candidate_details'; </script>";
			}
		}
		
		
        $this->load->view('pdf/exc_summary',$this->data);
    }

    public function combine_report()
    {
        ob_start();
        $this->data['post'] = $_POST;
        $this->data['du_name'] = $this->candidate->getCandidateInfo($_POST['user_id']);
        $this->data['post']['content'] = $this->candidate->select_summary($this->data['post']['user_id']);
        $combine_test_list = "";
        if(isset($_POST['test_list']) && count($_POST['test_list']) > 0)
        {
            foreach ($_POST['test_list'] as  $value)
            {
                if($this->candidate->checkTest($value,$_POST['user_id']))
                {
                    //it's okey
                }
                else
                {
                    $combine_test_list .= $value.",";
                }
            }

            $combine_test_list = rtrim($combine_test_list,",");

            if($this->test->creadit_combine_varification($combine_test_list))
                {
                    $message = "You have not enough credit to download report. Please Contact Your Administrator";
                    echo "<script>alert('$message');</script>";
                    echo "<script>window.close();</script>";
                    return false;
                    /* echo "window.location.href =  . base_url(candidate/candidate_details/$this->data['uid']); </script>";*/
                }
                else
                {
                    if($this->test->updateCombineCreadit($combine_test_list))
                    {
                        if($this->candidate->updateTestList($combine_test_list,$_POST['user_id']))
                        {

                        }
                    }
                    else
                    {
                        $message = "Problem In credit updation";
                        echo "<script>alert('$message');";
                        echo "window.location.href = '" . base_url() . "candidate/candidate_details'; </script>";
                    }
                }
            }



        if(isset($_POST['test_list']) && count($_POST['test_list']) > 0)
        {
            foreach ($_POST['test_list'] as  $value) {
                if($value==1)
                {
                    $this->data['test_code'] = $this->test->getTestCode();
                    $this->data['test_ans'] = $this->test->getAnsData($_POST['user_id']);
                }
                elseif ($value==2) {
                    $this->data['score2']  = $this->test->getTestResult(1, $_POST['user_id']);
                }
                elseif ($value==3) {
                    $this->data['Secscore3'] = $this->getResult3($_POST['user_id']);
                    $this->data['score3']  = $this->test->getTestResult(3, $_POST['user_id']);
                }
                elseif ($value==4) {
                }
                elseif ($value==5) {
                }
                elseif ($value==6) {
                }
                elseif ($value==7) {
                    $this->data['score7']  = $this->test->getTestResult(7, $_POST['user_id']);
                    if($this->data['score7']==0 || $this->data['score7']== "")
                    {
                     $this->data['score7']=1;   
                    }
                    if($this->data['score7'] > 10)
                    {
                        $this->data['score7']==10;
                    }
                }
                elseif ($value==8) {
                    $this->data['score8']  = $this->test->getTestResult(8, $_POST['user_id']);  
                    if($this->data['score8']==0 || $this->data['score8']== "")
                    {
                     $this->data['score8']=1;   
                    }
                    if($this->data['score8'] > 10)
                    {
                        $this->data['score8']==10;
                    } 
                }
                elseif ($value==9) {
                    $this->data['Secscore9'] = $this->getResult9($_POST['user_id']);
                    $this->data['score9']  = $this->test->getTestResult(8, $_POST['user_id']);  
                    if($this->data['score9']==0 || $this->data['score9']== "")
                    {
                     $this->data['score9']=1;   
                    }
                    if($this->data['score9'] > 10)
                    {
                        $this->data['score9']==10;
                    }    
                }
                elseif ($value==10) {
                    $this->data['score10']  = $this->test->getTestResult(10, $_POST['user_id']);
                    if($this->data['score10']==0 || $this->data['score10']== "")
                    {
                     $this->data['score10']=1;   
                    }
                    if($this->data['score10'] > 10)
                    {
                        $this->data['score10']==10;
                    }
                }
                elseif ($value==11) {
                    $this->data['score11']  = $this->test->getTestResult(11, $_POST['user_id']);
                }
                elseif ($value==12) {
                    $this->data['Secscore12'] = $this->getResult12($_POST['user_id']);
                    $this->data['score12']  = $this->test->getTestResult(10, $_POST['user_id']);
                    if($this->data['score12']==0 || $this->data['score12']== "")
                    {
                     $this->data['score12']=1;   
                    }
                    if($this->data['score12'] > 10)
                    {
                        $this->data['score12']==10;
                    }
                }
            }
        }
        
        $this->load->view('pdf/combine_report',$this->data);

    }



    public function download_report()
    {
        $this->data['uName']  = isset($_GET["u_name"]) ? isset($_GET["u_name"]) : "";
        $this->data['rTitle'] = isset($_GET["title"]) ?  isset($_GET["title"]) : "";
        $this->data['score']  = isset($_GET["score"]) ?  isset($_GET["score"]) : "";
        $this->data['uid']    = $_GET['user_id'];
        $this->data['test_id'] = $_GET['test_id'];  
        $this->data['created_date'] = $_GET['created_date'];         

        if($this->data['test_id'] != "" || $this->data['uid'] != "")
        {
            $userId = $this->session->userdata('logged_in')['user_id'];

            if($this->candidate->checkTest($this->data['test_id'],$this->data['uid']))
            {
                // it's okey !
            }
            else
            {
                if($this->test->creadit_varification($this->data['test_id']))
                {
                    $message = "You have not enough credit to download report. Please Contact Your Administrator";
                    echo "<script>alert('$message');</script>";
                    echo "<script>window.close();</script>";
                    return false;
                    // echo "window.location.href =  . base_url(candidate/candidate_details/$this->data['uid']); </script>";
                }
                else
                {
                    if($this->test->updateCreadit($this->data['test_id']))
                    {
                        if($this->candidate->updateTestList($this->data['test_id'],$this->data['uid']))
                        {

                        }
                    }
                    else
                    {
                        $message = "Problem In credit updation";
                        echo "<script>alert('$message');";
                        echo "window.location.href = '" . base_url() . "candidate/candidate_details'; </script>";
                    }
                }
            }
        }
        else
        {
            return redirect("candidate/candidate_details/$this->data['uid']");
        }

        if($this->data['test_id'] == 1)
        {
            ob_start();
            $this->data['test_code'] = $this->test->getTestCode();
            $this->data['test_ans'] = $this->test->getAnsData($this->data['uid']);
            $this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
            
            $this->load->view('pdf/pdf_content_1',$this->data);
        }
        elseif ($this->data['test_id'] == 2) {

            ob_start();
            $this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
            $this->data['score']  = isset($_GET["score"]) ?  isset($_GET["score"]) : "";
            $this->load->view('pdf/MIRA_1',$this->data);

        }
        elseif ($this->data['test_id'] == 3) {
            ob_start();
            $this->data['Secscore'] = $this->getResult3($this->data['uid']);
            $this->data['test_code'] = $this->test->getTestCode();
            $this->data['test_ans'] = $this->test->getAnsData($this->data['uid']);
            $this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
            $this->data['score']  = isset($_GET["score"]) ?  isset($_GET["score"]) : "";
            $this->load->view('pdf/lap',$this->data);
        }
        elseif ($this->data['test_id'] == 4) {
            $this->data['score'] = $this->getResult4($this->data['uid']);
            $this->data['score'] = 3;
            $this->load->view('pdf/dipdemo',$this->data);

        }
        elseif ($this->data['test_id'] == 5) {
            $this->data['score'] = $this->getResult5($this->data['uid']);
            echo $this->data['score'];
        }
        elseif ($this->data['test_id'] == 6) {
            ob_start();
            $this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
            $this->data['score']  = $this->getResult6($this->data['uid']);
            $this->load->view('pdf/opt',$this->data);
        }
        elseif ($this->data['test_id'] == 7) {

            ob_start();
            $this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
            $this->data['score']  = isset($_GET["score"]) ?  isset($_GET["score"]) : "";
            $this->load->view('pdf/vst',$this->data);

        }
        elseif ($this->data['test_id'] == 8) {

            ob_start();
            $this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
            $this->data['score']  = isset($_GET["score"]) ?  isset($_GET["score"]) : "";
            $this->load->view('pdf/nst',$this->data);

        }
        elseif ($this->data['test_id'] == 9) {
            ob_start();
            $this->data['Secscore'] = $this->getResult9($this->data['uid']);
            
            $this->data['test_code'] = $this->test->getTestCode();
            $this->data['test_ans'] = $this->test->getAnsData($this->data['uid']);
            $this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
            $this->data['score']  = isset($_GET["score"]) ?  isset($_GET["score"]) : "";
            $this->load->view('pdf/dst',$this->data);
        }
        elseif ($this->data['test_id'] == 10) {

            ob_start();
            $this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
            $this->data['score']  = isset($_GET["score"]) ?  isset($_GET["score"]) : "";
            $this->load->view('pdf/ast',$this->data);

        }
        elseif ($this->data['test_id'] == 11) {

            ob_start();
            $this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
            $this->data['score']  = isset($_GET["score"]) ?  isset($_GET["score"]) : "";
            $this->load->view('pdf/mst',$this->data);

        }
        elseif ($this->data['test_id'] == 12) {
            ob_start();
            $this->data['Secscore'] = $this->getResult12($this->data['uid']);
            
            $this->data['test_code'] = $this->test->getTestCode();
            $this->data['test_ans'] = $this->test->getAnsData($this->data['uid']);
            $this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
            $this->data['score']  = isset($_GET["score"]) ?  isset($_GET["score"]) : "";
            $this->load->view('pdf/est',$this->data);
        }
        else
        {
            $this->load->library('PDF');
            // $this->data['uName'] = "Mitul";
            // $this->data['rTitle'] = "Verbal Skills Test (VST)";
            // $this->data['score'] = 4;


            /** get the HTML */
            ob_start();
            // include(dirname(__FILE__) . '/vst_content.php');
            $this->load->view('pdf/pdf_content',$this->data);
            $content = ob_get_clean();

            /** convert in PDF */
            try {
                $uName =$this->data['uName'];
                $rTitle =$this->data['rTitle'];
                $score =$this->data['score'];
                $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 0);
                $html2pdf->writeHTML($content, isset($_GET['vuehtml']));/** isset($_GET['vuehtml']) is not mandatory, it allow to display the result in the HTML format */
                $html2pdf->Output("$uName-$rTitle.pdf", "D");
            } catch (HTML2PDF_exception $e) {
                echo $e;
                exit;
            }
        }
    }

    public function getResult3($uid)
    {
        $ans=$this->candidate->getCorrResult3($uid);
       // var_dump($ans);die;
        $corr_Ans = $ans['corr'][0]; 
        $give_Ans = $ans['give'][0];

        $CA = explode(",", $corr_Ans['LAP_A']);
        $GA = explode(",", $give_Ans['LAP_A']);

        $CB = explode(",", $corr_Ans['LAP_B']);
        $GB = explode(",", $give_Ans['LAP_B']);

        $CC = explode(",", $corr_Ans['LAP_C']);
        $GC = explode(",", $give_Ans['LAP_C']);

        $CD = explode(",", $corr_Ans['LAP_D']);
        $GD = explode(",", $give_Ans['LAP_D']);

        $data=array();

        $correct = 0;
        for ($i=0; $i < count($CA); $i++) 
        { 
            if ($GA[$i] === @$CA[$i]) 
            {
                $correct += 1;
            }
        }

        $data['corr_A'] = number_format((($correct / 79) * 10), 0);

        $data['corr_A'] = $data['corr_A']== 0 ? 1 : $data['corr_A'];
        $data['corr_A'] = $data['corr_A'] > 9 ? 9 : $data['corr_A'];
 
        $correct = 0;
        for ($i=0; $i < count($CB); $i++) 
        { 
            if ($GB[$i] === @$CB[$i]) 
            {
                $correct += 1;
            }
        }

        $data['corr_B'] = number_format((($correct / 79) * 10), 0);
        $data['corr_B'] = $data['corr_B']== 0 ? 1 : $data['corr_B'];
        $data['corr_B'] = $data['corr_B'] > 9 ? 9 : $data['corr_B'];

        $correct = 0;
        for ($i=0; $i < count($CC); $i++) 
        { 
            if ($GC[$i] === @$CC[$i]) 
            {
                $correct += 1;
            }
        }

        $data['corr_C'] = number_format((($correct / 79) * 10), 0);
        $data['corr_C'] = $data['corr_C']== 0 ? 1 : $data['corr_C'];
        $data['corr_C'] = $data['corr_C'] > 9 ? 9 : $data['corr_C'];

        $correct = 0;
        for ($i=0; $i < count($CD); $i++) 
        { 
            if ($GD[$i] === @$CD[$i]) 
            {
                $correct += 1;
            }
        }

        $data['corr_D'] = number_format((($correct / 79) * 10), 0);
        $data['corr_D'] = $data['corr_D']== 0 ? 1 : $data['corr_D'];
        $data['corr_D'] = $data['corr_D'] > 9 ? 9 : $data['corr_D'];


        return $data;

    }

    public function getResult4($uid)
    {
        $code_str = "D,I,S,C,D,C,I,C,D,D,I,S,I,S,C,D,I,C,C,S,I,D,C,I,S,C,D,I,S,C,I,D,C,S,C,D,S,I,D,S,I,S,S,D,S,I,C,C,S,D,C,I,D,I,S,D,S,I,C,C,D,C,I,D,S,S,I,D,C,S,D,I,S,C,I,D,C,D,S,I,C-,C-,S-,I-,S-,I-,D-,I-,S-,D-,I-,D-,C-,S-,C-,D-,C-,I-,D-,S-,S-,I-,D-,I-,D-,C-,S-,C-,I-,C-,C-,S-,I-,D-,S-,I-,D-,S-,C-,D-";

        $cod = explode(",", $code_str);

        $ans_str=$this->candidate->getCorrResult4($uid);
        $ans = explode(",", $ans_str[0]['test4_answer']);
        $D = "";   $I = ""; $S = ""; $C = ""; $Dm = ""; $Im = ""; $Sm = ""; $Cm = "";

        for ($i=0; $i <120 ; $i++) 
        { 
          if($cod[$i]=="D"){ $D+=$ans["$i"]; }
          if($cod[$i]=="I"){ $I+=$ans["$i"]; }
          if($cod[$i]=="S"){ $S+=$ans["$i"]; }
          if($cod[$i]=="C"){ $C+=$ans["$i"]; }
          if($cod[$i]=="D-"){ $Dm+=$ans["$i"]; }
          if($cod[$i]=="I-"){ $Im+=$ans["$i"]; }
          if($cod[$i]=="S-"){ $Sm+=$ans["$i"]; }
          if($cod[$i]=="C-"){ $Cm+=$ans["$i"]; }
        }

        $D1 = ($D/60) * 10;
        $D2 = ($Dm/60) * 10;
        $RD = $D1 - $D2;

        if($D1==$D2) 
        {
            $RD = 1;
        }

        $I1 = ($I/60) * 10;
        $I2 = ($Im/60) * 10;
        $RI = $I1 - $I2;

        if($I1==$I2) 
        {
            $RI = 1;
        }

        $S1 = ($S/60) * 10;
        $S2 = ($Sm/60) * 10;
        $RS = $S1 - $S2;

        if($S1==$S2) 
        {
            $RS = 1;
        }

        $C1 = ($C/60) * 10;
        $C2 = ($Cm/60) * 10;
        $RC = $C1 - $C2;

        if($C1==$C2) 
        {
            $RC = 1;
        }

        $total_result = "";

        if($RD>25){ $total_result.= "D"; }
        if($RI>25){ $total_result.= "I"; }
        if($RS>25){ $total_result.= "S"; }
        if($RC>25){ $total_result.= "C"; }
        
        return $total_result;
    }

    public function getResult5($uid)
    {
        $code_str = "J,J,J,S,E,T,E,T,E,S,E,S,S,E,S,T,J,S,E,J,S,T,J,E,S,S,T,S,J,S,S,J,T,T,T,T,T,J,S,E,T,E,E,E,E,T,E,E,E,J,E,J,E,J,S,T,J,T,S,J,S,E,T,S,J,S,J,J,J,J,T,T,T,J,E,E,S,T,S,T";

        $cod = explode(",", $code_str);

        $ans_str=$this->candidate->getCorrResult5($uid);
        $ans = explode(",", $ans_str[0]['IPT']);
        $E=$S=$T=$J="";
        for ($i=0; $i < 80; $i++)
        {
    
          if($cod[$i]=="E"){ $E+=$ans["$i"]; }
          if($cod[$i]=="S"){ $S+=$ans["$i"]; }
          if($cod[$i]=="T"){ $T+=$ans["$i"]; }
          if($cod[$i]=="J"){ $J+=$ans["$i"]; }
        }
    
         $totalE = $E;
         $totalS = $S;
         $totalT = $T;
         $totalJ = $J;
      
      if($E>10){ $El = "E"; }
      if($E<10){ $El = "I"; }
      if($E==10){ $El = "E"; }
      if($S>10){ $Sl = "S"; }
      if($S<10){ $Sl = "N"; }
      if($S==10){ $Sl = "S"; }
      if($T>10){ $Tl = "T"; }
      if($T<10){ $Tl = "F"; }
      if($T==10){ $Tl = "T"; }
      if($J>10){ $Jl = "J"; }
      if($J<10){ $Jl = "P"; }
          if($J==10){ $Jl = "J"; }
      
      $test_result = $El.$Sl.$Tl.$Jl;

      return $test_result;
    }

    public function getResult6($uid)
    {
        $ans_str=$this->candidate->getCorrResult6($uid);
        $ans = explode(",", $ans_str[0]['test_6answer']);

        $i = 0;
            $correct = 0;
            $e_count = 0;
            $i_count = 0;
            $s_count = 0;
            $n_count = 0;
            $t_count = 0;
            $f_count = 0;
            $j_count = 0;
            $p_count = 0;

            while ($i <= 27) {
                if ($ans[$i] == 'E') {
                    $e_count += 1;
                } elseif ($ans[$i] == 'I') {
                    $i_count += 1;
                } elseif ($ans[$i] == 'S') {
                    $s_count += 1;
                } elseif ($ans[$i] == 'N') {
                    $n_count += 1;
                } elseif ($ans[$i] == 'T') {
                    $t_count += 1;
                } elseif ($ans[$i] == 'F') {
                    $f_count += 1;
                } elseif ($ans[$i] == 'J') {
                    $j_count += 1;
                } elseif ($ans[$i] == 'P') {
                    $p_count += 1;
                }
                $correct += 1;
                $i++;
            }

            $reportName = '';
            if ($e_count > $i_count) {
                $reportName .='E';
            } elseif ($i_count > $e_count) {
                $reportName .='I';
            }

            if ($s_count > $n_count) {
                $reportName .='S';
            } elseif ($n_count > $s_count) {
                $reportName .='N';
            }

            if ($t_count > $f_count) {
                $reportName .='T';
            } elseif ($f_count > $t_count) {
                $reportName .='F';
            }

            if ($j_count > $p_count) {
                $reportName .='J';
            } elseif ($p_count > $j_count) {
                $reportName .='P';
            }
            return $reportName;
    }

    public function getResult9($uid)
    {
        $ans=$this->candidate->getCorrResult9($uid);
       // var_dump($ans);die;
        $corr_Ans = $ans['corr'][0]; 
        $give_Ans = $ans['give'][0];

        $CA = explode(",", $corr_Ans['DST_secA']);
        $GA = explode(",", $give_Ans['DST_secA']);

        $CB = explode(",", $corr_Ans['DST_secB']);
        $GB = explode(",", $give_Ans['DST_secB']);

        $CC = explode(",", $corr_Ans['DST_secC']);
        $GC = explode(",", $give_Ans['DST_secC']);

        $data=array();

        $correct = 0;
        for ($i=0; $i < count($CA); $i++) 
        { 
            if (@$GA[$i] === @$CA[$i]) 
            {
                $correct += 1;
            }
        }

        $data['corr_A'] = number_format((($correct / 75) * 10), 0);

        $data['corr_A'] = $data['corr_A']== 0 ? 1 : $data['corr_A'];
        $data['corr_A'] = $data['corr_A'] > 9 ? 9 : $data['corr_A'];
 
        $correct = 0;
        for ($i=0; $i < count($CB); $i++) 
        { 
            if (@$GB[$i] === @$CB[$i]) 
            {
                $correct += 1;
            }
        }

        $data['corr_B'] = number_format((($correct / 75) * 10), 0);
        $data['corr_B'] = $data['corr_B']== 0 ? 1 : $data['corr_B'];
        $data['corr_B'] = $data['corr_B'] > 9 ? 9 : $data['corr_B'];

        $correct = 0;
        for ($i=0; $i < count($CC); $i++) 
        { 
            if (@$GC[$i] === @$CC[$i]) 
            {
                $correct += 1;
            }
        }

        $data['corr_C'] = number_format((($correct / 75) * 10), 0);
        $data['corr_C'] = $data['corr_C']== 0 ? 1 : $data['corr_C'];
        $data['corr_C'] = $data['corr_C'] > 9 ? 9 : $data['corr_C'];

        return $data;

    }

    public function getResult12($uid)
    {
        $ans=$this->candidate->getCorrResult12($uid);
       // var_dump($ans);die;
        $corr_Ans = $ans['corr'][0]; 
        $give_Ans = $ans['give'][0];

        $CA = explode(",", $corr_Ans['test12_answer']);
        $GA = explode(",", $give_Ans['test12_answer']);

        $data=array();
        $correct = 0;
        for ($i=0; $i < count($CA); $i++) 
        { 
            if (@$GA[$i] === @$CA[$i]) 
            {
                $correct += 1;
            }
        }

        $data['corr_A'] = $correct;
 
        
        $data['corr_B'] = (55 - $correct);

        $data['corr_C'] = ($correct*100)/55;

        return $data;

    }

    public function loadCandidate() {
        /** get loggedin user is from session */
        $userId = $this->session->userdata('logged_in')['user_id'];
        $test_id = $this->input->post('testId');
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
        $result_page_data = $this->candidate->getCandidateList($userId,$test_id);
        
        $i=0;
        foreach($result_page_data as $value)
       {
            $result_page_data[$i]->test_list = $this->candidate->getCandidateTestList($value->candidate_id)[0]->test_list;
            $i++;
       }
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

        if($this->test->getFirsttime())
        {
            $this->session->set_flashdata('msg_error','Please Fill Your All Details Before Submit Test');
            return redirect('candidate/details');
        }

        if(!$this->candidate->check_terms())
        {
            $this->session->set_flashdata('msg_error','You must agree with terms and condition to give test.');
            return redirect('test/Agree');
        }
        $candidateId = $this->session->userdata('logged_in')['user_id'];
        
        $this->data['testDetail'] = $this->test->getCandidateTestInfo($candidateId);
        $this->layout->view('test', $this->data);
    }
    
    public function details() {
        $candidateId = $this->session->userdata('logged_in')['user_id'];
        $this->data['candidateData'] = $this->candidate->getCandidateInfo($candidateId);
        $post = $this->input->post();
        if ($post) {
            //$this->form_validation->set_rules('full_name', 'full name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('marital_status', 'marital status', 'trim|required|xss_clean');
            $this->form_validation->set_rules('gender', 'gender', 'trim|required|xss_clean');
            $this->form_validation->set_rules('age', 'age', 'trim|required|xss_clean');
            $this->form_validation->set_rules('nationality', 'nationality', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('id_passport_no', 'ID/Passport Number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone_no', 'phone number', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('home_language', 'home language', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('current_job_title', 'current job title', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('working_experience', 'working experience', 'trim|required|xss_clean');
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
            //$this->form_validation->set_rules('full_name', 'full name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('marital_status', 'marital status', 'trim|required|xss_clean');
            $this->form_validation->set_rules('gender', 'gender', 'trim|required|xss_clean');
            $this->form_validation->set_rules('age', 'age', 'trim|required|xss_clean');
            $this->form_validation->set_rules('nationality', 'nationality', 'trim|required|xss_clean');
            $this->form_validation->set_rules('id_passport_no', 'ID/Passport Number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone_no', 'phone number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('home_language', 'home language', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('current_job_title', 'current job title', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('working_experience', 'working experience', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->layout->view('candidate-detail-form', $this->data);
            } else {
                if ($this->candidate->registerDetail($post)) {
                    return redirect('candidate/test');
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

    public function loadProjectCandidate($id) {

        $result_page_data = $this->project->getProjectCandidate($id);
        $i=0;
        foreach ($result_page_data as $value) {
            $data=array();
            $data['candidate_id'] = $value->id;
            $data['candidate_name'] = $value->full_name;
            $data['candidate_status'] = $value->status;
            $data['tc'] = $this->project->testCompleted($value->id);
            $this->data[$i]=$data;
            $i++;
        }
        
        $datas = array(
            'candidateResult' => @$this->data,
            'project_id' => $id

        );
        $this->load->view('_load-project-candidate-list', $datas);/** Render view */
    }
    
}
