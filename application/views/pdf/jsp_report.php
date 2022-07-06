<?php
    
    $fullName = $_POST['first_name'] ." ". $_POST['last_name'];
    
    $u_title = "Executive Summary";
    $u_name = $_POST['first_name'];
    $gender = $_POST['gender'];
    $og_u_name = "Integrate_Report";
    
    
    
    $testCompletedDate = date('Y-m-d');
    $rootPath = '';
    $vowels = array(" ");
    $u_name = str_replace($vowels, "-", $u_name);
    
    require("fpdf/mc_table.php");
    
    class PDF extends PDF_MC_Table{
        
        function Header(){
            global $testCompletedDate;
            global  $rootPath;
            $this->Image($rootPath."images/perTestAssessmentHouse.png", 87, 10, 40);
            $this->SetTextColor(128, 128, 128);
            $this->SetFont('helvetica', '', 8);
            @$this->Cell(175, 7, $testCompletedDate, 0, 0, 'R');
            $this->Ln(20);
        }
        
        function footer(){
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
    $pdf->Image( $rootPath."images/Blue_line.png", 10, 0, 5, 282);
    $pdf->SetX(90);
    $pdf->SetTextColor(35, 125, 194);
    $pdf->SetFont('helvetica', 'I', 20);
    $pdf->Cell(100, 9, "", 0, 0, 'C');
    $pdf->Ln();
    $pdf->SetX(90);
    $pdf->SetFont('helvetica', 'I', 20);
    $pdf->Cell(100, 9, $fullName, 'B', 0, 'C');
    $pdf->Ln();
    $pdf->SetX(90);
    $pdf->SetFont('helvetica', 'I', 9);
    $pdf->SetTextColor(0, 0, 0);
    
    $pdf->Cell(50,7,'AGE','R',0,'R');
    $pdf->SetFillColor(242, 242, 242);
    $pdf->Cell(50,7,$_POST['age'],'L',1,'L',true);
    
    $pdf->SetX(90);
    $pdf->Cell(50,7,'GENDER','R',0,'R');
    $pdf->SetFillColor(255);
    $pdf->Cell(50,7,$gender,0,1,'L');
    $pdf->SetX(90);
    $pdf->Cell(50,7,'HOME LANGUAGE','R',0,'R');
    $pdf->SetFillColor(242, 242, 242);
    $pdf->Cell(50,7,$_POST['home_language'],'L',1,'L',true);
    $pdf->SetX(90);
    $pdf->Cell(50,7,'ETHNICITY','R',0,'R');
    $pdf->SetFillColor(255);
    $pdf->Cell(50,7,$_POST['ethnicity'],0,1,'L');
    $pdf->SetX(90);
    $pdf->Cell(50,7,'HIGHEST QUALIFICATION','R',0,'R');
    $pdf->SetFillColor(242, 242, 242);
    $pdf->Cell(50,7,$_POST['heighest_education'],'L',1,'L',true);
    
    $pdf->Ln(20);
    
    $pdf->SetTextColor(35, 125, 194);
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->Cell(50,9,'Executive Summary');
    
    $pdf->Ln(10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->MultiCell(165, 6, preg_replace("/&#?[a-z0-9]{2,8};/i","",filter_var(@$post['content'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH)));
    
    $pdf->Ln();
    
    $pdf->setXY(110,183);
    
    $pdf->SetTextColor(35, 125, 194);
    $pdf->SetFont('helvetica', 'I', 20);
    $pdf->Cell(50,9,'Assessments Completed');
    
    $pdf->Ln();
    
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('helvetica', '', 10);
    
    if(isset($_POST['test']) && count($_POST['test']) > 0)
    {
        foreach ($post['test'] as $value)
        {
            $pdf->SetX(110);
            
            $pdf->Cell(50,7,iconv('UTF-8', 'windows-1252','• '.$value),0,1,'L');
        }
    }
    
    // report combine
    if(isset($_POST['test_list']) && count($_POST['test_list']) > 0)
    {
        foreach ($_POST['test_list'] as  $value) {
            
            if($value==1)
            {
                
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
            }
            elseif ($value==2) {
                $pdf->CheckPageBreak(250);
                
                $he = "he";
                $He = "He";
                $his = "his";
                $him = "him";
                
                if($gender != "male")
                {
                    $he = "she";
                    $He = "She";
                    $his = "her";
                    $him = "her";
                }
                // heading
                $heading_ = "";
                $heading_1 = "SST LEVEL 1 - TANGIBLE BRILLIANCE";
                $heading_2 = "SST LEVEL 2 – EXCELLENCE CLARIFICATION";
                $heading_3 = "SST LEVEL 3 – STRATEGY EXECUTION";
                $heading_4 = "SST LEVEL 4 – STRATEGY CONTEXTUALISING";
                $heading_5 = "SST LEVEL 5 – STRATEGY CONCEPTUALISING";
                // data
                //1
                $score_ = "";
                $sub_score_ = "";
                
                $score_1 = "$u_name seems to be more comfortable working in an environment with tangible outputs where quality is $his main priority. $He may prefer to follow a clear set of guidelines to perform optimally and is more inclined to function in an operational and/or technical environment. A structured environment will probably suite $him better where $he can plan and organise $his daily activities. $He might also be more inclined to follow routines as this will make $his work activities more predictable and measurable.";
                $sub_score_1="Leaders on this level are usually leaders of self, having to manage their own work schedules and plan their own day-to-day activities. ";
                //2
                $score_2 = "It seems that $u_name might find working in an environment where $he has to solve problems where answers is not very clear by using $his knowledge and/or experience. $u_name tends to ask clarifying questions to ensure $he gets to the correct answer or solution. The environment $he seems to prefer to work in is mostly structured and routine-based, however with some flexibility of choice";
                
                $sub_score_2 = "Leaders on this level tend to lead self as well as moving into an environment where they may be required to manage other technical and/or operational people.`";
                //3
                
                $score_3 = "It seems that $u_name should find it comfortable working in environments that offer some strategic involvement, more specifically the execution of strategic plans. Thinking things through and effectively using and distributing resources effectively is a main component of this level which $he should be able to perform effectively. $u_name probably know how the operational day-to-day activities link to the long term strategy of the organisation.";
                
                $sub_score_3 = "Leaders on this level are usually leaders of others, at times leader of other first-line managers and/or supervisors.";
                
                // 4
                
                $score_4 = "The strategy contextualising environment requires someone to develop strategies to keep the company aligned to what is required to be viable in the future. $u_name seems to enjoy working across different business units, preferring a less structured working environment. Routine and day-to-day operational activities will probably be less motivating as a more challenging environment where decisions are more complex will probably be more motivating to $him. Innovation and thinking outside the box is probably more stimulating to $u_name and making decisions where the answer is not always that obvious and/or clear.";
                
                $sub_score_4 = "Leaders on this level usually lead other senior managers within an organisation.";
                
                $score_5 = "Conceptualising strategies for future industry viability is a key component for individuals working on this level. It seems that $u_name has the capability to deal with the complexity of this environment, thus working with information that is vague and/or mostly unavailable. $He probably finds it stimulating to work in environments that offer little if any structure at all. Working and thinking about the macro economy and making decisions that can impact the whole organisation will probably stimulate $him.";
                
                $sub_score_5 = "Leaders on this level usually manage numerous business units and at times probably different organisations. They can think across different systems and/or units, being good CEO’s of large organisations.";
                
                
                $pdf->Image( $rootPath."images/mira_report/mira_first.jpg", -1, $pdf->GetY() - 5, 211, 258);
                $pdf->SetY(255);
                $pdf->SetX(80);
                $pdf->CheckPageBreak(250);
                
                $pdf->SetFont('helvetica', 'B', 15);
                $pdf->SetFillColor(79,129,189);
                $pdf->Cell(0, 12, ${'heading_'.$score2}, 0, 0, 'C', 1);
                $pdf->SetTextColor(0, 0, 0);
                
                $pdf->Ln(30);
                
                $pdf->Image( $rootPath."images/mira_report/MIRA_Image_2.png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);
                
                $pdf->Ln(110);
                $pdf->SetFont('helvetica', '', 12.5);
                $pdf->MultiCell(160, 8, ${'score_'.$score2});
                
                $pdf->Ln(10);
                
                $pdf->MultiCell(160, 8, ${'sub_score_'.$score2});
            }
            elseif ($value==3) {
                function getStatus3($code)
                {
                    if($code >=1 AND $code <=3)
                    {
                        return "Low";
                    }
                    elseif($code >=4 AND $code <=6)
                    {
                        return "Effective";
                    }
                    else
                    {
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
                $pdf->MultiCell(160, 8, iconv('UTF-8', 'windows-1252','LAP, The Learning Agility Profile, or LAP, is a learning potential assessment that measures an individual’s potential to learn new information in a variety of formats and settings. The candidate will be trained to perform various basic tasks, then tested on how well the candidate can solve basic problems based on what they learned during this test.'));
                $pdf->Ln(13);
                $pdf->Image( $rootPath."images/rpt_chk/check_2_".$score3.".png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);
                $pdf->Ln(20);
                
                
                $data = array(
                              array(
                                    '1' => "Reasoning",
                                    '4' => "The ability to interpret information",
                                    '5' => "and drawing accurate conclusions",
                                    '2'=> $Secscore3['corr_A'],
                                    '3' => getStatus3($Secscore3['corr_A'])
                                    ),
                              
                              array(
                                    '1' => "Memory",
                                    '4' => "The ability to accurately recall information.",
                                    '5' => "",
                                    '2'=> $Secscore3['corr_B'],
                                    '3' => getStatus3($Secscore3['corr_B'])
                                    
                                    ),
                              
                              array('1' => "Spatial Orientation The",
                                    "4" => "ability to manipulate and visualise shapes",
                                    "5" => "and patterns.",
                                    '2'=> $Secscore3['corr_C'],
                                    '3' => getStatus3($Secscore3['corr_C'])
                                    ),
                              
                              array('1' => "Numeracy",
                                    "4" => "The ability to accurately perform basic",
                                    "5" => "numerical calculations.",
                                    '2'=> $Secscore3['corr_D'],
                                    '3' => getStatus3($Secscore3['corr_D'])
                                    )
                              );
                
                
                $pdf->SetFillColor(217,217,217);
                $pdf->SetTextColor(0);
                $pdf->SetDrawColor(0,0,0);
                $pdf->SetLineWidth(.3);
                
                // Title row
                $pdf->SetFont('', 'B');
                $pdf->Cell(120, 8, "LEARNING POTENTIAL", 1, 0, 'L', true);
                $pdf->SetFont('', '');
                $pdf->Cell(20, 8, "Score", 1, 0, 'C', true);
                $pdf->Cell(20, 8, "Results", 1, 0, 'C', true);
                $pdf->Ln();
                
                // Data rows
                $m=0;
                foreach($data as $row) {
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
                    $pdf->Cell(20, 8, $data[$m][2], '', '' , "C");
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
                $pdf->SetFillColor(192,0,0);
                $pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252',"1 – 3 Low"), 1, 0, 'C', true);
                $pdf->SetFillColor(247,150,70);
                $pdf->Cell(54, 8, iconv('UTF-8', 'windows-1252',"4 – 6 Effective"), 1, 0, 'C', true);
                $pdf->SetFillColor(0,176,80);
                $pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252',"7 – 9 Enhanced"), 1, 0, 'C', true);
                $pdf->Ln();
                
                $pdf->Ln(10);
                
            }
            elseif ($value==4) {
                //  $pdf->CheckPageBreak(250);
                
            }
            elseif ($value==5) {
                // $pdf->CheckPageBreak(250);
            }
            elseif ($value==6) {
                // $pdf->CheckPageBreak(250);
            }
            elseif ($value==7) {
                $pdf->CheckPageBreak(250);
                
                $pdf->SetFont('helvetica', 'B', 18);
                $pdf->SetDrawColor(79, 129, 189);
                $pdf->SetFillColor(79, 129, 189);
                $pdf->Cell(160, 12, 'Verbal Skills Test', 1, 0, 'C', 1);
                $pdf->Ln(20);
                $pdf->SetFont('helvetica', '', 12.5);
                $pdf->MultiCell(160, 8, iconv('UTF-8', 'windows-1252','The Verbal Skills Test, or VST, is a skills assessment that measures an individual’s ability to understand and interpret written information. The individual was required to read and interpret various texts and answer questions that was related to the text.'));
                $pdf->Ln(20);
                $pdf->setFont('helvetica', 'B', 12);
                $pdf->Cell(160,5,'RESULT');
                $pdf->Ln(20);
                $pdf->Image( $rootPath."images/rpt_chk/check_2_".$score7.".png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);
                $pdf->Ln(30);
                
                
                $pdf->SetFont('', 'B');
                $pdf->SetFillColor(192,0,0);
                $pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252',"1 – 3 Low"), 1, 0, 'C', true);
                $pdf->SetFillColor(247,150,70);
                $pdf->Cell(54, 8, iconv('UTF-8', 'windows-1252',"4 – 6 Effective"), 1, 0, 'C', true);
                $pdf->SetFillColor(0,176,80);
                $pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252',"7 – 9 Enhanced"), 1, 0, 'C', true);
                $pdf->Ln();
                
                $y=$pdf->GetY();
                
                $pdf->SetFont('helvetica', '', 10);
                $pdf->SetFillColor(192,0,0);
                $pdf->MultiCell(53, 9.6, iconv('UTF-8', 'windows-1252','The candidate might find it very challenging interpreting and working with verbal information and instructions. The candidate might not always understand and think logically when working with written information.') , 1, 'L', true);
                
                $pdf->SetXY($pdf->GetX()+53,$y);
                
                $pdf->SetFillColor(247,150,70);
                $pdf->MultiCell(54, 11.2, iconv('UTF-8', 'windows-1252','The candidate should find it fairly easy interpreting and working with verbal information. The candidate should understand and think logically when working with written information.'), 1, 'L', true);
                $pdf->SetXY($pdf->GetX()+107,$y);
                
                $pdf->SetFillColor(0,176,80);
                $pdf->MultiCell(53, 8.4, iconv('UTF-8', 'windows-1252',"The candidate should find it very easy interpreting and working with verbal information and instructions. The candidate should find it exceptionally easy to understand and think logically when working with written information."), 1, 'L', true);
                
                
                $pdf->Ln(10);
                
                
            }
            elseif ($value==8) {
                $pdf->CheckPageBreak(250);
                $pdf->SetFont('helvetica', 'B', 18);
                $pdf->SetDrawColor(79, 129, 189);
                $pdf->SetFillColor(79, 129, 189);
                $pdf->Cell(160, 12, 'Numerical Skills Test', 1, 0, 'C', 1);
                $pdf->Ln(20);
                $pdf->SetFont('helvetica', '', 12.5);
                $pdf->MultiCell(160, 8, iconv('UTF-8', 'windows-1252','The Numerical Skills Test, or NST, is a skills assessment that measures an individual’s ability to understand and interpret numerical information. The individual was required to interpret tables and graphs and answer questions that was related to these graphs and texts. The individual was also required to answer a range of numerical/maths related questions without the use of a calculator.'));
                $pdf->Ln(20);
                $pdf->setFont('helvetica', 'B', 12);
                $pdf->Cell(160,5,'RESULT');
                $pdf->Ln(20);
                $pdf->Image( $rootPath."images/rpt_chk/check_2_".$score8.".png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);
                $pdf->Ln(30);
                
                
                $pdf->SetFont('', 'B');
                $pdf->SetFillColor(192,0,0);
                $pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252',"1 – 3 Low"), 1, 0, 'C', true);
                $pdf->SetFillColor(247,150,70);
                $pdf->Cell(54, 8, iconv('UTF-8', 'windows-1252',"4 – 6 Effective"), 1, 0, 'C', true);
                $pdf->SetFillColor(0,176,80);
                $pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252',"7 – 9 Enhanced"), 1, 0, 'C', true);
                $pdf->Ln();
                
                $y=$pdf->GetY();
                
                $pdf->SetFont('helvetica', '', 10);
                $pdf->SetFillColor(192,0,0);
                $pdf->MultiCell(53, 8, iconv('UTF-8', 'windows-1252','The candidate might find it very challenging interpreting and working with numerical data. The candidate might struggle to do basic calculations, read and interpret basic numerical information contained in graphs and tables.') , 1, 'J', true);
                
                $pdf->SetXY($pdf->GetX()+53,$y);
                
                $pdf->SetFillColor(247,150,70);
                $pdf->MultiCell(54, 8, iconv('UTF-8', 'windows-1252','The candidate should not find it too challenging interpreting and working with numerical data. The candidate should not find it too difficult doing basic calculations, read and interpret basic numerical information contained in graphs and tables.'), 1, 'J', true);
                $pdf->SetXY($pdf->GetX()+107,$y);
                
                $pdf->SetFillColor(0,176,80);
                $pdf->MultiCell(53, 8, iconv('UTF-8', 'windows-1252',"The candidate should find interpreting and working with numerical data very easy. The candidate should not experience any challenges doing basic calculations, read and interpret basic numerical information contained in graphs and tables."), 1, 'J', true);
                
                
                $pdf->Ln(10);
            }
            elseif ($value==9) {
                $pdf->CheckPageBreak(250);
                $pdf->SetFont('helvetica', 'B', 18);
                $pdf->SetDrawColor(79, 129, 189);
                $pdf->SetFillColor(79, 129, 189);
                $pdf->Cell(160, 12, 'Drivers  Skills Test', 1, 0, 'C', 1);
                $pdf->Ln(20);
                $pdf->SetFont('helvetica', '', 12.5);
                $pdf->MultiCell(160, 8, iconv('UTF-8', 'windows-1252','The Drivers Skills Test, or DST, is a skills assessment that measures an individual’s drivers aptitude with specific reference to how well they can interpret maps, remember road signs, and their knowledge of the rules of the road.'));
                $pdf->Ln(20);
                $pdf->setFont('helvetica', 'B', 12);
                $pdf->Cell(160,5,'RESULT');
                $pdf->Ln(20);
                $pdf->Image( $rootPath."images/rpt_chk/check_2_".$score9.".png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);
                $pdf->Ln(30);
                
                $pdf->SetDrawColor(0,0,0);
                $pdf->SetFillColor(255,255,255);
                $pdf->setFont('helvetica', '', 11);
                $pdf->Cell(135,5,iconv('UTF-8', 'windows-1252',"Reading and Understanding Maps"));
                $pdf->Cell(20,5,iconv('UTF-8', 'windows-1252',$Secscore9['corr_A']),1,"","C");
                $pdf->ln();
                $pdf->Cell(135,5,iconv('UTF-8', 'windows-1252',"Memory – Remembering Road Signs"));
                $pdf->Cell(20,5,iconv('UTF-8', 'windows-1252',$Secscore9['corr_B']),1,"","C");
                $pdf->ln();
                $pdf->Cell(135,5,iconv('UTF-8', 'windows-1252',"Knowledge of the Rules of the Road"));
                $pdf->Cell(20,5,iconv('UTF-8', 'windows-1252',$Secscore9['corr_C']),1,"","C");
                $pdf->ln();
                $pdf->Ln(20);
                $pdf->SetFont('', 'B');
                $pdf->SetFillColor(192,0,0);
                $pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252',"1 – 3 Low"), 1, 0, 'C', true);
                $pdf->SetFillColor(247,150,70);
                $pdf->Cell(54, 8, iconv('UTF-8', 'windows-1252',"4 – 6 Effective"), 1, 0, 'C', true);
                $pdf->SetFillColor(0,176,80);
                $pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252',"7 – 9 Enhanced"), 1, 0, 'C', true);
                $pdf->Ln();
                
                $y=$pdf->GetY();
                
                $pdf->SetFont('helvetica', '', 10);
                $pdf->SetFillColor(192,0,0);
                $pdf->MultiCell(53, 11.2, iconv('UTF-8', 'windows-1252','The candidate scored low on the driver’s test and might experience difficulties remembering road signs, reading maps and applying the rules of the road appropriately.') , 1, 'L', true);
                
                $pdf->SetXY($pdf->GetX()+53,$y);
                
                $pdf->SetFillColor(247,150,70);
                $pdf->MultiCell(54, 9.6, iconv('UTF-8', 'windows-1252','The candidate scored within the effective functioning range on the driver’s test and should not experience too many difficulties remembering road signs, reading maps and applying the rules of the road appropriately.'), 1, 'L', true);
                $pdf->SetXY($pdf->GetX()+107,$y);
                
                $pdf->SetFillColor(0,176,80);
                $pdf->MultiCell(53, 11.2, iconv('UTF-8', 'windows-1252','The candidate scored very high on the driver’s test and should find it easy remembering road signs, reading maps and applying the rules of the road appropriately.'), 1, 'L', true);
                
                
                $pdf->Ln(10);
            }
            elseif ($value==10) {
                $pdf->CheckPageBreak(250);
                $pdf->SetFont('helvetica', 'B', 18);
                $pdf->SetDrawColor(79, 129, 189);
                $pdf->SetFillColor(79, 129, 189);
                $pdf->Cell(160, 12, 'Accuracy Skills Test', 1, 0, 'C', 1);
                $pdf->Ln(20);
                $pdf->SetFont('helvetica', '', 12.5);
                $pdf->MultiCell(160, 8, iconv('UTF-8', 'windows-1252','The Accuracy Skills Test, or AST, is a skills assessment that measures an individual’s ability to spot mistakes and errors, and check for accuracy in text and numbers.'));
                $pdf->Ln(20);
                $pdf->setFont('helvetica', 'B', 12);
                $pdf->Cell(160,5,'RESULT');
                $pdf->Ln(20);
                $pdf->Image( $rootPath."images/rpt_chk/check_2_".$score10.".png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);
                $pdf->Ln(30);
                
                
                $pdf->SetFont('', 'B');
                $pdf->SetFillColor(192,0,0);
                $pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252',"1 – 3 Low"), 1, 0, 'C', true);
                $pdf->SetFillColor(247,150,70);
                $pdf->Cell(54, 8, iconv('UTF-8', 'windows-1252',"4 – 6 Effective"), 1, 0, 'C', true);
                $pdf->SetFillColor(0,176,80);
                $pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252',"7 – 9 Enhanced"), 1, 0, 'C', true);
                $pdf->Ln();
                
                $y=$pdf->GetY();
                
                $pdf->SetFont('helvetica', '', 10);
                $pdf->SetFillColor(192,0,0);
                $pdf->MultiCell(53, 9.6, iconv('UTF-8', 'windows-1252','The participant might find it difficult to spot errors in sets of data. He/she is likely to make more mistakes than others when having to retype information.') , 1, 'L', true);
                
                $pdf->SetXY($pdf->GetX()+53,$y);
                
                $pdf->SetFillColor(247,150,70);
                $pdf->MultiCell(54, 9.6, iconv('UTF-8', 'windows-1252','The participant should not find it too difficult to spot errors in sets of data. He/she is likely to make fewer mistakes than others when having to retype information.'), 1, 'L', true);
                $pdf->SetXY($pdf->GetX()+107,$y);
                
                $pdf->SetFillColor(0,176,80);
                $pdf->MultiCell(53, 8, iconv('UTF-8', 'windows-1252',"The participant should not find it difficult at all to spot errors in sets of data. He/she will probably make no or very few mistakes when having to retype information."), 1, 'L', true);
                
                
                $pdf->Ln(10);
            }
            elseif ($value==11) {
                $pdf->CheckPageBreak(250);
                
                $pdf->SetFont('helvetica', 'B', 18);
                $pdf->SetDrawColor(79, 129, 189);
                $pdf->SetFillColor(79, 129, 189);
                $pdf->Cell(160, 12, 'Mechanical Skills Test', 1, 0, 'C', 1);
                $pdf->Ln(20);
                $pdf->SetFont('helvetica', '', 12.5);
                $pdf->MultiCell(160, 8, iconv('UTF-8', 'windows-1252','The AH Mechanical Reasoning measures the understanding of the basic physics principles and mechanics, as well as the ability to visualise the movement of objects and the cause-effect relationships between mechanical components.'));
                $pdf->Ln(20);
                $pdf->setFont('helvetica', 'B', 12);
                $pdf->Cell(160,5,'RESULTS INTERPRETATION');
                $pdf->Ln(20);
                $pdf->Image( $rootPath."images/mst/scroe_".$score11.".png", $pdf->GetX() - 2 , $pdf->GetY() - 5, 165);
                $pdf->Ln(50);
                
                
                $pdf->SetFont('', 'B');
                $pdf->SetFillColor(255,102,102);
                $pdf->Cell(53, 18, iconv('UTF-8', 'windows-1252',"1 – 3 Low"), 1, 0, 'C', true);
                
                $pdf->SetFont('helvetica', '', 10);
                $pdf->SetFillColor(255,255 ,255);
                $pdf->MultiCell(110, 6, iconv('UTF-8', 'windows-1252','The participant might find it difficult to understand and visualize the movement of objects and cause-effect relationships between mechanical components.') , 1, 'J', true);
                
                $pdf->SetFillColor(255,128,0);
                $pdf->Cell(53, 18, iconv('UTF-8', 'windows-1252',"4 – 6 Effective"), 1, 0, 'C', true);
                $pdf->SetFillColor(0,128,64);
                
                $pdf->SetFillColor(255,255 ,255);
                $pdf->MultiCell(110, 6, iconv('UTF-8', 'windows-1252','The participant might should understand and visualize the movement of objects and cause-effect relationships between mechanical components.'), 1, 'L', true);
                
                
                $pdf->SetFillColor(0,128,64);
                $pdf->Cell(53, 18, iconv('UTF-8', 'windows-1252',"7 – 9 Enhanced"), 1, 0, 'C', true);
                $pdf->SetFillColor(255,255 ,255);
                $pdf->MultiCell(110, 6, iconv('UTF-8', 'windows-1252','The participant should find it very easy to visualize the movement of objects and cause-effect relationships between mechanical components.'), 1, 'L', true);
                
                
                $pdf->Ln(10);
            }
            elseif ($value==12) {
                function getStatus12($code)
                {
                    if($code <= 10)
                    {
                        return 10;
                    }
                    elseif($code >=11 AND $code <=15)
                    {
                        return 15;
                    }
                    elseif($code >=16 AND $code <=20)
                    {
                        return 20;
                    }
                    elseif($code >=21 AND $code <=25)
                    {
                        return 25;
                    }
                    elseif($code >=26 AND $code <=30)
                    {
                        return 30;
                    }
                    elseif($code >=31 AND $code <=35)
                    {
                        return 35;
                    }
                    elseif($code >=36 AND $code <=40)
                    {
                        return 40;
                    }
                    elseif($code >=41 AND $code <=45)
                    {
                        return 45;
                    }
                    elseif($code >=46 AND $code <=50)
                    {
                        return 50;
                    }
                    elseif($code >=61 AND $code <=65)
                    {
                        return 65;
                    }
                    elseif($code >=66 AND $code <=70)
                    {
                        return 70;
                    }
                    elseif($code >=71 AND $code <=75)
                    {
                        return 75;
                    }
                    elseif($code >=76 AND $code <=80)
                    {
                        return 80;
                    }
                    elseif($code >=81 AND $code <=85)
                    {
                        return 85;
                    }
                    elseif($code >=86 AND $code <=90)
                    {
                        return 90;
                    }
                    elseif($code >=91 AND $code <=95)
                    {
                        return 95;
                    }
                    else
                    {
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
                $pdf->MultiCell(160, 8, iconv('UTF-8', 'windows-1252','The Electrical Skills Test, or MST, is a skills assessment that measures knowledge of Basic Electricity and electrical principles.'));
                $pdf->Ln(10);
                $pdf->setFont('helvetica', 'B', 12);
                $pdf->Cell(160,5,'RESULT');
                $pdf->Ln(20);
                $pdf->Image( $rootPath."images/EST_METER/".getStatus12($Secscore12['corr_C'])."%.png", $pdf->GetX() + 40, $pdf->GetY() - 5, 80);
                $pdf->Ln(60);
                
                $pdf->SetDrawColor(0,0,0);
                $pdf->setFont('helvetica', '', 11);
                $pdf->SetFillColor(219,229,241);
                $pdf->Cell(135,5,iconv('UTF-8', 'windows-1252',"Total Correct"),1,"","L");
                $pdf->Cell(20,5,iconv('UTF-8', 'windows-1252',$Secscore12['corr_A']),1,"","C");
                $pdf->ln();
                $pdf->SetFillColor(255,255,255);
                $pdf->Cell(135,5,iconv('UTF-8', 'windows-1252',"Total Wrong"),1);
                $pdf->Cell(20,5,iconv('UTF-8', 'windows-1252',$Secscore12['corr_B']),1,"","C");
                $pdf->ln();
                
                $pdf->setFont('helvetica', 'B', 12);
                $pdf->Cell(135,5,iconv('UTF-8', 'windows-1252',"Total Percentage"),1);
                $pdf->Cell(20,5,iconv('UTF-8', 'windows-1252',$Secscore12['corr_C']."%"),1,"","C");
                $pdf->ln();
                $pdf->Ln(20);
                $pdf->SetFont('', 'B');
                $pdf->SetFillColor(192,0,0);
                $pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252',"1% – 39% Low"), 1, 0, 'C', true);
                $pdf->SetFillColor(247,150,70);
                $pdf->Cell(54, 8, iconv('UTF-8', 'windows-1252',"40% - 59% Effective"), 1, 0, 'C', true);
                $pdf->SetFillColor(0,176,80);
                $pdf->Cell(53, 8, iconv('UTF-8', 'windows-1252',"60% - 100% Enhanced"), 1, 0, 'C', true);
                $pdf->Ln();
                
                $y=$pdf->GetY();
                
                $pdf->SetFont('helvetica', '', 10);
                $pdf->SetFillColor(192,0,0);
                $pdf->MultiCell(53, 8, iconv('UTF-8', 'windows-1252','The candidate’s basic knowledge and understanding of electricity and electrical priniciples is very low. Further development is strongly recommended.') , 1, 'L', true);
                
                $pdf->SetXY($pdf->GetX()+53,$y);
                
                $pdf->SetFillColor(247,150,70);
                $pdf->MultiCell(54, 9.6, iconv('UTF-8', 'windows-1252','The candidate’s basic knowledge and understanding of electricity and electrical principles is effective. Some further practical training is advised.'), 1, 'L', true);
                $pdf->SetXY($pdf->GetX()+107,$y);
                
                $pdf->SetFillColor(0,176,80);
                $pdf->MultiCell(53, 12, iconv('UTF-8', 'windows-1252','The candidate’s basic knowledge and understanding of electricity and electrical principles is extremely effective.'), 1, 'L', true);
                
                $pdf->Ln(10);
            }
        }
    }
    // desclaimer
    
    $pdf->CheckPageBreak(250);
    $pdf->SetFont('helvetica', 'B', 15);
    $pdf->SetFillColor(79,129,189);
    $pdf->Cell(0, 12, 'Disclosure', 0, 0, 'C', 1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Ln(10);
    $pdf->Ln(10);
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
    
    // end report combine
    
    
    
    $filePath = $u_name . "_" . $_POST['last_name'] . "_" . $og_u_name . "_" . date('Y_m_d') . ".pdf";
    $pdf->Output($filePath, 'D');
    
    
    ?>