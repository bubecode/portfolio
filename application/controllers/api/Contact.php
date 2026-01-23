<?php
include_once(APPPATH . "core/MY_Controller.php");
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends API_Base_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Contact_model');
        $this->load->library('form_validation');
        $this->load->library('email');
    }

    public function index() {
        // Only allow POST
        if ($this->input->method() !== 'post') {
            $this->response(['status' => 'error', 'message' => 'Method not allowed'], 405);
            return;
        }


        
        // Get data from JSON or POST
        $post_data = json_decode(file_get_contents('php://input'), true);
        if (!$post_data) {
            // Fallback to standard POST data if JSON is not present
            $post_data = $this->input->post();
        }

        if (!$post_data) {
            $this->response(['status' => 'error', 'message' => 'No data received. Please send JSON or Form data.'], 400);
            return;
        }

        // Apply rules manually since form_validation works with $_POST array
        $name = isset($post_data['name']) ? trim($post_data['name']) : '';
        $email = isset($post_data['email']) ? trim($post_data['email']) : '';
        $message = isset($post_data['message']) ? trim($post_data['message']) : '';

        $errors = [];
        if (strlen($name) < 2) $errors['name'] = 'Name must be at least 2 characters';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Invalid email address';
        if (strlen($message) < 10) $errors['message'] = 'Message must be at least 10 characters';

        if (!empty($errors)) {
            $this->response(['status' => 'error', 'errors' => $errors], 422);
            return;
        }

        // Prepare data
        $data = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'ip_address' => $this->input->ip_address(),
            'user_agent' => $this->input->user_agent()
        ];

        // 1. Save to DB
        if ($this->Contact_model->insert_contact($data)) {
            
            // 2. Send Email
            $this->send_notification_email($data);

            $this->response([
                'status' => 'success',
                'message' => 'Message sent successfully. I will respond within 24 hours.'
            ], 200);
        } else {
            $this->response([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    private function send_notification_email($data) {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => getenv('SMTP_USER') ?: 'bube.dev@gmail.com',
            'smtp_pass' => getenv('SMTP_PASS'),
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1',
            'newline'   => "\r\n"
        );

        $this->email->initialize($config);
        $this->email->from('no-reply@portfolio.com', 'Portfolio Contact');
        $this->email->to(getenv('SMTP_USER') ?: 'bube.dev@gmail.com');
        $this->email->subject('New Portfolio Contact Message');

        $body = "<h2>New Contact Message</h2>";
        $body .= "<p><strong>Name:</strong> {$data['name']}</p>";
        $body .= "<p><strong>Email:</strong> {$data['email']}</p>";
        $body .= "<p><strong>Message:</strong><br>" . nl2br($data['message']) . "</p>";
        $body .= "<p><strong>Date:</strong> " . date('Y-m-d H:i:s') . "</p>";
        $body .= "<p><strong>IP Address:</strong> {$data['ip_address']}</p>";

        $this->email->message($body);
        
        // We don't block success on email failure as per requirement
        $this->email->send();
    }
}
