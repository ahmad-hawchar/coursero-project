<?php
session_start();
if ($_SESSION['isloggedin'] !== 'true' || $_SESSION['role'] != 1) {
    header("Location: login.php");
    exit();
}

require_once('connection.php');

if (
    isset($_POST['description'], $_POST['cat'], $_POST['price'], $_POST['num_videos'], $_FILES['thumbnail'])
) {
    $desc = mysqli_real_escape_string($con, $_POST['description']);
    $cat = mysqli_real_escape_string($con, $_POST['cat']);
    $price = (float)$_POST['price'];
    $num_videos = (int)$_POST['num_videos'];
    $name = mysqli_real_escape_string($con, $_POST['course_name']); // Added course_name input

    $id = $_SESSION['id'];
    $date = date("Y-m-d");
    $course_id=$_GET['id'];
    $thumbnail = $_FILES['thumbnail']['name'];
    $thumbnail_tmp = $_FILES['thumbnail']['tmp_name'];
    move_uploaded_file($thumbnail_tmp, "thumbnail/$thumbnail");
    
    $videos = '';
    for ($i = 1; $i <= $num_videos; $i++) {
        if (!empty($_FILES["video$i"]["name"])) {
            $vid = $_FILES["video$i"]['name'];
            $vid_tmp = $_FILES["video$i"]['tmp_name'];
            move_uploaded_file($vid_tmp, "videos/$vid");
            $videos .= $vid . ",";
        }
    }
    $videos = rtrim($videos, ','); // Remove trailing comma
    
    $query = "UPDATE course SET `name`='$name', videos='$videos', price='$price', category='$cat', description='$desc', `date`='$date', num_videos='$num_videos', thumbnail='$thumbnail' WHERE id=$course_id";
    $result = mysqli_query($con, $query);
    
    
    if ($result) {
        header("Location: editcourse.php?course_id=$course_id&done=1");
    } else {
        header("Location: editcourse.php?course_id=$course_id&error=1");
    }
    
} else {
    header("Location: editcourse.php?course_id=$course_id&error=2");

}
?>