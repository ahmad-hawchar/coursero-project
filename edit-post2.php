<?php
session_start();
//if(!isset($_SESSION['isloggedin'])){
 //header("Location:login.php");
  //  return;
//}
//if ($_SESSION['isloggedin'] !="true" || $_SESSION['role'] != 1) {
   // header("Location:login.php");
   // return;
//}
require_once('connection.php');
if (
    (isset($_FILES['photo']) && $_FILES['photo'] != "") &&
    (isset($_GET['description']) && $_GET['description'] != "") &&
    (isset($_GET['cat']) && $_GET['cat'] != "") &&
    (isset($_GET['price']) && $_GET['price'] != "")&&
    (isset($_GET['temp']) && $_get['temp']!="")
) {
    if(isset($_FILES["photo"])){
        $photo=$_FILES["photo"]["name"];
        move_uploaded_file($_FILES["photo"]["tmp_name"],"photos/$photo");
    }
    echo"test";
    $desc = $_GET['description'];
    $cat = $_GET['cat'];
    $date = date("Y-m-d");
    $id = $_SESSION['id'];
    $price = $_GET['price'];
    $p_id=$_GET['Id'];
    $post=$_GET['temp'];
    $query = "UPDATE 'post' SET values('$p_id','$date','$desc','$id','$cat','$photo','$price' ) where  Id=$post and Id_t=$id";
    $result = mysqli_query($con, $query);
    $result ? header("Location:edit-post.php?done=''") : header("Location:edit-post.php?error=''");
} else {
    header("Location:edit-post.php?error=''");

}










?>