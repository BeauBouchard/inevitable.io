<?php

	// Use splautoloader or something
	
	//require '';
	class View {
		
		function __construct() {
			//view constructed, pre-render code can go here.
			$this->loadHeaderImage();
		}

		public function render($name, $noInclude = false, $title = "inevitable.io - Dwarf Fortress Quickfort Repository ") {
			$this->title = $title;
			if($noInclude){
				require 'views/' . $name . '.php';
			} else {
				require 'views/header.php';
				require 'views/' . $name . '.php';
				require 'views/footer.php';
			}
		}
		
		function loadHeaderImage(){
						$bkarray = Array("map2.png",
							 "map3.png",
							 "map4.png",
							 "map5.png",
							 "map6.png",
							 "map7.png",
							 "map8.png");
			$this->bkimage = $bkarray[array_rand($bkarray)];	//background-image: url(../media/map2.gif);
		}
	}