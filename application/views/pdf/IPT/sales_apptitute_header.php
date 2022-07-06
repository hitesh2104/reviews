<?php

require_once('config/lang/eng.php');
require_once('tcpdf.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    // public function Header() {
    //  //$this->Cell(0, 0, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    //  global $testCompletedDate;
 //        if ($this->PageNo() !== 1 && $this->PageNo() !== 4 && $this->PageNo() !== 8) {
 //            $this->Image("http://u-test.co.za/ah/images/sales_aptitude/headings.png", 0, 22, 210.4);
 //            $this->SetTextColor(255, 255, 255);
 //            $this->SetFont('helvetica', '', 8);
 //            $d = explode('-', substr($testCompletedDate, 0, 10));
 //            //$this->Cell(175, 7, ($d[2] . '/' . $d[1] . '/' . $d[0]), 0, 0, 'R');
 //            $this->Ln(22);
 //        }
    // }

    // Page footer
    public function Footer() {

        if ($this->PageNo() !== 1) {
            // $this->SetY(-20);
            // $this->SetX(160);
            // $this->SetY(-15);
            // //$this->SetTextColor(128, 128, 128);
            // $this->SetFont('helvetica', '', 10);
            // //$this->SetLineWidth(0.5);
            // //$this->SetDrawColor(128, 128, 128);
            // $this->SetFillColor(252, 252, 252);
            // //$this->Line($this->GetX() - 15, $this->GetY(), 199, $this->GetY());
            // //$this->Cell(165, 10, iconv("UTF-8", "ISO-8859-1", "©") . " AssessmentHouse ", 0, 0, 'R');
            // //$this->rect($this->GetX() - 0.75, $this->GetY(), 10, 8, 'F');
            // $this->SetTextColor(54, 127, 169);
            // $this->Cell(50, 0, "© Strategic Talent Technologies", 0, 0, 'R');
            // $this->Cell(130, 0, 'pg.'.$this->PageNo(), 0, 0, 'R');
        }
    }
}



// create new PDF document
$pdf = new MYPDF("P", "mm", "A4", true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Mitul Lakhani');
$pdf->SetTitle('Sales Reaport');
$pdf->SetSubject('Sales Reaport');
$pdf->SetKeywords('TCPDF, PDF');

// set default header data


// set header and footer fonts
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins

$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks


//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

//print
if(isset($_GET["print_pdf"])){
    $pdf->setUserRights(); 
    $pdf->IncludeJS("print();"); 
}
// add a page
if ($pdf->PageNo() !== 1) {
    $pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);
}

$pdf->AddPage();
$pdf->getAliasNbPages();
$pdf->Ln(20);
$pdf->SetMargins(25, 10, 25);
//$pdf->Image('', -1, 0, 215,300);
$pdf->Image(base_url().'images/sales_report_pages/frontpage.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->SetY(220);
$pdf->SetX(130);
$pdf->SetFont('helvetica', 'N', 22);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(188, 15, $uname);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetY(280);
$pdf->SetX(110);

$pdf->SetY(230);
$pdf->SetX(130);
$pdf->SetFont('helvetica', 'N', 22);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(188, 15, $reportDate);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetY(280);
$pdf->SetX(110);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFont('helvetica', '', 8);

$vowels = array("-");
$uname = str_replace($vowels, " ", $uname);
