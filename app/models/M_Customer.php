<?php
class M_Customer {
    private $db;

    public function __construct(){
        try {
            $this->db = new Database();
        } catch (Exception $e) {
            error_log('Database connection error in M_Customer: ' . $e->getMessage());
            // Don't die here, let methods handle the error
        }
    }

    // Get customer dashboard stats
    public function getCustomerStats($customer_id) {
        try {
            if (!$this->db) {
                // Return default stats if database is not available
                return [
                    'active_bookings' => 0,
                    'stadiums_visited' => 0,
                    'total_spent' => 0,
                    'rating_given' => 0
                ];
            }

            // For now, return sample data since bookings table might not exist yet
            return [
                'active_bookings' => 12,
                'stadiums_visited' => 8,
                'total_spent' => 2450,
                'rating_given' => 4.8
            ];

        } catch (Exception $e) {
            error_log('Error in getCustomerStats: ' . $e->getMessage());
            return [
                'active_bookings' => 0,
                'stadiums_visited' => 0,
                'total_spent' => 0,
                'rating_given' => 0
            ];
        }
    }

    // Get customer's recent bookings
    public function getRecentBookings($customer_id, $limit = 5) {
        try {
            // Return sample data for now
            return [
                [
                    'id' => 1,
                    'stadium' => 'Central Football Arena',
                    'date' => '2025-01-25',
                    'time' => '6:00 PM - 8:00 PM',
                    'duration' => '2 hours',
                    'amount' => 800,
                    'status' => 'Confirmed'
                ],
                [
                    'id' => 2,
                    'stadium' => 'Badminton Court Pro',
                    'date' => '2025-01-28',
                    'time' => '4:00 PM - 6:00 PM',
                    'duration' => '2 hours',
                    'amount' => 600,
                    'status' => 'Pending'
                ],
                [
                    'id' => 3,
                    'stadium' => 'Tennis Excellence Center',
                    'date' => '2025-01-20',
                    'time' => '7:00 PM - 9:00 PM',
                    'duration' => '2 hours',
                    'amount' => 1200,
                    'status' => 'Completed'
                ]
            ];
        } catch (Exception $e) {
            error_log('Error in getRecentBookings: ' . $e->getMessage());
            return [];
        }
    }

    // Get all customer bookings
    public function getAllBookings($customer_id) {
        try {
            return $this->getRecentBookings($customer_id, 10); // Return more bookings
        } catch (Exception $e) {
            error_log('Error in getAllBookings: ' . $e->getMessage());
            return [];
        }
    }

    // Get customer's favorite stadiums
    public function getFavoriteStadiums($customer_id) {
        try {
            return [
                [
                    'id' => 1,
                    'name' => 'Central Football Arena',
                    'location' => 'Colombo, Sri Lanka',
                    'last_visited' => 'Jan 25, 2025',
                    'total_bookings' => 5,
                    'rating' => 4.8,
                    'sport' => 'Football'
                ],
                [
                    'id' => 2,
                    'name' => 'Badminton Court Pro',
                    'location' => 'Kandy, Sri Lanka',
                    'last_visited' => 'Jan 28, 2025',
                    'total_bookings' => 3,
                    'rating' => 4.6,
                    'sport' => 'Badminton'
                ]
            ];
        } catch (Exception $e) {
            error_log('Error in getFavoriteStadiums: ' . $e->getMessage());
            return [];
        }
    }

    // Get customer's payment history
    public function getPaymentHistory($customer_id) {
        try {
            return [
                [
                    'id' => 'PAY-2025-001',
                    'date' => '2025-01-25',
                    'stadium' => 'Central Football Arena',
                    'method' => 'Credit Card',
                    'amount' => 800,
                    'status' => 'Completed'
                ],
                [
                    'id' => 'PAY-2025-002',
                    'date' => '2025-01-28',
                    'stadium' => 'Badminton Court Pro',
                    'method' => 'Debit Card',
                    'amount' => 600,
                    'status' => 'Pending'
                ]
            ];
        } catch (Exception $e) {
            error_log('Error in getPaymentHistory: ' . $e->getMessage());
            return [];
        }
    }

    // Get customer's upcoming events
    public function getUpcomingEvents($customer_id) {
        try {
            return [
                [
                    'id' => 1,
                    'title' => 'Football Match - Central Arena',
                    'date' => '25',
                    'month' => 'JAN',
                    'time' => '6:00 PM - 8:00 PM',
                    'type' => 'Personal Booking'
                ],
                [
                    'id' => 2,
                    'title' => 'Badminton Practice - Court Pro',
                    'date' => '28',
                    'month' => 'JAN',
                    'time' => '4:00 PM - 6:00 PM',
                    'type' => 'Personal Booking'
                ]
            ];
        } catch (Exception $e) {
            error_log('Error in getUpcomingEvents: ' . $e->getMessage());
            return [];
        }
    }

    // Get customer profile data
    public function getProfileData($customer_id) {
        try {
            if (!$this->db) {
                return $this->getDefaultProfileData();
            }

            $this->db->query('SELECT u.*, cp.district, cp.sports, cp.age_group, cp.skill_level 
                FROM users u
                LEFT JOIN customer_profiles cp ON u.id = cp.user_id
                WHERE u.id = :id');
            $this->db->bind(':id', $customer_id);
            
            $profile = $this->db->single();
            
            if ($profile) {
                return [
                    'first_name' => $profile->first_name ?? 'User',
                    'last_name' => $profile->last_name ?? 'Name',
                    'email' => $profile->email ?? 'user@example.com',
                    'phone' => $profile->phone ?? 'Not set',
                    'location' => $profile->district ?? 'Not set',
                    'favorite_sports' => $profile->sports ?? 'Not set',
                    'age_group' => $profile->age_group ?? 'Not set',
                    'skill_level' => $profile->skill_level ?? 'Not set',
                    'member_since' => isset($profile->created_at) ? date('F Y', strtotime($profile->created_at)) : 'January 2025',
                    'total_bookings' => 12,
                    'favorite_venues' => 3,
                    'loyalty_points' => 245
                ];
            }
            
            return $this->getDefaultProfileData();
            
        } catch (Exception $e) {
            error_log('Error in getProfileData: ' . $e->getMessage());
            return $this->getDefaultProfileData();
        }
    }

    private function getDefaultProfileData() {
        return [
            'first_name' => 'User',
            'last_name' => 'Name',
            'email' => 'user@example.com',
            'phone' => 'Not set',
            'location' => 'Not set',
            'favorite_sports' => 'Not set',
            'age_group' => 'Not set',
            'skill_level' => 'Not set',
            'member_since' => 'January 2025',
            'total_bookings' => 0,
            'favorite_venues' => 0,
            'loyalty_points' => 0
        ];
    }

    // Update customer profile
    public function updateProfile($customer_id, $profile_data) {
        try {
            if (!$this->db) {
                return false;
            }

            $this->db->query('UPDATE users SET
                first_name = :first_name,
                last_name = :last_name,
                phone = :phone,
                updated_at = NOW()
                WHERE id = :id');
            
            $this->db->bind(':first_name', $profile_data['first_name']);
            $this->db->bind(':last_name', $profile_data['last_name']);
            $this->db->bind(':phone', $profile_data['phone']);
            $this->db->bind(':id', $customer_id);
            
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Error in updateProfile: ' . $e->getMessage());
            return false;
        }
    }

    // Get customer profile (alias for backward compatibility)
    public function getProfile($customer_id) {
        return $this->getProfileData($customer_id);
    }
}