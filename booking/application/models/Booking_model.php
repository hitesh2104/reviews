<?php
class Booking_model extends CI_Model
{
    
    public function get_booking_statistics(){
        $this->db->select('COUNT(*) as total_booking,
            COUNT(CASE WHEN status = 2 then 1 ELSE NULL END) as "in_progress",
            COUNT(CASE WHEN status = 3 then 1 ELSE NULL END) as "completed"', false);
        $this->db->from('booking');
        if(is_client()){
            $this->db->where("client_id", current_user_id());
        }   
        $result = $this->db->get();
        return $result->row_array(); 
    }

    public function get_booking_details($booking_id){
        $this->db->select("bk.id, bk.job_id, bk.additional_assessments, bk.verification, bk.feedback, bk.cost, bk.booking_recieved, bk.created_date, jobs.title, jobs.family, COUNT('users.id') as total_users, bk.notes, bk.total_candidates, bk.additional_assessments_type, bk.verification_type, bk.po_number ");
        $this->db->where('bk.id',$booking_id);
        $this->db->join('jobs', 'bk.job_id = jobs.id','left');
        $this->db->join('users', 'bk.id = users.candidate_booking_id','left');
        $query = $this->db->get('booking as bk');
        return $query->row_array();
    }
    
    public function get_booking_candidates($booking_id){
        $where = array(
            "candidate_booking_id"=>$booking_id,
            "user_role"=>'CANDIDATE',
        );
        $this->db->where($where);
        $res = $this->db->get("users");
        return $res->result_array();
    }


    public function get_all_bookings() {
        
        error_reporting(0);
        $get_data = $this->input->get(NULL, TRUE);
        $dt_table = "booking as bk";
        $dt_col_searchable = array(true, true, true, false, false, false);
        if(is_admin() || is_client_manager()){
            
            $dt_columns = array( 'bk.id', 'bk.created_date', 'users.dealership_name', 'users.town_city', 'users.fullname', 'jobs.title', 'bk.status as booking_status', 'bk.is_delete');
        } else {
            $dt_columns = array( 'bk.id', 'bk.created_date', 'jobs.title', 'bk.status as booking_status', 'bk.is_delete');
        }
        
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
            $this->db->order_by('bk.id', 'DESC');
        }
        
        if ( isset($get_data['sSearch']) && $get_data['sSearch'] != "" ) {
            $this->db->group_start();       
            for ( $i=0 ; $i<count($dt_columns) ; $i++ ) {
                if ( isset($get_data['bSearchable_'.$i]) && $get_data['bSearchable_'.$i] == "true" ) {
                    $search_column = $dt_columns[$i];
                    if(strstr($search_column, "as") !== false) {
                        $temp_search_colm = explode(" as ", $search_column);
                        $this->db->or_like($temp_search_colm[0], $get_data['sSearch'], 'both'); 
                        
                    } else {
                        $this->db->or_like($search_column, $get_data['sSearch'], 'both'); 
                    }
                }
            }
            $this->db->group_end();       
        }
        
        for ( $i=0 ; $i<count($dt_columns) ; $i++ ) {
            if ( isset($get_data['bSearchable_'.$i]) && $get_data['bSearchable_'.$i] == "true" && $get_data['sSearch_'.$i] != '' ) {
                $search_column = $dt_columns[$i];
                if(strstr($search_column, "as") !== false) {
                    $temp_search_colm = explode(" as ", $search_column);
                    $this->db->or_like($temp_search_colm[0], $get_data['sSearch_'.$i], 'both'); 
                } else {
                    $this->db->or_like($search_column, $get_data['sSearch_'.$i], 'both'); 
                    
                }
            }
        }
        
        $this->db->group_by('bk.id');
        $this->db->where('bk.is_delete', '0');
        if(!is_client_manager()){
            if(is_client()){
                $this->db->where('bk.client_id', current_user_id());
                
            }
        }
        
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $dt_columns)), false);
        $dt_query = $this->db->join('users', 'users.id=bk.client_id', 'left');
        $dt_query = $this->db->join('jobs', 'jobs.id=bk.job_id', 'left');
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
        
        $is_disabled = "";
        if(is_candidate() || is_client() || is_client_manager()){
            $is_disabled = "disabled";
        }

        foreach ($dt_result->result_array() as $aRow) {
            
            $row = array();
             // $row[] = '<a href="' . base_url("bookings/edit/" . $aRow['id']) . '" title="Edit ' . $aRow['id'] . '" >' . $aRow['id'] . '</a>';
            $row[] = $aRow['id'];
            $row[] = change_date_format($aRow['created_date'],1);
            if(is_admin() || is_client_manager()){
                $row[] = $aRow['dealership_name'];
                $row[] = $aRow['town_city'];
                $row[] = $aRow['fullname'];
            }
            $row[] = $aRow['title'];
            $grey = "round_button_grey";
            $red = "round_button_red";
            $yellow = "round_button_yellow";
            $green = "round_button_green";
            $disabled_edit = '';
            if($aRow['booking_status'] == 1){
                $status_class1 = $red;
                $status_class2 = $grey;
                $status_class3 = $grey;
                
            } else if($aRow['booking_status'] == 2){
                $status_class1 = $grey;
                $status_class2 = $yellow;
                $status_class3 = $grey;
                
            } else if($aRow['booking_status'] == 3){
                $status_class1 = $grey;
                $status_class2 = $grey;
                $status_class3 = $green;
                $disabled_edit = 'disabled';
            }
            
            $row[] = '
            <a href="'.base_url("bookings/change_progress/1/" . $aRow['id']).'" class="change_status  btn '.$status_class1.' btn-xs  '.$is_disabled.'"></a>
            <a href="'.base_url("bookings/change_progress/2/" . $aRow['id']).'" class="change_status  btn '.$status_class2.' btn-xs  '.$is_disabled.'"></a>
            <a href="'.base_url("bookings/change_progress/3/" . $aRow['id']).'" class="change_status  btn '.$status_class3.' btn-xs  '.$is_disabled.'"></a>
            ';
            
            $action ="";
            if(is_admin()){
                $action = '
                <a href="'. base_url("bookings/details/" . $aRow['id']) . '" class="btn btn-xs "> <b>View</b> </a> &nbsp; | &nbsp; 
                ';
                $action .= '
                <a href="'. base_url("bookings/edit/" . $aRow['id']) . '" class="btn btn-xs " '.$disabled_edit.'> <b>Edit</b> </a> 
                ';
            }
            
            if(is_client()){
                $action = '
                <a href="'. base_url("bookings/details/" . $aRow['id']) . '" class="btn btn-xs "> <b>View</b>  </a> &nbsp; | &nbsp; 
                ';
                $action .= '
                <a href="'. base_url("bookings/edit/" . $aRow['id']) . '" class="btn btn-xs " '.$disabled_edit.'> <b>Edit</b> </a> 
                ';
            }
            
            if(is_client_manager()){
                $action = '
                <a href="'. base_url("bookings/details/" . $aRow['id']) . '" class="btn btn-xs "> <b>View</b>  </a>';
            }
            
            $row[] = $action;
            
            $output['aaData'][] = $row;
        }
        return $output;
    
    }
    
    public function save_booking($post_data){
        $additional_assess = implode(";", $post_data['Additional_assessments']);
        if($additional_assess == ""){
            $additional_assess = "NULL";
        }
        $feedback_required = implode(";", $post_data['feedback_required']);    
        if($feedback_required == ""){
            $feedback_required = "NULL";
        }
        $verification = implode(";", $post_data['verification']);    
        if($verification == ""){
            $verification = "NULL";
        }
        
        $job_id = 0;
        if($post_data['jobs'] != 'other'){
            $job_id = $post_data['jobs'];
        } else {
             $job_insert_data = array(
                 "title" => $post_data['job_title_field'],
                 "description" => $post_data['job_desc_field'],
                 "cost" => 0,
                 "attached_doc" => ($post_data['uploaded_job_desc_file_path']!="") ? $post_data['uploaded_job_desc_file_path'] : "",
             );
             
             $result = $this->db->insert('jobs', $job_insert_data);
             if($result){
               $job_id = $this->db->insert_id();
             } 
        }
        
        $booking_data = array(
            'job_id'                        => $job_id,
            'client_id'                     => current_user_id(),
            'additional_assessments_type'   => ($post_data['type']) ? $post_data['type'] : '0',
            'additional_assessments'        => $additional_assess,
            'feedback'                      => $feedback_required,
            'verification_type'             => ($post_data['verification_type']) ? $post_data['verification_type'] : '0',
            'verification'                  => $verification,
            'cost'                          => $post_data['total_cost'],
            'po_number'                     => $post_data['po_number'],
            'notes'                          => $post_data['notes'],
            'total_candidates'              => $post_data['total_candidates'],
            'created_date'                  => DATETIME,
            'booking_recieved'              => '1',
            'status'                        => '1',
            'is_delete'                     => '0',
        );
        
        $booking_insert = $this->db->insert("booking", $booking_data);
        if($booking_insert > 0){
            $booking_id = $this->db->insert_id();
            // insert booking candidates
            $count_client = 0;
            foreach($post_data['candidate'] as $key => $candidate_data){
                $random_password = generateRandomStr(10,1); 
                $insert_candidate_data = array(
                    'candidate_booking_id'=> $booking_id,
                    'user_role'           =>'CANDIDATE',
                    'fullname'            => $candidate_data['name'],
                    'id_number'           => $candidate_data['id_no'],
                    'email'               => $candidate_data['email'],
                    'password'            => MD5($random_password),
                    'telephone'           => $candidate_data['cellphone'],
                    "is_verified"         => '0',
                    "status"              => '1',
                    "is_delete"           => 0,
                    'created_date'        => DATETIME,
                );
                
                $insert_user = $this->db->insert("users", $insert_candidate_data);
                if($insert_user){
                    $candidate_id = $this->db->insert_id();
                    $this->db->where("id", current_user_id());
                    $client_details = $this->db->get("users")->row_array();
                    
                    $this->db->where("id", $post_data['jobs']);
                    $job_details = $this->db->get("jobs")->row_array();
                    new_booking_candidates($candidate_data['name'], $candidate_data['email'], $candidate_id, $client_details['dealership_name'], $client_details['town_city'], $job_details['title']);
                    $count_client++;
                }
            }
            new_booking_admin_mail(current_user_name(),ADMIN_EMAIL);
            return $count_client;
        }  else {
            return 0;
        }
    }
    
    
    public function update_booking($post_data,$booking_id){
        $additional_assess = implode(";", $post_data['Additional_assessments']);
        if($additional_assess == ""){
            $additional_assess = "NULL";
        }
        
        $feedback_required = implode(";", $post_data['feedback_required']);    
        if($feedback_required == ""){
            $feedback_required = "NULL";
        }
        
        $verification = implode(";", $post_data['verification']);    
        if($verification == ""){
            $verification = "NULL";
        }
        
         $job_id = 0;
        if($post_data['jobs'] != 'other'){
            $job_id = $post_data['jobs'];
        } else {
             $job_insert_data = array(
                 "title" => $post_data['job_title_field'],
                 "description" => $post_data['job_desc_field'],
                 "cost" => 0,
                 "attached_doc" => ($post_data['uploaded_job_desc_file_path']!="") ? $post_data['uploaded_job_desc_file_path'] : "",
             );
             
             $result = $this->db->insert('jobs', $job_insert_data);
             if($result){
               $job_id = $this->db->insert_id();
             } 
        }
        
        $booking_data = array(
            'job_id'                        => $job_id,
            'additional_assessments_type'   => $post_data['type'],
            'additional_assessments'        => $additional_assess,
            'verification_type'             => $post_data['verification_type'],
            'verification'                  => $verification,
            'feedback'                      => $feedback_required,
            'po_number'                     => $post_data['po_number'],
            'total_candidates'              => $post_data['total_candidates'],
            'notes'                          => $post_data['notes'],
            'cost'                          => $post_data['total_cost'],
            'modified_date'                 => DATETIME,
        );
        $this->db->where("id", $booking_id);
        $booking_update = $this->db->update("booking", $booking_data);
        if($booking_update > 0){
         
            $count_client = 0;
            foreach($post_data['candidate'] as $key => $candidate_data){
                $random_password = generateRandomStr(10,1); 
                $insert_candidate_data = array(
                    'candidate_booking_id'=> $booking_id,
                    'user_role'           =>'CANDIDATE',
                    'fullname'            => $candidate_data['name'],
                    'id_number'           => $candidate_data['id_no'],
                    'email'               => $candidate_data['email'],
                    'telephone'           => $candidate_data['cellphone'],
                    "is_verified"         => '0',
                    "status"              => '1',
                    "is_delete"           => 0,
                    'created_date'        => DATETIME,
                );
                
                if($candidate_data['id'] != ""){
                    $this->db->where("id", $candidate_data['id']);
                    $update_user = $this->db->update("users", $insert_candidate_data);
                } else {
                    $insert_candidate_data['password'] = MD5($random_password);
                    $insert_user = $this->db->insert("users", $insert_candidate_data);
                    if($insert_user){
                      // send mail 
                      $this->db->where("id", current_user_id());
                      $client_details = $this->db->get("users")->row_array();
                      
                      $this->db->where("id", $post_data['jobs']);
                      $job_details = $this->db->get("jobs")->row_array();
                      
                      new_booking_candidates($candidate_data['name'], $candidate_data['email'], $booking_id, $candidate_data['dealership_name'], $candidate_data['town_city'], $job_details['title']);
                  }
              }
              
              
              if($insert_user || $update_user){
                $count_client++;
            }
        }
        return $count_client;
        return 1;
    } else {
        return 0;
    }
}

public function change_progress($status_value, $booking_id){
    $update_data = array(
        "status"=> $status_value
    );
    $this->db->where("id", $booking_id);
    
    $update_result = $this->db->update("booking", $update_data);
    if($update_result > 0){
        if($status_value == 2 || $status_value == 3){
         $this->db->select("client_id, job_id");
         $this->db->where('id',$booking_id);
         $booking_row = $this->db->get('booking')->row_array();
         $client_id = $booking_row['client_id'];
         
         if($client_id!=""){
           $this->db->select("fullname, email, job_title");
           $this->db->where("id", $client_id);
           $user_details =  $this->db->get("users")->row_array();
           
           $this->db->where("id", $booking_row['job_id']);
           $job_details = $this->db->get("jobs")->row_array();
           
           booking_status_change_mail($status_value, $user_details['email'], $user_details['fullname'], $job_details['title']);
       }
   }
   return 1; 
} else {
    return 0;
}

}

public function consent_form_detail($candidate_id, $cfs_id = NULL){
    $extra_where = "";
    if($cfs_id!=""){
        $extra_where = " AND cfs.id = '$cfs_id' ";
    }
    $select_query = "SELECT cfs.id as cfs_id,
    cfs.fullname, cfs.passport, cfs.`date`, cfs.signature, bk.po_number,   bk.notes, bk.cost, us.telephone, us.email, jb.title,
    cfs.participating , cfs.compatibility , cfs.confidential , cfs.acknowledge , cfs.administrators
    FROM consent_form_submit as cfs
    LEFT JOIN users as us ON us.id = cfs.candidate_id
    LEFT JOIN booking as bk ON bk.id = cfs.booking_id
    LEFT JOIN jobs as jb ON jb.id = bk.job_id
    WHERE candidate_id = '$candidate_id' $extra_where ";
    if($cfs_id!=""){
        $candidate_details = $this->db->query($select_query)->row_array();
    } else {
        $candidate_details = $this->db->query($select_query)->result_array();
    }
    return $candidate_details;
}

}