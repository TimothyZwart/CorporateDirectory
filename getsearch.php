<?php



require "conn.php";

if(empty($_GET['limit']) && empty($_GET['offset'])&& empty($_GET['thearray'])){
   $sql = "SELECT UserID, FirstName, LastName, Departments.Name AS Department, Roles.Name AS Role, Locations.City AS City, Teams.Team AS Team
					FROM Users
					INNER JOIN Departments ON Users.DepartmentID = Departments.DepartmentID
					INNER JOIN Roles ON Users.RoleID = Roles.RoleID
					INNER JOIN Locations ON Users.LocationID = Locations.LocationID 
					INNER JOIN Teams ON Users.TeamID = Teams.TeamID
					";
$result = mysqli_query($conn,$sql);
	
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);

echo json_encode($row);

mysqli_close($conn);
    
}elseif(empty($_GET['limit']) && empty($_GET['offset'])&& isset($_GET['thearray'])){
  $thearray = $_GET['thearray'];
 $count = (count($thearray)-1);
 $size = $count;
 $q = 0;
    
 
 $sql = "SELECT UserID, FirstName, LastName, Departments.Name AS Department, Roles.Name AS Role, Locations.City AS City, Teams.Team AS Team
					FROM Users
					INNER JOIN Departments ON Users.DepartmentID = Departments.DepartmentID
					INNER JOIN Roles ON Users.RoleID = Roles.RoleID
					INNER JOIN Locations ON Users.LocationID = Locations.LocationID 
					INNER JOIN Teams ON Users.TeamID = Teams.TeamID";
 
   
while($q <= $count){
    $i = $q;
    $left = 1;
    $right = 1;
    $str ="";
    $pusharray = array();
    $array = $thearray;
    $pushloop = 0;
    
    if(($i-$left)>=0){
        while(($i-$left)>=0){
            $str="";
            $templeft = $i-$left;
            $right = 1;
            while($templeft <= $i){
             $str .= $array[$templeft];
             $templeft++;
            $str .=" ";
            }
            array_push($pusharray,$str);
            $tempstr = $str;
            while(($i+$right)<= $size){
            $tempcount = $i+$right;
            $str = $tempstr;
            $tempright = $i+1;
            while($tempright <= $tempcount){
             $str .= $array[$tempright];
             $tempright++;
             $str .=" ";
            }
            array_push($pusharray,$str);
            $right++;
            }
            $left++;
        }
        $right = $size;
        while($right > $i){
            $str="";
            $str .= $array[$i];
            $tempright = $i+1;
           while($tempright <= $right){
             $str .=" ";
             $str .= $array[$tempright]; 
             $tempright++;
           } 
            $right--;
            array_push($pusharray,$str);
        }
        
    }else{
       $right = $size;
        while($right > $i){
            $str="";
            $str .= $array[$i];
            $tempright = $i+1;
           while($tempright <= $right){
             $str .=" ";
             $str .= $array[$tempright]; 
             $tempright++;
           } 
            $right--;
            array_push($pusharray,$str);
        }
    
    }
$pushcount = count($pusharray);
if($q == 0){
    if($count == $q){
         $sql .= " WHERE (FirstName LIKE '".$thearray[$q]."%' OR LastName LIKE '".$thearray[$q]."%'  OR Departments.Name LIKE '".$thearray[$q]."%' OR Roles.Name LIKE '".$thearray[$q]."%' OR Locations.City LIKE '".$thearray[$q]."%'";
    }else{
        $sql .= " WHERE (FirstName = '".$thearray[$q]."' OR LastName = '".$thearray[$q]."'  OR Departments.Name = '".$thearray[$q]."' OR Roles.Name = '".$thearray[$q]."' OR Locations.City = '".$thearray[$q]."'";
    }
}else{  
    if($count == $q){
        $sql .= " AND (FirstName LIKE '".$thearray[$q]."%' OR LastName LIKE '".$thearray[$q]."%'  OR Departments.Name LIKE '".$thearray[$q]."%' OR Roles.Name LIKE '".$thearray[$q]."%' OR Locations.City LIKE '".$thearray[$q]."%' ";
     }else{
        $sql .= " AND (FirstName = '".$thearray[$q]."' OR LastName = '".$thearray[$q]."'  OR Departments.Name = '".$thearray[$q]."' OR Roles.Name = '".$thearray[$q]."' OR Locations.City = '".$thearray[$q]."'";
    }
}

while($pushloop < $pushcount ){

    $likeplaceholder = substr($pusharray[$pushloop],0,-1);
        
    $sql .= " OR FirstName LIKE '".$likeplaceholder."%' OR LastName LIKE '".$likeplaceholder."%' OR Departments.Name LIKE '".$likeplaceholder."%' OR Roles.Name LIKE '".$likeplaceholder."%' OR Locations.City LIKE '".$likeplaceholder."%' ";

    
      $sql .= " OR FirstName = '".$likeplaceholder."' OR LastName = '".$likeplaceholder."' OR Departments.Name = '".$likeplaceholder."' OR Roles.Name = '".$likeplaceholder."' OR Locations.City = '".$likeplaceholder."' ";  
    
    $pushloop++;
}

  $sql .=  ")";
    $q++;
}
$result = mysqli_query($conn,$sql);
	
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);

echo json_encode($row);

mysqli_close($conn);    
    
    
    
    
    
    
    
}elseif(isset($_GET['limit']) && isset($_GET['offset'])&& empty($_GET['thearray'])){
 $limit = $_GET['limit'];
 $offset = $_GET['offset'];
 
//$sql = 'SELECT * FROM users LIMIT '.$limit.' OFFSET '.$offset;
$sql = "
	SELECT UserID, FirstName, LastName, Departments.Name AS Department, Roles.Name AS Role, Locations.City AS City, Teams.Team AS Team
					FROM Users
					INNER JOIN Departments ON Users.DepartmentID = Departments.DepartmentID
					INNER JOIN Roles ON Users.RoleID = Roles.RoleID
					INNER JOIN Locations ON Users.LocationID = Locations.LocationID
					INNER JOIN Teams ON Users.TeamID = Teams.TeamID
					LIMIT ".$limit." OFFSET ".$offset."
";
$result = mysqli_query($conn,$sql);
	
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);

echo json_encode($row);

mysqli_close($conn);
	
}elseif(isset($_GET['limit']) && isset($_GET['offset'])&& empty($_GET['thearray'])){
 $limit = $_GET['limit'];
 $offset = $_GET['offset'];
 
//$sql = 'SELECT * FROM users LIMIT '.$limit.' OFFSET '.$offset;
$sql = "
	SELECT UserID, FirstName, LastName, Departments.Name AS Department, Roles.Name AS Role, Locations.City AS City, Teams.Team AS Team
					FROM Users
					INNER JOIN Departments ON Users.DepartmentID = Departments.DepartmentID
					INNER JOIN Roles ON Users.RoleID = Roles.RoleID
					INNER JOIN Locations ON Users.LocationID = Locations.LocationID
					INNER JOIN Teams ON Users.TeamID = Teams.TeamID
					LIMIT ".$limit." OFFSET ".$offset."
";
$result = mysqli_query($conn,$sql);
	
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);

echo json_encode($row);

mysqli_close($conn);
	
}elseif(isset($_GET['limit']) && isset($_GET['offset'])&&isset($_GET['thearray'])&&isset($_GET['thearray'])){
 $limit = $_GET['limit'];
 $offset = $_GET['offset'];
 $thearray = $_GET['thearray'];
 $count = (count($thearray)-1);
 $size = $count;
 $q = 0;
    
 
 $sql = "SELECT UserID, FirstName, LastName, Departments.Name AS Department, Roles.Name AS Role, Locations.City AS City, Teams.Team AS Team
					FROM Users
					INNER JOIN Departments ON Users.DepartmentID = Departments.DepartmentID
					INNER JOIN Roles ON Users.RoleID = Roles.RoleID
					INNER JOIN Locations ON Users.LocationID = Locations.LocationID 
					INNER JOIN Teams ON Users.TeamID = Teams.TeamID
					";
 
   
while($q <= $count){
    $i = $q;
    $left = 1;
    $right = 1;
    $str ="";
    $pusharray = array();
    $array = $thearray;
    $pushloop = 0;
    
    if(($i-$left)>=0){
        while(($i-$left)>=0){
            $str="";
            $templeft = $i-$left;
            $right = 1;
            while($templeft <= $i){
             $str .= $array[$templeft];
             $templeft++;
            $str .=" ";
            }
            array_push($pusharray,$str);
            $tempstr = $str;
            while(($i+$right)<= $size){
            $tempcount = $i+$right;
            $str = $tempstr;
            $tempright = $i+1;
            while($tempright <= $tempcount){
             $str .= $array[$tempright];
             $tempright++;
             $str .=" ";
            }
            array_push($pusharray,$str);
            $right++;
            }
            $left++;
        }
        $right = $size;
        while($right > $i){
            $str="";
            $str .= $array[$i];
            $tempright = $i+1;
           while($tempright <= $right){
             $str .=" ";
             $str .= $array[$tempright]; 
             $tempright++;
           } 
            $right--;
            array_push($pusharray,$str);
        }
        
    }else{
       $right = $size;
        while($right > $i){
            $str="";
            $str .= $array[$i];
            $tempright = $i+1;
           while($tempright <= $right){
             $str .=" ";
             $str .= $array[$tempright]; 
             $tempright++;
           } 
            $right--;
            array_push($pusharray,$str);
        }
    
    }
$pushcount = count($pusharray);
if($q == 0){
    if($count == $q){
         $sql .= " WHERE (FirstName LIKE '".$thearray[$q]."%' OR LastName LIKE '".$thearray[$q]."%'  OR Departments.Name LIKE '".$thearray[$q]."%' OR Roles.Name LIKE '".$thearray[$q]."%' OR Locations.City LIKE '".$thearray[$q]."%'";
    }else{
        $sql .= " WHERE (FirstName = '".$thearray[$q]."' OR LastName = '".$thearray[$q]."'  OR Departments.Name = '".$thearray[$q]."' OR Roles.Name = '".$thearray[$q]."' OR Locations.City = '".$thearray[$q]."'";
    }
}else{  
    if($count == $q){
        $sql .= " AND (FirstName LIKE '".$thearray[$q]."%' OR LastName LIKE '".$thearray[$q]."%'  OR Departments.Name LIKE '".$thearray[$q]."%' OR Roles.Name LIKE '".$thearray[$q]."%' OR Locations.City LIKE '".$thearray[$q]."%' ";
     }else{
        $sql .= " AND (FirstName = '".$thearray[$q]."' OR LastName = '".$thearray[$q]."'  OR Departments.Name = '".$thearray[$q]."' OR Roles.Name = '".$thearray[$q]."' OR Locations.City = '".$thearray[$q]."'";
    }
}

while($pushloop < $pushcount ){

    $likeplaceholder = substr($pusharray[$pushloop],0,-1);
        
    $sql .= " OR FirstName LIKE '".$likeplaceholder."%' OR LastName LIKE '".$likeplaceholder."%' OR Departments.Name LIKE '".$likeplaceholder."%' OR Roles.Name LIKE '".$likeplaceholder."%' OR Locations.City LIKE '".$likeplaceholder."%' ";

    
      $sql .= " OR FirstName = '".$likeplaceholder."' OR LastName = '".$likeplaceholder."' OR Departments.Name = '".$likeplaceholder."' OR Roles.Name = '".$likeplaceholder."' OR Locations.City = '".$likeplaceholder."' ";  
    
    $pushloop++;
}

  $sql .=  ")";
    $q++;
}
   $sql .= " LIMIT ".$limit." OFFSET ".$offset."";
    
    
$result = mysqli_query($conn,$sql);
	
$row=mysqli_fetch_all($result,MYSQLI_ASSOC);

echo json_encode($row);

mysqli_close($conn);
}



?>