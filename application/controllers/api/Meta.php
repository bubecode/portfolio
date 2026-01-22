<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meta extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Meta_model');
    }

    public function index() {
        $meta = $this->Meta_model->get_meta();
        $nav = $this->Meta_model->get_nav_links();
        
        $response = (array)$meta;
        $response['nav_links'] = $nav;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
