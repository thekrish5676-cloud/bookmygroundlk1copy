<?php
class Register extends Controller {
    private $registerModel;

    public function __construct()
    {
        $this->registerModel = $this->model('M_Register');
    }

    public function index() {
        // Default signup page - show role selection
        $data = [
            'title' => 'Join BookMyGround - Choose Your Role',
            'page_type' => 'role_selection'
        ];

        $this->view('signup/v_signup', $data);
    }

    public function customer() {
        // Customer registration form
        $data = [
            'title' => 'Sign Up as Customer - BookMyGround',
            'role' => 'customer',
            'role_title' => 'Sports Player',
            'role_description' => 'Book venues, join sessions, and connect with coaches',
            'error' => '',
            'success' => '',
            'cities' => $this->registerModel->getCities(),
            'sports' => $this->registerModel->getSportsSpecializations(),
            'age_groups' => $this->registerModel->getAgeGroups(),
            'skill_levels' => $this->registerModel->getSkillLevels()
        ];

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->processRegistration($data, 'customer');
        }

        $this->view('signup/v_signupcustomer', $data);
    }

    public function stadium_owner() {
        // Stadium Owner registration form
        $data = [
            'title' => 'Sign Up as Stadium Owner - BookMyGround',
            'role' => 'stadium_owner',
            'role_title' => 'Stadium Owner',
            'role_description' => 'List your facilities and manage bookings efficiently',
            'error' => '',
            'success' => '',
            'cities' => $this->registerModel->getCities(),
            'venue_types' => $this->registerModel->getVenueTypes(),
            'business_types' => $this->registerModel->getBusinessTypes()
        ];

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->processRegistration($data, 'stadium_owner');
        }

        $this->view('signup/v_signupowner', $data);
    }

    public function coach() {
        // Coach registration form
        $data = [
            'title' => 'Sign Up as Coach - BookMyGround',
            'role' => 'coach',
            'role_title' => 'Sports Coach',
            'role_description' => 'Share your expertise and grow your client base',
            'error' => '',
            'success' => '',
            'cities' => $this->registerModel->getCities(),
            'sports' => $this->registerModel->getSportsSpecializations(),
            'experience_levels' => $this->registerModel->getExperienceLevels(),
            'certification_levels' => $this->registerModel->getCertificationLevels(),
            'coaching_types' => $this->registerModel->getCoachingTypes(),
            'availability_options' => $this->registerModel->getAvailabilityOptions()
        ];

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->processRegistration($data, 'coach');
        }

        $this->view('signup/v_signupcoach', $data);
    }

    public function rental_owner() {
        // Rental Owner registration form
        $data = [
            'title' => 'Sign Up as Equipment Rental Owner - BookMyGround',
            'role' => 'rental_owner',
            'role_title' => 'Equipment Rental Service',
            'role_description' => 'Offer sports gear and expand your rental business',
            'error' => '',
            'success' => '',
            'cities' => $this->registerModel->getCities(),
            'business_types' => $this->registerModel->getBusinessTypes(),
            'equipment_types' => $this->registerModel->getEquipmentTypes(),
            'delivery_options' => $this->registerModel->getDeliveryOptions()
        ];

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->processRegistration($data, 'rental_owner');
        }

        $this->view('signup/v_signuprental', $data);
    }

    private function processRegistration($data, $role) {
        // Get form data
        $formData = [
            'role' => $role,
            'first_name' => trim($_POST['first_name'] ?? $_POST['first-name'] ?? ''),
            'last_name' => trim($_POST['last_name'] ?? $_POST['last-name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'confirm_password' => $_POST['confirm_password'] ?? $_POST['confirm-password'] ?? ''
        ];

        // Add role-specific fields
        switch($role) {
            case 'customer':
                $formData['district'] = trim($_POST['district'] ?? '');
                $formData['sports'] = $_POST['sports'] ?? '';
                $formData['age_group'] = $_POST['age_group'] ?? $_POST['age-group'] ?? '';
                $formData['skill_level'] = $_POST['skill_level'] ?? $_POST['skill-level'] ?? '';
                break;

            case 'stadium_owner':
                $formData['owner_name'] = trim($_POST['owner_name'] ?? $_POST['owner-name'] ?? '');
                $formData['business_name'] = trim($_POST['business_name'] ?? $_POST['business-name'] ?? '');
                $formData['district'] = trim($_POST['district'] ?? '');
                $formData['venue_type'] = $_POST['venue_type'] ?? $_POST['venue-type'] ?? '';
                $formData['business_reg'] = trim($_POST['business_reg'] ?? $_POST['business-reg'] ?? '');
                break;

            case 'coach':
                $formData['specialization'] = $_POST['specialization'] ?? '';
                $formData['experience'] = $_POST['experience'] ?? '';
                $formData['certification'] = $_POST['certification'] ?? '';
                $formData['coaching_type'] = $_POST['coaching_type'] ?? $_POST['coaching-type'] ?? '';
                $formData['district'] = trim($_POST['district'] ?? '');
                $formData['availability'] = $_POST['availability'] ?? '';
                break;

            case 'rental_owner':
                $formData['owner_name'] = trim($_POST['owner_name'] ?? $_POST['owner-name'] ?? '');
                $formData['business_name'] = trim($_POST['business_name'] ?? $_POST['business-name'] ?? '');
                $formData['district'] = trim($_POST['district'] ?? '');
                $formData['business_type'] = $_POST['business_type'] ?? $_POST['business-type'] ?? '';
                $formData['equipment_categories'] = $_POST['equipment_categories'] ?? $_POST['equipment-categories'] ?? '';
                $formData['delivery_service'] = $_POST['delivery_service'] ?? $_POST['delivery-service'] ?? '';
                break;
        }

        // Validate form data
        $validation = $this->validateForm($formData, $role);
        
        if (!empty($validation['errors'])) {
            $data['error'] = implode('<br>', $validation['errors']);
            $data['form_data'] = $formData; // Keep form data to repopulate
            return $data;
        }

        // Check if email already exists
        if ($this->registerModel->emailExists($formData['email'])) {
            $data['error'] = 'An account with this email already exists.';
            $data['form_data'] = $formData;
            return $data;
        }

        // Check if phone already exists
        if ($this->registerModel->phoneExists($formData['phone'])) {
            $data['error'] = 'An account with this phone number already exists.';
            $data['form_data'] = $formData;
            return $data;
        }

        // Create user account
        $userId = $this->registerModel->createUser($formData);
        
        if ($userId) {
            // Create role-specific profile
            $profileCreated = false;
            
            switch($role) {
                case 'customer':
                    $profileCreated = $this->registerModel->createCustomerProfile($userId, $formData);
                    break;
                case 'stadium_owner':
                    $profileCreated = $this->registerModel->createStadiumOwnerProfile($userId, $formData);
                    break;
                case 'coach':
                    $profileCreated = $this->registerModel->createCoachProfile($userId, $formData);
                    break;
                case 'rental_owner':
                    $profileCreated = $this->registerModel->createRentalOwnerProfile($userId, $formData);
                    break;
            }

            if ($profileCreated) {
                // Send welcome email (optional)
                $this->registerModel->sendWelcomeEmail($formData['email'], $formData['first_name'], $role);
                
                // Redirect to success page
                header('Location: ' . URLROOT . '/register/success');
                exit;
            } else {
                $data['error'] = 'Account created but profile setup failed. Please contact support.';
            }
        } else {
            $data['error'] = 'Registration failed. Please try again.';
        }
        
        $data['form_data'] = $formData;
        return $data;
    }

    private function validateForm($data, $role) {
        $errors = [];

        // Common validations
        if (empty($data['first_name'])) {
            $errors[] = 'First name is required';
        }

        if (empty($data['last_name'])) {
            $errors[] = 'Last name is required';
        }

        if (empty($data['email'])) {
            $errors[] = 'Email is required';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address';
        }

        if (empty($data['phone'])) {
            $errors[] = 'Phone number is required';
        } elseif (!preg_match('/^[\+]?[0-9\s\-\(\)]{10,}$/', $data['phone'])) {
            $errors[] = 'Please enter a valid phone number';
        }

        if (empty($data['password'])) {
            $errors[] = 'Password is required';
        } elseif (strlen($data['password']) < 6) {
            $errors[] = 'Password must be at least 6 characters long';
        }

        if ($data['password'] !== $data['confirm_password']) {
            $errors[] = 'Passwords do not match';
        }

        // Role-specific validations
        switch($role) {
            case 'customer':
                if (empty($data['district'])) {
                    $errors[] = 'District is required';
                }
                if (empty($data['sports'])) {
                    $errors[] = 'Preferred sport is required';
                }
                if (empty($data['age_group'])) {
                    $errors[] = 'Age group is required';
                }
                if (empty($data['skill_level'])) {
                    $errors[] = 'Skill level is required';
                }
                break;

            case 'stadium_owner':
                if (empty($data['owner_name'])) {
                    $errors[] = 'Owner name is required';
                }
                if (empty($data['business_name'])) {
                    $errors[] = 'Business name is required';
                }
                if (empty($data['district'])) {
                    $errors[] = 'District is required';
                }
                if (empty($data['venue_type'])) {
                    $errors[] = 'Venue type is required';
                }
                if (empty($data['business_reg'])) {
                    $errors[] = 'Business registration number is required';
                }
                break;

            case 'coach':
                if (empty($data['specialization'])) {
                    $errors[] = 'Sports specialization is required';
                }
                if (empty($data['experience'])) {
                    $errors[] = 'Years of experience is required';
                }
                if (empty($data['certification'])) {
                    $errors[] = 'Certification level is required';
                }
                if (empty($data['coaching_type'])) {
                    $errors[] = 'Coaching type is required';
                }
                if (empty($data['district'])) {
                    $errors[] = 'District is required';
                }
                if (empty($data['availability'])) {
                    $errors[] = 'Availability is required';
                }
                break;

            case 'rental_owner':
                if (empty($data['owner_name'])) {
                    $errors[] = 'Owner name is required';
                }
                if (empty($data['business_name'])) {
                    $errors[] = 'Business name is required';
                }
                if (empty($data['district'])) {
                    $errors[] = 'District is required';
                }
                if (empty($data['business_type'])) {
                    $errors[] = 'Business type is required';
                }
                if (empty($data['equipment_categories'])) {
                    $errors[] = 'Equipment category is required';
                }
                if (empty($data['delivery_service'])) {
                    $errors[] = 'Delivery service option is required';
                }
                break;
        }

        return ['errors' => $errors];
    }

    public function success() {
        // Success page after registration
        $data = [
            'title' => 'Registration Successful - BookMyGround'
        ];

        $this->view('signup/v_success', $data);
    }
}