<?php
	ob_start();
	session_start();
	session_regenerate_id();
	require 'conn.php';

	if (isset($_POST['Deny']) && ($_SESSION['Role'] == "Admin" || strpos($_SESSION['Permissions'], '5') === true)) {
		$action = 10;
		$userid =  mysqli_real_escape_string($conn, $_SESSION['UserID']);
		$user = mysqli_real_escape_string($conn, $_POST['user']);
		$app = mysqli_real_escape_string($conn, $_POST['app']);
		$permission = mysqli_real_escape_string($conn, $_POST['permission']);
		$sql = "INSERT INTO Audit(UserID, ActionID, Timestamp) VALUES('$userid', '$action', NOW())";
		$sql2 = "DELETE FROM Requests WHERE UserID = '$user' AND ApplicationID = '$app'";
		$result = mysqli_query($conn, $sql);
		$result2 = mysqli_query($conn, $sql2);
		if ($conn->query($result) === TRUE) {
			echo 'Yay';
			if ($conn->query($result2) === TRUE) {
				echo 'Yes';
			}
			else {
				echo 'No';
			}
		}
		else {
			echo 'Boo';
			header('location: requestspage.php?message=You%20have%20denied%20the%20request.');
		}
	
		mysqli_close($conn);
	}
	else {
		echo "<center>Invalid credentials.<br></center>";
		echo "<center><a href=\"index.php\">Click here to login to the account.</a></center>";
		header('location: requestspage.php?message=Please%20perform%20the%20action%20first.');
	}
?>