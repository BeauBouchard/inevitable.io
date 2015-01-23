<?php 
 /*
  * Controller page for About page.
  */

class About extends Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$this->view->render('about/index');
	}
}