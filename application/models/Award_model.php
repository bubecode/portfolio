<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Award_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_awards() {
        $this->db->order_by('set_order', 'ASC');
        return $this->db->get('awards')->result();
    }

    public function get_award($id) {
        $this->db->where('id', $id);
        return $this->db->get('awards')->row();
    }

    public function add_award($data) {
        return $this->db->insert('awards', $data);
    }

    public function update_award($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('awards', $data);
    }

    public function delete_award($id) {
        $this->db->where('id', $id);
        return $this->db->delete('awards');
    }
}
