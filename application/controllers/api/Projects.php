<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Project_model');
    }

    public function index() {
        $projects = $this->Project_model->get_all_projects();
        
        // Decode JSON fields for clean API output
        foreach ($projects as &$p) {
            $p->tech_stack = json_decode($p->tech_stack_json);
            $p->is_featured = (bool)$p->is_featured;
            unset($p->tech_stack_json);
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($projects));
    }
}
