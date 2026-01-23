<?php
include_once(APPPATH . "core/MY_Controller.php");
defined('BASEPATH') OR exit('No direct script access allowed');

class Experience extends API_Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Experience_model');
    }

    public function index() {
        $experience = $this->Experience_model->get_all_experience();
        
        foreach ($experience as &$e) {
            $highlights_raw = $this->Experience_model->get_highlights($e->id);
            $e->highlights = array_map(function($h) { return $h->highlight; }, $highlights_raw);
            $e->featured = (bool)$e->featured;
            // No need to unset anymore since DB name matches output name
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($experience));
    }
}
