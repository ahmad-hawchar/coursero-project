<?php
session_start();
require_once('connection.php');
if ($_SESSION['isloggedin'] != 'true') {
    header("Location:login.php");
    return;
}
else{
if (
    (isset($_GET['page']) && $_GET['page'] != "") &&
    (isset($_GET['nbrpost']) && $_GET['nbrpost'] != "")&&
    (isset($_GET['postid']) && $_GET['postid'] != "")&&
    (isset($_GET["cat"]))&&isset($_GET['filter'])&&isset($_GET['search-content'])
) {
    $nbr=$_GET["nbrpost"];
    $page=$_GET["page"];
    $p_id=$_GET["postid"];
    $id=$_SESSION["id"];
    $cat=$_GET["cat"];
    $filter=$_GET['filter'];
    $search=$_GET['search-content'];
 $query="SELECT * from fav where id_post=$p_id and id_student=$id";
 $res=mysqli_query($con,$query);
 $rows=mysqli_num_rows($res);
 if($rows!=0){
$query="DELETE FROM  fav WHERE id_post=$p_id AND id_student=$id";
$res=mysqli_query($con,$query);
if($res){
header("Location:search.php?page=$page&nbrpost=$nbr&filter=$filter&cat=$cat&search-content=$search");
}
else{
    echo"error while adding a favorite post! please go back and try again";
}
 }
else{
$query="INSERT into fav VALUES($id,$p_id)";
$res=mysqli_query($con,$query);

if($res){
    header("Location:search.php?page=$page&nbrpost=$nbr&filter=$filter&cat=$cat&search-content=$search"); 
}
else{
    echo"error while removing a favorite post! please go back and try again";
}
 }
}
}