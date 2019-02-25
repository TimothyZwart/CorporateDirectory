<?php
	ob_start();
    session_start();
	session_regenerate_id();
	//unset($_SESSION["Request"]);
	//echo session_id();
	//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="InvalidCredentialsStyles.css"/>

    <title>ACME Error Page</title>

  </head>
  <body>

    <div class="container">
        <img id="profile-img" class="profile-img-card" src="blue-oval-png-2.png"/>
        <div class="jumbotron jumbotron-fluid">
            <label>
            <h1 id="Oops" > Oops! </h1> 
            <p id="InvalidCredentials"> You do not have access to this page. </p>
            </label>
			<form action="requestaccess.php" method="POST">
				<input type="hidden" name="user" value="<?php echo $_SESSION['UserID']?>">
				<input type="hidden" name="app" value="<?php echo $_SESSION['Request']?>">
                <button id ="Button" class="btn btn-lg btn-primary btn-block btn-signin, float" type="submit" name="Request">Request Access</button>
			</form>
		</div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>


</html>




