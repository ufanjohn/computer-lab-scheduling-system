<?php
    include('../includes/indexconfig.php');
    session_start();
    $uid=$_SESSION['UID'];

    $dataid = $_POST['dataid'];

    mysqli_query($con, "DELETE FROM `notifications` WHERE `notifications`.`id` = '".$dataid."';");
   

?>