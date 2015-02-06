<?php 
 /*
  * Controller page for Upload page.
  */

class Upload extends Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ){
			if ( 0 < $_FILES['fileupload']['error'] ) {
	        	$status = 'Bad request!';
	    	}
	    	else {
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
	    $UploadDirectory    	= 'file_upload/uploads/'; 	// ends with / (slash)
	    $DownloadDirectory		= 'downloads/';
	    // ###### SETTINGS ######
	    
	    
	    header('Content-Type: text/plain; charset=utf-8');
	    try {
	    		
			if (!isset($_FILES['fileupload']['error']) || is_array($_FILES['fileupload']['error'])) {
		        throw new RuntimeException('Invalid parameters.');
		    }
		
		    // Check $_FILES['fileupload']['error'] value.
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
			
			
		
		    $File_Name          = $this->filterThis(strtolower($_FILES['fileupload']['name']));
		    $File_Ext           = end((explode(".", $File_Name))); //get file extention
		    //$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
		    $Random_Number      = rand(0, 9999); //Random number to be added to name.
		    $UploadDest			= AWR .$UploadDirectory.$Random_Number.$File_Ext;
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
    			$title = $this->filterThis($_POST['title']);
    			$desc = $this->filterThis($_POST['desc']);
    			$userID = $this->filterThis($userID);
    			
    			$blueprintID = $this->model->insertBlue($title,$desc,$userID); 
    			// returns the newly created blueprint ID
    			//[BlueprintID][FileID].png
    			// holy shit
    			
    			//filename extention should all ready be in lower case by now
    			/*if($File_Ext  == "jpg" || "gif" || "bmp")
    			{
    				//convert the iamge to a png if its jpg
    				$imageObject = imagecreatefromjpeg($UploadDest);
					//imagegif($imageObject, $imageFile . '.gif');
					
    				$UploadDest			= AWR .$UploadDirectory.$Random_Number. '.png';
    				$File_Ext = 'png';
					imagepng($imageObject, $UploadDest);
					
					//imagewbmp($imageObject, $imageFile . '.bmp');
    				
    			}
    			
    			if($File_Ext  == "csv"){
    				//generate an image with the CSV i guess?
    			}*/

				
				// moves the file, renames it for download folder
				$grandfilename = $this->hashbrown($userID.$blueprintID).".".$File_Ext;
				
				
				rename($UploadDest, AWR .$DownloadDirectory.$grandfilename);
    			// writes file location into the database
				$returnedID = $this->model->insertFile($blueprintID,$grandfilename);
    			
    			//if(!isset($returnedID) && $returnedID >0){
    				header('Location: '.URL."browse/");
    			//}
    			
      		}
		} catch (RuntimeException $e) {  echo $e->getMessage();}
	}

	
	public function renameFile(){
		
	}
	
	
	
	/* 
	 * createImage($filename='', $delimiter=',', $title = "inevitable.io")
	 * @Param $filename		where the CSV file is located in the upload directory
	 * @Param $delimiter	field delimiter, the specific boundary partioning the data 
	 * @Param $title		title name of the blueprint, will be put on image
	 */
	
	public function createImage($filename='', $delimiter=',', $title = "Null") {
		//will get a CSV file
		//parse empty space as darkcells
		// ,d, will be a dug out cell
		// auotmatically have a border and add title to bottom
		

		//$csv = array_map('str_getcsv',$delimite, file($filename));
		if(!file_exists($filename) || !is_readable($filename)) {
			 throw new RuntimeException('File is not uploaded, found or readable');
		}
				$Data = str_getcsv($CsvString, "\n"); //parse the rows 
		foreach($Data as &$Row) $Row = str_getcsv($Row, $delimiter); // parse the data
		
		//Render array into image
		//X = width of CSV, 
		$x = count($Data); // no joke, it was that easy
		$y = count($Data[2]);
		//var_dump(gd_info());
		
		//$Data should be  Arrays in arrays full of the data
		//http://php.net/str_getcsv
		$gd = imagecreatetruecolor($x, $y)or die('Cannot Initialize new GD image stream'); //$x = width $y = height
		imagesavealpha($gd, true); 
		$tcolor = imagecolorallocatealpha($gd, 0, 0, 0, 127);
		imagefill($gd, 0, 0, $tcolor);//makes background transparent 
		
		//Vherid like color scheme (seriously such bad ass colors) 
		$darkcolor = imagecolorallocate($gd , 48, 43, 47); //302B2F Dark
		$digcolor = imagecolorallocate($gd , 105, 97, 83); //696153 dug out area
		$staircolor = imagecolorallocate($gd , 255, 214, 151); //FFD697 stairs
		$textcolor = imagecolorallocatealpha($gd , 255, 166, 0, 32); // #FFA600 assign a color for the text  
		
		//imagesetpixel ( resource $image , int $x , int $y , int $color )
		//
		$xcount;
		foreach($Data as &$row ){
			foreach( $row as &$event ){
				if($event == 'd') {
					imagesetpixel($gd,$x, $y, $digcolor );
				}
			}
		}

		imagestring($gd, 1, 5, 5,  $title, $textcolor); // sets the title to the upper left of the image, assign color
		imagepng($gd); // makes the image
		//imagedestroy($gd);
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