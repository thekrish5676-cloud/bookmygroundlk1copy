<?php
class M_Admin {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAdminByUsername($username) {
        $this->db->query('SELECT * FROM admins WHERE username = :username');
        $this->db->bind(':username', $username);
        
        return $this->db->single();
    }

    public function getTotalUsers() {
        $this->db->query('SELECT COUNT(*) as total FROM users');
        return $this->db->single();
    }

    public function getTotalBookings() {
        $this->db->query('SELECT COUNT(*) as total FROM bookings');
        return $this->db->single();
    }

    public function getRecentBookings($limit = 10) {
        $this->db->query('SELECT * FROM bookings ORDER BY created_at DESC LIMIT :limit');
        $this->db->bind(':limit', $limit);
        
        return $this->db->resultSet();
    }

    public function getAllUsers() {
        $this->db->query('SELECT * FROM users ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getAllBookings() {
        $this->db->query('SELECT * FROM bookings ORDER BY created_at DESC');
        return $this->db->resultSet();
    }
}
?>