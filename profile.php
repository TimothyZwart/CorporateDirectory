<?php
	ob_start();
    session_start();
	session_regenerate_id();
	unset($_SESSION["Request"]);
	//echo session_id();
	/*var_dump($_SESSION);
	if (strpos($_SESSION['Permissions'], '6') !== false) {
		echo 'true';
	}
	else {
		echo 'false';
	}*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<?php 
	if ($_SESSION['login_user']) {
		echo "<title>".$_SESSION['FirstName']."'s Profile Page</title>";
	}
	else {
		echo "<title>Profile Page</title>";
	}
	?>
  </head>
  <body class='bg-info'>
  <?php
	if ($_SESSION['login_user']) {
		if (isset($_SESSION['Picture'])) {
			$picture = $_SESSION['Picture'];
		}
		else {
			$picture = "avatar.png";
		}
		require "nav.php";
		echo "<div class='container-fluid mx-auto px-0'>
			<div class='container-fluid mx-auto px-0 py-2 bg-info'>
				<img src='blue-oval-png-2.png' class='img-fluid mx-auto d-block' alt='Responsive image' style='max-width: 300px;'>";
		echo "</div>
			<div class='container-fluid mx-auto px-0 bg-info mt-0 py-2'>
				<div class='container-fluid mx-auto px-0 pt-0 bg-info mt-0'>
					<div class='row mt-0 mx-auto justify-content-center pt-1 bg-info'>
							<div class='col-sm-10 ml-0 pr-5 bg-light text-right pb-0 pt-3'>
							<a href='editprofile.php'><button type='button' class='btn btn-outline-dark bg-success'>Edit Profile</button></a>
							</div>
						</div>
					<div class='row mt-0 mx-auto justify-content-center pt-0 bg-info'>
						<div class='col-md-6 col-sm-10 mx-0 bg-light text-center pb-5' >
	                       <img src='ProfilePictures/{$picture}' class='img-fluid mx-auto d-block rounded-circle' alt='Responsive image' style='width: 256px; height: 256px;'>
						</div>
						<div class='col-md-4 col-sm-10 mx-0 bg-light text-left pb-1'>
								<p style = 'font-size: 1.9em; font-weight: bold;'> ".$_SESSION['FirstName']. " " .$_SESSION['LastName']. " </p>
							<div class='row'>
								<div class='col-sm-6  col-md-12 mx-0'>
								<p style = 'font-size: 1.5em; font-style: italic; font-weight:bold;'> Department:</p>
								<p style = 'font-size: 1.2em; font-style: italic;'> ".$_SESSION['Department']." </p>
								</div>
								<div class='col-sm-6 col-md-12 mx-0'>
								<p style = 'font-size: 1.5em; font-style: italic; font-weight: bold;'> Role:</p>
								<p style = 'font-size: 1.2em; font-style: italic;' > ".$_SESSION['Role']." </p>
								</div>
								<div class='col-sm-12 col-md-12 mx-0'>
								<p style = 'font-size: 1.5em; font-style: italic; font-weight: bold;'> City:</p>
								<p style = 'font-size: 1.2em; font-style: italic;'> ".$_SESSION['City']." </p>
								</div>
								<div class='col-sm-12 col-md-12 mx-0'>
								<p style = 'font-size: 1.5em; font-style: italic; font-weight: bold;'> Team:</p>
								<p style = 'font-size: 1.2em; font-style: italic;'> ".$_SESSION['Team']." </p>
								</div>
							</div>
						</div>
					</div>
				</div>";
				echo "<div class='row mt-0 mx-auto justify-content-center'>
						<div class='col-sm-10 mx-0 bg-light text-left pb-0'>
						<p style = 'font-weight: bold; font-size: 1.9em;'> <u>Contact Info:</u> </p>
						<div class='row'>
							<div class='col-sm'>
								<p style = 'font-weight: bold; font-style: italic; font-size: 1.2em;'> Email: </p>
								<p style = 'font-size: 1.2em'> ".$_SESSION['Email']." </p>
							</div>
							<div class= 'col-sm'>
								<p style = 'font-weight: bold; font-style: italic; font-size: 1.2em;'> Cell: </p>
								<p style = 'font-size: 1.2em'> ".$_SESSION['Phone']." </p>
							</div>
					</div>";
			echo	"</div>
			</div>
		</div>";
		//echo "<div class='row mt-0 mx-auto justify-content-center pt-0'>&nbsp<a href=logout.php>Logout</a>\n";
	}
	else {
		echo "<center>No user has signed in! Please <a href=index.php>login!</a></center>";
		header('location: index.php?message=You%20must%20sign%20in%20first.');
		header("Refresh:0");
	}
	?>
	

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>