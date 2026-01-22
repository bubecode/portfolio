<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/auth/login');
        }
        $this->load->model('Project_model');
    }

    public function index() {
        $data['title'] = 'Manage Projects';
        $data['projects'] = $this->Project_model->get_all_projects();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/projects/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function create() {
        $data['title'] = 'Add New Project';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/projects/form', $data);
        $this->load->view('admin/layout/footer');
    }

    public function edit($id) {
        $data['title'] = 'Edit Project';
        $data['project'] = $this->Project_model->get_project($id);
        if (!$data['project']) show_404();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/projects/form', $data);
        $this->load->view('admin/layout/footer');
    }

    public function save($id = NULL) {
        $this->form_validation->set_rules('name', 'Name', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $id ? $this->edit($id) : $this->create();
        } else {
            // Handle tech_stack array from textarea (comma separated) or direct array
            $tech_stack_str = $this->input->post('tech_stack');
            $tech_stack_array = array_map('trim', explode(',', $tech_stack_str));
            
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'description' => $this->input->post('description', TRUE),
                'impact_line' => $this->input->post('impact_line', TRUE),
                'tech_stack_json' => json_encode($tech_stack_array),
                'is_featured' => $this->input->post('is_featured') ? 1 : 0,
                'icon' => $this->input->post('icon', TRUE)
            );

            if ($id) {
                $this->Project_model->update_project($id, $data);
                $this->session->set_flashdata('success', 'Project updated successfully.');
            } else {
                $this->Project_model->add_project($data);
                $this->session->set_flashdata('success', 'Project created successfully.');
            }
            redirect('admin/projects');
        }
    }

    public function delete($id) {
        $this->Project_model->delete_project($id);
        $this->session->set_flashdata('success', 'Project deleted.');
        redirect('admin/projects');
    }
}
