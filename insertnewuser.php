<?php
	ob_start();
	session_start();
	session_regenerate_id();
	require 'conn.php';

	if (isset($_POST['submit'])) {
    		
			$firstname = mysqli_real_escape_string($conn, $_POST['FirstName']);
			$lastname = mysqli_real_escape_string($conn, $_POST['LastName']);
			$email = mysqli_real_escape_string($conn, $_POST['Email']);
			$phone = mysqli_real_escape_string($conn, $_POST['Phone']);
			$department = mysqli_real_escape_string($conn, $_POST['Department']);
			$role = mysqli_real_escape_string($conn, $_POST['Role']);
			$location = mysqli_real_escape_string($conn, $_POST['Location']);
			$team = mysqli_real_escape_string($conn, $_POST['Team']);
			$password = mysqli_real_escape_string($conn, $_POST['Password']);
			$picture = 'avatar.png';
			$seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789');
			shuffle($seed);
			$userhash = '';
			foreach (array_rand($seed, 32) as $k) {
				$userhash .= $seed[$k];
			}
			$action = 3;
			$userid = $_SESSION['UserID'];
			
			$sql = "INSERT INTO Users(FirstName, LastName, Email, UserHash, Phone, LocationID, DepartmentID, RoleID, TeamID, Picture) 
				VALUES('$firstname', '$lastname', '$email', '$userhash', '$phone', '$location', '$department', '$role', '$team', '$picture')";
			$sql2 = "INSERT INTO Passwords(UserHash, Password, DateChanged, ExpireTime) VALUES('$userhash', SHA1('$password'), NOW(), NOW() + INTERVAL 90 DAY)";
			$sql3 = "INSERT INTO Audit(UserID, ActionID, Timestamp) VALUES('$userid', '$action', NOW())";
			
    		
    		$result = mysqli_query($conn, $sql);
			$result2 = mysqli_query($conn, $sql2);
			$result3 = mysqli_query($conn, $sql3);
			
			if ($conn->query($result) === TRUE) {
				echo '';
				if ($conn->query($result2) === TRUE) {
					echo '';
					if ($conn->query($result3) === TRUE) {
						echo '';
					}
					else {
						echo 'Nope';
					}
				}
				else {
					echo 'No';
				}
			}
			else {
				echo '';
			}
			$sql4 = "SELECT MAX(UserID) AS UserID, RoleID FROM Users";
			$result4 = mysqli_query($conn, $sql4);
			$row = mysqli_fetch_row($result4);
			$maxid = $row[0];
			$sql5 = "SELECT UserID, RoleID FROM Users WHERE UserID='$maxid'";
			$result5 = mysqli_query($conn, $sql5);
			$row2 = mysqli_fetch_row($result5);
			$roleid = $row2[1];
			if ($roleid == 1) {
				$sql6 = "INSERT INTO hasPermissions(UserID, PermissionID, ApplicationID) VALUES('$maxid', '1', '1'),
				('$maxid', '7', '7'),('$maxid', '8', '8')";
				$result6 = mysqli_query($conn, $sql6);
			}
			else if ($roleid == 2) {
				$sql6 = "INSERT INTO hasPermissions(UserID, PermissionID, ApplicationID) VALUES('$maxid', '1', '1'),
				('$maxid', '3', '3'),('$maxid', '4', '4'),('$maxid', '7', '7'),('$maxid', '8', '8')";
				$result6 = mysqli_query($conn, $sql6);
			}
			else {
				$sql6 = "INSERT INTO hasPermissions(UserID, PermissionID, ApplicationID) VALUES('$maxid', '1', '1'),
				('$maxid', '2', '2'),('$maxid', '3', '3'),('$maxid', '4', '4'),('$maxid', '5', '5'),('$maxid', '6', '6'),
				('$maxid', '7', '7'),('$maxid', '8', '8')";
				$result6 = mysqli_query($conn, $sql6);
			}
			echo 'Finished process. Reloading...';
			header('location: createuserpage.php?message=Finished%20process.');
			header("Refresh:0");

    		mysqli_close($conn);
	}
	else {
		echo "<center>Invalid credentials.<br></center>";
		echo "<center><a href=\"index.php\">Click here to login to the account.</a></center>";
		header("location: profile.php?message=You%20do%20not%20have%20access%20to%20this%20page");
	}
?>