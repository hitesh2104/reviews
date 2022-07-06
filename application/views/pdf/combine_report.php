<?php

$fullName = iconv('UTF-8', 'windows-1252', $_POST['first_name'] . " " . $_POST['last_name']);

$u_title = "Executive Summary";
$u_name = iconv('UTF-8', 'windows-1252', $_POST['first_name']);
$gender = $_POST['gender'];
$og_u_name = "Integrate_Report";

$testCompletedDate = date('Y-m-d');
$rootPath = '';
$vowels = array(" ");
$u_name = str_replace($vowels, "-", $u_name);

require "fpdf/mc_table.php";
require_once APPPATH . 'third_party/jp_graph/jpgraph.php';
require_once APPPATH . 'third_party/jp_graph/jpgraph_bar.php';
require_once APPPATH . 'third_party/jp_graph/jpgraph_line.php';

class PDF extends PDF_MC_Table {

	function Header() {
		global $testCompletedDate;
		global $rootPath;
		if ($this->PageNo() !== 1) {
			$this->Image($rootPath . "images/perTestAssessmentHouse.png", 87, 10, 40);
			$this->SetTextColor(128, 128, 128);
			$this->SetFont('helvetica', '', 8);
			@$this->Cell(175, 7, $testCompletedDate, 0, 0, 'R');
			$this->Ln(20);
		}
	}

	function footer() {
		if ($this->PageNo() !== 1) {
			$this->SetY(-20);
			$this->SetX(160);
			$this->SetY(-15);
			$this->SetTextColor(128, 128, 128);
			$this->SetFont('helvetica', '', 10);
			$this->SetLineWidth(0.5);
			$this->SetDrawColor(128, 128, 128);
			$this->SetFillColor(128, 128, 128);
			$this->Line($this->GetX() - 15, $this->GetY(), 199, $this->GetY());
			$this->Cell(165, 10, iconv("UTF-8", "ISO-8859-1", "©") . " AssessmentHouse ", 0, 0, 'R');
			$this->rect($this->GetX() - 0.75, $this->GetY(), 10, 8, 'F');
			$this->SetTextColor(252, 252, 252);
			$this->Cell(6, 10, $this->PageNo(), 0, 0, 'R');
		}
	}

	function createTableWithFormating($data, $lastWidth = 12, $borderData = array(), $bgColorData = array(), $newHeight = 7, $boldFontData = array(), $align = 'L') {
		if ($newHeight == 0 || $newHeight == "") {
			$newHeight = 7;
		}
		$defaultBorderArr = array('F', 'FD', 'DF', 'RB');
		$nb = 0;
		$image_height = 0;
		for ($i = 0; $i < count($data); $i++) {
			if (strpos($data[$i], "IMAGE##") > -1) {
				$ar = explode("##", $data[$i]);
				$image_height = $ar[2] + 2;
			} else {
				$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
			}
		}
		$h = $newHeight * $nb;
		$h = max($h, $image_height);
		$this->CheckPageBreak($h);
		for ($i = 0; $i < count($data); $i++) {
			if ($i == (count($data) - 1)) {
				$w = $lastWidth;
			} else {
				$w = $this->widths[$i];
			}
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			$x = $this->GetX();
			$y = $this->GetY();
			if (strpos($data[$i], "IMAGE##") > -1) {
				$tmp = explode("##", $data[$i]);
				$data[$i] = $tmp[3];
				$this->SetFillColor(255, 255, 255);
				if (isset($borderData[$i]) && !empty($borderData[$i]) && in_array($borderData[$i], $defaultBorderArr)) {
					if ($borderData[$i] == "RB") {
						$this->Rect($x, $y, ($w - 0.2), ($h - 0.2), $borderData[$i]);
					} else {
						$this->Rect($x, $y, ($w), ($h), $borderData[$i]);
					}
				} else {
				}
				if (isset($borderData[$i]) && !empty($borderData[$i]) && !in_array($borderData[$i], $defaultBorderArr)) {
					$this->MultiCell($w, $h, $this->Image($data[$i], $this->GetX() + 1, $this->GetY() + 1, $tmp[1], $tmp[2]), $borderData[$i], 'C');
				} else {
					$this->MultiCell($w, 5, $this->Image($data[$i], $this->GetX() + 1, $this->GetY() + 1, $tmp[1], $tmp[2]), 0, 'C');
				}
			} else {
				$this->SetFont('helvetica', '');
				if (isset($boldFontData[$i]) && !empty($boldFontData[$i])) {
					$this->SetFont('helvetica', $boldFontData[$i]);
				}
				$this->SetTextColor(0, 0, 0);
				$this->SetFillColor(255, 255, 255);
				if (isset($bgColorData[$i]) && !empty($bgColorData[$i])) {
					$c = explode(", ", $bgColorData[$i]);
					$c[0] = isset($c[0]) ? $c[0] : 204;
					$c[1] = isset($c[1]) ? $c[1] : 255;
					$c[2] = isset($c[2]) ? $c[2] : 255;
					$this->SetFillColor($c[0], $c[1], $c[2]);
				}
				if (isset($borderData[$i]) && !empty($borderData[$i]) && in_array($borderData[$i], $defaultBorderArr)) {
					$this->Rect($x, $y, $w, $h, $borderData[$i]);
				} elseif (isset($borderData[$i]) && !empty($borderData[$i]) && !in_array($borderData[$i], $defaultBorderArr)) {
				} else {
					$this->Rect($x, $y, $w, $h);
				}
				if (isset($borderData[$i]) && !empty($borderData[$i]) && !in_array($borderData[$i], $defaultBorderArr)) {
					if (isset($bgColorData[$i]) && !empty($bgColorData[$i])) {
						$this->MultiCell($w, $newHeight, $data[$i], $borderData[$i], $align, true);
					} else {
						$this->MultiCell($w, $newHeight, $data[$i], $borderData[$i], $align);
					}
				} else {
					$this->MultiCell($w, $newHeight, $data[$i], 0, $align);
				}
			}
			$this->SetXY($x + $w, $y);
		}
		$this->Ln($h);
	}

	function createTableWithFormatingDip($data, $lastWidth = 12, $borderData = array(), $boldFontData = array(), $bgColorData = array(), $textColorData = array(), $newHeight = 7, $align = 'L') {
		if ($newHeight == 0 || $newHeight == "") {$newHeight = 7;}
		$defaultBorderArr = array('F', 'FD', 'DF', 'RB');
		//Calculate the height of the row
		//kamal , new code to fix
		// 1. Image overflow
		// 2. page break
		// 3. and height of the row
		$nb = 0;
		$image_height = 0;
		for ($i = 0; $i < count($data); $i++) {
			if (strpos($data[$i], "IMAGE##") > -1) {
				$ar = explode("##", $data[$i]);
				$image_height = $ar[2] + 2; // we have added 2 for a margin
			} else {
				$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
			}
		}
		$h = $newHeight * $nb;
		$h = max($h, $image_height);
		//end of new code
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for ($i = 0; $i < count($data); $i++) {
			if ($i == (count($data) - 1)) {
				$w = $lastWidth;
			} else {
				$w = $this->widths[$i];
			}
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x = $this->GetX();
			$y = $this->GetY();

			//Print the text
			if (strpos($data[$i], "IMAGE##") > -1) {
				$tmp = explode("##", $data[$i]);
				$data[$i] = $tmp[3];

				//Apply background color
				$this->SetFillColor(255, 255, 255);
				if (isset($bgColorData[$i]) && !empty($bgColorData[$i])) {
					$c = explode(", ", $bgColorData[$i]);
					$c[0] = isset($c[0]) ? $c[0] : 204;
					$c[1] = isset($c[1]) ? $c[1] : 255;
					$c[2] = isset($c[2]) ? $c[2] : 255;
					$this->SetFillColor($c[0], $c[1], $c[2]);
				}
				//Apply border
				if (isset($borderData[$i]) && !empty($borderData[$i]) && in_array($borderData[$i], $defaultBorderArr)) {
					/* D or empty string: draw. This is the default value.
						                        F: fill
						                        DF or FD: draw and fill
						                        RB: Reduce border width & height
					*/
					//Draw the border
					if ($borderData[$i] == "RB") {
						$this->Rect($x, $y, ($w - 0.2), ($h - 0.2), $borderData[$i]);
					} else {
						$this->Rect($x, $y, ($w), ($h), $borderData[$i]);
					}
				} else {
					//Draw the border
					//$this->Rect($x,$y,$w,$h);
				}

				# Add image
				if (isset($borderData[$i]) && !empty($borderData[$i]) && !in_array($borderData[$i], $defaultBorderArr)) {
					$this->MultiCell($w, $h, $this->Image($data[$i], $this->GetX() + 1, $this->GetY() + 1, $tmp[1], $tmp[2]), $borderData[$i], 'C');
				} else {
					$this->MultiCell($w, 5, $this->Image($data[$i], $this->GetX() + 1, $this->GetY() + 1, $tmp[1], $tmp[2]), 0, 'C');
				}

			} else {
				//Apply font setting
				$this->SetFont('Arial', '');
				if (isset($boldFontData[$i]) && !empty($boldFontData[$i])) {
					$this->SetFont('Arial', $boldFontData[$i]);
				}

				//Apply Text color
				$this->SetTextColor(0, 0, 0);
				if (isset($textColorData[$i]) && !empty($textColorData[$i])) {
					$tc = explode(", ", $textColorData[$i]);
					$tc[0] = isset($tc[0]) ? $tc[0] : 0;
					$tc[1] = isset($tc[1]) ? $tc[1] : 0;
					$tc[2] = isset($tc[2]) ? $tc[2] : 0;
					$this->SetTextColor($tc[0], $tc[1], $tc[2]);
				}

				//Apply background color
				$this->SetFillColor(255, 255, 255);
				if (isset($bgColorData[$i]) && !empty($bgColorData[$i])) {
					$c = explode(", ", $bgColorData[$i]);
					$c[0] = isset($c[0]) ? $c[0] : 204;
					$c[1] = isset($c[1]) ? $c[1] : 255;
					$c[2] = isset($c[2]) ? $c[2] : 255;
					$this->SetFillColor($c[0], $c[1], $c[2]);
				}

				//Apply border
				if (isset($borderData[$i]) && !empty($borderData[$i]) && in_array($borderData[$i], $defaultBorderArr)) {
					/* D or empty string: draw. This is the default value.
						                        F: fill
					*/
					//Draw the border
					$this->Rect($x, $y, $w, $h, $borderData[$i]);

				} elseif (isset($borderData[$i]) && !empty($borderData[$i]) && !in_array($borderData[$i], $defaultBorderArr)) {
					//Draw the border
					//$this->Rect($x,$y,$w,$h,$borderData[$i]);
				} else {
					//Draw the border
					$this->Rect($x, $y, $w, $h);
				}
				if (isset($borderData[$i]) && !empty($borderData[$i]) && !in_array($borderData[$i], $defaultBorderArr)) {
					//echo $data[$i];
					if (isset($bgColorData[$i]) && !empty($bgColorData[$i])) {
						$this->MultiCell($w, $newHeight, $data[$i], $borderData[$i], $align, true);
					} else {
						$this->MultiCell($w, $newHeight, $data[$i], $borderData[$i], $align);
					}
				} else {
					$this->MultiCell($w, $newHeight, $data[$i], 0, $align);
				}
			}
			//$this->MultiCell($w,5,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x + $w, $y);
		}
		//Go to the next line
		$this->Ln($h);
	}

}

$pdf = new PDF("P", "mm", "A4");
$pdf->AddPage();
$imgPath = "IMAGE##80##10##" . $rootPath . "images/rpt_chk/";
$pdf->AliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
$pdf->Image($rootPath . "images/IAR.jpg", -1, 0, 211, 298);
$pdf->SetY(255);
$pdf->SetX(80);
$pdf->SetFont('helvetica', '', 23);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(105, 10, $fullName, 0, 1, 'C');
$pdf->SetX(80);
$pdf->SetFont('helvetica', '', 18);
$pdf->Cell(105, 10, '(' . $testCompletedDate . ')', 0, 0, 'C');
$pdf->SetTextColor(0, 0, 0);

// report executive summary
if ($isExcSummary == 1) {
	$pdf->CheckPageBreak(250);
	include 'exc_summary_comman_code.php';
} else {

}

// report combine
if (isset($_POST['test_list']) && count($_POST['test_list']) > 0) {

	foreach ($_POST['test_list'] as $value) {

		if ($value == 1) {

			function getScore($code = '', $totVal) {
				if ($code == 'C1' || $code == 'C2' || $code == 'C3' || $code == 'C4') {
					if ($totVal >= 9 && $totVal <= 16.99) {
						return 1;
					} elseif ($totVal >= 17 && $totVal < 24.99) {
						return 2;
					} elseif ($totVal >= 25 && $totVal < 32.99) {
						return 3;
					} elseif ($totVal >= 33 && $totVal < 40.99) {
						return 4;
					} elseif ($totVal >= 41 && $totVal < 48.99) {
						return 5;
					} elseif ($totVal >= 49 && $totVal < 56.99) {
						return 6;
					} elseif ($totVal >= 57 && $totVal < 64.99) {
						return 7;
					} elseif ($totVal >= 65 && $totVal < 72.99) {
						return 8;
					} elseif ($totVal >= 73 && $totVal < 80.99) {
						return 9;
					} elseif ($totVal >= 81 && $totVal < 90) {
						return 10;
					} else {
						return 0;
					}
				} else {
					if ($totVal > 0 && $totVal < 5) {
						return 1;
					} elseif ($totVal >= 5 && $totVal < 10) {
						return 2;
					} elseif ($totVal >= 10 && $totVal < 15) {
						return 3;
					} elseif ($totVal >= 15 && $totVal < 20) {
						return 4;
					} elseif ($totVal >= 20 && $totVal < 25) {
						return 5;
					} elseif ($totVal >= 25 && $totVal < 30) {
						return 6;
					} elseif ($totVal >= 30 && $totVal < 35) {
						return 7;
					} elseif ($totVal >= 35 && $totVal < 40) {
						return 8;
					} elseif ($totVal >= 40 && $totVal < 45) {
						return 9;
					} elseif ($totVal >= 45) {
						return 10;
					} else {
						return 0;
					}
				}
			}

			function getRulebase($codeArr, $totVal) {
				if ($totVal == 1 || $totVal == 2) {
					return $codeArr['score_def_1and2'];
				} else if ($totVal == 3) {
					return $codeArr['score_def_3'];
				} else if ($totVal == 4 || $totVal == 5) {
					return $codeArr['score_def_4and5'];
				} else if ($totVal == 6) {
					return $codeArr['score_def_6'];
				} else if ($totVal == 7 || $totVal == 8) {
					return $codeArr['score_def_7and8'];
				} else if ($totVal == 9 || $totVal == 10) {
					return $codeArr['score_def_9and10'];
				} else {
					return '';
				}
			}

			function getNativeRule($codeArr, $totVal) {
				if ($totVal == 1 || $totVal == 2) {
					return $codeArr['native_rule_1and2'];
				} else if ($totVal == 3) {
					return $codeArr['native_rule_3'];
				} else if ($totVal == 4) {
					return $codeArr['native_rule_4and5'];
				} else if ($totVal == 5 || $totVal == 6) {
					return $codeArr['native_rule_6'];
				} else if ($totVal == 7 || $totVal == 8) {
					return $codeArr['native_rule_7and8'];
				} else if ($totVal == 9 || $totVal == 10) {
					return $codeArr['native_rule_9and10'];
				} else {
					return $codeArr['native_rule_0'];
				}
			}

			$pdf->CheckPageBreak(250);
			$sectionArr = array('Behavioural Intelligence', 'Emotional Intelligence', 'Cultural Intelligence');
			$clusterArr['Behavioural Intelligence'] = array('Business Intent', 'Communication', 'Leadership Intent', 'Creative Intent', 'Process Orientation', 'Solutions Intent', 'Results Driven', 'Strategic Intent');

			foreach ($test_code as $key => $row) {

				if ($row['section_name'] != 'Behavioural Intelligence') {
					$clusterArr[$row['section_name']][$row['cluster']] = $row['cluster'];
				}
				$competencyArr[$row['section_name']][$row['cluster']][$row['code']] = $row;
			}

			$maxQuestionId = 0;
			foreach ($test_ans as $row) {

				if (isset($ansArr[$row['code']])) {
					$ansArr[$row['code']] = $ansArr[$row['code']] + $row['answer'];
				} else {
					$ansArr[$row['code']] = $row['answer'];
				}
				if ($row['questions_id'] > $maxQuestionId) {
					$maxQuestionId = $row['questions_id'];
					$testCompletedDate = $row['created_date'];
				}
				$testCompletedDate = $row['created_date'];
			}

			//test 1 content
			$pdf->SetFont('helvetica', 'B', 18);
			$pdf->SetDrawColor(79, 129, 189);
			$pdf->SetFillColor(79, 129, 189);
			$pdf->Cell(160, 12, 'Behavioural, Emotional and Cultural Intelligence', 1, 0, 'C', 1);
			$pdf->Ln(20);
			$pdf->SetFont('helvetica', '', 12.5);
			$pdf->MultiCell(160, 8, 'BECi, which is short for Behavioural, Emotional and Cultural Intelligence, provides detailed information about various attributes and competencies that gives context to the personality and behavioural make-up of an individual. It represents a powerful interpretation to assist the user when preparing for a feedback, writing reports, or interpreting information across a range of other contexts.');
			$pdf->Ln(13);
			$pdf->Image($rootPath . "images/bec_img.png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);
			$pdf->Ln(95);
			$pdf->MultiCell(160, 8, "It therefore provides a profile of the individual's relative preferences and behaviours when at work.");
			$pdf->Ln(5);
			$pdf->MultiCell(160, 8, "This report is divided into 3 sections:\n    " . chr(149) . "  Behavioural Intelligence\n    " . chr(149) . "  Emotional Intelligence \n    " . chr(149) . "  Cultural Intelligence ");
			$pdf->CheckPageBreak(250);
			//print_r($sectionArr); die;
			foreach ($sectionArr as $sKey => $section) {
				$pdf->SetFont('helvetica', 'B', 15);
				$secArr = explode(" ", $section);
				if ($sKey == 0) {
					$pdf->SetTextColor(255, 255, 255);
					$pdf->SetFillColor(15, 36, 62);
					$pdf->SetDrawColor(15, 36, 62);
					$pdf->Cell(80, 12, $secArr[0] . " ", 1, 0, 'R', 1);
					$pdf->SetTextColor(15, 36, 62);
					$pdf->Cell(80, 12, $secArr[1], 1, 0);

				} else if ($sKey == 1) {
					$pdf->SetTextColor(255, 255, 255);
					$pdf->SetFillColor(111, 9, 0);
					$pdf->SetDrawColor(111, 9, 0);
					$pdf->Cell(80, 12, $secArr[0] . " ", 1, 0, 'R', 1);
					$pdf->SetTextColor(111, 9, 0);
					$pdf->Cell(80, 12, $secArr[1], 1, 0);

				} else if ($sKey == 2) {
					$pdf->SetTextColor(255, 255, 255);
					$pdf->SetFillColor(0, 96, 97);
					$pdf->SetDrawColor(0, 96, 97);
					$pdf->Cell(80, 12, $secArr[0] . " ", 1, 0, 'R', 1);
					$pdf->SetTextColor(0, 96, 97);
					$pdf->Cell(80, 12, $secArr[1], 1, 0);
				}
				$pdf->SetTextColor(0, 0, 0);
				$pdf->Ln(18);
				$culNo = 0;
				$bgColorArr = array('219, 229, 241', '242, 219, 219', '218, 238, 243');
				$tempNameArr = array();
				foreach ($clusterArr[$section] as $key => $cluster) {
					//print_r($clusterArr[$section]); die;
					$culNo++;
					$pdf->SetFont('helvetica', 'B', 12);
					$pdf->SetTextColor(255, 255, 255);
					if ($section == 'Behavioural Intelligence') {
						$pdf->SetFillColor(31, 73, 125);
						$pdf->Cell(160, 9, " " . $cluster, 1, '', '', 1);
						$pdf->Ln(9);
					} else if ($section == 'Emotional Intelligence') {
						$pdf->SetFillColor(148, 17, 0);
						$pdf->Cell(160, 9, " " . $cluster, 1, '', '', 1);
						$pdf->Ln(9);
					}
					$interpretation = '';
					foreach ($competencyArr[$section][$cluster] as $code) {
						//print_r($code); die;

						$pdf->SetFont('helvetica', 'I', 10);
						if ($section == 'Behavioural Intelligence') {
							$pdf->SetFillColor(84, 141, 212);
							$pdf->SetTextColor(0, 0, 0);
						} else if ($section == 'Emotional Intelligence') {
							$pdf->SetTextColor(255, 255, 255);
							$pdf->SetFillColor(192, 0, 0);
						} else {
							$pdf->SetFillColor(0, 145, 147);
							$pdf->SetTextColor(0, 0, 0);
						}
						$tempNameArr[] = array('competency' => $code['competency'], 'definition' => $code['definition']);
						$pdf->Cell(80, 7, " " . $code['competency'], 1, '', '', 1);
						$pdf->Cell(80, 7, " ", 'TR');
						$pdf->Ln(7);
						$pdf->SetFont('helvetica', '', 9);
						$answer = isset($ansArr[$code['code']]) ? $ansArr[$code['code']] : 0;
						$borderData = array('DF', 'LRB', 'DF', 'DF', 'DF', 'DF');
						$pdf->SetWidths(array(80, 80));
						$score = getScore($code['code'], $answer);
						$interpretation .= getNativeRule($code, $score) . " ";
						$printData = array(getRulebase($code, $score), $imgPath . 'check_' . $sKey . '_' . $score . '.png');
						$pdf->createTableWithFormating($printData, 80, $borderData, array($bgColorArr[$sKey]), 5);
					}

					$pdf->Ln(10);
					$pdf->SetFont('helvetica', 'B', 12);
					$pdf->Cell(80, 7, "Interpretation");
					$pdf->Ln(10);
					$interpretation = str_replace('Name ', $fullName . ' ', $interpretation);
					if ($gender == 'female') {
						$searchArr = array('He ', 'His ', ' he ', ' his ', 'himself ');
						$replaceArr = array('She ', 'Her ', ' she ', ' her ', 'herself ');
						$interpretation = str_replace($searchArr, $replaceArr, $interpretation);
						/*$interpretation = str_ireplace('He ', 'She ', $interpretation);
							                                $interpretation = str_ireplace('His ', 'Her ', $interpretation);
							                                $interpretation = str_ireplace(' he ', ' she ', $interpretation);
						*/
					}
					$pdf->SetFont('helvetica', '', 9);
					$pdf->MultiCell(160, 5, $interpretation);
					$pdf->Ln(8);
					$pdf->CheckPageBreak(250);
					/*if ($culNo == 2 || $cluster == 'Self Management') {
						                                $pdf->CheckPageBreak(250);
						                                $culNo = 0;
					*/
				}

				sort($tempNameArr);
				$competNameArr[$section] = $tempNameArr;

				$pdf->SetTextColor(0, 0, 0);
				$pdf->SetFillColor(255, 255, 255);
			}

			//$pdf->CheckPageBreak(250);
			$pdf->SetFont('helvetica', 'B', 15);
			$pdf->SetDrawColor(79, 129, 189);
			$pdf->SetFillColor(79, 129, 189);
			$pdf->Cell(80, 12, 'Competency  ', 1, 0, 'R', 1);
			$pdf->SetTextColor(79, 129, 189);
			$pdf->Cell(80, 12, 'Definitions', 1, 1, 1);
			$pdf->SetTextColor(0, 0, 0);
			$bgColorArr[0] = array('219, 229, 241', '219, 229, 241');
			$bgColorArr[1] = array('242, 219, 219', '242, 219, 219');
			$bgColorArr[2] = array('218, 238, 243', '218, 238, 243');
			$hbgColorArr[0] = array('79, 129, 189', '79, 129, 189');
			$hbgColorArr[1] = array('192, 80, 77', '192, 80, 77');
			$hbgColorArr[2] = array('0, 145, 147', '0, 145, 147');
			$borderData = array('DF', 'DF');
			$pdf->SetWidths(array(50, 110));
			foreach ($sectionArr as $sKey => $section) {
				$flag = 0;
				$pdf->SetFont('helvetica', 'B', 10);
				$pdf->SetTextColor(255, 255, 255);
				$pdf->Ln(10);
				if ($sKey == 0) {
					$pdf->SetDrawColor(79, 129, 189);
					$pdf->SetFillColor(79, 129, 189);
				} else if ($sKey == 1) {
					$pdf->SetDrawColor(192, 80, 77);
					$pdf->SetFillColor(192, 80, 77);
				} else if ($sKey == 2) {
					$pdf->SetDrawColor(0, 145, 147);
					$pdf->SetFillColor(0, 145, 147);
				}
				$pdf->Cell(50, 8, 'COMPETENCY  ', 1, 0, '', 1);
				$pdf->Cell(110, 8, 'DEFINITION', 1, 1, '', 1);
				$pdf->SetTextColor(0, 0, 0);
				/*foreach ($clusterArr[$section] as $key => $cluster) {
                            $culNo++;*/
				foreach ($competNameArr[$section] as $code) {
					$printData = array($code['competency'], $code['definition']);
					if ($flag == 0) {
						$flag = 1;
						$pdf->createTableWithFormating($printData, 110, $borderData, $bgColorArr[$sKey], 6, array('B', ''));
					} else {
						$flag = 0;
						$pdf->createTableWithFormating($printData, 110, $borderData, array(), 6, array('B', ''));
					}
				}
				/*}*/
				$pdf->SetTextColor(0, 0, 0);
				$pdf->SetFillColor(255, 255, 255);
			}
		} elseif ($value == 2) {
			$pdf->CheckPageBreak(250);

			$he = "he";
			$He = "He";
			$his = "his";
			$him = "him";

			if ($gender != "male") {
				$he = "she";
				$He = "She";
				$his = "her";
				$him = "her";
			}
			// heading
			$heading_ = "";
			$score_ = "";
			$sub_score_ = "";

			// heading
			$heading_1 = "SST LEVEL 1 - TANGIBLE BRILLIANCE";
			$heading_2 = "SST LEVEL 2 - EXCELLENCE CLARIFICATION";
			$heading_3 = "SST LEVEL 2 - EXCELLENCE CLARIFICATION";
			$heading_4 = "SST LEVEL 3 - STRATEGY EXECUTION";
			$heading_5 = "SST LEVEL 3 - STRATEGY EXECUTION";
			$heading_6 = "SST LEVEL 4 - STRATEGY CONTEXTUALISING";
			$heading_7 = "SST LEVEL 4 - STRATEGY CONTEXTUALISING";
			$heading_8 = "SST LEVEL 5 - STRATEGY CONCEPTUALISING";
			// data

			$potentail = "With the appropriate development and necessary exposure, $u_name  shows the potential to transition to the following work level:";

			//1
			$score_1 = "$u_name seems to be more comfortable working in an environment with tangible outputs where quality is $his main priority. $He may prefer to follow a clear set of guidelines to perform optimally and is more inclined to function in an operational and/or technical environment. A structured environment will probably suite $him better where $he can plan and organise $his daily activities. $He might also be more inclined to follow routines as this will make $his work activities more predictable and measurable.";
			$sub_score_1 = "Leaders on this level are usually leaders of self, having to manage their own work schedules and plan their own day-to-day activities. ";
			//2
			$score_2 = "It seems that $u_name might find working in an environment where $he has to solve problems where answers is not very clear by using $his knowledge and/or experience. $u_name tends to ask clarifying questions to ensure $he gets to the correct answer or solution. The environment $he seems to prefer to work in is mostly structured and routine-based, however with some flexibility of choice";

			$sub_score_2 = "Leaders on this level tend to lead self as well as moving into an environment where they may be required to manage other technical and/or operational people.`";
			//3

			$score_3 = "It seems that $u_name might find working in an environment where $he has to solve problems where answers is not very clear by using $his knowledge and/or experience. $u_name tends to ask clarifying questions to ensure $he gets to the correct answer or solution. The environment $he seems to prefer to work in is mostly structured and routine-based, however with some flexibility of choice";

			$sub_score_3 = "Leaders on this level tend to lead self as well as moving into an environment where they may be required to manage other technical and/or operational people.`";

			$score_4 = "It seems that $u_name should find it comfortable working in environments that offer some strategic involvement, more specifically the execution of strategic plans. Thinking things through and effectively using and distributing resources effectively is a main component of this level which $he should be able to perform effectively. $u_name probably know how the operational day-to-day activities link to the long term strategy of the organisation.";

			$sub_score_4 = "Leaders on this level are usually leaders of others, at times leader of other first-line managers and/or supervisors.";

			$score_5 = "It seems that $u_name should find it comfortable working in environments that offer some strategic involvement, more specifically the execution of strategic plans. Thinking things through and effectively using and distributing resources effectively is a main component of this level which $he should be able to perform effectively. $u_name probably know how the operational day-to-day activities link to the long term strategy of the organisation.";

			$sub_score_5 = "Leaders on this level are usually leaders of others, at times leader of other first-line managers and/or supervisors.";

			// 4

			$score_6 = "The strategy contextualising environment requires someone to develop strategies to keep the company aligned to what is required to be viable in the future. $u_name seems to enjoy working across different business units, preferring a less structured working environment. Routine and day-to-day operational activities will probably be less motivating as a more challenging environment where decisions are more complex will probably be more motivating to $him. Innovation and thinking outside the box is probably more stimulating to $u_name and making decisions where the answer is not always that obvious and/or clear.";

			$sub_score_6 = "Leaders on this level usually lead other senior managers within an organisation.";

			$score_7 = "The strategy contextualising environment requires someone to develop strategies to keep the company aligned to what is required to be viable in the future. $u_name seems to enjoy working across different business units, preferring a less structured working environment. Routine and day-to-day operational activities will probably be less motivating as a more challenging environment where decisions are more complex will probably be more motivating to $him. Innovation and thinking outside the box is probably more stimulating to $u_name and making decisions where the answer is not always that obvious and/or clear.";

			$sub_score_7 = "Leaders on this level usually lead other senior managers within an organisation.";

			$score_8 = "Conceptualising strategies for future industry viability is a key component for individuals working on this level. It seems that $u_name has the capability to deal with the complexity of this environment, thus working with information that is vague and/or mostly unavailable. $He probably finds it stimulating to work in environments that offer little if any structure at all. Working and thinking about the macro economy and making decisions that can impact the whole organisation will probably stimulate $him.";

			$sub_score_8 = "Leaders on this level usually manage numerous business units and at times probably different organisations. They can think across different systems and/or units, being good CEO’s of large organisations.";

			$pdf->Image($rootPath . "images/mira_report/mira_first.jpg", -1, $pdf->GetY() - 5, 211, 258);
			$pdf->SetY(255);
			$pdf->SetX(80);
			$pdf->CheckPageBreak(250);

			$pdf->SetFont('helvetica', 'B', 15);
			$pdf->SetFillColor(79, 129, 189);
			@$pdf->Cell(0, 12, ${'heading_' . $score2}, 0, 0, 'C', 1);
			$pdf->SetTextColor(0, 0, 0);

			$pdf->Ln(30);

			$pdf->Image($rootPath . "images/mira_report/MIRA_Image_2.png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);

			$pdf->Ln(110);
			$pdf->SetFont('helvetica', '', 12.5);
			@$pdf->MultiCell(160, 8, ${'score_' . $score2});

			$pdf->Ln(10);

			@$pdf->MultiCell(160, 8, ${'sub_score_' . $score2});

			if ($score2 == 1) {
				$pdf->Ln(30);

				$pdf->SetFont('helvetica', 'B', 15);
				$pdf->SetFillColor(79, 129, 189);
				$pdf->Cell(0, 12, 'POTENTIAL TRANSITIONING', 0, 0, 'C', 1);
				$pdf->Ln(20);

				$pdf->SetFont('helvetica', '', 12.5);
				$pdf->MultiCell(160, 8, $potentail);
				$pdf->Ln(10);

				$pdf->SetFont('helvetica', 'B', 15);
				$pdf->SetFillColor(79, 129, 189);
				$pdf->Cell(0, 12, ${'heading_2'}, 0, 0, 'C', 1);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->Ln(20);

				$pdf->SetFont('helvetica', '', 12.5);
				$pdf->MultiCell(160, 8, ${'score_2'});
				$pdf->Ln(10);
				$pdf->MultiCell(160, 8, ${'sub_score_2'});

			} else if ($score2 == 3) {
				$pdf->Ln(30);

				$pdf->SetFont('helvetica', 'B', 15);
				$pdf->SetFillColor(79, 129, 189);
				$pdf->Cell(0, 12, 'POTENTIAL TRANSITIONING', 0, 0, 'C', 1);
				$pdf->Ln(20);

				$pdf->SetFont('helvetica', '', 12.5);
				$pdf->MultiCell(160, 8, $potentail);
				$pdf->Ln(10);

				$pdf->SetFont('helvetica', 'B', 15);
				$pdf->SetFillColor(79, 129, 189);
				$pdf->Cell(0, 12, ${'heading_4'}, 0, 0, 'C', 1);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->Ln(20);

				$pdf->SetFont('helvetica', '', 12.5);
				$pdf->MultiCell(160, 8, ${'score_4'});
				$pdf->Ln(10);
				$pdf->MultiCell(160, 8, ${'sub_score_4'});

			} else if ($score2 == 5) {
				$pdf->Ln(30);

				$pdf->SetFont('helvetica', 'B', 15);
				$pdf->SetFillColor(79, 129, 189);
				$pdf->Cell(0, 12, 'POTENTIAL TRANSITIONING', 0, 0, 'C', 1);
				$pdf->Ln(20);

				$pdf->SetFont('helvetica', '', 12.5);
				$pdf->MultiCell(160, 8, $potentail);
				$pdf->Ln(10);

				$pdf->SetFont('helvetica', 'B', 15);
				$pdf->SetFillColor(79, 129, 189);
				$pdf->Cell(0, 12, ${'heading_6'}, 0, 0, 'C', 1);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->Ln(20);

				$pdf->SetFont('helvetica', '', 12.5);
				$pdf->MultiCell(160, 8, ${'score_6'});
				$pdf->Ln(10);
				$pdf->MultiCell(160, 8, ${'sub_score_6'});

			} else if ($score2 == 7) {
				$pdf->Ln(30);

				$pdf->SetFont('helvetica', 'B', 15);
				$pdf->SetFillColor(79, 129, 189);
				$pdf->Cell(0, 12, 'POTENTIAL TRANSITIONING', 0, 0, 'C', 1);
				$pdf->Ln(20);

				$pdf->SetFont('helvetica', '', 12.5);
				$pdf->MultiCell(160, 8, $potentail);
				$pdf->Ln(10);

				$pdf->SetFont('helvetica', 'B', 15);
				$pdf->SetFillColor(79, 129, 189);
				$pdf->Cell(0, 12, ${'heading_8'}, 0, 0, 'C', 1);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->Ln(20);

				$pdf->SetFont('helvetica', '', 12.5);
				$pdf->MultiCell(160, 8, ${'score_8'});
				$pdf->Ln(10);
				$pdf->MultiCell(160, 8, ${'sub_score_8'});
			}

		} elseif ($value == 3) {
			function getStatus3($code) {
				if ($code >= 1 AND $code <= 3) {
					return "Low";
				} elseif ($code >= 4 AND $code <= 6) {
					return "Effective";
				} else {
					return "Enhanced";
				}
			}
			$pdf->CheckPageBreak(250);

			$pdf->SetFont('helvetica', 'B', 18);
			$pdf->SetDrawColor(79, 129, 189);
			$pdf->SetFillColor(79, 129, 189);
			$pdf->Cell(160, 12, 'Learning Agility Profile', 1, 0, 'C', 1);
			$pdf->Ln(20);
			$pdf->SetFont('helvetica', '', 12.5);
			$pdf->MultiCell(160, 8, iconv('UTF-8', 'windows-1252', 'LAP, The Learning Agility Profile, or LAP, is a learning potential assessment that measures an individual’s potential to learn new information in a variety of formats and settings. The candidate will be trained to perform various basic tasks, then tested on how well the candidate can solve basic problems based on what they learned during this test.'));
			$pdf->Ln(13);
			$pdf->Image($rootPath . "images/rpt_chk/check_2_" . $score3 . ".png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);
			$pdf->Ln(20);

			$section_A_result = $Secscore3[0]->LAP_S_A;
			$section_B_result = $Secscore3[0]->LAP_S_B;
			$section_C_result = $Secscore3[0]->LAP_S_C;
			$section_D_result = $Secscore3[0]->LAP_S_D;

			$section_A_result = $section_A_result / 0.2;
			$section_B_result = $section_B_result / 0.3;
			$section_C_result = $section_C_result / 0.2;
			$section_D_result = $section_D_result / 0.3;

			$data = array(
				array(
					'1' => "Reasoning",
					'4' => "The ability to interpret information",
					'5' => "and drawing accurate conclusions",
					'2' => $section_A_result,
					'3' => getStatus3($section_A_result),
				),

				array(
					'1' => "Memory",
					'4' => "The ability to accurately recall information.",
					'5' => "",
					'2' => $section_B_result,
					'3' => getStatus3($section_B_result),

				),

				array('1' => "Spatial Orientation The",
					"4" => "ability to manipulate and visualise shapes",
					"5" => "and patterns.",
					'2' => $section_C_result,
					'3' => getStatus3($section_C_result),
				),

				array('1' => "Numeracy",
					"4" => "The ability to accurately perform basic",
					"5" => "numerical calculations.",
					'2' => $section_D_result,
					'3' => getStatus3($section_D_result),
				),
			);

			$pdf->SetFillColor(217, 217, 217);
			$pdf->SetTextColor(0);
			$pdf->SetDrawColor(0, 0, 0);
			$pdf->SetLineWidth(.3);

			// Title row
			$pdf->SetFont('', 'B');
			$pdf->Cell(120, 8, "LEARNING POTENTIAL", 1, 0, 'L', true);
			$pdf->SetFont('', '');
			$pdf->Cell(20, 8, "Score", 1, 0, 'C', true);
			$pdf->Cell(20, 8, "Results", 1, 0, 'C', true);
			$pdf->Ln();

			// Data rows
			$m = 0;
			foreach ($data as $row) {
				$pdf->SetTextColor(0);
				$pdf->SetFont('', 'B');
				$pdf->Cell(120, 8, $data[$m][1], "LTR", 0, 'L');
				$pdf->Cell(20, 8, "", "LTR");
				$pdf->Cell(20, 8, "", "LTR");
				$pdf->Ln();
				$pdf->SetTextColor(0);
				$pdf->SetFont('', '');
				$pdf->Cell(120, 8, $data[$m][4], "LR", 0, 'L');
				$pdf->SetFont('', '');
				$pdf->Cell(20, 8, $data[$m][2], '', '', "C");
				$pdf->Cell(20, 8, $data[$m][3], "LR", '', 'C');
				$pdf->Ln();
				$pdf->SetTextColor(0);
				$pdf->SetFont('', '');
				$pdf->Cell(120, 8, $data[$m][5], "LBR", 0, 'L');
				$pdf->Cell(20, 8, "", "LBR");
				$pdf->Cell(20, 8, "", "LBR");
				$pdf->Ln();
				$m++;
			}

			$pdf->Ln();

			$pdf->SetFont('', 'B');
			$pdf->SetFillColor(192, 0, 0);
			$pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252', "1 – 3 Low"), 1, 0, 'C', true);
			$pdf->SetFillColor(247, 150, 70);
			$pdf->Cell(54, 8, iconv('UTF-8', 'windows-1252', "4 – 6 Effective"), 1, 0, 'C', true);
			$pdf->SetFillColor(0, 176, 80);
			$pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252', "7 – 9 Enhanced"), 1, 0, 'C', true);
			$pdf->Ln();

			$pdf->Ln(10);

		}
		// elseif ($value==4) {
		//     $pdf->CheckPageBreak(250);
		//     $pdf->SetMargins(15, 10, 25);
		//     $pdf->SetFont('helvetica', 'B', 18);
		//     $pdf->SetDrawColor(79, 129, 189);
		//     $pdf->SetFillColor(79, 129, 189);
		//     $pdf->SetDrawColor(0, 0, 0);
		//     $pdf->SetX(15);
		//     $pdf->MultiCell(180, 12, 'DISC INDICATOR PROFILE (DIP)', 0, 'C', 1);
		//     $pdf->Ln(5);
		//     $pdf->SetFont('helvetica', '', 12.5);
		//     $pdf->Ln(2);

		//     # Start:- Bar graph
		//     // print_r($resultArr); echo '<br><br>';
		//     // die;
		//         $datay=array($score4['RD'], $score4['RI'], $score4['RS'], $score4['RC']);

		//         // Create the graph. These two calls are always required
		//         $graph = new Graph(450,480,"auto");

		//         // Slightly bigger margins than default to make room for titles
		//         $graph->SetMargin(50, 60, 30, 60);
		//         $graph->SetMarginColor('white');

		//         // Setup the scales for X,Y and Y2 axis
		//         //$graph->SetScale("textlin"); // X and Y axis
		//         $graph->SetScale('textlin',-10,10);

		//         //$graph->SetY2Scale("lin"); // Y2 axis

		//         // Overall graph title
		//         //$graph->title->Set('IQ ');
		//         //$graph->title->SetFont(FF_FONT1,FS_BOLD,12);

		//         // Setup the labels
		//         $lbl = array("D", "I", "S", "C");
		//         $graph->xaxis->SetTickLabels($lbl);
		//         $graph->xaxis->SetFont(FF_FONT1,FS_BOLD,16);
		//         $graph->xaxis->SetColor('black');
		//         $graph->xaxis->SetTickSide(SIDE_TOP);
		//         $graph->xaxis->HideLabels();
		//         //$graph->xaxis->SetLabelAngle(90);

		//         // Create Y data set
		//         $bplot = new BarPlot($datay);
		//         $graph->Add($bplot);
		//         $bplot->SetWeight(0);
		//         $bplot->SetFillColor(array('#c00000','#ffc000','#0070c0', '#00b050'));
		//         // Create Y2 scale data set
		//         $l1plot = new LinePlot($datay);
		//         // ... and add the plot to the Y2-axis

		//         $graph->AddY2($l1plot);

		//         $graph->SetY2OrderBack(false);
		//         $l1plot->SetColor("#C0504D");
		//         $l1plot->SetWeight(2);

		//         // Display the graph
		//         $bplot->value->SetFormat('%00.2f');
		//         $bplot->value->SetColor("#000000");
		//         $bplot->value->SetFont(FF_FONT1,FS_BOLD);
		//         $bplot->value->Show();
		//         $bplot->value->HideZero();
		//         $bplot->SetValuePos('top');
		//         $bplot->SetYBase(10);
		//     $graph->yaxis->scale->SetGrace(0);
		//     $graph->xaxis->SetTitleMargin(10);
		//         $outputFile = "temp_img/".$_POST['user_id']."_4_barGraph.png";
		//         @unlink($outputFile);
		//         // Display the graph
		//         $graph->Stroke($outputFile);
		//         #echo '<img src="'.base_url().$outputFile.'" width="450" height="350" alt="test" />'; die;
		//         // Display the graph
		//         // EOF
		//     # End:- Bar graph

		//     $pdf->Image("images/disc.png", 65, $pdf->GetY(), 70);
		//     $pdf->Image("temp_img/".$_POST['user_id']."_4_barGraph.png", 50, $pdf->GetY()+13, 100, 85);
		//     $pdf->Ln(99);

		//     $pdf->SetTextColor(0, 0, 0);
		//     $fontColorArr[0] = array('255, 255, 255', '255, 255, 255');
		//     $bgColorArr[0] = array('192, 0, 0', '255, 192, 0');
		//     $fontColorArr[1] = array('194, 10, 10', '255, 211, 79');
		//     $bgColorArr[1] = array('83, 129, 53', '91, 155, 213');
		//     $fontColorArr[2] = array('50, 191, 114', '17, 121, 196');
		//     $pdf->SetWidths(array(90, 90));

		//     $highD_heading = "High Dominance";
		//     $lowD_heading = "Low Dominance";
		//     $highD_keyWord = "Key words: Dominating, Direct, Determined, Assertive, Competitive";
		//     $lowD_keyWord = "Key words: Cautious, Non-competitive, Sacrificing, Passive";
		//     $highD_details = "People with a high D are authority driven and wants to be in charge and in control.  They enjoy being challenged and are very competitive individuals with a very high ambition. High D's prefer not to work under supervision and tend to shy away from being controled. They have a need for new and different activities.";
		//     $lowD_details = "People with a low D are sincere and understanding. They don't enjoy a competitive environment and prefers limited responsibility. They don't necessarily want to be in charge. Low D's likes to take time in decision making. They also prefer to report into an authority. They may be seen as less assertive.";

		//     $highI_heading = "High Influence";
		//     $lowI_heading = "Low Influence";
		//     $highI_keyWord = "Key words: Influencial, Persuasive, Outgoing, Positive";
		//     $lowI_keyWord = "Key words: Independent, Tasks, Quality, Non-social";
		//     $highI_details = "High I's enjoy being in contact with people. They like influencing others and communicate with ease. High I's have a desire to help other people and to motivate them. They prefer group activities, inside and outside the working environment. They enjoy public and social recognition.";
		//     $lowI_details = "Low I's are task driven individuals and seeks logical and factual information. They prefer working alone and wants to be socially independent. Low I's may appear sceptical and withdrawn. They don't always show their emotions openly and might be perceived as a poor mixer.";

		//     $highS_heading = "High Steadiness";
		//     $lowS_heading = "Low Steadiness";
		//     $highS_keyWord = "Key words: Reliable, Predictable, Structure, Repetitive";
		//     $lowS_keyWord = "Key words: Variety, Mobility, Change, Quick paced";
		//     $highS_details = "People with a high S are procedure orientated and likes to adhere to rules. They prefer environments that are predictable with little change. They are comfortable with systems and can concentrate on work for long periods of time. High S individuals wants security and a steady working environment. They need a lot of reassurance.";
		//     $lowS_details = "People with a Low S enjoys change and flexibility. They prefer environments that can offer a lot of variety and challenges which is also unstructured. They like to make quick decisions and are usually quick paced individuals. They may at times be less tolerant and in need of pressure. They like mobility and would probably be motivated in jobs which gives them the opportunity to travel.";

		//     $highC_heading = "High Compliance";
		//     $lowC_heading = "Low Compliance";
		//     $highC_keyWord = "Key words: Compliance, Details, Accuracy, Quality";
		//     $lowC_keyWord = "Key words: Independence, Risk, Freedom, Fearless";
		//     $highC_details = "High C's are detailed and quality orientated. They need precision work and an exact job description. They depend on detailed information to make their decisions. High C's always check their work for accuracy and comply to all the rules and procedures. They are quick to notice mistakes.";
		//     $lowC_details = "Low C's are usually unconventional. They don't like following rules and procedures. They usually react fearless to situations. Low C's are usually frank and direct and work well under stress. They need minimum guideliness and work well in environments where they don't have to be confined with rules and policies. They might tend to miss deadlines.";
		//     $pdf->SetFont('helvetica', '', 11);
		//     $D =(($score4['RD']>=0)?$highD_heading:$lowD_heading);
		//     $I =(($score4['RI']>=0)?$highI_heading:$lowI_heading);
		//     $printData = array($D, $I);
		//     $pdf->createTableWithFormatingDip($printData, 90, array('DF', 'DF'), array('B', 'B'), $bgColorArr[0], $fontColorArr[0], 8);

		//     $pdf->SetFont('helvetica', '', 10);
		//     $D =(($score4['RD']>=0)?$highD_keyWord:$lowD_keyWord);
		//     $I =(($score4['RI']>=0)?$highI_keyWord:$lowI_keyWord);
		//     $printData = array($D, $I);
		//     $pdf->createTableWithFormatingDip($printData, 90, array('DF', 'DF'), array('B', 'B'), array(), $fontColorArr[1], 5);

		//     $D =(($score4['RD']>=0)?$highD_details:$lowD_details);
		//     $I =(($score4['RI']>=0)?$highI_details:$lowI_details);
		//     $printData = array($D, $I);
		//     $pdf->createTableWithFormatingDip($printData, 90, array('DF', 'DF'), array(), array(), $fontColorArr[1], 5);

		//     $C =(($score4['RC']>=0)?$highC_heading:$lowC_heading);
		//     $S =(($score4['RS']>=0)?$highS_heading:$lowS_heading);
		//     $printData = array($C, $S);
		//     $pdf->createTableWithFormatingDip($printData, 90, array('DF', 'DF'), array('B', 'B'), $bgColorArr[1], $fontColorArr[0], 8);

		//     $pdf->SetFont('helvetica', '', 10);
		//     $C =(($score4['RC']>=0)?$highC_keyWord:$lowC_keyWord);
		//     $S =(($score4['RS']>=0)?$highS_keyWord:$lowS_keyWord);
		//     $printData = array($C, $S);
		//     $pdf->createTableWithFormatingDip($printData, 90, array('DF', 'DF'), array('B', 'B'), array(), $fontColorArr[2], 5);

		//     $C =(($score4['RC']>=0)?$highC_details:$lowC_details);
		//     $S =(($score4['RS']>=0)?$highS_details:$lowS_details);
		//     $printData = array($C, $S);
		//     $pdf->createTableWithFormatingDip($printData, 90, array('DF', 'DF'), array(), array(), $fontColorArr[2], 5);

		//     if($score4['RC'] > 0 && $score4['RI'] < 0 &&  $score4['RS'] < 0 && $score4['RD'] < 0 )
		//     {
		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252','Compliance is perhaps the most complex of the four DISC factors, and a High-C (highly Compliant) style reflects this in their behaviour. Unassertive by nature, often reticent and aloof, people of this kind can give an impression of coldness or disinterest. Much of this cautious style stems from their Controlled side, however, which makes them reluctant to reveal information about themselves or their ideas unless absolutely necessary. In fact, highly Compliant individuals are often surprisingly ambitious and have lofty goals, but their innate lack of assertiveness and unwillingness to become involved in confrontational situations makes it difficult for them to achieve these goals directly. Instead, they will tend to use existing structures and rules to accomplish their aims. For example, where a more dominant type might simply demand that others follow their instructions, a High-C will appeal to rules, authority and logical argument to influence the actions of others.'));
		//         $pdf->ln(10);

		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->SetFillColor(79,129,189);
		//         $pdf->Cell(0, 12, 'Relating to Others', 0, 0, 'C', 1);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->Ln(10);

		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+10);
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/rel_to_oth.jpg", 40, 120, 130, 80);
		//         $pdf->ln(10);
		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+75);
		//         $pdf->ln(10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(150, 5, iconv('UTF-8', 'windows-1252','Highly Compliant types have many strengths, but the ability to relate easily to other people is rarely among these. The combination of a reticent social style with a certain innate suspiciousness makes it difficult for this type of person to form or maintain close relationships, and this is especially true in a business sense. Their friendships or close acquaintances will normally be based on mutual interests or common aims, rather than emotional considerations.'));

		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Common Abilities', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_1.jpg", 30, 50, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"High-C's are generally very self-reliant people although, as we saw above, this fact is often difficult to perceive for other styles. They have structured ways of thinking, and often show particular strengths when it comes to organising facts or working with precise detail or sophisticated systems. The low Steadiness score in this profile suggests a quick-thinking individual who will often have useful input, but their natural reticence means that they will rarely offer an opinion unless asked directly for their thoughts."));

		//         $pdf->ln(20);

		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Motivating Factors', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_2.jpg", 30, 140, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"There is one factor that has a more significant effect on a High-C's motivation than any other - certainty. They need to feel completely sure of their position, and of others' expectations of them, before they are able to proceed. Because of this, they have a very strong aversion to risk, and will rarely take any action unless they can feel absolutely sure about its consequences."));

		//     }

		//     // D - only

		//     // D - only
		//     if($score4['RC'] < 0 && $score4['RI'] < 0 &&  $score4['RS'] < 0 && $score4['RD'] > 0 )
		//     {
		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"The High-D profile is often described as the 'Autocrat', and for good reason. Dominance is the factor of control and assertiveness, and with no other high factors in the profile to balance this, the pure High-D can be remarkably domineering, and even overbearing at times. This type of person has a very high need to achieve, and because of this they are often ambitious and competitive, striving aggressively to achieve their goals. They are dynamic and adaptable, and show decisiveness and a capacity for direct leadership."));
		//         $pdf->ln(10);

		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->SetFillColor(79,129,189);
		//         $pdf->Cell(0, 12, 'Relating to Others', 0, 0, 'C', 1);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->Ln(10);

		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+10);
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/rel_to_oth.jpg", 40, 120, 130, 80);
		//         $pdf->ln(10);
		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+75);
		//         $pdf->ln(30);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(150, 5, iconv('UTF-8', 'windows-1252',"The emphasis that this type of person places on achievement and success significantly affects their relations with other people. In extreme cases, a High-D can come to treat other people simply as a means to an end, or a way of achieving their personal goals. Dominance is not an emotional factor, and individuals with this type of profile will tend not to place great importance on feelings, either their own or others'. The competitive side of Dominance can lead this type of person to see challenges and opposition everywhere, and others sometimes find it difficult to break through this naturally suspicious, sceptical shell."));

		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Common Abilities', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_1.jpg", 30, 50, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"We have already seen that the Dominant individual has qualities of command and leadership. It should be noted, however, that these abilities are based on their direct, demanding nature, and are more suited to structured, formal situations than those where close ties are required."));
		//         $pdf->ln(10);
		//         $pdf->SetX($x+60);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"The High-D is a competent and confident decision-maker, able to reach a conclusion quickly from minimal information and act accordingly. They are well suited to situations that others would find unbearably stressful, astheir desire for challenge and their enjoyment of success against the odds makes them unusually proficient in dealing with such situations."));
		//         $pdf->ln(20);

		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Motivating Factors', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_2.jpg", 30, 170, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"Highly Dominant individuals of this kind like to feel that they are in control, and seek opportunities to reinforce and emphasise their personal power. They measure their progress in life by their achievements and successes, and need to maintain a sense of personal momentum. Being impatient and forthright, they intensely dislike situations that they are unable to directly resolve for themselves - dependence on other people is anathema to this type. They find these kinds of situation extremely frustrating, and can be driven to wild, impulsive actions in an attempt to relieve the pressure."));

		//     }

		//     if($score4['RC'] > 0 && $score4['RI'] < 0 &&  $score4['RS'] < 0 && $score4['RD'] > 0 )
		//     {
		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"This 'U'-shaped profile is not uncommon. It represents a highly formal and structured individual with a forceful and blunt style. This type of person believes in getting things right, and is rarely afraid to state their mind robustly and directly. Of all possible DISC profiles, this style probably represents the least forthcoming in personal or emotional matters; individuals of this type tend to be remote and somewhat isolated, preferring to keep their own counsel."));
		//         $pdf->ln(10);

		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->SetFillColor(79,129,189);
		//         $pdf->Cell(0, 12, 'Relating to Others', 0, 0, 'C', 1);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->Ln(10);

		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+10);
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/rel_to_oth.jpg", 40, 100, 130, 80);
		//         $pdf->ln(10);
		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+75);
		//         $pdf->ln(10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(180, 5, iconv('UTF-8', 'windows-1252','This is a behavioural style motivated by achievement and efficiency, as are all styles containing a high level of Dominance. In this case, however, this is modulated by the presence of a high Compliance factor, which also lends the character an interest in detail and precision. A noticeable element of this particular type, for example, is their tendency to correct other people when they make errors, even to the point of highlighting mistakes that others might regard as trivial or unimportant. '));
		//         $pdf->ln(10);
		//         $pdf->MultiCell(180, 5, iconv('UTF-8', 'windows-1252','Nonetheless, this combination of efficiency and precision can be an effective one, and their bluntly assertive style helps them to achieve difficult tasks by sheer force of character.'));

		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Common Abilities', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_1.jpg", 30, 50, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"High-C's are generally very self-reliant people although, as we saw above, this fact is often difficult to perceive for other styles. They have structured ways of thinking, and often show particular strengths when it comes to organising facts or working with precise detail or sophisticated systems. The low Steadiness score in this profile suggests a quick-thinking individual who will often have useful input, but their natural reticence means that they will rarely offer an opinion unless asked directly for their thoughts."));

		//         $pdf->ln(20);

		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Motivating Factors', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_2.jpg", 30, 140, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"This is a complex character in terms of motivation. In common with all High-D's, they have a desire for personal achievement and success, but they also like to feel that they are completing assignments or projects accurately and efficiently. The naturally inexpressive style of this type canmake it difficult to detect whether or not they are motivated in any particular set of circumstances."));

		//     }
		//     if($score4['RC'] < 0 && $score4['RI'] > 0 &&  $score4['RS'] < 0 && $score4['RD'] > 0 )
		//     {
		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"A profile of this type represents a highly assertive person, capable of both direct, dynamic action or charming sociability as a situation demands. In combination, these factors describe a person with clear goals in life with the determination and commitment to achieve them. This style of person will seek to maintain a position of dominance, both in terms of personal authority and control, but also in a social sense - they like to feel that they are not only respected by those working with them, but also genuinely liked. This powerful behavioural style is often called the 'Lazy Z' in reference to its characteristic DISC profile shape."));
		//         $pdf->ln(10);

		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->SetFillColor(79,129,189);
		//         $pdf->Cell(0, 12, 'Relating to Others', 0, 0, 'C', 1);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->Ln(10);

		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+10);
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/rel_to_oth.jpg", 40, 100, 130, 80);
		//         $pdf->ln(10);
		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+75);
		//         $pdf->ln(10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(180, 5, iconv('UTF-8', 'windows-1252','This type is characterised by strong social skills and a persuasive communication style. They are capable of great charm, but will sometimes adopt a more demanding, overbearing approach, especially if they feel themselves to be under pressure. The outgoing and quickly-paced approach of this kind of person can be difficult to deal with for less assertive or direct types, especially as they have no fear of confrontation and will address issues directly rather than prevaricate or evade. '));

		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Common Abilities', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_1.jpg", 30, 50, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"Challenge is a keyword for this type - they thrive in situations that others would find impossibly stressful and difficult to deal with. Their need for achievement means that they are willing to undertake almost any task to achieve success or recognition, and this driving, motivated approach lends them an urgency and energy rarely seen in other behavioural types. "));
		//         $pdf->ln(10);
		//         $pdf->SetX($x+60);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"Regular DISC users will recognize this profile shape as the classic ideal for direct sales work. This type of occupation typifies the characteristics of the Lazy Z, the ability to think and react quickly, adapt to challenging situations and use powers of both assertiveness and persuasion to motivate others to accept their own proposals."));

		//         $pdf->ln(20);

		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Motivating Factors', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_2.jpg", $x, $y, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"As we have already seen, success and recognition are the twin motivating factors for a person with high Dominance and Influence. To be content, they must feel that they are a success in both their business and personal lives. More than this, they are motivated by challenge - stagnation is anathema to a person of this type, and they need to set themselves lofty goals and ambitions, and aim steadily towards these, if they are to operate at their best. "));

		//     }

		//     // D&S
		//     if($score4['RC'] < 0 && $score4['RI'] < 0 &&  $score4['RS'] > 0 && $score4['RD'] > 0 )
		//     {
		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"Profiles showing both high Dominance and high Steadiness, while they can theoretically appear, are extremely rare in practice. This is because these two factors represent such radically differing sets of values and motivations that it is hard to see how they could effectively coexist in a single behavioural style. Because of the rarity of this profile, it should be pointed out that, unlike most sections in this chapter, the descriptions given here are largely theoretical in nature, and not necessarily based on practical experience with individual styles of this type."));
		//         $pdf->ln(10);

		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->SetFillColor(79,129,189);
		//         $pdf->Cell(0, 12, 'Relating to Others', 0, 0, 'C', 1);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->Ln(10);

		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+10);
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/rel_to_oth.jpg", 40, 100, 130, 80);
		//         $pdf->ln(10);
		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+75);
		//         $pdf->ln(10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252',"The unusual combination of factors represented by this style make it difficult to predict their likely approach to other people. On one hand, Dominance is a controlled and suspicious factor, preferring to avoid revealing information to others, but on the other Steadiness is an open characteristic, representing a person who likes to maintain amiable and trusting relations with those around them. This suggests that a person showing both high Dominance and Steadiness will adapt their social style to a particular situation, showing a friendlier side to their character if they feel that they can trust the people around them. "));

		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Common Abilities', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_1.jpg", 30, 50, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252',"An analysis of this style's 'Sub-traits' suggests a single-minded and practical style, representing an individual who will follow a line of action through to the end, using concentration and determination to achieve their aims. They will try to complete tasks within realistic timescales,but they also value careful planning. The profile shape suggests that the more cautious, thoughtful side of the behaviour will appear under favourable conditions, whilethe more urgent, demanding aspect will be seen at times of pressure."));

		//         $pdf->ln(20);

		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Motivating Factors', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_2.jpg", $x, $y, 50, 50);
		//         $pdf->SetXY($x+60,$y);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252',"The motivating factors associated with Dominance are control and power, while Steadiness is more related to the need for certainty and the avoidance of change. Insofar as these two factors are compatible, they suggest a preference for a situation in which this person exercises whatever authority they may have to preserve the status quo and avoid sudden change."));

		//     }

		//     // D&I&C
		//     if($score4['RC'] > 0 && $score4['RI'] > 0 &&  $score4['RS'] < 0 && $score4['RD'] > 0 )
		//     {
		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"Speed of response and a sense of urgency are the defining characteristics of this type. Their low Steadiness scores suggest that their approach will be rooted in a dynamic, impatient style. This is a relatively self-controlled and ambitious style, but they also possess effective social abilities that can be expected to come to the fore in informal, open situations."));
		//         $pdf->ln(10);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"While ambition and assertiveness are important elements of this style, the type of person to whom it refers will also have an awareness of the needs of others and a sense of order that make them far less impulsive and unpredictable than many similarly extrovert types. While they will wish to achieve success in their own right, they also understand that the needs of an organisation will from time to time require that they suppress their own ambitions for the good of the team."));

		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->SetFillColor(79,129,189);
		//         $pdf->Cell(0, 12, 'Relating to Others', 0, 0, 'C', 1);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->Ln(20);

		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/rel_to_oth.jpg", 40, $pdf->getY()+10, 130, 80);
		//         $pdf->ln(10);
		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+75);
		//         $pdf->ln(10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252',"The ways in which this type relates to other people will tend to vary according to their social situation, depending on the relative formality of their surroundings. In more social, casual circumstances, they will project a friendly and animated style, being open and enthusiastic in general style."));
		//         $pdf->ln(10);
		//         $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252',"If their situation is more formal or closely regulated, however, a more direct and determined side will develop, being both assertive and self-controlled, and showing far less of the sociable, gregarious side associated with favourable situations. It is in formal situations of this kind that the more ambitious and driving elements will come to the fore, and it is likely that the individual will also adopt a somewhat plain-speaking, blunt aspect."));

		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Common Abilities', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_1.jpg", 30, 50, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"From the above, it will be clear that an individual of this kind will display different abilities in different situations; they can be charming and enthusiastic, or direct and forthright, depending on their particular circumstances. From a manager's perspective, it will clearly be productive to adapt such a person's working environment, so far as is possible, to bring out the particular style that is most appropriate."));

		//         $pdf->ln(20);

		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Motivating Factors', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_2.jpg", $x, $y, 50, 50);
		//         $pdf->SetXY($x+60,$y);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"Profiles with three high factors, such as this, have complex sets of motivating factors that may sometimes conflict with one another. In this case, motivation stems from the achievement of personal ambition, the acceptance and approval of other people, and certainty of their position. Where these are incompatible, as for example if the fulfilment of a goal requires a risk to be taken, the relative values of the three factors will give some indication of the person's likely course of action."));
		//     }

		//     // D&I&S
		//     if($score4['RC'] < 0 && $score4['RI'] > 0 &&  $score4['RS'] > 0 && $score4['RD'] > 0 )
		//     {
		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"The lack of Compliance in this type indicates that independence is the key element in understanding this style. People of this kind have a clear idea of their aims in life, and the strength of will to achieve their aims. It is unusual to find high Steadiness in a profile of this type, and this lends the individual concerned a sense of persistence and a willingness to work steadfastly and diligently in pursuit of their ends."));
		//         $pdf->ln(10);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"There is a sociable, open aspect to this type of person, but the presence of Dominance means that they also have an underlying sense of determination and assertiveness that will come to the fore, especially if they find themselves in difficult or demanding situations."));

		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->SetFillColor(79,129,189);
		//         $pdf->Cell(0, 12, 'Relating to Others', 0, 0, 'C', 1);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->Ln(20);

		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/rel_to_oth.jpg", 40, $pdf->getY()+10, 130, 80);
		//         $pdf->ln(10);
		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+75);
		//         $pdf->ln(10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252',"Influence and Steadiness are both social factors, suggesting that this type will interact easily and skilfully with other people, and that they possess the personal self-confidence to mix relatively easily with strangers, or in unusual situations. They do have a strong sense of independence, however, and are prepared to go to considerable lengths to maintain their own sense of identity, and to protect and defend their own viewpoint."));
		//         $pdf->ln(10);

		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Common Abilities', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_1.jpg", 30, 50, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"This is a solid and dependable style with strong social abilities, and with an assertiveness and willingness to take the initiative that is rare in such types. They have a strong sense of personal responsibility and an inherent self-reliance that make them especially effective as facilitators. Their combination of patience and assertiveness results in a rare and valuable approach to work, capable of achieving results, but equally able to consider options carefully before reaching a final decision."));

		//         $pdf->ln(20);

		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Motivating Factors', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_2.jpg", $x, $y, 50, 50);
		//         $pdf->SetXY($x+60,$y);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"Because of their independent style, this type of person will seek to hold a degree of control over their own circumstances, and will look for opportunities to drive towards their own ambitions. While success is important to them, however, they also value positive relationships with other people, and under some circumstances they will be prepared to delay achievement of their goals if this conflicts with others' needs."));
		//     }

		//     // D&I&S 8
		//     if($score4['RC'] > 0 && $score4['RI'] < 0 &&  $score4['RS'] > 0 && $score4['RD'] > 0 )
		//     {
		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"This is an unusual profile shape, as are all profiles containing both high Dominance and Steadiness. The main distinguishing feature of this style is their low Influence score, describing a style based more around practicality and rational thought than emotional considerations, and being generally reluctant to reveal information about themselves, their ideas or their feelings."));
		//         $pdf->ln(10);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"In common with many profiles showing three high factors, this is a complex behavioural style with varying responses to varying situations. In this particular case, more assertive and dominant behaviour can be expected in antagonistic or difficult situations, while a more relaxed (but far less assertive) style can be anticipated in less pressurised circumstances."));

		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->SetFillColor(79,129,189);
		//         $pdf->Cell(0, 12, 'Relating to Others', 0, 0, 'C', 1);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->Ln(20);

		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/rel_to_oth.jpg", 40, $pdf->getY()+10, 130, 80);
		//         $pdf->ln(10);
		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+75);
		//         $pdf->ln(10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252',"The low Influence score in this profile shape indicates that relating to other people is not an area of particular emphasis for an individual of this type. Where they do respond to others on more than a purely practical basis, they will tend to react to comments or suggestions from other parties rather than offering direct input themselves. As a situation becomes more difficult, their willingness to make direct input will increase dramatically, but their readiness to communicate on a personal level will reduce proportionately."));
		//         $pdf->ln(10);

		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Common Abilities', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_1.jpg", 30, 50, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"The emphasis of this type of person is on results and productivity. They work well with facts, and are at home with complex systems. They value effectiveness and efficiency, and will tend to embody these qualities in their approach to both their work and home lives. Although they have a clear view of their own personal aims in life, they are prepared to bide their time when necessary, and this thoughtful, patient approach helps them to avoid unneccessary risks or impulsive actions."));

		//         $pdf->ln(20);

		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Motivating Factors', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_2.jpg", $x, $y, 50, 50);
		//         $pdf->SetXY($x+60,$y);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"Profiles with multiple high factors have a variety of motivating factors, and these can express themselves in different ways according to circumstance. In this case, motivating factors include the achievement of results, time to adapt to changing situations, a full understanding of fact and detail and an avoidance of risk. There will clearly be times when elements of this complex group of motivations conflict with one another."));
		//     }

		//     // D&I&S 9
		//     if($score4['RC'] > 0 && $score4['RI'] > 0 &&  $score4['RS'] < 0 && $score4['RD'] < 0 )
		//     {
		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"This relatively common profile includes two factors that appear in some ways to be contradictory. On the one hand, Influence is the factor of excitement, enjoyment and extrovert impulsiveness. On the other, Compliance is related to precision, detail and carefully-followed rules. The ways in which this apparent contradiction is resolved form the backbone of the interpretation for this behavioural type."));
		//         $pdf->ln(10);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"The differences in approach between these two factors are resolved in an unusual approach. Normally, two or more high DISC factors will tend to reinforce each other's common points, and blend to make up the entire behavioural approach. This is not the case with the two opposing styles of Influence and Compliance - what we see instead, with this type, is one factor (Influence) appearing in relaxed, open and favourable situations, while in more formal or structured circumstances, the other (Compliance) will come to the fore."));

		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->SetFillColor(79,129,189);
		//         $pdf->Cell(0, 12, 'Relating to Others', 0, 0, 'C', 1);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->Ln(20);

		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/rel_to_oth.jpg", 40, $pdf->getY()+10, 130, 80);
		//         $pdf->ln(10);
		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+75);
		//         $pdf->ln(10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252',"The ways in which this style will relate to other people is highly dependent on the circumstances under which an encounter takes place. In a circle of friends, or in a 'party' atmosphere, this style is capable of quite confident and extrovert behaviour. In a formal work environment, or pressurised atmosphere, such as an interview for a job, this confidence will apparently evaporate, and the style will fall into line with its more Compliant aspect."));
		//         $pdf->ln(10);

		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Common Abilities', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_1.jpg", 30, 50, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"This style combines the abilities of a pure High-I and a High-C, but, as we have noted above, these abilities will not all be apparent at the same time. Different environments will produce different responses, and so a manager requiring a certain style of behaviour from this type of person should ideally adapt their working environment to suit the type of responses they require. Note that, in most cases, the profile type will normally show an Influence factor higher than their Compliance factor (although, by definition, both must be relatively high), and so confident, communicative behaviour will be more commonly seen than their reticent, cautious side."));

		//         $pdf->ln(20);

		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Motivating Factors', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_2.jpg", $x, $y, 50, 50);
		//         $pdf->SetXY($x+60,$y);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"This person's motivations are more complex than most, because of the opposing natures of their two main factors. Their high Influence score means that they are interested in the attention and approval of others, but because they also have high Compliance, this element is less likely to be demonstrated overtly, and will instead be more subtle and discreet. Compliance is the factor of certainty and sureness, and this type of person will look for a clear idea of their position and the expectations of those around them."));
		//     }

		//     // D&I&S 10
		//     if($score4['RC'] < 0 && $score4['RI'] > 0 &&  $score4['RS'] > 0 && $score4['RD'] < 0 )
		//     {
		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"Influence and Steadiness are both communicative factors more oriented towards feelings and emotions than hard fact and practicalities. In combination, they describe a person oriented towards personal matters and the understanding of other people. Such an individual is confident, warm and friendly, but nonetheless is also able to extend a sympathetic ear to others and ready to help with others' problems if they can. These are the reasons why a DISC profile with this characteristic inverted 'U' shape is often described as a 'Counsellor' Profile."));

		//         $pdf->Ln(10);

		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->SetFillColor(79,129,189);
		//         $pdf->Cell(0, 12, 'Relating to Others', 0, 0, 'C', 1);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->Ln(20);

		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/rel_to_oth.jpg", 40, $pdf->getY()+10, 130, 80);
		//         $pdf->ln(10);
		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+75);
		//         $pdf->ln(10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252',"Of all DISC profiles, those following this general pattern are probably the most effective at relating to other people, in an all round sense. They are able to socialise easily and their gregarious natures allow them to feel at ease with people they do not know. They are often persuasive and charming, but the Steadiness in this profile means that they are also able to adopt a more open, relaxed approach when a situation demands, becoming less directly active and more receptive to the ideas and feelings of other people."));
		//         $pdf->ln(10);

		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Common Abilities', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_1.jpg", 30, 50, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"The strengths of a High-I profile, as described in the preceding paragraph, relate to their abilities in the areas of communication and understanding. They fulfil supportive roles well, being understanding and sympathetic, but their more outgoing side means that they are also able to operate effectively in a social or persuasive sense. It should be noted, however, that individuals of this kind place less emphasis on matters of practicality than a purely High-S-style, as this element is balanced by the less methodical Influence factor."));

		//         $pdf->ln(20);

		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Motivating Factors', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_2.jpg", $x, $y, 50, 50);
		//         $pdf->SetXY($x+60,$y);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"Antagonism, rejection and confrontation are all situations that this type will try to avoid. To use their considerable communicative powers, they will need to feel that they are operating in a favourable environment, and that those around them are sympathetic and approving. To feel completely motivated, individuals with a Counsellor Profile need to feel that they are appreciated, respected and liked by the people around them, and will sometimes go to unusual lengths to attract this attention."));
		//     }

		//     // I 11
		//     if($score4['RC'] < 0 && $score4['RI'] > 0 &&  $score4['RS'] < 0 && $score4['RD'] < 0 )
		//     {
		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"Influence is the factor of communication. A profile like that on the left, showing high Influence with no other balancing factors, is very closely linked with those styles that communicate easily and fluently with others. It is for this reason that profiles of this kind are often referred to as 'Communicator' profiles - they describe confident, outgoing and gregarious individuals who value contact with other people and the development of positive relations."));

		//         $pdf->Ln(10);

		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->SetFillColor(79,129,189);
		//         $pdf->Cell(0, 12, 'Relating to Others', 0, 0, 'C', 1);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->Ln(20);

		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/rel_to_oth.jpg", 40, $pdf->getY()+10, 130, 80);
		//         $pdf->ln(10);
		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+75);
		//         $pdf->ln(10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252',"Relating to others is what a High-I (highly Influential person) do best. They are open to others and confident in their own social abilities, allowing them to interact positively in almost any situation. Their strong and evident confidence, coupled with their genuine interest in the ideas and especially feelings of other people, are often found charming by those around them."));
		//         $pdf->ln(10);

		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Common Abilities', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_1.jpg", 30, 50, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"From the above, it will be no surprise that a High-I's most distinct abilities lie in the area of communication. They are strong communicators, possessing the assertiveness to drive home a point of view, but also the intuitive qualities to understand others' perspectives and adapt to meet new situations."));

		//         $pdf->ln(20);

		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Motivating Factors', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(20);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_2.jpg", $x, $y, 50, 50);
		//         $pdf->SetXY($x+60,$y);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"Highly Influential individuals are motivated by relations with others. Specifically, they need to feel accepted by those around them, and react badly if they perceive themselves to be rejected or disliked. Praise and approval make a strong impression on them, and they will sometimes go to great lengths to achieve this kind of reaction from other people. Especially important to this type of person are the opinions and reactions of their particularly close friends. When a High-I develops very close ties with somebody, that person becomes part of their 'Influence Group', as it is known. Their actions will often be designed to improve and extend relations within this group, even to the extent of alienating people who are not part of this circle."));
		//     }

		//     // I&S&C 12
		//     if($score4['RC'] > 0 && $score4['RI'] > 0 &&  $score4['RS'] > 0 && $score4['RD'] < 0 )
		//     {
		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"This combination of three high factors represents a behavioural style with a number of divergent elements. One common theme, however, is represented by the low level of Dominance in the style, meaning that this style will rarely display overtly assertive or direct behaviour. Instead, they will try to achieve their ends through communication, using their persuasive abilities or the powers of rational discussion."));

		//         $pdf->Ln(10);

		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"This is not an ambitious type of person; profiles of this kind reflect individual styles who rarely set distinct goals for themselves in life, but prefer instead simply to build strong relationships with others and pursue their personal interests or pastimes. They work particularly well as part of a team or group, being both friendly and co-operative in style, and ready to accept others' ideas."));
		//         $pdf->Ln(10);

		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->SetFillColor(79,129,189);
		//         $pdf->Cell(0, 12, 'Relating to Others', 0, 0, 'C', 1);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->Ln(20);

		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/rel_to_oth.jpg", 40, $pdf->getY()+10, 130, 80);
		//         $pdf->ln(10);
		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+75);
		//         $pdf->ln(10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252',"Relating to Others Influence, Steadiness and Compliance, the three important factors in this profile, all confer certain communicative strengths on this type. In combination, these three elements give people of this kind a number of strengths in the field of relations with other people. Influence is the factor that relates to an outgoing, friendly style, while Steadiness confers capable listening skills and patience with others. Finally, Compliance gives a rational aspect to such an individual, helping them to present cogent and coherent arguments when necessary."));
		//         $pdf->ln(10);

		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Common Abilities', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_1.jpg", 30, 50, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"As we saw above, many of this style's abilities lie in the field of personal communication and relationship management. They are good team players who work well with other people, and appreciate their input into discussions. While they have the confidence to maintain a pro-active role, this does not equate to the direct assertiveness of certain other types. They are capable of being outgoing and extrovert, they are also receptive to other people and sympathetic to other points of view."));

		//         $pdf->ln(20);

		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Motivating Factors', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(20);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_2.jpg", $x, $y, 50, 50);
		//         $pdf->SetXY($x+60,$y);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"This type of person is not ambitious by nature, and rarely has a specific set of goals or aims in life. Motivation for this person is more a matter of a general sense of happiness or contentment, and specifically this means the development of positive, warm relations with other people, time to adapt to changes in circumstance, and a sense of sureness about their position, especially (but not exclusively) in social terms."));
		//     }

		//     // S&C 13
		//     if($score4['RC'] > 0 && $score4['RI'] < 0 &&  $score4['RS'] > 0 && $score4['RD'] < 0 )
		//     {
		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"Profiles of this kind, showing both high Steadiness and high Compliance, are often referred to as 'Technical'. This term is used in its broadest sense; people showing this type of behaviour are suited to jobs such as accountancy, computer programming or engineering, because their approaches combine accuracy and precision with the patience to work at a problem until it has been solved. They are interested in producing quality work, and will often go to great lengths to ensure that the results of their efforts are the best they can possibly achie."));

		//         $pdf->Ln(10);

		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"Calm and rational in approach, this type of person often has a better understanding of personal or emotional issues than might be suggested by their relatively detached demeanour. They are not assertive in style, and will rarely offer input in a group situation, or act in an independent manner."));
		//         $pdf->Ln(10);

		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->SetFillColor(79,129,189);
		//         $pdf->Cell(0, 12, 'Relating to Others', 0, 0, 'C', 1);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->Ln(20);

		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/rel_to_oth.jpg", 40, $pdf->getY()+10, 130, 80);
		//         $pdf->ln(10);
		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+75);
		//         $pdf->ln(10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252',"This rather hesitant style often finds it difficult to relate to other people, especially in unfamiliar settings, because they need to know exactly where they stand before they feel able to act. While they value friendships and strong relations with others, this factor is often disguised by an apparently aloof and reserved style. In order to interact effectively with others, this type will look to more direct and outgoing styles to initiate and take control of interpersonal issue."));
		//         $pdf->ln(10);

		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Common Abilities', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_1.jpg", 30, 50, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"As the name 'Technical' suggests, the particular talents and skills of this type lie in the areas of complex systems and procedures. Their high Steadiness lends them patience and a degree of persistence, while their correspondingly high levels of Compliance bring an interest in order and precision. In combination, these factors reflect an individual with strong potential in broadly technical work. Because of their interest in quality and productivity, it is not unusual to find people of this kind who possess special skills or knowledge, especially in the 'technical' areas described."));

		//         $pdf->ln(20);

		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Motivating Factors', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(20);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_2.jpg", $x, $y, 50, 50);
		//         $pdf->SetXY($x+60,$y);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"A consequence of the patient, precise style of this type isa need for time to plan and execute their work to a standard with which they can feel satisfied. They will wish to work steadily at a project, and dislike interruptions or distractions from the task in hand. They will also seek certainty, and need to be sure that the work that they are doing conforms with the expectations of their colleagues and managers. A subtle aspect to this type's motivation is their enjoyment of positive relations with others. As we mentioned above, this fact is unlikely to be clear from their somewhat reserved and reticent demeanour, but they like to feel accepted by other people, and can be surprisingly open in style in a favourable environment of this kind."));
		//     }

		//     // S 14
		//     if($score4['RC'] < 0 && $score4['RI'] < 0 &&  $score4['RS'] > 0 && $score4['RD'] < 0 )
		//     {
		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->MultiCell(0, 6, iconv('UTF-8', 'windows-1252',"This type of profile, showing a high level of Steadiness with no other balancing factors, is comparatively rare, especially in Western societies. Steadiness is the factor of patience, calmness and gentle openness, and a pure High-S will reflect these qualities. They are generally amiable and warm-hearted, being sympathetic to others' points of view, and valuing positive interaction with others. They are not outgoing by nature, however, and rely on other, more assertive, people to take the lead. "));
		//         $pdf->Ln(10);

		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->SetFillColor(79,129,189);
		//         $pdf->Cell(0, 12, 'Relating to Others', 0, 0, 'C', 1);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->Ln(20);

		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/rel_to_oth.jpg", 40, $pdf->getY()+10, 130, 80);
		//         $pdf->ln(10);
		//         $pdf->SetXY($pdf->getX(), $pdf->getY()+75);
		//         $pdf->ln(10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(0, 5, iconv('UTF-8', 'windows-1252',"As in their general lifestyle, this type will look to more socially assertive people to initiate relationships of any kind - their solid, dependable outlook makes them far more suited to the maintenance of interpersonal relations than making initial contact. For this reason, their circle of friends and close acquaintances is often small but tightly-knit."));
		//         $pdf->ln(10);

		//         $pdf->CheckPageBreak(250);
		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Common Abilities', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(10);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_1.jpg", 30, 50, 50, 50);
		//         $pdf->SetXY($x+60,$y+10);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"This person's particular strengths can be summarised as supportive. They are dependable and loyal, this combines with an emotional literacy to make them particularly effective listeners and counsellors. They are also unusually persistent in approach, having the patience and restraint to work steadily at a task until it isachieved. This makes them unusually capable of dealing with laborious tasks that many other styles would simply not have the patience to complete."));

		//         $pdf->ln(20);

		//         $pdf->SetTextColor(79,129,189);
		//         $pdf->SetFont('helvetica', 'B', 15);
		//         $pdf->Cell(0, 12, 'Motivating Factors', 0, 0, 'L', 0);
		//         $pdf->SetTextColor(0, 0, 0);
		//         $pdf->ln(20);

		//         $y = $pdf->GetY();
		//         $x = $pdf->GetX();
		//         $pdf->Image( "/usr/www/users/assessjqbu/images/DIP/c_2.jpg", $x, $y, 50, 50);
		//         $pdf->SetXY($x+60,$y);
		//         $pdf->SetFont('helvetica', '', 11.5);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"The underlying patience of this type of person is the root of their motivating factors. They need to feel that they have the support of those around them and, more importantly, time to adapt to new situations. They have an inherent dislike of change, and will prefer to maintain the status quo whenever possible; sudden alterations in their circumstances can be very difficult for them to deal with."));
		//         $pdf->ln(10);
		//         $pdf->SetX($x+60);
		//         $pdf->MultiCell(100, 5, iconv('UTF-8', 'windows-1252',"Once embarked on a task, they will wish to concentrate closely on it and see it through. Interruptions and distractions of any kind can be particularly demotivating in these situations."));

		//     }
		//     $pdf->SetTextColor(0, 0, 0);
		// }
		elseif ($value == 5) {
			// $pdf->CheckPageBreak(250);
		} elseif ($value == 6) {
			// $pdf->CheckPageBreak(250);
		} elseif ($value == 7) {
			$pdf->CheckPageBreak(250);

			$pdf->SetFont('helvetica', 'B', 18);
			$pdf->SetDrawColor(79, 129, 189);
			$pdf->SetFillColor(79, 129, 189);
			$pdf->Cell(160, 12, 'Verbal Skills Test', 1, 0, 'C', 1);
			$pdf->Ln(20);
			$pdf->SetFont('helvetica', '', 12.5);
			$pdf->MultiCell(160, 8, iconv('UTF-8', 'windows-1252', 'The Verbal Skills Test, or VST, is a skills assessment that measures an individual’s ability to understand and interpret written information. The individual was required to read and interpret various texts and answer questions that was related to the text.'));
			$pdf->Ln(20);
			$pdf->setFont('helvetica', 'B', 12);
			$pdf->Cell(160, 5, 'RESULT');
			$pdf->Ln(20);
			$pdf->Image($rootPath . "images/rpt_chk/check_2_" . $score7 . ".png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);
			$pdf->Ln(30);

			$pdf->SetFont('', 'B');
			$pdf->SetFillColor(192, 0, 0);
			$pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252', "1 – 3 Low"), 1, 0, 'C', true);
			$pdf->SetFillColor(247, 150, 70);
			$pdf->Cell(54, 8, iconv('UTF-8', 'windows-1252', "4 – 6 Effective"), 1, 0, 'C', true);
			$pdf->SetFillColor(0, 176, 80);
			$pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252', "7 – 9 Enhanced"), 1, 0, 'C', true);
			$pdf->Ln();

			$y = $pdf->GetY();

			$pdf->SetFont('helvetica', '', 10);
			$pdf->SetFillColor(192, 0, 0);
			$pdf->MultiCell(53, 9.6, iconv('UTF-8', 'windows-1252', 'The candidate might find it very challenging interpreting and working with verbal information and instructions. The candidate might not always understand and think logically when working with written information.'), 1, 'L', true);

			$pdf->SetXY($pdf->GetX() + 53, $y);

			$pdf->SetFillColor(247, 150, 70);
			$pdf->MultiCell(54, 11.2, iconv('UTF-8', 'windows-1252', 'The candidate should find it fairly easy interpreting and working with verbal information. The candidate should understand and think logically when working with written information.'), 1, 'L', true);
			$pdf->SetXY($pdf->GetX() + 107, $y);

			$pdf->SetFillColor(0, 176, 80);
			$pdf->MultiCell(53, 8.4, iconv('UTF-8', 'windows-1252', "The candidate should find it very easy interpreting and working with verbal information and instructions. The candidate should find it exceptionally easy to understand and think logically when working with written information."), 1, 'L', true);

			$pdf->Ln(10);

		} elseif ($value == 8) {
			$pdf->CheckPageBreak(250);
			$pdf->SetFont('helvetica', 'B', 18);
			$pdf->SetDrawColor(79, 129, 189);
			$pdf->SetFillColor(79, 129, 189);
			$pdf->Cell(160, 12, 'Numerical Skills Test', 1, 0, 'C', 1);
			$pdf->Ln(20);
			$pdf->SetFont('helvetica', '', 12.5);
			$pdf->MultiCell(160, 8, iconv('UTF-8', 'windows-1252', 'The Numerical Skills Test, or NST, is a skills assessment that measures an individual’s ability to understand and interpret numerical information. The individual was required to interpret tables and graphs and answer questions that was related to these graphs and texts. The individual was also required to answer a range of numerical/maths related questions without the use of a calculator.'));
			$pdf->Ln(20);
			$pdf->setFont('helvetica', 'B', 12);
			$pdf->Cell(160, 5, 'RESULT');
			$pdf->Ln(20);
			$pdf->Image($rootPath . "images/rpt_chk/check_2_" . $score8 . ".png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);
			$pdf->Ln(30);

			$pdf->SetFont('', 'B');
			$pdf->SetFillColor(192, 0, 0);
			$pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252', "1 – 3 Low"), 1, 0, 'C', true);
			$pdf->SetFillColor(247, 150, 70);
			$pdf->Cell(54, 8, iconv('UTF-8', 'windows-1252', "4 – 6 Effective"), 1, 0, 'C', true);
			$pdf->SetFillColor(0, 176, 80);
			$pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252', "7 – 9 Enhanced"), 1, 0, 'C', true);
			$pdf->Ln();

			$y = $pdf->GetY();

			$pdf->SetFont('helvetica', '', 10);
			$pdf->SetFillColor(192, 0, 0);
			$pdf->MultiCell(53, 8, iconv('UTF-8', 'windows-1252', 'The candidate might find it very challenging interpreting and working with numerical data. The candidate might struggle to do basic calculations, read and interpret basic numerical information contained in graphs and tables.'), 1, 'J', true);

			$pdf->SetXY($pdf->GetX() + 53, $y);

			$pdf->SetFillColor(247, 150, 70);
			$pdf->MultiCell(54, 8, iconv('UTF-8', 'windows-1252', 'The candidate should not find it too challenging interpreting and working with numerical data. The candidate should not find it too difficult doing basic calculations, read and interpret basic numerical information contained in graphs and tables.'), 1, 'J', true);
			$pdf->SetXY($pdf->GetX() + 107, $y);

			$pdf->SetFillColor(0, 176, 80);
			$pdf->MultiCell(53, 8, iconv('UTF-8', 'windows-1252', "The candidate should find interpreting and working with numerical data very easy. The candidate should not experience any challenges doing basic calculations, read and interpret basic numerical information contained in graphs and tables."), 1, 'J', true);

			$pdf->Ln(10);
		} elseif ($value == 9) {
			$pdf->CheckPageBreak(250);
			$pdf->SetFont('helvetica', 'B', 18);
			$pdf->SetDrawColor(79, 129, 189);
			$pdf->SetFillColor(79, 129, 189);
			$pdf->Cell(160, 12, 'Drivers  Skills Test', 1, 0, 'C', 1);
			$pdf->Ln(20);
			$pdf->SetFont('helvetica', '', 12.5);
			$pdf->MultiCell(160, 8, iconv('UTF-8', 'windows-1252', 'The Drivers Skills Test, or DST, is a skills assessment that measures an individual’s drivers aptitude with specific reference to how well they can interpret maps, remember road signs, and their knowledge of the rules of the road.'));
			$pdf->Ln(20);
			$pdf->setFont('helvetica', 'B', 12);
			$pdf->Cell(160, 5, 'RESULT');
			$pdf->Ln(20);
			$pdf->Image($rootPath . "images/rpt_chk/check_2_" . $score9 . ".png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);
			$pdf->Ln(30);

			$pdf->SetDrawColor(0, 0, 0);
			$pdf->SetFillColor(255, 255, 255);
			$pdf->setFont('helvetica', '', 11);
			$pdf->Cell(135, 5, iconv('UTF-8', 'windows-1252', "Reading and Understanding Maps"));
			$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', $Secscore9['corr_A']), 1, "", "C");
			$pdf->ln();
			$pdf->Cell(135, 5, iconv('UTF-8', 'windows-1252', "Memory – Remembering Road Signs"));
			$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', $Secscore9['corr_B']), 1, "", "C");
			$pdf->ln();
			$pdf->Cell(135, 5, iconv('UTF-8', 'windows-1252', "Knowledge of the Rules of the Road"));
			$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', $Secscore9['corr_C']), 1, "", "C");
			$pdf->ln();
			$pdf->Ln(20);
			$pdf->SetFont('', 'B');
			$pdf->SetFillColor(192, 0, 0);
			$pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252', "1 – 3 Low"), 1, 0, 'C', true);
			$pdf->SetFillColor(247, 150, 70);
			$pdf->Cell(54, 8, iconv('UTF-8', 'windows-1252', "4 – 6 Effective"), 1, 0, 'C', true);
			$pdf->SetFillColor(0, 176, 80);
			$pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252', "7 – 9 Enhanced"), 1, 0, 'C', true);
			$pdf->Ln();

			$y = $pdf->GetY();

			$pdf->SetFont('helvetica', '', 10);
			$pdf->SetFillColor(192, 0, 0);
			$pdf->MultiCell(53, 11.2, iconv('UTF-8', 'windows-1252', 'The candidate scored low on the driver’s test and might experience difficulties remembering road signs, reading maps and applying the rules of the road appropriately.'), 1, 'L', true);

			$pdf->SetXY($pdf->GetX() + 53, $y);

			$pdf->SetFillColor(247, 150, 70);
			$pdf->MultiCell(54, 9.6, iconv('UTF-8', 'windows-1252', 'The candidate scored within the effective functioning range on the driver’s test and should not experience too many difficulties remembering road signs, reading maps and applying the rules of the road appropriately.'), 1, 'L', true);
			$pdf->SetXY($pdf->GetX() + 107, $y);

			$pdf->SetFillColor(0, 176, 80);
			$pdf->MultiCell(53, 11.2, iconv('UTF-8', 'windows-1252', 'The candidate scored very high on the driver’s test and should find it easy remembering road signs, reading maps and applying the rules of the road appropriately.'), 1, 'L', true);

			$pdf->Ln(10);
		} elseif ($value == 10) {
			$pdf->CheckPageBreak(250);
			$pdf->SetFont('helvetica', 'B', 18);
			$pdf->SetDrawColor(79, 129, 189);
			$pdf->SetFillColor(79, 129, 189);
			$pdf->Cell(160, 12, 'Accuracy Skills Test', 1, 0, 'C', 1);
			$pdf->Ln(20);
			$pdf->SetFont('helvetica', '', 12.5);
			$pdf->MultiCell(160, 8, iconv('UTF-8', 'windows-1252', 'The Accuracy Skills Test, or AST, is a skills assessment that measures an individual’s ability to spot mistakes and errors, and check for accuracy in text and numbers.'));
			$pdf->Ln(20);
			$pdf->setFont('helvetica', 'B', 12);
			$pdf->Cell(160, 5, 'RESULT');
			$pdf->Ln(20);
			$pdf->Image($rootPath . "images/rpt_chk/check_2_" . $score10 . ".png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);
			$pdf->Ln(30);

			$pdf->SetFont('', 'B');
			$pdf->SetFillColor(192, 0, 0);
			$pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252', "1 – 3 Low"), 1, 0, 'C', true);
			$pdf->SetFillColor(247, 150, 70);
			$pdf->Cell(54, 8, iconv('UTF-8', 'windows-1252', "4 – 6 Effective"), 1, 0, 'C', true);
			$pdf->SetFillColor(0, 176, 80);
			$pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252', "7 – 9 Enhanced"), 1, 0, 'C', true);
			$pdf->Ln();

			$y = $pdf->GetY();

			$pdf->SetFont('helvetica', '', 10);
			$pdf->SetFillColor(192, 0, 0);
			$pdf->MultiCell(53, 9.6, iconv('UTF-8', 'windows-1252', 'The participant might find it difficult to spot errors in sets of data. He/she is likely to make more mistakes than others when having to retype information.'), 1, 'L', true);

			$pdf->SetXY($pdf->GetX() + 53, $y);

			$pdf->SetFillColor(247, 150, 70);
			$pdf->MultiCell(54, 9.6, iconv('UTF-8', 'windows-1252', 'The participant should not find it too difficult to spot errors in sets of data. He/she is likely to make fewer mistakes than others when having to retype information.'), 1, 'L', true);
			$pdf->SetXY($pdf->GetX() + 107, $y);

			$pdf->SetFillColor(0, 176, 80);
			$pdf->MultiCell(53, 8, iconv('UTF-8', 'windows-1252', "The participant should not find it difficult at all to spot errors in sets of data. He/she will probably make no or very few mistakes when having to retype information."), 1, 'L', true);

			$pdf->Ln(10);
		} elseif ($value == 11) {
			$pdf->CheckPageBreak(250);

			$pdf->SetFont('helvetica', 'B', 18);
			$pdf->SetDrawColor(79, 129, 189);
			$pdf->SetFillColor(79, 129, 189);
			$pdf->Cell(160, 12, 'Mechanical Skills Test', 1, 0, 'C', 1);
			$pdf->Ln(20);
			$pdf->SetFont('helvetica', '', 12.5);
			$pdf->MultiCell(160, 8, iconv('UTF-8', 'windows-1252', 'The AH Mechanical Reasoning measures the understanding of the basic physics principles and mechanics, as well as the ability to visualise the movement of objects and the cause-effect relationships between mechanical components.'));
			$pdf->Ln(20);
			$pdf->setFont('helvetica', 'B', 12);
			$pdf->Cell(160, 5, 'RESULTS INTERPRETATION');
			$pdf->Ln(20);
			$pdf->Image($rootPath . "images/mst/scroe_" . $score11 . ".png", $pdf->GetX() - 2, $pdf->GetY() - 5, 165);
			$pdf->Ln(50);

			$pdf->SetFont('', 'B');
			$pdf->SetFillColor(255, 102, 102);
			$pdf->Cell(53, 18, iconv('UTF-8', 'windows-1252', "1 – 3 Low"), 1, 0, 'C', true);

			$pdf->SetFont('helvetica', '', 10);
			$pdf->SetFillColor(255, 255, 255);
			$pdf->MultiCell(110, 6, iconv('UTF-8', 'windows-1252', 'The participant might find it difficult to understand and visualize the movement of objects and cause-effect relationships between mechanical components.'), 1, 'J', true);

			$pdf->SetFillColor(255, 128, 0);
			$pdf->Cell(53, 18, iconv('UTF-8', 'windows-1252', "4 – 6 Effective"), 1, 0, 'C', true);
			$pdf->SetFillColor(0, 128, 64);

			$pdf->SetFillColor(255, 255, 255);
			$pdf->MultiCell(110, 6, iconv('UTF-8', 'windows-1252', 'The participant might should understand and visualize the movement of objects and cause-effect relationships between mechanical components.'), 1, 'L', true);

			$pdf->SetFillColor(0, 128, 64);
			$pdf->Cell(53, 18, iconv('UTF-8', 'windows-1252', "7 – 9 Enhanced"), 1, 0, 'C', true);
			$pdf->SetFillColor(255, 255, 255);
			$pdf->MultiCell(110, 6, iconv('UTF-8', 'windows-1252', 'The participant should find it very easy to visualize the movement of objects and cause-effect relationships between mechanical components.'), 1, 'L', true);

			$pdf->Ln(10);
		} elseif ($value == 12) {
			function getStatus12($code) {
				if ($code <= 10) {
					return 10;
				} elseif ($code >= 11 AND $code <= 15) {
					return 15;
				} elseif ($code >= 16 AND $code <= 20) {
					return 20;
				} elseif ($code >= 21 AND $code <= 25) {
					return 25;
				} elseif ($code >= 26 AND $code <= 30) {
					return 30;
				} elseif ($code >= 31 AND $code <= 35) {
					return 35;
				} elseif ($code >= 36 AND $code <= 40) {
					return 40;
				} elseif ($code >= 41 AND $code <= 45) {
					return 45;
				} elseif ($code >= 46 AND $code <= 50) {
					return 50;
				} elseif ($code >= 61 AND $code <= 65) {
					return 65;
				} elseif ($code >= 66 AND $code <= 70) {
					return 70;
				} elseif ($code >= 71 AND $code <= 75) {
					return 75;
				} elseif ($code >= 76 AND $code <= 80) {
					return 80;
				} elseif ($code >= 81 AND $code <= 85) {
					return 85;
				} elseif ($code >= 86 AND $code <= 90) {
					return 90;
				} elseif ($code >= 91 AND $code <= 95) {
					return 95;
				} else {
					return 100;
				}
			}
			$pdf->CheckPageBreak(250);

			$pdf->SetFont('helvetica', 'B', 18);
			$pdf->SetDrawColor(79, 129, 189);
			$pdf->SetFillColor(79, 129, 189);
			$pdf->Cell(160, 12, 'Electrical  Skills Test', 1, 0, 'C', 1);
			$pdf->Ln(20);
			$pdf->SetFont('helvetica', '', 12.5);
			$pdf->MultiCell(160, 8, iconv('UTF-8', 'windows-1252', 'The Electrical Skills Test, or MST, is a skills assessment that measures knowledge of Basic Electricity and electrical principles.'));
			$pdf->Ln(10);
			$pdf->setFont('helvetica', 'B', 12);
			$pdf->Cell(160, 5, 'RESULT');
			$pdf->Ln(20);
			$pdf->Image($rootPath . "images/EST_METER/" . getStatus12($Secscore12['corr_C']) . "%.png", $pdf->GetX() + 40, $pdf->GetY() - 5, 80);
			$pdf->Ln(60);

			$pdf->SetDrawColor(0, 0, 0);
			$pdf->setFont('helvetica', '', 11);
			$pdf->SetFillColor(219, 229, 241);
			$pdf->Cell(135, 5, iconv('UTF-8', 'windows-1252', "Total Correct"), 1, "", "L");
			$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', $Secscore12['corr_A']), 1, "", "C");
			$pdf->ln();
			$pdf->SetFillColor(255, 255, 255);
			$pdf->Cell(135, 5, iconv('UTF-8', 'windows-1252', "Total Wrong"), 1);
			$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', $Secscore12['corr_B']), 1, "", "C");
			$pdf->ln();

			$pdf->setFont('helvetica', 'B', 12);
			$pdf->Cell(135, 5, iconv('UTF-8', 'windows-1252', "Total Percentage"), 1);
			$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', round($Secscore12['corr_C'], 2) . "%"), 1, "", "C");
			$pdf->ln();
			$pdf->Ln(20);
			$pdf->SetFont('', 'B');
			$pdf->SetFillColor(192, 0, 0);
			$pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252', "1% – 39% Low"), 1, 0, 'C', true);
			$pdf->SetFillColor(247, 150, 70);
			$pdf->Cell(54, 8, iconv('UTF-8', 'windows-1252', "40% - 59% Effective"), 1, 0, 'C', true);
			$pdf->SetFillColor(0, 176, 80);
			$pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252', "60% - 100% Enhanced"), 1, 0, 'C', true);
			$pdf->Ln();

			$y = $pdf->GetY();

			$pdf->SetFont('helvetica', '', 10);
			$pdf->SetFillColor(192, 0, 0);
			$pdf->MultiCell(53, 8, iconv('UTF-8', 'windows-1252', 'The candidate’s basic knowledge and understanding of electricity and electrical priniciples is very low. Further development is strongly recommended.'), 1, 'L', true);

			$pdf->SetXY($pdf->GetX() + 53, $y);

			$pdf->SetFillColor(247, 150, 70);
			$pdf->MultiCell(54, 9.6, iconv('UTF-8', 'windows-1252', 'The candidate’s basic knowledge and understanding of electricity and electrical principles is effective. Some further practical training is advised.'), 1, 'L', true);
			$pdf->SetXY($pdf->GetX() + 107, $y);

			$pdf->SetFillColor(0, 176, 80);
			$pdf->MultiCell(53, 12, iconv('UTF-8', 'windows-1252', 'The candidate’s basic knowledge and understanding of electricity and electrical principles is extremely effective.'), 1, 'L', true);

			$pdf->Ln(10);
		}
	}
}
// desclaimer

$pdf->CheckPageBreak(250);
$pdf->SetFont('helvetica', 'B', 15);
$pdf->SetFillColor(79, 129, 189);
$pdf->Cell(0, 12, 'Disclosure', 0, 0, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(10);
$pdf->Ln(10);
$pdf->SetFont('helvetica', 'B', 11.5);
$pdf->Cell(20, 10, 'Purpose: ');
$pdf->SetFont('helvetica', '', 11.5);
$pdf->Cell(165, 10, iconv('UTF-8', 'windows-1252', ' The purpose of this report is to indicate the test-taker’s results on various skills,'));
$pdf->Ln();
$pdf->Cell(165, 10, iconv('UTF-8', 'windows-1252', 'aptitude, potential and behavioural attributes. This report is for the attention of the manager'));
$pdf->Ln(10);
$pdf->MultiCell(165, 10, iconv('UTF-8', 'windows-1252', 'who requested the assessment and remains the property of AssessmentHouse. This report may not be shared with any individual or company who is not trained in psychometric testing or have been authorised through informed consent by the test-taker and supervising psychologist.'));
$pdf->Ln(10);
$pdf->SetFont('helvetica', 'B', 11.5);
$pdf->Cell(23, 10, 'Disclaimer: ');
$pdf->SetFont('helvetica', '', 11.5);
$pdf->Cell(48, 10, '  Since the report contains ');
$pdf->SetFont('helvetica', 'B', 11.5);
$pdf->Cell(26, 10, ' confidential  ');
$pdf->SetFont('helvetica', '', 11.5);
$pdf->Cell(100, 10, 'information it needs to be dealt with');
$pdf->Ln(10);
$pdf->Cell(68, 10, 'accordingly. Consequently this report');
$pdf->SetFont('helvetica', 'B', 11.5);
$pdf->Cell(82, 10, ' may not be handed over to the participant. ');
$pdf->SetFont('helvetica', '', 11.5);
$pdf->Cell(100, 10, ' It may ');
$pdf->Ln(10);
$pdf->MultiCell(165, 8, "also not be used as evidence in a disciplinary hearing.  Should this report or the content of the report be handled or communicated incorrectly by any party within the company, AssessmentHouse cannot be held liable for any claims resulting from such action.");

// end report combine

$filePath = $u_name . "_" . $_POST['last_name'] . "_" . $og_u_name . "_" . date('Y_m_d') . ".pdf";
$pdf->Output($filePath, 'D');

?>