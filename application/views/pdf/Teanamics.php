<?php

//$loggedinUser = trim($_GET['user_id']);

$loggedinUser = trim($_GET['user_id']);

$as_query = $this->db->query("SELECT CONCAT(`test13_secA`,',',`test13_secB`,',',`test13_secC`,',',`test13_secD`,',',`test13_secE`,',',`test13_secF`,',',`test13_secG`,',',`test13_secH`) as answers FROM `test_given_answer` WHERE `candidate_id` = $loggedinUser");

$arr_str = $as_query->result()[0]->answers;

$score = getSumArray($arr_str);

$fullName = $du_name[0]->full_name;
$u_title = $rTitle;
$u_name = $du_name[0]->first_name;
$gender = $du_name[0]->gender;
$og_u_name = "Teanamics";

$his = "his";
$His = "His";
$he = "he";
$He = "He";
$him = "him";

if ($gender == "female") {
	$his = "her";
	$His = "Her";
	$he = "she";
	$He = "She";
	$him = "her";
}

//$score = json_decode($score,true);

$PTR = $score['Primary_Team_Role'][1];
$PSR = $score['Secondary_Team_Role'][1];

$PPD = $score['Potential_Primary_Disruptor'][1];
$PSD = $score['Potential_Secondary_Disruptor'][1];
// $PPD2 = $score['Potential_Primary_Disruptor'][2];
// $PSD2 = $score['Potential_Secondary_Disruptor'][2];

$PPD2 = $score['Potential_Primary_Disruptor'][1];
$PSD2 = $score['Potential_Secondary_Disruptor'][1];

$PTR_C = $score['Primary_Team_Role'][0];
$PSR_C = $score['Secondary_Team_Role'][0];

$PPD_C = $score['Potential_Primary_Disruptor'][0];
$PSD_C = $score['Potential_Secondary_Disruptor'][0];

$testCompletedDate = $created_date;
$d = explode('-', substr($testCompletedDate, 0, 10));
$testCompletedDate = ($d[2] . '/' . $d[1] . '/' . $d[0]);
//$testCompletedDate = date('Y-m-d');
$rootPath = ''; //$_SERVER['DOCUMENT_ROOT'].'/';
$vowels = array(" ");
$u_name = str_replace($vowels, "-", $u_name);

require "fpdf/mc_table.php";
require "fpdf/html2pdf.php";
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
$pdf->Image($rootPath . "images/Teanamics.jpg", -1, 0, 211, 298);
$pdf->SetY(255);
$pdf->SetX(80);
$pdf->SetFont('helvetica', '', 23);
$pdf->SetTextColor(79, 129, 189);
$pdf->Cell(105, 10, $fullName, 0, 1, 'C');
$pdf->SetX(80);
$pdf->SetFont('helvetica', '', 18);
$pdf->Cell(105, 10, '(' . $testCompletedDate . ')', 0, 0, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->CheckPageBreak(250);

$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('helvetica', 'B', 18);
$pdf->SetDrawColor(79, 129, 189);
$pdf->SetFillColor(79, 129, 189);
$pdf->Cell(160, 12, 'Introduction', 1, 0, 'C', 1);
$pdf->Ln(20);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->MultiCell(160, 7, iconv('UTF-8', 'windows-1252', 'For a team to succeed, members need to play the appropriate role at the appropriate time. Most problems that develop in a team occur because team roles are not clearly defined. Supervisors and team leaders are not the only ones with special roles and responsibilities. Employees also must know what is expected of them and what they will be accountable for in their new environment. Understanding their role will enable them to take part actively in meetings, contribute ideas, provide suggestions, and get involved in the work.'));
$pdf->Ln(10);

$pdf->Cell(160, 5, 'Individuals within a team have certain roles and may include:');
$pdf->Ln(7);
$pdf->Cell(160, 5, iconv('UTF-8', 'windows-1252', '•') . '   Defining objectives and goals for the team;');
$pdf->Ln(7);
$pdf->Cell(160, 5, iconv('UTF-8', 'windows-1252', '•') . '   Planning activities and deadlines;');
$pdf->Ln(7);
$pdf->Cell(160, 5, iconv('UTF-8', 'windows-1252', '•') . '   Identifying potential risks;');
$pdf->Ln(7);
$pdf->Cell(160, 6, iconv('UTF-8', 'windows-1252', '•') . '   Motivating the team;');
$pdf->Ln(7);
$pdf->Cell(160, 6, iconv('UTF-8', 'windows-1252', '•') . '   Ensuring everyone communicates effectively');
$pdf->Ln(10);

// $pdf->SetTextColor(79, 129, 189);
// $pdf->SetFont('helvetica', 'I', 12);
// $pdf->Cell(160, 6, iconv('UTF-8', 'windows-1252', '“…by organizing people into a team, managers can easily identify and use '), 0, 0, 'R');
// $pdf->Ln();
// $pdf->Cell(160, 6, iconv('UTF-8', 'windows-1252', 'the specific strengths of each individual member to the best advantage.”'), 0, 0, 'R');
// $pdf->Ln();
// $pdf->Cell(160, 6, iconv('UTF-8', 'windows-1252', '–Debra Housel'), 0, 0, 'R');

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Ln(10);
$pdf->MultiCell(160, 7, iconv('UTF-8', 'windows-1252', "However, within every team there will always be disruptions that that might derail the team from achieving its objectives. Understanding these potential disruptors can help the team manage these disruptions more effectively, but also use these disruptions in a positive way to potentially contribute to innovative thinking, or breaking the ice in difficult or stressful times. Understanding the team’s disruptors is as important as understanding everyone’s contributing role within a team."));
$pdf->Ln(10);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('helvetica', 'B', 20);
$pdf->SetDrawColor(79, 129, 189);
$pdf->SetFillColor(79, 129, 189);
$pdf->MultiCell(160, 12, 'Diversity = Strength' . chr(10) . chr(7) . 'Disruptions = Innovation', 1, 'C', 1);

$pdf->CheckPageBreak(250);

// Risk and Disruptions

$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('helvetica', 'B', 18);
$pdf->SetDrawColor(79, 129, 189);
$pdf->SetFillColor(79, 129, 189);
$pdf->Cell(160, 12, 'Risk and Disruptions', 1, 0, 'C', 1);
$pdf->Ln(20);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 12);

$pdf->MultiCell(160, 7, iconv('UTF-8', 'windows-1252', "The reality of individuals working in a team is the presence of disruptions, especially when the team is under pressure. These disruptive behaviours, or disruptors, has the potential to derail the team from achieving its objectives, but can also, if managed effectively, contribute to creativity and better problem solving. The level of risk of these disruptors may be used as a guideline to better understand the impact it may have on the individual as well as the team."));
$pdf->Ln(5);
$pdf->MultiCell(160, 7, iconv('UTF-8', 'windows-1252', "It is also important to note that higher risk scores on the disruption scale is not an indication of abnormal behaviour, but rather the probability that these disruptive behaviour will emerge when the individual is under pressure or in stressful situations."));
$pdf->Ln(5);
$pdf->MultiCell(160, 7, iconv('UTF-8', 'windows-1252', "To understand risk and the impact on the team, it is important that the following is considered when interpreting the report:"));
$pdf->Ln(10);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->Cell(40, 50, $pdf->Image($rootPath . "images/RP/tenamic-miter.png", $pdf->GetX(), $pdf->GetY() + 15, 33.78), 0, 0, 'L', false);
// 1
$pdf->SetFont('helvetica', 'B', 11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY($x + 40, $y);
$pdf->SetDrawColor(43, 184, 1);
$pdf->SetFillColor(43, 184, 1);
$pdf->Rect($x + 40, $y, 30, 20, 'F');
$pdf->SetXY($x + 42.5, $y + 7.5);
$pdf->MultiCell(25, 5, iconv('UTF-8', 'windows-1252', "LOW RISK"), 1);

$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetXY($x + 42.5, $y + 13);
$pdf->MultiCell(25, 5, iconv('UTF-8', 'windows-1252', "Score = 1 - 3"), 1);

$pdf->SetFont('helvetica', '', 12);
$pdf->SetXY($x + 70, $y);
$pdf->SetDrawColor(226, 239, 217);
$pdf->SetFillColor(226, 239, 217);
$pdf->Rect($x + 70, $y, 92.5, 20, 'F');
$pdf->SetXY($x + 72.5, $y + 2.5);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "The disruptor will probably be less evident under stressful situations and should not significantly impact the team negatively."), 1);
// 2
$pdf->SetFont('helvetica', 'B', 11);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY($x + 40, $y + 20);
$pdf->SetDrawColor(248, 205, 0);
$pdf->SetFillColor(248, 205, 0);
$pdf->Rect($x + 40, $y + 20, 30, 25, 'F');
$pdf->SetXY($x + 42.5, $y + 25);
$pdf->MultiCell(25, 5, iconv('UTF-8', 'windows-1252', "MODERATE RISK"), 1);

$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetXY($x + 42.5, $y + 35);
$pdf->MultiCell(25, 5, iconv('UTF-8', 'windows-1252', "Score = 4 - 6"), 1);

$pdf->SetFont('helvetica', '', 12);
$pdf->SetXY($x + 70, $y + 20);
$pdf->SetDrawColor(251, 229, 213);
$pdf->SetFillColor(251, 229, 213);
$pdf->Rect($x + 70, $y + 20, 92.5, 25, 'F');
$pdf->SetXY($x + 72.5, $y + 22.5);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "The disruptor may at times be observed under pressure and may cause some disruptions within the team, but it shouldn’t impact team work too much."), 1);

// 3
$pdf->SetFont('helvetica', 'B', 11);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetXY($x + 40, $y + 45);
$pdf->SetDrawColor(125, 3, 0);
$pdf->SetFillColor(125, 3, 0);
$pdf->Rect($x + 40, $y + 45, 100, 20, 'F');
$pdf->SetXY($x + 42.5, $y + 50);
$pdf->MultiCell(25, 5, iconv('UTF-8', 'windows-1252', "HIGH RISK"), 1);

$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetXY($x + 42.5, $y + 55.5);
$pdf->MultiCell(25, 5, iconv('UTF-8', 'windows-1252', "Score = 7 - 9"), 1);

$pdf->SetFont('helvetica', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY($x + 70, $y + 45);
$pdf->SetDrawColor(244, 169, 179);
$pdf->SetFillColor(244, 169, 179);
$pdf->Rect($x + 70, $y + 45, 92.5, 20, 'F');
$pdf->SetXY($x + 72.5, $y + 47.5);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(90, 5, iconv('UTF-8', 'windows-1252', "The disruptor will probably impact team work and might, if not managed effectively, derail the team from achieving its objectives."), 1);

$pdf->CheckPageBreak(250);

// Individual Contribution

$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('helvetica', 'B', 18);
$pdf->SetDrawColor(79, 129, 189);
$pdf->SetFillColor(79, 129, 189);
$pdf->Cell(160, 12, 'Individual Contribution', 1, 0, 'C', 1);
$pdf->Ln(20);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->MultiCell(160, 5, iconv('UTF-8', 'windows-1252', 'This section describes your preferred roles in the team. This does not reflect your abilities or skills, but rather a preference towards a certain role and responsibility.'));
$pdf->Ln(10);

$IC = base_url() . "images/radar_graph/jp_radar_C_" . $loggedinUser . ".jpeg";

$pdf->Image($IC, $pdf->GetX() + 0, $pdf->GetY() - 5, 160);

$pdf->Ln(100);
$pdf->SetTextColor(79, 129, 189);
$pdf->Cell(50, 12, $PTR_C, 0, 0, 'L', 0);
$pdf->Ln(10);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(160, 5, iconv('UTF-8', 'windows-1252', Individual_Contribution_Role($PTR_C, $u_name, $his, $His, $he, $He, $him)));

$pdf->Ln(10);

$pdf->SetTextColor(79, 129, 189);
$pdf->Cell(50, 12, $PSR_C, 0, 0, 'L', 0);
$pdf->Ln(10);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(160, 5, iconv('UTF-8', 'windows-1252', Individual_Contribution_Role($PSR_C, $u_name, $his, $His, $he, $He, $him)));

$pdf->CheckPageBreak(250);

//Potential Disruptors

$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('helvetica', 'B', 18);
$pdf->SetDrawColor(79, 129, 189);
$pdf->SetFillColor(79, 129, 189);
$pdf->Cell(160, 12, 'Potential Disruptors', 1, 0, 'C', 1);
$pdf->Ln(20);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(160, 5, iconv('UTF-8', 'windows-1252', 'This section describes your potential disruptors within a team environment. It is important to understand your disruptions to manage this more effectively especially in highly stressful situations where this could possible derail the team from achieving its objectives. At the same time, when a disruptor uses their profile constructively and the team is aware of this disruption style, it can contribute to the team success as each disruptor style challenges other team roles and can lead to innovative problem solving.'));
$pdf->Ln(10);

$PD = base_url() . "images/radar_graph/jp_radar_B_" . $loggedinUser . ".jpeg";

$pdf->Image($PD, $pdf->GetX() + 0, $pdf->GetY() - 5, 160);

$pdf->ln(90);

if ($PPD2 >= 7) {
	$pdf->SetTextColor(79, 129, 189);
	$pdf->Cell(60, 12, Potential_Role_title($PPD_C), 0, 0, 'L', 0);

	$pdf->Ln(10);

	$pdf->SetTextColor(0, 0, 0);
	$pdf->MultiCell(160, 5, iconv('UTF-8', 'windows-1252', Potential_Role($PPD_C, $PPD2, $u_name, $his, $His, $he, $He, $him)));
} else {
	$pdf->Ln(20);
	$pdf->MultiCell(160, 5, iconv('UTF-8', 'windows-1252', "$u_name shows no High Risk Disruptors."));
}
$pdf->Ln();

if ($PSD2 >= 7) {
	$pdf->SetTextColor(79, 129, 189);
	$pdf->Cell(60, 12, Potential_Role_title($PSD_C), 0, 0, 'L', 0);

	$pdf->Ln(10);

	$pdf->SetTextColor(0, 0, 0);
	$pdf->MultiCell(160, 5, iconv('UTF-8', 'windows-1252', Potential_Role($PSD_C, $PSD2, $u_name, $his, $His, $he, $He, $him)));
}

$pdf->CheckPageBreak(250);
$pdf->SetFont('helvetica', 'B', 15);
$pdf->SetFillColor(79, 129, 189);
$pdf->Cell(0, 12, 'TEANAMIC ROLE PROFILES', 0, 0, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(20);

// CC
$pdf->Cell(40, 40, $pdf->Image($rootPath . "images/RP/CC.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 13);

$pdf->SetXY($x, $y + 10);
$pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "Marketer"));

$pdf->SetXY($x + 40, $y);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "The client relationship builder and the marketing guru, likes to interact with clients and build new relationships. They understand the world of people the needs of the client. They understand the need is will suggest possible solutions to address these."));

$pdf->Ln(17);
// DA

$pdf->Cell(40, 40, $pdf->Image($rootPath . "images/RP/DA.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 13);

$pdf->SetXY($x, $y + 10);
$pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "Innovator"));

$pdf->SetXY($x + 40, $y);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "Coming up with new and innovative ideas, always thinking creatively and producing original concepts. They have a need to improve things and will usually think outside of the box to find a solution."));
$pdf->Ln(17);
// DI

$pdf->Cell(40, 40, $pdf->Image($rootPath . "images/RP/DI.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 13);

$pdf->SetXY($x, $y + 10);
$pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "Organiser"));

$pdf->SetXY($x + 40, $y);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "They like to plan and organise activities, ensuring projects are carefully planned, resources are allocated and deadlines are met. They ensure that timeliness is adhere to by everyone in the team."));
$pdf->Ln(17);
// ED

$pdf->Cell(40, 40, $pdf->Image($rootPath . "images/RP/ED.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 13);

$pdf->SetXY($x, $y + 10);
$pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "Leader"));

$pdf->SetXY($x + 40, $y);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "They guide the team and will probably enjoy taking the lead on projects, enjoys motivating others and inspiring the team to perform. They value the input of team members and accepts the responsibility of making the final decision."));
$pdf->Ln(17);
// HS

$pdf->Cell(40, 40, $pdf->Image($rootPath . "images/RP/HS.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 13);

$pdf->SetXY($x, $y + 10);
$pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "Perfectionist"));

$pdf->SetXY($x + 40, $y);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "They are the quality assurance contributor in the team, focusing on ensuring the solution adheres to the highest standards and will be the one who gives the final 'OK' after the project has been completed to ensure perfection."));

// IP
$pdf->CheckPageBreak(250);

$pdf->Cell(40, 40, $pdf->Image($rootPath . "images/RP/IP.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 13);

$pdf->SetXY($x, $y + 10);
$pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "Realist"));

$pdf->SetXY($x + 40, $y);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "The practical contributor of the team, always looking for pragmatic solutions and analysing the pros and cons of a solution. They are the go-to guy in the team to test whether solutions will actually work in the real world."));
$pdf->Ln(17);
// RP

$pdf->Cell(40, 40, $pdf->Image($rootPath . "images/RP/RP.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 13);

$pdf->SetXY($x, $y + 10);
$pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "Communicator"));

$pdf->SetXY($x + 40, $y);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "They enjoy communicating with others and sharing their ideas with the team. They enjoy giving advice and sharing information that will help the team gain better understanding of what is required."));
$pdf->Ln(17);
// SC

$pdf->Cell(40, 40, $pdf->Image($rootPath . "images/RP/SC.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 13);

$pdf->SetXY($x, $y + 10);
$pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "Maintainer"));

$pdf->SetXY($x + 40, $y);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "They prefer routine and structure, ensuring the project does not stand still. They are usually the ones that everyone goes to when they need to know where the project is at because they are constantly maintaining the daily flow of work."));

$pdf->CheckPageBreak(250);

//TEANAMIC DISRUPTOR PROFILES
$pdf->SetFont('helvetica', 'B', 15);
$pdf->SetFillColor(79, 129, 189);
$pdf->Cell(0, 12, 'TEANAMIC DISRUPTOR PROFILES', 0, 0, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(20);

// Dominant
$pdf->Cell(40, 40, $pdf->Image($rootPath . "images/DP/AH.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 13);

$pdf->SetXY($x, $y + 10);
$pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "Dominant"));

$pdf->SetXY($x + 42, $y + 10);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "They like fast pace environments and getting things done. This may cause them to be impulsive and impatient, sometimes ignoring others’ inputs."));

$pdf->Ln(17);

// Agreeable

$pdf->Cell(40, 40, $pdf->Image($rootPath . "images/DP/SS.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 13);

$pdf->SetXY($x, $y + 10);
$pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "Agreeable"));

$pdf->SetXY($x + 42, $y + 10);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "Individuals who enjoys a more passive working environment where conflict is minimal. Because of this, they may be risk-adverse and agree with others without challenging them."));
$pdf->Ln(17);

// CC

$pdf->Cell(40, 40, $pdf->Image($rootPath . "images/DP/CC.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 13);

$pdf->SetXY($x, $y + 10);
$pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "Enthusiastic"));

$pdf->SetXY($x + 42, $y + 10);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "They enjoy interacting with others, but may be prone to talk more and listen less. They tend to get enthusiastic quite easily, and may ignore critical information."));
$pdf->Ln(17);

// DM

$pdf->Cell(40, 40, $pdf->Image($rootPath . "images/DP/DM.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 13);

$pdf->SetXY($x, $y + 10);
$pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "Independent"));

$pdf->SetXY($x + 42, $y + 10);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "Very process oriented, they may focus less on other’s feelings to get the task done. They may be less group oriented and prefer to work independently."));
$pdf->Ln(17);

$pdf->CheckPageBreak(250);

// Inflexible

$pdf->Cell(40, 40, $pdf->Image($rootPath . "images/DP/DT.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 13);

$pdf->SetXY($x, $y + 10);
$pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "Inflexible"));

$pdf->SetXY($x + 42, $y + 10);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "They prefer a structured environment that offers predictability. This may however cause them to be less open to change and finding adapting to change quite difficult."));
$pdf->Ln(17);

// DP

$pdf->Cell(40, 40, $pdf->Image($rootPath . "images/DP/DP.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 13);

$pdf->SetXY($x, $y + 10);
$pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "Spontaneous"));

$pdf->SetXY($x + 42, $y + 10);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "Change and flexible work environments is what they prefer, finding routine and structure frustrating. They like to work in fast-pace environments, and may find planning draining."));

$pdf->Ln(17);

// TS

$pdf->Cell(40, 40, $pdf->Image($rootPath . "images/DP/TS.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 13);

$pdf->SetXY($x, $y + 10);
$pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "Precision"));

$pdf->SetXY($x + 42, $y + 10);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "They are very rule oriented and focus on quality rather than quantity. This may cause them to be too focused on the rules, thus impacting creativity and novel ideas."));
$pdf->Ln(17);

// ES

$pdf->Cell(40, 40, $pdf->Image($rootPath . "images/DP/ES.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false);

$x = $pdf->GetX();
$y = $pdf->GetY();

$pdf->SetFont('helvetica', 'B', 13);

$pdf->SetXY($x, $y + 10);
$pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "Risk-seeking"));

$pdf->SetXY($x + 42, $y + 10);
$pdf->SetFont('helvetica', '', 11.5);
$pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "They are quite firm and strong-willed, wanting to do things their way. They might be perceived as stubborn and rebellious at times."));
$pdf->Ln(17);

$pdf->CheckPageBreak(250);

// // AC

// $pdf->Cell( 40, 40, $pdf->Image($rootPath."images/DP/AC.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );

// $x = $pdf->GetX();
// $y = $pdf->GetY();

// $pdf->SetFont('helvetica', 'B', 13);

// $pdf->SetXY($x, $y+10);
// $pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "The Appeasing Challenger"));

// $pdf->SetXY($x + 42, $y+10);
// $pdf->SetFont('helvetica', '', 11.5);
// $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "Being optimistic and trusting of others intentions."));
// $pdf->Ln(17);

// // DT

// $pdf->Cell( 40, 40, $pdf->Image($rootPath."images/DP/DT.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );

// $x = $pdf->GetX();
// $y = $pdf->GetY();

// $pdf->SetFont('helvetica', 'B', 13);

// $pdf->SetXY($x, $y+10);
// $pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "The Detached Team Player"));

// $pdf->SetXY($x + 42, $y+10);
// $pdf->SetFont('helvetica', '', 11.5);
// $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "Keeping to deadliness, being committed and constructive."));
// $pdf->Ln(17);
// // DP

// $pdf->Cell( 40, 40, $pdf->Image($rootPath."images/DP/DP.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );

// $x = $pdf->GetX();
// $y = $pdf->GetY();

// $pdf->SetFont('helvetica', 'B', 13);

// $pdf->SetXY($x, $y+10);
// $pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "The Disorganised Perfectionist"));

// $pdf->SetXY($x + 42, $y+10);
// $pdf->SetFont('helvetica', '', 11.5);
// $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "Expressing self with assertiveness, willingness to help others and assuming leadership role."));

// $pdf->CheckPageBreak(250);

// // DO
// $pdf->Cell( 40, 40, $pdf->Image($rootPath."images/DP/DO.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );

// $x = $pdf->GetX();
// $y = $pdf->GetY();

// $pdf->SetFont('helvetica', 'B', 13);

// $pdf->SetXY($x, $y+10);
// $pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "The Distracted Organiser"));

// $pdf->SetXY($x + 42, $y+10);
// $pdf->SetFont('helvetica', '', 11.5);
// $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "Taking risks, testing the boundaries, being trustworthy and dependable."));
// $pdf->Ln(17);
// // ES

// $pdf->Cell( 40, 40, $pdf->Image($rootPath."images/DP/ES.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );

// $x = $pdf->GetX();
// $y = $pdf->GetY();

// $pdf->SetFont('helvetica', 'B', 13);

// $pdf->SetXY($x, $y+10);
// $pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "The Expressive Silencer"));

// $pdf->SetXY($x + 42, $y+10);
// $pdf->SetFont('helvetica', '', 11.5);
// $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "Interacting with others, making decisions."));
// $pdf->Ln(17);
// // GI

// $pdf->Cell( 40, 40, $pdf->Image($rootPath."images/DP/GI.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );

// $x = $pdf->GetX();
// $y = $pdf->GetY();

// $pdf->SetFont('helvetica', 'B', 13);

// $pdf->SetXY($x, $y+10);
// $pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "The Gregarious Introvert"));

// $pdf->SetXY($x + 42, $y+10);
// $pdf->SetFont('helvetica', '', 11.5);
// $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "Being creative and innovative, the need for direction and follow-through."));
// $pdf->Ln(17);

// // TS

// $pdf->Cell( 40, 40, $pdf->Image($rootPath."images/DP/TS.png", $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'L', false );

// $x = $pdf->GetX();
// $y = $pdf->GetY();

// $pdf->SetFont('helvetica', 'B', 13);

// $pdf->SetXY($x, $y+10);
// $pdf->MultiCell(40, 5, iconv('UTF-8', 'windows-1252', "The Trusting Scepticist"));

// $pdf->SetXY($x + 42, $y+10);
// $pdf->SetFont('helvetica', '', 11.5);
// $pdf->MultiCell(80, 5, iconv('UTF-8', 'windows-1252', "Cooperative and working with others, courage to challenge others, responding to criticism."));

// $pdf->CheckPageBreak(250);

// Disclosure
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
$pdf->MultiCell(165, 8, iconv('UTF-8', 'windows-1252', 'who requested the assessment and remains the property of AssessmentHouse. This report may not be shared with any individual or company who is not trained in psychometric testing or have been authorised through informed consent by the test-taker and supervising psychologist.'));
$pdf->Ln(10);
$pdf->SetFont('helvetica', 'B', 11.5);
$pdf->Cell(23, 10, iconv('UTF-8', 'windows-1252', 'Disclaimer: '));
$pdf->SetFont('helvetica', '', 11.5);
$pdf->Cell(48, 10, iconv('UTF-8', 'windows-1252', '  Since the report contains '));
$pdf->SetFont('helvetica', 'B', 11.5);
$pdf->Cell(26, 10, iconv('UTF-8', 'windows-1252', ' confidential  '));
$pdf->SetFont('helvetica', '', 11.5);
$pdf->Cell(100, 10, iconv('UTF-8', 'windows-1252', 'information it needs to be dealt with'));
$pdf->Ln(10);
$pdf->Cell(68, 10, iconv('UTF-8', 'windows-1252', 'accordingly. Consequently this report'));
$pdf->SetFont('helvetica', 'B', 11.5);
$pdf->Cell(82, 10, iconv('UTF-8', 'windows-1252', ' may not be handed over to the participant. '));
$pdf->SetFont('helvetica', '', 11.5);
$pdf->Cell(100, 10, iconv('UTF-8', 'windows-1252', ' It may '));
$pdf->Ln(10);
$pdf->MultiCell(165, 8, iconv('UTF-8', 'windows-1252', "also not be used as evidence in a disciplinary hearing.  Should this report or the content of the report be handled or communicated incorrectly by any party within the company, AssessmentHouse cannot be held liable for any claims resulting from such action."));

$filePath = $u_name . "_" . $du_name[0]->last_name . "_" . $og_u_name . "_" . $d[2] . '_' . $d[1] . '_' . $d[0] . ".pdf";
$pdf->Output($filePath, 'D');

function Individual_Contribution_Role($code, $u_name, $his, $His, $he, $He, $him) {
	switch ($code) {
	case "Innovator":
		return "$u_name enjoys coming up with new and innovative ideas, always thinking creatively and producing original concepts. $His team members might perceive $him as different because $he likes to think in ways that is less traditional and at times quite metaphoric. $u_name has a need to improve things and will usually think outside of the box to find a solution. $He might be described as the dreamer in the team.";
		break;

	case "Realist":
		return "$u_name is the practical contributor of the team. $He always looks for pragmatic solutions and will analyse the pros and cons of a solution. Team members might perceive $him as somewhat critical because $he tends to ask a lot of questions when dealing with a problem. $u_name will however be the go-to guy in the team to test whether solutions will actually work in the real world.";
		break;

	case "Organiser":
		return "$u_name likes to plan and organise activities. $He will be the one in the team that ensures that projects are carefully planned, resources are allocated and deadlines are met. $u_name's contribution to the team is very important as failing to plan is planning to fail. Team members might perceive $u_name as somewhat rigid at times, but as a planning specialist, $he will be the one to ensure that timeliness are adhere to by everyone in the team.";
		break;

	case "Maintainer":
		return "$u_name likes to work in environments that offers routine and structure. $He ensures that the project or work does not stand still and will be the one who keeps the wheel turning. $u_name will usually be the one that everyone goes to when they need to know where the project is at because $he is constantly maintaining the daily flow of work. $His team members might perceive $him as inflexible to change at times, but in times of change, $u_name will be the  one to bring stability to the team.";
		break;

	case "Perfectionist":
		return "$u_name is the quality assurance contributor in the team. $His main focus is on ensuring the solution adheres to the highest standards and will be the one who gives the final 'OK' after the project has been completed to ensure perfection. $u_name's team members might experience $him as too detail oriented and overly focused on specifications and requirements, but $he will be the one who ensures all the hard work of the team is appreciated by the client because of the quality of the solution or product.";
		break;

	case "Marketer":
		return "$u_name is the client relationship builder and the marketing guru of the team. $He likes to interact with clients and build new relationships to sell the solutions the team comes up with. $u_name likes to understand the world of people because this will enable $him to understand the needs of the client better. $He will usually be the one to tell the team what the real need is, and based on $his experience, will suggest possible solutions to address the need. $His team members might perceive $him as a socialist at times, but $he will be the one that introduces the products and services in the market.";
		break;

	case "Communicator":
		return "$u_name enjoys communicating with others and sharing $his ideas with the team. $He likes explaining things to others and will probably enjoy being the voice of the team. $He enjoys giving advice and sharing information that will help the team gain better understanding of what is required. $u_name is an effective listener and facilitator and enjoys giving feedback and building of an informal, relaxed climate.";
		break;

	case "Leader":
		return "$u_name is comfortable guiding the team and will probably enjoy taking the lead on projects. $He enjoys motivating others and inspiring the team to perform. Others will probably look at $u_name to take charge of situations and give direction to support the team in achieving their goals. $He values the input of team members, but $he accepts the responsibility of making the final decision.";
		break;

	default:
		return "";
		break;
	}
}

function Potential_Role($code, $score, $u_name, $his, $His, $he, $He, $him) {
	switch ($code) {
	case "Dominant":
		{
			if ($score >= 7) {
				return "$u_name  may be perceived as blunt and sarcastic at times, being too direct or forceful in situations. $He might be impulsive when making decisions, and impatient to get results. Others might at times find it difficult to work with $him in a team as $he might be overly critical and override others' ideas or inputs.";
			} else {
				return "Name shows no High Risk Disruptors";
			}
			break;
		}
	case "Agreeable":
		{
			if ($score >= 7) {
				return "$u_name may be perceived as risk-adverse and might tend to withdraw from conflict situations. $He might be too patient and lenient when urgent results are required. $His non-assertive behaviour might cause $him to give in too easy and agree with the team just for the sake of agreeing. $He might also be overly careful and nervous at times.";
			} else {
				return "Name shows no High Risk Disruptors";
			}
			break;
		}
	case "Enthusiastic":
		{
			if ($score >= 7) {
				return "$u_name might be inclined to talk rather than listen. $He might be overly enthusiastic to impress others, and might miss important detail that could derail the project. $He might tend to overestimate the complexity of problems and be somewhat inconsistent in $his solutions. $He might rely too much on $his personality to win people over.";
			} else {
				return "Name shows no High Risk Disruptors";
			}
			break;
		}
	case "Independent":
		{
			if ($score >= 7) {
				return "$u_name might be perceived as aloof and unsympathetic towards others. $He might tend to criticize others ideas and may be seen as negative at times. $He might find it difficult at times to share information or ideas in bigger teams, and might even resist group activities. $He will probably be more task driven and less focused on others' emotions or feelings.";
			} else {
				return "Name shows no High Risk Disruptors";
			}
			break;
		}
	case "Inflexible":
		{
			if ($score >= 7) {
				return "$u_name might be resistant to change and prefer to leave things as they are. Being very organised, $he might try to over-plan $his activities, being less flexible and adaptable to situations that change constantly. $He will be a very good listener, however others might find $him to be too quiet and not sharing information. Others might perceive $him as too relaxed and content with things as they are now, having no real drive to change things.";
			} else {
				return "Name shows no High Risk Disruptors";
			}
			break;
		}
	case "Spontaneous":
		{
			if ($score >= 7) {
				return "$u_name might be perceived as hyperactive and impatient. $He might find it very difficult to relax and may drain the team's energy because of $his highly paced drive to do things. $He enjoys change a lot, but might at times try to initiate change for the sake of change. $His attention span might also be quite low, find routine frustrating, and do things without too much planning.";
			} else {
				return "Name shows no High Risk Disruptors";
			}
			break;
		}
	case "Precision":
		{
			if ($score >= 7) {
				return "$u_name is very rule-oriented and concerned with structures and accuracy of information. This might make $him quite difficult to work with, especially where creativity is needed or instructions are vague. $He will tend to avoid risks as far as possible, and might disrupt the team in progressing should $he find it to be too stressful";
			} else {
				return "Name shows no High Risk Disruptors";
			}
			break;
		}
	case "Risk-seeking":
		{
			if ($score >= 7) {
				return "$u_name has a deep-seated need to be independent'. $He might find  it uncomfortable working in overly-structured environments, preferring to do $his own thing. $He might be quite firm and strong-willed, and may often precipitate a confrontation to achieve a result. $He is prepared to take risks. $u_name can be careless, not being overly concerned about detail, and stubborn and with little regard for authority, $he might be perceived as rebellious and defiant.";
			} else {
				return "Name shows no High Risk Disruptors";
			}
			break;
		}

	default:
		# code...
		break;
	}
}

function Potential_Role_title($code) {
	switch ($code) {
	case "Dominant":
		{
			return "Dominant";
			break;
		}
	case "Agreeable":
		{
			return "Agreeable";
			break;
		}
	case "Enthusiastic":
		{
			return "Enthusiastic";
			break;
		}
	case "Independent":
		{
			return "Independent";
			break;
		}
	case "Inflexible":
		{
			return "Inflexible";
			break;
		}
	case "Spontaneous":
		{
			return "Spontaneous";
			break;
		}
	case "Precision":
		{
			return "Precision";
			break;
		}
	case "Risk-seeking":
		{
			return "Risk-seeking";
			break;
		}

	default:
		# code...
		break;
	}
}

// function Potential_Role_old($code,$score,$u_name,$his,$His,$he,$He,$him)
// {

//     switch ($code) {
//         case "The Expressive Silencer":
//             switch ($score) {
//                 case ($score >= 1 && $score <= 3.99):
//                     return "$u_name seems to be calm under pressure and won't let stressful situations let $him down. $He is able to manage $his emotions quite well and should be less likely to react or express $his emotions openly.
// •   $His team member might experience $him as impersonal at times;
// •   Others might perceive $his lack of showing emotions as being non-empathetic.";
//                     break;

//                 case ($score >= 4 && $score <= 7.99):
//                     return "$u_name seems to be fairly calm under pressure although situations that are quite stressful might cause $him some discomfort. $He can manage $his emotions quite well, although $he might at times express $his feelings openly.";
//                     break;

//                 case ($score >= 8 && $score <= 10):
//                     return "$u_name might find it difficult to respond to stressful situations and might find managing $his emotions quite difficult. $He will probably express $his discomfort in stressful situation openly and others might find it difficult to work with $him when $he is under extreme pressure.
// •   $His team might perceive $him as erratic at times;
// •   $He might be perceived as the one causing some of the stress because of $his behaviour.";
//                     break;

//                 default:
//                     return "";
//                     break;
//             }
//             break;

//         case "The Trusting Scepticist":
//             switch ($score) {
//                 case ($score >= 1 && $score <= 3.99):
//                     return "$u_name is usually quite optimistic and will enjoy working with others. $He trusts others easily and will probably be prone to accept what others say without too much scepticism.
// •   Others might perceive $him as too trusting and accepting of ideas;
// •   $His team might at times think $his optimism might cause $him to be somewhat disillusioned to the current reality.";
//                     break;

//                 case ($score >= 4 && $score <= 7.99):
//                     return "$u_name is fairly optimistic and will enjoy working with others most of the time. $He might trusts others fairly easily but might at times be prone to accept what others say with a bit of scepticism.";
//                     break;

//                 case ($score >= 8 && $score <= 10):
//                     return "$u_name is less optimistic and might not always enjoy working with others. $He is less likely to trusts others and will probably be prone be sceptical of what others in $his team is thinking or saying.
// •   Others might perceive $him as negative at times;
// •   $His team might find $his scepticism difficult to manage.";
//                     break;

//                 default:
//                     return "";
//                     break;
//             }
//             break;

//         case "The Cautious Challenger":
//             switch ($score) {
//                 case ($score >= 1 && $score <= 3.99):
//                     return "$u_name is not afraid to try things out and is unafraid to make mistakes. $He enjoys new challenges and will be quite creative in coming up with new solutions.
// •   $He might overlook traditional methods that have successfully worked in the past;
// •   $His team might find $his need to constantly try new things out as somewhat bold and risky.";
//                     break;

//                 case ($score >= 4 && $score <= 7.99):
//                     return "$u_name is fairly open to try things out and is less afraid to make mistakes. $He sometimes enjoys new challenges and will be somewhat creative in coming up with new solutions.";
//                     break;

//                 case ($score >= 8 && $score <= 10):
//                     return "$u_name is less likely to try things out and is very reluctant to make mistakes. $He does not enjoy new challenges and will be less creative in coming up with new solutions.
// •   $He might be perceived as overly cautious and resisting change.
// •   $He might shoot down creative ideas before considering the value and validity thereof.";
//                     break;

//                 default:
//                     return "";
//                     break;
//             }
//             break;

//         case "The Detached Team Player":
//             switch ($score) {
//                 case ($score >= 1 && $score <= 3.99):
//                     return "$u_name is very outgoing and enjoys being around others. $He enjoys helping others and will be a good team player.
// •   $His team may at times experience $him as loud and too expressive;
// •   $He might be too team dependent.";
//                     break;

//                 case ($score >= 4 && $score <= 7.99):
//                     return "$u_name is somewhat outgoing and should enjoy working in smaller teams. $He will help others when asked and should be a contributing team member.";
//                     break;

//                 case ($score >= 8 && $score <= 10):
//                     return "$u_name can be quite direct when working with others and will prefer to rather work alone than in bigger team. $He can come across as quite intimidating and be less open to interact socially
// •   $His team might find interacting with $him difficult as $he might have the tendency to withdraw from social interactions.
// •   Others might perceive $him as somewhat cold at times.";
//                     break;

//                 default:
//                     return "";
//                     break;
//             }
//             break;

//         case "The Stubborn Supporter":
//             switch ($score) {
//                 case ($score >= 1 && $score <= 3.99):
//                     return "$u_name is very positive and optimistic. $He is very flexible and enjoy working in teams where $he can work constructively towards the team goals.
// •   $His team might find $his energy as overbearing at times;
// •   $He might also be inclined to be less assertive when having to give $his ideal goals on projects.";
//                     break;

//                 case ($score >= 4 && $score <= 7.99):
//                     return "$u_name is usually quite positive and optimistic. $He is somewhat flexible and may enjoy working in teams where $he can contribute towards the team goals.";
//                     break;

//                 case ($score >= 8 && $score <= 10):
//                     return "$u_name will probably be inclined to work alone and might be perceived as quite stubborn at times. $He might be prone to want to do things $his way.
// •   Others might find $him quite difficult to work with as $he might tend to want everyone to do things $his way most of the times;
// •   $He might also lack active listening skills.";
//                     break;

//                 default:
//                     return "";
//                     break;
//             }
//             break;

//         case "The Aggressive Humbler":
//             switch ($score) {
//                 case ($score >= 1 && $score <= 3.99):
//                     return "$u_name is an easy-going individual who is always willing to help others. Although less likely to take the leadership role in a team, $he will however be very supportive to team objectives.
// •   $He might tend to resist taking the lead when needed;
// •   $He might be less inclined to challenge others.";
//                     break;

//                 case ($score >= 4 && $score <= 7.99):
//                     return "$u_name is confident and assertive in expressing $him"."self. $He is willing take leadership roles at times whilst supporting the overall team objectives.";
//                     break;

//                 case ($score >= 8 && $score <= 10):
//                     return "$u_name might be very impulsive and fearless in taking on new tasks. $He will usually assume the leadership role, however might not always admit when things go wrong.
// •   $His team might find $his impulsivity to be a risk to the success of the team;
// •   Others might question $his integrity if $he doesn’t responsibility when things go wrong.";
//                     break;

//                 default:
//                     return "";
//                     break;
//             }
//             break;

//         case "The Dependable Manipulator":
//             switch ($score) {
//                 case ($score >= 1 && $score <= 3.99):
//                     return "$u_name seems to be very careful and quite averse to taking risks. $He is seen as very dependable and trustworthy and will be less inclined to accept a role where the stakes are high.
// •   Others might perceive $him as risk-averse;
// •   $He might withdraw from situations where outcomes are not always clear";
//                     break;

//                 case ($score >= 4 && $score <= 7.99):
//                     return "$u_name is fairly averse to risk although should not steer away when the stakes are high. Others can depend on $him most of the time.";
//                     break;

//                 case ($score >= 8 && $score <= 10):
//                     return "$u_name is very engaging and friendly, but can also be seen as manipulative to achieve results. $He enjoys taking risks and testing the limits.
// •   $His need to achieve might cause $his team to become suspicious of $his behaviour;
// •   $He might take risks that may impact team success.";
//                     break;

//                 default:
//                     return "";
//                     break;
//             }
//             break;

//         case "The Gregarious Introvert":
//             switch ($score) {
//                 case ($score >= 1 && $score <= 3.99):
//                     return "$u_name seems to be somewhat shy and less inclined to interact with people $he does not know well. $He prefers working on projects $he knows well, and probably less inclined to seek new business opportunities.
// •   $His team might find $him quite withdrawn;
// •   $He will probably be less interested in starting new projects.";
//                     break;

//                 case ($score >= 4 && $score <= 7.99):
//                     return "$u_name should not find it too challenging interacting with others $he does not know that well. $He prefers working on projects that is familiar to $him, but will not be too averse to taking on new tasks. ";

//                     break;

//                 case ($score >= 8 && $score <= 10):
//                     return "$u_name is quite talkative and interactive and others might perceive $him as gregarious. $He is less organised than most and might prefer to make intuitive decisions that is more creative and less practical

// •   $His team might find $him somewhat loud at times;
// •   $His ideas might be quite strange less pragmatic.";
//                     break;

//                 default:
//                     return "";
//                     break;
//             }
//             break;

//         case "The Distracted Organiser":
//             switch ($score) {
//                 case ($score >= 1 && $score <= 3.99):
//                     return "$u_name is very task-oriented and needs clear direction when working on projects. $He prefers predictability and will probably be more inclined to work with the practical things than being creative or innovative.
// •   $His need for predictability might frustrate $his team in planning projects;
// •   $He might ask too many questions to gain clear direction.";
//                     break;

//                 case ($score >= 4 && $score <= 7.99):
//                     return "$u_name is task-oriented and may need some direction when required to work on projects. $He might need some predictability in $his working environments and may come up with some creative and innovative ideas at times.";
//                     break;

//                 case ($score >= 8 && $score <= 10):
//                     return "$u_name is very creative and innovative. $His ideas might be very unconventional and not very practical. Being easily bored, $u_name might lack follow-through and might be distracted quite easily.
// •   Others might find $his ideas to be too creative and not aligned to current problems and challenges;
// •   The quality of $his work may not always be on standard because $he gets distracted quite easily.";
//                     break;

//                 default:
//                     return "";
//                     break;
//             }
//             break;

//         case "The Disorganised Perfectionist":
//             switch ($score) {
//                 case ($score >= 1 && $score <= 3.99):
//                     return "$u_name is quite relaxed and informal in approach. $He is very disorganised and will probably not enjoy working in a very structured environment. $He enjoys working in changing situations and is probably good at adapting to change.
// •   $His need for a relaxed environment with relatively no structures might cause the team to find $him quite difficult to work with, especially when planning activities;
// •   $His team might find $his disorganised behaviour quite difficult to manage. ";
//                     break;

//                 case ($score >= 4 && $score <= 7.99):
//                     return "$u_name is fairly relaxed about rules and deadlines, although will be prone to plan now and then to ensure $he doesn't miss deadlines. $He is fairly flexible in responding to change.";
//                     break;

//                 case ($score >= 8 && $score <= 10):
//                     return "$u_name prefers following the rules and quite intolerant of ambiguity. $He might be reluctant to try new solutions and might be perceived as somewhat uptight.
// •   $His need for rules and clarity might cause some frustrations within the team as $he will be a stickler for following the rulebook;
// •   Trying out something new will be very difficult for $him and $his team might find this to derail innovative problem solving.";
//                     break;

//                 default:
//                     return "";
//                     break;
//             }
//             break;

//         case "The Appeasing Challenger":
//             switch ($score) {
//                 case ($score >= 1 && $score <= 3.99):
//                     return "$u_name is very independent and self-sufficient. $He won’t find it difficult to challenge others' opinions and might even challenge $his superiors if $he doesn't agree with them. $He is less concerned about negative feedback.
// •   $His team members might feel threatened at times when $he challenges them on most things;
// •   $He might loose credibility from senior people if $he challenges them too much.";
//                     break;

//                 case ($score >= 4 && $score <= 7.99):
//                     return "$u_name is fairly independent and won't mind working alone or in teams. $He might challenge others from time to time, although this won't come naturally. $He should be open to criticism and negative feedback, although this might cause some discomfort.";
//                     break;

//                 case ($score >= 8 && $score <= 10):
//                     return "$u_name is pleasant and cooperative and works well with others. $He will be less inclined to challenge others, especially $his superiors, and might be prone to want to please others. $He might be reluctant to work independently, preferring to work in team and supporting others.
// •   $He might find it very difficult to challenge others’ ideas and will usually go with whatever the team decides;
// •   Others might perceive $him as someone who is overly dependent on the team to succeed.";
//                     break;

//                 default:
//                     return "";
//                     break;
//             }
//             break;

//         //main
//         default:
//             return "";
//             break;
//     }
// }

function getSumArray($arr_str) {
	$data = array();
	$answers = explode(',', $arr_str);
	array_unshift($answers, 0);

	// D

	$Dominant = array($answers[1], $answers[13], $answers[16], $answers[20], $answers[23], $answers[41], $answers[58], $answers[82], $answers[88], $answers[116]);
	$Agreeable = array($answers[37], $answers[52], $answers[64], $answers[70], $answers[74], $answers[93], $answers[96], $answers[99], $answers[125], $answers[128]);
	$Enthusiastic = array($answers[4], $answers[6], $answers[11], $answers[19], $answers[40], $answers[43], $answers[49], $answers[54], $answers[84], $answers[118]);
	$Independent = array($answers[30], $answers[32], $answers[34], $answers[38], $answers[62], $answers[73], $answers[76], $answers[94], $answers[101], $answers[126]);
	$Inflexible = array($answers[2], $answers[17], $answers[22], $answers[47], $answers[50], $answers[59], $answers[81], $answers[85], $answers[115], $answers[122]);
	$Spontaneous = array($answers[25], $answers[28], $answers[35], $answers[56], $answers[67], $answers[78], $answers[87], $answers[91], $answers[106], $answers[108]);
	$Precision = array($answers[10], $answers[14], $answers[44], $answers[46], $answers[61], $answers[90], $answers[111], $answers[113], $answers[119], $answers[121]);
	$Risk_seeking = array($answers[8], $answers[26], $answers[65], $answers[68], $answers[71], $answers[97], $answers[104], $answers[109], $answers[112], $answers[127]);

	$B = array(
		'Dominant' => array_sum($Dominant),
		'Agreeable' => array_sum($Agreeable),
		'Enthusiastic' => array_sum($Enthusiastic),
		'Independent' => array_sum($Independent),
		'Inflexible' => array_sum($Inflexible),
		'Spontaneous' => array_sum($Spontaneous),
		'Precision' => array_sum($Precision),
		'Risk-seeking' => array_sum($Risk_seeking),
	);

	arsort($B);

	$BPR = array(
		'Dominant' => potentialPrimaryDisruptor(array_sum($Dominant)),
		'Agreeable' => potentialPrimaryDisruptor(array_sum($Agreeable)),
		'Enthusiastic' => potentialPrimaryDisruptor(array_sum($Enthusiastic)),
		'Independent' => potentialPrimaryDisruptor(array_sum($Independent)),
		'Inflexible' => potentialPrimaryDisruptor(array_sum($Inflexible)),
		'Spontaneous' => potentialPrimaryDisruptor(array_sum($Spontaneous)),
		'Precision' => potentialPrimaryDisruptor(array_sum($Precision)),
		'Risk-seeking' => potentialPrimaryDisruptor(array_sum($Risk_seeking)),
	);

	arsort($BPR);

	$BPR_KEYS = array_keys($BPR);

	PrimaryRoleGraph($BPR, "B");

	$keys_B = array_keys($B);
	$shadow_B_1 = $B[$keys_B[0]];
	$shadow_B_2 = $B[$keys_B[1]];
	// END D

	// C
	$ip = array($answers['3'], $answers['27'], $answers['51'], $answers['75'], $answers['98'], $answers['123']);
	$ed = array($answers['5'], $answers['29'], $answers['53'], $answers['77'], $answers['100'], $answers['124']);
	$da = array($answers['7'], $answers['31'], $answers['55'], $answers['79'], $answers['102'], $answers['105']);
	$rc = array($answers['9'], $answers['33'], $answers['57'], $answers['80'], $answers['103'], $answers['107']);
	$cr = array($answers['12'], $answers['36'], $answers['60'], $answers['83'], $answers['86'], $answers['110']);
	$hs = array($answers['15'], $answers['21'], $answers['39'], $answers['63'], $answers['89'], $answers['114']);
	$sc = array($answers['18'], $answers['42'], $answers['45'], $answers['69'], $answers['92'], $answers['117']);
	$di = array($answers['24'], $answers['48'], $answers['66'], $answers['72'], $answers['95'], $answers['120']);

	$C = array(
		"Realist" => array_sum($ip),
		"Leader" => array_sum($ed),
		"Innovator" => array_sum($da),
		"Communicator" => array_sum($rc),
		"Marketer" => array_sum($cr),
		"Perfectionist" => array_sum($hs),
		"Maintainer" => array_sum($sc),
		"Organiser" => array_sum($di),
	);

	arsort($C);

	$CPR = array(
		"Realist" => primary_role(array_sum($ip)),
		"Leader" => primary_role(array_sum($ed)),
		"Innovator" => primary_role(array_sum($da)),
		"Communicator" => primary_role(array_sum($rc)),
		"Marketer" => primary_role(array_sum($cr)),
		"Perfectionist" => primary_role(array_sum($hs)),
		"Maintainer" => primary_role(array_sum($sc)),
		"Organiser" => primary_role(array_sum($di)),
	);

	arsort($CPR);
	PrimaryRoleGraph($CPR, "C");

	$keys = array_keys($C);
	$data['Primary_Team_Role'] = array(str_replace("\n", "", $keys[0]), primary_role($C[$keys[0]]));
	$data['Secondary_Team_Role'] = array(str_replace("\n", "", $keys[1]), primary_role($C[$keys[1]]));

	$dtBA_1 = $shadow_B_1;
	$dtBA_2 = $shadow_B_2;

	$data['Potential_Primary_Disruptor'] = array(str_replace("\n", "", $BPR_KEYS[0]), $BPR["$BPR_KEYS[0]"]);
	$data['Potential_Secondary_Disruptor'] = array(str_replace("\n", "", $BPR_KEYS[1]), $BPR["$BPR_KEYS[0]"]);

	return $data;

}

function primary_role($val) {
	if ($val >= 1 && $val <= 4) {return 1;}
	if ($val >= 5 && $val <= 8) {return 2;}
	if ($val >= 9 && $val <= 12) {return 3;}
	if ($val >= 13 && $val <= 16) {return 4;}
	if ($val >= 17 && $val <= 20) {return 5;}
	if ($val >= 21 && $val <= 24) {return 6;}
	if ($val >= 25 && $val <= 28) {return 7;}
	if ($val >= 29 && $val <= 32) {return 8;}
	if ($val >= 33 && $val <= 36) {return 9;}
}

function potentialPrimaryDisruptor($val) {
	if ($val >= 10 && $val <= 14) {return 1;}
	if ($val >= 15 && $val <= 19) {return 2;}
	if ($val >= 20 && $val <= 24) {return 3;}
	if ($val >= 25 && $val <= 29) {return 4;}
	if ($val >= 30 && $val <= 34) {return 5;}
	if ($val >= 35 && $val <= 39) {return 6;}
	if ($val >= 40 && $val <= 44) {return 7;}
	if ($val >= 45 && $val <= 49) {return 8;}
	if ($val >= 50 && $val <= 54) {return 9;}
	if ($val >= 55 && $val <= 60) {return 10;}
}

function PrimaryRoleGraph($array, $mtype) {
	$inp = array_map("abs", $array);
	$loggedinUser = trim($_GET['user_id']);
	$canvas = new Imagick();
	//$canvas->newImage(600, 600, new ImagickPixel('transparent'));
	// Use the above code if you need transparent background
	$canvas->newImage(700, 399, "white");

	$sd = 0;
	$ed = 45;
	$ox = 350;
	$oy = 197;

	foreach ($inp as $label => $value) {
		$radius = 15;
		$sw = 4;
		for ($i = 0; $i < 10; $i++) {
			$color = 'grey';
			if ($value > 0) {
				if ($i < $value) {
					$color = 'rgb(9, 16, 170)';
					if ($i >= 7) {
						$color = 'rgb(204, 59, 28)';
					}
				}

			}

			image_arc($canvas, $ox - $radius,
				$oy - $radius, $ox + $radius,
				$oy + $radius, $sd,
				$ed, $color, $sw);

			$radius = $radius + $sw + 5;
			$sw = $sw + 2;

			if ($i == 9) {
				//echo $label . "\n";
				//  position 1 - convert degrees to radians and get first point on perimeter of circle
				$x1 = $radius * cos($sd / 180 * 3.1416);
				$y1 = $radius * sin($sd / 180 * 3.1416);

				//  position 2 - convert degrees to radians and get second point on perimeter of circle
				$x2 = $radius * cos($ed / 180 * 3.1416);
				$y2 = $radius * sin($ed / 180 * 3.1416);
				$x = intval(($ox + $x1 + $ox + $x2) / 2) + 20;
				$y = intval(($oy + $y1 + $oy + $y2) / 2) + 20;

				if ($x <= 350) {
					$x = $x - 140;
				}
				if ($y <= 197) {
					$y = $y - 30;
				} else if ($y >= 230) {
					$y = $y - 15;
				}

				add_text($canvas, $label, $x, $y);
			}
		}

		$sd = $ed;
		$ed = $ed + 45;
		//break;
	}

	//  output the image
	$canvas->setImageFormat('jpeg');
	$fileName = "/usr/www/users/assessjqbu/images/radar_graph/jp_radar_" . $mtype . "_" . $loggedinUser . ".jpeg";

	if (file_exists($fileName)) {
		unlink($fileName);
	}

	$canvas->writeImage($fileName);

	return true;
}

//   function potentialPrimaryDisruptorGraph($val)
//   {
//   	if($val == 15){ return 10; }
//   	if($val == 14){ return 10; }
//   	if($val == 13){ return 9; }
//   	if($val == 12){ return 9; }
//   	if($val == 11){ return 8; }
//       if($val == 10){ return 8; }
//   	if($val == 9 ){ return 8; }
//   	if($val == 8 ){ return 7; }
//   	if($val == 7 ){ return 7; }
//   	if($val == 6 ){ return 6; }
//   	if($val == 5 ){ return 5; }
//   	if($val == 4 ){ return 4; }
//   	if($val == 3 ){ return 3; }
//   	if($val == 2 ){ return 2; }
//   	if($val == 1 ){ return 1; }
//   	if($val == 0) { return 1; }
//   	if($val == -15){ return 10;}
// if($val == -14){ return 10; }
// if($val == -13){ return 9; }
// if($val == -12){ return 9; }
// if($val == -11){ return 8; }
//       if($val == -10){ return 8; }
// if($val == -9) { return 8; }
// if($val == -8) { return 7; }
// if($val == -7) { return 7; }
// if($val == -6) { return 6; }
// if($val == -5) { return 5; }
// if($val == -4) { return 4; }
// if($val == -3) { return 3; }
// if($val == -2) { return 2; }
// if($val == -1) { return 1; }
//   }

// function potentialPrimaryRole($array)
// {
//     $inp = $array;

//     $loggedinUser = trim($_GET['user_id']);

//     //  create a new canvas object (transparent)
//     $canvas     = new Imagick();
//     //$canvas->newImage(700, 395, new ImagickPixel('transparent'));
//     $canvas->newImage(700, 395, "white");

//     $sd = 0;
//     $ed = 32.73;
//     $ox = 350;
//     $oy = 197;

//     foreach ($inp as $label => $value) {
//         $radius = 15;
//         $sw = 4;
//         for ($i = 0; $i < 10; $i++) {
//             $color = 'grey';
//             if ($value > 0) {
//                 if ($i < $value) {
//                     $color = 'rgb(9, 16, 170)';
//                     if ($i >= 7) {
//                         $color = 'rgb(204, 59, 28)';
//                     }
//                 }

//             }

//             image_arc($canvas, $ox - $radius,
//                       $oy - $radius, $ox + $radius,
//                       $oy + $radius, $sd,
//                       $ed, $color, $sw);

//             $radius = $radius + $sw + 3;
//             $sw = $sw + 2;

//             if ($i == 9) {
//                 //echo $label . "\n";
//                 //  position 1 - convert degrees to radians and get first point on perimeter of circle
//                 $x1 = $radius * cos($sd / 180 * 3.1416);
//                 $y1 = $radius * sin($sd / 180 * 3.1416);

//                 //  position 2 - convert degrees to radians and get second point on perimeter of circle
//                 $x2  = $radius * cos($ed / 180 * 3.1416);
//                 $y2  = $radius * sin($ed / 180 * 3.1416);
//                 $x = intval(($ox + $x1 + $ox + $x2) / 2) + 15;
//                 $y = intval(($oy + $y1 + $oy + $y2) / 2) + 20;

//                 if ($x <= 350) {
//                     $x = $x - 115;
//                 }
//                 if ($y <= 197) {
//                     $y = $y - 28;
//                 }
//                 else if ($y >= 230) {
//                     $y = $y - 10;
//                 }
//                 add_text($canvas, $label, $x, $y);
//             }
//         }

//         $sd = $ed;
//         $ed = $ed + 32.73;
//         if ($ed > 360)
//             $ed = 360;
//         //break;
//     }

//     //  output the image
//     $canvas->setImageFormat('jpeg');
//     $fileName = "/usr/www/users/assessjqbu/images/radar_graph/jp_radar_B_".$loggedinUser.".jpeg";

//     if (file_exists($fileName)) {
//         unlink($fileName);
//     }
//         $canvas->writeImage($fileName);

//     return true;
// }

function image_arc(&$canvas, $sx, $sy, $ex, $ey, $sd, $ed, $color, $sw = 4) {

	$draw = new ImagickDraw();
	$draw->setFillColor(new ImagickPixel('transparent'));
	$draw->setStrokeColor($color);
	$draw->setStrokeWidth($sw);
	//echo $sx . " " . $sy  . " " . $ex . " " .$ey . " " .$sd . " " .$ed. " " . $sw . "\n";
	$draw->arc($sx, $sy, $ex, $ey, $sd + 2, $ed - 2);
	$canvas->drawImage($draw);
}

function add_text(&$canvas, $text, $x, $y, $angle = 0) {
	$draw = new ImagickDraw();
	$draw->setFillColor(new ImagickPixel('transparent'));
	$draw->setFillColor('black');
	//$draw->setFont('TimesNewRoman');
	$draw->setFontSize(14);
	$canvas->annotateImage($draw, $x, $y, $angle, $text);

}

?>
