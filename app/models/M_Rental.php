<?php
class M_Rental {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllRentals() {
        // For demo purposes, returning sample data
        // In production, this would fetch from database
        return [
            (object)[
                'id' => 1,
                'store_name' => 'Pro Sports Gear',
                'category' => 'Multi-Sport',
                'location' => 'Colombo 03',
                'phone' => '+94 71 234 5678',
                'whatsapp' => '+94 71 234 5678',
                'email' => 'contact@prosportsgear.lk',
                'address' => '123 Galle Road, Colombo 03',
                'rating' => 4.8,
                'image' => 'pro-sports-gear.jpg',
                'status' => 'Open',
                'owner' => 'Kulassi Thathsarani',
                'owner_status' => 'Online',
                'equipment_types' => ['Cricket', 'Football', 'Tennis', 'Basketball'],
                'features' => ['Home Delivery', 'Quality Guarantee', 'Online Booking'],
                'description' => 'Complete sports equipment rental service with premium quality gear for all sports.',
                'hours' => 'Mon-Sun: 8:00 AM - 8:00 PM',
                'delivery' => true,
                'experience' => '10+ years'
            ],
            (object)[
                'id' => 2,
                'store_name' => 'Cricket Zone Rentals',
                'category' => 'Cricket',
                'location' => 'Colombo 07',
                'phone' => '+94 77 345 6789',
                'whatsapp' => '+94 77 345 6789',
                'email' => 'info@cricketzone.lk',
                'address' => '456 Duplication Road, Colombo 07',
                'rating' => 4.6,
                'image' => 'cricket-zone.jpg',
                'status' => 'Open',
                'owner' => 'Sunil Fernando',
                'owner_status' => 'Online',
                'equipment_types' => ['Cricket'],
                'features' => ['Expert Advice', 'Equipment Maintenance', 'Bulk Discounts'],
                'description' => 'Specialized cricket equipment rental with professional grade gear.',
                'hours' => 'Mon-Sat: 9:00 AM - 7:00 PM',
                'delivery' => true,
                'experience' => '8+ years'
            ],
            (object)[
                'id' => 3,
                'store_name' => 'Football Gear Hub',
                'category' => 'Football',
                'location' => 'Dehiwala',
                'phone' => '+94 70 456 7890',
                'whatsapp' => '+94 70 456 7890',
                'email' => 'hello@footballgearhub.lk',
                'address' => '789 Galle Road, Dehiwala',
                'rating' => 4.9,
                'image' => 'football-gear.jpg',
                'status' => 'Open',
                'owner' => 'Dinesh Silva',
                'owner_status' => 'Away',
                'equipment_types' => ['Football'],
                'features' => ['Team Packages', 'Goalkeeper Gear', 'Size Fitting'],
                'description' => 'Premium football equipment rental for players and teams.',
                'hours' => 'Mon-Sun: 7:00 AM - 9:00 PM',
                'delivery' => true,
                'experience' => '12+ years'
            ],
            (object)[
                'id' => 4,
                'store_name' => 'Tennis Pro Rentals',
                'category' => 'Tennis',
                'location' => 'Mount Lavinia',
                'phone' => '+94 76 567 8901',
                'whatsapp' => '+94 76 567 8901',
                'email' => 'rentals@tennispro.lk',
                'address' => '321 Hotel Road, Mount Lavinia',
                'rating' => 4.7,
                'image' => 'tennis-pro.jpg',
                'status' => 'Open',
                'owner' => 'Priya Rajapaksa',
                'owner_status' => 'Online',
                'equipment_types' => ['Tennis'],
                'features' => ['Racket Stringing', 'Professional Advice', 'Tournament Gear'],
                'description' => 'High-quality tennis equipment rental with expert guidance.',
                'hours' => 'Tue-Sun: 8:00 AM - 6:00 PM',
                'delivery' => false,
                'experience' => '6+ years'
            ],
            (object)[
                'id' => 5,
                'store_name' => 'All Sports Equipment',
                'category' => 'Multi-Sport',
                'location' => 'Nugegoda',
                'phone' => '+94 75 678 9012',
                'whatsapp' => '+94 75 678 9012',
                'email' => 'info@allsportsequipment.lk',
                'address' => '654 High Level Road, Nugegoda',
                'rating' => 4.5,
                'image' => 'all-sports.jpg',
                'status' => 'Closed',
                'owner' => 'Nimal Wickramasinghe',
                'owner_status' => 'Offline',
                'equipment_types' => ['Cricket', 'Football', 'Tennis', 'Basketball', 'Badminton'],
                'features' => ['Affordable Rates', 'Student Discounts', 'Equipment Insurance'],
                'description' => 'Wide range of sports equipment for rent at competitive prices.',
                'hours' => 'Mon-Sat: 9:00 AM - 6:00 PM',
                'delivery' => true,
                'experience' => '15+ years'
            ],
            (object)[
                'id' => 6,
                'store_name' => 'Basketball Gear Store',
                'category' => 'Basketball',
                'location' => 'Colombo 05',
                'phone' => '+94 74 789 0123',
                'whatsapp' => '+94 74 789 0123',
                'email' => 'contact@basketballgear.lk',
                'address' => '987 Baseline Road, Colombo 05',
                'rating' => 4.4,
                'image' => 'basketball-gear.jpg',
                'status' => 'Open',
                'owner' => 'Kalana Ekanayaka Max',
                'owner_status' => 'Online',
                'equipment_types' => ['Basketball'],
                'features' => ['Professional Shoes', 'Team Uniforms', 'Training Equipment'],
                'description' => 'Complete basketball equipment rental for players and teams.',
                'hours' => 'Mon-Sun: 10:00 AM - 8:00 PM',
                'delivery' => true,
                'experience' => '5+ years'
            ]
        ];
    }

    public function getRentalById($id) {
        // This would fetch single rental from database
        $rentals = $this->getAllRentals();
        
        foreach($rentals as $rental) {
            if($rental->id == $id) {
                return $rental;
            }
        }
        
        return false;
    }

    public function searchRentals($filters = []) {
        // This would implement search/filter functionality
        // For now, return all rentals
        return $this->getAllRentals();
    }
}