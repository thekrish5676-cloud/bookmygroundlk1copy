<?php
class Auth extends Controller
{
    private $authModel;

    public function __construct()
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->authModel = $this->model('M_Auth');
    }

    // ============ LOGIN ============

    public function login()
    {
        // Redirect if already logged in
        if (isset($_SESSION['user_id'])) {
            $this->redirectToDashboard();
            return;
        }

        $data = [
            'title' => 'Login - BookMyGround',
            'email' => '',
            'error' => '',
            'success' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $remember = isset($_POST['remember']);

            // Validation
            if (empty($email) || empty($password)) {
                $data['error'] = 'Please fill in all fields';
                $data['email'] = $email;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['error'] = 'Please enter a valid email address';
                $data['email'] = $email;
            } else {
                // Check login attempts
                $attempts = $this->authModel->getLoginAttempts($email);
                if ($attempts >= 5) {
                    $data['error'] = 'Too many login attempts. Please try again in 15 minutes.';
                    $data['email'] = $email;
                    $this->view('login/v_login', $data);
                    return;
                }

                // Try admin login first
                if ($email === 'krishnawishvajith@gmail.com') {
                    $admin = $this->authModel->authenticateAdmin($email, $password);

                    if ($admin) {
                        // Clear login attempts
                        $this->authModel->clearLoginAttempts($email);

                        // Set session
                        $_SESSION['user_id'] = $admin->id;
                        $_SESSION['user_role'] = 'admin';
                        $_SESSION['user_email'] = $admin->email;
                        $_SESSION['user_name'] = $admin->name;

                        // Redirect to admin dashboard
                        header('Location: ' . URLROOT . '/admin');
                        exit;
                    } else {
                        // Record failed attempt
                        $this->authModel->recordLoginAttempt($email, $_SERVER['REMOTE_ADDR']);
                        $data['error'] = 'Invalid email or password';
                        $data['email'] = $email;
                    }
                } else {
                    // Try user login
                    $user = $this->authModel->authenticateUser($email, $password);

                    if ($user) {
                        // Clear login attempts
                        $this->authModel->clearLoginAttempts($email);

                        // Set session
                        $_SESSION['user_id'] = $user->id;
                        $_SESSION['user_role'] = $user->role;
                        $_SESSION['user_email'] = $user->email;
                        $_SESSION['user_name'] = $user->first_name . ' ' . $user->last_name;

                        // Redirect based on role
                        $this->redirectToDashboard();
                        exit;
                    } else {
                        // Record failed attempt
                        $this->authModel->recordLoginAttempt($email, $_SERVER['REMOTE_ADDR']);
                        $data['error'] = 'Invalid email or password';
                        $data['email'] = $email;
                    }
                }
            }
        }

        // Load your existing login view
        $this->view('login/v_login', $data);
    }

    // ============ REGISTER (Role Selection) ============

    public function register($role = null)
    {
        // Redirect if already logged in
        if (isset($_SESSION['user_id'])) {
            $this->redirectToDashboard();
            return;
        }

        // If no role specified, show role selection page
        if ($role === null) {
            $data = ['title' => 'Register - Choose Your Role'];
            $this->view('signup/v_signup', $data);
            return;
        }

        // Handle specific role registration
        $this->registerRole($role);
    }

    // ============ ROLE-SPECIFIC REGISTRATION ============

    private function registerRole($role)
    {
        // Validate role
        $validRoles = ['customer', 'stadium_owner', 'coach', 'rental_owner'];
        if (!in_array($role, $validRoles)) {
            header('Location: ' . URLROOT . '/auth/register');
            exit;
        }

        $data = [
            'title' => 'Register - ' . ucfirst(str_replace('_', ' ', $role)),
            'role' => $role,
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'phone' => '',
            'error_first_name' => '',
            'error_last_name' => '',
            'error_email' => '',
            'error_phone' => '',
            'error_password' => '',
            'error_confirm_password' => '',
            'error' => '',
            'success' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Get form data based on role
            if ($role === 'customer' || $role === 'coach') {
                $data['first_name'] = trim($_POST['first-name'] ?? '');
                $data['last_name'] = trim($_POST['last-name'] ?? '');
            } else {
                // For owner and rental, use owner-name field
                $fullName = trim($_POST['owner-name'] ?? '');
                $nameParts = explode(' ', $fullName, 2);
                $data['first_name'] = $nameParts[0];
                $data['last_name'] = $nameParts[1] ?? '';
            }

            $data['email'] = trim($_POST['email']);
            $data['phone'] = trim($_POST['phone']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm-password'] ?? $_POST['confirm_password'] ?? '');

            // Validation
            $hasError = false;

            if (empty($data['first_name'])) {
                $data['error_first_name'] = 'Please enter your first name';
                $hasError = true;
            }

            if (empty($data['last_name'])) {
                $data['error_last_name'] = 'Please enter your last name';
                $hasError = true;
            }

            if (empty($data['email'])) {
                $data['error_email'] = 'Please enter your email';
                $hasError = true;
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['error_email'] = 'Please enter a valid email';
                $hasError = true;
            } elseif ($this->authModel->emailExists($data['email'])) {
                $data['error_email'] = 'Email already registered';
                $hasError = true;
            }

            if (empty($data['phone'])) {
                $data['error_phone'] = 'Please enter your phone number';
                $hasError = true;
            } elseif ($this->authModel->phoneExists($data['phone'])) {
                $data['error_phone'] = 'Phone number already registered';
                $hasError = true;
            }

            if (empty($password)) {
                $data['error_password'] = 'Please enter a password';
                $hasError = true;
            } elseif (strlen($password) < 8) {
                $data['error_password'] = 'Password must be at least 8 characters';
                $hasError = true;
            }

            if ($password !== $confirm_password) {
                $data['error_confirm_password'] = 'Passwords do not match';
                $hasError = true;
            }

            // If no errors, register user
            if (!$hasError) {
                $userData = [
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'password' => $password,
                    'role' => $role
                ];

                $userId = $this->authModel->registerUser($userData);

                if ($userId) {
                    // Auto login after registration
                    $_SESSION['user_id'] = $userId;
                    $_SESSION['user_role'] = $role;
                    $_SESSION['user_email'] = $data['email'];
                    $_SESSION['user_name'] = $data['first_name'] . ' ' . $data['last_name'];

                    // Redirect to dashboard
                    $this->redirectToDashboard();
                    exit;
                } else {
                    $data['error'] = 'Something went wrong. Please try again.';
                }
            }
        }

        // Load appropriate view based on role
        $viewMap = [
            'customer' => 'signup/v_signupcustomer',
            'stadium_owner' => 'signup/v_signupowner',
            'coach' => 'signup/v_signupcoach',
            'rental_owner' => 'signup/v_signuprental'
        ];

        $this->view($viewMap[$role], $data);
    }

    // ============ LOGOUT ============

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ' . URLROOT . '/auth/login');
        exit;
    }

    // ============ HELPER METHODS ============

    private function redirectToDashboard()
    {
        $role = $_SESSION['user_role'] ?? null;

        switch ($role) {
            case 'admin':
                header('Location: ' . URLROOT . '/admin');
                break;
            case 'customer':
                header('Location: ' . URLROOT . '/customer');
                break;
            case 'stadium_owner':
                header('Location: ' . URLROOT . '/stadiumowner');
                break;
            case 'coach':
                header('Location: ' . URLROOT . '/coach');
                break;
            case 'rental_owner':
                header('Location: ' . URLROOT . '/rentalowner');
                break;
            default:
                header('Location: ' . URLROOT . '/home');
        }
    }
}
