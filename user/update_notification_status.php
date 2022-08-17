<?php
   include('../includes/indexconfig.php');
   session_start();
   $uid=$_SESSION['UID'];

   $notification_id = $_POST['notification_id'];
   
   //$row = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `notifications` WHERE `user_id` = '".$uid."' ORDER BY id DESC;"));
   mysqli_query($con, "UPDATE `notifications` SET `status`=1 WHERE `id` = '".$notification_id."';");
?>