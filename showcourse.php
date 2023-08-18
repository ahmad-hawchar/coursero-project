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
$query="SELECT * FROM subscribe WHERE id_course=$course_id AND id_student=$id";
$query1="SELECT * FROM course WHERE id=$course_id AND Id_t=$id";
$result=mysqli_query($con,$query);
$result1=mysqli_query($con,$query1);
$num=mysqli_num_rows($result);
$num1=mysqli_num_rows($result1);
if($num==1||$num1==1){
    header("location:showcourse2.php?course_id=$course_id");
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
    <?php
    $query1="SELECT * FROM course WHERE id=$course_id";
    $result=mysqli_query($con,$query1);
    $row=mysqli_fetch_assoc($result);


    $id_t=$row['Id_t'];
    $query2="SELECT * FROM user WHERE id=$id_t";
    $result2=mysqli_query($con,$query2);
    $row2=mysqli_fetch_assoc($result2);
    $username_t=$row2['username'];
    $thumbnail=$row['thumbnail'];

    echo"<div class='course-container'>";
    echo"<div class='thumbnail'><img src='thumbnail/$thumbnail'/></div>";
    echo"<h1>".$row['name']."</h1><h4>Teacher: $username_t</h4> ";
    echo"<p>".$row['Description']."</p>";
    echo"<div class='price-section'><p>Subscribe to unlock all ".$row['num_videos']." videos of the course for<span class='price'>".$row['price']."$</span></p></div></div>";
    echo"<center><a href='buy.php?course_id=$course_id'><button class='subscribe-button'>Subscribe</button></a></center><br><br>";
    ?>
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