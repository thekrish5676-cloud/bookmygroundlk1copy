<?php
class M_Admin {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Authenticate admin login (now using email instead of username)
    public function authenticateAdmin($email, $password) {
        $this->db->query('SELECT * FROM admins WHERE email = :email');
        $this->db->bind(':email', $email);
        
        $admin = $this->db->single();
        
        if($admin && password_verify($password, $admin->password)) {
            return $admin;
        }
        return false;
    }

    // Update last login
    public function updateLastLogin($admin_id) {
        $this->db->query('UPDATE admins SET last_login = NOW() WHERE id = :id');
        $this->db->bind(':id', $admin_id);
        
        return $this->db->execute();
    }

    // Get total users count
    public function getTotalUsers() {
        $this->db->query('SELECT COUNT(*) as total FROM users');
        $result = $this->db->single();
        return $result ? $result->total : 0;
    }

    // Get all users
    public function getAllUsers() {
        $this->db->query('SELECT u.*, 
            CASE 
                WHEN u.role = "customer" THEN CONCAT(u.first_name, " ", u.last_name)
                WHEN u.role = "stadium_owner" THEN COALESCE(sop.business_name, CONCAT(u.first_name, " ", u.last_name))
                WHEN u.role = "coach" THEN CONCAT(u.first_name, " ", u.last_name)
                WHEN u.role = "rental_owner" THEN COALESCE(rop.business_name, CONCAT(u.first_name, " ", u.last_name))
                ELSE CONCAT(u.first_name, " ", u.last_name)
            END as display_name
            FROM users u
            LEFT JOIN stadium_owner_profiles sop ON u.id = sop.user_id
            LEFT JOIN rental_owner_profiles rop ON u.id = rop.user_id
            ORDER BY u.created_at DESC');
        
        return $this->db->resultSet();
    }

    // Get user by ID
    public function getUserById($id) {
        $this->db->query('SELECT u.*, 
            CASE 
                WHEN u.role = "customer" THEN CONCAT(u.first_name, " ", u.last_name)
                WHEN u.role = "stadium_owner" THEN COALESCE(sop.business_name, CONCAT(u.first_name, " ", u.last_name))
                WHEN u.role = "coach" THEN CONCAT(u.first_name, " ", u.last_name)
                WHEN u.role = "rental_owner" THEN COALESCE(rop.business_name, CONCAT(u.first_name, " ", u.last_name))
                ELSE CONCAT(u.first_name, " ", u.last_name)
            END as display_name
            FROM users u
            LEFT JOIN stadium_owner_profiles sop ON u.id = sop.user_id
            LEFT JOIN rental_owner_profiles rop ON u.id = rop.user_id
            WHERE u.id = :id');
        
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Check if email exists
    public function emailExists($email) {
        $this->db->query('SELECT id FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $this->db->execute();
        
        return $this->db->rowCount() > 0;
    }

    // Check if email exists for other user (for updates)
    public function emailExistsForOtherUser($email, $userId) {
        $this->db->query('SELECT id FROM users WHERE email = :email AND id != :user_id');
        $this->db->bind(':email', $email);
        $this->db->bind(':user_id', $userId);
        $this->db->execute();
        
        return $this->db->rowCount() > 0;
    }

    // Create a new user
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
        $this->db->bind(':status', 'active');
        $this->db->bind(':created_at', date('Y-m-d H:i:s'));

        // Execute
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    // Update user
    public function updateUser($userId, $userData) {
        $this->db->query('UPDATE users SET
            first_name = :first_name,
            last_name = :last_name,
            email = :email,
            phone = :phone,
            status = :status,
            updated_at = :updated_at
            WHERE id = :id');

        $this->db->bind(':first_name', $userData['first_name']);
        $this->db->bind(':last_name', $userData['last_name']);
        $this->db->bind(':email', $userData['email']);
        $this->db->bind(':phone', $userData['phone']);
        $this->db->bind(':status', $userData['status']);
        $this->db->bind(':updated_at', date('Y-m-d H:i:s'));
        $this->db->bind(':id', $userId);

        return $this->db->execute();
    }

    // Update user password
    public function updateUserPassword($userId, $newPassword) {
        $this->db->query('UPDATE users SET
            password = :password,
            updated_at = :updated_at
            WHERE id = :id');

        $this->db->bind(':password', password_hash($newPassword, PASSWORD_DEFAULT));
        $this->db->bind(':updated_at', date('Y-m-d H:i:s'));
        $this->db->bind(':id', $userId);

        return $this->db->execute();
    }

    // Delete user
    public function deleteUser($userId) {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $userId);
        
        return $this->db->execute();
    }

    // Toggle user status
    public function toggleUserStatus($userId) {
        $this->db->query('UPDATE users SET 
            status = CASE 
                WHEN status = "active" THEN "inactive" 
                WHEN status = "inactive" THEN "active" 
                ELSE "active" 
            END,
            updated_at = :updated_at
            WHERE id = :id');
        
        $this->db->bind(':updated_at', date('Y-m-d H:i:s'));
        $this->db->bind(':id', $userId);
        
        return $this->db->execute();
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
        $this->db->bind(':business_registration', $profileData['business_registration']);
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

    // Approve user account
    public function approveUser($user_id) {
        $this->db->query('UPDATE users SET status = "active" WHERE id = :id');
        $this->db->bind(':id', $user_id);
        
        return $this->db->execute();
    }

    // Suspend user account
    public function suspendUser($user_id) {
        $this->db->query('UPDATE users SET status = "suspended" WHERE id = :id');
        $this->db->bind(':id', $user_id);
        
        return $this->db->execute();
    }

    // Get dashboard statistics
    public function getDashboardStats() {
        $stats = [];
        
        // Total users
        $this->db->query('SELECT COUNT(*) as total FROM users');
        $stats['total_users'] = $this->db->single()->total;
        
        // Pending approvals
        $this->db->query('SELECT COUNT(*) as total FROM users WHERE status = "pending"');
        $stats['pending_approvals'] = $this->db->single()->total;
        
        // Active stadiums
        $this->db->query('SELECT COUNT(*) as total FROM users WHERE role = "stadium_owner" AND status = "active"');
        $stats['active_stadiums'] = $this->db->single()->total;
        
        return $stats;
    }

    // Get admin by email
    public function getAdminByEmail($email) {
        $this->db->query('SELECT * FROM admins WHERE email = :email');
        $this->db->bind(':email', $email);
        
        return $this->db->single();
    }

    // Update admin profile
    public function updateAdminProfile($admin_id, $data) {
        $this->db->query('UPDATE admins SET 
            full_name = :full_name,
            email = :email,
            updated_at = NOW()
            WHERE id = :id');
        
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':id', $admin_id);
        
        return $this->db->execute();
    }

    // Change admin password
    public function changeAdminPassword($admin_id, $new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        $this->db->query('UPDATE admins SET 
            password = :password,
            updated_at = NOW()
            WHERE id = :id');
        
        $this->db->bind(':password', $hashed_password);
        $this->db->bind(':id', $admin_id);
        
        return $this->db->execute();
    }

    // Get users by role
    public function getUsersByRole($role) {
        $this->db->query('SELECT u.*, 
            CASE 
                WHEN u.role = "customer" THEN CONCAT(u.first_name, " ", u.last_name)
                WHEN u.role = "stadium_owner" THEN COALESCE(sop.business_name, CONCAT(u.first_name, " ", u.last_name))
                WHEN u.role = "coach" THEN CONCAT(u.first_name, " ", u.last_name)
                WHEN u.role = "rental_owner" THEN COALESCE(rop.business_name, CONCAT(u.first_name, " ", u.last_name))
                ELSE CONCAT(u.first_name, " ", u.last_name)
            END as display_name
            FROM users u
            LEFT JOIN stadium_owner_profiles sop ON u.id = sop.user_id
            LEFT JOIN rental_owner_profiles rop ON u.id = rop.user_id
            WHERE u.role = :role
            ORDER BY u.created_at DESC');
        
        $this->db->bind(':role', $role);
        return $this->db->resultSet();
    }

    // Get users by status
    public function getUsersByStatus($status) {
        $this->db->query('SELECT u.*, 
            CASE 
                WHEN u.role = "customer" THEN CONCAT(u.first_name, " ", u.last_name)
                WHEN u.role = "stadium_owner" THEN COALESCE(sop.business_name, CONCAT(u.first_name, " ", u.last_name))
                WHEN u.role = "coach" THEN CONCAT(u.first_name, " ", u.last_name)
                WHEN u.role = "rental_owner" THEN COALESCE(rop.business_name, CONCAT(u.first_name, " ", u.last_name))
                ELSE CONCAT(u.first_name, " ", u.last_name)
            END as display_name
            FROM users u
            LEFT JOIN stadium_owner_profiles sop ON u.id = sop.user_id
            LEFT JOIN rental_owner_profiles rop ON u.id = rop.user_id
            WHERE u.status = :status
            ORDER BY u.created_at DESC');
        
        $this->db->bind(':status', $status);
        return $this->db->resultSet();
    }

    // Search users
    public function searchUsers($searchTerm) {
        $this->db->query('SELECT u.*, 
            CASE 
                WHEN u.role = "customer" THEN CONCAT(u.first_name, " ", u.last_name)
                WHEN u.role = "stadium_owner" THEN COALESCE(sop.business_name, CONCAT(u.first_name, " ", u.last_name))
                WHEN u.role = "coach" THEN CONCAT(u.first_name, " ", u.last_name)
                WHEN u.role = "rental_owner" THEN COALESCE(rop.business_name, CONCAT(u.first_name, " ", u.last_name))
                ELSE CONCAT(u.first_name, " ", u.last_name)
            END as display_name
            FROM users u
            LEFT JOIN stadium_owner_profiles sop ON u.id = sop.user_id
            LEFT JOIN rental_owner_profiles rop ON u.id = rop.user_id
            WHERE CONCAT(u.first_name, " ", u.last_name) LIKE :search 
            OR u.email LIKE :search
            OR sop.business_name LIKE :search
            OR rop.business_name LIKE :search
            ORDER BY u.created_at DESC');
        
        $searchTerm = '%' . $searchTerm . '%';
        $this->db->bind(':search', $searchTerm);
        return $this->db->resultSet();
    }

    // Get user counts by role
    public function getUserCountsByRole() {
        $this->db->query('SELECT role, COUNT(*) as count FROM users GROUP BY role');
        $results = $this->db->resultSet();
        
        $counts = [
            'customer' => 0,
            'stadium_owner' => 0,
            'coach' => 0,
            'rental_owner' => 0
        ];
        
        foreach ($results as $result) {
            $counts[$result->role] = $result->count;
        }
        
        return $counts;
    }

}