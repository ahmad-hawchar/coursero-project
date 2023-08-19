<?php
session_start();
if ($_SESSION['isloggedin'] != 'true' || $_SESSION['role']!=1) {
    header("Location:login.php"); 
    
}
$id=$_SESSION['id'];
require_once('connection.php');
if(!isset($_GET['course_id'])){
    header("location:profile.php?id=$id");
}
else{
    $course_id=$_GET['course_id'];
    $query1="SELECT * FROM course WHERE id=$course_id AND Id_t=$id";
    $result1=mysqli_query($con,$query1);
    $num=mysqli_num_rows($result1);
    if($num<1)
    header("location:showcourses.php?course_id=$course_id");
   else{
        $row1=mysqli_fetch_assoc($result1);
 
    ?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Course</title>
 <link rel="stylesheet" href="createpost.css">
</head>
<body>


  <h1>Edit the Course</h1>
  <?php
  echo"<form action='edit_course2.php?id=$course_id' method='POST'  enctype='multipart/form-data'>";
    
    $videos=$row1['videos'];
    $tab=explode(',',"$videos");
    echo"<label for='course_name'>Course Name</label>";
    echo " <input type='text' id='course_name' name='course_name' value='".$row1['name']."'required>";
    echo "<br><br>";
    echo"<label for='thumbnail'>Upload the thumbnail:</label>";
    echo"<input type='file' name='thumbnail'required accept='image/*'>";
    echo "<br><br>";
    echo"<label for='num_videos'>Number of Videos to Upload:</label>";
    echo "<input type='number'id='num_videos' name='num_videos' min='1'max='15' value='".$row1['num_videos']."'required>";
    echo "<br><br>";
    echo"<label for='video_upload_fields'>Upload Videos:</label>";
    echo"<div id='video_upload_fields'>";
    for($i=0;$i<$row1['num_videos'];$i++){
    echo"<input type='file' name='video$i'required accept='video/*'>";
    }
    echo"</div>";
    echo "<br>";
    echo"<label for='description'>Course Description:</label>";
    echo"<textarea id='description' name='description'  required>".$row1['Description']."</textarea>";
    echo "<br><br>";
    echo"<label for='cat'>Categories:</label>";
    echo "<select id='cat' name='cat' required>";
      
    $cat=$row1['category'];
            $query = "SELECT * From Categories  ";
            $result = mysqli_query($con, $query);
            $rows = mysqli_num_rows($result);
            for ($i = 0; $i < $rows; $i++) {
                $row = mysqli_fetch_assoc($result);
                if($row['name']==$cat)
                echo "<option selected>".$row['name']."</option>";
                else
                echo "<option>".$row['name']."</option>";
            }



            ////////////
    echo "</select>";
    echo "<br><br>";
    echo"<label for='price'>Price:</label>";
    echo"<input type='number' id='price' name='price' value='".$row1['price']."' required>";
    echo "<br><br>";
    echo"<input type='submit' value='Submit'>";
         if(isset($_GET['error'])){
            echo"<td style='color:red'> we had a problem editing your course! try again later</td>";
         } 
         if(isset($_GET['done'])){
            echo"<td style='color:green;'> course was edited successfully.</td>";
         }
         }}?>
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