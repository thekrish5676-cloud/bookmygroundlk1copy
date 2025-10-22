<?php
class Rental_packages extends Controller {
    private $rentalPackagesModel;

    public function __construct()
    {
        $this->rentalPackagesModel = $this->model('M_Rental_packages');
    }

    public function index() {
        // Show rental packages page
        $data = [
            'title' => 'Rental Service Packages - BookMyGround',
            'packages' => $this->rentalPackagesModel->getPackages()
        ];

        $this->view('rental_packages/v_packages', $data);
    }
}
?>