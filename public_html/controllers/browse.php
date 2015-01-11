<?php 
 /*
  * Controller page for About page.
  */

class Browse extends Controller {
	function __construct() {
		parent::__construct();
		
		
	}
	
	function index() {
		$this->printArray = $this->getPrints(0,3);
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
		return  $this->model->listPrints($start,$stop);
	}
	
	function generateImageBox() {
		
		
	}
}