<?php
 /*
  * Controller page for DataServer page.
  * Dataserver will be returning ajax / json formatted returns for the front 
  */

class DataServer extends Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		//$this->view->upload = true;
		//$this->view->render('upload/uploadHandler');
		error_reporting(E_ALL | E_STRICT);
		//require(LIBS.'UploadHandler.php');
		//$upload_handler = new UploadHandler();
		$this->fixGlobalFilesArray()
	
	}
	
	function json() {
		
	}
	
public static function fixGlobalFilesArray($files) {
        $ret = array();

        if(isset($files['tmp_name']))
        {
            if (is_array($files['tmp_name']))
            {
                foreach($files['name'] as $idx => $name)
                {
                    $ret[$idx] = array(
                        'name' => $name,
                        'tmp_name' => $files['tmp_name'][$idx],
                        'size' => $files['size'][$idx],
                        'type' => $files['type'][$idx],
                        'error' => $files['error'][$idx]
                    );
                }
            }
            else
            {
                $ret = $files;
            }
        }
        else
        {
            foreach ($files as $key => $value)
            {
                $ret[$key] = self::fixGlobalFilesArray($value);
            }
        }

        return $ret;
    }
}
