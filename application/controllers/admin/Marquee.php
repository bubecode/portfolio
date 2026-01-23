<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marquee extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
        $data['title'] = 'Manage Marquee Text';
        $data['marquee'] = $this->db->order_by('sort_order', 'ASC')->get('marquee')->result();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/marquee/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function save($id = NULL) {
        $this->form_validation->set_rules('text', 'Text', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->index();
        } else {
            $data = array(
                'text' => $this->input->post('text', TRUE),
                'sort_order' => (int)$this->input->post('sort_order')
            );

            if ($id) {
                $this->db->where('id', $id)->update('marquee', $data);
                $this->session->set_flashdata('success', 'Marquee updated.');
            } else {
                $this->db->insert('marquee', $data);
                $this->session->set_flashdata('success', 'Marquee added.');
            }
            redirect('admin/marquee');
        }
    }

    public function delete($id) {
        $this->db->where('id', $id)->delete('marquee');
        $this->session->set_flashdata('success', 'Marquee deleted.');
        redirect('admin/marquee');
    }
}
