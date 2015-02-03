<?php 
 /*
  * Controller page for About page.
  */

class Browse extends Controller {
	function __construct() {
		parent::__construct();
		
		
	}
	
	function index() {
		$this->view->printList = $this->model->listPrints(0,10);
		//$this->getPrints(0,3);
		$this->view->render('browse/index',false,'Browse Blueprints');
	}
	
	/*
	 * 	blueprint.blueprint_id as 'bid',
	 * 	user.user_id		   as 'uid',
	 * 	user.user_name		   as 'uname',
	 * 	blueprint_title		   as 'title',
	 * 	blueprint_desc   	   as 'desc',
	 * 	file_location  		   as 'location'
	 */
	function getPrints($start,$stop) {
		$start = $this->filterThis($start);
		$stop = $this->filterThis($start);
		if(is_numeric($start) && is_numeric($stop) )
		{
			//not really sure why, but the limit doesnt work with 
			// this PDO 
			return  $this->model->listPrints($start,$stop);
		} else {
			
		}
	}
	
	function getPrintsJson($start,$stop) {
		$start = $this->filterThis($start);
		$stop = $this->filterThis($start);
		if(is_numeric($start) && is_numeric($stop) )
		{
			$data = json_encode($this->getPrints($start,$stop));
			return $data;
		}

		
	}
	
	function generateImageBox() {
		
		
	}
}