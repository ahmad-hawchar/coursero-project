<?php 
session_start();
require_once("connection.php");
if (!$_SESSION["isloggedin"]) {
    header("location:login.php");
    return;
}
?>
<html><head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="search.css" />
    <style>
        body{
            
            justify-content:center ;
            align-items: center;
        }
    </style>
</head>
<body>
    <h2 ><a href='homepage.php'>go back to homepage</a></h1>
<?php
if(isset($_GET['post-id']) && $_GET['post-id']!=""){
$post=$_GET['post-id'];
//get the post
$query = "select * from post where id='$post'";
$res=mysqli_query($con,$query);
$row = mysqli_fetch_assoc($res);
//get the teachers info
$teacher=$row['Id_t'];
$query = "select * from user where id='$teacher' ";
$teacher = mysqli_query($con, $query);
$teacher = mysqli_fetch_assoc($teacher);
echo "<div class='postcontainer'><div class='post'> ";
echo "<span class='row1'><div class='picture'> <img src='$row[picture]' alt='$row[picture]' > </div>";
echo "<div class='names'> First name:$teacher[Fname] <br> Last name:$teacher[Lname] <br>price:$row[price] $/hr</div></span>";
echo "<div class='desc'> $row[Description] </div>";
echo "<span class='row3'><div class='date'> posted on $row[Date] </div>";
echo "<div class='category'> category: $row[category] </div>";
echo "<div class='chatbutton'><a  href='chat.php?receiver-id=$row[Id_t]'> chat ICON  </a></div></span></div></div>";
}
?>
</body>
</html>


