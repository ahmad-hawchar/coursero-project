<?php
session_start();
require_once('connection.php');
if(!isset($_SESSION['isloggedin']) || $_SESSION['role']!=3){
header('Location:login.php');
return;
}
else{
if(isset($_GET['id'])){
$id=$_GET['id'];
$query1="SELECT * from pending where Id=$id";
$res=mysqli_query($con , $query1);
$row=mysqli_fetch_assoc($res);
$date=$row['Date'];
$desc=$row['Description'];
$Id_t=$row['Id_t'];
$cat=$row['category'];
$photo=$row['picture'];
$price=$row['price'];
$query="INSERT into post values(NULL,'$date','$desc','$Id_t','$cat','$photo','$price' )";
$result=mysqli_query($con,$query);
if($result){
    $query2="DELETE from pending where Id=$id";
    $res=mysqli_query($con,$query2);
}
header("Location:adminreview.php");
}
else{
header('Location:adminreview.php'); 
}
}
?>
