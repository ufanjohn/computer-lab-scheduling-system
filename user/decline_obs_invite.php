<?php
    include('../includes/indexconfig.php');
    session_start();
    $uid=$_SESSION['UID'];

    $firstname = $_POST['fname'];
    $surname = $_POST['sname'];
    $dataid = $_POST['dataid'];


    $usersql = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `firstname` = '".$firstname."' AND  `surname` = '".$surname."';"); 
    $row = mysqli_fetch_array($usersql);    
    $requester_id = $row['id'];

   
    $sql = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$uid."';");
    $row1 = mysqli_fetch_array($sql);
    $user = $row1['firstname'].' '.$row1['surname'];;

    $title = "Invitation Declined";
    $message = $user .' '.'declined your request on following your computer schedules.';
   
    // mysqli_query($con, "INSERT INTO `observer`(`scheduler_id`, `observer_id`) VALUES ('$uid','$userid')");
    mysqli_query($con,"INSERT INTO `notifications`(`user_id`, `title`, `notification`) VALUES ('$requester_id', '$title', '$message')");
    
    mysqli_query($con, "DELETE FROM `notifications` WHERE `notifications`.`id` = '".$dataid."';");
   

?>