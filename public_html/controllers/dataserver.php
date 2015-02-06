<?php
 /*
  * Controller page for DataServer page.
  * Dataserver will be returning ajax / json formatted returns for the front 
  */

class DataServer extends Controller {
	function __construct() {
		parent::__construct();
	}
	
	
	function json() {
		
	}
		
	/* 
	 * Alain Tiemblo's solution to expor CSV from array direct downloads
	 */
	function array2csv(array &$array)
	{
	   if (count($array) == 0) {
	     return null;
	   }
	   ob_start();
	   $df = fopen("php://output", 'w');
	   fputcsv($df, array_keys(reset($array)));
	   foreach ($array as $row) {
	      fputcsv($df, $row);
	   }
	   fclose($df);
	   return ob_get_clean();
	}
	
	/*
	 * autoDownloadHeaders()
	 * @Param $filename 	Reads a file such that it is prompted for download
	 */
	function autoDownloadHeaders($filename) {
		// disable caching
		$now = gmdate("D, d M Y H:i:s");
		header("Expires: Wed, 03 Jul 2019 11:11:00 GMT"); // sorry future
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");
		
		// force download  
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
	
	    // disposition / encoding on response body
		header("Content-Disposition: attachment;filename={$filename}");
		header("Content-Transfer-Encoding: binary");
	}

}
