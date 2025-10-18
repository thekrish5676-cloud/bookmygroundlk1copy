<?php
class Home extends Controller {
    private $homeModel;

    public function __construct()
    {
        $this->homeModel = $this->model('M_Home');
    }

    public function index() {
        // Get featured stadiums (limit to 6 for the homepage)
        $featuredStadiums = $this->homeModel->getFeaturedStadiums(6);
        
        $data = [
            'title' => 'BookMyGround - Your Sports Booking Platform',
            'featured_stadiums' => $featuredStadiums
        ];

        $this->view('v_home', $data);
    }
}
?>