<?php
	/*
	 * 
	 * functionality: logout, change password, change email, view uploads
	 * 
	 */

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
		
		$this->view->js = array("jquery.js");
	}
	
	function index(){
		$this->view->render('dashboard/index');
	}
	
	// on first login, load session variables for user data
	function login(){
		Session::init();
		$id = Session::get('user_id');
		$data = $this->model->getUsername($id);
		Session::set('user_name', $data['user_name']);
		$username = "time";
		
		//Session::set('user_name','');
		$this->view->render('dashboard/index');
	}
	
	function logout(){
		Session::destroy();
		header('location: '.URL.'login');
	}
	
	

}