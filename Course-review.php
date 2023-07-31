<?php
session_start();
require_once('connection.php');
if ($_SESSION['isloggedin'] != 'true') {
    header("Location:login.php");
    return;
} else {
    if (
        (isset($_GET['page']) && $_GET['page'] != "") &&
        (isset($_GET['nbrpost']) && $_GET['nbrpost'] != "") &&
        (isset($_GET['postid']) && $_GET['postid'] != "") &&
        (isset($_GET['review']) && $_GET['review'] != "")&&
        (isset($_GET["cat"]))&&isset($_GET['filter'])&&isset($_GET['search-content'])
    ) {
        $review = $_GET['review'];
        $nbr = $_GET["nbrpost"];
        $page = $_GET["page"];
        $p_id = $_GET["postid"];
        $id = $_SESSION["id"];
        $query = "SELECT * from review_courses where course_id=$p_id and student_id=$id";
        $res = mysqli_query($con, $query);
        $rows = mysqli_num_rows($res);
        $cat=$_GET["cat"];
    $filter=$_GET['filter'];
    $search=$_GET['search-content'];
        if ($rows != 0) {
            $query = "UPDATE review_courses SET rating='$review' WHERE course_id=$p_id and student_id=$id";
            $res = mysqli_query($con, $query);
            if ($res) {
                header("Location:course-search.php?page=$page&nbrpost=$nbr&filter=$filter&cat=$cat&search-content=$search");
            } else {
                echo "error while updating your review! please go back and try again";
            }
        } else {
            $query = "INSERT into review_courses  VALUES($id,$p_id,'$review')";
            $res = mysqli_query($con, $query);

            if ($res) {

                header("Location:course-search.php?page=$page&nbrpost=$nbr&filter=$filter&cat=$cat&search-content=$search");
            } else {
                echo "error while adding a review! please go back and try again";
            }
        }
    }
}