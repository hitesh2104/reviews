<ol class="breadcrumb bc-3" >
	<li>
		<a href="javascript:;"><i class="fa fa-home"></i>Home</a>
	</li>
</ol>

<div class="row">
	<?php 
	if(is_admin() || is_client() || is_client_manager()){ ?>
	<div class="col-sm-4 col-xs-6">
		
		<div class="tile-stats tile-red">
			<div class="icon"><i class="entypo-plus-squared"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $booking_statistics['total_booking'] ?>" data-postfix="" data-duration="1500" data-delay="0">0</div>
			
			<h3>Total Bookings </h3>
		</div>
		
	</div>
	
	<div class="col-sm-4 col-xs-6">
		
		<div class="tile-stats tile-aqua">
			<div class="icon"><i class="entypo-clock"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $booking_statistics['in_progress'] ?>" data-postfix="" data-duration="1500" data-delay="1200">0</div>
			
			<h3>Bookings in Progress</h3>
		</div>
		
	</div>
	
	<div class="col-sm-4 col-xs-6">
		
		<div class="tile-stats tile-green">
			<div class="icon"><i class="entypo-check"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $booking_statistics['completed'] ?>" data-postfix="" data-duration="1500" data-delay="600">0</div>
			
			<h3>Bookings completed</h3>
		</div>
		
	</div>
	
	
	<?php } ?>
	
	<?php if(is_candidate()){ ?>
	<div class="main-content">
		<div class="row">
			<div class="panel panel-default panel-shadow" data-collapsed="0">
		<div class="panel-heading">
			<div class="panel-title">Welcome</div>
		</div>
		
		<div class="panel-body">
			
			<p>Dear <b><?php echo $this->session->userdata("full_name");   ?></b>, <br>
			Welcome to the IMPERIAL Psychometric Assessments Booking Portal.  <br><br>

				You have been registered as a candidate to complete a battery of psychometric assessments in support of your recent job application within the IMPERIAL Group. To ensure we have the correct information, please go to the “Edit Profile” menu and update all your details. Please ensure your email address, ID number and contact details are correct.   <br><br>

				Please also go to the “Documents” menu and upload any documents requested (if any). Without these documents, we will not be allowed to send you the psychometric assessments. <br><br>

				You will be contacted by the IMPERIAL Assessment Centre within the next 24 hours with further instructions and information regarding the psychometric assessments. If you are only required to complete online assessments, the links with instructions will be emailed directly to you. If you are required to attend a testing session at our offices, we will contact you with possible dates. <br><br>
				
				
				If you have any questions or queries, please do not hesitate to contact us. <br><br>

				Kind regards, <br>
				Imperial Assessments<br>
				<a href="assessment1@ih.co.za">assessment1@ih.co.za</a></p>
				
			</div>
			
		</div>
		</div>
	</div>
		

		<?php } ?>
		
	</div>