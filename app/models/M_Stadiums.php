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