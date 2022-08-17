<?php
    include('../includes/indexconfig.php');
    session_start();
    $adminuid = $_SESSION['UID'];

    $userid = $_POST['userid'];




    $admsql = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$adminuid."' "); 
    $row = mysqli_fetch_array($admsql);
    $admin = $row['firstname'] .' '.$row['surname'];

    $usersql = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$userid."' "); 
    $row = mysqli_fetch_array($usersql);
    $newadmin = $row['firstname'] .' '.$row['surname'];

    mysqli_query($con, "INSERT INTO `administrators`(`created_by`, `user_id`) VALUES ('$adminuid','$userid')");

    $title = "Admin alert";
    $message = $newadmin .', '.'just made you an administrator, you now have administrative rights to the unisc portal';
   
    mysqli_query($con,"INSERT INTO `notifications`(`user_id`, `title`, `notification`) VALUES ('$userid', '$title', '$message')");
    

   

?>