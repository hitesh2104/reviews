<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model {

    /** constructor */
    function __construct() {
        parent::__construct();
    }

    public function getClientCountByMasterAdmin($masterAdminId) {
        $query = $this->db->query("
            SELECT count(*) AS count
            FROM user
            WHERE status != 'deleted' AND role = 'client' AND created_by = $masterAdminId
            ");
        $result = $query->result();
        if (!empty($result)) {
            return $result[0]->count;
        }
        return false;
    }

    public function getRegisteredCandidateCount() {
        $query = $this->db->query("
            SELECT count(*) AS count
            FROM user
            WHERE status != 'deleted' AND role = 'candidate'
            ");
        $result = $query->result();
        if (!empty($result)) {
            return $result[0]->count;
        }
        return false;
    }

    public function getTotalProjectCreated() {
        $query = $this->db->query("
            SELECT count(*) AS count
            FROM project
            WHERE status != 'deleted'
            ");
        $result = $query->result();
        if (!empty($result)) {
            return $result[0]->count;
        }
        return false;
    }

    public function getMasterAdminCredits($masterAdminId) {
        $query = $this->db->query("
            SELECT credits
            FROM user
            WHERE status != 'deleted' AND role = 'master-admin' AND id = $masterAdminId 
            LIMIT 1");
        $result = $query->result();
        if (!empty($result)) {
            return $result[0]->credits;
        }
        return false;
    }

    public function getProjectCountByCreator($creatorId) {
        $query = $this->db->query("
            SELECT count(*) AS count
            FROM project
            WHERE status != 'deleted' 
            AND created_by = $creatorId
            ");
        $result = $query->result();
        if (!empty($result)) {
            return $result[0]->count;
        }
        return false;
    }

    public function getTotalCandidateRegisteredByCreator($creatorId) {
        $query = $this->db->query("
            SELECT count(*) AS count
            FROM user
            WHERE status != 'deleted' 
            AND role = 'candidate' 
            AND created_by = $creatorId
            ");
        $result = $query->result();
        if (!empty($result)) {
            return $result[0]->count;
        }
        return false;
    }

    public function getTotalStaffByClient($clientId) {
        $query = $this->db->query("
            SELECT count(*) AS count
            FROM user
            WHERE status != 'deleted' 
            AND role = 'staff' 
            AND created_by = $clientId
            ");
        $result = $query->result();
        if (!empty($result)) {
            return $result[0]->count;
        }
        return false;
    }

    public function getClientAdminCredits($clientAdminId) {
        $query = $this->db->query("
            SELECT credits
            FROM user
            WHERE status != 'deleted' AND role = 'client-admin' AND id = $clientAdminId
            ");
        $result = $query->result();
        if (!empty($result)) {
            return $result[0]->credits;
        }
        return false;
    }

    public function getMasterAdminCount() {
        $query = $this->db->query("
            SELECT count(*) AS count
            FROM user
            WHERE status != 'deleted' AND role = 'master-admin'
            ");
        $result = $query->result();
        if (!empty($result)) {
            return $result[0]->count;
        }
        return false;
    }

    public function getIncommingCreditRequestCount($userId) {
        $query = $this->db->query("
            SELECT count(c.id) AS count
            FROM credit_request as c
            INNER JOIN user AS u ON u.id = c.fk_user_id
            WHERE c.status = 'active' 
            AND u.status != 'deleted' 
            AND c.fk_request_to_user_id = $userId
            ");
        $result = $query->result();
        if (!empty($result)) {
            return $result[0]->count;
        }
        return false;
    }
    
    public function getUserAvailableCredit($userId) {
        $query = $this->db->query("
            SELECT credits
            FROM user
            WHERE status != 'deleted'
            AND id = $userId
            ");
        $result = $query->result();
        if (!empty($result)) {
            return $result[0]->credits;
        }
        return false;
    }
    
    public function getRegisteredCandidate($projectId) {
        $query = $this->db->query("
            SELECT count(*) AS count
            FROM user
            WHERE status = 'active' AND role = 'candidate' AND fk_project_id = $projectId   
            ");
        $result = $query->result();
        if (!empty($result)) {
            return $result[0]->count;
        }
        return false;
    }
    
    public function getTotalTestCompleted($projectId) {
        $query = $this->db->query("
            SELECT count(*) AS count
            FROM candidate_associated_test
            WHERE status = 'completed' AND fk_project_id = $projectId
            ");
        $result = $query->result();
        if (!empty($result)) {
            return $result[0]->count;
        }
        return false;
    }

    public function getMyAccount($Id)
    {
        $query = $this->db->query("
            SELECT *
            FROM user
            WHERE id='$Id'
            ");
        return $query->result();
    }

    public function changePassword($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data);
        return true;
    }

    public function check_password($id,$old_password)
    {
        $this->db->where('id', $id);
        $this->db->where('password', $old_password);
        
        $query = $this->db->get('user');

        if($query->num_rows() > 0)
            return 1;
        else
            return 0;   
     }
	 
    public function getJSPCountByCreator($creatorId) {
        $query = $this->db->query("
            SELECT count(*) AS count
            FROM job_success_profile
            WHERE status != 'deleted' 
            AND created_by = $creatorId
            ");
        $result = $query->result();
        if (!empty($result)) {
            return $result[0]->count;
        }
        return false;
    }	 

}

/* End of file Common_model.php */
/* Location: ./application/model/Common_model.php */
