<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_projects() {
        $this->db->order_by('id', 'DESC');
        return $this->db->get('projects')->result();
    }

    public function get_project($id) {
        $this->db->where('id', $id);
        return $this->db->get('projects')->row();
    }

    public function add_project($data) {
        return $this->db->insert('projects', $data);
    }

    public function update_project($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('projects', $data);
    }

    public function delete_project($id) {
        $this->db->where('id', $id);
        return $this->db->delete('projects');
    }
}
