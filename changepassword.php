<?php 
session_start();
if ($_SESSION['isloggedin'] != 'true') {
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
    <title>Change Password</title>
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
        <h2>Change Password</h2>
        <form action="update_password.php" method="post" enctype="multipart/form-data">
            <?php
            echo"<h4 id='error' style='color:red;'></h4>";
            echo"<label for='old_pass'>Old Password:</label>";
            echo"<input type='password' id='old_pass' name='old_pass' >";
            echo"<label for='new_pass'>New Password:</label>";
            echo"<input type='password' id='new_pass' name='new_pass' >";
            echo"<label for='cpass'>Repeat Password:</label>";
            echo"<input type='password'  onblur='checkpass() ' id='cpass' name='cpass' >";
            echo"<input type='submit' id='button' onclick='checkpass()' value='Update Password' disabled> ";
            if(isset($_GET['error'])){
                echo"<td style='color:red'>Error with password changing</td>";
             } 
             if(isset($_GET['done'])){
                echo"<td style='color:green'>Password changed successfully.</td>";
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
  <script>
                function checkpass() {
                let pass = document.getElementById("new_pass").value
                let cpass = document.getElementById("cpass").value
                let msg = document.getElementById("error")
                if (pass != cpass) {
                    msg.innerHTML = "Password don't match!"
                    return false
                }
                else {
                    msg.innerHTML = ""
                    return true
                }
              }
            if(checkpass()){
                document.getElementById("button").disabled=false;
            }

  </script>
</body>
</html>
