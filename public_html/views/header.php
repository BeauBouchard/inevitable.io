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
        <?php /* Additional Styles ---- */ 
        				
        ?>
    </head>
    <body>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo URL; ?>">inevitable.io</a>
        </div>
        <div id="navbar" >
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo URL; ?>">Home</a></li>
				<li><a href="<?php echo URL; ?>browse/">Browse</a></li>
				<li><a href="<?php echo URL; ?>about/">About</a></li>
				<li><a href="<?php echo URL; ?>login/">Login</a></li>
            </ul>
            
        </div><!--/.nav-collapse -->
      </div><!--/container -->
    </nav>
		<div class="container">