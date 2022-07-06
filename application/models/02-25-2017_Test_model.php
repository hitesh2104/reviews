<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test_model extends CI_Model {

    /** constructor */
    function __construct() {
        parent::__construct();
    }

    public function getCandidateTestInfo($candidateId) {
        $condition = " cat.status != 'deleted' AND p.status != 'deleted' AND p.is_launched = 1";
        $condition .= " AND cat.fk_candidate_id = " . $candidateId;
        $query = $this->db->query("
            SELECT 
            cat.id, cat.fk_test_id, cat.completed_date, cat.status AS test_status,
            p.project_name, p.status AS project_status,
            t.test_name
            FROM candidate_associated_test AS cat
            INNER JOIN test AS t ON t.id = cat.fk_test_id
            INNER JOIN project AS p ON p.id = cat.fk_project_id 
            WHERE $condition
            ");
        return $query->result();
    }
    
    public function getAllTestList() {
        $condition = " status = 'active'";
        $query = $this->db->query("
            SELECT 
            id, test_name
            FROM test
            WHERE $condition
            ORDER BY test_name ASC
            ");
        return $query->result();
    }

    public function getFirsttime()
    {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        
        $query=$this->db->query("SELECT id FROM user WHERE is_update_profile=0 AND id=$loggedinUser");
          
        $query_result=$query->result();
        
        if(@$query_result[0]->id=="")
        {
            return false;
        }
        else
        {
            return true;
        }

    }

    public function getProjectDetails($pid,$fieldname)
    {
        $project_query=$this->db->query("SELECT $fieldname FROM project WHERE id=$pid");
        $project_result=$project_query->result();
        return $project_result[0]->$fieldname;
    }

    public function checkProjectEnd($catid)
    {
        $project_query=$this->db->query("SELECT fk_project_id FROM candidate_associated_test WHERE id=$catid");
        $project_result=$project_query->result();

        $project_details=$this->getProjectDetails($project_result[0]->fk_project_id,'end_date');

        if($project_details =="" || strtotime($project_details) > time())
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function getCreaditTest($pid)
    {
        $test_credit_query=$this->db->query("SELECT credit_amount from test where id=$pid");
        $test_credit_result=$test_credit_query->result();
        return $test_credit_result[0]->credit_amount;
    }

    public function getCombineCreaditTest($pid)
    {
        if(empty($pid))
        {
            return 0;
        }
        else
        {
            $test_credit_query=$this->db->query("SELECT SUM(credit_amount) as total_creadit from test where id in ($pid)");
            $test_credit_result=$test_credit_query->result();
            return $test_credit_result[0]->total_creadit;
        }
    }

    public function get_MasterAdmin($uid)
    {
        $user_MA_query=$this->db->query("SELECT master_user_id from user where id=$uid");
        $user_MA_result=$user_MA_query->result();
        return $user_MA_result[0]->master_user_id;
    }

    public function getMasterCredit($mid)
    {
        $master_creadit_query=$this->db->query("SELECT credits from user where id=$mid");
        $master_credit_result=$master_creadit_query->result();
        return $master_credit_result[0]->credits;
    }

    public function creadit_varification($pid)
    {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];

        if($this->session->userdata('logged_in')['role'] == "staff")
        {
            $loggedinUser = $this->session->userdata('logged_in')['client_user_id'];    
        }
            
        $test_credit=$this->getCreaditTest($pid);

        $user_creadit_query=$this->db->query("SELECT credits from user where id=$loggedinUser");
        $user_credit_result=$user_creadit_query->result();
        $user_credit=$user_credit_result[0]->credits;

        if($test_credit > $user_credit)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateCreadit($id)
    {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];

        if($this->session->userdata('logged_in')['role'] == "staff")
        {
            $loggedinUser = $this->session->userdata('logged_in')['client_user_id'];    
        }

        $test_credit=$this->getCreaditTest($id);
            $this->db->query("UPDATE user SET credits=credits-$test_credit WHERE id=$loggedinUser");

        return true;
    }

    public function updateCombineCreadit($id)
    {

        $loggedinUser = $this->session->userdata('logged_in')['user_id'];

        if($this->session->userdata('logged_in')['role'] == "staff")
        {
            $loggedinUser = $this->session->userdata('logged_in')['client_user_id'];    
        }

        $test_credit=$this->getCombineCreaditTest($id);
        $this->db->query("UPDATE user SET credits=credits-$test_credit WHERE id=$loggedinUser");

        return true;
    }

    public function creadit_combine_varification($pid)
    {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];

        if($this->session->userdata('logged_in')['role'] == "staff")
        {
            $loggedinUser = $this->session->userdata('logged_in')['client_user_id'];    
        }
            
        $test_credit=$this->getCombineCreaditTest($pid);

        $user_creadit_query=$this->db->query("SELECT credits from user where id=$loggedinUser");
        $user_credit_result=$user_creadit_query->result();
        $user_credit=$user_credit_result[0]->credits;

        if($test_credit >= $user_credit)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function processTest12($post) {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $catId = $post['cat_id'];
        $test12Anwer = $this->db->query("SELECT test12_answer FROM test_answer");
        $result = $test12Anwer->result();
        $correctAnsArray = explode(',', $result[0]->test12_answer);
        $i = 0;
        $noQ = 55;
        $givenAnsArray = array();
        //make answers array into string
        while ($i < $noQ) {
            $i++;
            $answer = str_replace(",", ";", @isset($post["q$i"]) ? $post["q$i"] : 0);
            array_push($givenAnsArray, $answer);
        }
        
        $givenAnsString = implode(',', $givenAnsArray);

        $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
        $ansData = $userGivenAnswer->result();
        $testDataArray = array(
            'candidate_id' => $loggedinUser,
            'test12_answer' => $givenAnsString
        );
        if (count($ansData) == 0) {
            $this->db->insert('test_given_answer', $testDataArray);
        } else {
            $this->db->where('candidate_id', $loggedinUser);
            $this->db->update('test_given_answer', $testDataArray);
        }

        $j = 0;
        $correct = 0;
        while ($j < $noQ) {
            if ($givenAnsArray[$j] === $correctAnsArray[$j]) {
                $correct += 1;
            }
            $j++;
        }

        $percenatge = number_format((($correct/44)*10), 0);

        $candidateTest = array(
            'test_result' => $percenatge,
            'completed_date' => getCurrentDatetime(),
            'status' => 'completed'
        );
        $this->db->where('id', $catId);
        $this->db->update('candidate_associated_test', $candidateTest);
        if($this->send_mail($catId))
        {
            return true;    
        }
        else
        {
            return false;
        }
    }

    public function processTest4($post) {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];

    
        $catId = $post['cat_id'];
        
        $i = 0;
        $noQ = 120;
        $givenAnsArray = array();
        //make answers array into string
        while ($i < $noQ) {
            $i++;
            $answer = str_replace(",", ";", @isset($post["q$i"]) ? $post["q$i"] : 0);
            array_push($givenAnsArray, $answer);
        }
        $givenAnsString = implode(',', $givenAnsArray);

        $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
        $ansData = $userGivenAnswer->result();
        $testDataArray = array(
            'candidate_id' => $loggedinUser,
            'test4_answer' => $givenAnsString
        );
        if (count($ansData) == 0) {
            $this->db->insert('test_given_answer', $testDataArray);
        } else {
            $this->db->where('candidate_id', $loggedinUser);
            $this->db->update('test_given_answer', $testDataArray);
        }

        $candidateTest = array(
            'completed_date' => getCurrentDatetime(),
            'status' => 'completed'
        );
        $this->db->where('id', $catId);
        $this->db->update('candidate_associated_test', $candidateTest);
        if($this->send_mail($catId))
        {
            return true;    
        }
        else
        {
            return false;
        }
    }

    public function processTest6($post) {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $catId = $post['cat_id'];

        $i = 0;
        $noQ = 28;
        $givenAnsArray = array();
        //make answers array into string
        while ($i < $noQ) {
            $i++;
            $answer = str_replace(",", ";", @isset($post["q$i"]) ? $post["q$i"] : 0);
            array_push($givenAnsArray, $answer);
        }
        $givenAnsString = implode(',', $givenAnsArray);

        $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
        $ansData = $userGivenAnswer->result();
        $testDataArray = array(
            'candidate_id' => $loggedinUser,
            'test_6answer' => $givenAnsString
        );
        if (count($ansData) == 0) {
            $this->db->insert('test_given_answer', $testDataArray);
        } else {
            $this->db->where('candidate_id', $loggedinUser);
            $this->db->update('test_given_answer', $testDataArray);
        }

        $candidateTest = array(
            'completed_date' => getCurrentDatetime(),
            'status' => 'completed'
        );
        $this->db->where('id', $catId);
        $this->db->update('candidate_associated_test', $candidateTest);

        if($this->send_mail($catId))
        {
            return true;    
        }
        else
        {
            return false;
        }
    }

    public function processTest9($post) {
        if($post['type']=="secA")
        {
            $fldname="DST_secA";
            $noQ = 15;
        }
        elseif($post['type']=="secB")
        {
            $fldname="DST_secB";
            $noQ = 10;
        }
        else
        {
            $fldname="DST_secC";
            $noQ = 50;
        }

        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $catId = $post['cat_id'];
        $test9Anwer = $this->db->query("SELECT $fldname FROM test_answer");
        $result = $test9Anwer->result();
        $correctAnsArray = explode(',', $result[0]->$fldname);
        $i = 0;
        $givenAnsArray = array();
        //make answers array into string
        while ($i < $noQ) {
            $i++;
            $answer = str_replace(",", ";", @isset($post["q$i"]) ? $post["q$i"] : 0);
            array_push($givenAnsArray, $answer);
        }
        $givenAnsString = implode(',', $givenAnsArray);

        $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
        $ansData = $userGivenAnswer->result();

        $testDataArray = array(
            'candidate_id' => $loggedinUser,
             "$fldname" => $givenAnsString
        );
        if (count($ansData) == 0) {
            $this->db->insert('test_given_answer', $testDataArray);
        } else {
            $this->db->where('candidate_id', $loggedinUser);
            $this->db->update('test_given_answer', $testDataArray);
        }

        $j = 0;
        
        if($post['type']=="secA")
        {
            $correct = 0;
        }
        else
        {
            $userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
            $correct = (int)$userGivenAnswer->result();
        }

        while ($j < $noQ) {
            if ($givenAnsArray[$j] === $correctAnsArray[$j]) {
                $correct += 1;
            }
            $j++;
        }

        // $candidateTest = array(
        //     'test_result' => $correct,
        //     'completed_date' => getCurrentDatetime(),
        //     'status' => 'completed'
        // );

        $candidateTest = array(
            'test_result' => $correct,
            'completed_date' => getCurrentDatetime(),
            'status' => 'active'
        );

        if ($post['type']=="final") {
            $candidateTest=array();
            $percenatge = number_format((($correct / 75) * 10), 0);
            $candidateTest = array(
                'test_result' => $percenatge,
                'completed_date' => getCurrentDatetime(),
                'status' => 'completed'
            );            
        }

        $this->db->where('id', $catId);
        $this->db->update('candidate_associated_test', $candidateTest);

        if ($post['type']=="final") {
            if($this->send_mail($catId))
            {
                return true;    
            }
            else
            {
                return false;
            }
        }
        return true;
    }

    public function processTest2($post) {
        if($post['type']=="secA")
        {
            $fldname="MIRA_A";
            $noQ = 25;
        }
        else
        {
            $fldname="MIRA_B";
            $noQ = 25;
        }

        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $catId = $post['cat_id'];
        
        $test9Anwer = $this->db->query("SELECT $fldname FROM test_answer");
        $result = $test9Anwer->result();
        $correctAnsArray = explode(',', $result[0]->$fldname);
        $i = 0;
        $givenAnsArray = array();
        //make answers array into string
        while ($i < $noQ) {
            $i++;
            $answer = str_replace(",", ";", @isset($post["q$i"]) ? $post["q$i"] : 0);
            array_push($givenAnsArray, $answer);
        }
        $givenAnsString = implode(',', $givenAnsArray);

        $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
        $ansData = $userGivenAnswer->result();

        $testDataArray = array(
            'candidate_id' => $loggedinUser,
             "$fldname" => $givenAnsString
        );

        if (count($ansData) == 0) {
            $this->db->insert('test_given_answer', $testDataArray);
        } else {
            $this->db->where('candidate_id', $loggedinUser);
            $this->db->update('test_given_answer', $testDataArray);
        }

        $j = 0;
        
        if($post['type']=="secA")
        {
            $correct = 0;
        }
        else
        {
            $userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
            $correct = (int)$userGivenAnswer->result();
        }
        
        while ($j < $noQ) {
            if ($givenAnsArray[$j] === $correctAnsArray[$j]) {
                $correct += 1;
            }
            $j++;
        }

        $candidateTest = array(
            'test_result' => $correct,
            'completed_date' => getCurrentDatetime(),
            'status' => 'active'
        );

        if ($post['type']=="final") {
            $candidateTest=array();
            $percenatge = number_format((($correct / 20) * 10), 0);
            $candidateTest = array(
                'test_result' => $percenatge,
                'completed_date' => getCurrentDatetime(),
                'status' => 'completed'
            );            
        }
        

        $this->db->where('id', $catId);
        $this->db->update('candidate_associated_test', $candidateTest);
        if ($post['type']=="final") {
            if($this->send_mail($catId))
            {
                return true;    
            }
            else
            {
                return false;
            }
        }
        return true;
    }

    public function getLastremember($field){
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $query=$this->db->query("SELECT $field FROM test_given_answer WHERE candidate_id = $loggedinUser");
		if($query->result_array()){
	        return $query->result()[0]->$field;
		}else{
			return 0;
		}
    }

    public function getLastrememberList()
    {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $query=$this->db->query("SELECT `answer` FROM `qanswer_sheet` WHERE `created_by` = $loggedinUser ORDER BY `questions_id`");
        return $query->result_array();

    }

    public function processTest1($post)
    {
        if($post['type']=="secA")
        {
            $fldname="BECL_A";
            $noQ = 288;
        }
        else
        {
            $fldname="BECL_B";
            $noQ = 36;
        }
        //echo $noQ;print_r($_POST);die;
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $catId = $post['cat_id'];
        
        $i = 0;
        $givenAnsArray = array();
       /* //make answers array into string
        foreach($noQ as $i => $val) {
            $answer = str_replace(",", ";", $post["quesAns"][$i]);
            array_push($givenAnsArray, $answer);
        }*/
        $givenAnsString = implode(',', $post["quesAns"]);

        $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
        $ansData = $userGivenAnswer->result();

        $testDataArray = array(
            'candidate_id' => $loggedinUser,
             "$fldname" => $givenAnsString
        );
        if (count($ansData) == 0) {
            $this->db->insert('test_given_answer', $testDataArray);
        } else {
            $this->db->where('candidate_id', $loggedinUser);
            $this->db->update('test_given_answer', $testDataArray);
        }

        if ($post['type']=="final") {
            $candidateTest=array();
            $percenatge = 10;
            
            $candidateTest = array(
                'test_result' => $percenatge,
                'completed_date' => getCurrentDatetime(),
                'status' => 'completed'
            );            

            $this->db->where('id', $catId);
            $this->db->update('candidate_associated_test', $candidateTest);
        }

        

        if ($post['type']=="final")
        {

            if($this->send_mail($catId))
            {
                return true;    
            }
            else
            {
                return false;
            }
        }
        return true;
    }

    public function answertest1($post)
    {

        $this->db->where('created_by',$post['created_by']);    
        $this->db->where('questions_id',$post['questions_id']);
        $this->db->from('qanswer_sheet');
        $query = $this->db->get();
        $rowcount = $query->num_rows();

        if($rowcount > 0)
        {
            $this->db->where('created_by',$post['created_by']);    
            $this->db->where('questions_id',$post['questions_id']);
            $this->db->update('qanswer_sheet', array('answer' => $post['answer'], 'total' => $post['total']));
            if($this->db->affected_rows() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            if($this->db->insert('qanswer_sheet', $post))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

    }

    public function update_remember($test,$question,$candidate)
    {
        $this->db->where('candidate_id',$candidate);    
        $this->db->from('test_given_answer');
        $query = $this->db->get();
        $rowcount = $query->num_rows();

        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        

        if($rowcount > 0)
        {
            $data=array($test => $question);
            $this->db->where('candidate_id', $loggedinUser);
            $this->db->update('test_given_answer', $data);
        }
        else
        {
            $data=array($test => $question, 'candidate_id' => $candidate);
            $iquery=$this->db->insert("test_given_answer",$data);
        }

        return true;
    }

    //  public function processTest1($post) {
        
    //     $fldname="BECL";
    //     $noQ = 252;

    //     $loggedinUser = $this->session->userdata('logged_in')['user_id'];
    //     $catId = $post['cat_id'];

    //     // $test9Anwer = $this->db->query("SELECT $fldname FROM test_answer");
    //     // $result = $test9Anwer->result();
    //     // $correctAnsArray = explode(',', $result[0]->$fldname);

    //     $i = 0;
    //     $givenAnsArray = array();
    //     //make answers array into string
    //     while ($i < $noQ) {
    //         $i++;
    //         $answer = str_replace(",", ";", $post["quesAns"][$i]);
    //         array_push($givenAnsArray, $answer);
    //     }
    //     $givenAnsString = implode(',', $givenAnsArray);

    //     $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
    //     $ansData = $userGivenAnswer->result();

    //     $testDataArray = array(
    //         'candidate_id' => $loggedinUser,
    //          "$fldname" => $givenAnsString
    //     );
    //     if (count($ansData) == 0) {
    //         $this->db->insert('test_given_answer', $testDataArray);
    //     } else {
    //         $this->db->where('candidate_id', $loggedinUser);
    //         $this->db->update('test_given_answer', $testDataArray);
    //     }

    //     //$j = 0;
        
    //     // if($post['type']=="secA")
    //     // {
    //     //     $correct = 0;
    //     // }
    //     // else
    //     // {
    //     //     $userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
    //     //     $correct = (int)$userGivenAnswer->result();
    //     // }

    //     // while ($j < $noQ) {
    //     //     if ($givenAnsArray[$j] === $correctAnsArray[$j]) {
    //     //         $correct += 1;
    //     //     }
    //     //    $j++;
    //     //}
    //     //$percenatge = number_format((($correct / 40) * 10), 0);

    //     $candidateTest = array(
    //         'test_result' => '',
    //         'completed_date' => getCurrentDatetime(),
    //         'status' => 'completed'
    //     );

    //     $this->db->where('id', $catId);
    //     $this->db->update('candidate_associated_test', $candidateTest);
    //     if($this->send_mail($catId))
    //     {
    //         return true;    
    //     }
    //     else
    //     {
    //         return false;
    //     }
    // }

    public function beci($post) {

        if($post['type']=="secA")
        {
            $fldname="BECi_A";
            $noQ = 325;
        }
        else
        {
            $fldname="BECi_B";
            $noQ = 36;
        }

        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $catId = $post['cat_id'];
        
        $i = 0;
        $givenAnsArray = array();
        //make answers array into string
        while ($i < $noQ) {
            $i++;
            $answer = str_replace(",", ";", $post["quesAns"][$i]);
            array_push($givenAnsArray, $answer);
        }
        $givenAnsString = implode(',', $givenAnsArray);

        $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
        $ansData = $userGivenAnswer->result();

        $testDataArray = array(
            'candidate_id' => $loggedinUser,
             "$fldname" => $givenAnsString
        );
        if (count($ansData) == 0) {
            $this->db->insert('test_given_answer', $testDataArray);
        } else {
            $this->db->where('candidate_id', $loggedinUser);
            $this->db->update('test_given_answer', $testDataArray);
        }

        if ($post['type']=="final") {
            $candidateTest=array();
            $percenatge = number_format((($correct / 40) * 10), 0);

            $candidateTest = array(
                'test_result' => $percenatge,
                'completed_date' => getCurrentDatetime(),
                'status' => 'completed'
            );            
        }

        $this->db->where('id', $catId);
        $this->db->update('candidate_associated_test', $candidateTest);

        if ($post['type']=="final")
        {
            if($this->send_mail($catId))
            {
                return true;    
            }
            else
            {
                return false;
            }
        }
        return true;
    }

    public function processTest7($post) {
        if($post['type']=="secA")
        {
            $fldname="Verbal_Skills_A";
            $noQ = 5;
        }
        elseif($post['type']=="secB")
        {
            $fldname="Verbal_Skills_B";
            $noQ = 5;
        }
        elseif($post['type']=="secC")
        {
            $fldname="Verbal_Skills_C";
            $noQ = 5;
        }
        elseif($post['type']=="secD")
        {
            $fldname="Verbal_Skills_D";
            $noQ = 10;
        }
        else
        {
            $fldname="Verbal_Skills_E";
            $noQ = 9;
        }

        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $catId = $post['cat_id'];
        
        $test7Anwer = $this->db->query("SELECT $fldname FROM test_answer");
        $result = $test7Anwer->result();
        $correctAnsArray = explode(',', $result[0]->$fldname);

        $i = 0;
        $givenAnsArray = array();
        //make answers array into string
        while ($i < $noQ) {
            $i++;
            $answer = str_replace(",", ";", @isset($post["q$i"]) ? $post["q$i"] : 0);
            array_push($givenAnsArray, $answer);
        }
        $givenAnsString = implode(',', $givenAnsArray);

        $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
        $ansData = $userGivenAnswer->result();

        $testDataArray = array(
            'candidate_id' => $loggedinUser,
             "$fldname" => $givenAnsString
        );
        if (count($ansData) == 0) {
            $this->db->insert('test_given_answer', $testDataArray);
        } else {
            $this->db->where('candidate_id', $loggedinUser);
            $this->db->update('test_given_answer', $testDataArray);
        }

        $j = 0;
        
        if($post['type']=="secA")
        {
            $correct = 0;
        }
        else
        {
            $userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
            $correct = (int)$userGivenAnswer->result();
        }
        
        while ($j < $noQ) {
            if ($givenAnsArray[$j] === $correctAnsArray[$j]) {
                $correct += 1;
            }
            $j++;
        }

        $candidateTest = array(
            'test_result' => $correct,
            'completed_date' => getCurrentDatetime(),
            'status' => 'active'
        );

        if ($post['type']=="final") {
            $candidateTest=array();
            $percenatge = number_format((($correct / 34) * 10), 0);
            $candidateTest = array(
                'test_result' => $percenatge,
                'completed_date' => getCurrentDatetime(),
                'status' => 'completed'
            );            
        }

        $this->db->where('id', $catId);
        $this->db->update('candidate_associated_test', $candidateTest);
        
        if ($post['type']=="final")
        {
            if($this->send_mail($catId))
            {
                return true;    
            }
            else
            {
                return false;
            }
        }
        return true;
    }

    public function processTest8($post) {
        if($post['type']=="secA")
        {
            $fldname="Numerical_Skills_A";
            $noQ = 10;
        }
        elseif($post['type']=="secB")
        {
            $fldname="Numerical_Skills_B";
            $noQ = 10;
        }
        elseif($post['type']=="secC")
        {
            $fldname="Numerical_Skills_C";
            $noQ = 10;
        }
        else
        {
            $fldname="Numerical_Skills_D";
            $noQ = 10;
        }

        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $catId = $post['cat_id'];
        
        $test8Anwer = $this->db->query("SELECT $fldname FROM test_answer");
        $result = $test8Anwer->result();
        $correctAnsArray = explode(',', $result[0]->$fldname);

        $i = 0;
        $givenAnsArray = array();
        //make answers array into string
        while ($i < $noQ) {
            $i++;
            $answer = str_replace(",", ";", @isset($post["q$i"]) ? $post["q$i"] : 0);
            array_push($givenAnsArray, $answer);
        }
        $givenAnsString = implode(',', $givenAnsArray);

        $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
        $ansData = $userGivenAnswer->result();

        $testDataArray = array(
            'candidate_id' => $loggedinUser,
             "$fldname" => $givenAnsString
        );
        if (count($ansData) == 0) {
            $this->db->insert('test_given_answer', $testDataArray);
        } else {
            $this->db->where('candidate_id', $loggedinUser);
            $this->db->update('test_given_answer', $testDataArray);
        }

        $j = 0;
        
        if($post['type']=="secA")
        {
            $correct = 0;
        }
        else
        {
            $userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
            $correct = (int)$userGivenAnswer->result();
        }
        
        while ($j < $noQ) {
            if ((int)$givenAnsArray[$j] === (int)$correctAnsArray[$j]) {
                $correct += 1;
            }
            $j++;
        }

        $candidateTest = array(
            'test_result' => $correct,
            'completed_date' => getCurrentDatetime(),
            'status' => 'active'
        );

        if ($post['type']=="final") {
            $candidateTest=array();
            $percenatge = number_format((($correct / 40) * 10), 0);
            $candidateTest = array(
                'test_result' => $percenatge,
                'completed_date' => getCurrentDatetime(),
                'status' => 'completed'
            );            
        }

        $this->db->where('id', $catId);
        $this->db->update('candidate_associated_test', $candidateTest);
        if ($post['type']=="final") {
            if($this->send_mail($catId))
            {
                return true;    
            }
            else
            {
                return false;
            }
        }
        return true;
    }

    public function processTest3($post) {
        if($post['type']=="secA")
        {
            $fldname="LAP_A";
            $noQ = 24;
        }
        elseif($post['type']=="secB")
        {
            $fldname="LAP_B";
            $noQ = 24;
        }
        elseif($post['type']=="secC")
        {
            $fldname="LAP_C";
            $noQ = 10;
        }
        else
        {
            $fldname="LAP_D";
            $noQ = 21;
        }

        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $catId = $post['cat_id'];

        $lap = $this->db->query("SELECT $fldname FROM test_answer");
        $result = $lap->result();
        $correctAnsArray = explode(',', $result[0]->$fldname);
        
        $i = 0;
        $givenAnsArray = array();
        //make answers array into string
        while ($i < $noQ) {
            $i++;
            $answer = str_replace(",", ";", @isset($post["q$i"]) ? $post["q$i"] : 0);
            array_push($givenAnsArray, $answer);
        }

        $givenAnsString = implode(',', $givenAnsArray);

        $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
        $ansData = $userGivenAnswer->result();

        $testDataArray = array(
            'candidate_id' => $loggedinUser,
             "$fldname" => $givenAnsString
        );
        if (count($ansData) == 0) {
            $this->db->insert('test_given_answer', $testDataArray);
        } else {
            $this->db->where('candidate_id', $loggedinUser);
            $this->db->update('test_given_answer', $testDataArray);
        }
        
        $j = 0;
        
        if($post['type']=="secA")
        {
            $correct = 0;
        }
        else
        {
            $userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
            $correct = (int)$userGivenAnswer->result();
        }

        while ($j < $noQ) {
            if ($givenAnsArray[$j] === $correctAnsArray[$j]) {
                $correct += 1;
            }
            $j++;
        }
        $candidateTest = array(
            'test_result' => $correct,
            'completed_date' => getCurrentDatetime(),
            'status' => 'active'
        );

        if ($post['type']=="final") {
            $candidateTest=array();
            $percenatge = number_format((($correct / 79) * 10), 0);
            $candidateTest = array(
                'test_result' => $percenatge,
                'completed_date' => getCurrentDatetime(),
                'status' => 'completed'
            );            
        }

        $this->db->where('id', $catId);
        $this->db->update('candidate_associated_test', $candidateTest);
        
        if ($post['type']=="final") {
            if($this->send_mail($catId))
            {
                return true;    
            }
            else
            {
                return false;
            }
        }
        return true;

    }

    public function processTest10($post) {
        if($post['type']=="secA")
        {
            $fldname="ECT_A";
            $noQ = 5;
        }
        elseif($post['type']=="secB")
        {
            $fldname="ECT_B";
            $noQ = 5;
        }
        elseif($post['type']=="secC")
        {
            $fldname="ECT_C";
            $noQ = 10;
        }
        else
        {
            $fldname="ECT_D";
            $noQ = 15;
        }

        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $catId = $post['cat_id'];
        
        $ECT = $this->db->query("SELECT $fldname FROM test_answer");
        $result = $ECT->result();
        $correctAnsArray = explode(',', $result[0]->$fldname);

        $i = 0;
        $givenAnsArray = array();
        //make answers array into string
        while ($i < $noQ) {
            $i++;
            $answer = str_replace(",", ";", @isset($post["q$i"]) ? $post["q$i"] : 0);
            array_push($givenAnsArray, $answer);
        }
        $givenAnsString = implode(',', $givenAnsArray);

        $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
        $ansData = $userGivenAnswer->result();

        $testDataArray = array(
            'candidate_id' => $loggedinUser,
             "$fldname" => $givenAnsString
        );
        if (count($ansData) == 0) {
            $this->db->insert('test_given_answer', $testDataArray);
        } else {
            $this->db->where('candidate_id', $loggedinUser);
            $this->db->update('test_given_answer', $testDataArray);
        }

        $j = 0;
        
        if($post['type']=="secA")
        {
            $correct = 0;
        }
        else
        {
            $userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
            $correct = (int)$userGivenAnswer->result();
        }
        
        while ($j < $noQ) {
            if ($givenAnsArray[$j] === $correctAnsArray[$j]) {
                $correct += 1;
            }
            $j++;
        }

        $candidateTest = array(
            'test_result' => $correct,
            'completed_date' => getCurrentDatetime(),
            'status' => 'active'
        );

        if ($post['type']=="final") {
            $candidateTest=array();
            $percenatge = number_format((($correct / 35) * 10), 0);
            $candidateTest = array(
                'test_result' => $percenatge,
                'completed_date' => getCurrentDatetime(),
                'status' => 'completed'
            );            
        }

        $this->db->where('id', $catId);
        $this->db->update('candidate_associated_test', $candidateTest);
        if ($post['type']=="final") {
            if($this->send_mail($catId))
            {
                return true;    
            }
            else
            {
                return false;
            }
        }
        return true;
    }

    public function processTest11($post) {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $catId = $post['cat_id'];
        $test4Anwer = $this->db->query("SELECT MST FROM test_answer");
        $result = $test4Anwer->result();
        $correctAnsArray = explode(',', $result[0]->MST);
        $i = 0;
        $noQ = 20;
        $givenAnsArray = array();
        //make answers array into string
        while ($i < $noQ) {
            $i++;
            $answer = str_replace(",", ";", @isset($post["q$i"]) ? $post["q$i"] : 0);
            array_push($givenAnsArray, $answer);
        }
        $givenAnsString = implode(',', $givenAnsArray);

        $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
        $ansData = $userGivenAnswer->result();
        $testDataArray = array(
            'candidate_id' => $loggedinUser,
            'MST' => $givenAnsString
        );
        if (count($ansData) == 0) {
            $this->db->insert('test_given_answer', $testDataArray);
        } else {
            $this->db->where('candidate_id', $loggedinUser);
            $this->db->update('test_given_answer', $testDataArray);
        }

        $j = 0;
        $correct = 0;
        while ($j < $noQ) {
            if ($givenAnsArray[$j] === $correctAnsArray[$j]) {
                $correct += 1;
            }
            $j++;
        }


        $percenatge = number_format((($correct / 20) * 10), 0);

        $candidateTest = array(
            'test_result' => $percenatge,
            'completed_date' => getCurrentDatetime(),
            'status' => 'completed'
        );
        $this->db->where('id', $catId);
        $this->db->update('candidate_associated_test', $candidateTest);
    
        if($this->send_mail($catId))
        {
            return true;    
        }
        else
        {
            return false;
        }
    }

    public function processTest5($post) {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $catId = $post['cat_id'];
        $i = 0;
        $noQ = 80;
        $givenAnsArray = array();
        //make answers array into string
        while ($i < $noQ) {
            $i++;
            $answer = str_replace(",", ";", @isset($post["q$i"]) ? $post["q$i"] : 0);
            array_push($givenAnsArray, $answer);
        }
        $givenAnsString = implode(',', $givenAnsArray);

        $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
        $ansData = $userGivenAnswer->result();
        $testDataArray = array(
            'candidate_id' => $loggedinUser,
            'IPT' => $givenAnsString
        );
        if (count($ansData) == 0) {
            $this->db->insert('test_given_answer', $testDataArray);
        } else {
            $this->db->where('candidate_id', $loggedinUser);
            $this->db->update('test_given_answer', $testDataArray);
        }

        $candidateTest = array(
            'completed_date' => getCurrentDatetime(),
            'status' => 'completed'
        );
        $this->db->where('id', $catId);
        $this->db->update('candidate_associated_test', $candidateTest);
        
        if($this->send_mail($catId))
        {
            return true;    
        }
        else
        {
            return false;
        }
    }

    public function getMasterTestList()
    {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $query = $this->db->query("SELECT assign_test from user where id=$loggedinUser");
        $mt=$query->result();
        $tests=$mt[0]->assign_test;

        $test_query = $this->db->query("SELECT id,test_name from test where id in ($tests)");
        return $test_query->result();
    }

    public function getCandidateTestList($id)
    {
        $test_query = $this->db->query("SELECT at.*,t.test_name,t.test_short_name from candidate_associated_test as at, test as t where fk_candidate_id=$id AND t.id=at.fk_test_id order by at.fk_test_id");
        return $test_query->result();
    }

    public function send_mail($cid)
    {
        $project_query=$this->db->query("SELECT p.notification as notification FROM project as p, candidate_associated_test as c WHERE c.id=$cid AND p.id=c.fk_project_id LIMIT 1");
        $project_result=$project_query->result();

        if($project_result[0]->notification == 2)
        {
            return true;
        }
        else
        {
            $loggedinUser = $this->session->userdata('logged_in')['user_id'];
            $masterUser = $this->session->userdata('logged_in')['created_by'];

            $query=$this->db->query("SELECT email,phone_no,first_name,id_passport_no FROM user WHERE id=$loggedinUser");
            $query_result=$query->result();

            $master_query = $this->db->query("SELECT email,username FROM user WHERE id=$masterUser");
            $master_result= $master_query->result();


            $from = 'noreply@assessmenthouse.com';
            $to = $master_result[0]->email;
            $subject = 'Candidate completed Test';
            $emaliFilename = $this->config->item('base_url') . "mailer/candidate-completetest.php";
            $data = file_get_contents($emaliFilename);
            $replace = array("[%USERNAME%]", "[%CNAME%]", "[%CNUMBER%]", "[%CEMAIL%]", "[%CID%]");
            $replace_with = array($master_result[0]->username, $query_result[0]->first_name, $query_result[0]->email, $query_result[0]->id_passport_no);
            $message = str_replace($replace, $replace_with, $data);
            if ($this->sendTestMail($to, $from, $subject, $message)) {
                return true;
            }
            else
            {
                return false;
            }
        }

    }

    public function sendTestMail($to, $from, $subject, $message) {
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

    public function getTestResult($test_id, $user_id)
    {
        $query = $this->db->query("SELECT test_result from candidate_associated_test WHERE fk_candidate_id=$user_id AND fk_test_id=$test_id");
        $query_result = $query->result_array();
        return $query_result[0]['test_result'];
    }

    public function getTestCode()
    {
        $query = $this->db->query("SELECT * FROM questions_code WHERE is_deleted = 0 ORDER BY cluster");
        return $query->result_array();

    }

    public function getAnsData($uid)
    {
        $query = $this->db->query("SELECT q.questions_id, q.code, qs.created_by, qs.answer, qs.total, qs.created_date FROM qanswer_sheet AS qs LEFT JOIN questions AS q ON q.questions_id = qs.questions_id AND q.is_deleted = 0 WHERE qs.is_deleted = '0' AND qs.created_by = $uid ");
        return $query->result_array();
    }
	
    public function getQuestionList($secName = 'A'){
        $query = $this->db->query("SELECT questions_id, item FROM questions WHERE is_deleted = '0' ");
        return $query->result_array();
    }

    public function getMiraTestResultRules(){
        $query = $this->db->query("SELECT * FROM mira_test_result_rules WHERE is_deleted = '0' ");
        return $query->result_array();
    }

}

/* End of file Test_model.php */
/* Location: ./application/model/Test_model.php */
