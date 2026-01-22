<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_about() {
        $query = $this->db->get('about');
        return $query->row();
    }

    public function get_features($about_id) {
        if(!$about_id) return [];
        $this->db->where('about_id', $about_id);
        return $this->db->get('about_features')->result();
    }

    public function update_about($data) {
        $count = $this->db->count_all('about');
        if ($count == 0) {
            $this->db->insert('about', $data);
            return $this->db->insert_id();
        } else {
            $this->db->where('id', 1); // Assuming single record
            $this->db->update('about', $data);
            return 1;
        }
    }

    public function add_feature($data) {
        return $this->db->insert('about_features', $data);
    }

    public function delete_feature($id) {
        $this->db->where('id', $id);
        return $this->db->delete('about_features');
    }
}
