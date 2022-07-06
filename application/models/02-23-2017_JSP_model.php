<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class JSP_model extends CI_Model {

    /** constructor */
    function __construct() {
        parent::__construct();
    }
	
	// Get JSP list
    public function getJspList() {
		$loggedIn = $this->session->userdata('logged_in');
        $loggedinUser = $loggedIn['user_id'];
        $query = $this->db->query("
            SELECT j.jsp_id, j.job_title, j.job_family, j.created_at, j.status
            FROM job_success_profile AS j
            WHERE j.status != 'deleted' AND (j.created_by = $loggedinUser OR
            j.created_by IN (SELECT id from user where master_user_id= ".$loggedinUser." AND role = 'client') OR client_user_id In (SELECT id from user WHERE master_user_id= ".$loggedinUser." AND role = 'client'))
            ORDER BY j.created_at DESC
            ");
        return $query->result();
    }

	// Get tCompetency list
    public function getCompetencyList() {
        $query = $this->db->query("
            SELECT code, competency, definition
            FROM questions_code
            WHERE is_deleted = 0
			ORDER BY competency ASC ");
        return $query->result_array();
    }
	
	// Get jsp data
    public function getJSPData($jspId) {
        $query = $this->db->query("
            SELECT *
            FROM job_success_profile
            WHERE status != 'deleted' AND jsp_id = $jspId ");
		$row = $query->result_array();
        return $row[0];
    }	

	// Add / edit JSP
    public function addEditJSP($post) {
		$loggedIn = $this->session->userdata('logged_in');
        $loggedinUser = $loggedIn['user_id'];
        $masterUserId = $loggedIn['master_user_id'];
        if (isClient()) {
            $clientUserId = $loggedinUser;
            $masterUserId = $loggedinUser;
        } elseif (isStaff()) {
            $clientUserId = $loggedIn['client_user_id'];
            $masterUserId = $loggedinUser;
        } elseif (isMasterAdmin()) {
            $masterUserId = $loggedinUser;
            $clientUserId = 0;
        }
        if (isset($post)) {
            $jspData = array(
                'job_title' => trim(addslashes($post['job_title'])),
                'job_family' => trim(addslashes($post['job_family'])),
                'level_of_gomplexity' => trim($post['level_of_gomplexity']),
                'impact_competencies' => implode(',', $post['impact_competencies']),
                'impact_competencies_counter' => trim($post['impact_competencies_counter']),
                'important_competencies' => implode(',', $post['important_competencies']),
                'important_competencies_counter' => trim($post['important_competencies_counter']),
                'status' => 'active'
            );
			$jspId = $post['jspId'];
            try {
                $this->db->trans_begin();
				if($jspId == 0){
					$jspData['master_user_id'] = $masterUserId;
					$jspData['client_user_id'] = $clientUserId;
					$jspData['created_by'] = $loggedinUser;
					$jspData['created_at'] = getCurrentDatetime();	
									
					if ($this->db->insert('job_success_profile', $jspData)) {
						$jspId = $this->db->insert_id();
						$this->db->trans_commit();
						return true;
					}
				}else{
					$jspData['last_updated_by'] = $loggedinUser;
					$jspData['updated_at'] = getCurrentDatetime();					

					$this->db->where('jsp_id', $jspId);
					if ($this->db->update('job_success_profile', $jspData)) {
						$this->db->trans_commit();
						return true;
					}
				}
            } catch (Exception $e) {
                $this->db->trans_rollback();
                return false;
            }
        }
        return false;
    }
	
	// Create clone 
	public function createClone($jspId) {
		$loggedIn = $this->session->userdata('logged_in');
        $loggedinUser = $loggedIn['user_id'];
        $masterUserId = $loggedIn['master_user_id'];
        if (isClient()) {
            $clientUserId = $loggedinUser;
            $masterUserId = $loggedinUser;
        } elseif (isStaff()) {
            $clientUserId = $loggedIn['client_user_id'];
            $masterUserId = $loggedinUser;
        } elseif (isMasterAdmin()) {
            $masterUserId = $loggedinUser;
            $clientUserId = 0;
        }
        if (!empty($jspId)) {
			$jspOldData = $this->getJSPData($jspId);
			
            $jspData = array(
                'job_title' => $jspOldData['job_title'],
                'job_family' => $jspOldData['job_family'],
                'level_of_gomplexity' => $jspOldData['level_of_gomplexity'],
                'impact_competencies' => $jspOldData['impact_competencies'],
                'impact_competencies_counter' => $jspOldData['impact_competencies_counter'],
                'important_competencies' => $jspOldData['important_competencies'],
                'important_competencies_counter' => $jspOldData['important_competencies_counter'],
                'status' => $jspOldData['status']
            );

            try {
                $this->db->trans_begin();
				$jspData['master_user_id'] = $masterUserId;
				$jspData['client_user_id'] = $clientUserId;
				$jspData['created_by'] = $loggedinUser;
				$jspData['created_at'] = getCurrentDatetime();	
								
				if ($this->db->insert('job_success_profile', $jspData)) {
					$jspId = $this->db->insert_id();
					$this->db->trans_commit();
					return $jspId;
				}
            } catch (Exception $e) {
                $this->db->trans_rollback();
                return false;
            }
        }
        return false;
    }

	// Add new record for JSP dropdown
    public function addNewData($post) {
		$loggedIn = $this->session->userdata('logged_in');
        $loggedinUser = $loggedIn['user_id'];
        $masterUserId = $loggedIn['master_user_id'];
        if (isClient()) {
            $clientUserId = $loggedinUser;
            $masterUserId = $loggedinUser;
        } elseif (isStaff()) {
            $clientUserId = $loggedIn['client_user_id'];
            $masterUserId = $loggedinUser;
        } elseif (isMasterAdmin()) {
            $masterUserId = $loggedinUser;
            $clientUserId = 0;
        }
        if (isset($post)) {
            $jspData = array(
                'job_family' => trim(addslashes($post['job_family'])),
                'job_title' => trim(addslashes(!empty($post['job_title'])?$post['job_title']:'NA')),
                'status' => 'active'
            );
            try {
                $this->db->trans_begin();
				$jspData['master_user_id'] = $masterUserId;
				$jspData['client_user_id'] = $clientUserId;
				$jspData['created_by'] = $loggedinUser;
				$jspData['created_at'] = getCurrentDatetime();	
								
				if ($this->db->insert('jsp_family_data', $jspData)) {
					$id = $this->db->insert_id();
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
	
	// Get role list by family
    public function getRoleListByFamily($post) {
		$loggedIn = $this->session->userdata('logged_in');
        $loggedinUser = $loggedIn['user_id'];
        $query = $this->db->query("
            SELECT j.id, j.job_family, j.job_title, j.created_at, j.status
            FROM jsp_family_data AS j
            WHERE j.status != 'deleted' AND j.job_title != 'NA' AND j.job_family LIKE '".$post['job_family']."' AND (j.created_by = $loggedinUser OR
            j.created_by IN (SELECT id from user WHERE master_user_id= ".$loggedinUser." AND role = 'client') OR client_user_id In (SELECT id from user WHERE master_user_id= ".$loggedinUser." AND role = 'client'))
            ORDER BY j.created_at DESC
            ");
        return $query->result_array();
    }		 
	
	// Get family list
    public function getFamilyList() {
		$loggedIn = $this->session->userdata('logged_in');
        $loggedinUser = $loggedIn['user_id'];
        $query = $this->db->query("
            SELECT j.id, j.job_family, j.job_title, j.created_at, j.status
            FROM jsp_family_data AS j
            WHERE j.status != 'deleted' AND (j.created_by = $loggedinUser OR
            j.created_by IN (SELECT id from user WHERE master_user_id= ".$loggedinUser." AND role = 'client') OR client_user_id In (SELECT id from user WHERE master_user_id= ".$loggedinUser." AND role = 'client'))
			GROUP BY j.job_family
            ORDER BY j.created_at DESC
            ");
        return $query->result_array();
    }	

	// Get family title list
    public function getFamilyTitleList() {
		$loggedIn = $this->session->userdata('logged_in');
        $loggedinUser = $loggedIn['user_id'];
        $query = $this->db->query("
            SELECT CONCAT(j.job_family, ' (', j.job_title, ')') AS  job_family, j.jsp_id, j.status
            FROM job_success_profile AS j
            WHERE j.status != 'deleted' AND (j.created_by = $loggedinUser OR
            j.created_by IN (SELECT id from user WHERE master_user_id= ".$loggedinUser." AND role = 'client') OR client_user_id In (SELECT id from user WHERE master_user_id= ".$loggedinUser." AND role = 'client'))
			GROUP BY j.job_family
            ORDER BY j.job_family
            ");
			
        return $query->result_array();
    }	
			
	// Check job title in jsp table
    public function checkJobTitle($post, $isClone) {
		$loggedIn = $this->session->userdata('logged_in');
        $loggedinUser = $loggedIn['user_id'];
		$post['jspId'] = ($isClone == 0)?$post['jspId']:0;
		$query = $this->db->query("
            SELECT j.jsp_id, j.job_title, j.job_family
            FROM job_success_profile AS j
            WHERE j.status != 'deleted' AND j.created_by = $loggedinUser AND j.job_family like '".$post['job_family']."' 
				AND j.job_title like '".$post['job_title']."' AND j.jsp_id != ".$post['jspId']);
        return $query->result();
    }		
	
	// Get jsp data
    public function getJSPDataByFamilyRoleName($family = '', $role = '') {
        $query = $this->db->query("
            SELECT *
            FROM job_success_profile
            WHERE status != 'deleted' AND job_family LIKE '".$family."' AND job_title LIKE '".$role."' ");
		$row = $query->result_array();
        return $row[0];
    }		
	
	// Get JSP dropdown data
    public function old_getDropdownData() {
		$loggedIn = $this->session->userdata('logged_in');
        $loggedinUser = $loggedIn['user_id'];
        $query = $this->db->query("
            SELECT j.id, j.name, j.type, j.created_at, j.status
            FROM jsp_default_data AS j
            WHERE j.status != 'deleted' AND (j.created_by = $loggedinUser OR
            j.created_by IN (SELECT id from user where master_user_id= ".$loggedinUser." AND role = 'client') OR client_user_id In (SELECT id from user WHERE master_user_id= ".$loggedinUser." AND role = 'client'))
            ORDER BY j.created_at DESC
            ");
        return $query->result();
    }	

	
 
}
