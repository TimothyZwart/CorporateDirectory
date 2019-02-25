<?php


require 'conn.php';

if (isset($_GET['limit']) && isset($_GET['offset'])) {
 $limit = $_GET['limit'];
 $offset = $_GET['offset'];
 
$sql = "
	SELECT CONCAT(Users.FirstName, ' ', Users.LastName) AS User, Actions.Name AS Action, Timestamp
					FROM Audit
					INNER JOIN Users ON Audit.UserID = Users.UserID
					INNER JOIN Actions ON Audit.ActionID = Actions.ActionID
					ORDER BY Timestamp DESC
					LIMIT ".$limit." OFFSET ".$offset."";
}

$result = mysqli_query($conn, $sql);
	
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);

echo json_encode($row);

mysqli_close($conn);

?>