<?php
 /*
  * Controller page for Upload page.
  */

class DataServer extends Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		//$this->view->upload = true;
		//$this->view->render('upload/uploadHandler');
		error_reporting(E_ALL | E_STRICT);
		require(LIBS.'UploadHandler.php');
		$upload_handler = new UploadHandler();
	}
	
	function json() {
		
	}
}
