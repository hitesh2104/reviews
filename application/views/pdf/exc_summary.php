<?php
//print_r($_POST);
$fullName = !empty($post['first_name'])?$post['first_name'] ." ". $post['last_name']:$_POST['full_name'];

$u_title = "Executive Summary";
$u_name = $_POST['first_name'];
$gender = $_POST['gender'];
$og_u_name = "Exc_Summary_Report";



$testCompletedDate = date('Y-m-d');
$rootPath = '';
$vowels = array(" ");
$u_name = str_replace($vowels, "-", $u_name);

require("fpdf/mc_table.php");

class PDF extends PDF_MC_Table{
    
    function Header(){
        global $testCompletedDate;
        global  $rootPath;
        //if ($this->PageNo() !== 1) {
            $this->Image($rootPath."images/perTestAssessmentHouse.png", 87, 10, 40);
            $this->SetTextColor(128, 128, 128);
            $this->SetFont('helvetica', '', 8);
            @$this->Cell(175, 7, $testCompletedDate, 0, 0, 'R');
            $this->Ln(15);
			
			$this->Image( $rootPath."images/Blue_line.png", 10, 12, 5, 270);
		    $this->SetX(25);
        //}
    }

    function footer(){
       // if ($this->PageNo() !== 1) {
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
       // }
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
   /* $pdf->AliasNbPages();
    $pdf->Ln(20);
    $pdf->SetMargins(25, 10, 25);
    $pdf->Image( $rootPath."images/IAR.jpg", -1, 0, 211, 298);
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
	*/
    // report executive summary

    
    include('exc_summary_comman_code.php');

// end report combine



$filePath = $u_name . "_" . $_POST['last_name'] . "_" . $og_u_name . "_" . date('Y_m_d') . ".pdf";
$pdf->Output($filePath, 'D');


?>