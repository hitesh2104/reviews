<?php 
// $openTextRes = $report_data[0]['open_text_res']?json_decode($report_data[0]['open_text_res'],true):array();


//print_r($report_data);

// die;


// According to file right answer
//$sales_aptitude_qus_ans = array('0' => '3','1' => '1','2' => '4','3' => '1','4' => '4','5' => '1','6' => '1','7' => '2','8' => '1','9' => '4','10' => '1','11' => '3','12' => '1','13' => '1','14' => '2','15' => '1','16' => '1','17' => '1','18' => '4','19' => '2','20' => '3','21' => '1','22' => '1','23' => '1','24' => '1','25' => '1','26' => '1','27' => '1','28' => '1','29' => '2','30' => '4','31' => '4','32' => '4','33' => '1','34' => '1');


// According to client right answer
$sales_aptitude_qus_ans = array('0' => '1','1' => '2','2' => '4','3' => '1','4' => '4','5' => '4','6' => '4','7' => '2','8' => '3','9' => '1','10' => '1','11' => '4','12' => '4','13' => '1','14' => '4','15' => '3','16' => '3','17' => '3','18' => '3','19' => '3','20' => '2','21' => '4','22' => '1','23' => '4','24' => '2','25' => '1','26' => '2','27' => '2','28' => '1','29' => '4','30' => '1','31' => '3','32' => '1','33' => '4','34' => '2');

$Sales_Apptitute_Test = explode(',', $report_data[0]['Sales_Apptitute_Test']);
$Sales_Value_Test = explode(',', $report_data[0]['Sales_Value_Test']);
$Sales_Attribute_Test_A = explode(',', $report_data[0]['Sales_Attribute_Test_A']);
$Sales_Attribute_Test_B = explode(',', $report_data[0]['Sales_Attribute_Test_B']);
$openTextRes = $report_data[0]['open_text_res']?json_decode($report_data[0]['open_text_res'],true):array();

$hunter_data = array();
$farmer_data = array();

// DISC CALCULATIONS START
$dip_eport_data_arr = explode(",", $report_data[0]['sales_dip']);
$dip_report_total = array("D+" => 0,  "I+" => 0,  "S+" => 0,  "C+" => 0,  "D-" => 0,  "S-" => 0,  "C-" => 0,  "I-" => 0 );
$value_replacer = array("1"=> 4, "2"=> 3, "3"=> 2, "4"=> 1);
foreach($dip_eport_data_arr as $report_data_item){
    $report_data_item_content = explode("_", $report_data_item);
    // $dip_report_total[$report_data_item_content[0]]  += $report_data_item_content[1];
    $dip_report_total[$report_data_item_content[0]]  += $value_replacer[$report_data_item_content[1]];
}
/*echo "<br>";print_r($dip_report_total);
die;*/
$dip_total_D = 0; $dip_total_I = 0; $dip_total_S = 0; $dip_total_C = 0;
if($dip_report_total['D+']!= "" && $dip_report_total['D-']){
	$d1 = ($dip_report_total['D+'] / 60) * 10;
	$d2 = ($dip_report_total['D-'] / 60) * 10;
    if($d1 == $d2){
        $dip_total_D = 1;
    } else {
    	$dip_total_D = ($d1 - $d2);
    }
}

if($dip_report_total['I+']!= "" && $dip_report_total['I-']){
	$i1 = ($dip_report_total['I+'] / 60) * 10;
	$i2 = ($dip_report_total['I-'] / 60) * 10;
    if($i1 == $i2){
        $dip_total_I = 1;
    } else {
        $dip_total_I = ($i1 - $i2);
    }
}

if($dip_report_total['S+']!= "" && $dip_report_total['S-']){
	$s1 = ($dip_report_total['S+'] / 60) * 10;
	$s2 = ($dip_report_total['S-'] / 60) * 10;
    if($s1 == $s2){
        $dip_total_S = 1;
    } else {
        $dip_total_S = ($s1 - $s2);
    }
}

if($dip_report_total['C+']!= "" && $dip_report_total['C-']){
	$c1 = ($dip_report_total['C+'] / 60) * 10;
	$c2 = ($dip_report_total['C-'] / 60) * 10;
    if($c1 == $c2){
        $dip_total_C = 1;
    } else {
        $dip_total_C = ($c1 - $c2);
    }
}


$hunter_data['hunter_disc'] = $dip_total_D + $dip_total_I;
$farmer_data['farmer_disc'] = $dip_total_S + $dip_total_C;

// DISC CALCULATIONS END




// echo '<pre>';print_r($openTextRes);die;

$graph_labels = array('Flexibility','Security','Financial Reward','Dealing with conflict','Initiative','Fun','Product knowledge','Trustworthy','Resourcefullness','Enthusiasm','Confidence','Entrepreneurial instinct','Passion','Work ethic','Prior success','Curiosity','Coachability');

$graph_data = array();


$smd_score_formula = array('0'=>'1','1'=>'1','2'=>'1','3'=>'1','4'=>'1','5'=>'2','6'=>'3','7'=>'4','8'=>'5','9'=>'6','10'=>'6','11'=>'7','12'=>'7','13'=>'8','14'=>'9','15'=>'9','16'=>'10');

$smd_val = array('Enthusiasm','Resourcefullness','Security','Work ethic','Passion','Trustworthy','Product knowledge');



$smd_score = 0;


$hunter_salse_motivation = 0;
$farmer_salse_motivation = 0;

foreach ($Sales_Value_Test as $key => $value) {
	$str = explode('_', $value);
	if(in_array($str[0], $graph_labels)){
		$graph_data[$str[0]] = $smd_score_formula[$str[1]];
	}

	if(in_array($str[0], $smd_val)){
		$smd_score = $smd_score + $smd_score_formula[$str[1]];
	}

	if(in_array($str[0], array('Flexibility','Financial Reward','Initiative','Entrepreneurial instinct','Curiosity'))){
		$hunter_salse_motivation = $hunter_salse_motivation+$smd_score_formula[$str[1]];
	}

	if(in_array($str[0], array('Security','Resourcefullness','Trustworthy'))){
		$farmer_salse_motivation = $farmer_salse_motivation+$smd_score_formula[$str[1]];
	}
}

$smd_score = round($smd_score/7);

// Hunter Sales Motivation Score
$hunter_data['hunter_sm'] = ($hunter_salse_motivation/6);

// Farmer Sales Motivation Score
$farmer_data['farmer_sm'] = ($farmer_salse_motivation/3);



// LSI SCORE



$LAP_S_A_result = round(($report_data[0]['LAP_S_A']?$report_data[0]['LAP_S_A']:0)/0.2);
$LAP_S_B_result = round(($report_data[0]['LAP_S_B']?$report_data[0]['LAP_S_B']:0)/0.3);
$LAP_S_C_result = round(($report_data[0]['LAP_S_C']?$report_data[0]['LAP_S_C']:0)/0.2);
$LAP_S_D_result = round(($report_data[0]['LAP_S_D']?$report_data[0]['LAP_S_D']:0)/0.3);

$LAP_S_A = $LAP_S_A_result?round($LAP_S_A_result*0.35):0;
$LAP_S_B = $LAP_S_B_result?round($LAP_S_B_result*0.35):0;
$LAP_S_C = $LAP_S_C_result?round($LAP_S_C_result*0.30):0;
$LAP_S_D = $LAP_S_D_result?round($LAP_S_D_result*0.35):0;



$lsi = round($LAP_S_A+$LAP_S_B+$LAP_S_C);

$learning_speed_index = $score?$score:0;

// echo '<pre>';
// print_r($report_data);
//print_r($Sales_Value_Test);
//die;
$total_correct_ans = 0;

foreach ($Sales_Apptitute_Test as $key => $value) {
	if(@$sales_aptitude_qus_ans[$key] == $value){
		$total_correct_ans++;
	}
}
$sales_aptitude_score = round(($total_correct_ans/35)*10);


// SEACTION A & B
$secAB = array('1' => 'Active','2' => 'Cautious','3' => 'Excitable','4' => 'Kind','5' => 'Polite','6' => 'Sensitive','7' => 'Affable','8' => 'Charismatic','9' => 'Extroverted','10' => 'Logical','11' => 'Pragmatic','12' => 'Sincere','13' => 'Altruistic','14' => 'Charming','15' => 'Faithful','16' => 'Manipulative','17' => 'Precise','18' => 'Slapdash','19' => 'Ambitious','20' => 'Compassionate','21' => 'Funny','22' => 'Moody','23' => 'Reserved','24' => 'Talkative','25' => 'Amiable','26' => 'Conscientious','27' => 'Gregarious','28' => 'Organized','29' => 'Reticent','30' => 'Thoughtful','31' => 'Argumentative','32' => 'Considerate','33' => 'Guarded','34' => 'Passive','35' => 'Rigid','36' => 'Thoughtless','37' => 'Assertive','38' => 'Creative','39' => 'Impartial','40' => 'Perfectionist','41' => 'Self-assured','42' => 'Trustworthy','43' => 'Authoritative','44' => 'Curious','45' => 'Impatient','46' => 'Persuasive','47' => 'Self-aware','48' => 'Inventive','49' => 'Bossy','50' => 'Domineering','51' => 'Caring','52' => 'Enthusiastic','53' => 'Introverted','54' => 'Organized');


$secAB_score = 0;
$secA_relation = array('1','19','33','44','17');
$secB_relation = array('45','15','12','14','45');

$mostCorelation = array();
$leastCorelation = array();

$hunter_behaviour_attributes = 0;
$farmer_behaviour_attributes = 0;

foreach ($Sales_Attribute_Test_A as $key => $value) {
	if(in_array($value, $secA_relation)){
		$secAB_score = $secAB_score+1;
		$mostCorelation[] = $secAB[$value];
	}else{
		$mostCorelation[] = $secAB[$value];
	}

	/*
	* For : Hunter
	* Check Faithful ,Pleasent 
	* If these competencies are in his top 5, he get's an 3,33 point for each one.
	*/
	if(in_array($value, array('1','46','19'))){
		$hunter_behaviour_attributes = $hunter_behaviour_attributes+3.33;
	}

	/*
	* For : Farmer
	* Check Faithful ,Pleasent 
	* If these competencies are in his top 5, he get's an 3,33 point for each one.
	*/
	if(in_array($value, array('14','15'))){
		$farmer_behaviour_attributes = $farmer_behaviour_attributes+5;
	}

}

$hunter_data['hunter_ba'] = $hunter_behaviour_attributes;
$farmer_data['farmer_ba'] = $farmer_behaviour_attributes;

$hunter_score = number_format((float)($hunter_data['hunter_sm']*0.4)+($hunter_data['hunter_ba']*0.2)+($hunter_data['hunter_disc']*0.4), 2, '.', '');
$farmer_score = number_format((float)($farmer_data['farmer_sm']*0.4)+($farmer_data['farmer_ba']*0.2)+($farmer_data['farmer_disc']*0.4), 2, '.', '');


foreach ($Sales_Attribute_Test_B as $key => $value) {
	if(in_array($value, $secB_relation)){
		$secAB_score = $secAB_score-1;
		$leastCorelation[] = $secAB[$value];
	}else{
		$leastCorelation[] = $secAB[$value];
	}
}

$BA_score = array('5'=>10,'4'=>9,'3'=>8,'2'=>7,'1'=>6,'-1'=>5,'-2'=>4,'-3'=>3,'-4'=>2,'-5'=>1);
$secAB_score =$BA_score[$secAB_score];

/*echo $secAB_score;

echo "<pre>";
print_r( $Sales_Attribute_Test_A);
echo "<br><br>";
print_r( $Sales_Attribute_Test_B);
echo "<br><br>";
print_r( $mostCorelation);
echo "<br><br>";
print_r( $leastCorelation);

die;
*/
//echo phpinfo();die;

$uname = $userdetails[0]->full_name?$userdetails[0]->full_name:'Sales Report';//$du_name[0]->full_name;
$u_title = $rTitle?$rTitle:'Test';//$rTitle;
$u_name = $uName?$uName:'User';
$gender = 'Male';
$og_u_name = "SalesAptitude";


$testCompletedDate = $created_date?$created_date:date('Y-m-d H:i:s');

$d = explode('-', substr($testCompletedDate, 0, 10));
$testCompletedDate = ($d[2] . '/' . $d[1] . '/' . $d[0]);

$reportDate = date('d M Y',strtotime($created_date?$created_date:date('Y-m-d H:i:s')));


//require_once ('jpgraph-4.0.2/jpgraph.php');
require_once ('jpgraph-4.0.2/jpgraph_bar.php');
include 'sa_graph.php';
include 'sa_dip_graph.php';

$file_path = base_url("/images/sales_aptitude/horizontal_bar_chart.png");
$dip_file_path = base_url("/images/sales_aptitude/disc_graph.png");
//echo '<img src="'.$file_path.'" style="width:600px; height:600px;" />'; die;


require("sales_apptitute_header.php");
ob_start();

// if(isset($_GET['dev']) && $_GET['dev'] == 'on'){
// }else{
// 	include 'SALES_APPTITUDE_bkp.php';
// }
include 'SALES_APPTITUDE.php';

$include = ob_get_contents();


$_GET['req'] = "KFC";
ob_end_clean();
if(@$_GET['req'] == "KFC")
{
$html = <<< EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
body,td,th,p,li { font-family: Arial, Helvetica, sans-serif;	font-size: 12pt;  color: black;}

.name_box{ height: 340px; text-align:center;}

p {
    color: red;
    font-family: helvetica;
    font-size: 12pt;
  }

.boxtxt{
	border:1px solid black;
}
h1{ color: #3aa5de;}
.tips_img{ margin-bottom: 0px;}
</style>

<div id="main">
	{$include}
	
EOF;
}

// 
$pdf->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT,false);
// output the HTML content

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
if(!empty($uname)) {
	$rname = str_replace(' ', '_', $uname);
	$file_name=$rname."_".$d[2] . '_' . $d[1] . '_' . $d[0] .'.pdf';
    $pdf->Output($file_name, 'I');
    //$pdf->Output($file_name, 'D');
}
else
$pdf->Output('SalesAptitude.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
