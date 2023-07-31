<?php
session_start();
if (!$_SESSION['isloggedin'] || $_SESSION['role'] != 1 || !isset($_GET['post'])) {
    header("Location:login.php");
    return;
}
require_once('connection.php')
    ?>
<!DOCTYPE html>
<html>

<head>
    <title>Create a Post</title>
    <link rel="stylesheet" type="text/css" href="createpost.css">
</head>
<body>
    <?php
    $post = $_GET['post'];
    $id = $_SESSION["id"];
    $query = "SELECT * from post where Id=$post and Id_t=$id";
    $res = mysqli_query($con, $query);
    if (mysqli_num_rows($res) < 0) {
        echo "you don't have access to this post";

    } else {
        $row1 = mysqli_fetch_assoc($res);
        echo "<h1>edit your Post</h1>";
        echo "<form action='createpost2.php' enctype='file' method='GET'>";
        echo " <label for='photo'>Photo:</label>";
        echo " <input type='file' id='photo' name='photo' required>";
        echo " <label for='description'>Description:</label>";
        echo "<textarea id='description' name='description' rows='4' cols='50'  required></textarea>";
        echo"<script> let doc=document.getElementById('description')
        doc.innerText='$row1[Description]'</script>";
        echo "<label for='cat'>Categories:</label>";
        echo "<select id='cat' name='cat' required>";
        $query = "SELECT * From Categories  ";
        $result = mysqli_query($con, $query);
        $rows = mysqli_num_rows($result);
        for ($i = 0; $i < $rows; $i++) {
            $row = mysqli_fetch_assoc($result);
            echo "<option>" . $row['name'] . "</option>";

        }
        echo "</select>";
        echo "<script>let selected=document.getElementById('cat')
            for(let i of selected.options){
                if(i=='$row1[category]'){
                i.selected=true;
                break;
                }
            }
            </script>";







        echo "<label for='price'>price:</label>";
        echo "<input type='number' id='price' name='price' value='$row1[price]' required></input>";
        echo "<table>";
        echo "<tr><td> <input type='submit' value='Submit'></td>";
        if (isset($_GET['error'])) {
            echo "<td style='color:red'>we had a problem creating your post! try again later</td>";
        }
        if (isset($_GET['done'])) {
            echo "<td style='color:red'>post was created! waiting for admin approval.</td>";
        }
        echo"<input type='text' id='temp' style='visibility:hidden' /> ";
        echo "<script> let temp=document.getElementById('temp');
        temp.value='$post' </script>";
        echo "</table></form></body></html>";
    } ?>