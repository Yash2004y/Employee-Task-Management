<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TaskTracker</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="icon" href="image/logosmall2.png" />

</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.php -->
    <?php include "partials/_navbar.php"; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.php -->
      <?php include "partials/_sidebar.php"; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-account"></i>
              </span> Employee Profile
            </h3>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                      <!-- <thead>
                        
                      </thead> -->
                      <tbody id="tabbody">
                        <tr>
                          <th>Employee Name</th>
                          <td><?php echo htmlentities($emp["name"]); ?></td>
                        </tr>

                        <tr>
                          <th>Email Address</th>
                          <td><?php echo htmlentities($emp["emailId"]); ?></td>
                        </tr>

                        <!-- <tr>
                          <th>Password</th>
                          <td><?php echo htmlentities($emp["password"]); ?></td>
                        </tr> -->

                        <tr>
                          <th>Department Name</th>
                          <td><?php echo htmlentities($emp["deptName"]); ?></td>
                        </tr>

                        <tr>
                          <th>Mobile NO.</th>
                          <td><?php echo htmlentities($emp["mobileNo"]); ?></td>
                        </tr>

                        <tr>
                          <th>Salary.</th>
                          <td><?php echo htmlentities($emp["salary"]); ?></td>
                        </tr>

                        <tr>
                          <th>Date Of Birth</th>
                          <td><?php echo htmlentities($emp["birthDate"]); ?></td>
                        </tr>

                        <tr>
                          <th>Date Of Joining</th>
                          <td><?php echo htmlentities($emp["joiningDate"]); ?></td>
                        </tr>

                        <tr>
                          <th>Address</th>
                          <td><?php echo htmlentities($emp["address"]); ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <a href="logout.php" style="float:left;" class="mt-4 mb-0 btn btn-gradient-danger">Logout</a>
                  <a href="editemployeeprofile.php?id=<?php echo $emp["empId"]; ?>" style="float:right;" class="mt-4 mb-0 btn btn-gradient-warning">Edit</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.php -->
        <?php include "partials/_footer.php"; ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <!-- End custom js for this page -->
</body>

</html>