<?php
session_start();
require_once "connection.php";
if(!isset($_SESSION['isloggedin'])&& $_SESSION['isloggedin'] != "true"){
    header("location:login.php");
}
else{
  $id=$_SESSION['id'];
  $query="SELECT * FROM user WHERE id=$id";
  $result=mysqli_query($con,$query);
  $row=mysqli_fetch_assoc($result);
  $full_name=$row['Fname']." ".$row['Lname'];
}
?>
<html lang="en">
<head>
  <title>Profile</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="profile.css">
  
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
            <a href="chat.php?receiver-id=1">Support</a>
          </li>
          <li>
           <?php
          if($_SESSION['role']==1){
            echo'<a href="myads.php">My ads</a>';
            echo'<a href="mycourses.php">My courses</a>';

}
else{
  echo'<a href="bought.php">bought courses</a>';
}
          ?>
          
          </li>
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
  <div class="profile-container">
        <?php
        
        if (isset($_GET['id']) && $_SESSION['id'] == $_GET['id']) {
            echo "<div class='profilelink'>";
            echo '<a href="logout.php">Logout</a>';
            echo '<a href="edit_profile.php">Edit Profile</a>';
            echo '<a href="changepassword.php">Change Password</a>';
            echo'</div>';
        }
        ?>

        
        <?php
        if(!isset($_GET['id'])){
          header("location:homepage.php");
        }
        $id=$_GET['id'];
        $query="SELECT * FROM user WHERE id=$id";
        $result=mysqli_query($con,$query);
        $row=mysqli_fetch_assoc($result);
        
        $profilePicture = $row['profile_pic'];
        $firstName = $row['Fname']; 
        $lastName = $row['Lname']; 
        $gender = $row['gender']; 
        $tab1=explode("-",$row['Date_Of_Birth']);
        $age=date("Y")-$tab1[0];
        
        
        echo '<img src="profile/' . $profilePicture . '" alt="Profile Picture">';
        echo '<p>First Name: ' . $firstName . '</p>';
        echo '<p>Last Name: ' . $lastName . '</p>';
        echo '<p>Gender: ' . $gender . '</p>';
        echo '<p>Age: ' . $age . '</p>';
        ?>

        
        <?php
       if($_SESSION['role']==1){
        $query1="SELECT * FROM post WHERE Id_t=$id AND Id=(SELECT MAX(Id) FROM post WHERE Id_t=$id ) ";
        $result1=mysqli_query($con,$query1);
        $num1=mysqli_num_rows($result1);
        if($num1>0){
        $row1=mysqli_fetch_assoc($result1);
        $lastUploadedPostTitle = $row1['Description']; 
        $lastUploadedPostDate = $row1['Date']; 

        echo '<p>Last Uploaded Post:</p>';
        echo '<p>Title:<a href="showpost.php?post_id='.$row1['Id'].'">  ' . $lastUploadedPostTitle . '</a></p>';
        echo '<p>Date: ' . $lastUploadedPostDate . '</p>';
        echo"<a href='myads.php'><button>More</button></a>";
      }
      else
      echo"No uploaded posts<br>";
       }
        ?>

      
        <?php
        if($_SESSION['role']==1){
        $query2="SELECT * FROM course WHERE Id_t=$id AND id=(SELECT MAX(id) FROM course WHERE Id_t=$id ) ";
        $result2=mysqli_query($con,$query2);
        $num2=mysqli_num_rows($result2);
        if($num2>0){
        $row2=mysqli_fetch_assoc($result2);
        $lastUploadedCourseTitle = $row2['name']; 
        $lastUploadedCourseDate = $row2['Date']; 

        echo '<p>Last Uploaded Course:</p>';
        echo '<p>Title:<a href="showcourse.php?course_id='.$row2['id'].'"> ' . $lastUploadedCourseTitle . '</a></p>';
        echo '<p>Date: ' . $lastUploadedCourseDate . '</p>';
        echo"<a href='mycourses.php'><button>More</button></a>";
        }
        else
        echo"No uploaded courses";
      }
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