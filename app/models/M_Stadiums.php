<?php
class M_Stadiums {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllStadiums() {
        $this->db->query('SELECT * FROM stadiums ORDER BY id ASC');
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

    public function getStadiumById($id) {
        $this->db->query('SELECT * FROM stadiums WHERE id = :id');
        $this->db->bind(':id', $id);
        $stadium = $this->db->single();
        
        if($stadium) {
            $stadium->features = $this->getStadiumFeatures($stadium->id);
            $stadium->more_features = count($stadium->features) > 3 ? count($stadium->features) - 3 : 0;
        }
        
        return $stadium;
    }

    public function getNearbyStadiums($location, $excludeId, $limit = 4) {
        // For now, get stadiums in similar location
        $this->db->query('SELECT * FROM stadiums WHERE location LIKE :location AND id != :exclude_id ORDER BY rating DESC LIMIT :limit');
        $this->db->bind(':location', '%' . $location . '%');
        $this->db->bind(':exclude_id', $excludeId);
        $this->db->bind(':limit', $limit);
        
        $stadiums = $this->db->resultSet();
        
        // Get features for each stadium
        foreach($stadiums as $stadium) {
            $stadium->features = $this->getStadiumFeatures($stadium->id);
            $stadium->more_features = count($stadium->features) > 3 ? count($stadium->features) - 3 : 0;
        }
        
        return $stadiums;
    }

    public function getStadiumGallery($stadium_id) {
        // For demo, return sample images - in real app this would come from database
        return [
            'main.jpg',
            'gallery1.jpg', 
            'gallery2.jpg',
            'gallery3.jpg',
            'gallery4.jpg',
            'gallery5.jpg'
        ];
    }

    public function getStadiumVideos($stadium_id) {
        // For demo, return sample videos - in real app this would come from database
        return [
            [
                'title' => 'Stadium Tour',
                'thumbnail' => 'video-thumb1.jpg',
                'url' => 'https://www.youtube.com/embed/sample1'
            ],
            [
                'title' => 'Facilities Overview',
                'thumbnail' => 'video-thumb2.jpg', 
                'url' => 'https://www.youtube.com/embed/sample2'
            ],
            [
                'title' => 'Match Highlights',
                'thumbnail' => 'video-thumb3.jpg',
                'url' => 'https://www.youtube.com/embed/sample3'
            ]
        ];
    }

    public function getStadiumReviews($stadium_id, $limit = 5) {
        // For demo, return sample reviews - in real app this would come from database
        return [
            [
                'id' => 1,
                'customer_name' => 'Krishna Wishvajith',
                'rating' => 5,
                'comment' => 'Excellent facilities and well-maintained ground. The lighting system is perfect for evening matches.',
                'date' => '2025-01-15',
                'verified' => true
            ],
            [
                'id' => 2,
                'customer_name' => 'Kulakshi Thathsarani',
                'rating' => 4,
                'comment' => 'Great stadium with good parking facilities. Only minor issue was the changing room could be cleaner.',
                'date' => '2025-01-10',
                'verified' => true
            ],
            [
                'id' => 3,
                'customer_name' => 'Dinesh Sulakshana',
                'rating' => 5,
                'comment' => 'Professional quality ground and excellent customer service. Highly recommended!',
                'date' => '2025-01-08',
                'verified' => false
            ],
            [
                'id' => 4,
                'customer_name' => 'Kalana Ekanayake',
                'rating' => 4,
                'comment' => 'Good value for money. The turf quality is excellent and perfect for tournaments.',
                'date' => '2025-01-05',
                'verified' => true
            ]
        ];
    }

    public function searchStadiums($filters = []) {
        // Build base query
        $sql = 'SELECT * FROM stadiums WHERE 1=1';
        
        // Add filters dynamically
        if(!empty($filters['type'])) {
            $sql .= ' AND type = :type';
        }
        if(!empty($filters['category'])) {
            $sql .= ' AND category = :category';
        }
        if(!empty($filters['location'])) {
            $sql .= ' AND location LIKE :location';
        }
        if(!empty($filters['status'])) {
            $sql .= ' AND status = :status';
        }
        
        $sql .= ' ORDER BY id ASC';
        
        $this->db->query($sql);
        
        // Bind parameters
        if(!empty($filters['type'])) {
            $this->db->bind(':type', $filters['type']);
        }
        if(!empty($filters['category'])) {
            $this->db->bind(':category', $filters['category']);
        }
        if(!empty($filters['location'])) {
            $this->db->bind(':location', '%' . $filters['location'] . '%');
        }
        if(!empty($filters['status'])) {
            $this->db->bind(':status', $filters['status']);
        }
        
        $stadiums = $this->db->resultSet();
        
        // Get features for each stadium
        foreach($stadiums as $stadium) {
            $stadium->features = $this->getStadiumFeatures($stadium->id);
            $stadium->more_features = count($stadium->features) > 3 ? count($stadium->features) - 3 : 0;
        }
        
        return $stadiums;
    }
}
?>