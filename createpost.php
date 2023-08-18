<?php
session_start();
if ($_SESSION['isloggedin'] != 'true' ) {
    header("Location:login.php");
    return;
}
if($_SESSION["role"]==2){
    header("location:homepage.php");
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
    <h1>Create a Post</h1>
    <form action="createpost2.php" enctype="multipart/form-data" method="POST">
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" required accept="image/*">
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea>
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
        <label for="price">price:</label>
        <input type="number" id="price" name="price" required></input>
        <table>
       <tr><td> <input type="submit" value="Submit"></td>
         <?php if(isset($_GET['error'])){
            echo"<td style='color:red'>we had a problem creating your post! try again later</td>";
         } 
         if(isset($_GET['done'])){
            echo"<td style='color:red'>post was created! waiting for admin approval.</td>";
         }?>

        </table>
    </form>
</body>

</html>