<?php
	require 'conn.php';
	/*if (!isset($_SESSION['password_user'])) {
		header("location: password.php");
	}*/
	session_start();
	session_regenerate_id();
	if (!isset($_SESSION['login_user']) && isset($_POST['Submit'])) {
		echo '<script>alert("Your password for your account has expired! Please change it before proceeding.")</script>';
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="ResetPasswordStyles.css" /> 

    <title>Reset Password</title>
  </head>
  <body>

 
 <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="blue-oval-png-2.png"/>
            
            <p id="profile-name" class="profile-name-card"></p>
            <form action="confirm.php" method="POST" class="form-signin">

                <p id="Reset"> Forgot Your Password? </p>
                <p id="Reset2"> Let us help you. </p>
                <br>
                <p id="Reset3"> 1. Type in your ACME email below. </p>
                <p id="Reset3"> 2. Wait for an email from us. </p>
                <p id="Reset3"> 3. Follow instructions to change password. </p>

                <br>

                <span id="reauth-email" class="reauth-email"></span>

                <div class="input-group input-group-lg">
                         <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="email" name="Email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
                </div>
            
            <div id="remember" class="checkbox">
            <br> 
            </div>
                
                <button class="btn btn-lg btn-primary btn-block btn-signin, float" type="submit" name="submit">Request Password Change</button>
                
            </form><!-- /form -->
            <br>
            </div><!-- /card-container -->
        </div><!-- /container -->



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>


</html>






</body>
</html>