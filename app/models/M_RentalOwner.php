<?php
class M_RentalOwner {
    private $db;

    public function __construct(){
        try {
            $this->db = new Database();
        } catch (Exception $e) {
            error_log('Database connection error in M_RentalOwner: ' . $e->getMessage());
        }
    }

    // Get rental owner dashboard stats
    public function getOwnerStats($owner_id) {
        try {
            if (!$this->db) {
                return $this->getDefaultStats();
            }

            // For now, return sample data since we may not have all rental tables set up yet
            $stats = [
                'total_shops' => 4,
                'active_rentals' => 12,
                'monthly_revenue' => 25000,
                'total_customers' => 18,
                'equipment_items' => 85,
                'average_rating' => 4.6
            ];

            return $stats;

        } catch (Exception $e) {
            error_log('Error in getOwnerStats: ' . $e->getMessage());
            return $this->getDefaultStats();
        }
    }

    private function getDefaultStats() {
        return [
            'total_shops' => 0,
            'active_rentals' => 0,
            'monthly_revenue' => 0,
            'total_customers' => 0,
            'equipment_items' => 0,
            'average_rating' => 0.0
        ];
    }

    // Get recent rentals for owner
    public function getRecentRentals($owner_id, $limit = 5) {
        try {
            // For now return sample data
            return [
                [
                    'id' => 'RT001',
                    'customer' => 'Krishna Wishvajith',
                    'equipment' => 'Cricket Bat Set',
                    'shop' => 'Pro Sports Gear',
                    'date' => '2025-01-25',
                    'duration' => '3 days',
                    'amount' => 1500,
                    'status' => 'Active',
                    'return_date' => '2025-01-28'
                ],
                [
                    'id' => 'RT002',
                    'customer' => 'Kulakshi Thathsarani',
                    'equipment' => 'Football Kit',
                    'shop' => 'Football Gear Hub',
                    'date' => '2025-01-26',
                    'duration' => '1 day',
                    'amount' => 800,
                    'status' => 'Returned',
                    'return_date' => '2025-01-27'
                ]
            ];
        } catch (Exception $e) {
            error_log('Error in getRecentRentals: ' . $e->getMessage());
            return [];
        }
    }

    // Get upcoming rental schedules
    public function getUpcomingSchedules($owner_id) {
        try {
            return [
                [
                    'equipment' => 'Tennis Racket Set',
                    'customer' => 'Dinesh Sulakshana',
                    'date' => '27',
                    'month' => 'JAN',
                    'time' => 'Pickup: 10:00 AM',
                    'status' => 'Confirmed',
                    'shop' => 'Tennis Pro Rentals'
                ],
                [
                    'equipment' => 'Basketball Kit',
                    'customer' => 'Kalana Ekanayake',
                    'date' => '28',
                    'month' => 'JAN', 
                    'time' => 'Return: 5:00 PM',
                    'status' => 'Return Due',
                    'shop' => 'Basketball Gear Store'
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
                'this_month' => 25000,
                'last_month' => 22000,
                'growth_percentage' => 13.6,
                'pending_payments' => 3500,
                'next_payout_date' => '2025-02-01'
            ];
        } catch (Exception $e) {
            error_log('Error in getRevenueOverview: ' . $e->getMessage());
            return [];
        }
    }

    // Get shop summary
    public function getShopSummary($owner_id) {
        try {
            return [
                'total_shops' => 4,
                'active_shops' => 4,
                'total_equipment' => 85,
                'package_type' => 'Standard',
                'shops_limit' => 6,
                'can_add_more' => true
            ];
        } catch (Exception $e) {
            error_log('Error in getShopSummary: ' . $e->getMessage());
            return [];
        }
    }

    // Get package information
    public function getPackageInfo($owner_id) {
        try {
            return [
                'package_name' => 'Standard',
                'commission_rate' => 12,
                'shops_limit' => 6,
                'equipment_limit' => 100,
                'photos_limit' => 5,
                'support_type' => 'Email & Phone Support'
            ];
        } catch (Exception $e) {
            error_log('Error in getPackageInfo: ' . $e->getMessage());
            return [];
        }
    }

    // Get all shops for owner
    public function getAllShops($owner_id) {
        try {
            // Return sample shop data that matches your existing view structure
            return [
                (object)[
                    'id' => 1,
                    'shop_name' => 'Pro Sports Gear Rentals',
                    'address' => '123 Galle Road, Colombo 03',
                    'description' => 'Complete sports equipment rental service with premium quality gear for all sports including cricket, football, and tennis.',
                    'daily_rate' => 1500,
                    'contact_email' => 'rentals@prosportsgear.lk',
                    'contact_phone' => '+94 71 234 5678',
                    'operating_hours' => 'Mon-Sun: 8:00 AM - 8:00 PM',
                    'image' => 'equ1.jpg',
                    'status' => 'active',
                    'equipment_count' => 85,
                    'rentals_count' => 120,
                    'category' => 'Multi-Sport',
                    'equipment_types' => ['Cricket', 'Football', 'Tennis', 'Basketball'],
                    'features' => ['Home Delivery', 'Quality Guarantee', 'Online Booking']
                ],
                (object)[
                    'id' => 2,
                    'shop_name' => 'Cricket Zone Equipment',
                    'address' => '456 Duplication Road, Colombo 07',
                    'description' => 'Specialized cricket equipment rental with professional grade gear including bats, pads, gloves, and protective equipment.',
                    'daily_rate' => 800,
                    'contact_email' => 'info@cricketzone.lk',
                    'contact_phone' => '+94 77 345 6789',
                    'operating_hours' => 'Mon-Sat: 9:00 AM - 7:00 PM',
                    'image' => 'equ1.jpg',
                    'status' => 'active',
                    'equipment_count' => 45,
                    'rentals_count' => 65,
                    'category' => 'Cricket',
                    'equipment_types' => ['Cricket'],
                    'features' => ['Expert Advice', 'Equipment Maintenance', 'Bulk Discounts']
                ],
                (object)[
                    'id' => 3,
                    'shop_name' => 'Football Gear Hub',
                    'address' => '789 Galle Road, Dehiwala',
                    'description' => 'Premium football equipment rental for players and teams including balls, shoes, goalkeeper gear, and training equipment.',
                    'daily_rate' => 1200,
                    'contact_email' => 'hello@footballgearhub.lk',
                    'contact_phone' => '+94 70 456 7890',
                    'operating_hours' => 'Mon-Sun: 7:00 AM - 9:00 PM',
                    'image' => 'equ1.jpg',
                    'status' => 'active',
                    'equipment_count' => 60,
                    'rentals_count' => 95,
                    'category' => 'Football',
                    'equipment_types' => ['Football'],
                    'features' => ['Team Packages', 'Goalkeeper Gear', 'Size Fitting']
                ],
                (object)[
                    'id' => 4,
                    'shop_name' => 'Tennis Pro Rentals',
                    'address' => '321 Hotel Road, Mount Lavinia',
                    'description' => 'High-quality tennis equipment rental with expert guidance including rackets, balls, nets, and court equipment.',
                    'daily_rate' => 1000,
                    'contact_email' => 'rentals@tennispro.lk',
                    'contact_phone' => '+94 76 567 8901',
                    'operating_hours' => 'Tue-Sun: 8:00 AM - 6:00 PM',
                    'image' => 'equ1.jpg',
                    'status' => 'active',
                    'equipment_count' => 35,
                    'rentals_count' => 78,
                    'category' => 'Tennis',
                    'equipment_types' => ['Tennis'],
                    'features' => ['Racket Stringing', 'Professional Advice', 'Tournament Gear']
                ]
            ];
        } catch (Exception $e) {
            error_log('Error in getAllShops: ' . $e->getMessage());
            return [];
        }
    }

    // Add new shop
    public function addShop($owner_id, $shopData) {
        try {
            if (!$this->db) {
                return false;
            }

            // In real implementation, insert into database
            // For now, just return true
            return true;
        } catch (Exception $e) {
            error_log('Error in addShop: ' . $e->getMessage());
            return false;
        }
    }

    // Update shop
    public function updateShop($owner_id, $shop_id, $shopData) {
        try {
            if (!$this->db) {
                return false;
            }

            // In real implementation, update database
            return true;
        } catch (Exception $e) {
            error_log('Error in updateShop: ' . $e->getMessage());
            return false;
        }
    }

    // Get single shop
    public function getShop($owner_id, $shop_id) {
        try {
            // Return sample shop data for editing
            $sampleShops = [
                1 => (object)[
                    'id' => 1,
                    'shop_name' => 'Pro Sports Gear Rentals',
                    'address' => '123 Galle Road, Colombo 03',
                    'description' => 'Complete sports equipment rental service with premium quality gear for all sports including cricket, football, and tennis.',
                    'equipment_count' => 85,
                    'daily_rate' => 1500,
                    'contact_email' => 'rentals@prosportsgear.lk',
                    'contact_phone' => '+94 71 234 5678',
                    'operating_hours' => 'Mon-Sun: 8:00 AM - 8:00 PM',
                    'category' => 'Multi-Sport'
                ],
                2 => (object)[
                    'id' => 2,
                    'shop_name' => 'Cricket Zone Equipment',
                    'address' => '456 Duplication Road, Colombo 07',
                    'description' => 'Specialized cricket equipment rental with professional grade gear including bats, pads, gloves, and protective equipment.',
                    'equipment_count' => 45,
                    'daily_rate' => 800,
                    'contact_email' => 'info@cricketzone.lk',
                    'contact_phone' => '+94 77 345 6789',
                    'operating_hours' => 'Mon-Sat: 9:00 AM - 7:00 PM',
                    'category' => 'Cricket'
                ],
                3 => (object)[
                    'id' => 3,
                    'shop_name' => 'Football Gear Hub',
                    'address' => '789 Galle Road, Dehiwala',
                    'description' => 'Premium football equipment rental for players and teams including balls, shoes, goalkeeper gear, and training equipment.',
                    'equipment_count' => 60,
                    'daily_rate' => 1200,
                    'contact_email' => 'hello@footballgearhub.lk',
                    'contact_phone' => '+94 70 456 7890',
                    'operating_hours' => 'Mon-Sun: 7:00 AM - 9:00 PM',
                    'category' => 'Football'
                ],
                4 => (object)[
                    'id' => 4,
                    'shop_name' => 'Tennis Pro Rentals',
                    'address' => '321 Hotel Road, Mount Lavinia',
                    'description' => 'High-quality tennis equipment rental with expert guidance including rackets, balls, nets, and court equipment.',
                    'equipment_count' => 35,
                    'daily_rate' => 1000,
                    'contact_email' => 'rentals@tennispro.lk',
                    'contact_phone' => '+94 76 567 8901',
                    'operating_hours' => 'Tue-Sun: 8:00 AM - 6:00 PM',
                    'category' => 'Tennis'
                ]
            ];

            return isset($sampleShops[$shop_id]) ? $sampleShops[$shop_id] : null;
        } catch (Exception $e) {
            error_log('Error in getShop: ' . $e->getMessage());
            return null;
        }
    }

    // Get messages for owner
    public function getMessages($owner_id) {
        try {
            return [
                [
                    'id' => 1,
                    'from' => 'Krishna Wishvajith',
                    'subject' => 'Equipment Rental Inquiry',
                    'message' => 'Hi, I would like to rent cricket equipment for tomorrow...',
                    'date' => '2025-01-20',
                    'status' => 'unread'
                ],
                [
                    'id' => 2,
                    'from' => 'Kulakshi Thathsarani',
                    'subject' => 'Equipment Return Issue',
                    'message' => 'I had an issue returning the football yesterday...',
                    'date' => '2025-01-19',
                    'status' => 'read'
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

    // Get profile data
    public function getProfileData($owner_id) {
        try {
            if (!$this->db) {
                return $this->getDefaultProfileData();
            }

            $this->db->query('SELECT u.*, rop.* FROM users u
                LEFT JOIN rental_owner_profiles rop ON u.id = rop.user_id
                WHERE u.id = :id AND u.role = "rental_owner"');
            $this->db->bind(':id', $owner_id);
            
            $profile = $this->db->single();
            
            if ($profile) {
                return [
                    'owner_name' => $profile->owner_name ?? 'Rental Owner',
                    'business_name' => $profile->business_name ?? 'Equipment Rental Service',
                    'email' => $profile->email ?? 'owner@example.com',
                    'phone' => $profile->phone ?? 'Not set',
                    'address' => $profile->address ?? 'Not set',
                    'business_type' => $profile->business_type ?? 'Not specified',
                    'equipment_categories' => $profile->equipment_categories ?? 'Not specified',
                    'delivery_service' => $profile->delivery_service ?? 'Not specified',
                    'district' => $profile->district ?? 'Not set',
                    'package_type' => 'Standard', // This would come from a separate package tracking
                    'total_shops' => 4,
                    'total_revenue' => 125000,
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
            'owner_name' => 'Rental Owner',
            'business_name' => 'Equipment Rental Service',
            'email' => 'owner@example.com',
            'phone' => 'Not set',
            'address' => 'Not set',
            'business_type' => 'Not specified',
            'equipment_categories' => 'Not specified',
            'delivery_service' => 'Not specified',
            'district' => 'Not set',
            'package_type' => 'Standard',
            'total_shops' => 0,
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

            // Update rental owner profile data
            $this->db->query('UPDATE rental_owner_profiles SET
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