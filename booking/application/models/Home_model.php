<?php
class Home_model extends CI_Model
{	
	
	public function login_check($username,$password){
		
		$queryStr = "SELECT * FROM users WHERE 
		(`email` = ".$this->db->escape($username)." OR `username` = ".$this->db->escape($username).")  AND 
		`password` = '".md5($password)."'"; 
		
		$query = $this->db->query($queryStr);
		if ($query->num_rows() > 0){ 
			$row = $query->row_array(); 
			$is_admin = 0;
			if($row['user_role'] == 'ADMIN') {
				$is_admin = 1;
			}
			return array("status"=>1,"row"=>$row,'is_admin'=>$is_admin,'user_role'=>$row['user_role'],'role_name'=>"");
		} 
	}
	
	public function consent_form_submit($post_data, $candidate_id){
		
		$this->db->where("id", $candidate_id);
		$client_details = $this->db->get("users")->row_array();
		$insert_data = array(
			"fullname"            => $post_data['fullname'],
			"candidate_id"        => $candidate_id,
			"booking_id"          => $client_details['candidate_booking_id'],
			"passport"            => $post_data['passport_no'],
			"date"                => $post_data['date'],
			"signature"           => $post_data['signature_converted'],
			"participating"       => $post_data['participating'],
			"compatibility"       => $post_data['compatibility'],
			"confidential"        => $post_data['confidential'],
			"acknowledge"         => $post_data['acknowledge'],
			"administrators"      => $post_data['administrators'],
			"declined_consent"      => $post_data['declined_consent'],
		//	"accepted_disagree"      => $post_data['agree_disagree'],
			"created_date"        => DATETIME,
			"status"              => '1',
			"is_deleted"           => 0,
		);
		
		$consent_form_res = $this->db->insert("consent_form_submit", $insert_data);
		if($consent_form_res > 0){
			return 1;
		} else {
			return 0;
		}
	}
	
	public function register_user($post_data){
		
		//  check email exists 
		$this->db->where("email",$post_data['email']);
		$check_email = $this->db->get("users");
		if($check_email->num_rows() > 0){
			return 'e2';
		}

		$random_password = generateRandomStr(10,1);
		$insert_data = array(
			"fullname"            => $post_data['fullname'],
			"user_role"           => 'CLIENT',
			"mobile"              => $post_data['cell_phone'],
			"telephone"           => $post_data['work_phone'],
			"email"               => $post_data['email'],
			"dealership_name"     => $post_data['dealership_name'],
			"town_city"           => $post_data['town_city'],
			"province"            => $post_data['province'],
			"password"            => MD5($random_password),
			"created_date"        => DATETIME,
			"is_verified"         => '0',
			"status"              => '1',
			"is_delete"           => 0,
		);
		
		$register_query = $this->db->insert("users", $insert_data);
		if($register_query > 0){
			$attachment_file = "uploads/ah_infographic.pdf";
			new_registration_mail(trim($post_data['fullname']),trim($post_data['email']),$random_password, $attachment_file);
			return 1;
		} else {
			return 0;
		}
		
	}


	public function forgot_password_submit($email_address)
	{
		$this->db->where('email', $email_address);
		$query = $this->db->get('users');
		
		if ($query->num_rows() > 0){ 
			$user_data = $query->row_array();
			if($user_data['status'] == 0 || $user_data['status'] == 2 ){
				return array("status"=>3);
			} else if($user_data['is_delete'] == 1){
				return array("status"=>2);
			} else {
				$random_password = generateRandomStr(10,1);

				$data = array(
					'password'=>md5($random_password),
				);
				$this->db->where("id",$user_data['id']);
				$query = $this->db->update("users",$data);

				$user_full_name = $user_data['firstname']. ' '. $user_data['lastname'];
				
				password_reset_mail($user_full_name, $user_data['email'], $random_password);

				return array("status"=>1,"row"=>$user_data);
			}
		}
		else	{
			return array("status"=>0);
		}
	}
	
	public function save_uploaded_doc($uploaded_doc){
		$candidate_id = current_user_id();		
		
		$update_data = array(
			'candidates_document' => json_encode($uploaded_doc),
		);
		$this->db->where("id", $candidate_id);
		$res = $this->db->update("users", $update_data);
		if($res > 0){
			return 1;
		} else {
			return 0;
		}
	}
	
	public function get_client_booking($candidate_id = NULL){
		if($candidate_id == ""){
			$candidate_id = current_user_id();
		}
		$this->db->where("us.id", $candidate_id);
		$this->db->select("us.fullname, us.client_company, us.id_number, us.mobile, us.telephone, us.email, us.username, us.password, us.phone, us.job_title, us.company, us.business_unit, us.division, us.cost_center_number, us.created_date, us.modified_date, us.is_verified, us.is_forget_password, us.is_approve, us.status, us.is_delete, us.candidate_booking_id, bk.verification, candidates_document");
		$this->db->from("users as us");
		$this->db->join('booking as bk', 'bk.id = us.candidate_booking_id','left');
		$res = $this->db->get();
		return $res->row_array();
		
	}
	
	
	public function get_verification_types($verification = NULL){
		if(trim($verification) != NULL){
			$verification = str_replace(";", ",", $verification);
			$type_query = "SELECT GROUP_CONCAT(type) as verification_type FROM verifications WHERE FIND_IN_SET(name, '$verification')";
			$type_query_res = $this->db->query($type_query);
			if($type_query_res->num_rows() > 0){
				return explode(",",$type_query_res->row_array()['verification_type']);
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
	

}
?>
