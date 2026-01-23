<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Experience extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Experience_model');
    }

    public function index() {
        $experience = $this->Experience_model->get_all_experience();
        
        foreach ($experience as &$e) {
            $e->highlights = $this->Experience_model->get_highlights($e->id);
            $e->is_featured = (bool)$e->is_featured;
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($experience));
    }
}
