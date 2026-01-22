<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Education_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_education() {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('education')->result();
    }

    public function get_education($id) {
        $this->db->where('id', $id);
        return $this->db->get('education')->row();
    }

    public function add_education($data) {
        return $this->db->insert('education', $data);
    }

    public function update_education($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('education', $data);
    }

    public function delete_education($id) {
        $this->db->where('id', $id);
        return $this->db->delete('education');
    }
}
