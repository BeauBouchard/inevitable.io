<?php
	class Login_Model extends Model {
		
		public function __construct() {
			parent::__construct();
		}
		
		public function attemptLogin($login,$password) {
			$login = mysql_real_escape_string($login);
  			$password = mysql_real_escape_string($password);
			
			$data = $this->db->prepare("SELECT user_id FROM user WHERE user_name=:login AND user_p=:password LIMIT 0 , 1");
			$data->execute(array (':login' => $login, ':password' => $password));
			
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
		
		function attemptRegister($email,$login,$pass) {
  			$email = mysql_real_escape_string($email);
			$login = mysql_real_escape_string($login);
  			$password = mysql_real_escape_string($pass);
			
  			$newuser = $this->db->prepare("INSERT INTO user (user_name,user_p) VALUES (:login,:password)");
  			$newuser->execute(array (':login' => $login, ':password' => $password));
  			//tries to find newly created user id
        	$id = $this->db->lastInsertId();
        	if($id){
        		$newprofile = $this->db->prepare("INSERT INTO user_profile (user_id,user_email,user_bio,user_website) VALUES (:id,:email,'Please enter a short Bio here.','none')");
  				$newprofile->execute(array (':id' => $id, ':email' => $email));
        	} else {
        		// failed because the id was not returned
        	}
        	return $id;
		}
		
		// supplies a username and returns the ID of said username
		public function findID($uname) {
			$login = mysql_real_escape_string($uname);
			$data = $this->db->prepare("SELECT user_id FROM user WHERE user_name=:login LIMIT 0 , 5");
			$data->execute(array (':login' => $login));
			if($data->rowCount() > 0){	
				$data = $data->fetch(PDO::FETCH_ASSOC); 
				return $data['user_id'];
			} else { return false; }
		}
		
		public function checkName($uname){
			$login = mysql_real_escape_string($uname);
			$data = $this->db->prepare("SELECT user_id FROM user WHERE user_name=:login LIMIT 0 , 5");
			$data->execute(array (':login' => $login));
			if($data->rowCount() > 0){	return false; // username is taken
			} else { return true; }
		}
		
	}