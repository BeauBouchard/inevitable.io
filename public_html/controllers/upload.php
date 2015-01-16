<?php 
 /*
  * Controller page for Upload page.
  */

class Upload extends Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
	   if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
    }
		/*$this->view->js = array("jquery.ui.widget.js",
		"jquery.fileupload-audio.js",
		"jquery.fileupload-image.js",
		"jquery.fileupload-process.js",
		"jquery.fileupload-ui.js",
		"jquery.fileupload-validate.js",
		"jquery.fileupload-video.js",
		"jquery.fileupload.js",
		"jquery.iframe-transport.js",
		"jquery.fileupload-run.js");*/
		
		//$this->view->upload = true;
		$this->view->render('upload/index');
	}
}