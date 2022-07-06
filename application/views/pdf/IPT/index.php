<?php 

$uname = $du_name[0]->full_name;
$u_title = $rTitle;
$u_name = $du_name[0]->first_name;
$gender = $du_name[0]->gender;
$og_u_name = "IPT";

$doc = $score;

$testCompletedDate = $created_date;
$d = explode('-', substr($testCompletedDate, 0, 10));
$testCompletedDate = ($d[2] . '/' . $d[1] . '/' . $d[0]); 

require("r_header.php");
ob_start();

include $doc.'.php';

$include = ob_get_contents();


$_GET['req'] = "KFC";
ob_end_clean();
if(@$_GET['req'] == "KFC")
{
$html = <<< EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
body,td,th,p,li { font-family: Arial, Helvetica, sans-serif;	font-size: 12pt;  color: #555;}

.name_box{ height: 340px; text-align:center;}

p {
    color: red;
    font-family: helvetica;
    font-size: 12pt;
  }

h1{ color: #3aa5de;}
.tips_img{ margin-bottom: 0px;}
</style>

<div id="main">

{$include}
<div class="disclosure">
			<h1>Disclosure</h1>
			<br>
			<p><strong>Purpose:</strong> The purpose of this report is to indicate the test-taker’s cognitive capability using the Stratified Systems Theory (SST). This report is for the attention of the manager who requested the assessment and remains the property of AssessmentHouse. This report may not be shared with any individual or company who is not trained in psychometric testing or have been authorised through informed consent by the test-taker and supervising psychologist.  
			</p>
			<p>
			<strong>Disclaimer:</strong> Since the report contains confidential information it needs to be dealt with accordingly. Consequently this report may not be handed over to the participant. It may also not be used as evidence in a disciplinary hearing.  Should this report or the content of the report be handled or communicated incorrectly by any party within the company, AssessmentHouse cannot be held liable for any claims resulting from such action.
			</p>

		</div>
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
	$file_name=$rname."_IPT_".$d[2] . '_' . $d[1] . '_' . $d[0] .'.pdf';
    $pdf->Output($file_name, 'D');
}
else
$pdf->Output('IPT.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
