<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Credit_model extends CI_Model {

    /** constructor */
    function __construct() {
        parent::__construct();
    }

    public function sendCreditRequest($post) {
        if (isset($post)) {
            $loggedinUser = $this->session->userdata('logged_in')['user_id'];
            $requestTo = $this->session->userdata('logged_in')['created_by'];
            $userId = $loggedinUser;
            $creditRequest = trim($post['credit_request']);
            $createdAt = getCurrentDatetime();
            $userQuery = $this->db->query("
                    INSERT INTO 
                    credit_request (fk_user_id, credit_request, fk_request_to_user_id, created_at) 
                    VALUES ('$userId', '$creditRequest', '$requestTo','$createdAt') ");
            if ($userQuery) {

                $master_query=$this->db->query("SELECT username,email FROM user WHERE id=$requestTo");
                $master_result = $master_query->result();
                $name = $master_result[0]->username;
                $email  = $master_result[0]->email;

                $from = 'noreply@assessmenthouse.com';
                $to = $email;
                $subject = 'New Credit Request';
                $emaliFilename = $this->config->item('base_url') . "mailer/credit_request.php";
                $data = file_get_contents($emaliFilename);
                $replace = array("[%USERNAME%]");
                $replace_with = array($name);
                $message = str_replace($replace, $replace_with, $data);
                if ($this->sendRegistrationMail($to, $from, $subject, $message)) {
                    return true;
                }


                return true;
            }
        }
        return false;
    }

    public function approveCreditRequest($post) {
        if (isset($post)) {
            $loggedinUser = $this->session->userdata('logged_in')['user_id'];
            $creditRequestId = trim($post['credit_request_id']);
            $creditApproved = trim($post['credit_approved']);
            $data = array(
                'credit_approved' => $creditApproved,
                'status' => 'approved',
                'last_updated_by' => $loggedinUser,
                'updated_at' => getCurrentDatetime()
            );
            $this->db->where('id', $creditRequestId);
            $this->db->update('credit_request', $data);

            
            $userId = $this->getCreditRequestedUserId($creditRequestId);
            $this->db->set('credits', "credits+$creditApproved", FALSE);
            $this->db->set('last_updated_by', $loggedinUser);
            $this->db->set('updated_at', getCurrentDatetime());
            $this->db->where('id', $userId);
            $this->db->update('user');
            
            if($this->session->userdata('logged_in')['role'] != "system-admin")
            {
                $this->db->set('credits', "credits-$creditApproved", FALSE);
                $this->db->where('id', $loggedinUser);
                $this->db->update('user');
            }

            return true;
        }
        return false;
    }

    public function declineCreditRequest($post) {
        if (isset($post)) {
            $loggedinUser = $this->session->userdata('logged_in')['user_id'];
            $creditRequestId = trim($post['credit_request_id']);
            $data = array(
                'status' => 'declined',
                'last_updated_by' => $loggedinUser,
                'updated_at' => getCurrentDatetime()
            );
            $this->db->where('id', $creditRequestId);
            $this->db->update('credit_request', $data);
            return true;
        }
        return false;
    }

    public function getCreditRequestList($userId) {
        $query = $this->db->query("
            SELECT c.id, c.credit_request, c.credit_approved, c.status, c.created_at,
            u.full_name, u.email, u.phone_no
            FROM credit_request AS c 
            INNER JOIN user AS u ON u.id = c.fk_user_id
            WHERE /* c.status = 'active' 
            AND u.status != 'deleted' 
            AND */ c.fk_request_to_user_id = $userId
            ORDER BY c.id DESC
            ");
        return $query->result();
    }

    public function getRequestedCreditList($userId) {
        $query = $this->db->query("
            SELECT id, credit_request, credit_approved, status, created_at
            FROM credit_request
            WHERE status != 'deleted' 
            AND fk_user_id = $userId
            ORDER BY id DESC
            ");
        return $query->result();
    }

    public function getCreditRequestByMasterAdmin($masterAdminId) {
        $query = $this->db->query("
            SELECT c.id, c.credit_request, c.credit_approved, c.status, c.created_at
            u.full_name, u.email, u.phone_no
            FROM credit_request AS c 
            INNER JOIN user AS u ON u.id = c.fk_user_id
            WHERE c.status != 'deleted' 
            AND u.status != 'deleted' 
            AND c.fk_request_to_user_id = $masterAdminId
            ORDER BY c.id DESC
            ");
        return $query->result();
    }
    
    public function getCreditRequestedUserId($requestId){
        $query = $this->db->query("
            SELECT fk_user_id
            FROM credit_request
            WHERE id = $requestId
            LIMIT 1
            ");
        $result = $query->result();
        if (!empty($result)) {
           return $result[0]->fk_user_id;
        }
        return false;
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

/* End of file Credit.php */
    /* Location: ./application/model/Credit.php */
    