<?php 
session_start();
if ($_SESSION['isloggedin'] != 'true' ) {
    header("Location:login.php");
    return;
}
require_once('connection.php');
$id=$_SESSION['id'];
$query="SELECT * FROM user WHERE id=$id";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="edit_profile.css">
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



    <div class="edit-profile-container">
        <h2>Edit Profile</h2>
        <form action="update_profile.php" method="post" enctype="multipart/form-data">
            <?php
            echo"<label for='profile-picture'>Profile Picture:</label>";
            echo"<input type='file' name='pic' accept='image/*'>" ;
            echo"<label for='first-name'>First Name:</label>";
            echo"<input type='text' id='first-name' name='first_name' value='".$row['Fname']."'>";
            echo"<label for='last-name'>Last Name:</label>";
            echo"<input type='text' id='last-name' name='last_name' value='".$row['Lname']."'>";
            echo"<label for='username'>Username:</label>";
            echo"<input type='text' id='username' name='username' value='".$row['username']."'>";
            echo"<input type='submit' value='Update Profile'>";
            if(isset($_GET['error'])){
              echo"<td style='color:red'>we had a problem changing your profile</td>";
           } 
           if(isset($_GET['done'])){
              echo"<td style='color:green'>Profile changed successfully.</td>";
           }
            ?>
        </form>
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
