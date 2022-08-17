<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="index.php">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->


  <li class="nav-item">
    <a class="nav-link collapsed reports" data-bs-target="#computer-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-laptop"></i><span>Computers</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="computer-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="" class="addComputer">
          <i class="bi bi-circle"></i><span>Add Computer</span>
        </a>
      </li>      
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="events.php">
      <i class="bi bi-menu-button-wide"></i><span>Schedule</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="" class="newschedule">
          <i class="bi bi-circle"></i><span>New Schedule</span>
        </a>
      </li>
      <li>
        <a href="" class="quickset" style="cursor:not-allowed">
          <i class="bi bi-circle"></i><span>Quick Schedule</span>
        </a>
      </li>
      <li>
        <a href="" class="bulkschedule">
          <i class="bi bi-circle"></i><span>Bulk Schedule</span>
        </a>
      </li>
    </ul>
  </li><!-- End Forms Nav -->

  <!-- <li class="nav-item">
    <a class="nav-link collapsed calendarsb" href="" onclick="document.getElementById('calendarnav').click()">
      <i class="bi bi-journal-text"></i>
      <span>Calendar</span>
    </a>
  </li> -->

  <li class="nav-item">
    <a class="nav-link collapsed reports" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="reports.php">
      <i class="bi bi-layout-text-window-reverse"></i><span>Workgroups</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="" class="addWorkgroup">
          <i class="bi bi-circle"></i><span>Add Workgroup</span>
        </a>
      </li>
      <li>
        <a href="#" class="view_workgroup">
          <i class="bi bi-circle"></i><span>View All Workgroup</span> 
        </a>
      </li>
    </ul>
  </li><!-- End Tables Nav -->     

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-gem"></i><span>Admin</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="#" class="addAdmin">
          <i class="bi bi-circle"></i><span>Make Admin</span>
        </a>
      </li> 
    </ul>
  </li><!-- End Icons Nav -->

  <li class="nav-heading">Useful/External Links</li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="https://uniuyo.edu.ng/eportals/">
      <i class="bi bi-person"></i>
      <span>E-portal</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="https://uniuyo.edu.ng/results/">
      <i class="bi bi-question-circle"></i>
      <span>Result Checker</span>
    </a>
  </li><!-- End F.A.Q Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="https://uniuyo.edu.ng/notice/">
      <i class="bi bi-envelope"></i>
      <span>News</span>
    </a>
  </li><!-- End Contact Page Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="logout.php">
      <i class="bi bi-box-arrow-in-right"></i>
      <span>Logout</span>
    </a>
  </li>
  <!-- End Login Page Nav -->
  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="register.php">
      <i class="bi bi-card-list"></i>
      <span>Register</span>
    </a>
  </li> -->
  <!-- End Register Page Nav -->


</ul>

</aside><!-- End Sidebar-->