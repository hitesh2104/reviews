<?php

if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

require_once APPPATH . 'third_party/jp_graph/jpgraph.php';
require_once APPPATH . 'third_party/jp_graph/jpgraph_radar.php';

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

	public function getFirsttime() {
		$loggedinUser = $this->session->userdata('logged_in')['user_id'];

		$query = $this->db->query("SELECT id FROM user WHERE is_update_profile=0 AND id=$loggedinUser");

		$query_result = $query->result();

		if (@$query_result[0]->id == "") {
			return false;
		} else {
			return true;
		}

	}

	public function getProjectDetails($pid, $fieldname) {
		$project_query = $this->db->query("SELECT $fieldname FROM project WHERE id=$pid");
		$project_result = $project_query->result();
		return $project_result[0]->$fieldname;
	}

	public function checkProjectEnd($catid) {
		$project_query = $this->db->query("SELECT fk_project_id FROM candidate_associated_test WHERE id=$catid");
		$project_result = $project_query->result();

		$project_details = $this->getProjectDetails($project_result[0]->fk_project_id, 'end_date');

		if ($project_details == "" || strtotime($project_details) > time()) {
			return false;
		} else {
			return true;
		}
	}

	public function getCreaditTest($pid) {
		$test_credit_query = $this->db->query("SELECT credit_amount from test where id=$pid");
		$test_credit_result = $test_credit_query->result();
		return $test_credit_result[0]->credit_amount;
	}

	public function getCombineCreaditTest($pid) {
		if (empty($pid)) {
			return 0;
		} else {
			$test_credit_query = $this->db->query("SELECT SUM(credit_amount) as total_creadit from test where id in ($pid)");
			$test_credit_result = $test_credit_query->result();
			return $test_credit_result[0]->total_creadit;
		}
	}

	public function get_MasterAdmin($uid) {
		$user_MA_query = $this->db->query("SELECT master_user_id from user where id=$uid");
		$user_MA_result = $user_MA_query->result();
		return $user_MA_result[0]->master_user_id;
	}

	public function getMasterCredit($mid) {
		$master_creadit_query = $this->db->query("SELECT credits from user where id=$mid");
		$master_credit_result = $master_creadit_query->result();
		return $master_credit_result[0]->credits;
	}

	public function creadit_varification($pid) {
		$loggedinUser = $this->session->userdata('logged_in')['user_id'];

		if ($this->session->userdata('logged_in')['role'] == "staff") {
			$loggedinUser = $this->session->userdata('logged_in')['client_user_id'];
		}

		$test_credit = $this->getCreaditTest($pid);

		$user_creadit_query = $this->db->query("SELECT credits from user where id=$loggedinUser");
		$user_credit_result = $user_creadit_query->result();
		$user_credit = $user_credit_result[0]->credits;

		if ($test_credit > $user_credit) {
			return true;
		} else {
			return false;
		}
	}

	public function updateCreadit($id) {
		$loggedinUser = $this->session->userdata('logged_in')['user_id'];

		if ($this->session->userdata('logged_in')['role'] == "staff") {
			$loggedinUser = $this->session->userdata('logged_in')['client_user_id'];
		}

		$test_credit = $this->getCreaditTest($id);
		$this->db->query("UPDATE user SET credits=credits-$test_credit WHERE id=$loggedinUser");

		return true;
	}

	public function updateCombineCreadit($id) {

		$loggedinUser = $this->session->userdata('logged_in')['user_id'];

		if ($this->session->userdata('logged_in')['role'] == "staff") {
			$loggedinUser = $this->session->userdata('logged_in')['client_user_id'];
		}

		$test_credit = $this->getCombineCreaditTest($id);
		$this->db->query("UPDATE user SET credits=credits-$test_credit WHERE id=$loggedinUser");

		return true;
	}

	public function creadit_combine_varification($pid) {
		$loggedinUser = $this->session->userdata('logged_in')['user_id'];

		if ($this->session->userdata('logged_in')['role'] == "staff") {
			$loggedinUser = $this->session->userdata('logged_in')['client_user_id'];
		}

		$test_credit = $this->getCombineCreaditTest($pid);

		$user_creadit_query = $this->db->query("SELECT credits from user where id=$loggedinUser");
		$user_credit_result = $user_creadit_query->result();
		$user_credit = $user_credit_result[0]->credits;

		if ($test_credit >= $user_credit) {
			return true;
		} else {
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
			'test12_answer' => $givenAnsString,
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

		$percenatge = number_format((($correct / 44) * 10), 0);

		$candidateTest = array(
			'test_result' => $percenatge,
			'completed_date' => getCurrentDatetime(),
			'status' => 'completed',
		);
		$this->db->where('id', $catId);
		$this->db->update('candidate_associated_test', $candidateTest);
		if ($this->send_mail($catId)) {
			return true;
		} else {
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
		if (isset($post["type"])) {
			foreach ($post["type"] as $key => $type) {
				$answer = str_replace(",", ";", @isset($post["q$key"]) ? $post["q$key"] : 0);
				array_push($givenAnsArray, $type . "_" . $answer);
			}
		}
		/*while ($i < $noQ) {
			            $i++;
			            $answer = str_replace(",", ";", @isset($post["q$i"]) ? $post["q$i"] : 0);
			            array_push($givenAnsArray, $answer);
		*/
		$givenAnsString = implode(',', $givenAnsArray);

		$userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
		$ansData = $userGivenAnswer->result();
		$testDataArray = array(
			'candidate_id' => $loggedinUser,
			'test4_answer' => $givenAnsString,
		);
		if (count($ansData) == 0) {
			$this->db->insert('test_given_answer', $testDataArray);
		} else {
			$this->db->where('candidate_id', $loggedinUser);
			$this->db->update('test_given_answer', $testDataArray);
		}

		$candidateTest = array(
			'completed_date' => getCurrentDatetime(),
			'status' => 'completed',
		);
		$this->db->where('id', $catId);
		$this->db->update('candidate_associated_test', $candidateTest);
		if ($this->send_mail($catId)) {
			return true;
		} else {
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
			'test_6answer' => $givenAnsString,
		);
		if (count($ansData) == 0) {
			$this->db->insert('test_given_answer', $testDataArray);
		} else {
			$this->db->where('candidate_id', $loggedinUser);
			$this->db->update('test_given_answer', $testDataArray);
		}

		$candidateTest = array(
			'completed_date' => getCurrentDatetime(),
			'status' => 'completed',
		);
		$this->db->where('id', $catId);
		$this->db->update('candidate_associated_test', $candidateTest);

		if ($this->send_mail($catId)) {
			return true;
		} else {
			return false;
		}
	}

	public function processTest9($post) {
		if ($post['type'] == "secA") {
			$fldname = "DST_secA";
			$noQ = 15;
		} elseif ($post['type'] == "secB") {
			$fldname = "DST_secB";
			$noQ = 10;
		} else {
			$fldname = "DST_secC";
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
			"$fldname" => $givenAnsString,
		);
		if (count($ansData) == 0) {
			$this->db->insert('test_given_answer', $testDataArray);
		} else {
			$this->db->where('candidate_id', $loggedinUser);
			$this->db->update('test_given_answer', $testDataArray);
		}

		$j = 0;

		if ($post['type'] == "secA") {
			$correct = 0;
		} else {
			$userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
			$correct = (int) $userGivenAnswer->result();
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
			'status' => 'active',
		);

		if ($post['type'] == "final") {
			$candidateTest = array();
			$percenatge = number_format((($correct / 75) * 10), 0);
			$candidateTest = array(
				'test_result' => $percenatge,
				'completed_date' => getCurrentDatetime(),
				'status' => 'completed',
			);
		}

		$this->db->where('id', $catId);
		$this->db->update('candidate_associated_test', $candidateTest);

		if ($post['type'] == "final") {
			if ($this->send_mail($catId)) {
				return true;
			} else {
				return false;
			}
		}
		return true;
	}

	public function processTest2($post) {

		if ($post['type'] == "secA") {
			$fldname = "MIRA_A";
			$noQ = 25;
		} else {
			$fldname = "MIRA_B";
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
			"$fldname" => $givenAnsString,
		);

		if (count($ansData) == 0) {
			$this->db->insert('test_given_answer', $testDataArray);
		} else {
			$this->db->where('candidate_id', $loggedinUser);
			$this->db->update('test_given_answer', $testDataArray);
		}

		if ($post['type'] == "secA") {
			$correct = 0;
		} else {
			$userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
			$correct = (int) $userGivenAnswer->row_array()['test_result'];
		}

		$j = 0;
		while ($j < $noQ) {
			if ($givenAnsArray[$j] === $correctAnsArray[$j]) {
				$correct += 1;
			}
			$j++;
		}

		$candidateTest = array(
			'test_result' => $correct,
			'completed_date' => getCurrentDatetime(),
			'status' => 'active',
		);

		if ($post['type'] == "final") {

			$candidateTest = array();

			$average = number_format((($correct / 50) * 99), 0);

			if ($average < 27) {
				$sst_score = 1;

			} elseif ($average >= 27 && $average < 36) {
				$sst_score = 2;

			} elseif ($average >= 36 && $average < 46) {
				$sst_score = 3;

			} elseif ($average >= 46 && $average < 53) {
				$sst_score = 4;

			} elseif ($average >= 53 && $average < 63) {
				$sst_score = 5;

			} elseif ($average >= 63 && $average < 78) {
				$sst_score = 6;

			} elseif ($average >= 78 && $average < 88) {
				$sst_score = 7;

			} elseif ($average >= 88) {
				$sst_score = 8;
			}

			$candidateTest = array(
				'test_result' => $sst_score,
				'completed_date' => getCurrentDatetime(),
				'status' => 'completed',
			);
		}
		$this->db->where('id', $catId);
		$this->db->update('candidate_associated_test', $candidateTest);
		if ($post['type'] == "final") {
			if ($this->send_mail($catId)) {
				return true;
			} else {
				return false;
			}
		}
		return true;
	}

	public function getLastremember($field) {
		$loggedinUser = $this->session->userdata('logged_in')['user_id'];
		$query = $this->db->query("SELECT $field FROM test_given_answer WHERE candidate_id = $loggedinUser");
		if ($query->result_array()) {
			return $query->result()[0]->$field;
		} else {
			return 0;
		}
	}

	public function getLastrememberList() {
		$loggedinUser = $this->session->userdata('logged_in')['user_id'];
		$query = $this->db->query("SELECT `answer` FROM `qanswer_sheet` WHERE `created_by` = $loggedinUser ORDER BY `questions_id`");
		return $query->result_array();

	}

	public function processTest1($post) {
		if ($post['type'] == "secA") {
			$fldname = "BECL_A";
			$noQ = 288;
		} else {
			$fldname = "BECL_B";
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
		*/
		$givenAnsString = implode(',', $post["quesAns"]);

		$userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
		$ansData = $userGivenAnswer->result();

		$testDataArray = array(
			'candidate_id' => $loggedinUser,
			"$fldname" => $givenAnsString,
		);
		if (count($ansData) == 0) {
			$this->db->insert('test_given_answer', $testDataArray);
		} else {
			$this->db->where('candidate_id', $loggedinUser);
			$this->db->update('test_given_answer', $testDataArray);
		}

		if ($post['type'] == "final") {
			$candidateTest = array();
			$percenatge = 10;

			$candidateTest = array(
				'test_result' => $percenatge,
				'completed_date' => getCurrentDatetime(),
				'status' => 'completed',
			);

			$this->db->where('id', $catId);
			$this->db->update('candidate_associated_test', $candidateTest);
		}

		if ($post['type'] == "final") {

			if ($this->send_mail($catId)) {
				return true;
			} else {
				return false;
			}
		}
		return true;
	}

	public function answertest1($post) {

		$this->db->where('created_by', $post['created_by']);
		$this->db->where('questions_id', $post['questions_id']);
		$this->db->from('qanswer_sheet');
		$query = $this->db->get();
		$rowcount = $query->num_rows();
		if ($rowcount > 0) {
			$this->db->trans_start();
			$this->db->where('created_by', $post['created_by']);
			$this->db->where('questions_id', $post['questions_id']);
			$this->db->update('qanswer_sheet', array('answer' => $post['answer'], 'total' => $post['total']));
			$this->db->trans_complete();
			if ($this->db->trans_status()) {
				return true;
			} else {
				return false;
			}
		} else {
			if ($this->db->insert('qanswer_sheet', $post)) {
				return true;
			} else {
				return false;
			}
		}

	}

	public function update_remember($test, $question, $candidate) {
		$this->db->where('candidate_id', $candidate);
		$this->db->from('test_given_answer');
		$query = $this->db->get();
		$rowcount = $query->num_rows();

		$loggedinUser = $this->session->userdata('logged_in')['user_id'];

		if ($rowcount > 0) {
			$data = array($test => $question);
			$this->db->where('candidate_id', $loggedinUser);
			$this->db->update('test_given_answer', $data);
		} else {
			$data = array($test => $question, 'candidate_id' => $candidate);
			$iquery = $this->db->insert("test_given_answer", $data);
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

		if ($post['type'] == "secA") {
			$fldname = "BECi_A";
			$noQ = 325;
		} else {
			$fldname = "BECi_B";
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
			"$fldname" => $givenAnsString,
		);
		if (count($ansData) == 0) {
			$this->db->insert('test_given_answer', $testDataArray);
		} else {
			$this->db->where('candidate_id', $loggedinUser);
			$this->db->update('test_given_answer', $testDataArray);
		}

		if ($post['type'] == "final") {
			$candidateTest = array();
			$percenatge = number_format((($correct / 40) * 10), 0);

			$candidateTest = array(
				'test_result' => $percenatge,
				'completed_date' => getCurrentDatetime(),
				'status' => 'completed',
			);
		}

		$this->db->where('id', $catId);
		$this->db->update('candidate_associated_test', $candidateTest);

		if ($post['type'] == "final") {
			if ($this->send_mail($catId)) {
				return true;
			} else {
				return false;
			}
		}
		return true;
	}

	public function processTest7($post) {
		if ($post['type'] == "secA") {
			$fldname = "Verbal_Skills_A";
			$noQ = 5;
		} elseif ($post['type'] == "secB") {
			$fldname = "Verbal_Skills_B";
			$noQ = 5;
		} elseif ($post['type'] == "secC") {
			$fldname = "Verbal_Skills_C";
			$noQ = 5;
		} elseif ($post['type'] == "secD") {
			$fldname = "Verbal_Skills_D";
			$noQ = 10;
		} else {
			$fldname = "Verbal_Skills_E";
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
			"$fldname" => $givenAnsString,
		);
		if (count($ansData) == 0) {
			$this->db->insert('test_given_answer', $testDataArray);
		} else {
			$this->db->where('candidate_id', $loggedinUser);
			$this->db->update('test_given_answer', $testDataArray);
		}

		$j = 0;

		if ($post['type'] == "secA") {
			$correct = 0;
		} else {
			$userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
			//$correct = (int)$userGivenAnswer->result();
			$correct = (int) $userGivenAnswer->row_array()['test_result'];
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
			'status' => 'active',
		);

		if ($post['type'] == "final") {
			$candidateTest = array();
			$percenatge = number_format((($correct / 34) * 10), 0);
			$candidateTest = array(
				'test_result' => $percenatge,
				'completed_date' => getCurrentDatetime(),
				'status' => 'completed',
			);
		}

		$this->db->where('id', $catId);
		$this->db->update('candidate_associated_test', $candidateTest);

		if ($post['type'] == "final") {
			if ($this->send_mail($catId)) {
				return true;
			} else {
				return false;
			}
		}
		return true;
	}

	public function processTest8($post) {

		if ($post['type'] == "secA") {
			$fldname = "Numerical_Skills_A";
			$noQ = 10;
		} elseif ($post['type'] == "secB") {
			$fldname = "Numerical_Skills_B";
			$noQ = 10;
		} elseif ($post['type'] == "secC") {
			$fldname = "Numerical_Skills_C";
			$noQ = 10;
		} else {
			$fldname = "Numerical_Skills_D";
			$noQ = 10;
		}

		$loggedinUser = $this->session->userdata('logged_in')['user_id'];
		$catId = $post['cat_id'];
		$test_id = 8;
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
			"$fldname" => $givenAnsString,
		);
		if (count($ansData) == 0) {
			$this->db->insert('test_given_answer', $testDataArray);
		} else {
			$this->db->where('candidate_id', $loggedinUser);
			$this->db->update('test_given_answer', $testDataArray);
		}

		$j = 0;

		if ($post['type'] == "secA") {
			$correct = 0;
		} else {
			$userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
			//$correct = (int)$userGivenAnswer->result();
			$correct = (int) $userGivenAnswer->row_array()['test_result'];
		}
		while ($j < $noQ) {
			if ((int) $givenAnsArray[$j] === (int) $correctAnsArray[$j]) {
				$correct += 1;
			}
			$j++;
		}

		$candidateTest = array(
			'test_result' => $correct,
			'completed_date' => getCurrentDatetime(),
			'status' => 'active',
		);

		if ($post['type'] == "final") {
			$candidateTest = array();
			$percenatge = number_format((($correct / 40) * 10), 0);
			$candidateTest = array(
				'test_result' => $percenatge,
				'completed_date' => getCurrentDatetime(),
				'status' => 'completed',
			);
		}

		$this->db->where('id', $catId);
		$this->db->update('candidate_associated_test', $candidateTest);

		if ($post['type'] == "final") {
			if ($this->send_mail($catId)) {
				return true;
			} else {
				return false;
			}
		}
		return true;
	}

	public function processTest3($post) {
		if ($post['type'] == "secA") {
			$fldname = "LAP_A";
			$score_fldname = "LAP_S_A";
			$noQ = 24;
		} elseif ($post['type'] == "secB") {
			$fldname = "LAP_B";
			$score_fldname = "LAP_S_B";
			$noQ = 24;
		} elseif ($post['type'] == "secC") {
			$fldname = "LAP_C";
			$score_fldname = "LAP_S_C";
			$noQ = 10;
		} else {
			$fldname = "LAP_D";
			$score_fldname = "LAP_S_D";
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
			"$fldname" => $givenAnsString,
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

		if ($post['type'] == "secA") {
			$percenatge = number_format((($correct / 24) * 100), 0);
			$section = 0;

			if (($percenatge > 0) && ($percenatge <= 7)) {
				$section = 1;
			} elseif (($percenatge >= 8) && ($percenatge <= 14)) {
				$section = 2;

			} elseif (($percenatge >= 15) && ($percenatge <= 22)) {
				$section = 3;

			} elseif ($percenatge >= 23 && $percenatge <= 29) {
				$section = 4;

			} elseif (($percenatge >= 30) && ($percenatge <= 36)) {
				$section = 5;

			} elseif (($percenatge >= 37) && ($percenatge <= 43)) {
				$section = 6;

			} elseif (($percenatge >= 44) && ($percenatge <= 50)) {
				$section = 7;

			} elseif (($percenatge >= 51) && ($percenatge <= 57)) {
				$section = 8;

			} elseif (($percenatge >= 58) && ($percenatge <= 65)) {
				$section = 9;

			} elseif (($percenatge >= 66) && ($percenatge <= 100)) {
				$section = 10;
			}

			$section_result = $section * 0.2;
		} elseif ($post['type'] == "secB") {
			$percenatge = number_format((($correct / 24) * 100), 0);
			$section = 0;

			if (($percenatge > 0) && ($percenatge <= 9)) {
				$section = 1;

			} elseif (($percenatge >= 10) && ($percenatge <= 17)) {
				$section = 2;

			} elseif (($percenatge >= 18) && ($percenatge <= 26)) {
				$section = 3;

			} elseif (($percenatge >= 27) && ($percenatge <= 35)) {
				$section = 4;

			} elseif (($percenatge >= 36) && ($percenatge <= 44)) {
				$section = 5;

			} elseif (($percenatge >= 45) && ($percenatge <= 52)) {
				$section = 6;

			} elseif (($percenatge >= 53) && ($percenatge <= 61)) {
				$section = 7;

			} elseif (($percenatge >= 62) && ($percenatge <= 70)) {
				$section = 8;

			} elseif (($percenatge >= 71) && ($percenatge <= 79)) {
				$section = 9;

			} elseif (($percenatge >= 80) && ($percenatge <= 100)) {
				$section = 10;
			}

			$section_result = $section * 0.3;
		} elseif ($post['type'] == "secC") {
			$percenatge = number_format((($correct / 10) * 100), 0);
			$section = 0;

			if (($percenatge > 0) && ($percenatge <= 5)) {
				$section = 1;

			} elseif (($percenatge >= 6) && ($percenatge <= 11)) {
				$section = 2;

			} elseif (($percenatge >= 12) && ($percenatge <= 16)) {
				$section = 3;

			} elseif ($percenatge >= 17 && $percenatge <= 21) {
				$section = 4;

			} elseif (($percenatge >= 22) && ($percenatge <= 27)) {
				$section = 5;

			} elseif (($percenatge >= 28) && ($percenatge <= 32)) {
				$section = 6;

			} elseif (($percenatge >= 33) && ($percenatge <= 37)) {
				$section = 7;

			} elseif (($percenatge >= 38) && ($percenatge <= 43)) {
				$section = 8;

			} elseif (($percenatge >= 44) && ($percenatge <= 48)) {
				$section = 9;

			} elseif (($percenatge >= 49) && ($percenatge <= 100)) {
				$section = 10;
			}

			$section_result = $section * 0.2;

		} else {
			$section = 0;
			$percenatge = number_format((($correct / 21) * 100), 0);

			if (($percenatge > 0) && ($percenatge <= 9)) {
				$section = 1;

			} elseif (($percenatge >= 10) && ($percenatge <= 18)) {
				$section = 2;

			} elseif (($percenatge >= 19) && ($percenatge <= 27)) {
				$section = 3;

			} elseif ($percenatge >= 28 && $percenatge <= 36) {
				$section = 4;

			} elseif ($percenatge >= 37 && $percenatge <= 45) {
				$section = 5;

			} elseif (($percenatge >= 46) && ($percenatge <= 54)) {
				$section = 6;

			} elseif (($percenatge >= 55) && ($percenatge <= 63)) {
				$section = 7;

			} elseif (($percenatge >= 64) && ($percenatge <= 72)) {
				$section = 8;

			} elseif (($percenatge >= 73) && ($percenatge <= 81)) {
				$section = 9;

			} elseif (($percenatge >= 82) && ($percenatge <= 100)) {
				$section = 10;
			}
			$section_result = $section * 0.3;
		}

		$candidateTest = array(
			$score_fldname => $section_result,
		);
		$this->db->where('candidate_id', $loggedinUser);
		$this->db->update('test_given_answer', $candidateTest);
		//xxxxxxxxxx
		// if ($post['type']=="final") {
		//     $candidateTest=array();
		//     $percenatge = number_format((($correct / 79) * 10), 0);
		//     $candidateTest = array(
		//         'test_result' => $percenatge,
		//         'completed_date' => getCurrentDatetime(),
		//         'status' => 'completed'
		//     );
		// }
		//xxxxxxxxxxxxxxxxx

		if ($post['type'] == "final") {
			$result_query = $this->db->query("SELECT LAP_S_A,LAP_S_B,LAP_S_C,LAP_S_D FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
			$result = $result_query->result();
			$section_A_result = $result[0]->LAP_S_A;
			$section_B_result = $result[0]->LAP_S_B;
			$section_C_result = $result[0]->LAP_S_C;
			$section_D_result = $result[0]->LAP_S_D;

			$average = number_format(($section_A_result + $section_B_result + $section_C_result + $section_D_result), 0);

			$candidateCompleteTest = array(
				'test_result' => $average,
				'completed_date' => getCurrentDatetime(),
				'status' => 'completed',
				'fk_candidate_id' => $loggedinUser,
			);

			$this->db->where('id', $catId);
			$this->db->update('candidate_associated_test', $candidateCompleteTest);
		}

		if ($post['type'] == "final") {
			if ($this->send_mail($catId)) {
				return true;
			} else {
				return false;
			}
		}
		return true;

	}

	public function processTest10($post) {
		//print_r($post);
		if ($post['type'] == "secA") {
			$fldname = "ECT_A";
			$noQ = 5;
		} elseif ($post['type'] == "secB") {
			$fldname = "ECT_B";
			$noQ = 5;
		} elseif ($post['type'] == "secC") {
			$fldname = "ECT_C";
			$noQ = 10;
		} else {
			$fldname = "ECT_D";
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
			"$fldname" => $givenAnsString,
		);
		if (count($ansData) == 0) {
			$this->db->insert('test_given_answer', $testDataArray);
		} else {
			$this->db->where('candidate_id', $loggedinUser);
			$this->db->update('test_given_answer', $testDataArray);
		}

		$j = 0;

		if ($post['type'] == "secA") {
			$correct = 0;
		} else {
			$userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
			//$correct = (int)$userGivenAnswer->result();
			$correct = (int) $userGivenAnswer->row_array()['test_result'];
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
			'status' => 'active',
		);

		if ($post['type'] == "final") {
			$candidateTest = array();
			$percenatge = number_format((($correct / 35) * 10), 0);
			$candidateTest = array(
				'test_result' => $percenatge,
				'completed_date' => getCurrentDatetime(),
				'status' => 'completed',
			);
		}

		$this->db->where('id', $catId);
		$this->db->update('candidate_associated_test', $candidateTest);

		if ($post['type'] == "final") {
			if ($this->send_mail($catId)) {
				return true;
			} else {
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
			'MST' => $givenAnsString,
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
			'status' => 'completed',
		);
		$this->db->where('id', $catId);
		$this->db->update('candidate_associated_test', $candidateTest);

		if ($this->send_mail($catId)) {
			return true;
		} else {
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
			'IPT' => $givenAnsString,
		);
		if (count($ansData) == 0) {
			$this->db->insert('test_given_answer', $testDataArray);
		} else {
			$this->db->where('candidate_id', $loggedinUser);
			$this->db->update('test_given_answer', $testDataArray);
		}

		$candidateTest = array(
			'completed_date' => getCurrentDatetime(),
			'status' => 'completed',
		);
		$this->db->where('id', $catId);
		$this->db->update('candidate_associated_test', $candidateTest);

		if ($this->send_mail($catId)) {
			return true;
		} else {
			return false;
		}
	}

	public function processTest14($post) {
		if ($post['type'] == "secA") {
			$fldname = "MIRA_COM_A";
			$noQ = 13;
		} else {
			$fldname = "MIRA_COM_B";
			$noQ = 11;
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
			"$fldname" => $givenAnsString,
		);

		if (count($ansData) == 0) {
			$this->db->insert('test_given_answer', $testDataArray);
		} else {
			$this->db->where('candidate_id', $loggedinUser);
			$this->db->update('test_given_answer', $testDataArray);
		}

		if ($post['type'] == "secA") {
			$correct = 0;
		} else {
			$userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
			$correct = (int) $userGivenAnswer->row_array()['test_result'];
		}

		$j = 0;
		while ($j < $noQ) {
			if ($givenAnsArray[$j] === $correctAnsArray[$j]) {
				$correct += 1;
			}
			$j++;
		}

		$candidateTest = array(
			'test_result' => $correct,
			'completed_date' => getCurrentDatetime(),
			'status' => 'active',
		);

		if ($post['type'] == "final") {

			$candidateTest = array();

			$average = number_format((($correct / 24) * 100), 0);

			if ($average > 85 && $average <= 100) {
				$sst_score = 5;
			} elseif ($average > 64 && $average <= 85) {
				$sst_score = 4;
			} elseif ($average > 46 && $average <= 64) {
				$sst_score = 3;
			} elseif ($average > 32 && $average <= 46) {
				$sst_score = 2;
			} else {
				$sst_score = 1;
			}

			$candidateTest = array(
				'test_result' => $sst_score,
				'completed_date' => getCurrentDatetime(),
				'status' => 'completed',
			);
		}
		$this->db->where('id', $catId);
		$this->db->update('candidate_associated_test', $candidateTest);
		if ($post['type'] == "final") {
			if ($this->send_mail($catId)) {
				return true;
			} else {
				return false;
			}
		}
		return true;
	}

	public function processTest15($post) {
		if ($post['type'] == "secA") {
			$fldname = "MIRA_COMX_A";
			$noQ = 13;
		} else {
			$fldname = "MIRA_COMX_B";
			$noQ = 11;
		}

		$loggedinUser = $this->session->userdata('logged_in')['user_id'];
		$catId = $post['cat_id'];

		if ($post['type'] != "final") {
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
				"$fldname" => $givenAnsString,
			);

			if (count($ansData) == 0) {
				$this->db->insert('test_given_answer', $testDataArray);
			} else {
				$this->db->where('candidate_id', $loggedinUser);
				$this->db->update('test_given_answer', $testDataArray);
			}

			if ($post['type'] == "secA") {
				$correct = 0;
			} else {
				$userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
				$correct = (int) $userGivenAnswer->row_array()['test_result'];
			}

			$j = 0;
			while ($j < $noQ) {
				if ($givenAnsArray[$j] === $correctAnsArray[$j]) {
					$correct += 1;
				}
				$j++;
			}

			$candidateTest = array(
				'test_result' => $correct,
				'completed_date' => getCurrentDatetime(),
				'status' => 'active',
			);
		}

		if ($post['type'] == "secB") {

			$candidateTest = array();

			$average = number_format((($correct / 24) * 100), 0);

			if ($average < 27) {
				$sst_score = 1;

			} elseif ($average >= 27 && $average < 36) {
				$sst_score = 2;

			} elseif ($average >= 36 && $average < 46) {
				$sst_score = 3;

			} elseif ($average >= 46 && $average < 53) {
				$sst_score = 4;

			} elseif ($average >= 53 && $average < 63) {
				$sst_score = 5;

			} elseif ($average >= 63 && $average < 78) {
				$sst_score = 6;

			} elseif ($average >= 78 && $average < 88) {
				$sst_score = 7;

			} elseif ($average >= 88) {
				$sst_score = 8;
			}

			$candidateTest = array(
				'test_result' => $sst_score,
				'completed_date' => getCurrentDatetime(),
				'status' => 'active',
			);
		}

		if ($post['type'] == "final") {

			$secResult = array(
                               'total_moves' => $post['total_moves'],
                               'total_correct' => $post['total_correct'],
                               'average_time' => round($post['average_time']) < 0 ? 0 : round($post['average_time']),
                               'block_sequence' => $post['block_sequence'],
                               'total_box_e' => $post['total_nff'],
			);

			$testDataArray = array(
				'candidate_id' => $loggedinUser,
				"MIRA_COMX_C" => json_encode($secResult),
			);

			$this->db->where('candidate_id', $loggedinUser);
			$this->db->update('test_given_answer', $testDataArray);

			$candidateTest = array(
				'test_result2' => json_encode($secResult),
				'completed_date' => getCurrentDatetime(),
				'status' => 'completed',
			);
                                  
		}

		$this->db->where('id', $catId);
		$this->db->update('candidate_associated_test', $candidateTest);
		if ($post['type'] == "final") {
			if ($this->send_mail($catId)) {
				return true;
			} else {
				return false;
			}
		}
		return true;
	}
                                  
      public function processTest16($post) {
                                  
      if ($post['type'] == "secA") {
      $fldname = "MIRA_COMX_A";
      $noQ = 13;
      } else {
      $fldname = "MIRA_COMX_B";
      $noQ = 11;
      }
      
      $loggedinUser = $this->session->userdata('logged_in')['user_id'];
      $catId = $post['cat_id'];
      
      if ($post['type'] != "final") {
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
                             "$fldname" => $givenAnsString,
                             );
      
      if (count($ansData) == 0) {
      $this->db->insert('test_given_answer', $testDataArray);
      } else {
      $this->db->where('candidate_id', $loggedinUser);
      $this->db->update('test_given_answer', $testDataArray);
      }
      
      if ($post['type'] == "secA") {
      $correct = 0;
      } else {
      $userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
      $correct = (int) $userGivenAnswer->row_array()['test_result'];
      }
      
      $j = 0;
      while ($j < $noQ) {
      if ($givenAnsArray[$j] === $correctAnsArray[$j]) {
      $correct += 1;
      }
      $j++;
      }
      
      $candidateTest = array(
                             'test_result' => $correct,
                             'completed_date' => getCurrentDatetime(),
                             'status' => 'active',
                             );
      }
      
      if ($post['type'] == "secB") {
      
      $candidateTest = array();
      
      $average = number_format((($correct / 24) * 100), 0);
      
      if ($average >= 85 && $average <= 100) {
      $sst_leval = 5;
      
      } elseif ($average >= 64 && $average < 85) {
      $sst_leval = 4;
      
      } elseif ($average >= 46 && $average < 64) {
      $sst_leval = 3;
      
      } elseif ($average >= 32 && $average < 46) {
      $sst_leval = 2;
      
      } elseif ($average >= 1 && $average < 32) {
      $sst_leval = 1;
      }
      
      if ($average < 27) {
      $sst_score = 1;
      
      } elseif ($average >= 27 && $average < 36) {
      $sst_score = 2;
      
      } elseif ($average >= 36 && $average < 46) {
      $sst_score = 3;
      
      } elseif ($average >= 46 && $average < 53) {
      $sst_score = 4;
      
      } elseif ($average >= 53 && $average < 63) {
      $sst_score = 5;
      
      } elseif ($average >= 63 && $average < 78) {
      $sst_score = 6;
      
      } elseif ($average >= 78 && $average < 88) {
      $sst_score = 7;
      
      } elseif ($average >= 88) {
      $sst_score = 8;
      }
      
      $candidateTest = array(
                             'test_result' => json_encode(['sst_score' => $sst_score, 'sst_leval' => $sst_leval]),
                             'completed_date' => getCurrentDatetime(),
                             'status' => 'active',
                             );
      }
      
      if ($post['type'] == "final") {
      
      $this->db->where('id', $catId);
      $query = $this->db->get('candidate_associated_test')->row();
      $res = json_decode($query->test_result, true);
      
      $secResult = array(
                         'sst_score' => $res['sst_score'],
                         'total_moves' => $post['total_moves'],
                         'total_correct' => $post['total_correct'],
                         'average_time' => round($post['average_time']) < 0 ? 0 : round($post['average_time']),
                         'block_sequence' => $post['block_sequence'],
                         'total_box_e' => $post['total_nff'],
                         );
      
      $testDataArray = array(
                             'candidate_id' => $loggedinUser,
                             "MIRA_COMX_C" => json_encode($secResult),
                             );
      
      $this->db->where('candidate_id', $loggedinUser);
      $this->db->update('test_given_answer', $testDataArray);
      
      $candidateTest = array(
                             'test_result' => $res['sst_leval'],
                             'test_result2' => json_encode($secResult),
                             'completed_date' => getCurrentDatetime(),
                             'status' => 'completed',
                             );
      
      }
      
      $this->db->where('id', $catId);
      $this->db->update('candidate_associated_test', $candidateTest);
      if ($post['type'] == "final") {
      if ($this->send_mail($catId)) {
      return true;
      } else {
      return false;
      }
      }
      return true;
      }
                                  
  public function processTest17($post) {
  
  if ($post['type'] == "secA") {
  $fldname = "MIRA_COMX_A";
  $noQ = 13;
  } else {
  $fldname = "MIRA_COMX_B";
  $noQ = 11;
  }
  
  $loggedinUser = $this->session->userdata('logged_in')['user_id'];
  $catId = $post['cat_id'];
  
  if ($post['type'] != "final") {
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
                         "$fldname" => $givenAnsString,
                         );
  
  if (count($ansData) == 0) {
  $this->db->insert('test_given_answer', $testDataArray);
  } else {
  $this->db->where('candidate_id', $loggedinUser);
  $this->db->update('test_given_answer', $testDataArray);
  }
  
  if ($post['type'] == "secA") {
  $correct = 0;
  } else {
  $userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
  $correct = (int) $userGivenAnswer->row_array()['test_result'];
  }
  
  $j = 0;
  while ($j < $noQ) {
  if ($givenAnsArray[$j] === $correctAnsArray[$j]) {
  $correct += 1;
  }
  $j++;
  }
  
  $candidateTest = array(
                         'test_result' => $correct,
                         'completed_date' => getCurrentDatetime(),
                         'status' => 'active',
                         );
  }
  
  if ($post['type'] == "secB") {
  
  $candidateTest = array();
  
  $average = number_format((($correct / 24) * 100), 0);
  
  if ($average >= 85 && $average <= 100) {
  $sst_leval = 5;
  
  } elseif ($average >= 64 && $average < 85) {
  $sst_leval = 4;
  
  } elseif ($average >= 46 && $average < 64) {
  $sst_leval = 3;
  
  } elseif ($average >= 32 && $average < 46) {
  $sst_leval = 2;
  
  } elseif ($average >= 1 && $average < 32) {
  $sst_leval = 1;
  }
  
  if ($average < 27) {
  $sst_score = 1;
  
  } elseif ($average >= 27 && $average < 36) {
  $sst_score = 2;
  
  } elseif ($average >= 36 && $average < 46) {
  $sst_score = 3;
  
  } elseif ($average >= 46 && $average < 53) {
  $sst_score = 4;
  
  } elseif ($average >= 53 && $average < 63) {
  $sst_score = 5;
  
  } elseif ($average >= 63 && $average < 78) {
  $sst_score = 6;
  
  } elseif ($average >= 78 && $average < 88) {
  $sst_score = 7;
  
  } elseif ($average >= 88) {
  $sst_score = 8;
  }
  
  $candidateTest = array(
                         'test_result' => json_encode(['sst_score' => $sst_score, 'sst_leval' => $sst_leval]),
                         'completed_date' => getCurrentDatetime(),
                         'status' => 'active',
                         );
  }
  
  if ($post['type'] == "final") {
  
  $this->db->where('id', $catId);
  $query = $this->db->get('candidate_associated_test')->row();
  $res = json_decode($query->test_result, true);
  
  $secResult = array(
                     'sst_score' => $res['sst_score'],
                     'total_moves' => $post['total_moves'],
                     'total_correct' => $post['total_correct'],
                     'average_time' => round($post['average_time']) < 0 ? 0 : round($post['average_time']),
                     'block_sequence' => $post['block_sequence'],
                     'total_box_e' => $post['total_nff'],
                     );
  
  $testDataArray = array(
                         'candidate_id' => $loggedinUser,
                         "MIRA_COMX_PT" => json_encode($secResult),
                         );
  
  $this->db->where('candidate_id', $loggedinUser);
  $this->db->update('test_given_answer', $testDataArray);
  
  $candidateTest = array(
                         'test_result' => $res['sst_leval'],
                         'test_result2' => json_encode($secResult),
                         'completed_date' => getCurrentDatetime(),
                         'status' => 'completed',
                         );
  
  }
  
  $this->db->where('id', $catId);
  $this->db->update('candidate_associated_test', $candidateTest);
  if ($post['type'] == "final") {
  if ($this->send_mail($catId)) {
  return true;
  } else {
  return false;
  }
  }
  return true;
	}
	
	public function processTest19($post) {
                                  
		if ($post['type'] == "secA") {
		$fldname = "mira_low_a";
		$noQ = 13;
		} else {
		$fldname = "mira_low_b";
		$noQ = 11;
		}
		
		$loggedinUser = $this->session->userdata('logged_in')['user_id'];
		$catId = $post['cat_id'];
		
		if ($post['type'] != "final") {
		$test9Anwer = $this->db->query("SELECT $fldname FROM test_answer");
		$result = $test9Anwer->result();
		$correctAnsArray = array();
		if($result[0]->$fldname) {
		$correctAnsArray = explode(',', $result[0]->$fldname);
		}
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
													 "$fldname" => $givenAnsString,
													 );
		
		if (count($ansData) == 0) {
		$this->db->insert('test_given_answer', $testDataArray);
		} else {
		$this->db->where('candidate_id', $loggedinUser);
		$this->db->update('test_given_answer', $testDataArray);
		}
		
		if ($post['type'] == "secA") {
		$correct = 0;
		} else {
		$userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
		$correct = (int) $userGivenAnswer->row_array()['test_result'];
		}
		if(!empty($correctAnsArray)) {
		$j = 0;
		while ($j < $noQ) {
		if ($givenAnsArray[$j] === $correctAnsArray[$j]) {
		$correct += 1;
		}
		$j++;
		}
	}
		
		$candidateTest = array(
													 'test_result' => $correct,
													 'completed_date' => getCurrentDatetime(),
													 'status' => 'active',
													 );
		}
		
		if ($post['type'] == "secB") {
		
		$candidateTest = array();
		$average = number_format((($correct / 24) * 100), 0);
		$sst_leval = '';
		if ($average >= 85 && $average <= 100) {
		$sst_leval = 5;
		
		} elseif ($average >= 64 && $average < 85) {
		$sst_leval = 4;
		
		} elseif ($average >= 46 && $average < 64) {
		$sst_leval = 3;
		
		} elseif ($average >= 32 && $average < 46) {
		$sst_leval = 2;
		
		} elseif ($average >= 1 && $average < 32) {
		$sst_leval = 1;
		}
		
		if ($average < 27) {
		$sst_score = 1;
		
		} elseif ($average >= 27 && $average < 36) {
		$sst_score = 2;
		
		} elseif ($average >= 36 && $average < 46) {
		$sst_score = 3;
		
		} elseif ($average >= 46 && $average < 53) {
		$sst_score = 4;
		
		} elseif ($average >= 53 && $average < 63) {
		$sst_score = 5;
		
		} elseif ($average >= 63 && $average < 78) {
		$sst_score = 6;
		
		} elseif ($average >= 78 && $average < 88) {
		$sst_score = 7;
		
		} elseif ($average >= 88) {
		$sst_score = 8;
		}
		$testDataArray = array(
			'candidate_id' => $loggedinUser,
			"mira_low_c" => $sst_score,
			);
		
		$this->db->where('candidate_id', $loggedinUser);
		$this->db->update('test_given_answer', $testDataArray);
		$candidateTest = array(
													 'test_result' => json_encode(['sst_score' => $sst_score, 'sst_leval' => $sst_leval]),
													 'completed_date' => getCurrentDatetime(),
													 'status' => 'completed',
													 );
		}
		
		$this->db->where('id', $catId);
		$this->db->update('candidate_associated_test', $candidateTest);
		if ($post['type'] == "secB") {
		if ($this->send_mail($catId)) {
		return true;
		} else {
		return false;
		}
		}
		return true;
		}

          public function processTest20($post) {
          
          if ($post['type'] == "secA") {
          
          $fldname = "Sales_Apptitute_Test";
          $noQ = 35;
          
          
          $loggedinUser = $this->session->userdata('logged_in')['user_id'];
          $catId = $post['cat_id'];
          $test_id = 16;
          $test20Anwer = $this->db->query("SELECT $fldname FROM test_answer");
          $result = $test20Anwer->result();
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
                                 "$fldname" => $givenAnsString,
                                 );
          if (count($ansData) == 0) {
          $this->db->insert('test_given_answer', $testDataArray);
          } else {
          $this->db->where('candidate_id', $loggedinUser);
          $this->db->update('test_given_answer', $testDataArray);
          }
          
          $j = 0;
          
          if ($post['type'] == "secA") {
          $correct = 0;
          }
          else {
          $userGivenAnswer = $this->db->query("SELECT test_result FROM candidate_associated_test WHERE id = '$catId' LIMIT 1");
          //$correct = (int)$userGivenAnswer->result();
          $correct = (int) $userGivenAnswer->row_array()['test_result'];
          }
          while ($j < $noQ) {
          if ((int) $givenAnsArray[$j] === (int) $correctAnsArray[$j]) {
          $correct += 1;
          }
          $j++;
          }
          
          $candidateTest = array(
                                 'test_result' => $correct,
                                 'completed_date' => getCurrentDatetime(),
                                 'status' => 'active',
                                 );
          }elseif ($post['type'] == "secB") {
          $loggedinUser = $this->session->userdata('logged_in')['user_id'];
          $catId = $post['cat_id'];
          
          $fldname = "Sales_Value_Test";
          // $noQ = 68;
          $i = 0;
          $noQ = 68;
          $givenAnsArray = array();
          //make answers array into string
          if (isset($post["types"])) {
          
          $plusall='';
          $correctanswer='';
          $curanswer1='';
          $curanswer2='';
          $curanswer3='';
          $curanswer4='';
          $curanswer5='';
          $curanswer6='';
          $curanswer7='';
          $curanswer8='';
          $curanswer9='';
          $curanswer10='';
          $curanswer11='';
          $curanswer12='';
          $curanswer13='';
          $curanswer14='';
          $curanswer15='';
          $curanswer16='';
          $curanswer17='';
          
          foreach ($post["types"] as $key => $type) {
          $answer = str_replace(",", ";", @isset($post["q$key"]) ? $post["q$key"] : 0);
          
          if ($answer==4) {
          $answer=1;
          }elseif ($answer==3) {
          $answer=2;
          }elseif ($answer==2) {
          $answer=3;
          }else{
          $answer=4;
          }
          
          if ($type=='Coachability') {
          //  echo "Coachability";
          // echo $answer.'<br>';
          $curanswer1.=$answer.',';
          }
          if ($type=='Curiosity') {
          $curanswer2.=$answer.',';
          }
          if ($type=='Prior success') {
          $curanswer3.=$answer.',';
          }
          if ($type=='Work ethic') {
          $curanswer4.=$answer.',';
          }
          if ($type=='Passion') {
          $curanswer5.=$answer.',';
          }
          if ($type=='Entrepreneurial instinct') {
          $curanswer6.=$answer.',';
          }
          if ($type=='Confidence') {
          $curanswer7.=$answer.',';
          }
          if ($type=='Enthusiasm') {
          $curanswer8.=$answer.',';
          }
          if ($type=='Resourcefulness') {
          $curanswer9.=$answer.',';
          }
          if ($type=='Trustworthy') {
          $curanswer10.=$answer.',';
          }
          if ($type=='Product knowledge') {
          $curanswer11.=$answer.',';
          }
          if ($type=='Fun') {
          $curanswer12.=$answer.',';
          }
          if ($type=='Initiative') {
          $curanswer13.=$answer.',';
          }
          if ($type=='Dealing with conflict') {
          $curanswer14.=$answer.',';
          }
          if ($type=='Financial Reward') {
          $curanswer15.=$answer.',';
          }
          if ($type=='Security') {
          $curanswer16.=$answer.',';
          }
          if ($type=='Flexibility') {
          $curanswer17.=$answer.',';
          }
          // array_push($givenAnsArray, $answer);
          }
          }
          
          $explodplusall1=explode(',', $curanswer1);
          $correctanswer.='Coachability_'.array_sum($explodplusall1).',';
          
          $explodplusall2=explode(',', $curanswer2);
          $correctanswer.='Curiosity_'.array_sum($explodplusall2).',';
          
          $explodplusall3=explode(',', $curanswer3);
          $correctanswer.='Prior success_'.array_sum($explodplusall3).',';
          
          $explodplusall4=explode(',', $curanswer4);
          $correctanswer.='Work ethic_'.array_sum($explodplusall4).',';
          
          $explodplusall5=explode(',', $curanswer5);
          $correctanswer.='Passion_'.array_sum($explodplusall5).',';
          
          $explodplusall6=explode(',', $curanswer6);
          $correctanswer.='Entrepreneurial instinct_'.array_sum($explodplusall6).',';
          
          $explodplusall7=explode(',', $curanswer7);
          $correctanswer.='Confidence_'.array_sum($explodplusall7).',';
          
          $explodplusall8=explode(',', $curanswer8);
          $correctanswer.='Enthusiasm_'.array_sum($explodplusall8).',';
          
          $explodplusall9=explode(',', $curanswer9);
          $correctanswer.='Resourcefullness_'.array_sum($explodplusall9).',';
          
          $explodplusall10=explode(',', $curanswer10);
          $correctanswer.='Trustworthy_'.array_sum($explodplusall10).',';
          
          $explodplusall11=explode(',', $curanswer11);
          $correctanswer.='Product knowledge_'.array_sum($explodplusall11).',';
          
          $explodplusall12=explode(',', $curanswer12);
          $correctanswer.='Fun_'.array_sum($explodplusall12).',';
          
          $explodplusall13=explode(',', $curanswer13);
          $correctanswer.='Initiative_'.array_sum($explodplusall13).',';
          
          $explodplusall14=explode(',', $curanswer14);
          $correctanswer.='Dealing with conflict_'.array_sum($explodplusall14).',';
          
          $explodplusall15=explode(',', $curanswer15);
          $correctanswer.='Financial Reward_'.array_sum($explodplusall15).',';
          
          $explodplusall16=explode(',', $curanswer16);
          $correctanswer.='Security_'.array_sum($explodplusall16).',';
          
          $explodplusall1=explode(',', $curanswer17);
          $correctanswer.='Flexibility_'.array_sum($explodplusall1);
          
          
          $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
          $ansData = $userGivenAnswer->result();
          $testDataArray = array(
                                 'candidate_id' => $loggedinUser,
                                 'Sales_Value_Test' => $correctanswer,
                                 );
          if (count($ansData) == 0) {
          $this->db->insert('test_given_answer', $testDataArray);
          } else {
          $this->db->where('candidate_id', $loggedinUser);
          $this->db->update('test_given_answer', $testDataArray);
          }
          
          $candidateTest = array(
                                 'completed_date' => getCurrentDatetime(),
                                 'status' => 'completed',
                                 );
          $this->db->where('id', $catId);
          $this->db->update('candidate_associated_test', $candidateTest);
          }elseif ($post['type'] == "secC") {
          $fldname = "Sales_Attribute_Test_A";
          $noQ = 54;
          
          $loggedinUser = $this->session->userdata('logged_in')['user_id'];
          $catId = $post['cat_id'];
          
          // $i = 0;
          // $givenAnsArray = array();
          //make answers array into string
          // while ($i < $noQ) {
          //     $i++;
          //     $answer = str_replace(",", ";", @isset($post["q$i"]) ? $post["q$i"] : 0);
          //     array_push($givenAnsArray, $answer);
          // }
          // $givenAnsString = implode(',', $givenAnsArray);
          $givenAnsString = implode(',', $post["most"] );
          
          $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
          $ansData = $userGivenAnswer->result();
          
          $testDataArray = array(
                                 'candidate_id' => $loggedinUser,
                                 "$fldname" => $givenAnsString,
                                 );
          if (count($ansData) == 0) {
          $this->db->insert('test_given_answer', $testDataArray);
          } else {
          $this->db->where('candidate_id', $loggedinUser);
          $this->db->update('test_given_answer', $testDataArray);
          }
          }elseif ($post['type'] == "secD") {
          $fldname = "Sales_Attribute_Test_B";
          $noQ = 54;
          
          $loggedinUser = $this->session->userdata('logged_in')['user_id'];
          $catId = $post['cat_id'];
          
          $givenAnsString = implode(',', $post["least"] );
          
          $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
          $ansData = $userGivenAnswer->result();
          
          $testDataArray = array(
                                 'candidate_id' => $loggedinUser,
                                 "$fldname" => $givenAnsString,
                                 );
          if (count($ansData) == 0) {
          $this->db->insert('test_given_answer', $testDataArray);
          } else {
          $this->db->where('candidate_id', $loggedinUser);
          $this->db->update('test_given_answer', $testDataArray);
          }
          
          $candidateTest = array(
                                 'completed_date' => getCurrentDatetime(),
                                 'status' => 'completed',
                                 );
          $this->db->where('id', $catId);
          $this->db->update('candidate_associated_test', $candidateTest);
          }elseif($post['type'] == "secE"){
          $loggedinUser = $this->session->userdata('logged_in')['user_id'];
          $catId = $post['cat_id'];
          
          $i = 0;
          $noQ = 120;
          $givenAnsArray = array();
          //make answers array into string
          if (isset($post["type1"])) {
          foreach ($post["type1"] as $key => $type) {
          $answer = str_replace(",", ";", @isset($post["q$key"]) ? $post["q$key"] : 0);
          array_push($givenAnsArray, $type . "_" . $answer);
          }
          }
          /*while ($i < $noQ) {
           $i++;
           $answer = str_replace(",", ";", @isset($post["q$i"]) ? $post["q$i"] : 0);
           array_push($givenAnsArray, $answer);
           */
          $givenAnsString = implode(',', $givenAnsArray);
          
          $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
          $ansData = $userGivenAnswer->result();
          $testDataArray = array(
                                 'candidate_id' => $loggedinUser,
                                 'sales_dip' => $givenAnsString,
                                 );
          if (count($ansData) == 0) {
          $this->db->insert('test_given_answer', $testDataArray);
          } else {
          $this->db->where('candidate_id', $loggedinUser);
          $this->db->update('test_given_answer', $testDataArray);
          }
          
          $candidateTest = array(
                                 'completed_date' => getCurrentDatetime(),
                                 'status' => 'completed',
                                 );
          $this->db->where('id', $catId);
          $this->db->update('candidate_associated_test', $candidateTest);
          }else {
          
          $loggedinUser = $this->session->userdata('logged_in')['user_id'];
          $catId = $post['cat_id'];
          
          $fldname = "open_text";
          
          
          $i = 0;
          $noQ = 12;
          $givenAnsArray = array();
          //make answers array into string
          $open_textRes = array();
          if (isset($post["open"])) {
          foreach ($post["open"] as $key => $id) {
          $answer = str_replace(",", ";", @isset($post["q$key"]) ? $post["q$key"] : 0);
          array_push($givenAnsArray, "question".$id . "=" . $answer);
          $open_textRes[$id] = $answer;
          }
          }
          
          $givenAnsString = implode(',', $givenAnsArray );
          
          $userGivenAnswer = $this->db->query("SELECT id FROM test_given_answer WHERE candidate_id = '$loggedinUser' LIMIT 1");
          $ansData = $userGivenAnswer->result();
          $testDataArray = array(
                                 'candidate_id' => $loggedinUser,
                                 'open_text' => $givenAnsString,
                                 'open_text_res' => json_encode($open_textRes),
                                 );
          
          if (count($ansData) == 0) {
          $this->db->insert('test_given_answer', $testDataArray);
          } else {
          $this->db->where('candidate_id', $loggedinUser);
          $this->db->update('test_given_answer', $testDataArray);
          }
          
          $candidateTest = array(
                                 'completed_date' => getCurrentDatetime(),
                                 'status' => 'completed',
                                 );
          $this->db->where('id', $catId);
          $this->db->update('candidate_associated_test', $candidateTest);
          }
          
          
          
          
          
          // if ($post['type'] == "final") {
          //     $candidateTest = array();
          //     $percenatge = number_format((($correct / 40) * 10), 0);
          //     $candidateTest = array(
          //         'test_result' => $percenatge,
          //         'completed_date' => getCurrentDatetime(),
          //         'status' => 'completed',
          //     );
          // }
          
          // $this->db->where('id', $catId);
          // $this->db->update('candidate_associated_test', $candidateTest);
          
          if ($post['type'] == "final") {
          if ($this->send_mail($catId)) {
          return true;
          } else {
          return false;
          }
          }
          return true;
          }
	public function getMasterTestList() {
		$loggedinUser = $this->session->userdata('logged_in')['user_id'];
		$query = $this->db->query("SELECT assign_test from user where id=$loggedinUser");
		$mt = $query->result();
		$tests = $mt[0]->assign_test;
		if (empty($tests)) {
			return "";
		} else {
			$test_query = $this->db->query("SELECT id,test_name from test where id in ($tests)");
			return $test_query->result();
		}
	}

	public function getCandidateTestList($id) {
		$test_query = $this->db->query("SELECT at.*,t.test_name,t.test_short_name from candidate_associated_test as at, test as t where fk_candidate_id=$id AND t.id=at.fk_test_id order by at.fk_test_id");
		return $test_query->result();
	}

	public function send_mail($cid) {
		$project_query = $this->db->query("SELECT p.notification as notification FROM project as p, candidate_associated_test as c WHERE c.id=$cid AND p.id=c.fk_project_id LIMIT 1");
		$project_result = $project_query->result();

		if ($project_result[0]->notification == 2) {
			return true;
		} else {
			$loggedinUser = $this->session->userdata('logged_in')['user_id'];
			$masterUser = $this->session->userdata('logged_in')['created_by'];

			$query = $this->db->query("SELECT email,phone_no,first_name,id_passport_no FROM user WHERE id=$loggedinUser");
			$query_result = $query->result();

			$master_query = $this->db->query("SELECT email,username,phone_no FROM user WHERE id=$masterUser");
			$master_result = $master_query->result();

			$from = 'noreply@assessmenthouse.com';
			$to = $master_result[0]->email;
			$subject = 'Candidate completed Test';
			$emaliFilename = $this->config->item('dir_url') . "mailer/candidate-completetest.php";
			$data = file_get_contents($emaliFilename);
			$replace = array("[%USERNAME%]", "[%CNAME%]", "[%CNUMBER%]", "[%CEMAIL%]", "[%CID%]");
			$replace_with = array($master_result[0]->username, $query_result[0]->first_name, $query_result[0]->phone_no, $query_result[0]->email, $query_result[0]->id_passport_no);
			$message = str_replace($replace, $replace_with, $data);
			if ($this->sendTestMail($to, $from, $subject, $message)) {
				return true;
			} else {
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

	public function getTestResult($test_id, $user_id) {
		$query = $this->db->query("SELECT test_result from candidate_associated_test WHERE fk_candidate_id=$user_id AND fk_test_id=$test_id");
		$query_result = $query->result_array();
		return $query_result[0]['test_result'];
	}

	public function getTestCompletedInfo($test_id, $user_id) {
		$query = $this->db->query("SELECT test_result, completed_date, status from candidate_associated_test WHERE fk_candidate_id=$user_id AND fk_test_id=$test_id");
		$query_result = $query->result_array();
		return $query_result[0];
	}

	public function getTestCode() {
		$query = $this->db->query("SELECT * FROM questions_code WHERE is_deleted = 0 ORDER BY cluster");
		return $query->result_array();

	}

	public function getAnsData($uid) {
		$query = $this->db->query("SELECT q.questions_id, q.code, qs.created_by, qs.answer, qs.total, qs.created_date FROM qanswer_sheet AS qs LEFT JOIN questions AS q ON q.questions_id = qs.questions_id AND q.is_deleted = 0 WHERE qs.is_deleted = '0' AND qs.created_by = $uid ");
		return $query->result_array();
	}

	public function getQuestionList($secName = 'A') {
		$query = $this->db->query("SELECT questions_id, item FROM questions WHERE is_deleted = '0' ");
		return $query->result_array();
	}

	public function getMiraTestResultRules() {
		$query = $this->db->query("SELECT * FROM mira_test_result_rules WHERE is_deleted = '0' ");
		return $query->result_array();
	}

	// get Candiate Id
	public function getCandidateId($test_id, $user_id) {
		$query = $this->db->query("SELECT id FROM candidate_associated_test WHERE fk_test_id=$test_id AND fk_candidate_id=$user_id");
		return $query->result_array();
	}

	// Teanamics
	public function processTest13($post) {
		$noQ = 16;
		if ($post['type'] == "secA") {
			$fldname = "test13_secA";
		} elseif ($post['type'] == "secB") {
			$fldname = "test13_secB";
		} elseif ($post['type'] == "secC") {
			$fldname = "test13_secC";
		} elseif ($post['type'] == "secD") {
			$fldname = "test13_secD";
		} elseif ($post['type'] == "secE") {
			$fldname = "test13_secE";
		} else if ($post['type'] == "secF") {
			$fldname = "test13_secF";
		} else if ($post['type'] == "secG") {
			$fldname = "test13_secG";
		} else {
			$fldname = "test13_secH";
		}

		$loggedinUser = $this->session->userdata('logged_in')['user_id'];
		$catId = $post['cat_id'];

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
			"$fldname" => $givenAnsString,
		);
		if (count($ansData) == 0) {
			$this->db->insert('test_given_answer', $testDataArray);
		} else {
			$this->db->where('candidate_id', $loggedinUser);
			$this->db->update('test_given_answer', $testDataArray);
		}

		if ($post['type'] == "final") {

			$as_query = $this->db->query("SELECT CONCAT(`test13_secA`,',',`test13_secB`,',',`test13_secC`,',',`test13_secD`,',',`test13_secE`,',',`test13_secF`,',',`test13_secG`,',',`test13_secH`) as answers FROM `test_given_answer` WHERE `candidate_id` = $loggedinUser");
			$arr_str = $as_query->result()[0]->answers;

			$score = $this->getSumArray($arr_str);

			$candidateTest = array(
				'test_result' => json_encode($score),
				'completed_date' => date("Y-m-d"),
				'status' => 'completed',
			);

			$this->db->where('id', $catId);
			$this->db->update('candidate_associated_test', $candidateTest);
		}

		if ($post['type'] == "final") {
			if ($this->send_mail($catId)) {
				return true;
			} else {
				return false;
			}
		}
		return true;
	}

	public function getSumArray($arr_str) {
		$data = array();
		$answers = explode(',', $arr_str);
		array_unshift($answers, 0);

		// A
		// $esA = array($answers['1'],$answers['23'],$answers['45']);
		// $dmA = array($answers['2'],$answers['24'],$answers['46']);
		// $ahA = array($answers['5'],$answers['27'],$answers['96']);
		// $ssA = array($answers['8'],$answers['77'],$answers['99']);
		// $acA = array($answers['9'],$answers['78'],$answers['100']);
		// $tsA = array($answers['20'],$answers['42'],$answers['64']);
		// $giA = array($answers['21'],$answers['43'],$answers['65']);
		// $ccA = array($answers['39'],$answers['61'],$answers['83']);
		// $doA = array($answers['40'],$answers['62'],$answers['84']);
		// $dtA = array($answers['58'],$answers['80'],$answers['102']);
		// $dpA = array($answers['59'],$answers['81'],$answers['103']);

		// $A = array(
		//     'The Expressive Silencer'       => array_sum($esA),
		//     'The Dependable Manipulator'    => array_sum($dmA),
		//     'The Aggressive Humbler '       => array_sum($ahA),
		//     'The Stubborn Supporter'        => array_sum($ssA),
		//     'The Appeasing Challenger'      => array_sum($acA),
		//     'The Trusting Scepticist'       => array_sum($tsA),
		//     'The Gregarious Introvert'      => array_sum($giA),
		//     'The Cautious Challenger'       => array_sum($ccA),
		//     'The Distracted Organiser'      => array_sum($doA),
		//     'The Detached Team Player'      => array_sum($dtA),
		//     'The Disorganised Perfectionist'=> array_sum($dpA)
		// );

		// arsort($A);
		// $keys_A = array_keys($A);
		// $shadow_A_1 = $A[$keys_A[0]];
		// $shadow_A_2 = $A[$keys_A[1]];

		// //print_r($A);
		// // B

		// $dtB = array($answers['11'],$answers['33'],$answers['55']);
		// $dpB = array($answers['12'],$answers['34'],$answers['56']);
		// $ccB = array($answers['14'],$answers['36'],$answers['105']);
		// $doB = array($answers['15'],$answers['37'],$answers['106']);
		// $tsB = array($answers['17'],$answers['86'],$answers['108']);
		// $giB = array($answers['18'],$answers['87'],$answers['109']);
		// $ssB = array($answers['30'],$answers['52'],$answers['74']);
		// $acB = array($answers['31'],$answers['53'],$answers['75']);
		// $ahB = array($answers['49'],$answers['71'],$answers['93']);
		// $esB = array($answers['67'],$answers['89'],$answers['111']);
		// $dmB = array($answers['68'],$answers['90'],$answers['112']);

		// $B = array(
		//     'The Detached Team Player'      => array_sum($dtB),
		//     'The Disorganised Perfectionist'=> array_sum($dpB),
		//     'The Cautious Challenger'       => array_sum($ccB),
		//     'The Distracted Organiser'      => array_sum($doB),
		//     'The Trusting Scepticist'       => array_sum($tsB),
		//     'The Gregarious Introvert'      => array_sum($giB),
		//     'The Stubborn Supporter'        => array_sum($ssB),
		//     'The Appeasing Challenger'      => array_sum($acB),
		//     'The Aggressive Humbler'        => array_sum($ahB),
		//     'The Expressive Silencer'       => array_sum($esB),
		//     'The Dependable Manipulator'    => array_sum($dmB)
		// );

		// arsort($B);
		// $BPR = array(
		//     "The Detached \nTeam Player"      => $this->potentialPrimaryDisruptor((array_sum($dtB)-(array_sum($dtA)))),
		//     "The Disorganised \nPerfectionist"=> $this->potentialPrimaryDisruptor((array_sum($dpB)-(array_sum($dpA)))),
		//     "The Cautious \nChallenger"       => $this->potentialPrimaryDisruptor((array_sum($ccB)-(array_sum($ccA)))),
		//     "The Distracted \nOrganiser"      => $this->potentialPrimaryDisruptor((array_sum($doB)-(array_sum($doA)))),
		//     "The Trusting \nScepticist"       => $this->potentialPrimaryDisruptor((array_sum($tsB)-(array_sum($tsA)))),
		//     "The Gregarious \nIntrovert"      => $this->potentialPrimaryDisruptor((array_sum($giB)-(array_sum($giA)))),
		//     "The Stubborn \nSupporter"        => $this->potentialPrimaryDisruptor((array_sum($ssB)-(array_sum($ssA)))),
		//     "The Appeasing \nChallenger"      => $this->potentialPrimaryDisruptor((array_sum($acB)-(array_sum($acA)))),
		//     "The Aggressive \nHumbler"        => $this->potentialPrimaryDisruptor((array_sum($ahB)-(array_sum($ahA)))),
		//     "The Expressive \nSilencer"       => $this->potentialPrimaryDisruptor((array_sum($esB)-(array_sum($esA)))),
		//     "The Dependable \nManipulator"    => $this->potentialPrimaryDisruptor((array_sum($dmB)-(array_sum($dmA))))
		// );

		// $BPR = array_map("abs", $BPR);
		// arsort($BPR);

		// $BPR_KEYS = array_keys($BPR);

		// $this->potentialPrimaryRole($BPR);

		// $keys_B = array_keys($B);
		// $shadow_B_1 = $B[$keys_B[0]];
		// $shadow_B_2 = $B[$keys_B[1]];

		//print_r($B);

		// D

		$DH = array($answers[1], $answers[13], $answers[16], $answers[20], $answers[23], $answers[41], $answers[58], $answers[82], $answers[88], $answers[116]);
		$DL = array($answers[37], $answers[52], $answers[64], $answers[70], $answers[74], $answers[93], $answers[96], $answers[99], $answers[125], $answers[128]);
		$IH = array($answers[4], $answers[6], $answers[11], $answers[19], $answers[40], $answers[43], $answers[49], $answers[54], $answers[84], $answers[118]);
		$IL = array($answers[30], $answers[32], $answers[34], $answers[38], $answers[62], $answers[73], $answers[76], $answers[94], $answers[101], $answers[126]);
		$SH = array($answers[2], $answers[17], $answers[22], $answers[47], $answers[50], $answers[59], $answers[81], $answers[85], $answers[115], $answers[122]);
		$SL = array($answers[25], $answers[28], $answers[35], $answers[56], $answers[67], $answers[78], $answers[87], $answers[91], $answers[106], $answers[108]);
		$CH = array($answers[10], $answers[14], $answers[44], $answers[46], $answers[61], $answers[90], $answers[111], $answers[113], $answers[119], $answers[121]);
		$CL = array($answers[8], $answers[26], $answers[65], $answers[68], $answers[71], $answers[97], $answers[104], $answers[109], $answers[112], $answers[127]);

		$B = array(
			'DH' => array_sum($DH),
			'DL' => array_sum($DL),
			'IH' => array_sum($IH),
			'IL' => array_sum($IL),
			'SH' => array_sum($SH),
			'SL' => array_sum($SL),
			'CH' => array_sum($CH),
			'CL' => array_sum($CL),
		);

		arsort($B);

		$BPR = array(
			'DH' => $this->primary_role(array_sum($DH)),
			'DL' => $this->primary_role(array_sum($DL)),
			'IH' => $this->primary_role(array_sum($IH)),
			'IL' => $this->primary_role(array_sum($IL)),
			'SH' => $this->primary_role(array_sum($SH)),
			'SL' => $this->primary_role(array_sum($SL)),
			'CH' => $this->primary_role(array_sum($CH)),
			'CL' => $this->primary_role(array_sum($CL)),
		);

		arsort($BPR);

		$BPR_KEYS = array_keys($BPR);

		$this->potentialPrimaryRole($BPR);

		$keys_B = array_keys($B);
		$shadow_B_1 = $B[$keys_B[0]];
		$shadow_B_2 = $B[$keys_B[1]];
		// END D

		// C
		$ip = array($answers['3'], $answers['27'], $answers['51'], $answers['75'], $answers['98'], $answers['123']);
		$ed = array($answers['5'], $answers['29'], $answers['53'], $answers['77'], $answers['100'], $answers['124']);
		$da = array($answers['7'], $answers['31'], $answers['55'], $answers['79'], $answers['102'], $answers['105']);
		$rc = array($answers['9'], $answers['33'], $answers['57'], $answers['80'], $answers['103'], $answers['107']);
		$cr = array($answers['12'], $answers['36'], $answers['60'], $answers['83'], $answers['86'], $answers['110']);
		$hs = array($answers['15'], $answers['21'], $answers['39'], $answers['63'], $answers['89'], $answers['114']);
		$sc = array($answers['18'], $answers['42'], $answers['45'], $answers['69'], $answers['92'], $answers['117']);
		$di = array($answers['24'], $answers['48'], $answers['66'], $answers['72'], $answers['95'], $answers['120']);

		$C = array(
			"In-house Philosopher" => array_sum($ip),
			"Elusive Solutions Director" => array_sum($ed),
			"Dream Alchemist" => array_sum($da),
			"Random Communications Planner" => array_sum($rc),
			"Customer Configuration Representative" => array_sum($cr),
			"Hyphenated-Specialist" => array_sum($hs),
			"Supreme Chaos Preventer" => array_sum($sc),
			"Dynamic Implementation Coordinator" => array_sum($di),
		);

		arsort($C);

		$CPR = array(
			"In-house \nPhilosopher" => $this->primary_role(array_sum($ip)),
			"Elusive Solutions \nDirector" => $this->primary_role(array_sum($ed)),
			"Dream \nAlchemist" => $this->primary_role(array_sum($da)),
			"Random \n Communications \nPlanner" => $this->primary_role(array_sum($rc)),
			"Customer Configuration \nRepresentative" => $this->primary_role(array_sum($cr)),
			"Hyphenated\n-Specialist" => $this->primary_role(array_sum($hs)),
			"Supreme Chaos \nPreventer" => $this->primary_role(array_sum($sc)),
			"Dynamic \n Implementation \nCoordinator" => $this->primary_role(array_sum($di)),
		);

		arsort($CPR);
		$this->PrimaryRoleGraph($CPR);

		$keys = array_keys($C);
		$data['Primary_Team_Role'] = array(str_replace("\n", "", $keys[0]), $this->primary_role($C[$keys[0]]));
		$data['Secondary_Team_Role'] = array(str_replace("\n", "", $keys[1]), $this->primary_role($C[$keys[1]]));

		$dtBA_1 = $shadow_B_1;
		$dtBA_2 = $shadow_B_2;

		$data['Potential_Primary_Disruptor'] = array(str_replace("\n", "", $BPR_KEYS[0]), $BPR["$BPR_KEYS[0]"]);
		$data['Potential_Secondary_Disruptor'] = array(str_replace("\n", "", $BPR_KEYS[1]), $BPR["$BPR_KEYS[0]"]);

		return $data;

	}

	public function primary_role($val) {
		if ($val >= 1 && $val <= 4) {return 1;}
		if ($val >= 5 && $val <= 8) {return 2;}
		if ($val >= 9 && $val <= 12) {return 3;}
		if ($val >= 13 && $val <= 16) {return 4;}
		if ($val >= 17 && $val <= 20) {return 5;}
		if ($val >= 21 && $val <= 24) {return 6;}
		if ($val >= 25 && $val <= 28) {return 7;}
		if ($val >= 29 && $val <= 32) {return 8;}
		if ($val >= 33 && $val <= 36) {return 9;}
	}

	public function potentialPrimaryDisruptor($val) {
		if ($val >= 10 && $val <= 14) {return 1;}
		if ($val >= 15 && $val <= 19) {return 2;}
		if ($val >= 20 && $val <= 24) {return 3;}
		if ($val >= 25 && $val <= 29) {return 4;}
		if ($val >= 30 && $val <= 34) {return 5;}
		if ($val >= 35 && $val <= 39) {return 6;}
		if ($val >= 40 && $val <= 44) {return 7;}
		if ($val >= 45 && $val <= 49) {return 8;}
		if ($val >= 50 && $val <= 54) {return 9;}
		if ($val >= 55 && $val <= 60) {return 10;}

	}

	public function PrimaryRoleGraph($array) {
		$inp = array_map("abs", $array);
		$loggedinUser = $this->session->userdata('logged_in')['user_id'];
		$canvas = new Imagick();
		//$canvas->newImage(600, 600, new ImagickPixel('transparent'));
		// Use the above code if you need transparent background
		$canvas->newImage(700, 399, "white");

		$sd = 0;
		$ed = 45;
		$ox = 350;
		$oy = 197;

		foreach ($inp as $label => $value) {
			$radius = 15;
			$sw = 4;
			for ($i = 0; $i < 10; $i++) {
				$color = 'grey';
				if ($value > 0) {
					if ($i < $value) {
						$color = 'rgb(9, 16, 170)';
						if ($i >= 7) {
							$color = 'rgb(204, 59, 28)';
						}
					}

				}

				$this->image_arc($canvas, $ox - $radius,
					$oy - $radius, $ox + $radius,
					$oy + $radius, $sd,
					$ed, $color, $sw);

				$radius = $radius + $sw + 5;
				$sw = $sw + 2;

				if ($i == 9) {
					//echo $label . "\n";
					//  position 1 - convert degrees to radians and get first point on perimeter of circle
					$x1 = $radius * cos($sd / 180 * 3.1416);
					$y1 = $radius * sin($sd / 180 * 3.1416);

					//  position 2 - convert degrees to radians and get second point on perimeter of circle
					$x2 = $radius * cos($ed / 180 * 3.1416);
					$y2 = $radius * sin($ed / 180 * 3.1416);
					$x = intval(($ox + $x1 + $ox + $x2) / 2) + 20;
					$y = intval(($oy + $y1 + $oy + $y2) / 2) + 20;

					if ($x <= 350) {
						$x = $x - 140;
					}
					if ($y <= 197) {
						$y = $y - 30;
					} else if ($y >= 230) {
						$y = $y - 15;
					}

					$this->add_text($canvas, $label, $x, $y);
				}
			}

			$sd = $ed;
			$ed = $ed + 45;
			//break;
		}

		//  output the image
		$canvas->setImageFormat('jpeg');
		$fileName = "/usr/www/users/assessjqbu/images/radar_graph/jp_radar_C_" . $loggedinUser . ".jpeg";

		if (file_exists($fileName)) {
			unlink($fileName);
		}

		$canvas->writeImage($fileName);
		$canvas->destroy();

		return true;
	}

	public function potentialPrimaryRole($array) {
		$inp = $array;
		$loggedinUser = $this->session->userdata('logged_in')['user_id'];

		//  create a new canvas object (transparent)
		$canvas = new Imagick();
		//$canvas->newImage(700, 395, new ImagickPixel('transparent'));
		$canvas->newImage(700, 395, "white");

		$sd = 0;
		$ed = 32.73;
		$ox = 350;
		$oy = 197;

		foreach ($inp as $label => $value) {
			$radius = 15;
			$sw = 4;
			for ($i = 0; $i < 10; $i++) {
				$color = 'grey';
				if ($value > 0) {
					if ($i < $value) {
						$color = 'rgb(9, 16, 170)';
						if ($i >= 7) {
							$color = 'rgb(204, 59, 28)';
						}
					}

				}

				$this->image_arc($canvas, $ox - $radius,
					$oy - $radius, $ox + $radius,
					$oy + $radius, $sd,
					$ed, $color, $sw);

				$radius = $radius + $sw + 3;
				$sw = $sw + 2;

				if ($i == 9) {
					//echo $label . "\n";
					//  position 1 - convert degrees to radians and get first point on perimeter of circle
					$x1 = $radius * cos($sd / 180 * 3.1416);
					$y1 = $radius * sin($sd / 180 * 3.1416);

					//  position 2 - convert degrees to radians and get second point on perimeter of circle
					$x2 = $radius * cos($ed / 180 * 3.1416);
					$y2 = $radius * sin($ed / 180 * 3.1416);
					$x = intval(($ox + $x1 + $ox + $x2) / 2) + 15;
					$y = intval(($oy + $y1 + $oy + $y2) / 2) + 20;

					if ($x <= 350) {
						$x = $x - 115;
					}
					if ($y <= 197) {
						$y = $y - 28;
					} else if ($y >= 230) {
						$y = $y - 10;
					}

					$this->add_text($canvas, $label, $x, $y);
				}
			}

			$sd = $ed;
			$ed = $ed + 32.73;
			if ($ed > 360) {
				$ed = 360;
			}

			//break;
		}

		//  output the image
		$canvas->setImageFormat('jpeg');
		$fileName = "/usr/www/users/assessjqbu/images/radar_graph/jp_radar_B_" . $loggedinUser . ".jpeg";

		if (file_exists($fileName)) {
			unlink($fileName);
		}
		$canvas->writeImage($fileName);
		$canvas->destroy();

		return true;
	}

	function image_arc(&$canvas, $sx, $sy, $ex, $ey, $sd, $ed, $color, $sw = 4) {

		$draw = new ImagickDraw();
		$draw->setFillColor(new ImagickPixel('transparent'));
		$draw->setStrokeColor($color);
		$draw->setStrokeWidth($sw);
		//echo $sx . " " . $sy  . " " . $ex . " " .$ey . " " .$sd . " " .$ed. " " . $sw . "\n";
		$draw->arc($sx, $sy, $ex, $ey, $sd + 2, $ed - 2);
		$canvas->drawImage($draw);
	}

	function add_text(&$canvas, $text, $x, $y, $angle = 0) {
		$draw = new ImagickDraw();
		$draw->setFillColor(new ImagickPixel('transparent'));
		$draw->setFillColor('black');
		//$draw->setFont('TimesNewRoman');
		$draw->setFontSize(14);
		$canvas->annotateImage($draw, $x, $y, $angle, $text);

	}

	// Test Results

	function getCandidateTestResult13($candidate_id) {
		$as_query = $this->db->query("SELECT CONCAT(`test13_secA`,',',`test13_secB`,',',`test13_secC`,',',`test13_secD`,',',`test13_secE`,',',`test13_secF`,',',`test13_secG`,',',`test13_secH`) as answers FROM `test_given_answer` WHERE `candidate_id` = $candidate_id");
		return $as_query->row();
	}

	function getCandidateTestResult1($candidate_id) {
		// $as_query = $this->db->query("SELECT `BECL_A` as answers FROM `test_given_answer` WHERE `candidate_id` = $candidate_id");
		// return $as_query->row();
		$query = $this->db->query("SELECT `answer` FROM `qanswer_sheet` WHERE `created_by` = $candidate_id ORDER BY `questions_id`");
		return $query->result_array();
	}

}

/* End of file Test_model.php */
/* Location: ./application/model/Test_model.php */
