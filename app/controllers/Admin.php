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
        if (!isset($_SESSION['admin_logged_in'])) {
            $this->login();
            return;
        }

        // Dashboard data
        $data = [
            'title' => 'Admin Dashboard',
            'total_users' => 1250,
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

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Simple temporary login (username: admin, password: admin123)
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($username === 'admin' && $password === 'admin123') {
                session_start();
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $username;
                header('Location: ' . URLROOT . '/admin');
                exit;
            } else {
                $data['error'] = 'Invalid credentials';
            }
        }

        $data = [
            'title' => 'Admin Login'
        ];

        $this->view('admin/v_login', $data);
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ' . URLROOT . '/admin/login');
        exit;
    }

    public function users() {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            $this->login();
            return;
        }

        $data = [
            'title' => 'User Management',
            'users' => [
                ['id' => 1, 'name' => 'Kulakshi Thathsarani', 'email' => 'john@example.com', 'role' => 'Customer', 'status' => 'Active'],
                ['id' => 2, 'name' => 'University Of Colombo', 'email' => 'owner1@example.com', 'role' => 'Stadium Owner', 'status' => 'Active'],
                ['id' => 3, 'name' => 'Dinesh Sulakshana', 'email' => 'coach@example.com', 'role' => 'Coach', 'status' => 'Active'],
                ['id' => 4, 'name' => 'Kalana Ekanayake', 'email' => 'rental@example.com', 'role' => 'Rental Owner', 'status' => 'Active'],
                ['id' => 5, 'name' => 'Kamal Jayasooriya', 'email' => 'jane@example.com', 'role' => 'Customer', 'status' => 'Inactive']
            ]
        ];

        $this->view('admin/v_users', $data);
    }

    public function bookings() {
        session_start();
        
        if (!isset($_SESSION['admin_logged_in'])) {
            $this->login();
            return;
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
            $this->login();
            return;
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
            $this->login();
            return;
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
            $this->login();
            return;
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
            $this->login();
            return;
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
            $this->login();
            return;
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
            $this->login();
            return;
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
            $this->login();
            return;
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
            $this->login();
            return;
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

?>




