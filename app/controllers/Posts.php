<?php
class Posts extends Controller {
    private $postsModel;

    public function __construct() {
        $this->postsModel = $this->model('M_Posts');
    }

    // Main blog page - list all posts
    public function index() {
        // For now, we'll use sample data
        // Later we'll fetch from database
        $posts = [
            [
                'id' => 1,
                'title' => 'Top 5 Football Stadiums in Sri Lanka',
                'excerpt' => 'Discover the best football stadiums across Sri Lanka for your next game...',
                'content' => 'Full content here...',
                'author' => 'Admin',
                'category' => 'Football',
                'image' => 'blog1.jpg',
                'views' => 245,
                'created_at' => '2025-01-10',
                'status' => 'published'
            ],
            [
                'id' => 2,
                'title' => 'How to Choose the Right Sports Equipment',
                'excerpt' => 'A comprehensive guide to selecting quality sports gear for your needs...',
                'content' => 'Full content here...',
                'author' => 'Admin',
                'category' => 'General',
                'image' => 'blog2.jpg',
                'views' => 189,
                'created_at' => '2025-01-08',
                'status' => 'published'
            ],
            [
                'id' => 3,
                'title' => 'Benefits of Regular Sports Training',
                'excerpt' => 'Learn why consistent training is key to improving your athletic performance...',
                'content' => 'Full content here...',
                'author' => 'Admin',
                'category' => 'Training',
                'image' => 'blog3.jpg',
                'views' => 312,
                'created_at' => '2025-01-05',
                'status' => 'published'
            ],
            [
                'id' => 4,
                'title' => 'Cricket Coaching Tips for Beginners',
                'excerpt' => 'Essential cricket techniques every beginner should master...',
                'content' => 'Full content here...',
                'author' => 'Admin',
                'category' => 'Cricket',
                'image' => 'blog4.jpg',
                'views' => 156,
                'created_at' => '2025-01-03',
                'status' => 'published'
            ]
        ];

        $data = [
            'title' => 'Blog - BookMyGround',
            'posts' => $posts
        ];

        $this->view('posts/v_blog', $data);
    }

    // Single post page
    public function show($id) {
        // For now, we'll use sample data
        $post = [
            'id' => $id,
            'title' => 'Top 5 Football Stadiums in Sri Lanka',
            'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                         <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                         <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>',
            'author' => 'Admin',
            'category' => 'Football',
            'image' => 'blog1.jpg',
            'views' => 245,
            'created_at' => '2025-01-10',
            'status' => 'published'
        ];

        $data = [
            'title' => $post['title'] . ' - Blog',
            'post' => $post
        ];

        $this->view('posts/v_blog_single', $data);
    }

    // Category filter
    public function category($category) {
        // This will filter posts by category
        // For now, redirect to main blog
        header('Location: ' . URLROOT . '/posts');
        exit;
    }
}
?>