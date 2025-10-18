<?php
class Login extends Controller {
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = $this->model('M_Login');
    }

    public function index() {
        // Data to pass to the login view
        $data = [
            'title' => 'Login - BookMyGround',
            'error' => '',
            'success' => ''
        ];

        // Handle POST request (when form is submitted)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get form data
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $remember = isset($_POST['remember']);

            // Basic validation
            if (empty($email) || empty($password)) {
                $data['error'] = 'Please fill in all fields';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['error'] = 'Please enter a valid email address';
            } else {
                // For now, just show a success message
                // Later this will be replaced with actual authentication
                $data['success'] = 'Login form submitted successfully!';
                
                // Store form data to show in case of error
                $data['email'] = $email;
                $data['remember'] = $remember;
            }
        }

        // Load the login view
        $this->view('login/v_login', $data);
    }

    public function forgot() {
        // Handle forgot password
        $data = [
            'title' => 'Forgot Password - BookMyGround'
        ];

        $this->view('login/v_forgot_password', $data);
    }

    public function register() {
        // Redirect to register page
        header('Location: ' . URLROOT . '/register');
        exit;
    }

    public function logout() {
        // Handle logout (for future use)
        session_start();
        session_destroy();
        header('Location: ' . URLROOT . '/login');
        exit;
    }
}