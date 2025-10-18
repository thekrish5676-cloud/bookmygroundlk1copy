<?php
class Login extends Controller {
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = $this->model('M_Login');
    }

    public function index() {
        // Check if already logged in
        session_start();
        if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
            $this->redirectToDashboard($_SESSION['user_role']);
            return;
        }

        // Check if admin is logged in
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            header('Location: ' . URLROOT . '/admin');
            exit;
        }

        // Data to pass to the login view
        $data = [
            'title' => 'Login - BookMyGround',
            'error' => '',
            'success' => ''
        ];

        // Handle POST request (when form is submitted)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->processLogin($data);
        }

        // Load the login view
        $this->view('login/v_login', $data);
    }

    private function processLogin($data) {
        // Get form data
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $remember = isset($_POST['remember']);

        // Basic validation
        if (empty($email) || empty($password)) {
            $data['error'] = 'Please fill in all fields';
            return $data;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data['error'] = 'Please enter a valid email address';
            return $data;
        }

        // Check for too many login attempts
        $attempts = $this->loginModel->getLoginAttempts($email);
        if ($attempts >= 5) {
            $data['error'] = 'Too many failed login attempts. Please try again after 15 minutes.';
            return $data;
        }

        // Attempt to authenticate user (this now checks both users and admins)
        $user = $this->loginModel->login($email, $password);
        
        if ($user) {
            // Check if it's an admin
            if ($user->role === 'admin') {
                // Admin login process
                if ($user->status !== 'active') {
                    $data['error'] = 'Your admin account is inactive. Please contact system administrator.';
                    return $data;
                }

                // Clear any previous login attempts
                $this->loginModel->clearLoginAttempts($email);
                
                // Update last login for admin
                $this->loginModel->updateLastLogin($user->id, true);
                
                // Start session and set admin session variables
                session_start();
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $user->id;
                $_SESSION['admin_email'] = $user->email;
                $_SESSION['admin_name'] = $user->full_name;
                $_SESSION['admin_role'] = 'admin';

                // Log the activity
                $this->loginModel->logActivity($user->id, 'Admin logged in', true);

                // Redirect to admin dashboard
                header('Location: ' . URLROOT . '/admin');
                exit;

            } else {
                // Regular user login process
                if ($user->status !== 'active') {
                    $statusMsg = $user->status === 'pending' ? 'pending approval' : $user->status;
                    $data['error'] = "Your account is currently {$statusMsg}. Please contact support if you need assistance.";
                    return $data;
                }

                // Clear any previous login attempts
                $this->loginModel->clearLoginAttempts($email);
                
                // Update last login
                $this->loginModel->updateLastLogin($user->id);
                
                // Start session and set session variables
                session_start();
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_email'] = $user->email;
                $_SESSION['user_name'] = $user->first_name . ' ' . $user->last_name;
                $_SESSION['user_role'] = $user->role;
                $_SESSION['user_first_name'] = $user->first_name;
                $_SESSION['user_last_name'] = $user->last_name;
                $_SESSION['user_status'] = $user->status;

                // Set remember me cookie if requested
                if ($remember) {
                    $token = bin2hex(random_bytes(32));
                    setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/'); // 30 days
                }

                // Log the activity
                $this->loginModel->logActivity($user->id, 'User logged in');

                // Redirect to appropriate dashboard
                $this->redirectToDashboard($user->role);
            }
            
        } else {
            // Record failed login attempt
            $this->loginModel->recordLoginAttempt($email, $_SERVER['REMOTE_ADDR']);
            
            $data['error'] = 'Invalid email or password';
            $data['email'] = $email; // Keep email in form
        }

        return $data;
    }

    private function redirectToDashboard($role) {
        switch($role) {
            case 'customer':
                header('Location: ' . URLROOT . '/customer');
                break;
            case 'stadium_owner':
                header('Location: ' . URLROOT . '/stadium_owner');
                break;
            case 'coach':
                header('Location: ' . URLROOT . '/coach');
                break;
            case 'rental_owner':
                header('Location: ' . URLROOT . '/rental_owner');
                break;
            case 'admin':
                header('Location: ' . URLROOT . '/admin');
                break;
            default:
                header('Location: ' . URLROOT . '/customer');
                break;
        }
        exit;
    }

    public function forgot() {
        // Handle forgot password for both users and admins
        $data = [
            'title' => 'Forgot Password - BookMyGround',
            'error' => '',
            'success' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email'] ?? '');
            
            if (empty($email)) {
                $data['error'] = 'Please enter your email address';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['error'] = 'Please enter a valid email address';
            } elseif ($this->loginModel->emailExists($email)) {
                // Generate password reset token
                $token = $this->loginModel->createPasswordResetToken($email);
                if ($token) {
                    $data['success'] = 'Password reset instructions have been sent to your email address.';
                } else {
                    $data['error'] = 'Unable to process password reset. Please try again.';
                }
            } else {
                $data['error'] = 'No account found with that email address.';
            }
        }

        $this->view('login/v_forgot_password', $data);
    }

    public function logout() {
        session_start();
        
        // Log the activity
        if (isset($_SESSION['user_id'])) {
            $this->loginModel->logActivity($_SESSION['user_id'], 'User logged out');
        } elseif (isset($_SESSION['admin_id'])) {
            $this->loginModel->logActivity($_SESSION['admin_id'], 'Admin logged out', true);
        }
        
        // Clear session
        session_destroy();
        
        // Clear remember me cookie
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/');
        }
        
        // Redirect to login page
        header('Location: ' . URLROOT . '/login');
        exit;
    }

    public function register() {
        // Redirect to register page
        header('Location: ' . URLROOT . '/register');
        exit;
    }
}