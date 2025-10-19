<?php
class Stadium_owner extends Controller {
    private $stadiumOwnerModel;

    public function __construct()
    {
        try {
            $this->stadiumOwnerModel = $this->model('M_Stadium_owner');
            
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            if (!Auth::isLoggedIn()) {
                error_log('Stadium owner not logged in, redirecting...');
                header('Location: ' . URLROOT . '/login');
                exit;
            }
            
            if (!Auth::hasRole('stadium_owner')) {
                error_log('User does not have stadium_owner role, redirecting...');
                header('Location: ' . URLROOT . '/login');
                exit;
            }
            
        } catch (Exception $e) {
            error_log('Stadium Owner Controller Constructor Error: ' . $e->getMessage());
            die('Error in Stadium Owner controller: ' . $e->getMessage());
        }
    }

    public function index() {
        try {
            $userId = Auth::getUserId();
            
            if (!$userId) {
                die('User ID not found in session');
            }
            
            // Get stadium owner stats
            $stats = $this->stadiumOwnerModel->getOwnerStats($userId);
            
            $data = [
                'title' => 'Stadium Owner Dashboard',
                'user_name' => Auth::getUserName() ?: 'Owner',
                'user_first_name' => Auth::getUserFirstName() ?: 'Owner',
                'stats' => $stats,
                'recent_bookings' => $this->stadiumOwnerModel->getRecentBookings($userId, 5),
                'upcoming_schedules' => $this->stadiumOwnerModel->getUpcomingSchedules($userId),
                'revenue_overview' => $this->stadiumOwnerModel->getRevenueOverview($userId),
                'property_summary' => $this->stadiumOwnerModel->getPropertySummary($userId),
                'package_info' => $this->stadiumOwnerModel->getPackageInfo($userId)
            ];

            $this->view('stadium_owner/dashboard', $data);
            
        } catch (Exception $e) {
            error_log('Stadium Owner Index Error: ' . $e->getMessage());
            die('Error in Stadium Owner index: ' . $e->getMessage());
        }
    }

    public function properties() {
        try {
            $userId = Auth::getUserId();
            
            $data = [
                'title' => 'My Properties',
                'properties' => $this->stadiumOwnerModel->getAllProperties($userId),
                'package_limits' => $this->stadiumOwnerModel->getPackageLimits($userId)
            ];

            $this->view('stadium_owner/v_properties', $data);
        } catch (Exception $e) {
            error_log('Stadium Owner Properties Error: ' . $e->getMessage());
            die('Error in Stadium Owner properties: ' . $e->getMessage());
        }
    }

    public function add_property() {
        try {
            $userId = Auth::getUserId();
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Handle property addition
                $propertyData = [
                    'name' => $_POST['name'] ?? '',
                    'type' => $_POST['type'] ?? '',
                    'category' => $_POST['category'] ?? '',
                    'price' => $_POST['price'] ?? '',
                    'location' => $_POST['location'] ?? '',
                    'description' => $_POST['description'] ?? '',
                    'features' => $_POST['features'] ?? []
                ];
                
                if ($this->stadiumOwnerModel->addProperty($userId, $propertyData)) {
                    $data['success'] = 'Property added successfully!';
                } else {
                    $data['error'] = 'Failed to add property';
                }
            }
            
            $data = [
                'title' => 'Add New Property',
                'package_limits' => $this->stadiumOwnerModel->getPackageLimits($userId)
            ];

            $this->view('stadium_owner/v_add_property', $data);
        } catch (Exception $e) {
            error_log('Stadium Owner Add Property Error: ' . $e->getMessage());
            die('Error in Stadium Owner add property: ' . $e->getMessage());
        }
    }

    public function edit_property($id = null) {
        try {
            $userId = Auth::getUserId();
            
            if (!$id) {
                header('Location: ' . URLROOT . '/stadium_owner/properties');
                exit;
            }
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Handle property update
                $propertyData = [
                    'name' => $_POST['name'] ?? '',
                    'type' => $_POST['type'] ?? '',
                    'category' => $_POST['category'] ?? '',
                    'price' => $_POST['price'] ?? '',
                    'location' => $_POST['location'] ?? '',
                    'description' => $_POST['description'] ?? '',
                    'features' => $_POST['features'] ?? []
                ];
                
                if ($this->stadiumOwnerModel->updateProperty($userId, $id, $propertyData)) {
                    $data['success'] = 'Property updated successfully!';
                } else {
                    $data['error'] = 'Failed to update property';
                }
            }
            
            $data = [
                'title' => 'Edit Property',
                'property' => $this->stadiumOwnerModel->getProperty($userId, $id)
            ];

            $this->view('stadium_owner/v_edit_property', $data);
        } catch (Exception $e) {
            error_log('Stadium Owner Edit Property Error: ' . $e->getMessage());
            die('Error in Stadium Owner edit property: ' . $e->getMessage());
        }
    }

    public function bookings() {
        try {
            $userId = Auth::getUserId();
            
            $data = [
                'title' => 'Booking History',
                'all_bookings' => $this->stadiumOwnerModel->getAllBookings($userId),
                'booking_stats' => $this->stadiumOwnerModel->getBookingStats($userId)
            ];

            $this->view('stadium_owner/v_bookings', $data);
        } catch (Exception $e) {
            error_log('Stadium Owner Bookings Error: ' . $e->getMessage());
            die('Error in Stadium Owner bookings: ' . $e->getMessage());
        }
    }

    public function messages() {
        try {
            $userId = Auth::getUserId();
            
            $data = [
                'title' => 'Messages',
                'messages' => $this->stadiumOwnerModel->getMessages($userId),
                'unread_count' => $this->stadiumOwnerModel->getUnreadMessageCount($userId)
            ];

            $this->view('stadium_owner/v_messages', $data);
        } catch (Exception $e) {
            error_log('Stadium Owner Messages Error: ' . $e->getMessage());
            die('Error in Stadium Owner messages: ' . $e->getMessage());
        }
    }

    public function send_reply() {
        try {
            $userId = Auth::getUserId();
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $messageData = [
                    'message_id' => $_POST['message_id'] ?? '',
                    'reply_content' => $_POST['reply_content'] ?? ''
                ];
                
                if ($this->stadiumOwnerModel->sendReply($userId, $messageData)) {
                    echo json_encode(['success' => true, 'message' => 'Reply sent successfully']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to send reply']);
                }
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error sending reply']);
        }
    }

    public function revenue() {
        try {
            $userId = Auth::getUserId();
            
            $data = [
                'title' => 'Revenue & Analytics',
                'revenue_data' => $this->stadiumOwnerModel->getRevenueData($userId),
                'analytics' => $this->stadiumOwnerModel->getAnalytics($userId)
            ];

            $this->view('stadium_owner/v_revenue', $data);
        } catch (Exception $e) {
            error_log('Stadium Owner Revenue Error: ' . $e->getMessage());
            die('Error in Stadium Owner revenue: ' . $e->getMessage());
        }
    }

    public function profile() {
        try {
            $userId = Auth::getUserId();
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Handle profile update
                $profileData = [
                    'owner_name' => $_POST['owner_name'] ?? '',
                    'business_name' => $_POST['business_name'] ?? '',
                    'phone' => $_POST['phone'] ?? '',
                    'email' => $_POST['email'] ?? '',
                    'address' => $_POST['address'] ?? ''
                ];
                
                if ($this->stadiumOwnerModel->updateProfile($userId, $profileData)) {
                    $data['success'] = 'Profile updated successfully!';
                } else {
                    $data['error'] = 'Failed to update profile';
                }
            }
            
            $data = [
                'title' => 'My Profile',
                'profile_data' => $this->stadiumOwnerModel->getProfileData($userId)
            ];

            $this->view('stadium_owner/v_profile', $data);
        } catch (Exception $e) {
            error_log('Stadium Owner Profile Error: ' . $e->getMessage());
            die('Error in Stadium Owner profile: ' . $e->getMessage());
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
            error_log('Stadium Owner Logout Error: ' . $e->getMessage());
            die('Error in Stadium Owner logout: ' . $e->getMessage());
        }
    }
}