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

    $title = "Group Request";
    $message = $requester .' '.'invites you to join a group.';
   
    mysqli_query($con,"INSERT INTO `notifications`(`user_id`, `title`, `notification`) VALUES ('$userid', '$title', '$message')");
    

   

?>