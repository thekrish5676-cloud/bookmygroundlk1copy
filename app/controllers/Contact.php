<?php
class Contact extends Controller {
    private $contactModel;

    public function __construct()
    {
        $this->contactModel = $this->model('M_Contact');
    }

    public function index() {
        // Contact page data
        $data = [
            'title' => 'Contact Us - BookMyGround',
            'page_title' => 'Contact Us',
            'page_subtitle' => 'Have questions about stadium bookings, equipment rentals, or coaching services? We\'re here to help! Reach out to us and we\'ll get back to you as soon as possible.',
            'contact_info' => [
                'main_phone' => '(071) 111 1111',
                'support_phone' => '(071) 222 2222', 
                'email' => 'support@bookmyground.lk',
                'support_email' => 'help@bookmyground.lk',
                'address' => '4200 Reid Avenue, Colombo 07',
                'working_hours' => 'Monday - Sunday: 6:00 AM - 10:00 PM',
                'emergency_contact' => '(071) 999 9999'
            ],
            'office_hours' => [
                ['day' => 'Monday - Friday', 'time' => '6:00 AM - 10:00 PM'],
                ['day' => 'Saturday', 'time' => '7:00 AM - 9:00 PM'],
                ['day' => 'Sunday', 'time' => '8:00 AM - 8:00 PM'],
                ['day' => 'Emergency Line', 'time' => '24/7 Available']
            ]
        ];

        $this->view('contact/v_contact', $data);
    }

    public function submit() {
        // Handle contact form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get form data
            $formData = [
                'first_name' => trim($_POST['firstName'] ?? ''),
                'last_name' => trim($_POST['lastName'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'phone' => trim($_POST['phone'] ?? ''),
                'subject' => $_POST['subject'] ?? '',
                'message' => trim($_POST['message'] ?? ''),
                'submitted_at' => date('Y-m-d H:i:s')
            ];

            // Basic validation
            $errors = [];
            
            if (empty($formData['first_name'])) {
                $errors[] = 'First name is required';
            }
            
            if (empty($formData['last_name'])) {
                $errors[] = 'Last name is required';
            }
            
            if (empty($formData['email'])) {
                $errors[] = 'Email is required';
            } elseif (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Please enter a valid email address';
            }
            
            if (empty($formData['subject'])) {
                $errors[] = 'Subject is required';
            }
            
            if (empty($formData['message'])) {
                $errors[] = 'Message is required';
            }

            if (empty($errors)) {
                // Save contact message
                if ($this->contactModel->saveContactMessage($formData)) {
                    // Success response for AJAX
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true, 'message' => 'Thank you! Your message has been sent successfully.']);
                    exit;
                } else {
                    $errors[] = 'Failed to send message. Please try again.';
                }
            }

            // Error response for AJAX
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'errors' => $errors]);
            exit;
        }

        // Redirect to contact page if not POST
        header('Location: ' . URLROOT . '/contact');
        exit;
    }

    public function support() {
        // Support page
        $data = [
            'title' => 'Support Center - BookMyGround',
            'page_title' => 'Support Center',
            'faq_categories' => $this->contactModel->getFAQCategories(),
            'common_issues' => $this->contactModel->getCommonIssues()
        ];

        $this->view('contact/v_support', $data);
    }
}
?>