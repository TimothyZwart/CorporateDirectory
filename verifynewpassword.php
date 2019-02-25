<?php
	ob_start();
	session_start();
	session_regenerate_id();
	require 'sql_helper.php';

	if (isset($_POST['submit'])) {

		$password1 = mysqli_real_escape_string($conn, $_POST['Password1']);
		$password2 = mysqli_real_escape_string($conn, $_POST['Password2']);
		
		if ($password1 != $password2) {
			header('location: changepassword.php?message=Passwords%20do%20not%20match.');
		}
		else {
			$action = 9;
			$email = $_SESSION['Email'];
			$userid = $_SESSION['UserID'];
			$updatepassword = "UPDATE Passwords, Users SET Passwords.Password = SHA1('$password1'), 
			DateChanged = NOW(), ExpireTime = (NOW() + INTERVAL 90 DAY) WHERE Email = '$email' 
			AND Users.UserHash = Passwords.UserHash";
			$sql2 = "INSERT INTO Audit(UserID, ActionID, Timestamp) VALUES('$userid', '$action', NOW())";
			if ($conn->query($updatepassword) === TRUE) {
				echo "Success!";
				$result2 = mysqli_query($conn, $sql2);
				header('refresh:1 url=profile.php');
			}
			else {
				echo "Oops. Something went wrong";
				header('refresh:1 url=changepassword.php');
			}
		}
		mysqli_close($conn);
	}

	else {
		echo "<center>Invalid credentials.<br></center>";
		echo "<center><a href=\"index.php\">Click here to login to the account.</a></center>";
		header('location: login.php?message=You%20must%20sign%20in%20first.');
		header("Refresh:0");
	}
?>