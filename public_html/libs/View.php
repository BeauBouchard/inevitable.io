<?php

	// Use splautoloader or something
	
	//require '';
	class View {
		
		function __construct() {
			//view constructed, pre-render code can go here.
			
		}
		
		public function render($name, $noInclude = false) {
			if($noInclude){
				require 'views/' . $name . '.php';
			} else {
				require 'views/header.php';
				require 'views/' . $name . '.php';
				require 'views/footer.php';
			}
		}
	}