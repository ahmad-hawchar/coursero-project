<?php
session_start();
if ($_SESSION['isloggedin'] != 'true') {
    header("Location:login.php");
    return;
}
require_once('connection.php');
if(isset($_POST['old_pass'])&&isset($_POST['new_pass'])&&isset($_POST['cpass'])){
    $old_pass=$_POST['old_pass'];
    $new_pass=$_POST['new_pass'];
    $cpass=$_POST['cpass'];
    $id=$_SESSION['id'];

if( $new_pass!=$cpass){
    header("Location:changepassword.php?error='1'");
    return;

}
    $query1="SELECT * FROM user WHERE id='$id' AND password='$old_pass' ";
    $result1=mysqli_query($con,$query1);
    $num=mysqli_num_rows($result1);
    if($num>0){
        $query="UPDATE user SET password='$new_pass' WHERE id=$id";
        $result=mysqli_query($con,$query);
        $result ? header("Location:changepassword.php?done=''") : header("Location:changepassword.php?error='1'");
    }

    else{
        header("Location:changepassword.php?error='1'");
    }
}
else{
    header("Location:changepassword.php?error='1'");
}


?>