<?php
	/*
	 * 
	 * functionality: logout, change password, change email, view uploads
	 * 
	 */

class Dashboard extends Controller {
	function __construct() {
		parent::__construct();
		//$this->view->js = array("jquery.js");
		$this->checkLogin();
	}
	
	public function checkLogin(){
		Session::init();
		$log = Session::get('log');
		if(isset($log) && $log == true){
			
		} else {
			Session::destroy();
			header('location: '.URL.'login');
			exit;
		}
	}
	
	function index(){
		$this->checkLogin();
		$this->view->render('dashboard/index');
	}
	
	// on first login, load session variables for user data
	function login(){
		$this->checkLogin();
		$id = Session::get('user_id');
		$data = $this->model->getUsername($id);
		Session::set('user_name', $data['user_name']);
		//$username = "time";
		
		//Session::set('user_name','');
		$this->view->render('dashboard/index');
	}
	
	function logout(){
		Session::destroy();
		header('location: '.URL.'login');
	}
	
/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source http://gravatar.com/site/implement/images/php/
 * 
 */
 public function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}
	
	

}