
<?php
  include('../includes/redirection_conn.php'); 
  

  $uid=$_SESSION['UID'];


  $sfggwg  = mysqli_query($con, "SELECT * FROM `administrators` WHERE `user_id`= '".$_SESSION['UID']."';");
  $aadmincount =mysqli_num_rows($sfggwg);

  if ($aadmincount == 0){
    header('location:index.php');
  }


  if( isset( $_POST['scdel'])){
    $id = $_POST['elemid'];
    mysqli_query($con, "DELETE FROM `timer_tbl` WHERE `timer_tbl`.`timer_id` = '".$id."';");
  }


  


  if(isset($_POST['removeschedule'])){
    $scheduleid = $_POST['scheduleid'];

    $exset = mysqli_query($con, "SELECT * FROM timer_tbl WHERE timer_id ='".$scheduleid."';");
    $exsetfetch = mysqli_fetch_array($exset);

    $timer_id = $exsetfetch['timer_id'];
    $user_id = $exsetfetch['user_id']; 
    $pc_id = $exsetfetch['pc_id'];
    $thingstodo = $exsetfetch['thingstodo'];
    $schedulename = $exsetfetch['schedulename'];
    $projectname = $exsetfetch['projectname'];
    $start_time = $exsetfetch['start_time'];
    $end_time = $exsetfetch['end_time'];
    $posted = $exsetfetch['posted'];


    mysqli_query($con, "INSERT INTO `extimer_tbl`(`timer_id`, `user_id`, `pc_id`, `thingstodo`, `schedulename`, `projectname`, `start_time`, `end_time`, `posted`) VALUES ('$timer_id','$user_id','$pc_id','$thingstodo','$schedulename','$projectname','$start_time','$end_time','$posted')");
    // Delete from Ongoing Schedules
    mysqli_query($con, "DELETE FROM `timer_tbl` WHERE `timer_tbl`.`timer_id` = '".$timer_id."';");

  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Start Head -->
<?php include('../includes/clienthead.php'); ?> 
<!-- End Head -->

  <title>Update Profile | UniuyoSchedule</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/index.css" rel="stylesheet">
  <link href="../assets/css/maincalender.css" rel="stylesheet">
<script src='../assets/js/maincalender.js'></script> 
<script>

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      displayEventTime: false,
      initialDate: '2019-04-01',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,listYear'
      },
      events: {
        url: 'ics/feed.ics',
        format: 'ics',
        failure: function() {
          document.getElementById('script-warning').style.display = 'block';
        }
      },
      loading: function(bool) {
        document.getElementById('loading').style.display =
          bool ? 'block' : 'none';
      }
    });

    calendar.render();
  });

</script>

  <style>
  .accsetting_pane{
  background:#f6f9ff;
  height: 100%;
  width: 0;
  position: fixed; 
  display:none; 
  z-index: 1;
  top: 0;
  right: 0;
  overflow-x: hidden; 
  padding-top: 60px;
  transition: 25.5s;

}

.accsetting_pane_active{
  display:block;
  width:700px;
  transition:5s;
} 





  </style>

</head>

<body>

  <!-- Start Header -->
<?php include('../includes/clientheader.php'); ?>
<!-- End Header -->
<!-- Start Sidebar -->
<?php include('../includes/adminoffcanvas.php'); ?>
<!-- End Sidebar -->
  


  <main id="main" class="main" >
  
    <div class="card toptaps">
      <div class="card-body " style="padding-bottom:0px; padding-top:10px">
        <!-- Bordered Tabs -->
        <ul class="nav nav-tabs nav-tabs-bordered">

          <li class="nav-item">
            <button class="nav-link scheduletab active" data-bs-toggle="tab" data-bs-target="#schedules">Schedules</button>
          </li>

          <li class="nav-item">
            <button class="nav-link ongoingtab" data-bs-toggle="tab" data-bs-target="#ongoing">Ongoing</button>
          </li>
          <li class="nav-item">
            <button class="nav-link setbymetab" data-bs-toggle="tab" data-bs-target="#setbyme">Set by me</button>
          </li>
          <li class="nav-item">
            <button class="nav-link followingtab" data-bs-toggle="tab" data-bs-target="#following">Following</button>
          </li>

          <li class="nav-item">
            <button class="nav-link assistingtab" data-bs-toggle="tab" data-bs-target="#assisting">Assisting</button>
          </li>
          



        </ul>
      </div>
    </div>
          <div class="navii ">            
            <h5 class="mt-2 me-3">All Schedule</h5>
              <div class="btn-group scopt" role="group" aria-label="Button group with nested dropdown" style="padding-top:0px; padding-bottom:0px; outline:none">
                <button type="button" style="padding:0px;padding-left:10px;height:39px; background:#B4E624; outline:none; font-size:15px; text-transform:uppercase" class="btn newschedule"  >New Schedule</button>

                <div class="btn-group" role="group">
                  <button id="btnGroupDrop1" style="height:39px;background:#B4E624" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top:0px; padding-bottom:0px; outline:none">
                 
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <li><a class="dropdown-item" href="#">Quick Schedule</a></li>
                  </ul>
                </div>
              </div>
            <div class="search-ba dataTable-search">
              <form class="search-form d-flex align-items-center">
                <div class="usearch " placeholder="filter and search">
                  
                  <!-- <span class="usearchspan">
                    <span class="tagel" contenteditable>Ongoing</span>  <i class='bi bi-x'></i>
                  </span>
                  <span class="usearchspan">
                  <span class="tagel" contenteditable>Following</span>  <i class="bi bi-x"></i>
                  </span> -->
                </div>
                <button  title="Search"><i class="bi bi-search topnavsearch pe-2"></i></button>
              </form>
            </div>
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="padding-top:0px; padding-bottom:0px; outline:none">
              <div class="btn-group" role="group">
                <button id="customset" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top:0px; padding-bottom:0px; outline:none">
                  <i class="bi bi-gear"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="btnsettings">
                  <li><a class="dropdown-item bulkschedule" href="#bulkschedule">Bulk Schedule</a></li>                                
                  <li><a class="dropdown-item addWorkgroup" href="#workgroup">Add Workgroup</a></li>
                  <li><a class="dropdown-item addComputer" href="#computer">Add Computer</a></li>
                  <li><a class="dropdown-item addAdmin" href="#addadmin">Make Admins</a></li>
                </ul>
              </div>
            </div>
            <!-- <button class="toolselement toolsetting" > <i class="bi bi-gear"></i></button> -->
            <button class="toolselement quickset" data-bs-toggle="tooltip" data-bs-placement="top" title="Quickly Schedule a PC"> <i class="bi bi-lightning"></i></button>
          </div>
          <div class="mt-4 border-bottom"></div>


          <div class="card bysort">
            <div class="card-body" style="padding-bottom:1px; padding-top:0px">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#ongoing">List</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#today">Today</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link planner" data-bs-toggle="tab" data-bs-target="#yesterday">Yesterday</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link thismontht" data-bs-toggle="tab" data-bs-target="#thismonth" >This Month</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#deadline">Expired</button>
                </li>


              </ul>
              

            </div>
          </div>

          <section class="section">
      <div class="row">
        <div class="col-lg-12">
          
          <div class="tab-content pt-2">
            <div class="tab-pane fade show active ongoing" id="ongoing">

              <div class="card schedules" style="" >
                <div class="card-body">
                  <div class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl" >
                  
                  <table class="table datatable"  >
                    <thead>
                      <tr>
                        <th scope="col">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="padding-top:0px; padding-bottom:0px; outline:none">
                            <div class="btn-group" role="group">
                              <button id="btnsettingsall" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top:0px; padding-bottom:0px; outline:none">
                              <i class="bi bi-gear"></i>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="btnsettings">
                                                           
                                <li><a class="dropdown-item scpinall" data-id="<?php echo $row['timer_id']?>" href="#pinall" style="cursor:not-allowed">Pin All</a></li>                                
                                <li><a class="dropdown-item scdelall" data-id="<?php echo $row['timer_id']?>" href="#deleteall">Delete All</a></li>
                              </ul>
                            </div>
                          </div>
                        </th>
                        <th scope="col">Name</th>
                        <th scope="col">Active</th>
                        <th scope="col">Expiry</th>
                        <th scope="col">Created by</th>                    
                        <th scope="col">Responsible Person</th>
                        <th scope="col">Project</th>


                      </tr>
                    </thead>
                    <tbody>
                    <?php

                      // Gets all schedules from schedule table for users that matches the observer table and status equals 1
                        
                        $sqluery = mysqli_query($con, "SELECT * FROM `timer_tbl` ORDER BY timer_id DESC ");
                        while($row = mysqli_fetch_array($sqluery)){
                      
                      ?>
                      <tr>

                        <td>
                          <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="padding-top:0px; padding-bottom:0px; outline:none">
                            <div class="btn-group" role="group">
                              <button id="btnsetting" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top:0px; padding-bottom:0px; outline:none">
                              <i class="bi bi-gear"></i>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="btnsetting">
                                <li>
                                  <a 
                                    class="dropdown-item scview" 
                                    data-id="<?php echo $row['timer_id']?>"  
                                    data-pcid="<?php echo $row['pc_id']?>" 
                                    data-task="<?php echo $row['thingstodo']?>" 
                                    data-stm="<?php echo $row['start_time']?>" 
                                    data-etm="<?php echo $row['end_time']?>" 
                                    data-pst="<?php echo $row['posted']?>"                                      
                                    data-scname="<?php echo $row['schedulename']?>" 
                                    data-prname="<?php echo $row['projectname']?>" 
                                    href="#view"
                                  >
                                    View
                                  </a>
                                </li>
                                <li>
                                  <a 
                                    class="dropdown-item scedit" 
                                    data-id="<?php echo $row['timer_id']?>"  
                                    data-pcid="<?php echo $row['pc_id']?>" 
                                    data-task="<?php echo $row['thingstodo']?>" 
                                    data-stm="<?php echo $row['start_time']?>" 
                                    data-etm="<?php echo $row['end_time']?>" 
                                    data-pst="<?php echo $row['posted']?>"                                      
                                    data-scname="<?php echo $row['schedulename']?>" 
                                    data-prname="<?php echo $row['projectname']?>" 
                                    href="#edit"
                                    >
                                    Edit
                                  </a>
                                </li>                                
                                <li><a class="dropdown-item scpin" data-id="<?php echo $row['timer_id']?>" href="#pin" style="cursor:not-allowed">Pin</a></li>                                
                                <li><a class="dropdown-item scdel" data-id="<?php echo $row['timer_id']?>" href="#delete">Delete</a></li>
                              </ul>
                            </div>
                          </div>
                        </td>
                        <td>
                          
                          <?php echo $row['schedulename']?>
                        </td>
                        <td class="dbstart" data-bs-toggle="tooltip" data-bs-placement="top" title="Started .." data-user="<?php echo $row['user_id'];?>" data-id="<?php echo $row['timer_id'];?>" data-acdate="<?php echo $row['start_time'];?>"><?php echo date('M d, h:i a',strtotime($row['start_time']));?></td>
                        <td>
                          <span class="badge rounded-pill "  style="background-color:rgb(165,201,59);"><?php echo date('M d, h:i a',strtotime($row['end_time']));?></span>
                        </td>


                        <td> <i class="bx bx-user-circle"></i>                     
                          <?php $createdby = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$row['user_id']."';");
                            $createdby = mysqli_fetch_array($createdby);
                            echo $createdby['firstname'].' '.$createdby['surname']?>
                        </td>
                        <td><i class="bx bx-user-circle"></i> <?php $createdby = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$row['user_id']."';");
                        $createdby = mysqli_fetch_array($createdby);
                        echo $createdby['firstname'].' '.$createdby['surname']?></td>
                        <td><?php echo $row['projectname']?></td>
                      </tr>
                    </tbody>
                    <?php }?>
                  </table>
                  </div>
                  <!-- End Table with stripped rows -->

                </div>
              </div>
            </div>



            <!-- Today -->
            <div class="tab-pane fade show today" id="today">

              <div class="card schedules" style="" >
                <div class="card-body">
                  <div class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl" >
                  
                  <table class="table datatable"  >
                    <thead>
                      <tr>
                        <th scope="col">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="padding-top:0px; padding-bottom:0px; outline:none">
                            <div class="btn-group" role="group">
                              <button id="btnsettingsall" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top:0px; padding-bottom:0px; outline:none">
                              <i class="bi bi-gear"></i>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="btnsetting">
                                                          
                                <li><a class="dropdown-item scpinall" data-id="<?php echo $row['timer_id']?>" href="#pinall" style="cursor:not-allowed">Pin All</a></li>                                
                                <li><a class="dropdown-item scdelall" data-id="<?php echo $row['timer_id']?>" href="#deleteall">Delete All</a></li>
                              </ul>
                            </div>
                          </div>
                        </th>
                        <th scope="col">Name</th>
                        <th scope="col">Active</th>
                        <th scope="col">Expiry</th>
                        <th scope="col">Created by</th>                    
                        <th scope="col">Responsible Person</th>
                        <th scope="col">Project</th>


                      </tr>
                    </thead>
                    <tbody>
                    <?php

                      // Gets all schedules from schedule table for users that matches the observer table and status equals 1
                        
                        $sqluery = mysqli_query($con, "SELECT * FROM `timer_tbl` WHERE posted >= CURDATE() ORDER BY timer_id DESC ");
                        while($row = mysqli_fetch_array($sqluery)){
                      
                      ?>
                      <tr>

                        <td>
                          <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="padding-top:0px; padding-bottom:0px; outline:none">
                            <div class="btn-group" role="group">
                              <button id="btnsetting" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top:0px; padding-bottom:0px; outline:none">
                              <i class="bi bi-gear"></i>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="btnsetting">
                                <li>
                                  <a 
                                    class="dropdown-item scview" 
                                    data-id="<?php echo $row['timer_id']?>"  
                                    data-pcid="<?php echo $row['pc_id']?>" 
                                    data-task="<?php echo $row['thingstodo']?>" 
                                    data-stm="<?php echo $row['start_time']?>" 
                                    data-etm="<?php echo $row['end_time']?>" 
                                    data-pst="<?php echo $row['posted']?>"                                      
                                    data-scname="<?php echo $row['schedulename']?>" 
                                    data-prname="<?php echo $row['projectname']?>" 
                                    href="#view"
                                  >
                                    View
                                  </a>
                                </li>
                                <li>
                                  <a 
                                    class="dropdown-item scedit" 
                                    data-id="<?php echo $row['timer_id']?>"  
                                    data-pcid="<?php echo $row['pc_id']?>" 
                                    data-task="<?php echo $row['thingstodo']?>" 
                                    data-stm="<?php echo $row['start_time']?>" 
                                    data-etm="<?php echo $row['end_time']?>" 
                                    data-pst="<?php echo $row['posted']?>"                                      
                                    data-scname="<?php echo $row['schedulename']?>" 
                                    data-prname="<?php echo $row['projectname']?>" 
                                    href="#edit"
                                    >
                                    Edit
                                  </a>
                                </li>                                
                                <li><a class="dropdown-item scpin" data-id="<?php echo $row['timer_id']?>" href="#pin" style="cursor:not-allowed">Pin</a></li>                                
                                <li><a class="dropdown-item scdel" data-id="<?php echo $row['timer_id']?>" href="#delete">Delete</a></li>
                              </ul>
                            </div>
                          </div>
                        </td>
                        <td>
                          
                          <?php echo $row['schedulename']?>
                        </td>
                        <td class="dbstart" data-bs-toggle="tooltip" data-bs-placement="top" title="Started .." data-acdate="<?php echo $row['start_time'];?>"><?php echo date('M d, h:i a',strtotime($row['start_time']));?></td>
                        <td>
                          <span class="badge rounded-pill "  style="background-color:rgb(165,201,59);"><?php echo date('M d, h:i a',strtotime($row['end_time']));?></span>
                        </td>


                        <td> <i class="bx bx-user-circle"></i>                     
                          <?php $createdby = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$row['user_id']."';");
                            $createdby = mysqli_fetch_array($createdby);
                            echo $createdby['firstname'].' '.$createdby['surname']?>
                        </td>
                        <td><i class="bx bx-user-circle"></i> <?php $createdby = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$row['user_id']."';");
                        $createdby = mysqli_fetch_array($createdby);
                        echo $createdby['firstname'].' '.$createdby['surname']?></td>
                        <td><?php echo $row['projectname']?></td>
                      </tr>
                    </tbody>
                    <?php }?>
                  </table>
                  </div>
                  <!-- End Table with stripped rows -->

                </div>
              </div>
            </div>


            <!-- Yesterday -->
            <div class="tab-pane fade show yesterday" id="yesterday">

              <div class="card schedules" style="" >
                <div class="card-body">
                  <div class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl" >
                  
                  <table class="table datatable"  >
                    <thead>
                      <tr>
                        <th scope="col">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="padding-top:0px; padding-bottom:0px; outline:none">
                            <div class="btn-group" role="group">
                              <button id="btnsettingsall" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top:0px; padding-bottom:0px; outline:none">
                              <i class="bi bi-gear"></i>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="btnsettings">
                                                          
                                <li><a class="dropdown-item scpinall" data-id="<?php echo $row['timer_id']?>" href="#pinall" style="cursor:not-allowed">Pin All</a></li>                                
                                <li><a class="dropdown-item scdelall" data-id="<?php echo $row['timer_id']?>" href="#deleteall">Delete All</a></li>
                              </ul>
                            </div>
                          </div>
                        </th>
                        <th scope="col">Name today</th>
                        <th scope="col">Active</th>
                        <th scope="col">Expiry</th>
                        <th scope="col">Created by</th>                    
                        <th scope="col">Responsible Person</th>
                        <th scope="col">Project</th>


                      </tr>
                    </thead>
                    <tbody>
                    <?php

                      // Get schedule from yesterday
                        $sqluery = mysqli_query($con, "SELECT * FROM `timer_tbl` WHERE posted >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND posted < CURDATE() ORDER BY timer_id DESC ");
                        while($row = mysqli_fetch_array($sqluery)){
                      
                      ?>
                      <tr>

                        <td>
                          <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="padding-top:0px; padding-bottom:0px; outline:none">
                            <div class="btn-group" role="group">
                              <button id="btnsetting" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top:0px; padding-bottom:0px; outline:none">
                              <i class="bi bi-gear"></i>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="btnsetting">
                                <li>
                                  <a 
                                    class="dropdown-item scview" 
                                    data-id="<?php echo $row['timer_id']?>"  
                                    data-pcid="<?php echo $row['pc_id']?>" 
                                    data-task="<?php echo $row['thingstodo']?>" 
                                    data-stm="<?php echo $row['start_time']?>" 
                                    data-etm="<?php echo $row['end_time']?>" 
                                    data-pst="<?php echo $row['posted']?>"                                      
                                    data-scname="<?php echo $row['schedulename']?>" 
                                    data-prname="<?php echo $row['projectname']?>" 
                                    href="#view"
                                  >
                                    View
                                  </a>
                                </li>
                                <li>
                                  <a 
                                    class="dropdown-item scedit" 
                                    data-id="<?php echo $row['timer_id']?>"  
                                    data-pcid="<?php echo $row['pc_id']?>" 
                                    data-task="<?php echo $row['thingstodo']?>" 
                                    data-stm="<?php echo $row['start_time']?>" 
                                    data-etm="<?php echo $row['end_time']?>" 
                                    data-pst="<?php echo $row['posted']?>"                                      
                                    data-scname="<?php echo $row['schedulename']?>" 
                                    data-prname="<?php echo $row['projectname']?>" 
                                    href="#edit"
                                    >
                                    Edit
                                  </a>
                                </li>                                
                                <li><a class="dropdown-item scpin" data-id="<?php echo $row['timer_id']?>" href="#pin" style="cursor:not-allowed">Pin</a></li>                                
                                <li><a class="dropdown-item scdel" data-id="<?php echo $row['timer_id']?>" href="#delete">Delete</a></li>
                              </ul>
                            </div>
                          </div>
                        </td>
                        <td>
                          
                          <?php echo $row['schedulename']?>
                        </td>
                        <td class="dbstart" data-bs-toggle="tooltip" data-bs-placement="top" title="Started .." data-acdate="<?php echo $row['start_time'];?>"><?php echo date('M d, h:i a',strtotime($row['start_time']));?></td>
                        <td>
                          <span class="badge rounded-pill "  style="background-color:rgb(165,201,59);"><?php echo date('M d, h:i a',strtotime($row['end_time']));?></span>
                        </td>


                        <td> <i class="bx bx-user-circle"></i>                     
                          <?php $createdby = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$row['user_id']."';");
                            $createdby = mysqli_fetch_array($createdby);
                            echo $createdby['firstname'].' '.$createdby['surname']?>
                        </td>
                        <td><i class="bx bx-user-circle"></i> <?php $createdby = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$row['user_id']."';");
                        $createdby = mysqli_fetch_array($createdby);
                        echo $createdby['firstname'].' '.$createdby['surname']?></td>
                        <td><?php echo $row['projectname']?></td>
                      </tr>
                    </tbody>
                    <?php }?>
                  </table>
                  </div>
                  <!-- End Table with stripped rows -->

                </div>
              </div>
            </div>



            <div class="tab-pane fade show thismonth" id="thismonth">

              <div class="card schedules" style="" >
                <div class="card-body">
                  <div class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl" >
                  
                  <table class="table datatable"  >
                    <thead>
                      <tr>
                        <th scope="col">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="padding-top:0px; padding-bottom:0px; outline:none">
                            <div class="btn-group" role="group">
                              <button id="btnsettingsall" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top:0px; padding-bottom:0px; outline:none">
                              <i class="bi bi-gear"></i>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="btnsettings">
                                                          
                                <li><a class="dropdown-item scpinall" data-id="<?php echo $row['timer_id']?>" href="#pinall" style="cursor:not-allowed">Pin All</a></li>                                
                                <li><a class="dropdown-item scdelall" data-id="<?php echo $row['timer_id']?>" href="#deleteall">Delete All</a></li>
                              </ul>
                            </div>
                          </div>
                        </th>
                        <th scope="col">Name today</th>
                        <th scope="col">Active</th>
                        <th scope="col">Expiry</th>
                        <th scope="col">Created by</th>                    
                        <th scope="col">Responsible Person</th>
                        <th scope="col">Project</th>


                      </tr>
                    </thead>
                    <tbody>
                    <?php

                      // Get schedule from thismonth
                        $sqluery = mysqli_query($con, "SELECT * FROM `timer_tbl` WHERE posted >= DATE_SUB(CURDATE(), INTERVAL DAYOFMONTH(CURDATE())-1 DAY) ORDER BY timer_id DESC ");
                        while($row = mysqli_fetch_array($sqluery)){
                      
                      ?>
                      <tr>

                        <td>
                          <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="padding-top:0px; padding-bottom:0px; outline:none">
                            <div class="btn-group" role="group">
                              <button id="btnsetting" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top:0px; padding-bottom:0px; outline:none">
                              <i class="bi bi-gear"></i>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="btnsetting">
                                <li>
                                  <a 
                                    class="dropdown-item scview" 
                                    data-id="<?php echo $row['timer_id']?>"  
                                    data-pcid="<?php echo $row['pc_id']?>" 
                                    data-task="<?php echo $row['thingstodo']?>" 
                                    data-stm="<?php echo $row['start_time']?>" 
                                    data-etm="<?php echo $row['end_time']?>" 
                                    data-pst="<?php echo $row['posted']?>"                                      
                                    data-scname="<?php echo $row['schedulename']?>" 
                                    data-prname="<?php echo $row['projectname']?>" 
                                    href="#view"
                                  >
                                    View
                                  </a>
                                </li>
                                <li>
                                  <a 
                                    class="dropdown-item scedit" 
                                    data-id="<?php echo $row['timer_id']?>"  
                                    data-pcid="<?php echo $row['pc_id']?>" 
                                    data-task="<?php echo $row['thingstodo']?>" 
                                    data-stm="<?php echo $row['start_time']?>" 
                                    data-etm="<?php echo $row['end_time']?>" 
                                    data-pst="<?php echo $row['posted']?>"                                      
                                    data-scname="<?php echo $row['schedulename']?>" 
                                    data-prname="<?php echo $row['projectname']?>" 
                                    href="#edit"
                                    >
                                    Edit
                                  </a>
                                </li>                                
                                <li><a class="dropdown-item scpin" data-id="<?php echo $row['timer_id']?>" href="#pin" style="cursor:not-allowed">Pin</a></li>                                
                                <li><a class="dropdown-item scdel" data-id="<?php echo $row['timer_id']?>" href="#delete">Delete</a></li>
                              </ul>
                            </div>
                          </div>
                        </td>
                        <td>
                          
                          <?php echo $row['schedulename']?>
                        </td>
                        <td class="dbstart" data-bs-toggle="tooltip" data-bs-placement="top" title="Started .." data-acdate="<?php echo $row['start_time'];?>"><?php echo date('M d, h:i a',strtotime($row['start_time']));?></td>
                        <td>
                          <span class="badge rounded-pill "  style="background-color:rgb(165,201,59);"><?php echo date('M d, h:i a',strtotime($row['end_time']));?></span>
                        </td>


                        <td> <i class="bx bx-user-circle"></i>                     
                          <?php $createdby = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$row['user_id']."';");
                            $createdby = mysqli_fetch_array($createdby);
                            echo $createdby['firstname'].' '.$createdby['surname']?>
                        </td>
                        <td><i class="bx bx-user-circle"></i> <?php $createdby = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$row['user_id']."';");
                        $createdby = mysqli_fetch_array($createdby);
                        echo $createdby['firstname'].' '.$createdby['surname']?></td>
                        <td><?php echo $row['projectname']?></td>
                      </tr>
                    </tbody>
                    <?php }?>
                  </table>
                  </div>
                  <!-- End Table with stripped rows -->

                </div>
              </div>
            </div>



            <!-- deadline -->
            <div class="tab-pane fade show deadline" id="deadline">

              <div class="card schedules" style="" >
                <div class="card-body">
                  <div class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl" >
                  
                  <table class="table datatable"  >
                    <thead>
                      <tr>
                        <th scope="col">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="padding-top:0px; padding-bottom:0px; outline:none">
                            <div class="btn-group" role="group">
                              <button id="btnsettingsall" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top:0px; padding-bottom:0px; outline:none">
                              <i class="bi bi-gear"></i>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="btnsettings">
                                                           
                                <li><a class="dropdown-item scpinall" data-id="<?php echo $row['timer_id']?>" href="#pinall" style="cursor:not-allowed">Pin All</a></li>                                
                                <li><a class="dropdown-item scdelall" data-id="<?php echo $row['timer_id']?>" href="#deleteall">Delete All</a></li>
                              </ul>
                            </div>
                          </div>
                        </th>
                        <th scope="col">Name</th>
                        <th scope="col">Active</th>
                        <th scope="col">Expires</th>
                        <th scope="col">Created by</th>                    
                        <th scope="col">Responsible Person</th>
                        <th scope="col">Project</th>


                      </tr>
                    </thead>
                    <tbody>
                    <?php

                      // Gets all schedules from schedule table for users that matches the observer table and status equals 1
                        
                        $sqluery = mysqli_query($con, "SELECT * FROM `extimer_tbl` ORDER BY timer_id DESC ");
                        while($row = mysqli_fetch_array($sqluery)){
                      
                      ?>
                      <tr>

                        <td>
                          <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="padding-top:0px; padding-bottom:0px; outline:none">
                            <div class="btn-group" role="group">
                              <button id="btnsetting" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top:0px; padding-bottom:0px; outline:none">
                              <i class="bi bi-gear"></i>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="btnsetting">
                                <li>
                                  <a 
                                    class="dropdown-item scview" 
                                    data-id="<?php echo $row['timer_id']?>"  
                                    data-pcid="<?php echo $row['pc_id']?>" 
                                    data-task="<?php echo $row['thingstodo']?>" 
                                    data-stm="<?php echo $row['start_time']?>" 
                                    data-etm="<?php echo $row['end_time']?>" 
                                    data-pst="<?php echo $row['posted']?>"                                      
                                    data-scname="<?php echo $row['schedulename']?>" 
                                    data-prname="<?php echo $row['projectname']?>" 
                                    href="#view"
                                  >
                                    View
                                  </a>
                                </li>
                                <li>
                                  <a 
                                    class="dropdown-item scedit" 
                                    data-id="<?php echo $row['timer_id']?>"  
                                    data-pcid="<?php echo $row['pc_id']?>" 
                                    data-task="<?php echo $row['thingstodo']?>" 
                                    data-stm="<?php echo $row['start_time']?>" 
                                    data-etm="<?php echo $row['end_time']?>" 
                                    data-pst="<?php echo $row['posted']?>"                                      
                                    data-scname="<?php echo $row['schedulename']?>" 
                                    data-prname="<?php echo $row['projectname']?>" 
                                    href="#edit"
                                    >
                                    Edit
                                  </a>
                                </li>                                
                                <li><a class="dropdown-item scpin" data-id="<?php echo $row['timer_id']?>" href="#pin" style="cursor:not-allowed">Pin</a></li>                                
                                <li><a class="dropdown-item scdel" data-id="<?php echo $row['timer_id']?>" href="#delete">Delete</a></li>
                              </ul>
                            </div>
                          </div>
                        </td>
                        <td>
                          
                          <?php echo $row['schedulename']?>
                        </td>
                        <td class="dbstart" data-bs-toggle="tooltip" data-bs-placement="top" title="Started .." data-user="<?php echo $row['user_id'];?>" data-id="<?php echo $row['timer_id'];?>" data-acdate="<?php echo $row['start_time'];?>"><?php echo date('M d, h:i a',strtotime($row['start_time']));?></td>
                        <td>
                          <span class="badge rounded-pill " style="background-color:#dcb835;"><?php echo date('M d, h:i a',strtotime($row['end_time']));?></span>
                        </td>


                        <td> <i class="bx bx-user-circle"></i>                     
                          <?php $createdby = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$row['user_id']."';");
                            $createdby = mysqli_fetch_array($createdby);
                            echo $createdby['firstname'].' '.$createdby['surname']?>
                        </td>
                        <td><i class="bx bx-user-circle"></i> <?php $createdby = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$row['user_id']."';");
                        $createdby = mysqli_fetch_array($createdby);
                        echo $createdby['firstname'].' '.$createdby['surname']?></td>
                        <td><?php echo $row['projectname']?></td>
                      </tr>
                    </tbody>
                    <?php }?>
                  </table>
                  </div>
                  <!-- End Table with stripped rows -->

                </div>
              </div>
            </div>

            <!-- Deadline -->
            <div class="tab-pane fade show deadliwne" id="deeadline">

              <div class="card schedules" >
                <div class="card-body">
                  <div class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl" >
                  
                  <table class="table datatable"  >
                    <thead>
                      <tr>
                        <th scope="col">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck1">
                          </div>
                        </th>
                        <th scope="col">Name</th>
                        <th scope="col" >Active</th>
                        <th scope="col">Expiry</th>
                        <th scope="col">Created by</th>                    
                        <th scope="col">Responsible Person</th>
                        <th scope="col">Project</th>


                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $sqluery1 = mysqli_query($con, "SELECT * FROM `extimer_tbl` ORDER BY timer_id DESC ");
                      while($row1 = mysqli_fetch_array($sqluery1)){

                      
                      ?>
                      <tr>
                        <th scope="row">
                          <div class="form-check">
                            <a href="" class="extimerid" style="display:none"><?php echo $row1['timer_id']?></a>
                            <a href="" class="exstarttimespan" style="display:none"><?php echo $row1['start_time'];?></a>
                            <a href="" class="exendtimespan" style="display:none"><?php echo $row1['end_time'];?></a>
                            <input class="form-check-input" data-id="<?php echo $row['timer_id']?>" type="checkbox" id="gridCheck1">
                          </div>
                        </th>
                        <td><?php echo $row1['schedulename']?></td>
                        <td><?php echo date('M d, h:i a',strtotime($row1['posted']));?></td>
                        <td>
                          <span class="badge rounded-pill "  style="background-color:#dcb835;"><?php echo date('M d, h:i a',strtotime($row1['end_time']));?></span>
                        </td>


                        <td> <i class="bx bx-user-circle"></i>                     
                          <?php $createdby1 = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$row1['user_id']."';");
                            $createdby1 = mysqli_fetch_array($createdby1);
                            echo $createdby1['firstname'].' '.$createdby1['surname']?>
                        </td>
                        <td><i class="bx bx-user-circle"></i> <?php $createdby1 = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$row['user_id']."';");
                        $createdby1 = mysqli_fetch_array($createdby1);
                        echo $createdby1['firstname'].' '.$createdby1['surname']?></td>
                        
                        <td><?php echo $row1['projectname']?></td>
                      </tr>
                    </tbody>
                    <?php }?>
                  </table>
                  </div>
                  <!-- End Table with stripped rows -->

                </div>
              </div>
            </div>

            <!-- Calender -->
            <div class="tab-pane fade show calender" id="calender">

              <div class="card" >
                <div class="card-body">
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                      Screen View Port Error Detected! Resize your device to gain full access to Calender!
                    <button type="button" class="btn-close btnresize" data-bs-dismiss="alert" aria-label="Close" ></button>
                </div>
                <div id='script-warning'>

                 
                  </div>

                  <div id='loading'></div> 

                  <div id='calendar' style="margin-top:50px"></div>
                </div>
              </div>
            </div>
            <!-- End Calender -->
          </div>



        </div>


        
      </div>
    </section>

    


    </section>
    <!-- <div id="session" session="<!?php echo $_SESSION['UID']?>"><!?php echo $_SESSION['UID']?></div> -->



    
  </main><!-- End #main -->
  <main id="main" class="mainschedule">                    
    <i class="bi bi-arrow-left-square me-4 back" data-bs-toggle="tooltip" data-bs-placement="top" title="Back"></i>
    <div class="pagetitle">
      <h1>Schedule a Computer</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">New Schedule</a></li>
          <li class="breadcrumb-item active">Schedule a Computer
            <!--?php
              $result=mysqli_query($con,"select *from timer_tbl order by timer_id desc limit 1");
              $row = mysqli_fetch_assoc($result);
              echo $row['start_time']." ";
              echo $row['end_time'];
            ?-->
          </li>
        </ol> 
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard" >
      <?php
        $ret=mysqli_query($con,"select *from tblcomputers");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)){
      ?>
  <div class="pc-cont border" >
    
  <div style="height:200px;overflow-x:scroll;">
      <span class="fw-bold text-center pc-id">PC<?php echo $row['ID'];?></span>
      <i class="bi bi-laptop text-center p-0 fs-1 pc-icon"></i>
      <!--button type="button" class=" btn-primary reserve-button"><a href="edit-computer-detail.php?editid=<!php echo $row['ID'];?>">Edit Details</a></button-->
      <!-- Button trigger modal -->
      <button type="button" data-pc="<?php echo $row['ID']; ?>" class="btn-primary reserve-button mt-2 pl-1 
      <?php 
      $ret1=mysqli_fetch_array(mysqli_query($con,"select *from timer_tbl where pc_id = '".$row['ID']."'"));
      if($ret1){
        echo 'btn-danger pr';
      }        
      ?>" id="<?php 
      $ret1=mysqli_fetch_array(mysqli_query($con,"select *from timer_tbl where pc_id = '".$row['ID']."'"));
      if($ret1){
        echo 'Occupied';
      }else{
        echo 'Reserve';
      }        
      ?>" data-bs-toggle="<?php 
      $ret1=mysqli_fetch_array(mysqli_query($con,"select *from timer_tbl where pc_id = '".$row['ID']."'"));
      if($ret1){
        echo '';
      }else{
        echo 'modal';
      }        
      ?>" data-bs-target="#exampleModal"><?php 
      $ret1=mysqli_fetch_array(mysqli_query($con,"select *from timer_tbl where pc_id = '".$row['ID']."'"));       
      if($ret1){
        echo '<a href="queue.php?id='.$row['ID'].'" class="text-white pr-2">Occupied</a>'; 
      }else{
        echo 'Reserve';
      }        
      ?></button>
    <small class="ms-3"><a href="scheduled.php?id=<?php echo $row['ID'];?>" class="link-primary">Details</a></small>
      <!-- Modal -->
              
            </div>
            
          </div>
        </div>
      </div>
      <!-- Modal -->
      <?php 
    $cnt=$cnt+1;
    }?>
      






  
  </div>
  </div>
    </section>

  </main><!-- End #main -->
  <main id="main" class="mainsetschedule">

    <div class="pagetitle">
      <h5>New Schedule</h5>
    </div><!-- End Page Title -->
    <section class="section dashboard" >
      <div class="card">
        <div class="card-body">
          <div class="card-title mb-1 d-flex">
            <i class="bi bi-arrow-left-square me-4 back" data-bs-toggle="tooltip" data-bs-placement="top" title="Back"></i>
            <h5>Things to do</h5>
          </div>
           <!-- TinyMCE Editor -->
           <textarea class="tinymce-editor" id="thingstodo"  placeholder="Completely optional, but you might want to add some note as to why you'll be scheduling the labouratory">
              
            </textarea><!-- End TinyMCE Editor -->
          
          <div class="border-bottom"></div>
          <div class="schedule_task mt-1"></div>
          <div class="attachments" >
            <ul>
              <li><a href="" class="text-muted pe-3" style="cursor: not-allowed;" ><i class="bi bi-link-45deg"></i> File</a></li>
              <li><a href="" class="text-muted pe-3" style="cursor: not-allowed;" ><i class="bi bi-file-earmark-pdf"></i> New Document</a></li>
              <li><a href="" class="text-muted pe-3" style="cursor: not-allowed;" ><i class="bi bi-at"></i> mention</a></li>              
              <li><a href="" class="text-muted pe-3" style="cursor: not-allowed;" ><i class="bi bi-blockquote-left"></i> Quote</a></li>
            </ul>
          </div>

          <div class="schedule_timing ">
            
            
            <div class="row mb-3 border-bottom pb-1">
              <label for="inputText" class="col-sm-3 col-form-label">Person Responsible</label>
              <div class="col-sm-5">
                <input type="text" style="font-size:14px;cursor: not-allowed;" class="form-control usern" value="<?php 
                    $query = mysqli_query($con, "SELECT * FROM tblusers WHERE id= '".$_SESSION['UID']."' ");
                    $row = mysqli_fetch_assoc($query);            
                    $dbfullname = $row['firstname'].' '.$row['surname'];
                    echo $_SESSION['username'].$dbfullname;
                  ?>"  disabled>
              </div>
            </div>
                <div class="row mb-3 border-bottom pb-1">
                  <label for="inputEmail" class="col-sm-3 col-form-label">Starting</label>
                  <div class="col-sm-6">
                    <input type="datetime-local"  style="font-size:14px" class="form-control starting">
                  </div>
                </div>
                <div class="row mb-3 border-bottom pb-1">
                  <label for="inputEnd" class="col-sm-3 col-form-label">Ending</label>
                  <div class="col-sm-6">
                    <input type="datetime-local"  style="font-size:14px" class="form-control ending">
                  </div>
                </div>
          </div>
          <!-- Default Accordion -->
          <div class="accordion" id="morescheduleopt">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" style="font-size:14px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      More
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#morescheduleopt">
                    <div class="accordion-body">
                      <div class="row mb-3 border-bottom pb-1">
                        <label for="inputname" class="col-sm-3 col-form-label">Name <br> Schedule</label>
                        <div class="col-sm-6">
                          <input type="text"  style="font-size:14px" class="form-control inputname" id="inputname" data-bs-toggle="tooltip" data-bs-placement="bottom"  placeholder="Optional" title="Unnamed schedules will be scheduled as anonymous schedules">
                        
                        </div>
                      </div>



                      <div class="row mb-3 border-bottom pb-1">
                        <label for="inputPc" class="col-sm-3 col-form-label">Schedule PC</label>
                        <div class="col-sm-6">
                          <input type="text" class="pcid"  style="font-size:14px; color:blue;cursor: not-allowed;" class="form-control" disabled="" value="PC-2">
                        </div>
                      </div>


                      <div class="row mb-3 border-bottom pb-1">
                        <label for="inputProject" class="col-sm-3 col-form-label">Project</label>
                        <div class="col-sm-6">
                          <input type="text" class="project"  style="font-size:14px; border:1px solid rgb(212,212,212)" class="form-control" placeholder="Optional" value="">
                        </div>
                      </div>



                      
                    </div>
                  </div>
                </div>            
              </div><!-- End Default Accordion Example -->
        </div>


        
        <button class="btn add-schedule" type="button">
          <span class=" spinner-border-sm" role="status" aria-hidden="true"></span>
                Add schedule
        </button>
        <button class="btn upd-schedule" type="button">
          <span class=" spinner-border-sm" role="status" aria-hidden="true"></span>
                Update Schedule
        </button>
          
        
        <!-- <button class="btn add-sgchedule">Add Schedule</button> -->
      </div>
        
    </section>
  </main>


  <!-- Observers main Page -->
  

  <!-- Workgroup Pane -->
  <main id="main" class="workgroup_pane">

    <!-- <div class="pagetitle">
      <h5>Workgroup</h5>
    </div> -->
    <section class="section dashboard" >
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-4 wkgrpimg">
            <img src="../assets/img/group.svg" class="img-fluid rounded-start" alt="...">
            <p class="card-text" style="display:none">Team up with other users, view <br> their schedules and participate in a discussion.</p>
            
          </div>
          <div class="col-md-8 wkgrpdis">
            <div class="card-body" >
              <h5 class="card-title mt-2" style="font-size:25px; padding-bottom:0px; font-weight:500">Manage your Team</h5>
              
              <p class="card-text">Team up with other users, view their schedules and participate in a discussion.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="card-title mb-1 d-flex">
            <i class="bi bi-arrow-left-square me-4 back" data-bs-toggle="tooltip" data-bs-placement="top" title="Back"></i>
            <nav class="descbreadcrump" style="--bs-breadcrumb-divider: '>';">
              <ol class="breadcrumb">
                <li class="breadcrumb-item me-1"><a href="#">Add Name</a></li>
                <li class="breadcrumb-item me-1"><a href="#">Add Description</a></li>
                <li class="breadcrumb-item me-1"><a href="#">Add Member</a></li>
              </ol>
            </nav>
          </div>
          

          <!-- Invitation Options -->
          <div class="workgroup_cont ">
            <!-- By Telephone -->
            <h5>About Workgroup</h5>
            <!--st  -->
            
            <!-- end -->
            <div class="row mb-3 pb-1">
              <div class="col-sm-6">
                <label for="" class="workgroup-label form-label">Workgroup Name</label>
                <input type="text" id="" value="" class="form-control workgroupname" style="height:34px; font-size:14px" placeholder="Workgroup Name">
              </div>
            </div>
            <div class="row mb-3 pb-1">
              <div class="col-sm-6">
                <label for="" class="workgroup-label form-label">Description</label>
                <input type="text" id="" value="" class="form-control workgroupdesc" style="height:34px; font-size:14px" placeholder="Description">
              </div>
            </div>

            <div class="row mb-3 pb-1">
              <div class="col-sm-6 wkg_mem">
                <label for="" class="workgroup-label form-label">New member</label>
                <input type="text" id="" value="" class="form-control workgroupname wkgroupinput" style="height:34px" placeholder="registration number">
                <div class="result"></div>
                <!-- Selected Users -->
                <!-- <div class="input-group mb-3  mt-3 usertolist">
                  <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="invitenow" disabled>
                  <button class="btn btn-outline-secondary  invitenow " type="button" id="invitenow"><i class="bi bi-cursor"></i></button>
                </div> -->
              </div>
            </div> 
          

            <!-- Default Accordion -->
            <div class="accordion" id="morescheduleopt">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" style="font-size:14px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    More
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#morescheduleopt">
                  <div class="row mb-3 pb-1">
                    <div class="col-sm-6">
                      <label for="" class="workgroup-label form-label" style="margin:20px; margin-bottom:0px">Workgroup icon</label>
                      <div class="workgroup_icon d-flex">
                        <img src="../assets/img/group.png" class="workgroup_icon_img gimg active" alt="">
                        <img src="../assets/img/teamwork.png" class="workgroup_icon_img timg" alt="">
                        <img src="../assets/img/group5.png" class="workgroup_icon_img timg" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>            
            </div><!-- End Default Accordion Example -->
          </div>
          
          <input id="hidden_js_aid" type="hidden" name="hidden_js_array">
        <div class="d-flex mt-4">
          <button class="btn groupback me-2" type="button">Back</button>
          <button class="btn groupsubmit" type="button">Submit</button>
        </div>
      </div>
        
    </section>
  </main>



  <!-- Add computer -->
  <main id="main" class="addcomputer_pane">

    <!-- <div class="pagetitle">
      <h5>Workgroup</h5>
    </div> -->
    <section class="section dashboard" >
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-4 wkgrpimg">
            <img src="../assets/img/nwcomputer.png"  class="img-fluid rounded-start" alt="...">
            <p class="card-text" style="display:none">Upload computer details to help students understanding what they're scheduling.</p>
            
          </div>
          <div class="col-md-8 wkgrpdis">
            <div class="card-body" >
              <h5 class="card-title mt-2" style="font-size:25px; padding-bottom:0px; font-weight:500">Upload a new computer</h5>
              
              <p class="card-text">Upload computer details to help students understanding what they're scheduling</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="card-title mb-1 d-flex">
            <i class="bi bi-arrow-left-square me-4 back" data-bs-toggle="tooltip" data-bs-placement="top" title="Back"></i>
            <nav class="descbreadcrump" style="--bs-breadcrumb-divider: '>';">
              <ol class="breadcrumb">
                <li class="breadcrumb-item me-1"><a href="#">Add Name</a></li>
                <li class="breadcrumb-item me-1"><a href="#">Add Description</a></li>
                <li class="breadcrumb-item me-1"><a href="#">Add Properties</a></li>
              </ol>
            </nav>
          </div>
          

          <div class="addcomputer ">
            <h5>About Computer</h5>
            <!--st  -->
            <form class="row g-3" method="POST">
                <div class="col-md-12">
                  <label for="computername" class="form-label">Computer Name</label>
                  <input type="text" class="form-control" id="computername" name="computername" placeholder="HP Pavilion G5">
                </div>
                <div class="col-md-12">
                  <label for="aboutcomputer" class="form-label">About Computer</label>
                  <input type="text" class="form-control" id="aboutcomputer" name="aboutcomputer" placeholder="HP Pavilion G5 is one of the best comp.">
                </div>
                <div class="col-md-6">
                  <label for="display" class="form-label">Display</label>
                  <input type="text" class="form-control" placeholder='11.6"HD' id="display" name="display">
                </div>
                <div class="col-md-6">
                  <label for="processor" class="form-label">Processor</label>
                  <input type="text" class="form-control" placeholder='Quad Core, 1.8GHz' id="processor" name="processor">
                </div>
                <div class="col-md-6">
                  <label for="harddisk" class="form-label">Hard Disk</label>
                  <input type="text" class="form-control" placeholder='512GB Hard Disk' id="harddisk" name="harddisk">
                </div>
                <div class="col-md-6">
                  <label for="disresol" class="form-label">Display Resolution</label>
                  <input type="text" class="form-control" placeholder='1344 x 1234' id="disresol" name="disresol">
                </div>
                <div class="col-md-6">
                  <label for="ram" class="form-label">Ram</label>
                  <input type="text" class="form-control" placeholder='8GB' id="ram" name="ram">
                </div>
                <div class="col-md-6 notselected">
                  <label for="inputtouch" class="form-label">Touch Screen</label>
                  <select id="inputtouch" class="form-select" name="touchscreen">
                    <option selected>Choose...</option>
                    <option value="True">True</option>
                    <option value="False">False</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="graphics" class="form-label">Graphics Card</label>
                  <input type="text" class="form-control" placeholder='Intel UHD Graphics 620' id="graphics" name="graphics">
                </div>              
                
                <div class="col-md-6">
                  <label for="inputssd" class="form-label">SSD</label>
                  <select id="inputssd" class="form-select" name="ssd">
                    <option selected>Choose...</option>
                    <option value="True">True</option>
                    <option value="False">False</option>
                  </select>
                </div> 
              </form>
              
            </div>
            <div class="d-flex mt-4">
              <button class="btn compback me-2" type="button">Back</button>
              <button class="btn addcomputersubmit"  type="button">Submit</button>
            </div>
          
        
      </div>
        
    </section>
  </main>


  <!-- Make Admin -->
  <main id="main" class="makeadmin_pane">    
    <section class="section dashboard" >
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-4 wkgrpimg">
            <img src="../assets/img/newadmin.png"  class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8 wkgrpdis">
            <div class="card-body">
              <h5 class="card-title mt-2" style="font-size:25px; padding-bottom:0px; font-weight:500">Create a new administrator</h5>
              
              <p class="card-text">Assign a new administrator with administrative rights to the unisc schedule system</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="card-title mb-1 d-flex">
            <i class="bi bi-arrow-left-square me-4 back" data-bs-toggle="tooltip" data-bs-placement="top" title="Back"></i>
            <nav class="descbreadcrump" style="--bs-breadcrumb-divider: '>';">
              <ol class="breadcrumb">
                <li class="breadcrumb-item me-1"><a href="#">Search user</a></li>
                <li class="breadcrumb-item me-1"><a href="#">Add list</a></li>
                <li class="breadcrumb-item me-1"><a href="#">Create admin</a></li>
              </ol>
            </nav>
          </div>
          

          <!-- Invitation Options -->
          <div class="invite_observers ">
            <div class="row mb-3 pb-3 ">
              <div class="col-sm-6 userscont">   
                <input type="text" id="byuser" width="260px" value="" placeholder="Search by name or reg. no." class="form-control ms-2 byuser" autocomplete="off" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Search Unisc user by name or registration details">
                <div class="result"></div>




                <!-- Selected Users -->
                <!-- <div class="input-group mb-3  mt-3 usertolist">
                  <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="invitenow" disabled>
                  <button class="btn btn-outline-secondary  invitenow " type="button" id="invitenow"><i class="bi bi-cursor"></i></button>
                </div> -->
              </div>
            </div>


          <!-- Default Accordion -->
          <div class="accordion" id="morescheduleopt">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" style="font-size:14px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      More
                    </button>
                  </h2>
                  <div id="collapseOne" style="width: 200px; margin-left: 70px;" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#morescheduleopt">
                  <?php
                    $admins = mysqli_query($con, "SELECT * FROM `administrators` ORDER BY id DESC");
                    while($row = mysqli_fetch_array($admins)){
                  ?>  
                    <div class="input-group mb-3  mt-3">
                      <input type="text" class="form-control" aria-label="Recipient's username" value="<?php
                      $usersql = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$row['user_id']."' "); 
                      $row1 = mysqli_fetch_array($usersql);
                      echo $row1['firstname'] .' '.$row1['surname'];
                      ?>" aria-describedby="admincc" disabled style="font-size:14px;color:#576D94">
                    </div>
                  <?php }?>
                  </div>
                </div>            
              </div><!-- End Default Accordion Example -->
        </div>
        
        <input id="hidden_js_admin" type="hidden" name="hidden_js_array">
      </div>
        
    </section>
  </main>


  <!-- Bulk schedule -->
  <main id="main" class="bulkschedule_pane">

    <section class="section dashboard" >
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-4 wkgrpimg">
            <img src="../assets/img/group.svg" class="img-fluid rounded-start" alt="...">
            <p class="card-text" style="display:none">Leverage on your administrative rights, schedule computers in bulk or in its entirety.</p>
            
          </div>
          <div class="col-md-8 wkgrpdis">
            <div class="card-body">
              <h5 class="card-title mt-2" style="font-size:25px; padding-bottom:0px; font-weight:500">Bulk Schedule</h5>
              
              <p class="card-text">Leverage on your administrative rights, schedule computers in bulk or in its entirety.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="card-title mb-1 d-flex">
            <i class="bi bi-arrow-left-square me-4 back" data-bs-toggle="tooltip" data-bs-placement="top" title="Back"></i>
            <nav class="descbreadcrump" style="--bs-breadcrumb-divider: '>';">
              <ol class="breadcrumb">
                <li class="breadcrumb-item me-1"><a href="#">Add PCs</a></li>
                <li class="breadcrumb-item me-1"><a href="#">Add Description</a></li>
                <li class="breadcrumb-item me-1"><a href="#">Add Timing</a></li>
              </ol>
            </nav>
          </div>
          

          <!-- Invitation Options -->
          <div class="workgroup_cont ">
            <!-- By Telephone -->
            <h5>Schedule PCs</h5>
            
            <form action="admin-bulk-schedule.php" method="POST">
            <div class="row mb-3 pb-1">
              <div class="col-sm-6">
                <label for="" class="workgroup-label form-label">Available PCs</label>
                <input type="number" max="10" min="1" id="availpcs" name="availpcs" value="" class="form-control avlval" >
              </div>
              <div class="col-sm-6">
                <label for="" class="workgroup-label form-label">Schedule name</label>
                <input type="text" name="reqnname" value="" class="form-control" placeholder="Schedule Name">
              </div>
              
            </div>
            <div class="row mb-3 pb-1">
              <div class="col-sm-6">
                <label for="" class="workgroup-label form-label">Starting</label>
                <input type="datetime-local" name="reqst" value="" class="form-control" placeholder="Workgroup Name">
              </div>
              <div class="col-sm-6">
                <label for="" class="workgroup-label form-label">Ending</label>
                <input type="datetime-local" name="reqed" value="" class="form-control" placeholder="Workgroup Name">
              </div>
            </div>
            <div class="row mb-3 pb-1">
              <div class="col-sm-12">
                <label for="" class="workgroup-label form-label">Description</label>
                <input type="text" name="reqdes" value="" class="form-control workgroupdesc" placeholder="Description">
              </div>
            </div>

          
          

            <!-- Default Accordion -->
            <div class="accordion" id="morescheduleopt">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" style="font-size:14px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    More
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#morescheduleopt">
                 
                </div>
              </div>            
            </div><!-- End Default Accordion Example -->
          </div>
          
          <input id="scpcids" type="hidden" name="scpcids">
        <div class="d-flex mt-4">
          <button class="btn reqback me-2" type="button">Back</button>
          <button class="btn reqsubmit" type="submit">Submit</button>
        </div>
        </form>
      </div>
        
    </section>
  </main>
  

  <!-- Workgroup view_pane -->
  <main id="main" class="workgroup_view_pane">

    <!-- <div class="pagetitle">
      <h5>Workgroup</h5>
    </div> -->
    <section class="section dashboard" >
      <div class="card mb-3">
        <div class="row g-0">
          
          <div class="col-md-8">
            <div class="card-body" >
              <h5 class="card-title mt-2 wkgrppaneh2" style="font-size:30px; padding-bottom:0px; font-weight:500">Participate and manage your Workgroups</h5>
              
              <p class="card-text wkgrppanep">Participate in workgroups, learn what your colleagues are up to and catch up with the trend.</p>
            </div>
          </div>
          <div class="col-md-4">
            <img class="wkgrppaneimg" src="../assets/img/group.svg" style="height: 90px; margin: 30px;" class="img-fluid rounded-start" alt="...">
          </div>
        </div>
      </div>


      <div class="card">
        <div class="card-body">
          <div class="table-responsive table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl table-responsive-xxl" >
            <table class="table datatable"  >
              <thead>
                <tr>
                  <th scope="col">Icon</th>
                  <th scope="col">Name</th>
                  <th scope="col">About</th>
                  <th scope="col">Privacy</th> 
                </tr>
              </thead>
              <tbody>
                <?php
                  $wksql = mysqli_query($con, "SELECT * FROM `users_workgroup` WHERE `user_id` = '".$_SESSION['UID']."' ");
                  while($wkrow = mysqli_fetch_array($wksql)){

                ?>
                <tr>
                  <td><?php echo $_SESSION['UID'] ?></td>
                  <td><a href="workgroup.php?workgroup_id=<?php echo $wkrow['workgroup_name']?>" class="grplink"> <?php echo $wkrow['workgroup_name']?></a></td>
                  <td><!--?php echo $wkrow['description']?--></td>
                  <td></td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>







      
        
    </section>
  </main>




  <!-- Chat pane -->
  <main id="main" class="workgroup_chat_pane">

    <!-- <div class="pagetitle">
      <h5>Workgroup</h5>
    </div> -->
    <section class="section dashboard" >
      <div class="card mb-3">
        <div class="row g-0">
          
          <div class="col-md-8">
            <div class="card-body" >
              <h5 class="card-title mt-2" style="font-size:30px; padding-bottom:0px; font-weight:500">Participate and manage your Workgroups</h5>
              
              <p class="card-text">participate in workgroups, learn what your colleagues are up to and catch up with the trend.</p>
            </div>
          </div>
          <div class="col-md-4">
            <img src="../assets/img/group.svg" style="height: 90px; margin: 30px;" class="img-fluid rounded-start" alt="...">
          </div>
        </div>
      </div>


      






      <div class="card">
        <div class="card-body">
          <div class="card-title mb-1 d-flex">
            <i class="bi bi-arrow-left-square me-4 back" data-bs-toggle="tooltip" data-bs-placement="top" title="Back"></i>
            <nav style="--bs-breadcrumb-divider: '>';">
              <ol class="breadcrumb">
                <li class="breadcrumb-item me-1"><a href="#">Add Name</a></li>
                <li class="breadcrumb-item me-1"><a href="#">Add Description</a></li>
                <li class="breadcrumb-item me-1"><a href="#">Add Member</a></li>
              </ol>
            </nav>
          </div>
          

          <!-- Invitation Options -->
          <div class="workgroup_cont ">
            <!-- By Telephone -->
            <h5>About Workgroup</h5>
            <div class="row mb-3 pb-1">
              <div class="col-sm-6">
                <label for="" class="workgroup-label form-label">Workgroup Name</label>
                <input type="text" id="" value="" class="form-control workgroupname" style="height:34px; font-size:14px" placeholder="Workgroup Name">
              </div>
            </div>
            <div class="row mb-3 pb-1">
              <div class="col-sm-6">
                <label for="" class="workgroup-label form-label">Description</label>
                <input type="text" id="" value="" class="form-control workgroupdesc" style="height:34px; font-size:14px" placeholder="Description">
              </div>
            </div>

            <div class="row mb-3 pb-1">
              <div class="col-sm-6 wkg_mem">
                <label for="" class="workgroup-label form-label">New member</label>
                <input type="text" id="" value="" class="form-control workgroupname wkgroupinput" style="height:34px" placeholder="registration number">
                <div class="result"></div>
                <!-- Selected Users -->
                <!-- <div class="input-group mb-3  mt-3 usertolist">
                  <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="invitenow" disabled>
                  <button class="btn btn-outline-secondary  invitenow " type="button" id="invitenow"><i class="bi bi-cursor"></i></button>
                </div> -->
              </div>
            </div> 
          

            <!-- Default Accordion -->
            <div class="accordion" id="morescheduleopt">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" style="font-size:14px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    More
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#morescheduleopt">
                  <div class="row mb-3 pb-1">
                    <div class="col-sm-6">
                      <label for="" class="workgroup-label form-label" style="margin:20px; margin-bottom:0px">Workgroup icon</label>
                      <div class="workgroup_icon d-flex">
                        <img src="../assets/img/group.png" class="workgroup_icon_img gimg active" alt="">
                        <img src="../assets/img/teamwork.png" class="workgroup_icon_img timg" alt="">
                        <img src="../assets/img/group5.png" class="workgroup_icon_img timg" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>            
            </div><!-- End Default Accordion Example -->
          </div>
          
          <input id="hidden_js_aid" type="hidden" name="hidden_js_array">
        <div class="d-flex mt-4">
          <button class="btn groupback me-2" type="button">Back</button>
          
          <button class="btn groupsubmit" type="button"><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Submit</button>
        </div>
      </div>
        
    </section>
  </main>

  <!-- Notification Pane -->
  <main id="main" class="notification_pane">

    <div class="pagetitle">
      <h5>All Notifications</h5>
    </div><!-- End Page Title -->
    <section class="section dashboard" >
      <div class="card">
        <div class="card-body">
          <div class="card-title mb-1 d-flex">
            <i class="bi bi-arrow-left-square me-4 back" data-bs-toggle="tooltip" data-bs-placement="top" title="Back"></i>
            <h5>Notifications</h5>
          </div>
          


         
          <?php
              $notifsql = mysqli_query($con, "SELECT * FROM `notifications` WHERE `user_id` = '".$_SESSION['UID']."' ORDER BY id DESC; "); 
              while($rownotif = mysqli_fetch_array($notifsql)){
                
                ?>

          <div class="notification_cont" data-id="<?php echo $rownotif['id']?>">
            <div class="d-flex align-items-center border-bottom pb-1">
              <div class="row" style="width:100%">
                <div class="col-lg-8 col-md-12 col-sm-12 indnotifitem" data-id="<?php echo $rownotif['id']?>" style="margin-top:14px;">
                  <img src="../assets/img/request.png" class="me-2 mt-2" alt=""><span class="notif_title"><?php echo $rownotif['title']?></span><br>
                  <p style="font-size:13px;margin-left: 43px; margin-top: -8px;"><?php echo $rownotif['notification']?></p>  
                  <!-- Created if it satisfies a condition -->
                  <!-- <div class="notbuttons">
                    <button class="accept">Accept</button>
                    <button class="decline">Decline</button>
                  </div> -->
                  <!-- <div class="wotbuttons"><button class="wdel">Delete</button></div> -->
                </div>                                        
                
                <div class="col-lg-4 col-md-12 col-sm-12">
                  <p class="" style="font-size:11px; float:right; margin-top:10px">
                  <?php echo $rownotif['time']?></p>
                </div>
              </div>
            </div>

          </div>
          <?php }?>

          
            


          <!-- Default Accordion -->
          <div class="accordion" id="morescheduleopt">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" style="font-size:14px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      More
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#morescheduleopt">
                    
                  </div>
                </div>            
              </div><!-- End Default Accordion Example -->
        </div>
      </div>
        
    </section>
  </main>


  <!-- Account Info -->

  <main id="main" class="accsetting_pane">
    <section class="section dashboard" >
      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="../assets/img/accimg.png" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body" style="margin-left:-30px">
              <h5 class="card-title mt-2" style="font-size:25px; padding-bottom:0px; font-weight:500">Account Setting</h5>
              
              <p class="card-text">Only you can see you profile, you can only change your profile picture.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
          
          <!-- Start -->
          <div class="card" style="background:#f6f9ff">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>


              </ul>
              <div class="tab-content pt-2">


                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form class="contprof">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img style="width:100px;height:100px" src="
                          <?php 
                          $query = mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$_SESSION['UID']."';");
                          $row = mysqli_fetch_assoc($query);
                          $img = $row['location'];
                          echo $img;
                        ?>                        
                        " alt="Profile">
                        <div class="pt-2">
                          <input type="file" id="image" style="display:none;">

                          <a href="#" class="btn btn-primary btn-sm insertimg" title="Upload new profile image" onclick="document.getElementById('image').click()" ><i class="bi bi-file-person"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image" ><i class="bi bi-trash"></i></a>
                          <a href="#" class="btn btn-primary btn-sm " title="Submit new profile image" id="upload"><i class="bi bi-upload"></i></a>
                          </div>
                      </div>
                    </div>

                    <div class="row mb-3 pb-1">
                      <div class="col-sm-6">
                        <label for="" class="workgroup-label form-label">Name</label>
                        <input type="text" id="" value="<?php 
                          $query = mysqli_query($con, "SELECT * FROM tblusers WHERE id= '".$_SESSION['UID']."' ");
                          $row = mysqli_fetch_assoc($query);
                          $dbfullname = $row['firstname'].''. $row['surname'];
                          echo $dbfullname;?>" class="form-control " style="height:34px; font-size:14px" disabled>
                      </div>
                    </div>

                    <div class="row mb-3 pb-1">
                      <div class="col-sm-6">
                        <label for="" class="workgroup-label form-label">Registration No</label>
                        <input type="text" id="" value="<?php 
                          $query = mysqli_query($con, "SELECT * FROM tblusers WHERE id= '".$_SESSION['UID']."' ");
                          $row = mysqli_fetch_assoc($query);
                          echo $row['regno'];
                        ?>" class="form-control " style="height:34px; font-size:14px" disabled>
                      </div>
                    </div>

                    <div class="row mb-3 pb-1">
                      <div class="col-sm-6">
                        <label for="" class="workgroup-label form-label">Email</label>
                        <input type="text" id="" value="<?php 
                          $query = mysqli_query($con, "SELECT * FROM tblusers WHERE id= '".$_SESSION['UID']."' ");
                          $row = mysqli_fetch_assoc($query);
                          echo $row['email'];
                        ?>" class="form-control" style="height:34px; font-size:14px" disabled>
                      </div>
                    </div>




                    <div class="row mb-3 pb-1">
                      <div class="col-sm-6">
                        <label for="" class="workgroup-label form-label">Phone</label>
                        <input type="text" id="" value="<?php 
                          $query = mysqli_query($con, "SELECT * FROM tblusers WHERE id= '".$_SESSION['UID']."' ");
                          $row = mysqli_fetch_assoc($query);
                          echo $row['phone'];?>" class="form-control " style="height:34px; font-size:14px" disabled>
                      </div>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                

              </div><!-- End Bordered Tabs -->

            </div>
          </div>
          <!-- End -->
         
      </div>
        
    </section>
  </main>


  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>UniuyoSchedule</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
     Designed by <a href="https://tasknify.com/">Tasknify</a>
    </div>
  </footer><!-- End Footer -->

  <a href="" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.min.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/jquery.js"></script>
  <script src="../assets/js/users_profile.js"></script>
  <script src="../assets/js/index.js"></script>
  <script src="../assets/js/script.js"></script>
  <script>
    $(function(){

      //Toggle back button
      $('.back').on('click', function(e){
        e.preventDefault();
        $parent = this.parentElement.parentElement.parentElement.parentElement.parentElement;
        $parent1 = $(this).parent().parent().parent().parent().parent();
        $removeclass = $parent.classList[1];
        $parent1.removeClass($removeclass);
      });

      //Calender
      $('.fc-daygrid-day-top').on('click',function(){
        $selected = $(this).children('.fc-daygrid-day-number').attr('aria-label');
        $selected = new Date($selected);
        $selected = new Date($selected.getTime() - $selected.getTimezoneOffset() * 60000).toISOString().substring(0, 19);


        $('.mainschedule').toggleClass('mainscheduleactivenp');
        $('.starting').val($selected);
        $('.ending').val($selected);
        console.log($selected);
      });



      $('.quickset').on('click', function(e){
        e.preventDefault();
        var reserve = document.querySelector('#Reserve');
        var qpcid = reserve.attributes['data-pc'].nodeValue;
        $('.mainsetschedule').toggleClass('mainsetscheduleactive');        
        $('.pcid'). val('PC-'+qpcid);
        $('.upd-schedule').attr('style','display:none');
        console.log(qpcid);
      });

      $('.scview').on('click', function(){
        console.log($(this).parent());
        $('.mainsetschedule').toggleClass('mainsetscheduleactive');

        $dataid = $(this).attr('data-id'); 
        $datapcid = $(this).attr('data-pcid');
        $datatask = $(this).attr('data-task');
        $datascname = $(this).attr('data-scname');
        $dataprname = $(this).attr('data-prname'); 
        $datastm = $(this).attr('data-stm');
        $dataetm = $(this).attr('data-etm');
        $datapst = $(this).attr('data-pst');

        console.log($datastm);


        tinymce.get("thingstodo").setContent($datatask); 
        $('.starting').val($datastm); 
        $('.ending').val($dataetm ); 
        $('.inputname').val($datascname);
        $('.project').val($dataprname);
        $('.pcid').val('PC-'+$datapcid);

        $('.starting').attr('disabled',''); 
        $('.ending').attr('disabled','');
        $('.inputname').attr('disabled','');
        $('.project').attr('disabled','');
        $('.pcid').attr('disabled','');
        $('.add-schedule').attr("style","display:none")



      })

      //Edit
      $('.scedit').on('click', function(){
        $('.mainsetschedule').toggleClass('mainsetscheduleactive');

        $dataid = $(this).attr('data-id'); 
        $datapcid = $(this).attr('data-pcid');
        $datatask = $(this).attr('data-task');
        $datascname = $(this).attr('data-scname');
        $dataprname = $(this).attr('data-prname'); 
        $datastm = $(this).attr('data-stm');
        $dataetm = $(this).attr('data-etm');
        $datapst = $(this).attr('data-pst');

        console.log($datastm);


        tinymce.get("thingstodo").setContent($datatask); 
        $('.starting').val($datastm); 
        $('.ending').val($dataetm ); 
        $('.inputname').val($datascname);
        $('.project').val($dataprname);
        $('.pcid').val('PC-'+$datapcid);
        $('.back').attr('data-id',$dataid);

        
        $('.add-schedule').css({'display':'none'});



      });
      

      $('.scdel').on('click', function(){
        $id = $(this).attr('data-id');
        $.ajax({
        type: 'POST',
        data: {scdel: 'scdel',
               elemid: $id},

        success: function(data){          
          window.onbeforeunload = null;
          location.reload();
        },
        error: function(data){
          console.log(data + " error");
        }
      });

               
    });

        
      })



  </script> 
</body>

</html>