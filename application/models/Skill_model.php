<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skill_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_categories() {
        $this->db->order_by('sort_order', 'ASC');
        return $this->db->get('skill_categories')->result();
    }

    public function get_all_skills() {
        $this->db->select('skills.*, skill_categories.name as category_name, skills.name as title, skill_categories.name as category');
        $this->db->from('skills');
        $this->db->join('skill_categories', 'skill_categories.id = skills.category_id', 'left');
        $this->db->order_by('skill_categories.sort_order', 'ASC');
        $this->db->order_by('skills.sort_order', 'ASC');
        return $this->db->get()->result();
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
