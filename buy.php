<?php
 session_start();
 require_once('connection.php');
 if ($_SESSION['isloggedin'] != 'true') {
    header("Location:login.php");
    
}
$id=$_SESSION['id'];

if(!isset($_GET['course_id'])){
    header("location:course-search.php");
}
else{
$course_id=$_GET['course_id'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Credit Card Payment</title>
    <link rel="stylesheet" type="text/css" href="buy.css">
</head>
<body>
    <div class="container">
        <h1>Enter Credit Card Information</h1>
        <?php
       echo" <form action='buy2.php?course_id=$course_id' method='post'>"
        ?>
            <label for="card_number">Card Number:</label>
            <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
            
            <label for="expiration">Expiration Date:</label>
            <input type="text" id="expiration" name="expiration" placeholder="MM / YY" required>
            
            <label for="cvv">CVV:</label>
            <input type="password" id="cvv" name="cvv" placeholder="123" required>
            
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
