<?php
class Coach extends Controller {


	// Default method used by router
	public function index() {
		$sportsModel = $this->model('M_Coaches');
		$sports = $sportsModel->selectbysport();
		$featured = $sportsModel->getFeatured();

		$data = [
			'title' => 'Coach Listing',
			'sports' => $sports,
			'featured' => $featured
		];
	    // Load view using base Controller helper
	    $this->view('coachlist/v_coach_index', $data);
	}
   
    



	// Show coaches for a specific sport, e.g. /coach/sport/football
	public function sport($sport = ''){
		$sportsModel = $this->model('M_Coaches');
		$sport = urldecode($sport);
		$coaches = $sportsModel->getBySport($sport);

		$data = [
			'title' => ucwords($sport) . ' Coaches',
			'sport' => $sport,
			'coaches' => $coaches
		];

		$this->view('coachlist/v_coach_sport', $data);
	}
    
		// Show a single coach detail page: /coach/show/{id}
		public function show($id = 0){
			$model = $this->model('M_Coaches');
			$all = $model->getAll();
			$coach = null;
			foreach($all as $c){
				if((int)$c['id'] === (int)$id){
					$coach = $c;
					break;
				}
			}

			if(!$coach){
				// simple 404-like behavior: redirect back to list
				header('Location: ' . URLROOT . '/coach');
				exit;
			}

			$data = [
				'title' => $coach['name'] . ' — Coach',
				'coach' => $coach
			];

			$this->view('coachlist/v_coach_single', $data);
		}
    
}