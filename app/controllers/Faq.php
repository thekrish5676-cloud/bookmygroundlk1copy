<?php
class Faq extends Controller {
    private $faqModel;

    public function __construct()
    {
        $this->faqModel = $this->model('M_Faq');
    }

    public function index() {
        // Get all FAQ categories and their questions
        $faqData = $this->faqModel->getAllFAQsByCategory();
        
        $data = [
            'title' => 'Frequently Asked Questions - BookMyGround',
            'faq_data' => $faqData,
            'total_faqs' => $this->faqModel->getTotalFAQs(),
            'categories' => $this->faqModel->getCategories()
        ];

        $this->view('faq/v_faq', $data);
    }

    public function search() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $searchTerm = $_POST['search_term'] ?? '';
            
            if (!empty($searchTerm)) {
                $searchResults = $this->faqModel->searchFAQs($searchTerm);
                
                $data = [
                    'title' => 'FAQ Search Results - BookMyGround',
                    'search_results' => $searchResults,
                    'search_term' => $searchTerm,
                    'total_results' => count($searchResults)
                ];
                
                $this->view('faq/v_search_results', $data);
                return;
            }
        }
        
        // Redirect back to FAQ if no search term
        header('Location: ' . URLROOT . '/faq');
        exit;
    }

    public function category($categoryName = null) {
        if (!$categoryName) {
            header('Location: ' . URLROOT . '/faq');
            exit;
        }
        
        $categoryFAQs = $this->faqModel->getFAQsByCategory($categoryName);
        
        if (empty($categoryFAQs)) {
            header('Location: ' . URLROOT . '/faq');
            exit;
        }
        
        $data = [
            'title' => ucfirst($categoryName) . ' FAQs - BookMyGround',
            'category' => $categoryName,
            'category_faqs' => $categoryFAQs,
            'total_questions' => count($categoryFAQs)
        ];
        
        $this->view('faq/v_category', $data);
    }
}
?>