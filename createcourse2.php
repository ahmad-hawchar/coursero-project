<?php
session_start();
if ($_SESSION['isloggedin'] != 'true' || $_SESSION['role'] != 1) {
    header("Location:login.php");
    return;
}
require_once('connection.php');
// if (
//     (isset($_POST['description']) && $_POST['description'] != "") &&
//     (isset($_POST['cat']) && $_POST['cat'] != "") &&
//     (isset($_POST['price']) && $_POST['price'] != "")&&
//     (isset($_POST['num_videos']) && $_POST['num_videos'] != "")&&
//     (isset($_POST['thumbnail']) && $_POST['thumbnail'] != "")&&
//(isset($_POST['name']) && $_POST['name'] != "")
    $desc = $_POST['description'];
    $cat = $_POST['cat'];
    $date = date("Y-m-d");
    $id = $_SESSION['id'];
    $price = $_POST['price'];
    $num_videos=$_POST['num_videos'];
   
    $name=$_POST['name'];
    $videos="";
    if(!empty($_FILES["thumbnail"])){
    $thumbnail=$_FILES["thumbnail"]["name"];
    move_uploaded_file($_FILES["thumbnail"]["tmp_name"],"thumbnail/$thumbnail");
}
    for($i=1;$i<=$num_videos;$i++){
        if(!empty($_FILES["video$i"])){                       
          $vid=$_FILES["video$i"]['name'];
          move_uploaded_file($_FILES["video$i"]['tmp_name'],"videos/$vid");
          $videos.=$vid.",";
    }
  }
$query="INSERT INTO course VALUES(NULL,'$id','$videos','$price','$cat','$desc','$date','$num_videos','$thumbnail','$name')";
$result=mysqli_query($con,$query);
$result ? header("Location:createcourse.php?done=''") : header("Location:createcourse.php?error='1'");
// } else {
//     header("Location:createcourse.php?error='2'");

// }
?>