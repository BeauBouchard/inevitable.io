<?php
 /*
  * Controller page for login page.
  */

class Login extends Controller {
	function __construct() {
		parent::__construct();
		$this->view->js = array("jquery.validate.js","formvalidate.js");
	}
	
	function index() {
		$this->view->render('login/index');
	}
	
	function fail() {
		$this->view->render('login/index');
		
	}
	
	
	//model call for login
	function run() {
			//echo "password:".$_POST['password']." <br/>";
			//echo "hash:".$this->eliteEncrypt($this->filterThis($_POST['password']))." <br/>";
			//echo "uname:".$_POST['login']." <br/>";
			//echo "passwordf:".$this->filterThis($_POST['password'])." <br/>";
		$login = $this->filterThis($_POST['login']);
		$password = $this->eliteEncrypt($this->filterThis($_POST['password'])); 
		$back = $this->model->attemptLogin($login,$password);
		if($back) {
			//echo "Success!";
			Session::init();
			Session::set('user_id',$back['user_id']);
			header('location: '.URL.'dashboard/login/');
		}else {
		//				header('location: '.URL.'dashboard');
		//		header('location: '.URL.'login');
			//echo "Fail!";
			header('location: '.URL.'login/fail/');
		}
	}
	
	//model call for registration 
	function reg() {
		
	}
	
	function register() {
		$this->view->render('login/register');
	}
	

	

}