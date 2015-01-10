<!DOCTYPE html>
<html>
    <head>
        <title>title</title>

        <!-- Link -->
        <link rel='shortcut icon' href='<?php echo URL; ?>assets/ico/favicon.ico' type='image/x-icon'>
        <link rel='icon' href='<?php echo URL; ?>assets/ico/favicon.ico' type='image/x-icon'>

        <!-- Style -->
        <link href='<?php echo URL; ?>assets/css/bootstrap.css' rel='stylesheet' type='text/css'>
        <link href='<?php echo URL; ?>assets/css/bootstrap-theme.css' rel='stylesheet' type='text/css'>
        <link href='<?php echo URL; ?>assets/css/bootstrap-responsive.css' rel='stylesheet' type='text/css'>
        <link href='<?php echo URL; ?>assets/css/font-awesome.min.css' rel='stylesheet' type='text/css' >
        <link href='<?php echo URL; ?>assets/css/inevitable.io.css' rel='stylesheet' type='text/css' >
      	<!-- Exturnal Style -->
        <link href='http://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Press+Start+2P' rel='stylesheet' type='text/css'>
        <?php /* Additional Styles ---- */ 
        	if(isset($this->css)){
        	    foreach($this->css as $css) {
        			echo "        <link href='".URL."' ?>assets/css/".$css."' rel='stylesheet' type='text/css' >\n";
        		}
        	}			
        ?>
        <!-- Scripts -->
        <script type='text/javascript' src='<?php echo URL; ?>assets/js/jquery.js'></script>
        <script type='text/javascript' src='<?php echo URL; ?>assets/js/header-anim.js'></script>
        <?php /* Additional Scripts ---- */ 
        	if(isset($this->js)){
        		foreach($this->js as $js) {
        			echo "<script type='text/javascript' src='".URL."assets/js/".$js."'></script>";
        		}
        	}	
        ?>

    </head>
    <body>
    <!-- Fixed navbar -->
    <nav id="animate-area" class="navbar navbar-default navbar-nav" style="background-image: url('<?php 
    		echo URL ."assets/media/". $this->bkimage ;
    ?>')">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo URL; ?>">inevitable.io</a>
        </div>
        <div id="navbar" >
          <ul class="nav navbar-nav">
            	<li class="active"><a href="<?php echo URL; ?>">Home</a></li>
				<li><a href="<?php echo URL; ?>browse/">Browse</a></li>
				<li><a href="<?php echo URL; ?>about/">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right pull-right">
            <?php 
            	Session::init();
				$logcheck = Session::get('log');
            /* If the user is logged in, they see a logout button, dashboard link. (dashboard link should be user name / gravatar)*/
            if(isset($logcheck) && $logcheck == true){
            	echo "              <li><a href='" . URL . "dashboard/'>".Session::get('user_name')."</a></li>";
            	echo "              <li><a href='" . URL . "dashboard/logout/'>Log Out</a></li>";
			} else {
				echo "              <li><a href='" . URL . "login/'>Login</a></li>";
			} ?>

            </ul>
              
            
        </div><!--/#navbar -->
      </div><!--/container -->
    </nav>
		<div class="container main-content">