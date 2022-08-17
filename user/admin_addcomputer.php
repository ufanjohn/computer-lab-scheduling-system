<?php
    include('../includes/indexconfig.php');
    session_start();
    $uid=$_SESSION['UID'];

    $computername = $_POST['computername']; 
    $aboutcomputer = $_POST['aboutcomputer'];
    $display = $_POST['display'];
    $displayResolution = $_POST['disresol'];
    $touchscreen = $_POST['touchscreen'];
    $processor = $_POST['processor'];
    $ram = $_POST['ram'];
    $harddisk = $_POST['harddisk'];
    $ssd = $_POST['ssd'];
    $graphics = $_POST['graphics'];


    mysqli_query($con, "INSERT INTO `tblcomputers`(`ComputerName`, `About`, `Display`, `DisplayResolution`, `Touchscreen`, `Processor`, `RAM`, `HD`, `SSD`, `Graphics`) VALUES ('$computername', '$aboutcomputer', '$display', '$displayResolution', '$touchscreen', '$processor', '$ram', '$harddisk', '$ssd', '$graphics')");
    
    // $sql= "INSERT into tblcomputers(ComputerName, About, Display, DisplayResolution, Touchscreen, Processor, RAM, HD, SSD, Graphics)VALUES('$computername', '$aboutcomputer', '$display', '$displayResolution', '$touchscreen', '$processor', '$ram', '$harddisk', '$ssd', '$graphics');
  
?>