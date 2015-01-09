<div class="login-page">
<h2>Register</h2>
      <form action="login/reg" method="post" class="form-signin">
        <h2 class="form-signin-heading">New Account</h2>
        <label for="inputEmail" class="sr-only">Email address:</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputUsername" class="sr-only">Username:</label>
        <input type="text" id="inputLogin" class="form-control" placeholder="Username" name="login" required autofocus>
        <label for="inputPassword" class="sr-only">Password:</label>
        <input type="password" id="inputPassword1" class="form-control" placeholder="Password" name="password1" required>
        <label for="inputPassword" class="sr-only">Confirm Password:</label>
        <input type="password" id="inputPassword2" class="form-control" placeholder="Password ... again"  name="password2" required>
        
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me">I would like email notifications
          </label>
        </div>
        <button class="btn btn-lg btn-primary " type="submit">Register</button>
      </form>
</div>
