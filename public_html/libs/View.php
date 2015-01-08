<?php

	// Use splautoloader or something
	
	//require '';
	class View {
		
		function __construct() {
			echo "Main View";
			
		}
	
		public function render($name) {
			require'views/' . $name . '.php';
			
			
		}
	
	}