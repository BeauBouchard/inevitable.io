<?php
 /*
  * Controller page for Error page.
  */

class Error extends Controller {
	function __construct() {
		parent::__construct();
		echo "We are on the Error page";
		
		$this->view->render('error/index');
	}
	
	public function error($args = false) {
		if($args == "404"){
			echo "404!!!";
		} else {
			echo $args;
		}
	}
	
	
	
}