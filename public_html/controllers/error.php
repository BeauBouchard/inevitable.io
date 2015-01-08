<?php
 /*
  * Controller page for Error page.
  */

class Error extends Controller {
	function __construct() {
		parent::__construct();
		
		$this->view->render('error/index');
	}
	
	function index() {
		$this->view->msg = 'This page doesnt exist';
		$this->view->render('error/index');
	}
	
	public function error($args = false) {
		require 'models/error_model.php';
		$model = new Error_Model();
		
		if($args == "404"){
			echo "404!!!";
		} else {
			echo $args;
		}
	}
}