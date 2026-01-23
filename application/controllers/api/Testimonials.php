<?php
include_once(APPPATH . "core/MY_Controller.php");
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonials extends API_Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Testimonial_model');
    }

    public function index() {
        $testimonials_raw = $this->Testimonial_model->get_active();
        
        $testimonials = array_map(function($t) {
            return [
                'id' => (int)$t->id,
                'person' => $t->person_name,
                'role' => $t->person_role,
                'company' => $t->company_name,
                'product' => $t->product_used,
                'message' => $t->message,
                'rating' => (int)$t->rating,
                'image' => $t->person_image ? base_url($t->person_image) : null,
                'logo' => $t->company_logo ? base_url($t->company_logo) : null,
                'featured' => (bool)$t->is_featured
            ];
        }, $testimonials_raw);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($testimonials));
    }
}
