<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonials extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/auth/login');
        }
        $this->load->model('Testimonial_model');
        $this->load->library('upload');
    }

    public function index() {
        $data['title'] = 'Manage Testimonials';
        $data['testimonials'] = $this->Testimonial_model->get_all();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/testimonials/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function add() {
        $data['title'] = 'Add Testimonial';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/testimonials/form', $data);
        $this->load->view('admin/layout/footer');
    }

    public function edit($id) {
        $data['title'] = 'Edit Testimonial';
        $data['item'] = $this->Testimonial_model->get_by_id($id);
        if (!$data['item']) show_404();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/testimonials/form', $data);
        $this->load->view('admin/layout/footer');
    }

    public function save($id = NULL) {
        $this->form_validation->set_rules('person_name', 'Person Name', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');

        if ($this->form_validation->run() === FALSE) {
            $id ? $this->edit($id) : $this->add();
        } else {
            $data = array(
                'person_name' => $this->input->post('person_name', TRUE),
                'person_role' => $this->input->post('person_role', TRUE),
                'company_name' => $this->input->post('company_name', TRUE),
                'product_used' => $this->input->post('product_used', TRUE),
                'message' => $this->input->post('message', TRUE),
                'rating' => (int)$this->input->post('rating', TRUE),
                'is_featured' => $this->input->post('is_featured') ? 1 : 0,
                'status' => $this->input->post('status', TRUE)
            );

            // Handle Person Image Upload
            if (!empty($_FILES['person_image']['name'])) {
                $config['upload_path']   = './assets/uploads/testimonials/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
                $config['file_name']     = 'person_' . time();
                
                $this->upload->initialize($config);
                if ($this->upload->do_upload('person_image')) {
                    $uploadData = $this->upload->data();
                    $data['person_image'] = 'assets/uploads/testimonials/' . $uploadData['file_name'];
                }
            }

            // Handle Company Logo Upload
            if (!empty($_FILES['company_logo']['name'])) {
                $config['upload_path']   = './assets/uploads/testimonials/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
                $config['file_name']     = 'logo_' . time();
                
                $this->upload->initialize($config);
                if ($this->upload->do_upload('company_logo')) {
                    $uploadData = $this->upload->data();
                    $data['company_logo'] = 'assets/uploads/testimonials/' . $uploadData['file_name'];
                }
            }

            if ($id) {
                $this->Testimonial_model->update($id, $data);
                $this->session->set_flashdata('success', 'Testimonial updated successfully.');
            } else {
                $this->Testimonial_model->add($data);
                $this->session->set_flashdata('success', 'Testimonial added successfully.');
            }
            redirect('admin/testimonials');
        }
    }

    public function delete($id) {
        $item = $this->Testimonial_model->get_by_id($id);
        if ($item) {
            if ($item->person_image && file_exists('./' . $item->person_image)) unlink('./' . $item->person_image);
            if ($item->company_logo && file_exists('./' . $item->company_logo)) unlink('./' . $item->company_logo);
            $this->Testimonial_model->delete($id);
            $this->session->set_flashdata('success', 'Testimonial deleted.');
        }
        redirect('admin/testimonials');
    }
}
