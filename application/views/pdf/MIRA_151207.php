<?php

$fullName = $du_name[0]->full_name;
$u_title = $rTitle;
$u_name = $du_name[0]->first_name;
$gender = $du_name[0]->gender;
$og_u_name = "MIRa complex";

// Section C
$cresult2 = json_decode(base64_decode($_GET['result2']), true);

function speedOfLearning($val) {
	if ($val >= 7 && $val <= 30) {
		return 'Extremely hign';
	} elseif ($val >= 31 && $val <= 40) {
		return 'Hign';
	} elseif ($val >= 41 && $val <= 50) {
		return 'Above average';
	} elseif ($val >= 51 && $val <= 70) {
		return 'Average';
	} elseif ($val >= 71 && $val <= 80) {
		return 'Below average';
	} elseif ($val >= 81 && $val <= 90) {
		return 'Low';
	}
}

function problemSolvingStyle($val) {

	if ($val >= 0 && $val <= 10) {
		return 'Random';
	} elseif ($val >= 11 && $val <= 20) {
		return 'Trial and Error';
	} elseif ($val >= 20 && $val <= 40) {
		return 'Logical/Analytical';
	} elseif ($val >= 40) {
		return 'Reflective';
	}
}

function needForPredictability($sequence) {
	$cbc = explode(',', $sequence);
	$val = array_count_values($cbc)[5];

	if ($val >= 1 && $val <= 5) {
		return 'Low';
	} elseif ($val >= 6 && $val <= 10) {
		return 'Average';
	} elseif ($val >= 11 && $val <= 15) {
		return 'Above average';
	} elseif ($val >= 16) {
		return 'Extremely hign';
	}
}

// End Section C

//$score = ($score>5)?$score:$score;
$testCompletedDate = $created_date;
$d = explode('-', substr($testCompletedDate, 0, 10));
$testCompletedDate = ($d[2] . '/' . $d[1] . '/' . $d[0]);
//$testCompletedDate = date('Y-m-d');
$rootPath = ''; //$_SERVER['DOCUMENT_ROOT'].'/';
$vowels = array(" ");
$u_name = str_replace($vowels, "-", $u_name);

//
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

//

require "fpdf/mc_table.php";

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

}

$pdf = new PDF("P", "mm", "A4");
$pdf->AddPage();
$imgPath = "IMAGE##80##10##" . $rootPath . "images/rpt_chk/";
$pdf->AliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
$pdf->Image($rootPath . "images/MIRA.jpg", -1, 0, 211, 298);
$pdf->SetY(255);
$pdf->SetX(80);
$pdf->SetFont('helvetica', '', 23);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(105, 10, $fullName, 0, 1, 'C');
$pdf->SetX(80);
$pdf->SetFont('helvetica', '', 18);
$pdf->Cell(105, 10, '(' . $testCompletedDate . ')', 0, 0, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->CheckPageBreak(250);

// first page

$pdf->Image($rootPath . "images/mira_report/mira_first.jpg", -1, $pdf->GetY() - 5, 211, 258);
$pdf->SetY(255);
$pdf->SetX(80);
$pdf->CheckPageBreak(250);

//middle page

$pdf->SetFont('helvetica', 'B', 15);
$pdf->SetFillColor(79, 129, 189);
$pdf->Cell(0, 12, ${'heading_' . $score}, 0, 0, 'C', 1);
$pdf->SetTextColor(0, 0, 0);

$pdf->Ln(30);

$pdf->Image($rootPath . "images/mira_report/MIRA_Image_2.png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);

$pdf->Ln(110);
$pdf->SetFont('helvetica', '', 12.5);
$pdf->MultiCell(160, 8, ${'score_' . $score});

$pdf->Ln(10);

$pdf->MultiCell(160, 8, ${'sub_score_' . $score});
if ($score == 1) {
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

} else if ($score == 3) {
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

} else if ($score == 5) {
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

} else if ($score == 7) {
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

// C

if (count($cresult2) > 0) {
	$pdf->CheckPageBreak(250);

	$pdf->SetFont('helvetica', 'B', 18);
	$pdf->SetDrawColor(79, 129, 189);
	$pdf->SetFillColor(79, 129, 189);
	$pdf->Cell(160, 12, 'Measuring Problem Solving', 1, 0, 'C', 1);
	$pdf->Ln(20);
	$pdf->SetFont('helvetica', '', 12.5);

	$pdf->SetFont('', 'B');
	$pdf->Cell(100, 8, "Speed Of Learning", 0, 0, 'L');
	$pdf->SetFont('', '');
	$pdf->Cell(50, 8, speedOfLearning($cresult2['total_moves']), 1, 0, 'C');
	$pdf->Ln(20);

	$pdf->SetFont('', 'B');
	$pdf->Cell(100, 8, "Problem Solving Style", 0, 0, 'L');
	$pdf->SetFont('', '');
	$pdf->Cell(50, 8, problemSolvingStyle($cresult2['average_time']), 1, 0, 'C');
	$pdf->Ln(20);

	$pdf->SetFont('', 'B');
	$pdf->Cell(100, 8, "Need for Predictability", 0, 0, 'L');
	$pdf->SetFont('', '');
	$pdf->Cell(50, 8, needForPredictability($cresult2['block_sequence']), 1, 0, 'C');
	$pdf->Ln(20);

}

// Disclosure

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

$filePath = $u_name . "_" . $du_name[0]->last_name . "_" . str_replace(' ', '_', $og_u_name) . "_" . $d[2] . '_' . $d[1] . '_' . $d[0] . ".pdf";

$pdf->Output($filePath, 'D');

?>