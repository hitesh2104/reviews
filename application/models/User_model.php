<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    /** constructor */
    function __construct() {
        parent::__construct();
    }

    public function saveMasterAdmin($post) {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        if (isset($post)) {
            $role = 'master-admin';
            $fullName = trim(addslashes($post['full_name']));
            $username = trim($post['username']);
            $email = trim($post['email']);
            $phoneNo = trim($post['phone_no']);
            $credits = trim($post['credits']);
            $originalPassword = generatePassword();
            $password = md5($originalPassword);
            $tests="";
            
            foreach ($post['test_list'] as $value) {
                $tests.=$value.",";
            }

            $testlist=trim($tests, ",");

            $createdAt = getCurrentDatetime();
            $this->db->trans_begin();
            $userQuery = $this->db->query("
                    INSERT INTO 
                    user (role, username, email, password, full_name, phone_no, credits,assign_test, created_by, created_at) 
                    VALUES ('$role', '$username', '$email', '$password', '$fullName', '$phoneNo', '$credits', '$testlist' ,'$loggedinUser', '$createdAt') ");

            /** SEND MAIL HERE */
            ini_set('allow_url_fopen',1);
            $from = 'noreply@assessmenthouse.com';
            $to = $email;
            $subject = 'AssessmentHouse Master Administrator Login';
            $emaliFilename = $this->config->item('dir_url') . "mailer/masteradmin-registration.php";
            $data = file_get_contents($emaliFilename);
            $replace = array("[%USERNAME%]", "[%EMAIL%]", "[%PASSWORD%]");
            $replace_with = array($fullName, $email, $originalPassword);
            $message = str_replace($replace, $replace_with, $data);
            if ($this->sendRegistrationMail($to, $from, $subject, $message)) {
                $this->db->trans_commit();
                return true;
            }
            $this->db->trans_rollback();
        }
        return false;
    }

    public function updateMasterAdmin($post) {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        if (isset($post)) {
            $masterAdminId = $post['id'];
            $fullName = trim(addslashes($post['full_name']));
            $phoneNo = trim($post['phone_no']);
            $credits = trim($post['credits']);
            $tests="";
            
            foreach ($post['test_list'] as $value) {
                $tests.=$value.",";
            }

            $testlist=trim($tests, ",");

            $userData = array(
                'full_name' => $fullName,
                'phone_no' => $phoneNo,
                'credits' => $credits,
                'assign_test' => $testlist,
                'last_updated_by' => $loggedinUser,
                'updated_at' => getCurrentDatetime()
            );
            $this->db->where('id', $masterAdminId);
            $this->db->update('user', $userData);
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $this->db->query("UPDATE user set status='deleted' WHERE id=$id");
        return true;
    }

    public function saveClient($post) {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        if (isset($post)) {
            $role = 'client';
            $fullName = trim(addslashes($post['full_name']));
            $email = trim($post['email']);
            $phoneNo = trim($post['phone_no']);
            $originalPassword = generatePassword();
            $password = md5($originalPassword);
            $clientName = trim(addslashes($post['client_name']));
            $accountEmail = trim($post['account_email']);
            $vatTaxNo = trim(addslashes($post['vat_tax_no']));
            $companyAddress = trim(addslashes($post['company_address']));
            $credits = trim($post['credits']);
            $createdAt = getCurrentDatetime();
            //$this->db->trans_begin();

            $tests="";
            
            foreach ($post['test_list'] as $value) {
                $tests.=$value.",";
            }

            $testlist=trim($tests, ",");

            $userQuery = $this->db->query("
                    INSERT INTO 
                    user (role, email, password, full_name, phone_no, client_name, account_email, vat_tax_no, company_address, credits,assign_test, master_user_id, created_by, created_at) 
                    VALUES ('$role', '$email', '$password', '$fullName', '$phoneNo', '$clientName', '$accountEmail', '$vatTaxNo', '$companyAddress', '$credits', '$testlist', '$loggedinUser', '$loggedinUser', '$createdAt') ");
            if ($userQuery) {

                // creadit update

                $credit_query=$this->db->query("UPDATE user SET credits=credits-$credits WHERE id = $loggedinUser");

                $mastername=$this->session->userdata('logged_in')['username'];
                $masteremail = $this->session->userdata('logged_in')['email'];

                /** SEND MAIL HERE */
                $from = 'noreply@assessmenthouse.com';
                $to = $email;
                $subject = 'AssessmentHouse Client Administrator Login';
                $emaliFilename = $this->config->item('dir_url') . "mailer/client-registration.php";
                $data = file_get_contents($emaliFilename);               
                $replace = array("[%USERNAME%]", "[%EMAIL%]", "[%PASSWORD%]", "[%MUSERNAME%]", "[%MEMAIL%]");
                $replace_with = array($fullName, $email, $originalPassword,$mastername,$masteremail);
                $message = str_replace($replace, $replace_with, $data);
                if ($this->sendRegistrationMail($to, $from, $subject, $message)) {
                    //$this->db->trans_commit();
                    return true;
                }
            }
            //$this->db->trans_rollback();
        }
        return false;
    }

    public function updateClient($post) {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        if (isset($post)) {
            $clientId = $post['id'];
            $fullName = trim(addslashes($post['full_name']));
            $phoneNo = trim($post['phone_no']);
            $clientName = trim(addslashes($post['client_name']));
            $accountEmail = trim($post['account_email']);
            $vatTaxNo = trim(addslashes($post['vat_tax_no']));
            $companyAddress = trim(addslashes($post['company_address']));
            $credits = trim($post['credits']);
            $tests="";
            
            foreach ($post['test_list'] as $value) {
                $tests.=$value.",";
            }

            $testlist=trim($tests, ",");

            $userData = array(
                'full_name' => $fullName,
                'phone_no' => $phoneNo,
                'client_name' => $clientName,
                'account_email' => $accountEmail,
                'vat_tax_no' => $vatTaxNo,
                'company_address' => $companyAddress,
                'assign_test' => $testlist,
                'last_updated_by' => $loggedinUser,
                'updated_at' => getCurrentDatetime()
            );
            $this->db->where('id', $clientId);
            $this->db->update('user', $userData);
            return true;
        }
        return false;
    }
    
    public function createStaff($post) {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $masterUserId = $this->session->userdata('logged_in')['master_user_id'];
        if ($post) {
            $originalPassword = generatePassword();
            $password = md5($originalPassword);
            $tests="";
            foreach ($post['test_list'] as $value) {
                $tests.=$value.",";
            }

            $testlist=trim($tests, ",");
            $staffData = array(
                'role' => 'staff',
                'full_name' => $post['full_name'],
                'email' => $post['email'],
                'password' => $password,
                'phone_no' => $post['phone_no'],
                'assign_test' => $testlist,
                'master_user_id' => $masterUserId,
                'client_user_id' => $loggedinUser,
                'created_by' => $loggedinUser,
                'created_at' => getCurrentDatetime(),
            );
            try {
                $this->db->trans_begin();
                if ($this->db->insert('user', $staffData)) {
                    /** SEND MAIL HERE */
                    $mastername=$this->session->userdata('logged_in')['username'];
                    $masteremail = $this->session->userdata('logged_in')['email'];
                    $from = 'noreply@assessmenthouse.com';
                    
                    $to = $post['email'];
                    $subject = 'AssessmentHouse Test Administrator Login';
                    $emaliFilename = $this->config->item('dir_url') . "mailer/staff-registration.php";
                    $data = file_get_contents($emaliFilename);
                    $replace = array("[%USERNAME%]", "[%EMAIL%]", "[%PASSWORD%]", "[%CNAME%]", "[%CEMAIL%]");
                    $replace_with = array($post['full_name'], $post['email'], $originalPassword, $mastername, $masteremail);
                    $message = str_replace($replace, $replace_with, $data);
                    if ($this->sendRegistrationMail($to, $from, $subject, $message)) {
                        $this->db->trans_commit();
                        return true;
                    }
                    $this->db->trans_rollback();
                    return false;
                }
            } catch (Exception $e) {
                return false;
            }
        }
        return false;
    }
    
    public function updateStaff($post) {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        if (isset($post)) {
            $tests="";
            foreach ($post['test_list'] as $value) {
                $tests.=$value.",";
            }

            $testlist=trim($tests, ",");
            $userData = array(
                'full_name' => trim(addslashes($post['full_name'])),
                'phone_no' => trim($post['phone_no']),
                'assign_test' => $testlist,
                'last_updated_by' => $loggedinUser,
                'updated_at' => getCurrentDatetime()
            );
            $this->db->where('id', $post['id']);
            $this->db->update('user', $userData);
            return true;
        }
        return false;
    }

    public function getTestList()
    {
        $query=$this->db->query("SELECT id,test_name from test where status='active'");
        return $query->result();
    }

    public function getMasterTestList()
    {
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $query = $this->db->query("SELECT assign_test from user where id=$loggedinUser");
        $mt=$query->result();
        $tests=$mt[0]->assign_test;
        // $tests=arraymap("intval",explode(",",$mt[0]->assign_test));

        // for ($i=0; $i < count($tests) ; $i++) { 
            
        // }

        $test_query = $this->db->query("SELECT id,test_name from test where id in ($tests)");
        return $test_query->result();
    }

    public function getMasterAdmintList() {
        $query = $this->db->query("
            SELECT id, full_name, username, email, phone_no, credits, status
            FROM user 
            WHERE role = 'master-admin' 
            AND status != 'deleted' 
            ORDER BY id DESC
            ");
        return $query->result();
    }

    public function getMasterAdminClientList($creatorId) {
        $query = $this->db->query("
            SELECT id, full_name, username, email, phone_no, credits, client_name, status
            FROM user 
            WHERE role = 'client' 
            AND status != 'deleted'
            AND created_by = $creatorId
            ORDER BY id DESC
            ");
        return $query->result();
    }
    
    public function getClientStaffList($creatorId) {
        $query = $this->db->query("
            SELECT id, full_name, username, email, phone_no, credits, status
            FROM user
            WHERE role = 'staff' 
            AND status != 'deleted'
            AND created_by = $creatorId
            ORDER BY id DESC
            ");
        return $query->result();
    }

    public function getUser($userId) {
        if (!empty($userId)) {
            $condition = " status != 'deleted' AND id = " . $userId;
            $query = $this->db->query("
            SELECT *
            FROM user
            WHERE $condition LIMIT 1
            ");
            return $query->result();
        }
        return array();
    }
    

    public function sendRegistrationMail($to, $from, $subject, $message) {
        
        $from='assessmenthouse@gmail.com';
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->from($from,'assessmenthouse'); // change it to yours
        $this->email->to($to); // change it to yours
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        }
        show_error($this->email->print_debugger());die();
        return false;
    }

    public function check_creadit()
    {
        $credits=$_GET['credits'];
        $loggedinUser = $this->session->userdata('logged_in')['user_id'];
        $query = $this->db->query("SELECT credits from user WHERE id=$loggedinUser");
        $query_result = $query->result();

        $master_creadit = $query_result[0]->credits;
        
        if($master_creadit >= $credits)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function getUserList(){
        $query = $this->db->query("
            SELECT id, role, full_name, username, email, phone_no, credits, client_name, status
            FROM user 
            WHERE status != 'deleted'
            AND role != 'system-admin'
            ORDER BY full_name DESC
            ");
        return $query->result();
    }

    public function check_email()
    {
        $email = $_GET['useremail'];
        $query=$this->db->query("SELECT id from user WHERE email='$email' AND role != 'system-admin' AND role != 'candidate'");
        
        if($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function resendLogin($id)
    {
        $email_query = $this->db->query("SELECT email FROM user WHERE id=$id");
        $email_result = $email_query->result();
        $email=$email_result[0]->email;
        $pass = generatePassword();
        $password = md5($pass);

        $this->db->trans_begin();
        
        $query=$this->db->query("UPDATE user set password='$password' WHERE id=$id");

        $from = 'noreply@assessmenthouse.com';
        $to = $email;
        $subject = 'New Login Details';
        $emaliFilename = $this->config->item('dir_url') . "mailer/user-forgotpassword.php";
        $data = file_get_contents($emaliFilename);
        $replace = array("[%USERNAME%]", "[%PASSWORD%]");
        $replace_with = array($email, $pass);
        $message = str_replace($replace, $replace_with, $data);
        if ($this->sendRegistrationMail($to, $from, $subject, $message)) {
            $this->db->trans_commit();
            return true;
        }
        $this->db->trans_rollback();
        return false;
    }

    public function forgot_password()
    {
        $email = $_POST['useremail'];
        $check_query=$this->db->query("SELECT status FROM user WHERE email = '$email' ");
        $check_result=$check_query->result();
        $status = $check_result[0]->status;
       
        if($status == "active")
        {
                $pass = generatePassword();
                $password = md5($pass);

                $this->db->trans_begin();
                
                $query=$this->db->query("UPDATE user set password='$password' WHERE email = '$email' ");

                $from = 'noreply@assessmenthouse.com';
                $to = $email;
                $subject = 'Forgot Login Details';
                $emaliFilename = $this->config->item('dir_url') . "mailer/user-forgotpassword.php";
                $data = file_get_contents($emaliFilename);
                $replace = array("[%USERNAME%]", "[%PASSWORD%]");
                $replace_with = array($email, $pass);
                $message = str_replace($replace, $replace_with, $data);
                if ($this->sendRegistrationMail($to, $from, $subject, $message)) {
                    $this->db->trans_commit();
                    return true;
                }
                $this->db->trans_rollback();
                return false;
            }
            else{
            return "inactive";
        }
        }


        

}

/* End of file User_model.php */
    /* Location: ./application/model/User_model.php */
    