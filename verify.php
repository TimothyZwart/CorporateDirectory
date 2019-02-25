<?php
	ob_start();
	session_start();
	session_regenerate_id();
	//echo session_id();
	require 'conn.php';

	if (isset($_POST['Submit'])) {
		if (!empty($_POST['Email']) && !empty($_POST['Password'])) {
    		$email=mysqli_real_escape_string($conn, $_POST['Email']);
    		$password=mysqli_real_escape_string($conn, $_POST['Password']);
			$action = 1;
			$expire="(NOW() - INTERVAL 90 DAY)";
			//$datechanged = "(NOW() - INTERVAL 90 DAY)";
    		
    		$sql = "SELECT UserID, FirstName, LastName, Email, Phone, Picture, Departments.Name AS Department, Roles.Name AS Role, Locations.City as City, Teams.Team AS Team
					FROM Users
                    INNER JOIN Passwords ON Users.UserHash = Passwords.UserHash
					INNER JOIN Departments ON Users.DepartmentID = Departments.DepartmentID
					INNER JOIN Roles ON Users.RoleID = Roles.RoleID
					INNER JOIN Locations ON Users.LocationID = Locations.LocationID
					INNER JOIN Teams ON Users.TeamID = Teams.TeamID
					WHERE Email='$email' AND Password=SHA1('$password') AND ExpireTime >= $expire LIMIT 1";
			$sql2 = "SELECT UserID, FirstName, LastName, Email, Phone, Picture, Departments.Name AS Department, Roles.Name AS Role, Locations.City as City, Teams.Team AS Team
					FROM Users
                    INNER JOIN Passwords ON Users.UserHash = Passwords.UserHash
					INNER JOIN Departments ON Users.DepartmentID = Departments.DepartmentID
					INNER JOIN Roles ON Users.RoleID = Roles.RoleID
					INNER JOIN Locations ON Users.LocationID = Locations.LocationID
					INNER JOIN Teams ON Users.TeamID = Teams.TeamID
					WHERE Email='$email' AND Password=SHA1('$password') AND ExpireTime < $expire LIMIT 1";
    		
    		$result = mysqli_query($conn, $sql);
			$result2 = mysqli_query($conn, $sql2);
			
    		if (mysqli_num_rows($result) === 1) {
					$_SESSION['login_user']=$email;
					$aUser = mysqli_fetch_assoc($result);
					
					$_SESSION['UserID'] = $aUser['UserID'];
					$_SESSION['FirstName'] = $aUser['FirstName'];
					$_SESSION['LastName'] = $aUser['LastName'];
					$_SESSION['Department'] = $aUser['Department'];
					$_SESSION['Role'] = $aUser['Role'];
					$_SESSION['City'] = $aUser['City'];
					$_SESSION['Team'] = $aUser['Team'];
					$_SESSION['Email'] = $aUser['Email'];
					$_SESSION['Phone'] = $aUser['Phone'];
					$_SESSION['Picture'] = $aUser['Picture'];
					
					$userid = $_SESSION['UserID'];
					$_SESSION['Permissions'] = '';
					$sqlqry = "SELECT Users.UserID AS UserID, Permissions.PermissionID AS PermissionID, Applications.ApplicationID AS ApplicationID 
							   FROM hasPermissions 
							   INNER JOIN Users ON hasPermissions.UserID = Users.UserID 
							   INNER JOIN Applications ON hasPermissions.ApplicationID = Applications.ApplicationID 
							   INNER JOIN Permissions ON hasPermissions.PermissionID = Permissions.PermissionID 
							   WHERE hasPermissions.UserID = '$userid'";
					$answer = mysqli_query($conn, $sqlqry);
					while ($row = mysqli_fetch_array($answer)) {
						$_SESSION['Permissions'] .= $row['PermissionID'];
					}
					
					$qry = "INSERT INTO Audit(UserID, ActionID, Timestamp) VALUES('$userid', '$action', NOW())";
					$result2 = mysqli_query($conn, $qry);
					if ($conn->query($result2) === TRUE) {
						echo 'Yay';
					}
					else {
						echo 'Redirecting...';
					}
					
					if ($password == "acme") {
						echo "<script>alert('Please change your password from the default password before proceeding!')</script>";
						header('refresh:0 url=changepassword.php');
					}
					else {
						header('location: profile.php');
					}
    		}
    		else if (mysqli_num_rows($result2) === 1) {
				echo "<script>alert('Your password has expired! Please contact your administrator for more details!')</script>";
				echo "Redirecting...";
				header('refresh:1 url=password.php');
			}
			else {
				echo "<center>Invalid credentials. Refreshing page.</center><br>";
				echo "<center><a href=\"index.php\">Click here to login to the account.</a></center>";
				header('location: index.php?message=Invalid%20credentials');
			}
    		
    		mysqli_close($conn);
		}
		else {
			echo "<center>Invalid credentials.<br></center>";
			echo "<center><a href=\"index.php\">Click here to login to the account.</a></center>";
			header('location: index.php?message=Invalid%20credentials');
		}
    }
?>