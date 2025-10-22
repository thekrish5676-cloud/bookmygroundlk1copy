<?php
class M_Stadium_owner
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = new Database();
        } catch (Exception $e) {
            error_log('Database connection error in M_Stadium_owner: ' . $e->getMessage());
        }
    }

    // Get stadium owner dashboard stats
    public function getOwnerStats($owner_id)
    {
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

    private function getDefaultStats()
    {
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
    public function getRecentBookings($owner_id, $limit = 5)
    {
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
    public function getUpcomingSchedules($owner_id)
    {
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
    public function getRevenueOverview($owner_id)
    {
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
    public function getPropertySummary($owner_id)
    {
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
    public function getPackageInfo($owner_id)
    {
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
    public function getAllProperties($owner_id)
    {
        try {
            if (!$this->db) {
                throw new Exception('Database connection not established');
            }

            $this->db->query("SELECT 
                s.id,
                s.name,
                s.type,
                s.category,
                s.price,
                s.location,
                s.district,
                s.description,
                s.status,
                s.image
            FROM stadiums s
            ORDER BY s.created_at DESC");

            $results = $this->db->resultSet();

            // Convert objects to arrays
            $properties = [];
            foreach ($results as $row) {
                $properties[] = [
                    'id' => $row->id,
                    'name' => $row->name,
                    'type' => $row->type,
                    'category' => $row->category,
                    'price' => $row->price,
                    'location' => $row->location,
                    'district' => $row->district,
                    'description' => $row->description,
                    'status' => $row->status,
                    'image' => $row->image,
                    'rating' => 0, // Default value
                    'total_bookings' => 0, // Default value
                    'monthly_revenue' => 0 // Default value
                ];
            }

            return $properties;
        } catch (Exception $e) {
            error_log('Error in getAllProperties: ' . $e->getMessage());
            return [];
        }
    }

    // Get package limits
    public function getPackageLimits($owner_id)
    {
        try {
            if (!$this->db) {
                throw new Exception('Database connection not established');
            }

            // Get current property count
            $this->db->query('SELECT COUNT(*) as count FROM stadiums WHERE owner = :owner_id');
            $this->db->bind(':owner_id', $owner_id);
            $propertyCount = $this->db->single();
            $currentProperties = $propertyCount ? $propertyCount->count : 0;

            // Get package info
            $this->db->query('SELECT p.* 
                FROM packages p 
                JOIN user_packages up ON p.id = up.package_id 
                WHERE up.user_id = :owner_id 
                AND up.status = "active" 
                AND up.expiry_date > CURRENT_DATE()
                ORDER BY up.created_at DESC 
                LIMIT 1');
            $this->db->bind(':owner_id', $owner_id);
            $package = $this->db->single();

            // Convert to array format
            return [
                'properties_limit' => $package ? $package->property_limit : 1,
                'current_properties' => $currentProperties,
                'photos_limit' => $package ? $package->photo_limit : 3,
                'videos_limit' => $package ? $package->video_limit : 1,
                'featured_listings' => $package ? $package->featured_limit : 0,
                'can_add_property' => $currentProperties < ($package ? $package->property_limit : 1)
            ];
        } catch (Exception $e) {
            error_log('Error in getPackageLimits: ' . $e->getMessage());
            // Return default limits on error
            return [
                'properties_limit' => 1,
                'current_properties' => 0,
                'photos_limit' => 3,
                'videos_limit' => 1,
                'featured_listings' => 0,
                'can_add_property' => true
            ];
        }
    }

    // Get all bookings for owner
    public function getAllBookings($owner_id)
    {
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
    public function getBookingStats($owner_id)
    {
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
    public function getMessages($owner_id)
    {
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
    public function getUnreadMessageCount($owner_id)
    {
        try {
            return 3; // Sample count
        } catch (Exception $e) {
            error_log('Error in getUnreadMessageCount: ' . $e->getMessage());
            return 0;
        }
    }

    // Send reply to message
    public function sendReply($owner_id, $messageData)
    {
        try {
            // In real implementation, save reply to database
            return true;
        } catch (Exception $e) {
            error_log('Error in sendReply: ' . $e->getMessage());
            return false;
        }
    }

    // Get revenue data
    public function getRevenueData($owner_id)
    {
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
    public function getAnalytics($owner_id)
    {
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
    public function addProperty($owner_id, $data)
    {
        try {
            if (!$this->db) {
                throw new Exception("Database connection not available");
            }

            // Prepare the query using Database class method
            $this->db->query("INSERT INTO stadiums 
                     (name, type, category, price, location, owner, 
                      district, postal_code, description, opening_hours, 
                      advance_booking, minimum_duration, cancellation_policy,
                      contact_person, contact_phone, contact_email, 
                      whatsapp_number, special_instructions, status)
                     VALUES 
                     (:name, :type, :category, :price, :location, :owner,
                      :district, :postal_code, :description, :opening_hours,
                      :advance_booking, :minimum_duration, :cancellation_policy,
                      :contact_person, :contact_phone, :contact_email,
                      :whatsapp_number, :special_instructions, 'Available')");

            // Bind all parameters using Database class bind method
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':type', $data['type']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':price', $data['price']);
            $this->db->bind(':location', $data['location']);
            $this->db->bind(':owner', $owner_id);
            $this->db->bind(':district', $data['district']);
            $this->db->bind(':postal_code', $data['postal_code']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':opening_hours', $data['opening_hours']);
            $this->db->bind(':advance_booking', $data['advance_booking']);
            $this->db->bind(':minimum_duration', $data['minimum_duration']);
            $this->db->bind(':cancellation_policy', $data['cancellation_policy']);
            $this->db->bind(':contact_person', $data['contact_person']);
            $this->db->bind(':contact_phone', $data['contact_phone']);
            $this->db->bind(':contact_email', $data['contact_email']);
            $this->db->bind(':whatsapp_number', $data['whatsapp_number']);
            $this->db->bind(':special_instructions', $data['special_instructions']);

            // Execute the query
            if ($this->db->execute()) {
                $stadium_id = $this->db->lastInsertId();

                // Add features if provided
                if (!empty($data['features']) && is_array($data['features'])) {
                    $this->addFeatures($stadium_id, $data['features']);
                }

                return array(
                    'success' => true,
                    'stadium_id' => $stadium_id,
                    'message' => 'Stadium added successfully'
                );
            } else {
                throw new Exception("Failed to insert stadium data");
            }
        } catch (Exception $e) {
            return array(
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Failed to add stadium'
            );
        }
    }


    // Update property
    public function updateProperty($owner_id, $property_id, $data)
    {
        try {
            if (!$this->db) {
                throw new Exception("Database connection not available");
            }

            // First verify that this stadium belongs to this owner
            $this->db->query("SELECT id FROM stadiums WHERE id = :id AND owner = :owner_id");
            $this->db->bind(':id', $property_id);
            $this->db->bind(':owner_id', $owner_id);

            if (!$this->db->single()) {
                throw new Exception("Stadium not found or unauthorized");
            }

            // Update the stadium information
            $this->db->query("UPDATE stadiums SET 
                      name = :name,
                      type = :type,
                      category = :category,
                      price = :price,
                      location = :location,
                      district = :district,
                      postal_code = :postal_code,
                      description = :description,
                      opening_hours = :opening_hours,
                      advance_booking = :advance_booking,
                      minimum_duration = :minimum_duration,
                      cancellation_policy = :cancellation_policy,
                      contact_person = :contact_person,
                      contact_phone = :contact_phone,
                      contact_email = :contact_email,
                      whatsapp_number = :whatsapp_number,
                      special_instructions = :special_instructions,
                      status = :status
                      WHERE id = :id");

            // Bind all parameters
            $this->db->bind(':id', $property_id);
            // $this->db->bind(':owner_id', $owner_id);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':type', $data['type']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':price', $data['price']);
            $this->db->bind(':location', $data['location']);
            $this->db->bind(':district', $data['district']);
            $this->db->bind(':postal_code', $data['postal_code']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':opening_hours', $data['opening_hours']);
            $this->db->bind(':advance_booking', $data['advance_booking']);
            $this->db->bind(':minimum_duration', $data['minimum_duration']);
            $this->db->bind(':cancellation_policy', $data['cancellation_policy']);
            $this->db->bind(':contact_person', $data['contact_person']);
            $this->db->bind(':contact_phone', $data['contact_phone']);
            $this->db->bind(':contact_email', $data['contact_email']);
            $this->db->bind(':whatsapp_number', $data['whatsapp_number']);
            $this->db->bind(':special_instructions', $data['special_instructions']);
            $this->db->bind(':status', $data['status']);

            if ($this->db->execute()) {
                // Update features if provided
                if (isset($data['features']) && is_array($data['features'])) {
                    // First delete existing features
                    $this->db->query("DELETE FROM stadium_features WHERE stadium_id = :stadium_id");
                    $this->db->bind(':stadium_id', $property_id);
                    $this->db->execute();

                    // Then add new features
                    $this->addFeatures($property_id, $data['features']);
                    echo "features updated<br>";
                }

                return array(
                    'success' => true,
                    'message' => 'Stadium updated successfully'
                );
            } else {
                throw new Exception("Failed to update stadium data");
            }
        } catch (Exception $e) {
            return array(
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Failed to update stadium'
            );
        }
    }

    // Get single property
    public function getProperty($owner_id, $property_id)
    {
        try {
            if (!$this->db) {
                throw new Exception('Database connection not established');
            }

            // First verify that this stadium belongs to this owner
            $this->db->query("SELECT 
                s.*,
                COALESCE((SELECT COUNT(*) FROM bookings b WHERE b.stadium_id = s.id), 0) as total_bookings,
                COALESCE((SELECT SUM(amount) FROM bookings b WHERE b.stadium_id = s.id AND MONTH(booking_date) = MONTH(CURRENT_DATE())), 0) as monthly_revenue,
                COALESCE((SELECT AVG(rating) FROM reviews r WHERE r.stadium_id = s.id), 0) as rating
            FROM stadiums s 
            WHERE s.id = :id");

            $this->db->bind(':id', $property_id);
            $this->db->bind(':owner_id', $owner_id);

            $property = $this->db->single();

            if (!$property) {
                throw new Exception('Property not found or unauthorized access');
            }

            // Get features for this stadium
            $this->db->query("SELECT feature_name FROM stadium_features WHERE stadium_id = :stadium_id");
            $this->db->bind(':stadium_id', $property_id);
            $features = $this->db->resultSet();

            // Get images for this stadium
            $this->db->query("SELECT image_path FROM stadium_images WHERE stadium_id = :stadium_id");
            $this->db->bind(':stadium_id', $property_id);
            $images = $this->db->resultSet();

            // Convert to array format
            return [
                'id' => $property->id,
                'name' => $property->name,
                'type' => $property->type,
                'category' => $property->category,
                'price' => $property->price,
                'location' => $property->location,
                'district' => $property->district,
                'postal_code' => $property->postal_code,
                'description' => $property->description,
                'opening_hours' => $property->opening_hours,
                'advance_booking' => $property->advance_booking,
                'minimum_duration' => $property->minimum_duration,
                'cancellation_policy' => $property->cancellation_policy,
                'contact_person' => $property->contact_person,
                'contact_phone' => $property->contact_phone,
                'contact_email' => $property->contact_email,
                'whatsapp_number' => $property->whatsapp_number,
                'special_instructions' => $property->special_instructions,
                'status' => $property->status,
                'total_bookings' => $property->total_bookings,
                'monthly_revenue' => $property->monthly_revenue,
                'rating' => number_format($property->rating, 1),
                'features' => array_map(function($f) { return $f->feature_name; }, $features),
                'images' => array_map(function($i) { return $i->image_path; }, $images),
                'created_at' => $property->created_at,
                'updated_at' => $property->updated_at
            ];
        } catch (Exception $e) {
            error_log('Error in getProperty: ' . $e->getMessage());
            error_log('Stack trace: ' . $e->getTraceAsString());
            error_log('Property ID: ' . $property_id . ', Owner ID: ' . $owner_id);
            return [];
        }
    }

    // Get profile data
    public function getProfileData($owner_id)
    {
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

    private function getDefaultProfileData()
    {
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
    public function updateProfile($owner_id, $profileData)
    {
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

    private function addFeatures($stadium_id, $features)
    {
        try {
            foreach ($features as $feature) {
                $this->db->query("INSERT INTO stadium_features (stadium_id, feature_name) VALUES (:stadium_id, :feature_name)");
                $this->db->bind(':stadium_id', $stadium_id);
                $this->db->bind(':feature_name', $feature);
                $this->db->execute();
            }
            return true;
        } catch (Exception $e) {
            throw new Exception('Failed to add stadium features');
        }
    }

    // Delete property
    // public function deleteProperty($owner_id, $property_id) 
    // {
    //     try {
    //         if (!$this->db) {
    //             throw new Exception("Database connection not available");
    //         }

    //         // First verify that this stadium belongs to this owner
    //         $this->db->query("SELECT id FROM stadiums WHERE id = :id ");
    //         $this->db->bind(':id', $property_id);
    //         $this->db->bind(':owner_id', $owner_id);
            
    //         if (!$this->db->single()) {
    //             throw new Exception("Stadium not found or unauthorized");
    //         }

    //         // Delete related records first (foreign key constraints)
    //         // Delete features
    //         $this->db->query("DELETE FROM stadium_features WHERE stadium_id = :stadium_id");
    //         $this->db->bind(':stadium_id', $property_id);
    //         $this->db->execute();

    //         // Delete images
    //         $this->db->query("DELETE FROM stadium_images WHERE stadium_id = :stadium_id");
    //         $this->db->bind(':stadium_id', $property_id);
    //         $this->db->execute();

    //         // Finally delete the stadium
    //         $this->db->query("DELETE FROM stadiums WHERE id = :id ");
    //         $this->db->bind(':id', $property_id);
    //         $this->db->bind(':owner_id', $owner_id);

    //         if ($this->db->execute()) {
    //             return array(
    //                 'success' => true,
    //                 'message' => 'Stadium deleted successfully'
    //             );
    //         } else {
    //             throw new Exception("Failed to delete stadium");
    //         }

    //     } catch (Exception $e) {
    //         error_log('Error in deleteProperty: ' . $e->getMessage());
    //         error_log('Stack trace: ' . $e->getTraceAsString());
    //         return array(
    //             'success' => false,
    //             'error' => $e->getMessage(),
    //             'message' => 'Failed to delete stadium'
    //         );
    //     }
    // }
}
