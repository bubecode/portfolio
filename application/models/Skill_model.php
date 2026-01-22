<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skill_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_skills() {
        $this->db->order_by('category', 'ASC');
        return $this->db->get('skills')->result();
    }

    public function get_skill($id) {
        $this->db->where('id', $id);
        return $this->db->get('skills')->row();
    }

    public function add_skill($data) {
        return $this->db->insert('skills', $data);
    }

    public function update_skill($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('skills', $data);
    }

    public function delete_skill($id) {
        $this->db->where('id', $id);
        return $this->db->delete('skills');
    }
}
