<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Candidate_model extends CI_Model {

    /** constructor */
    function __construct() {
        parent::__construct();
    }

    public function getCandidateList($userId) {
        $condition = "u.role = 'candidate' AND u.status != 'deleted'";
        if (isMasterAdmin()) {
            $condition .= " AND u.master_user_id=" . $userId;
        } elseif (isClient()) {
        $condition .= " AND u.client_user_id=" . $userId;
    } elseif (isStaff()) {
    $condition .= " AND u.created_by=" . $userId;
}
        $query = $this->db->query("
            SELECT
            u.id AS candidate_id, u.full_name AS candidate_name, u.status AS candidate_status,
            client.client_name,
            client.full_name AS client_admin_name,
            p.project_name
            FROM user AS u
            LEFT JOIN project AS p ON p.id = u.fk_project_id
            LEFT JOIN user AS client ON client.id = u.client_user_id
            WHERE $condition
            ORDER BY u.id ASC
            ");
        return $query->result();
    }

//    public function getAdminParticipantList() {
//        $condition = " participant.role = 'participant' AND participant.status != 'deleted'";
//        $query = $this->db->query("
//            SELECT
//            participant.id AS participant_id, participant.full_name AS participant_name, participant.status AS participant_status,
//            ci.client_name,
//            clientadmin.full_name AS client_admin_name,
//            p.project_name
//            FROM user AS participant
//            LEFT JOIN client_info AS ci ON ci.id = participant.client_info_id
//            LEFT JOIN project AS p ON p.id = participant.fk_project_id
//            LEFT JOIN user AS clientadmin ON clientadmin.id = ci.fk_client_admin_id
//            WHERE $condition
//            ORDER BY participant.full_name ASC
//            ");
//        return $query->result();
//    }
//
//    public function getClientAdminParticipantList($clientAdminId) {
//        $condition = " p.status != 'deleted' AND p.status != 'created' AND p.is_launched = 1";
//        $condition .= " AND p.created_by = " . $clientAdminId;
//        $query = $this->db->query("
//            SELECT 
//            pat.id, pat.fk_participant_id, pat.fk_project_id, pat.status AS user_test_status,
//            p.project_name, 
//            u.full_name, u.email, u.phone_no, u.status AS participant_status
//            FROM participant_associated_test AS pat
//            INNER JOIN project AS p ON p.id = pat.fk_project_id 
//            INNER JOIN user AS u ON u.id = pat.fk_participant_id
//            WHERE $condition
//            ORDER BY u.full_name ASC
//            ");
//        return $query->result();
//    }

    public function registerDetail($post) {
        if ($post) {
            $candidateData = array(
                'id' => $post['id'],
                'full_name' => $post['full_name'],
                'marital_status' => $post['marital_status'],
                'gender' => $post['gender'],
                'age' => $post['age'],
                'nationality' => $post['nationality'],
                'id_passport_no' => $post['id_passport_no'],
                'phone_no' => $post['phone_no'],
                'home_language' => $post['home_language'],
                'current_job_title' => $post['current_job_title'],
                'working_experience' => $post['working_experience'],
                'is_update_profile' => 1,
                'last_updated_by' => $post['id'],
                'updated_at' => getCurrentDatetime(),
            );
            try {
                $this->db->where('id', $post['id']);
                $this->db->update('user', $candidateData);
                return true;
            } catch (Exception $e) {
                return false;
            }
        }
        return false;
    }

    public function getCandidateInfo($candidateId) {
        if (!empty($candidateId)) {
            $condition = "status != 'deleted' AND id = " . $candidateId;
            $query = $this->db->query("
            SELECT * FROM user 
            WHERE $condition LIMIT 1
            ");
            return $query->result();
        }
        return array();
    }

    public function updateCandidateInfo($post) {
        $loggedinUserId = $this->session->userdata('logged_in')['user_id'];
        if ($post) {
            $candidateData = array(
                'id' => $post['id'],
                'full_name' => $post['full_name'],
                'marital_status' => $post['marital_status'],
                'gender' => $post['gender'],
                'age' => $post['age'],
                'nationality' => $post['nationality'],
                'id_passport_no' => $post['id_passport_no'],
                'phone_no' => $post['phone_no'],
                'home_language' => $post['home_language'],
                'current_job_title' => $post['current_job_title'],
                'working_experience' => $post['working_experience'],
                'last_updated_by' => $loggedinUserId,
                'updated_at' => getCurrentDatetime(),
            );
            try {
                $this->db->where('id', $post['id']);
                $this->db->update('user', $candidateData);
                return true;
            } catch (Exception $e) {
                return false;
            }
        }
        return false;
    }

//    public function getMasterAdminClientId($masterAdminId) {
//        if (!empty($masterAdminId)) {
//            $condition = "role = 'client' AND status != 'deleted' AND created_by = " . $masterAdminId;
//            $query = $this->db->query("
//            SELECT id FROM user 
//            WHERE $condition
//            ");
//            return $query->result();
//        }
//        return array();
//    }

//    public function getClientStaffId($clientId) {
//        if (!empty($masterAdminId)) {
//            $condition = "role = 'staff' AND status != 'deleted' AND created_by = " . $clientId;
//            $query = $this->db->query("
//            SELECT id FROM user 
//            WHERE $condition
//            ");
//            return $query->result();
//        }
//        return array();
//    }

}

/* End of file Candidate_model.php */
/* Location: ./application/model/Candidate_model.php */
