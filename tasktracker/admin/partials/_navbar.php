<?php
 include_once("../connect.php");
  if(!isset($_SESSION["adminid"]))
  {
    header("location:login.php");
  }
  else
  {
    $admin_id = $_SESSION["adminid"];
    $cmd_admin = "select * from admins where adminId='$admin_id'";
    $result_admin = mysqli_query($conn,$cmd_admin);
    $admin = mysqli_fetch_array($result_admin);
  }
?>
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <!-- <a class="navbar-brand brand-logo" href="index.php"><img src="assets/images/logo.svg" alt="logo" /></a> -->
    <a class="navbar-brand brand-logo" href="index.php"><img src="image/logo2.png" style="width:200px;height:40px;" alt="logo" /></a>
    <!-- <a class="navbar-brand brand-logo-mini" href="index.php"><img src="assets/images/logo-mini.svg" alt="logo" /></a> -->
    <a class="navbar-brand brand-logo-mini" href="index.php"><img src="image/logosmall1.png" alt="logo" style="width:30px;height:30px;"/></a>
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
            <p class="mb-1 text-black"><?php echo htmlentities($admin["name"]); ?></p>
          </div>
        </a>
        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="adminprofile.php">
            <i class="mdi mdi-account me-2 text-success"></i> Profile 
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">
            <i class="mdi mdi-logout me-2 text-primary"></i> Signout
          </a>
        </div>
      </li>


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