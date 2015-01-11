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
			$data = $this->db->prepare("SELECT 
						blueprint.blueprint_id as 'bid',
						user.user_id		   as 'uid',
						user.user_name		   as 'uname',
						blueprint_title		   as 'title',
						blueprint_desc   	   as 'desc',
						file_location  		   as 'location'
					FROM `blueprint`
					INNER JOIN `blueprint_files`
						ON `blueprint`.blueprint_id=`blueprint_files`.blueprint_id 
					JOIN `user` 
   						ON `user`.user_id  = `blueprint`.user_id
					WHERE file_location LIKE '%.png'  LIMIT :start , :stop");
			$data->execute(array (':start' => $start,':stop' => $stop));
					/*	Join statement for returning all */
			
			return $data->fetch(PDO::FETCH_ASSOC); 
			
		}
		
		function getPrintsFrom($uname){
			$uname = mysql_real_escape_string($uname);
			$data = $this->db->prepare("SELECT user_id FROM user WHERE user_name=:uname LIMIT 0 , 5");
			$data->execute(array (':uname' => $uname));
		}


	}