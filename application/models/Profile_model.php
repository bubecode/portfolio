<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_profile() {
        $query = $this->db->get('profile');
        return $query->row();
    }

    public function update_profile($data) {
        // Check if a row exists
        $count = $this->db->count_all('profile');
        if ($count == 0) {
            return $this->db->insert('profile', $data);
        } else {
            // Assume single row with ID 1
            $this->db->where('id', 1);
            return $this->db->update('profile', $data);
        }
    }
}
