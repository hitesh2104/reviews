<?php

function getTextColor($color=null){
	$colorRes = array(255,255,255);
	if(empty($color)){return $colorRes;}

	if($color == 'red'){
		$colorRes = array(252,5,25);
	}
	if($color == 'yellow'){
		$colorRes = array(255,152,0);
	}
	if($color == 'green'){
		//$colorRes = array(17,47,0);
		$colorRes = array(57, 181, 4);
	}
	if($color == 'orange'){
		$colorRes = array(235, 79, 38);	
	}
	
	return $colorRes;
}

function salesPredictionIndicator($score=0){
	$scoreArr = array('text'=>'','color'=>array(255,255,255),'score'=>'');
	if($score <= 1){
		$scoreArr['text']	= 'Extremely Low';
		$scoreArr['color']	= getTextColor('red');
		$scoreArr['score']	= $score;
	}
	else if($score == 2){
		$scoreArr['text']	= 'Very Low';
		$scoreArr['color']	= getTextColor('red');
		$scoreArr['score']	= $score;
	}
	else if($score == 3){
		$scoreArr['text']	= 'Low';
		$scoreArr['color']	= getTextColor('red');
		$scoreArr['score']	= $score;
	}
	else if($score == 4 || $score == 5 || $score == 6){
		$scoreArr['text']	= 'Moderate';
		$scoreArr['color']	= getTextColor('yellow');
		$scoreArr['score']	= $score;
	}
	else if($score == 7 || $score == 8){
		$scoreArr['text']	= 'High';
		$scoreArr['color']	= getTextColor('green');
		$scoreArr['score']	= $score;
	}
	else if($score == 9 || $score == 10){
		$scoreArr['text']	= 'Very High';
		$scoreArr['color']	= getTextColor('green');
		$scoreArr['score']	= $score;
	}
	return $scoreArr;
}

function salesPredictionIndicator2($score=0){
	$scoreArr  = salesPredictionIndicator($score);
	if($score >= 1 && $score <= 3.99){
		$scoreArr['color']	= getTextColor('red');
	} else if($score >= 4 && $score <= 6.99){
		$scoreArr['color']	= getTextColor('orange');
	} else if($score >= 7){
		$scoreArr['color']	= getTextColor('green');
	}
	return $scoreArr;
}

function behaviourAttributeScore($score=0){
	$BA_score = array('5'=>10,'4'=>9,'3'=>8,'2'=>7,'1'=>6,'-1'=>5,'-2'=>4,'-3'=>3,'-4'=>2,'-5'=>1);
	$scoreArr = array('text'=>'','color'=>array(255,255,255),'score'=>'');
	if($score == 0 || $score == 1 || $score == -1 || $score == -2){
		$scoreArr['text']	= 'Moderate';
		$scoreArr['color']	= getTextColor('yellow');
		$scoreArr['score']	= $BA_score[$score];
	}
	else if($score == -3){
		$scoreArr['text']	= 'Low';
		$scoreArr['color']	= getTextColor('red');
		$scoreArr['score']	= $BA_score[$score];
	}
	else if($score == -4){
		$scoreArr['text']	= 'Very Low';
		$scoreArr['color']	= getTextColor('red');
		$scoreArr['score']	= $BA_score[$score];
	}
	else if($score == -5){
		$scoreArr['text']	= 'Extremely Low';
		$scoreArr['color']	= getTextColor('red');
		$scoreArr['score']	= $BA_score[$score];
	}
	else if($score == 2 || $score == 2){
		$scoreArr['text']	= 'High';
		$scoreArr['color']	= getTextColor('green');
		$scoreArr['score']	= $BA_score[$score];
	}
	else if($score == 4){
		$scoreArr['text']	= 'Very High';
		$scoreArr['color']	= getTextColor('green');
		$scoreArr['score']	= $BA_score[$score];
	}
	else if($score == 5){
		$scoreArr['text']	= 'Extremely High';
		$scoreArr['color']	= getTextColor('green');
		$scoreArr['score']	= $BA_score[$score];
	}
	return $scoreArr;
}

function learningPotential($score=0){
	$scoreArr = array('text'=>'','color'=>array(255,255,255),'score'=>'');
	if($score == 1){
		$scoreArr['text']	= 'Extremely Low';
		$scoreArr['color']	= getTextColor('red');
		$scoreArr['score']	= $score;
	}
	else if($score == 2){
		$scoreArr['text']	= 'Very Low';
		$scoreArr['color']	= getTextColor('red');
		$scoreArr['score']	= $score;
	}
	else if($score == 3 || $score == 0){
		$scoreArr['text']	= 'Low';
		$scoreArr['color']	= getTextColor('red');
		$scoreArr['score']	= $score;
	}
	else if($score == 4 || $score == 5 || $score == 6){
		$scoreArr['text']	= 'Moderate';
		$scoreArr['color']	= getTextColor('yellow');
		$scoreArr['score']	= $score;
	}
	else if($score == 7 || $score == 8){
		$scoreArr['text']	= 'High';
		$scoreArr['color']	= getTextColor('green');
		$scoreArr['score']	= $score;
	}
	else if($score == 9 || $score == 10){
		$scoreArr['text']	= 'Very High';
		$scoreArr['color']	= getTextColor('green');
		$scoreArr['score']	= $score;
	}
	return $scoreArr;
}

function gen_string($string,$max=20)
{
    $tok=strtok($string,' ');
    $string='';
    while($tok!==false && strlen($string)<$max)
    {
        if (strlen($string)+strlen($tok)<=$max)
            $string.=$tok.' ';
        else
            break;
        $tok=strtok(' ');
    }
    return trim($string);
}

/* PAGE 2 */
if ($pdf->PageNo() !== 2) {
    $pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);
}
$pdf->AddPage();
$pdf->getAliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
$pdf->Image(base_url().'images/sales_report_pages/page_1.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')

// SALES KNOWLEDGE
$salesKnowledge = salesPredictionIndicator2($sales_aptitude_score);
$pdf->SetY(163);
$pdf->SetX(120);
$pdf->SetFont('helvetica', 'N', 15);
$pdf->SetTextColor($salesKnowledge['color'][0],$salesKnowledge['color'][1],$salesKnowledge['color'][2]);
$pdf->Cell(75, 15, $salesKnowledge['text'].'             '.$salesKnowledge['score'],0,0,'R',0,'',0,false,'T','M');

// Behaviour Attributes
$behaviourAttribute = salesPredictionIndicator2($secAB_score);
$pdf->SetY(179);
$pdf->SetX(120);
$pdf->SetFont('helvetica', 'N', 15);
$pdf->SetTextColor($behaviourAttribute['color'][0],$behaviourAttribute['color'][1],$behaviourAttribute['color'][2]);
$pdf->Cell(75, 15, $behaviourAttribute['text'].'             '.$behaviourAttribute['score'],0,0,'R',0,'',0,false,'T','M');

// Motivation And Values
$motivationAndValues = salesPredictionIndicator2($smd_score);
$pdf->SetY(195);
$pdf->SetX(120);
$pdf->SetFont('helvetica', 'N', 15);
$pdf->SetTextColor($motivationAndValues['color'][0],$motivationAndValues['color'][1],$motivationAndValues['color'][2]);
$pdf->Cell(75, 15, $motivationAndValues['text'].'             '.$motivationAndValues['score'],0,0,'R',0,'',0,false,'T','M');

// Learning Speed Index
$learningSpeedInd = salesPredictionIndicator2($lsi);
$pdf->SetY(211);
$pdf->SetX(120);
$pdf->SetFont('helvetica', 'N', 15);
$pdf->SetTextColor($learningSpeedInd['color'][0],$learningSpeedInd['color'][1],$learningSpeedInd['color'][2]);
$pdf->Cell(75, 15, $learningSpeedInd['text'].'             '.$learningSpeedInd['score'],0,0,'R',0,'',0,false,'T','M');

// Sales Prediction Indicator

$spi_scr = round(($salesKnowledge['score']+$behaviourAttribute['score']+$motivationAndValues['score']+$learningSpeedInd['score'])/4);

$salesPredInd = salesPredictionIndicator2($spi_scr);
$pdf->SetY(232);
$pdf->SetX(120);
$pdf->SetFont('helvetica', 'N', 18);
$pdf->SetTextColor($salesPredInd['color'][0],$salesPredInd['color'][1],$salesPredInd['color'][2]);
$pdf->Cell(75, 15, $salesPredInd['text'].'             '.$salesPredInd['score'],0,0,'R',0,'',0,false,'T','M');


$hunter_farmer = array(
		'1'=> array('hunter'=>'hunter_novice.png','text'=>$uname.' Sales Pi score is below the average range. He/she might find sales related roles very challenging and might not perform as well as required. Based on these results, '.$uname.' is not recommended for this position.','farmer'=>'farmer_novice.png'),
		'2'=> array('hunter'=>'hunter_standard.png','text'=>$uname.' Sales Pi score is within the average range. He/she should perform fairly well in sales related roles, although at times might find it challenging to perform as well as required. Based on these results, '.$uname.' is recommended with caution for this position.','farmer'=>'farmer_standard.png'),
		'3'=> array('hunter'=>'hunter_advanced.png','text'=>$uname.' Sales Pi score is above average. He/she should perform well in sales related roles. Based on these results, '.$uname.' is recommended for this position.','farmer'=>'farmer_advanced.png'),
		'4'=> array('hunter'=>'hunter_expert.png','text'=>$uname.' Sales Pi score is within the enhanced range. He/she should perform extremely well in sales. '.$uname.' is highly recommended for this position.','farmer'=>'farmer_expert.png')
	);

$pdf->SetY(282);
$pdf->SetX(15);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->SetTextColor(215,57,37);
$pdf->Cell(75, 15, 'Hunter');

$pdf->SetY(282);
$pdf->SetX(182);
$pdf->SetFont('helvetica', 'N', 10);
$pdf->SetTextColor(215,57,37);
$pdf->Cell(75, 15, 'Farmer');


$hf_td1 = '';
$hf_td2 = '';
$hf_td3 = '';

if($hunter_score <= 3.99){
	$hf_td1 = base_url().'images/sales_report_pages/hunter_image/'.$hunter_farmer[1]['hunter'];
}else if($hunter_score > 3.99 && $hunter_score <= 4.99){
	$hf_td1 = base_url().'images/sales_report_pages/hunter_image/'.$hunter_farmer[2]['hunter'];
}else if($hunter_score > 4.99 && $hunter_score <= 6.99){
	$hf_td1 = base_url().'images/sales_report_pages/hunter_image/'.$hunter_farmer[3]['hunter'];
}else if($hunter_score > 6.99 && $hunter_score <= 10){
	$hf_td1 = base_url().'images/sales_report_pages/hunter_image/'.$hunter_farmer[4]['hunter'];
}

if($spi_scr <= 3.99){
	$hf_td2 = $hunter_farmer[1]['text'];
}else if($spi_scr > 3.99 && $spi_scr <= 5.99){
	$hf_td2 = $hunter_farmer[2]['text'];
}else if($spi_scr > 5.99 && $spi_scr <= 7.99){
	$hf_td2 = $hunter_farmer[3]['text'];
}else if($spi_scr > 7.99 && $spi_scr <= 10){
	$hf_td2 = $hunter_farmer[4]['text'];
}


if($farmer_score <= 3.99){
	$hf_td3 = base_url().'images/sales_report_pages/hunter_image/'.$hunter_farmer[1]['farmer'];
}else if($farmer_score > 3.99 && $farmer_score <= 4.99){
	$hf_td3 = base_url().'images/sales_report_pages/hunter_image/'.$hunter_farmer[2]['farmer'];
}else if($farmer_score > 4.99 && $farmer_score <= 6.99){
	$hf_td3 = base_url().'images/sales_report_pages/hunter_image/'.$hunter_farmer[3]['farmer'];
}else if($farmer_score > 6.99 && $farmer_score <= 10){
	$hf_td3 = base_url().'images/sales_report_pages/hunter_image/'.$hunter_farmer[4]['farmer'];
}


$tbl_HTML ='<table width="100%" cellpadding="5" border="1">
				<tr>
					<td width="20%" align="center"><img src="'.$hf_td1.'" style="width:110px;height:110px"></td>
					<td width="60%" align="center">'.$hf_td2.'</td>
					<td width="20%" align="center"><img src="'.$hf_td3.'" style="width:110px;height:110px"></td>
				</tr>
			</table>';
$pdf->SetY(255);
$pdf->SetX(0);
$pdf->SetMargins(0, 0, 0);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('helvetica', 'N', 14);
$pdf->writeHTML($tbl_HTML, true, 0, true, 0);

// Contine with here............


/* PAGE 3 */
if ($pdf->PageNo() !== 3) {
    $pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);
}
$pdf->AddPage();
$pdf->getAliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
$pdf->Image(base_url().'images/sales_report_pages/page_2.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('helvetica', '', 8);

$pdf->SetY(83);
$pdf->SetX(162);
$pdf->SetFont('helvetica', 'N', 18);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(75, 15, $total_correct_ans);

// SALES KNOWLEDGE
$salesKnowledge = salesPredictionIndicator($sales_aptitude_score);
$pdf->SetY(98);
$pdf->SetX(92);
$pdf->SetFont('helvetica', 'N', 15);
$pdf->SetTextColor($salesKnowledge['color'][0],$salesKnowledge['color'][1],$salesKnowledge['color'][2]);
$pdf->Cell(75, 15, $salesKnowledge['text'].'             '.$salesKnowledge['score'],0,0,'R',0,'',0,false,'T','M');


$ms = 170;
$tabl = '';

$tdVal1 = array('Active','Pleasant','Ambitious','Persuasive','Trustworthy','Faithful');
$tdVal2 = array('Sensitive','Cautious','Moody','Argumentative','Impatient');

foreach ($mostCorelation as $key => $value) {

	if(in_array($value, $tdVal1)){
		$td1 = '<td width="50%" align="center" style="color:blue">'.$value.'</td>';
	}elseif (in_array($value, $tdVal2)) {
		$td1 = '<td width="50%" align="center" style="color:red">'.$value.'</td>';
	}else{
		$td1 = '<td width="50%" align="center">'.$value.'</td>';
	}

	if(in_array($leastCorelation[$key], $tdVal1)){
		$td2 = '<td align="center" style="color:blue">'.$leastCorelation[$key].'</td>';
	}elseif (in_array($leastCorelation[$key], $tdVal2)) {
		$td2 = '<td align="center" style="color:red">'.$leastCorelation[$key].'</td>';
	}else{
		$td2 = '<td align="center">'.$leastCorelation[$key].'</td>';
	}

	$tabl .= '<tr>'.$td1.$td2.'</tr>';
	$tabl .= '<tr><td></td><td></td></tr>';

	// $pdf->SetY($ms);
	// $pdf->SetX(115);
	// $pdf->SetFont('helvetica', 'N', 15);
	// $pdf->SetTextColor(0,0,0);
	// //$pdf->Cell(75, 15, $leastCorelation[$key],0,0,'L',0,'',0,false,'T','M');
	// $pdf->writeHTML('<p style="color:green">'.$leastCorelation[$key].'</p>', true, false, true, false, '');


	//$ms = $ms+17;
}
$pdf->SetY(170);
$pdf->SetX(20);
$pdf->SetFont('helvetica', 'N', 15);
$pdf->SetTextColor(0,0,0);
//$pdf->Cell(75, 15, $value,0,0,'L',0,'',0,false,'T','M');
$pdf->writeHTML('<table cellpadding="3" width="100%">'.$tabl.'</table>', true, false, true, false, '');

/* page 4 */
if ($pdf->PageNo() !== 4) {
    $pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);
}
$pdf->AddPage();
$pdf->getAliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
$pdf->Image(base_url().'images/sales_report_pages/page_3.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->Image($file_path, 10, 50, 190, 220, '', '', '', false, 0, '', false, false, 0);
//$pdf->Image(base_url().'images/sales_aptitude/graph_legends.png', 50, 260, 0, 0, '', '', '', false, 0, '', false, false, 0);

$pdf->SetY(260);
$pdf->SetX(50);
$pdf->SetFont('helvetica', 'N', 11);
$pdf->SetTextColor(0,156,218);
$pdf->Cell(75, 15, 'Low Preference',0,0,'L',0,'',0,false,'T','M');

$pdf->SetY(260);
$pdf->SetX(105);
$pdf->SetFont('helvetica', 'N', 11);
$pdf->SetTextColor(0,156,218);
$pdf->Cell(75, 15, 'Moderate Preference',0,0,'L',0,'',0,false,'T','M');

$pdf->SetY(260);
$pdf->SetX(160);
$pdf->SetFont('helvetica', 'N', 11);
$pdf->SetTextColor(0,156,218);
$pdf->Cell(75, 15, 'Strong Preference ',0,0,'L',0,'',0,false,'T','M');



$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('helvetica', '', 8);


/* page 5 */
if ($pdf->PageNo() !== 5) {
    $pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);
}
$pdf->AddPage();
$pdf->getAliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
$pdf->Image(base_url().'images/sales_report_pages/page_4.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('helvetica', '', 8);

/* page 6 */
if ($pdf->PageNo() !== 6) {
    $pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);
}
$pdf->AddPage();
$pdf->getAliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
$pdf->Image(base_url().'images/sales_report_pages/page_5.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('helvetica', '', 8);

// Reasoning
$sp_lap_reasoning = learningPotential($LAP_S_A_result);
$pdf->SetY(73);
$pdf->SetX(120);
$pdf->SetFont('helvetica', 'N', 16);
$pdf->SetTextColor($sp_lap_reasoning['color'][0],$sp_lap_reasoning['color'][1],$sp_lap_reasoning['color'][2]);
$pdf->Cell(75, 15, $sp_lap_reasoning['score'].'            '.$sp_lap_reasoning['text'],0,0,'L',0,'',0,false,'T','M');

// Reasoning
$sp_lap_memory = learningPotential($LAP_S_B_result);
$pdf->SetY(91);
$pdf->SetX(120);
$pdf->SetFont('helvetica', 'N', 16);
$pdf->SetTextColor($sp_lap_memory['color'][0],$sp_lap_memory['color'][1],$sp_lap_memory['color'][2]);
$pdf->Cell(75, 15, $sp_lap_memory['score'].'            '.$sp_lap_memory['text'],0,0,'L',0,'',0,false,'T','M');

// Numerical
$sp_lap_numerical = learningPotential($LAP_S_D_result);
$pdf->SetY(110);
$pdf->SetX(120);
$pdf->SetFont('helvetica', 'N', 16);
$pdf->SetTextColor($sp_lap_numerical['color'][0],$sp_lap_numerical['color'][1],$sp_lap_numerical['color'][2]);
$pdf->Cell(75, 15, $sp_lap_numerical['score'].'            '.$sp_lap_numerical['text'],0,0,'L',0,'',0,false,'T','M');

// Spatial
$sp_lap_spatial = learningPotential($LAP_S_C_result);
$pdf->SetY(127);
$pdf->SetX(120);
$pdf->SetFont('helvetica', 'N', 16);
$pdf->SetTextColor($sp_lap_spatial['color'][0],$sp_lap_spatial['color'][1],$sp_lap_spatial['color'][2]);
$pdf->Cell(75, 15, $sp_lap_spatial['score'].'            '.$sp_lap_spatial['text'],0,0,'L',0,'',0,false,'T','M');

// LEARNING POTENTIAL
$sp_lap_learning_potential = learningPotential($learning_speed_index);
$pdf->SetY(145);
$pdf->SetX(120);
$pdf->SetFont('helvetica', 'N', 16);
$pdf->SetTextColor($sp_lap_learning_potential['color'][0],$sp_lap_learning_potential['color'][1],$sp_lap_learning_potential['color'][2]);
$pdf->Cell(75, 15, $sp_lap_learning_potential['score'].'            '.$sp_lap_learning_potential['text'],0,0,'L',0,'',0,false,'T','M');




/* page 7 */

$highD_heading = "High Drive";
$lowD_heading = "Low Drive";

$highD_keyWord = "Key words: Dominating, Direct, Determined, Assertive, Competitive";
$lowD_keyWord = "Key words: Cautious, Non-competitive, Sacrificing, Passive";

$highD_details = "People with a high D are authority driven and wants to be in charge and in control.  They enjoy being challenged and are very competitive individuals with a very high ambition. High D's prefer not to work under supervision and tend to shy away from being controled. They have a need for new and different activities.";

$lowD_details = "People with a low D are sincere and understanding. They don't enjoy a competitive environment and prefers limited responsibility. They don't necessarily want to be in charge. Low D's likes to take time in decision making. They also prefer to report into an authority. They may be seen as less assertive.";


$highI_heading = "High Interaction";
$lowI_heading = "Low Interaction";

$highI_keyWord = "Key words: Influencial, Persuasive, Outgoing, Positive";
$lowI_keyWord = "Key words: Independent, Tasks, Quality, Non-social";

$highI_details = "High I's enjoy being in contact with people. They like influencing others and communicate with ease. High I's have a desire to help other people and to motivate them. They prefer group activities, inside and outside the working environment. They enjoy public and social recognition.";

$lowI_details = "Low I's are task driven individuals and seeks logical and factual information. They prefer working alone and wants to be socially independent. Low I's may appear sceptical and withdrawn. They don't always show their emotions openly and might be perceived as a poor mixer.";

$highS_heading = "High Stability";
$lowS_heading = "Low Stability";

$highS_keyWord = "Key words: Reliable, Predictable, Structure, Repetitive";
$lowS_keyWord = "Key words: Variety, Mobility, Change, Quick paced";

$highS_details = "People with a high S are procedure orientated and likes to adhere to rules. They prefer environments that are predictable with little change. They are comfortable with systems and can concentrate on work for long periods of time. High S individuals wants security and a steady working environment. They need a lot of reassurance.";

$lowS_details = "People with a Low S enjoys change and flexibility. They prefer environments that can offer a lot of variety and challenges which is also unstructured. They like to make quick decisions and are usually quick paced individuals. They may at times be less tolerant and in need of pressure. They like mobility and would probably be motivated in jobs which gives them the opportunity to travel.";

$highC_heading = "High Conscientiousness";
$lowC_heading = "Low Conscientiousness";

$highC_keyWord = "Key words: Compliance, Details, Accuracy, Quality";
$lowC_keyWord = "Key words: Independence, Risk, Freedom, Fearless";

$highC_details = "High C's are detailed and quality orientated. They need precision work and an exact job description. They depend on detailed information to make their decisions. High C's always check their work for accuracy and comply to all the rules and procedures. They are quick to notice mistakes.";

$lowC_details = "Low C's are usually unconventional. They don't like following rules and procedures. They usually react fearless to situations. Low C's are usually frank and direct and work well under stress. They need minimum guideliness and work well in environments where they don't have to be confined with rules and policies. They might tend to miss deadlines.";

$dip_card_detail_D = array(); 
$dip_card_detail_I = array(); 
$dip_card_detail_S = array(); 
$dip_card_detail_C = array();

if($dip_total_D >= 0){
    $dip_card_detail_D = array( "heading" => $highD_heading, "keyword" => $highD_keyWord, "details" => $highD_details);    
} else {
    $dip_card_detail_D = array( "heading" => $lowD_heading, "keyword" => $lowD_keyWord, "details" => $lowD_details);    
}

if($dip_total_I >= 0){
    $dip_card_detail_I = array( "heading" => $highI_heading, "keyword" => $highI_keyWord, "details" => $highI_details);    
} else {
    $dip_card_detail_I = array( "heading" => $lowI_heading, "keyword" => $lowI_keyWord, "details" => $lowI_details);    
}

if($dip_total_C >= 0){
    $dip_card_detail_C = array( "heading" => $highC_heading, "keyword" => $highC_keyWord, "details" => $highC_details);    
} else {
    $dip_card_detail_C = array( "heading" => $lowC_heading, "keyword" => $lowC_keyWord, "details" => $lowC_details);    
}

if($dip_total_S >= 0){
    $dip_card_detail_S = array( "heading" => $highS_heading, "keyword" => $highS_keyWord, "details" => $highS_details);    
} else {
    $dip_card_detail_S = array( "heading" => $lowS_heading, "keyword" => $lowS_keyWord, "details" => $lowS_details);    
}


if ($pdf->PageNo() !== 7) {
    $pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);
}
$pdf->AddPage();
$pdf->getAliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
$pdf->Image(base_url().'images/sales_report_pages/page_6.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->Image($dip_file_path, 120, 40, 80, 100, '', '', '', false, 0, '', false, false, 0);
$pdf->Image(base_url().'images/sales_aptitude/graph_overlay.png', 135, 55, 50, 65, '', '', '', false, 0, '', false, false, 0);
$pdf->Image(base_url().'images/sales_aptitude/disc.png', 120, 30, 80, 20, '', '', '', false, 0, '', false, false, 0);

$pdf->SetY(125);
$pdf->SetX(125);
$pdf->SetFont('helvetica', 'N', 9);
$pdf->SetTextColor(215,57,37);
$pdf->Cell(75, 15, '* Red dotted line indicates preferable range');

$tbl_HTML ='<table width="100%" cellpadding="5">
			<tr>
				<td style="color:#FFF;font-size:20px;width:50%" align="center">'.$dip_card_detail_D['heading'].'</td>
				<td style="color:#FFF;font-size:20px;width:50%" align="center">'.$dip_card_detail_I['heading'].'</td>
			</tr>
			<tr>
				<td style="font-size:14px;width:50%">'.$dip_card_detail_D['keyword'].'</td>
				<td style="font-size:14px;width:50%">'.$dip_card_detail_I['keyword'].'</td>
			</tr>
			<tr>
				<td style="font-size:14px;width:50%"><table cellpadding="10"><tr><td>'.$dip_card_detail_D['details'].'</td></tr></table></td>
				<td style="font-size:14px;width:50%"><table cellpadding="10"><tr><td>'.$dip_card_detail_I['details'].'</td></tr></table></td>
			</tr>
			</table>';
$pdf->SetY(143);
$pdf->SetX(0);
$pdf->SetMargins(0, 0, 0);
$pdf->SetTextColor(0,0,0);
$pdf->writeHTML($tbl_HTML, true, false, true, false, '');

$tbl_HTML ='<table width="100%" cellpadding="5">
			<tr>
				<td style="color:#FFF;font-size:20px;width:50%" align="center">'.$dip_card_detail_C['heading'].'</td>
				<td style="color:#FFF;font-size:20px;width:50%" align="center">'.$dip_card_detail_S['heading'].'</td>
			</tr>
			<tr>
				<td style="font-size:14px;width:50%" valign="middle">'.$dip_card_detail_C['keyword'].'</td>
				<td style="font-size:14px;width:50%" valign="middle">'.$dip_card_detail_S['keyword'].'</td>
			</tr>
			<tr>
				<td style="font-size:14px;width:50%"><table cellpadding="10"><tr><td><br><br>'.$dip_card_detail_C['details'].'</td></tr></table></td>
				<td style="font-size:14px;width:50%"><table cellpadding="10"><tr><td><br><br>'.$dip_card_detail_S['details'].'</td></tr></table></td>
			</tr>
			</table>';
$pdf->SetY(220);
$pdf->SetX(0);
$pdf->SetMargins(0, 0, 0);
$pdf->SetTextColor(0,0,0);
$pdf->writeHTML($tbl_HTML, true, false, true, false, '');

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('helvetica', '', 8);


/* page 8 */

$interviewQuestion = array(
    '1'=> 'How do you keep up to date on your target market?',
    '2'=> 'How much time did you spend cultivating customer relationships versus \n hunting for new clients, and why?',
    '3'=> 'What role does social media play in your selling process?',
    '4'=> 'How does your current employer bring value to the customer?',
    '5'=> 'What are three important qualifying questions you ask every prospect?',
    '6'=> 'Describe a time when you had a difficult prospect, and how you handled that situation to win the sale?',
);

if ($pdf->PageNo() !== 8) {
    $pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);
}
$pdf->AddPage();
$pdf->getAliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
$pdf->Image(base_url().'images/sales_report_pages/page_7.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('helvetica', '', 8);

$pdf->SetY(85);
$pdf->SetX(13);
$pdf->SetFont('helvetica', 'N', 12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(75, 15, 'How do you keep up to date on your target market?');

$ans1yaxis = 100;
if(isset($openTextRes[1]) && !empty($openTextRes[1])){
	// $html = "<p style='font-size:10px'>".$openTextRes[1]."</p>";
	$html = "<table style='width:100%'><tr><td><span style='text-align:justify;'>".substr($openTextRes[1], 0, 700)."</span></td></tr></table>";
	$pdf->SetY(105);
	$pdf->SetX(13);
	$pdf->SetFont('helvetica', 'N', 10);
	$pdf->writeHTML($html, true, false, true, false, '');
	/*$string = $openTextRes[1];
	do {
		$text = gen_string($string,90);
	    $pdf->SetY($ans1yaxis);
		$pdf->SetX(13);
		$pdf->SetFont('helvetica', 'N', 12);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(75, 15, $text);
	    $ans1yaxis = $ans1yaxis + 5;
	    if($text == ''){
	      break;
	    }
	    $string = str_ireplace($text, " ", $string);

	}while($string);*/
}

$pdf->SetY(157);
$pdf->SetX(13);
$pdf->SetFont('helvetica', 'N', 12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(75, 15, 'How much time did you spend cultivating customer relationships versus');
$pdf->SetY(162);
$pdf->SetX(13);
$pdf->SetFont('helvetica', 'N', 12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(75, 15, 'hunting for new clients, and why?');
$ans2_yaxis = 175;
if(isset($openTextRes[2]) && !empty($openTextRes[2])){
	//$html = "<p style='font-size:10px'>".($openTextRes[2])."</p>";
	$html = "<table style='width:100%'><tr><td><span style='text-align:justify;'>".substr($openTextRes[2], 0, 700)."</span></td></tr></table>";
	$pdf->SetY(177);
	$pdf->SetX(13);
	$pdf->SetFont('helvetica', 'N', 10);
	$pdf->writeHTML($html, true, false, true, false, '');
	/*$string = $openTextRes[2];
	do {
	    $text = gen_string($string,90);
	    $pdf->SetY($ans2_yaxis);
		$pdf->SetX(13);
		$pdf->SetFont('helvetica', 'N', 12);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(75, 15, $text);
	    if($text == ''){
	      break;
	    }
	    $ans2_yaxis = $ans2_yaxis + 5;
	    $string = str_ireplace($text, " ", $string);
	}while($string);*/
}



$pdf->SetY(225);
$pdf->SetX(13);
$pdf->SetFont('helvetica', 'N', 12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(75, 15, 'What role does social media play in your selling process?');

if(isset($openTextRes[3]) && !empty($openTextRes[3])){
	//$pos=strpos($openTextRes[3],0, 300);
	// $html = "<span style='font-size:10px'>".substr($openTextRes[3], 0, 600)."</span>";
	$html = "<table style='width:100%'><tr><td><span style='text-align:justify;'>".substr($openTextRes[3], 0, 600)."</span></td></tr></table>";
	$pdf->SetY(245);
	$pdf->SetX(13);
	$pdf->SetFont('helvetica', 'N', 10);
	$pdf->writeHTML($html, true, false, true, false, '');
}

// $string1 = '';
// if(isset($openTextRes[3]) && !empty($openTextRes[3])){
// 	$string1 = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting";//$openTextRes[3];
// 	do {
// 	    $text = gen_string($string1,90);
// 	    $pdf->SetY($ans3_yaxis);
// 		$pdf->SetX(13);
// 		$pdf->SetFont('helvetica', 'N', 12);
// 		$pdf->SetTextColor(0,0,0);
// 		$pdf->Cell(75, 15, $text);
// 	    if($text == ''){
// 	      break;
// 	    }
// 	    $ans3_yaxis = $ans3_yaxis + 5;
// 	    $string1 = str_ireplace($text, " ", $string1);
// 	}while($string1);
// }

if ($pdf->PageNo() !== 9) {
    $pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);
}
$pdf->AddPage();
$pdf->getAliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
$pdf->Image(base_url().'images/sales_report_pages/page_8.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('helvetica', '', 8);

$pdf->SetY(25);
$pdf->SetX(13);
$pdf->SetFont('helvetica', 'N', 12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(75, 15, 'How does your current employer bring value to the customer?');
$ans4_yaxis = 40;
if(isset($openTextRes[4]) && !empty($openTextRes[4])){
	// $html = "<p style='font-size:10px'>".($openTextRes[4])."</p>";
	$html = "<table style='width:100%'><tr><td><span style='text-align:justify;'>".substr($openTextRes[4], 0, 800)."</span></td></tr></table>";
	$pdf->SetY(45);
	$pdf->SetX(13);
	$pdf->SetFont('helvetica', 'N', 10);
	$pdf->writeHTML($html, true, false, true, false, '');
	/*$string = $openTextRes[4];
	do {
	    $text = gen_string($string,90);
	    $pdf->SetY($ans4_yaxis);
		$pdf->SetX(13);
		$pdf->SetFont('helvetica', 'N', 12);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(75, 15, $text);
	    if($text == ''){
	      break;
	    }
	    $ans4_yaxis = $ans4_yaxis + 5;
	    $string = str_ireplace($text, " ", $string);
	}while($string);*/
}
$pdf->SetY(117);
$pdf->SetX(13);
$pdf->SetFont('helvetica', 'N', 12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(75, 15, 'What are three important qualifying questions you ask every prospect?');
$ans5_yaxis = 132;
if(isset($openTextRes[5]) && !empty($openTextRes[5])){
	// $html = "<p style='font-size:10px'>".($openTextRes[5])."</p>";
	$html = "<table style='width:100%'><tr><td><span style='text-align:justify;'>".substr($openTextRes[5], 0, 800)."</span></td></tr></table>";
	$pdf->SetY(137);
	$pdf->SetX(13);
	$pdf->SetFont('helvetica', 'N', 10);
	$pdf->writeHTML($html, true, false, true, false, '');
	/*$string = $openTextRes[5];
	do {
	    $text = gen_string($string,90);
	    $pdf->SetY($ans5_yaxis);
		$pdf->SetX(13);
		$pdf->SetFont('helvetica', 'N', 12);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(75, 15, $text);
	    if($text == ''){
	      break;
	    }
	    $ans5_yaxis = $ans5_yaxis + 5;
	    $string = str_ireplace($text, " ", $string);
	}while($string);*/
}


$pdf->SetY(195);
$pdf->SetX(13);
$pdf->SetFont('helvetica', 'N', 12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(75, 15, 'Describe a time when you had a difficult prospect, and how you handled');
$pdf->SetY(200);
$pdf->SetX(13);
$pdf->SetFont('helvetica', 'N', 12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(75, 15, 'that situation to win the sale?');
$ans6_yaxis = 210;

if(isset($openTextRes[6]) && !empty($openTextRes[6])){
	// $html = "<p style='font-size:10px'>".$openTextRes[6]."</p>";
	$html = "<table style='width:100%'><tr><td><span style='text-align:justify;'>".substr($openTextRes[6], 0, 800)."</span></td></tr></table>";
	$pdf->SetY(215);
	$pdf->SetX(13);
	$pdf->SetFont('helvetica', 'N', 10);
	$pdf->writeHTML($html, true, false, true, false, '');
	/*$string = $openTextRes[6];
	do {
	    $text = gen_string($string,90);
	    $pdf->SetY($ans6_yaxis);
		$pdf->SetX(13);
		$pdf->SetFont('helvetica', 'N', 12);
		$pdf->SetTextColor(0,0,0);
		$pdf->Cell(75, 15, $text);
	    if($text == ''){
	      break;
	    }
	    $ans6_yaxis = $ans6_yaxis + 5;
	    $string = str_ireplace($text, " ", $string);
	}while($string);*/
}

/* page 10 */
if ($pdf->PageNo() !== 10) {
    $pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);
}
$pdf->AddPage();
$pdf->getAliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
$pdf->Image(base_url().'images/sales_report_pages/page_9.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('helvetica', '', 8);

?>
