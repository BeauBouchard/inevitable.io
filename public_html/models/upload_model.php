<?php

	class Upload_Model extends Model{
		
		function __construct() {
			parent::__construct();
		}
		
		/*
		 * createBlueprint
		 * 		@param	string		$title 		- varchar(64)
		 * 		@param	string		$desc		- varchar(200)
		 * 		@param	int 		$userID		- The foreign key to map blueprint to Users
		 * 		@param	string		$location	- The temp location of the file to add
		 * 		@return mixed	- returns either the 'blueprint' last ID of insert, or false if failed
		 */
		function createBlueprint($title,$desc,$userID,$filelocation){
			$title = mysql_real_escape_string($title);
			$desc = mysql_real_escape_string($desc);
			
			$blueprintID = insertBlue($title,$desc,$userID);
			
			$fileID = insertFile($blueprintID,$filelocation);
		}
		
	
		function createTag(){
			// check to see if tag exists:
			$checkTag;
			//add new tag since if doesn't exist
		}
		
		/*
		 * insertBlue
		 * 		@param	string		$title 	- varchar(64)
		 * 		@param	string		$desc	- varchar(200)
		 * 		@param	int 		$userID	- The foreign key to map blueprint to Users
		 * 		@return mixed	- returns either the 'blueprint' last ID of insert, or false if failed
		 */
		function insertBlue($title,$desc,$userID){
			$newBlue = $this->db->prepare("INSERT INTO blueprint (blueprint_title, blueprint_desc, user_id) VALUES ( :title, :desc, :userID)");
			$newBlue->execute(array (':title' => $title, ':desc' => $desc, ':userID' => $userID));
			$id =	$this->db->lastInsertId();
			if($id){
				return $id;
        	} else {
        		// failed because the id was not returned
        		return false;
        	}
		}
		
		/*
		 * insertFile
		 * 		@param	int		$blueID 	- The blueprintID of the project that the file is associated with.
		 * 		@param	string	$location	- The temp location of the file to add
		 * 		@return mixed	- returns either the blueprint_files last ID of insert, or false if failed
		 */
		function insertFile($blueID,$location){
			$newFile = $this->db->prepare("INSERT INTO blueprint_files ( blueprint_id, file_location) VALUES( :blueID, :location)");
			$newFile->execute(array (':blueID' => $blueID, ':location' => $location));
			$id =	$this->db->lastInsertId();
			if($id){
				return $id;
        	} else {
        		// failed because the id was not returned
        		return false;
        	}
		}
		
		/*
		 * insertTag
		 * 		@param	string	$tag	- the tag to add
		 * 		@return mixed	- returns either the 'tag' last ID of insert, or false if failed
		 */
		function insertTag( $tag ){
			$tag 	=  mysql_real_escape_string($tag);
			$newTag = $this->db->prepare("INSERT INTO tag ( tag_content) VALUES( :tag )");
			$newTag->execute(array (':tag' => $tag));
			$id =	$this->db->lastInsertId();
			if($id){
				return $id;
        	} else {
        		// failed because the id was not returned
        		return false;
        	}
		}
		
		/*
		 * insertTagLink
		 * 		@param	int		$blueID 	- The blueprintID of the project that the file is associated with.
		 * 		@param	int		$tagID		- The tagID of the tag that the tag is describing.
		 * 		@return mixed	- returns either the blueprint_tags last ID of insert, or false if failed
		 */
		function insertTagLink($blueID, $tagID){
			$newTagLink = $this->db->prepare("INSERT INTO blueprint_tags ( tag_id, blueprint_id) VALUES( :tagID, :blueID )");
			$newTagLink->execute(array (':tagID' => $tagID, ':blueID' => $blueID));
			$id =	$this->db->lastInsertId();
			if($id){
				return $id;
        	} else {
        		// failed because the id was not returned
        		return false;
        	}
		}
		

		
		function insertFileArray($filelocations){
			// later i would like to have an array ()
		}
		
		function insertTagArray(){
			
		}
		
	
		
		
		

		
		function renameFile() {
			
		}
	}