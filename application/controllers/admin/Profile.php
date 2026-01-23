<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/auth/login');
        }
        $this->load->model('Profile_model');
        $this->load->library('upload');
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
            $update_data = array(
                'name' => $this->input->post('name', TRUE),
                'title' => $this->input->post('title', TRUE),
                'hero_text' => $this->input->post('hero_text', TRUE),
                'tagline' => $this->input->post('hero_subtext', TRUE),
                'location' => $this->input->post('location', TRUE),
                'email' => $this->input->post('email', TRUE),
                'status' => $this->input->post('status', TRUE)
            );

            // Handle Image Upload
            if (!empty($_FILES['profile_image']['name'])) {
                $config['upload_path']   = './uploads/profile/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = 2048;
                $config['file_name']     = 'profile_' . time();

                $this->upload->initialize($config);

                if ($this->upload->do_upload('profile_image')) {
                    $uploadData = $this->upload->data();
                    $update_data['profile_image'] = 'uploads/profile/' . $uploadData['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/profile');
                }
            }

            $this->Profile_model->update_profile($update_data);
            $this->session->set_flashdata('success', 'Profile updated successfully!');
            redirect('admin/profile');
        }
    }
}
