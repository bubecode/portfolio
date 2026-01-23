<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Awards extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/auth/login');
        }
        $this->load->model('Award_model');
    }

    public function index() {
        $data['title'] = 'Manage Awards';
        $data['awards'] = $this->Award_model->get_all_awards();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/awards/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function add() {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('organization', 'Organization', 'required');
        
        if ($this->form_validation->run() !== FALSE) {
            $data = array(
                'title' => $this->input->post('title', TRUE),
                'organization' => $this->input->post('organization', TRUE),
                'description' => $this->input->post('description', TRUE),
                'year' => $this->input->post('year', TRUE),
                'set_order' => (int)$this->input->post('set_order', TRUE)
            );
            $this->Award_model->add_award($data);
            $this->session->set_flashdata('success', 'Award added.');
        }
        redirect('admin/awards');
    }

    public function edit($id) {
        $data['title'] = 'Edit Award';
        $data['award'] = $this->Award_model->get_award($id);
        if (!$data['award']) show_404();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/awards/edit_award', $data);
        $this->load->view('admin/layout/footer');
    }

    public function update($id) {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('organization', 'Organization', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->edit($id);
        } else {
            $data = array(
                'title' => $this->input->post('title', TRUE),
                'organization' => $this->input->post('organization', TRUE),
                'description' => $this->input->post('description', TRUE),
                'year' => $this->input->post('year', TRUE),
                'set_order' => (int)$this->input->post('set_order', TRUE)
            );
            $this->Award_model->update_award($id, $data);
            $this->session->set_flashdata('success', 'Award updated.');
            redirect('admin/awards');
        }
    }

    public function delete($id) {
        $this->Award_model->delete_award($id);
        $this->session->set_flashdata('success', 'Award deleted.');
        redirect('admin/awards');
    }
}
