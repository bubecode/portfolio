<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skills extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Skill_model');
    }

    public function index() {
        $skills = $this->Skill_model->get_all_skills();
        
        // Group by category for easier frontend consumption, or return flat list
        // Returning flat list as per requirement usually, but grouping is often nicer.
        // Will return flat list to match GET /api/skills simple convention, letting frontend filter.
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($skills));
    }
}
