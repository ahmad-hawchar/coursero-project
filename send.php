<?php
session_start();
include("connection.php");
$msg= trim($_POST['message']);
$id_sender=$_SESSION['id'];
$date=date("Y/m/d");
$id_receiver=$_GET['idr'];


 if(isset($msg)&& $msg!="" &&$msg!=" "){
 $query="INSERT INTO messages VALUES (NULL,'$date','$id_sender','$id_receiver','$msg')";
 $result=mysqli_query($con,$query);
 header("location:chat.php?receiver-id=$id_receiver");

 }
 else
 header("location:chat.php?receiver-id=$id_receiver");

?>