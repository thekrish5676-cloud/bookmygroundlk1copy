<?php
class Stadiums extends Controller {
    private $stadiumsModel;

    public function __construct()
    {
        $this->stadiumsModel = $this->model('M_Stadiums');
    }

    public function index() {
        // Get all stadiums
        $stadiums = $this->stadiumsModel->getAllStadiums();

        $data = [
            'title' => 'Find Your Perfect Stadium',
            'stadiums' => $stadiums
        ];

        $this->view('stadiums/v_stadiums', $data);
    }

    public function single($id) {
        // Get single stadium details
        $stadium = $this->stadiumsModel->getStadiumById($id);
        
        if(!$stadium) {
            // Redirect to 404 or stadiums list
            header('Location: ' . URLROOT . '/stadiums');
            exit;
        }

        $data = [
            'title' => $stadium->name,
            'stadium' => $stadium
        ];

        $this->view('stadiums/v_single_stadium', $data);
    }
}
?>