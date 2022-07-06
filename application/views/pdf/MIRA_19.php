
<?php

$fullName = $du_name[0]->full_name;

$u_title = $rTitle;
$u_name = $du_name[0]->first_name;
$gender = $du_name[0]->gender;
$og_u_name = "MIRa";
error_reporting(0);
ini_set('display_errors', 1);
// Section C
$cresult2 = json_decode(base64_decode($_GET['result2']), true);
$testCompletedDate = $created_date;
$d = explode('-', substr($testCompletedDate, 0, 10));
$testCompletedDate = ($d[2] . '/' . $d[1] . '/' . $d[0]);

$rootPath = '';
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

$sst_score =  $cresult2['sst_score'];
$sst_score = $score;

// heading
$heading_1 = "SST LEVEL 1 - TANGIBLE BRILLIANCE";
$heading_2 = "SST LEVEL 2 - EXCELLENCE CLARIFICATION";
$heading_3 = "SST LEVEL 3 - STRATEGY EXECUTION";
$heading_4 = "SST LEVEL 4 - STRATEGY CONTEXTUALISING";
$heading_5 = "SST LEVEL 5 - STRATEGY CONCEPTUALISING";
$potential_transitioning = "POTENTIAL TRANSITIONING";
// data

//_11

$score_5 = "$u_name's speed of learning falls within the low range. $He will probably learn much slower than most people, and might finding solving complex problems difficult most of the times. With a low learning speed, $he might find it quite difficult to adapt to new situations.";

$score_rule_5 = "$He can solve problems when the information is always available and easily accessible.";

//_22

$score_4 = "$u_name's speed of learning falls within the below average range. $He will probably learn a bit slower than most people, and might finding solving complex problems  difficult at times. With a below average learning speed, $he might find it somewhat difficult to adapt to new situations.";

$score_rule_4 = "$He can solve problems where information is readily available through research and investigation.";

//3

$score_3 = "$u_name's speed of learning falls within the average range. $He will probably learn as fast as most people, but might finding solving complex problems somewhat difficult at times. With an average learning speed, $he should not find it too difficult to adapt to new situations.";

$score_rule_3 = "$He can solve somewhat complex problems where the information is not readily available.";

// 4

$score_2 = "$u_name's speed of learning falls within the above average range. $He will probably learn faster than most people and grasp complex issues without real difficulty. With an above average learning speed, $he should easily adapt to new situations.";

$score_rule_2 = "$He can solve relatively complex problems where the information is somewhat vague or not available.";

// 5

$score_1 = "$u_name's speed of learning is exceptionally high. $He will probably learn much faster than most people and grasp complex issues without any difficulty. With an exceptionally high learning speed, $he should easily adapt to new situations.";

$score_rule_1 = "$He can solve complex problems where the information is vague or not available.";
require "fpdf/mc_table.php";

class PDF extends PDF_MC_Table {

	function Header() {
		global $testCompletedDate;
		global $rootPath;
		if ($this->PageNo() !== 1 || $this->PageNo() !== 3) {
			$this->Image($rootPath . "images/new_mira_complex/black-head.png", -1, 0, 140, 30);
		}
	}

	function footer() {
		global $rootPath;
		if ($this->PageNo() !== 1 && $this->PageNo() != 7) {
			$this->SetX(160);
			$this->SetY(-15);
			$this->Image($rootPath . "images/perTestAssessmentHouse.png", 5, null, 40);
			$this->SetXY(180, -50);
			$this->Image($rootPath . "images/new_mira_complex/page_num.png", null, null, 30);
			$this->SetFont('ARIAL', '', 12);
			$this->SetXY(195, -20);
			$this->SetTextColor(255, 255, 255);
			$this->Cell(50, 10, "MIRA");
			$this->Ln();
			$this->SetX(198);
			$this->Cell(50, 5, $this->PageNo());
		}
	}
}

$pdf = new PDF("P", "mm", "A4");
$pdf->AddPage();
// page1
$imgPath = "IMAGE##80##10##" . $rootPath . "images/rpt_chk/";
$pdf->AliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
// Background
    
$pdf->Image($rootPath . "images/new_mira_complex/mira_frontpage.png", -1, 0, 211, 298);
$pdf->SetY(-1);

$pdf->SetY(240);
$pdf->SetX(100);
$pdf->SetFont('ARIAL', '', 50);
$pdf->SetTextColor(255, 255, 255);
//$pdf->Cell(105, 10, "M I R A", 0, 1, 'R');
$pdf->SetFont('ARIAL', '', 25);
$pdf->Ln(10);
$pdf->SetX(101);
//$pdf->Cell(105, 10, "MATRICES OF INTELLECTUAL", 0, 1, 'R');
//$pdf->SetX(101);
//$pdf->Cell(105, 10, "REASONING ASSESSMENT", 0, 1, 'R');

$pdf->SetX(80);
$pdf->SetFont('helvetica', '', 18);
$pdf->Cell(140, 10, $fullName, 0, 0, 'C');

$pdf->Ln(7);
$pdf->Cell(140, 10,'(' . $testCompletedDate . ')', 0, 0, 'R');

$pdf->SetTextColor(0, 0, 0);
$pdf->CheckPageBreak(250);

// second page
$pdf->SetFont('helvetica', '', 15);
$pdf->SetY(5);
$pdf->SetX(2);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(2, 5, "INTRODUCTION TO THE MATRICES OF");
$pdf->Ln(10);
$pdf->SetX(2);
$pdf->Cell(2, 5, "INTELLECTUAL REASONING ASSESSMENT");

$pdf->SetDrawColor(64, 149, 209);
$pdf->SetLineWidth(0.7);
$pdf->Line(2, 25, 115, 25);

$pdf->Ln(18);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->SetX(9);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "The Matrices of Intellectual Reasoning assessment (MIRa) is a non-verbal mental ability test that requires test-takers to find solutions to a range of problems with different levels of complexity. It also measures one’s ability to formulate new concepts, extract meaning out of ambiguity and to think clearly about complex situations and events."));

$pdf->SetXY($x + 100, $y);

$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "Based on Elliott Jaques theory of the Stratified Systems Theory (SST) that defines work in different organisational levels, mainly on the basis of decision-making complexity. MIRa measures the individual’s capability to find solutions through different levels of complex problems."));
$pdf->Ln(10);
$pdf->Image($rootPath . "images/new_mira_complex/problem_solving_style.png", 5, null, 200, 110);
$pdf->Ln(2);
$pdf->SetX(9);
$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "It identifies five levels of work, differentiated on the basis of complexity and time-span of decision-making. Each level contributes to different levels of work within organisations, with no level more important than another."));

$pdf->SetXY($x + 100, $y);

    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "Results from this report can be used to indicate the level of work / level of complexity that a person can effectively function at. It indicates how the test-taker will interact with people on a level lower, as well as one level higher. It also reports on the time-frame to see the results or impact of a decision based on the test-taker’s level of work. Lastly, some examples of jobs on this level is provided. "));

// Administrator, Call Centre Agent, Artisan, Cashier, Credit Clerk, Controller, Foreman, Claims Officer, Pharmacist Assistant, Store Supervisor, Driver, Receptionist

    $pdf->CheckPageBreak(250);
    // Background
    $pdf->Image($rootPath . "images/new_mira_complex/levels_of_work.png", -1, 0, 211, 298);
    // Heading
    $pdf->SetY(-1);
    $pdf->CheckPageBreak(250);
    
if ($sst_score == 1) {
// 4rd page
	$pdf->SetFont('helvetica', '', 15);
	$pdf->SetY(5);
	$pdf->SetX(2);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->Ln(8);
	$pdf->SetX(2);
	$pdf->Cell(2, 5, iconv('UTF-8', 'windows-1252', $heading_1));
	$pdf->SetDrawColor(64, 149, 209);
	$pdf->Line(2, 20, 100, 20);
	$pdf->Ln(15);
    $pdf->Image($rootPath . "images/new_mira_complex/SST_1_TANGABLE_BRILIANCE.png", 20, null, 200, 100);

	$pdf->SetFont('helvetica', '', 12);
	$pdf->SetTextColor(0, 0, 0);

	$pdf->Ln(5);

	$x = $pdf->GetX();
	$y = $pdf->GetY();
    
    $pdf->SetXY($x -16, $y);
	$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "$u_name seems to be more comfortable working in an environment with tangible outputs where quality is $his main priority. $He may prefer to follow a clear set of guidelines to perform optimally and is more inclined to function in an operational and/or technical environment. A structured environment will probably suite $him better where $he can plan and organise $his daily activities. $He might also be more inclined to follow routines, as this will make $his work activities more predictable and measurable."));
    
    $pdf->Ln(5);
    
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x -16, $y);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "The key focus of people working in the tangible brilliance environment is about using individual skills efficiently, controlling and minimising cost and producing work that is of high quality. Prioritising work is very important and making sure that they have the necessary equipment to perform their tasks. They have to follow instructions carefully, working towards specific and measurable objectives. Previous learning and experience is important as decisions and problem solving is based on evidence and proven outcomes."));

	$pdf->SetXY($x + 84, $y-60);

	$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "People on this level has a very important contribution to make to those working in a level 2 (Excellence clarification) environment by providing information about potential wasting of resources, direct client needs that is not currently addressed or advising on new/improved ways to add value to current products and/or services."));
    $pdf->Ln(5);
    $pdf->SetXY($x + 84, $y-15);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "Leaders on this level are usually leaders of self, having to manage their own work schedules and plan their own day-to-day activities."));

	$pdf->SetFillColor(229, 232, 234);
	$pdf->Rect(110, $y + 10, 88, 80, 'F');

	$pdf->SetXY(115, $y + 15);
	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->MultiCell(80, 5, "Time frame (seeing results, impact of decisions):");
    $pdf->Ln(2);
	$pdf->SetX(115);
	$pdf->SetFont('helvetica', '', 12);
	$pdf->MultiCell(70, 5, "Immediate to 3 months");
	$pdf->Ln(10);
	$pdf->SetX(115);
	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Typical jobs on this level:'));
	$pdf->Ln(2);
	$pdf->SetFont('helvetica', '', 12);
	$pdf->SetX(115);
	$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Administrator, Call Centre Agent, Artisan, Cashier, Credit Clerk, Controller, Foreman, Claims Officer, Pharmacist Assistant, Store Supervisor, Driver, Receptionist'));

	$pdf->CheckPageBreak(250);
                                 
     $pdf->SetFont('helvetica', '', 15);
     $pdf->SetY(5);
     $pdf->SetX(2);
     $pdf->SetTextColor(255, 255, 255);
     $pdf->Cell(2, 5, $potential_transitioning);
     $pdf->Ln(10);
     $pdf->SetX(2);
     $pdf->Cell(2, 5, $heading_2);
     $pdf->SetDrawColor(64, 149, 209);
     $pdf->Line(2, 20, 100, 20);
     $pdf->Ln(10);
    $pdf->Image($rootPath . "images/new_mira_complex/SST_2_EXCELLENCE_CLARIFICATION.png", 5, 20, 200, 100);

    $pdf->SetFont('helvetica', '', 12);
    $pdf->SetTextColor(0, 0, 0);

    $pdf->Ln(95);

    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x -16, $y);
    
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252',  "$u_name should find working in an environment where $he has to solve problems where answers is not very clear by using $his knowledge and/or experience. $u_name tends to ask clarifying questions to ensure $he gets to the correct answer or solution. The environment $he seems to prefer to work in is mostly structured and routine-based, however with some flexibility of choice."));
   $pdf->Ln(5);

    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x -16, $y);
    
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'People working in the excellence clarification  environment focus mainly on planning and controlling. Usually a technical and/or professional environment that requires people to use specialist knowledge and experience to allocate resources and ensuring the optimal use of materials within their environment. Controlling cost and efficiencies, people working in this environment supports and guide people working in the tangible brilliance (SST 1) environment to deliver a quality product and service to their customers.'));

    $pdf->SetXY($x + 84, $y - 50);

    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'In this environment, people play a critical role in supporting those working in a level 3 (strategy execution) environment by offering feedback on how current workflow and delivery can be improved to add value in other product/service streams in the business. They can also contribute to cost saving initiatives that will enable the business to deliver more efficiently in the medium term, which may influence the strategic initiatives planned for this department.'));
    
    $pdf->Ln(5);
    $pdf->SetXY($x + 84, $y + 10);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'Leaders on this level tend to lead self as well as moving into an environment where they may be required to manage other technical and/or operational people.'));
    $pdf->SetFillColor(229, 232, 234);
    $pdf->Rect(110, $y + 35, 90, 70, 'F');
    $pdf->SetXY(115, $y + 40);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->MultiCell(80, 5, "Time frame (seeing results, impact of decisions):");
    $pdf->Ln(2);
    $pdf->SetX(115);
    $pdf->SetFont('helvetica', '', 12);
    $pdf->MultiCell(70, 5, "3 months to 1 year");
    $pdf->Ln(10);
    $pdf->SetX(115);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->MultiCell(70, 5, iconv('UTF-8', 'windows-1252', 'Typical jobs on this level:'));
    $pdf->Ln(2);
    $pdf->SetFont('helvetica', '', 12);
    $pdf->SetX(115);
    $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Accountant, Analyst, HR Business Partner, Brand Manager, Financial Manager, Pharmacist, Planner, Supply Chain Technician, Project Manager'));
                                 
} elseif ($sst_score== 2) {
	$pdf->SetFont('helvetica', '', 15);
	$pdf->SetY(5);
	$pdf->SetX(2);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->Ln(8);
	$pdf->SetX(2);
	$pdf->Cell(2, 5, iconv('UTF-8', 'windows-1252', $heading_2));
	$pdf->SetDrawColor(64, 149, 209);
	$pdf->Line(2, 20, 100, 20);
	$pdf->Ln(10);
	$pdf->Image($rootPath . "images/new_mira_complex/SST_2_EXCELLENCE_CLARIFICATION.png", 5, 20, 200, 100);

	$pdf->SetFont('helvetica', '', 12);
	$pdf->SetTextColor(0, 0, 0);

	$pdf->Ln(95);

    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x -16, $y);
	$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "Results indicates that $u_name might find working in an environment where $he has to solve problems where answers is not very clear by using $his knowledge and/or experience. $u_name tends to ask clarifying questions to ensure $he gets to the correct answer or solution. The environment $he seems to prefer to work in is mostly structured and routine-based, however with some flexibility of choice."));
    $pdf->Ln(5);
    
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x -16, $y);
	$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'People working in the excellence clarification  environment focus mainly on planning and controlling. Usually a technical and/or professional environment that requires people to use specialist knowledge and experience to allocate resources and ensuring the optimal use of materials within their environment. Controlling cost and efficiencies, people working in this environment supports and guide people working in the tangible brilliance (SST 1) environment to deliver a quality product and service to their customers.'));

	$pdf->SetXY($x + 84, $y - 50);

    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'In this environment, people play a critical role in supporting those working in a level 3 (strategy execution) environment by offering feedback on how current workflow and delivery can be improved to add value in other product/service streams in the business. They can also contribute to cost saving initiatives that will enable the business to deliver more efficiently in the medium term, which may influence the strategic initiatives planned for this department.'));
    
    $pdf->Ln(5);
    $pdf->SetXY($x + 84, $y + 10);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'Leaders on this level tend to lead self as well as moving into an environment where they may be required to manage other technical and/or operational people.'));

	$pdf->SetFillColor(229, 232, 234);
	$pdf->Rect(110, $y + 35, 90, 70, 'F');

	$pdf->SetXY(115, $y + 40);
	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->MultiCell(80, 5, "Time frame (seeing results, impact of decisions):");
    $pdf->Ln(2);
	$pdf->SetX(115);
	$pdf->SetFont('helvetica', '', 12);
	$pdf->MultiCell(70, 5, "3 months to 1 year");
	$pdf->Ln(10);
	$pdf->SetX(115);
	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Typical jobs on this level:'));
	$pdf->Ln(2);
	$pdf->SetFont('helvetica', '', 12);
	$pdf->SetX(115);
	$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Accountant, Analyst, HR Business Partner, Brand Manager, Financial Manager, Pharmacist, Planner, Supply Chain Technician, Project Manager'));
                                
    } elseif ($sst_score == 3) {
                                 
    $pdf->SetFont('helvetica', '', 15);
    $pdf->SetY(5);
    $pdf->SetX(2);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Ln(8);
    $pdf->SetX(2);
    $pdf->Cell(2, 5, iconv('UTF-8', 'windows-1252', $heading_2));
    $pdf->SetDrawColor(64, 149, 209);
    $pdf->Line(2, 20, 100, 20);
    $pdf->Ln(10);
    $pdf->Image($rootPath . "images/new_mira_complex/SST_2_EXCELLENCE_CLARIFICATION.png", 5, 20, 200, 100);

    $pdf->SetFont('helvetica', '', 12);
    $pdf->SetTextColor(0, 0, 0);

    $pdf->Ln(95);

    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x -16, $y);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "Results indicates that $u_name might find working in an environment where $he has to solve problems where answers is not very clear by using $his knowledge and/or experience. $u_name tends to ask clarifying questions to ensure $he gets to the correct answer or solution. The environment $he seems to prefer to work in is mostly structured and routine-based, however with some flexibility of choice."));
    $pdf->Ln(5);
   
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x -16, $y);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'People working in the excellence clarification  environment focus mainly on planning and controlling. Usually a technical and/or professional environment that requires people to use specialist knowledge and experience to allocate resources and ensuring the optimal use of materials within their environment. Controlling cost and efficiencies, people working in this environment supports and guide people working in the tangible brilliance (SST 1) environment to deliver a quality product and service to their customers.'));

    $pdf->SetXY($x + 84, $y - 55);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'In this environment, people play a critical role in supporting those working in a level 3 (strategy execution) environment by offering feedback on how current workflow and delivery can be improved to add value in other product/service streams in the business. They can also contribute to cost saving initiatives that will enable the business to deliver more efficiently in the medium term, which may influence the strategic initiatives planned for this department.'));
                                 
    $pdf->Ln(5);
    $pdf->SetXY($x + 84, $y + 5);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'Leaders on this level tend to lead self as well as moving into an environment where they may be required to manage other technical and/or operational people.'));
      
      $pdf->SetFillColor(229, 232, 234);
      $pdf->Rect(110, $y + 30, 90, 65, 'F');
      
      $pdf->SetXY(115, $y + 35);
      $pdf->SetFont('helvetica', 'B', 12);
      $pdf->MultiCell(80, 5, "Time frame (seeing results, impact of decisions):");
      $pdf->Ln(2);
      $pdf->SetX(115);
      $pdf->SetFont('helvetica', '', 12);
      $pdf->MultiCell(70, 5, "3 months to 1 year");
      $pdf->Ln(10);
      $pdf->SetX(115);
      $pdf->SetFont('helvetica', 'B', 12);
      $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Typical jobs on this level:'));
      $pdf->Ln(2);
      $pdf->SetFont('helvetica', '', 12);
      $pdf->SetX(115);
      $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Accountant, Analyst, HR Business Partner, Brand Manager, Financial Manager, Pharmacist, Planner, Supply Chain Technician, Project Manager'));

	$pdf->CheckPageBreak(250);
                                 
     $pdf->SetFont('helvetica', '', 15);
     $pdf->SetY(5);
     $pdf->SetX(2);
     $pdf->SetTextColor(255, 255, 255);
     $pdf->Cell(2, 5, $potential_transitioning);
     $pdf->Ln(10);
     $pdf->SetX(2);
     $pdf->Cell(2, 5, $heading_3);
     $pdf->SetDrawColor(64, 149, 209);
     $pdf->Line(2, 20, 100, 20);
     $pdf->Ln(10);
    $pdf->Image($rootPath . "images/new_mira_complex/SST_3_STRATEGY_EXECUTION.png", 5, 20, 200, 100);

    $pdf->SetFont('helvetica', '', 12);
    $pdf->SetTextColor(0, 0, 0);

    $pdf->Ln(95);

    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x -16, $y);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "Results indicates that $u_name should find it comfortable working in environments that offer some strategic involvement, more specifically the execution of strategic plans. Thinking things through and effectively using and distributing resources effectively is a main component of this level, which $he should be able to perform effectively. $u_name probably know how the operational day-to-day activities link to the long-term strategy of the organisation."));
    $pdf->Ln(5);

    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x -16, $y);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'People working in the strategy execution level focus mainly on ensuring the strategy of the business is executed in the most effective and efficient manner. Resources that is managed in this environment includes people and equipment, whilst controlling the budgets relating to these resources. They support those working in the tangible brilliance (SST 1) and excellence clarification (SST 2) through training, leading and advising on best practices to ensure maximum efficiencies are achieved through resource management.'));

     $pdf->SetXY($x + 84, $y - 60);

     $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'In the strategy execution level, they support those working in a level 4 (strategy contextualisation) environment by giving feedback on the impact of the strategic initiatives on their clients and the market they operate in. They also provide forecasts and trends that relates to the business and how the business could potentially improve their product/service offering in the future to address client needs better.'));
                                 
     $pdf->Ln(5);
     $pdf->SetXY($x + 84, $y-5);
     $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'Leaders on this level are usually leaders of others, at times leader of other first-line managers and/or supervisors.'));
      
      $pdf->SetFillColor(229, 232, 234);
      $pdf->Rect(110, $y + 15, 90, 70, 'F');
      
      $pdf->SetXY(115, $y  + 20);
      $pdf->SetFont('helvetica', 'B', 12);
      $pdf->MultiCell(80, 5, "Time frame (seeing results, impact of decisions):");
      $pdf->Ln(2);
      $pdf->SetX(115);
      $pdf->SetFont('helvetica', '', 12);
      $pdf->MultiCell(80, 5, "1 to 2 years");
      $pdf->Ln(10);
      $pdf->SetX(115);
      $pdf->SetFont('helvetica', 'B', 12);
      $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Typical jobs on this level:'));
      $pdf->Ln(2);
      $pdf->SetFont('helvetica', '', 12);
      $pdf->SetX(115);
      $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Industrial Engineer, Learning and Development Executive, General Finance Manager, Sales Manager, Lead Project Manager, Regional Managers, Legal Councillor.'));
                                 
     }  elseif ($sst_score == 4) {
	$pdf->SetFont('helvetica', '', 15);
	$pdf->SetY(5);
	$pdf->SetX(2);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->Ln(8);
	$pdf->SetX(2);
	$pdf->Cell(2, 5, iconv('UTF-8', 'windows-1252', iconv('UTF-8', 'windows-1252', $heading_3)));
	$pdf->SetDrawColor(64, 149, 209);
	$pdf->Line(2, 20, 100, 20);
	$pdf->Ln(10);
	$pdf->Image($rootPath . "images/new_mira_complex/SST_3_STRATEGY_EXECUTION.png", 5, 20, 200, 100);

	$pdf->SetFont('helvetica', '', 12);
	$pdf->SetTextColor(0, 0, 0);

	$pdf->Ln(95);

         $x = $pdf->GetX();
         $y = $pdf->GetY();
         $pdf->SetXY($x -16, $y);
	$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "Results indicates that $u_name should find it comfortable working in environments that offer some strategic involvement, more specifically the execution of strategic plans. Thinking things through and effectively using and distributing resources effectively is a main component of this level, which $he should be able to perform effectively. $u_name probably know how the operational day-to-day activities link to the long-term strategy of the organisation."));
    $pdf->Ln(5);
         
         $x = $pdf->GetX();
         $y = $pdf->GetY();
         $pdf->SetXY($x -16, $y);
	$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'People working in the strategy execution level focus mainly on ensuring the strategy of the business is executed in the most effective and efficient manner. Resources that is managed in this environment includes people and equipment, whilst controlling the budgets relating to these resources. They support those working in the tangible brilliance (SST 1) and excellence clarification (SST 2) through training, leading and advising on best practices to ensure maximum efficiencies are achieved through resource management.'));

	$pdf->SetXY($x + 84, $y - 60);
     $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'In the strategy execution level, they support those working in a level 4 (strategy contextualisation) environment by giving feedback on the impact of the strategic initiatives on their clients and the market they operate in. They also provide forecasts and trends that relates to the business and how the business could potentially improve their product/service offering in the future to address client needs better.'));
    $pdf->Ln(5);
    $pdf->SetXY($x + 84, $y -5);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'Leaders on this level are usually leaders of others, at times leader of other first-line managers and/or supervisors.'));

	$pdf->SetFillColor(229, 232, 234);
	$pdf->Rect(110, $y + 15, 90, 70, 'F');

	$pdf->SetXY(115, $y + 20);
	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->MultiCell(80, 5, "Time frame (seeing results, impact of decisions):");
    $pdf->Ln(2);
	$pdf->SetX(115);
	$pdf->SetFont('helvetica', '', 12);
	$pdf->MultiCell(80, 5, "1 to 2 years");
	$pdf->Ln(10);
	$pdf->SetX(115);
	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Typical jobs on this level:'));
	$pdf->Ln(2);
	$pdf->SetFont('helvetica', '', 12);
	$pdf->SetX(115);
	$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Industrial Engineer, Learning and Development Executive, General Finance Manager, Sales Manager, Lead Project Manager, Regional Managers, Legal Councillor.'));
} elseif ($sst_score == 5) {
                                 
    $pdf->SetFont('helvetica', '', 15);
    $pdf->SetY(5);
    $pdf->SetX(2);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Ln(8);
    $pdf->SetX(2);
    $pdf->Cell(2, 5, iconv('UTF-8', 'windows-1252', iconv('UTF-8', 'windows-1252', $heading_3)));
    $pdf->SetDrawColor(64, 149, 209);
    $pdf->Line(2, 20, 100, 20);
    $pdf->Ln(10);
    $pdf->Image($rootPath . "images/new_mira_complex/SST_3_STRATEGY_EXECUTION.png", 5, 20, 200, 100);

    $pdf->SetFont('helvetica', '', 12);
    $pdf->SetTextColor(0, 0, 0);

    $pdf->Ln(95);

    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x -16, $y);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "Results indicates that $u_name should find it comfortable working in environments that offer some strategic involvement, more specifically the execution of strategic plans. Thinking things through and effectively using and distributing resources effectively is a main component of this level, which $he should be able to perform effectively. $u_name probably know how the operational day-to-day activities link to the long-term strategy of the organisation."));
    $pdf->Ln(5);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x -16, $y);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'People working in the strategy execution level focus mainly on ensuring the strategy of the business is executed in the most effective and efficient manner. Resources that is managed in this environment includes people and equipment, whilst controlling the budgets relating to these resources. They support those working in the tangible brilliance (SST 1) and excellence clarification (SST 2) through training, leading and advising on best practices to ensure maximum efficiencies are achieved through resource management.'));

    $pdf->SetXY($x + 84, $y - 60);

    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'In the strategy execution level, they support those working in a level 4 (strategy contextualisation) environment by giving feedback on the impact of the strategic initiatives on their clients and the market they operate in. They also provide forecasts and trends that relates to the business and how the business could potentially improve their product/service offering in the future to address client needs better.'));
    
      $pdf->Ln(5);
      $pdf->SetXY($x + 84, $y -5);
      $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'Leaders on this level are usually leaders of others, at times leader of other first-line managers and/or supervisors.'));
    
      $pdf->SetFillColor(229, 232, 234);
      $pdf->Rect(110, $y + 15, 90, 70, 'F');
      
      $pdf->SetXY(115, $y + 20);
      $pdf->SetFont('helvetica', 'B', 12);
      $pdf->MultiCell(80, 5, "Time frame (seeing results, impact of decisions):");
      $pdf->Ln(2);
      $pdf->SetX(115);
      $pdf->SetFont('helvetica', '', 12);
      $pdf->MultiCell(80, 5, "1 to 2 years");
      $pdf->Ln(10);
      $pdf->SetX(115);
      $pdf->SetFont('helvetica', 'B', 12);
      $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Typical jobs on this level:'));
      $pdf->Ln(2);
      $pdf->SetFont('helvetica', '', 12);
      $pdf->SetX(115);
      $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Industrial Engineer, Learning and Development Executive, General Finance Manager, Sales Manager, Lead Project Manager, Regional Managers, Legal Councillor.'));

	$pdf->CheckPageBreak(250);
                                 
     $pdf->SetFont('helvetica', '', 15);
     $pdf->SetY(5);
     $pdf->SetX(2);
     $pdf->SetTextColor(255, 255, 255);
     $pdf->Cell(2, 5, $potential_transitioning);
     $pdf->Ln(10);
     $pdf->SetX(2);
     $pdf->Cell(2, 5, $heading_4);
     $pdf->SetDrawColor(64, 149, 209);
     $pdf->Line(2, 20, 100, 20);
     $pdf->Ln(10);
	$pdf->Image($rootPath . "images/new_mira_complex/SST_4_STRATEGY_CONTEXTUALISING.png", 5, 30, 200, 70);

	$pdf->SetFont('helvetica', '', 12);
	$pdf->SetTextColor(0, 0, 0);

	$pdf->Ln(80);

    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x -16, $y);
	$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "The strategy contextualising environment requires someone to develop strategies to keep the company aligned to what is required to be viable in the future. $u_name should enjoy working across different business units, preferring a less structured working environment. Routine and day-to-day operational activities will probably be less motivating as a more challenging environment where decisions are more complex will probably be more motivating to $him. Innovation and thinking outside the box should be more stimulating and making decisions where the answer is not always that obvious and/or clear."));
    $pdf->Ln(5);

    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x - 16, $y);
	$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'People working in the strategy contextualising (SST 4) environment contributes through value creation in the market the business operates in. They focus on trends in the market to develop strategies that will impact the business in the medium to long term and aligns the business operations in order for it to be ready for the changes in the future. They build on internal capabilities to ensure the business has a competitive advantage in the future. People in this environment supports those in the strategy execution (SST 3) environment in setting clear priorities and guidelines in place ensuring that the strategy is executed in a way that will maximise future return on investments.'));

	$pdf->SetXY($x + 84, $y - 75);

	$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'In the strategy contextualising level, people support those working in level 5 (strategy conceptualisation) by providing insights and analysis on trends that may impact the profitability of the business in the medium to long term. They provide context on future trends and offer potential solutions that should be considered in conceptualising the strategy for the long-term success of the business.'));
    
    $pdf->Ln(5);
    $pdf->SetXY($x + 84, $y -25);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'Leaders on this level usually lead other senior managers within an organisation.'));

	$pdf->SetFillColor(229, 232, 234);
	$pdf->Rect(110, $y - 10, 90, 80, 'F');

	$pdf->SetXY(115, $y - 5);
	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->MultiCell(80, 5, "Time frame (seeing results, impact of decisions):");
    $pdf->Ln(2);
    $pdf->SetX(115);
	$pdf->SetFont('helvetica', '', 12);
	$pdf->MultiCell(80, 5, "2 to 5 years");
	$pdf->Ln(10);
	$pdf->SetX(115);
	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Typical jobs on this level:'));
	$pdf->Ln(2);
	$pdf->SetFont('helvetica', '', 12);
	$pdf->SetX(115);
	$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Chief Financial Officer, Client Services Director, Financial Director, Chief People Officer, Information Director, Business Development Executive, Managing Director.'))
                                 ;
     } elseif ($sst_score == 6) {
                                 
    $pdf->SetFont('helvetica', '', 15);
    $pdf->SetY(5);
    $pdf->SetX(2);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Ln(10);
    $pdf->SetX(2);
    $pdf->Cell(2, 5, iconv('UTF-8', 'windows-1252', iconv('UTF-8', 'windows-1252', $heading_4)));
    $pdf->SetDrawColor(64, 149, 209);
    $pdf->Line(2, 25, 130, 25);
    $pdf->Ln(10);
    $pdf->Image($rootPath . "images/new_mira_complex/SST_4_STRATEGY_CONTEXTUALISING.png", 5, 30, 200, 70);

    $pdf->SetFont('helvetica', '', 12);
    $pdf->SetTextColor(0, 0, 0);

    $pdf->Ln(80);

    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x - 16, $y);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "The strategy contextualising environment requires someone to develop strategies to keep the company aligned to what is required to be viable in the future. $u_name should enjoy working across different business units, preferring a less structured working environment. Routine and day-to-day operational activities will probably be less motivating as a more challenging environment where decisions are more complex will probably be more motivating to $him. Innovation and thinking outside the box should be more stimulating and making decisions where the answer is not always that obvious and/or clear."));
    $pdf->Ln(5);
         
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x - 16, $y);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'People working in the strategy contextualising (SST 4) environment contributes through value creation in the market the business operates in. They focus on trends in the market to develop strategies that will impact the business in the medium to long term and aligns the business operations in order for it to be ready for the changes in the future. They build on internal capabilities to ensure the business has a competitive advantage in the future. People in this environment supports those in the strategy execution (SST 3) environment in setting clear priorities and guidelines in place ensuring that the strategy is executed in a way that will maximise future return on investments.'));

    $pdf->SetXY($x + 84, $y - 75);

    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'In the strategy contextualising level, people support those working in level 5 (strategy conceptualisation) by providing insights and analysis on trends that may impact the profitability of the business in the medium to long term. They provide context on future trends and offer potential solutions that should be considered in conceptualising the strategy for the long-term success of the business.'));
         
     $pdf->Ln(5);
     $pdf->SetXY($x + 84, $y - 25);
     $pdf->MultiCell(85, 5, iconv('UTF-8', 'windows-1252', 'Leaders on this level usually lead other senior managers within an organisation.'));
        
      $pdf->SetFillColor(229, 232, 234);
      $pdf->Rect(110, $y - 5, 90, 80, 'F');
      
      $pdf->SetXY(115, $y);
      $pdf->SetFont('helvetica', 'B', 12);
      $pdf->MultiCell(70, 5, "Time frame (seeing results, impact of decisions):");
      $pdf->Ln(2);
      $pdf->SetX(115);
      $pdf->SetFont('helvetica', '', 12);
      $pdf->MultiCell(80, 5, "2 to 5 years");
      $pdf->Ln(10);
      $pdf->SetX(115);
      $pdf->SetFont('helvetica', 'B', 12);
      $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Typical jobs on this level:'));
      $pdf->Ln(2);
      $pdf->SetFont('helvetica', '', 12);
      $pdf->SetX(115);
      $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Chief Financial Officer, Client Services Director, Financial Director, Chief People Officer, Information Director, Business Development Executive, Managing Director.'));
                                 
} elseif ($sst_score == 7) {
    $pdf->SetFont('helvetica', '', 15);
    $pdf->SetY(5);
    $pdf->SetX(2);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Ln(10);
    $pdf->SetX(2);
    $pdf->Cell(2, 5, iconv('UTF-8', 'windows-1252', iconv('UTF-8', 'windows-1252', $heading_4)));
    $pdf->SetDrawColor(64, 149, 209);
    $pdf->Line(2, 25, 130, 25);
    $pdf->Ln(10);
    $pdf->Image($rootPath . "images/new_mira_complex/SST_4_STRATEGY_CONTEXTUALISING.png", 5, 30, 200, 70);

    $pdf->SetFont('helvetica', '', 12);
    $pdf->SetTextColor(0, 0, 0);

    $pdf->Ln(80);

    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x - 16, $y);
    $pdf->MultiCell(85, 5, iconv('UTF-8', 'windows-1252', "The strategy contextualising environment requires someone to develop strategies to keep the company aligned to what is required to be viable in the future. $u_name should enjoy working across different business units, preferring a less structured working environment. Routine and day-to-day operational activities will probably be less motivating as a more challenging environment where decisions are more complex will probably be more motivating to $him. Innovation and thinking outside the box should be more stimulating and making decisions where the answer is not always that obvious and/or clear."));
    $pdf->Ln(5);
    
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x - 16, $y);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'People working in the strategy contextualising (SST 4) environment contributes through value creation in the market the business operates in. They focus on trends in the market to develop strategies that will impact the business in the medium to long term and aligns the business operations in order for it to be ready for the changes in the future. They build on internal capabilities to ensure the business has a competitive advantage in the future. People in this environment supports those in the strategy execution (SST 3) environment in setting clear priorities and guidelines in place ensuring that the strategy is executed in a way that will maximise future return on investments.'));

    $pdf->SetXY($x + 84, $y - 80);

    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'In the strategy contextualising level, people support those working in level 5 (strategy conceptualisation) by providing insights and analysis on trends that may impact the profitability of the business in the medium to long term. They provide context on future trends and offer potential solutions that should be considered in conceptualising the strategy for the long-term success of the business.'));
     $pdf->Ln(5);
     $pdf->SetXY($x + 84, $y - 30);
      $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'Leaders on this level usually lead other senior managers within an organisation.'));
    
      $pdf->SetFillColor(229, 232, 234);
      $pdf->Rect(110, $y - 15, 90, 80, 'F');
      
      $pdf->SetXY(115, $y - 10);
      $pdf->SetFont('helvetica', 'B', 12);
      $pdf->MultiCell(80, 5, "Time frame (seeing results, impact of decisions):");
      $pdf->Ln(2);
      $pdf->SetX(115);
      $pdf->SetFont('helvetica', '', 12);
      $pdf->MultiCell(80, 5, "2 to 5 years");
      $pdf->Ln(10);
      $pdf->SetX(115);
      $pdf->SetFont('helvetica', 'B', 12);
      $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Typical jobs on this level:'));
      $pdf->Ln(2);
      $pdf->SetFont('helvetica', '', 12);
      $pdf->SetX(115);
      $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Chief Financial Officer, Client Services Director, Financial Director, Chief People Officer, Information Director, Business Development Executive, Managing Director.'));

	$pdf->CheckPageBreak(250);

     $pdf->SetFont('helvetica', '', 15);
     $pdf->SetY(5);
     $pdf->SetX(2);
     $pdf->SetTextColor(255, 255, 255);
     $pdf->Cell(2, 5, $potential_transitioning);
     $pdf->Ln(10);
     $pdf->SetX(2);
     $pdf->Cell(2, 5, $heading_5);
     $pdf->SetDrawColor(64, 149, 209);
     $pdf->Line(2, 20, 100, 20);
     $pdf->Ln(10);
    $pdf->Image($rootPath . "images/new_mira_complex/SST_5_STRATEGY_CONCEPTUALISING.png", 5, 30, 200, 100);

    $pdf->SetFont('helvetica', '', 12);
    $pdf->SetTextColor(0, 0, 0);

    $pdf->Ln(103);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x - 16, $y);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "Conceptualising strategies for future industry viability is a key component for individuals working on this level. It seems that $u_name has the capability to deal with the complexity of this environment, thus working with information that is vague and/or mostly unavailable. $He probably finds it stimulating to work in environments that offer little if any structure at all. Working and thinking about the macro economy and making decisions that can impact the whole organisation will probably stimulate $him."));
    
    $pdf->Ln(5);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetXY($x - 16, $y);
    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'People working in the strategy conceptualisation (SST 5) environment focus mainly on enhancing the value proposition of the business. They create market opportunities through choosing and creating new product/service portfolios with the main focus on future competitiveness. Although managing cost always remains important, their main focus is on creating value-added growth and value for the shareholders.'));

    $pdf->SetXY($x + 84, $y - 65);

    $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'They work very close with people in the strategy contextualisation (SST 4) environment to gain better understanding of current market conditions and future trends that may impact the business.'));
    
     $pdf->Ln(5);
     $pdf->SetXY($x + 84, $y -35);
        $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'Leaders on this level usually manage numerous business units and at times probably different organisations. They can think across different systems and/or units, being good CEO’s of large organisations.'));
    
      $pdf->SetFillColor(229, 232, 234);
      $pdf->Rect(110, $y - 5, 90, 70, 'F');
      
      $pdf->SetXY(115, $y);
      $pdf->SetFont('helvetica', 'B', 12);
      $pdf->MultiCell(80, 5, "Time frame (seeing results, impact of decisions):");
      $pdf->Ln(2);
      $pdf->SetX(115);
      $pdf->SetFont('helvetica', '', 12);
      $pdf->MultiCell(80, 5, "5 to 10 years");
      $pdf->Ln(10);
      $pdf->SetX(115);
      $pdf->SetFont('helvetica', 'B', 12);
      $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Typical jobs on this level:'));
      $pdf->Ln(2);
      $pdf->SetFont('helvetica', '', 12);
      $pdf->SetX(115);
      $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Chief Strategy Officer, Chief Executive Officer, Group Financial Officer'));

 } elseif ($sst_score == 8) {
	$pdf->SetFont('helvetica', '', 15);
	$pdf->SetY(5);
	$pdf->SetX(2);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->Ln(8);
	$pdf->SetX(2);
	$pdf->Cell(2, 5, iconv('UTF-8', 'windows-1252', iconv('UTF-8', 'windows-1252', $heading_5)));
	$pdf->SetDrawColor(64, 149, 209);
	$pdf->Line(2, 20, 100, 20);
	$pdf->Ln(10);
	$pdf->Image($rootPath . "images/new_mira_complex/SST_5_STRATEGY_CONCEPTUALISING.png", 5, 30, 200, 100);

	$pdf->SetFont('helvetica', '', 12);
	$pdf->SetTextColor(0, 0, 0);

	$pdf->Ln(103);

     $x = $pdf->GetX();
     $y = $pdf->GetY();
     $pdf->SetXY($x - 16, $y);
	$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "Conceptualising strategies for future industry viability is a key component for individuals working on this level. It seems that $u_name has the capability to deal with the complexity of this environment, thus working with information that is vague and/or mostly unavailable. $He probably finds it stimulating to work in environments that offer little if any structure at all. Working and thinking about the macro economy and making decisions that can impact the whole organisation will probably stimulate $him."));

	$pdf->Ln(5);
     $x = $pdf->GetX();
     $y = $pdf->GetY();
     $pdf->SetXY($x - 16, $y);
	$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'People working in the strategy conceptualisation (SST 5) environment focus mainly on enhancing the value proposition of the business. They create market opportunities through choosing and creating new product/service portfolios with the main focus on future competitiveness. Although managing cost always remains important, their main focus is on creating value-added growth and value for the shareholders.'));

	$pdf->SetXY($x + 84, $y - 65);
	$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'They work very close with people in the strategy contextualisation (SST 4) environment to gain better understanding of current market conditions and future trends that may impact the business.'));

   $pdf->Ln(5);
   $pdf->SetXY($x + 84, $y -35);
   $pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', 'Leaders on this level usually manage numerous business units and at times probably different organisations. They can think across different systems and/or units, being good CEO’s of large organisations.'));

	$pdf->SetFillColor(229, 232, 234);
	$pdf->Rect(110, $y, 90, 70, 'F');

	$pdf->SetXY(115, $y + 5);
	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->MultiCell(80, 5, "Time frame (seeing results, impact of decisions):");
    $pdf->Ln(2);
	$pdf->SetX(115);
	$pdf->SetFont('helvetica', '', 12);
	$pdf->MultiCell(80, 5, "5 to 10 years");
	$pdf->Ln(10);
	$pdf->SetX(115);
	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Typical jobs on this level:'));
	$pdf->Ln(2);
	$pdf->SetFont('helvetica', '', 12);
	$pdf->SetX(115);
	$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', 'Chief Strategy Officer, Chief Executive Officer, Group Financial Officer'));
}

$pdf->CheckPageBreak(250);
// Fourth Page
 /*
$pdf->SetFont('helvetica', '', 15);
$pdf->SetY(5);
$pdf->SetX(2);
$pdf->SetTextColor(255, 255, 255);
$pdf->Ln(8);
$pdf->SetX(2);
$pdf->Cell(2, 5, "PROBLEM SOLVING STYLE");
$pdf->SetDrawColor(64, 149, 209);
$pdf->Line(2, 25, 100, 25);

$pdf->Ln(30);
$pdf->Image($rootPath . "images/new_mira_complex/PSS_PROBLEM_SOLVING_STYLE.png", null, null, 170, 100);
$pdf->Ln(30);

$y = $pdf->GetY();
$pdf->SetTextColor(0, 0, 0);
$pdf->SetX(10);
$pdf->SetFont('helvetica', '', 15);
$pdf->Cell(2, 5, "Problem solving style");
$pdf->Ln(10
);
$pdf->SetX(10);
$pdf->SetFont('helvetica', '', 12);
$pdf->MultiCell(75, 5, iconv('UTF-8', 'windows-1252', $problemSolvingStyleRule));

$pdf->SetFillColor(229, 232, 234);
$pdf->Rect(110, $y, 90, 80, 'F');

$pdf->SetXY(110, $y + 2);
$pdf->SetFont('helvetica', '', 15);
$pdf->Cell(2, 5, "Key Strengths");
$pdf->Ln(10);
$pdf->SetX(110);
$pdf->SetFont('helvetica', '', 12);
$pdf->MultiCell(70, 5, iconv('UTF-8', 'windows-1252', $lpks . ', ' . $nfks));

$pdf->Ln(10);
$pdf->SetX(110);
$pdf->SetFont('helvetica', '', 15);
$pdf->Cell(2, 5, "Potential Limitations");
$pdf->Ln(10);
$pdf->SetX(110);
$pdf->SetFont('helvetica', '', 12);
$pdf->MultiCell(70, 5, iconv('UTF-8', 'windows-1252', $lplm . ', ' . $nflm));
$pdf->CheckPageBreak(250);
*/
/*
// Fifth Page
$pdf->SetFont('helvetica', '', 15);
$pdf->SetY(5);
$pdf->SetX(2);
$pdf->SetTextColor(255, 255, 255);
$pdf->Ln(8);
$pdf->SetX(2);
$pdf->Cell(2, 5, "Measuring Problem Solving");
$pdf->SetDrawColor(64, 149, 209);
$pdf->Line(2, 25, 100, 25);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Ln(30);

$pdf->SetFont('', 'B');
$pdf->Cell(100, 8, "Speed Of Learning", 0, 0, 'L');
$pdf->SetFont('', '');
$pdf->Cell(50, 8, $speedOfLearning, 1, 0, 'C');
$pdf->Ln(20);

$pdf->SetFont('', 'B');
$pdf->Cell(100, 8, "Problem Solving Style", 0, 0, 'L');
$pdf->SetFont('', '');
$pdf->Cell(50, 8, $problemSolvingStyleRule, 1, 0, 'C');
$pdf->Ln(20);

$pdf->SetFont('', 'B');
$pdf->Cell(100, 8, "Need for Predictability", 0, 0, 'L');
$pdf->SetFont('', '');
$pdf->Cell(50, 8, needForPredictability($cresult2['block_sequence']), 1, 0, 'C');
$pdf->Ln(20);
$pdf->CheckPageBreak(250);
*/
// Six Page
$pdf->SetFont('helvetica', '', 15);
$pdf->SetY(5);
$pdf->SetX(2);
$pdf->SetTextColor(255, 255, 255);
$pdf->Ln(8);
$pdf->SetX(2);
$pdf->Cell(2, 5, "PURPOSE AND DISCLAIMER");
$pdf->SetDrawColor(64, 149, 209);
$pdf->Line(2, 25, 100, 25);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Ln(30);
$pdf->SetX(20);
    
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x - 10 , $y);
$pdf->MultiCell(190, 5, iconv('UTF-8', 'windows-1252', 'The purpose of this report is to indicate the test-taker’s results on various skills, aptitude, potential and behavioural attributes. This report is for the attention of the manager who requested the assessment and remains the property of AssessmentHouse. This report may not be shared with any individual or company who is not trained in psychometric testing or have been authorised through informed consent by the test-taker and supervising psychologist.'));

$pdf->SetX(20);
$pdf->Ln(10);

$pdf->SetDrawColor(64, 149, 209);
$pdf->Line(12, $pdf->GetY(), 186, $pdf->GetY());
$pdf->Ln(10);
$pdf->SetX(20);
    
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x - 10 , $y);
$pdf->MultiCell(190, 5, iconv('UTF-8', 'windows-1252', 'Since the report contains confidential information it needs to be dealt with accordingly. Consequently this report may not be handed over to the participant. It may also not be used as evidence in a disciplinary hearing. Should this report or the content of the report be handled or communicated incorrectly by any party within the company, AssessmentHouse cannot be held liable for any claims resulting from such action.'));

$pdf->SetY(-1);
$pdf->Image($rootPath . "images/new_mira_complex/triangle.png", 60, 130, null, 170);

$filePath = $u_name . "_" . $du_name[0]->last_name . "_" . $og_u_name . "_" . $d[2] . '_' . $d[1] . '_' . $d[0] . ".pdf";

$pdf->Output($filePath, 'D');

?>
