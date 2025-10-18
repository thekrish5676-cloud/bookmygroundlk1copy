<?php
/**
 * Authentication Helper Class
 * Handles session management and authentication checks
 */
class Auth {
    
    // Start session if not started
    public static function init() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    // Check if user is logged in
    public static function isLoggedIn() {
        self::init();
        return isset($_SESSION['user_id']) && isset($_SESSION['user_role']);
    }
    
    // Check if admin is logged in
    public static function isAdmin() {
        self::init();
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }
    
    // Check if user has specific role
    public static function hasRole($role) {
        self::init();
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === $role;
    }
    
    // Get current user ID
    public static function getUserId() {
        self::init();
        return $_SESSION['user_id'] ?? null;
    }
    
    // Get current user role
    public static function getUserRole() {
        self::init();
        return $_SESSION['user_role'] ?? null;
    }
    
    // Get current user data
    public static function getUser() {
        self::init();
        if (!self::isLoggedIn()) {
            return null;
        }
        
        return [
            'id' => $_SESSION['user_id'],
            'role' => $_SESSION['user_role'],
            'email' => $_SESSION['user_email'],
            'name' => $_SESSION['user_name']
        ];
    }
    
    // Redirect if not logged in
    public static function requireLogin() {
        self::init();
        if (!self::isLoggedIn()) {
            header('Location: ' . URLROOT . '/auth/login');
            exit;
        }
    }
    
    // Redirect if not admin
    public static function requireAdmin() {
        self::init();
        if (!self::isAdmin()) {
            header('Location: ' . URLROOT . '/auth/login');
            exit;
        }
    }
    
    // Redirect if not specific role
    public static function requireRole($role) {
        self::init();
        if (!self::hasRole($role)) {
            header('Location: ' . URLROOT . '/auth/login');
            exit;
        }
    }
    
    // Logout user
    public static function logout() {
        self::init();
        session_unset();
        session_destroy();
        header('Location: ' . URLROOT . '/auth/login');
        exit;
    }
    
    // Set user session
    public static function setUserSession($user_id, $role, $email, $name) {
        self::init();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_role'] = $role;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        $_SESSION['logged_in_time'] = time();
    }
}
?>