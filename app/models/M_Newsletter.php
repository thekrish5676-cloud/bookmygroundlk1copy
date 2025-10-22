<?php

class M_Newsletter {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Get total subscribers count
    public function getTotalSubscribers() {
        // Return sample data for now
        return 1247;
    }

    // Get active subscribers count
    public function getActiveSubscribers() {
        // Return sample data for now
        return 1195;
    }

    // Get newsletters sent this month
    public function getNewslettersSent() {
        // Return sample data for now
        return 8;
    }

    // Get recent newsletters
    public function getRecentNewsletters($limit = 5) {
        // Return sample data for now
        return [
            [
                'id' => 1,
                'subject' => 'New Stadium Openings This Month',
                'recipients' => 1195,
                'open_rate' => 34.2,
                'click_rate' => 8.5,
                'sent_date' => '2025-01-20',
                'status' => 'Sent'
            ],
            [
                'id' => 2,
                'subject' => 'Equipment Rental Special Offers',
                'recipients' => 1180,
                'open_rate' => 28.7,
                'click_rate' => 6.2,
                'sent_date' => '2025-01-15',
                'status' => 'Sent'
            ],
            [
                'id' => 3,
                'subject' => 'Coaching Sessions Available',
                'recipients' => 1165,
                'open_rate' => 31.5,
                'click_rate' => 9.1,
                'sent_date' => '2025-01-10',
                'status' => 'Sent'
            ]
        ];
    }

    // Get subscriber growth data
    public function getSubscriberGrowth() {
        // Return sample data for now
        return [
            'this_month' => 52,
            'last_month' => 38,
            'growth_percentage' => 36.8
        ];
    }

    // Get top content categories
    public function getTopCategories() {
        // Return sample data for now
        return [
            ['name' => 'Stadium Updates', 'percentage' => 35],
            ['name' => 'Equipment News', 'percentage' => 28],
            ['name' => 'Coaching Tips', 'percentage' => 22],
            ['name' => 'Special Offers', 'percentage' => 15]
        ];
    }

    // Get all subscribers
    public function getAllSubscribers() {
        // Return sample data for now
        return [
            [
                'id' => 1,
                'email' => 'krishna@example.com',
                'name' => 'Krishna Wishvajith',
                'status' => 'Active',
                'subscribed_date' => '2024-12-15',
                'interests' => ['Stadiums', 'Cricket'],
                'engagement_score' => 85
            ],
            [
                'id' => 2,
                'email' => 'kulakshi@example.com',
                'name' => 'Kulakshi Thathsarani',
                'status' => 'Active',
                'subscribed_date' => '2024-12-20',
                'interests' => ['Equipment', 'Tennis'],
                'engagement_score' => 72
            ],
            [
                'id' => 3,
                'email' => 'dinesh@example.com',
                'name' => 'Dinesh Sulakshana',
                'status' => 'Inactive',
                'subscribed_date' => '2024-11-10',
                'interests' => ['Coaching', 'Football'],
                'engagement_score' => 23
            ]
        ];
    }

    // Get subscriber statistics
    public function getSubscriberStats() {
        return [
            'total' => 1247,
            'active' => 1195,
            'inactive' => 52,
            'this_month_new' => 52,
            'unsubscribed_this_month' => 8
        ];
    }

    // Get email templates
    public function getEmailTemplates() {
        return [
            ['id' => 1, 'name' => 'Default Newsletter', 'description' => 'Standard newsletter layout'],
            ['id' => 2, 'name' => 'Stadium Focus', 'description' => 'Template focused on stadium listings'],
            ['id' => 3, 'name' => 'Equipment Promotions', 'description' => 'Template for equipment deals'],
            ['id' => 4, 'name' => 'Event Announcement', 'description' => 'Template for special events']
        ];
    }

    // Get subscriber segments
    public function getSubscriberSegments() {
        return [
            'all' => 'All Subscribers (1,247)',
            'customers' => 'Customers Only (856)',
            'stadium_owners' => 'Stadium Owners (145)',
            'coaches' => 'Coaches (128)',
            'rental_owners' => 'Rental Owners (118)',
            'active_users' => 'Active Users (1,195)',
            'new_subscribers' => 'New Subscribers (52)'
        ];
    }

    // Create newsletter
    public function createNewsletter($data) {
        // In a real implementation, this would save to database
        // For demo, return true
        return true;
    }

    // Send newsletter
    public function sendNewsletter($data) {
        // In a real implementation, this would send emails
        // For demo, return true
        return true;
    }

    // Get all templates
    public function getAllTemplates() {
        return [
            [
                'id' => 1,
                'name' => 'Default Newsletter',
                'description' => 'Standard newsletter layout with header and footer',
                'preview_image' => 'template-default.jpg',
                'usage_count' => 15,
                'created_date' => '2024-12-01',
                'status' => 'Active'
            ],
            [
                'id' => 2,
                'name' => 'Stadium Focus',
                'description' => 'Template optimized for stadium listings and updates',
                'preview_image' => 'template-stadium.jpg',
                'usage_count' => 8,
                'created_date' => '2024-12-10',
                'status' => 'Active'
            ],
            [
                'id' => 3,
                'name' => 'Equipment Promotions',
                'description' => 'Perfect for equipment deals and rental offers',
                'preview_image' => 'template-equipment.jpg',
                'usage_count' => 12,
                'created_date' => '2024-12-15',
                'status' => 'Active'
            ]
        ];
    }

    // Get campaign statistics
    public function getCampaignStats() {
        return [
            'total_campaigns' => 24,
            'total_emails_sent' => 28650,
            'average_open_rate' => 31.2,
            'average_click_rate' => 7.8,
            'bounce_rate' => 2.1,
            'unsubscribe_rate' => 0.8
        ];
    }

    // Get engagement metrics
    public function getEngagementMetrics() {
        return [
            'most_opened' => 'New Stadium Openings This Month',
            'most_clicked' => 'Equipment Rental Special Offers',
            'best_day' => 'Tuesday',
            'best_time' => '10:00 AM',
            'engagement_trend' => 'increasing'
        ];
    }

    // Get subscriber analytics
    public function getSubscriberAnalytics() {
        return [
            'top_interests' => [
                'Stadium Bookings' => 45,
                'Equipment Rental' => 32,
                'Coaching Services' => 28,
                'Sports Events' => 25
            ],
            'geographic_data' => [
                'Colombo' => 423,
                'Kandy' => 198,
                'Galle' => 156,
                'Negombo' => 134,
                'Other' => 336
            ]
        ];
    }
}