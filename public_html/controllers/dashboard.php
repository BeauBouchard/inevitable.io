<?php
	
class Dashboard extends Controller {
	function __construct() {
		parent::__construct();
		Session::init();
		$log = Session::get('log');
		if(isset($log) && $log == true){
			
		} else {
			Session::destroy();
			header('location: '.URL.'login');
		}
		
		$this->view->js = array();
	}
	
	function index(){
		$this->view->render('dashboard/index');
	}
	
	// on first login, load session variables for user data
	function login(){
		//$data = $this->model->get
		$username = "time";
		Session::set('user_name','');
	}
	
	function logout(){
		Session::destroy();
		header('location: '.URL.'login');
	}
}