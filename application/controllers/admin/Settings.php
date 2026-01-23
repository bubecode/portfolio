<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/auth/login');
        }
        $this->load->model('User_model');
    }

    public function index() {
        $data['title'] = 'Account Settings';
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/settings/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function change_password() {
        $this->form_validation->set_rules('current_password', 'Current Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'required|matches[new_password]');

        if ($this->form_validation->run() === FALSE) {
            $this->index();
        } else {
            $user_id = $this->session->userdata('admin_id');
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');

            // Verify current password
            $user = $this->User_model->get_user_by_email($this->session->userdata('email'));

            if ($user && password_verify($current_password, $user->password_hash)) {
                $this->User_model->update_password($user_id, $new_password);
                $this->session->set_flashdata('success', 'Password changed successfully!');
                redirect('admin/settings');
            } else {
                $this->session->set_flashdata('error', 'Current password is incorrect');
                redirect('admin/settings');
            }
        }
    }
}
