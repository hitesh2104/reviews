<?php
class Product_model extends CI_Model
{
	
	public function get_job_details($job_id){
		$this->db->where('id',$job_id);
		$query = $this->db->get('jobs');
		return $query->row_array();
	}
	
	public function get_assesments_details($assesments_id){
		$this->db->where('id',$assesments_id);
		$query = $this->db->get('assessments');
		return $query->row_array();
	}
    
    public function get_verification_details($verification_id){
        $this->db->where('id',$verification_id);
        $query = $this->db->get('verifications');
        return $query->row_array();
    }
	
	public function save_job($post_data){
		$insert_data = array(
			"title"           => $post_data['job_title'],
			//"family"          => $post_data['job_family'],
			// "description"     => $post_data['job_description'],
			"cost"            => $post_data['cost'],
			"status"          => 1,
			"created_date"    => DATETIME,
		);
		
		$job_query = $this->db->insert("jobs", $insert_data);
		if($job_query > 0){
			return 1;
		} else {
			return 0;
		}
	}	
	
	
	public function update_job($post_data, $job_id){
		$update_data = array(
			"title"           => $post_data['job_title'],
		//	"family"          => $post_data['job_family'],
		//	"description"     => $post_data['job_description'],
			"cost"            => $post_data['cost'],
			"status"          => 1,
			"modified_date"    => DATETIME,
		);
		
		$this->db->where("id", $job_id);
		$job_query = $this->db->update("jobs", $update_data);
		if($job_query > 0){
			return 1;
		} else {
			return 0;
		}
	}	
	
	public function save_assessments($post_data){
			$insert_data = array(
			"name"           => $post_data['name'],
			"type"          => $post_data['type'],
			"description"     => $post_data['description'],
			"cost"            => $post_data['cost'],
		//	"attachment_needed"  => $post_data['attachment_needed'],
			"status"          => 1,
			"created_date"    => DATETIME,
		);
		
		$assestment_query = $this->db->insert("assessments", $insert_data);
		if($assestment_query > 0){
			return 1;
		} else {
			return 0;
		}
	}	
	
	public function update_assessments($post_data, $assessments_id){
		$update_data = array(
			"name"           => $post_data['name'],
			"type"          => $post_data['type'],
			"description"     => $post_data['description'],
			"cost"            => $post_data['cost'],
			// "attachment_needed"  => $post_data['attachment_needed'],
			"status"          => 1,
			"updated_date"    => DATETIME,
		);
		
		$this->db->where("id", $assessments_id);
		$job_query = $this->db->update("assessments", $update_data);
		if($job_query > 0){
			return 1;
		} else {
			return 0;
		}
	}	
	
    public function save_verifications($post_data){
            $insert_data = array(
            "name"           => $post_data['name'],
            "type"          => $post_data['type'],
            "description"     => $post_data['description'],
            "cost"            => $post_data['cost'],
            "attachment_needed"  => $post_data['attachment_needed'],
            "status"          => 1,
            "created_date"    => DATETIME,
        );
        
        $assestment_query = $this->db->insert("verifications", $insert_data);
        if($assestment_query > 0){
            return 1;
        } else {
            return 0;
        }
    }   
    
    public function update_verifications($post_data, $verification_id){
        $update_data = array(
            "name"           => $post_data['name'],
            "type"          => $post_data['type'],
            "description"     => $post_data['description'],
            "cost"            => $post_data['cost'],
            "attachment_needed"  => $post_data['attachment_needed'],
            "status"          => 1,
            "modified_date"    => DATETIME,
        );
        
        $this->db->where("id", $verification_id);
        $job_query = $this->db->update("verifications", $update_data);
        if($job_query > 0){
            return 1;
        } else {
            return 0;
        }
    }
	
	public function get_all_jobs() {
        error_reporting(0);
        $get_data = $this->input->get(NULL, TRUE);
        $dt_table = "jobs as jb";
        $dt_col_searchable = array(true, true, true, false, false, false);
        // $dt_columns = array( 'jb.id', 'jb.title', 'jb.family', 'jb.cost', 'jb.is_deleted',  'jb.status', );
        $dt_columns = array( 'jb.id', 'jb.title', 'jb.cost', 'jb.is_deleted',  'jb.status', );
        
        //Pagination
        if(isset($get_data['iDisplayStart']) && $get_data['iDisplayLength'] != '-1') {
            $this->db->limit(intVal($get_data['iDisplayLength']), intVal($get_data['iDisplayStart']));
        }

       //Sorting
        if(isset($get_data['iSortCol_0'])) {
            for($i=0; $i<intval($get_data['iSortingCols']); $i++) {
                if($get_data['bSortable_'.intval($get_data['iSortCol_'.$i])] == "true") {
                    $sort_column = $dt_columns[intval($get_data['iSortCol_'.$i])];
                     if(strstr($sort_column, "as") !== false) {
                        $temp_sort_column = explode(" as ", $sort_column);
                        $this->db->order_by($temp_sort_column[1], ($get_data['sSortDir_'.$i] === 'asc' ? 'asc' : 'desc'));
                   } else {
                        $this->db->order_by($sort_column, ($get_data['sSortDir_'.$i] === 'asc' ? 'asc' : 'desc'));
                     
                   }
                }
            }
        } else {
            $this->db->order_by('jb.id', 'DESC');
        }
        
        if ( isset($get_data['sSearch']) && $get_data['sSearch'] != "" ) {
            for ( $i=0 ; $i<count($dt_columns) ; $i++ ) {
                if ( isset($get_data['bSearchable_'.$i]) && $get_data['bSearchable_'.$i] == "true" ) {
                    $this->db->or_like($dt_columns[$i], $get_data['sSearch'], 'both'); 
                }
            }
            
        }
        for ( $i=0 ; $i<count($dt_columns) ; $i++ ) {
            if ( isset($get_data['bSearchable_'.$i]) && $get_data['bSearchable_'.$i] == "true" && $get_data['sSearch_'.$i] != '' ) {
                $this->db->or_like($dt_columns[$i], $get_data['sSearch_'.$i], 'both'); 
            }
        }
  
        $this->db->where('jb.is_deleted', '0');
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $dt_columns)), false);
        $this->db->from($dt_table);
        $dt_result = $this->db->get() or die( 'MySQL Error: ' . $this->db->_error_number() ); 
        
        $dt_filtered_total = $this->db->query('SELECT FOUND_ROWS() as count;')->row()->count; //Calculate total number of filtered rows
        $dt_total = $this->db->count_all($dt_table);//Calculate total number of rows

         $output = array(
            "sEcho" => intval($get_data['sEcho']),
            "iTotalRecords" => $dt_total,
            "iTotalDisplayRecords" => $dt_filtered_total,
            "aaData" => array()
        );

        foreach ($dt_result->result_array() as $aRow) {
            
            $row = array();
             $row[] = '<a href="' . base_url("products/edit_jobs/" . $aRow['id']) . '" title="Edit ' . $aRow['title'] . '" >' . $aRow['id'] . '</a>';
            // $row[] = '<a href="' . base_url("products/edit_jobs/" . $aRow['id']) . '" title="Edit ' . $aRow['title'] . '" >' . $aRow['family'] . '</a>';
            $row[] = '<a href="' . base_url("products/edit_jobs/" . $aRow['id']) . '" title="Edit ' . $aRow['title'] . '" >' . $aRow['title']. '</a>';
            $row[] = 'R'.$aRow['cost'];
            
            $output['aaData'][] = $row;
        }
        return $output;
    }


	public function get_all_assessments() {
        error_reporting(0);
        $get_data = $this->input->get(NULL, TRUE);
        $dt_table = "assessments as ass";
        $dt_col_searchable = array(true, true, true, false, false, false);
        $dt_columns = array( 'ass.id', 'at.type_name', 'ass.description', 'ass.cost', 'ass.attachment_needed',  'ass.status');
        
        //Pagination
        if(isset($get_data['iDisplayStart']) && $get_data['iDisplayLength'] != '-1') {
            $this->db->limit(intVal($get_data['iDisplayLength']), intVal($get_data['iDisplayStart']));
        }

       //Sorting
        if(isset($get_data['iSortCol_0'])) {
            for($i=0; $i<intval($get_data['iSortingCols']); $i++) {
                if($get_data['bSortable_'.intval($get_data['iSortCol_'.$i])] == "true") {
                    $sort_column = $dt_columns[intval($get_data['iSortCol_'.$i])];
                     if(strstr($sort_column, "as") !== false) {
                        $temp_sort_column = explode(" as ", $sort_column);
                        $this->db->order_by($temp_sort_column[1], ($get_data['sSortDir_'.$i] === 'asc' ? 'asc' : 'desc'));
                   } else {
                        $this->db->order_by($sort_column, ($get_data['sSortDir_'.$i] === 'asc' ? 'asc' : 'desc'));
                     
                   }
                }
            }
        } else {
            $this->db->order_by('ass.id', 'DESC');
        }
        
        if ( isset($get_data['sSearch']) && $get_data['sSearch'] != "" ) {
            for ( $i=0 ; $i<count($dt_columns) ; $i++ ) {
                if ( isset($get_data['bSearchable_'.$i]) && $get_data['bSearchable_'.$i] == "true" ) {
                    $this->db->or_like($dt_columns[$i], $get_data['sSearch'], 'both'); 
                }
            }
            
        }
        for ( $i=0 ; $i<count($dt_columns) ; $i++ ) {
            if ( isset($get_data['bSearchable_'.$i]) && $get_data['bSearchable_'.$i] == "true" && $get_data['sSearch_'.$i] != '' ) {
                $this->db->or_like($dt_columns[$i], $get_data['sSearch_'.$i], 'both'); 
            }
        }
  
        $this->db->where('ass.is_deleted', '0');
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $dt_columns)), false);
        $this->db->from($dt_table);
        $this->db->join('assessments_type as at', 'at.id=ass.type', 'left');
        
        $dt_result = $this->db->get() or die( 'MySQL Error: ' . $this->db->_error_number() ); 
        
        $dt_filtered_total = $this->db->query('SELECT FOUND_ROWS() as count;')->row()->count; //Calculate total number of filtered rows
        $dt_total = $this->db->count_all($dt_table);//Calculate total number of rows

         $output = array(
            "sEcho" => intval($get_data['sEcho']),
            "iTotalRecords" => $dt_total,
            "iTotalDisplayRecords" => $dt_filtered_total,
            "aaData" => array()
        );

        foreach ($dt_result->result_array() as $aRow) {
            
            $row = array();
             $row[] = '<a href="'.base_url("products/edit_assessments/".$aRow['id']).'" title="Edit ' . $aRow['type'] . '" >' .$aRow['id']. '</a>';;
            $row[] = '<a href="'.base_url("products/edit_assessments/".$aRow['id']).'" title="Edit ' . $aRow['type_name'] . '" >' . $aRow['type_name'] . '</a>';
            $row[] = $aRow['description'];
            $row[] = 'R'.$aRow['cost'];
         //\   $row[] = ($aRow['attachment_needed'] == 1 ) ? "<span class='text-success'><b>Yes</b</span>" : "<span class='text-danger'><b>No</b></span>";
            
            $output['aaData'][] = $row;
        }
        return $output;
    }    
    
    public function get_all_verifications() {
        error_reporting(0);
        $get_data = $this->input->get(NULL, TRUE);
        $dt_table = "verifications as ver";
        $dt_col_searchable = array(true, true, true, false, false, false);
        $dt_columns = array( 'ver.id', 'ver.type', 'ver.description', 'ver.cost', 'ver.attachment_needed',  'ver.status');
        
        //Pagination
        if(isset($get_data['iDisplayStart']) && $get_data['iDisplayLength'] != '-1') {
            $this->db->limit(intVal($get_data['iDisplayLength']), intVal($get_data['iDisplayStart']));
        }

       //Sorting
        if(isset($get_data['iSortCol_0'])) {
            for($i=0; $i<intval($get_data['iSortingCols']); $i++) {
                if($get_data['bSortable_'.intval($get_data['iSortCol_'.$i])] == "true") {
                    $sort_column = $dt_columns[intval($get_data['iSortCol_'.$i])];
                     if(strstr($sort_column, "as") !== false) {
                        $temp_sort_column = explode(" as ", $sort_column);
                        $this->db->order_by($temp_sort_column[1], ($get_data['sSortDir_'.$i] === 'asc' ? 'asc' : 'desc'));
                   } else {
                        $this->db->order_by($sort_column, ($get_data['sSortDir_'.$i] === 'asc' ? 'asc' : 'desc'));
                     
                   }
                }
            }
        } else {
            $this->db->order_by('ver.id', 'DESC');
        }
        
        if ( isset($get_data['sSearch']) && $get_data['sSearch'] != "" ) {
            for ( $i=0 ; $i<count($dt_columns) ; $i++ ) {
                if ( isset($get_data['bSearchable_'.$i]) && $get_data['bSearchable_'.$i] == "true" ) {
                    $this->db->or_like($dt_columns[$i], $get_data['sSearch'], 'both'); 
                }
            }
            
        }
        for ( $i=0 ; $i<count($dt_columns) ; $i++ ) {
            if ( isset($get_data['bSearchable_'.$i]) && $get_data['bSearchable_'.$i] == "true" && $get_data['sSearch_'.$i] != '' ) {
                $this->db->or_like($dt_columns[$i], $get_data['sSearch_'.$i], 'both'); 
            }
        }
  
        $this->db->where('ver.is_deleted', '0');
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $dt_columns)), false);
        $this->db->from($dt_table);
        $dt_result = $this->db->get() or die( 'MySQL Error: ' . $this->db->_error_number() ); 
        
        $dt_filtered_total = $this->db->query('SELECT FOUND_ROWS() as count;')->row()->count; //Calculate total number of filtered rows
        $dt_total = $this->db->count_all($dt_table);//Calculate total number of rows

         $output = array(
            "sEcho" => intval($get_data['sEcho']),
            "iTotalRecords" => $dt_total,
            "iTotalDisplayRecords" => $dt_filtered_total,
            "aaData" => array()
        );

        foreach ($dt_result->result_array() as $aRow) {
            
            $row = array();
             $row[] = '<a href="'.base_url("products/edit_verifications/".$aRow['id']).'" title="Edit ' . $aRow['type'] . '" >' .$aRow['id']. '</a>';;
            $row[] = '<a href="'.base_url("products/edit_verifications/".$aRow['id']).'" title="Edit ' . $aRow['type'] . '" >' . $aRow['type'] . '</a>';
            $row[] = $aRow['description'];
            $row[] = 'R'.$aRow['cost'];
           $row[] = ($aRow['attachment_needed'] == 1 ) ? "<span class='text-success'><b>Yes</b</span>" : "<span class='text-danger'><b>No</b></span>";
            
            $output['aaData'][] = $row;
        }
        return $output;
    }    
    
	
}