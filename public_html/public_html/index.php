<?php
	/*
	 * Author: Beau Bouchard (@beaubouchard)
	 * a simple MVC for small website
	 * 
	 */
	
	require 'libs/Bootstrap.php';
	require 'libs/Controller.php';
	require 'libs/Model.php';
	require 'libs/View.php';
	require 'libs/Database.php';
	require 'libs/Session.php';
	
	require 'config/paths.php';
	require 'config/database.php';
	
	
	$app = new BootStrap();