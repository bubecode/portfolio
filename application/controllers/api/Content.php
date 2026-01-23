<?php
include_once(APPPATH . "core/MY_Controller.php");
defined('BASEPATH') OR exit('No direct script access allowed');


class Content extends API_Base_Controller {

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
        
        // New tables
        $education_raw = $this->db->get('education')->result();
        $nav_links = $this->db->order_by('sort_order', 'ASC')->get('nav_links')->result();
        $marquee = $this->db->order_by('sort_order', 'ASC')->get('marquee')->result();

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
            'quote' => isset($about->quote) ? $about->quote : '',
            'features' => array_map(function($e) { return $e->expertise; }, $expertise_raw)
        ];

        // 6. Format Skills
        $skills = [
            'backend' => ['primary' => '', 'others' => [], 'description' => ''],
            'database' => [],
            'frontend' => [],
            'tools' => []
        ];
        foreach ($skills_raw as $sk) {
            $cat = strtolower($sk->category);
            if ($cat == 'backend') {
                if ($sk->is_primary) {
                    $skills['backend']['primary'] = $sk->name;
                    if ($sk->description) $skills['backend']['description'] = $sk->description;
                } else {
                    $skills['backend']['others'][] = $sk->name;
                }
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

            // Fetch highlights for this experience
            $highlights_raw = $this->Experience_model->get_highlights($e->id);
            $highlights = array_map(function($h) { return $h->highlight; }, $highlights_raw);

            return [
                'id' => (int)$e->id,
                'title' => $e->role,
                'company' => $e->company,
                'period' => $period,
                'location' => $e->location,
                'featured' => (bool)$e->featured,
                'highlights' => $highlights
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
                'id' => (int)$p->id,
                'title' => $p->title,
                'description' => $p->description,
                'impact' => $p->impact,
                'tech' => $tech_stack,
                'featured' => (bool)$p->featured,
                'icon' => $p->icon
            ];
            
            if ($p->featured && empty($projects['featured'])) {
                $projects['featured'] = $project_item;
            } else {
                $projects['others'][] = $project_item;
            }
        }

        // 9. Format Education
        $education = array_map(function($ed) {
            return [
                'id' => (int)$ed->id,
                'degree' => $ed->degree,
                'institution' => $ed->institution,
                'period' => $ed->period ? $ed->period : $ed->year
            ];
        }, $education_raw);

        // Map Nav Links
        $navigation = array_map(function($n) {
            return [
                'name' => $n->name,
                'href' => $n->href
            ];
        }, $nav_links);

        // Map Marquee
        $marquee_data = array_map(function($m) {
            return $m->text;
        }, $marquee);

        // Final Response
        $response = [
            'profile' => $profile_data,
            'socials' => $socials,
            'stats' => $stats,
            'about' => $about_data,
            'skills' => $skills,
            'experience' => $experience,
            'projects' => $projects,
            'education' => $education,
            'nav_links' => $navigation,
            'marquee' => $marquee_data
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
