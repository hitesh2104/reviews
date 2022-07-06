<?php // content="text/plain; charset=utf-8"

$data1y=array($dip_total_D,$dip_total_I,$dip_total_S,$dip_total_C);

// Create the graph. These two calls are always required
$graph = new Graph(350,400,'auto');
// $graph->SetScale("textlin");
$graph->SetScale("textlin",-10,10);
$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->yaxis->SetTickPositions(array(10,9,8,7,6,5,4,3,2,1,0,-1,-2,-3,-4,-5,-6,-7,-8,-9,-10));
$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels(array('D','I','S','C'));
$graph->yaxis->HideLine(true);
$graph->yaxis->HideTicks(true,true);
//$graph->yaxis->SetTitleMargin(40);


// $graph->title->Set('Manual scale, allow adjustment');
// $graph->title->SetFont(FF_FONT2,FS_NORMAL);

// Create the bar plots
$b1plot = new BarPlot($data1y);
// $b2plot = new BarPlot($data2y);
// $b3plot = new BarPlot($data3y);

// Create the grouped bar plot
$gbplot = new GroupBarPlot(array($b1plot));
// ...and add it to the graPH
$graph->Add($gbplot);
$b1plot->value->Show();
$b1plot->value->SetColor('black');

$b1plot->SetColor("white");
$b1plot->SetFillColor(array("#5D5E62","#61BCCE","#5D5E62","#61BCCE"));
$b1plot->SetAbsWidth(30);

// $b2plot->SetColor("white");
// $b2plot->SetFillColor("#F39C12");

// $b3plot->SetColor("white");
// $b3plot->SetFillColor("#1111cc");
$dip_path=dirname(__FILE__);
$dip_abs_path=explode('application',$dip_path);
$dip_file_path = $dip_abs_path[0]. '/images/sales_aptitude/disc_graph.png';

// Display the graph
$graph->Stroke($dip_file_path);
?>