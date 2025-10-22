<?php
class Advertisement extends Controller {
    private $advertisementModel;

    public function __construct()
    {
        $this->advertisementModel = $this->model('M_Advertisement');
    }

    public function index() {
        // Show advertisement submission page
        $data = [
            'title' => 'Publish Your Advertisement - BookMyGround',
            'packages' => $this->advertisementModel->getPackages()
        ];

        $this->view('advertisement/v_publish_ad', $data);
    }

    public function submit() {
        // Handle advertisement form submission
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . URLROOT . '/advertisement');
            exit;
        }

        // Get form data
        $formData = [
            'company_name' => trim($_POST['companyName'] ?? ''),
            'contact_name' => trim($_POST['contactName'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'package' => $_POST['package'] ?? '',
            'website' => trim($_POST['website'] ?? ''),
            'message' => trim($_POST['message'] ?? ''),
            'status' => 'pending',
            'submitted_at' => date('Y-m-d H:i:s')
        ];

        // Validate form data
        $errors = $this->validateForm($formData);

        if (!empty($errors)) {
            $_SESSION['ad_errors'] = $errors;
            $_SESSION['ad_form_data'] = $formData;
            header('Location: ' . URLROOT . '/advertisement');
            exit;
        }

        // Handle file upload if present
        if (isset($_FILES['adFile']) && $_FILES['adFile']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->handleFileUpload($_FILES['adFile']);
            if ($uploadResult['success']) {
                $formData['file_path'] = $uploadResult['file_path'];
            } else {
                $_SESSION['ad_errors'] = [$uploadResult['error']];
                $_SESSION['ad_form_data'] = $formData;
                header('Location: ' . URLROOT . '/advertisement');
                exit;
            }
        }

        // Save advertisement request
        if ($this->advertisementModel->createAdvertisement($formData)) {
            $_SESSION['ad_success'] = 'Thank you! Your advertisement request has been submitted successfully. We\'ll contact you within 24 hours.';
            header('Location: ' . URLROOT . '/advertisement');
            exit;
        } else {
            $_SESSION['ad_errors'] = ['Failed to submit advertisement. Please try again.'];
            $_SESSION['ad_form_data'] = $formData;
            header('Location: ' . URLROOT . '/advertisement');
            exit;
        }
    }

    private function validateForm($data) {
        $errors = [];

        if (empty($data['company_name'])) {
            $errors[] = 'Company/Business name is required';
        }

        if (empty($data['contact_name'])) {
            $errors[] = 'Contact person name is required';
        }

        if (empty($data['email'])) {
            $errors[] = 'Email is required';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address';
        }

        if (empty($data['phone'])) {
            $errors[] = 'Phone number is required';
        }

        if (empty($data['package'])) {
            $errors[] = 'Please select a package';
        }

        return $errors;
    }

    private function handleFileUpload($file) {
        $uploadDir = '../public/uploads/advertisements/';
        
        // Create directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Validate file
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($file['type'], $allowedTypes)) {
            return ['success' => false, 'error' => 'Invalid file type. Only JPG, PNG, and PDF files are allowed.'];
        }

        if ($file['size'] > $maxSize) {
            return ['success' => false, 'error' => 'File size exceeds 5MB limit.'];
        }

        // Generate unique filename
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = 'ad_' . time() . '_' . uniqid() . '.' . $extension;
        $filepath = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            return ['success' => true, 'file_path' => 'uploads/advertisements/' . $filename];
        } else {
            return ['success' => false, 'error' => 'Failed to upload file.'];
        }
    }
}
?>