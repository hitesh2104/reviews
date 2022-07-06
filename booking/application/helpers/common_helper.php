<?php 

function report_error(){
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
}

function pr($data,$die=1){
	print_r("<pre>");
	print_r($data);
	if($die==1){
		die;
	}
}
function last_query($die=0){
	print_r("<pre>");
	$ci=& get_instance();
	echo $ci->db->last_query();
	if($die==1){
		die;
	}
}


function checkSession(){
	$obj =& get_instance();
	if($obj->session->userdata('logged_in')==''){
		$returnURL = "";
		$uri_segment = $obj->uri->segment(1);
		if($uri_segment!="home"){
			$urldata = $obj->uri->segment_array();
			$urldata =  implode("/",$urldata);
			$returnURL = '?return_url='.$urldata;
		} 
		redirect("home/login".$returnURL);
	}
}


function upload_images($filename = null){
	
	$obj =& get_instance();
	$videoExts = allowed_image_ext();	  
	$name = $_FILES[$filename]['name'];
	$tmp_name = $_FILES[$filename]['tmp_name'];
	$ext = pathinfo($name,PATHINFO_EXTENSION);
	$rand = generateRandomStr();
	$renamedfile = $rand.".".$ext;
	$target_path = UPLOAD_IMAGES.$renamedfile;
	if(move_uploaded_file($tmp_name,$target_path))	{
		return $target_path;
	}
}

function upload_documents($filename = null){
	
	$obj =& get_instance();
	$name = $_FILES[$filename]['name'];
	$tmp_name = $_FILES[$filename]['tmp_name'];
	$ext = pathinfo($name,PATHINFO_EXTENSION);
	$rand = generateRandomStr();
	// $renamedfile = $rand.".".$ext;
	$renamedfile = $name;
	$target_path = UPLOAD_PDF.$renamedfile;
	if(move_uploaded_file($tmp_name,$target_path))	{
		return $target_path;
	} 
}

function allowed_video_ext(){
	return array("mp4",'3gp','avi','mov','mpeg');
	
}

function allowed_image_ext(){
	return array('jpg','jpeg','gif','bmp','png','');
}

function generateRandomStr($len = 10,$without_time = 0){
	$characters = '01234abcdefghizABCDZ0123EFGHIJKLMNOPQRSTjklmn56789opqrstuvwxyUVWXY456789';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $len; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	if($without_time == 0){
		return $randomString."-".strtotime("now");
	} else {
		return $randomString;
	}
}


function generatePass($len = 8){
	$character_set_array = array(
		array('count' => 5, 'characters' => 'abcdefghijklmnopqrstuvwxyz'),
		array('count' => 1, 'characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'),
		array('count' => 1, 'characters' => '0123456789'),
		array('count' => 1, 'characters' => PASSWORD_SPECIAL_CHARACTERS),
	);
	$temp_array = array();
	foreach ($character_set_array as $character_set) {
		for ($i = 0; $i < $character_set['count']; $i++) {
			$temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
		}
	}
	shuffle($temp_array);
	return implode('', $temp_array);
}


function cal_date_diff($date1,$date2 = null){
	 // date difference 
	$obj =& get_instance();
	$obj->load->database();
	if($date2 == NULL){
		$date2 = date("Y-m-d");
	}
	$sql_string = "SELECT DATEDIFF('$date1','$date2') AS DiffDate";
	$query_row =  $obj->db->query($sql_string)->row_array();
	$diff = $query_row['DiffDate'];
	return $diff;
	
}

function getRowCount($table,$where,$count_column){
	$obj =& get_instance();
	$obj->load->database();
	$query = $obj->db->query("SELECT COUNT($count_column) as `count_rows` FROM $table WHERE $where");
	if($query->num_rows() > 0){
		$getCount = $query->row_array();
		return $getCount['count_rows'];
	} else {
		return 0;
	}
}



function get_job_list($type='html',$selected_value=null){
	$obj =& get_instance();
	$obj->load->database();
	$query = $obj->db->query('SELECT id,title,cost,family,business_unit FROM jobs GROUP BY title');
	if($query->num_rows() > 0)	{
		$job_data = $family_data  = $business_unit_data = "";
		$temp_business_arr =  $temp_family_arr = array();
		foreach($query->result_array() as $data){
			if($type == 'html'){
				
				$selected="";
				if($selected_value == $data['id']){
					$selected = 'selected';
				}
				if(!in_array(trim($data['business_unit']), $temp_business_arr)){
					$business_unit_data.='<option value="'.$data['business_unit'].'" '.$selected.'>'.$data['business_unit'].'</option>';
					$temp_business_arr[] = trim($data['business_unit']);
					$family_data.='<option value="Finance" class="hide"  data-business="'.$data['business_unit'].'"   '.$selected.'>Finance</option>';
					$family_data.='<option value="Human capital" class="hide"  data-business="'.$data['business_unit'].'"   '.$selected.'>Human capital</option>';
				}
				if(!in_array(trim($data['family']), $temp_family_arr) && trim($data['family']) != "Finance" && trim($data['family']) != "Human capital" ){
					$family_data.='<option value="'.$data['family'].'" class="hide"  data-business="'.$data['business_unit'].'"   '.$selected.'>'.$data['family'].'</option>';
					$temp_family_arr[] = trim($data['family']);
				}
				$job_data.='<option value="'.$data['id'].'" class="hide" data-cost="'.$data['cost'].'" data-family="'.$data['family'].'"  '.$selected.'>'.$data['title'].'</option>';
			} else {
				$job_data[$data['id']] = $data['title'];
			}
			
		}
		return array(
			"job_data" => $job_data,
			"business_unit_data" => $business_unit_data,
			"family_data" => $family_data,
		);
	} else {
		return 0;
	}
}

function get_type_dd($type='html',$selected_value=null){
	$obj =& get_instance();
	$obj->load->database();
	$query = $obj->db->query('SELECT id,type_name FROM assessments_type ORDER BY type_name ASC');
	if($query->num_rows() > 0)	{
		$member = "";
		$temp_data = "";
		return generate_dd($type, $query->result_array(), 'id', 'type_name', $selected_value);
		
	} else {
		return 0;
	}
}

function generate_dd($type = 'html', $data_array, $option_key, $option_value, $selected_option){
	$temp_data = 0;
	foreach($data_array as $data){
		if($type == 'html'){
			
			$selected="";
			if($selected_option == $data[$option_key]){
				$selected = 'selected';
			}
			$temp_data.='<option value="'.$data[$option_key].'" '.$selected.'>'.$data[$option_value].'</option>';
		} else {
			$temp_data[$data[$option_key]] = $data[$option_value];
		}
		
	}
	return $temp_data;
}


function change_date_format($date,$withtime = 1){
	if($date!="" && $date!='0000-00-00 00:00:00'){
		if($withtime == 1){
			return date("d-m-Y H:i:s",strtotime($date));
		} else {
			return date("d-m-Y",strtotime($date));
		}
	} else {
		return "";
	}
}



function log_input($data,$webServiceName){
	$put_path =LOG_PATH.date("d-m-Y")."/"; 
	$filename = $webServiceName.".log";
	if (!file_exists($put_path)) {
		mkdir($put_path);
	}
	file_put_contents($put_path.$filename,json_encode($data)."\n\n",FILE_APPEND);
}

function email_log_save($html_content,$email_name){
	$put_path =LOG_PATH."emails/".date("d-m-Y").'/'; 
	$email_name = str_replace(" ", "-", $email_name);
	$filename = $put_path.$email_name.".html";
	if (!file_exists($put_path)) {
		mkdir($put_path);
	}
	file_put_contents($filename,$html_content."<br><br><br><hr><br><br><br>",FILE_APPEND);
}




function no_form_input_specified($get_post_data){
	if(!isset($get_post_data) || $get_post_data=="" || empty($get_post_data)){
		redirect("/home");
	}
}


function activeSuspendedDd( $type="html", $selectedstats = null ){
	$array = array(
		"1"=>"Active",
		"2"=>"Suspended",
	);
	$html = "";
	if($type=="html"){
		foreach($array as $key => $value){
			$selected = "";
			if($key == $selectedstats && $selectedstats!=""){
				$selected = 'selected';
			}
			$html .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
		}
		return $html;
	} else {
		return $array;
	}
}

function generate_table_head($array = ""){
	$html = "<tr>";
	foreach($array as $key => $inner_array){
		$class = ' class="'.$inner_array['class'].'"';
		$html .= '<th'.$class.'>'.$inner_array['col'].'</th>'."\n";
	}
	$html .= "</tr>";
	return $html;
}


function is_admin(){
	$obj =& get_instance();
	$user_role = $obj->session->userdata('user_role');
	if($user_role == 'ADMIN'){
		return 1;
	} else {
		return 0;
	}
}

function is_client(){
	$obj =& get_instance();
	$user_role = $obj->session->userdata('user_role');
	$added_by_admin = $obj->session->userdata('added_by_admin');
	//if($user_role == 'CLIENT' && $added_by_admin == 0){
	if($user_role == 'CLIENT' && $added_by_admin == 0){
		return 1;
	} else {
		return 0;
	}	
}

function is_client_manager(){
	$obj =& get_instance();
	$user_role = $obj->session->userdata('user_role');
	$added_by_admin = $obj->session->userdata('added_by_admin');
	if($user_role == 'CLIENT' && $added_by_admin == 1){
		return 1;
	} else {
		return 0;
	}	
}


function is_candidate(){
	$obj =& get_instance();
	$user_role = $obj->session->userdata('user_role');
	if($user_role == 'CANDIDATE'){
		return 1;
	} else {
		return 0;
	}	
}

function current_user_id(){
	$obj =& get_instance();
	$user_id = $obj->session->userdata('user_id');
	
	return $user_id;
}

function current_user_email(){
	$obj =& get_instance();
	$user_id = current_user_id();
	$obj->db->where("id",$user_id);
	$obj->db->select("id, email");
	$obj->db->from("users");
	$result = $obj->db->get();
	return $result->row()->email;
}

function current_user_name(){
	$obj =& get_instance();
	$user_id = current_user_id();
	$obj->db->where("id",$user_id);
	$obj->db->select("id, fullname");
	$obj->db->from("users");
	$result = $obj->db->get();
	return $result->row()->fullname;
}


function get_additional_assessments_type($type='html',$selected_value=null){
	$obj =& get_instance();
	$obj->load->database();
	
	$obj->db->select("id, type_name");
	$obj->db->from("assessments_type");
	$result = $obj->db->get();
	return generate_dd($type, $result->result_array(), 'id', 'type_name', $selected_value);
}

function get_type_values($type='html',$selected_value=null){
	$obj =& get_instance();
	$obj->load->database();
	
	$obj->db->select("id, type_name");
	$obj->db->from("assessments_type");
	$result = $obj->db->get();
	$temp = array();
	foreach($result->result_array() as $type){
		$temp[$type['id']] = $type['type_name'];
	}
	return $temp;	
}


function get_additional_assessment_items(){
	$obj =& get_instance();
	$obj->load->database();
	
	$obj->db->select("id, name, cost, type");
	$obj->db->from("assessments");
	$result = $obj->db->get();
	$temp = array();
	foreach($result->result_array() as $assess){
		$temp[$assess['id']] =  array("name" => $assess['name'], "cost"=> $assess['cost'], "type"=> $assess['type']);
	}
	return $temp;
}

function feedback_items(){
	return array(
		"email_report"=>       array("name" => "Email report", "cost"=>'0'), 
		"feedback_manager"=>   array("name" => "Feedback to HR/Line Manager", "cost"=>"500"), 
		"feedback_candidate"=> array("name" => "Feedback to candidate", "cost"=>"500")
	);
}

function get_verifications_list(){
	$obj =& get_instance();
	$obj->load->database();
	
	$obj->db->select("id, name, cost, type");
	$obj->db->from("verifications");
	$result = $obj->db->get();
	$temp = array();
	foreach($result->result_array() as $assess){
		$temp[$assess['id']] =  array(
			"name" => $assess['name'], 
			"cost"=> $assess['cost'], 
			"type"=> $assess['type']
		);
	}
	return $temp;
}

function get_verification_type($type='html',$selected_value=null){
	$obj =& get_instance();
	$obj->load->database();
	$obj->db->distinct();
	$obj->db->select("type");
	$obj->db->from("verifications");
	$result = $obj->db->get();
	return generate_dd($type, $result->result_array(), 'type', 'type', $selected_value);
}

function document_list(){
	return array(
		"assessment_consent_form" => "Assessment consent form" ,
		"copy_of_ids" => "Copy of ids" ,
		"verification_consent_form" => "Verification consent form" ,
		"upload_certificate_copy" => "Upload certificate copy" ,
		"upload_latest_cv" => "Upload latest cv" ,
		"copy_of_passport" => "Copy of passport" ,
		"copy_of_address" => "Copy of address" ,
		"copy_of_permanent_address" => "Copy of permanent address" ,
	);
}





function province_list( $type="html", $selectedstats = null ){
	
	$array = array(
		"Eastern Cape" => "Eastern Cape",
		"Free State" => "Free State",
		"Gauteng" => "Gauteng",
		"KwaZulu-Natal" => "KwaZulu-Natal",
		"Limpopo" => "Limpopo",
		"Mpumalanga" => "Mpumalanga",
		"North West" => "North West",
		"Northern Cape" => "Northern Cape",
		"Western Cape" => "Western Cape",
	);
	$html = "";
	if($type=="html"){
		foreach($array as $key => $value){
			$selected = "";
			if($key == $selectedstats && $selectedstats!=""){
				$selected = 'selected';
			}
			$html .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
		}
		return $html;
	} else {
		return $array;
	}
}
