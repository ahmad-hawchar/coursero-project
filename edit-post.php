<?php
session_start();
//if (!$_SESSION['isloggedin'] || $_SESSION['role'] != 1 || !isset($_GET['post'])) {
  //  header("Location:login.php");
    //return;
//}
require_once('connection.php')
    ?>
<!DOCTYPE html>
<html>

<head>
    <title>Create a Post</title>
    <link rel="stylesheet" type="text/css" href="createpost.css">
</head>
<body>
<header>
      <nav>
      <div class="logo">
      <h1 >LOGO</h1>
    </div>
        <i class="fas fa-bars" id="ham-menu"></i>
        <ul id="nav-bar">
          <li>
            <a href="homepage.php">Home</a>
          </li>
          <li>
            <a href="recentChat.php">Chat</a>
          </li>
          <li>
            <a href="course-search.php">Courses</a>
          </li>
          <li>
            <a href="chat.php?receiver-id=1">Support</a>
          </li>

           <?php
          if($_SESSION['role']==1){
            echo'<li><a href="myads.php">My ads</a></li>';
            echo'<li><a href="mycourses.php">My courses</a></li>';

}
else{
  echo'<li><a href="bought.php">bought courses</a></li>';
}
          ?>
          

            <?php  if(isset($_SESSION['role']) ){
             if($_SESSION['role']==1){

            
              echo" <li><a href='createpost.php'>add a post</a>";
              echo"</li><li><a href='createcourse.php'>add a course</a></li>";
            }
          }
            ?>
          
          <?php
        if (isset($_SESSION["isloggedin"])) {

          if ($_SESSION["isloggedin"] == "true") {
            $id=$_SESSION['id'];
            echo "<li>";
            echo "<a href='profile.php?id=$id'><i class='fa fa-user' aria-hidden='false'></i></a>";
            echo "  </li>";
          } else {
            echo "<li> <a href='Register.php'> REGISTER/LOGIN</a></li>";
          }

        } else {
          echo "<li> <a href='Register.php'> REGISTER/LOGIN</a></li>";
        }
        ?>
        </ul>
      </nav>
    </header>
    <!-- Script -->
    <script src="script.js"></script>
    <div style="background-color:#e9e9e9; margin-bottom:10px">
        <center>
          <h2 >Edit post</h2>
        </center>
      </div>
    <?php
    if(isset($_GET['post'])){
      $post=$_GET['post'];
    }
    else{
      header('Location:homepage.php');
    }
    $id =$_SESSION["id"];
    $query ="SELECT * from post where Id=$post and Id_t=$id";
    $res = mysqli_query($con, $query);
    if (mysqli_num_rows($res)==0) {
        echo "you don't have access to this post";

    } else {
        $row1 = mysqli_fetch_assoc($res);
        echo "<h1>edit your Post</h1>";
        echo "<form action='edit-post2.php' method='POST' enctype='multipart/form-data'>";
        echo "<label for='photo'>Photo:</label>";
        echo " <input type='file'name='photo' required accept='image/*'>";
        echo "<label for='description'>Description:</label>";
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
            echo "<td style='color:red'>post edited successfully! .</td>";
        }
        echo"<input type='text' id='postid' name='postid' hidden='true' /> ";
        echo"<script> let postid=document.getElementById('postid');
        postid.value='$post' </script>";
        echo"</table></form></body></html>";
    } ?>