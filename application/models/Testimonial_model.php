<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('testimonials')->result();
    }

    public function get_active() {
        $this->db->where('status', 'active');
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('testimonials')->result();
    }

    public function get_featured() {
        $this->db->where('is_featured', 1);
        $this->db->where('status', 'active');
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('testimonials')->result();
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('testimonials')->row();
    }

    public function add($data) {
        return $this->db->insert('testimonials', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('testimonials', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('testimonials');
    }
}
