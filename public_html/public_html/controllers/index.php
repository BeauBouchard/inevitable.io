<?php 
 /*
  * Controller page for Home page.
  */

class Index extends Controller {
	
	function __construct() {
		parent::__construct();
		$this->view->render('index/index');
	}
	
	//main splash/ home page
	function index() {
		$this->view->render('index/index');
	}
}
