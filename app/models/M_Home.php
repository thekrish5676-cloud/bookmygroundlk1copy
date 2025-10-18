<?php
class M_Home {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getFeaturedStadiums($limit = 6) {
        // For demo purposes, returning sample data similar to stadiums controller
        // In production, this would fetch featured stadiums from database
        $allStadiums = [
            (object)[
                'id' => 1,
                'name' => 'Colombo Cricket Ground',
                'type' => 'Cricket',
                'category' => 'Outdoor',
                'price' => 5000,
                'location' => 'Colombo 03',
                'rating' => 4.8,
                'image' => 'cricket-ground.jpg',
                'status' => 'Available',
                'owner' => 'Rajesh Kumar',
                'owner_status' => 'Online',
                'features' => ['Lighting', 'Parking', 'WiFi'],
                'more_features' => 1,
                'is_featured' => true
            ],
            (object)[
                'id' => 2,
                'name' => 'Indoor Sports Complex',
                'type' => 'Multi-Sport',
                'category' => 'Indoor',
                'price' => 3500,
                'location' => 'Colombo 07',
                'rating' => 4.6,
                'image' => 'indoor-complex.jpg',
                'status' => 'Available',
                'owner' => 'Samantha Silva',
                'owner_status' => 'Away',
                'features' => ['Air Conditioning', 'Parking', 'WiFi'],
                'more_features' => 0,
                'is_featured' => true
            ],
            (object)[
                'id' => 3,
                'name' => 'Football Arena Pro',
                'type' => 'Football',
                'category' => 'Outdoor',
                'price' => 7500,
                'location' => 'Colombo 05',
                'rating' => 4.9,
                'image' => 'football-arena.jpg',
                'status' => 'Available',
                'owner' => 'David Fernando',
                'owner_status' => 'Online',
                'features' => ['Professional Turf', 'Lighting', 'Parking'],
                'more_features' => 1,
                'is_featured' => true
            ],
            (object)[
                'id' => 4,
                'name' => 'Tennis Academy Courts',
                'type' => 'Tennis',
                'category' => 'Outdoor',
                'price' => 2500,
                'location' => 'Colombo 04',
                'rating' => 4.7,
                'image' => 'tennis-courts.jpg',
                'status' => 'Available',
                'owner' => 'Maria Perera',
                'owner_status' => 'Online',
                'features' => ['Professional Courts', 'Equipment Rental'],
                'more_features' => 2,
                'is_featured' => true
            ],
            (object)[
                'id' => 5,
                'name' => 'Basketball Hub',
                'type' => 'Basketball',
                'category' => 'Indoor',
                'price' => 4000,
                'location' => 'Colombo 06',
                'rating' => 4.5,
                'image' => 'basketball-court.jpg',
                'status' => 'Available',
                'owner' => 'John Mendis',
                'owner_status' => 'Away',
                'features' => ['Professional Court', 'Air Conditioning', 'Parking'],
                'more_features' => 0,
                'is_featured' => true
            ],
            (object)[
                'id' => 6,
                'name' => 'Multi-Purpose Arena',
                'type' => 'Multi-Sport',
                'category' => 'Indoor',
                'price' => 6000,
                'location' => 'Colombo 02',
                'rating' => 4.8,
                'image' => 'multi-purpose.jpg',
                'status' => 'Available',
                'owner' => 'Priya Jayawardena',
                'owner_status' => 'Online',
                'features' => ['Multiple Sports', 'Lighting', 'Parking'],
                'more_features' => 2,
                'is_featured' => true
            ]
        ];

        // Return limited number for featured section
        return array_slice($allStadiums, 0, $limit);
    }

    public function getHeroData() {
        // This will be used later for hero section
        return [
            'title' => 'BOOK YOUR SPORT GROUND',
            'subtitle' => 'Your All-in-One Solution for Finding and Booking Indoor & Outdoor Stadiums, Rent Sport Equipments, Attend Practise Sessions, Book Individual Coaching Sessions & Publish Your Advertisements',
            'stats' => [
                'stadiums' => 150,
                'bookings' => 5000,
                'cities' => 15,
                'users' => 10000
            ]
        ];
    }
}
?>