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