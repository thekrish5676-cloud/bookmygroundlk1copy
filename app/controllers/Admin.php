<?php
class Admin extends Controller {
    private $adminModel;

    public function __construct()
    {
        $this->adminModel = $this->model('M_Admin');
    }

    public function index() {
        session_start();
        
        // Check if admin is logged in
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            // Redirect to main login page
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        // Dashboard data
        $stats = $this->adminModel->getDashboardStats();
        
        $data = [
            'title' => 'Admin Dashboard',
            'total_users' => $stats['total_users'] ?? 1250,
            'total_bookings' => 340,
            'monthly_revenue' => 85000,
            'pending_payouts' => 65000,
            'pending_refunds' => 5,
            'active_stadiums' => 45,
            'recent_bookings' => [
                ['id' => 1, 'stadium' => 'University Of Colombo Grounds', 'customer' => 'Kulakshi Thathsarani', 'amount' => 5000, 'date' => '2025-08-19'],
                ['id' => 2, 'stadium' => 'Dehiwala Indoor Lanka Court 1', 'customer' => 'Dinesh Sulakshana', 'amount' => 7500, 'date' => '2025-08-18'],
                ['id' => 3, 'stadium' => 'Tennis Academy Pannipitiya Courts', 'customer' => 'Kalana Ekanayake', 'amount' => 2500, 'date' => '2025-08-18']
            ],
            'pending_payouts_list' => [
                ['owner' => 'University Of Colombo', 'stadium' => 'University Of Colombo Basket Ball Court', 'amount' => 4000, 'commission' => 1000],
                ['owner' => 'Dehiwala Indoor Lanka', 'stadium' => 'Dehiwala Indoor Lanka Court 1', 'amount' => 6000, 'commission' => 1500]
            ]
        ];

        $this->view('admin/v_dashboard', $data);
    }

    // Remove the separate login method - admins now use main login
    public function login() {
        // Redirect to main login page
        header('Location: ' . URLROOT . '/login');
        exit;
    }

    public function logout() {
        session_start();
        
        // Clear admin session
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_email']);
        unset($_SESSION['admin_name']);
        unset($_SESSION['admin_role']);
        
        session_destroy();
        
        header('Location: ' . URLROOT . '/login');
        exit;
    }

    // ============= USER MANAGEMENT METHODS =============

    public function users() {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        // Get filters from GET parameters
        $filters = [
            'role' => $_GET['role'] ?? '',
            'status' => $_GET['status'] ?? '',
            'search' => $_GET['search'] ?? ''
        ];

        // Get all users with filters
        $users = $this->adminModel->getAllUsers($filters);
        
        // Get stats for display
        $stats = $this->adminModel->getDashboardStats();

        $data = [
            'title' => 'User Management',
            'users' => $users,
            'filters' => $filters,
            'stats' => [
                'total_users' => $stats['total_users'] ?? 0,
                'customers' => $stats['role_customer'] ?? 0,
                'stadium_owners' => $stats['role_stadium_owner'] ?? 0,
                'coaches' => $stats['role_coach'] ?? 0,
                'rental_owners' => $stats['role_rental_owner'] ?? 0,
                'active' => $stats['status_active'] ?? 0,
                'inactive' => $stats['status_inactive'] ?? 0,
                'suspended' => $stats['status_suspended'] ?? 0
            ]
        ];

        $this->view('admin/v_users', $data);
    }

    public function add_user() {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        $data = [
            'title' => 'Add New User',
            'error' => '',
            'success' => '',
            'form_data' => []
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->processAddUser($data);
        }

        $this->view('admin/v_add_user', $data);
    }

    public function edit_user($id = null) {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        if (!$id) {
            header('Location: ' . URLROOT . '/admin/users');
            exit;
        }

        $user = $this->adminModel->getUserById($id);
        
        if (!$user) {
            $_SESSION['error'] = 'User not found';
            header('Location: ' . URLROOT . '/admin/users');
            exit;
        }

        $data = [
            'title' => 'Edit User',
            'user' => $user,
            'error' => '',
            'success' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->processEditUser($id, $data);
        }

        $this->view('admin/v_edit_user', $data);
    }

    public function view_user($id = null) {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        if (!$id) {
            header('Location: ' . URLROOT . '/admin/users');
            exit;
        }

        $user = $this->adminModel->getUserById($id);
        
        if (!$user) {
            $_SESSION['error'] = 'User not found';
            header('Location: ' . URLROOT . '/admin/users');
            exit;
        }

        $data = [
            'title' => 'View User Details',
            'user' => $user
        ];

        $this->view('admin/v_view_user', $data);
    }

    public function delete_user($id = null) {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        if (!$id) {
            $_SESSION['error'] = 'Invalid user ID';
            header('Location: ' . URLROOT . '/admin/users');
            exit;
        }

        if ($this->adminModel->deleteUser($id)) {
            $_SESSION['success'] = 'User deleted successfully';
        } else {
            $_SESSION['error'] = 'Failed to delete user';
        }

        header('Location: ' . URLROOT . '/admin/users');
        exit;
    }

    public function suspend_user($id = null) {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        if (!$id) {
            $_SESSION['error'] = 'Invalid user ID';
            header('Location: ' . URLROOT . '/admin/users');
            exit;
        }

        if ($this->adminModel->updateUserStatus($id, 'suspended')) {
            $_SESSION['success'] = 'User suspended successfully';
        } else {
            $_SESSION['error'] = 'Failed to suspend user';
        }

        header('Location: ' . URLROOT . '/admin/users');
        exit;
    }

    public function activate_user($id = null) {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        if (!$id) {
            $_SESSION['error'] = 'Invalid user ID';
            header('Location: ' . URLROOT . '/admin/users');
            exit;
        }

        if ($this->adminModel->updateUserStatus($id, 'active')) {
            $_SESSION['success'] = 'User activated successfully';
        } else {
            $_SESSION['error'] = 'Failed to activate user';
        }

        header('Location: ' . URLROOT . '/admin/users');
        exit;
    }

    // AJAX endpoints for user management
    public function ajax_delete_user() {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }

        $id = $_POST['id'] ?? null;
        
        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'Invalid user ID']);
            exit;
        }

        if ($this->adminModel->deleteUser($id)) {
            echo json_encode(['success' => true, 'message' => 'User deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete user']);
        }
        exit;
    }

    public function ajax_update_status() {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }

        $id = $_POST['id'] ?? null;
        $status = $_POST['status'] ?? null;
        
        if (!$id || !$status || !in_array($status, ['active', 'inactive', 'suspended'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
            exit;
        }

        if ($this->adminModel->updateUserStatus($id, $status)) {
            echo json_encode(['success' => true, 'message' => 'User status updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update user status']);
        }
        exit;
    }

    // ============= HELPER METHODS =============

    private function processAddUser($data) {
        // Validate input
        $userData = [
            'first_name' => trim($_POST['first_name'] ?? ''),
            'last_name' => trim($_POST['last_name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'confirm_password' => $_POST['confirm_password'] ?? '',
            'role' => $_POST['role'] ?? '',
            'status' => $_POST['status'] ?? 'active'
        ];

        // Basic validation
        $errors = [];

        if (empty($userData['first_name'])) {
            $errors[] = 'First name is required';
        }

        if (empty($userData['last_name'])) {
            $errors[] = 'Last name is required';
        }

        if (empty($userData['email'])) {
            $errors[] = 'Email is required';
        } elseif (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address';
        } elseif ($this->adminModel->emailExists($userData['email'])) {
            $errors[] = 'Email already exists';
        }

        if (empty($userData['phone'])) {
            $errors[] = 'Phone number is required';
        }

        if (empty($userData['password'])) {
            $errors[] = 'Password is required';
        } elseif (strlen($userData['password']) < 6) {
            $errors[] = 'Password must be at least 6 characters long';
        }

        if ($userData['password'] !== $userData['confirm_password']) {
            $errors[] = 'Passwords do not match';
        }

        if (empty($userData['role'])) {
            $errors[] = 'User role is required';
        } elseif (!in_array($userData['role'], ['customer', 'stadium_owner', 'coach', 'rental_owner'])) {
            $errors[] = 'Invalid user role';
        }

        // Role-specific data validation
        if ($userData['role'] && !empty($_POST['profile_data'])) {
            $profileErrors = $this->validateProfileData($userData['role'], $_POST['profile_data']);
            $errors = array_merge($errors, $profileErrors);
            $userData[$userData['role'] . '_data'] = $_POST['profile_data'];
        }

        if (!empty($errors)) {
            $data['error'] = implode('<br>', $errors);
            $data['form_data'] = $userData;
            return $data;
        }

        // Create user
        $userId = $this->adminModel->createUser($userData);

        if ($userId) {
            $_SESSION['success'] = 'User created successfully';
            header('Location: ' . URLROOT . '/admin/users');
            exit;
        } else {
            $data['error'] = 'Failed to create user. Please try again.';
            $data['form_data'] = $userData;
        }

        return $data;
    }

    private function processEditUser($id, $data) {
        // Validate input
        $userData = [
            'first_name' => trim($_POST['first_name'] ?? ''),
            'last_name' => trim($_POST['last_name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'role' => $_POST['role'] ?? '',
            'status' => $_POST['status'] ?? 'active'
        ];

        // Basic validation
        $errors = [];

        if (empty($userData['first_name'])) {
            $errors[] = 'First name is required';
        }

        if (empty($userData['last_name'])) {
            $errors[] = 'Last name is required';
        }

        if (empty($userData['email'])) {
            $errors[] = 'Email is required';
        } elseif (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address';
        } elseif ($this->adminModel->emailExists($userData['email'], $id)) {
            $errors[] = 'Email already exists';
        }

        if (empty($userData['phone'])) {
            $errors[] = 'Phone number is required';
        }

        if (empty($userData['role'])) {
            $errors[] = 'User role is required';
        } elseif (!in_array($userData['role'], ['customer', 'stadium_owner', 'coach', 'rental_owner'])) {
            $errors[] = 'Invalid user role';
        }

        // Password update (optional)
        if (!empty($_POST['new_password'])) {
            if (strlen($_POST['new_password']) < 6) {
                $errors[] = 'Password must be at least 6 characters long';
            } elseif ($_POST['new_password'] !== $_POST['confirm_new_password']) {
                $errors[] = 'Passwords do not match';
            } else {
                // Update password separately
                $this->adminModel->updateUserPassword($id, $_POST['new_password']);
            }
        }

        // Role-specific data validation
        if ($userData['role'] && !empty($_POST['profile_data'])) {
            $profileErrors = $this->validateProfileData($userData['role'], $_POST['profile_data']);
            $errors = array_merge($errors, $profileErrors);
            $userData['profile_data'] = $_POST['profile_data'];
        }

        if (!empty($errors)) {
            $data['error'] = implode('<br>', $errors);
            return $data;
        }

        // Update user
        if ($this->adminModel->updateUser($id, $userData)) {
            $_SESSION['success'] = 'User updated successfully';
            header('Location: ' . URLROOT . '/admin/users');
            exit;
        } else {
            $data['error'] = 'Failed to update user. Please try again.';
        }

        return $data;
    }

    private function validateProfileData($role, $profileData) {
        $errors = [];

        switch($role) {
            case 'customer':
                if (empty($profileData['district'])) {
                    $errors[] = 'District is required for customer';
                }
                if (empty($profileData['sports'])) {
                    $errors[] = 'Sports preference is required for customer';
                }
                if (empty($profileData['age_group'])) {
                    $errors[] = 'Age group is required for customer';
                }
                if (empty($profileData['skill_level'])) {
                    $errors[] = 'Skill level is required for customer';
                }
                break;

            case 'stadium_owner':
                if (empty($profileData['owner_name'])) {
                    $errors[] = 'Owner name is required for stadium owner';
                }
                if (empty($profileData['business_name'])) {
                    $errors[] = 'Business name is required for stadium owner';
                }
                if (empty($profileData['district'])) {
                    $errors[] = 'District is required for stadium owner';
                }
                if (empty($profileData['venue_type'])) {
                    $errors[] = 'Venue type is required for stadium owner';
                }
                if (empty($profileData['business_registration'])) {
                    $errors[] = 'Business registration is required for stadium owner';
                }
                break;

            case 'coach':
                if (empty($profileData['specialization'])) {
                    $errors[] = 'Specialization is required for coach';
                }
                if (empty($profileData['experience'])) {
                    $errors[] = 'Experience is required for coach';
                }
                if (empty($profileData['certification'])) {
                    $errors[] = 'Certification is required for coach';
                }
                if (empty($profileData['coaching_type'])) {
                    $errors[] = 'Coaching type is required for coach';
                }
                if (empty($profileData['district'])) {
                    $errors[] = 'District is required for coach';
                }
                if (empty($profileData['availability'])) {
                    $errors[] = 'Availability is required for coach';
                }
                break;

            case 'rental_owner':
                if (empty($profileData['owner_name'])) {
                    $errors[] = 'Owner name is required for rental owner';
                }
                if (empty($profileData['business_name'])) {
                    $errors[] = 'Business name is required for rental owner';
                }
                if (empty($profileData['district'])) {
                    $errors[] = 'District is required for rental owner';
                }
                if (empty($profileData['business_type'])) {
                    $errors[] = 'Business type is required for rental owner';
                }
                if (empty($profileData['equipment_categories'])) {
                    $errors[] = 'Equipment categories is required for rental owner';
                }
                if (empty($profileData['delivery_service'])) {
                    $errors[] = 'Delivery service option is required for rental owner';
                }
                break;
        }

        return $errors;
    }

    // ============= OTHER EXISTING METHODS =============

    public function bookings() {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        $data = [
            'title' => 'Booking Management',
            'bookings' => [
                ['id' => 1, 'stadium' => 'University Of Colombo Football Court', 'customer' => 'Krishna Wishvajith', 'date' => '2025-08-19', 'amount' => 5000, 'status' => 'Completed'],
                ['id' => 2, 'stadium' => 'Dehiwala Indoor Lanka Court 1', 'customer' => 'Kulakshi Thathsarani', 'date' => '2025-08-20', 'amount' => 7500, 'status' => 'Pending'],
                ['id' => 3, 'stadium' => 'Tennis Academy Pannipitiya Court 1', 'customer' => 'Dinesh Sulakshana', 'date' => '2025-08-18', 'amount' => 2500, 'status' => 'Completed'],
                ['id' => 4, 'stadium' => 'Basketball Hub Angoda', 'customer' => 'Kalana Ekanayake', 'date' => '2025-08-21', 'amount' => 4000, 'status' => 'Pending'],
                ['id' => 5, 'stadium' => 'Multi-Purpose Courts Colombo 07', 'customer' => 'Kalana Ekanayake', 'date' => '2025-08-17', 'amount' => 6000, 'status' => 'Refunded']
            ]
        ];

        $this->view('admin/v_bookings', $data);
    }

    public function content() {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        $data = [
            'title' => 'Content Management',
            'hero_title' => 'BOOK YOUR SPORT GROUND',
            'hero_description' => 'Your All-in-One Solution for Finding and Booking Indoor & Outdoor Stadiums, Rent Sport Equipments, Attend Practise Sessions, Book Individual Coaching Sessions & Publish Your Advertisements',
            'hero_bg_image' => 'basketball-player.png'
        ];

        $this->view('admin/v_content', $data);
    }

    public function messages() {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        $data = [
            'title' => 'Message Center',
            'messages' => [
                ['id' => 1, 'from' => 'Kulakshi Thathsarani', 'subject' => 'Booking Cancellation Request', 'date' => '2025-08-19', 'status' => 'Unread'],
                ['id' => 2, 'from' => 'University Of Colombo', 'subject' => 'Payout Question', 'date' => '2025-08-18', 'status' => 'Read'],
                ['id' => 3, 'from' => 'Krishna Wishvajith', 'subject' => 'Equipment Rental Issue', 'date' => '2025-08-17', 'status' => 'Priority'],
                ['id' => 4, 'from' => 'Dinesh Sulakshana', 'subject' => 'Training Session Schedule', 'date' => '2025-08-16', 'status' => 'Read']
            ]
        ];

        $this->view('admin/v_messages', $data);
    }

    public function payouts() {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        $data = [
            'title' => 'Payout Management',
            'pending_payouts' => [
                ['owner' => 'University Of Colombo', 'stadium' => 'University Of Colombo Football Court', 'total_bookings' => 12, 'gross_amount' => 60000, 'commission' => 12000, 'net_payout' => 48000],
                ['owner' => 'Dehiwala Indoor Lanka', 'stadium' => 'Dehiwala Indoor Lanka Footsal Court', 'total_bookings' => 8, 'gross_amount' => 45000, 'commission' => 9000, 'net_payout' => 36000],
                ['owner' => 'Tennis Academy Pannipitiya', 'stadium' => 'Tennis Academy Tennis Court 1', 'total_bookings' => 15, 'gross_amount' => 37500, 'commission' => 7500, 'net_payout' => 30000]
            ],
            'completed_payouts' => [
                ['owner' => 'Basketball Hub', 'amount' => 25000, 'date' => '2025-08-12', 'status' => 'Completed'],
                ['owner' => 'Multi-Purpose Arena', 'amount' => 42000, 'date' => '2025-08-05', 'status' => 'Completed']
            ]
        ];

        $this->view('admin/v_payouts', $data);
    }

    public function refunds() {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        $data = [
            'title' => 'Refund Requests',
            'refund_requests' => [
                ['id' => 1, 'booking_id' => 'BK0032', 'customer' => 'Krishna Wishvajith', 'stadium' => 'Tennis Academy Courts', 'amount' => 2500, 'reason' => 'Weather conditions', 'date' => '2025-08-19', 'status' => 'Pending'],
                ['id' => 2, 'booking_id' => 'BK0028', 'customer' => 'Kulakshi Thathsarani', 'stadium' => 'Football Arena Pro', 'amount' => 7500, 'reason' => 'Emergency cancellation', 'date' => '2025-08-18', 'status' => 'Pending'],
                ['id' => 3, 'booking_id' => 'BK0025', 'customer' => 'Kalana Ekanayake', 'stadium' => 'Basketball Hub', 'amount' => 4000, 'reason' => 'Double booking error', 'date' => '2025-08-17', 'status' => 'Approved'],
                ['id' => 4, 'booking_id' => 'BK0022', 'customer' => 'Dinesh Sulakshana', 'stadium' => 'Cricket Ground', 'amount' => 5000, 'reason' => 'Facility unavailable', 'date' => '2025-08-16', 'status' => 'Processed']
            ]
        ];

        $this->view('admin/v_refunds', $data);
    }

    public function advertisements() {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        $data = [
            'title' => 'Advertisement Management',
            'pending_ads' => [
                ['id' => 1, 'company' => 'Sport Gear Lanka', 'contact' => 'John Silva', 'email' => 'john@sportgear.lk', 'phone' => '0712345678', 'amount' => 15000, 'status' => 'Payment Pending', 'submitted' => '2025-08-19'],
                ['id' => 2, 'company' => 'Kalana Lanka Pvt Ltd', 'contact' => 'Sarath Fernando', 'email' => 'sarath@kalanalanka.lk', 'phone' => '0773456789', 'amount' => 20000, 'status' => 'Payment Submitted', 'submitted' => '2025-08-18'],
                ['id' => 3, 'company' => 'Sports Store', 'contact' => 'Kulassi Thathsarani', 'email' => 'thathsaranikulakshi@gmail.com', 'phone' => '0765432100', 'amount' => 12000, 'status' => 'Verified', 'submitted' => '2025-08-17']
            ],
            'published_ads' => [
                ['id' => 1, 'company' => 'Nike Sri Lanka', 'type' => 'Image', 'published' => '2025-08-15', 'expires' => '2025-09-15', 'status' => 'Active'],
                ['id' => 2, 'company' => 'Adidas Store', 'type' => 'Video', 'published' => '2025-08-10', 'expires' => '2025-09-10', 'status' => 'Active']
            ]
        ];

        $this->view('admin/v_advertisements', $data);
    }

    public function faq() {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        $data = [
            'title' => 'FAQ Management',
            'faqs' => [
                ['id' => 1, 'question' => 'How do I book a stadium?', 'answer' => 'You can book a stadium by browsing our available venues, selecting your preferred date and time, and completing the payment process.', 'category' => 'Booking', 'status' => 'Published', 'updated' => '2025-08-15'],
                ['id' => 2, 'question' => 'What is your cancellation policy?', 'answer' => 'Cancellations made 6 hours before the booking time are eligible for full refund. Cancellations within 24 hours may incur charges.', 'category' => 'Policies', 'status' => 'Published', 'updated' => '2025-08-12'],
                ['id' => 3, 'question' => 'Do you provide sports equipment?', 'answer' => 'Yes, we offer equipment rental services for various sports including cricket, football, basketball, and tennis.', 'category' => 'Equipment', 'status' => 'Published', 'updated' => '2025-08-10']
            ]
        ];

        $this->view('admin/v_faq', $data);
    }

    public function blog() {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        $data = [
            'title' => 'Blog Management',
            'posts' => [
                ['id' => 1, 'title' => 'Top 10 Cricket Grounds in Colombo', 'author' => 'Admin', 'category' => 'Cricket', 'status' => 'Published', 'published' => '2025-08-18', 'views' => 1250],
                ['id' => 2, 'title' => 'Football Training Tips for Beginners', 'author' => 'Krishna Wishvajith', 'category' => 'Football', 'status' => 'Draft', 'published' => '', 'views' => 0],
                ['id' => 3, 'title' => 'Benefits of Playing Tennis', 'author' => 'Dr. Dinesh', 'category' => 'Tennis', 'status' => 'Published', 'published' => '2025-08-15', 'views' => 980]
            ]
        ];

        $this->view('admin/v_blog', $data);
    }

    public function contact() {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        $data = [
            'title' => 'Contact Page Management',
            'contact_info' => [
                'main_phone' => '(071) 111 1111',
                'support_phone' => '(071) 222 2222',
                'email' => 'support@bookmyground.lk',
                'support_email' => 'help@bookmyground.lk',
                'address' => '4200 Reid Avenue, Colombo 07',
                'working_hours' => 'Monday - Sunday: 6:00 AM - 10:00 PM',
                'emergency_contact' => '(071) 999 9999'
            ]
        ];

        $this->view('admin/v_contact', $data);
    }
}
            '