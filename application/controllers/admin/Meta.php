<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meta extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/auth/login');
        }
        $this->load->model('Meta_model');
    }

    public function index() {
        $data['title'] = 'Manage Meta & Navigation';
        $data['meta'] = $this->Meta_model->get_meta();
        $data['nav_links'] = $this->Meta_model->get_nav_links();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/meta/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function update() {
        $data = array(
            'brand_name' => $this->input->post('brand_name', TRUE),
            'copyright_year' => $this->input->post('copyright_year', TRUE)
        );
        $this->Meta_model->update_meta($data);
        $this->session->set_flashdata('success', 'Meta updated.');
        redirect('admin/meta');
    }

    public function add_nav() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('href', 'Link', 'required');
        
        if ($this->form_validation->run() !== FALSE) {
            $data = $this->input->post();
            $this->Meta_model->add_nav_link($data);
            $this->session->set_flashdata('success', 'Nav link added.');
        }
        redirect('admin/meta');
    }

    public function delete_nav($id) {
        $this->Meta_model->delete_nav_link($id);
        $this->session->set_flashdata('success', 'Nav link deleted.');
        redirect('admin/meta');
    }
}
