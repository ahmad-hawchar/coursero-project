<?php
session_start();
if ($_SESSION['isloggedin'] !== 'true' ) {
    header("Location: login.php");
    exit();
}
if($_SESSION["role"]==2){
  header("location:homepage.php");
  return;
}

require_once('connection.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Course</title>
    <link rel="stylesheet" href="createpost.css">
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
    <h1>Create a New Course</h1>
    <form action="createcourse2.php" method="POST" enctype="multipart/form-data">
    <label for="course_name">Course Name</label>
    <input type="text" id="course_name" name="course_name"required>
    <br><br>
    <label for="thumbnail">Upload the thumbnail:</label>
    <input type="file" name="thumbnail" required accept="image/*">
    <br><br>
    <label for="num_videos">Number of Videos to Upload:</label>
    <input type="number" id="num_videos" name="num_videos" min="1" max="15" value="1" required>
    <br><br>
    <label for="video_upload_fields">Upload Videos:</label>
    <div id="video_upload_fields">
    <input type="file" name="video1" required="" accept="video/*">
    </div>
    <br>
    <label for="description">Course Description:</label>
    <textarea id="description" name="description" maxlength="300" required></textarea>
    <br><br>
    <label for="cat">Categories:</label>
        <select id="cat" name="cat" required>
      
            <?php
            $query = "SELECT * From Categories  ";
            $result = mysqli_query($con, $query);
            $rows = mysqli_num_rows($result);
            for ($i = 0; $i < $rows; $i++) {
                $row = mysqli_fetch_assoc($result);
                echo "<option>".$row['name']."</option>";
            }



            ?>
        </select>
    <br><br>
    <label for="price">Price:</label>
    <input type="number" id="price" name="price"  required>
    <br><br>
    <input type="submit" value="Submit">
    <?php if(isset($_GET['error'])){
            echo"<td style='color:red'>we had a problem creating your post! try again later</td>";
         } 
         if(isset($_GET['done'])){
            echo"<td style='color:green'>post was created! </td>";
         }?>
  </form>

  <script>
    document.getElementById("num_videos").addEventListener("change", function() {
      let numVideos = parseInt(this.value);
      let videoFieldsContainer = document.getElementById("video_upload_fields");
      videoFieldsContainer.innerHTML = " <input type='file' name='video1' required accept='video/*'/><br>";

      for (let i = 2; i <= numVideos; i++) {
        let inputField = document.createElement("input");
        inputField.type = "file";
        inputField.name = "video"+i;
        inputField.required = true;
        inputField.accept = "video/*";
        videoFieldsContainer.appendChild(inputField);
        videoFieldsContainer.appendChild(document.createElement("br"));
      }
    });
  </script>

</body>
</html>
