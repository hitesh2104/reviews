<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Project_model extends CI_Model {

    /** constructor */
    function __construct() {
        parent::__construct();
    }

    public function createProject($post) {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $masterUserId = $this->session->userdata('logged_in')['master_user_id'];
        if (isClient()) {
            $clientUserId = $loggedinUser;
            $masterUserId = $loggedinUser;
        } elseif (isStaff()) {
            $clientUserId = $this->session->userdata('logged_in')['client_user_id'];
            $masterUserId = $loggedinUser;
        } elseif (isMasterAdmin()) {
            $masterUserId = $loggedinUser;
            $clientUserId = 0;
        }
        if (isset($post)) {
            $projectData = array(
                'project_name' => trim(addslashes($post['project_name'])),
                'project_description' => trim(addslashes($post['project_description'])),
                'start_date' => trim($post['start_date']),
                'end_date' => trim($post['end_date']),
                'test_list' => implode(',', $post['test_list']),
                'notification' => trim($post['notification']),
				'job_success_profile' => trim($post['job_success_profile']),
                'status' => 'created',
                'master_user_id' => $masterUserId,
                'client_user_id' => $clientUserId,
                'created_by' => $loggedinUser,
                'created_at' => getCurrentDatetime()
            );
			
            $candidateName = $post['full_name'];
            $candidateEmail = $post['email'];
            $candicatePhoneNo = @isset($post['phone_no']) ? $post['phone_no'] : '';
            $countCheck = count($candidateName);
            try {
                $this->db->trans_begin();
                if ($this->db->insert('project', $projectData)) {
                    $projectId = $this->db->insert_id();

                    //Create participant account without password and inactive status
                    for ($i = 0; $i < $countCheck; $i++) {
                        if (!empty($candidateEmail[$i]) && !empty($candidateName[$i])) {
                            $password = generatePassword();
                            $args = array(
                                'email' => $candidateEmail[$i],
                                'full_name' => $candidateName[$i],
                                'phone_no' => @$candicatePhoneNo[$i],
                                'password' => $password,
                                'master_user_id' => $masterUserId,
                                'client_user_id' => $clientUserId,
                                'created_by' => $loggedinUser,
                                'created_at' => getCurrentDatetime(),
                                'test_list' => implode(',', $post['test_list']),
                                'projectId' => $projectId
                            );
                            $result = $this->createCandidate($args);
                            if ($result != 1) {
                                $this->db->trans_rollback();
                                return false;
                            }
                        }
                    }
                    $this->db->trans_commit();
                    return true;
                }
            } catch (Exception $e) {
                $this->db->trans_rollback();
                return false;
            }
        }
        return false;
    }

    public function createCandidate($args) {
        if ($args) {
            $role = 'candidate';
            $name = $args['full_name'];
            $email = $args['email'];
            $phone_no = @isset($args['phone_no']) ? $args['phone_no'] : '';
            $status = 'inactive';
            $originalPwd = $args['password'];
            $generatedPwd = md5($originalPwd);
            $masterUserId = $args['master_user_id'];
            $clientUserId = $args['client_user_id'];
            $createdBy = $args['created_by'];
            $createdAt = $args['created_at'];
            $testList = $args['test_list'];
            $projectId = $args['projectId'];
            try {
                $userQuery = $this->db->query("
                    INSERT INTO 
                    user (role, email, full_name, phone_no, fk_project_id, status, master_user_id, client_user_id, created_by, created_at) 
                    VALUES ('$role', '$email', '$name', '$phone_no', '$projectId', '$status', '$masterUserId', '$clientUserId', '$createdBy', '$createdAt') ");

                $candidateId = $this->db->insert_id();

                if ($candidateId) {
                    $testArray = explode(',', $testList);
                    foreach ($testArray as $test) {
                        $testInfo = $this->db->query("
                        INSERT INTO 
                        candidate_associated_test (fk_candidate_id, fk_project_id, fk_test_id, created_by, created_at) 
                        VALUES ('$candidateId', '$projectId', '$test', '$createdBy', '$createdAt') ");
                    }
                        if ($testInfo) {
                            return true;
                        }
                }
            } catch (PDOException $e) {
                return false;
            }
        }
        return false;
    }

    public function launchProject($post) {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $masterUserId = $this->session->userdata('logged_in')['master_user_id'];
        if (isClient()) {
            $masterUserId = $loggedinUser;
            $clientUserId = $loggedinUser;
        } elseif (isStaff()) {
            $masterUserId = $loggedinUser;
            $clientUserId = $this->session->userdata('logged_in')['client_user_id'];
        } elseif (isMasterAdmin()) {
            $masterUserId = $loggedinUser;
            $clientUserId = 0;
        }

        if (isset($post)) {
            $projectData = array(
                'project_name' => trim(addslashes($post['project_name'])),
                'project_description' => trim(addslashes($post['project_description'])),
                'start_date' => trim($post['start_date']),
                'end_date' => trim($post['end_date']),
                'test_list' => implode(',', $post['test_list']),
                'notification' => trim($post['notification']),
				'job_success_profile' => trim($post['job_success_profile']),
                'is_launched' => 1,
                'status' => 'active',
                'master_user_id' => $masterUserId,
                'client_user_id' => $clientUserId,
                'created_by' => $loggedinUser,
                'created_at' => getCurrentDatetime()
            );
			
            $candidateName = $post['full_name'];
            $candidateEmail = $post['email'];
            $candicatePhoneNo = @isset($post['phone_no']) ? $post['phone_no'] : '';
            $countCheck = count($candidateName);

            //Create project
            try {
                $this->db->trans_begin();
                if ($this->db->insert('project', $projectData)) {
                    $projectId = $this->db->insert_id();
                    //Create candidate account with password and active status
                    for ($i = 0; $i < $countCheck; $i++) {
                        if (!empty($candidateEmail[$i]) && !empty($candidateName[$i])) {
                            $password = generatePassword();
                            $args = array(
                                'email' => $candidateEmail[$i],
                                'password' => $password,
                                'full_name' => $candidateName[$i],
                                'phone_no' => @$candicatePhoneNo[$i],
                                'master_user_id' => $masterUserId,
                                'client_user_id' => $clientUserId,
                                'created_by' => $loggedinUser,
                                'created_at' => getCurrentDatetime(),
                                'test_list' => implode(',', $post['test_list']),
                                'projectId' => $projectId
                            );
                            $result = $this->launchCandidate($args);
                            if ($result != 1) {
                                
                                    $this->db->trans_rollback();
                                    return false;
                                    
                            }
                        }
                    }
                    if($this->sendProjectCandidateMail($projectId))
                    {
                        $this->db->trans_commit();
                    }
                    return true;
                }
            } catch (Exception $e) {
                $this->db->trans_rollback();
                return false;
            }
        }
        return false;
    }

    public function launchCandidate($args) {
        if ($args) {
            $role = 'candidate';
            $name = $args['full_name'];
            $email = $args['email'];
            $originalPwd = $args['password'];
            $generatedPwd = md5($originalPwd);
            $phone_no = @isset($args['phone_no']) ? $args['phone_no'] : '';
            $status = 'active';
            $masterUserId = $args['master_user_id'];
            $clientUserId = $args['client_user_id'];
            $createdBy = $args['created_by'];
            $createdAt = $args['created_at'];
            $testList = $args['test_list'];
            $projectId = $args['projectId'];

            try {
                $userQuery = $this->db->query("
                    INSERT INTO 
                    user (role, email, password, full_name, phone_no, fk_project_id, status, master_user_id, client_user_id, created_by, created_at) 
                    VALUES ('$role', '$email', '$generatedPwd', '$name', '$phone_no', '$projectId', '$status', '$masterUserId', '$clientUserId', '$createdBy', '$createdAt') ");

                $candidateId = $this->db->insert_id();

                if ($candidateId) {
                    $testArray = explode(',', $testList);

                    foreach ($testArray as $test) {
                    $testInfo = $this->db->query("
                    INSERT INTO 
                    candidate_associated_test (fk_candidate_id, fk_project_id, fk_test_id, created_by, created_at) 
                    VALUES ('$candidateId', '$projectId', '$test','$createdBy', '$createdAt') ");
                    }
                    if ($testInfo) {
                        if(@isset($args['regi']) == 1)
                        {
                            // send mail
                            $from = 'noreply@assessmenthouse.com';
                            $to = $args['email'];
                            $subject = 'Candidate Login Details';
                            $emaliFilename = $this->config->item('dir_url') . "mailer/candidate-registration.php";
                            $data = file_get_contents($emaliFilename);
                            
                            $loggedinUser = empty($this->session->userdata('logged_in')['username']) ? $this->session->userdata('logged_in')['full_name'] : $this->session->userdata('logged_in')['username'];
                            
                            $loggedinemail = $args['email'];
                            $replace = array("[%TNAME%]","[%USERNAME%]", "[%EMAIL%]", "[%PASSWORD%]", "[%TEMAIL%]");
                            $replace_with = array($loggedinUser,$name, $email, $originalPwd, $loggedinemail);
                            // $replace = array("[%USERNAME%]", "[%EMAIL%]", "[%PASSWORD%]");
                            // $replace_with = array($name, $email, $originalPwd);
                            $message = str_replace($replace, $replace_with, $data);
                            if ($this->sendRegistrationMail($to, $from, $subject, $message)) {
                                return $candidateId;
                            }
                        }
                        else
                        {
                            return true;
                        }
                    }
                }
            } catch (Exception $e) {
                return false;
            }
        }
        return false;
    }

    public function sendProjectCandidateMail($pid)
    {
        $userlist = $this->getProjectCandidate($pid);

        foreach ($userlist as $value) {
        	$this->db->query("UPDATE user set status='active' WHERE id = $value->id");
            $this->resendLogin($value->id);
        }
        
        return true;
    }

    public function getProjectList() {

        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $query = $this->db->query("
            SELECT p.id, p.project_name, p.start_date, p.end_date, p.notification, p.status, p.is_launched, p.test_list
            FROM project AS p
            WHERE p.status != 'deleted' AND (p.created_by = $loggedinUser OR
            p.created_by IN (SELECT id from user where master_user_id= ".$loggedinUser." AND role = 'client') OR client_user_id In (SELECT id from user where master_user_id= ".$loggedinUser." AND role = 'client'))
            ORDER BY p.created_at DESC
            ");
        return $query->result();
    }

    public function getProjectPerticipant($progectId) {
        $query = $this->db->query("
            SELECT COUNT(*) AS no_of_perticipant
            FROM user
            WHERE fk_project_id = $progectId
            ");
        return $query->result()[0]->no_of_perticipant;
    }

    public function getAllProjectList() {
        $query = $this->db->query("
            SELECT p.id, p.project_name, p.start_date, p.end_date, p.step_1_report_type, p.step_2_report_type, p.status, p.is_launched, p.created_by
            FROM project AS p
            WHERE p.status != 'deleted' 
            ORDER BY p.created_at DESC
            ");
        return $query->result();
    }
    
    public function getProject($projectId) {
        if (!empty($projectId)) {
            $condition = " status != 'deleted' AND id = " . (int)$projectId;
            $query = $this->db->query("
            SELECT *
            FROM project
            WHERE $condition LIMIT 1
            ");
            return $query->result();
        }
        return array();
    }
    
    public function launchProjectUpdate($post) {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        if (isClient()) {
            $clientUserId = $loggedinUser;
            $masterUserId = $loggedinUser;
        } elseif (isStaff()) {
            $clientUserId = $this->session->userdata('logged_in')['client_user_id'];
            $masterUserId = $loggedinUser;
        } elseif (isMasterAdmin()) {
            $masterUserId = $loggedinUser;
            $clientUserId = 0;
        }

        if (isset($post)) {
            $projectData = array(
                'project_name' => trim(addslashes($post['project_name'])),
                'project_description' => trim(addslashes($post['project_description'])),
                'start_date' => trim($post['start_date']),
                'end_date' => @$_POST['open_project']=="open" ? "" : trim($post['end_date']),
                'test_list' => implode(',', $post['test_list']),
                'notification' => $_POST['notification'],
				'job_success_profile' => trim($post['job_success_profile']),
                //'step_1_report_type' => trim($post['step_1_report_type']),
                //'step_2_report_type' => trim($post['step_2_report_type']),
                'is_launched' => 1,
                'status' => 'active',
                'last_updated_by' => $loggedinUser,
                'updated_at' => getCurrentDatetime()
            );

            $candidateName = $post['full_name'];
            $candidateEmail = $post['email'];
            $candicatePhoneNo = @isset($post['phone_no']) ? $post['phone_no'] : '' ;
            $countCheck = count($candidateName);

            //Create project
            try {
                $this->db->trans_begin();
                $projectId = trim($post['id']);
                $this->db->where('id', $projectId);
                if ($this->db->update('project', $projectData)) {
                    //Create candidate account with password and active status
                    for ($i = 0; $i < $countCheck; $i++) {
                        if (!empty($candidateEmail[$i]) && !empty($candidateName[$i])) {
                            $password = generatePassword();
                            $args = array(
                                'email' => $candidateEmail[$i],
                                'password' => $password,
                                'full_name' => $candidateName[$i],
                                'phone_no' => @$candicatePhoneNo[$i],
                                'master_user_id' => $masterUserId,
                                'client_user_id' => $clientUserId,
                                'created_by' => $loggedinUser,
                                'created_at' => getCurrentDatetime(),
                                'test_list' => implode(',', $post['test_list']),
                                'projectId' => $projectId
                            );
                            $result = $this->launchCandidate($args);
                            if ($result != 1) {
                                $this->db->trans_rollback();
                                return false;
                            }
                        }
                    }
                    if($this->sendProjectCandidateMail($projectId))
                    {
                        $this->db->trans_commit();
                    }
                    return true;
                }
            } catch (Exception $e) {
                $this->db->trans_rollback();
                return false;
            }
        }
        return false;
    }

    public  function getProjectCandidate($id)
    {
        $candidate_query=$this->db->query("SELECT DISTINCT(fk_candidate_id) FROM candidate_associated_test WHERE fk_project_id=$id");
        $candidate_result=$candidate_query->result();
        
        if(@$candidate_result[0]->fk_candidate_id != "")
        {
            $candidate_list="";
            foreach ($candidate_result as $value) {
                $candidate_list.=$value->fk_candidate_id.",";
            }
            $candidate_list=rtrim($candidate_list,",");

            $candidate_detail_query=$this->db->query("SELECT * FROM user where id in ($candidate_list) AND status != 'deleted'");

            return $candidate_detail_query->result();
        }
        return array();
    }

    public  function getProjectCandidateCount($id)
    {
        $candidate_query=$this->db->query("SELECT COUNT(DISTINCT(fk_candidate_id)) as candidates FROM candidate_associated_test WHERE fk_project_id=$id");
        $candidate_result=$candidate_query->result();

        if (!empty($candidate_result)) {
            return $candidate_result[0]->candidates;
        }
        return 0;
    }

    public function changeStatus($post)
    {
        $status = $post['status'];

        $project_status = $post['project_status'];

        $projectId = $post['project_id'];

        $candidate_query=$this->db->query("SELECT DISTINCT(fk_candidate_id) FROM candidate_associated_test WHERE fk_project_id=$projectId");
        $candidate_result=$candidate_query->result();
        $candidate_list="";
        foreach ($candidate_result as $value) {
            $candidate_list.=$value->fk_candidate_id.",";
        }
        $candidate_list=rtrim($candidate_list,",");

        $this->db->query("UPDATE user SET status='$status' WHERE id in ($candidate_list)");

        $this->db->query("UPDATE project SET status='$project_status' WHERE id=$projectId");

        return true;

    }

    public function testCompleted($id)
    {
        $total_query=$this->db->query("SELECT COUNT(fk_test_id) as total_test from candidate_associated_test WHERE fk_candidate_id=$id");
        $total_result=$total_query->result();
        $total_test=$total_result[0]->total_test;

        $complete_query=$this->db->query("SELECT COUNT(fk_test_id) as complete_test from candidate_associated_test WHERE fk_candidate_id=$id AND status='completed'");

        $complete_result=$complete_query->result();
        $complete_test=$complete_result[0]->complete_test;

        return $complete_test."/".$total_test;
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

    public function checkClientCredit($clientId,$post)
    {
        $clientCredit_query = $this->db->query("SELECT credits FROM user WHERE id = $clientId");
        $clientCredit_result = $clientCredit_query->result();
        $clientCredit=$clientCredit_result[0]->credits;

        $tests="";
        
        foreach ($post['test_list'] as $value) {
            $tests.=$value.",";
        }

        $testlist=trim($tests, ",");

        $testCredit_query = $this->db->query("SELECT SUM(credit_amount) as testCredit FROM test WHERE id IN ($testlist)");
        $testCredit_result = $testCredit_query->result();
        $testCredit=$testCredit_result[0]->testCredit;

        if($clientCredit >= $testCredit)        
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // Update Project

    public function ProjectUpdate($post) {
    	
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        if (isClient()) {
            $clientUserId = $loggedinUser;
            $masterUserId = $loggedinUser;
        } elseif (isStaff()) {
            $clientUserId = $this->session->userdata('logged_in')['client_user_id'];
            $masterUserId = $loggedinUser;
        } elseif (isMasterAdmin()) {
            $masterUserId = $loggedinUser;
            $clientUserId = 0;
        }

        if (isset($post)) {
        	$projectId = trim($post['id']);
        	$pstatus = $this->getProject($projectId)[0]->status;
            $projectData = array(
                'project_name' => trim(addslashes($post['project_name'])),
                'project_description' => trim(addslashes($post['project_description'])),
                'start_date' => trim($post['start_date']),
                'end_date' => @$_POST['open_project']=="open" ? "" : trim($post['end_date']),
                'test_list' => implode(',', $post['test_list']),
                'notification' => $_POST['notification'],
				'job_success_profile' => trim($post['job_success_profile']),
                // 'step_1_report_type' => trim($post['step_1_report_type']),
                // 'step_2_report_type' => trim($post['step_2_report_type']),
                'is_launched' => 1,
                'status' => $pstatus,
                'last_updated_by' => $loggedinUser,
                'updated_at' => getCurrentDatetime()
            );

            $candidateName = $post['full_name'];
            $candidateEmail = $post['email'];
            $candicatePhoneNo = @isset($post['phone_no']) ? $post['phone_no'] : '' ;
            $countCheck = count($candidateName);

            //Create project
            try {
                $this->db->trans_begin();
                //$projectId = trim($post['id']);
                $this->db->where('id', $projectId);
                if ($this->db->update('project', $projectData)) {
                    //Create candidate account with password and active status
                    for ($i = 0; $i < $countCheck; $i++) {
                        if (!empty($candidateEmail[$i]) && !empty($candidateName[$i])) {
                            $password = generatePassword();
                            $args = array(
                                'email' => $candidateEmail[$i],
                                'password' => $password,
                                'full_name' => $candidateName[$i],
                                'phone_no' => @$candicatePhoneNo[$i],
                                'master_user_id' => $masterUserId,
                                'client_user_id' => $clientUserId,
                                'created_by' => $loggedinUser,
                                'created_at' => getCurrentDatetime(),
                                'test_list' => implode(',', $post['test_list']),
                                'projectId' => $projectId
                            );
                            $result = $this->UpdateCandidate($args);
                            if ($result != 1) {
                                $this->db->trans_rollback();
                                return false;
                            }
                        }
                    }
                    $this->db->trans_commit();
                    return true;
                }
            } catch (Exception $e) {
                $this->db->trans_rollback();
                return false;
            }
        }
        return false;
    }

    public function UpdateCandidate($args) {
    	$projectId = $args['projectId'];
		$astatus = $this->getProject($projectId)[0]->status=="active" ? "active" : "inactive" ;
        if ($args) {
            $role = 'candidate';
            $name = $args['full_name'];
            $email = $args['email'];
            $originalPwd = $args['password'];
            $generatedPwd = md5($originalPwd);
            $phone_no = @isset($args['phone_no']) ? $args['phone_no'] : '';
            $status = $astatus;
            $masterUserId = $args['master_user_id'];
            $clientUserId = $args['client_user_id'];
            $createdBy = $args['created_by'];
            $createdAt = $args['created_at'];
            $testList = $args['test_list'];
            
            try {
                $userQuery = $this->db->query("
                    INSERT INTO 
                    user (role, email, password, full_name, phone_no, fk_project_id, status, master_user_id, client_user_id, created_by, created_at) 
                    VALUES ('$role', '$email', '$generatedPwd', '$name', '$phone_no', '$projectId', '$status', '$masterUserId', '$clientUserId', '$createdBy', '$createdAt') ");

                $candidateId = $this->db->insert_id();

                if ($candidateId) {
                    $testArray = explode(',', $testList);
                    foreach ($testArray as $test) {
                    $testInfo = $this->db->query("
                    INSERT INTO 
                    candidate_associated_test (fk_candidate_id, fk_project_id, fk_test_id, created_by, created_at) 
                    VALUES ('$candidateId', '$projectId', '$test','$createdBy', '$createdAt') ");
                    }
                    if ($testInfo) {

                    	if($this->getProject($projectId)[0]->status == "active")
                    	{
                            $from = 'noreply@assessmenthouse.com';
	                        $to = $email;
	                        $subject = 'Candidate Login Details';
	                        $emaliFilename = $this->config->item('dir_url') . "mailer/candidate-registration.php";
	                        $data = file_get_contents($emaliFilename);
	                        $loggedinUser = empty($this->session->userdata('logged_in')['username']) ? $this->session->userdata('logged_in')['full_name'] : $this->session->userdata('logged_in')['username'];
        					$loggedinemail = $this->session->userdata('logged_in')['email'];
	                        $replace = array("[%TNAME%]","[%USERNAME%]", "[%EMAIL%]", "[%PASSWORD%]", "[%TEMAIL%]");
        					$replace_with = array($loggedinUser,$name, $email, $originalPwd, $loggedinemail);
	                        // $replace = array("[%USERNAME%]", "[%EMAIL%]", "[%PASSWORD%]");
	                        // $replace_with = array($name, $email, $originalPwd);
	                        $message = str_replace($replace, $replace_with, $data);
	                        if ($this->sendRegistrationMail($to, $from, $subject, $message)) {
	                            return true;
	                        }
                    	}
                    	
                    	return true;
                    }
                }
            } catch (Exception $e) {
                return false;
            }
        }
        return false;
    }

    public function resendLogin($id)
    {
        $email_query = $this->db->query("SELECT email,full_name FROM user WHERE id=$id");
        $email_result = $email_query->result();
        $email=$email_result[0]->email;
        $name = $email_result[0]->full_name;
        $pass = generatePassword();
        $password = md5($pass);

        $loggedinUser = empty($this->session->userdata('logged_in')['username']) ? 'Master' : $this->session->userdata('logged_in')['username'];
        $loggedinemail = $this->session->userdata('logged_in')['email'];

        $this->db->trans_begin();
        
        $query=$this->db->query("UPDATE user set password='$password' WHERE id=$id");
        $to = $email;
        $from = 'noreply@assessmenthouse.com';
        $subject = 'Candidate Login Details';
        $emaliFilename = $this->config->item('dir_url') . "mailer/candidate-registration.php";
        $data = file_get_contents($emaliFilename);
        $replace = array("[%TNAME%]","[%USERNAME%]", "[%EMAIL%]", "[%PASSWORD%]", "[%TEMAIL%]");
        $replace_with = array($loggedinUser,$name, $email, $pass, $loggedinemail);

        $message = str_replace($replace, $replace_with, $data);
        if ($this->sendRegistrationMail($to, $from, $subject, $message)) {
            $this->db->trans_commit();
            return true;
        }
        $this->db->trans_rollback();
        return false;
    }
}
