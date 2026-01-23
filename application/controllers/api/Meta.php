<?php
include_once(APPPATH . "core/MY_Controller.php");
defined('BASEPATH') OR exit('No direct script access allowed');

class Meta extends API_Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Meta_model');
        $this->load->model('Profile_model');
    }

    public function index() {
        $profile = $this->Profile_model->get_profile();
        $socials = $this->Meta_model->get_social_links();
        $nav = $this->Meta_model->get_nav_links();
        
        $response = [
            'brand_name' => isset($profile->name) ? $profile->name : 'Portfolio',
            'copyright_year' => date('Y'),
            'social_links' => $socials,
            'nav_links' => $nav
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
