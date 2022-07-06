<?php
class Test_model extends CI_Model
{
	
 	public function save_assessment_content($title, $type, $cost){
 		$this->db->where("type_name", $type);
 		$result = $this->db->get("assessments_type");
 		if($result->num_rows() > 0){
 			$data = $result->row_array();
 			$type_id = $data['id'];
 		} else {
 			$insert_data = array(
 				"type_name" => $type,
 				"status" =>  1,
 			"is_deleted" => 0,
 			);
 			$this->db->insert("assessments_type", $insert_data);
 			$type_id = $this->db->insert_id();
 		}
 		
 		$ass_data = array(
 			"name" => $title,
 			"type" => $type_id,
 			"description" => $title,
 			"cost" => $cost,
 			"status" =>  1,
 			"is_deleted" => 0,
 			"created_date" => DATETIME,
 			
 		);
 		
 		$insert_data = $this->db->insert("assessments", $ass_data);
 		
 	}
 	
 	public function save_verifications($type, $name, $description, $cost){
 			$ass_data = array(
 			"name" => $name,
 			"type" => $type,
 			"description" => $description,
 			"cost" => $cost,
 			"status" =>  1,
 			"is_deleted" => 0,
 			"created_date" => DATETIME,
 			
 		);
 		
 		$insert_data = $this->db->insert("verifications", $ass_data);
 	}
 	
 	public function save_jobs($business_unit, $job_family, $job_title, $description, $cost){
 	
 		$job_data = array(
 			"business_unit" => $business_unit,
 			"title" => $job_title,
 			"family" => $job_family,
 			"description" => $description,
 			"cost" => $cost,
 			"status" => '1',
 			"is_deleted" => '0',
 			"created_date" => DATETIME,
 		);
 		$insert_data = $this->db->insert("jobs", $job_data);	
 	}
	
}