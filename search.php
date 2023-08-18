<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="search.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script>
        <?php
        //if someone pressed on a certain category from the home page
        if (isset($_GET["cat"])) {
            echo ("let cat='" . $_GET['cat'] . "';");
        } else {
            echo "let cat='';";
        }
        if (isset($_GET["filter"])) {
            echo ("let filter='" . $_GET['filter'] . "';");
        } else {
            echo "let filter='';";
        }
        if (isset($_GET["search-content"])) {
            echo ("let searchContent='" . $_GET['search-content'] . "';");
        } else {
            echo "let searchContent='';";
        } ?>

        function fill() {
            let select1 = document.getElementById("cat").options;
            test1 = false
            let select2 = document.getElementById("filter").options;
            test2 = false
            let search = document.getElementById("searchcontent");
            for (let i of select1) {
                if (i.text == cat) {
                    i.selected = true;
                    test1 = true

                }
            }
            for (let i of select2) {
                if (i.value == filter) {
                    i.selected = true;
                    test2 = true
                }

            }
            search.value = searchContent;
            if (!test1) { select1[0].selected = true; }
            if (!test2) { select2[0].selected = true; }
        }
    </script>
</head>

<body <?php if (isset($_GET['cat'])) {
    echo "onload='fill()'";
} ?>>
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

    <nav style='background-color:#e9e9e9;'>
        <form method="get" action="search.php">

            <div class="category-filter">

                <div class="even"><label class="lab1">Filter By:</label>
                    <select name="filter" id="filter" class="select1">
                        <option></option>
                        <option value="date asc">date(low to high)</option>
                        <option value="date desc">date(high to low)</option>
                        <option value="price asc">price(low to high)</option>
                        <option value="price desc">price(high to low)</option>
                        <option value="male">gender(male)</option>
                        <option value="female">gender(female)</option>
                    </select>
                </div>

                <div class="even"><label class="lab2">catergory:</label>
                    <select id="cat" name="cat" class="select2">
                        <option></option>
                        <option>informatique</option>
                        <option>private-training</option>
                        <option>informatique</option>
                        <option>informatique</option>
                        <option>informatique</option>
                        <option>informatique</option>
                        <option>informatique</option>
                        <option>informatique</option>
                    </select>
                </div>

            </div>

            <div class="search">
                <div class="search-container icone">
                    <input type="text" placeholder="Search.." id="searchcontent" name="search-content" />
                    <button type="submit"><i class="fa fa-search"></i></button>


                </div>
            </div>
            </div>
        </form>
    </nav>


    <section class="columns">
        <?php
        //-------------------------------------------------------------------------------------------------------------------------------------------------
        require_once("connection.php");
        //
        // comment: this is for giving a default to any input that have not being specified while pressing on the search button
        if (isset($_GET["cat"]) && $_GET["cat"] != "") {
            $cat = $_GET["cat"];
        } else {
            $cat = false;
        }
        if (isset($_GET["search-content"]) && $_GET["search-content"] != "") {
            $search = $_GET["search-content"];
        } else {
            $search = "*";
        }
        if (isset($_GET["filter"]) && $_GET["filter"] != "") {
            $filter = $_GET["filter"];
            if ($filter == "male" || $filter == "female") {
                $gender = $filter;
                $filter = "DATE DESC"; //Description ASC
            } else {
                $gender = '';
            }
        } else {
            $filter = "DATE DESC";
            $gender = '';
        }
        if ($search != "*") {
            $search = explode(" ", $search);
            if (count($search) >= 2) {
                $Fname = $search[0];
                $Lname = $search[1];
                $search = true;
            } else if (count($search) == 1) {
                $Fname = $search[0];
                $Lname = $search[0];
                $search = true;
            }
        } else {
            $search = false;
            $Fname = "";
            $Lname = "";
        }
        //-------------------------------------------------------------------------------------------------------------------------------------------------
        if ($search) {
            //if a name have been specified 
            $query = "SELECT * FROM post 
            WHERE id_t IN (SELECT id FROM user WHERE ((Fname LIKE '%$Fname%' OR Lname LIKE '%$Lname%') AND gender LIKE'$gender%') AND category LIKE '%$cat%') AND id NOT IN(SELECT id FROM featured)
            ORDER BY $filter;";
        } else {
            //if no name have been specified
            if ($gender == '') {
                $query = "SELECT * FROM post 
                    WHERE category LIKE'%$cat%' AND id NOT IN(SELECT id FROM featured)  ORDER BY $filter  ;";
                ;
            } else {
                $query = "SELECT * FROM post 
            WHERE category LIKE'%$cat%' AND id_t IN (SELECT id FROM user WHERE gender LIKE'$gender%') AND id NOT IN(SELECT id FROM featured) ORDER BY $filter  ;";
                ;
            }
        }
        $query1 = "SELECT * FROM post
    WHERE id IN (SELECT id FROM featured) AND category LIKE '%$cat%';";
        //-------------------------------------------------------------------------------------------------------------------------------------------------
        $result = mysqli_query($con, $query);
        if ($result) {
            $rows = mysqli_num_rows($result);
            $featured = mysqli_query($con, $query1);
            $frows = mysqli_num_rows($featured);
            //-------------------------------------------------------------------------------------------------------------------------------------------------        
            if (isset($_GET["page"])) {
                $nbrpage = $_GET["page"];
            } else {
                $nbrpage = 1;
            }
            //-------------------------------------------------------------------------------------------------------------------------------------------------
            //we only show featured posts while on the first page! therefor i need to send the page that we are currently on by url
           if(isset($_GET['search-content'])){
            $search=$_GET['search-content'];
           }
           else{
            $search="";
           }
            if ($nbrpage == 1) {
                if(isset($_GET["filter"])){
                    $filter = $_GET["filter"];
                }
               

                for ($i = 0; $i < $frows; $i++) {
                    $frow = mysqli_fetch_assoc($featured);
                    $fquery = "select * from user where id='$frow[Id_t]' ";
                    $teacher = mysqli_query($con, $fquery);
                    $teacher = mysqli_fetch_assoc($teacher);
                    echo "<table><tr><td><div class='post'> ";
                    echo "<span class='row1'><div class='picture'> <img src='$frow[picture]' alt='$frow[picture]' > </div>";
                    echo "<div class='names'> <SPAN style='color:red''>FEATURED!</SPAN> <br>First name:$teacher[Fname] <br> Last name:$teacher[Lname]   <br>price:$frow[price] $/hr </div></span>";
                    echo "<div class='desc'> $frow[Description] </div>";
                    echo "<span class='row3'><div class='date'> posted on $frow[Date] </div>";
                    echo "<div class='category'> category: $frow[category] </div>";
                    echo "<div class='chatbutton'><a  href='chat.php?receiver-id=$frow[Id_t]'> chat ICON  </a></div></span>";
                    if (isset($_SESSION['id'])) {
                        $favorited = $frow['Id'];
                        $favoritedid = $_SESSION['id'];
                        $favquery = "select * from fav where id_post=$favorited and id_student=$favoritedid ";
                        $resultat = mysqli_query($con, $favquery);
                        if (mysqli_num_rows($resultat) > 0) {
                            $reviewquery = "SELECT * FROM review_post where post_id=$favorited and student_id=$favoritedid  ";
                            $reviewres = mysqli_query($con, $reviewquery);
                            if (mysqli_num_rows($reviewres) > 0) {
                                $reviewres = mysqli_fetch_assoc($reviewres);
                                if ($reviewres['rating'] == 'up') {
                                    echo "</div></td><td class='fav'><div class='rating-button'> <a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search'><div class='upped'><img src='arrow-up-solid.svg' /></div></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-down-solid.svg' /></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-solid.svg' /></a></div></td></tr></table> ";
                                } else {
                                    echo "</div></td><td class='fav'><div class='rating-button'> <a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-up-solid.svg' /></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search'><div class='downed'><img src='arrow-down-solid.svg' /></div></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-solid.svg' /></a></div></td></tr></table> ";
                                }
                            }
                            else{echo "</div></td><td class='fav'><div class='rating-button'> <a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-up-solid.svg' /></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-down-solid.svg' /></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-solid.svg' /></a></div></td></tr></table> ";}
                        } else {
                            $reviewquery = "SELECT * FROM review_post where post_id=$favorited and student_id=$favoritedid  ";
                            $reviewres = mysqli_query($con, $reviewquery);
                            if (mysqli_num_rows($reviewres) > 0) {
                                $reviewres = mysqli_fetch_assoc($reviewres);
                                if ($reviewres['rating'] == 'up') {
                                    echo "</div></td><td class='fav'><div class='rating-button'> <a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search'><div class='upped'><img src='arrow-up-solid.svg' /></div></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-down-solid.svg' /></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search '><img src='star-regular.svg' /></a></div></td></tr></table> ";
                                } else {
                                    echo "</div></td><td class='fav'><div class='rating-button'> <a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-up-solid.svg' /></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search'><div class='downed'><img src='arrow-down-solid.svg' /></div></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-regular.svg' /></a></div></td></tr></table> ";
                                }
                            } else {
                                echo "</div></td><td class='fav'><div class='rating-button'><a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-up-solid.svg' /></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-down-solid.svg' /></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$frow[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-regular.svg' /></a></div></td></tr></table> ";
                            }
                        }
                    }
                    else{echo"</tr></table>";}

                }


                //after we show feature posts we make a function to fill the rest of the page
                for ($i = 0; $i < (15 - $frows) && $i < $rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $query = "select * from user where id='$row[Id_t]' ";
                    $teacher = mysqli_query($con, $query);
                    if ($teacher) {
                        $teacher = mysqli_fetch_assoc($teacher);
                        echo "<table><tr><td><div class='post'> ";
                        echo "<span class='row1'><div class='picture'> <img src='$row[picture]' alt='$row[picture]' > </div>";
                        echo "<div class='names'> First name:$teacher[Fname] <br> Last name:$teacher[Lname] <br>  price:$row[price] $/hr </div></span>";
                        echo "<div class='desc'> $row[Description] </div>";
                        echo "<span class='row3'><div class='date'> posted on $row[Date] </div>";
                        echo "<div class='category'> category: $row[category] </div>";
                        echo "<div class='chatbutton'><a  href='chat.php?receiver-id=$row[Id_t]'> chat ICON  </a></div></span>";
                        if (isset($_SESSION['id'])) {
                            $favorited = $row['Id'];
                            $favoritedid = $_SESSION['id'];
                            $favquery = "select * from fav where id_post=$favorited and id_student=$favoritedid ";
                            $resultat = mysqli_query($con, $favquery);
                            if (mysqli_num_rows($resultat) > 0) {
                                $reviewquery = "SELECT * FROM review_post where post_id=$favorited and student_id=$favoritedid  ";
                                $reviewres = mysqli_query($con, $reviewquery);
                                if (mysqli_num_rows($reviewres) > 0) {
                                    $reviewres = mysqli_fetch_assoc($reviewres);
                                    if ($reviewres['rating'] == 'up') {
                                        echo "</div></td><td class='fav'><div class='rating-button'> <a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><div class='upped'><img src='arrow-up-solid.svg' /></div></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-down-solid.svg' /></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-solid.svg' /></a></div></td></tr></table> ";
                                    } else {
                                        echo "</div></td><td class='fav'><div class='rating-button'> <a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-up-solid.svg' /></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><div class='downed'><img src='arrow-down-solid.svg' /></div></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-solid.svg' /></a></div></td></tr></table> ";
                                    }
                                } else {
                                    echo "</div></td><td class='fav'><div class='rating-button'> <a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-up-solid.svg' /></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-down-solid.svg' /></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-solid.svg' /></a></div></td></tr></table> ";
                                }
                            } else {
                                $reviewquery = "SELECT * FROM review_post where post_id=$favorited and student_id=$favoritedid  ";
                                $reviewres = mysqli_query($con, $reviewquery);
                                if (mysqli_num_rows($reviewres) > 0) {
                                    $reviewres = mysqli_fetch_assoc($reviewres);
                                    if ($reviewres['rating'] == 'up') {
                                        echo "</div></td><td class='fav'><div class='rating-button'> <a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><div class='upped'><img src='arrow-up-solid.svg' /></div></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-down-solid.svg' /></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-regular.svg' /></a></div></td></tr></table> ";
                                    } else {
                                        echo "</div></td><td class='fav'><div class='rating-button'> <a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-up-solid.svg' /></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><div class='downed'><img src='arrow-down-solid.svg' /></div></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-regular.svg' /></a></div></td></tr></table> ";
                                    }
                                } else {
                                    echo "</div></td><td class='fav'><div class='rating-button'><a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-up-solid.svg' /></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-down-solid.svg' /></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-regular.svg' /></a></div></td></tr></table> ";
                                }
                            }

                        }
                        else{echo"</tr></table>";}
                    }
                }
            }




            //-------------------------------------------------------------------------------------------------------------------------------------------------
            else { if(isset($_GET["filter"])){
                $filter = $_GET["filter"];
            }
           ;
                //if we are on a page different than page 1
                //cant i just start fetching from line 15 and get 15 posts
                for ($i = 0; $i < $rows; $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $query = "select * from user where id='$row[Id_t]' ";
                    $teacher = mysqli_query($con, $query);
                    if ($teacher) {
                        if ($i > (($nbrpage - 1) * 15 - 1 - $frows) && ($i < (($nbrpage - 1) * 15 - $frows) + 15)) {
                            $teacher = mysqli_fetch_assoc($teacher);
                            echo "<table><tr><td><div class='post'> ";
                            echo "<span class='row1'><div class='picture'> <img src='$row[picture]' alt='$row[picture]' > </div>";
                            echo "<div class='names'> First name:$teacher[Fname] <br> Last name:$teacher[Lname] <br>price:$row[price] $/hr</div></span>";
                            echo "<div class='desc'> $row[Description] </div>";
                            echo "<span class='row3'><div class='date'> posted on $row[Date] </div>";
                            echo "<div class='category'> category: $row[category] </div>";
                            echo "<div class='chatbutton'><a  href='chat.php?receiver-id=$row[Id_t]'> chat ICON  </a></div></span>";
                            if (isset($_SESSION['id'])) {
                                $favorited = $row['Id'];
                                if (isset($_SESSION['id'])) {
                                    $favoritedid = $_SESSION['id'];
                                    $favquery = "select * from fav where id_post=$favorited and id_student=$favoritedid ";
                                    $resultat = mysqli_query($con, $favquery);
                                    if (mysqli_num_rows($resultat) > 0) {
                                        $reviewquery = "SELECT * FROM review_post where post_id=$favorited and student_id=$favoritedid  ";
                                        $reviewres = mysqli_query($con, $reviewquery);
                                        if (mysqli_num_rows($reviewres) > 0) {
                                            $reviewres = mysqli_fetch_assoc($reviewres);
                                            if ($reviewres['rating'] == 'up') {
                                                echo "</div></td><td class='fav'><div class='rating-button'> <a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><div class='upped'><img src='arrow-up-solid.svg' /></div></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-down-solid.svg' /></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-solid.svg' /></a></div></td></tr></table> ";
                                            } else {
                                                echo "</div></td><td class='fav'><div class='rating-button'> <a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-up-solid.svg' /></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><div class='downed'><img src='arrow-down-solid.svg' /></div></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-solid.svg' /></a></div></td></tr></table> ";
                                            }
                                        } else {
                                            echo "</div></td><td class='fav'><div class='rating-button'> <a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-up-solid.svg' /></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-down-solid.svg' /></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-solid.svg' /></a></div></td></tr></table> ";
                                        }
                                    } else {
                                        $reviewquery = "SELECT * FROM review_post where post_id=$favorited and student_id=$favoritedid  ";
                                        $reviewres = mysqli_query($con, $reviewquery);
                                        if (mysqli_num_rows($reviewres) > 0) {
                                            $reviewres = mysqli_fetch_assoc($reviewres);
                                            if ($reviewres['rating'] == 'up') {
                                                echo "</div></td><td class='fav'><div class='rating-button'> <a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><div class='upped'><img src='arrow-up-solid.svg' /></div></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-down-solid.svg' /></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-regular.svg' /></a></div></td></tr></table> ";
                                            } else {
                                                echo "</div></td><td class='fav'><div class='rating-button'> <a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-up-solid.svg' /></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><div class='downed'><img src='arrow-down-solid.svg' /></div></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-regular.svg' /></a></div></td></tr></table> ";
                                            }
                                        } else {
                                            echo "</div></td><td class='fav'><div class='rating-button'><a href='review.php?review=up&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-up-solid.svg' /></a><a href='review.php?review=down&page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search'><img src='arrow-down-solid.svg' /></a></div><div class='fav-button'><a href='processfav.php?page=$nbrpage&nbrpost=$i&postid=$row[Id]&filter=$filter&cat=$cat&search-content=$search '> <img src='star-regular.svg' /></a></div></td></tr></table> ";
                                        }
                                    }
                                }
                            }
                            else{echo"</tr></table>";}
                        }
                    }
                }
            }
        }
        ?>
    </section>

    <section class="pages">
        <?php

        $nbrpages = $rows / 15;
        $nbrpages = (int) $nbrpages;
        if (isset($_GET['search-content'])) {
            $search = $_GET['search-content'];
        }
        if (isset($_GET['cat'])) {
            $cat = $_GET['cat'];
        }
        if (isset($_GET['filter'])) {
            $filter = $_GET['filter'];
        }
        for ($i = 0; $i <= $nbrpages; $i++) {
            $j = $i + 1;
            if ($i == $nbrpage - 1) {
                echo "<div >";
                echo "<a  class='selectd' href='search.php?filter=$filter&cat=$cat&search-content=$search&page=$j'> $j &nbsp </a>";
                echo "</div>";
            } else {
                echo "<div >";
                echo "<a  class='notselected'href='search.php?filter=$filter&cat=$cat&search-content=$search&page=$j'> $j &nbsp </a>";
                echo "</div>";
            }

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