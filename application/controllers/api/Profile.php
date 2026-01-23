<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Profile_model');
    }

    public function index() {
        $this->load->model('About_model');
        $this->load->model('Meta_model');

        $profile = $this->Profile_model->get_profile();
        $about = $this->About_model->get_about();
        $socials_raw = $this->Meta_model->get_social_links();
        $stats_raw = $this->Profile_model->get_stats();

        // Map stats
        $stats = [
            'years' => '0',
            'projects' => '0'
        ];
        foreach ($stats_raw as $s) {
            if (stripos($s->stat_key, 'Years') !== false) $stats['years'] = $s->stat_value;
            if (stripos($s->stat_key, 'Projects') !== false) $stats['projects'] = $s->stat_value;
        }

        // Map socials
        $socials = array_map(function($s) {
            return [
                'platform' => $s->platform,
                'url' => $s->url,
                'handle' => $s->handle
            ];
        }, $socials_raw);

        $response = [
            'profile' => [
                'name' => isset($profile->name) ? $profile->name : '',
                'title' => isset($profile->title) ? $profile->title : '',
                'hero_text' => isset($profile->hero_text) ? $profile->hero_text : '',
                'subtitle' => isset($about->role) ? $about->role : '',
                'description' => isset($about->about_text) ? $about->about_text : '',
                'status' => isset($profile->status) ? $profile->status : '',
                'email' => isset($profile->email) ? $profile->email : '',
                'location' => isset($profile->location) ? $profile->location : ''
            ],
            'socials' => $socials,
            'stats' => $stats
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
