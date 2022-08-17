<?php
    include('../includes/indexconfig.php');
    session_start();
    $uid=$_SESSION['UID'];


    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];
    $timeleft = $_POST['timeleft'];
    $pcid = $_POST['pcid'];
    $thingsToDo = $_POST['thingsToDo'];
    $nameOfSchedule = $_POST['nameOfSchedule'];
    $nameOfProject = $_POST['nameOfProject'];  
    
    $title = "Successful schedule";
    $row = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `tblcomputers` WHERE `ID` = '".$pcid."';"));
    $message = 'You have just scheduled '.$row['ComputerName'] .' with ID No. '.$row['ID'] .' and you have been successfully booked to start now/ '.$starttime.' and your time elapses '.$endtime.'. Congratulations!';
   
    mysqli_query($con,"INSERT INTO `notifications`(`user_id`, `title`, `notification`) VALUES ('$uid','$title','$message')");
    
    $sql1 = "INSERT INTO timer_tbl (user_id, pc_id, start_time, end_time) VALUES ((SELECT `id` FROM `tblusers` WHERE `Username`= '".$_SESSION["username"]."'), '$pcid', '$starttime', '$endtime')";
    $sql2 = "INSERT INTO `timer_tbl`(`user_id`, `pc_id`, `thingstodo`, `schedulename`, `projectname`, `start_time`, `end_time`) VALUES ('$uid','$pcid','$thingsToDo','$nameOfSchedule','$nameOfProject','$starttime', '$endtime')";
    
    $query1 = mysqli_query( $con, $sql2 ); 
?>