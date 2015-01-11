<div class="login-page">
<h2>Register New Account</h2>
 <?php 
 Session::init();

  $error = Session::get('error');
   if(isset($error)){
   	echo "<p>".$error."</p>";
   }
 ?>
      <form id="reg-form" action="<?php echo URL; ?>login/reg" method="post" class="form-horizontal">
        <div class="control-group">
        	<label class="control-label" for="email" >Email address:</label>
       		<div class="controls"><input type="email" id="email" class="form-control" placeholder="Email address" name="email" required autofocus></div>
        </div>
        <div class="control-group">
        	<label class="control-label" for="login" >Username:</label>
        	<div class="controls"><input type="text" id="login" class="form-control" placeholder="Username" name="login" required autofocus></div>
        </div>
        <div class="control-group">
        	<label class="control-label" for="password1" class="sr-only">Password:</label>
        	<div class="controls"><input type="password" id="password1" class="form-control" placeholder="Password" name="password1" required></div>
        	<label class="control-label" for="inputPassword">Confirm Password:</label>
        	<div class="controls"><input type="password" id="password2" class="form-control" placeholder="Password ... again"  name="password2" required></div>
        </div>       
		 <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me">I would like email notifications
          </label>
        </div> 
		<div class="row"><div class="span12"> <button class="btn btn-lg btn-primary " type="submit">Register</button></div> </div>
      </form>
</div>
