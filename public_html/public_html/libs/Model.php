<?php


	class Model {
		function __construct() {
			$this->db = new Database();
			//$this->db->setAttribute(PDO::ATTR_STATEMENT_CLASS, array('MyPDOStatement'));

		}
	}
