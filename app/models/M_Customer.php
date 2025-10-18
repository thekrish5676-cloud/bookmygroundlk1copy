<?php
class M_Customer {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Get customer dashboard stats
    public function getCustomerStats($customer_id) {
        // Active bookings count
        $this->db->query('SELECT COUNT(*) as count FROM bookings WHERE customer_id = :id AND status IN ("confirmed", "pending")');
        $this->db->bind(':id', $customer_id);
        $active_bookings = $this->db->single()->count ?? 0;

        // Total stadiums visited
        $this->db->query('SELECT COUNT(DISTINCT stadium_id) as count FROM bookings WHERE customer_id = :id AND status = "completed"');
        $this->db->bind(':id', $customer_id);
        $stadiums_visited = $this->db->single()->count ?? 0;

        // Total amount spent
        $this->db->query('SELECT SUM(amount) as total FROM bookings WHERE customer_id = :id AND status IN ("completed", "confirmed")');
        $this->db->bind(':id', $customer_id);
        $total_spent = $this->db->single()->total ?? 0;

        // Average rating given
        $this->db->query('SELECT AVG(rating) as avg_rating FROM reviews WHERE customer_id = :id');
        $this->db->bind(':id', $customer_id);
        $avg_rating = $this->db->single()->avg_rating ?? 0;

        return [
            'active_bookings' => $active_bookings,
            'stadiums_visited' => $stadiums_visited,
            'total_spent' => $total_spent,
            'rating_given' => round($avg_rating, 1)
        ];
    }

    // Get customer's recent bookings
    public function getRecentBookings($customer_id, $limit = 5) {
        // For now, return sample data until bookings table is ready
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
    }

    // Get all customer bookings
    public function getAllBookings($customer_id) {
        // Return sample data - replace with real query when bookings table is ready
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
            ],
            [
                'id' => 4,
                'stadium' => 'Cricket Ground Elite',
                'date' => '2025-02-05',
                'time' => '2:00 PM - 5:00 PM',
                'duration' => '3 hours',
                'amount' => 1500,
                'status' => 'Confirmed'
            ]
        ];
    }

    // Get customer's favorite stadiums
    public function getFavoriteStadiums($customer_id) {
        // Return sample data
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
            ],
            [
                'id' => 3,
                'name' => 'Tennis Excellence Center',
                'location' => 'Galle, Sri Lanka',
                'last_visited' => 'Jan 20, 2025',
                'total_bookings' => 2,
                'rating' => 4.9,
                'sport' => 'Tennis'
            ]
        ];
    }

    // Get customer's payment history
    public function getPaymentHistory($customer_id) {
        // Return sample data
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
            ],
            [
                'id' => 'PAY-2025-003',
                'date' => '2025-01-20',
                'stadium' => 'Tennis Excellence Center',
                'method' => 'Debit Card',
                'amount' => 1200,
                'status' => 'Completed'
            ]
        ];
    }

    // Get payment statistics
    public function getPaymentStats($customer_id) {
        return [
            'total_spent' => 2450,
            'total_transactions' => 8,
            'avg_booking_amount' => 306,
            'pending_payments' => 1
        ];
    }

    // Get customer's upcoming events
    public function getUpcomingEvents($customer_id) {
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
    }

    // Get customer profile data
    public function getProfileData($customer_id) {
        $this->db->query('SELECT u.*, cp.district, cp.sports, cp.age_group, cp.skill_level 
            FROM users u
            LEFT JOIN customer_profiles cp ON u.id = cp.user_id
            WHERE u.id = :id');
        $this->db->bind(':id', $customer_id);
        
        $profile = $this->db->single();
        
        if ($profile) {
            return [
                'first_name' => $profile->first_name,
                'last_name' => $profile->last_name,
                'email' => $profile->email,
                'phone' => $profile->phone,
                'location' => $profile->district ?? 'Not set',
                'favorite_sports' => $profile->sports ?? 'Not set',
                'age_group' => $profile->age_group ?? 'Not set',
                'skill_level' => $profile->skill_level ?? 'Not set',
                'member_since' => date('F Y', strtotime($profile->created_at)),
                'total_bookings' => 12,
                'favorite_venues' => 3,
                'loyalty_points' => 245
            ];
        }
        
        return null;
    }

    // Update customer profile
    public function updateProfile($customer_id, $profile_data) {
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
    }

    // Cancel booking
    public function cancelBooking($booking_id, $customer_id) {
        // TODO: Implement with real bookings table
        // Check if booking exists and belongs to customer
        // Check if cancellation is within policy (12 hours before)
        // Update booking status to cancelled
        // Create refund request
        return true; // Placeholder
    }

    // Reschedule booking
    public function rescheduleBooking($booking_id, $customer_id, $new_date, $new_time) {
        // TODO: Implement with real bookings table
        return true; // Placeholder
    }

    // Rate stadium
    public function rateStadium($customer_id, $stadium_id, $booking_id, $rating, $review = null) {
        // TODO: Implement with reviews table
        return true; // Placeholder
    }

    // Get loyalty points
    public function getLoyaltyPoints($customer_id) {
        // TODO: Implement with loyalty_points table
        return 245; // Placeholder
    }

    // Get points history
    public function getPointsHistory($customer_id) {
        // TODO: Implement with loyalty_points table
        return []; // Placeholder
    }

    // Get customer notifications
    public function getNotifications($customer_id, $limit = 10) {
        // TODO: Implement with notifications table
        return []; // Placeholder
    }

    // Mark notification as read
    public function markNotificationRead($notification_id, $customer_id) {
        // TODO: Implement with notifications table
        return true; // Placeholder
    }

    // Get booking by ID for customer
    public function getBookingById($booking_id, $customer_id) {
        // TODO: Implement with bookings table
        return null; // Placeholder
    }
}