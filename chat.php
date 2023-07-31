<?php
session_start();

if($_SESSION['isloggedin'] != "true"){

      $id_receiver=$_GET['receiver-id'];

     header("location:login.php?tochat='1'&receiver='$id_receiver'");}
$id=$_SESSION['id'];
include("connection.php");
if(isset($_GET['receiver-id'])){
    $id_receiver=$_GET['receiver-id'];
  
    }
    else{
        header("location:search.php");
    }
$query=" SELECT * FROM user WHERE id=$id_receiver";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_array($result);
$uname=$row['username'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="chat.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
</head>

<script>
    //for auto refresh chat div
     $(document).ready(function(){
        setInterval(function(){
            $("#chat").load(window.location.href+" #chat");
        }, 3000);
     });

     
    // Scroll to the bottom of the chat container
    function scrollToBottom() {
        var chatContainer = document.getElementById("chat");
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // Call the scrollToBottom function when the page is fully loaded
    window.addEventListener("load", scrollToBottom);
</script>

    
   

<body  onload="href='#bottom'">

  <nav class=navbar>
  <a href="recentChat.php"><img src="back.png" alt="back" srcset=""></a>
  <?php
  echo "<h2>$uname</h2>"
  ?>

  </nav>
 

   
   
    <section>
    <div class="chat-container">
      <ul class="chat-messages">
        <div id="chat">
        <?php
$query="SELECT * FROM messages WHERE (id_sender=$id AND id_receiver=$id_receiver ) OR (id_sender=$id_receiver AND id_receiver=$id ) ";
$result=mysqli_query($con,$query);
$row=mysqli_fetch_array($result);
$num=mysqli_num_rows($result);
if($num>0){
do{
    
    if($id!=$row['id_sender']){
        
        echo "<li class='chat-message'><div class='r-message'> <p class='message-text'>".$row['cont']."</p></div></li><br>";
    }
    else{
        echo "<li class='chat-message'><div class='s-message'><p class='message-text'>".$row['cont']."</p></div></li><br>";
    }
}while($row=mysqli_fetch_array($result));
}
       echo" </div>";
        
       echo ' <form action="send.php?idr='.$id_receiver.'" method="post">';
       echo ' <input type="text" class="chat-input" placeholder="Type your message..." name="message" autocomplete="off">';
        echo '<button class="send-button" id="button">Send</button>';
        echo'</form>';
       
        ?>
        <p class='bottom' id='bottom'>
            
        </p>
     
    </section>
</body>
</html>