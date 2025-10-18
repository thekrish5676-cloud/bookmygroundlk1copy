<?php
class M_Customer {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Find customer by email
    public function findCustomerByEmail($email) {
        $this->db->query('SELECT * FROM customers WHERE email = :email');
        $this->db->bind(':email', $email);
        
        return $this->db->single();
    }

    // Authenticate customer login
    public function authenticateCustomer($email, $password) {
        $customer = $this->findCustomerByEmail($email);
        
        if($customer) {
            // In production, use password_verify() for hashed passwords
            if(password_verify($password, $customer->password)) {
                return $customer;
            }
        }
        return false;
    }

    // Get customer dashboard stats
    public function getCustomerStats($customer_id) {
        // Active bookings count
        $this->db->query('SELECT COUNT(*) as count FROM bookings WHERE customer_id = :id AND status IN ("confirmed", "pending")');
        $this->db->bind(':id', $customer_id);
        $active_bookings = $this->db->single()->count;

        // Total stadiums visited
        $this->db->query('SELECT COUNT(DISTINCT stadium_id) as count FROM bookings WHERE customer_id = :id AND status = "completed"');
        $this->db->bind(':id', $customer_id);
        $stadiums_visited = $this->db->single()->count;

        // Total amount spent
        $this->db->query('SELECT SUM(amount) as total FROM payments WHERE customer_id = :id AND status = "completed"');
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
        $this->db->query('
            SELECT b.*, s.name as stadium_name 
            FROM bookings b 
            JOIN stadiums s ON b.stadium_id = s.id 
            WHERE b.customer_id = :customer_id 
            ORDER BY b.booking_date DESC 
            LIMIT :limit
        ');
        $this->db->bind(':customer_id', $customer_id);
        $this->db->bind(':limit', $limit);
        
        return $this->db->resultSet();
    }

    // Get all customer bookings
    public function getAllBookings($customer_id) {
        $this->db->query('
            SELECT b.*, s.name as stadium_name, s.location 
            FROM bookings b 
            JOIN stadiums s ON b.stadium_id = s.id 
            WHERE b.customer_id = :customer_id 
            ORDER BY b.booking_date DESC
        ');
        $this->db->bind(':customer_id', $customer_id);
        
        return $this->db->resultSet();
    }

    // Get customer's favorite stadiums
    public function getFavoriteStadiums($customer_id) {
        $this->db->query('
            SELECT s.*, COUNT(b.id) as booking_count, AVG(r.rating) as avg_rating,
                   MAX(b.booking_date) as last_visit
            FROM stadiums s
            JOIN bookings b ON s.id = b.stadium_id
            LEFT JOIN reviews r ON s.id = r.stadium_id AND r.customer_id = :customer_id
            WHERE b.customer_id = :customer_id AND b.status = "completed"
            GROUP BY s.id
            ORDER BY booking_count DESC, last_visit DESC
            LIMIT 10
        ');
        $this->db->bind(':customer_id', $customer_id);
        
        return $this->db->resultSet();
    }

    // Get customer's payment history
    public function getPaymentHistory($customer_id) {
        $this->db->query('
            SELECT p.*, b.booking_id, s.name as stadium_name
            FROM payments p
            JOIN bookings b ON p.booking_id = b.id
            JOIN stadiums s ON b.stadium_id = s.id
            WHERE p.customer_id = :customer_id
            ORDER BY p.payment_date DESC
        ');
        $this->db->bind(':customer_id', $customer_id);
        
        return $this->db->resultSet();
    }

    // Get customer's upcoming events
    public function getUpcomingEvents($customer_id) {
        $this->db->query('
            SELECT b.*, s.name as stadium_name
            FROM bookings b
            JOIN stadiums s ON b.stadium_id = s.id
            WHERE b.customer_id = :customer_id 
            AND b.booking_date >= CURDATE()
            AND b.status IN ("confirmed", "pending")
            ORDER BY b.booking_date ASC, b.start_time ASC
            LIMIT 10
        ');
        $this->db->bind(':customer_id', $customer_id);
        
        return $this->db->resultSet();
    }

    // Update customer profile
    public function updateProfile($customer_id, $profile_data) {
        $this->db->query('
            UPDATE customers SET
                first_name = :first_name,
                last_name = :last_name,
                phone = :phone,
                location = :location,
                favorite_sports = :favorite_sports,
                updated_at = NOW()
            WHERE id = :id
        ');
        
        $this->db->bind(':first_name', $profile_data['first_name']);
        $this->db->bind(':last_name', $profile_data['last_name']);
        $this->db->bind(':phone', $profile_data['phone']);
        $this->db->bind(':location', $profile_data['location']);
        $this->db->bind(':favorite_sports', $profile_data['favorite_sports']);
        $this->db->bind(':id', $customer_id);
        
        return $this->db->execute();
    }

    // Cancel booking
    public function cancelBooking($booking_id, $customer_id) {
        // Check if booking belongs to customer and is cancellable
        $this->db->query('
            SELECT * FROM bookings 
            WHERE id = :booking_id 
            AND customer_id = :customer_id 
            AND status IN ("confirmed", "pending")
            AND booking_date > DATE_ADD(NOW(), INTERVAL 6 HOUR)
        ');
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':customer_id', $customer_id);
        
        $booking = $this->db->single();
        
        if($booking) {
            // Update booking status to cancelled
            $this->db->query('UPDATE bookings SET status = "cancelled", updated_at = NOW() WHERE id = :id');
            $this->db->bind(':id', $booking_id);
            
            if($this->db->execute()) {
                // Create refund request
                $this->db->query('
                    INSERT INTO refund_requests (booking_id, customer_id, amount, reason, status, created_at)
                    VALUES (:booking_id, :customer_id, :amount, "Customer cancellation", "pending", NOW())
                ');
                $this->db->bind(':booking_id', $booking_id);
                $this->db->bind(':customer_id', $customer_id);
                $this->db->bind(':amount', $booking->amount);
                
                return $this->db->execute();
            }
        }
        
        return false;
    }

    // Rate stadium
    public function rateStadium($customer_id, $stadium_id, $booking_id, $rating, $review = null) {
        $this->db->query('
            INSERT INTO reviews (customer_id, stadium_id, booking_id, rating, review, created_at)
            VALUES (:customer_id, :stadium_id, :booking_id, :rating, :review, NOW())
            ON DUPLICATE KEY UPDATE
            rating = :rating2, review = :review2, updated_at = NOW()
        ');
        
        $this->db->bind(':customer_id', $customer_id);
        $this->db->bind(':stadium_id', $stadium_id);
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':rating', $rating);
        $this->db->bind(':review', $review);
        $this->db->bind(':rating2', $rating);
        $this->db->bind(':review2', $review);
        
        return $this->db->execute();
    }

    // Get customer's loyalty points
    public function getLoyaltyPoints($customer_id) {
        $this->db->query('
            SELECT SUM(points) as total_points 
            FROM loyalty_points 
            WHERE customer_id = :customer_id 
            AND status = "active"
        ');
        $this->db->bind(':customer_id', $customer_id);
        
        $result = $this->db->single();
        return $result->total_points ?? 0;
    }

    // Add loyalty points
    public function addLoyaltyPoints($customer_id, $points, $description = 'Booking reward') {
        $this->db->query('
            INSERT INTO loyalty_points (customer_id, points, description, status, created_at)
            VALUES (:customer_id, :points, :description, "active", NOW())
        ');
        
        $this->db->bind(':customer_id', $customer_id);
        $this->db->bind(':points', $points);
        $this->db->bind(':description', $description);
        
        return $this->db->execute();
    }

    // Get customer notifications
    public function getNotifications($customer_id, $limit = 10) {
        $this->db->query('
            SELECT * FROM notifications 
            WHERE customer_id = :customer_id 
            ORDER BY created_at DESC 
            LIMIT :limit
        ');
        $this->db->bind(':customer_id', $customer_id);
        $this->db->bind(':limit', $limit);
        
        return $this->db->resultSet();
    }

    // Mark notification as read
    public function markNotificationRead($notification_id, $customer_id) {
        $this->db->query('
            UPDATE notifications 
            SET is_read = 1, read_at = NOW() 
            WHERE id = :id AND customer_id = :customer_id
        ');
        $this->db->bind(':id', $notification_id);
        $this->db->bind(':customer_id', $customer_id);
        
        return $this->db->execute();
    }

    // Get booking by ID for customer
    public function getBookingById($booking_id, $customer_id) {
        $this->db->query('
            SELECT b.*, s.name as stadium_name, s.location, s.contact_phone
            FROM bookings b
            JOIN stadiums s ON b.stadium_id = s.id
            WHERE b.id = :booking_id AND b.customer_id = :customer_id
        ');
        $this->db->bind(':booking_id', $booking_id);
        $this->db->bind(':customer_id', $customer_id);
        
        return $this->db->single();
    }
}