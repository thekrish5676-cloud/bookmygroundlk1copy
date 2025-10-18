<?php
class Customer extends Controller {
    private $customerModel;

    public function __construct()
    {
        $this->customerModel = $this->model('M_Customer');
    }

    public function index() {
        session_start();
        
        // Check if customer is logged in
        if (!isset($_SESSION['customer_logged_in'])) {
            $this->login();
            return;
        }

        // Dashboard data
        $data = [
            'title' => 'Customer Dashboard',
            'customer_name' => $_SESSION['customer_name'],
            'customer_email' => $_SESSION['customer_email'],
            'stats' => [
                'active_bookings' => 12,
                'stadiums_visited' => 8,
                'rating_given' => 4.8,
                'total_spent' => 2450
            ],
            'recent_bookings' => [
                [
                    'id' => 1,
                    'stadium' => 'Central Football Arena',
                    'date' => '2025-01-25',
                    'time' => '6:00 PM - 8:00 PM',
                    'duration' => '2 hours',
                    'amount' => 800,
                    'status' => 'Confirmed'
                ],
                [
                    'id' => 2,
                    'stadium' => 'Badminton Court Pro',
                    'date' => '2025-01-28',
                    'time' => '4:00 PM - 6:00 PM',
                    'duration' => '2 hours',
                    'amount' => 600,
                    'status' => 'Pending'
                ],
                [
                    'id' => 3,
                    'stadium' => 'Tennis Excellence Center',
                    'date' => '2025-01-20',
                    'time' => '7:00 PM - 9:00 PM',
                    'duration' => '2 hours',
                    'amount' => 1200,
                    'status' => 'Completed'
                ]
            ],
            'upcoming_events' => [
                [
                    'id' => 1,
                    'title' => 'Football Match - Central Arena',
                    'date' => '25',
                    'month' => 'JAN',
                    'time' => '6:00 PM - 8:00 PM',
                    'type' => 'Personal Booking'
                ],
                [
                    'id' => 2,
                    'title' => 'Badminton Practice - Court Pro',
                    'date' => '28',
                    'month' => 'JAN',
                    'time' => '4:00 PM - 6:00 PM',
                    'type' => 'Personal Booking'
                ]
            ],
            'favorite_stadiums' => [
                [
                    'id' => 1,
                    'name' => 'Central Football Arena',
                    'location' => 'Colombo, Sri Lanka',
                    'last_visited' => 'Jan 25, 2025',
                    'total_bookings' => 5,
                    'rating' => 4.8,
                    'sport' => 'Football'
                ],
                [
                    'id' => 2,
                    'name' => 'Badminton Court Pro',
                    'location' => 'Kandy, Sri Lanka',
                    'last_visited' => 'Jan 28, 2025',
                    'total_bookings' => 3,
                    'rating' => 4.6,
                    'sport' => 'Badminton'
                ],
                [
                    'id' => 3,
                    'name' => 'Tennis Excellence Center',
                    'location' => 'Galle, Sri Lanka',
                    'last_visited' => 'Jan 20, 2025',
                    'total_bookings' => 2,
                    'rating' => 4.9,
                    'sport' => 'Tennis'
                ]
            ],
            'payment_history' => [
                [
                    'id' => 'PAY-2025-001',
                    'date' => '2025-01-25',
                    'stadium' => 'Central Football Arena',
                    'method' => 'Credit Card',
                    'amount' => 800,
                    'status' => 'Completed'
                ],
                [
                    'id' => 'PAY-2025-002',
                    'date' => '2025-01-28',
                    'stadium' => 'Badminton Court Pro',
                    'method' => 'Debit Card',
                    'amount' => 600,
                    'status' => 'Pending'
                ],
                [
                    'id' => 'PAY-2025-003',
                    'date' => '2025-01-20',
                    'stadium' => 'Tennis Excellence Center',
                    'method' => 'Debit Card',
                    'amount' => 1200,
                    'status' => 'Completed'
                ]
            ]
        ];

        $this->view('customer/customer', $data);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Simple temporary login (email: customer@test.com, password: customer123)
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($email === 'customer@test.com' && $password === 'customer123') {
                session_start();
                $_SESSION['customer_logged_in'] = true;
                $_SESSION['customer_name'] = 'John Doe';
                $_SESSION['customer_email'] = $email;
                $_SESSION['customer_id'] = 1;
                header('Location: ' . URLROOT . '/customer');
                exit;
            } else {
                $data['error'] = 'Invalid credentials';
            }
        }

        $data = [
            'title' => 'Customer Login - BookMyGround'
        ];

        $this->view('customer/v_customer_login', $data);
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ' . URLROOT . '/customer/login');
        exit;
    }

    public function bookings() {
        session_start();
        
        if (!isset($_SESSION['customer_logged_in'])) {
            $this->login();
            return;
        }

        $data = [
            'title' => 'My Bookings - Customer Dashboard',
            'customer_name' => $_SESSION['customer_name'],
            'all_bookings' => [
                [
                    'id' => 1,
                    'stadium' => 'Central Football Arena',
                    'date' => '2025-01-25',
                    'time' => '6:00 PM - 8:00 PM',
                    'duration' => '2 hours',
                    'amount' => 800,
                    'status' => 'Confirmed'
                ],
                [
                    'id' => 2,
                    'stadium' => 'Badminton Court Pro',
                    'date' => '2025-01-28',
                    'time' => '4:00 PM - 6:00 PM',
                    'duration' => '2 hours',
                    'amount' => 600,
                    'status' => 'Pending'
                ],
                [
                    'id' => 3,
                    'stadium' => 'Tennis Excellence Center',
                    'date' => '2025-01-20',
                    'time' => '7:00 PM - 9:00 PM',
                    'duration' => '2 hours',
                    'amount' => 1200,
                    'status' => 'Completed'
                ],
                [
                    'id' => 4,
                    'stadium' => 'Cricket Ground Elite',
                    'date' => '2025-02-05',
                    'time' => '2:00 PM - 5:00 PM',
                    'duration' => '3 hours',
                    'amount' => 1500,
                    'status' => 'Confirmed'
                ]
            ]
        ];

        $this->view('customer/v_bookings', $data);
    }

    public function stadiums() {
        session_start();
        
        if (!isset($_SESSION['customer_logged_in'])) {
            $this->login();
            return;
        }

        $data = [
            'title' => 'My Stadiums - Customer Dashboard',
            'customer_name' => $_SESSION['customer_name'],
            'favorite_stadiums' => [
                [
                    'id' => 1,
                    'name' => 'Central Football Arena',
                    'location' => 'Colombo, Sri Lanka',
                    'last_visited' => 'Jan 25, 2025',
                    'total_bookings' => 5,
                    'rating' => 4.8,
                    'sport' => 'Football'
                ],
                [
                    'id' => 2,
                    'name' => 'Badminton Court Pro',
                    'location' => 'Kandy, Sri Lanka',
                    'last_visited' => 'Jan 28, 2025',
                    'total_bookings' => 3,
                    'rating' => 4.6,
                    'sport' => 'Badminton'
                ],
                [
                    'id' => 3,
                    'name' => 'Tennis Excellence Center',
                    'location' => 'Galle, Sri Lanka',
                    'last_visited' => 'Jan 20, 2025',
                    'total_bookings' => 2,
                    'rating' => 4.9,
                    'sport' => 'Tennis'
                ]
            ]
        ];

        $this->view('customer/v_stadiums', $data);
    }

    public function payments() {
        session_start();
        
        if (!isset($_SESSION['customer_logged_in'])) {
            $this->login();
            return;
        }

        $data = [
            'title' => 'Payment History - Customer Dashboard',
            'customer_name' => $_SESSION['customer_name'],
            'payment_history' => [
                [
                    'id' => 'PAY-2025-001',
                    'date' => '2025-01-25',
                    'stadium' => 'Central Football Arena',
                    'method' => 'Credit Card',
                    'amount' => 800,
                    'status' => 'Completed'
                ],
                [
                    'id' => 'PAY-2025-002',
                    'date' => '2025-01-28',
                    'stadium' => 'Badminton Court Pro',
                    'method' => 'Debit Card',
                    'amount' => 600,
                    'status' => 'Pending'
                ],
                [
                    'id' => 'PAY-2025-003',
                    'date' => '2025-01-20',
                    'stadium' => 'Tennis Excellence Center',
                    'method' => 'Debit Card',
                    'amount' => 1200,
                    'status' => 'Completed'
                ]
            ],
            'payment_stats' => [
                'total_spent' => 2450,
                'total_transactions' => 8,
                'avg_booking_amount' => 306,
                'pending_payments' => 1
            ]
        ];

        $this->view('customer/v_payments', $data);
    }

    public function profile() {
        session_start();
        
        if (!isset($_SESSION['customer_logged_in'])) {
            $this->login();
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle profile update
            $data['success'] = 'Profile updated successfully!';
        }

        $data = [
            'title' => 'My Profile - Customer Dashboard',
            'customer_name' => $_SESSION['customer_name'],
            'customer_email' => $_SESSION['customer_email'],
            'profile_data' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => $_SESSION['customer_email'],
                'phone' => '+94 77 123 4567',
                'location' => 'Colombo, Sri Lanka',
                'favorite_sports' => 'Football, Tennis, Badminton',
                'member_since' => 'January 2024',
                'total_bookings' => 12,
                'favorite_venues' => 3,
                'loyalty_points' => 245
            ]
        ];

        $this->view('customer/v_profile', $data);
    }

    // API endpoint for booking actions
    public function booking_action() {
        session_start();
        
        if (!isset($_SESSION['customer_logged_in'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action = $_POST['action'] ?? '';
            $booking_id = $_POST['booking_id'] ?? '';
            
            switch($action) {
                case 'cancel':
                    // Handle booking cancellation
                    echo json_encode(['success' => true, 'message' => 'Booking cancelled successfully']);
                    break;
                case 'reschedule':
                    // Handle booking rescheduling
                    echo json_encode(['success' => true, 'message' => 'Booking rescheduled successfully']);
                    break;
                default:
                    echo json_encode(['error' => 'Invalid action']);
            }
        }
    }
}