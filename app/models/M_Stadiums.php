<?php
class M_Stadiums {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllStadiums() {
        // For demo purposes, returning sample data
        // In production, this would fetch from database
        return [
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
                'more_features' => 1
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
                'more_features' => 0
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
                'status' => 'Booked',
                'owner' => 'David Fernando',
                'owner_status' => 'Online',
                'features' => ['Professional Turf', 'Lighting', 'Parking'],
                'more_features' => 1
            ],
            (object)[
                'id' => 4,
                'name' => 'Tennis Academy Courts',
                'type' => 'Tennis',
                'category' => 'Outdoor',
                'price' => 2500,
                'location' => 'Colombo 06',
                'rating' => 4.4,
                'image' => 'tennis-courts.jpg',
                'status' => 'Available',
                'owner' => 'Michelle Perera',
                'owner_status' => 'Online',
                'features' => ['Clay Courts', 'Lighting', 'Equipment Rental'],
                'more_features' => 2
            ],
            (object)[
                'id' => 5,
                'name' => 'Basketball Hub Angoda',
                'type' => 'Basketball',
                'category' => 'Indoor',
                'price' => 4000,
                'location' => 'Angoda',
                'rating' => 4.7,
                'image' => 'basketball-court.jpg',
                'status' => 'Available',
                'owner' => 'Kevin Rodrigo',
                'owner_status' => 'Online',
                'features' => ['Professional Court', 'Sound System', 'Seating'],
                'more_features' => 0
            ],
            (object)[
                'id' => 6,
                'name' => 'Swimming Pool Complex',
                'type' => 'Swimming',
                'category' => 'Outdoor',
                'price' => 6000,
                'location' => 'Mount Lavinia',
                'rating' => 4.5,
                'image' => 'swimming-pool.jpg',
                'status' => 'Available',
                'owner' => 'Sarah Johnson',
                'owner_status' => 'Away',
                'features' => ['Olympic Size', 'Changing Rooms', 'Lifeguard'],
                'more_features' => 3
            ]
        ];
    }

    public function getStadiumById($id) {
        // This would fetch single stadium from database
        $stadiums = $this->getAllStadiums();
        
        foreach($stadiums as $stadium) {
            if($stadium->id == $id) {
                return $stadium;
            }
        }
        
        return false;
    }

    public function searchStadiums($filters = []) {
        // This would implement search/filter functionality
        // For now, return all stadiums
        return $this->getAllStadiums();
    }
}