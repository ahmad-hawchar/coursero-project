<?php 
session_start();
if ($_SESSION['isloggedin'] != 'true' || $_SESSION['role'] != 1) {
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
  
    <div class="edit-profile-container">
        <h2>Edit Profile</h2>
        <form action="update_profile.php" method="post" enctype="multipart/form-data">
            <?php
            echo"<label for='profile-picture'>Profile Picture(not required):</label>";
            echo"<input type='file' id='profile-picture''name='profile_picture' accept='image/*'>";
            echo"<label for='first-name'>First Name(not required):</label>";
            echo"<input type='text' id='first-name' name='first_name' value='".$row['Fname']."'>";
            echo"<label for='last-name'>Last Name (not required):</label>";
            echo"<input type='text' id='last-name' name='last_name' value='".$row['Lname']."'>";
            echo"<label for='old_pass'>Old Password(not required):</label>";
            echo"<input type='password' id='old_pass' name='old_pass' >";
            echo"<label for='new_pass'>new Password(not required):</label>";
            echo"<input type='password' id='new_pass' name='new_pass' >";
            echo"<input type='submit' value='Update Profile'>";
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
