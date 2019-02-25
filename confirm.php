<?php
	ob_start();
	session_start();
	session_regenerate_id();
	require 'sql_helper.php';

	if (isset($_POST['submit'])) {
		$email = mysqli_real_escape_string($conn, $_POST['Email']);
		$action = 8;
		$sql = "SELECT UserID FROM Users WHERE Email = '$email'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_row($result);
		$userid = $row[0];
		$sql2 = "INSERT INTO Audit(UserID, ActionID, Timestamp) VALUES('$userid', '$action', NOW())";
		if (mysqli_num_rows($result) == 1) {
			echo "Success!";
			$result2 = mysqli_query($conn, $sql2);
			header('refresh:1 url=index.php');
		}
		else {
			echo "Invalid email address. Not found.";
			header('refresh:1 url=password?message=Invalid%20credentials.');
		}
    }
?>