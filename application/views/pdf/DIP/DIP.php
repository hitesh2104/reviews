<?php require("r_header.php");
ob_start();

#error_reporting(E_ALL);
#ini_set('display_errors', 1);

$doc = $score;


$uname=;

include 'reports_html/'.$doc.'.php';

$include = ob_get_contents();
$arrayOne = array("ENFJ", "ENFP", "ENTJ", "ENTP", "ESFJ", "ESFP", "ESTJ", "ESTP", "INFJ", "INFP", "INTJ", "INTP", "ISFJ", "ISFP", "ISTJ", "INTJ", "ISTP");
$arrayTwo = array("SST1", "NEW", "SST2", "SST3", "SST4", "SST5");
$arrayThree = array("C", "D", "DC", "DI", "DIC", "DIS", "DS", "DSC", "I", "IC", "IS", "ISC", "S", "SC");

if(in_array($doc, $arrayOne)){
	#$top_pic = "type_top.jpg";
	$footerPic = "report_footer_type.jpg";
}else if(in_array($doc, $arrayTwo)){
	#$top_pic = "cog_top.jpg";
	$footerPic = "report_footer_sst.jpg";
}else if(in_array($doc, $arrayThree)){
	#$top_pic = "top.jpg";
	$footerPic = "report_footer_disc.jpg";
}

ob_end_clean();
if($_GET['req'] == "KFC")
{
$html = <<< EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
body,td,th,p,li { font-family: Arial, Helvetica, sans-serif;	font-size: 40px; line-height: 5px; color: #555;}
.name_box{ height: 340px; text-align:center;}
p{ line-height: 5px;}
h1{ color: #900;}
.tips_img{ margin-bottom: 0px;}
</style>

<div id="main">
<div id="main_left">
	<img src="http://assessmenthouse.com/kfc_reports_html/images/report_logo.jpg" width="700px;">
</div>

<table width="700" align="center">
	<tr>
		<td height="100" align="center"></td>
	</tr>
</table>

<div class="name_box">
	<h1 style="color: #000;">{$uname}</h1>
</div>

<table width="700" align="center">
	<tr>
		<td height="220" align="center"></td>
	</tr>
</table>

<div id="main_left">
	<img src="http://assessmenthouse.com/kfc_reports_html/images/{$footerPic}" width="1900px;">
</div>
{$include}

EOF;
}
else
{
$html = <<< EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
body,td,th,p,li { font-family: Arial, Helvetica, sans-serif;	font-size: 40px; line-height: 5px; color: #555;}
.name_box{ height: 340px; text-align:center;}
p{ line-height: 5px;}
h1{ color: #900;}
.tips_img{ margin-bottom: 0px;}
</style>

<div id="main">
<div id="main_left">
	<img src="http://assessmenthouse.com/reports_html/images/report_logo_tradintion.jpg" width="700px;">
</div>

<table width="700" align="center">
	<tr>
		<td height="100" align="center"></td>
	</tr>
</table>

<div class="name_box">
	<h1 style="color: #000;">{$uname}</h1>
</div>

<table width="700" align="center">
	<tr>
		<td height="220" align="center"></td>
	</tr>
</table>

<div id="main_left">
	<img src="http://assessmenthouse.com/reports_html/images/{$footerPic}" width="1900px;">
</div>
{$include}

EOF;
}

// output the HTML content

$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// *******************************************************************
// HTML TIPS & TRICKS
// *******************************************************************

// REMOVE CELL PADDING
//
// $pdf->SetCellPadding(0);
// 
// This is used to remove any additional vertical space inside a 
// single cell of text.

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// REMOVE TAG TOP AND BOTTOM MARGINS
//
// $tagvs = array('p' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n' => 0)));
// $pdf->setHtmlVSpace($tagvs);
// 
// Since the CSS margin command is not yet implemented on TCPDF, you
// need to set the spacing of block tags using the following method.

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// SET LINE HEIGHT
//
// $pdf->setCellHeightRatio(1.25);
// 
// You can use the following method to fine tune the line height
// (the number is a percentage relative to font height).

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// CHANGE THE PIXEL CONVERSION RATIO
//
// $pdf->setImageScale(0.47);
// 
// This is used to adjust the conversion ratio between pixels and 
// document units. Increase the value to get smaller objects.
// Since you are using pixel unit, this method is important to set the
// right zoom factor.
// 
// Suppose that you want to print a web page larger 1024 pixels to 
// fill all the available page width.
// An A4 page is larger 210mm equivalent to 8.268 inches, if you 
// subtract 13mm (0.512") of margins for each side, the remaining 
// space is 184mm (7.244 inches).
// The default resolution for a PDF document is 300 DPI (dots per 
// inch), so you have 7.244 * 300 = 2173.2 dots (this is the maximum 
// number of points you can print at 300 DPI for the given width).
// The conversion ratio is approximatively 1024 / 2173.2 = 0.47 px/dots
// If the web page is larger 1280 pixels, on the same A4 page the 
// conversion ratio to use is 1280 / 2173.2 = 0.59 pixels/dots

// *******************************************************************

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
if(!empty($uname)) {
	$file_name=$uname.'.pdf';
    $pdf->Output($file_name, 'D');
}
else
$pdf->Output('example_061.pdf', 'I');

//============================================================+
// END OF FILE                                                
//============================================================+
