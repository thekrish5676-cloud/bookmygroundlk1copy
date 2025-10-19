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

    // ============= USER CRUD OPERATIONS =============

    // CREATE - Add new user
    public function createUser($userData) {
        try {
            // Insert into users table
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
                NOW()
            )');

            $this->db->bind(':first_name', $userData['first_name']);
            $this->db->bind(':last_name', $userData['last_name']);
            $this->db->bind(':email', $userData['email']);
            $this->db->bind(':phone', $userData['phone']);
            $this->db->bind(':password', password_hash($userData['password'], PASSWORD_DEFAULT));
            $this->db->bind(':role', $userData['role']);
            $this->db->bind(':status', $userData['status']);

            if ($this->db->execute()) {
                $userId = $this->db->lastInsertId();
                
                // Create role-specific profile
                $this->createRoleProfile($userId, $userData['role'], $userData);
                
                return $userId;
            }
            return false;
        } catch (Exception $e) {
            error_log('Create user error: ' . $e->getMessage());
            return false;
        }
    }

    // READ - Get all users with role-specific data
    public function getAllUsers($filters = []) {
        $sql = 'SELECT u.*, 
            CASE 
                WHEN u.role = "customer" THEN CONCAT(u.first_name, " ", u.last_name)
                WHEN u.role = "stadium_owner" THEN sop.business_name
                WHEN u.role = "coach" THEN CONCAT(u.first_name, " ", u.last_name)
                WHEN u.role = "rental_owner" THEN rop.business_name
                ELSE CONCAT(u.first_name, " ", u.last_name)
            END as display_name,
            CASE
                WHEN u.role = "stadium_owner" THEN sop.owner_name
                WHEN u.role = "rental_owner" THEN rop.owner_name
                ELSE NULL
            END as owner_name
            FROM users u
            LEFT JOIN stadium_owner_profiles sop ON u.id = sop.user_id
            LEFT JOIN rental_owner_profiles rop ON u.id = rop.user_id
            WHERE 1=1';

        // Apply filters
        if (!empty($filters['role'])) {
            $sql .= ' AND u.role = :role';
        }
        if (!empty($filters['status'])) {
            $sql .= ' AND u.status = :status';
        }
        if (!empty($filters['search'])) {
            $sql .= ' AND (u.first_name LIKE :search OR u.last_name LIKE :search OR u.email LIKE :search)';
        }

        $sql .= ' ORDER BY u.created_at DESC';

        $this->db->query($sql);

        // Bind filter values
        if (!empty($filters['role'])) {
            $this->db->bind(':role', $filters['role']);
        }
        if (!empty($filters['status'])) {
            $this->db->bind(':status', $filters['status']);
        }
        if (!empty($filters['search'])) {
            $this->db->bind(':search', '%' . $filters['search'] . '%');
        }

        return $this->db->resultSet();
    }

    // READ - Get user by ID with role-specific data
    public function getUserById($id) {
        $this->db->query('SELECT u.*, 
            cp.district as customer_district, cp.sports, cp.age_group, cp.skill_level,
            sop.owner_name as stadium_owner_name, sop.business_name as stadium_business_name, 
            sop.district as stadium_district, sop.venue_type, sop.business_registration,
            cochp.specialization, cochp.experience, cochp.certification, cochp.coaching_type,
            cochp.district as coach_district, cochp.availability,
            rop.owner_name as rental_owner_name, rop.business_name as rental_business_name,
            rop.district as rental_district, rop.business_type, rop.equipment_categories, rop.delivery_service
            FROM users u
            LEFT JOIN customer_profiles cp ON u.id = cp.user_id
            LEFT JOIN stadium_owner_profiles sop ON u.id = sop.user_id
            LEFT JOIN coach_profiles cochp ON u.id = cochp.user_id
            LEFT JOIN rental_owner_profiles rop ON u.id = rop.user_id
            WHERE u.id = :id');
        
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // UPDATE - Update user information
    public function updateUser($id, $userData) {
        try {
            // Update main user data
            $this->db->query('UPDATE users SET 
                first_name = :first_name,
                last_name = :last_name,
                email = :email,
                phone = :phone,
                role = :role,
                status = :status,
                updated_at = NOW()
                WHERE id = :id');

            $this->db->bind(':first_name', $userData['first_name']);
            $this->db->bind(':last_name', $userData['last_name']);
            $this->db->bind(':email', $userData['email']);
            $this->db->bind(':phone', $userData['phone']);
            $this->db->bind(':role', $userData['role']);
            $this->db->bind(':status', $userData['status']);
            $this->db->bind(':id', $id);

            if ($this->db->execute()) {
                // Update role-specific profile if provided
                if (isset($userData['profile_data'])) {
                    $this->updateRoleProfile($id, $userData['role'], $userData['profile_data']);
                }
                return true;
            }
            return false;
        } catch (Exception $e) {
            error_log('Update user error: ' . $e->getMessage());
            return false;
        }
    }

    // UPDATE - Change user password
    public function updateUserPassword($id, $newPassword) {
        $this->db->query('UPDATE users SET 
            password = :password,
            updated_at = NOW()
            WHERE id = :id');
        
        $this->db->bind(':password', password_hash($newPassword, PASSWORD_DEFAULT));
        $this->db->bind(':id', $id);
        
        return $this->db->execute();
    }

    // UPDATE - Change user status (suspend/activate)
    public function updateUserStatus($id, $status) {
        $this->db->query('UPDATE users SET 
            status = :status,
            updated_at = NOW()
            WHERE id = :id');
        
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        
        return $this->db->execute();
    }

    // DELETE - Delete user and related data
    public function deleteUser($id) {
        try {
            // Get user role first
            $this->db->query('SELECT role FROM users WHERE id = :id');
            $this->db->bind(':id', $id);
            $user = $this->db->single();
            
            if (!$user) {
                return false;
            }

            // Delete role-specific profile first (due to foreign key constraints)
            $this->deleteRoleProfile($id, $user->role);

            // Delete from users table
            $this->db->query('DELETE FROM users WHERE id = :id');
            $this->db->bind(':id', $id);
            
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Delete user error: ' . $e->getMessage());
            return false;
        }
    }

    // ============= HELPER METHODS =============

    // Create role-specific profile
    private function createRoleProfile($userId, $role, $userData) {
        switch($role) {
            case 'customer':
                if (isset($userData['customer_data'])) {
                    $this->db->query('INSERT INTO customer_profiles (
                        user_id, district, sports, age_group, skill_level, created_at
                    ) VALUES (
                        :user_id, :district, :sports, :age_group, :skill_level, NOW()
                    )');
                    
                    $this->db->bind(':user_id', $userId);
                    $this->db->bind(':district', $userData['customer_data']['district']);
                    $this->db->bind(':sports', $userData['customer_data']['sports']);
                    $this->db->bind(':age_group', $userData['customer_data']['age_group']);
                    $this->db->bind(':skill_level', $userData['customer_data']['skill_level']);
                    
                    $this->db->execute();
                }
                break;

            case 'stadium_owner':
                if (isset($userData['stadium_owner_data'])) {
                    $this->db->query('INSERT INTO stadium_owner_profiles (
                        user_id, owner_name, business_name, district, venue_type, business_registration, created_at
                    ) VALUES (
                        :user_id, :owner_name, :business_name, :district, :venue_type, :business_registration, NOW()
                    )');
                    
                    $this->db->bind(':user_id', $userId);
                    $this->db->bind(':owner_name', $userData['stadium_owner_data']['owner_name']);
                    $this->db->bind(':business_name', $userData['stadium_owner_data']['business_name']);
                    $this->db->bind(':district', $userData['stadium_owner_data']['district']);
                    $this->db->bind(':venue_type', $userData['stadium_owner_data']['venue_type']);
                    $this->db->bind(':business_registration', $userData['stadium_owner_data']['business_registration']);
                    
                    $this->db->execute();
                }
                break;

            case 'coach':
                if (isset($userData['coach_data'])) {
                    $this->db->query('INSERT INTO coach_profiles (
                        user_id, specialization, experience, certification, coaching_type, district, availability, created_at
                    ) VALUES (
                        :user_id, :specialization, :experience, :certification, :coaching_type, :district, :availability, NOW()
                    )');
                    
                    $this->db->bind(':user_id', $userId);
                    $this->db->bind(':specialization', $userData['coach_data']['specialization']);
                    $this->db->bind(':experience', $userData['coach_data']['experience']);
                    $this->db->bind(':certification', $userData['coach_data']['certification']);
                    $this->db->bind(':coaching_type', $userData['coach_data']['coaching_type']);
                    $this->db->bind(':district', $userData['coach_data']['district']);
                    $this->db->bind(':availability', $userData['coach_data']['availability']);
                    
                    $this->db->execute();
                }
                break;

            case 'rental_owner':
                if (isset($userData['rental_owner_data'])) {
                    $this->db->query('INSERT INTO rental_owner_profiles (
                        user_id, owner_name, business_name, district, business_type, equipment_categories, delivery_service, created_at
                    ) VALUES (
                        :user_id, :owner_name, :business_name, :district, :business_type, :equipment_categories, :delivery_service, NOW()
                    )');
                    
                    $this->db->bind(':user_id', $userId);
                    $this->db->bind(':owner_name', $userData['rental_owner_data']['owner_name']);
                    $this->db->bind(':business_name', $userData['rental_owner_data']['business_name']);
                    $this->db->bind(':district', $userData['rental_owner_data']['district']);
                    $this->db->bind(':business_type', $userData['rental_owner_data']['business_type']);
                    $this->db->bind(':equipment_categories', $userData['rental_owner_data']['equipment_categories']);
                    $this->db->bind(':delivery_service', $userData['rental_owner_data']['delivery_service']);
                    
                    $this->db->execute();
                }
                break;
        }
    }

    // Update role-specific profile
    private function updateRoleProfile($userId, $role, $profileData) {
        switch($role) {
            case 'customer':
                $this->db->query('UPDATE customer_profiles SET 
                    district = :district,
                    sports = :sports,
                    age_group = :age_group,
                    skill_level = :skill_level,
                    updated_at = NOW()
                    WHERE user_id = :user_id');
                
                $this->db->bind(':district', $profileData['district']);
                $this->db->bind(':sports', $profileData['sports']);
                $this->db->bind(':age_group', $profileData['age_group']);
                $this->db->bind(':skill_level', $profileData['skill_level']);
                $this->db->bind(':user_id', $userId);
                
                $this->db->execute();
                break;

            case 'stadium_owner':
                $this->db->query('UPDATE stadium_owner_profiles SET 
                    owner_name = :owner_name,
                    business_name = :business_name,
                    district = :district,
                    venue_type = :venue_type,
                    business_registration = :business_registration,
                    updated_at = NOW()
                    WHERE user_id = :user_id');
                
                $this->db->bind(':owner_name', $profileData['owner_name']);
                $this->db->bind(':business_name', $profileData['business_name']);
                $this->db->bind(':district', $profileData['district']);
                $this->db->bind(':venue_type', $profileData['venue_type']);
                $this->db->bind(':business_registration', $profileData['business_registration']);
                $this->db->bind(':user_id', $userId);
                
                $this->db->execute();
                break;

            // Add other roles as needed...
        }
    }

    // Delete role-specific profile
    private function deleteRoleProfile($userId, $role) {
        switch($role) {
            case 'customer':
                $this->db->query('DELETE FROM customer_profiles WHERE user_id = :user_id');
                break;
            case 'stadium_owner':
                $this->db->query('DELETE FROM stadium_owner_profiles WHERE user_id = :user_id');
                break;
            case 'coach':
                $this->db->query('DELETE FROM coach_profiles WHERE user_id = :user_id');
                break;
            case 'rental_owner':
                $this->db->query('DELETE FROM rental_owner_profiles WHERE user_id = :user_id');
                break;
        }
        
        if (isset($this->db)) {
            $this->db->bind(':user_id', $userId);
            $this->db->execute();
        }
    }

    // Check if email exists (for validation)
    public function emailExists($email, $excludeId = null) {
        $sql = 'SELECT id FROM users WHERE email = :email';
        if ($excludeId) {
            $sql .= ' AND id != :exclude_id';
        }
        
        $this->db->query($sql);
        $this->db->bind(':email', $email);
        if ($excludeId) {
            $this->db->bind(':exclude_id', $excludeId);
        }
        
        return $this->db->rowCount() > 0;
    }

    // Get dashboard statistics
    public function getDashboardStats() {
        $stats = [];
        
        // Total users
        $this->db->query('SELECT COUNT(*) as total FROM users');
        $stats['total_users'] = $this->db->single()->total;
        
        // Users by role
        $this->db->query('SELECT role, COUNT(*) as count FROM users GROUP BY role');
        $roleStats = $this->db->resultSet();
        foreach($roleStats as $role) {
            $stats['role_' . $role->role] = $role->count;
        }
        
        // Users by status
        $this->db->query('SELECT status, COUNT(*) as count FROM users GROUP BY status');
        $statusStats = $this->db->resultSet();
        foreach($statusStats as $status) {
            $stats['status_' . $status->status] = $status->count;
        }
        
        // Recent registrations (last 30 days)
        $this->db->query('SELECT COUNT(*) as total FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)');
        $stats['recent_registrations'] = $this->db->single()->total;
        
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
}