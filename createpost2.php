<?php
session_start();
if ($_SESSION['isloggedin'] !="true" || $_SESSION['role'] != 1) {
    header("Location:login.php");
    return;
}
require_once('connection.php');
if (
    (isset($_POST['description']) && $_POST['description'] != "") &&
    (isset($_POST['cat']) && $_POST['cat'] != "") &&
    (isset($_POST['price']) && $_POST['price'] != "")
) {
    $desc = $_POST['description'];
    $cat = $_POST['cat'];
    $date = date("Y-m-d");
    $id = $_SESSION['id'];
    $price = $_POST['price'];
    if(isset($_FILES["photo"])){
        $photo=$_FILES["photo"]["name"];
        move_uploaded_file($_FILES["photo"]["tmp_name"],"photos/$photo");
    }
    $query = "insert into pending values(NULL,'$date','$desc','$id','$cat','$photo','$price' )";
    $result = mysqli_query($con, $query);
   $result ? header("Location:createpost.php?done=''") : header("Location:createpost.php?error=''");
} else {
    header("Location:createpost.php?error=''");

}










?>