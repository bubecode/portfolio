<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/auth/login');
        }
        $this->load->model('About_model');
    }

    public function index() {
        $data['title'] = 'Manage About Section';
        $data['about'] = $this->About_model->get_about();
        $data['expertise'] = ($data['about']) ? $this->About_model->get_expertise($data['about']->id) : [];
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/about/edit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function update() {
        $data = array(
            'role' => $this->input->post('role', TRUE), // Was section_label/title mixed, moving to role based on schema? Wait, schema has role, about_text, personal_statement. Let's check view too.
            // Schema: id, profile_id, role, about_text, personal_statement. 
            // Old inputs: section_label, title, subtitle, about_text, personal_statement.
            // I should map: section_label->?, title->role? subtitle->?
            // User schema: role, about_text, personal_statement.
            // I will update inputs to match schema in View first preferably, but let's do Controller logic.
            // Let's assume view sends 'role', 'about_text', 'personal_statement' now.
            'role' => $this->input->post('role', TRUE),
            'about_text' => $this->input->post('about_text', TRUE),
            'personal_statement' => $this->input->post('personal_statement', TRUE),
            'profile_id' => 1 // Hardcoded for now as per logic
        );

        $about_id = $this->About_model->update_about($data);

        // Handle Expertise Addition
        $new_expertise = $this->input->post('new_expertise', TRUE);
        
        if (!empty($new_expertise)) {
            $expertise_data = array(
                'about_id' => $about_id,
                'expertise' => $new_expertise
            );
            $this->About_model->add_expertise($expertise_data);
        }

        $this->session->set_flashdata('success', 'About section updated successfully!');
        redirect('admin/about');
    }

    public function delete_expertise($id) {
        $this->About_model->delete_expertise($id);
        $this->session->set_flashdata('success', 'Expertise deleted.');
        redirect('admin/about');
    }
}
