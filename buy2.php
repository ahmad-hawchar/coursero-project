<?php
 session_start();
 require_once('connection.php');
 if ($_SESSION['isloggedin'] != 'true') {
    header("Location:login.php");
    
}
$id=$_SESSION['id'];

if(!isset($_GET['course_id'])){
    header("location:course-search.php");
}
else{
$course_id=$_GET['course_id'];
$query="INSERT INTO subscribe VALUES (NULL,'$course_id','$id')";
$result=mysqli_query($con,$query);
if(!$result){
    header("location:showcourse.php?course_id=$course_id");
}
else{
    header("location:bought.php");
}
}

?>