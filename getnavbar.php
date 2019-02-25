<?php

require 'conn.php';

$sql = "SELECT Name, Link FROM applications WHERE 1=1";

$result = mysqli_query($conn,$sql);
	
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);

echo json_encode($row);

?>