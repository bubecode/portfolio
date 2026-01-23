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
            $profile = $this->db->get('profile', 1)->row();
            if ($profile) {
                $this->db->where('id', $profile->id);
                return $this->db->update('profile', $data);
            }
            return FALSE;
        }
    }

    public function get_stats() {
        return $this->db->get('stats')->result();
    }
}
