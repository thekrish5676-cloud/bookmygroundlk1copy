<?php
class M_Stadium_owner {
    private $db;

    public function __construct(){
        try {
            $this->db = new Database();
        } catch (Exception $e) {
            error_log('Database connection error in M_Stadium_owner: ' . $e->getMessage());
        }
    }

    // Get stadium owner dashboard stats
    public function getOwnerStats($owner_id) {
        try {
            if (!$this->db) {
                return $this->getDefaultStats();
            }

            // Get actual stats from database
            $stats = [];
            
            // Total properties count
            $this->db->query('SELECT COUNT(*) as total FROM stadiums WHERE owner_id = :owner_id');
            $this->db->bind(':owner_id', $owner_id);
            $result = $this->db->single();
            $stats['total_properties'] = $result ? $result->total : 0;
            
            // For now, return mixed real and demo data
            $stats['active_bookings'] = 8;
            $stats['monthly_revenue'] = 45000;
            $stats['total_customers'] = 24;
            $stats['occupancy_rate'] = 75;
            $stats['average_rating'] = 4.6;

            return $stats;

        } catch (Exception $e) {
            error_log('Error in getOwnerStats: ' . $e->getMessage());
            return $this->getDefaultStats();
        }
    }

    private function getDefaultStats() {
        return [
            'total_properties' => 0,
            'active_bookings' => 0,
            'monthly_revenue' => 0,
            'total_customers' => 0,
            'occupancy_rate' => 0,
            'average_rating' => 0.0
        ];
    }

    // Get recent bookings for owner
    public function getRecentBookings($owner_id, $limit = 5) {
        try {
            // For now return sample data, later replace with actual database queries
            return [
                [
                    'id' => 'BK001',
                    'customer' => 'Krishna Wishvajith',
                    'property' => 'Colombo Cricket Ground',
                    'date' => '2025-01-25',
                    'time' => '2:00 PM - 4:00 PM',
                    'amount' => 5000,
                    'status' => 'Confirmed',
                    'payment_status' => 'Paid'
                ],
                [
                    'id' => 'BK002',
                    'customer' => 'Kulakshi Thathsarani',
                    'property' => 'Football Arena Pro',
                    'date' => '2025-01-26',
                    'time' => '6:00 PM - 8:00 PM',
                    'amount' => 7500,
                    'status' => 'Pending',
                    'payment_status' => 'Pending'
                ]
            ];
        } catch (Exception $e) {
            error_log('Error in getRecentBookings: ' . $e->getMessage());
            return [];
        }
    }

    // Get upcoming schedules
    public function getUpcomingSchedules($owner_id) {
        try {
            return [
                [
                    'property' => 'Colombo Cricket Ground',
                    'customer' => 'Krishna Wishvajith',
                    'date' => '25',
                    'month' => 'JAN',
                    'time' => '2:00 PM - 4:00 PM',
                    'status' => 'Confirmed'
                ],
                [
                    'property' => 'Football Arena Pro',
                    'customer' => 'Team Phoenix',
                    'date' => '26',
                    'month' => 'JAN',
                    'time' => '6:00 PM - 8:00 PM',
                    'status' => 'Pending'
                ]
            ];
        } catch (Exception $e) {
            error_log('Error in getUpcomingSchedules: ' . $e->getMessage());
            return [];
        }
    }

    // Get revenue overview
    public function getRevenueOverview($owner_id) {
        try {
            return [
                'this_month' => 45000,
                'last_month' => 38000,
                'growth_percentage' => 18.4,
                'pending_payouts' => 12000,
                'next_payout_date' => '2025-02-01'
            ];
        } catch (Exception $e) {
            error_log('Error in getRevenueOverview: ' . $e->getMessage());
            return [];
        }
    }

    // Get property summary
    public function getPropertySummary($owner_id) {
        try {
            return [
                'total_properties' => 3,
                'active_properties' => 3,
                'under_maintenance' => 0,
                'package_type' => 'Standard',
                'properties_limit' => 6,
                'can_add_more' => true
            ];
        } catch (Exception $e) {
            error_log('Error in getPropertySummary: ' . $e->getMessage());
            return [];
        }
    }

    // Get package information
    public function getPackageInfo($owner_id) {
        try {
            return [
                'package_name' => 'Standard',
                'commission_rate' => 12,
                'properties_limit' => 6,
                'photos_limit' => 5,
                'videos_limit' => 5,
                'featured_listings' => 3,
                'support_type' => 'Email & Phone Support'
            ];
        } catch (Exception $e) {
            error_log('Error in getPackageInfo: ' . $e->getMessage());
            return [];
        }
    }

    // Get all properties for owner
    public function getAllProperties($owner_id) {
        try {
            // In a real implementation, fetch from database
            // For now, return sample data
            return [
                [
                    'id' => 1,
                    'name' => 'Colombo Cricket Ground',
                    'type' => 'Cricket',
                    'category' => 'Outdoor',
                    'price' => 5000,
                    'location' => 'Colombo 03',
                    'status' => 'Active',
                    'rating' => 4.8,
                    'total_bookings' => 45,
                    'monthly_revenue' => 18000,
                    'image' => 'cricket-ground.jpg'
                ],
                [
                    'id' => 2,
                    'name' => 'Football Arena Pro',
                    'type' => 'Football',
                    'category' => 'Outdoor',
                    'price' => 7500,
                    'location' => 'Colombo 05',
                    'status' => 'Active',
                    'rating' => 4.9,
                    'total_bookings' => 32,
                    'monthly_revenue' => 19000,
                    'image' => 'football-arena.jpg'
                ],
                [
                    'id' => 3,
                    'name' => 'Tennis Academy Courts',
                    'type' => 'Tennis',
                    'category' => 'Outdoor',
                    'price' => 2500,
                    'location' => 'Colombo 06',
                    'status' => 'Active',
                    'rating' => 4.4,
                    'total_bookings' => 28,
                    'monthly_revenue' => 8000,
                    'image' => 'tennis-courts.jpg'
                ]
            ];
        } catch (Exception $e) {
            error_log('Error in getAllProperties: ' . $e->getMessage());
            return [];
        }
    }

    // Get package limits
    public function getPackageLimits($owner_id) {
        try {
            return [
                'properties_limit' => 6,
                'current_properties' => 3,
                'photos_limit' => 5,
                'videos_limit' => 5,
                'featured_listings' => 3,
                'can_add_property' => true
            ];
        } catch (Exception $e) {
            error_log('Error in getPackageLimits: ' . $e->getMessage());
            return [];
        }
    }

    // Get all bookings for owner
    public function getAllBookings($owner_id) {
        try {
            // Return sample booking data
            return [
                [
                    'id' => 'BK001',
                    'customer' => 'Krishna Wishvajith',
                    'property' => 'Colombo Cricket Ground',
                    'date' => '2025-01-25',
                    'time' => '2:00 PM - 4:00 PM',
                    'duration' => '2 hours',
                    'amount' => 5000,
                    'commission' => 600,
                    'net_amount' => 4400,
                    'status' => 'Confirmed'
                ],
                [
                    'id' => 'BK002',
                    'customer' => 'Kulakshi Thathsarani',
                    'property' => 'Football Arena Pro',
                    'date' => '2025-01-26',
                    'time' => '6:00 PM - 8:00 PM',
                    'duration' => '2 hours',
                    'amount' => 7500,
                    'commission' => 900,
                    'net_amount' => 6600,
                    'status' => 'Pending'
                ]
            ];
        } catch (Exception $e) {
            error_log('Error in getAllBookings: ' . $e->getMessage());
            return [];
        }
    }

    // Get booking stats
    public function getBookingStats($owner_id) {
        try {
            return [
                'confirmed' => 67,
                'pending' => 8,
                'today' => 3,
                'revenue' => 125000
            ];
        } catch (Exception $e) {
            error_log('Error in getBookingStats: ' . $e->getMessage());
            return [];
        }
    }

    // Get messages for owner
    public function getMessages($owner_id) {
        try {
            return [
                [
                    'id' => 1,
                    'from' => 'Krishna Wishvajith',
                    'subject' => 'Booking Inquiry',
                    'message' => 'Hi, I would like to book your cricket ground...',
                    'date' => '2025-01-19',
                    'status' => 'unread'
                ]
            ];
        } catch (Exception $e) {
            error_log('Error in getMessages: ' . $e->getMessage());
            return [];
        }
    }

    // Get unread message count
    public function getUnreadMessageCount($owner_id) {
        try {
            return 3; // Sample count
        } catch (Exception $e) {
            error_log('Error in getUnreadMessageCount: ' . $e->getMessage());
            return 0;
        }
    }

    // Send reply to message
    public function sendReply($owner_id, $messageData) {
        try {
            // In real implementation, save reply to database
            return true;
        } catch (Exception $e) {
            error_log('Error in sendReply: ' . $e->getMessage());
            return false;
        }
    }

    // Get revenue data
    public function getRevenueData($owner_id) {
        try {
            return [
                'total_revenue' => 278000,
                'this_month' => 45000,
                'pending_payout' => 12000,
                'monthly_data' => [
                    'January' => 45000,
                    'February' => 38000,
                    'March' => 42000,
                    'April' => 50000,
                    'May' => 55000,
                    'June' => 48000
                ]
            ];
        } catch (Exception $e) {
            error_log('Error in getRevenueData: ' . $e->getMessage());
            return [];
        }
    }

    // Get analytics data
    public function getAnalytics($owner_id) {
        try {
            return [
                'property_performance' => [
                    ['name' => 'Football Arena Pro', 'bookings' => 32, 'revenue' => 19000],
                    ['name' => 'Colombo Cricket Ground', 'bookings' => 45, 'revenue' => 18000],
                    ['name' => 'Tennis Academy Courts', 'bookings' => 28, 'revenue' => 8000]
                ]
            ];
        } catch (Exception $e) {
            error_log('Error in getAnalytics: ' . $e->getMessage());
            return [];
        }
    }

    // Add new property
    public function addProperty($owner_id, $propertyData) {
        try {
            if (!$this->db) {
                return false;
            }

            // In real implementation, insert into database
            // For now, just return true
            return true;
        } catch (Exception $e) {
            error_log('Error in addProperty: ' . $e->getMessage());
            return false;
        }
    }

    // Update property
    public function updateProperty($owner_id, $property_id, $propertyData) {
        try {
            if (!$this->db) {
                return false;
            }

            // In real implementation, update database
            return true;
        } catch (Exception $e) {
            error_log('Error in updateProperty: ' . $e->getMessage());
            return false;
        }
    }

    // Get single property
    public function getProperty($owner_id, $property_id) {
        try {
            // Return sample property data
            return [
                'id' => $property_id,
                'name' => 'Sample Property',
                'type' => 'Football',
                'category' => 'Outdoor',
                'price' => 5000,
                'location' => 'Colombo 03',
                'description' => 'Sample description',
                'features' => ['Lighting', 'Parking'],
                'status' => 'Active',
                'total_bookings' => 45,
                'monthly_revenue' => 18000,
                'rating' => 4.8,
                'images' => ['sample1.jpg', 'sample2.jpg']
            ];
        } catch (Exception $e) {
            error_log('Error in getProperty: ' . $e->getMessage());
            return [];
        }
    }

    // Get profile data
    public function getProfileData($owner_id) {
        try {
            if (!$this->db) {
                return $this->getDefaultProfileData();
            }

            $this->db->query('SELECT u.*, sop.* FROM users u
                LEFT JOIN stadium_owner_profiles sop ON u.id = sop.user_id
                WHERE u.id = :id AND u.role = "stadium_owner"');
            $this->db->bind(':id', $owner_id);
            
            $profile = $this->db->single();
            
            if ($profile) {
                return [
                    'owner_name' => $profile->owner_name ?? 'Stadium Owner',
                    'business_name' => $profile->business_name ?? 'Sports Complex',
                    'email' => $profile->email ?? 'owner@example.com',
                    'phone' => $profile->phone ?? 'Not set',
                    'address' => $profile->address ?? 'Not set',
                    'business_registration' => $profile->business_registration ?? 'Not set',
                    'website' => $profile->website ?? '',
                    'package_type' => 'Standard', // This would come from a separate package tracking
                    'total_properties' => 3,
                    'total_revenue' => 278000,
                    'rating' => '4.6',
                    'member_since' => isset($profile->created_at) ? date('F Y', strtotime($profile->created_at)) : 'January 2024'
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
            'owner_name' => 'Stadium Owner',
            'business_name' => 'Sports Complex',
            'email' => 'owner@example.com',
            'phone' => 'Not set',
            'address' => 'Not set',
            'business_registration' => 'Not set',
            'website' => '',
            'package_type' => 'Standard',
            'total_properties' => 0,
            'total_revenue' => 0,
            'rating' => '0.0',
            'member_since' => 'January 2025'
        ];
    }

    // Update profile
    public function updateProfile($owner_id, $profileData) {
        try {
            if (!$this->db) {
                return false;
            }

            // Update main user data
            $this->db->query('UPDATE users SET
                phone = :phone,
                updated_at = NOW()
                WHERE id = :id');
            
            $this->db->bind(':phone', $profileData['phone']);
            $this->db->bind(':id', $owner_id);
            
            $result1 = $this->db->execute();

            // Update stadium owner profile data
            $this->db->query('UPDATE stadium_owner_profiles SET
                owner_name = :owner_name,
                business_name = :business_name,
                updated_at = NOW()
                WHERE user_id = :id');
            
            $this->db->bind(':owner_name', $profileData['owner_name']);
            $this->db->bind(':business_name', $profileData['business_name']);
            $this->db->bind(':id', $owner_id);
            
            $result2 = $this->db->execute();
            
            return $result1 && $result2;
        } catch (Exception $e) {
            error_log('Error in updateProfile: ' . $e->getMessage());
            return false;
        }
    }
}
?>