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
        $this->db->insert('experience', $data);
        return $this->db->insert_id();
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

    public function save_highlights($experience_id, $highlights) {
        // First, clear existing highlights for this experience
        $this->db->where('experience_id', $experience_id);
        $this->db->delete('experience_highlights');

        // Then, insert new ones
        if (!empty($highlights)) {
            $data = [];
            foreach ($highlights as $index => $highlight) {
                if (trim($highlight) !== '') {
                    $data[] = [
                        'experience_id' => $experience_id,
                        'highlight' => trim($highlight),
                        'sort_order' => $index
                    ];
                }
            }
            if (!empty($data)) {
                return $this->db->insert_batch('experience_highlights', $data);
            }
        }
        return TRUE;
    }

    public function delete_experience($id) {
        // Highlights will be deleted via ON DELETE CASCADE in MySQL if set up correctly,
        // but we can be explicit if we want to be safe. 
        // Based on the schema_update.sql, it is set to ON DELETE CASCADE.
        $this->db->where('id', $id);
        return $this->db->delete('experience');
    }
}
