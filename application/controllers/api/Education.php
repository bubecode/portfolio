<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Education extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Education_model');
    }

    public function index() {
        $data = $this->Education_model->get_all_education();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}
