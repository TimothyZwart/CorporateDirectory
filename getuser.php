<?php
require 'conn.php';


if(isset($_GET['id'])){
    $id = $_GET['id'];
    
$sql = "SELECT UserID, FirstName, LastName, Email, Phone, Picture, Departments.Name AS Department, Roles.Name AS Role, Locations.City as City, Teams.Team AS Team
					FROM Users
                    INNER JOIN Passwords ON Users.UserHash = Passwords.UserHash
					INNER JOIN Departments ON Users.DepartmentID = Departments.DepartmentID
					INNER JOIN Roles ON Users.RoleID = Roles.RoleID
					INNER JOIN Locations ON Users.LocationID = Locations.LocationID 
					INNER JOIN Teams ON Users.TeamID = Teams.TeamID
					WHERE UserID = ".$id."
					ORDER BY Department, LastName, FirstName, City, Role";

$result = mysqli_query($conn,$sql);
	
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);

echo json_encode($row);
}
else{
    echo "404 value not found";
}


mysqli_close($conn);


?>