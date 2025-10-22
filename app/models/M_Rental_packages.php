<?php
class M_Rental_packages {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getPackages() {
        // Return package data - this will be from database later
        return [
            'standard' => [
                'name' => 'Sport Equipment Rental Service Owner Package',
                'price' => 12300,
                'duration' => 'Listings Valid For 3 Months',
                'listings' => 5,
                'images_per_listing' => 5,
                'color' => 'standard',
                'icon' => '⚡',
                'popular' => true,
                'features' => [
                    '5 Rental Shop Listings',
                    '5 Images per Listing',
                    'Phone + Email Contact',
                    'Amenities Display',
                    'Email & Phone Support',
                    'Priority Placement'
                ]
            ]
        ];
    }
}
?>