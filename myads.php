<?php session_start(); 
if(!$_SESSION["isloggedin"]){
    header("location:login.php");
    return;
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="myads.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body onload="categoryfill()">
  <header>
    <div class="logo">
      <h1><a href="homepage.php">LOGO</a></h1>
    </div>
    <div class="title">
       MY ADS
</div>
<div class="homepage"><a href="homepage.php" >GO BACK TO HOMEPAGE</a></div>
  </header>
    <section class="columns">
        <?php
    //-------------------------------------------------------------------------------------------------------------------------------------------------
        require_once("connection.php");
    //i need to sanitize all inputs and strip spaces from search inputs
          $id=$_SESSION["id"];
          $query = "SELECT * FROM post 
            WHERE id_t =$id  
            ORDER BY date";
    //-------------------------------------------------------------------------------------------------------------------------------------------------
        $result = mysqli_query($con, $query);
        if ($result) {
            $rows = mysqli_num_rows($result);        
    //-------------------------------------------------------------------------------------------------------------------------------------------------
                    for ($i = 0; $i < $rows ; $i++) {
                        $row = mysqli_fetch_assoc($result);
                        $query = "select * from user where id='$row[Id_t]' ";
                        $teacher = mysqli_query($con, $query);
                        if ($teacher) {
                        $teacher = mysqli_fetch_assoc($teacher);
                        echo "<div class='post'> ";
                        echo "<span class='row1'><div class='picture'> <img loading='lazy' src='$row[picture]' alt='$row[picture]' > </div>";
                        echo "<div class='names'> First name:$teacher[Fname] <br> Last name:$teacher[Lname] </div></span>";
                        echo "<div class='desc'> $row[Description] </div>";
                        echo "<span class='row3'><div class='date'> posted on $row[Date] </div>";
                        echo "<div class='category'> category: $row[category] </div>";
                        echo "<div class='chatbutton'><a  href='edit-post.php?post=$row[Id]'> edit Post  </a></div></span>";
                        echo "</div > ";
                    }
                
                }
            }
            else{
                echo"we had an error while loading your data! please refrech the page.";
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