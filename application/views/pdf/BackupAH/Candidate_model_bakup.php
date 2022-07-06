<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Candidate_model extends CI_Model {

	/** constructor */
	function __construct() {
		parent::__construct();
	}

	public function getCandidateList($userId, $test_id) {

		$condition = "u.role = 'candidate' AND u.status != 'deleted'";
		if (isMasterAdmin()) {
			$condition .= " AND (u.master_user_id=" . $userId . " OR
            u.client_user_id IN (SELECT id from user where master_user_id= " . $userId . " AND role = 'client'))";

		} elseif (isClient()) {
			$condition .= " AND u.client_user_id=" . $userId;
		} elseif (isStaff()) {
			$condition .= " AND u.created_by=" . $userId;
		}

		$test_query = " ";
		$test_left = " ";
		if ($test_id != "") {
			$test_left = " LEFT JOIN candidate_associated_test as mc ON u.id = mc.fk_candidate_id ";
			$test_query = " AND find_in_set($test_id,fk_test_id) <> 0 ";
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
            $test_left
            WHERE $condition $test_query
            ORDER BY u.id DESC
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
	//            ORDER BY participant.full_name DESC
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
	//            ORDER BY u.full_name DESC
	//            ");
	//        return $query->result();
	//    }

	public function registerDetail($post) {
		if ($post) {

			$candidateData = array(
				'id' => $post['id'],
				'full_name' => @$post['full_name'],
				'first_name' => @$post['first_name'],
				//'middle_name' => $post['middle_name'],
				'last_name' => @$post['last_name'],
				'marital_status' => @$post['marital_status'],
				'gender' => @$post['gender'],
				'age' => @$post['age'],
				'nationality' => @$post['nationality'],
				'dob' => @$post['dob'],
				'ethnicity' => @$post['ethnicity'],
				'heighest_education' => @$post['heighest_education'],
				'employment_status' => @$post['employment_status'],
				'id_passport_no' => @$post['id_passport_no'],
				'phone_no' => @$post['phone_no'],
				'home_language' => @$post['home_language'],
				'current_job_level' => @$post['current_job_level'],
				//'current_job_title' => $post['current_job_title'],
				//'working_experience' => $post['working_experience'],
				'is_update_profile' => 1,
				'last_updated_by' => @$post['id'],
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

	public function getCandidateTestList($candidateId) {
		if (!empty($candidateId)) {
			$condition = "status != 'deleted' AND fk_candidate_id = " . $candidateId;
			$query = $this->db->query("
            SELECT GROUP_CONCAT(fk_test_id) as test_list FROM candidate_associated_test
            WHERE $condition
            ");
			return $query->result();
		}
		return "";
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

	public function update_test($id) {
		$query = $this->db->query("SELECT test_result from user WHERE id=$id");
		$query_result = $query->result_array();

		$crs = $query_result[0]['test_result'];

		$cra = explode(",", $crs);

		$post = $_POST;
		$update_test = "";
		$cr = array();
		foreach ($post as $key => $value) {
			if ($value == "no" && $key != "exc_summary") {
				$update_test .= $key . ",";

				while (($i = array_search($key, $cra)) !== false) {
					unset($cra[$i]);
				}
			}
		}

		$ucr = implode(",", $cra);

		$update_test = rtrim($update_test, ",");

		$this->db->query("UPDATE user SET test_result='$update_test' WHERE id=$id");

		if (!empty($update_test)) {
			$this->db->query("UPDATE candidate_associated_test SET status='active', updated_at=NOW(), test_result='', completed_date='' WHERE fk_candidate_id=$id AND fk_test_id in ($update_test)");
		}
		return true;
	}

	//
	public function check_terms() {
		$userId = $this->session->userdata('logged_in')['user_id'];
		$query = $this->db->query("SELECT id FROM user_agreement WHERE user_id=$userId");
		$query_result = $query->result();
		if (@$query_result[0]->id == "") {
			return false;
		} else {
			return true;
		}
	}

	public function terms($post) {
		$userId = $this->session->userdata('logged_in')['user_id'];
		if(array_key_exists('ackno3', $post)) {
			$ackno3 = $post['ackno3'];
		} else {
			$ackno3 = '0';
		}
		
		$this->db->query("INSERT INTO user_agreement(user_id, role, agreement_1, agreement_2, agreement_3, agreement_4, name, id_passport_no) VALUES ($userId,$post[usedfor],$post[ackno1],$post[ackno2],$ackno3,$post[ackno4],'$post[acknow_name]', '$post[acknow_passport]')");
		return true;
	}

	public function checkTest($testId, $userId) {
		$query = $this->db->query("SELECT test_result FROM user WHERE find_in_set('$testId',test_result) AND id = $userId");
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function updateTestList($testId, $userId) {
		$query = $this->db->query("SELECT test_result FROM user WHERE id = $userId");
		$result = $query->result();
		$new_test_result = "";
		if (empty($result[0]->test_result)) {
			$new_test_result = $testId;
		} else {
			$new_test_result = $result[0]->test_result . ',' . $testId;
		}

		$update_query = $this->db->query("UPDATE user SET test_result = '$new_test_result' WHERE id = $userId");
		return true;

	}

// Result

	public function getCorrResult3_2($uid) {
		$result_query = $this->db->query("SELECT LAP_S_A,LAP_S_B,LAP_S_C,LAP_S_D FROM test_given_answer WHERE candidate_id=" . $uid);
		$result = $result_query->result();
		return $result;
	}

	public function getCorrResult3($uid) {
		$Cquery = $this->db->query("SELECT `LAP_A`,`LAP_B`,`LAP_C`,`LAP_D` FROM `test_answer`");

		$Gquery = $this->db->query("SELECT`LAP_A`,`LAP_B`,`LAP_C`,`LAP_D` FROM `test_given_answer` WHERE `candidate_id` = $uid");

		$data = array();
		$data['corr'] = $Cquery->result_array();
		$data['give'] = $Gquery->result_array();

		return $data;
	}

	public function getCorrResult4($uid) {
		$Gquery = $this->db->query("SELECT `test4_answer` FROM `test_given_answer` WHERE `candidate_id` = $uid");
		return $Gquery->result_array();
	}

	public function getCorrResult5($uid) {
		$Gquery = $this->db->query("SELECT `IPT` FROM `test_given_answer` WHERE `candidate_id` = $uid");
		return $Gquery->result_array();
	}

	public function getCorrResult6($uid) {
		$Gquery = $this->db->query("SELECT `test_6answer` FROM `test_given_answer` WHERE `candidate_id` = $uid");
		return $Gquery->result_array();
	}

	public function getCorrResult9($uid) {
		$Cquery = $this->db->query("SELECT `DST_secA`,`DST_secB`,`DST_secC` FROM `test_answer`");

		$Gquery = $this->db->query("SELECT`DST_secA`,`DST_secB`,`DST_secC` FROM `test_given_answer` WHERE `candidate_id` = $uid");

		$data = array();
		$data['corr'] = $Cquery->result_array();
		$data['give'] = $Gquery->result_array();

		return $data;
	}

	public function getCorrResult12($uid) {
		$Cquery = $this->db->query("SELECT `test12_answer` FROM `test_answer`");

		$Gquery = $this->db->query("SELECT`test12_answer` FROM `test_given_answer` WHERE `candidate_id` = $uid");

		$data = array();
		$data['corr'] = $Cquery->result_array();
		$data['give'] = $Gquery->result_array();

		return $data;
	}

	public function getCorrResult13($uid) {
		$Gquery = $this->db->query("SELECT test_result FROM `candidate_associated_test` WHERE `fk_candidate_id` = $uid AND `fk_test_id` = 13");
		$data = $Gquery->result()[0]->test_result;
		return $data;
	}

	// manage executive summary
	public function update_summary($summary, $uid) {
		$array = array('exc_summary' => $summary);

		$this->db->where('id', $uid);
		$this->db->update('user', $array);
		return true;
	}

	public function select_summary($uid) {
		$query = $this->db->query("SELECT exc_summary FROM user WHERE id=$uid");
		$query_result = $query->result_array();

		return $query_result[0]['exc_summary'];
	}
                                      
  public function salesAptitudeTest($user_id){
  $output = array();
  
  $query= $this->db->query("SELECT `LAP_S_A`, `LAP_S_B`, `LAP_S_C`, `LAP_S_D`, `Sales_Value_Test`, `Sales_Apptitute_Test`, `Sales_Attribute_Test_A`, `Sales_Attribute_Test_B`,`open_text`,`open_text_res`,`candidate_id`,`sales_dip` FROM `test_given_answer` WHERE `candidate_id` = '$user_id' AND `LAP_S_A` != '' AND `LAP_S_B` != '' AND `LAP_S_C` != '' AND `LAP_S_D` != '' AND `Sales_Value_Test` != '' AND `Sales_Apptitute_Test` != '' AND `Sales_Attribute_Test_A` != '' AND `Sales_Attribute_Test_B` != '' AND `open_text` != '' AND `open_text_res` != '' AND `sales_dip` != ''");
  //$query= $this->db->query("SELECT `LAP_S_A`, `LAP_S_B`, `LAP_S_C`, `LAP_S_D`, `Sales_Value_Test`, `Sales_Apptitute_Test`, `Sales_Attribute_Test_A`, `Sales_Attribute_Test_B`,`open_text`,`open_text_res` FROM `test_given_answer` WHERE `candidate_id` = '$user_id' AND `Sales_Value_Test` != '' AND `Sales_Apptitute_Test` != '' AND `Sales_Attribute_Test_A` != '' AND `Sales_Attribute_Test_B` != ''");
  $query_result = $query->result_array();
  return $query_result;
  }
  
  public function lapTestScore($user_id){
  return $this->db->query("SELECT test_result FROM candidate_associated_test where fk_candidate_id= '$user_id' AND fk_test_id = 3")->row_array()['test_result'];
  }

	//

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
