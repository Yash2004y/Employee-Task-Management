<nav class="sidebar sidebar-offcanvas" id="sidebar">
<ul class="nav">
    <li class="nav-item nav-profile">
      <a href="adminprofile.php" class="nav-link">
        <div class="nav-profile-image">
          <!-- <img src="assets/images/faces/face1.jpg" alt="profile"> -->
          <img src="assets\images\faces-clipart\pic-4.png" alt="profile">
          <!-- <div class="img-text btn btn-gradient-warning">Y</div> -->
          
          <!-- <span class="login-status online"></span> -->
          <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2"><?php echo htmlentities($admin["name"]); ?></span>
          <span class="text-secondary text-small"><?php echo htmlentities($admin["emailId"]); ?></span>
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
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-emp" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-title">Employees</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-account-multiple menu-icon"></i>
      </a>
      <div class="collapse" id="ui-basic-emp">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="addemployees.php">Add Employees</a></li>
          <li class="nav-item"> <a class="nav-link" href="viewemployee.php">View Employees</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-project" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-title">Projects</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-book-multiple menu-icon"></i>
      </a>
      <div class="collapse" id="ui-basic-project">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="addprojects.php">Add Projects</a></li>
          <li class="nav-item"> <a class="nav-link" href="viewproject.php">View Projects</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-task" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-title">Tasks</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-briefcase menu-icon"></i>
      </a>
      <div class="collapse" id="ui-basic-task">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="addtasks.php">Add Tasks</a></li>
          <li class="nav-item"> <a class="nav-link" href="viewtask.php">View Tasks</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="allocatetask.php">
        <span class="menu-title">Allocate Tasks</span>
        <i class="mdi mdi-briefcase-upload menu-icon"></i>
      </a>
    </li>
    <li class="nav-item sidebar-actions">
      <span class="nav-link">
        <div class="border-bottom">
          <h6 class="font-weight-normal mb-3">Projects</h6>
        </div>
        <a href="addprojects.php" class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Add Project</a>
        
      </span>
    </li>
  </ul>
</nav>