<?php 
 /*
  * Controller page for Upload page.
  */

class Upload extends Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' )
		{
			if ( 0 < $_FILES['file']['error'] ) {
	        	//echo 'Error: ' . $_FILES['file']['error'] . '<br>';
	    	}
	    	else {
	       		 //move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
	    	}
		}
		else {
	  		$status = 'Bad request!';
	  		$this->view->render('upload/index');
		}
	}
	
	
function index() {
	}
		/*
		 * So, this should be a transaction instead of what I am currently doing.
		 * 1.) upload file, 
		 * 2 	create element for file in table "files", return ID of file.
		 * 3 	create Dir /uploads/[UserID]/ if doesn't exist
		 * 			if file isn't PNG, convert file to PNG
		 * 			imagepng(imagecreatefromstring(file_get_contents($filename)), "output.png");
		 * 4 	Rename file to [BlueprintID][FileID].png
		 * 5	move file to /uploads/[UserID]/[BlueprintID][FileID].png
		 */
	
	/*
	 * incUpload
	 * Expects there to be files uploaded to action='inevitable.io/upload/'
	 * 
	 */
	function incUpload(){
					//upload the file
					//confirm file is uploaded
					//make thumbnail if needed
					//if png, make a CSV, if CSV make png
					//commit
					//
		if(isset($_FILES["FileInput"]) && $_FILES["FileInput"]["error"]== UPLOAD_ERR_OK)
		{
			
			    ############ Edit settings ##############
			    $UploadDirectory    = '/home/website/file_upload/uploads/'; //specify upload directory ends with / (slash)
			    ##########################################
			    
			    /*
			    Note : You will run into errors or blank page if "memory_limit" or "upload_max_filesize" is set to low in "php.ini". 
			    Open "php.ini" file, and search for "memory_limit" or "upload_max_filesize" limit 
			    and set them adequately, also check "post_max_size".
			    */
			    
			    //check if this is an ajax request
			    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			        die();
			    }
			    
			    
			    //Is file size is less than allowed size.
			    if ($_FILES["FileInput"]["size"] > 5242880) {
			        die("File size is too big!");
			    }
			    
			    //allowed file type Server side check
			    switch(strtolower($_FILES['FileInput']['type']))
			        {
			            //allowed file types
			            case 'image/png': 
			            case 'image/gif': 
			           	// case 'image/jpeg': 
			            //case 'image/pjpeg':
			            //case 'text/plain':
			            //case 'text/html': //html file
			            //case 'application/x-zip-compressed':
			            //case 'application/pdf':
			            //case 'application/msword':
			            //case 'application/vnd.ms-excel':
			            //case 'video/mp4':
			                break;
			            default:
			                die('Unsupported File!'); //output error
			    }
			    
			    $File_Name          = strtolower($_FILES['FileInput']['name']);
			    $File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
			    $Random_Number      = rand(0, 9999999999); //Random number to be added to name.
			    $NewFileName        = $Random_Number.$File_Ext; //new file name
			    
			    if(move_uploaded_file($_FILES['FileInput']['tmp_name'], $UploadDirectory.$NewFileName ))
			       {
			        // do other stuff 
			               die('Success! File Uploaded.');
			    }else{
			        die('error uploading File!');
			    }
			    
			}
			else
			{
			    die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
			}
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