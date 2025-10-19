<?php
class M_Posts {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Get all published posts
    public function getAllPosts() {
        $this->db->query('SELECT * FROM posts WHERE status = :status ORDER BY created_at DESC');
        $this->db->bind(':status', 'published');
        
        return $this->db->resultSet();
    }

    // Get single post by ID
    public function getPostById($id) {
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);
        
        return $this->db->single();
    }

    // Get recent posts (limit)
    public function getRecentPosts($limit = 5) {
        $this->db->query('SELECT * FROM posts WHERE status = :status ORDER BY created_at DESC LIMIT :limit');
        $this->db->bind(':status', 'published');
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        
        return $this->db->resultSet();
    }

    // Get posts by category
    public function getPostsByCategory($category) {
        $this->db->query('SELECT * FROM posts WHERE category = :category AND status = :status ORDER BY created_at DESC');
        $this->db->bind(':category', $category);
        $this->db->bind(':status', 'published');
        
        return $this->db->resultSet();
    }

    // Search posts
    public function searchPosts($searchTerm) {
        $this->db->query('SELECT * FROM posts WHERE (title LIKE :search OR content LIKE :search) AND status = :status ORDER BY created_at DESC');
        $this->db->bind(':search', '%' . $searchTerm . '%');
        $this->db->bind(':status', 'published');
        
        return $this->db->resultSet();
    }

    // Increment post views
    public function incrementViews($id) {
        $this->db->query('UPDATE posts SET views = views + 1 WHERE id = :id');
        $this->db->bind(':id', $id);
        
        return $this->db->execute();
    }
}
?>
