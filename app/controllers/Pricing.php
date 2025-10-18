<?php
class Pricing extends Controller {
    private $pricingModel;

    public function __construct()
    {
        $this->pricingModel = $this->model('M_Pricing');
    }

    public function index() {
        // Get pricing packages
        $packages = $this->pricingModel->getPricingPackages();

        $data = [
            'title' => 'Pricing Plans',
            'packages' => $packages
        ];

        $this->view('pricing/v_pricing', $data);
    }

    public function compare() {
        // Detailed comparison page
        $packages = $this->pricingModel->getPricingPackages();
        $features = $this->pricingModel->getFeatureComparison();

        $data = [
            'title' => 'Compare Plans',
            'packages' => $packages,
            'features' => $features
        ];

        $this->view('pricing/v_compare', $data);
    }
}
?>