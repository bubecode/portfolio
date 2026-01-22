<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/auth/login');
        }
        $this->load->model('Profile_model');
    }

    public function index() {
        $data['title'] = 'Manage Profile';
        $data['profile'] = $this->Profile_model->get_profile();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/profile/edit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function update() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        
        if ($this->form_validation->run() === FALSE) {
            $this->index();
        } else {
            $data = $this->input->post();
            // Remove submit button or csrf token if present in post array implicitly, 
            // though CI3 Input class usually cleans up. 
            // Better to explicitly define fields or unset unwanted.
            
            // Basic XSS clean is enabled globally or via input->post(NULL, TRUE)
            $update_data = array(
                'name' => $this->input->post('name', TRUE),
                'title' => $this->input->post('title', TRUE),
                'hero_text' => $this->input->post('hero_text', TRUE),
                'hero_subtext' => $this->input->post('hero_subtext', TRUE),
                'location' => $this->input->post('location', TRUE),
                'timezone' => $this->input->post('timezone', TRUE),
                'email' => $this->input->post('email', TRUE),
                'status' => $this->input->post('status', TRUE),
                'linkedin' => $this->input->post('linkedin', TRUE),
                'github' => $this->input->post('github', TRUE)
            );

            $this->Profile_model->update_profile($update_data);
            $this->session->set_flashdata('success', 'Profile updated successfully!');
            redirect('admin/profile');
        }
    }
}
