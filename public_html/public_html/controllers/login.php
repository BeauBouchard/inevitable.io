<?php
 /*
  * Controller page for login page.
  */

class Login extends Controller {
	function __construct() {
		$this->view->js = array("jquery.validate.js","formvalidate.js");
		parent::__construct();
		
	}
	
	function index() {
		$this->view->render('login/index');
	}
	
	/*
	 * fail()
	 * Counts failed loggin attempts. 
	 */
	function fail() {
		Session::init();
		$log = Session::get('loginattempt');
		if(isset($log) && $log != 0){
			$log++;
			Session::set('loginattempt', $log);
		} else {
			Session::set('loginattempt', 1);
		}
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
			//Fail!
			header('location: '.URL.'login/fail/');
		}
	}
	
	//model call for registration 
	function reg() {
		//cleaning inputs
		$email =  $this->filterThis($_POST['email']); //64 varchar
		$username =  $this->filterThis($_POST['login']); // 64 varchar
		$pass =  $this->filterThis($_POST['password1']); // 64 varchar
		
		//checking if too long or short, replies error msg
		if(strlen($email) >= 8 && strlen($email) < 64){
			
		} else {
			Session::init();
			Session::set('error', 'Email is too long/short.');
			header('location: '.URL.'login/register/');
		}
		if(strlen($username) >= 8 && strlen($username) < 64){
			
		} else {
			Session::init();
			Session::set('error', 'Username is too long/short.');
			header('location: '.URL.'login/register/');
		}
		if(strlen($pass) >= 8 && strlen($pass) < 64){
			
		} else {
			Session::init();
			Session::set('error', 'Password is too long/short.');
			header('location: '.URL.'login/register/');
		}
		
		// now to actually check to see if the username is availble 
		//checkUsername()
		if($this->checkUsername($username)){
			
		} else {
			Session::init();
			Session::set('error', 'Username already taken.');
			header('location: '.URL.'login/register/');
		}
		
		$back = $this->model->attemptRegister($email,$username,$this->eliteEncrypt($pass));
		
		if(isset($back) && $back !=false) {
			//echo "Success!";
			Session::init();
			Session::set('log', true);
			Session::set('user_id',$back['user_id']);
			header('location: '.URL.'dashboard/login/');
		}else {
			//Fail!
			Session::init();
			Session::set('error', 'There was a problem creating the account');
			header('location: '.URL.'login/register/');
		}
	}
	
	public function checkUsername($username) { 
		return $this->model->checkName($this->filterThis($username));
	}
	
	function register() {
		$this->view->render('login/register');
	}
	

	

}