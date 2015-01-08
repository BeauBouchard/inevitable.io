<?php 
 /*
  * Controller page for About page.
  */

class Browse extends Controller {
	function __construct() {
		parent::__construct();
		
		
	}
	
	function index() {
		$this->view->render('browse/index');
	}
}