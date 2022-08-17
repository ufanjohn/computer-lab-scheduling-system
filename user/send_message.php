<?php
    include('../includes/indexconfig.php');
    session_start();
    $uid=$_SESSION['UID'];

    $msg = $_POST['msg'];
    $workgroupid = $_POST['wkgroupid'];
    mysqli_query($con, "INSERT INTO `chat`(`user_id`, `workgroup_id`, `message`) VALUES ('$uid','$workgroupid','$msg')");

    
?>