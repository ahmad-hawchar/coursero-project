<!DOCTYPE html>
<html>
<?php
session_start();
require_once("connection.php");
?>

<head>
  <title>Home page</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script>
    function add() {
      let elements = document.querySelectorAll('.photo');
      elements.forEach((element) => {
              element.classList.add('blur-img');
          });
    }
    function remove() {
      let elements = document.querySelectorAll('.photo');
      elements.forEach((element) => {
        element.classList.remove('blur-img');
      })
    }



  </script>
</head>

<body onload="fill_list()"> <!--to put the first 5 posts from favorites list!        -->
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
  <?php
  if (isset($_SESSION["isloggedin"])) {

    if ($_SESSION["isloggedin"] == "true") {
      echo "";

    } else {
      echo "
  <div class='welcome'>
  <div class='center'>
  <h2>Welcome to Our Website</h2>
  <br><br>
  <p>Here you can find the expert and best fit person to solve your problems </p>
  <br><br>
  <a href='Register.php' class='register'> REGISTER NOW</a>
</div>
</div>";
    }

  } else {
    echo "
<div class='welcome'>
<div class='center'>
<h2>Welcome to Our Website</h2>
<br><br>
<p>Here you can find the expert and best fit person to solve your problems </p>
<br><br>
<a href='Register.php' class='register'> REGISTER NOW</a>
</div>
</div>";
  }
  ?>



    <div class="search">
      <div class="search-container">
        <form action="search.php" method="GET" class="icone">
          <input type="text" placeholder="Search for teachers! " name="search-content" />
          <input type="text" placeholder="Search.." name="filter" value="" hidden="hidden" />
          <input type="text" placeholder="Search.." name="cat" value="" hidden="hidden" />

          <button type="submit"><i class="fa fa-search"></i></button>

        </form>
      </div>
    </div>
    </div>

  <section>

    <div class="c">
      <?php

      //to get all the data of the favorites posts 
      if (isset($_SESSION['isloggedin']) && isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $query = "select * from fav where 	id_student='$id'";
        $result = mysqli_query($con, $query);
        if (!$result) {
          echo '  echo <div  style="text-align:center" >
          sorry we had an error loading your favorites list! please refrech the page.</div>';
        } else {
          $row = mysqli_num_rows($result);
          if ($row == 0) {
            echo '<div style="text-align:center">you have no favorites yet! feel free to add anyone to your favorites list to see them here.</div>';
          } else {

            $query = "select * from post  join fav 
            on post.id=fav.id_post
             where fav.id_student=$id
             order by post.Description";
            $result = mysqli_query($con, $query);
            if ($result) {
              $var = "";
              for ($i = 0; $i < $row; $i++) {
                $content = mysqli_fetch_assoc($result);
                $query = "select * from user where id='$content[Id_t]'";
                $teacher = mysqli_query($con, $query);
                $teacher = mysqli_fetch_assoc($teacher);
                if ($i != $row - 1) {
                  $var .= "[ '$content[Id]','$content[Description]', '$teacher[Lname]','$teacher[Fname]','$teacher[Date_Of_Birth]','$content[picture]'],";
                  //put all the data in a string variable and then put the whole variable in a javascript array to use it later
                } else {
                  $var .= "[ '$content[Id]','$content[Description]', '$teacher[Lname]','$teacher[Fname]','$teacher[Date_Of_Birth]','$content[picture]']";
                }
              }
            }
            ?>
            <!-- javascript functions that handle the next and previous buttons for favorites posts       -->
            <script>
              let index = 0;
              let temp = 0;
              let ct = 0;
              let tempt = 0;
              let content = [<?php echo "$var" ?>];
              let j;
              //onload function to fill the posts when the page loads
              function fill_list() {


                let favorites = document.getElementById('favs');
                let msg = ""
                for (let i = 0; i < 5 && i < content.length; i++) {
                  if (temp == 4) {
                    return
                  }
                  j = favorites
                  temp = i
                  let description=content[i][1];
                  if(description.length>10){
                    description=description.substring(0,11);
                    description+=" <a href='post.php?post-id='"+content[i][0] +">readmore...</a>"
                  }
                  msg += "<div class='favpost'> <div class='picture'> <img src='" + content[i][5] + "'></div>" + "<div class='name'>" + content[i][3] + '<br> ' + content[i][2] + "</div>" + "<div class='description'>" + description + '</div></div>';




                }
                j.innerHTML += msg;
                index = temp
              }
              //0 1 2 3 4
              //5 6 7 8 9
              //10 11 12 13
              function handlenext() {
                index = temp
                if (content.length - 1 <= 4) {
                  return
                }
                if (temp >= content.length - 1) {
                  index -= ct
                }

                let favorites = document.getElementById('favs')
                let j = favorites;
                let msg = ""
                j.innerHTML = ""
                let count = 0
                for (let i = index + 1; i < index + 6; i++) {
                  if (i > content.length - 1) {
                    if (count == 0) {

                      break
                    }
                    index = temp
                    tempt = temp
                    j.innerHTML += msg
                    return
                  }
                  let description=content[i][1];
                  if(description.length>10){
                    description=description.substring(0,11);
                    description+=" <a href='post.php?post-id='"+content[i][0] +">readmore...</a>"
                  }
                  msg += "<div class='favpost'> <div class='picture'> <img src='" + content[i][5] + "'></div>" + "<div class='name'>" + content[i][3] + '<br> ' + content[i][2] + "</div>" + "<div class='description'>" + description + '</div></div>';

                  temp = i
                  tempt = temp
                  count++
                  ct = count

                }
                j.innerHTML += msg
                index = temp
                return

              }
              //0 1 2 3 4
              //5 6 7 8 9
              //10 11 12 13

              function handleprevious() {
                tempt = index
                if (content.length <= 4) {
                  return
                }

                let favorites = document.getElementById('favs')
                let nbr = document.getElementsByClassName("favpost").length
                let j = favorites;
                let msg = "";
                j.innerHTML = ""


                for (let i = index - ct - 4; i < index - ct + 1; i++) {
                  let description=content[i][1];
                  if(description.length>10){
                    description=description.substring(0,11);
                    description+=" <a href='post.php?post-id='"+content[i][0] +">readmore...</a>"
                  }
                  msg += "<div class='favpost'> <div class='picture'> <img src='" + content[i][5] + "'></div>" + "<div class='name'>" + content[i][3] + '<br> ' + content[i][2] + "</div>" + "<div class='description'>" + description + '</div></div>';
                
                }

                tempt = temp - 5 - ct
                index = tempt

                if (index <= 3) {
                  index = 4
                  tempt = 4
                }
                ct = 0
                if (tempt < 4)
                  temp = tempt + 5
                else
                  temp = tempt
                j.innerHTML += msg

              }




            </script>
            <?php
            echo ("<div class='fav'>
        <div class='arrows'><button  onclick=" . "handleprevious()" . " value='previous'><img src='prevarrow.png'></button></div>");
            echo
              "<div id='favs'> 
              
              </div>
        <div class='arrows'><button  onclick=" . "handlenext()" . " value='previous'><img src='nextarrow.png'></button></a></div>
        </div>";

          }
        }
      }

      ?>
      <div>
        <center>
          <h2 class="label"> Categories</h2>
        </center>
      </div>
      <div class="intro">
        <p class="item">
          <img src="Teacher-in-front-of-chalkboard.jpeg" class="photo" onmouseover="add(this)"
            onmouseout="remove(this)" />
            <a href='search.php?cat=informatique'> <button class="overlay-button">browse informatique posts</button></a>
        </p>
        <p class="item">
          <img src="Teacher-in-front-of-chalkboard.jpeg" class="photo" onmouseover="add(this)"
            onmouseout="remove(this)" />
            <a href='search.php?cat=informatique'> <button class="overlay-button">browse informatique posts</button></a>
        </p>
        <p class="item">
          <img src="Teacher-in-front-of-chalkboard.jpeg" class="photo" onmouseover="add(this)"
            onmouseout="remove(this)" />
          <a href='search.php?cat=informatique'> <button class="overlay-button">browse informatique posts</button></a>
        </p>
        <p class="item">
          <img src="Teacher-in-front-of-chalkboard.jpeg" class="photo" onmouseover="add(this)"
            onmouseout="remove(this)" />
            <a href='search.php?cat=informatique'> <button class="overlay-button">browse informatique posts</button></a>
        </p>
        <p class="item">
          <img src="Teacher-in-front-of-chalkboard.jpeg" class="photo" onmouseover="add(this)"
            onmouseout="remove(this)" />
            <a href='search.php?cat=informatique'> <button class="overlay-button">browse informatique posts</button></a>
        </p>
        <p class="item">
          <img src="Teacher-in-front-of-chalkboard.jpeg" class="photo" onmouseover="add(this)"
            onmouseout="remove(this)" />
            <a href='search.php?cat=informatique'> <button class="overlay-button">browse informatique posts</button></a>
        </p>
        <p class="item">
          <img src="Teacher-in-front-of-chalkboard.jpeg" class="photo" onmouseover="add(this)"
            onmouseout="remove(this)" />
            <a href='search.php?cat=informatique'> <button class="overlay-button">browse informatique posts</button></a>
        </p>
        <p class="item">
          <img src="Teacher-in-front-of-chalkboard.jpeg" class="photo" onmouseover="add(this)"
            onmouseout="remove(this)" />
            <a href='search.php?cat=informatique'> <button class="overlay-button">browse informatique posts</button></a>
        </p>

      </div>
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

</html>