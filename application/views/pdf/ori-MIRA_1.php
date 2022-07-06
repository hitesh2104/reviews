<?php
$fullName = "pramod batodiya";
$uName = "pramod";
$gender ="male";
$rTitle = "mira";
$rootPath = ''; //$_SERVER['DOCUMENT_ROOT'].'/';

require("fpdf/mc_table.php");
class PDF_1 extends PDF_MC_Table {
    
    function Header() {
        global $testCompletedDate;
        global  $rootPath;
        if ($this->PageNo() !== 1) {
            $this->Image($rootPath."images/perTestImg1.png", 87, 10, 40);
            $this->SetTextColor(128, 128, 128);
            $this->SetFont('helvetica', '', 8);
            $d = date('d/m/Y');
            $this->Cell(175, 7, $d, 0, 0, 'R');
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

$pdf = new PDF_1("P", "mm", "A4");
$pdf->AddPage();
$imgPath = "IMAGE##80##10##" . '../images/rpt_chk/';
$pdf->AliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
$pdf->Image($rootPath."images/MIRA.jpg", -1, 0, 211, 298);
$pdf->SetY(117);
$pdf->SetX(110);
$pdf->SetFont('helvetica', 'B', 25);
$pdf->SetTextColor(79, 129, 189);
$pdf->Cell(188, 15, $fullName);
$pdf->SetTextColor(0, 0, 0);
$pdf->CheckPageBreak(250);
$pdf->Ln(13);
$pdf->Image($rootPath."images/perTestImg1.png", $pdf->GetX() + 3, $pdf->GetY() - 5, 165);
$pdf->Ln(75);
$pdf->MultiCell(160, 8, "The Matrix of Intellectual Reasoning Assessment (MIRA)is a non-verbal mental ability test that requires test-takers to find solutions to a range of different problems. It measures observation skills, thinking ability, intellectual capacity and efficiency. It also measures one's ability to formulate new concepts, extract meaning out of ambiguity and to think clearly about complex situations and events.");
$pdf->Ln(5);
$pdf->MultiCell(160, 8, "The Stratified Systems Theory (SST) developed by Eliot Jaques defines work in different organisational levels, mainly on the basis of decision-making complexity. MIRA measures the individual's ability to find solutions through different levels of complex problems.");
$pdf->CheckPageBreak(250);

$pdf->Image($rootPath."images/perTestImg1.png", $pdf->GetX() + 3, $pdf->GetY() - 5, 160);
$pdf->Ln(95);
$pdf->CheckPageBreak(250);
$main_title = '';
$sub_title ='';
if ($score == 1) {
    $pdf->SetFont('helvetica', '', 18);
    $pdf->MultiCell(160, 8, 'SST LEVEL 1 - TANGIBLE BRILLIANCE');
    $pdf->Ln(13);
    $pdf->Image($rootPath."images/perTestImg1.png", $pdf->GetX() + 30, $pdf->GetY() - 10, 120);
    $pdf->Ln(75);
    
    $main_title = "The candidate seems to be more comfortable working in an environment with tangible outputs where quality is their main priority. They may prefer to follow a clear set of guidelines to perform optimally and are more inclined to function in an operational and/or technical environment. A structured environment will probably suite the candidate better where they can plan and organise their daily activities. The candidate might also be more inclined to follow routines as this will make their work activities more predictable and measurable.";
    
    $sub_title = "Leaders on this level are usually leaders of self, having to manage their own work schedules and plan their own day-to-day activities.";
}

if ($score == 2) {
    $pdf->SetFont('helvetica', '', 18);
    $pdf->MultiCell(160, 8, 'SST LEVEL 2 - EXCELLENCE CLARIFICATION');
    $pdf->Ln(13);
    $pdf->Image($rootPath."images/perTestImg1.png", $pdf->GetX() + 30, $pdf->GetY() - 10, 100);
    $pdf->Ln(75);
    
    $main_title = "It seems that they might find working in an environment where they have to solve problems where answers are not very clear by using their knowledge and/or experience. They tend to ask clarifying questions to ensure they get to the correct answer or solution. The environment they seem to prefer to work in is mostly structured and routine-based, however with some flexibility of choice.";
    
    $sub_title = "Leaders on this level tend to lead self as well as moving into an environment where they may be required to manage other technical and/or operational people.";
}
if ($score == 3) {
    $pdf->SetFont('helvetica', '', 18);
    $pdf->MultiCell(160, 8, 'SST LEVEL 3 - STRATEGY EXECUTION');
    $pdf->Ln(13);
    $pdf->Image($rootPath."images/perTestImg1.png", $pdf->GetX() + 30, $pdf->GetY() - 10, 100);
    $pdf->Ln(75);
    $main_title = "It seems that they should find it comfortable working in environments that offer some strategic involvement, more specifically the execution of strategic plans. Thinking things through and effectively using and distributing resources effectively is a main component of this level which they should be able to perform effectively. They probably know how the operational day-to-day activities link to the long term strategy of the organisation.";
    
    $sub_title = "Leaders on this level are usually leaders of others, at times leader of other first-line managers and/or supervisors.";
}
if ($score == 4) {
    $pdf->SetFont('helvetica', '', 18);
    $pdf->MultiCell(160, 8, 'SST LEVEL 4 - STRATEGY CONTEXTUALISING');
    $pdf->Ln(13);
    $pdf->Image($rootPath."images/perTestImg1.png", $pdf->GetX() + 30, $pdf->GetY() - 10, 100);
    $pdf->Ln(90);
    $main_title = "The strategy contextualising environment requires someone to develop strategies to keep the company aligned to what is required to be viable in the future. They seem to enjoy working across different business units, preferring a less structured working environment. Routine and day-to-day operational activities will probably be less motivating as a more challenging environment where decisions are more complex will probably be more motivating to them. Innovation and thinking outside the box is probably more stimulating to them and making decisions where the answer is not always that obvious and/or clear.";
    
    $sub_title = "Leaders on this level usually lead other senior managers within an organisation.";
}
if ($score == 5) {
    $pdf->SetFont('helvetica', '', 18);
    $pdf->MultiCell(160, 8, 'SST LEVEL 5 - STRATEGY CONCEPTUALISING');
    $pdf->Ln(13);
    $pdf->Image($rootPath."images/perTestImg1.png", $pdf->GetX() + 30, $pdf->GetY() - 10, 100);
    $pdf->Ln(75);
    $main_title = "Conceptualising strategies for future industry viability is a key component for individuals working on this level. It seems that they have the capability to deal with the complexity of this environment, thus working with information that is very vague and/or mostly unavailable. They probably find it stimulating to work in environments that offer little if any structure at all. Working and thinking about the macro economy and making decisions that can impact the whole organisation will probably stimulate them.";
    
    $sub_title = "Leaders on this level usually manage numerous business units and at times probably different organisations. They can think across different systems and/or units, being good CEO’s of large organisations.";
}

$main_title = str_replace('Name ', $fullName.' ', $main_title);
if($gender == 'female'){
    $searchArr = array('He ', 'His ', ' he ', ' his ', 'himself ');
    $replaceArr = array('She ', 'Her ', ' she ', ' her ', 'herself ');
    $main_title = str_replace($searchArr, $replaceArr, $main_title);
}

$pdf->SetFont('helvetica', '', 12.5);
$pdf->MultiCell(160, 8, $main_title);
$pdf->Ln(5);
$pdf->MultiCell(160, 8, $sub_title);
$pdf->CheckPageBreak(250);

$pdf->SetFont('helvetica', '', 18);
$pdf->MultiCell(160, 8, 'Disclosure');
$pdf->Ln(13);

$pdf->SetFont('helvetica', 'B', 11.5);
$pdf->Cell(20, 10, 'Purpose: ');
$pdf->SetFont('helvetica', '', 11.5);
$pdf->Cell(100, 10, ' The purpose of this report is to indicate the test-takers cognitive capability using');
$pdf->Ln(10);
$pdf->MultiCell(165, 10, "the Stratified Systems Theory (SST). This report is for the attention of the manager who requested the assessment and remains the property of AssessmentHouse. This report may not be shared with any individual or company who is not trained in psychometric testing or have been authorised through informed consent by the test-taker and supervising psychologist.");
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
$filePath = $uName . "-" . $rTitle . ".pdf";
$pdf->Output($filePath, 'D');
?>