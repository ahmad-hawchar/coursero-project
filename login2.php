<?php
session_start();

require_once("connection.php");
$user = $_POST["username"];
$pass = $_POST["password"];
if (isset($user) && $user != "" && isset($pass) && $pass != "") {
    $query = "select * from user where username='$user' and password='$pass'";
    $result = mysqli_query($con, $query);
    !$result ? header("Location:login.php?error='true'") : '';
    $nbr = mysqli_num_rows($result);
    if ($nbr == 0) {
        header("Location:login.php?wrong='true'");
    } else {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['isloggedin'] = "true";
        $_SESSION['role'] = $row["Role_Id"];
        $_SESSION['id']=$row['id'];
        $_SESSION['user']=$row['username'];
        header("Location:homepage.php");
    }



} else
    header("Location:login.php?error='true'")



        ?>