<h2>Browse</h2>
<?php 
	/*
	 * 	blueprint.blueprint_id as 'bid',
	 * 	user.user_id		   as 'uid',
	 * 	user.user_name		   as 'uname',
	 * 	blueprint_title		   as 'title',
	 * 	blueprint_desc   	   as 'desc',
	 * 	file_location  		   as 'location'
	 */
	if(isset($this->printList) && count($this->printList) == 1){
		echo "<img src='".URL. "downloads/".$this->printList['location']."' class='img-rounded' alt='Rounded Image' />";
	} else if (isset($this->printList) && count($this->printList) > 1){
		foreach($this->printList as $key => $value){
			
		}
	} else {
		
	}


?>