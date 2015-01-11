<?php

	class Upload_Model extends Model{
		
		function __construct() {
		
		}
		
		function createBlueprint($title,$desc,$userID,$filelocation){
			$title = mysql_real_escape_string($title);
			$desc = mysql_real_escape_string($desc);
			
			$blueprintID = insertBlue($title,$desc,$userID);
			
			insertFile($blueprintID,$filelocation);
		}
		
		function insertFileArray($filelocations){
			// later i would like to have an array ()
		}
		
		function insertTagArray(){
			
		}
		
		function insertBlue($title,$desc,$userID){
			$newBlue = $this->db->prepare("INSERT INTO blueprint (blueprint_title, blueprint_desc, user_id) VALUES ( :title, :desc, :userID)");
			$newBlue->execute(array (':title' => $title, ':desc' => $desc, ':userID' => $userID));
			return $this->db->lastInsertId();
		}
		
		function insertFile($blueID,$location){
			 $newFile = $this->db->prepare("INSERT INTO blueprint_files ( blueprint_id, file_location) VALUES( :blueID, :location)");
			 $newFile->execute(array (':blueID' => $blueID, ':location' => $location));
		}
		
		function insertTag($blueprintID, $tagID ){
			//INSERT INTO `blueprint_tags` (`bt_id`, `tag_id`, `blueprint_id`) VALUES
			//(1, 1, 1),
			//(2, 2, 1);
			
		}
	}