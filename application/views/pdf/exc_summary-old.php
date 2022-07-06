<!DOCTYPE html>
<html>
<head>
	
	<link href="<?= base_url() ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>css/scrolling-nav.css" rel="stylesheet">

	<style>
	<!--
		
		.containt {
			padding-top: 20px;
		    background-image: url(http://www.assessmenthouse.co.za/images/report_image/back.jpg);
			background-repeat:no-repeat;
			background-size:contain;
			background-color: #fff;
		}
		p
		{
			text-align: justify;
		}

		tbody tr:nth-child(even) td:nth-child(even){
			background-color: #e0e0e0;

		}

		tbody tr td:nth-child(odd){
			text-align: right;
			padding: 5px 10px !important;

		}
			
		table {
			border:none !important;
			border-collapse: collapse;
			}

			table td {
			border-left: 1px solid #000;
			border-right: 1px solid #000;
			border-top: none !important; 
			}

			table td:first-child {
			border-left: none;
			}

			table td:last-child {
			border-right: none;
			}

			table td:nth-child(2)
			{
				min-width: 180px;
			}
		-->
	</style>
</head>
<body>
	<div class="containt">
		<div class="container">
		<div class="row">
			<div class="col-xs-offset-8 col-xs-4">
			<img src="<?= $_SERVER['DOCUMENT_ROOT'] ?>/images/report_image/logo2.png"" class="img-responsive" alt="Image">

			<legend class="text-primary">
				<span style="text-align: center;"> <?= $post['first_name'] ?> <br> <?= $post['last_name'] ?></span>
			</legend>
			<table class="table no-border">

				<tbody>
					<tr>
						<td>AGE</td>
						<td><?= $post['age'] ?></td>
					</tr>
					<tr>
						<td>GENDER</td>
						<td><?= $post['gender'] ?></td>
					</tr>
					<tr>
						<td>HOME LANGUAGE</td>
						<td><?= $post['home_language'] ?></td>
					</tr>
					<tr>
						<td>ETHNICITY</td>
						<td><?= $post['ethnicity'] ?></td>
					</tr>
					<tr>
						<td>HIGHEST QUALIFICATION</td>
						<td><?= $post['heighest_education'] ?></td>
					</tr>
				</tbody>
			</table>
			</div>

			<h3 class="text-primary">Executive Summary</h3>
			<br><br>
			<p><h5>
				<?= $post['content'] ?>
			</h5></p>

			<div class="col-xs-offset-8 col-xs-4">
				<h3 class="text-primary">Assessments Completed</h3>
				<ul>
					<?php foreach ($post['test'] as $value) {	
					echo '<li><h5>'.$value.'</h5></li>';
					} ?>
				</ul>
			</div>
		</div>
		</div>
	</div>
</body>

    <script src="<?= base_url() ?>js/jQuery-2.1.4.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url() ?>js/bootstrap.min.js"></script>
</html>