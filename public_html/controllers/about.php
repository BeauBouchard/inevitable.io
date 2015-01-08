<?php 
 /*
  * Controller page for About page.
  */

class About extends Controller {
	function __construct() {
		parent::__construct();
		echo "We are on the about page";
	}
	
	public function author() {
		echo "Beau Bouchard (@beaubouchard)";
	}
	
}
