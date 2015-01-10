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
			//collects data from database to display incase of error
		}
		public function xhrInsert() 
	{
		$text = $_POST['text'];
		
		$sth = $this->db->prepare('INSERT INTO data (text) VALUES (:text)');
		$sth->execute(array(':text' => $text));
		
		$data = array('text' => $text, 'id' => $this->db->lastInsertId());
		echo json_encode($data);
	}
	
	public function xhrGetListings()
	{
		$sth = $this->db->prepare('SELECT * FROM data');
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();
		echo json_encode($data);
	}
	
	public function xhrDeleteListing()
	{
		$id = $_POST['id'];
		$sth = $this->db->prepare('DELETE FROM data WHERE id = "'.$id.'"');
		$sth->execute();
	}
	}