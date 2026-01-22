<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Service_model');
    }

    public function index() {
        $data = $this->Service_model->get_all_services();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}
