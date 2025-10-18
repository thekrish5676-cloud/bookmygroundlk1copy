<?php
class M_Pricing {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getPricingPackages() {
        // Return pricing packages data
        return [
            (object)[
                'id' => 1,
                'name' => 'Basic',
                'price' => 'Free',
                'monthly_fee' => 0,
                'commission' => 8,
                'description' => 'Perfect for getting started with stadium rentals',
                'color' => 'basic',
                'icon' => '🌟',
                'popular' => false,
                'features' => [
                    'stadium_limit' => 3,
                    'photos_per_property' => 3,
                    'videos_per_property' => 3,
                    'featured_listings' => 0,
                    'support' => 'Email Support',
                    'analytics' => 'Basic Analytics',
                    'booking_management' => true,
                    'payment_processing' => true,
                    'mobile_app' => true,
                    'priority_support' => false,
                    'marketing_tools' => false,
                    'advanced_analytics' => false
                ]
            ],
            (object)[
                'id' => 2,
                'name' => 'Standard',
                'price' => 'Free',
                'monthly_fee' => 0,
                'commission' => 12,
                'description' => 'Ideal for growing stadium businesses',
                'color' => 'standard',
                'icon' => '⚡',
                'popular' => true,
                'features' => [
                    'stadium_limit' => 6,
                    'photos_per_property' => 5,
                    'videos_per_property' => 5,
                    'featured_listings' => 3,
                    'support' => 'Email & Phone Support',
                    'analytics' => 'Advanced Analytics',
                    'booking_management' => true,
                    'payment_processing' => true,
                    'mobile_app' => true,
                    'priority_support' => true,
                    'marketing_tools' => true,
                    'advanced_analytics' => true
                ]
            ],
            (object)[
                'id' => 3,
                'name' => 'Gold',
                'price' => 'Free',
                'monthly_fee' => 0,
                'commission' => 20,
                'description' => 'For established stadium owners who want maximum exposure',
                'color' => 'gold',
                'icon' => '👑',
                'popular' => false,
                'features' => [
                    'stadium_limit' => 'unlimited',
                    'photos_per_property' => 10,
                    'videos_per_property' => 5,
                    'featured_listings' => 5,
                    'support' => 'Priority Support 24/7',
                    'analytics' => 'Premium Analytics & Reports',
                    'booking_management' => true,
                    'payment_processing' => true,
                    'mobile_app' => true,
                    'priority_support' => true,
                    'marketing_tools' => true,
                    'advanced_analytics' => true,
                    'dedicated_manager' => true,
                    'api_access' => true
                ]
            ]
        ];
    }

    public function getFeatureComparison() {
        return [
            'Stadium Listings' => [
                'basic' => '3 Stadiums',
                'standard' => '6 Stadiums', 
                'gold' => 'Unlimited Stadiums'
            ],
            'Commission Rate' => [
                'basic' => '8% per booking',
                'standard' => '12% per booking',
                'gold' => '20% per booking'
            ],
            'Photos per Stadium' => [
                'basic' => '3 Photos',
                'standard' => '5 Photos',
                'gold' => '10 Photos'
            ],
            'Videos per Stadium' => [
                'basic' => '3 Videos',
                'standard' => '5 Videos',
                'gold' => '5 Videos'
            ],
            'Featured Listings' => [
                'basic' => 'None',
                'standard' => '3 Featured',
                'gold' => '5 Featured'
            ],
            'Support' => [
                'basic' => 'Email Only',
                'standard' => 'Email & Phone',
                'gold' => '24/7 Priority Support'
            ],
            'Analytics' => [
                'basic' => 'Basic Reports',
                'standard' => 'Advanced Analytics',
                'gold' => 'Premium Analytics'
            ]
        ];
    }

    public function getPackageById($id) {
        $packages = $this->getPricingPackages();
        
        foreach($packages as $package) {
            if($package->id == $id) {
                return $package;
            }
        }
        
        return false;
    }
}