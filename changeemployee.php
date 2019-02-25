<?php
	ob_start();
	session_start();
	session_regenerate_id();
	require 'conn.php';

	if (isset($_POST['submit'])) {
		
		$action = 6;
		$userid = $_SESSION['UserID'];
		$id = $_POST['id'];
		$sql = "SELECT FirstName, LastName, Email, Phone, Picture, Departments.Name AS Department, Roles.Name AS Role, Locations.City as City, Teams.Name AS Team
				FROM Users
				INNER JOIN Departments ON Users.DepartmentID = Departments.DepartmentID
				INNER JOIN Roles ON Users.RoleID = Roles.RoleID
				INNER JOIN Locations ON Users.LocationID = Locations.LocationID
				INNER JOIN Teams ON Users.TeamID = Teams.TeamID
				WHERE UserID = '$id'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_row($result);

		if (!isset($_POST['Email'])) {
			$email = $row[2];
		}
		
		if ($_SESSION["Role"] != "Employee") {
			if ($_SESSION["Role"] == "Admin") {
				if (isset($_POST['Email'])) {
					$email = $_POST['Email'];
				}
				else {
					$email = $row[2];
				}
				$sql = "UPDATE Users SET Email = '$email' WHERE UserID = ".$id."";
				$result = mysqli_query($conn, $sql);
			}
			$array = array('Department', 'Role', 'City', 'Team');
			foreach($array as $field) {
				if(empty($_POST[$field])) {
					$field = $_SESSION[$field];
				}
				else {
					$field = mysqli_real_escape_string($conn, $_POST[$field]);
				}
				echo $field."<br/>";
			}
			$department = mysqli_real_escape_string($conn, $_POST[$array[0]]);
			$role = mysqli_real_escape_string($conn, $_POST[$array[1]]);
			$city = mysqli_real_escape_string($conn, $_POST[$array[2]]);
			$team = mysqli_real_escape_string($conn, $_POST[$array[3]]);
			$sql = "UPDATE Users SET DepartmentID = ".$department.", RoleID = ".$role.", 
			LocationID = ".$city.", TeamID = ".$team." WHERE UserID = ".$id."";
			$result = mysqli_query($conn, $sql);
		}
		
    		
			if (empty($_POST['Phone'])) { 
				$phone = $row[3];
			}
			
			if ($_FILES['picture']['name'] == "") {
				$picture = $row[4];
			}
			
			if ($_FILES['picture']['name'] != "") {
				$picture = '';
				$temp = $_FILES['picture']['tmp_name'];
				$picture = $id.$_FILES['picture']['name'];
				$path = "ProfilePictures/".$id.basename($_FILES['picture']['name']);
				move_uploaded_file($temp, $path);
			}
			
			if (isset($_POST['Phone'])) {
				$phone = mysqli_real_escape_string($conn, $_POST['Phone']);
			}
			
				
			$sql = "UPDATE Users SET Phone = '$phone', Picture = '$picture' WHERE UserID = ".$id."";
			$sql2 = "INSERT INTO Audit(UserID, ActionID, Timestamp) VALUES('$userid', '$action', NOW())";
    		
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
			}
			
			$sql3 = "SELECT Departments.Name AS Department, Roles.Name AS Role, Locations.City as City, Teams.TeamID
					FROM Users
					INNER JOIN Departments ON Users.DepartmentID = Departments.DepartmentID
					INNER JOIN Roles ON Users.RoleID = Roles.RoleID
					INNER JOIN Locations ON Users.LocationID = Locations.LocationID
					INNER JOIN Teams ON Users.TeamID = Teams.TeamID
					WHERE UserID = ".$id."";
			$result3 = mysqli_query($conn, $sql3);
			$sql4 = "SELECT Email FROM Users WHERE UserID = ".$id."";
			$result4 = mysqli_query($conn, $sql4);
			$row2 = mysqli_fetch_row($result3);
			$row3 = mysqli_fetch_row($result4);
			$email = $row3[0];
			$department = $row2[0];
			$role = $row2[1];
			$city = $row2[2];
			$team = $row2[3];
			
			header('location: advancededit.php?message=Successfully%20changed%20employee%20data.');
				
			mysqli_close($conn);
	}
	else {
		echo "<center>Invalid credentials.<br></center>";
		echo "<center><a href=\"index.php\">Click here to login to the account.</a></center>";
		header('location: index.php?message=You%20must%20sign%20in%20first.');
		header("Refresh:0");
	}
?>