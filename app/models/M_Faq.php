<?php
class M_Faq {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Get all FAQs organized by category
    public function getAllFAQsByCategory() {
        // For demo purposes, returning sample data that matches your FAQ view
        // In production, this would fetch from database
        return [
            'general' => [
                [
                    'id' => 1,
                    'question' => 'What is BookMyGround.com?',
                    'answer' => 'BookMyGround.com is a dedicated sports booking platform that allows you to book stadiums and grounds online. We also list advertisements for rental services and coaches, making it easier for you to find the support you need for your sports activities.',
                    'category' => 'general',
                    'status' => 'published'
                ],
                [
                    'id' => 2,
                    'question' => 'How do I get started on BookMyGround?',
                    'answer' => 'Getting started is easy! Just create an account under your user role (customer, stadium owner, rental service provider, or coach). Once registered, you can immediately browse available stadiums, equipment, and coaching services—and book your first session within minutes.',
                    'category' => 'general',
                    'status' => 'published'
                ],
                [
                    'id' => 3,
                    'question' => 'Is BookMyGround available in my city?',
                    'answer' => 'We\'re rapidly expanding across Sri Lanka! Currently, our services are available in major cities, including the Colombo area. Visit our locations page for the most up-to-date coverage.',
                    'category' => 'general',
                    'status' => 'published'
                ],
                [
                    'id' => 4,
                    'question' => 'What sports do you support?',
                    'answer' => 'We support a wide range of sports, including football, cricket, badminton, and many more. Our platform caters to both individual players and teams looking for facilities and services.',
                    'category' => 'general',
                    'status' => 'published'
                ]
            ],
            'booking' => [
                [
                    'id' => 5,
                    'question' => 'How far in advance can I book a stadium?',
                    'answer' => 'You can book stadiums up to 28 days in advance. This helps with proper planning while keeping availability fair for all users. For popular venues, we recommend booking at least 2–3 weeks early.',
                    'category' => 'booking',
                    'status' => 'published'
                ],
                [
                    'id' => 6,
                    'question' => 'Can I cancel or modify my booking?',
                    'answer' => 'Yes! You can cancel your booking up to 12 hours before the scheduled time.',
                    'category' => 'booking',
                    'status' => 'published'
                ],
                [
                    'id' => 7,
                    'question' => 'Do I need to make a payment to confirm my booking?',
                    'answer' => 'Yes, all bookings must be confirmed with an online payment. This ensures your slot is reserved and prevents double-booking. Payment details and receipts will be provided immediately after your booking.',
                    'category' => 'booking',
                    'status' => 'published'
                ],
                [
                    'id' => 8,
                    'question' => 'Can I book for a group or team?',
                    'answer' => 'Absolutely! We support both individual and group bookings. You can book for teams, organize tournaments, or reserve multiple time slots. For large group bookings or special arrangements, please contact our support team.',
                    'category' => 'booking',
                    'status' => 'published'
                ]
            ],
            'payment' => [
                [
                    'id' => 9,
                    'question' => 'What payment methods do you accept?',
                    'answer' => 'We currently accept credit and debit card payments. We plan to add more payment options in the future.',
                    'category' => 'payment',
                    'status' => 'published'
                ],
                [
                    'id' => 10,
                    'question' => 'When do I get charged for my booking?',
                    'answer' => 'Payments are processed immediately upon booking confirmation.',
                    'category' => 'payment',
                    'status' => 'published'
                ],
                [
                    'id' => 11,
                    'question' => 'Do you offer refunds?',
                    'answer' => 'Yes. We offer full refunds (excluding handling fees) for cancellations made at least 12 hours before the scheduled booking time. Cancellations made within 12 hours of the booking will not be eligible for a refund.',
                    'category' => 'payment',
                    'status' => 'published'
                ]
            ],
            'equipment' => [
                [
                    'id' => 12,
                    'question' => 'What equipment can I rent?',
                    'answer' => 'We provide access to a wide range of sports equipment, including balls, rackets, protective gear, training equipment, and more. Availability may vary depending on the rental service provider. You can check what\'s available at your selected provider through our platform.',
                    'category' => 'equipment',
                    'status' => 'published'
                ],
                [
                    'id' => 13,
                    'question' => 'How much does equipment rental cost?',
                    'answer' => 'Rental prices depend on the type of equipment and the duration of use. Basic items like balls and rackets typically start at LKR 50–100 per session. However, the final prices are determined by each rental service provider. Please note that we do not handle rental bookings directly — we only publish their advertisements. You can contact the provider via our website to confirm rates and arrange rentals.',
                    'category' => 'equipment',
                    'status' => 'published'
                ]
            ],
            'coaching' => [
                [
                    'id' => 14,
                    'question' => 'How do I find a coach?',
                    'answer' => 'Browse our coaching section to find certified coaches in your area. You can filter by sport, location, experience level, and price. Each coach has a detailed profile with qualifications, experience, and student reviews.',
                    'category' => 'coaching',
                    'status' => 'published'
                ],
                [
                    'id' => 15,
                    'question' => 'What are the coaching rates?',
                    'answer' => 'Coaching rates vary depending on the coach\'s experience, the sport, and the session duration. Individual sessions typically range from LKR 500–2000 per hour. Many coaches also offer group sessions and package deals at discounted rates. Please note that we do not provide direct booking services for coaching — we only publish their advertisements. You can contact the coaches directly via our platform for detailed pricing and arrangements.',
                    'category' => 'coaching',
                    'status' => 'published'
                ]
            ],
            'account' => [
                [
                    'id' => 16,
                    'question' => 'How do I update my profile information?',
                    'answer' => 'Go to your dashboard and click on the Profile section. You can update your personal information, contact details, preferences, and profile picture.',
                    'category' => 'account',
                    'status' => 'published'
                ],
                [
                    'id' => 17,
                    'question' => 'Can I have multiple accounts?',
                    'answer' => 'We recommend using one account per person for better tracking and management. However, if you need separate accounts for business purposes, please contact our support team for assistance.',
                    'category' => 'account',
                    'status' => 'published'
                ]
            ]
        ];
    }

    // Get FAQs by specific category
    public function getFAQsByCategory($category) {
        $allFAQs = $this->getAllFAQsByCategory();
        
        return isset($allFAQs[$category]) ? $allFAQs[$category] : [];
    }

    // Search FAQs by keyword
    public function searchFAQs($searchTerm) {
        $allFAQs = $this->getAllFAQsByCategory();
        $results = [];
        
        $searchTerm = strtolower($searchTerm);
        
        foreach ($allFAQs as $category => $faqs) {
            foreach ($faqs as $faq) {
                if (strpos(strtolower($faq['question']), $searchTerm) !== false || 
                    strpos(strtolower($faq['answer']), $searchTerm) !== false) {
                    $results[] = $faq;
                }
            }
        }
        
        return $results;
    }

    // Get total number of FAQs
    public function getTotalFAQs() {
        $allFAQs = $this->getAllFAQsByCategory();
        $total = 0;
        
        foreach ($allFAQs as $category => $faqs) {
            $total += count($faqs);
        }
        
        return $total;
    }

    // Get all categories with question counts
    public function getCategories() {
        return [
            'general' => [
                'name' => 'General Questions',
                'description' => 'Basic information about our platform',
                'icon' => '❓',
                'count' => 4
            ],
            'booking' => [
                'name' => 'Booking & Reservations',
                'description' => 'How to book stadiums and manage reservations',
                'icon' => '📅',
                'count' => 4
            ],
            'payment' => [
                'name' => 'Payment & Billing',
                'description' => 'Payment methods and billing information',
                'icon' => '💳',
                'count' => 3
            ],
            'equipment' => [
                'name' => 'Equipment Rental',
                'description' => 'Renting sports equipment and gear',
                'icon' => '⚽',
                'count' => 2
            ],
            'coaching' => [
                'name' => 'Coaching Services',
                'description' => 'Professional coaching and training',
                'icon' => '👨‍🏫',
                'count' => 2
            ],
            'account' => [
                'name' => 'Account & Profile',
                'description' => 'Managing your account and profile',
                'icon' => '👤',
                'count' => 2
            ]
        ];
    }

    // Get single FAQ by ID
    public function getFAQById($id) {
        $allFAQs = $this->getAllFAQsByCategory();
        
        foreach ($allFAQs as $category => $faqs) {
            foreach ($faqs as $faq) {
                if ($faq['id'] == $id) {
                    return $faq;
                }
            }
        }
        
        return false;
    }

    // Get most popular FAQs (for demo, just return first few)
    public function getPopularFAQs($limit = 5) {
        $allFAQs = $this->getAllFAQsByCategory();
        $popular = [];
        
        foreach ($allFAQs as $category => $faqs) {
            foreach ($faqs as $faq) {
                $popular[] = $faq;
                if (count($popular) >= $limit) {
                    break 2;
                }
            }
        }
        
        return $popular;
    }

    // For admin/database functionality (when you implement actual database)
    public function addFAQ($question, $answer, $category) {
        // This would add FAQ to database
        // For now, return true for demo
        return true;
    }

    public function updateFAQ($id, $question, $answer, $category) {
        // This would update FAQ in database
        // For now, return true for demo
        return true;
    }

    public function deleteFAQ($id) {
        // This would delete FAQ from database
        // For now, return true for demo
        return true;
    }
}
?>