<h2>Browse</h2>
<?php 
	//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	error_reporting(0);
	/*
	 * 	blueprint.blueprint_id as 'bid',
	 * 	user.user_id		   as 'uid',
	 * 	user.user_name		   as 'uname',
	 * 	blueprint_title		   as 'title',
	 * 	blueprint_desc   	   as 'desc',
	 * 	file_location  		   as 'location'
	 */
	//print_r($this->printList);
	$this->rowcount =0;
	echo"<div class='container dynamicTile'>";
	if(isset($this->printList) && count($this->printList) == 1){
		echo "<img src='".URL. "downloads/".$this->printList['location']."' class='img-rounded' alt='Rounded Image' />";
	} else if (isset($this->printList) && count($this->printList) > 1){
		foreach( $this->printList  as $row){
			if($this->rowcount==0) {echo "<row>"; } 
				echo "<div class='col-sm-2 col-xs-4'>";
  				echo "<a href='" . URL ."blueprint/".sprintf("%07s", $row[bid])."' class='thumbnail'>";
   				echo "<img src='".URL. "downloads/".$row[location]."' alt='". $row[title] ."' class='img-rounded img-responsive' />";
  				echo "</a>";
				echo "</div>";
				$this->rowcount++;
			if($this->rowcount==3) {echo "</row>";$this->rowcount = 0  ;} 
				
		}
	} else {
		
	}
	echo"</div>";

?>