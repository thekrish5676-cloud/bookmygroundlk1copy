<?php
class M_Login {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Find user by email
    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        
        $row = $this->db->single();
        
        // Check if user exists
        if($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    // Verify user login credentials
    public function login($email, $password) {
        $user = $this->findUserByEmail($email);
        
        if($user) {
            // Verify password (assuming password is hashed)
            if(password_verify($password, $user->password)) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Check if email exists (for forgot password)
    public function emailExists($email) {
        $this->db->query('SELECT id FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Create password reset token
    public function createPasswordResetToken($email) {
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        $this->db->query('INSERT INTO password_resets (email, token, expires_at) VALUES (:email, :token, :expires)');
        $this->db->bind(':email', $email);
        $this->db->bind(':token', $token);
        $this->db->bind(':expires', $expires);
        
        if($this->db->execute()) {
            return $token;
        } else {
            return false;
        }
    }

    // Get user roles for login
    public function getUserRoles() {
        return [
            'customer' => 'Customer',
            'stadium_owner' => 'Stadium Owner', 
            'coach' => 'Coach',
            'rental_owner' => 'Rental Owner'
        ];
    }

    // Log user activity
    public function logActivity($user_id, $activity) {
        $this->db->query('INSERT INTO user_activity (user_id, activity, created_at) VALUES (:user_id, :activity, :created_at)');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':activity', $activity);
        $this->db->bind(':created_at', date('Y-m-d H:i:s'));
        
        return $this->db->execute();
    }

    // Get login attempts (for security)
    public function getLoginAttempts($email) {
        $this->db->query('SELECT COUNT(*) as attempts FROM login_attempts WHERE email = :email AND attempted_at > DATE_SUB(NOW(), INTERVAL 15 MINUTE)');
        $this->db->bind(':email', $email);
        
        $result = $this->db->single();
        return $result->attempts ?? 0;
    }

    // Record failed login attempt
    public function recordLoginAttempt($email, $ip_address) {
        $this->db->query('INSERT INTO login_attempts (email, ip_address, attempted_at) VALUES (:email, :ip, :attempted_at)');
        $this->db->bind(':email', $email);
        $this->db->bind(':ip', $ip_address);
        $this->db->bind(':attempted_at', date('Y-m-d H:i:s'));
        
        return $this->db->execute();
    }

    // Clear login attempts after successful login
    public function clearLoginAttempts($email) {
        $this->db->query('DELETE FROM login_attempts WHERE email = :email');
        $this->db->bind(':email', $email);
        
        return $this->db->execute();
    }

    // Update last login time
    public function updateLastLogin($user_id) {
        $this->db->query('UPDATE users SET last_login = :last_login WHERE id = :id');
        $this->db->bind(':last_login', date('Y-m-d H:i:s'));
        $this->db->bind(':id', $user_id);
        
        return $this->db->execute();
    }
}