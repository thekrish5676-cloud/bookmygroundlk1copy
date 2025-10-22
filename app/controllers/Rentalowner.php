<?php
class Rentalowner extends Controller {
    private $rentalOwnerModel;

    public function __construct()
    {
        try {
            $this->rentalOwnerModel = $this->model('M_RentalOwner');
            
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            if (!Auth::isLoggedIn()) {
                error_log('Rental owner not logged in, redirecting...');
                header('Location: ' . URLROOT . '/login');
                exit;
            }
            
            if (!Auth::hasRole('rental_owner')) {
                error_log('User does not have rental_owner role, redirecting...');
                header('Location: ' . URLROOT . '/login');
                exit;
            }
            
        } catch (Exception $e) {
            error_log('Rental Owner Controller Constructor Error: ' . $e->getMessage());
            die('Error in Rental Owner controller: ' . $e->getMessage());
        }
    }

    public function index() {
        try {
            $userId = Auth::getUserId();
            
            if (!$userId) {
                die('User ID not found in session');
            }
            
            // Get rental owner stats
            $stats = $this->rentalOwnerModel->getOwnerStats($userId);
            
            $data = [
                'title' => 'Rental Owner Dashboard',
                'user_name' => Auth::getUserName() ?: 'Owner',
                'user_first_name' => Auth::getUserFirstName() ?: 'Owner',
                'stats' => $stats,
                'recent_rentals' => $this->rentalOwnerModel->getRecentRentals($userId, 5),
                'upcoming_schedules' => $this->rentalOwnerModel->getUpcomingSchedules($userId),
                'revenue_overview' => $this->rentalOwnerModel->getRevenueOverview($userId),
                'shop_summary' => $this->rentalOwnerModel->getShopSummary($userId),
                'package_info' => $this->rentalOwnerModel->getPackageInfo($userId)
            ];

            $this->view('rentalowner/v_dashboard', $data);
            
        } catch (Exception $e) {
            error_log('Rental Owner Index Error: ' . $e->getMessage());
            die('Error in Rental Owner index: ' . $e->getMessage());
        }
    }

    public function shopManagement() {
        try {
            $userId = Auth::getUserId();
            
            $data = [
                'title' => 'Shop Management',
                'shops' => $this->rentalOwnerModel->getAllShops($userId)
            ];

            $this->view('rentalowner/shop_managment', $data);
        } catch (Exception $e) {
            error_log('Rental Owner Shop Management Error: ' . $e->getMessage());
            die('Error in Rental Owner shop management: ' . $e->getMessage());
        }
    }

    public function addShop() {
        try {
            $userId = Auth::getUserId();
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Handle shop addition
                $shopData = [
                    'shop_name' => $_POST['shop_name'] ?? '',
                    'address' => $_POST['address'] ?? '',
                    'description' => $_POST['description'] ?? '',
                    'category' => $_POST['category'] ?? '',
                    'contact_email' => $_POST['contact_email'] ?? '',
                    'contact_phone' => $_POST['contact_phone'] ?? '',
                    'operating_hours' => $_POST['operating_hours'] ?? '',
                    'equipment_types' => $_POST['equipment_types'] ?? [],
                    'features' => $_POST['features'] ?? []
                ];
                
                if ($this->rentalOwnerModel->addShop($userId, $shopData)) {
                    $data['success'] = 'Shop added successfully!';
                } else {
                    $data['error'] = 'Failed to add shop';
                }
            }
            
            $data = [
                'title' => 'Add New Shop'
            ];

            $this->view('rentalowner/add_shop', $data);
        } catch (Exception $e) {
            error_log('Rental Owner Add Shop Error: ' . $e->getMessage());
            die('Error in Rental Owner add shop: ' . $e->getMessage());
        }
    }

    public function editShop($id = null) {
        try {
            $userId = Auth::getUserId();
            
            if (!$id) {
                header('Location: ' . URLROOT . '/rentalowner/shopManagement');
                exit;
            }
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Handle shop update
                $shopData = [
                    'shop_name' => $_POST['shop_name'] ?? '',
                    'address' => $_POST['address'] ?? '',
                    'description' => $_POST['description'] ?? '',
                    'contact_email' => $_POST['contact_email'] ?? '',
                    'contact_phone' => $_POST['contact_phone'] ?? '',
                    'operating_hours' => $_POST['operating_hours'] ?? ''
                ];
                
                if ($this->rentalOwnerModel->updateShop($userId, $id, $shopData)) {
                    header('Location: ' . URLROOT . '/rentalowner/shopManagement?success=1');
                    exit;
                } else {
                    $data['error'] = 'Failed to update shop';
                }
            }
            
            $data = [
                'title' => 'Edit Shop',
                'shop' => $this->rentalOwnerModel->getShop($userId, $id)
            ];

            $this->view('rentalowner/edit_shop', $data);
        } catch (Exception $e) {
            error_log('Rental Owner Edit Shop Error: ' . $e->getMessage());
            die('Error in Rental Owner edit shop: ' . $e->getMessage());
        }
    }

    public function messages() {
        try {
            $userId = Auth::getUserId();
            
            $data = [
                'title' => 'Messages',
                'messages' => $this->rentalOwnerModel->getMessages($userId),
                'unread_count' => $this->rentalOwnerModel->getUnreadMessageCount($userId)
            ];

            $this->view('rentalowner/v_messages', $data);
        } catch (Exception $e) {
            error_log('Rental Owner Messages Error: ' . $e->getMessage());
            die('Error in Rental Owner messages: ' . $e->getMessage());
        }
    }

    public function advertisment() {
        try {
            $userId = Auth::getUserId();
            
            $data = [
                'title' => 'Advertisement Management',
                'monthly_revenue' => 47000,
                'pending_ads' => [
                    [
                        'id' => 1, 
                        'business' => 'Sports Gear Rentals', 
                        'service_type' => 'Equipment Rental',
                        'contact' => 'John Silva', 
                        'email' => 'john@sportgear.lk', 
                        'phone' => '0712345678', 
                        'amount' => 15000, 
                        'status' => 'Payment Pending', 
                        'submitted' => '2025-08-19'
                    ],
                    [
                        'id' => 2, 
                        'business' => 'Sports Gear Rentals', 
                        'service_type' => 'Equipment Rental',
                        'contact' => 'kalana Silva', 
                        'email' => 'kalana@sportgear.lk', 
                        'phone' => '0772345678', 
                        'amount' => 45000, 
                        'status' => 'Under Review', 
                        'submitted' => '2025-08-19'
                    ]
                ],
                'verified_ads' => [
                    [
                        'id' => 4, 
                        'business' => 'City Sports Arena',
                        'service_type' => 'Facility Rental',
                        'contact' => 'Maria Fernando',
                        'email' => 'maria@citysports.lk',
                        'phone' => '0754321098', 
                        'amount' => 25000, 
                        'status' => 'Verified', 
                        'submitted' => '2025-08-16',
                        'verified_date' => '2025-08-20'
                    ]
                ],
                'published_ads' => [
                    [
                        'id' => 5, 
                        'business' => 'Premium Ground Rentals', 
                        'service_type' => 'Venue Rental',
                        'type' => 'Image', 
                        'image' => 'rental-ad1.jpg',
                        'published' => '2025-08-15', 
                        'expires' => '2025-09-15', 
                        'status' => 'Active'
                    ]
                ]
            ];

            $this->view('rentalowner/v_advertisment', $data);
        } catch (Exception $e) {
            error_log('Rental Owner Advertisement Error: ' . $e->getMessage());
            die('Error in Rental Owner advertisement: ' . $e->getMessage());
        }
    }

    public function blog() {
        try {
            $data = [
                'title' => 'Blog Management',
                'posts' => [
                    ['id' => 1, 'title' => 'Beginner\'s Guide: What to Rent for Your First Cricket Match', 'author' => 'Krishna Wishvajith', 'category' => 'Cricket', 'status' => 'Published', 'published' => '2025-08-18', 'views' => 1250],
                    ['id' => 2, 'title' => 'How to Choose the Right Football for Different Grounds', 'author' => 'Krishna Wishvajith', 'category' => 'Football', 'status' => 'Draft', 'published' => '', 'views' => 0],
                ]
            ];

            $this->view('rentalowner/v_blog', $data);
        } catch (Exception $e) {
            error_log('Rental Owner Blog Error: ' . $e->getMessage());
            die('Error in Rental Owner blog: ' . $e->getMessage());
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
                
                if ($this->rentalOwnerModel->updateProfile($userId, $profileData)) {
                    $data['success'] = 'Profile updated successfully!';
                } else {
                    $data['error'] = 'Failed to update profile';
                }
            }
            
            $data = [
                'title' => 'My Profile',
                'profile_data' => $this->rentalOwnerModel->getProfileData($userId)
            ];

            $this->view('rentalowner/v_profile', $data);
        } catch (Exception $e) {
            error_log('Rental Owner Profile Error: ' . $e->getMessage());
            die('Error in Rental Owner profile: ' . $e->getMessage());
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
            error_log('Rental Owner Logout Error: ' . $e->getMessage());
            die('Error in Rental Owner logout: ' . $e->getMessage());
        }
    }
}
?>