<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('About_model');
    }

    public function index() {
        $about = $this->About_model->get_about();
        
        $response = [];
        if($about) {
            $expertise = $this->About_model->get_expertise($about->id);
            $response = (array)$about;
            $response['features'] = $expertise;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
