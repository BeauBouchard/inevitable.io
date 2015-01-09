<div class="login-page">
<h2>Login Page</h2>
      <form action="<?php echo URL; ?>login/run" method="post" class="form-signin ">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Username:</label>
        <input type="text" id="inputLogin" class="form-control  text-center" placeholder="Username" name="login" required autofocus>
        <label for="inputPassword" class="sr-only">Password:</label>
        <input type="password" id="inputPassword" class="form-control  text-center" placeholder="Password" name="password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary " type="submit">Sign in</button>
        <p><a href="<?php echo URL; ?>login/register/">Don't have an Account?</a></p>
      </form>
</div>
