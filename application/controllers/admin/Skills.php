<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[AllowDynamicProperties]
class Skills extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/auth/login');
        }
        $this->load->model('Skill_model');
    }

    public function index() {
        $data['title'] = 'Manage Skills';
        $data['skills'] = $this->Skill_model->get_all_skills();
        $data['categories'] = $this->Skill_model->get_categories();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/skills/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function add() {
        $data = array(
            'name' => $this->input->post('name', TRUE),
            'category_id' => $this->input->post('category_id', TRUE),
            'is_primary' => $this->input->post('is_primary') ? 1 : 0
        );
        $this->Skill_model->add_skill($data);
        $this->session->set_flashdata('success', 'Skill added.');
        redirect('admin/skills');
    }

    public function delete($id) {
        $this->Skill_model->delete_skill($id);
        $this->session->set_flashdata('success', 'Skill deleted.');
        redirect('admin/skills');
    }
}
