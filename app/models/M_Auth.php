<?php
class M_Auth {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // ============ ADMIN AUTHENTICATION ============
    
    public function authenticateAdmin($email, $password) {
        // Check if this is the fixed admin email
        if ($email !== 'krishnawishvajith@gmail.com') {
            return false;
        }
        
        $this->db->query('SELECT * FROM admins WHERE email = :email');
        $this->db->bind(':email', $email);
        $admin = $this->db->single();
        
        if ($admin && password_verify($password, $admin->password)) {
            return $admin;
        }
        
        return false;
    }

    // ============ USER AUTHENTICATION ============
    
    public function authenticateUser($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :email AND status = "active"');
        $this->db->bind(':email', $email);
        $user = $this->db->single();
        
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        
        return false;
    }

    // ============ REGISTRATION ============
    
    public function registerUser($data) {
        $this->db->query('INSERT INTO users (first_name, last_name, email, phone, password, role, status) 
                         VALUES (:first_name, :last_name, :email, :phone, :password, :role, :status)');
        
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':status', 'active');
        
        if ($this->db->execute()) {
            // Get last inserted ID
            $this->db->query('SELECT LAST_INSERT_ID() as id');
            $result = $this->db->single();
            return $result->id;
        }
        
        return false;
    }

    // ============ VALIDATION ============
    
    public function emailExists($email) {
        // Check in users table
        $this->db->query('SELECT id FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $this->db->execute();
        
        if ($this->db->rowCount() > 0) {
            return true;
        }
        
        // Check if it's admin email
        if ($email === 'krishnawishvajith@gmail.com') {
            return true;
        }
        
        return false;
    }

    public function phoneExists($phone) {
        $this->db->query('SELECT id FROM users WHERE phone = :phone');
        $this->db->bind(':phone', $phone);
        $this->db->execute();
        
        return $this->db->rowCount() > 0;
    }

    // ============ SECURITY ============
    
    public function recordLoginAttempt($email, $ip_address) {
        $this->db->query('INSERT INTO login_attempts (email, ip_address) VALUES (:email, :ip)');
        $this->db->bind(':email', $email);
        $this->db->bind(':ip', $ip_address);
        
        return $this->db->execute();
    }

    public function getLoginAttempts($email) {
        $this->db->query('SELECT COUNT(*) as attempts FROM login_attempts 
                         WHERE email = :email AND attempted_at > DATE_SUB(NOW(), INTERVAL 15 MINUTE)');
        $this->db->bind(':email', $email);
        
        $result = $this->db->single();
        return $result->attempts ?? 0;
    }

    public function clearLoginAttempts($email) {
        $this->db->query('DELETE FROM login_attempts WHERE email = :email');
        $this->db->bind(':email', $email);
        
        return $this->db->execute();
    }
}
?>