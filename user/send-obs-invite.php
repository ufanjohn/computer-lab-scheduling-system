<?php
    include('../includes/indexconfig.php');
    session_start();
    $uid=$_SESSION['UID'];

    $firstname = $_POST['fname'];

    $usersql = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$uid."' "); 
    $row = mysqli_fetch_array($usersql);
    $requester = $row['firstname'] .' '.$row['surname'];

    $sql = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `firstname` = '".$firstname."';");
    $row1 = mysqli_fetch_array($sql);
    $userid = $row1['id'];

    $title = "Invitation";
    $message = $requester .' '.'invites you as an observer on computer schedules.';
   
    mysqli_query($con, "INSERT INTO `observer`(`scheduler_id`, `observer_id`) VALUES ('$uid','$userid')");
    mysqli_query($con,"INSERT INTO `notifications`(`user_id`, `title`, `notification`) VALUES ('$userid', '$title', '$message')");
    

   

?>