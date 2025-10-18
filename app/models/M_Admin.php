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

    // Get all users
    public function getAllUsers() {
        $this->db->query('SELECT u.*, 
            CASE 
                WHEN u.role = "customer" THEN CONCAT(u.first_name, " ", u.last_name)
                WHEN u.role = "stadium_owner" THEN sop.business_name
                WHEN u.role = "coach" THEN CONCAT(u.first_name, " ", u.last_name)
                WHEN u.role = "rental_owner" THEN rop.business_name
            END as display_name
            FROM users u
            LEFT JOIN stadium_owner_profiles sop ON u.id = sop.user_id
            LEFT JOIN rental_owner_profiles rop ON u.id = rop.user_id
            ORDER BY u.created_at DESC');
        
        return $this->db->resultSet();
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

    // Delete user account
    public function deleteUser($user_id) {
        $this->db->query('DELETE FROM users WHERE id = :id');
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
}