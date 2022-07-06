<?php
class User_model extends CI_Model
{
	public function get_user($user_id){
		$this->db->where('id',$user_id);
		$query = $this->db->get('users');
		return $query->row_array();
	}
	
	public function save_report($post_data, $client_id){
        $json_encoded_files = json_encode($post_data['files']);
        $data = array(
            "candidates_reports"=> $json_encoded_files
        );
        $this->db->where("id", $client_id);
        $res = $this->db->update("users", $data);
        if($res){
            $output = array('status'=>'success','message'=>"Report Uploaded",'error_code'=>400);
        } else {
            $output = array('status'=>'error','message'=>system_messages()['try_again_later'],'error_code'=>400);
        }
        
        echo json_encode( $output );
    }
    
    public function change_password($postData='',$user_id){
      $get_admin_user = $this->get_user($user_id);
      if($get_admin_user['password'] == md5($postData['current_password'])){
         $data= array(
            'password'=>md5($postData['reenter_password'])
        );
         $this->db->where("`id` = '$user_id' ");
         $query = $this->db->update('users',$data);
         if($query > 0){
            $output = array('status'=>'success','message'=>"Your Password updated",'error_code'=>400);
        } else {
            $output = array('status'=>'error','message'=>system_messages()['try_again_later'],'error_code'=>400);
        }
    } else {
     $output = array('status'=>'error','message'=>"You have entered incorrect current password",'error_code'=>100);
 }
 echo json_encode( $output );

}

public function manager_add($post_data){
    report_error();
    $this->db->where("email",$post_data['email']);
    $check_email = $this->db->get("users");
    if($check_email->num_rows() > 0){
        $output = array('status'=>'error','message'=>"Entered email address already exists, please try with a different email.",'error_code'=>400);
        return json_encode( $output );
    }
    $random_password = generateRandomStr(10,1);
    $insert_data = array(
        "fullname"            => $post_data['fullname'],
        "user_role"           => 'CLIENT',
        //  "id_number"           => $post_data['id_number'],
        "mobile"              => $post_data['cell_phone'],
        "telephone"           => $post_data['work_phone'],
        "email"               => $post_data['email'],
       /* "dealership_name"     => $post_data['dealership_name'],
       "town_city"           => $post_data['town_city'],*/
       "province"            => $post_data['province'],
       "password"            => MD5($random_password),
        //"job_title"           => $post_data['jobtitle'],
        //"company"             => $post_data['company'],
        //"position"             => $post_data['position'],
        //"business_unit"       => $post_data['business_unit'],
        //"division"            => $post_data['division'],
        // "cost_center_number"  => $post_data['cost_center_number'],
       "created_date"        => DATETIME,
       "is_verified"         => '0',
       "status"              => '1',
       "is_delete"           => 0,
       "added_by_admin"      => '1',
   );
    
    $register_query = $this->db->insert("users", $insert_data);
    if($register_query > 0){
        new_manager_mail(trim($post_data['fullname']),trim($post_data['email']),$random_password);
        $output = array('status'=>'success','message'=>"Manager Added",'error_code'=>400);
    } else {
        $output = array('status'=>'error','message'=>system_messages()['try_again_later'],'error_code'=>400);
    }
    return json_encode( $output );
    
} 

public function update_user($post_data){
    $logged_in_id = current_user_id();
    
        //  check email exists 
    $this->db->where(array("email"=>$post_data['email'], "id!=" => $logged_in_id));
    $check_email = $this->db->get("users");
    if($check_email->num_rows() > 0){
        return 'e2';
    }
    
        //  check mobile number exists
    $this->db->where(array("mobile"=>$post_data['cell_phone'], "id!=" => $logged_in_id));
    $check_mobile = $this->db->get("users");
    if($check_mobile->num_rows() > 0){
        return 'e3';
    }
    
    $update_data = array(
        "fullname"            => $post_data['fullname'],
        "id_number"           => $post_data['id_number'],
        "mobile"              => $post_data['cell_phone'],
        "telephone"           => $post_data['telephone'],
        "email"               => $post_data['email'],
        /* "position"           => $post_data['position'],
        "job_title"           => $post_data['job_title'],
        "company"             => $post_data['company'], */
        "modified_date"       => DATETIME
    );
    
    $this->db->where("id", $logged_in_id);
    $query = $this->db->update('users',$update_data);
    if($query > 0){
            //  update session user name
        $this->session->set_userdata('full_name', $post_data['fullname']);
        $output = array('status'=>'success','message'=>"Profile Updated",'error_code'=>400);
    } else {
        $output = array('status'=>'error','message'=>system_messages()['try_again_later'],'error_code'=>400);
    }
    return json_encode( $output );
}

public function get_all_members() {
        //report_error();
    error_reporting(0);
    $get_data = $this->input->get(NULL, TRUE);
    $dt_table = "users as us";
    $dt_col_searchable = array(true, true, true, true, true, true, false, false, false, true, false, false);
    $dt_columns = array(
        'us.dealership_name',
        'us.town_city',
        'us.fullname',
        'us.email',
        'us.mobile',
        'us.job_title',
        "sum(CASE WHEN bk.status = '2' THEN 1 ELSE 0 END) as total_in_progress",
        "sum(CASE WHEN bk.status = '3' THEN 1 ELSE 0 END) as total_completed",
        "sum(bk.cost) as total_cost",
        'us.company',
        'us.is_delete',
        'us.status',
        'us.id'
    );
    
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
        $this->db->order_by('us.id', 'DESC');
    }
    
    if ( isset($get_data['sSearch']) && $get_data['sSearch'] != "" ) {
     
        for ( $i=0 ; $i<count($dt_columns) ; $i++ ) {
            if ( isset($get_data['bSearchable_'.$i]) && $get_data['bSearchable_'.$i] == "true" ) {
                $search_column = $dt_columns[$i];
                if($dt_col_searchable[$i] == true){
                    if(strstr($search_column, "as") !== false) {
                        $temp_search_colm = explode(" as ", $search_column);
                        $this->db->or_like($temp_search_colm[0], $get_data['sSearch'], 'both'); 
                        
                    } else {
                        $this->db->or_like($search_column, $get_data['sSearch'], 'both'); 
                    }
                }
            }
        }
        
    }
    
    for ( $i=0 ; $i<count($dt_columns) ; $i++ ) {
        if ( isset($get_data['bSearchable_'.$i]) && $get_data['bSearchable_'.$i] == "true" && $get_data['sSearch_'.$i] != '' ) {
            $search_column = $dt_columns[$i];
            if($dt_col_searchable[$i] == true){
                if(strstr($search_column, "as") !== false) {
                    $temp_search_colm = explode(" as ", $search_column);
                    $this->db->or_like($temp_search_colm[0], $get_data['sSearch_'.$i], 'both'); 
                } else {
                    $this->db->or_like($search_column, $get_data['sSearch_'.$i], 'both'); 
                }
            }
        }
    }
    
    $this->db->group_by('us.id');
    $this->db->where('us.user_role', 'CLIENT');
    $this->db->where('us.is_delete', '0');
    $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $dt_columns)), false);
    $this->db->from($dt_table);
    $this->db->join('booking as bk', 'bk.client_id = us.id','left');
    $dt_result = $this->db->get() or die( 'MySQL Error: ' . $this->db->_error_number() ); 
    // last_query(); die;
        $dt_filtered_total = $this->db->query('SELECT FOUND_ROWS() as count;')->row()->count; //Calculate total number of filtered rows
        $dt_total = $this->db->count_all($dt_table);//Calculate total number of rows

        $output = array(
            "sEcho" => intval($get_data['sEcho']),
            "iTotalRecords" => $dt_total,
            "iTotalDisplayRecords" => $dt_filtered_total,
            "aaData" => array()
        );

        foreach ($dt_result->result_array() as $aRow) {
            $name = $aRow['fullname'];
            
            $row = array();
          //  $row[] = $aRow['id'];
            $row[] = '<a href="#" title="Edit ' . $name . '" >' . $aRow['dealership_name'] . '</a>';
            $row[] = '<a href="#" title="Edit ' . $name . '" >' . $aRow['town_city'] . '</a>';
            $row[] = '<a href="#" title="Edit ' . $name . '" >' . $aRow['fullname'] . '</a>';
            $row[] = $aRow['email'];
            $row[] = $aRow['mobile'];
            $row[] = $aRow['total_in_progress'];
            $row[] = $aRow['total_completed'];
            $row[] = ($aRow['total_cost']!=0 && $aRow['total_cost']!="") ? 'R'.number_format($aRow['total_cost'],2) : "N/A";
            $output['aaData'][] = $row;
        }
        return $output;
    }
    
    public function get_client_bookings($client_id){
        $this->db->select("GROUP_CONCAT(`id`) as booking_ids", false);
        $this->db->where("client_id", $client_id);
        $result = $this->db->get("booking");
        
        return explode(",",$result->row_array()['booking_ids']);
    }
    
    public function get_all_candidates($booking_id = NULL, $within_booking = 0) {
        
        $get_data = $this->input->get(NULL, TRUE);
        $dt_table = "users as us";
        $dt_col_searchable = array(true, true, true, true, true, true, false);
     //    $dt_columns = array('us.id', 'us.fullname', 'us.id_number', 'us.email', 'us.telephone', 'uss.fullname as client_name', 'jobs.title', 'us.created_date', 'us.company',  'us.is_delete', 'us.status');
        if($within_booking == 0){
            $dt_columns = array('us.id', 'us.fullname', 'us.id_number', 'us.email', 'us.telephone', 'jobs.title', 'us.created_date', 'cfs.declined_consent', 'us.company',  'us.is_delete', 'us.status');
        } else {
            $dt_columns = array('us.id', 'us.fullname', 'jobs.title', 'us.created_date', 'cfs.declined_consent', 'us.company',  'us.is_delete', 'us.status');
        }
        
        // condition for client to see his candidates
        if(is_client() &&  !is_client_manager()){
            $this->db->where_in("us.candidate_booking_id", $this->get_client_bookings(current_user_id()));
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
            $this->db->order_by('us.id', 'DESC');
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
        
        $this->db->group_start();
        
        // if(!is_client_manager()){
        if($booking_id != "" && $booking_id != '0'){
            $this->db->where('us.candidate_booking_id', $booking_id);
        }
        // }
        
        $this->db->where('us.user_role', 'CANDIDATE');
        $this->db->where('us.is_delete', '0');
        $this->db->group_end();
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $dt_columns)), false);
        $this->db->join('booking as bk', 'us.candidate_booking_id=bk.id', 'left');
        $this->db->join('users as uss', 'uss.id=bk.client_id', 'left');
        $this->db->join('jobs', 'jobs.id=bk.job_id', 'left');
        $this->db->join('consent_form_submit as cfs', 'us.id=cfs.candidate_id', 'left');
        $this->db->group_by('us.id');
        $this->db->from($dt_table);
        $dt_result = $this->db->get() or die( 'MySQL Error: ' . $this->db->_error_number() ); 
       // last_query(1);
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
            $row[] = $aRow['id'];
            // $row[] = '<a href="#" title="Edit ' . $aRow['fullname'] . '" >' . $aRow['fullname'] . '</a>';
            // $row[] = '<a href="#attached_doc_modal" data-toggle="modal" class="fetch_user_documents" data-id="'.$aRow['id'].'">'.$aRow['fullname'].'</a>';
            $row[] ='<a href="#upload_report_model" data-toggle="modal" data-id="'.$aRow['id'].'" data-href="'.base_url('user/').'" class="upload_reports">' .$aRow['fullname']. '</a>';
            if($within_booking == 0){
                $row[] = $aRow['id_number'];
                $row[] = $aRow['email'];
                $row[] = $aRow['telephone'];
            }
       //     $row[] = $aRow['client_name'];
            $row[] = $aRow['title'];
            $row[] = $aRow['created_date'];
            
            if($aRow['declined_consent']!= NULL){
                if($aRow['declined_consent'] == 1){
                    $dec =  '<span class="text-danger"><b>Yes</b></span>';
                } else {
                    $dec =  '<span class="text-success"><b>No</b></span>';
                }
            } else {
                $dec =  '<span class="text-primary"><b>N/A</b></span>';
            }
            $row[] = $dec;
            
            $action = '';
            if(is_client_manager() || is_client()){
               $action = '<a href="#upload_report_model" data-toggle="modal" data-id="'.$aRow['id'].'" data-href="'.base_url('user/').'" class="upload_reports">View</a>' ; 
           }
           
           if(is_admin()){
            $action .= '<a href="#upload_report_model" data-toggle="modal" data-id="'.$aRow['id'].'" data-href="'.base_url('user/').'" class="upload_reports">Upload Reports</a>';
        }
        
        $row[] = $action;
        
        $output['aaData'][] = $row;
    }
    return $output;
}

}