<?php
class M_Home {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getFeaturedStadiums($limit = 6) {
        // Fetch only featured stadiums from database
        $this->db->query('SELECT * FROM stadiums WHERE is_featured = TRUE ORDER BY rating DESC LIMIT :limit');
        $this->db->bind(':limit', $limit);
        $stadiums = $this->db->resultSet();
        
        // Get features for each stadium
        foreach($stadiums as $stadium) {
            $stadium->features = $this->getStadiumFeatures($stadium->id);
            // Calculate how many features are hidden (more than 3)
            $stadium->more_features = count($stadium->features) > 3 ? count($stadium->features) - 3 : 0;
        }
        
        return $stadiums;
    }

    private function getStadiumFeatures($stadium_id) {
        $this->db->query('SELECT feature_name FROM stadium_features WHERE stadium_id = :stadium_id');
        $this->db->bind(':stadium_id', $stadium_id);
        $features = $this->db->resultSet();
        
        // Convert to simple array of feature names
        $featureArray = [];
        foreach($features as $feature) {
            $featureArray[] = $feature->feature_name;
        }
        
        return $featureArray;
    }

    public function getHeroData() {
        // Get dynamic stats from database
        $this->db->query('SELECT COUNT(*) as total FROM stadiums');
        $stadiumCount = $this->db->single()->total;
        
        return [
            'title' => 'BOOK YOUR SPORT GROUND',
            'subtitle' => 'Your All-in-One Solution for Finding and Booking Indoor & Outdoor Stadiums, Rent Sport Equipments, Attend Practise Sessions, Book Individual Coaching Sessions & Publish Your Events',
            'stats' => [
                'stadiums' => $stadiumCount,
                'bookings' => 5000,
                'cities' => 15,
                'users' => 10000
            ]
        ];
    }
}
?>