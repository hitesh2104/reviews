<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . "/third_party/PHPExcel/PHPExcel.php";
class Candidate extends CI_Controller {

	/** Layout used in this controller */
	public $layout_view = 'layouts/main';

	function __construct() {
		parent::__construct();
		$this->load->helper(array('ajaxpagination', 'utility')); /** load helpers */
		$this->load->library(array('form_validation')); /** Load libraries */
		$this->load->model('Candidate_model', 'candidate'); /** Load models */
		$this->load->model('JSP_model', 'jsp'); /** Load models */
		$this->load->model('Project_model', 'project'); /** Load models */
		$this->load->model('Test_model', 'test'); /** Load models */
		if (!isMasterAdmin() && !isClient() && !isStaff() && !isCandidate()) {
			/** Redirect to admin login page if not logged in or is not admin */
			return redirect('login', 'refresh');
		}
	}

	public function index() {
		$this->layout->view('candidate');
	}

	public function managecandidate() {
		$this->layout->view('candidate');
	}

	public function candidate_details($idd) {
		if (is_numeric($idd)) {
			$this->someProblem();
		}

		$id = base64_decode($idd);

		if (!is_numeric($id)) {
			$this->someProblem();
		}

		$this->data['general_details'] = $this->candidate->getCandidateInfo($id);

		if (empty($this->data['general_details'])) {
			$this->someProblem();
		}

		$this->data['projectData'] = $this->project->getProject($this->data['general_details'][0]->fk_project_id);
		$this->data['test_details'] = $this->test->getCandidateTestList($id);
		$this->layout->view('candidate_open', $this->data);
	}

	public function Personality_Teanamics_Validation_Old() {

		$project_id = 365;
		$project_candidate_data = $this->project->getProjectCandidate($project_id);
		$result = array();

		$profile = array('Name', 'Age', 'Marital status', 'Gender', 'Language', 'Working experience', 'Job level', 'Highest qualification', 'Ethnicity');
		$bt_1_qus = getBECIQuestions();
		$bt_13_qus = getTenamicsQuestions();
		$Heading_arr = array_merge($profile, $bt_1_qus, $bt_13_qus);
		foreach ($project_candidate_data as $ckey => $candidate) {
			$id = $candidate->id;

			$this->data['general_details'] = $this->candidate->getCandidateInfo($id);
			$this->data['test_details'] = $this->test->getCandidateTestList($id);
			$bt_1_arr = [];
			$bt_13_arr = [];

			foreach ($this->data['test_details'] as $key => $test_row) {

				if (($test_row->fk_test_id == 1 && $test_row->status == 'completed') || ($test_row->fk_test_id == 13 && $test_row->status == 'completed')) {

					$bt_1_res = @$this->test->getCandidateTestResult1($id)->answers;
					if (!empty($bt_1_res)) {
						$bt_1_res = explode(',', $bt_1_res);
					}
					foreach ($bt_1_qus as $key => $row) {
						$bt_1_arr[$row] = @$bt_1_res[$key];
					}

					$bt_13_res = @$this->test->getCandidateTestResult13($id)->answers;
					if (!empty($bt_13_res)) {
						$bt_13_res = explode(',', $bt_13_res);
					}
					foreach ($bt_13_qus as $key => $row) {
						$bt_13_arr[$row] = @$bt_13_res[$key];
					}
				}
			}

			if (!empty($bt_1_arr) || !empty($bt_13_arr)) {
				$this->data['ptv']['Profile'] = array(
					'Name' => $this->data['general_details'][0]->full_name,
					'Age' => $this->data['general_details'][0]->age,
					'Marital status' => $this->data['general_details'][0]->marital_status,
					'Gender' => $this->data['general_details'][0]->gender,
					'Language' => $this->data['general_details'][0]->home_language,
					'Working experience' => $this->data['general_details'][0]->working_experience,
					'Job level' => $this->data['general_details'][0]->current_job_level,
					'Highest qualification' => $this->data['general_details'][0]->heighest_education,
					'Ethnicity' => $this->data['general_details'][0]->ethnicity,
				);
				$this->data['ptv']['BECI'] = $bt_1_arr;
				$this->data['ptv']['Teanamics'] = $bt_13_arr;

				$result[] = array_merge($this->data['ptv']['Profile'], $this->data['ptv']['BECI'], $this->data['ptv']['Teanamics']);

			}

		}

		$objPHPExcel = new PHPExcel();
		// Merge
		#style
		$merge_style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
		);

		// Merge Heading
		$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
		$objPHPExcel->getActiveSheet()->getCell('A1')->setValue('Profile');

		$mstart = 8;
		$start = PHPExcel_Cell::stringFromColumnIndex($mstart + 1);
		$end = PHPExcel_Cell::stringFromColumnIndex($mstart + count($bt_1_qus));
		$merge = "$start" . "1:" . $end . "1";

		$objPHPExcel->getActiveSheet()->mergeCells($merge);
		$objPHPExcel->getActiveSheet()->getCell("$start" . "1")->setValue('BECI');
		$mstart = $mstart + count($bt_1_qus);

		$start = PHPExcel_Cell::stringFromColumnIndex($mstart + 1);
		$end = PHPExcel_Cell::stringFromColumnIndex($mstart + count($bt_13_qus));
		$merge = "$start" . "1:" . "$end" . "1";

		$objPHPExcel->getActiveSheet()->getCell("$start" . "1")->setValue('Teanamics');
		$objPHPExcel->getActiveSheet()->mergeCells($merge);

		$objPHPExcel->getActiveSheet()->getStyle("A1:$end" . "1")->applyFromArray($merge_style);

		// Qyestion Headings
		$objPHPExcel->getActiveSheet()->fromArray($profile, null, 'A2');

		foreach ($bt_1_qus as $key => $value) {
			$md1 = $key + 9;
			$cell = PHPExcel_Cell::stringFromColumnIndex($md1);
			$qus = $key + 1;
			$objPHPExcel->getActiveSheet()->getCell("$cell" . "2")->setValue("Question $qus");
		}

		$mdp = 9 + count($bt_1_qus);
		foreach ($bt_13_qus as $key => $value) {
			$md13 = $key + $mdp;
			$cell = PHPExcel_Cell::stringFromColumnIndex($md13);
			$qus = $key + 1;
			$objPHPExcel->getActiveSheet()->getCell("$cell" . "2")->setValue("Question $qus");
		}

		$objPHPExcel->getActiveSheet()->getStyle("A2:$end" . "2")->getAlignment()->setTextRotation(90);
		$objPHPExcel->getActiveSheet()->getStyle("A2:$end" . "2")->applyFromArray($merge_style);

		// Fill worksheet from values in array
		foreach ($result as $key => $value) {
			$md = $key + 3;
			$objPHPExcel->getActiveSheet()->fromArray($result, null, "A" . "$md");
			$objPHPExcel->getActiveSheet()->getStyle("A3" . "$md" . ":$end" . "$md")->applyFromArray($merge_style);
		}

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Personality Teanamics Val');

		//$objWriter->save('Insert.xlsx');
		// We'll be outputting an excel file
		@header('Content-type: application/vnd.ms-excel');
		// It will be called file.xls
		@header('Content-Disposition: attachment; filename="PTV_excel.xlsx"');
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		// Write file to the browser
		// $objWriter->save("nameoffile.xls");
		$objWriter->save('php://output');

		// $this->data['general_details'] = $this->candidate->getCandidateInfo($id);

		// $this->data['test_details'] = $this->test->getCandidateTestList($id);

		// $bt_1_arr = [];
		// $bt_13_arr = [];
		// foreach ($this->data['test_details'] as $key => $test_row) {

		// 	if ($test_row->fk_test_id == 1 && $test_row->status == 'completed') {
		// 		$bt_1_res = @$this->test->getCandidateTestResult1($id)->answers;
		// 		if (!empty($bt_1_res)) {
		// 			$bt_1_res = explode(',', $bt_1_res);
		// 			$bt_1_qus = getBECIQuestions();
		// 			foreach ($bt_1_qus as $key => $row) {
		// 				$bt_1_arr[$row] = @$bt_1_res[$key];
		// 			}
		// 		}
		// 	}

		// 	if ($test_row->fk_test_id == 13 && $test_row->status == 'completed') {
		// 		$bt_13_res = @$this->test->getCandidateTestResult13($id)->answers;
		// 		if (!empty($bt_13_res)) {
		// 			$bt_13_res = explode(',', $bt_13_res);
		// 			$bt_13_qus = getTenamicsQuestions();
		// 			foreach ($bt_13_qus as $key => $row) {
		// 				$bt_13_arr[$row] = @$bt_13_res[$key];
		// 			}
		// 		}
		// 	}
		// }

		// if (!empty($bt_1_arr) || !empty($bt_13_arr)) {
		// 	$this->data['ptv']['Profile'] = array(
		// 		'Name' => $this->data['general_details'][0]->full_name,
		// 		'Age' => $this->data['general_details'][0]->age,
		// 		'Marital status' => $this->data['general_details'][0]->marital_status,
		// 		'Gender' => $this->data['general_details'][0]->gender,
		// 		'Language' => $this->data['general_details'][0]->home_language,
		// 		'Working experience' => $this->data['general_details'][0]->working_experience,
		// 		'Job level' => $this->data['general_details'][0]->current_job_level,
		// 		'Highest qualification' => $this->data['general_details'][0]->heighest_education,
		// 		'Ethnicity' => $this->data['general_details'][0]->ethnicity,
		// 	);
		// 	$this->data['ptv']['BECI'] = $bt_1_arr;
		// 	$this->data['ptv']['Teanamics'] = $bt_13_arr;

		// 	$result = array_merge($this->data['ptv']['Profile'], $this->data['ptv']['BECI'], $this->data['ptv']['Teanamics']);

		// 	$objPHPExcel = new PHPExcel();

		// 	// Merge
		// 	#style
		// 	$merge_style = array(
		// 		'alignment' => array(
		// 			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		// 		),
		// 	);
		// 	$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
		// 	$objPHPExcel->getActiveSheet()->getCell('A1')->setValue('Profile');

		// 	$mstart = 9;
		// 	// var_dump($this->data['ptv']['BECI']);
		// 	// die;
		// 	if (count($this->data['ptv']['BECI']) > 0) {
		// 		$start = PHPExcel_Cell::stringFromColumnIndex($mstart);
		// 		$end = PHPExcel_Cell::stringFromColumnIndex($mstart + count($bt_1_arr));
		// 		$merge = "$start" . "1:" . $end . "1";

		// 		$objPHPExcel->getActiveSheet()->mergeCells($merge);
		// 		$objPHPExcel->getActiveSheet()->getCell("$start" . "1")->setValue('BECI');
		// 		$mstart = $mstart + count($this->data['ptv']['BECI']);
		// 	}

		// 	if (count($this->data['ptv']['Teanamics']) > 0) {
		// 		$start = PHPExcel_Cell::stringFromColumnIndex($mstart);
		// 		$end = PHPExcel_Cell::stringFromColumnIndex($mstart + count($bt_13_arr));
		// 		$merge = "$start" . "1:" . "$end" . "1";
		// 		$objPHPExcel->getActiveSheet()->getCell("$start" . "1")->setValue('Teanamics');
		// 		$objPHPExcel->getActiveSheet()->mergeCells($merge);
		// 	}

		// 	$objPHPExcel->getActiveSheet()->getStyle("A1:$end" . "1")->applyFromArray($merge_style);

		// 	// Fill worksheet from values in array
		// 	$objPHPExcel->getActiveSheet()->fromArray(array_keys($result), null, 'A2');

		// 	$objPHPExcel->getActiveSheet()->getStyle("A2:$end" . "2")->getAlignment()->setTextRotation(90);
		// 	$objPHPExcel->getActiveSheet()->getStyle("A2:$end" . "2")->applyFromArray($merge_style);
		// 	$objPHPExcel->getActiveSheet()->getStyle("A3:$end" . "3")->applyFromArray($merge_style);

		// 	$objPHPExcel->getActiveSheet()->fromArray($result, null, 'A3');

		// 	// Rename worksheet
		// 	$objPHPExcel->getActiveSheet()->setTitle('Personality Teanamics Val');

		// 	//$objWriter->save('Insert.xlsx');
		// 	// We'll be outputting an excel file
		// 	@header('Content-type: application/vnd.ms-excel');
		// 	// It will be called file.xls
		// 	@header('Content-Disposition: attachment; filename="PTV_excel.xlsx"');
		// 	$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		// 	// Write file to the browser
		// 	// $objWriter->save("nameoffile.xls");
		// 	$objWriter->save('php://output');
		// }

	}

	public function Personality_Teanamics_Validation() {

		$project_id = 365;
		$project_candidate_data = $this->project->getProjectCandidate($project_id);
		$result = array();

		$profile = array('Name', 'Age', 'Marital status', 'Gender', 'Language', 'Working experience', 'Job level', 'Highest qualification', 'Ethnicity');
		$bt_1_qus = getBECIQuestions();
		$bt_13_qus = getTenamicsQuestions();
		$Heading_arr = array_merge($profile, $bt_1_qus, $bt_13_qus);
		foreach ($project_candidate_data as $ckey => $candidate) {
			$id = $candidate->id;
			// die($id);
			$this->data['general_details'] = $this->candidate->getCandidateInfo($id);
			$this->data['test_details'] = $this->test->getCandidateTestList($id);
			$bt_1_arr = [];
			$bt_13_arr = [];

			foreach ($this->data['test_details'] as $key => $test_row) {

				if (($test_row->fk_test_id == 1 && $test_row->status == 'completed') || ($test_row->fk_test_id == 13 && $test_row->status == 'completed')) {

					$bt_1_res = @$this->test->getCandidateTestResult1($id);

					// if (!empty($bt_1_res)) {
					// 	$bt_1_res = explode(',', $bt_1_res);
					// }
					foreach ($bt_1_qus as $key => $row) {
						$bt_1_arr[$row] = is_numeric(@$bt_1_res[$key]['answer']) ? @$bt_1_res[$key]['answer'] : '-';
					}

					$bt_13_res = @$this->test->getCandidateTestResult13($id)->answers;
					if (!empty($bt_13_res)) {
						$bt_13_res = explode(',', $bt_13_res);
					}
					foreach ($bt_13_qus as $key => $row) {
						$bt_13_arr[$row] = is_numeric(@$bt_13_res[$key]) ? @$bt_13_res[$key] : '-';
					}
				}
			}

			if (!empty($bt_1_arr) || !empty($bt_13_arr)) {
				$this->data['ptv']['Profile'] = array(
					'Name' => $this->data['general_details'][0]->full_name,
					'Age' => $this->data['general_details'][0]->age,
					'Marital status' => $this->data['general_details'][0]->marital_status,
					'Gender' => $this->data['general_details'][0]->gender,
					'Language' => $this->data['general_details'][0]->home_language,
					'Working experience' => $this->data['general_details'][0]->working_experience,
					'Job level' => $this->data['general_details'][0]->current_job_level,
					'Highest qualification' => $this->data['general_details'][0]->heighest_education,
					'Ethnicity' => $this->data['general_details'][0]->ethnicity,
				);
				$this->data['ptv']['BECI'] = $bt_1_arr;
				$this->data['ptv']['Teanamics'] = $bt_13_arr;

				$result[] = array_merge($this->data['ptv']['Profile'], $this->data['ptv']['BECI'], $this->data['ptv']['Teanamics']);

			}

		}

		$objPHPExcel = new PHPExcel();
		// Merge
		#style
		$merge_style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
		);

		// Merge Heading
		$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
		$objPHPExcel->getActiveSheet()->getCell('A1')->setValue('Profile');

		$mstart = 8;
		$start = PHPExcel_Cell::stringFromColumnIndex($mstart + 1);
		$end = PHPExcel_Cell::stringFromColumnIndex($mstart + count($bt_1_qus));
		$merge = "$start" . "1:" . $end . "1";

		$objPHPExcel->getActiveSheet()->mergeCells($merge);
		$objPHPExcel->getActiveSheet()->getCell("$start" . "1")->setValue('BECI');
		$mstart = $mstart + count($bt_1_qus);

		$start = PHPExcel_Cell::stringFromColumnIndex($mstart + 1);
		$end = PHPExcel_Cell::stringFromColumnIndex($mstart + count($bt_13_qus));
		$merge = "$start" . "1:" . "$end" . "1";

		$objPHPExcel->getActiveSheet()->getCell("$start" . "1")->setValue('Teanamics');
		$objPHPExcel->getActiveSheet()->mergeCells($merge);

		$objPHPExcel->getActiveSheet()->getStyle("A1:$end" . "1")->applyFromArray($merge_style);

		// Qyestion Headings
		$objPHPExcel->getActiveSheet()->fromArray($profile, null, 'A2');

		foreach ($bt_1_qus as $key => $value) {
			$md1 = $key + 9;
			$cell = PHPExcel_Cell::stringFromColumnIndex($md1);
			$qus = $key + 1;
			$objPHPExcel->getActiveSheet()->getCell("$cell" . "2")->setValue("Question $qus");
		}

		$mdp = 9 + count($bt_1_qus);
		foreach ($bt_13_qus as $key => $value) {
			$md13 = $key + $mdp;
			$cell = PHPExcel_Cell::stringFromColumnIndex($md13);
			$qus = $key + 1;
			$objPHPExcel->getActiveSheet()->getCell("$cell" . "2")->setValue("Question $qus");
		}

		$objPHPExcel->getActiveSheet()->getStyle("A2:$end" . "2")->getAlignment()->setTextRotation(90);
		$objPHPExcel->getActiveSheet()->getStyle("A2:$end" . "2")->applyFromArray($merge_style);

		// Fill worksheet from values in array
		foreach ($result as $key => $value) {
			$md = $key + 3;
			$objPHPExcel->getActiveSheet()->fromArray($result, null, "A" . "$md");
			$objPHPExcel->getActiveSheet()->getStyle("A3" . "$md" . ":$end" . "$md")->applyFromArray($merge_style);
		}

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Personality Teanamics Val');

		//$objWriter->save('Insert.xlsx');
		// We'll be outputting an excel file
		@header('Content-type: application/vnd.ms-excel');
		// It will be called file.xls
		@header('Content-Disposition: attachment; filename="PTV_excel.xlsx"');
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		// Write file to the browser
		// $objWriter->save("nameoffile.xls");
		$objWriter->save('php://output');

		// $this->data['general_details'] = $this->candidate->getCandidateInfo($id);

		// $this->data['test_details'] = $this->test->getCandidateTestList($id);

		// $bt_1_arr = [];
		// $bt_13_arr = [];
		// foreach ($this->data['test_details'] as $key => $test_row) {

		// 	if ($test_row->fk_test_id == 1 && $test_row->status == 'completed') {
		// 		$bt_1_res = @$this->test->getCandidateTestResult1($id)->answers;
		// 		if (!empty($bt_1_res)) {
		// 			$bt_1_res = explode(',', $bt_1_res);
		// 			$bt_1_qus = getBECIQuestions();
		// 			foreach ($bt_1_qus as $key => $row) {
		// 				$bt_1_arr[$row] = @$bt_1_res[$key];
		// 			}
		// 		}
		// 	}

		// 	if ($test_row->fk_test_id == 13 && $test_row->status == 'completed') {
		// 		$bt_13_res = @$this->test->getCandidateTestResult13($id)->answers;
		// 		if (!empty($bt_13_res)) {
		// 			$bt_13_res = explode(',', $bt_13_res);
		// 			$bt_13_qus = getTenamicsQuestions();
		// 			foreach ($bt_13_qus as $key => $row) {
		// 				$bt_13_arr[$row] = @$bt_13_res[$key];
		// 			}
		// 		}
		// 	}
		// }

		// if (!empty($bt_1_arr) || !empty($bt_13_arr)) {
		// 	$this->data['ptv']['Profile'] = array(
		// 		'Name' => $this->data['general_details'][0]->full_name,
		// 		'Age' => $this->data['general_details'][0]->age,
		// 		'Marital status' => $this->data['general_details'][0]->marital_status,
		// 		'Gender' => $this->data['general_details'][0]->gender,
		// 		'Language' => $this->data['general_details'][0]->home_language,
		// 		'Working experience' => $this->data['general_details'][0]->working_experience,
		// 		'Job level' => $this->data['general_details'][0]->current_job_level,
		// 		'Highest qualification' => $this->data['general_details'][0]->heighest_education,
		// 		'Ethnicity' => $this->data['general_details'][0]->ethnicity,
		// 	);
		// 	$this->data['ptv']['BECI'] = $bt_1_arr;
		// 	$this->data['ptv']['Teanamics'] = $bt_13_arr;

		// 	$result = array_merge($this->data['ptv']['Profile'], $this->data['ptv']['BECI'], $this->data['ptv']['Teanamics']);

		// 	$objPHPExcel = new PHPExcel();

		// 	// Merge
		// 	#style
		// 	$merge_style = array(
		// 		'alignment' => array(
		// 			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		// 		),
		// 	);
		// 	$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
		// 	$objPHPExcel->getActiveSheet()->getCell('A1')->setValue('Profile');

		// 	$mstart = 9;
		// 	// var_dump($this->data['ptv']['BECI']);
		// 	// die;
		// 	if (count($this->data['ptv']['BECI']) > 0) {
		// 		$start = PHPExcel_Cell::stringFromColumnIndex($mstart);
		// 		$end = PHPExcel_Cell::stringFromColumnIndex($mstart + count($bt_1_arr));
		// 		$merge = "$start" . "1:" . $end . "1";

		// 		$objPHPExcel->getActiveSheet()->mergeCells($merge);
		// 		$objPHPExcel->getActiveSheet()->getCell("$start" . "1")->setValue('BECI');
		// 		$mstart = $mstart + count($this->data['ptv']['BECI']);
		// 	}

		// 	if (count($this->data['ptv']['Teanamics']) > 0) {
		// 		$start = PHPExcel_Cell::stringFromColumnIndex($mstart);
		// 		$end = PHPExcel_Cell::stringFromColumnIndex($mstart + count($bt_13_arr));
		// 		$merge = "$start" . "1:" . "$end" . "1";
		// 		$objPHPExcel->getActiveSheet()->getCell("$start" . "1")->setValue('Teanamics');
		// 		$objPHPExcel->getActiveSheet()->mergeCells($merge);
		// 	}

		// 	$objPHPExcel->getActiveSheet()->getStyle("A1:$end" . "1")->applyFromArray($merge_style);

		// 	// Fill worksheet from values in array
		// 	$objPHPExcel->getActiveSheet()->fromArray(array_keys($result), null, 'A2');

		// 	$objPHPExcel->getActiveSheet()->getStyle("A2:$end" . "2")->getAlignment()->setTextRotation(90);
		// 	$objPHPExcel->getActiveSheet()->getStyle("A2:$end" . "2")->applyFromArray($merge_style);
		// 	$objPHPExcel->getActiveSheet()->getStyle("A3:$end" . "3")->applyFromArray($merge_style);

		// 	$objPHPExcel->getActiveSheet()->fromArray($result, null, 'A3');

		// 	// Rename worksheet
		// 	$objPHPExcel->getActiveSheet()->setTitle('Personality Teanamics Val');

		// 	//$objWriter->save('Insert.xlsx');
		// 	// We'll be outputting an excel file
		// 	@header('Content-type: application/vnd.ms-excel');
		// 	// It will be called file.xls
		// 	@header('Content-Disposition: attachment; filename="PTV_excel.xlsx"');
		// 	$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		// 	// Write file to the browser
		// 	// $objWriter->save("nameoffile.xls");
		// 	$objWriter->save('php://output');
		// }

	}

	public function update_test($id) {
		$this->candidate->update_test($id);
		return redirect(base_url() . "candidate/candidate_details/" . base64_encode($id));
	}

	public function exe_summary() {
		ob_start();
		$this->data['post'] = $_POST;
		$creaditTestIdList = "";

		if (!empty($this->data['post']['content'])) {
			$this->candidate->update_summary($this->data['post']['content'], $this->data['post']['user_id']);

		} else {
			$this->data['post']['content'] = $this->candidate->select_summary($this->data['post']['user_id']);
		}

		$this->data['projectData'] = $this->project->getProject($_POST['project_id']);
		if (!empty($this->data['projectData'][0]->job_success_profile)) {
			$familyRol = $this->data['projectData'][0]->job_success_profile;
			if (explode(" (", $familyRol)) {
				$cmpList = explode(" (", $familyRol);
				$family = $cmpList[0];
				$role = str_replace(')', '', isset($cmpList[1]) ? $cmpList[1] : '');
			}
			$this->data['jspData'] = $this->jsp->getJSPDataByFamilyRoleName($family, $role);
		}

		$this->data['test_details'] = $this->test->getCandidateTestList($this->data['post']['user_id']);
		$this->data['miraRules'] = $this->test->getMiraTestResultRules($this->data['post']['user_id']);

		if (!empty($this->data['test_details'])) {
			foreach ($this->data['test_details'] as $test) {
				if ($test->status == "completed") {

					// creadit section
					if ($this->candidate->checkTest($test->fk_test_id, $_POST['user_id'])) {
						//it's okey
					} else {
						$creaditTestIdList .= $test->fk_test_id . ",";
					}

					if ($test->test_short_name == 'BECi') {
						$this->data['test_code'] = $this->test->getTestCode();
						$this->data['test_ans'] = $this->test->getAnsData($_POST['user_id']);

					} elseif ($test->test_short_name == 'MIRa') {
						$this->data['score2'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);

					} elseif ($test->test_short_name == 'LAP') {
						$this->data['Secscore3'] = $this->getResult3($_POST['user_id']);

						$this->data['score3'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);

					} elseif ($test->test_short_name == 'DIP') {

					} elseif ($test->test_short_name == 'IPT') {

					} elseif ($test->test_short_name == 'OPT') {

					} elseif ($test->test_short_name == 'VST') {
						$this->data['score7'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);
						if ($this->data['score7'] == 0 || $this->data['score7'] == "") {
							$this->data['score7'] = 1;
						}
						if ($this->data['score7'] > 10) {
							$this->data['score7'] == 10;
						}

					} elseif ($test->test_short_name == 'NST') {
						$this->data['score8'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);
						if ($this->data['score8'] == 0 || $this->data['score8'] == "") {
							$this->data['score8'] = 1;
						}
						if ($this->data['score8'] > 10) {
							$this->data['score8'] = 10;
						}

					} elseif ($test->test_short_name == 'DST') {
						$this->data['Secscore9'] = $this->getResult9($_POST['user_id']);
						$this->data['score9'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);
						if ($this->data['score9'] == 0 || $this->data['score9'] == "") {
							$this->data['score9'] = 1;
						}
						if ($this->data['score9'] > 10) {
							$this->data['score9'] == 10;
						}

					} elseif ($test->test_short_name == 'AST') {
						$this->data['score10'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);
						if ($this->data['score10'] == 0 || $this->data['score10'] == "") {
							$this->data['score10'] = 1;
						}
						if ($this->data['score10'] > 10) {
							$this->data['score10'] == 10;
						}

					} elseif ($test->test_short_name == 'MST') {
						$this->data['score11'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);

					} elseif ($test->test_short_name == 'EST') {
						$this->data['Secscore12'] = $this->getResult12($_POST['user_id']);
						$this->data['score12'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);
						if ($this->data['score12'] == 0 || $this->data['score12'] == "") {
							$this->data['score12'] = 1;
						}
						if ($this->data['score12'] > 10) {
							$this->data['score12'] == 10;
						}
					}
				}
			}
		}

		$creaditTestIdList = rtrim($creaditTestIdList, ",");

		if ($this->test->creadit_combine_varification($creaditTestIdList)) {
			$message = "You have not enough credit to download report. Please Contact Your Administrator";
			echo "<script>alert('$message');</script>";
			echo "<script>window.close();</script>";
			return false;
			/* echo "window.location.href =  . base_url(candidate/candidate_details/$this->data['uid']); </script>";*/
		} else {
			if ($this->test->updateCombineCreadit($creaditTestIdList)) {
				if ($this->candidate->updateTestList($creaditTestIdList, $_POST['user_id'])) {
					// its ok
				}
			} else {
				$message = "Problem In credit updation";
				echo "<script>alert('$message');";
				echo "window.location.href = '" . base_url() . "candidate/candidate_details'; </script>";
			}
		}

		// echo "<pre>";print_r($this->data);die;
		$this->load->view('pdf/exc_summary', $this->data);
	}

	public function combine_report() {
		$this->data['post'] = $_POST;
		$this->data['du_name'] = $this->candidate->getCandidateInfo($_POST['user_id']);
		$this->data['post']['content'] = $this->candidate->select_summary($this->data['post']['user_id']);
		$combine_test_list = "";
		$this->data['isExcSummary'] = 0;
		if (isset($_POST['test_list']) && count($_POST['test_list']) > 0) {
			foreach ($_POST['test_list'] as $value) {
				if ($value != 'exc_summary') {
					if ($this->candidate->checkTest($value, $_POST['user_id'])) {
						//it's okey
					} else {
						$combine_test_list .= $value . ",";
					}
				} else {
					$this->data['isExcSummary'] = 1;
				}
			}

			$combine_test_list = rtrim($combine_test_list, ",");
			if ($this->data['isExcSummary'] == 0) {
				if ($this->test->creadit_combine_varification($combine_test_list)) {
					$message = "You have not enough credit to download report. Please Contact Your Administrator";
					echo "<script>alert('$message');</script>";
					echo "<script>window.close();</script>";
					return false;
					/* echo "window.location.href =  . base_url(candidate/candidate_details/$this->data['uid']); </script>";*/
				} else {
					if ($this->test->updateCombineCreadit($combine_test_list)) {
						if ($this->candidate->updateTestList($combine_test_list, $_POST['user_id'])) {

						}
					} else {
						$message = "Problem In credit updation";
						echo "<script>alert('$message');";
						echo "window.location.href = '" . base_url() . "candidate/candidate_details'; </script>";
					}
				}
			}
		}

		if (isset($_POST['test_list']) && count($_POST['test_list']) > 0) {
			foreach ($_POST['test_list'] as $value) {
				if ($value == 1) {
					$this->data['test_code'] = $this->test->getTestCode();
					$this->data['test_ans'] = $this->test->getAnsData($_POST['user_id']);
				} elseif ($value == 2) {
					$this->data['score2'] = $this->test->getTestResult(2, $_POST['user_id']);
				} elseif ($value == 3) {
					//$this->data['Secscore3'] = $this->getResult3($_POST['user_id']);
					$this->data['Secscore3'] = $this->candidate->getCorrResult3_2($_POST['user_id']);
					$this->data['score3'] = $this->test->getTestResult(3, $_POST['user_id']);
				} elseif ($value == 4) {
					$this->data['score4'] = $this->getResult4($_POST['user_id']);
				} elseif ($value == 5) {
				} elseif ($value == 6) {
				} elseif ($value == 7) {
					$this->data['score7'] = $this->test->getTestResult(7, $_POST['user_id']);
					if ($this->data['score7'] == 0 || $this->data['score7'] == "") {
						$this->data['score7'] = 1;
					}
					if ($this->data['score7'] > 10) {
						$this->data['score7'] == 10;
					}
				} elseif ($value == 8) {
					$this->data['score8'] = $this->test->getTestResult(8, $_POST['user_id']);

					if ($this->data['score8'] == 0 || $this->data['score8'] == "") {
						$this->data['score8'] = 1;
					}
					if ($this->data['score8'] > 10) {
						$this->data['score8'] == 10;
					}
				} elseif ($value == 9) {
					$this->data['Secscore9'] = $this->getResult9($_POST['user_id']);
					$this->data['score9'] = $this->test->getTestResult(8, $_POST['user_id']);
					if ($this->data['score9'] == 0 || $this->data['score9'] == "") {
						$this->data['score9'] = 1;
					}
					if ($this->data['score9'] > 10) {
						$this->data['score9'] == 10;
					}
				} elseif ($value == 10) {
					$this->data['score10'] = $this->test->getTestResult(10, $_POST['user_id']);
					if ($this->data['score10'] == 0 || $this->data['score10'] == "") {
						$this->data['score10'] = 1;
					}
					if ($this->data['score10'] > 10) {
						$this->data['score10'] == 10;
					}
				} elseif ($value == 11) {
					$this->data['score11'] = $this->test->getTestResult(11, $_POST['user_id']);
				} elseif ($value == 12) {
					$this->data['Secscore12'] = $this->getResult12($_POST['user_id']);
					$this->data['score12'] = $this->test->getTestResult(10, $_POST['user_id']);
					if ($this->data['score12'] == 0 || $this->data['score12'] == "") {
						$this->data['score12'] = 1;
					}
					if ($this->data['score12'] > 10) {
						$this->data['score12'] == 10;
					}
				} elseif ($value == 'exc_summary') {
					$this->data['isExcSummary'] = 1;
					$this->data['projectData'] = $this->project->getProject($_POST['project_id']);
					if (!empty($this->data['projectData'][0]->job_success_profile)) {
						$familyRol = $this->data['projectData'][0]->job_success_profile;
						if (explode(" (", $familyRol)) {
							$cmpList = explode(" (", $familyRol);
							$family = $cmpList[0];
							$role = str_replace(')', '', isset($cmpList[1]) ? $cmpList[1] : '');
						}
						$this->data['jspData'] = $this->jsp->getJSPDataByFamilyRoleName($family, $role);
					}

					$this->data['test_details'] = $this->test->getCandidateTestList($this->data['post']['user_id']);
					$this->data['miraRules'] = $this->test->getMiraTestResultRules($this->data['post']['user_id']);
					$combine_test_list = '';
					if (!empty($this->data['test_details'])) {
						foreach ($this->data['test_details'] as $test) {
							if ($test->status == "completed") {

								// creadit section
								if ($this->candidate->checkTest($test->fk_test_id, $_POST['user_id'])) {
									//it's okey
								} else {
									$combine_test_list .= $test->fk_test_id . ",";
								}

								if ($test->test_short_name == 'BECi') {
									$this->data['test_code'] = $this->test->getTestCode();
									$this->data['test_ans'] = $this->test->getAnsData($_POST['user_id']);

								} elseif ($test->test_short_name == 'MIRa') {
									$this->data['score2'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);

								} elseif ($test->test_short_name == 'LAP') {
									$this->data['Secscore3'] = $this->getResult3($_POST['user_id']);
									$this->data['score3'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);

								} elseif ($test->test_short_name == 'DIP') {
									$this->data['score4'] = $this->getResult4($_POST['user_id']);

								} elseif ($test->test_short_name == 'IPT') {
									$this->data['score5'] = $this->getResult5($_POST['user_id']);
								} elseif ($test->test_short_name == 'OPT') {
									$this->data['score6'] = $this->getResult6($_POST['user_id']);
								} elseif ($test->test_short_name == 'VST') {
									$this->data['score7'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);
									if ($this->data['score7'] == 0 || $this->data['score7'] == "") {
										$this->data['score7'] = 1;
									}
									if ($this->data['score7'] > 10) {
										$this->data['score7'] == 10;
									}

								} elseif ($test->test_short_name == 'NST') {
									$this->data['score8'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);
									if ($this->data['score8'] == 0 || $this->data['score8'] == "") {
										$this->data['score8'] = 1;
									}
									if ($this->data['score8'] > 10) {
										$this->data['score8'] = 10;
									}

								} elseif ($test->test_short_name == 'DST') {
									$this->data['Secscore9'] = $this->getResult9($_POST['user_id']);
									$this->data['score9'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);
									if ($this->data['score9'] == 0 || $this->data['score9'] == "") {
										$this->data['score9'] = 1;
									}
									if ($this->data['score9'] > 10) {
										$this->data['score9'] == 10;
									}

								} elseif ($test->test_short_name == 'AST') {
									$this->data['score10'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);
									if ($this->data['score10'] == 0 || $this->data['score10'] == "") {
										$this->data['score10'] = 1;
									}
									if ($this->data['score10'] > 10) {
										$this->data['score10'] == 10;
									}

								} elseif ($test->test_short_name == 'MST') {
									$this->data['score11'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);

								} elseif ($test->test_short_name == 'EST') {
									$this->data['Secscore12'] = $this->getResult12($_POST['user_id']);
									$this->data['score12'] = $this->test->getTestResult($test->fk_test_id, $_POST['user_id']);
									if ($this->data['score12'] == 0 || $this->data['score12'] == "") {
										$this->data['score12'] = 1;
									}
									if ($this->data['score12'] > 10) {
										$this->data['score12'] == 10;
									}
								}
							}
						}
					}

					$creaditTestIdList = rtrim($combine_test_list, ",");

					if ($this->test->creadit_combine_varification($creaditTestIdList)) {
						$message = "You have not enough credit to download report. Please Contact Your Administrator";
						echo "<script>alert('$message');</script>";
						echo "<script>window.close();</script>";
						return false;
						/* echo "window.location.href =  . base_url(candidate/candidate_details/$this->data['uid']); </script>";*/
					} else {
						if ($this->test->updateCombineCreadit($creaditTestIdList)) {
							if ($this->candidate->updateTestList($creaditTestIdList, $_POST['user_id'])) {
								// its ok
							}
						} else {
							$message = "Problem In credit updation";
							echo "<script>alert('$message');";
							echo "window.location.href = '" . base_url() . "candidate/candidate_details'; </script>";
						}
					}
				}
			}
		}

		$this->load->view('pdf/combine_report', $this->data);

	}

	public function download_report() {
		$this->data['uName'] = isset($_GET["u_name"]) ? isset($_GET["u_name"]) : "";
		$this->data['rTitle'] = isset($_GET["title"]) ? isset($_GET["title"]) : "";
		$this->data['score'] = isset($_GET["score"]) ? isset($_GET["score"]) : "";
		$this->data['uid'] = $_GET['user_id'];
		$this->data['test_id'] = $_GET['test_id'];
		$this->data['created_date'] = $_GET['created_date'];

		if ($this->data['test_id'] != "" || $this->data['uid'] != "") {
			$userId = $this->session->userdata('logged_in')['user_id'];

			if ($this->candidate->checkTest($this->data['test_id'], $this->data['uid'])) {
				// it's okey !
			} else {
				if ($this->test->creadit_varification($this->data['test_id'])) {
					$message = "You have not enough credit to download report. Please Contact Your Administrator";
					echo "<script>alert('$message');</script>";
					echo "<script>window.close();</script>";
					return false;
					/* echo "window.location.href =  . base_url(candidate/candidate_details/$this->data['uid']); </script>"; */
				} else {
					if ($this->test->updateCreadit($this->data['test_id'])) {
						if ($this->candidate->updateTestList($this->data['test_id'], $this->data['uid'])) {

						}
					} else {
						$message = "Problem In credit updation";
						echo "<script>alert('$message');";
						echo "window.location.href = '" . base_url() . "candidate/candidate_details'; </script>";
					}
				}
			}
		} else {
			return redirect("candidate/candidate_details/$this->data['uid']");
		}

		if ($this->data['test_id'] == 1) {
			ob_start();
			$this->data['test_code'] = $this->test->getTestCode();
			$this->data['test_ans'] = $this->test->getAnsData($this->data['uid']);
			$this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);

			$this->load->view('pdf/pdf_content_1', $this->data);
		} elseif ($this->data['test_id'] == 2) {

			ob_start();
			$this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
			$this->data['score'] = isset($_GET["score"]) ? $_GET["score"] : "";
			$this->load->view('pdf/MIRA_1', $this->data);

		} elseif ($this->data['test_id'] == 3) {
			ob_start();
			$this->data['Secscore'] = $this->getResult3($this->data['uid']);
			$this->data['test_code'] = $this->test->getTestCode();
			$this->data['test_ans'] = $this->test->getAnsData($this->data['uid']);
			$this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
			$this->data['score'] = isset($_GET["score"]) ? isset($_GET["score"]) : "";
			$this->load->view('pdf/lap', $this->data);
		} elseif ($this->data['test_id'] == 4) {
			$this->data['userData'] = $this->candidate->getCandidateInfo($this->data['uid']);
			$this->data['testCompData'] = $this->test->getTestCompletedInfo($this->data['test_id'], $this->data['uid']);
			$this->data['resultArr'] = $this->getResult4($this->data['uid']);
			$this->load->view('pdf/dip_report', $this->data);

		} elseif ($this->data['test_id'] == 5) {
			$this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
			$this->data['score'] = $this->getResult5($this->data['uid']);

			$this->load->view('pdf/IPT/index', $this->data);
		} elseif ($this->data['test_id'] == 6) {
			ob_start();
			$this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
			$this->data['score'] = $this->getResult6($this->data['uid']);

			$this->load->view('pdf/opt', $this->data);
		} elseif ($this->data['test_id'] == 7) {

			ob_start();
			$this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
			$this->data['score'] = isset($_GET["score"]) ? isset($_GET["score"]) : "";

			$this->load->view('pdf/vst', $this->data);

		} elseif ($this->data['test_id'] == 8) {

			ob_start();
			$this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
			$this->data['score'] = isset($_GET["score"]) ? isset($_GET["score"]) : "";
			$this->load->view('pdf/nst', $this->data);

		} elseif ($this->data['test_id'] == 9) {
			ob_start();
			$this->data['Secscore'] = $this->getResult9($this->data['uid']);

			$this->data['test_code'] = $this->test->getTestCode();
			$this->data['test_ans'] = $this->test->getAnsData($this->data['uid']);
			$this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
			$this->data['score'] = isset($_GET["score"]) ? isset($_GET["score"]) : "";
			$this->load->view('pdf/dst', $this->data);
		} elseif ($this->data['test_id'] == 10) {

			ob_start();
			$this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
			$this->data['score'] = isset($_GET["score"]) ? isset($_GET["score"]) : "";
			$this->load->view('pdf/ast', $this->data);

		} elseif ($this->data['test_id'] == 11) {

			ob_start();
			$this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
			$this->data['score'] = isset($_GET["score"]) ? isset($_GET["score"]) : "";
			$this->load->view('pdf/mst', $this->data);

		} elseif ($this->data['test_id'] == 12) {
			ob_start();
			$this->data['Secscore'] = $this->getResult12($this->data['uid']);

			$this->data['test_code'] = $this->test->getTestCode();
			$this->data['test_ans'] = $this->test->getAnsData($this->data['uid']);
			$this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
			$this->data['score'] = isset($_GET["score"]) ? isset($_GET["score"]) : "";
			$this->load->view('pdf/est', $this->data);
		} elseif ($this->data['test_id'] == 13) {
			$this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
			$this->data['score'] = $this->getResult13($this->data['uid']);

			$this->load->view('pdf/Teanamics', $this->data);
		} elseif ($this->data['test_id'] == 14) {

			ob_start();
			$this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
			$this->data['score'] = isset($_GET["score"]) ? $_GET["score"] : "";
			$this->load->view('pdf/MIRA_14', $this->data);
		} elseif ($this->data['test_id'] == 15) {

			ob_start();
			$this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
			$this->data['score'] = isset($_GET["score"]) ? $_GET["score"] : "";
			$this->load->view('pdf/MIRA_14', $this->data);
		} elseif ($this->data['test_id'] == 16) {

			ob_start();
			$this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
			$this->data['score'] = isset($_GET["score"]) ? $_GET["score"] : "";
			$this->load->view('pdf/MIRA_16', $this->data);
        } elseif ($this->data['test_id'] == 19) {
            
            ob_start();
            $this->data['du_name'] = $this->candidate->getCandidateInfo($this->data['uid']);
            $this->data['score'] = isset($_GET["score"]) ? $_GET["score"] : "";
            $this->load->view('pdf/MIRA_19', $this->data);
        } elseif ($this->data['test_id'] == 20) {
            
            ob_start();
            $this->data['userdetails'] = $this->candidate->getCandidateInfo($this->data['uid']);
            $this->data['report_data'] = $this->candidate->salesAptitudeTest($this->data['uid']);
            $this->data['score'] = $this->candidate->lapTestScore($this->data['uid']);
            
            if($this->data['report_data']){
                $this->load->view('pdf/IPT/sales_report', $this->data);
            }else{
                $message = "Make sure you have completed Sales Aptitude & LAP test.".base64_encode($this->data['uid']);
                echo "<script>alert('$message');";
                echo "window.location.href = 'http://u-test.co.za/ah/candidate/candidate_details/MTA3Nw=='; </script>";
                $this->candidate_details(base64_encode($this->data['uid']));
            }
        } else {
			$this->load->library('PDF');
			// $this->data['uName'] = "Mitul";
			// $this->data['rTitle'] = "Verbal Skills Test (VST)";
			// $this->data['score'] = 4;

			/** get the HTML */
			ob_start();
			// include(dirname(__FILE__) . '/vst_content.php');
			$this->load->view('pdf/pdf_content', $this->data);
			$content = ob_get_clean();

			/** convert in PDF */
			try {
				$uName = $this->data['uName'];
				$rTitle = $this->data['rTitle'];
				$score = $this->data['score'];
				$html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 0);
				$html2pdf->writeHTML($content, isset($_GET['vuehtml'])); /** isset($_GET['vuehtml']) is not mandatory, it allow to display the result in the HTML format */
				$html2pdf->Output("$uName-$rTitle.pdf", "D");
			} catch (HTML2PDF_exception $e) {
				echo $e;
				exit;
			}
		}
	}

	public function getResult3($uid) {
		$ans = $this->candidate->getCorrResult3($uid);
		// var_dump($ans);die;
		$corr_Ans = $ans['corr'][0];
		$give_Ans = $ans['give'][0];

		$CA = explode(",", $corr_Ans['LAP_A']);
		$GA = explode(",", $give_Ans['LAP_A']);

		$CB = explode(",", $corr_Ans['LAP_B']);
		$GB = explode(",", $give_Ans['LAP_B']);

		$CC = explode(",", $corr_Ans['LAP_C']);
		$GC = explode(",", $give_Ans['LAP_C']);

		$CD = explode(",", $corr_Ans['LAP_D']);
		$GD = explode(",", $give_Ans['LAP_D']);

		$data = array();

		$correct = 0;
		for ($i = 0; $i < count($CA); $i++) {
			if ($GA[$i] === @$CA[$i]) {
				$correct += 1;
			}
		}

		$data['corr_A'] = number_format((($correct / 79) * 10), 0);

		$data['corr_A'] = $data['corr_A'] == 0 ? 1 : $data['corr_A'];
		$data['corr_A'] = $data['corr_A'] > 9 ? 9 : $data['corr_A'];

		$correct = 0;
		for ($i = 0; $i < count($CB); $i++) {
			if ($GB[$i] === @$CB[$i]) {
				$correct += 1;
			}
		}

		$data['corr_B'] = number_format((($correct / 79) * 10), 0);
		$data['corr_B'] = $data['corr_B'] == 0 ? 1 : $data['corr_B'];
		$data['corr_B'] = $data['corr_B'] > 9 ? 9 : $data['corr_B'];

		$correct = 0;
		for ($i = 0; $i < count($CC); $i++) {
			if ($GC[$i] === @$CC[$i]) {
				$correct += 1;
			}
		}

		$data['corr_C'] = number_format((($correct / 79) * 10), 0);
		$data['corr_C'] = $data['corr_C'] == 0 ? 1 : $data['corr_C'];
		$data['corr_C'] = $data['corr_C'] > 9 ? 9 : $data['corr_C'];

		$correct = 0;
		for ($i = 0; $i < count($CD); $i++) {
			if ($GD[$i] === @$CD[$i]) {
				$correct += 1;
			}
		}

		$data['corr_D'] = number_format((($correct / 79) * 10), 0);
		$data['corr_D'] = $data['corr_D'] == 0 ? 1 : $data['corr_D'];
		$data['corr_D'] = $data['corr_D'] > 9 ? 9 : $data['corr_D'];
		return $data;

	}

	public function getResult4($uid) {

		$ansStr = $this->candidate->getCorrResult4($uid);
		$ansArr = explode(",", $ansStr[0]['test4_answer']);

		$resultArr = array();
		if (isset($ansArr)) {
			foreach ($ansArr as $ans) {
				$val = explode("_", $ans);
				$resultArr[$val[0]] = isset($resultArr[$val[0]]) ? $resultArr[$val[0]] + $val[1] : $val[1];
			}
		}

		$D1 = @($resultArr['D+'] / 45) * 10;
		$D2 = @($resultArr['D-'] / 45) * 10;
		$resultArr['RD'] = round(($D1 != $D2) ? ($D1 - $D2) : 1, 2);

		$I1 = @($resultArr['I+'] / 45) * 10;
		$I2 = @($resultArr['I-'] / 45) * 10;
		$resultArr['RI'] = round(($I1 != $I2) ? ($I1 - $I2) : 1, 2);

		$S1 = @($resultArr['S+'] / 45) * 10;
		$S2 = @($resultArr['S-'] / 45) * 10;
		$resultArr['RS'] = round(($S1 != $S2) ? ($S1 - $S2) : 1, 2);

		$C1 = @($resultArr['C+'] / 45) * 10;
		$C2 = @($resultArr['C-'] / 45) * 10;
		$resultArr['RC'] = round(($C1 != $C2) ? ($C1 - $C2) : 1, 2);

		return $resultArr;
	}

	public function old_getResult4($uid) {
		$code_str = "D,I,S,C,D,C,I,C,D,D,I,S,I,S,C,D,I,C,C,S,I,D,C,I,S,C,D,I,S,C,I,D,C,S,C,D,S,I,D,S,I,S,S,D,S,I,C,C,S,D,C,I,D,I,S,D,S,I,C,C,D,C,I,D,S,S,I,D,C,S,D,I,S,C,I,D,C,D,S,I,C-,C-,S-,I-,S-,I-,D-,I-,S-,D-,I-,D-,C-,S-,C-,D-,C-,I-,D-,S-,S-,I-,D-,I-,D-,C-,S-,C-,I-,C-,C-,S-,I-,D-,S-,I-,D-,S-,C-,D-";

		$cod = explode(",", $code_str);

		$ans_str = $this->candidate->getCorrResult4($uid);
		$ans = explode(",", $ans_str[0]['test4_answer']);
		$D = "";
		$I = "";
		$S = "";
		$C = "";
		$Dm = "";
		$Im = "";
		$Sm = "";
		$Cm = "";

		for ($i = 0; $i < 120; $i++) {
			if ($cod[$i] == "D") {$D += $ans["$i"];}
			if ($cod[$i] == "I") {$I += $ans["$i"];}
			if ($cod[$i] == "S") {$S += $ans["$i"];}
			if ($cod[$i] == "C") {$C += $ans["$i"];}
			if ($cod[$i] == "D-") {$Dm += $ans["$i"];}
			if ($cod[$i] == "I-") {$Im += $ans["$i"];}
			if ($cod[$i] == "S-") {$Sm += $ans["$i"];}
			if ($cod[$i] == "C-") {$Cm += $ans["$i"];}
		}

		$D1 = ($D / 60) * 10;
		$D2 = ($Dm / 60) * 10;
		$RD = $D1 - $D2;

		if ($D1 == $D2) {
			$RD = 1;
		}

		$I1 = ($I / 60) * 10;
		$I2 = ($Im / 60) * 10;
		$RI = $I1 - $I2;

		if ($I1 == $I2) {
			$RI = 1;
		}

		$S1 = ($S / 60) * 10;
		$S2 = ($Sm / 60) * 10;
		$RS = $S1 - $S2;

		if ($S1 == $S2) {
			$RS = 1;
		}

		$C1 = ($C / 60) * 10;
		$C2 = ($Cm / 60) * 10;
		$RC = $C1 - $C2;

		if ($C1 == $C2) {
			$RC = 1;
		}

		$total_result = "";

		if ($RD > 25) {$total_result .= "D";}
		if ($RI > 25) {$total_result .= "I";}
		if ($RS > 25) {$total_result .= "S";}
		if ($RC > 25) {$total_result .= "C";}

		return $total_result;
	}

	public function getResult5($uid) {
		$code_str = "J,J,J,S,E,T,E,T,E,S,E,S,S,E,S,T,J,S,E,J,S,T,J,E,S,S,T,S,J,S,S,J,T,T,T,T,T,J,S,E,T,E,E,E,E,T,E,E,E,J,E,J,E,J,S,T,J,T,S,J,S,E,T,S,J,S,J,J,J,J,T,T,T,J,E,E,S,T,S,T";

		$cod = explode(",", $code_str);

		$ans_str = $this->candidate->getCorrResult5($uid);
		$ans = explode(",", $ans_str[0]['IPT']);
		$E = $S = $T = $J = "";
		for ($i = 0; $i < 80; $i++) {

			if ($cod[$i] == "E") {$E += $ans["$i"];}
			if ($cod[$i] == "S") {$S += $ans["$i"];}
			if ($cod[$i] == "T") {$T += $ans["$i"];}
			if ($cod[$i] == "J") {$J += $ans["$i"];}
		}

		$totalE = $E;
		$totalS = $S;
		$totalT = $T;
		$totalJ = $J;

		if ($E > 10) {$El = "E";}
		if ($E < 10) {$El = "I";}
		if ($E == 10) {$El = "E";}
		if ($S > 10) {$Sl = "S";}
		if ($S < 10) {$Sl = "N";}
		if ($S == 10) {$Sl = "S";}
		if ($T > 10) {$Tl = "T";}
		if ($T < 10) {$Tl = "F";}
		if ($T == 10) {$Tl = "T";}
		if ($J > 10) {$Jl = "J";}
		if ($J < 10) {$Jl = "P";}
		if ($J == 10) {$Jl = "J";}

		$test_result = $El . $Sl . $Tl . $Jl;

		return $test_result;
	}

	public function getResult6($uid) {
		$ans_str = $this->candidate->getCorrResult6($uid);
		$ans = explode(",", $ans_str[0]['test_6answer']);

		$i = 0;
		$correct = 0;
		$e_count = 0;
		$i_count = 0;
		$s_count = 0;
		$n_count = 0;
		$t_count = 0;
		$f_count = 0;
		$j_count = 0;
		$p_count = 0;

		while ($i <= 27) {
			if ($ans[$i] == 'E') {
				$e_count += 1;
			} elseif ($ans[$i] == 'I') {
				$i_count += 1;
			} elseif ($ans[$i] == 'S') {
				$s_count += 1;
			} elseif ($ans[$i] == 'N') {
				$n_count += 1;
			} elseif ($ans[$i] == 'T') {
				$t_count += 1;
			} elseif ($ans[$i] == 'F') {
				$f_count += 1;
			} elseif ($ans[$i] == 'J') {
				$j_count += 1;
			} elseif ($ans[$i] == 'P') {
				$p_count += 1;
			}
			$correct += 1;
			$i++;
		}

		$reportName = '';
		if ($e_count > $i_count) {
			$reportName .= 'E';
		} elseif ($i_count > $e_count) {
			$reportName .= 'I';
		}

		if ($s_count > $n_count) {
			$reportName .= 'S';
		} elseif ($n_count > $s_count) {
			$reportName .= 'N';
		}

		if ($t_count > $f_count) {
			$reportName .= 'T';
		} elseif ($f_count > $t_count) {
			$reportName .= 'F';
		}

		if ($j_count > $p_count) {
			$reportName .= 'J';
		} elseif ($p_count > $j_count) {
			$reportName .= 'P';
		}
		return $reportName;
	}

	public function getResult9($uid) {
		$ans = $this->candidate->getCorrResult9($uid);
		// var_dump($ans);die;
		$corr_Ans = $ans['corr'][0];
		$give_Ans = $ans['give'][0];

		$CA = explode(",", $corr_Ans['DST_secA']);
		$GA = explode(",", $give_Ans['DST_secA']);

		$CB = explode(",", $corr_Ans['DST_secB']);
		$GB = explode(",", $give_Ans['DST_secB']);

		$CC = explode(",", $corr_Ans['DST_secC']);
		$GC = explode(",", $give_Ans['DST_secC']);

		$data = array();

		$correct = 0;
		for ($i = 0; $i < count($CA); $i++) {
			if (@$GA[$i] === @$CA[$i]) {
				$correct += 1;
			}
		}

		$data['corr_A'] = number_format((($correct / 75) * 10), 0);

		$data['corr_A'] = $data['corr_A'] == 0 ? 1 : $data['corr_A'];
		$data['corr_A'] = $data['corr_A'] > 9 ? 9 : $data['corr_A'];

		$correct = 0;
		for ($i = 0; $i < count($CB); $i++) {
			if (@$GB[$i] === @$CB[$i]) {
				$correct += 1;
			}
		}

		$data['corr_B'] = number_format((($correct / 75) * 10), 0);
		$data['corr_B'] = $data['corr_B'] == 0 ? 1 : $data['corr_B'];
		$data['corr_B'] = $data['corr_B'] > 9 ? 9 : $data['corr_B'];

		$correct = 0;
		for ($i = 0; $i < count($CC); $i++) {
			if (@$GC[$i] === @$CC[$i]) {
				$correct += 1;
			}
		}

		$data['corr_C'] = number_format((($correct / 75) * 10), 0);
		$data['corr_C'] = $data['corr_C'] == 0 ? 1 : $data['corr_C'];
		$data['corr_C'] = $data['corr_C'] > 9 ? 9 : $data['corr_C'];

		return $data;

	}

	public function getResult12($uid) {
		$ans = $this->candidate->getCorrResult12($uid);
		// var_dump($ans);die;
		$corr_Ans = $ans['corr'][0];
		$give_Ans = $ans['give'][0];

		$CA = explode(",", $corr_Ans['test12_answer']);
		$GA = explode(",", $give_Ans['test12_answer']);

		$data = array();
		$correct = 0;
		for ($i = 0; $i < count($CA); $i++) {
			if (@$GA[$i] === @$CA[$i]) {
				$correct += 1;
			}
		}

		$data['corr_A'] = $correct;

		$data['corr_B'] = (55 - $correct);

		$data['corr_C'] = ($correct * 100) / 55;

		return $data;

	}

	public function getResult13($uid) {
		$score = $this->candidate->getCorrResult13($uid);
		return $score;
	}

	public function loadCandidate() {
		/** get loggedin user is from session */
		$userId = $this->session->userdata('logged_in')['user_id'];
		$test_id = $this->input->post('testId');
		/** initialization for paging */
//        $page = $this->input->post('page', TRUE);
		//        $current_page = $page;
		//        $page -= 1;
		//        $per_page = 10;
		//        $start = $page * $per_page;
		//        $limit = $per_page;
		//        $offset = $start;
		//        /** getting total record count */
		//        $record_count = count($this->company->getClientList(null, null, null));
		//        /** get record based on limit and offset */
		//        $result_page_data = $this->company->getClientList(null, $limit, $offset);
		$result_page_data = $this->candidate->getCandidateList($userId, $test_id);

		$i = 0;
		foreach ($result_page_data as $value) {
			$result_page_data[$i]->test_list = $this->candidate->getCandidateTestList($value->candidate_id)[0]->test_list;
			$i++;
		}
//        $data = array(
		//            'current_page' => $current_page,
		//            'record_count' => $record_count,
		//            'per_page' => $per_page,
		//            'client_result' => $result_page_data
		//        );
		//
		//$this->load->view('admin/_load-client-list', $data);/** Render view */
		$data = array(
			'candidateResult' => $result_page_data,
		);
		$this->load->view('_load-candidate-list', $data); /** Render view */
	}

	public function update() {

		if (is_numeric($this->uri->segment(3))) {
			$this->someProblem();
		}

		$candidateId = base64_decode($this->uri->segment(3));

		if (!is_numeric($candidateId)) {
			$this->someProblem();
		}

		$this->data['candidateData'] = $this->candidate->getCandidateInfo($candidateId);

		if (empty($this->data['candidateData'])) {
			$this->someProblem();
		}

		$post = $this->input->post();

		if ($post) {
			$this->form_validation->set_rules('full_name', 'full name', 'trim|required|xss_clean');
			if ($this->form_validation->run() == FALSE) {
				$this->layout->view('candidate-form', $this->data);
			} else {
				if ($this->candidate->updateCandidateInfo($post)) {
					$this->session->set_flashdata('msg_success', 'Participant details updated successfully.');
				} else {
					$this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
				}
				return redirect('candidate/managecandidate');
			}
		} else {
			$this->layout->view('candidate-form', $this->data);
		}
	}

	public function changeStatus() {
		$loggedinUser = $this->session->userdata('logged_in')['user_id'];
		$post = $this->input->post();
		$participantId = $post['participant_id'];
		$status = $post['status'];
		if (!empty($post)) {
			$data = array(
				'status' => $status,
				'last_updated_by' => $loggedinUser,
				'updated_at' => getCurrentDatetime(),
			);

			$this->db->where('id', $participantId);
			$this->db->update('user', $data);
			echo $status;
		}
		echo false;
	}

	public function test() {

		if ($this->test->getFirsttime()) {
			$this->session->set_flashdata('msg_error', 'Please Fill Your All Details Before Submit Test');
			return redirect('candidate/details');
		}

		if (!$this->candidate->check_terms()) {
			$this->session->set_flashdata('msg_error', 'You must agree with terms and condition to give test.');
			return redirect('test/Agree');
		}
		$candidateId = $this->session->userdata('logged_in')['user_id'];

		$this->data['testDetail'] = $this->test->getCandidateTestInfo($candidateId);
		$this->layout->view('test', $this->data);
	}

	public function details() {
		$candidateId = $this->session->userdata('logged_in')['user_id'];
		$this->data['candidateData'] = $this->candidate->getCandidateInfo($candidateId);
		$post = $this->input->post();
		if ($post) {
			//$this->form_validation->set_rules('full_name', 'full name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('marital_status', 'marital status', 'trim|required|xss_clean');
			$this->form_validation->set_rules('gender', 'gender', 'trim|required|xss_clean');
			$this->form_validation->set_rules('age', 'age', 'trim|required|xss_clean');
			$this->form_validation->set_rules('nationality', 'nationality', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('id_passport_no', 'ID/Passport Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('phone_no', 'phone number', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('home_language', 'home language', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('current_job_title', 'current job title', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('working_experience', 'working experience', 'trim|required|xss_clean');
			if ($this->form_validation->run() == FALSE) {
				$this->layout->view('candidate-detail-form', $this->data);
			} else {
				if ($this->candidate->registerDetail($post)) {
					$this->session->set_flashdata('msg_success', 'Your details updated successfully.');
				} else {
					$this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
				}
				return redirect('candidate/details');
			}
		} else {
			$this->layout->view('candidate-detail-form', $this->data);
		}
	}

	public function register() {
		$candidateId = $this->session->userdata('logged_in')['user_id'];
		$this->data['candidateData'] = $this->candidate->getCandidateInfo($candidateId);
		$post = $this->input->post();
		if ($post) {
			//$this->form_validation->set_rules('full_name', 'full name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('marital_status', 'marital status', 'trim|required|xss_clean');
			$this->form_validation->set_rules('gender', 'gender', 'trim|required|xss_clean');
			$this->form_validation->set_rules('age', 'age', 'trim|required|xss_clean');
			$this->form_validation->set_rules('nationality', 'nationality', 'trim|required|xss_clean');
			$this->form_validation->set_rules('id_passport_no', 'ID/Passport Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('phone_no', 'phone number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('home_language', 'home language', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('current_job_title', 'current job title', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('working_experience', 'working experience', 'trim|required|xss_clean');
			if ($this->form_validation->run() == FALSE) {
				$this->layout->view('candidate-detail-form', $this->data);
			} else {
				if ($this->candidate->registerDetail($post)) {
					return redirect('candidate/test');
				} else {
					$this->session->set_flashdata('msg_error', 'Opps! something went wrong, please try again.');
				}
				return redirect('candidate/register');
			}
		} else {
			$this->layout->view('candidate-detail-form', $this->data);
		}
	}

	public function consent() {
		$this->layout->view('consent');
	}

	public function loadProjectCandidate($id) {

		$result_page_data = $this->project->getProjectCandidate($id);
		$i = 0;
		foreach ($result_page_data as $value) {
			$data = array();
			$data['candidate_id'] = $value->id;
			$data['candidate_name'] = $value->full_name;
			$data['candidate_status'] = $value->status;
			$data['tc'] = $this->project->testCompleted($value->id);
			$this->data[$i] = $data;
			$i++;
		}

		$datas = array(
			'candidateResult' => @$this->data,
			'project_id' => $id,

		);
		$this->load->view('_load-project-candidate-list', $datas); /** Render view */
	}

	public function someProblem() {
		$this->session->set_flashdata('msg_warning', 'Opps! something went wrong, please try again.');
		return redirect('client/manageclient');
	}

}
