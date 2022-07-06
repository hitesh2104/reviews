<?php

$fullName = $du_name[0]->full_name;
$u_title = $rTitle;
$u_name = $du_name[0]->first_name;
$gender = $du_name[0]->gender;
$og_u_name = "LAP";
$score = $_GET['score'];

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
$pdf->Image( $rootPath."images/LAP.jpg", -1, 0, 211, 298);
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
$pdf->Cell(160, 12, 'Learning Agility Profile', 1, 0, 'C', 1);
$pdf->Ln(20);
$pdf->SetFont('helvetica', '', 12.5);
$pdf->MultiCell(160, 8, iconv('UTF-8', 'windows-1252','LAP, The Learning Agility Profile, or LAP, is a learning potential assessment that measures an individual’s potential to learn new information in a variety of formats and settings. The candidate will be trained to perform various basic tasks, then tested on how well the candidate can solve basic problems based on what they learned during this test.'));
$pdf->Ln(13);
$pdf->Image( $rootPath."images/rpt_chk/check_2_".$score.".png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);
$pdf->Ln(20);
    
$candidateId =  $du_name[0]->id;

$result_query = $this->db->query("SELECT LAP_S_A,LAP_S_B,LAP_S_C,LAP_S_D FROM test_given_answer WHERE candidate_id=".$candidateId);
$result = $result_query->result();
$section_A_result = $result[0]->LAP_S_A;
$section_B_result = $result[0]->LAP_S_B;
$section_C_result = $result[0]->LAP_S_C;
$section_D_result = $result[0]->LAP_S_D;
    
$section_A_result = $section_A_result/0.2;
$section_B_result = $section_B_result/0.3;
$section_C_result = $section_C_result/0.2;
$section_D_result = $section_D_result/0.3;

$data = array(
    array(
        '1' => "Reasoning",
        '4' => "The ability to interpret information",
        '5' => "and drawing accurate conclusions",
        '2'=> $section_A_result,
         '3' => getStatus($section_A_result)
        ),

    array(
    	'1' => "Memory",
    	'4' => "The ability to accurately recall information.",
    	'5' => "",
    	'2'=> $section_B_result,
    	'3' => getStatus($section_B_result)

        ),

    array('1' => "Spatial Orientation",
    	"4" => "The ability to manipulate and visualise shapes",
    	"5" => "and patterns.",
    	'2'=> $section_C_result,
    	'3' => getStatus($section_C_result)
        ),

    array('1' => "Numeracy",
    	"4" => "The ability to accurately perform basic",
    	"5" => "numerical calculations.",
    	'2'=> $section_D_result,
    	'3' => getStatus($section_D_result)
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


$filePath = $u_name . "_" . $du_name[0]->last_name . "_" . $og_u_name . "_" .$d[2] . '_' . $d[1] . '_' . $d[0] . ".pdf";

$pdf->Output($filePath, 'D');


function getStatus($code)
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

 ?>