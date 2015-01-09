<?php
 /*
  * Main Controller page that all ctrlers are apart of
  * 
  */

	class Controller  {
		
		function __construct() {
			//echo "Main Controller";
			$this->view = new View();
		}
		
		public function loadModel($name) {
			
			$path = 'models/' . $name . '_model.php';
			
			if (file_exists($path)) {
				require 'models/' . $name .'_model.php';
				
				$modelName = $name . '_Model';
				$this->model = new $modelName();
			}
		}
		
		public function checkEmail($email) {
			if ( preg_match('/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/', $email)){
				$emailAddress = trim( $email );
				return $emailAddress;
			} else {
				return false;
			}
		}
		
		public function filterThis($string) {
    		return mysql_real_escape_string($string);
		}
		
		public function hashbrown($income) {
			//$options = [ 	'salt' => $this->getsalt(),
    		//				'cost' => 12 // the default cost is 10
			//		];
			//255
			
			array("cost" => 12, "salt" => $this->getSalt());
			$output = password_hash( $income , PASSWORD_BCRYPT, $options); // 
		}
		
		public function getSalt() {
			
			return "!(!!";
			
		}
		
		public function verifyPass($income) {
			// Fetch hash+salt from database, place in $hashAndSalt variable
			// and then to verify $password:
			if (password_verify($password, $income)) {
   				// Verified
			}
			
		}
		

	}