<?php 
// send mails 
function send_mail($email,$subject,$body,$attachment_file = null){
	
	$obj =& get_instance();
	$obj->load->library('email',array('mailtype'  => 'html'));
	$obj->email->from(FROM_EMAIL, APP_NAME);
	$obj->email->reply_to(FROM_EMAIL, APP_NAME);
	$obj->email->to($email); 
	$obj->email->subject($subject);
	$obj->email->message($body);	
	if($attachment_file!= ""){
		$obj->email->attach($attachment_file);
	}
	$obj->email->send(false);
	$output =  $obj->email->print_debugger();
	return $output;	
	
}

function new_registration_mail($first_name,$email,$password, $attachment_file = NULL){
	$subject = " Registration as assessment booking administrator ";

	$body = "Hi <b>$first_name</b> <br>";
	$body .= "Thank you for registering on the AssessmentHouse psychometric assessment booking portal. <br> With this portal, you will be able to book assessments as well as view previous bookings. <br>
	You will also be able to download the reports for applicants which you have already assessed. <br><br>";
	$body .= "To log in to the system, please go to <a target='_blank' href='".base_url()."'>".base_url()."</a> using the following details <br><br>";
	$body .= "<b>Username:</b> : $email  <br>";
	$body .= "<b>Password</b> : $password  <br><br>";
	$body .= "Please do not share your login information with anyone. <br>
	Any bookings made on your portal might incur costs for which your dealership will be responsible for. <br><br>";
	$body .= 'If you have any questions, please do not hesitate to contact your relevant HR Representative. <br><br>';
	$body .= "Regards, <br>
	AssessmentHouse Team <br>
	<a  target='_blank' href='mailto:assess@assessmenthouse.co.za'>assess@assessmenthouse.co.za</a> <br>";
	send_mail($email,$subject,$body, $attachment_file);
}

function new_manager_mail($first_name,$email,$password){
	$subject = " Registration as Account Manager - AssessmentHouse Booking ";

	$body = "Dear <b>$first_name</b> <br>";
	$body .= "You have been registered as an account manager on the AssessmentHouse booking portal. As an account manager, you will be able to review all the dealerships that are registered on this portal and that have requested assessments. You will also be able to review all of the assessment reports prepared for the dealerships. <br> <br> 
	Please do not share or distribute any assessment reports with anyone without the prior written consent of the candidate, the dealership and the AssessmentHouse administration team.  <br><br>";
	$body .= "Please log in using the following information: <br><br>";
	$body .= "<b>Website:</b>  <a target='_blank' href='".base_url()."'>".base_url()."</a>   <br>";
	$body .= "<b>Username:</b>  $email  <br>";
	$body .= "<b>Password</b>  $password  <br><br>";
	$body .= "Due to the sensitive nature of the information on the assessment platform, please do not share your login details with anyone. . <br><br>";
	$body .= 'Please do not hesitate to contact us if you have any questions. <br><br>';
	$body .= "Regards, <br>
	AssessmentHouse Team <br>
	<a  target='_blank' href='mailto:assess@assessmenthouse.co.za'>assess@assessmenthouse.co.za</a> <br>";
	send_mail($email,$subject,$body);
}



function password_reset_mail($fullname,$email,$password){
	$subject = APP_NAME. " request password reset mail";

	$body = "Hi <b>$fullname</b> <br>";
	$body .= "We have reset your password  <br><br>";
	$body .= "Please use the temporary password indicated below to log in to your account. In addition, do not forget to change your password once you have logged in, <br><br>";
	$body .=  "<b>Password</b> : $password  <br><br><br>";
	$body .= "Regards, <br>
	".APP_NAME_TEAM;
	send_mail($email,$subject,$body);
}

function new_booking_candidates($fullname, $email, $candiate_id, $dealer_ship, $town_city, $job_role){
	$subject = " Psychometric Assessments Invitation";	
	$body = "Dear <b>$fullname</b> <br><br>";
	$body .= "$dealer_ship $town_city requires you to complete a battery of psychometric assessments in support of your application for the $job_role vacancy. <br><br>
	In order for us to release your results, we are required to obtain your consent. Please click on the following link and read, sign and submit the consent form:<br>";
	$body .= "<b>Link</b> : <a href='".base_url('home/consent_form/'.$candiate_id)."' target='_blank' >Click Here</a> <br><br>";
	$body .= "We will contact you within the next 24 hours with further instructions and information to complete the psychometric assessments.  <br><br>";
	$body .= 'Please do not hesitate to contact us if you have any questions. <br><br>';
	$body .= "Regards, <br>
	AssessmentHouse Team <br>
	<a  target='_blank' href='mailto:booking@assessmenthouse.co.za'>booking@assessmenthouse.co.za</a> <br>";
	send_mail($email,$subject,$body);
}

function new_booking_admin_mail($client_name,$admin_mail){
	$subject = APP_NAME. " new booking received";

	$body = "Dear <b>Assessment Administrator</b> <br>";
	$body .= "You have received a new booking instruction from <b>$client_name</b> <br><br>";
	
	$body .= "Regards, <br>
	IMPERIAL Online Booking Genie
	";
	send_mail($admin_mail,$subject,$body);
}

function booking_status_change_mail($status, $email, $manager_name, $job_title){
	
	if($status == 2){
		$subject = "Assessment booking received";
		$body = "Dear <b>$manager_name</b> <br>";
		$body .= "We have received your assessment booking and will set up the requested assessments within the
		next 4 hours. You will receive another email notification as soon as the assessments are completed
		and your reports have been uploaded. <br><br>";

	} else if($status == 3){
		$subject = " Assessments request completed";
		$body = "Dear <b>$manager_name</b> <br>";
		$body .=  "Your assessment request for the $job_title position is now complete, and the candidate(s) reports have been uploaded to your account for your perusal. <br>";
		$body .= "<p style='color:red !important; font-weight:900;'><b>
		Due to the sensitive nature of these reports, please do not distribute the reports to any party without
		the prior written consent of the candidate. In addition, please do not e-mail this report to the
		candidate without providing the candidate with feedback on their results. Feedback may be provided,
		upon request, only by a licenced and duly trained psychologist/psychometrist.</b>
		</p> <br>";
	}
	
	$body .= 'Please do not hesitate to contact us if you have any questions. <br><br>';
	$body .= "Regards, <br>
	AssessmentHouse Team <br>
	<a  target='_blank' href='mailto:booking@assessmenthouse.co.za'>booking@assessmenthouse.co.za</a> <br>";
	
	send_mail($email,$subject,$body);
}


?>