<?php
	ob_start();
	session_start();
	session_regenerate_id();
	require 'conn.php';

	if (isset($_POST['Delete']) && $_SESSION['Role'] == "Admin") {
		$action = 5;
		$userid =  $_SESSION['UserID'];
		$table = mysqli_real_escape_string($conn, $_POST['table']);
		$column = mysqli_real_escape_string($conn, $_POST['column']);
		$record = mysqli_real_escape_string($conn, $_POST['record']);
		$sql = "DELETE FROM Users WHERE UserID = $record";
		$sql2 = "INSERT INTO Audit(UserID, ActionID, Timestamp) VALUES('$userid', '$action', NOW())";
		$result2 = mysqli_query($conn, $sql2);
		if (mysqli_query($conn, $sql)) {
			echo 'Yay';
		}
		else {
			echo 'Boo' . mysqli_error($conn);
		}
	
		header('location: searchpageplus.php?message=Sucessfully%20deleted%20user.');
	
		mysqli_close($conn);
	}
	else {
		echo "<center>Invalid credentials.<br></center>";
		echo "<center><a href=\"index.php\">Click here to login to the account.</a></center>";
		header('location: index.php?message=You%20must%20sign%20in%20first.');
	}
?>