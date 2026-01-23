<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Experience_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_experience() {
        // Sort by start_date descending usually, but it's varchar. 
        // Ideally DB should use DATE type, but user requsted varchar(50) in task.
        // We will just order by ID DESC for now.
        $this->db->order_by('id', 'DESC');
        return $this->db->get('experience')->result();
    }

    public function get_experience($id) {
        $this->db->where('id', $id);
        return $this->db->get('experience')->row();
    }

    public function add_experience($data) {
        return $this->db->insert('experience', $data);
    }

    public function update_experience($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('experience', $data);
    }

    public function get_highlights($experience_id) {
        $this->db->where('experience_id', $experience_id);
        $this->db->order_by('sort_order', 'ASC');
        return $this->db->get('experience_highlights')->result();
    }

    public function delete_experience($id) {
        $this->db->where('id', $id);
        return $this->db->delete('experience');
    }
}
