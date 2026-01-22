<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meta_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_meta() {
        $query = $this->db->get('meta');
        return $query->row();
    }

    public function update_meta($data) {
        $count = $this->db->count_all('meta');
        if ($count == 0) {
            return $this->db->insert('meta', $data);
        } else {
            $this->db->where('id', 1);
            return $this->db->update('meta', $data);
        }
    }

    public function get_nav_links() {
        $this->db->order_by('order_index', 'ASC');
        return $this->db->get('nav_links')->result();
    }

    public function add_nav_link($data) {
        return $this->db->insert('nav_links', $data);
    }

    public function delete_nav_link($id) {
        $this->db->where('id', $id);
        return $this->db->delete('nav_links');
    }
}
