<?php
session_start();
?>
<?php
if(!isset($_SESSION['isloggedin'])){
 header("Location:login.php");
    return;
}
if ($_SESSION['isloggedin'] !="true" || $_SESSION['role'] != 1) {
    header("Location:login.php");
    return;
}
require_once('connection.php');
if (
   //(isset($_FILES['photo']) && $_FILES['photo'] != "")&&
   (isset($_POST['description']) && $_POST['description'] != "") &&
    (isset($_POST['cat']) && $_POST['cat'] != "") &&
    (isset($_POST['price']) && $_POST['price'] != "")&&
   (isset($_POST['postid']) && $_POST['postid']!="")
) {
    $desc = $_POST['description'];
    $cat = $_POST['cat'];
    $date = date("Y-m-d");
    $id = $_SESSION['id'];
    $price = $_POST['price'];
    $photo = $_FILES['photo']['name'];
    $photo_tmp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($photo_tmp, "photos/$photo");
    $p_id=$_POST['postid'];
    $query ="UPDATE `post` SET `Id`='$p_id',`Date`='$date',`Description`='$desc',`Id_t`='$id',`category`='$cat',`picture`='$Photo',`price`='$price'  where  Id=$p_id and Id_t=$id ;";
    echo"$query";
    $result = mysqli_query($con, $query);
    echo"$query";
    //$result ? header("Location:edit-post.php?done=''&post='$p_id'") : header("Location:edit-post.php?error=''&post='$p_id'");
} else {
    $p_id=$_POST['postid'];
    header("Location:edit-post.php?error=''&post=$p_id");
}










?>