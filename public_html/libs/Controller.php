<?php
 /*
  * Main Controller page that all ctrlers are apart of
  * 
  */

	class Controller  {
		
		function __construct() {
			echo "Main Controller";
			$this->view = new View();
		}
	}