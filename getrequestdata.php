<?php


require 'conn.php';

if (isset($_GET['limit']) && isset($_GET['offset'])) {
 $limit = $_GET['limit'];
 $offset = $_GET['offset'];
 
$sql = "
	SELECT Users.UserID, Applications.ApplicationID, CONCAT(Users.FirstName, ' ', Users.LastName) AS User, Applications.Name AS Application, Timestamp
					FROM Requests
					INNER JOIN Users ON Requests.UserID = Users.UserID
					INNER JOIN Applications ON Requests.ApplicationID = Applications.ApplicationID
					ORDER BY Timestamp DESC
					LIMIT ".$limit." OFFSET ".$offset."";
}

$result = mysqli_query($conn, $sql);
	
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);

echo json_encode($row);

mysqli_close($conn);

?>