<?php
session_start();
if ($_SESSION['isloggedin'] != 'true' ) {
    header("Location:login.php");
    return;
}
else
$id=$_SESSION['id'];
require_once('connection.php');


if(isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['username'])){
    $Fname=$_POST['first_name'];
    $Lname=$_POST['last_name'];
    $username=$_POST['username'];
 

    $query1="SELECT * FROM user WHERE username='$username'AND id!='$id' ";
    $result1=mysqli_query($con,$query1);
    $num=mysqli_num_rows($result1);
    if($num==0){
        if(isset($_FILES['pic'])){
            $pic=$_FILES["pic"]["name"];
            move_uploaded_file($_FILES["pic"]["tmp_name"],"profile/$pic");
            $query="UPDATE user SET Lname='$Lname', username='$username', Fname='$Fname',profile_pic='$pic' WHERE id='$id'";
            $result=mysqli_query($con,$query);
            $result ? header("Location:edit_profile.php?done=''") : header("Location:edit_profile.php?error='1'");
        }
        else{
            $query="UPDATE user SET Lname='$Lname', username='$username', Fname='$Fname' WHERE id='$id'";
            $result=mysqli_query($con,$query);
            $result ? header("Location:edit_profile.php?done=''") : header("Location:edit_profile.php?error='1'");
        }

}
else{
    header("Location:edit_profile.php?error='1'");

}

}


?>