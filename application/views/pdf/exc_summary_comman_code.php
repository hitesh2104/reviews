<?php

$pdf->Image($rootPath . "images/Blue_line.png", 10, 12, 5, 270);
$pdf->SetX(25);
$pdf->SetTextColor(35, 125, 194);
$pdf->SetFont('helvetica', 'I', 20);
$pdf->Cell(100, 9, "", 0, 0, 'C');
$pdf->Ln();
$pdf->SetX(60);
$pdf->SetFont('helvetica', 'I', 20);
$pdf->Cell(100, 9, strtoupper($fullName), 'B', 0, 'C');
$pdf->Ln();
$pdf->SetX(60);
$pdf->SetFont('helvetica', 'I', 9);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(50, 7, 'AGE', 'R', 0, 'R');
$pdf->SetFillColor(242, 242, 242);
$pdf->Cell(50, 7, $_POST['age'], 'L', 1, 'L', true);

$pdf->SetX(60);
$pdf->Cell(50, 7, 'GENDER', 'R', 0, 'R');
$pdf->SetFillColor(255);
$pdf->Cell(50, 7, strtoupper($gender), 0, 1, 'L');
$pdf->SetX(60);
$pdf->Cell(50, 7, 'HOME LANGUAGE', 'R', 0, 'R');
$pdf->SetFillColor(242, 242, 242);
$pdf->Cell(50, 7, strtoupper($_POST['home_language']), 'L', 1, 'L', true);
$pdf->SetX(60);
$pdf->Cell(50, 7, 'ETHNICITY', 'R', 0, 'R');
$pdf->SetFillColor(255);
$pdf->Cell(50, 7, strtoupper($_POST['ethnicity']), 0, 1, 'L');
$pdf->SetX(60);
$pdf->Cell(50, 7, 'HIGHEST QUALIFICATION', 'R', 0, 'R');
$pdf->SetFillColor(242, 242, 242);
$pdf->Cell(50, 7, strtoupper($_POST['heighest_education']), 'L', 1, 'L', true);
$pdf->Ln(20);

$pdf->SetLeftMargin(25);
$pdf->SetTextColor(35, 125, 194);
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(50, 9, 'Executive Summary');
$role = '';
$familyRol = $projectData[0]->job_success_profile;
if (explode(" (", $familyRol)) {
	$cmpList = explode(" (", $familyRol);
	$role = str_replace(')', '', isset($cmpList[1]) ? $cmpList[1] : '');
}
$pdf->Ln(10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 10);
$pdf->MultiCell(170, 6, $fullName . " completed a battery of psychometric assessments and " . (($gender == 'female') ? 'her' : 'his') . " results was compared against the " . $role . " Job Success Profile. The Executive Summary provides a brief overview of " . $fullName . " overall results.");
$pdf->Ln(6);
$allRules = '';
if (isset($test_details) && isset($test_details)) {
	foreach ($test_details as $test) {
		if ($test->status == "completed") {

			if ($test->test_short_name == 'BECi') {
				/*$pdf->SetFont('helvetica', 'B', 14);
					$pdf->SetTextColor(255, 255, 255);
					$pdf->SetFillColor(15, 36, 62);
					$pdf->Cell(170, 8, $test->test_name, 0, '', '', 1);
					$pdf->SetTextColor(0, 0, 0);
					$pdf->Ln(12);*/

				$impactComp = $importantComp = '';
				$impactCompResult = $importantCompResult = array();
				$impactCompArr = (isset($jspData['impact_competencies']) && !empty($jspData['impact_competencies'])) ? explode(',', $jspData['impact_competencies']) : array();
				$importantCompArr = (isset($jspData['important_competencies']) && !empty($jspData['important_competencies'])) ? explode(',', $jspData['important_competencies']) : array();

				function getExcScore($code = '', $totVal) {
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

				function getExcRulebase($codeArr, $totVal) {
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

				function getExcNativeRule($codeArr, $totVal) {
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

				//$pdf->CheckPageBreak(250);
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
				foreach ($sectionArr as $sKey => $section) {
					$secArr = explode(" ", $section);
					/*$pdf->SetFont('helvetica', 'B', 15);
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
						}*/
					$pdf->SetTextColor(0, 0, 0);
					//$pdf->Ln(18);
					$culNo = 0;
					$bgColorArr = array('219, 229, 241', '242, 219, 219', '218, 238, 243');
					$tempNameArr = array();
					foreach ($clusterArr[$section] as $key => $cluster) {
						//print_r($clusterArr[$section]); die;
						$culNo++;
						/* $pdf->SetFont('helvetica', 'B', 12);
							$pdf->SetTextColor(255, 255, 255);
							if ($section == 'Behavioural Intelligence') {
								$pdf->SetFillColor(31, 73, 125);
								$pdf->Cell(160, 9, " " . $cluster, 1, '', '', 1);
								$pdf->Ln(9);
							} else if ($section == 'Emotional Intelligence') {
								$pdf->SetFillColor(148, 17, 0);
								$pdf->Cell(160, 9, " " . $cluster, 1, '', '', 1);
								$pdf->Ln(9);
							}*/
						foreach ($competencyArr[$section][$cluster] as $code) {
							//print_r($code); die;

							/* $pdf->SetFont('helvetica', 'I', 10);
								if ($section == 'Behavioural Intelligence') {
									$pdf->SetFillColor(84, 141, 212);
									$pdf->SetTextColor(0, 0, 0);
								} else if ($section == 'Emotional Intelligence') {
									$pdf->SetTextColor(255, 255, 255);
									$pdf->SetFillColor(192, 0, 0);
								} else {
									$pdf->SetFillColor(0, 145, 147);
									$pdf->SetTextColor(0, 0, 0);
								}*/
							$tempNameArr[] = array('competency' => $code['competency'], 'definition' => $code['definition']);
							//$pdf->Cell(80, 7, " " . $code['competency'], 1, '', '', 1);
							//$pdf->Cell(80, 7, " ", 'TR');
							//$pdf->Ln(7);
							$pdf->SetFont('helvetica', '', 9);
							$answer = isset($ansArr[$code['code']]) ? $ansArr[$code['code']] : 0;
							$borderData = array('DF', 'LRB', 'DF', 'DF', 'DF', 'DF');
							$pdf->SetWidths(array(80, 80));
							$score = getExcScore($code['code'], $answer);
							$impactComp = '';
							$importantComp = '';
							if (in_array($code['code'], $impactCompArr)) {
								$impactComp = getExcNativeRule($code, $score);
								$impactCompResult[] = array('code' => $code['code'], 'competency' => $code['competency'], 'rule' => $impactComp);
							}
							if (in_array($code['code'], $importantCompArr)) {
								$importantComp = getExcNativeRule($code, $score);
								$importantCompResult[] = array('code' => $code['code'], 'competency' => $code['competency'], 'rule' => $importantComp);
							}

							// $printData = array(getExcRulebase($code, $score), $imgPath . 'check_' . $sKey . '_' . $score . '.png');
							// $pdf->createTableWithFormating($printData, 80, $borderData, array($bgColorArr[$sKey]), 5);
						}

						/*if ($culNo == 2 || $cluster == 'Self Management') {
								$pdf->CheckPageBreak(250);
								$culNo = 0;
							}*/
					}

					sort($tempNameArr);
					$competNameArr[$section] = $tempNameArr;

					$pdf->SetTextColor(0, 0, 0);
					$pdf->SetFillColor(255, 255, 255);
				}

				// Impact competencies section
				/*$pdf->SetFont('helvetica', 'B', 10);
					$pdf->SetTextColor(211, 0, 0);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->Cell(170, 7, "Rules for all Impact competencies :-", 0, '', '', 1);
					$pdf->Ln(7);*/
				$impactComp = '';
				foreach ($impactCompResult as $impResult) {
					//chr(149)."  ".$impResult['rule']." \n"

					if ($gender != 'female') {
						$impactComp .= str_replace('Name ', $fullName . ' ', $impResult['rule'] . " ");
					} else {
						$searchArr = array('He ', 'His ', ' he ', ' his ', 'himself ');
						$replaceArr = array('She ', 'Her ', ' she ', ' her ', 'herself ');
						$impactComp .= str_replace($searchArr, $replaceArr, str_replace('Name ', $fullName . ' ', $impResult['rule'] . " "));
					}
				}
				/*$pdf->SetFillColor(255, 255, 255);
					$pdf->SetTextColor(0, 0, 0);

					$pdf->SetFont('helvetica', '', 10);
					$pdf->MultiCell(170, 5, $impactComp);
					$pdf->Ln(8);*/

				/*// Essential competencies section
					$pdf->SetFont('helvetica', 'B', 10);
					$pdf->SetTextColor(211, 0, 0);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->Cell(170, 7, "Rules for all Essential competencies :-", 0, '', '', 1);
					$pdf->Ln(7);*/
				// twise
				$importantComp = '';
				foreach ($importantCompResult as $importResult) {
					if ($gender != 'female') {
						$importantComp .= str_replace('Name ', $fullName . ' ', $importResult['rule'] . " ");
					} else {
						$searchArr = array('He ', 'His ', ' he ', ' his ', 'himself ');
						$replaceArr = array('She ', 'Her ', ' she ', ' her ', 'herself ');
						$importantComp .= str_replace($searchArr, $replaceArr, str_replace('Name ', $fullName . ' ', $importResult['rule'] . " "));
					}
				}
				$pdf->SetFillColor(255, 255, 255);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->SetFont('helvetica', '', 10);
				$pdf->MultiCell(170, 5, $impactComp);
				$pdf->Ln(8);

				$pdf->SetFillColor(255, 255, 255);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->SetFont('helvetica', '', 10);
				$pdf->MultiCell(170, 5, $importantComp);
				$pdf->Ln(8);

				//$pdf->CheckPageBreak(250);

				/*//$pdf->CheckPageBreak(250);
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
						//foreach ($clusterArr[$section] as $key => $cluster) {
							//$culNo++;
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
						//}
						$pdf->SetTextColor(0, 0, 0);
						$pdf->SetFillColor(255, 255, 255);
					}*/

			} elseif ($test->test_short_name == 'MIRa') {
				$pdf->SetX(25);
				$selectedOnJSP = isset($jspData['level_of_gomplexity']) ? $jspData['level_of_gomplexity'] : 0;
				$miraRuleArr = array();
				if (isset($miraRules) && !empty($miraRules)) {
					foreach ($miraRules as $rule) {
						$miraRuleArr[$rule['level_of_gomplexity']] = $rule;
					}
				}
				//$pdf->CheckPageBreak(250);

				/*$pdf->SetFont('helvetica', 'B', 14);
					$pdf->SetTextColor(255, 255, 255);
					$pdf->SetFillColor(15, 36, 62);
					$pdf->Cell(170, 8, $test->test_name, 0, '', '', 1);
					$pdf->SetTextColor(0, 0, 0);
					$pdf->Ln(12);*/
				//echo $score2; die;
				$miraRule = isset($miraRuleArr[$selectedOnJSP]) ? isset($miraRuleArr[$selectedOnJSP]['mira_result_' . $score2]) ? $miraRuleArr[$selectedOnJSP]['mira_result_' . $score2] : '' : '';

				$miraRule = str_replace('Name', $fullName . '', $miraRule);
				$miraRule = str_replace('job_role', $role . '', $miraRule);
				if ($gender == 'female') {
					$searchArr = array('He ', 'His ', ' he ', ' his ', 'himself ');
					$replaceArr = array('She ', 'Her ', ' she ', ' her ', 'herself ');
					$miraRule = str_replace($searchArr, $replaceArr, $miraRule);
				}

				/*$pdf->SetFont('helvetica', 'B', 10);
					$pdf->SetTextColor(211, 0, 0);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->Cell(170, 8, 'Rules for MIRA :- ', 0, 1, '', 1);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->SetTextColor(0, 0, 0);*/

				$pdf->SetFont('helvetica', '', 10);
				$pdf->MultiCell(170, 5, $miraRule);
				$pdf->Ln(8);

			} elseif ($test->test_short_name == 'LAP') {
				$pdf->SetX(25);
				function getExcRule($code) {
					if ($code < 4) {
						return "From a learning potential point of view, Name's overall learning potential score was below the average range. He might find learning new information fast challenging and take longer than others to understand and apply new concepts.";

					} elseif ($code >= 4 && $code < 6) {
						return "From a learning potential point of view, Name's overall learning potential score was within the average range. He should find learning new information as challenging as most  and should understand and apply new concepts as effective as most people.";

					} elseif ($code >= 6) {
						return "From a learning potential point of view, Name's overall learning potential score was above the average range. He should find learning new information very easy and should understand and apply new concepts quicker than most people. ";
					}
				}
				// $pdf->CheckPageBreak(250);

				/*$pdf->SetFont('helvetica', 'B', 14);
					$pdf->SetTextColor(255, 255, 255);
					$pdf->SetFillColor(15, 36, 62);
					$pdf->Cell(170, 8, $test->test_name, 0, '', '', 1);
					$pdf->SetTextColor(0, 0, 0);
					$pdf->Ln(12);
					//echo $score2; die;*/
				$lapRule = getExcRule($score3);

				$lapRule = str_replace('Name', $fullName . '', $lapRule);
				if ($gender == 'female') {
					$searchArr = array('He ', 'His ', ' he ', ' his ', 'himself ');
					$replaceArr = array('She ', 'Her ', ' she ', ' her ', 'herself ');
					$lapRule = str_replace($searchArr, $replaceArr, $lapRule);
				}
//					$allRules .= $lapRule;
				/*$pdf->SetFont('helvetica', 'B', 10);
					$pdf->SetTextColor(211, 0, 0);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->Cell(170, 8, 'Rules for LAP :-', 0, 1, '', 1);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->SetTextColor(0, 0, 0); */

				$pdf->SetFont('helvetica', '', 10);
				$pdf->MultiCell(170, 5, $lapRule);
				$pdf->Ln(8);
			} elseif ($test->test_short_name == 'DIP') {
				//  $pdf->CheckPageBreak(250);
			} elseif ($test->test_short_name == 'IPT') {
				// $pdf->CheckPageBreak(250);
			} elseif ($test->test_short_name == 'OPT') {
				// $pdf->CheckPageBreak(250);
			} elseif ($test->test_short_name == 'VST') {
				$pdf->SetX(25);
				function getExcVSTRule($code) {
					if ($code < 4) {
						return "Name's verbal reasoning score was below the effective functioning range and might find understanding written instructions and interpreting information challenging most of the times.";

					} elseif ($code >= 4 && $code < 6) {
						return "Name's verbal reasoning score was within the effective functioning range and should  understand written instructions and interpreting information less challenging.";

					} elseif ($code >= 6) {
						return "Name's verbal reasoning score was above the effective functioning range and should  understand written instructions and interpreting information easier than most others.";
					}
				}
				// $pdf->CheckPageBreak(250);

				/*$pdf->SetFont('helvetica', 'B', 14);
					$pdf->SetTextColor(255, 255, 255);
					$pdf->SetFillColor(15, 36, 62);
					$pdf->Cell(170, 8, $test->test_name, 0, '', '', 1);
					$pdf->SetTextColor(0, 0, 0);
					$pdf->Ln(12);
					//echo $score2; die;*/
				$lapRule = getExcVSTRule($score7);

				$lapRule = str_replace('Name', $fullName . '', $lapRule);
				if ($gender == 'female') {
					$searchArr = array('He ', 'His ', ' he ', ' his ', 'himself ');
					$replaceArr = array('She ', 'Her ', ' she ', ' her ', 'herself ');
					$lapRule = str_replace($searchArr, $replaceArr, $lapRule);
				}
				$allRules .= $lapRule;
				/*$pdf->SetFont('helvetica', 'B', 10);
					$pdf->SetTextColor(211, 0, 0);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->Cell(170, 8, 'Rules for VST :-', 0, 1, '', 1);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->SetTextColor(0, 0, 0);

					$pdf->SetFont('helvetica', '', 10);
					$pdf->MultiCell(170, 5, $lapRule);
					$pdf->Ln(8);*/

			} elseif ($test->test_short_name == 'NST') {
				$pdf->SetX(25);
				function getExcNSTRule($code) {
					if ($code < 4) {
						return " His numerical reasoning score was below the average range and might find it quite difficult to understand graphs and tables, and to perform basic numerical calculations.";

					} elseif ($code >= 4 && $code < 6) {
						return " His numerical reasoning score was within the average range and should not find it to difficult to understand graphs and tables, and to perform basic numerical calculations.";

					} elseif ($code >= 6) {
						return " His numerical reasoning score was above the average range and should find it very easy to understand graphs and tables, and to perform basic numerical calculations.";
					}
				}
				// $pdf->CheckPageBreak(250);

				/*$pdf->SetFont('helvetica', 'B', 14);
					$pdf->SetTextColor(255, 255, 255);
					$pdf->SetFillColor(15, 36, 62);
					$pdf->Cell(170, 8, $test->test_name, 0, '', '', 1);
					$pdf->SetTextColor(0, 0, 0);
					$pdf->Ln(12);
					//echo $score2; die;*/
				$lapRule = getExcNSTRule($score8);

				$lapRule = str_replace('Name', $fullName . '', $lapRule);
				if ($gender == 'female') {
					$searchArr = array('He ', 'His ', ' he ', ' his ', 'himself ');
					$replaceArr = array('She ', 'Her ', ' she ', ' her ', 'herself ');
					$lapRule = str_replace($searchArr, $replaceArr, $lapRule);
				}
				$allRules .= $lapRule;
				/*$pdf->SetFont('helvetica', 'B', 10);
					$pdf->SetTextColor(211, 0, 0);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->Cell(170, 8, 'Rules for NST :-', 0, 1, '', 1);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->SetTextColor(0, 0, 0);

					$pdf->SetFont('helvetica', '', 10);
					$pdf->MultiCell(170, 5, $lapRule);
					$pdf->Ln(8);*/

			} elseif ($test->test_short_name == 'DST') {} elseif ($test->test_short_name == 'AST') {
				$pdf->SetX(25);
				function getExcASTRule($code) {
					if ($code < 4) {
						return " From a quality orientation point of view, Name performed lower than most others. His ability to find errors or mistakes in written information is low and might produce results that is of lower quality.";

					} elseif ($code >= 4 && $code < 6) {
						return " From a quality orientation point of view, Name performed as well as most others. His ability to find errors or mistakes in written information is effective and should produce results that is of good quality.";

					} elseif ($code >= 6) {
						return " From a quality orientation point of view, Name performed better than most others. His ability to find errors or mistakes in written information is within the enhanced range, and he should produce results that is of excellent quality.";
					}
				}
				// $pdf->CheckPageBreak(250);

				/*$pdf->SetFont('helvetica', 'B', 14);
					$pdf->SetTextColor(255, 255, 255);
					$pdf->SetFillColor(15, 36, 62);
					$pdf->Cell(170, 8, $test->test_name, 0, '', '', 1);
					$pdf->SetTextColor(0, 0, 0);
					$pdf->Ln(12);
					//echo $score2; die;*/
				$lapRule = getExcASTRule($score10);

				$lapRule = str_replace('Name', $fullName . '', $lapRule);
				if ($gender == 'female') {
					$searchArr = array('He ', 'His ', ' he ', ' his ', 'himself ');
					$replaceArr = array('She ', 'Her ', ' she ', ' her ', 'herself ');
					$lapRule = str_replace($searchArr, $replaceArr, $lapRule);
				}
				$allRules .= $lapRule;
				/*$pdf->SetFont('helvetica', 'B', 10);
					$pdf->SetTextColor(211, 0, 0);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->Cell(170, 8, 'Rules for AST :-', 0, 1, '', 1);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->SetTextColor(0, 0, 0);

					$pdf->SetFont('helvetica', '', 10);
					$pdf->MultiCell(170, 5, $lapRule);
					$pdf->Ln(8);*/

			} elseif ($test->test_short_name == 'MST') {
				$pdf->SetX(25);
				function getExcMSTRule($code) {
					if ($code < 4) {
						return " Name's mechanical reasoning score is below average. He might find understanding the principles of mechanics, spatial ability, and cause and effect relationships quite difficult.";

					} elseif ($code >= 4 && $code < 6) {
						return " Name's mechanical reasoning score is within the average range. He might not find it too difficult to understand the principles of mechanics, spatial ability, and cause and effect relationships.";

					} elseif ($code >= 6) {
						return " Name's mechanical reasoning score is above the average range. He should find it very easy to understand the principles of mechanics, spatial ability, and cause and effect relationships.";
					}
				}
				// $pdf->CheckPageBreak(250);

				/*$pdf->SetFont('helvetica', 'B', 14);
					$pdf->SetTextColor(255, 255, 255);
					$pdf->SetFillColor(15, 36, 62);
					$pdf->Cell(170, 8, $test->test_name, 0, '', '', 1);
					$pdf->SetTextColor(0, 0, 0);
					$pdf->Ln(12);
					//echo $score2; die; */
				$lapRule = getExcMSTRule($score11);

				$lapRule = str_replace('Name', $fullName . '', $lapRule);
				if ($gender == 'female') {
					$searchArr = array('He ', 'His ', ' he ', ' his ', 'himself ');
					$replaceArr = array('She ', 'Her ', ' she ', ' her ', 'herself ');
					$lapRule = str_replace($searchArr, $replaceArr, $lapRule);
				}
				$allRules .= $lapRule;
				/*$pdf->SetFont('helvetica', 'B', 10);
					$pdf->SetTextColor(211, 0, 0);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->Cell(170, 8, 'Rules for MST :-', 0, 1, '', 1);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->SetTextColor(0, 0, 0);

					$pdf->SetFont('helvetica', '', 10);
					$pdf->MultiCell(170, 5, $lapRule);
					$pdf->Ln(8);*/

			} elseif ($test->test_short_name == 'EST') {
				$pdf->SetX(25);
				function getExcESTRule($code) {
					if ($code < 4) {
						return " His ability to understand the basic principles of electricity and electrical components is well below average. He might find it quite challenging working in environments where this skill is required and further development is recommended.";

					} elseif ($code >= 4 && $code < 6) {
						return " His ability to understand the basic principles of electricity and electrical components is within the average range. He might find it as easy as most others within this industry working in environments where this skill is required.";

					} elseif ($code >= 6) {
						return " His ability to understand the basic principles of electricity and electrical components is well above the average range. He might find it easier than most others within this industry working in environments where this skill is required.";
					}
				}
				// $pdf->CheckPageBreak(250);

				/*$pdf->SetFont('helvetica', 'B', 14);
					$pdf->SetTextColor(255, 255, 255);
					$pdf->SetFillColor(15, 36, 62);
					$pdf->Cell(170, 8, $test->test_name, 0, '', '', 1);
					$pdf->SetTextColor(0, 0, 0);
					$pdf->Ln(12);
					//echo $score2; die; */
				$lapRule = getExcESTRule($score12);

				$lapRule = str_replace('Name', $fullName . '', $lapRule);
				if ($gender == 'female') {
					$searchArr = array('He ', 'His ', ' he ', ' his ', 'himself ');
					$replaceArr = array('She ', 'Her ', ' she ', ' her ', 'herself ');
					$lapRule = str_replace($searchArr, $replaceArr, $lapRule);
				}
				$allRules .= $lapRule;

				/*$pdf->SetFont('helvetica', 'B', 10);
					$pdf->SetTextColor(211, 0, 0);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->Cell(170, 8, 'Rules for EST :-', 0, 1, '', 1);
					$pdf->SetFillColor(255, 255, 255);
					$pdf->SetTextColor(0, 0, 0);

					$pdf->SetFont('helvetica', '', 10);
					$pdf->MultiCell(170, 5, $lapRule);
					$pdf->Ln(8);*/

			}

		}
	}
}

if ($pdf->GetY() > 20) {
	$pdf->Image($rootPath . "images/Blue_line.png", 10, 12, 5, 270);
	$pdf->SetX(25);
}
$pdf->SetFont('helvetica', '', 10);
$pdf->MultiCell(170, 5, $allRules);
$pdf->Ln(8);
if ($pdf->GetY() > 20) {
	$pdf->Image($rootPath . "images/Blue_line.png", 10, 12, 5, 270);
	$pdf->SetX(25);
}
if (!empty($post['content'])) {
	$pdf->Ln(2);
	$pdf->SetTextColor(35, 125, 194);
	$pdf->SetFont('helvetica', 'B', 16);
	$pdf->Cell(20, 9, 'Conclusion');

	$pdf->Ln(10);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFont('helvetica', '', 10);
	$pdf->MultiCell(165, 6, preg_replace("/&#?[a-z0-9]{2,8};/i", "", filter_var(@$post['content'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));

}

$pdf->Ln(30);
if ($pdf->GetY() > 215) {
	$pdf->CheckPageBreak(250);
}
$pdf->Image($rootPath . "images/Blue_line.png", 10, 12, 5, 270);
$pdf->SetX(25);

//$pdf->setXY(110,183);
$pdf->setX(110);
$pdf->SetTextColor(35, 125, 194);
$pdf->SetFont('helvetica', 'I', 20);
$pdf->Cell(50, 9, 'Assessments Completed');
$pdf->Ln(10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 10);
if (isset($test_details) && isset($test_details)) {
	foreach ($test_details as $test) {
		$sName = $test->test_short_name;
		if ($test->status == "completed" && $sName != 'DIP' && $sName != 'IPT' && $sName != 'OPT' && $sName != 'DST') {
			$pdf->setX(110);
			$pdf->Cell(50, 9, chr(149) . "  " . $test->test_name);
			$pdf->Ln(6);
		}
	}
}

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 10);
?>