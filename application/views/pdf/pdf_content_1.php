<?php

$sectionArr = $clusterArr = $competencyArr = $competNameArr = $ansArr = array();

$fullName = $du_name[0]->first_name." ".$du_name[0]->last_name;
$u_title = $rTitle;
$u_name = $du_name[0]->first_name;
$gender = $du_name[0]->gender;
$og_u_name = "BECi";

$sectionArr = array('Behavioural Intelligence', 'Emotional Intelligence', 'Cultural Intelligence');
$clusterArr['Behavioural Intelligence'] = array('Business Intent', 'Communication', 'Leadership Intent', 'Creative Intent', 'Process Orientation', 'Solutions Intent', 'Results Driven', 'Strategic Intent');

    foreach ($test_code as $key => $row) {

        if ($row['section_name'] != 'Behavioural Intelligence') {
            $clusterArr[$row['section_name']][$row['cluster']] = $row['cluster'];
        }
        $competencyArr[$row['section_name']][$row['cluster']][$row['code']] = $row;
    }

$maxQuestionId = 0;
global $testCompletedDate;

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

$d = explode('-', substr($testCompletedDate, 0, 10));
$testCompletedDate = ($d[2] . '/' . $d[1] . '/' . $d[0]); 
$rootPath = ''; //$_SERVER['DOCUMENT_ROOT'].'/'; 
$vowels = array(" ");
$u_name = str_replace($vowels, "-", $u_name);
require("fpdf/mc_table.php");

class PDF extends PDF_MC_Table{
	
    function Header(){
        global $testCompletedDate;
        global  $rootPath;
        if ($this->PageNo() !== 1) {
            $this->Image($rootPath."images/perTestAssessmentHouse.png", 87, 10, 40);
            $this->SetTextColor(128, 128, 128);
            $this->SetFont('helvetica', '', 8);
            @$this->Cell(175, 7, $testCompletedDate, 0, 0, 'R');
            $this->Ln(20);
        }
    }

    function footer(){
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

    function createTableWithFormating($data, $lastWidth = 12, $borderData = array(), $bgColorData = array(), $newHeight = 7, $boldFontData = array(), $align = 'L'){
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
}


$pdf = new PDF("P", "mm", "A4");
$pdf->AddPage();
$imgPath = "IMAGE##80##10##" . $rootPath."images/rpt_chk/";
$pdf->AliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
$pdf->Image( $rootPath."images/BECI.jpg", -1, 0, 211, 298);
$pdf->SetY(255);
$pdf->SetX(80);
$pdf->SetFont('helvetica', '', 23);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(105, 10, $fullName, 0, 1, 'C');
$pdf->SetX(80);
$pdf->SetFont('helvetica', '', 18);
$pdf->Cell(105, 10, '('.$testCompletedDate.')', 0, 0, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->CheckPageBreak(250);

$pdf->SetFont('helvetica', 'B', 18);
$pdf->SetDrawColor(79, 129, 189);
$pdf->SetFillColor(79, 129, 189);
$pdf->Cell(160, 12, 'Behavioural, Emotional and Cultural Intelligence', 1, 0, 'C', 1);
$pdf->Ln(20);
$pdf->SetFont('helvetica', '', 12.5);
$pdf->MultiCell(160, 8, 'BECi, which is short for Behavioural, Emotional and Cultural Intelligence, provides detailed information about various attributes and competencies that gives context to the personality and behavioural make-up of an individual. It represents a powerful interpretation to assist the user when preparing for a feedback, writing reports, or interpreting information across a range of other contexts.');
$pdf->Ln(13);
$pdf->Image( $rootPath."images/bec_img.png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);
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
			$interpretation.= getNativeRule($code, $score)." ";
            $printData = array(getRulebase($code, $score), $imgPath . 'check_' . $sKey . '_' . $score . '.png');
            $pdf->createTableWithFormating($printData, 80, $borderData, array($bgColorArr[$sKey]), 5);
        }
		
		$pdf->Ln(10);
		$pdf->SetFont('helvetica', 'B', 12);
		$pdf->Cell(80, 7, "Interpretation");
        $pdf->Ln(10);
		$interpretation = str_replace('Name ', $fullName.' ', $interpretation);
		if($gender == 'female'){
			$searchArr = array('He ', 'His ', ' he ', ' his ', 'himself ');
			$replaceArr = array('She ', 'Her ', ' she ', ' her ', 'herself ');
			$interpretation = str_replace($searchArr, $replaceArr, $interpretation);
			/*$interpretation = str_ireplace('He ', 'She ', $interpretation);
			$interpretation = str_ireplace('His ', 'Her ', $interpretation);
			$interpretation = str_ireplace(' he ', ' she ', $interpretation);
			$interpretation = str_ireplace(' his ', ' her ', $interpretation); */
		}
		$pdf->SetFont('helvetica', '', 9);
		$pdf->MultiCell(160, 5, $interpretation);
        $pdf->Ln(8);
		$pdf->CheckPageBreak(250);
        /*if ($culNo == 2 || $cluster == 'Self Management') {
            $pdf->CheckPageBreak(250);
            $culNo = 0;
        }*/
    }

	sort($tempNameArr);
	$competNameArr[$section] =  $tempNameArr;
	
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
$pdf->CheckPageBreak(250);
$pdf->SetFont('helvetica', 'B', 15);
$pdf->SetDrawColor(128, 128, 128);
$pdf->SetFillColor(128, 128, 128);
$pdf->Cell(80, 12, 'Purpose  ', 1, 0, 'R', 1);
$pdf->SetTextColor(128, 128, 128);
$pdf->Cell(80, 12, 'Disclaimer', 1, 1, 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(8);
$pdf->SetFont('helvetica', 'B', 11.5);
$pdf->Cell(20, 10, 'Purpose: ');
$pdf->SetFont('helvetica', '', 11.5);
$pdf->Cell(165, 10, iconv('UTF-8', 'windows-1252',' The purpose of this report is to indicate the test-taker’s results on various skills,'));
$pdf->Ln();
$pdf->Cell(165, 10, iconv('UTF-8', 'windows-1252','aptitude, potential and behavioural attributes. This report is for the attention of the manager'));
$pdf->Ln(10);
$pdf->MultiCell(165, 10, iconv('UTF-8', 'windows-1252','who requested the assessment and remains the property of AssessmentHouse. This report may not be shared with any individual or company who is not trained in psychometric testing or have been authorised through informed consent by the test-taker and supervising psychologist.'));
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


$filePath = $u_name . "_" . $du_name[0]->last_name . "_" . $og_u_name . "_" .$d[2] . '_' . $d[1] . '_' . $d[0] . ".pdf";
$pdf->Output($filePath, 'D');

function getScore($code = '', $totVal){
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

function getRulebase($codeArr, $totVal){
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

function getNativeRule($codeArr, $totVal){
    if ($totVal == 1 || $totVal == 2) {
        return $codeArr['native_rule_1and2'];
    } else if ($totVal == 3) {
        return $codeArr['native_rule_3'];
    } else if ($totVal == 4 ) {
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

 ?>