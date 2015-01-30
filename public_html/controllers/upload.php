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
	        	$status = 'Bad request!';
	    	}
	    	else {
	       		 //move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);
	       		 $this->upload();
	    	}
		}
		else {
	  		
	  		$this->view->render('upload/index');
		}
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
		 * upload the file
		 * confirm file is uploaded
		 * make thumbnail if needed
		 * if png, make a CSV, if CSV make png
		 * commit
		 * Note :  "memory_limit" or "upload_max_filesize" or "post_max_size" can be set too low in "php.ini".  
		 */
	function upload() {
		

		// ###### SETTINGS ######
		$MaxFileSize 			= 5242880; 					// 5.2Mb
	    $UploadDirectory    	= '/file_upload/uploads/'; 	// ends with / (slash)
	    $DownloadDirectory		= '/downloads/';
	    // ###### SETTINGS ######
	    
	    
	    header('Content-Type: text/plain; charset=utf-8');
	    try {
	    		
			if (!isset($_FILES['fileupload']['error']) || is_array($_FILES['"fileupload"']['error'])) {
		        throw new RuntimeException('Invalid parameters.');
		    }
		
		    // Check $_FILES['upfile']['error'] value.
		    switch ($_FILES['fileupload']['error']) {
		        case UPLOAD_ERR_OK:
		            break;
		        case UPLOAD_ERR_NO_FILE:
		            throw new RuntimeException('No file sent.');
		        case UPLOAD_ERR_INI_SIZE:
		        case UPLOAD_ERR_FORM_SIZE:
		            throw new RuntimeException('Exceeded filesize limit.');
		        default:
		            throw new RuntimeException('Unknown errors.');
		    }
	    
			// check filesize
		    if ($_FILES['fileupload']['size'] > $MaxFileSize) {
		        throw new RuntimeException('File size is too big!');
		    }
		    //http://php.net/manual/en/function.exif-imagetype.php
		    $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
			$detectedType = exif_imagetype($_FILES['fileupload']['tmp_name']);
			$error = !in_array($detectedType, $allowedTypes);
			
			/*
		    $finfo = new finfo(FILEINFO_MIME_TYPE);
		    if (false === $ext = array_search(
		        $finfo->file($_FILES['fileupload']['tmp_name']),
		        array(
		            'jpg' => 'image/jpeg',
		            'png' => 'image/png',
		            'gif' => 'image/gif',
		        		// case 'image/jpeg': 
			            //case 'image/pjpeg':
			            //case 'text/plain':
			            //case 'text/html': //html file
			            //case 'application/x-zip-compressed':
			            //case 'application/pdf':
			            //case 'application/msword':
			            //case 'application/vnd.ms-excel':
			            //case 'video/mp4':
		        ),
		        true
		    )) {
		        throw new RuntimeException('Invalid file format.');
		    }*/
			    
		    $File_Name          = filterThis(strtolower($_FILES['fileupload']['name']));
		    $File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
		    $Random_Number      = rand(0, 9999999999); //Random number to be added to name.
		    $UploadDest			= $UploadDirectory.$Random_Number.$File_Ext;
		    if (file_exists($UploadDirectory. $_FILES['fileupload']['name'])) {
      			echo   " already exists. ";
     		 }
    		else {
		    	if(!move_uploaded_file($_FILES['fileupload']['tmp_name'],  $UploadDest)) {
        			throw new RuntimeException('Failed to move uploaded file.');
    			}
    			
    			
    			Session::init();
    			$userID = Session::get('user_id'); 
				
    			//inserts the title and desc into db
    			$title = $this->filterThis($title);
    			$desc = $this->filterThis($desc);
    			$userID = $this->filterThis($userID);
    			$blueprintID = $this->model->insertBlue($title,$desc,$userID); 
    			// returns the newly created blueprint ID
    			//[BlueprintID][FileID].png
    			// holy shit
    			
    			$grandfilename = $DownloadDirectory.$this->hashbrown($userID.$blueprintID).".".$File_Ext;
    			// writes file location into the database
    			$this->model->insertFile($blueID,$grandfilename);
      		}
		} catch (RuntimeException $e) {  echo $e->getMessage();}
	}

	
	public function renameFile(){
		
	}


	public static function fixGlobalFilesArray($files) {
	        $ret = array();
	
	        if(isset($files['tmp_name'])){
	            if (is_array($files['tmp_name'])){
	                foreach($files['name'] as $idx => $name){
	                    $ret[$idx] = array(
	                        'name' => $name,
	                        'tmp_name' => $files['tmp_name'][$idx],
	                        'size' => $files['size'][$idx],
	                        'type' => $files['type'][$idx],
	                        'error' => $files['error'][$idx]
	                    );
	                }
	            }
	            else {
	                $ret = $files;
	            }
	        }
	        else {
	            foreach ($files as $key => $value) {
	                $ret[$key] = self::fixGlobalFilesArray($value);
	            }
	        }
	        return $ret;
	    }
	}