<?php
	ob_start();
	session_start();
	session_regenerate_id();
	require 'conn.php';

	if (isset($_POST['Request'])) {
		$userid = mysqli_real_escape_string($conn, $_POST['user']);
		$applicationid = mysqli_real_escape_string($conn, $_POST['app']);
		$sql = "INSERT INTO Requests(UserID, ApplicationID, Timestamp) VALUES('$userid', '$applicationid', NOW())";
		$result = mysqli_query($conn, $sql);
		if ($conn->query($result) === TRUE) {
			echo 'Boo' . mysqli_error($conn);
		}
		else {
			header('location: profile.php?message=Successfully%20submitted%20a%20request.');
			echo "<script>alert(Successfully submitted a request. If approved, you will receive an e-mail.)</script>";
		}
	
		mysqli_close($conn);
	}
	else {
		echo "<center>Invalid credentials.<br></center>";
		echo "<center><a href=\"index.php\">Click here to login to the account.</a></center>";
		header('location: index.php?message=You%20must%20login%20first.');
	}
?>