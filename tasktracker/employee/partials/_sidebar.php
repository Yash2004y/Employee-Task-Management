<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="employeeprofile.php" class="nav-link">
        <div class="nav-profile-image">
          <!-- <img src="assets/images/faces/face1.jpg" alt="profile"> -->
          <img src="assets\images\faces-clipart\pic-4.png" alt="profile">
          
          
          <span class="login-status online"></span>
          <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2"><?php echo htmlentities($emp["name"]); ?></span>
          <span class="text-secondary text-small"><?php echo htmlentities($emp["deptName"]); ?></span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-task" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-title">Tasks</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-briefcase menu-icon"></i>
      </a>
      <div class="collapse" id="ui-basic-task">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="alltask.php">All Task</a></li>
          <li class="nav-item"> <a class="nav-link" href="newtask.php">New Tasks</a></li>
          <li class="nav-item"> <a class="nav-link" href="inprogresstask.php">Inprogress Tasks</a></li>
          <li class="nav-item"> <a class="nav-link" href="completedtask.php">Completed Tasks</a></li>
        
        </ul>
      </div>
    </li>
  </ul>
</nav>