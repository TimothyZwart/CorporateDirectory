<?php
	ob_start();
    session_start();
	session_regenerate_id();
	require 'conn.php';
	if (!isset($_SESSION['login_user'])) {
		header('location: index.php?message=You%20must%20sign%20in%20first.');
		header("Refresh:0");
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	<?php 
	if ($_SESSION['login_user']) {
		echo "<title>".$_SESSION['FirstName']."'s Edit Profile Page</title>";
	}
	else {
		echo "<title>Edit Profile Page</title>";
	}
	?>

  </head>
  <body>
    <?php
	if ($_SESSION['login_user']) {
		if (isset($_SESSION['Picture'])) {
			$picture = $_SESSION['Picture'];
		}
		else {
			$picture = "avatar.png";
		}
	}
	?>
	<div class="container-fluid mx-auto px-0">
		<?php require "nav.php"; ?>
		<div class="container-fluid mx-auto px-0 py-2 bg-info">
			<img src="blue-oval-png-2.png" class="img-fluid mx-auto d-block" alt="Responsive image" style="max-width: 300px;">
		</div>
		
		<div class="container-fluid mx-auto px-0 bg-info mt-0 py-2">
			<div class="container-fluid mx-auto px-0 pt-0 bg-info mt-0">
				<div class="row mt-0 mx-auto justify-content-center pt-0 bg-info">
						<div class="col-sm-10 ml-0 pr-5 bg-light text-right pb-0 pt-3">
						
						</div>
					</div>
				<div class="row mt-0 mx-auto justify-content-center pt-0 bg-info">
					<div class="col-md-6 col-sm-10 mx-0 bg-light text-center pb-5 pt-3">
						<form action="updateemployee.php" method="POST" enctype="multipart/form-data">
							<img src="ProfilePictures/<?php echo $picture; ?>" class="img-fluid mx-auto d-block rounded-circle" name="Picture" alt="Responsive image" style="width: 256px; height: 256px;">
							<div class="form-row pt-3">
								<label style = "font-size: 1.9em; font-weight: bold;" for="exampleFormControlFile1" class="col-sm-3">Change Profile:</label>
									<input type="file" class="form-control-file col-sm-9" name="picture" accept="image/jpeg, image/jpg, image/png" id="exampleFormControlFile1">
							</div>
					</div>
					<div class="col-md-4 col-sm-10 mx-0 bg-light text-left pb-0">
							<p style = "font-size: 1.9em; font-weight: bold;"> <u>ACME Titles:</u> </p>
						<div class="row">
							<div class="col-sm-6  col-md-12 mx-0">
							<p style = "font-size: 1.5em; font-style: italic; font-weight:bold;"> Department:</p>
							<p style = "font-size: 1.2em; font-style: italic;"> *
							<?php 
							if ($_SESSION['Role'] != "Employee" && strpos($_SESSION['Permissions'], '3') !== false) {
								echo "<select class='custom-select d-block w-100' id='Department' name='Department' required>
								<option value=''>Choose...</option>";
								  $sql = "SELECT * FROM Departments";
								  $filter = mysqli_query($conn, $sql);
								  $menu = "";

								  while ($row = mysqli_fetch_array($filter)) {
									  $menu .= "<option value=".$row['DepartmentID'].">" .$row['Name']. "</option>"; 
								  }
									
								  echo $menu;
								  echo "</select>";
							}
							else {
								echo $_SESSION['Department']; 
							}
							?> 
							</p>
							</div>
							<div class="col-sm-6 col-md-12 mx-0">
							<p style = "font-size: 1.5em; font-style: italic; font-weight: bold;"> Role:</p>
							<p style = "font-size: 1.2em; font-style: italic; "> * 
							<?php 
							if ($_SESSION['Role'] != "Employee" && strpos($_SESSION['Permissions'], '3') !== false) {
								echo "<select class='custom-select d-block w-100' id='Role' name='Role' required>
								<option value=''>Choose...</option>";
								  if ($_SESSION["Role"] != "Admin") {
									  $sql = "SELECT * FROM Roles WHERE RoleID != 3";
								  }
								  else {
									  $sql = "SELECT * FROM Roles";
								  }
								  $filter = mysqli_query($conn, $sql);
								  $menu = "";

								  while ($row = mysqli_fetch_array($filter)) {
									  $menu .= "<option value=".$row['RoleID'].">" .$row['Name']. "</option>";
								  }
									
								  echo $menu;
								  echo "</select>";
							}
							else {
								echo $_SESSION['Role']; 
							}
							?> </p>
							</div>
							<div class="col-sm-12 col-md-12 mx-0">
							<p style = "font-size: 1.5em; font-style: italic; font-weight: bold;"> City:</p>
							<p style = "font-size: 1.2em; font-style: italic;"> * 
							<?php
							if ($_SESSION['Role'] != "Employee" && strpos($_SESSION['Permissions'], '3') !== false) {
								echo "<select class='custom-select d-block w-100' id='City' name='City' required>
								<option value=''>Choose...</option>";
								  $sql = "SELECT * FROM Locations";
								  $filter = mysqli_query($conn, $sql);
								  $menu = "";

								  while ($row = mysqli_fetch_array($filter)) {
									  $menu .= "<option value=".$row['LocationID'].">" .$row['City']. "</option>";
								  }
									
								  echo $menu;
								  echo "</select>";
							}
							else {
								echo $_SESSION['City']; 
							}
							?> 
							</p>
							</div>
							<div class="col-sm-12 col-md-12 mx-0">
							<p style = "font-size: 1.5em; font-style: italic; font-weight: bold;"> Team:</p>
							<p style = "font-size: 1.2em; font-style: italic;"> * 
							<?php
							if ($_SESSION['Role'] != "Employee" && strpos($_SESSION['Permissions'], '3') !== false) {
								echo "<select class='custom-select d-block w-100' id='Team' name='Team' required>
								<option value=''>Choose...</option>";
								  $sql = "SELECT * FROM Teams";
								  $filter = mysqli_query($conn, $sql);
								  $menu = "";

								  while ($row = mysqli_fetch_array($filter)) {
									  $menu .= "<option value=".$row['TeamID'].">" .$row['Team']. "</option>";
								  }
									
								  echo $menu;
								  echo "</select>";
							}
							else {
								echo $_SESSION['Team']; 
							}
							?> 
							</p>
							</div>
						</div>
				</div>
			</div>
				<div class="row mt-0 mx-auto justify-content-center">
					<div class="col-sm-10 mx-0 bg-light text-left pb-3">
					<p style = "font-weight: bold; font-size: 1.9em;"> <u>Contact Info:</u> </p>
					<div class="row">
						<div class="col-sm">
							<p style = "font-weight: bold; font-style: italic; font-size: 1.2em;"> Email: </p>
							<p style = "font-size: 1.2em"> Personal: 
							<?php 
							if ($_SESSION['Role'] == "Admin" && strpos($_SESSION['Permissions'], '3') !== false) {
								echo "<input type=email class=form-control col-sm-10 id=exampleFormControlInput1 placeholder=".$_SESSION['Email']." name=Email value=".$_SESSION['Email']." required>";
							}
							else {
								echo $_SESSION['Email']; 
							}
							?>
							</p>
						</div>
						<div class="col-sm">
							<p style = "font-weight: bold; font-style: italic; font-size: 1.2em;"> Cell: </p>
						<div class="form-row">
							<label for="exampleFormControlInput1" class="col-sm-2">Personal:</label>
							<input type="text" class="form-control col-sm-10" id="exampleFormControlInput1" placeholder="<?php echo $_SESSION['Phone']; ?>" name="Phone" value="<?php echo $_SESSION['Phone']; ?>" pattern='(?=.*\d).{10}' required>
						</div>
						</div>
					</div>
					<div class="text-center pt-3">
					<button type="submit" name="submit" class="btn btn-primary">Submit & Verify</button>
					</div>
					</div>
				</div>
				
			</div>
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