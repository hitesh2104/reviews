<?php

$inp = array(
	"Forerunners" => 5,
	"Inventors" => 4,
	"Gurus" => 2,
	"Nurturers" => 7,
	"Chiefs" => 10,
);

//  create a new canvas object (transparent)
$canvas = new Imagick();
$canvas->newImage(800, 800, new ImagickPixel('transparent'));
//$canvas->newImage(800, 800, "white");

$sd = 0;
$ed = 32.73;
$ox = 400;
$oy = 400;

foreach ($inp as $label => $value) {
	$radius = 50;
	$sw = 4;
	for ($i = 0; $i < 10; $i++) {
		$color = 'grey';
		if ($value > 0) {
			if ($i < $value) {
				$color = 'blue';
				if ($i >= 7) {
					$color = 'red';
				}

			}

		}

		image_arc($canvas, $ox - $radius,
			$oy - $radius, $ox + $radius,
			$oy + $radius, $sd,
			$ed, $color, $sw);

		$radius = $radius + $sw + 5;
		$sw = $sw + 3;

		if ($i == 9) {
			//echo $label . "\n";
			//  position 1 - convert degrees to radians and get first point on perimeter of circle
			$x1 = $radius * cos($sd / 180 * 3.1416);
			$y1 = $radius * sin($sd / 180 * 3.1416);

			//  position 2 - convert degrees to radians and get second point on perimeter of circle
			$x2 = $radius * cos($ed / 180 * 3.1416);
			$y2 = $radius * sin($ed / 180 * 3.1416);
			$x = intval(($ox + $x1 + $ox + $x2) / 2) + 20;
			$y = intval(($oy + $y1 + $oy + $y2) / 2) + 20;

			if ($x <= 400) {
				$x = $x - 140;
			}
			if ($y <= 400) {
				$y = $y - 40;
			}

			add_text($canvas, $label, $x, $y);
		}
	}

	$sd = $ed;
	$ed = $ed + 32.73;
	if ($ed > 360) {
		$ed = 360;
	}

	//break;
}

//  output the image
$canvas->setImageFormat('png');
$canvas->writeImage('11.png');
exit;

function image_arc(&$canvas, $sx, $sy, $ex, $ey, $sd, $ed, $color, $sw = 4) {

	//  draw arc on canvas
	//  $sx, $sy, $ex, $ey specify a bounding rectangle of a circle with the origin in the middle
	//  $sd, and $ed specify start and end angles in degrees
	//  $sw is Stroke Width

	$draw = new ImagickDraw();
	$draw->setFillColor(new ImagickPixel('transparent'));
	$draw->setStrokeColor($color);
	$draw->setStrokeWidth($sw);
	//echo $sx . " " . $sy  . " " . $ex . " " .$ey . " " .$sd . " " .$ed. " " . $sw . "\n";
	$draw->arc($sx, $sy, $ex, $ey, $sd + 2, $ed - 2);
	$canvas->drawImage($draw);
}

function add_text(&$canvas, $text, $x, $y, $angle = 0) {
	$draw = new ImagickDraw();
	$draw->setFillColor(new ImagickPixel('transparent'));
	$draw->setFillColor('black');
	//$draw->setFont('TimesNewRoman');
	$draw->setFontSize(16);
	$canvas->annotateImage($draw, $x, $y, $angle, $text);

}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<center>
		<img src="11.png" alt="">
	</center>
</body>
</html>