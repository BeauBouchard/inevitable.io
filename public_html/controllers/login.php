<?php
 /*
  * Controller page for login page.
  */

class Login extends Controller {
	function __construct() {
		parent::__construct();
		
	}
	
	function index() {
		
		$this->view->render('login/index');
	}
	
	function run() {
		$login = $this->filterThis($_POST['login']);
		$password = $this->hashbrown($this->filterThis($_POST['password'])); 
		$this->model->attemptLogin($login,$password);
	}
	
	function reg() {
		
	}
	
	function register() {
		$this->view->render('login/register');
	}
	

	

}