<?php
    $servername = "localhost";
    $username = "tpirone";
    $password = "tp27yankeesqyz";
    $dbname = "acme";
    
    $conn = mysqli_connect($servername, $username, $password);
    
    if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
	}
    else {
        mysqli_select_db($conn, $dbname); 
	}
?>