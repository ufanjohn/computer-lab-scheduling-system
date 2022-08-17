<?php
    include('../includes/indexconfig.php');
    session_start();
    $uid=$_SESSION['UID'];

    $wkdesc = $_POST['wkdesc'];
    $wkname = $_POST['wkname']; 
    $id_array = $_POST['id_array'];
    $avatar = $_POST['avatar'];

    mysqli_query($con, "INSERT INTO `workgroup`(`creator_id`, `name`, `avatar`, `description`) VALUES ('$uid','$wkname','$avatar','$wkdesc')");

    
   
    $tid_array=array();
    $tid_array=explode(',', $id_array);

    mysqli_query($con, "INSERT INTO `users_workgroup`(`user_id`, `workgroup_name`) VALUES ('$uid','$wkname')");

    foreach ($tid_array as $tid) {
        mysqli_query($con, "INSERT INTO `users_workgroup`(`user_id`, `workgroup_name`) VALUES ('$tid','$wkname')");
    }



    



    $usersql = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$uid."' "); 
    $row = mysqli_fetch_array($usersql);
    $creator = $row['firstname'] .' '.$row['surname'];


    $title = "Workgroup created";
    $message = $creator .', '.'your workgroup - '.$wkname.' '.'has been successfully created.';
   
    mysqli_query($con,"INSERT INTO `notifications`(`user_id`, `title`, `notification`) VALUES ('$uid', '$title', '$message')");
    

   

?>