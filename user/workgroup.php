
<?php
  include('../includes/redirection_conn.php');   

  $uid=$_SESSION['UID'];
  $id = '';
  $gpname = $_GET['workgroup_id'];
  if(!($gpname)){
    header('location:index.php');
  }else{
    $id = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `workgroup` WHERE `name` = '".$gpname."';"));
    $id = $id['id'];
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Start Head -->
<?php include('../includes/clienthead.php'); ?> 
<!-- End Head -->

  <title>Workgroup | UniuyoSchedule</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/index.css" rel="stylesheet">
<style>
  .float-even{
    margin-left':'72%'
  }
  

</style>
</head>

<body>

  <!-- Start Header -->
<?php include('../includes/clientheader.php'); ?>
<!-- End Header -->
<!-- Start Sidebar -->
<?php include('../includes/workgroupoffcanvas.php'); ?>
<!-- End Sidebar -->
  

<main id="main" class="main">
  <section class="section dashboard" >
    <div class="row">
      <div class="col-4 allworkgroupspane">
        <div class="card mb-3" style="margin-top:-20px; margin-left:-30px; height:90vh; overflow-y:scroll">
        <!-- List of groups and active chat -->
          <div class="ms-3">
            <div class="d-flex align-content-between border-bottom" style="margin-top:37px">
               <div class="search ms-2"><a href="index.php"><i class="bi bi-arrow-left-square me-4 back" data-bs-toggle="tooltip" data-bs-placement="top" title="Back"></i></a></div>
              <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="padding-top:0px; padding-bottom:0px; outline:none; margin-left:250px; margin-bottom:17px;">
                <div class="btn-group" role="group">
                  <button id="btnsettings" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="padding-top:0px; padding-bottom:0px; outline:none">
                    <i class="bi bi-gear"></i>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="btnsettings ">
                    <li><a class="dropdown-item addWorkgroup"  href="#create">Create Workgroup</a></li>                                
                  </ul>
                </div>
              </div>
            </div>
            <?php		
              $query=mysqli_query($con,"SELECT * FROM `users_workgroup` WHERE `user_id` = '".$_SESSION['UID']."' LIMIT 6;");
              while($row = mysqli_fetch_array($query)){
            ?>
              <a href="workgroup.php?workgroup_id=<?php echo $row['workgroup_name']?>" class="wkgrpmap">
                <div class="col-12 border-bottom" style="margin-top:14px;">      
                  <img src="<?php
                  $path=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `workgroup` WHERE `name` = '".$row['workgroup_name']."';"));
                  echo $path['avatar'];                      
                  ?>" class="me-2 mt-2" style="border-radius:50%; width: 35px; height:35px;" alt=""><span class="notif_title" style="color: #012970; top:-7px; position:relative;">Workgroup: "<?php echo $row['workgroup_name']?>"</span><br>
                  <i class="bi bi-arrow-90deg-left" style="margin-top:-40px;margin-left: 43px;position:relative;top:-22px;font-size:10px"></i>
                  <p style="display:inline-block;font-size:13px; top:-18px; margin-left:7px; position:relative">
                  <?php 
                    $creator = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `workgroup` WHERE `name` = '".$row['workgroup_name']."';"));
                    $creator = $creator['creator_id'];
                    $creator1 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$creator."';"));
                    echo $creator1['firstname'].' '.$creator1['surname'];
                  ?></p>                      
                </div>  
              </a>     
            <?php }?>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-sm-12">
        <div class="card" style="margin-top:-20px; margin-left:-30px; height:90vh ">
          <div class="card-body" style="flex:0 1 auto;">     
            <div class="chatheader" data-id="<?php echo $id?>">
              <div class="d-flex align-items-center border-bottom pb-1">
                <div class="row" style="width:100%">
                  <div class="col-lg-8 col-sm-12" style="margin-top:14px;">
                    <img src="<?php
                      $path=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM `workgroup` WHERE `id` = '".$id."';"));
                      echo $path['avatar'];                      
                      ?>" class="me-2 mt-2" style="border-radius:50%; width: 35px; height:35px;" alt=""><span class="notif_title" style="color: #012970; top:-7px; position:relative;">Workgroup: "<?php $groupname = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `workgroup` WHERE `id` = '".$_GET['workgroup_id']."' OR `name` = '".$_GET['workgroup_id']."';")); echo $groupname['name'];?>"</span><br>
                    <img src="<?php 
                      $curuser = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$_SESSION['UID']."';")); 
                      echo $curuser['location'];
                      ?>" class="" style="border-radius:50%; margin-top:-40px; width: 20px; height:20px;margin-left: 43px;" alt=""><p style="display:inline-block;font-size:13px; top:-20px; margin-left:7px; position:relative">
                      <?php 
                      $curuser = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `tblusers` WHERE `id` = '".$_SESSION['UID']."';")); 
                      echo $curuser['firstname'].' '.$curuser['surname'];
                      ?></p> 
                  </div>                                        
                  
                </div>
              </div>
            </div>
          </div>
          <div class="chatarea" style="background:url('../assets/img/chatbg.png'); margin-top:-40px;overflow-y:scroll; height:67vh;width:calc(100%+90px);margin-left:-30px">
              <!-- <div class="ms-5">
                  <div class="card my-3" style="display:inline-block">
                      <div class="card-body py-0 px-0 px-sm-3">
                          <div style="display:inline; margin-top:30px" class="my-2">
                                  <img class="mt-2 rounded-circle" style="width:30px;height:30px" src="../assets/img/messages-1.jpg" alt="">                            
                                  <div class="ms-5" style="margin-top:-34px;">
                                      <h5 class="" style="display:inline; font-size:15px">Godswill William</h5><br>
                                      <span class="text-muted" style="position:relative; display:inline; top:-7px; font-size:0.8rem">July 9 2022</span>
                                  </div>
                              </div>
                              <p class="wkmsg" style="margin-top: -5px;font-size: 14px;">You have just won</p>
                          </div>
                      </div>
                  </div>
              </div> -->
              <!-- <div class="">
                  <div class="ms-5 chatelement" style="background:#f6f9ff">
                      <img class="mt-2 rounded-circle" style="width:30px;height:30px" src="../assets/img/messages-1.jpg" alt="">  
                      <div class="ms-5" style="margin-top:-34px;">
                          <h5 class="" style="display:inline; font-size:15px">Godswill William</h5><br>
                          <span class="text-muted" style="position:relative; display:inline; top:-7px; font-size:0.8rem">July 9 2022</span>
                      </div>
                      <p class="wkmsg" style="margin-top: -5px;font-size: 14px;">You have just won</p>
                  </div>
              </div> -->
            </div> 
            <div class="msgarea">
              <div class="quill-editor-bubble" style="height:9vh">
                <p>Hello, <?php $groupname = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `workgroup` WHERE `id` = '".$_GET['workgroup_id']."' OR `name` = '".$_GET['workgroup_id']."';")); echo $groupname['name'];?>.</p>
              </div>
              <div class="attachments"  >
                <ul>
                  <li style="cursor:pointer"><a href="" class="text-muted pe-3 sendmsg"  ><i class="bi bi-cursor"></i> Send Message</a></li>
                  <li class="r320"><a href="" class="text-muted pe-3" style="cursor: not-allowed;" ><i class="bi bi-link-45deg"></i> File</a></li>
                  <li class="r320"><a href="" class="text-muted pe-3" style="cursor: not-allowed;" ><i class="bi bi-file-earmark-pdf"></i> New Document</a></li>
                  <li class="r320"><a href="" class="text-muted pe-3" style="cursor: not-allowed;" ><i class="bi bi-at"></i> mention</a></li>              
                  <li class="r320"><a href="" class="text-muted pe-3" style="cursor: not-allowed;" ><i class="bi bi-blockquote-left"></i> Quote</a></li>
                </ul>
              </div>
            </div>               
          </div>
        </div>
      </div>        
    </section>
  </main>
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
        
      </div>
      <div class="col-md-8 wkgrpdis">
        <div class="card-body">
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

<!-- PCs Pick -->
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
      ?>" data-bs-target="#exampleModal">
      <?php 
      $ret1=mysqli_fetch_array(mysqli_query($con,"select *from timer_tbl where pc_id = '".$row['ID']."'"));
      
      if($ret1){
        echo '<a href="queue.php?id='.$row['ID'].'" class="text-white pr-2">Occupied</a>';
      }else{
        echo 'Reserve';
      }        
      ?>
      
    </button>
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



<!-- Quickset -->

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
            <div class="card-body pane_info">
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
                          $dbfullname = $row['firstname'].' '. $row['surname'];
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
                        <input type="text" id="" value="<?php $query = mysqli_query($con, "SELECT * FROM tblusers WHERE id= '".$_SESSION['UID']."' ");
                          $row = mysqli_fetch_assoc($query);
                          echo $row['phone'];?>" class="form-control" style="height:34px; font-size:14px" disabled>
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
      $('.back').on('click', function(){
        location.reload();
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

        
        $('.add-schedule').html("Update Schedule");

        $('.add-schedule').addClass('upd-schedule');
        $('.upd-schedule').removeClass('add-schedule');



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