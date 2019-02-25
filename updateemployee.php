<?php
	ob_start();
	session_start();
	session_regenerate_id();
	require 'conn.php';

	if (isset($_POST['submit'])) {
		
		$action = 4;
		$userid = $_SESSION['UserID'];
		
		if ($_SESSION["Role"] != "Employee") {
			if ($_SESSION["Role"] == "Admin") {
				if (isset($_POST['Email'])) {
					$email = mysqli_real_escape_string($conn, $_POST['Email']);
				}
				else {
					$email = $_SESSION['Email'];
				}
				$sql = "UPDATE Users SET Email = '$email' WHERE UserID = ".$_SESSION['UserID']."";
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
			LocationID = ".$city.", TeamID = ".$team." WHERE UserID = ".$_SESSION['UserID']."";
			$result = mysqli_query($conn, $sql);
		}
		
    		
			if (empty($_POST['Phone'])) {
				$phone = $_SESSION['Phone'];
			}
			
			if ($_FILES['picture']['name'] == "") {
				$picture = $_SESSION['Picture'];
			}
			
			if ($_FILES['picture']['name'] != "") {
				$picture = '';
				$temp = $_FILES['picture']['tmp_name'];
				$picture = $_SESSION['UserID'].$_FILES['picture']['name'];
				$path = "ProfilePictures/".$_SESSION['UserID'].basename($_FILES['picture']['name']);
				move_uploaded_file($temp, $path);
			}
			
			if (isset($_POST['Phone'])) {
				$phone = mysqli_real_escape_string($conn, $_POST['Phone']);
			}
			
				
			$sql = "UPDATE Users SET Phone = '$phone', Picture = '$picture' WHERE UserID = ".$_SESSION['UserID']."";
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
			
			$sql3 = "SELECT Departments.Name AS Department, Roles.Name AS Role, Locations.City as City, Teams.Team AS Team
					FROM Users
					INNER JOIN Departments ON Users.DepartmentID = Departments.DepartmentID
					INNER JOIN Roles ON Users.RoleID = Roles.RoleID
					INNER JOIN Locations ON Users.LocationID = Locations.LocationID
					INNER JOIN Teams ON Users.TeamID = Teams.TeamID
					WHERE UserID = ".$_SESSION['UserID']."";
			$result3 = mysqli_query($conn, $sql3);
			$sql4 = "SELECT Email FROM Users WHERE UserID = ".$_SESSION['UserID']."";
			$result4 = mysqli_query($conn, $sql4);
			$row = mysqli_fetch_row($result3);
			$row2 = mysqli_fetch_row($result4);
			$email = $row2[0];
			$department = $row[0];
			$role = $row[1];
			$city = $row[2];
			$team = $row[3];
			$_SESSION['Email'] = $email;
			$_SESSION['Department'] = $department;
			$_SESSION['Role'] = $role;
			$_SESSION['City'] = $city;
			$_SESSION['Team'] = $team;
		
			if ($_FILES['picture']['name'] != "") {
				$_SESSION['Picture'] = $picture;
			}
			if (!empty($_POST['Phone'])) {
				$_SESSION['Phone'] = $phone;
			}
			
			header('location: profile.php');
				
			mysqli_close($conn);
	}
	else {
		echo "<center>Invalid credentials.<br></center>";
		echo "<center><a href=\"index.php\">Click here to login to the account.</a></center>";
		header('location: index.php?message=You%20must%20sign%20in%20first.');
		header("Refresh:0");
	}
?>