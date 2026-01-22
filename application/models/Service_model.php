<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_services() {
        $this->db->order_by('id', 'ASC');
        return $this->db->get('services')->result();
    }

    public function get_service($id) {
        $this->db->where('id', $id);
        return $this->db->get('services')->row();
    }

    public function add_service($data) {
        return $this->db->insert('services', $data);
    }

    public function update_service($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('services', $data);
    }

    public function delete_service($id) {
        $this->db->where('id', $id);
        return $this->db->delete('services');
    }
}
