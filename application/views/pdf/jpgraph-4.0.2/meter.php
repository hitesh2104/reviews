<?php //ini_set('display_errors', 0);
//=============================================================================
// File:	ODOEX00.PHP
// Description: Example 0 for odometer graphs
// Created:	2002-02-22
// Version:	$Id$
// 
// Comment:
// Example file for odometer graph. This examples demonstrates the simplest
// possible graph using all default values for colors, sizes etc.
//
// Copyright (C) 2002 Johan Persson. All rights reserved.
//=============================================================================
require_once ('jpgraph.php');
require_once ('jpgraph_odo.php');

//---------------------------------------------------------------------
// Create a new odometer graph (width=250, height=200 pixels)
//---------------------------------------------------------------------
$graph = new OdoGraph(250,130);
$graph->SetColor('white');
$graph->SetMarginColor('white');
$graph->SetFrame(false);

//---------------------------------------------------------------------
// Now we need to create an odometer to add to the graph.
// By default the scale will be 0 to 100
//---------------------------------------------------------------------

// Create a new odometer graph (width=250, height=200 pixels)
$graph = new OdoGraph(250,150);

//$graph->title->Set('Example with scale indicators');
$graph->caption->Set("Numeric");
$graph->caption->SetFont(FF_FONT2,FS_BOLD);
// Add drop shadow for graph
//$graph->SetShadow();

// Now we need to create an odometer to add to the graph.
// By default the scale will be 0 to 100
$odo = new Odometer();

// Add color indications
$odo->AddIndication(0,4.6,"green:0.7");
$odo->AddIndication(4.6,9.33,"yellow");
$odo->AddIndication(9.33,14,"red");

//$odo->SetCenterAreaWidth(0.45);

// Set display value for the odometer
$odo->needle->Set(5);
$odo->scale->Set(0, 14);
$odo->scale->SetTicks(2);
// Add scale labels
//$odo->label->Set("mBar");
//$odo->label->SetFont(FF_FONT2,FS_BOLD);

// Add drop shadow for needle
//$odo->needle->SetShadow();

// Add the odometer to the graph
$graph->Add($odo);

$output_file = "".time()."_meterChart.png";
// Display the graph
$graph->Stroke($output_file);
//echo	'<img border="none" alt="Logo" src="../'.$output_file.'" style="background:#069; margin:30px; ">';
//$pdf->Image($output_file);

echo	'<img border="none" alt="Logo" src="'.$output_file.'" style="background:#069; margin:30px; "><br>';
// EOF
?>