<?php
 session_start();
 require_once('connection.php');
 if ($_SESSION['isloggedin'] != 'true' || $_SESSION['role']!=1) {
    header("Location:login.php");
    
}
$id=$_SESSION['id'];

if(!isset($_GET['course_id'])){
    header("location:showcourses.php");
}
else{
$course_id=$_GET['course_id'];
$query="SELECT * FROM subscribe WHERE id_course=$course_id AND id_student=$id";
$result=mysqli_query($con,$query);
$num=mysqli_num_rows($result);
if($num!=1){
    header("location:showcourse.php?course_id=$course_id");
}
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="showcourse.css">
    <title>showcourse</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body>
<header>
      <nav>
      <div class="logo">
      <h1>LOGO</h1>
    </div>
        <i class="fas fa-bars" id="ham-menu"></i>
        <ul id="nav-bar">
          <li>
            <a href="recentChat.php">Chat</a>
          </li>
          <li>
            <a href="chat.php?receiver-id=1">Support</a>
          </li>
          <li>
            <a href="myads.php">My ads</a>
          </li>
          <li>
          <a href="#">Settings</a>
          </li>
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
  
    <?php
    $query1="SELECT * FROM course WHERE id=$course_id";
    $result1=mysqli_query($con,$query1);
    $row1=mysqli_fetch_assoc($result1);


    $id_t=$row1['Id_t'];
    $query2="SELECT * FROM user WHERE id=$id_t";
    $result2=mysqli_query($con,$query2);
    $row2=mysqli_fetch_assoc($result2);
    $username_t=$row2['username'];
    
    $videos=$row1['videos'];
    $num_videos=$row1['num_videos'];
    $thumbnail=$row1['thumbnail'];
    $tab=explode(',',"$videos");
    echo"<div class='course-container'>";
    echo"<div class='thumbnail'><img src='thumbnail/$thumbnail'/></div>";
    echo"<h1>".$row1['name']."</h1><h4>Teacher: $username_t</h4> ";
    echo"<p>".$row1['Description']."</p>";
    echo"<div class='price-section'><p>Enjoy all ".$row1['num_videos']." videos of the course </p></div>";
    echo"<div class='videos-section'>";
    for($i=0;$i< $num_videos;$i++){
       echo"  <video  controls><source src='videos/$tab[$i]' > </video>";
    }
    echo"</div>";
    ?>
    </div>
      <div class="footer">
    <footer>
      <p>
        Created by <i class="fa fa-copyright"></i>Ahmad Hawchar, Chadi Ech &
        Taha Haydar
      </p>
    </footer>
  </div>
</body>
</html>