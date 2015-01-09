<?php
	class Login_Model extends Model {
		
		public function __construct() {
		
		}
		
		public function attemptLogin($login,$password) {
			
			$login = mysql_real_escape_string($login);
  			$password = mysql_real_escape_string($password);

			$this->db->prepared("SELECT id FROM users WHERE login= :login AND password= :password");
			$this->execute(array (':login' => $login, ':password' => $password));
			
			$data = fetchAll();
			
			print_r($data);
		}
		
	}