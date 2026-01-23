<?php
include_once(APPPATH . "core/MY_Controller.php");
defined('BASEPATH') OR exit('No direct script access allowed');

class Awards extends API_Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Award_model');
    }

    public function index() {
        $data = $this->Award_model->get_all_awards();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}
