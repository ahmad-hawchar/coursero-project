<?php
require_once 'connection.php';

    if (
        isset($_POST["role"]) && $_POST["role"] != ""
        && isset($_POST["password"]) && $_POST["password"] != ""
        && isset($_POST["passwrd"]) && $_POST["passwrd"] != ""
        && isset($_POST["username"]) && $_POST["username"] != ""
        && isset($_POST["lname"]) && $_POST["lname"] != ""
        && isset($_POST["fname"]) && $_POST["fname"] != ""
        && isset($_POST["date"]) && $_POST["date"] != ""
        && isset($_POST["gender"]) && $_POST["gender"] != ""
    ) {
        $pass = $_POST["password"];
        $passtest = $_POST["passwrd"];
        $user = $_POST["username"];
        $lname = $_POST["lname"];
        $fname = $_POST["fname"];
        $date = $_POST["date"];
        $role = $_POST["role"];
        $gender = $_POST["gender"];
        $query = "select * from user where username='$user' ";
        $result = mysqli_query($con, $query);
        $nbr = mysqli_num_rows($result);
        if ($nbr == 0) {
            $insert = "insert into user VALUES(NULL , '$user' ,'$pass' ,'$fname' ,'$lname' ,'$date' ,'$gender','$role','default.png')";
            $result = mysqli_query($con, $insert);
            $result ? header("Location:login.php?registered='true'") : header("Location:register.php?error='true'");
        } else {
            header("Location:register.php?taken='true'");
        }

    } else {
        header("Location:register.php?error='true'");
    }

?>