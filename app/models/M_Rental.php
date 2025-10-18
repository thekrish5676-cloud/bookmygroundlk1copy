<?php
class M_Rental {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllRentals() {
        // Fetch all rental shops from database
        $this->db->query('SELECT * FROM rental_shops ORDER BY rating DESC');
        $rentals = $this->db->resultSet();
        
        // Get equipment types and features for each rental shop
        foreach($rentals as $rental) {
            $rental->equipment_types = $this->getRentalEquipmentTypes($rental->id);
            $rental->features = $this->getRentalFeatures($rental->id);
        }
        
        return $rentals;
    }

    private function getRentalEquipmentTypes($rental_id) {
        $this->db->query('SELECT equipment_type FROM rental_equipment_types WHERE rental_id = :rental_id');
        $this->db->bind(':rental_id', $rental_id);
        $types = $this->db->resultSet();
        
        // Convert to simple array of equipment types
        $typesArray = [];
        foreach($types as $type) {
            $typesArray[] = $type->equipment_type;
        }
        
        return $typesArray;
    }

    private function getRentalFeatures($rental_id) {
        $this->db->query('SELECT feature_name FROM rental_features WHERE rental_id = :rental_id');
        $this->db->bind(':rental_id', $rental_id);
        $features = $this->db->resultSet();
        
        // Convert to simple array of feature names
        $featuresArray = [];
        foreach($features as $feature) {
            $featuresArray[] = $feature->feature_name;
        }
        
        return $featuresArray;
    }

    public function getRentalById($id) {
        // Fetch single rental shop from database
        $this->db->query('SELECT * FROM rental_shops WHERE id = :id');
        $this->db->bind(':id', $id);
        $rental = $this->db->single();
        
        if($rental) {
            $rental->equipment_types = $this->getRentalEquipmentTypes($rental->id);
            $rental->features = $this->getRentalFeatures($rental->id);
        }
        
        return $rental;
    }

    public function searchRentals($filters = []) {
        // Build base query
        $sql = 'SELECT * FROM rental_shops WHERE 1=1';
        
        // Add filters dynamically
        if(!empty($filters['category'])) {
            $sql .= ' AND category = :category';
        }
        if(!empty($filters['location'])) {
            $sql .= ' AND location LIKE :location';
        }
        if(!empty($filters['status'])) {
            $sql .= ' AND status = :status';
        }
        if(!empty($filters['delivery'])) {
            $sql .= ' AND delivery = :delivery';
        }
        if(!empty($filters['rating'])) {
            $sql .= ' AND rating >= :rating';
        }
        
        $sql .= ' ORDER BY rating DESC';
        
        $this->db->query($sql);
        
        // Bind parameters
        if(!empty($filters['category'])) {
            $this->db->bind(':category', $filters['category']);
        }
        if(!empty($filters['location'])) {
            $this->db->bind(':location', '%' . $filters['location'] . '%');
        }
        if(!empty($filters['status'])) {
            $this->db->bind(':status', $filters['status']);
        }
        if(!empty($filters['delivery'])) {
            $this->db->bind(':delivery', $filters['delivery']);
        }
        if(!empty($filters['rating'])) {
            $this->db->bind(':rating', $filters['rating']);
        }
        
        $rentals = $this->db->resultSet();
        
        // Get equipment types and features for each rental shop
        foreach($rentals as $rental) {
            $rental->equipment_types = $this->getRentalEquipmentTypes($rental->id);
            $rental->features = $this->getRentalFeatures($rental->id);
        }
        
        return $rentals;
    }
}
?>