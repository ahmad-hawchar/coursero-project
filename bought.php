<?php session_start();
if (!$_SESSION["isloggedin"]) {
    header("location:login.php");
    return;
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribed courses</title>
    <link rel="stylesheet" href="mycourses.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body >
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
          <h2 >Subscribed Courses</h2>
        </center>
      </div>
    <section class="columns">
        <?php
        //-------------------------------------------------------------------------------------------------------------------------------------------------
        require_once("connection.php");
        //i need to sanitize all inputs and strip spaces from search inputs
        $id = $_SESSION["id"];
        $query = "SELECT * FROM subscribe
            WHERE id_student=$id ";
        //-------------------------------------------------------------------------------------------------------------------------------------------------
        $result = mysqli_query($con, $query);
        if ($result) {
            $rows = mysqli_num_rows($result);
            //-------------------------------------------------------------------------------------------------------------------------------------------------
            for ($i = 0; $i < $rows; $i++) {
                $row1 = mysqli_fetch_assoc($result);
                $course=$row1['id_course'];
                $query2="SELECT * from course where id=$course";
                $resulat=mysqli_query($con,$query2);
                $row = mysqli_fetch_assoc($resulat);
                $t=$row['Id_t'];
                $query = "select * from user where id='$t' ";
                $teacher = mysqli_query($con, $query);
                if ($teacher) {
                    $teacher = mysqli_fetch_assoc($teacher);
                    echo "<table><tr><td><div class='post'> ";
                    echo "<div class='row1-container'><span class='row1'><div class='picture'> <img src='$row[thumbnail]' alt='$row[thumbnail]' > </div>";
                    echo "<div class='names'> course name:$row[name] <br> creator name:$teacher[Fname] $teacher[Lname] <br> Price: $row[price]$</div></span></div>";
                    echo "<div class='desc'> $row[Description] </div>";
                    echo "<span class='row3'><div class='date'> posted on $row[Date] </div>";
                    echo "<div class='category'> category: $row[category] </div>";
                    echo "<div class='chatbutton'><a  href='showcourse2.php?course_id=$row[id]'> see course </a></div></span></div></div></td>";
                    echo "</tr></table>";
                }


            }
        } else {
            echo "we had an error while loading your data! please refrech the page.";
        }


        ?>
    </section>
    <div class="footer">
        <footer>
            <p>
                Created by <i class="fa fa-copyright"></i>Ahmad Hawchar, Chadi Ech &
                Taha Haydar
            </p>
        </footer>

    </div>



</body>