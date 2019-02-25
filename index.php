<?php
	ob_start();
	session_start();
	session_regenerate_id();
	if (isset($_SESSION['login_user'])) {
		header('location: profile.php');
	}
	//echo session_id();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    
 <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="LoginPage3Styles.css" /> 

    <title>ACME Profile Page</title>
  </head>
  <body>

 
 <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="blue-oval-png-2.png"/>
            <br>
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="verify.php" method="POST">
                <span id="reauth-email" class="reauth-email"></span>


<div class="input-group input-group-lg">
                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="email" name="Email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
            </div>
<br>


<div class="input-group input-group-lg">
                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" name="Password" id="inputPassword" class="form-control" placeholder="Password" required>
            </div>


                <div id="remember" class="checkbox">
                    <br>
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin, float" name="Submit" value="Submit" type="submit">Sign in</button>
            </form><!-- /form -->
            <br>
            <a href="password.php" class="forgot-password">
                Forgot the password?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>


</html>




