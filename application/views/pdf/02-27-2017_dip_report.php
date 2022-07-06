<?php
$fullName = $userData[0]->full_name;
$userId = $userData[0]->id;
$gender = $userData[0]->gender;
$rptName = "DIP";

global $testCompletedDate;

$testCompletedDate = $testCompData['completed_date'];

$d = explode('-', substr($testCompletedDate, 0, 10));
$testCompletedDate = ($d[2] . '/' . $d[1] . '/' . $d[0]); 
$rootPath = ''; //$_SERVER['DOCUMENT_ROOT'].'/'; 
$vowels = array(" ");
$u_name = str_replace($vowels, "-", $fullName);
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
			$this->SetMargins(25, 10, 25);
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

	function createTableWithFormating($data, $lastWidth=12, $borderData = array(), $boldFontData = array(), $bgColorData = array(), $textColorData = array(), $newHeight = 7, $align = 'L'){
		if($newHeight == 0 || $newHeight == ""){ $newHeight = 7;}
		$defaultBorderArr = array('F', 'FD', 'DF', 'RB');
		//Calculate the height of the row
		//kamal , new code to fix 
		// 1. Image overflow
		// 2. page break
		// 3. and height of the row  
		$nb=0;
		$image_height=0;
		for($i=0;$i<count($data);$i++){
			if (strpos($data[$i], "IMAGE##") > -1){
				$ar = explode("##", $data[$i]);
				$image_height=$ar[2]+2; // we have added 2 for a margin
			}else{
				$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i])); 
			}
		}
		$h = $newHeight * $nb;
		$h=max($h,$image_height);
		//end of new code
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++){
			if($i==(count($data)-1)){
				$w = $lastWidth;
			}else{
				$w = $this->widths[$i];
			}
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x = $this->GetX();
			$y = $this->GetY();

			//Print the text
			if (strpos($data[$i], "IMAGE##") > -1){
				$tmp = explode("##", $data[$i]);
				$data[$i] = $tmp[3];
				
				//Apply background color
				$this->SetFillColor(255, 255, 255);
				if(isset($bgColorData[$i]) && !empty($bgColorData[$i])){
					$c = explode(", ",$bgColorData[$i]);
					$c[0] = isset($c[0])?$c[0]:204;
					$c[1] = isset($c[1])?$c[1]:255;
					$c[2] = isset($c[2])?$c[2]:255;						
					$this->SetFillColor($c[0], $c[1], $c[2]);
				}
				//Apply border
				if(isset($borderData[$i]) && !empty($borderData[$i]) && in_array($borderData[$i], $defaultBorderArr)){
				      /* D or empty string: draw. This is the default value.
				        F: fill
				      	DF or FD: draw and fill 
						RB: Reduce border width & height
						*/
					//Draw the border
					if($borderData[$i]=="RB"){
						$this->Rect($x,$y,($w-0.2),(10),$borderData[$i]);
					}else{
						$this->Rect($x,$y,($w),($h),$borderData[$i]);
					}
				}else{
					//Draw the border
					//$this->Rect($x,$y,$w,$h);
				}	
				
				# Add image
				if(isset($borderData[$i]) && !empty($borderData[$i]) && !in_array($borderData[$i], $defaultBorderArr)){
					$this->MultiCell($w, $h, $this->Image($data[$i], $this->GetX()+1, $this->GetY()+1, $tmp[1], $tmp[2]),$borderData[$i],'C');
				}else{
					$this->MultiCell($w, 5, $this->Image($data[$i], $this->GetX()+1, $this->GetY()+1, $tmp[1], $tmp[2]),0,'C');
				}
				
			}else{
				//Apply font setting
				$this->SetFont('Arial','');
				if(isset($boldFontData[$i]) && !empty($boldFontData[$i])){
					$this->SetFont('Arial',$boldFontData[$i]);
				}
					
				//Apply Text color
				$this->SetTextColor(0, 0, 0);
				if(isset($textColorData[$i]) && !empty($textColorData[$i])){
					$tc = explode(", ",$textColorData[$i]);
					$tc[0] = isset($tc[0])?$tc[0]:0;
					$tc[1] = isset($tc[1])?$tc[1]:0;
					$tc[2] = isset($tc[2])?$tc[2]:0;						
					$this->SetTextColor($tc[0], $tc[1], $tc[2]);
				}	

				//Apply background color
				$this->SetFillColor(255, 255, 255);
				if(isset($bgColorData[$i]) && !empty($bgColorData[$i])){
					$c = explode(", ",$bgColorData[$i]);
					$c[0] = isset($c[0])?$c[0]:204;
					$c[1] = isset($c[1])?$c[1]:255;
					$c[2] = isset($c[2])?$c[2]:255;						
					$this->SetFillColor($c[0], $c[1], $c[2]);
				}	
				
				//Apply border
				if(isset($borderData[$i]) && !empty($borderData[$i]) && in_array($borderData[$i], $defaultBorderArr)){
				      /* D or empty string: draw. This is the default value.
				        F: fill
				      	DF or FD: draw and fill */
					//Draw the border
					$this->Rect($x,$y,$w,$h,$borderData[$i]);
					
				}elseif(isset($borderData[$i]) && !empty($borderData[$i]) && !in_array($borderData[$i], $defaultBorderArr)){
					//Draw the border
					//$this->Rect($x,$y,$w,$h,$borderData[$i]);
				}else{
					//Draw the border
					$this->Rect($x,$y,$w,$h);
				}
				if(isset($borderData[$i]) && !empty($borderData[$i]) && !in_array($borderData[$i], $defaultBorderArr)){
					//echo $data[$i];
					if(isset($bgColorData[$i]) && !empty($bgColorData[$i])){
						$this->MultiCell($w, $newHeight, $data[$i], $borderData[$i], $align, true);
					}else{
						$this->MultiCell($w, $newHeight, $data[$i], $borderData[$i], $align);
					}
				}else{
					$this->MultiCell($w, $newHeight, $data[$i], 0, $align);
				}
			}
			//$this->MultiCell($w,5,$data[$i],0,$a);	
			//Put the position to the right of the cell
			$this->SetXY($x+$w, $y);
		}
		//Go to the next line
		$this->Ln($h);
	}
}


$pdf = new PDF("P", "mm", "A4");
$pdf->AddPage();
$imgPath = "IMAGE##80##10##" . $rootPath."images/rpt_chk/";
$pdf->AliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
$pdf->Image( $rootPath."images/DIP.jpg", -1, 0, 211, 298);
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

$pdf->SetMargins(15, 10, 25);
$pdf->SetFont('helvetica', 'B', 18);
$pdf->SetDrawColor(79, 129, 189);
$pdf->SetFillColor(79, 129, 189);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetX(15);
$pdf->MultiCell(180, 12, 'DISC INDICATOR PROFILE (DIP)', 0, 'C', 1);
$pdf->Ln(5);
$pdf->SetFont('helvetica', '', 12.5);
$pdf->MultiCell(160, 8, 'REPORT FOR '.$fullName);
$pdf->Ln(2);

require_once("jpgraph-4.0.2/jpgraph.php");	
require_once('jpgraph-4.0.2/jpgraph_bar.php');
require_once('jpgraph-4.0.2/jpgraph_line.php');
	
# Start:- Bar graph
//print_r($resultArr); echo '<br><br>';
	$datay=array($resultArr['RD'], $resultArr['RI'], $resultArr['RS'], $resultArr['RC']);

	// Create the graph. These two calls are always required
	$graph = new Graph(450,450,"auto");    

	// Slightly bigger margins than default to make room for titles
	$graph->SetMargin(50, 60, 30, 60);
	$graph->SetMarginColor('white');

	// Setup the scales for X,Y and Y2 axis
	$graph->SetScale("textlin"); // X and Y axis
	$graph->SetY2Scale("lin"); // Y2 axis

	// Overall graph title
	//$graph->title->Set('IQ ');
	//$graph->title->SetFont(FF_FONT1,FS_BOLD,12);

	// Setup the labels
	$lbl = array("D", "I", "S", "C");
	$graph->xaxis->SetTickLabels($lbl);
	$graph->xaxis->SetFont(FF_FONT1,FS_BOLD,16);
	$graph->xaxis->SetColor('black');
	$graph->xaxis->SetTickSide(SIDE_TOP);
	$graph->xaxis->HideLabels();
	//$graph->xaxis->SetLabelAngle(90);

	// Create Y data set 
	$bplot = new BarPlot($datay);
	$graph->Add($bplot);
	$bplot->SetWeight(0);
	$bplot->SetFillColor(array('#c00000','#ffc000','#0070c0', '#00b050')); 
	// Create Y2 scale data set 
	$l1plot = new LinePlot($datay);
	// ... and add the plot to the Y2-axis

	$graph->AddY2($l1plot);
	$graph->SetY2OrderBack(false);
	$l1plot->SetColor("#C0504D");
	$l1plot->SetWeight(2);
	
	// Display the graph
	$bplot->value->SetFormat('%00.2f');
	$bplot->value->SetColor("#000000");
	$bplot->value->SetFont(FF_FONT1,FS_BOLD);
	$bplot->value->Show();
	$bplot->value->HideZero();
	$bplot->SetValuePos('top');
	
	$outputFile = "temp_img/".$userId."_".$test_id."_barGraph.png";
	@unlink($outputFile); 
	// Display the graph
	$graph->Stroke($outputFile);
	#echo '<img src="'.base_url().$outputFile.'" width="450" height="350" alt="test" />'; die;
	// Display the graph
	// EOF 
# End:- Bar graph

$pdf->Image("images/disc.png", 65, $pdf->GetY(), 70);
$pdf->Image("temp_img/".$userId."_".$test_id."_barGraph.png", 50, $pdf->GetY()+13, 100, 85);
$pdf->Ln(99);

$pdf->SetTextColor(0, 0, 0);
$fontColorArr[0] = array('255, 255, 255', '255, 255, 255');
$bgColorArr[0] = array('192, 0, 0', '255, 192, 0');
$fontColorArr[1] = array('194, 10, 10', '255, 211, 79');
$bgColorArr[1] = array('83, 129, 53', '91, 155, 213');
$fontColorArr[2] = array('50, 191, 114', '17, 121, 196');
$pdf->SetWidths(array(90, 90));

$highD_heading = "High Dominance";
$lowD_heading = "Low Dominance";
$highD_keyWord = "Key words: Dominating, Direct, Determined, Assertive, Competitive";
$lowD_keyWord = "Key words: Cautious, Non-competitive, Sacrificing, Passive";
$highD_details = "People with a high D are authority driven and wants to be in charge and in control.  They enjoy being challenged and are very competitive individuals with a very high ambition. High D's prefer not to work under supervision and tend to shy away from being controled. They have a need for new and different activities.";
$lowD_details = "People with a low D are sincere and understanding. They don't enjoy a competitive environment and prefers limited responsibility. They don't necessarily want to be in charge. Low D's likes to take time in decision making. They also prefer to report into an authority. They may be seen as less assertive.";

$highI_heading = "High Influence";
$lowI_heading = "Low Influence";
$highI_keyWord = "Key words: Influencial, Persuasive, Outgoing, Positive";
$lowI_keyWord = "Key words: Independent, Tasks, Quality, Non-social";
$highI_details = "High I's enjoy being in contact with people. They like influencing others and communicate with ease. High I's have a desire to help other people and to motivate them. They prefer group activities, inside and outside the working environment. They enjoy public and social recognition.";
$lowI_details = "Low I's are task driven individuals and seeks logical and factual information. They prefer working alone and wants to be socially independent. Low I's may appear sceptical and withdrawn. They don't always show their emotions openly and might be perceived as a poor mixer.";

$highS_heading = "High Steadiness";
$lowS_heading = "Low Steadiness";
$highS_keyWord = "Key words: Reliable, Predictable, Structure, Repetitive";
$lowS_keyWord = "Key words: Variety, Mobility, Change, Quick paced";
$highS_details = "People with a high S are procedure orientated and likes to adhere to rules. They prefer environments that are predictable with little change. They are comfortable with systems and can concentrate on work for long periods of time. High S individuals wants security and a steady working environment. They need a lot of reassurance.";
$lowS_details = "People with a Low S enjoys change and flexibility. They prefer environments that can offer a lot of variety and challenges which is also unstructured. They like to make quick decisions and are usually quick paced individuals. They may at times be less tolerant and in need of pressure. They like mobility and would probably be motivated in jobs which gives them the opportunity to travel.";

$highC_heading = "High Compliance";
$lowC_heading = "Low Compliance";
$highC_keyWord = "Key words: Compliance, Details, Accuracy, Quality";
$lowC_keyWord = "Key words: Independence, Risk, Freedom, Fearless";
$highC_details = "High C's are detailed and quality orientated. They need precision work and an exact job description. They depend on detailed information to make their decisions. High C's always check their work for accuracy and comply to all the rules and procedures. They are quick to notice mistakes.";
$lowC_details = "Low C's are usually unconventional. They don't like following rules and procedures. They usually react fearless to situations. Low C's are usually frank and direct and work well under stress. They need minimum guideliness and work well in environments where they don't have to be confined with rules and policies. They might tend to miss deadlines.";
$pdf->SetFont('helvetica', '', 11);
$D =(($resultArr['RD']>=0)?$highD_heading:$lowD_heading);
$I =(($resultArr['RI']>=0)?$highI_heading:$lowI_heading);
$printData = array($D, $I);
$pdf->createTableWithFormating($printData, 90, array('DF', 'DF'), array('B', 'B'), $bgColorArr[0], $fontColorArr[0], 8);

$pdf->SetFont('helvetica', '', 10);
$D =(($resultArr['RD']>=0)?$highD_keyWord:$lowD_keyWord);
$I =(($resultArr['RI']>=0)?$highI_keyWord:$lowI_keyWord);
$printData = array($D, $I);
$pdf->createTableWithFormating($printData, 90, array('DF', 'DF'), array('B', 'B'), array(), $fontColorArr[1], 5);

$D =(($resultArr['RD']>=0)?$highD_details:$lowD_details);
$I =(($resultArr['RI']>=0)?$highI_details:$lowI_details);
$printData = array($D, $I);
$pdf->createTableWithFormating($printData, 90, array('DF', 'DF'), array(), array(), $fontColorArr[1], 5);

$C =(($resultArr['RC']>=0)?$highC_heading:$lowC_heading);
$S =(($resultArr['RS']>=0)?$highS_heading:$lowS_heading);
$printData = array($C, $S);
$pdf->createTableWithFormating($printData, 90, array('DF', 'DF'), array('B', 'B'), $bgColorArr[1], $fontColorArr[0], 8);

$pdf->SetFont('helvetica', '', 10);
$C =(($resultArr['RC']>=0)?$highC_keyWord:$lowC_keyWord);
$S =(($resultArr['RS']>=0)?$highS_keyWord:$lowS_keyWord);
$printData = array($C, $S);
$pdf->createTableWithFormating($printData, 90, array('DF', 'DF'), array('B', 'B'), array(), $fontColorArr[2], 5);

$C =(($resultArr['RC']>=0)?$highC_details:$lowC_details);
$S =(($resultArr['RS']>=0)?$highS_details:$lowS_details);
$printData = array($C, $S);
$pdf->createTableWithFormating($printData, 90, array('DF', 'DF'), array(), array(), $fontColorArr[2], 5);
    
    $pdf->CheckPageBreak(250);
    $pdf->SetFont('helvetica', 'B', 15);
    $pdf->SetFillColor(79,129,189);
    $pdf->SetTextColor(0, 0, 0);

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

$filePath = $u_name . "_" . $userData[0]->last_name . "_" . $rptName . "_" .$d[2] . '_' . $d[1] . '_' . $d[0] . ".pdf";
$pdf->Output($filePath, 'D');


 ?>