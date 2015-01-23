<?php
 /*
  * Controller page for Error page.
  */

class Error extends Controller {
	function __construct($args = false) {
		parent::__construct();
		if($args == 404){
			$this->view->errormsg = "404 - The page is not here";
		} else {
			$list = Array('It was inevitable',
				  'The horror!',
				  'It is terrifying.',
				  'Im a little angry.',
				  'Death is all around us. This cannot horrify me.',
				  'Long live the cause!',
				  'It was for the best.',
				  'That is sad but not unexpected.',
	              'Its dark down here.',
	              'At least it doesnt rain down here.',
	              'This must be stopped by any means at our disposal.',
	              'It is inaccessible from here.',
	              'Life is, in a word, dusk.',
				  'Theres fighting!');
	
			$this->view->errormsg = $list[array_rand($list)];
		}
		$this->view->render('error/index');
	}
	
	function index() {
		$this->view->msg = 'This page doesnt exist';
		$this->view->render('error/index');
	}
	
	public function error($args = false) {
		require 'models/error_model.php';
		$model = new Error_Model();

	}
}