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
        session_start();
        
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
            // Process form data and update coach profile
            // This would typically update the database
            
            // Redirect back to profile page with success message
            header('Location: ' . URLROOT . '/coachdash');
            exit;
        }
    }

    private function getCoachData() {
        // In real scenario, this would fetch from database based on logged-in coach
        return [
            'id' => 1,
            'name' => 'Thimira Jayasingha',
            'image' => '',
            'gender' => 'male',
            'availability' => 'available',
            'rating' => '4.9',
            'location' => 'Colombo 10',
            'sport' => 'Badminton',
            'featured' => true,
            'mobile' => '+94711234567',
            'bio' => 'Professional badminton coach with 8+ years of experience. Former national level player specializing in technique improvement and competitive training.',
            'rate' => '2,500',
            'experience' => '8 years',
            'certification' => 'Level 3 Badminton Coach',
            'specialization' => ['Technique Training', 'Competitive Coaching', 'Fitness Conditioning'],
            'free_slots' => [
                ['day' => 'Monday', 'time' => '4:00 PM - 5:00 PM', 'type' => 'Group Session'],
                ['day' => 'Wednesday', 'time' => '5:00 PM - 6:00 PM', 'type' => 'Beginner Class'],
                ['day' => 'Saturday', 'time' => '9:00 AM - 10:00 AM', 'type' => 'Free Trial']
            ],
            'achievements' => ['National Championship 2019', 'Best Coach Award 2021'],
            'languages' => ['Sinhala', 'English'],
            'email' => 'thimira@example.com',
            'address' => '123 Coach Street, Colombo 10',
            'qualifications' => ['Level 3 Coaching Certificate', 'Sports Science Diploma'],
            'training_style' => 'Technical focus with game-based learning approach'
        ];
    }
}