<?php // content="text/plain; charset=utf-8"

error_reporting(E_ALL);
ini_set("display_errors", 1);

// $graph_data['Coachable'] = $graph_data['Coachability'];
// unset($graph_data['Coachability']);

$labels = array_keys($graph_data);
$score_value = array_values($graph_data);

// Create the graph. These two calls are always required
$graph = new Graph(700,700,'auto');
$graph->SetScale("textlin",0,10);
// $graph->img->SetImgFormat('jpeg');
// $graph->img->SetQuality(100);

$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->Set90AndMargin(150,40,50,40);
$graph->img->SetAngle(90);
$graph->yaxis->SetTickPositions(array(0,1,2,3,4,5,6,7,8,9,10));
$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($labels);
$graph->yaxis->HideLine(true);
$graph->yaxis->HideTicks(true,true);

// Create the bar plots
$b1plot = new BarPlot($score_value);
// Create the grouped bar plot
$gbplot = new GroupBarPlot(array($b1plot));
// ...and add it to the graPH
$graph->Add($gbplot);
$b1plot->value->Show();
$b1plot->value->SetColor('black');

$b1plot->SetColor("white");
$b1plot->SetFillColor("#357CA5");
$b1plot->SetAbsWidth(15);
//$graph->title->Set("Score");
//$graph->Stroke();die;
// Display the graph
$path=dirname(__FILE__);
$abs_path=explode('application',$path);

$file_path = $abs_path[0]. '/images/sales_aptitude/horizontal_bar_chart.png';
$graph->Stroke($file_path);

?>