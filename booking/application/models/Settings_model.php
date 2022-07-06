<?php
class Settings_model extends CI_Model
{	
	public function get_center_details($center_id){
		$this->db->select('name,description');
		$this->db->from('centers');
		$this->db->where('id', $center_id); 
		$result = $this->db->get();
		return $result->row_array();
	}

	public function update_center_details($center_id,$dataArray){
		$data = array(
			'name'=>$dataArray['center_name'],
			'description'=>$dataArray['center_description'],
			);
		$this->db->where("id",$center_id);
		$query = $this->db->update("centers",$data);
	}

	public function get_system_versions(){
		$query = $this->db->get("system_version");
		$data = array();
		foreach($query->result_array() as $version_data){
			$data[$version_data['name']] = $version_data['version'];
			if($version_data['force_update']){
				$data[$version_data['name']."_force_update"] = $version_data['force_update']; 
			}
			$data[$version_data['name']."_url"] = $version_data['app_url']; 
		}
		return $data; 
	}
	
	public function update_system_version($postData){
		$count = 0;
		$force_update_android = 0;
		$force_update_ios = 0;
		if(isset($postData['android_app_force_update']) && $postData['android_app_force_update']== 1){
			$force_update_android = 1;	
		}
		
		if(isset($postData['ios_app_force_update']) && $postData['ios_app_force_update']== 1){
			$force_update_ios = 1;
		}
		foreach($postData as $version_name => $version_value){
			$version_value = $this->db->escape($version_value);
			$extraWhere = "";
			$force_update = 0;
			$app_url = '';
			if($version_name == 'ios_app'){
				$force_update =$force_update_ios;
				$app_url = $postData['ios_app_url']; 
			}
			if($version_name == 'android_app'){
				$force_update = $force_update_android;
				$app_url = $postData['android_app_url']; 
			}
			$update_sql = "UPDATE system_version SET `version` = $version_value,`force_update` = '$force_update',app_url='$app_url'  WHERE name = '$version_name' ";
			$update_sql_res = $this->db->query($update_sql);
			if($update_sql_res > 0){
				$count++;
			}
		}
		
		if($count){
			return 1;			
		} else {
			return 0;
		}
	}
}