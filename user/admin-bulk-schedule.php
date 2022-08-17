<?php
    include('../includes/indexconfig.php');
    session_start();
    $uid=$_SESSION['UID'];

    $availpcs = $_POST['availpcs'];
    $reqnname = $_POST['reqnname']; 
    $reqst = $_POST['reqst'];
    $reqed = $_POST['reqed'];
    
    $reqdes = $_POST['reqdes'];
    $scpcids = $_POST['scpcids'];


    
   
    $pcid_array=array();
    $pcid_array=explode(',', $scpcids);



    for ($x = 0; $x < $availpcs; $x++) {
        mysqli_query($con, "INSERT INTO `timer_tbl`(`user_id`, `pc_id`, `thingstodo`, `schedulename`, `projectname`, `start_time`, `end_time`) VALUES ('$uid','$pcid_array[$x]','$reqdes','$reqnname','$reqnname','$reqst','$reqed')");
    }



    

    $usersql = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$uid."' "); 
    $row = mysqli_fetch_array($usersql);
    $creator = $row['firstname'] .' '.$row['surname'];


    $title = "PCs booked";
    $message = $creator .', '.'your schedule was successful.';
   
    mysqli_query($con,"INSERT INTO `notifications`(`user_id`, `title`, `notification`) VALUES ('$uid', '$title', '$message')");
    
    header('location:admin.php');
   

?>