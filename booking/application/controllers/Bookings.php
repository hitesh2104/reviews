<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookings extends CI_Controller 
{
	public $sessionData;
	public function __construct(){
		parent::__construct();
		checkSession();
		$this->load->model("booking_model");
		$this->sessionData = $this->session->userdata();
		if(is_candidate()){ 
			redirect("home");
		}
	}
	
	
	public function view() {
		if(is_candidate()){
			redirect("home");
		}
		
		$data['page_title'] = "View Bookings";
		$data['active_menu'] = "options";
		$data['page_job_title'] = "View Jobs";
		$data['data_source'] = base_url('bookings/get_all_bookings');
		
		$columns[] =  array("col" => "ID",            "class" => "");
		$columns[] =  array("col" => "Date Received", "class" => "");
		if(is_admin() || is_client_manager()){
			$columns[] =  array("col" => "Dealership name",       "class" => "");
			$columns[] =  array("col" => "Town & City",       "class" => "");
			$columns[] =  array("col" => "Contact",       "class" => "");
		}
		$columns[] =  array("col" => "Job Title",       "class" => "");
		$columns[] =  array("col" => "Progress",      "class" => "");
		$columns[] =  array("col" => "Details of Booking",     "class" => "no-sort");
		
		$data['table'] = generate_table_head($columns);
		$this->load->view('include/header', $data);
		$this->load->view('booking', $data);
		$this->load->view('include/footer', $data);
	}
	
	public function get_all_bookings(){
		$output = $this->booking_model->get_all_bookings();	
		echo json_encode($output);
		die;
	}
	
	public function add(){
		if(!is_client()){
			redirect("home");
		}
		
		$data['page_title'] = "Bookings";
		$data['short_message'] = "Add Bookings";
		$data['active_menu'] = "bookings";
		$data['btnSubmitText'] = "Add";
		$data['btnCancelUrl'] = base_url("bookings/view");
		$data['form_action'] = base_url('bookings/save_booking');
		$data['redirect_url'] = base_url('bookings/view');
		$temp_jobs_data = get_job_list('html');
		$data['job_list'] = $temp_jobs_data['job_data'];
		$data['business_unit_options'] = $temp_jobs_data['business_unit_data'];
		$data['job_family_options'] = $temp_jobs_data['family_data'];
		
		$data['assessments_type_list'] = get_additional_assessments_type("html");
		
		$data['additional_assessments'] = get_additional_assessment_items();
		$data['additional_assessments_content'] = '';
		$data['assessment_table_data']= '';
		foreach($data['additional_assessments'] as $additional_assessments){
			$data['additional_assessments_content'] .= '
			<div class="checkbox assesment_check hide" data-assessmenttype="'.$additional_assessments['type'].'" >
			<label>
			<input type="checkbox" class="additional_assessments" name="Additional_assessments[]" data-cost="'.$additional_assessments['cost'].'" value="'.$additional_assessments['name'].'" >  '.$additional_assessments['name'].'
			</label>
			</div>
			';
		}

		$data['feedback'] = feedback_items();
		$data['feedback_content'] = '';
		foreach($data['feedback'] as $id => $feedback){
			$data['feedback_content'] .= '
			<div class="checkbox">
			<label>
			<input type="checkbox" id="'.$id.'" name="feedback_required[]" class="feedback_required" data-cost="'.$feedback['cost'].'" value="'.$feedback['name'].'"> '.$feedback['name'].'
			</label>
			</div>
			';
		}
		
		$data['verification_type_list'] = get_verification_type("html");
		$data['verifications_list'] = get_verifications_list("html");
		$data['verification_table_data'] = '';
		$data['verifications_content'] = '';
		foreach($data['verifications_list'] as $verifications_list){
			$data['verifications_content'] .= '
			<div class="checkbox verification_check" data-type="'. $verifications_list['type'] .'">
			<label>
			<input type="checkbox" class="verifications_list" name="verification[]"  data-cost="'.$verifications_list['cost'].'" value="'.$verifications_list['name'].'" >  '.$verifications_list['name'].'
			</label>
			</div>
			';
		}
		
		$this->load->view('include/header',$data);
		$this->load->view('add_edit_bookings',$data);
		$this->load->view('include/footer',$data);
	}
	
	public function save_booking(){
		$post_data = $this->input->post(NULL, TRUE);
		$response = $this->booking_model->save_booking($post_data);
		if($response != 0){
			$output = array("status"=>"success","message"=>"Booking saved successfully");
		} else {
			$output = array("status"=>"error","message"=>"There was some error while updating, please try again.");
		}
		echo json_encode($output);
	}
	
	public function edit($booking_id){
		$data['page_title'] = "Bookings";
		$data['short_message'] = "Edit Bookings";
		$data['active_menu'] = "bookings";
		$data['btnSubmitText'] = "Update";
		$data['btnCancelUrl'] = base_url("bookings/view");
		$data['form_action'] = base_url('bookings/update_booking/'.$booking_id);
		$data['redirect_url'] = base_url('bookings/view');
		$data['booking_data'] = $this->booking_model->get_booking_details($booking_id);
		
		$temp_jobs_data = get_job_list('html', $data['booking_data']['job_id']);
		$data['job_list'] = $temp_jobs_data['job_data'];
		$data['business_unit_options'] = $temp_jobs_data['business_unit_data'];
		$data['job_family_options'] = $temp_jobs_data['family_data'];
		
		
		$data['assessments_type_list'] = get_additional_assessments_type("html", $data['booking_data']['additional_assessments_type']);
		$get_type_arr = get_type_values();
		$data['additional_assessments'] = get_additional_assessment_items();
		$data['booking_data']['additional_assessments'] = trim($data['booking_data']['additional_assessments']);
		$saved_add_assesment = explode(";", $data['booking_data']['additional_assessments']);
		$saved_add_assesment = array_map('trim', $saved_add_assesment);
		$data['additional_assessments_content'] = '';
		$data['assessment_table_data']= '';
		foreach($data['additional_assessments'] as $additional_assessments){
			$checked = "";
			if(in_array($additional_assessments['name'], $saved_add_assesment)){
				$checked = "checked";
				$data['assessment_table_data'] .= '<tr class="'.$get_type_arr[$additional_assessments['type']].'_in_table" data-ass_type="'.$additional_assessments['name'].'">
				<td>'.$get_type_arr[$additional_assessments['type']].'</td>
				<td>'.$additional_assessments['name'].'</td>
				</tr>'; 	
			} 
			$class = "hide";
			if($data['booking_data']['additional_assessments_type'] == $additional_assessments['type']){
				$class = "";
			}
			$data['additional_assessments_content'] .= '
			<div class="checkbox assesment_check '.$class.'" data-assessmenttype="'.$additional_assessments['type'].'" >
			<label>
			<input '.$checked.' type="checkbox" class="additional_assessments" name="Additional_assessments[]"  data-cost="'.$additional_assessments['cost'].'" value="'.$additional_assessments['name'].'">  '.$additional_assessments['name'].'
			</label>
			</div>
			';
		}
		
		$data['verification_type_list'] = get_verification_type("html", $data['booking_data']['verification_type']);
		$saved_verifications = explode(";", $data['booking_data']['verification']);
		$saved_verifications = array_map('trim', $saved_verifications);
		$data['verifications_list'] = get_verifications_list("html");
		$data['verifications_content'] = '';
		$data['verification_table_data'] = '';
		foreach($data['verifications_list'] as $verifications_list){
			$checked = "";
			if(in_array($verifications_list['name'], $saved_verifications)){
				$checked = "checked";
				$data['verification_table_data'] .= '<tr class="'.$verifications_list['type'].'_in_table" data-ass_type="'.$verifications_list['name'].'" >
				<td>'.$verifications_list['type'].'</td>
				<td>'.$verifications_list['name'].'</td>
				</tr>';
			} 
			$v_class = "hide";	
			if($data['booking_data']['verification_type'] == $verifications_list['type']){
				$v_class = "";
			}
			$data['verifications_content'] .= '
			<div class="checkbox verification_check '.$v_class.'" data-type="'. $verifications_list['type'] .'">
			<label>
			<input '.$checked.' type="checkbox" class="verifications_list" name="verification[]"  data-cost="'.$verifications_list['cost'].'" value="'.$verifications_list['name'].'" >  '.$verifications_list['name'].'
			</label>
			</div>
			';
		}

		$data['feedback'] = feedback_items();
		$saved_feedback = explode(";", trim($data['booking_data']['feedback']));
		$saved_feedback = array_map('trim', $saved_feedback);
		$data['feedback_content'] = '';
		foreach($data['feedback'] as $id => $feedback){
			$checked = "";
			if(in_array($feedback['name'], $saved_feedback)){
				$checked = 'checked';
			}
			$data['feedback_content'] .= '
			<div class="checkbox">
			<label>
			<input '.$checked.' type="checkbox" id="'.$id.'" name="feedback_required[]" class="feedback_required"  data-cost="'.$feedback['cost'].'" value="'.$feedback['name'].'"> '.$feedback['name'].'
			</label>
			</div>
			';
		}


		$data['candidates'] = $this->booking_model->get_booking_candidates($data['booking_data']['id']);

		$this->load->view('include/header',$data);
		$this->load->view('add_edit_bookings',$data);
		$this->load->view('include/footer',$data);
	}

	public function update_booking($booking_id){
		$post_data = $this->input->post(NULL, TRUE);
		$response = $this->booking_model->update_booking($post_data,$booking_id);
		if($response != 0){
			$output = array("status"=>"success","message"=>"Booking updated successfully");
		} else {
			$output = array("status"=>"error","message"=>"There was some error while updating, please try again.");
		}
		echo json_encode($output);
	}

	public function details($booking_id){
		$data['page_title'] = "Bookings";
		$data['short_message'] = "View Bookings";
		$data['active_menu'] = "bookings";
		$data['btnCancelUrl'] = base_url("bookings/view");
		$data['form_action'] = base_url('bookings/update_booking/'.$booking_id);
		$data['redirect_url'] = base_url('bookings/view');
		$data['booking_data'] = $this->booking_model->get_booking_details($booking_id);
		
		$temp_jobs_data = get_job_list('html', $data['booking_data']['job_id']);
		$data['job_list'] = $temp_jobs_data['job_data'];
		$data['business_unit_options'] = $temp_jobs_data['business_unit_data'];
		$data['job_family_options'] = $temp_jobs_data['family_data'];
		
		//  additional assesment 
		$data['assessments_type_list'] = get_additional_assessments_type("html", $data['booking_data']['additional_assessments_type']);
		$data['additional_assessments'] = get_additional_assessment_items();
		$data['booking_data']['additional_assessments'] = trim($data['booking_data']['additional_assessments']);
		
		$saved_add_assesment = explode(";", $data['booking_data']['additional_assessments']);
		$saved_add_assesment = array_map('trim', $saved_add_assesment);
		$data['additional_assessments_content'] = '';
		
		$get_type_arr = get_type_values();
		$data['assessment_table_data']= '';
		foreach($data['additional_assessments'] as $additional_assessments){
			
			if(in_array($additional_assessments['name'], $saved_add_assesment)){
				$i_class = "fa fa-check-square-o custom_font_size";
				$text_class = "text-success";
				
				$data['assessment_table_data'] .= '<tr>
				<td>'.$get_type_arr[$additional_assessments['type']].'</td>
				<td>'.$additional_assessments['name'].'</td>
				</tr>'; 	
				
			} else {
				$text_class = "text-danger";
				$i_class = "fa fa-minus-square custom_font_size";
			}
			$class = "hide";
			if($data['booking_data']['additional_assessments_type'] == $additional_assessments['type']){
				$class = "";
			}
			

			$data['additional_assessments_content'] .= '
			<div class="checkbox assesment_check '.$class.'" data-assessmenttype="'.$additional_assessments['type'].'" >
			<label class="'.$text_class.' disabled">
			<i class="'.$i_class.'" ></i>  '.$additional_assessments['name'].'
			</label>
			</div>';
			
		}

		$data['feedback'] = feedback_items();
		$saved_feedback = explode(";", trim($data['booking_data']['feedback']));
		$saved_feedback = array_map('trim', $saved_feedback);
		$data['feedback_content'] = '';
		foreach($data['feedback'] as $id => $feedback){
			if(in_array($feedback['name'], $saved_feedback)){
				$i_class = "fa fa-check-square-o custom_font_size";
				$text_class = "text-success";
				
			} else {
				$text_class = "text-danger";
				$i_class = "fa fa-minus-square custom_font_size";
			}

			$data['feedback_content'] .= '
			<div class="checkbox">
			<label class="'.$text_class.' disabled">
			<i class="'.$i_class.'" ></i>  '.$feedback['name'].'
			</label>
			</div>';

		}

		$data['verification_type_list'] = get_verification_type("html", $data['booking_data']['verification_type']);
		$data['verification'] = get_verifications_list("html");
		$saved_verification = explode(";", trim($data['booking_data']['verification']));
		$saved_verification = array_map('trim', $saved_verification);
		$data['verification_content'] = '';
		$data['verification_table_data'] = '';
		foreach($data['verification'] as $id => $verification){
			if(in_array($verification['name'], $saved_verification)){
				$i_class = "fa fa-check-square-o custom_font_size";
				$text_class = "text-success";
				$data['verification_table_data'] .= '<tr>
				<td>'.$verification['type'].'</td>
				<td>'.$verification['name'].'</td>
				</tr>';
			} else {
				$text_class = "text-danger";
				$i_class = "fa fa-minus-square custom_font_size";
			}
			
			$v_class = "hide";
			if($data['booking_data']['verification_type'] == $verification['type']){
				$v_class = "";
			}
			$data['verification_content'] .= '
			<div class="checkbox verification_check '. $v_class .'" data-type="'. $verification['type'] .'">
			<label class="'.$text_class.' disabled">
			<i class="'.$i_class.'" ></i>  '.$verification['name'].'
			</label>
			</div>';
			
		}


		$data['data_source'] = base_url('users/get_all_candidates/'.$data['booking_data']['id'].'/1');


		$columns = array(
			array("col" => "id",         "class" => ""),
			array("col" => "Candidate", "class" => ""),
	/*array("col" => "ID Number", "class" => ""),
	array("col" => "Email Address", "class" => ""),
	array("col" => "Cellphone", "class" => ""),
	array("col" => "Client",      "class" => ""),
	*/
	array("col" => "Job Title",     "class" => "no-sort"),
	array("col" => "Date",     "class" => "no-sort"),
	array("col" => "Declined Consent",     "class" => "no-sort"),
	array("col" => "Report",     "class" => "no-sort"),
//			array("col" => "Action",     "class" => "no-sort"),
);
		$data['table_elements'] = generate_table_head($columns);

		$this->load->view('include/header',$data);
		$this->load->view('booking_details',$data);
		$this->load->view('include/footer',$data);
	}


	public function change_progress($status_value, $booking_id){
		if(!is_admin()){
			redirect("home");
		}
		$response = $this->booking_model->change_progress($status_value, $booking_id);
		if($response != 0){
			$output = array("status"=>"success","message"=>"Booking status changed successfully");
		} else {
			$output = array("status"=>"error","message"=>"There was some error while updating, please try again.");
		}
		echo json_encode($output);
	}

	public function test_admin_mail(){
		error_reporting(E_ALL);
		ini_set("display_errors", 1);
		new_booking_admin_mail(current_user_name(),'meenesh@mailinator.com');
	}

	public function get_candidate_consent_form($candidate_id, $cfs_id = NULL){
		$data = $this->booking_model->consent_form_detail($candidate_id, $cfs_id);
		
		
		$participating  = ($data['participating']  == 1) ? "Yes" : 'No';
		$compatibility  = ($data['compatibility']  == 1) ? "Yes" : 'No';
		$confidential   = ($data['confidential']   == 1) ? "Yes" : 'No';
		$acknowledge    = ($data['acknowledge']    == 1) ? "Yes" : 'No';
		$administrators = ($data['administrators'] == 1) ? "Yes" : 'No';
		$signature = str_replace("svg+xml", "jpeg", $data['signature']);
		
		$table_border = "background:#AAA;color: #2A3F54; border: 1px solid #ccc; font-size: 1.1em;text-align: left;padding:0.2cm";

		$html = '<!DOCTYPE html><html lang="en">';
		$html .= '<body style="position: relative;width: 21cm;height: auto;margin: 0 auto;color: #2A3F54;background: #FFFFFF;font-family: Arial, sans-serif;font-size: 14px;font-family: SourceSansPro;border: 1px #ddd solid;padding: 3px">';
		$html .= "
		<style>
		td,th {
			border: 1px solid #CCC;
			padding:0.2cm;
		}
		</style>
		";
		
		$html .= '<table width="100%" border="0" cellpadding="0" cellspacing="0">';		
		$html .= '<tr>';
		$html .= '<td width="100%" style="vertical-align:middle;border:none !important">';
		$html .= '<div style="padding:20px;float: right;">';
		$html .= '<img style="width: 220px;" alt="Company Logo" title="noImage" src="'.base_url().'assets/images/logo.png">';
		$html .= '</div>';
		$html .= '</td>';

		$html .= '<td width="50%" style="text-align:right;padding:10px;border:none !important">';

		$html .= '</td>';
		$html .= '</tr>';
		$html .= '</table>';

		$html .= "<div style='margin:1cm;font-family:Calibri, Verdana, Ariel, sans-serif;font-size:1.1em'>
		<h1>Consent Form</h1>  
		<hr>
		I hereby agree to undergo the psychometric assessment administered by the Imperial Assessment Centre. I also authorise them to reveal and discuss the results of these assessments with the management of the relevant division/department that requested the assessments. 
		<br><br>
		I understand that the results of the assessments will be used for selection and/or development purposes. I understand that any employment that may be offered to me following the assessment and interview(s) will be totally at the discretion of the company and that said employment will be totally conditional to the written acceptance of terms and conditions of employment. 
		<br><br>
		Psychometric tests are governed by the applicable legal entity that ensures validity and reliability of psychometric testing. Although all of these tests have valid and reliable norms, some of the tests are still under development/review as required from the entity governing psychometric tests.<br><br></div>";

		
		$html .= '<div style="margin:auto 1cm;font-family:Calibri, Verdana, Ariel, sans-serif;font-size:1em">';
		$html .= '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<th colspan="3" style="'.$table_border.'">I hereby acknowledge that I am voluntarily participating in the psychometric assessment. </th>';
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';
		$html .= '<tr><td colspan="3" >'.$participating.'</td></tr>';
		$html .= '</tbody>';
		$html .= '</table>';
		$html .= '</div>';
		
		$html .= '<br><br><br>';
		
		
		$html .= '<div style="margin:auto 1cm;font-family:Calibri, Verdana, Ariel, sans-serif;font-size:1em">';
		$html .= '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<th colspan="3" style="'.$table_border.'">I hereby agree to release my assessment results to the appropriate individuals to determine my compatibility and competence for performing specific work functions within the organisation. </th>';
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';
		$html .= '<tr><td colspan="3" >'.$compatibility.'</td></tr>';
		$html .= '</tbody>';
		$html .= '</table>';
		$html .= '</div>';
		
		$html .= '<br><br><br>';

		$html .= '<div style="margin:auto 1cm;font-family:Calibri, Verdana, Ariel, sans-serif;font-size:1em">';
		$html .= '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<th colspan="3" style="'.$table_border.'">I hereby agree that the results of this assessment can be used for research purposes on a strictly confidential basis. </th>';
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';
		$html .= '<tr><td colspan="3" >'.$confidential.'</td></tr>';
		$html .= '</tbody>';
		$html .= '</table>';
		$html .= '</div>';
		
		$html .= '<br><br><br>';
		
		$html .= '<div style="margin:auto 1cm;font-family:Calibri, Verdana, Ariel, sans-serif;font-size:1em">';
		$html .= '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<th colspan="3" style="'.$table_border.'">I hereby acknowledge that I am entitled to feedback, however the cost of the feedback may be at my own expense. </th>';
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';
		$html .= '<tr><td colspan="3" >'.$acknowledge.'</td></tr>';
		$html .= '</tbody>';
		$html .= '</table>';
		$html .= '</div>';
		$html .= '<br><br><br>';
		
		$html .= '<div style="margin:auto 1cm;font-family:Calibri, Verdana, Ariel, sans-serif;font-size:1em">';
		$html .= '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<th colspan="3" style="'.$table_border.'">I declare that I feel mentally and physically fit to complete the assessment to the best of my abilities. If I feel unwell during the assessment process, I will inform one of the assessment administrators. </th>';
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';
		$html .= '<tr><td colspan="3" >'.$administrators.'</td></tr>';
		$html .= '</tbody>';
		$html .= '</table>';
		$html .= '</div>';
		$html .= '<hr> <br>';
		
		$html .= '<div style="margin:auto 1cm;font-family:Calibri, Verdana, Ariel, sans-serif;font-size:1em">
		<div style="width: 35%;float: left;"><b>Full Name</b></div><div style="width: 35%;float: left;">'.$data['fullname'].'</div><br><br>
		<div style="width: 35%;float: left;"><b>ID/Passport</b></div><div style="width: 35%;float: left;">'.$data['passport'].'</div><br><br>
		<div style="width: 35%;float: left;"><b>Date</b></div><div style="width: 35%;float: left;">'.$data['date'].'</div><br><br>
		<div style="width: 35%;float: left;"><b>Signature</b></div><div class="signature_box" style="width: 35%;float: left;">
		<img src="data:'.$signature.'" alt="" width="200px" height="100px">
		</div>
		</div>';
		
		$html .= '<br/><br/><br/><br/><br/><br/>';
		
		// echo $html;die;


		include("application/third_party/plugins/mpdf/mpdf.php");
		$filename = 'Report.pdf';
		$pdf=new mPDF('c','A4','','',10,10,15,25,16,13); 		
		$pdf->SetDisplayMode('fullpage');
		//$pdf->list_indent_first_level = 0;
		$pdf->WriteHTML($html);
		$pdf->Output($filename,'D'); // FOR DOWNLOAD
		
	}

}
?>