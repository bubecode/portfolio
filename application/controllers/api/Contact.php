<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('email');
    }

    public function index() {
        // Only allow POST
        if ($this->input->method() !== 'post') {
            $this->output
                ->set_status_header(405)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Method Not Allowed']));
            return;
        }

        // Get JSON input
        $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
        $request = json_decode($stream_clean);
        
        if (!$request) {
             // Fallback to standard POST if not JSON body
             $name = $this->input->post('name', TRUE);
             $email = $this->input->post('email', TRUE);
             $message = $this->input->post('message', TRUE);
        } else {
             $name = isset($request->name) ? $request->name : '';
             $email = isset($request->email) ? $request->email : '';
             $message = isset($request->message) ? $request->message : '';
        }

        if (empty($name) || empty($email) || empty($message)) {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'All fields are required']));
            return;
        }

        // Email Config (Basic mail() or SMTP would be configured in config/email.php)
        $this->email->from($email, $name);
        $this->email->to('bube.dev@gmail.com');
        $this->email->subject('New Contact from Portfolio: ' . $name);
        $this->email->message($message);

        // Simulation for dev environment since no SMTP creds provided
        // In production, uncomment send()
        // $sent = $this->email->send();
        $sent = TRUE; 

        if ($sent) {
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode(['success' => 'Message sent successfully']));
        } else {
            $this->output
                ->set_status_header(500)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Failed to send message']));
        }
    }
}
