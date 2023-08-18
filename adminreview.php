<?php
session_start();
require_once('connection.php');
if(!isset($_SESSION['isloggedin']) || $_SESSION['role']!=3){
header('Location:login.php');
return;
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
table{  
    justify-content: center;
    align-items: center;
}
</style>
</head>
<body>
<table border="1">
    <?php
    $query="SELECT * from pending";
    $res=mysqli_query($con,$query);
    $rows=mysqli_num_rows($res);
    echo"<tr><td>date</td><td>Description</td><td>teacher id</td><td>category</td><td>picture</td><td>price</td><td>approve a post</td><td>deny a post</td></tr>";
    for($i=0;$i<$rows;$i++ ){
$row=mysqli_fetch_assoc($res);
echo"<tr><td>$row[Date]</td><td>$row[Description]</td><td>$row[Id_t]</td><td>$row[category]</td><td>$row[picture]</td><td>$row[price]</td><td><a href='handle-admin-accep.php?id=$row[Id]'>approve</a></td><td><a href='handle-admin-deny.php?id=$row[Id]'>deny</a></td></tr>";
    }




?>
</table>

</body>
</html>