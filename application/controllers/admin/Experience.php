<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Experience extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/auth/login');
        }
        $this->load->model('Experience_model');
    }

    public function index() {
        $data['title'] = 'Manage Experience';
        $data['experience'] = $this->Experience_model->get_all_experience();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/experience/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function create() {
        $data['title'] = 'Add New Experience';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/experience/form', $data);
        $this->load->view('admin/layout/footer');
    }

    public function edit($id) {
        $data['title'] = 'Edit Experience';
        $data['item'] = $this->Experience_model->get_experience($id);
        if (!$data['item']) show_404();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/experience/form', $data);
        $this->load->view('admin/layout/footer');
    }

    public function save($id = NULL) {
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('company', 'Company', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $id ? $this->edit($id) : $this->create();
        } else {
            // Handle highlights array from textarea (semicolon separated for experience usually better than comma)
            // or just use new line splitting
            $highlights_str = $this->input->post('highlights');
            $highlights_array = array_filter(array_map('trim', explode("\n", $highlights_str)));
            
            $data = array(
                'role' => $this->input->post('role', TRUE),
                'company' => $this->input->post('company', TRUE),
                'description' => $this->input->post('description', TRUE),
                'start_date' => $this->input->post('start_date', TRUE),
                'end_date' => $this->input->post('end_date', TRUE),
                'location' => $this->input->post('location', TRUE),
                'featured' => $this->input->post('featured') ? 1 : 0,
                'highlights_json' => json_encode(array_values($highlights_array))
            );

            if ($id) {
                $this->Experience_model->update_experience($id, $data);
                $this->session->set_flashdata('success', 'Experience updated successfully.');
            } else {
                $this->Experience_model->add_experience($data);
                $this->session->set_flashdata('success', 'Experience created successfully.');
            }
            redirect('admin/experience');
        }
    }

    public function delete($id) {
        $this->Experience_model->delete_experience($id);
        $this->session->set_flashdata('success', 'Experience deleted.');
        redirect('admin/experience');
    }
}
