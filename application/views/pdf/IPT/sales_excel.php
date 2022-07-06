<?php

function getDIPGRaphValue($score = 1) {
        
    if ($score >= 1 && $score <= 3 ) {
        return 1;
    } elseif ($score >= 4 && $score <= 6 ) {
        return 2;
    } elseif ($score >= 7 && $score <= 9 ) {
        return 3;
    } elseif ($score >= 10 && $score <= 12 ) {
        return 4;
    } elseif ($score >= 13 && $score <= 15 ) {
        return 5;
    } elseif ($score >= 16 && $score <= 18 ) {
        return 6;
    } elseif ($score >= 19 && $score <= 21 ) {
        return 7;
    } elseif ($score >= 22 && $score <= 24 ) {
        return 8;
    } elseif ($score >= 25 && $score <= 27 ) {
        return 9;
    } elseif ($score >= 28 && $score <= 30 ) {
        return 10;
    } else {
        $score = $score* -1;
        if ($score >= 1 && $score <= 3 ) {
            return -1;
        } elseif ($score >= 4 && $score <= 6 ) {
            return -2;
        } elseif ($score >= 7 && $score <= 9 ) {
            return -3;
        } elseif ($score >= 10 && $score <= 12 ) {
            return -4;
        } elseif ($score >= 13 && $score <= 15 ) {
            return -5;
        } elseif ($score >= 16 && $score <= 18 ) {
            return -6;
        } elseif ($score >= 19 && $score <= 21 ) {
            return -7;
        } elseif ($score >= 22 && $score <= 24 ) {
            return -8;
        } elseif ($score >= 25 && $score <= 27 ) {
            return -9;
        } elseif ($score >= 28 && $score <= 30 ) {
            return -10;
        }
    }
}

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
        $scoreArr['text']   = 'Extremely Low';
        $scoreArr['color']  = getTextColor('red');
        $scoreArr['score']  = $score;
    }
    else if($score == 2){
        $scoreArr['text']   = 'Very Low';
        $scoreArr['color']  = getTextColor('red');
        $scoreArr['score']  = $score;
    }
    else if($score == 3){
        $scoreArr['text']   = 'Low';
        $scoreArr['color']  = getTextColor('red');
        $scoreArr['score']  = $score;
    }
    else if($score == 4 || $score == 5 || $score == 6){
        $scoreArr['text']   = 'Moderate';
        $scoreArr['color']  = getTextColor('yellow');
        $scoreArr['score']  = $score;
    }
    else if($score == 7 || $score == 8){
        $scoreArr['text']   = 'High';
        $scoreArr['color']  = getTextColor('green');
        $scoreArr['score']  = $score;
    }
    else if($score == 9 || $score == 10){
        $scoreArr['text']   = 'Very High';
        $scoreArr['color']  = getTextColor('green');
        $scoreArr['score']  = $score;
    }
    return $scoreArr;
}

function salesPredictionIndicator2($score=0){
    $scoreArr  = salesPredictionIndicator($score);
    if($score >= 1 && $score <= 3.99){
        $scoreArr['color']  = getTextColor('red');
    } else if($score >= 4 && $score <= 6.99){
        $scoreArr['color']  = getTextColor('orange');
    } else if($score >= 7){
        $scoreArr['color']  = getTextColor('green');
    }
    return $scoreArr;
}

$finaleRows = array();

// ini_set('memory_limit', '-1');
ini_set('memory_limit', '1000M');
ini_set('upload_max_size', '64M');
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');
ini_set('max_execution_time', '3000');
ini_set('max_input_time', '1000');
// $openTextRes = $report_data['open_text_res']?json_decode($report_data['open_text_res'],true):array();



//echo 'ddfdfdfdf<pre>';print_r($sales_excel_report);die;
$tbl_HTML = '<table width="100%" cellpadding="5" border="1"><tr>
    <td align="center"><b>First Name</b></td>
    <td align="center"><b>Last Name</b></td>
    <td align="center"><b>Sales Knowledge</b></td>
    <td align="center"><b>Behavioural attributes</b></td>
    <td align="center"><b>Motivation and Values</b></td>
    <td align="center"><b>Cognitive Agility</b></td>
    <td align="center"><b>Sales Prediction Indicator</b></td>
    <td align="center"><b>Recommendation</b></td>
    <td align="center"><b>Hunter</b></td>
    <td align="center"><b>Farmer</b></td>
</tr>';
if(isset($sales_excel_report) && !empty($sales_excel_report)){
    foreach ($sales_excel_report as $key => $report_data) {
        $sales_aptitude_qus_ans = array('0' => '1','1' => '2','2' => '4','3' => '1','4' => '4','5' => '4','6' => '4','7' => '2','8' => '3','9' => '1','10' => '1','11' => '4','12' => '4','13' => '1','14' => '4','15' => '3','16' => '3','17' => '3','18' => '3','19' => '3','20' => '2','21' => '4','22' => '1','23' => '4','24' => '2','25' => '1','26' => '2','27' => '2','28' => '1','29' => '4','30' => '1','31' => '3','32' => '1','33' => '4','34' => '2');

        $Sales_Apptitute_Test = explode(',', $report_data['Sales_Apptitute_Test']);
        $Sales_Value_Test = explode(',', $report_data['Sales_Value_Test']);
        $Sales_Attribute_Test_A = explode(',', $report_data['Sales_Attribute_Test_A']);
        $Sales_Attribute_Test_B = explode(',', $report_data['Sales_Attribute_Test_B']);
        $openTextRes = $report_data['open_text_res']?json_decode($report_data['open_text_res'],true):array();

        $hunter_data = array();
        $farmer_data = array();

        // DISC CALCULATIONS START
        $dip_eport_data_arr = explode(",", $report_data['sales_dip']);
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
            $d1 = ($dip_report_total['D+']);
            $d2 = ($dip_report_total['D-']);
            if($d1 == $d2){
                $dip_total_D = 1;
            } else {
                $d_total = ($d1 - $d2);
                $dip_total_D = getDIPGRaphValue($d_total);
            }
        }

        if($dip_report_total['I+']!= "" && $dip_report_total['I-']){
            $i1 = ($dip_report_total['I+']);
            $i2 = ($dip_report_total['I-']);
            if($i1 == $i2){
                $dip_total_I = 1;
            } else {
                $I_total = ($i1 - $i2);
                $dip_total_I = getDIPGRaphValue($I_total);
            }
        }

        if($dip_report_total['S+']!= "" && $dip_report_total['S-']){
            $s1 = ($dip_report_total['S+']);
            $s2 = ($dip_report_total['S-']);
            if($s1 == $s2){
                $dip_total_S = 1;
            } else {
                $s_total = ($s1 - $s2);
                $dip_total_S = getDIPGRaphValue($s_total);
            }
        }

        if($dip_report_total['C+']!= "" && $dip_report_total['C-']){
            $c1 = ($dip_report_total['C+']);
            $c2 = ($dip_report_total['C-']);
            if($c1 == $c2){
                $dip_total_C = 1;
            } else {
                $c_total = ($c1 - $c2);
                $dip_total_C = getDIPGRaphValue($c_total);
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
                if($str[0] == 'Coachability'){
                    $graph_data['Coachable'] = $smd_score_formula[$str[1]];
                }else{
                    $graph_data[$str[0]] = $smd_score_formula[$str[1]];
                }
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



        $LAP_S_A_result = round(($report_data['LAP_S_A']?$report_data['LAP_S_A']:0)/0.2);
        $LAP_S_B_result = round(($report_data['LAP_S_B']?$report_data['LAP_S_B']:0)/0.3);
        $LAP_S_C_result = round(($report_data['LAP_S_C']?$report_data['LAP_S_C']:0)/0.2);
        $LAP_S_D_result = round(($report_data['LAP_S_D']?$report_data['LAP_S_D']:0)/0.3);

        $LAP_S_A = $LAP_S_A_result?round($LAP_S_A_result*0.35):0;
        $LAP_S_B = $LAP_S_B_result?round($LAP_S_B_result*0.35):0;
        $LAP_S_C = $LAP_S_C_result?round($LAP_S_C_result*0.30):0;
        $LAP_S_D = $LAP_S_D_result?round($LAP_S_D_result*0.35):0;



        $lsi = round($LAP_S_A+$LAP_S_B+$LAP_S_C);


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
        $secA_relation = array('1','19','32','46','42','15');
        $secB_relation = array('6','2','22','31','45');

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

        $BA_score = array('5'=>10,'4'=>9,'3'=>8,'2'=>7,'1'=>6,'0'=>5, '-1'=>5,'-2'=>4,'-3'=>3,'-4'=>2,'-5'=>1);
        $secAB_score =$BA_score[$secAB_score];


        $salesKnowledge = salesPredictionIndicator2($sales_aptitude_score);
        $behaviourAttribute = salesPredictionIndicator2($secAB_score);
        $motivationAndValues = salesPredictionIndicator2($smd_score);
        $learningSpeedInd = salesPredictionIndicator2($lsi);
        $spi_scr = round(($salesKnowledge['score']+$behaviourAttribute['score']+$motivationAndValues['score']+$learningSpeedInd['score'])/4);
        $salesPredInd = salesPredictionIndicator2($spi_scr);

        $hunterScore = '';
        $farmerScore = '';


        $uname = $report_data['first_name'].' '.$report_data['last_name'];
        $hunter_farmer = array(
            '1'=> array('hunter'=>'hunter_novice.png','text'=>$uname.' Sales Pi score is below the average range. He/she might find sales related roles very challenging and might not perform as well as required. Based on these results, '.$uname.' is not recommended for this position.','farmer'=>'farmer_novice.png'),
            '2'=> array('hunter'=>'hunter_standard.png','text'=>$uname.' Sales Pi score is within the average range. He/she should perform fairly well in sales related roles, although at times might find it challenging to perform as well as required. Based on these results, '.$uname.' is recommended with caution for this position.','farmer'=>'farmer_standard.png'),
            '3'=> array('hunter'=>'hunter_advanced.png','text'=>$uname.' Sales Pi score is above average. He/she should perform well in sales related roles. Based on these results, '.$uname.' is recommended for this position.','farmer'=>'farmer_advanced.png'),
            '4'=> array('hunter'=>'hunter_expert.png','text'=>$uname.' Sales Pi score is within the enhanced range. He/she should perform extremely well in sales. '.$uname.' is highly recommended for this position.','farmer'=>'farmer_expert.png')
        );

        if($hunter_score <= 3.99){
            $hunterScore = 'Novice';
            $hunterText = $hunter_farmer[1]['text'];
        }else if($hunter_score > 3.99 && $hunter_score <= 4.99){
            $hunterScore = 'Standard';
            $hunterText = $hunter_farmer[2]['text'];
        }else if($hunter_score > 4.99 && $hunter_score <= 6.99){
            $hunterScore = 'Advance';
            $hunterText = $hunter_farmer[3]['text'];
        }else if($hunter_score > 6.99 && $hunter_score <= 10){
            $hunterScore = 'Expert';
            $hunterText = $hunter_farmer[4]['text'];
        }


        if($farmer_score <= 3.99){
            $farmerScore = 'Novice';
            $farmerText = $hunter_farmer[1]['text'];
        }else if($farmer_score > 3.99 && $farmer_score <= 4.99){
            $farmerScore = 'Standard';
            $farmerText = $hunter_farmer[2]['text'];
        }else if($farmer_score > 4.99 && $farmer_score <= 6.99){
            $farmerScore = 'Advance';
            $farmerText = $hunter_farmer[3]['text'];
        }else if($farmer_score > 6.99 && $farmer_score <= 10){
            $farmerScore = 'Expert';
            $farmerText = $hunter_farmer[4]['text'];
        }


        $RecommendationText = $hunterText;
        if($hunter_score<$farmer_score){
            $RecommendationText = $farmerText;
        }


        
        $finaleRows[] = array(
                            'fname'=>$report_data['first_name'],
                            'lname'=>$report_data['last_name'],
                            'salesKnowledge'=>$salesKnowledge['score'],
                            'behaviourAttribute'=>$behaviourAttribute['score'],
                            'motivationAndValues'=>$motivationAndValues['score'],
                            'learningSpeedInd'=>$learningSpeedInd['score'],
                            'salesPredInd'=>$salesPredInd['score'],
                            'recommended'=>$RecommendationText,
                            'hunter_score'=>$hunterScore,
                            'farmer_score'=>$farmerScore,
                        );
    }

    function array_sort($array, $on, $order=SORT_ASC){
        $new_array = array();
        $sortable_array = array();
        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }
        return $new_array;
    }
    $trtdArr = array_sort($finaleRows,'salesPredInd',SORT_DESC);

    foreach ($trtdArr as $key => $value) {
        $tbl_HTML .='<tr>
                        <td style="vertical-align:middle" align="center">'.$value['fname'].'</td>
                        <td style="vertical-align:middle" align="center">'.$value['lname'].'</td>
                        <td style="vertical-align:middle" align="center">'.$value['salesKnowledge'].'</td>
                        <td style="vertical-align:middle" align="center">'.$value['behaviourAttribute'].'</td>
                        <td style="vertical-align:middle" align="center">'.$value['motivationAndValues'].'</td>
                        <td style="vertical-align:middle" align="center">'.$value['learningSpeedInd'].'</td>
                        <td style="vertical-align:middle" align="center">'.$value['salesPredInd'].'</td>
                        <td style="vertical-align:middle" align="center">'.$value['recommended'].'</td>
                        <td style="vertical-align:middle" align="center">'.$value['hunter_score'].'</td>
                        <td style="vertical-align:middle" align="center">'.$value['farmer_score'].'</td>
                    </tr>';
    }

}else{
    $tbl_HTML .= '<tr><td colspan="10" align="center">No Test Completed Yet!</td></tr>';
}


$tbl_HTML .='</table>';


$filename = "Project_Sales_Report_" . date('Ymd') . ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
echo $tbl_HTML;

?>