<?php
	class Dashboard_Model extends Model {
		
		public function __construct() {
			parent::__construct();
		}
		
		
		public function userInfo($uid) {
			$data = $this->db->prepare("SELECT user_id, user_name FROM user WHERE user_id=:login");
			$data->execute(array (':login' => $login, ':password' => $password));
		}
		
		public function userUploads($uid) {
			
		}
		

		
	}