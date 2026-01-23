<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load all models
        $this->load->model('Profile_model');
        $this->load->model('Meta_model');
        $this->load->model('About_model');
        $this->load->model('Skill_model');
        $this->load->model('Experience_model');
        $this->load->model('Project_model');
        $this->load->model('Award_model');
    }

    public function index() {
        // 1. Fetch data from all models
        $profile = $this->Profile_model->get_profile();
        $about = $this->About_model->get_about();
        $socials_raw = $this->Meta_model->get_social_links();
        $stats_raw = $this->Profile_model->get_stats();
        $expertise_raw = $this->About_model->get_expertise($about ? $about->id : null);
        $skills_raw = $this->Skill_model->get_all_skills();
        $experience_raw = $this->Experience_model->get_all_experience();
        $projects_raw = $this->Project_model->get_all_projects();
        $awards_raw = $this->Award_model->get_all_awards();

        // 2. Format Profile
        $profile_data = [
            'name' => isset($profile->name) ? $profile->name : '',
            'title' => isset($profile->title) ? $profile->title : '',
            'hero_text' => isset($profile->hero_text) ? $profile->hero_text : '',
            'subtitle' => isset($about->role) ? $about->role : '',
            'description' => isset($about->about_text) ? $about->about_text : '',
            'status' => isset($profile->status) ? $profile->status : '',
            'email' => isset($profile->email) ? $profile->email : '',
            'location' => isset($profile->location) ? $profile->location : '',
            'profile_image' => !empty($profile->profile_image) ? base_url($profile->profile_image) : null
        ];

        // 3. Format Socials
        $socials = array_map(function($s) {
            return [
                'platform' => $s->platform,
                'url' => $s->url,
                'handle' => $s->handle
            ];
        }, $socials_raw);

        // 4. Format Stats
        $stats = [
            'years' => '0',
            'projects' => '0'
        ];
        foreach ($stats_raw as $s) {
            if (stripos($s->stat_key, 'Years') !== false) $stats['years'] = $s->stat_value;
            if (stripos($s->stat_key, 'Projects') !== false) $stats['projects'] = $s->stat_value;
        }

        // 5. Format About
        $about_data = [
            'expertise' => isset($about->role) ? $about->role : '',
            'subtitle' => isset($about->personal_statement) ? $about->personal_statement : '',
            'bio' => isset($about->about_text) ? $about->about_text : '',
            'features' => array_map(function($e) { return $e->expertise; }, $expertise_raw)
        ];

        // 6. Format Skills
        $skills = [
            'backend' => ['primary' => '', 'others' => []],
            'database' => [],
            'frontend' => [],
            'tools' => []
        ];
        foreach ($skills_raw as $sk) {
            $cat = strtolower($sk->category);
            if ($cat == 'backend') {
                if ($sk->is_primary) $skills['backend']['primary'] = $sk->name;
                else $skills['backend']['others'][] = $sk->name;
            } elseif (isset($skills[$cat])) {
                $skills[$cat][] = $sk->name;
            }
        }

        // 7. Format Experience
        $experience = array_map(function($e) {
            $start = $e->start_date ? date('Y', strtotime($e->start_date)) : '';
            $end = $e->end_date ? date('Y', strtotime($e->end_date)) : 'Present';
            if ($start == $end) $period = $start;
            else $period = "$start - $end";

            return [
                'title' => $e->role,
                'company' => $e->company,
                'period' => $period,
                'location' => $e->location,
                'featured' => (bool)$e->is_featured
            ];
        }, $experience_raw);

        // 8. Format Projects
        $projects = [
            'featured' => null,
            'others' => []
        ];
        foreach ($projects_raw as $p) {
            $tech_stack = $p->tech_stack_json ? json_decode($p->tech_stack_json, true) : [];
            $project_item = [
                'title' => $p->name,
                'subtitle' => $p->impact_line,
                'tech' => $tech_stack
            ];
            
            if ($p->is_featured && empty($projects['featured'])) {
                $projects['featured'] = $project_item;
            } else {
                $projects['others'][] = $project_item;
            }
        }

        // 9. Format Awards
        $awards = array_map(function($a) {
            return [
                'title' => $a->title,
                'org' => $a->organization,
                'year' => $a->year,
                'description' => $a->description
            ];
        }, $awards_raw);

        // Map Awards to match user's special case for "project"
        $awards = array_map(function($a) {
            $data = [
                'title' => $a['title'],
                'org' => $a['org'],
                'year' => $a['year']
            ];
            if ($a['description']) $data['project'] = $a['description']; // User example showed "project" field
            return $data;
        }, $awards);

        // Final Response
        $response = [
            'profile' => $profile_data,
            'socials' => $socials,
            'stats' => $stats,
            'about' => $about_data,
            'skills' => $skills,
            'experience' => $experience,
            'projects' => $projects,
            'awards' => $awards
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
