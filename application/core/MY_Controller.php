<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base Controller for API endpoints to handle CORS and global settings.
 */
class API_Base_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Enable CORS globally for all API controllers extending this class
        $this->handle_cors();

        // Handle preflight OPTIONS requests early
        if ($this->input->method() === 'options') {
            $this->output
                 ->set_status_header(200)
                 ->set_content_type('application/json', 'utf-8')
                 ->_display();
            exit;
        }
    }

    /**
     * Sets common CORS headers to allow cross-origin requests.
     */
    protected function handle_cors() {
        // Allow Lovable and other frontends to access the API
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        
        // Handle preflight for browsers
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header('HTTP/1.1 200 OK');
            exit();
        }
    }
    
    /**
     * Utility method to send JSON responses
     */
    protected function response($data, $status = 200) {
        return $this->output
            ->set_status_header($status)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data));
    }
}
