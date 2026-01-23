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

    public function get_expertise($about_id) {
        if(!$about_id) return [];
        $this->db->where('about_id', $about_id);
        $this->db->order_by('sort_order', 'ASC');
        return $this->db->get('core_expertise')->result();
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

    public function add_expertise($data) {
        return $this->db->insert('core_expertise', $data);
    }

    public function delete_expertise($id) {
        $this->db->where('id', $id);
        return $this->db->delete('core_expertise');
    }
}
