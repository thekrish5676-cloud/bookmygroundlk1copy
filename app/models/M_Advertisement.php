<?php
class M_Advertisement {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getPackages() {
        return [
            'basic' => [
                'name' => 'Basic Package',
                'price' => 5000,
                'duration' => 'week',
                'features' => [
                    'Homepage banner placement',
                    '7 days visibility',
                    'Desktop & mobile display',
                    'Basic analytics report'
                ]
            ],
            'professional' => [
                'name' => 'Professional Package',
                'price' => 12000,
                'duration' => 'month',
                'popular' => true,
                'features' => [
                    'Top banner on all pages',
                    '30 days visibility',
                    'Priority placement',
                    'Detailed analytics dashboard',
                    'Social media promotion'
                ]
            ],
            'premium' => [
                'name' => 'Premium Package',
                'price' => 30000,
                'duration' => '3 months',
                'features' => [
                    'Featured placement everywhere',
                    '90 days visibility',
                    'Multiple ad formats',
                    'Advanced analytics & insights',
                    'Social media campaigns',
                    'Dedicated account manager'
                ]
            ]
        ];
    }

    public function createAdvertisement($data) {
        try {
            $this->db->query('INSERT INTO advertisement_requests (
                company_name,
                contact_name,
                email,
                phone,
                package,
                website,
                message,
                file_path,
                status,
                submitted_at
            ) VALUES (
                :company_name,
                :contact_name,
                :email,
                :phone,
                :package,
                :website,
                :message,
                :file_path,
                :status,
                :submitted_at
            )');

            $this->db->bind(':company_name', $data['company_name']);
            $this->db->bind(':contact_name', $data['contact_name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':phone', $data['phone']);
            $this->db->bind(':package', $data['package']);
            $this->db->bind(':website', $data['website']);
            $this->db->bind(':message', $data['message']);
            $this->db->bind(':file_path', $data['file_path'] ?? null);
            $this->db->bind(':status', $data['status']);
            $this->db->bind(':submitted_at', $data['submitted_at']);

            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Advertisement Model Error: ' . $e->getMessage());
            return false;
        }
    }

    public function getAllAdvertisements() {
        try {
            $this->db->query('SELECT * FROM advertisement_requests ORDER BY submitted_at DESC');
            return $this->db->resultSet();
        } catch (Exception $e) {
            error_log('Advertisement Model Error: ' . $e->getMessage());
            return [];
        }
    }

    public function getAdvertisementById($id) {
        try {
            $this->db->query('SELECT * FROM advertisement_requests WHERE id = :id');
            $this->db->bind(':id', $id);
            return $this->db->single();
        } catch (Exception $e) {
            error_log('Advertisement Model Error: ' . $e->getMessage());
            return null;
        }
    }

    public function updateStatus($id, $status) {
        try {
            $this->db->query('UPDATE advertisement_requests SET status = :status WHERE id = :id');
            $this->db->bind(':status', $status);
            $this->db->bind(':id', $id);
            return $this->db->execute();
        } catch (Exception $e) {
            error_log('Advertisement Model Error: ' . $e->getMessage());
            return false;
        }
    }
}
?>