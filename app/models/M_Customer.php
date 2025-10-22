<?php
class M_Customer {
    private $db;

    public function __construct(){
        try {
            $this->db = new Database();
        } catch (Exception $e) {
            error_log('Database connection error in M_Customer: ' . $e->getMessage());
            // allow methods to return safe defaults
        }
    }

    // Get customer dashboard stats (placeholder until bookings/payments/reviews exist)
    public function getCustomerStats($user_id) {
        try {
            if (!$this->db) {
                return [
                    'active_bookings' => 0,
                    'stadiums_visited' => 0,
                    'total_spent' => 0,
                    'rating_given' => 0
                ];
            }

            // If bookings/payments tables are not ready yet, return demo values
            return [
                'active_bookings' => 0,
                'stadiums_visited' => 0,
                'total_spent' => 0,
                'rating_given' => 0
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

    // Get customer's recent bookings (placeholder until bookings table exists)
    public function getRecentBookings($user_id, $limit = 5) {
        try {
            return [];
        } catch (Exception $e) {
            error_log('Error in getRecentBookings: ' . $e->getMessage());
            return [];
        }
    }

    // Get all customer bookings (placeholder)
    public function getAllBookings($user_id) {
        try {
            return [];
        } catch (Exception $e) {
            error_log('Error in getAllBookings: ' . $e->getMessage());
            return [];
        }
    }

    // Get customer's favorite stadiums (can be derived later; placeholder now)
    public function getFavoriteStadiums($user_id) {
        try {
            return [];
        } catch (Exception $e) {
            error_log('Error in getFavoriteStadiums: ' . $e->getMessage());
            return [];
        }
    }

    // Get customer's payment history (placeholder)
    public function getPaymentHistory($user_id) {
        try {
            return [];
        } catch (Exception $e) {
            error_log('Error in getPaymentHistory: ' . $e->getMessage());
            return [];
        }
    }

    // Get customer's upcoming events (placeholder)
    public function getUpcomingEvents($user_id) {
        try {
            return [];
        } catch (Exception $e) {
            error_log('Error in getUpcomingEvents: ' . $e->getMessage());
            return [];
        }
    }

    // Get customer profile data (users + customer_profiles)
    public function getProfileData($user_id) {
        try {
            if (!$this->db) {
                return $this->getDefaultProfileData();
            }

            $this->db->query('SELECT u.*, cp.district, cp.sports, cp.age_group, cp.skill_level 
                FROM users u
                LEFT JOIN customer_profiles cp ON u.id = cp.user_id
                WHERE u.id = :id');
            $this->db->bind(':id', $user_id);
            
            $profile = $this->db->single();
            
            if ($profile) {
                return [
                    'first_name' => $profile->first_name ?? 'User',
                    'last_name' => $profile->last_name ?? 'Name',
                    'email' => $profile->email ?? 'user@example.com',
                    'phone' => $profile->phone ?? '',
                    'location' => $profile->district ?? '',
                    'favorite_sports' => $profile->sports ?? '',
                    'age_group' => $profile->age_group ?? '',
                    'skill_level' => $profile->skill_level ?? '',
                    'member_since' => isset($profile->created_at) ? date('F Y', strtotime($profile->created_at)) : ''
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
            'email' => '',
            'phone' => '',
            'location' => '',
            'favorite_sports' => '',
            'age_group' => '',
            'skill_level' => '',
            'member_since' => ''
        ];
    }

    // Update profile: users + upsert into customer_profiles
    public function updateProfile($user_id, $profile_data) {
        try {
            if (!$this->db) {
                return false;
            }

            // Update basic user fields
            $this->db->query('UPDATE users SET
                first_name = :first_name,
                last_name = :last_name,
                phone = :phone,
                updated_at = NOW()
                WHERE id = :id');
            $this->db->bind(':first_name', $profile_data['first_name'] ?? '');
            $this->db->bind(':last_name', $profile_data['last_name'] ?? '');
            $this->db->bind(':phone', $profile_data['phone'] ?? '');
            $this->db->bind(':id', $user_id);
            $this->db->execute();

            // Check if customer_profiles exists for user
            $this->db->query('SELECT id FROM customer_profiles WHERE user_id = :uid');
            $this->db->bind(':uid', $user_id);
            $exists = $this->db->single();

            if ($exists) {
                $this->db->query('UPDATE customer_profiles SET 
                    district = :district,
                    sports = :sports,
                    age_group = :age_group,
                    skill_level = :skill_level,
                    updated_at = NOW()
                    WHERE user_id = :uid');
            } else {
                $this->db->query('INSERT INTO customer_profiles (user_id, district, sports, age_group, skill_level, created_at)
                    VALUES (:uid, :district, :sports, :age_group, :skill_level, NOW())');
            }

            $this->db->bind(':uid', $user_id);
            $this->db->bind(':district', $profile_data['district'] ?? '');
            $this->db->bind(':sports', $profile_data['sports'] ?? '');
            $this->db->bind(':age_group', $profile_data['age_group'] ?? '');
            $this->db->bind(':skill_level', $profile_data['skill_level'] ?? '');

            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Error in updateProfile: ' . $e->getMessage());
            return false;
        }
    }

    // Emergency contacts CRUD aligned to users table
    public function createEmergencyContact($user_id, $data) {
        try {
            $this->db->query('INSERT INTO emergency_contacts (user_id, contact_name, relationship, phone, email, created_at) 
                              VALUES (:user_id, :name, :relationship, :phone, :email, NOW())');
            $this->db->bind(':user_id', $user_id);
            $this->db->bind(':name', $data['contact_name'] ?? '');
            $this->db->bind(':relationship', $data['relationship'] ?? '');
            $this->db->bind(':phone', $data['phone'] ?? '');
            $this->db->bind(':email', $data['email'] ?? null);
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Error in createEmergencyContact: ' . $e->getMessage());
            return false;
        }
    }

    public function getEmergencyContacts($user_id) {
        try {
            $this->db->query('SELECT * FROM emergency_contacts WHERE user_id = :uid ORDER BY created_at DESC');
            $this->db->bind(':uid', $user_id);
            return $this->db->resultSet();
        } catch (Exception $e) {
            error_log('Error in getEmergencyContacts: ' . $e->getMessage());
            return [];
        }
    }

    public function deleteEmergencyContact($id, $user_id) {
        try {
            $this->db->query('DELETE FROM emergency_contacts WHERE id = :id AND user_id = :uid');
            $this->db->bind(':id', $id);
            $this->db->bind(':uid', $user_id);
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Error in deleteEmergencyContact: ' . $e->getMessage());
            return false;
        }
    }

    // Backward-compatible alias
    public function getProfile($user_id) {
        return $this->getProfileData($user_id);
    }
}
