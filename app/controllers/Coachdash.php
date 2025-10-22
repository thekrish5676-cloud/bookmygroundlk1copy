<?php
class Coachdash extends Controller {
    public function index() {
        // Get coach data (in real scenario, this would come from database/session)
        $coach_data = $this->getCoachData();
        
        $data = [
            'title' => 'Edit Profile',
            'coach' => $coach_data
        ];

        $this->view('coachdash/v_coach_dashboard', $data);
    }

    public function messages(){
        $data = [
            'title' => 'Messages',
        ];
        $this->view('coachdash/v_messages', $data);
    }

    public function edit() {
        // show editable profile view
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user_id'] ?? 1;

        $model = $this->model('M_Coachdash');
        $coach = $model->getCoachByUserId($user_id);

        // Load sports options from registration model so edit uses same choices as signup
        $registerModel = $this->model('M_Register');
        $sports = [];
        if (method_exists($registerModel, 'getSportsSpecializations')) {
            $sports = $registerModel->getSportsSpecializations();
        }

        $data = [
            'title' => 'Edit Profile',
            'coach' => $coach ?: ['id' => $user_id],
            'sports' => $sports
        ];

        $this->view('coachdash/v_coach_dashboard_edit', $data);
    }

    public function advertisment(){
        $data = [
            'title' => 'Advertisement Management',
            'monthly_revenue' => 47000,
            'pending_ads' => [
                [
                    'id' => 1, 
                    'title' => 'Advanced Football Training', 
                    'audience' => 'Advanced Players', 
                    'duration' => 30, 
                    'amount' => 15000, 
                    'status' => 'Under Review', 
                    'submitted' => '2025-08-19'
                ]
            ],
            'verified_ads' => [
                [
                    'id' => 4, 
                    'title' => 'Professional Football Coaching', 
                    'audience' => 'All Levels', 
                    'duration' => 30, 
                    'amount' => 18000, 
                    'status' => 'Verified', 
                    'verified_date' => '2025-08-20'
                ]
            ],
            'published_ads' => [
                [
                    'id' => 6, 
                    'title' => 'Elite Football Academy', 
                    'type' => 'Coaching Service', 
                    'audience' => 'Advanced Players',
                    'image' => 'coaching-ad1.jpg',
                    'published' => '2025-08-15', 
                    'expires' => '2025-09-15', 
                    'status' => 'Active'
                ]
            ]
        ];
        $this->view('coachdash/v_advertisment', $data);
    }

    public function blog() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $data = [
            'title' => 'Blog Management',
            'posts' => [
                ['id' => 1, 'title' => 'Football Formation Tactics', 'author' => 'Kalana ekanayke', 'category' => 'Football', 'status' => 'Published', 'published' => '2025-08-18', 'views' => 1250],
                ['id' => 2, 'title' => 'Football Training Tips for Beginners', 'author' => 'Kalana ekanayke', 'category' => 'Football', 'status' => 'Draft', 'published' => '', 'views' => 0],
            ]
        ];

        $this->view('coachdash/v_blog', $data);
    }

    public function updateProfile() {
        // Handle profile update (in real scenario, this would process form data)
        if ($_POST) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $user_id = $_SESSION['user_id'] ?? $_POST['user_id'] ?? 1;

            // collect fields
            $first = trim($_POST['first_name'] ?? '');
            $last = trim($_POST['last_name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['mobile'] ?? '');
            $district = trim($_POST['district'] ?? '');
            $certification = trim($_POST['certification'] ?? '');
            $experience = trim($_POST['experience'] ?? '');
            $coaching_type = trim($_POST['coaching_type'] ?? '');
            $bio = trim($_POST['bio'] ?? '');
            $training_style = trim($_POST['training_style'] ?? '');
            $languages = $_POST['languages'] ?? [];
            $achievements = $_POST['achievements'] ?? [];
            // current_status is the coach's current availability state (available/unavailable/flexibility)
            $current_status = trim($_POST['current_status'] ?? '');
            // availability is the coach's primary work window (weekdays/weekends/flexible)
            $primary_availability = trim($_POST['availability'] ?? '');
            $hourly_rate = trim($_POST['hourly_rate'] ?? '');

            // free_slots may be submitted as an array of arrays
            $free_slots = $_POST['free_slots'] ?? [];
            $specializations = $_POST['specializations'] ?? null;
            // Accept primary sport single select from edit form
            $primarySport = $_POST['specialization'] ?? null;
            if ($primarySport) {
                // if specializations is array, ensure primary sport is included, otherwise set as single
                if (is_array($specializations)) {
                    if (!in_array($primarySport, $specializations)) {
                        array_unshift($specializations, $primarySport);
                    }
                } else {
                    $specializations = [$primarySport];
                }
            }
            // if specializations is a comma-separated string (single input), convert to array
            if (is_string($specializations) && strpos($specializations, ',') !== false) {
                $specializations = array_map('trim', explode(',', $specializations));
            } elseif (is_string($specializations) && trim($specializations) !== '') {
                $specializations = [trim($specializations)];
            }

            $model = $this->model('M_Coachdash');
            $update = $model->updateCoachByUserId($user_id, [
                'first_name' => $first,
                'last_name' => $last,
                'email' => $email,
                'phone' => $phone,
                'district' => $district,
                'certification' => $certification,
                'experience' => $experience,
                'coaching_type' => $coaching_type,
                'bio' => $bio,
                'specialization' => $specializations,
                'languages' => $languages,
                'achievements' => $achievements,
                'training_style' => $training_style,
                'free_slots' => $free_slots,
                // persist current status to coach_card_details and update coach_profiles.availability with primary_availability
                'current_status' => $current_status,
                'primary_availability' => $primary_availability,
                // ensure coach_profiles.availability gets updated from the edit form's availability field
                'availability' => $primary_availability,
                'hourly_rate' => $hourly_rate
            ]);

            // Redirect back to profile page
            header('Location: ' . URLROOT . '/coachdash');
            exit;
        }
    }

    private function getCoachData() {
        // Use the model M_Coachdash to fetch coach data
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user_id = $_SESSION['user_id'] ?? 1; // fallback to 1 for development

        $model = $this->model('M_Coachdash');
        $coach = $model->getCoachByUserId($user_id);

        if ($coach) {
            return $coach;
        }

        // default fallback structure
        return [
            'id' => $user_id,
            'name' => '',
            'image' => '',
            'availability' => '',
            'rating' => '1',
            'location' => '',
            'sport' => '',
            'featured' => false,
            'mobile' => '',
            'bio' => '',
            'rate' => '',
            'experience' => '',
            'certification' => '',
            'specialization' => [],
            'free_slots' => [],
            'achievements' => [],
            'languages' => [],
            'email' => '',
            'address' => '',
            'qualifications' => [],
            'training_style' => ''
        ];
    }
}