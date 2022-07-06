<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Authentication_model extends CI_Model {

    /** constructor */
    function __construct() {
        parent::__construct();
    }

    public function login($data) {
        if (strpos($data['username'], '@') == TRUE) { /** login via email */
            $condition = 'email = ' . $this->db->escape($data['username']) . ' AND password = ' . $this->db->escape($data['password']) . ' AND status = "active"';
        } else { /** login via username */
            $condition = 'username = ' . $this->db->escape($data['username']) . ' AND password = ' . $this->db->escape($data['password']) . ' AND status = "active"';
        }

        $this->db->select('id, role, username, email, credits, is_update_profile, master_user_id, created_by,client_user_id');
        $this->db->from('user');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->row();
            $session_data = array(
                'user_id' => $result->id,
                'role' => $result->role,
                'username' => $result->username,
                'full_name' => @isset($result->full_name) ? $result->full_name : "",
                'email' => $result->email,
                'credits' => $result->credits,
                'is_update_profile' => $result->is_update_profile,
                'master_user_id' => $result->master_user_id,
                'created_by' => $result->created_by,
                'client_user_id' => $result->client_user_id
            );
            $this->session->set_userdata('logged_in', $session_data);

            return true;
        }
        
        return false;
    }

    function logout() {
        if ($this->session->userdata('logged_in')) {
            $this->session->unset_userdata('logged_in');
            return true;
        }
        return false;
    }

}

/* End of file authentication_model.php */
/* Location: ./application/model/authentication_model.php */
