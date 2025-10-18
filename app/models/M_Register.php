<?php
class M_Register {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Check if email already exists
    public function emailExists($email) {
        $this->db->query('SELECT id FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $this->db->execute();
        
        return $this->db->rowCount() > 0;
    }

    // Check if phone number already exists
    public function phoneExists($phone) {
        $this->db->query('SELECT id FROM users WHERE phone = :phone');
        $this->db->bind(':phone', $phone);
        $this->db->execute();
        
        return $this->db->rowCount() > 0;
    }

    // Create a new user account
    public function createUser($userData) {
        $this->db->query('INSERT INTO users (
            first_name, 
            last_name, 
            email, 
            phone, 
            password, 
            role, 
            status, 
            created_at
        ) VALUES (
            :first_name, 
            :last_name, 
            :email, 
            :phone, 
            :password, 
            :role, 
            :status, 
            :created_at
        )');

        // Bind parameters
        $this->db->bind(':first_name', $userData['first_name']);
        $this->db->bind(':last_name', $userData['last_name']);
        $this->db->bind(':email', $userData['email']);
        $this->db->bind(':phone', $userData['phone']);
        $this->db->bind(':password', password_hash($userData['password'], PASSWORD_DEFAULT));
        $this->db->bind(':role', $userData['role']);
        $this->db->bind(':status', 'pending'); // Default status - admin will approve
        $this->db->bind(':created_at', date('Y-m-d H:i:s'));

        // Execute
        if ($this->db->execute()) {
            // Return the newly created user ID
            return $this->db->lastInsertId();
        }
        return false;
    }

    // Create customer profile
    public function createCustomerProfile($userId, $profileData) {
        $this->db->query('INSERT INTO customer_profiles (
            user_id,
            district,
            sports,
            age_group,
            skill_level,
            created_at
        ) VALUES (
            :user_id,
            :district,
            :sports,
            :age_group,
            :skill_level,
            :created_at
        )');

        $this->db->bind(':user_id', $userId);
        $this->db->bind(':district', $profileData['district']);
        $this->db->bind(':sports', $profileData['sports']);
        $this->db->bind(':age_group', $profileData['age_group']);
        $this->db->bind(':skill_level', $profileData['skill_level']);
        $this->db->bind(':created_at', date('Y-m-d H:i:s'));

        return $this->db->execute();
    }

    // Create stadium owner profile
    public function createStadiumOwnerProfile($userId, $profileData) {
        $this->db->query('INSERT INTO stadium_owner_profiles (
            user_id,
            owner_name,
            business_name,
            district,
            venue_type,
            business_registration,
            created_at
        ) VALUES (
            :user_id,
            :owner_name,
            :business_name,
            :district,
            :venue_type,
            :business_registration,
            :created_at
        )');

        $this->db->bind(':user_id', $userId);
        $this->db->bind(':owner_name', $profileData['owner_name']);
        $this->db->bind(':business_name', $profileData['business_name']);
        $this->db->bind(':district', $profileData['district']);
        $this->db->bind(':venue_type', $profileData['venue_type']);
        $this->db->bind(':business_registration', $profileData['business_reg']);
        $this->db->bind(':created_at', date('Y-m-d H:i:s'));

        return $this->db->execute();
    }

    // Create coach profile
    public function createCoachProfile($userId, $profileData) {
        $this->db->query('INSERT INTO coach_profiles (
            user_id,
            specialization,
            experience,
            certification,
            coaching_type,
            district,
            availability,
            created_at
        ) VALUES (
            :user_id,
            :specialization,
            :experience,
            :certification,
            :coaching_type,
            :district,
            :availability,
            :created_at
        )');

        $this->db->bind(':user_id', $userId);
        $this->db->bind(':specialization', $profileData['specialization']);
        $this->db->bind(':experience', $profileData['experience']);
        $this->db->bind(':certification', $profileData['certification']);
        $this->db->bind(':coaching_type', $profileData['coaching_type']);
        $this->db->bind(':district', $profileData['district']);
        $this->db->bind(':availability', $profileData['availability']);
        $this->db->bind(':created_at', date('Y-m-d H:i:s'));

        return $this->db->execute();
    }

    // Create rental owner profile
    public function createRentalOwnerProfile($userId, $profileData) {
        $this->db->query('INSERT INTO rental_owner_profiles (
            user_id,
            owner_name,
            business_name,
            district,
            business_type,
            equipment_categories,
            delivery_service,
            created_at
        ) VALUES (
            :user_id,
            :owner_name,
            :business_name,
            :district,
            :business_type,
            :equipment_categories,
            :delivery_service,
            :created_at
        )');

        $this->db->bind(':user_id', $userId);
        $this->db->bind(':owner_name', $profileData['owner_name']);
        $this->db->bind(':business_name', $profileData['business_name']);
        $this->db->bind(':district', $profileData['district']);
        $this->db->bind(':business_type', $profileData['business_type']);
        $this->db->bind(':equipment_categories', $profileData['equipment_categories']);
        $this->db->bind(':delivery_service', $profileData['delivery_service']);
        $this->db->bind(':created_at', date('Y-m-d H:i:s'));

        return $this->db->execute();
    }

    // Send welcome email (placeholder)
    public function sendWelcomeEmail($email, $name, $role) {
        // TODO: Implement email functionality
        // For now, just return true
        return true;
    }

    // Get all dropdown data methods
    public function getCities() {
        return [
            'Colombo', 'Kandy', 'Galle', 'Jaffna', 'Negombo',
            'Anuradhapura', 'Polonnaruwa', 'Kurunegala', 'Ratnapura',
            'Batticaloa', 'Matara', 'Vavuniya', 'Trincomalee',
            'Kalutara', 'Badulla'
        ];
    }

    public function getSportsSpecializations() {
        return [
            'football' => 'Football',
            'cricket' => 'Cricket',
            'basketball' => 'Basketball',
            'tennis' => 'Tennis',
            'badminton' => 'Badminton',
            'swimming' => 'Swimming',
            'volleyball' => 'Volleyball',
            'rugby' => 'Rugby',
            'athletics' => 'Athletics',
            'hockey' => 'Hockey',
            'futsal' => 'Futsal',
            'table_tennis' => 'Table Tennis',
            'other' => 'Other'
        ];
    }

    public function getAgeGroups() {
        return [
            'under_18' => 'Under 18',
            '18_25' => '18-25 years',
            '26_35' => '26-35 years',
            'above_35' => 'Above 35'
        ];
    }

    public function getSkillLevels() {
        return [
            'beginner' => 'Beginner',
            'intermediate' => 'Intermediate',
            'advanced' => 'Advanced',
            'professional' => 'Professional'
        ];
    }

    public function getVenueTypes() {
        return [
            'stadium' => 'Stadium',
            'indoor_court' => 'Indoor Court',
            'outdoor_court' => 'Outdoor Court',
            'sports_complex' => 'Sports Complex',
            'practice_nets' => 'Practice Nets'
        ];
    }

    public function getBusinessTypes() {
        return [
            'private_stadium' => 'Private Stadium',
            'sports_complex' => 'Sports Complex',
            'community_center' => 'Community Center',
            'school_university' => 'School/University',
            'hotel_resort' => 'Hotel/Resort',
            'government_facility' => 'Government Facility',
            'sports_club' => 'Sports Club',
            'retail_chain' => 'Retail Chain',
            'independent' => 'Independent Store',
            'sports_shop' => 'Sports Shop',
            'equipment_specialist' => 'Equipment Specialist',
            'other' => 'Other'
        ];
    }

    public function getExperienceLevels() {
        return [
            '1_3' => '1-3 years',
            '4_6' => '4-6 years',
            '7_10' => '7-10 years',
            '10_plus' => '10+ years'
        ];
    }

    public function getCertificationLevels() {
        return [
            'basic' => 'Basic Certification',
            'intermediate' => 'Intermediate Level',
            'advanced' => 'Advanced Level',
            'professional' => 'Professional License'
        ];
    }

    public function getCoachingTypes() {
        return [
            'individual' => 'Individual Training',
            'group' => 'Group Sessions',
            'both' => 'Both Individual & Group'
        ];
    }

    public function getAvailabilityOptions() {
        return [
            'full_time' => 'Full Time',
            'part_time' => 'Part Time',
            'weekends' => 'Weekends Only'
        ];
    }

    public function getEquipmentTypes() {
        return [
            'football_equipment' => 'Football Equipment',
            'cricket_equipment' => 'Cricket Equipment',
            'basketball_equipment' => 'Basketball Equipment',
            'tennis_equipment' => 'Tennis Equipment',
            'badminton_equipment' => 'Badminton Equipment',
            'swimming_equipment' => 'Swimming Equipment',
            'volleyball_equipment' => 'Volleyball Equipment',
            'rugby_equipment' => 'Rugby Equipment',
            'athletics_equipment' => 'Athletics Equipment',
            'hockey_equipment' => 'Hockey Equipment',
            'futsal_equipment' => 'Futsal Equipment',
            'table_tennis_equipment' => 'Table Tennis Equipment',
            'gym_equipment' => 'Gym Equipment',
            'safety_gear' => 'Safety Gear'
        ];
    }

    public function getDeliveryOptions() {
        return [
            'yes' => 'Yes, We Deliver',
            'no' => 'Pickup Only'
        ];
    }
}