<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NavLinks extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/auth/login');
        }
    }

    public function index() {
        $data['title'] = 'Manage Nav Links';
        $data['nav_links'] = $this->db->order_by('sort_order', 'ASC')->get('nav_links')->result();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/nav_links/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function save($id = NULL) {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('href', 'HREF', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->index();
        } else {
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'href' => $this->input->post('href', TRUE),
                'sort_order' => (int)$this->input->post('sort_order')
            );

            if ($id) {
                $this->db->where('id', $id)->update('nav_links', $data);
                $this->session->set_flashdata('success', 'Link updated.');
            } else {
                $this->db->insert('nav_links', $data);
                $this->session->set_flashdata('success', 'Link added.');
            }
            redirect('admin/navlinks');
        }
    }

    public function delete($id) {
        $this->db->where('id', $id)->delete('nav_links');
        $this->session->set_flashdata('success', 'Link deleted.');
        redirect('admin/navlinks');
    }
}
