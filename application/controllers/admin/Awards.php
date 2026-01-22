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
        
        if ($this->form_validation->run() !== FALSE) {
            $data = $this->input->post();
            $this->Award_model->add_award($data);
            $this->session->set_flashdata('success', 'Award added.');
        }
        redirect('admin/awards');
    }

    public function delete($id) {
        $this->Award_model->delete_award($id);
        $this->session->set_flashdata('success', 'Award deleted.');
        redirect('admin/awards');
    }
}
