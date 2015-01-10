<?php

	// Use splautoloader or something
	
	//require '';
	class View {
		
		function __construct() {
			//view constructed, pre-render code can go here.

		}
		

		
		public function render($name, $noInclude = false) {
													$bkarray = Array("map2.png",
							  "map3.png",
							  "map4.png",
							  "map5.png",
							  "map6.png",
							  "map7.png",
							  "map8.png");
			
			
			$this->bkimage = $bkarray[array_rand($bkarray)];	//background-image: url(../media/map2.gif);
		
			if($noInclude){
				require 'views/' . $name . '.php';
			} else {
				require 'views/header.php';
				require 'views/' . $name . '.php';
				require 'views/footer.php';
			}
		}
	}