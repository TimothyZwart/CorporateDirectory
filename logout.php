<?php
    session_start();
	session_regenerate_id();
	require 'conn.php';
	if (isset($_SESSION['login_user'])) {
		$action = 2;
		$userid = $_SESSION['UserID'];
		$sql = "INSERT INTO Audit(UserID, ActionID, Timestamp) VALUES('$userid', '$action', NOW())";
		$result = mysqli_query($conn, $sql);
		if ($conn->query($result) === TRUE) {
			echo 'Yay';
		}
		else {
			echo 'Boo';
		}
	}
    unset($_SESSION['login_user']);
	session_destroy();
    header ("location: index.php?message=You%20are%20logged%20out.");
?>