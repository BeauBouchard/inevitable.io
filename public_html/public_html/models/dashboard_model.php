<?php
	class Dashboard_Model extends Model {
		
		public function __construct() {
			parent::__construct();
		}
		
		
		public function getUsername($uid) {
			$data = $this->db->prepare("SELECT  user_name FROM user WHERE user_id=:id");
			$data->execute(array (':id' => $uid));
			if($data->rowCount() > 0){
					return $data->fetch(PDO::FETCH_ASSOC);
			}else {
				// failed
				return false;
			}
		}
		
		public function userUploads($uid) {
			
		}	
	}