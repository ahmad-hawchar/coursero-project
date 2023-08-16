<?php
session_start();
if(isset($_GET['receiver-id'])) {
    $id_receiver = $_GET['receiver-id'];
}

if($_SESSION['isloggedin'] != "true") {
    header("location: login.php");
}

$id = $_SESSION['id'];
include("connection.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <link rel="stylesheet" type="text/css" href="recent.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body>

<header>
      <nav>
      <div class="logo">
<<<<<<< HEAD
      <h1 >LOGO</h1>
=======
      <h1><a href="homepage.php">LOGO</a></h1>
>>>>>>> 08ede56fb5700b268bc70d45d79d65760dab0118
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
            <a href="myads.php">My ads</a>
          </li>
          <li>
            <a href="mycourses.php">My courses</a>
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
    <div class="chat-list">
        <?php
        $query = "SELECT * FROM user where id IN(SELECT DISTINCT id_receiver FROM messages where id_sender=$id) OR id IN(
            SELECT DISTINCT id_sender FROM messages where id_receiver=$id AND id_sender NOT IN
             (SELECT DISTINCT id_receiver FROM messages where id_sender=$id ))"; 
        
        $result = mysqli_query($con, $query);
        $num = mysqli_num_rows($result);
        if($num>0){
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['username'];
            $receiver = $row['id'];

            
            if ($receiver != $id) {
                echo "
                <a href='chat.php?receiver-id=$receiver'>
                    <div class='chat-item'>
                        <img src='' alt='Profile Picture'>
                        <div class='chat-details'>
                            <h3>$name</h3>              
                        </div>
                    </div>
                </a>";
            }
        }
      }
      else{
        echo"<h1 class='nomsg'>You have no messages yet!</h1>";
        echo"<a href='search.php' class='browse'><h3>Browse for posts here</h3></a>";
      }
        ?>
    </div>
    <div class="footer" >
    <footer>
      <p>
        Created by <i class="fa fa-copyright"></i>Ahmad Hawchar, Chadi Ech &
        Taha Haydar
      </p>
    </footer>
</body>
</html>
