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
		
		function listPrints($start,$stop) {
			$start = mysql_real_escape_string($start);
			$stop = mysql_real_escape_string($stop);
			//$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//$this->db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
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
					WHERE file_location LIKE '%.png' 
					ORDER BY bid DESC");
			//$data->bindValue(':start', intval(trim($start)), PDO::PARAM_INT);
			//$data->bindValue(':max',intval(trim($stop)), PDO::PARAM_INT);
			//$data->execute(array(':start' => $start, ':max' => $stop));// 
			$data->bindValue(1, intval(trim($start)), PDO::PARAM_INT);
			$data->bindValue(2, intval(trim($stop)), PDO::PARAM_INT);
			$data->execute() or die(print_r($data->errorInfo()));

			//$data = $data->fetch(PDO::FETCH_ASSOC); 
					/*	Join statement for returning all */
			if($data->rowCount() > 0){
				$data = $data->fetch(PDO::FETCH_ASSOC); 
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