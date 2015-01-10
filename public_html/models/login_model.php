<?php
	class Login_Model extends Model {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function attemptLogin($login,$password) {
			
			$login = mysql_real_escape_string($login);
  			$password = mysql_real_escape_string($password);
			
			$data = $this->db->prepare("SELECT user_id FROM user WHERE user_name=:login AND user_p=:password");
			$data->execute(array (':login' => $login, ':password' => $password));
			
			
			//$data = fetchAll();
			
			//print_r($data);
			
			if($data->rowCount() > 0){
				//login
				Session::init();
				Session::set('log', true);
				$userid = $data->fetch(PDO::FETCH_ASSOC);
				
				return $userid;
			} else {
				// failed
				return false;
			}
		}
		
	}