<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Education extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/auth/login');
        }
        $this->load->model('Education_model');
    }

    public function index() {
        $data['title'] = 'Manage Education';
        $data['education'] = $this->Education_model->get_all_education();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/education/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function create() {
        $data['title'] = 'Add Education';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/education/form', $data);
        $this->load->view('admin/layout/footer');
    }

    public function edit($id) {
        $data['title'] = 'Edit Education';
        $data['item'] = $this->Education_model->get_education($id);
        if (!$data['item']) show_404();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/education/form', $data);
        $this->load->view('admin/layout/footer');
    }

    public function save($id = NULL) {
        $this->form_validation->set_rules('degree', 'Degree', 'required');
        $this->form_validation->set_rules('institution', 'Institution', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $id ? $this->edit($id) : $this->create();
        } else {
            $data = $this->input->post();
            
            if ($id) {
                $this->Education_model->update_education($id, $data);
                $this->session->set_flashdata('success', 'Education updated successfully.');
            } else {
                $this->Education_model->add_education($data);
                $this->session->set_flashdata('success', 'Education created successfully.');
            }
            redirect('admin/education');
        }
    }

    public function delete($id) {
        $this->Education_model->delete_education($id);
        $this->session->set_flashdata('success', 'Education deleted.');
        redirect('admin/education');
    }
}
