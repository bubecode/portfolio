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
        $data['features'] = ($data['about']) ? $this->About_model->get_features($data['about']->id) : [];
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/about/edit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function update() {
        $data = array(
            'section_label' => $this->input->post('section_label', TRUE),
            'title' => $this->input->post('title', TRUE),
            'subtitle' => $this->input->post('subtitle', TRUE),
            'about_text' => $this->input->post('about_text', TRUE),
            'personal_statement' => $this->input->post('personal_statement', TRUE)
        );

        $about_id = $this->About_model->update_about($data);

        // Handle Features Addition
        $new_feature_label = $this->input->post('new_feature_label', TRUE);
        $new_feature_icon = $this->input->post('new_feature_icon', TRUE);
        
        if (!empty($new_feature_label)) {
            $feature_data = array(
                'about_id' => $about_id,
                'label' => $new_feature_label,
                'icon' => $new_feature_icon
            );
            $this->About_model->add_feature($feature_data);
        }

        $this->session->set_flashdata('success', 'About section updated successfully!');
        redirect('admin/about');
    }

    public function delete_feature($id) {
        $this->About_model->delete_feature($id);
        $this->session->set_flashdata('success', 'Feature deleted.');
        redirect('admin/about');
    }
}
