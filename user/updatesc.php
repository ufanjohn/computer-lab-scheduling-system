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
    $tblid =  $_POST['scId'];

    
    
    mysqli_query($con,"UPDATE `timer_tbl` SET `thingstodo`='$thingsToDo',`schedulename`='$nameOfSchedule',`projectname`='$nameOfProject',`start_time`='$starttime',`end_time`='$endtime' WHERE `timer_id` = '".$tblid."';"); 
  
?>