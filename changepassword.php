<?php
	require 'conn.php';
	/*if (!isset($_SESSION['password_user'])) {
		header("location: password.php");
	}*/
	session_start();
	session_regenerate_id();
	if (!isset($_SESSION['login_user'])) {
		header('location: index.php?message=You%20must%20sign%20in%20first.');
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link rel="stylesheet" type="text/css" href="ResetPasswordStyles.css" /> 

    <title>Change Password</title>
  </head>
  <body>

 
 <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="blue-oval-png-2.png"/>
            
            <p id="profile-name" class="profile-name-card"></p>
            <form action="verifynewpassword.php" method="POST" class="form-signin">

                <p id="Reset"> Change Password! </p>
                <p id="Reset2"> Follow these steps! </p>
                <br>
                <p id="Reset3"> 1. Password must be at least 8 characters in length.</p>
                <p id="Reset3"> 2. Password must contain 1 uppercase letter. </p>
                <p id="Reset3"> 3. Password must contain 1 lowercase letter. </p>
				<p id="Reset3"> 4. Password must contain 1 number. </p>
                <br>

                <span id="reauth-email" class="reauth-email"></span>

<div class="input-group input-group-lg">
                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" name="Password1" id="inputPassword1" class="form-control" placeholder="Password" title="Password must be 8 characters including 1 uppercase letter, 1 lowercase letter and numeric characters" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
            </div>
			<br/>
<div class="input-group input-group-lg">
                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" name="Password2" id="inputPassword2" class="form-control" placeholder="Password" title="Password must be 8 characters including 1 uppercase letter, 1 lowercase letter and numeric characters" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
            </div>
            
                <br/>
                <button class="btn btn-lg btn-primary btn-block btn-signin, float" type="submit" name="submit">Change Password</button>
                
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