<?php include_once("../connect.php");
if (!isset($_SESSION["empid"])) {
  header("location:login.php");
} else {
  $emp_id = $_SESSION["empid"];
  $cmd_emp = "select * from employees where empId='$emp_id'";
  $result_emp = mysqli_query($conn, $cmd_emp);
  $emp = mysqli_fetch_array($result_emp);
}

?>

<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <!-- <a class="navbar-brand brand-logo" href="index.php"><img src="assets/images/logo.svg" alt="logo" /></a> -->
    <a class="navbar-brand brand-logo" href="index.php"><img src="image/logo2.png" style="width:200px;height:40px;" alt="logo" /></a>
    <!-- <a class="navbar-brand brand-logo-mini" href="index.php"><img src="assets/images/logo-mini.svg" alt="logo" /></a> -->
    <a class="navbar-brand brand-logo-mini" href="index.php"><img src="image/logosmall1.png" alt="logo" style="width:30px;height:30px;" /></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="nav-profile-img">
            <!-- <img src="assets/images/faces/face1.jpg" alt="image"> -->
            <img src="assets/images/faces-clipart/pic-4.png" alt="image">

            <span class="availability-status online"></span>
          </div>
          <div class="nav-profile-text">
            <p class="mb-1 text-black"><?php echo htmlentities($emp["name"]); ?></p>
          </div>
        </a>
        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="employeeprofile.php">
            <i class="mdi mdi-account me-2 text-success"></i> Profile
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">
            <i class="mdi mdi-logout me-2 text-primary"></i> Signout
          </a>
        </div>
      </li>

      <!-- Message Box Start -->
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="mdi mdi-book"></i>
          <span class="count-symbol bg-warning"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
          <h6 class="p-3 mb-0">New Tasks</h6>
          <div class="dropdown-divider"></div>
          <?php
          if ($conn) {
            //$result = mysqli_query($conn, "select task.taskId,task.taskTitle,task.startDate,task.endDate,task.status,atask.empId,atask.percentage from allocatetasks atask,tasks task where atask.empId = '$emp[empId]' and atask.percentage = '0' and atask.taskId = task.taskId order by atask.allocateId desc limit 3");
            $result = mysqli_query($conn, "select task.*,atask.* from allocatetasks atask,tasks task where atask.empId = '$emp[empId]' and atask.percentage = '0' and atask.taskId = task.taskId order by atask.allocateId desc limit 3");
            $numrow = mysqli_num_rows($result);
            if ($numrow > 0) {
              while ($rowntask = mysqli_fetch_array($result)) {
          ?>
                <a class="dropdown-item preview-item" href="detailnewtask.php?id=<?php echo $rowntask["taskId"]; ?>">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-book mdi-24px profile-pic"></i>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal"><?php echo htmlentities($rowntask["taskTitle"]); ?></h6>
                    <p class="text-gray mb-0"> See More </p>
                  </div>
                </a>

                <div class="dropdown-divider"></div>

          <?php
              }
            }
          }
          ?>


          <div class="dropdown-divider"></div>
          <h6 class="p-3 mb-0 text-center"><?php echo $numrow; ?> New Task</h6>
        </div>
      </li>
      <!-- Message Box End -->
      <li class="nav-item d-none d-lg-block full-screen-link">
        <a class="nav-link">
          <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
        </a>
      </li>
      <li class="nav-item nav-logout d-none d-lg-block">
        <a class="nav-link" href="logout.php">
          <i class="mdi mdi-power"></i>
        </a>
      </li>
      <li class="nav-item nav-settings d-none d-lg-block">
        <a class="nav-link" href="#">
          <i class="mdi mdi-format-line-spacing"></i>
        </a>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>