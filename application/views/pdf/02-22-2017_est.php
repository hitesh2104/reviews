<?php

$fullName = $du_name[0]->full_name;
$u_title = $rTitle;
$u_name = $du_name[0]->first_name;
$gender = $du_name[0]->gender;
$og_u_name = "EST";


$testCompletedDate = $created_date;
$d = explode('-', substr($testCompletedDate, 0, 10));
$testCompletedDate = ($d[2] . '/' . $d[1] . '/' . $d[0]); 
//$testCompletedDate = date('Y-m-d');
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

}


$pdf = new PDF("P", "mm", "A4");
$pdf->AddPage();
$imgPath = "IMAGE##80##10##" . $rootPath."images/rpt_chk/";
$pdf->AliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
$pdf->Image( $rootPath."images/EST.jpg", -1, 0, 211, 298);
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
$pdf->Cell(160, 12, 'Electrical  Skills Test', 1, 0, 'C', 1);
$pdf->Ln(20);
$pdf->SetFont('helvetica', '', 12.5);
$pdf->MultiCell(160, 8, iconv('UTF-8', 'windows-1252','The Electrical Skills Test, or MST, is a skills assessment that measures knowledge of Basic Electricity and electrical principles.'));
$pdf->Ln(10);
$pdf->setFont('helvetica', 'B', 12);
$pdf->Cell(160,5,'RESULT');
$pdf->Ln(20);
$pdf->Image( $rootPath."images/EST_METER/".getStatus($Secscore['corr_C'])."%.png", $pdf->GetX() + 40, $pdf->GetY() - 5, 80);
$pdf->Ln(60);

$pdf->SetDrawColor(0,0,0);
$pdf->setFont('helvetica', '', 11);
$pdf->SetFillColor(219,229,241);
$pdf->Cell(135,5,iconv('UTF-8', 'windows-1252',"Total Correct"),1,"","L");
$pdf->Cell(20,5,iconv('UTF-8', 'windows-1252',$Secscore['corr_A']),1,"","C");
$pdf->ln();
$pdf->SetFillColor(255,255,255);
$pdf->Cell(135,5,iconv('UTF-8', 'windows-1252',"Total Wrong"),1);
$pdf->Cell(20,5,iconv('UTF-8', 'windows-1252',$Secscore['corr_B']),1,"","C");
$pdf->ln();

$pdf->setFont('helvetica', 'B', 12);
$pdf->Cell(135,5,iconv('UTF-8', 'windows-1252',"Total Percentage"),1);
$pdf->Cell(20,5,iconv('UTF-8', 'windows-1252',$Secscore['corr_C']."%"),1,"","C");
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
$pdf->Cell(23, 10, iconv('UTF-8', 'windows-1252','Disclaimer: '));
$pdf->SetFont('helvetica', '', 11.5);
$pdf->Cell(48, 10, iconv('UTF-8', 'windows-1252','  Since the report contains '));
$pdf->SetFont('helvetica', 'B', 11.5);
$pdf->Cell(26, 10, iconv('UTF-8', 'windows-1252',' confidential  '));
$pdf->SetFont('helvetica', '', 11.5);
$pdf->Cell(100, 10, iconv('UTF-8', 'windows-1252','information it needs to be dealt with'));
$pdf->Ln(10);
$pdf->Cell(68, 10, iconv('UTF-8', 'windows-1252','accordingly. Consequently this report'));
$pdf->SetFont('helvetica', 'B', 11.5);
$pdf->Cell(82, 10, iconv('UTF-8', 'windows-1252',' may not be handed over to the participant. '));
$pdf->SetFont('helvetica', '', 11.5);
$pdf->Cell(100, 10, iconv('UTF-8', 'windows-1252',' It may '));
$pdf->Ln(10);
$pdf->MultiCell(165, 8, iconv('UTF-8', 'windows-1252',"also not be used as evidence in a disciplinary hearing.  Should this report or the content of the report be handled or communicated incorrectly by any party within the company, AssessmentHouse cannot be held liable for any claims resulting from such action."));

$filePath = $u_name . "_" . $du_name[0]->last_name . "_" . $og_u_name . "_" .$d[2] . '_' . $d[1] . '_' . $d[0] . ".pdf";
$pdf->Output($filePath, 'D');

function getStatus($code)
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


?>