<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_user_by_email($email) {
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->row();
    }

    public function create_user($email, $password) {
        $data = array(
            'email' => $email,
            'password_hash' => password_hash($password, PASSWORD_BCRYPT)
        );
        return $this->db->insert('users', $data);
    }

    public function update_password($id, $new_password) {
        $data = array(
            'password_hash' => password_hash($new_password, PASSWORD_BCRYPT)
        );
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }
}
