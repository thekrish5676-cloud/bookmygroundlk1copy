<?php
class Customer extends Controller {
    private $customerModel;

    public function __construct()
    {
        try {
            // Debug: Check if we can load the model
            $this->customerModel = $this->model('M_Customer');
            
            // Debug: Check session status
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            // Debug: Check if Auth class exists and works
            if (!class_exists('Auth')) {
                die('Auth class not found');
            }
            
            // Debug: Check authentication
            if (!Auth::isLoggedIn()) {
                error_log('User not logged in, redirecting...');
                header('Location: ' . URLROOT . '/login');
                exit;
            }
            
            if (!Auth::hasRole('customer')) {
                error_log('User does not have customer role, redirecting...');
                header('Location: ' . URLROOT . '/login');
                exit;
            }
            
        } catch (Exception $e) {
            error_log('Customer Controller Constructor Error: ' . $e->getMessage());
            die('Error in Customer controller: ' . $e->getMessage());
        }
    }

    public function index() {
        try {
            $userId = Auth::getUserId();
            
            if (!$userId) {
                die('User ID not found in session');
            }
            
            // Debug: Check if model method exists
            if (!method_exists($this->customerModel, 'getCustomerStats')) {
                die('getCustomerStats method not found in M_Customer model');
            }
            
            // Get customer stats with error handling
            $stats = $this->customerModel->getCustomerStats($userId);
            
            $data = [
                'title' => 'Customer Dashboard',
                'user_name' => Auth::getUserName() ?: 'User',
                'user_first_name' => Auth::getUserFirstName() ?: 'User',
                'stats' => $stats,
                'recent_bookings' => $this->customerModel->getRecentBookings($userId, 5),
                'upcoming_events' => $this->customerModel->getUpcomingEvents($userId),
                'favorite_stadiums' => $this->customerModel->getFavoriteStadiums($userId),
                'payment_history' => $this->customerModel->getPaymentHistory($userId),
                // Provide emergency contacts to the view (avoid model calls in views)
                'emergency_contacts' => $this->customerModel->getEmergencyContacts($userId),
                // Provide profile data so view can rely on $data instead of $_SESSION
                'profile_data' => $this->customerModel->getProfileData($userId)
            ];

            // Debug: Check if view file exists
            $viewPath = '../app/views/customer/customer.php';
            if (!file_exists($viewPath)) {
                die('View file not found: ' . $viewPath);
            }
            
            $this->view('customer/customer', $data);
            
        } catch (Exception $e) {
            error_log('Customer Index Error: ' . $e->getMessage());
            die('Error in Customer index: ' . $e->getMessage());
        }
    }

    // Handle profile updates from dashboard form
    public function updateProfile() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                header('Location: ' . URLROOT . '/customer');
                exit;
            }

            $userId = Auth::getUserId();
            if (!$userId) {
                header('Location: ' . URLROOT . '/login');
                exit;
            }

            // Map and normalize fields from the form
            $first_name = $_POST['first_name'] ?? '';
            $last_name = $_POST['last_name'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $district = $_POST['district'] ?? '';
            // The view currently uses 'preferred_sports'
            $sports = $_POST['preferred_sports'] ?? ($_POST['sports'] ?? '');
            $age_group = $_POST['age_group'] ?? '';
            $skill_level = $_POST['skill_level'] ?? '';

            // Normalize age group values to match DB enum (under_18, 18_25, 26_35, above_35)
            $age_group = str_replace('-', '_', $age_group);

            $payload = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone' => $phone,
                'district' => $district,
                'sports' => $sports,
                'age_group' => $age_group,
                'skill_level' => $skill_level,
            ];

            if ($this->customerModel->updateProfile($userId, $payload)) {
                $_SESSION['success'] = 'Profile updated successfully!';
            } else {
                $_SESSION['error'] = 'Failed to update profile.';
            }

            header('Location: ' . URLROOT . '/customer#profile');
            exit;
        } catch (Exception $e) {
            error_log('Customer updateProfile Error: ' . $e->getMessage());
            $_SESSION['error'] = 'Unexpected error while updating profile.';
            header('Location: ' . URLROOT . '/customer#profile');
            exit;
        }
    }

    // Create new emergency contact
    public function addEmergencyContact() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                header('Location: ' . URLROOT . '/customer#emergency-contacts');
                exit;
            }

            $userId = Auth::getUserId();
            if (!$userId) {
                header('Location: ' . URLROOT . '/login');
                exit;
            }

            $data = [
                'contact_name' => $_POST['contact_name'] ?? '',
                'relationship' => $_POST['relationship'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'email' => $_POST['email'] ?? null,
            ];

            if ($this->customerModel->createEmergencyContact($userId, $data)) {
                $_SESSION['success'] = 'Emergency contact added.';
            } else {
                $_SESSION['error'] = 'Failed to add emergency contact.';
            }

            header('Location: ' . URLROOT . '/customer#emergency-contacts');
            exit;
        } catch (Exception $e) {
            error_log('Customer addEmergencyContact Error: ' . $e->getMessage());
            $_SESSION['error'] = 'Unexpected error while adding contact.';
            header('Location: ' . URLROOT . '/customer#emergency-contacts');
            exit;
        }
    }

    // Delete an emergency contact by id (scoped to current user)
    public function deleteEmergencyContact($id) {
        try {
            $userId = Auth::getUserId();
            if (!$userId) {
                header('Location: ' . URLROOT . '/login');
                exit;
            }

            if ($this->customerModel->deleteEmergencyContact($id, $userId)) {
                $_SESSION['success'] = 'Emergency contact deleted.';
            } else {
                $_SESSION['error'] = 'Unable to delete emergency contact.';
            }

            header('Location: ' . URLROOT . '/customer#emergency-contacts');
            exit;
        } catch (Exception $e) {
            error_log('Customer deleteEmergencyContact Error: ' . $e->getMessage());
            $_SESSION['error'] = 'Unexpected error while deleting contact.';
            header('Location: ' . URLROOT . '/customer#emergency-contacts');
            exit;
        }
    }

    public function bookings() {
        try {
            $userId = Auth::getUserId();
            
            $data = [
                'title' => 'My Bookings',
                'all_bookings' => $this->customerModel->getAllBookings($userId)
            ];

            $this->view('customer/v_bookings', $data);
        } catch (Exception $e) {
            error_log('Customer Bookings Error: ' . $e->getMessage());
            die('Error in Customer bookings: ' . $e->getMessage());
        }
    }

    public function profile() {
        try {
            $userId = Auth::getUserId();
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Handle profile update
                $profileData = [
                    'first_name' => $_POST['first_name'] ?? '',
                    'last_name' => $_POST['last_name'] ?? '',
                    'phone' => $_POST['phone'] ?? '',
                    'location' => $_POST['location'] ?? '',
                    'favorite_sports' => $_POST['favorite_sports'] ?? ''
                ];
                
                if ($this->customerModel->updateProfile($userId, $profileData)) {
                    $data['success'] = 'Profile updated successfully!';
                } else {
                    $data['error'] = 'Failed to update profile';
                }
            }
            
            $data = [
                'title' => 'My Profile',
                'profile_data' => $this->customerModel->getProfileData($userId)
            ];

            $this->view('customer/v_profile', $data);
        } catch (Exception $e) {
            error_log('Customer Profile Error: ' . $e->getMessage());
            die('Error in Customer profile: ' . $e->getMessage());
        }
    }

    public function logout() {
        try {
            // Clear all session data
            session_unset();
            session_destroy();
            
            // Start a new session
            session_start();
            
            header('Location: ' . URLROOT . '/login');
            exit;
        } catch (Exception $e) {
            error_log('Customer Logout Error: ' . $e->getMessage());
            die('Error in Customer logout: ' . $e->getMessage());
        }
    }
}