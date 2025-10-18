<?php
class Auth {
    
    // Check if user is logged in
    public static function isLoggedIn() {
        return isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
    }
    
    // Check if admin is logged in
    public static function isAdminLoggedIn() {
        return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    }
    
    // Check if user has specific role
    public static function hasRole($role) {
        return self::isLoggedIn() && isset($_SESSION['user_role']) && $_SESSION['user_role'] === $role;
    }
    
    // Get current user ID
    public static function getUserId() {
        return $_SESSION['user_id'] ?? null;
    }
    
    // Get current user role
    public static function getUserRole() {
        return $_SESSION['user_role'] ?? null;
    }
    
    // Require login - redirect if not logged in
    public static function requireLogin() {
        if (!self::isLoggedIn()) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }
    }
    
    // Require admin - redirect if not admin
    public static function requireAdmin() {
        if (!self::isAdminLoggedIn()) {
            header('Location: ' . URLROOT . '/admin/login');
            exit;
        }
    }
    
    // Require specific role
    public static function requireRole($role) {
        if (!self::hasRole($role)) {
            header('Location: ' . URLROOT . '/login');
            exit;
        }
    }
    
    // Check if account is active
    public static function isAccountActive() {
        return isset($_SESSION['user_status']) && $_SESSION['user_status'] === 'active';
    }
}