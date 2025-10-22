<?php
class M_Coaches {
    public function selectbysport(){
        return [
            [
                'id'=>1,
                'title'=>'FootBall',
                'image'=> URLROOT . '/public/images/coaches/foot.jpg',
            ],
            [
                'id'=>2,
                'title'=>'Cricket',
                'image'=> URLROOT . '/public/images/coaches/cricket.jpg',
            ],
            [
                'id'=>3,
                'title'=>'Tennis',
                'image'=> URLROOT . '/public/images/coaches/tenis.jpg',
            ],
            [
                'id'=>4,
                'title'=>'Badminton',
                'image'=> URLROOT . '/public/images/coaches/badminn.jpg',
            ],
            [
                'id'=>5,
                'title'=>'Swimming',
                'image'=> URLROOT . '/public/images/coaches/swim.jpg',
            ]
        ];
    }

    public function getFeatured(){
        $all = $this->getAll();
        $out = [];
        foreach ($all as $c) {
            if (!empty($c['featured'])) {
                $out[] = $c;
            }
        }
        return $out;
    }

    public function getBySport($sport){
        $sport = strtolower(trim($sport));
        $all = $this->getAll();
        $out = [];
        foreach ($all as $c) {
            if (strtolower($c['sport']) === $sport) {
                $out[] = $c;
            }
        }
        return $out;
    }

    public function getAll(){
        return [
            [
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
                'languages' => ['Sinhala', 'English']
            ],
            [
                'id' => 2,
                'name' => 'Dawn Staly',
                'image' => '',
                'gender' => 'female',
                'availability' => 'unavailable',
                'rating' => '2.9',
                'location' => 'Colombo 10',
                'sport' => 'Swimming',
                'featured' => true,
                'mobile' => '+94712234567',
                'bio' => 'Swimming instructor specializing in beginner and intermediate levels. Focus on water safety and proper technique.',
                'rate' => '3,000',
                'experience' => '6 years',
                'certification' => 'ASCA Level 2',
                'specialization' => ['Beginner Lessons', 'Water Safety', 'Stroke Technique'],
                'free_slots' => [
                    ['day' => 'Tuesday', 'time' => '3:00 PM - 4:00 PM', 'type' => 'Kids Session'],
                    ['day' => 'Friday', 'time' => '4:00 PM - 5:00 PM', 'type' => 'Adult Beginners']
                ],
                'achievements' => ['Swim Safety Instructor 2020'],
                'languages' => ['Sinhala', 'English', 'Tamil']
            ],
            [
                'id' => 3,
                'name' => 'Roomy Hassan',
                'image' => URLROOT . '/public/images/coaches/feature/roomy.jpg',
                'gender' => 'male',
                'availability' => 'available',
                'rating' => '3.5',
                'location' => 'Colombo 6',
                'sport' => 'Football',
                'featured' => true,
                'mobile' => '+94713234567',
                'bio' => 'Football coach with extensive experience in youth development and team strategy. Former professional player.',
                'rate' => '2,000',
                'experience' => '10 years',
                'certification' => 'AFC B License',
                'specialization' => ['Youth Development', 'Team Strategy', 'Fitness Training'],
                'free_slots' => [
                    ['day' => 'Thursday', 'time' => '4:30 PM - 5:30 PM', 'type' => 'Youth Training'],
                    ['day' => 'Sunday', 'time' => '8:00 AM - 9:00 AM', 'type' => 'Free Workshop']
                ],
                'achievements' => ['Regional Champions 2018', 'Youth Development Award 2022'],
                'languages' => ['Sinhala', 'English']
            ],
            [
                'id' => 4,
                'name' => 'Jony Rukshan',
                'image' => '',
                'gender' => 'male',
                'availability' => 'available',
                'rating' => '4.0',
                'location' => 'Colombo 3',
                'sport' => 'Football',
                'featured' => true,
                'mobile' => '+94714234567',
                'bio' => 'Passionate football coach focusing on technical skills and game intelligence for all age groups.',
                'rate' => '1,800',
                'experience' => '5 years',
                'certification' => 'National Coaching Certificate',
                'specialization' => ['Technical Skills', 'Game Strategy', 'Physical Conditioning'],
                'free_slots' => [
                    ['day' => 'Monday', 'time' => '5:00 PM - 6:00 PM', 'type' => 'Skills Clinic'],
                    ['day' => 'Saturday', 'time' => '10:00 AM - 11:00 AM', 'type' => 'Free Trial']
                ],
                'achievements' => ['Community Coach Award 2021'],
                'languages' => ['Sinhala', 'English']
            ],
            [
                'id' => 5,
                'name' => 'Jonathan Carls',
                'image' => URLROOT . '/public/images/coaches/feature/tbadminton.jpg',
                'gender' => 'male',
                'availability' => 'available',
                'rating' => '3.8',
                'location' => 'Colombo 7',
                'sport' => 'Badminton',
                'featured' => true,
                'mobile' => '+94715234567',
                'bio' => 'International badminton coach with experience training national level players and beginners alike.',
                'rate' => '3,500',
                'experience' => '12 years',
                'certification' => 'BWF Level 2 Coach',
                'specialization' => ['Advanced Techniques', 'Tournament Preparation', 'Mental Training'],
                'free_slots' => [
                    ['day' => 'Wednesday', 'time' => '6:00 PM - 7:00 PM', 'type' => 'Advanced Session'],
                    ['day' => 'Sunday', 'time' => '3:00 PM - 4:00 PM', 'type' => 'Strategy Workshop']
                ],
                'achievements' => ['International Coach Certification', 'National Team Coach 2020'],
                'languages' => ['English', 'Sinhala', 'Hindi']
            ],
            [
                'id' => 6,
                'name' => 'Thenuka Ranavira',
                'image' => '',
                'gender' => 'male',
                'availability' => 'available',
                'rating' => '4.2',
                'location' => 'Colombo 5',
                'sport' => 'Tennis',
                'featured' => false,
                'mobile' => '+94716234567',
                'bio' => 'Tennis professional with focus on individual technique development and match play strategies.',
                'rate' => '2,800',
                'experience' => '7 years',
                'certification' => 'USPTA Certified',
                'specialization' => ['Individual Training', 'Match Strategy', 'Footwork Drills'],
                'free_slots' => [
                    ['day' => 'Friday', 'time' => '4:00 PM - 5:00 PM', 'type' => 'Beginner Class'],
                    ['day' => 'Saturday', 'time' => '2:00 PM - 3:00 PM', 'type' => 'Free Assessment']
                ],
                'achievements' => ['Regional Tournament Winner 2019'],
                'languages' => ['Sinhala', 'English']
            ],
            [
                'id' => 7,
                'name' => 'Dinesh Gamage',
                'image' => '',
                'gender' => 'male',
                'availability' => 'unavailable',
                'rating' => '3.9',
                'location' => 'Colombo 10',
                'sport' => 'Football',
                'featured' => false,
                'mobile' => '+94717234567',
                'bio' => 'Dedicated football coach with expertise in fitness training and team coordination.',
                'rate' => '2,200',
                'experience' => '4 years',
                'certification' => 'National Coaching Diploma',
                'specialization' => ['Fitness Training', 'Team Coordination', 'Defensive Strategies'],
                'free_slots' => [
                    ['day' => 'Tuesday', 'time' => '5:00 PM - 6:00 PM', 'type' => 'Fitness Session']
                ],
                'achievements' => ['Best Defensive Coach 2021'],
                'languages' => ['Sinhala']
            ],
            [
                'id' => 8,
                'name' => 'Risiru Perera',
                'image' => '',
                'gender' => 'male',
                'availability' => 'available',
                'rating' => '4.6',
                'location' => 'Colombo 10',
                'sport' => 'Swimming',
                'featured' => false,
                'mobile' => '+94718234567',
                'bio' => 'Expert swimming coach specializing in competitive swimming and advanced techniques.',
                'rate' => '3,200',
                'experience' => '9 years',
                'certification' => 'ASCA Level 3',
                'specialization' => ['Competitive Swimming', 'Advanced Techniques', 'Endurance Training'],
                'free_slots' => [
                    ['day' => 'Monday', 'time' => '3:00 PM - 4:00 PM', 'type' => 'Technique Workshop'],
                    ['day' => 'Thursday', 'time' => '5:00 PM - 6:00 PM', 'type' => 'Free Assessment'],
                    ['day' => 'Sunday', 'time' => '10:00 AM - 11:00 AM', 'type' => 'Beginner Session']
                ],
                'achievements' => ['National Swimming Coach 2022', 'Olympic Training Program'],
                'languages' => ['Sinhala', 'English']
            ]
        ];
    }
}