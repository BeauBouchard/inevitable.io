<?php
	/*
	 * Browse Datalayer
	 * 		Description: Browse is the individual page for a blueprint. It will include a download of a zip including both the .png image of the blueprint and the .csv version of the blueprint. 
	 * 
	 * 
	 * @param 
	 * 
	 */
	class Browse_Model extends Model{
		private $blueprintID;
		function __construct() {
			parent::__construct();
			//collects data from database to display incase of error
		}
					/*$data = $this->db->prepare("SELECT 
						blueprint.blueprint_id  as 'bid', 	
						user.user_id 			as 'uid',
						user.user_name 			as 'uname',
			 			blueprint_title 		as 'title',
						blueprint_desc   	    as 'desc',
						file_location  		    as 'location'
					FROM blueprint
					INNER JOIN blueprint_files
						ON blueprint.blueprint_id = blueprint_files.blueprint_id 
					JOIN user 
   						ON user.user_id  = blueprint.user_id
					WHERE file_location LIKE '%.png' 
					ORDER BY bid DESC");*/
			//$data->execute(array(':start' => $start, ':max' => $stop));// 
			//$data->bindParam(':start', intval(trim($start)), PDO::PARAM_INT);
			//$data->bindParam(':stop', intval(trim($stop)), PDO::PARAM_INT);
						//$data = $data->fetch(PDO::FETCH_ASSOC); 
		function listPrints($start,$stop) {
			$start = mysql_real_escape_string($start);
			$stop = mysql_real_escape_string($stop);
			
			$this->db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
			//$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			/*	Join statement for returning all */
			$data = $this->db->prepare("SELECT 
						blueprint.blueprint_id  as 'bid',
						user.user_id 			as 'uid',
						user.user_name 			as 'uname',
			 			blueprint_title 		as 'title',
						blueprint_desc   	    as 'desc',
						file_location  		    as 'location'
					FROM blueprint
					INNER JOIN blueprint_files
						ON blueprint.blueprint_id = blueprint_files.blueprint_id 
					JOIN user 
   						ON user.user_id  = blueprint.user_id
					ORDER BY bid ASC
					LIMIT :start, :stop");
			$data->bindValue(1, intval(trim($start)), PDO::PARAM_INT);
			$data->bindValue(2, intval(trim($stop)), PDO::PARAM_INT);
			$data->execute() or die(print_r($data->errorInfo()));
			if($data->rowCount() > 0){
				//$data = $data->fetch(PDO::FETCH_ASSOC); 
				$data = $data->fetchAll();
				return $data; 
			} else { 
				echo "failire";
				return false; }	
		}
		
		function getPrintsFrom($uname){
			$uname = mysql_real_escape_string($uname);
			$data = $this->db->prepare("SELECT user_id FROM user WHERE user_name=:uname ");
			$data->execute(array (':uname' => $uname));
		}


	}