<?php
class M_Contact {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Save contact form submission
    public function saveContactMessage($data) {
        try {
            $this->db->query('INSERT INTO contact_messages (
                first_name, 
                last_name, 
                email, 
                phone, 
                subject, 
                message, 
                status,
                submitted_at
            ) VALUES (
                :first_name, 
                :last_name, 
                :email, 
                :phone, 
                :subject, 
                :message, 
                :status,
                :submitted_at
            )');

            $this->db->bind(':first_name', $data['first_name']);
            $this->db->bind(':last_name', $data['last_name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':phone', $data['phone']);
            $this->db->bind(':subject', $data['subject']);
            $this->db->bind(':message', $data['message']);
            $this->db->bind(':status', 'new');
            $this->db->bind(':submitted_at', $data['submitted_at']);

            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Contact Model Error: ' . $e->getMessage());
            return false;
        }
    }

    // Get FAQ categories for support page
    public function getFAQCategories() {
        return [
            'booking' => [
                'name' => 'Stadium Booking',
                'icon' => '🏟️',
                'count' => 8
            ],
            'equipment' => [
                'name' => 'Equipment Rental',
                'icon' => '⚽',
                'count' => 6
            ],
            'coaching' => [
                'name' => 'Coaching Services',
                'icon' => '👨‍🏫',
                'count' => 5
            ],
            'payment' => [
                'name' => 'Payment & Billing',
                'icon' => '💳',
                'count' => 4
            ],
            'account' => [
                'name' => 'Account Management',
                'icon' => '👤',
                'count' => 7
            ],
            'technical' => [
                'name' => 'Technical Support',
                'icon' => '🔧',
                'count' => 5
            ]
        ];
    }

    // Get common issues for quick help
    public function getCommonIssues() {
        return [
            [
                'title' => 'How to book a stadium?',
                'description' => 'Step-by-step guide to booking your first venue',
                'link' => URLROOT . '/faq#booking'
            ],
            [
                'title' => 'Payment methods accepted',
                'description' => 'Learn about our secure payment options',
                'link' => URLROOT . '/faq#payment'
            ],
            [
                'title' => 'Cancellation policy',
                'description' => 'Understanding our booking cancellation terms',
                'link' => URLROOT . '/faq#cancellation'
            ],
            [
                'title' => 'Equipment rental process',
                'description' => 'How to rent sports equipment',
                'link' => URLROOT . '/faq#equipment'
            ]
        ];
    }

    // Get all contact messages (for admin)
    public function getAllContactMessages($limit = 50) {
        try {
            $this->db->query('SELECT * FROM contact_messages ORDER BY submitted_at DESC LIMIT :limit');
            $this->db->bind(':limit', $limit);
            return $this->db->resultSet();
        } catch (Exception $e) {
            error_log('Contact Model Error: ' . $e->getMessage());
            return [];
        }
    }

    // Update message status
    public function updateMessageStatus($id, $status) {
        try {
            $this->db->query('UPDATE contact_messages SET status = :status, updated_at = NOW() WHERE id = :id');
            $this->db->bind(':status', $status);
            $this->db->bind(':id', $id);
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Contact Model Error: ' . $e->getMessage());
            return false;
        }
    }

    // Get contact statistics
    public function getContactStats() {
        try {
            $stats = [];
            
            // Total messages
            $this->db->query('SELECT COUNT(*) as total FROM contact_messages');
            $result = $this->db->single();
            $stats['total_messages'] = $result ? $result->total : 0;
            
            // New messages
            $this->db->query('SELECT COUNT(*) as total FROM contact_messages WHERE status = "new"');
            $result = $this->db->single();
            $stats['new_messages'] = $result ? $result->total : 0;
            
            // This month messages
            $this->db->query('SELECT COUNT(*) as total FROM contact_messages WHERE MONTH(submitted_at) = MONTH(NOW()) AND YEAR(submitted_at) = YEAR(NOW())');
            $result = $this->db->single();
            $stats['this_month'] = $result ? $result->total : 0;
            
            return $stats;
        } catch (Exception $e) {
            error_log('Contact Model Error: ' . $e->getMessage());
            return [
                'total_messages' => 0,
                'new_messages' => 0,
                'this_month' => 0
            ];
        }
    }
}
?>