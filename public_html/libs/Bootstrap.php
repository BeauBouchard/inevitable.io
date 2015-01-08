<?php

class Boostrap {
	
	function __construct() {
		$url = $_GET['url'];
		$url = rtrim($url,'/');
		$url = explode('/',$url);
		
		
		
		//print_r($url);
		
		
		$file = 'controllers/' . $url[0] . '.php';
		if(file_exists($file)){
			require $file;
			
		} else {
			require 'controllers/error.php';
			$ctrl = new Error();
			//echo 'The File: '.$file.' does not exist!';
			//file does not exist
			
		}
		
		
		$ctrl = new $url[0];
		
			//there is a link to a function and a controller use it
		if(isset($url[2])) {
			if(isset($url[1])) {
				$ctrl->{$url[1]}($url[2]);
			}
		} else {
			//If the controller is a dectect use it
			if(isset($url[1])) {
				$ctrl->{$url[1]}();
			}	
		}
	}
}