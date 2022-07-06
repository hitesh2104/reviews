<?php

defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
ini_set('display_errors', 0);
class Test extends CI_Controller {

	/** Layout used in this controller */
	public $layout_view = 'layouts/main';

	function __construct() {
		parent::__construct();
		$this->load->helper(array('ajaxpagination', 'utility')); /** load helpers */
		$this->load->library(array('form_validation')); /** Load libraries */
		$this->load->model('Candidate_model', 'candidate'); /** Load models */
		$this->load->model('Test_model', 'test'); /** Load models */
		if (!isMasterAdmin() && !isClient() && !isStaff() && !isCandidate()) {
			/** Redirect to admin login page if not logged in or is not admin */
			return redirect('login', 'refresh');
		}
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		//$this->check_first_time();
		//$this->check_terms();
	}

	public function check_terms() {
		if ($this->candidate->check_terms()) {
			return true;
		} else {
			$this->session->set_flashdata('msg_error', 'You must agree with terms and condition to give test.');
			return redirect('test/Agree');
		}
	}

	public function Agree() {
		$post = $this->input->post();
		if ($post) {
			if ($this->candidate->terms($post)) {
				return redirect("candidate/test");
			}
		}
		$this->layout->view('test/agree');
	}

	public function check_first_time() {
		if ($this->test->getFirsttime()) {
			$this->session->set_flashdata('msg_error', 'You have to complete this section before you can commence with the tests.');
			return redirect('candidate/details');
		}
	}

	public function begin() {
		$this->check_first_time();
		$this->check_terms();
		$this->data['catId'] = $this->uri->segment(3);
		$testId = $this->uri->segment(4);
		$this->data['sacId'] = "A";
		if (!empty($testId)) {
			switch ($testId) {
			case 1:

				$this->data['last_remember'] = $this->test->getLastremember("test_10_remember");
				$this->data['remember_list'] = $this->test->getLastrememberList();
				$this->data['sectionOneArr'] = array();
				if ($this->data['last_remember'] >= 288) {
					$this->data['last_remember'] = $this->data['last_remember'] - 288;
					$this->data['sacId'] = "B";
				} else {
					$sectData = $this->test->getQuestionList('A');
					foreach ($sectData as $quest) {
						$this->data['sectionOneArr'][$quest['questions_id']] = $quest['item'];
					}
				}

				$testName = 'test1';

				break;
			case 2:
				$testName = 'test2';
				break;
			case 3:
				$testName = 'test3';
				break;
			case 4:
				$testName = 'test4';
				break;
			case 5:
				$testName = 'test5';
				break;
			case 6:
				$testName = 'test6';
				break;
			case 7:
				$testName = 'test7';
				break;
			case 8:
				$testName = 'test8';
				break;
			case 9:
				$testName = 'test9';
				break;
			case 10:
				$testName = 'test10';
				break;
			case 11:
				$testName = 'test11';
				break;
			case 12:
				$testName = 'test12';
				break;
			case 13:
				$testName = 'test13';
				break;
			case 14:
				$testName = 'test14';
				break;
			case 15:
				$testName = 'test15';
				break;
            case 16:
                $testName = 'test16';
                break;
                case 17:
                    $testName = 'test17';
                    break;
            case 18:
                    $testName = 'test18';
                    break;
                case 19:
                    $testName = 'test19';
                    break;
                case 20:
                    $testName = 'test20';
                    break;
			default:
				break;
			}

			if ($this->test->checkProjectEnd($this->data['catId'])) {
				$message = "This Project Is Expired.";
				echo "<script>alert('$message');";
				echo "window.location.href = '" . base_url() . "candidate/test'; </script>";
			} else {
				$this->layout->view('test/' . $testName, $this->data);
			}
		}
	}

	public function processTest12() {
		$post = $this->input->post();
		if (empty(isset($post['type']))) {
			$this->getTestUrl(12);
		}

		if ($post) {
			$sectionType = $post['type'];
			if ($sectionType == 'final') {
				$test = $this->test->processTest12($post);

				return redirect('test/finish');
			}
		}

	}

	public function processTest4() {
		$post = $this->input->post();
		if (empty(isset($post['type']))) {
			$this->getTestUrl(4);
		}

		if ($this->test->processTest4($post)) {

			return redirect('test/finish');
		}
	}

	public function processTest6() {
		$post = $this->input->post();
		if (empty(isset($post['type']))) {
			$this->getTestUrl(6);
		}

		$test = $this->test->processTest6($post);

		return redirect('test/finish');
	}

	public function processTest7() {
		$post = $this->input->post();
		if (empty(isset($post['type']))) {
			$this->getTestUrl(7);
		}

		// if(@$post['timeout']=="timeout")
		// {
		//     $this->data['catId'] = $this->input->post('cat_id');
		//     if($post['type']="secA")
		//         $this->data['sacId'] = "A";
		//     elseif($post['type']="secB")
		//         $this->data['sacId'] = "B";
		//     elseif($post['type']="secC")
		//         $this->data['sacId'] = "C";
		//     elseif($post['type']="secD")
		//         $this->data['sacId'] = "D";
		//     elseif($post['type']="secE")
		//         $this->data['sacId'] = "E";
		//     $this->layout->view('test/test7',$this->data);
		// }
		// else
		if ($post['type'] == "secA") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "B";
			$test = $this->test->processTest7($post);
			$this->layout->view('test/test7', $this->data);
		} elseif ($post['type'] == "secB") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "C";
			$test = $this->test->processTest7($post);
			$this->layout->view('test/test7', $this->data);
		} elseif ($post['type'] == "secC") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "D";
			$test = $this->test->processTest7($post);
			$this->layout->view('test/test7', $this->data);
		} elseif ($post['type'] == "secD") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "E";
			$test = $this->test->processTest7($post);
			$this->layout->view('test/test7', $this->data);
		} elseif ($post['type'] == "final") {
			$test = $this->test->processTest7($post);

			$this->layout->view('test/finish');
		}
	}

	public function processTest8() {
		$post = $this->input->post();
		if (empty(isset($post['type']))) {
			$this->getTestUrl(8);
		}

		// if(@$post['timeout']=="timeout")
		// {
		//     $this->data['catId'] = $this->input->post('cat_id');
		//     if($post['type']="secA")
		//         $this->data['sacId'] = "A";
		//     elseif($post['type']="secB")
		//         $this->data['sacId'] = "B";
		//     elseif($post['type']="secC")
		//         $this->data['sacId'] = "C";
		//     elseif($post['type']="secD")
		//         $this->data['sacId'] = "D";

		//     $this->layout->view('test/test8',$this->data);
		// }
		// else
		if ($post['type'] == "secA") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "B";
			$test = $this->test->processTest8($post);
			$this->layout->view('test/test8', $this->data);
		} elseif ($post['type'] == "secB") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "C";
			$test = $this->test->processTest8($post);
			$this->layout->view('test/test8', $this->data);
		} elseif ($post['type'] == "secC") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "D";
			$test = $this->test->processTest8($post);
			$this->layout->view('test/test8', $this->data);
		} elseif ($post['type'] == "final") {
			$test = $this->test->processTest8($post);

			$this->layout->view('test/finish');
		}
	}

	public function processTest3() {
		$post = $this->input->post();
		if (empty(isset($post['type']))) {
			$this->getTestUrl(3);
		}

		// if(@$post['timeout']=="timeout")
		// {
		//     $this->data['catId'] = $this->input->post('cat_id');
		//     if($post['type']="secA")
		//         $this->data['sacId'] = "A";
		//     elseif($post['type']="secB")
		//         $this->data['sacId'] = "B";
		//     elseif($post['type']="secC")
		//         $this->data['sacId'] = "C";
		//     elseif($post['type']="secD")
		//         $this->data['sacId'] = "D";

		//     $this->layout->view('test/test8',$this->data);
		// }
		// else
		if ($post['type'] == "secA") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "B";
			$test = $this->test->processTest3($post);
			$this->layout->view('test/test3', $this->data);
		} elseif ($post['type'] == "secB") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "C";
			$test = $this->test->processTest3($post);
			$this->layout->view('test/test3', $this->data);
		} elseif ($post['type'] == "secC") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "D";
			$test = $this->test->processTest3($post);
			$this->layout->view('test/test3', $this->data);
		} elseif ($post['type'] == "final") {
			$test = $this->test->processTest3($post);

			$this->layout->view('test/finish');
		}
	}

	public function processTest10() {
		$post = $this->input->post();
		if (empty(isset($post['type']))) {
			$this->getTestUrl(10);
		}

		if ($post['type'] == "secA") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "B";
			$test = $this->test->processTest10($post);
			$this->layout->view('test/test10', $this->data);
		} elseif ($post['type'] == "secB") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "C";
			$test = $this->test->processTest10($post);
			$this->layout->view('test/test10', $this->data);
		} elseif ($post['type'] == "secC") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "D";
			$test = $this->test->processTest10($post);
			$this->layout->view('test/test10', $this->data);
		} elseif ($post['type'] == "final") {
			$test = $this->test->processTest10($post);

			$this->layout->view('test/finish');
		}
	}

	public function processTest1() {
		$post = $this->input->post();
		if (empty(isset($post['type']))) {
			$this->getTestUrl(1);
		}

		if ($post['type'] == "secA") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "B";
			$test = $this->test->processTest1($post);
			$this->data['last_remember'] = $this->test->getLastremember("test_10_remember");
			$this->data['remember_list'] = $this->test->getLastrememberList();
			$this->data['sectionTwoArr'] = array();
			$sectData = $this->test->getQuestionList('B');
			foreach ($sectData as $quest) {
				$this->data['sectionTwoArr'][$quest['questions_id']] = $quest['item'];
			}

			$this->layout->view('test/test1', $this->data);
		} elseif ($post['type'] == "final") {
			$test = $this->test->processTest1($post);

			$this->layout->view('test/finish');
		}

	}

	public function answertest1() {
		$total = $_POST['total'];
		$questions = explode(",", $_POST['questions']);
		$answers = explode(",", $_POST['answers']);
		$loggedinUser = $this->session->userdata('logged_in')['user_id'];
		$candidate = $_POST['candidate_id'];
		$sacId = $_POST['sac_id'];

		$ins = [];

		for ($i = 0; $i < count($questions); $i++) {
			if ($sacId == "final") {
				$data = array('questions_id' => $questions[$i], 'answer' => $answers[$i], 'total' => $total, 'created_date' => date("Y/m/d h:i:sa"), 'created_by' => $loggedinUser);
			} else {
				$data = array('questions_id' => $questions[$i], 'answer' => $answers[$i], 'total' => $total, 'created_date' => date("Y/m/d h:i:sa"), 'created_by' => $loggedinUser);
			}

			if (!$this->test->answertest1($data)) {
				echo 0;
			}
		}

		if ($sacId == "final") {
			$qus = $questions[3];
		} else {
			$qus = $questions[3];
		}

		if (!$this->test->update_remember("test_10_remember", $qus, $candidate)) {
			echo 0;
		}

		echo 1;

	}

	// public function processTest1() {
	//     $post = $this->input->post();
	//     $test = $this->test->processTest1($post);
	//
	//     $this->layout->view('test/finish');

	// }

	public function processTest9() {
		$post = $this->input->post();
		if (empty(isset($post['type']))) {
			$this->getTestUrl(9);
		}

		if ($post['type'] == "secA") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "B";
			$test = $this->test->processTest9($post);
			$this->layout->view('test/test9', $this->data);
		}

		if ($post['type'] == "secB") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "C";
			$test = $this->test->processTest9($post);
			$this->layout->view('test/test9', $this->data);
		}

		if ($post['type'] == "final") {
			$test = $this->test->processTest9($post);

			$this->layout->view('test/finish');
		}
	}

	public function processTest2() {
		$post = $this->input->post();
		if (empty(isset($post['type']))) {
			$this->getTestUrl(2);
		}

		// if(@$post['timeout']=="timeout")
		// {
		//     $this->data['catId'] = $this->input->post('cat_id');
		//     if($post['type']="secA")
		//         $this->data['sacId'] = "A";
		//     else
		//         $this->data['sacId'] = "B";

		//     $this->layout->view('test/test2',$this->data);
		// }
		// else
		if ($post['type'] == "secA") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "B";
			$test = $this->test->processTest2($post);
			$this->layout->view('test/test2', $this->data);
		} elseif ($post['type'] == "final") {
			$test = $this->test->processTest2($post);

			$this->layout->view('test/finish');
		}
	}

	public function processTest14() {
		$post = $this->input->post();
		if (empty(isset($post['type']))) {
			$this->getTestUrl(14);
		}

		// if(@$post['timeout']=="timeout")
		// {
		//     $this->data['catId'] = $this->input->post('cat_id');
		//     if($post['type']="secA")
		//         $this->data['sacId'] = "A";
		//     else
		//         $this->data['sacId'] = "B";

		//     $this->layout->view('test/test2',$this->data);
		// }
		// else
		if ($post['type'] == "secA") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "B";
			$test = $this->test->processTest14($post);
			$this->layout->view('test/test14', $this->data);
		} elseif ($post['type'] == "final") {
			$test = $this->test->processTest14($post);

			$this->layout->view('test/finish');
		}
	}

	public function processTest15() {
		$post = $this->input->post();
		if (empty(isset($post['type']))) {
			$this->getTestUrl(2);
		}

		if ($post['type'] == "secA") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "B";
			$test = $this->test->processTest15($post);
			$this->layout->view('test/test15', $this->data);
		} elseif ($post['type'] == "secB") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "C";
			$test = $this->test->processTest15($post);
			$this->layout->view('test/test15', $this->data);
		} elseif ($post['type'] == "final") {
			$test = $this->test->processTest15($post);

			$this->layout->view('test/finish');
		}
	}

	public function processTest16() {
		$post = $this->input->post();
		if (empty(isset($post['type']))) {
			$this->getTestUrl(2);
		}

		if ($post['type'] == "secA") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "B";
			$test = $this->test->processTest16($post);
			$this->layout->view('test/test16', $this->data);
		} elseif ($post['type'] == "secB") {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = "C";
			$test = $this->test->processTest16($post);
			$this->layout->view('test/test16', $this->data);
		} elseif ($post['type'] == "final") {
			$test = $this->test->processTest16($post);

			$this->layout->view('test/finish');
		}
	}
    
    public function processTest18() {
        $post = $this->input->post();
        //echo '<pre>';print_r($post);die;
        if (empty(isset($post['type']))) {
            $this->getTestUrl(18);
        }
        if ($post['type'] == "secA") {
            $this->data['catId'] = $this->input->post('cat_id');
            $this->data['sacId'] = "B";
            $test = $this->test->processTest18($post);
            $this->layout->view('test/test18', $this->data);
        } elseif ($post['type'] == "final") {
            $test = $this->test->processTest18($post);
            $this->layout->view('test/finish');
        }
    }

    public function processTest19() {
        $post = $this->input->post();
        //echo '<pre>';print_r($post);die;
        if (empty(isset($post['type']))) {
            $this->getTestUrl(19);
        }
        if ($post['type'] == "secA") {
            $this->data['catId'] = $this->input->post('cat_id');
            $this->data['sacId'] = "B";
            $test = $this->test->processTest19($post);
            $this->layout->view('test/test19', $this->data);
        } elseif ($post['type'] == "secB") {
            $test = $this->test->processTest19($post);
            $this->layout->view('test/finish');
        }
    }
    
    public function processTest20() {
        
        
        $post = $this->input->post();
        //echo '<pre>';print_r($post);die;
        if (empty(isset($post['type']))) {
            $this->getTestUrl(20);
        }
        
        // if(@$post['timeout']=="timeout")
        // {
        //     $this->data['catId'] = $this->input->post('cat_id');
        //     if($post['type']="secA")
        //         $this->data['sacId'] = "A";
        //     elseif($post['type']="secB")
        //         $this->data['sacId'] = "B";
        //     elseif($post['type']="secC")
        //         $this->data['sacId'] = "C";
        //     elseif($post['type']="secD")
        //         $this->data['sacId'] = "D";
        
        //     $this->layout->view('test/test8',$this->data);
        // }
        // else
        if ($post['type'] == "secA") {
            $this->data['catId'] = $this->input->post('cat_id');
            $this->data['sacId'] = "B";
            $test = $this->test->processTest20($post);
            $this->layout->view('test/test20', $this->data);
        } elseif ($post['type'] == "secB") {
            $this->data['catId'] = $this->input->post('cat_id');
            $this->data['sacId'] = "C";
            $test = $this->test->processTest20($post);
            $this->layout->view('test/test20', $this->data);
        } elseif ($post['type'] == "secC") {
            $this->data['catId'] = $this->input->post('cat_id');
            $this->data['sacId'] = "D";
            $test = $this->test->processTest20($post);
            $this->layout->view('test/test20', $this->data);
        }
        // elseif ($post['type'] == "secD") {
        //     // $this->data['catId'] = $this->input->post('cat_id');
        //     $test = $this->test->processTest20($post);
        //     $this->layout->view('test/finish');
        // }
        
        
        elseif ($post['type'] == "secD") {
            $this->data['catId'] = $this->input->post('cat_id');
            $this->data['sacId'] = "E";
            $test = $this->test->processTest20($post);
            $this->layout->view('test/test20', $this->data);
        }
        
        elseif ($post['type'] == "secE") {
            
            $this->data['catId'] = $this->input->post('cat_id');
            $this->data['sacId'] = "F";
            $test = $this->test->processTest20($post);
            $this->layout->view('test/test20', $this->data);
        }
        
        
        elseif ($post['type'] == "final") {
            $this->data['catId'] = $this->input->post('cat_id');
            $test = $this->test->processTest20($post);
            $this->layout->view('test/finish');
        }        
        
    }
    
	public function processTest5() {
		$post = $this->input->post();
		if (empty(isset($post['type']))) {
			$this->getTestUrl(5);
		}

		$test = $this->test->processTest5($post);

		return redirect('test/finish');
	}

	public function processTest11() {
		$post = $this->input->post();
		if (empty(isset($post['type']))) {
			$this->getTestUrl(11);
		}

		$test = $this->test->processTest11($post);

		return redirect('test/finish');
	}

	public function finish() {
		$this->layout->view('test/finish');
	}

	public function getTestUrl($testid) {
		$loggedinUser = $this->session->userdata('logged_in')['user_id'];
		$id = $this->test->getCandidateId($testid, $loggedinUser)[0]['id'];
		$testUrl = "http://www.assessmenthouse.co.za/test/begin/" . $id . "/" . $testid;
		return redirect($testUrl);
	}

	// Teanamics

	public function processTest13() {
		$post = $this->input->post();

		if (isset($post['previous'])) {
			$this->data['catId'] = $this->input->post('cat_id');
			$this->data['sacId'] = $post['previous'];
			$this->layout->view('test/test13', $this->data);
		} else {

			if ($post['type'] == "secA") {
				$this->data['catId'] = $this->input->post('cat_id');
				$this->data['sacId'] = "B";
				$test = $this->test->processTest13($post);
				$this->layout->view('test/test13', $this->data);
			} elseif ($post['type'] == "secB") {
				$this->data['catId'] = $this->input->post('cat_id');
				$this->data['sacId'] = "C";
				$test = $this->test->processTest13($post);
				$this->layout->view('test/test13', $this->data);
			} elseif ($post['type'] == "secC") {
				$this->data['catId'] = $this->input->post('cat_id');
				$this->data['sacId'] = "D";
				$test = $this->test->processTest13($post);
				$this->layout->view('test/test13', $this->data);
			} elseif ($post['type'] == "secD") {
				$this->data['catId'] = $this->input->post('cat_id');
				$this->data['sacId'] = "E";
				$test = $this->test->processTest13($post);
				$this->layout->view('test/test13', $this->data);
			} elseif ($post['type'] == "secE") {
				$this->data['catId'] = $this->input->post('cat_id');
				$this->data['sacId'] = "F";
				$test = $this->test->processTest13($post);
				$this->layout->view('test/test13', $this->data);
			} elseif ($post['type'] == "secF") {
				$this->data['catId'] = $this->input->post('cat_id');
				$this->data['sacId'] = "G";
				$test = $this->test->processTest13($post);
				$this->layout->view('test/test13', $this->data);
			} elseif ($post['type'] == "secG") {
				$this->data['catId'] = $this->input->post('cat_id');
				$this->data['sacId'] = "H";
				$test = $this->test->processTest13($post);
				$this->layout->view('test/test13', $this->data);
			} elseif ($post['type'] == "final") {
				$test = $this->test->processTest13($post);
				$this->layout->view('test/finish');
			}
		}
	}

}
