<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/auth/login');
        }
        $this->load->model('Service_model');
    }

    public function index() {
        $data['title'] = 'Manage Services';
        $data['services'] = $this->Service_model->get_all_services();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/services/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function add() {
        $this->form_validation->set_rules('title', 'Title', 'required');
        
        if ($this->form_validation->run() !== FALSE) {
            $data = array(
                'title' => $this->input->post('title', TRUE),
                'description' => $this->input->post('description', TRUE),
                'icon' => $this->input->post('icon', TRUE),
                'sort_order' => $this->input->post('sort_order', TRUE) ?: 0
            );
            $this->Service_model->add_service($data);
            $this->session->set_flashdata('success', 'Service added.');
        }
        redirect('admin/services');
    }

    public function edit($id) {
        $data['title'] = 'Edit Service';
        $data['service'] = $this->Service_model->get_service($id);
        if (!$data['service']) show_404();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/services/edit_service', $data);
        $this->load->view('admin/layout/footer');
    }

    public function update($id) {
        $this->form_validation->set_rules('title', 'Title', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->edit($id);
        } else {
            $data = array(
                'title' => $this->input->post('title', TRUE),
                'description' => $this->input->post('description', TRUE),
                'icon' => $this->input->post('icon', TRUE),
                'sort_order' => $this->input->post('sort_order', TRUE) ?: 0
            );
            $this->Service_model->update_service($id, $data);
            $this->session->set_flashdata('success', 'Service updated.');
            redirect('admin/services');
        }
    }

    public function delete($id) {
        $this->Service_model->delete_service($id);
        $this->session->set_flashdata('success', 'Service deleted.');
        redirect('admin/services');
    }
}
