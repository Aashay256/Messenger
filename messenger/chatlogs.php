<?php

    // Create connection
	date_default_timezone_set('Asia/Kolkata');
    $conn = new mysqli("localhost", "root", "", "phpfirebase");
    $conn->set_charset('utf8mb4');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 


          $user1u=$_REQUEST['user_1'];
          $user2u=$_REQUEST['user_2'];
          $mess=$_REQUEST['message'];
          $time=date('Y-m-d H:i:s');

          $sql= mysqli_query($conn,"INSERT INTO `chat_history` (`userf`,`usert`,`message`,`time`) VALUES ('".$user1u."','".$user2u."','".$mess."','".$time."')");

 ?>