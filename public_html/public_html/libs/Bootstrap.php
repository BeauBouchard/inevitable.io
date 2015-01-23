<?php

class Bootstrap {
	function __construct() {
		//if url not set, return null
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url,'/');
		$url = explode('/',$url);
		
		//print_r($url);
		//index page loads at root if there is no '/' 
		if(empty($url[0])){
			require 'controllers/index.php';
			$ctrl = new Index();
			return false;
		}
		
		$file = 'controllers/' . $url[0] . '.php';
		if(file_exists($file)){
			require $file;
		} else {
			require 'controllers/error.php';
			$ctrl = new Error(404);
			return false;
			//echo 'The File: '.$file.' does not exist!';
			//file does not exist
		}
		
		
		$ctrl = new $url[0];
		$ctrl->loadModel($url[0]);
		
		
	
		//there is a link to a function and a controller use it
		if(isset($url[2])) {
			if(method_exists($ctrl, $url[1])) {
				$ctrl->{$url[1]}($url[2]);
			} else {
				
			}
		} else {
			//If the controller is a dectect use it
			if(isset($url[1])) {
				$ctrl->{$url[1]}();
			} else {
				$ctrl->index();
			}
		}
		
	}
	
		//error
	function error() {
		require 'controllers/error.php';
		$ctrl = new Error();
		$ctrl->index();
		return false;
	}
}