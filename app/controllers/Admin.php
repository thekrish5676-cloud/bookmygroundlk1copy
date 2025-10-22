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
        $data = [
            'title' => 'Admin Dashboard',
            'total_users' => $this->adminModel->getTotalUsers(),
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

    public function users() {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        // Get all users from database
        $users = $this->adminModel->getAllUsers();

        $data = [
            'title' => 'User Management',
            'users' => $users
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

    private function processAddUser($data) {
        // Get and validate form data
        $formData = [
            'first_name' => trim($_POST['first_name'] ?? ''),
            'last_name' => trim($_POST['last_name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'role' => $_POST['role'] ?? '',
            'password' => $_POST['password'] ?? '',
            'confirm_password' => $_POST['confirm_password'] ?? ''
        ];

        $data['form_data'] = $formData;

        // Validation
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

        if (empty($formData['phone'])) {
            $errors[] = 'Phone number is required';
        }

        if (empty($formData['role'])) {
            $errors[] = 'Please select a role';
        } elseif (!in_array($formData['role'], ['customer', 'stadium_owner', 'coach', 'rental_owner'])) {
            $errors[] = 'Invalid role selected';
        }

        if (empty($formData['password'])) {
            $errors[] = 'Password is required';
        } elseif (strlen($formData['password']) < 6) {
            $errors[] = 'Password must be at least 6 characters long';
        }

        if ($formData['password'] !== $formData['confirm_password']) {
            $errors[] = 'Passwords do not match';
        }

        // Check if email already exists
        if (empty($errors) && $this->adminModel->emailExists($formData['email'])) {
            $errors[] = 'Email address already exists';
        }

        if (!empty($errors)) {
            $data['error'] = implode('<br>', $errors);
            return $data;
        }

        // Create user
        $userId = $this->adminModel->createUser($formData);

        if ($userId) {
            // Create role-specific profile if needed
            $this->createRoleProfile($userId, $formData);
            
            $data['success'] = 'User created successfully!';
            $data['form_data'] = []; // Clear form data on success
        } else {
            $data['error'] = 'Failed to create user. Please try again.';
        }

        return $data;
    }

    private function createRoleProfile($userId, $formData) {
        // Create basic profiles for different roles
        // This can be expanded later with more specific fields
        switch($formData['role']) {
            case 'customer':
                $this->adminModel->createCustomerProfile($userId, [
                    'district' => 'Not specified',
                    'sports' => 'Not specified',
                    'age_group' => 'under_18',
                    'skill_level' => 'beginner'
                ]);
                break;
            case 'stadium_owner':
                $this->adminModel->createStadiumOwnerProfile($userId, [
                    'owner_name' => $formData['first_name'] . ' ' . $formData['last_name'],
                    'business_name' => 'Not specified',
                    'district' => 'Not specified',
                    'venue_type' => 'stadium',
                    'business_registration' => 'Not specified'
                ]);
                break;
            case 'coach':
                $this->adminModel->createCoachProfile($userId, [
                    'specialization' => 'Not specified',
                    'experience' => '1_3',
                    'certification' => 'basic',
                    'coaching_type' => 'individual',
                    'district' => 'Not specified',
                    'availability' => 'part_time'
                ]);
                break;
            case 'rental_owner':
                $this->adminModel->createRentalOwnerProfile($userId, [
                    'owner_name' => $formData['first_name'] . ' ' . $formData['last_name'],
                    'business_name' => 'Not specified',
                    'district' => 'Not specified',
                    'business_type' => 'independent',
                    'equipment_categories' => 'Not specified',
                    'delivery_service' => 'no'
                ]);
                break;
        }
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

        $data = [
            'title' => 'Edit User',
            'error' => '',
            'success' => '',
            'user' => $this->adminModel->getUserById($id),
            'form_data' => []
        ];

        if (!$data['user']) {
            $_SESSION['admin_error'] = 'User not found.';
            header('Location: ' . URLROOT . '/admin/users');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->processEditUser($data, $id);
        }

        $this->view('admin/v_edit_user', $data);
    }

    private function processEditUser($data, $userId) {
        $formData = [
            'first_name' => trim($_POST['first_name'] ?? ''),
            'last_name' => trim($_POST['last_name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'status' => $_POST['status'] ?? '',
            'reset_password' => isset($_POST['reset_password']),
            'new_password' => $_POST['new_password'] ?? '',
            'confirm_password' => $_POST['confirm_password'] ?? ''
        ];

        $data['form_data'] = $formData;

        // Validation
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

        if (empty($formData['phone'])) {
            $errors[] = 'Phone number is required';
        }

        if (empty($formData['status'])) {
            $errors[] = 'Status is required';
        }

        // Password validation only if reset_password is checked
        if ($formData['reset_password']) {
            if (empty($formData['new_password'])) {
                $errors[] = 'New password is required when resetting password';
            } elseif (strlen($formData['new_password']) < 6) {
                $errors[] = 'Password must be at least 6 characters long';
            }

            if ($formData['new_password'] !== $formData['confirm_password']) {
                $errors[] = 'Passwords do not match';
            }
        }

        // Check if email exists for other users
        if (empty($errors) && $this->adminModel->emailExistsForOtherUser($formData['email'], $userId)) {
            $errors[] = 'Email address already exists for another user';
        }

        if (!empty($errors)) {
            $data['error'] = implode('<br>', $errors);
            return $data;
        }

        // Update user
        $updateSuccess = $this->adminModel->updateUser($userId, $formData);
        
        // Update password if requested
        if ($updateSuccess && $formData['reset_password']) {
            $updateSuccess = $this->adminModel->updateUserPassword($userId, $formData['new_password']);
        }

        if ($updateSuccess) {
            $_SESSION['admin_message'] = 'User updated successfully!';
            header('Location: ' . URLROOT . '/admin/users');
            exit;
        } else {
            $data['error'] = 'Failed to update user. Please try again.';
        }

        return $data;
    }

    public function delete_user($id = null) {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        if (!$id) {
            header('Location: ' . URLROOT . '/admin/users');
            exit;
        }

        if ($this->adminModel->deleteUser($id)) {
            $_SESSION['admin_message'] = 'User deleted successfully!';
        } else {
            $_SESSION['admin_error'] = 'Failed to delete user.';
        }

        header('Location: ' . URLROOT . '/admin/users');
        exit;
    }

    public function toggle_user_status($id = null) {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }

        if (!$id) {
            header('Location: ' . URLROOT . '/admin/users');
            exit;
        }

        if ($this->adminModel->toggleUserStatus($id)) {
            $_SESSION['admin_message'] = 'User status updated successfully!';
        } else {
            $_SESSION['admin_error'] = 'Failed to update user status.';
        }

        header('Location: ' . URLROOT . '/admin/users');
        exit;
    }

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

    public function listings() {
    session_start();
    
    if (!isset($_SESSION['admin_logged_in'])) {
        header('Location: ' . URLROOT . '/login');
        exit;
    }

    $data = [
        'title' => 'Stadium Listings Management',
        'active_listings' => [
            ['id' => 1, 'name' => 'Colombo Cricket Ground', 'owner' => 'Rajesh Kumar', 'type' => 'Cricket', 'category' => 'Outdoor', 'price' => 5000, 'location' => 'Colombo 03', 'status' => 'Active', 'featured' => true, 'created' => '2025-01-15', 'views' => 245, 'bookings' => 12],
            ['id' => 2, 'name' => 'Football Arena Pro', 'owner' => 'David Fernando', 'type' => 'Football', 'category' => 'Outdoor', 'price' => 7500, 'location' => 'Colombo 05', 'status' => 'Active', 'featured' => true, 'created' => '2025-01-10', 'views' => 189, 'bookings' => 8],
            ['id' => 3, 'name' => 'Tennis Academy Courts', 'owner' => 'Michelle Perera', 'type' => 'Tennis', 'category' => 'Outdoor', 'price' => 2500, 'location' => 'Colombo 06', 'status' => 'Active', 'featured' => false, 'created' => '2025-01-08', 'views' => 156, 'bookings' => 5],
        ],
        'pending_listings' => [
            ['id' => 4, 'name' => 'New Basketball Court', 'owner' => 'Kevin Rodrigo', 'type' => 'Basketball', 'category' => 'Indoor', 'price' => 4000, 'location' => 'Colombo 04', 'status' => 'Pending', 'submitted' => '2025-01-20', 'reason' => 'New listing awaiting approval'],
            ['id' => 5, 'name' => 'Swimming Pool Complex', 'owner' => 'Sarah Johnson', 'type' => 'Swimming', 'category' => 'Outdoor', 'price' => 6000, 'location' => 'Mount Lavinia', 'status' => 'Pending', 'submitted' => '2025-01-19', 'reason' => 'Missing documentation'],
        ],
        'expired_listings' => [
            ['id' => 6, 'name' => 'Old Badminton Hall', 'owner' => 'Former Owner', 'type' => 'Badminton', 'category' => 'Indoor', 'price' => 3000, 'location' => 'Colombo 02', 'status' => 'Expired', 'expired' => '2025-01-01', 'last_booking' => '2024-12-15'],
        ],
        'statistics' => [
            'total_listings' => 25,
            'active_listings' => 18,
            'pending_approval' => 4,
            'expired_listings' => 3,
            'featured_listings' => 6,
            'this_month_revenue' => 125000
        ]
    ];

    $this->view('admin/v_listings', $data);
}

public function edit_listing($id = null) {
    session_start();
    
    if (!isset($_SESSION['admin_logged_in'])) {
        header('Location: ' . URLROOT . '/login');
        exit;
    }

    if (!$id) {
        header('Location: ' . URLROOT . '/admin/listings');
        exit;
    }

    // Sample data - replace with actual database query
    $data = [
        'title' => 'Edit Stadium Listing',
        'listing' => [
            'id' => $id,
            'name' => 'Colombo Cricket Ground',
            'owner' => 'Rajesh Kumar',
            'owner_email' => 'rajesh@email.com',
            'type' => 'Cricket',
            'category' => 'Outdoor',
            'price' => 5000,
            'location' => 'Colombo 03',
            'address' => '123 Cricket Street, Colombo 03',
            'description' => 'Professional cricket ground with modern facilities',
            'features' => ['Lighting', 'Parking', 'WiFi', 'Changing Rooms'],
            'status' => 'Active',
            'featured' => true,
            'images' => ['cricket-ground-1.jpg', 'cricket-ground-2.jpg'],
            'created' => '2025-01-15',
            'views' => 245,
            'bookings' => 12
        ]
    ];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Handle form submission
        $data['success'] = 'Listing updated successfully!';
    }

    $this->view('admin/v_edit_listing', $data);
}

public function packages() {
    session_start();
    
    if (!isset($_SESSION['admin_logged_in'])) {
        header('Location: ' . URLROOT . '/login');
        exit;
    }

    // Sample package data - later you can fetch from database
    $data = [
        'title' => 'Package Management',
        'packages' => [
            'basic' => [
                'id' => 1,
                'name' => 'Basic',
                'monthly_fee' => 0,
                'commission_rate' => 8,
                'stadium_limit' => 3,
                'photos_limit' => 3,
                'videos_limit' => 3,
                'featured_limit' => 0,
                'support_level' => 'email',
                'features' => [
                    'booking_management' => true,
                    'payment_processing' => true,
                    'advanced_analytics' => false,
                    'marketing_tools' => false,
                    'api_access' => false
                ],
                'description' => 'Perfect for getting started with stadium rentals',
                'status' => 'active',
                'users_count' => 25
            ],
            'standard' => [
                'id' => 2,
                'name' => 'Standard',
                'monthly_fee' => 0,
                'commission_rate' => 12,
                'stadium_limit' => 6,
                'photos_limit' => 5,
                'videos_limit' => 5,
                'featured_limit' => 3,
                'support_level' => 'phone',
                'features' => [
                    'booking_management' => true,
                    'payment_processing' => true,
                    'advanced_analytics' => true,
                    'marketing_tools' => true,
                    'api_access' => false
                ],
                'description' => 'Ideal for growing stadium businesses',
                'status' => 'active',
                'users_count' => 15,
                'popular' => true
            ],
            'gold' => [
                'id' => 3,
                'name' => 'Gold',
                'monthly_fee' => 0,
                'commission_rate' => 20,
                'stadium_limit' => 999, // unlimited
                'photos_limit' => 10,
                'videos_limit' => 5,
                'featured_limit' => 5,
                'support_level' => 'priority',
                'features' => [
                    'booking_management' => true,
                    'payment_processing' => true,
                    'advanced_analytics' => true,
                    'marketing_tools' => true,
                    'api_access' => true,
                    'dedicated_manager' => true
                ],
                'description' => 'For established stadium owners who want maximum exposure',
                'status' => 'active',
                'users_count' => 5,
                'premium' => true
            ]
        ],
        'statistics' => [
            'total_packages' => 3,
            'active_packages' => 3,
            'total_users' => 45,
            'monthly_revenue' => 125000,
            'avg_commission_rate' => 13.3
        ]
    ];

    $this->view('admin/v_packages', $data);
}

public function reviews() {
    session_start();
    
    if (!isset($_SESSION['admin_logged_in'])) {
        header('Location: ' . URLROOT . '/login');
        exit;
    }

    // Sample review data - in production this would come from database
    $data = [
        'title' => 'Stadium Reviews Management',
        'reviews' => [
            [
                'id' => 1,
                'stadium_name' => 'Colombo Cricket Ground',
                'stadium_id' => 1,
                'customer_name' => 'Krishna Wishvajith',
                'customer_email' => 'krishna@email.com',
                'rating' => 5,
                'review_text' => 'Excellent facilities and well-maintained ground. The lighting system is perfect for evening matches. Highly recommend for cricket tournaments.',
                'date' => '2025-01-20',
                'status' => 'Published',
                'verified_booking' => true,
                'helpful_votes' => 15,
                'reported' => false
            ],
            [
                'id' => 2,
                'stadium_name' => 'Football Arena Pro',
                'stadium_id' => 3,
                'customer_name' => 'Kulakshi Thathsarani',
                'customer_email' => 'kulakshi@email.com',
                'rating' => 4,
                'review_text' => 'Great stadium with good parking facilities. Only minor issue was the changing room could be cleaner. Overall good experience.',
                'date' => '2025-01-18',
                'status' => 'Published',
                'verified_booking' => true,
                'helpful_votes' => 8,
                'reported' => false
            ],
            [
                'id' => 3,
                'stadium_name' => 'Tennis Academy Courts',
                'stadium_id' => 4,
                'customer_name' => 'Dinesh Sulakshana',
                'customer_email' => 'dinesh@email.com',
                'rating' => 5,
                'review_text' => 'Professional quality courts and excellent customer service. The coaching staff is very helpful and knowledgeable.',
                'date' => '2025-01-17',
                'status' => 'Published',
                'verified_booking' => true,
                'helpful_votes' => 22,
                'reported' => false
            ],
            [
                'id' => 4,
                'stadium_name' => 'Basketball Hub Angoda',
                'stadium_id' => 5,
                'customer_name' => 'Kalana Ekanayake',
                'customer_email' => 'kalana@email.com',
                'rating' => 4,
                'review_text' => 'Good value for money. The court quality is excellent and perfect for competitive games.',
                'date' => '2025-01-15',
                'status' => 'Published',
                'verified_booking' => true,
                'helpful_votes' => 6,
                'reported' => false
            ],
            [
                'id' => 5,
                'stadium_name' => 'Indoor Sports Complex',
                'stadium_id' => 2,
                'customer_name' => 'Sarah Johnson',
                'customer_email' => 'sarah@email.com',
                'rating' => 2,
                'review_text' => 'Very disappointing experience. The facility was not clean and staff was unprofessional. Would not recommend.',
                'date' => '2025-01-14',
                'status' => 'Flagged',
                'verified_booking' => true,
                'helpful_votes' => 3,
                'reported' => true
            ],
            [
                'id' => 6,
                'stadium_name' => 'Swimming Pool Complex',
                'stadium_id' => 6,
                'customer_name' => 'Mike Wilson',
                'customer_email' => 'mike@email.com',
                'rating' => 5,
                'review_text' => 'Amazing swimming facility with clean water and excellent maintenance. The Olympic-size pool is perfect for serious training.',
                'date' => '2025-01-12',
                'status' => 'Published',
                'verified_booking' => true,
                'helpful_votes' => 18,
                'reported' => false
            ],
            [
                'id' => 7,
                'stadium_name' => 'Colombo Badminton Center',
                'stadium_id' => 7,
                'customer_name' => 'Priya Raj',
                'customer_email' => 'priya@email.com',
                'rating' => 3,
                'review_text' => 'Average facility. Courts are okay but could use better lighting. Service is decent.',
                'date' => '2025-01-10',
                'status' => 'Pending',
                'verified_booking' => false,
                'helpful_votes' => 2,
                'reported' => false
            ],
            [
                'id' => 8,
                'stadium_name' => 'Premier Squash Courts',
                'stadium_id' => 8,
                'customer_name' => 'John Silva',
                'customer_email' => 'john@email.com',
                'rating' => 1,
                'review_text' => 'Terrible experience! Courts were dirty and equipment was broken. Staff was rude and unprofessional. Waste of money!',
                'date' => '2025-01-08',
                'status' => 'Flagged',
                'verified_booking' => true,
                'helpful_votes' => 0,
                'reported' => true
            ]
        ],
        'stats' => [
            'total_reviews' => 156,
            'published_reviews' => 142,
            'pending_reviews' => 8,
            'flagged_reviews' => 6,
            'average_rating' => 4.2,
            'this_month_reviews' => 23
        ]
    ];

    $this->view('admin/v_reviews', $data);
}

}