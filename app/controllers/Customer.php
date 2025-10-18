<?php
class Customer extends Controller {
    private $customerModel;

    public function __construct()
    {
        $this->customerModel = $this->model('M_Customer');
        
        // Start session if not started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Check if user is logged in and has customer role
        if (!Auth::isLoggedIn() || !Auth::hasRole('customer')) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }
        
        // Check if account is active
        if (!Auth::isAccountActive()) {
            // Logout and redirect with message
            session_destroy();
            header('Location: ' . URLROOT . '/login?error=account_pending');
            exit;
        }
    }

    public function index() {
        $userId = Auth::getUserId();
        
        // Get customer stats
        $stats = $this->customerModel->getCustomerStats($userId);
        
        $data = [
            'title' => 'Customer Dashboard',
            'stats' => $stats,
            'recent_bookings' => $this->customerModel->getRecentBookings($userId, 5),
            'upcoming_events' => $this->customerModel->getUpcomingEvents($userId),
            'favorite_stadiums' => $this->customerModel->getFavoriteStadiums($userId),
            'payment_history' => $this->customerModel->getPaymentHistory($userId)
        ];

        $this->view('customer/customer', $data);
    }

    public function bookings() {
        $userId = Auth::getUserId();
        
        $data = [
            'title' => 'My Bookings',
            'all_bookings' => $this->customerModel->getAllBookings($userId)
        ];

        $this->view('customer/v_bookings', $data);
    }

    public function profile() {
        $userId = Auth::getUserId();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle profile update
            $profileData = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'phone' => $_POST['phone'],
                'location' => $_POST['location'],
                'favorite_sports' => $_POST['favorite_sports']
            ];
            
            if ($this->customerModel->updateProfile($userId, $profileData)) {
                $data['success'] = 'Profile updated successfully!';
            } else {
                $data['error'] = 'Failed to update profile';
            }
        }
        
        $data = [
            'title' => 'My Profile',
            'profile_data' => $this->customerModel->getProfile($userId)
        ];

        $this->view('customer/v_profile', $data);
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ' . URLROOT . '/login');
        exit;
    }
}