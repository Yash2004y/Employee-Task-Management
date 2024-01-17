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
  <?php include("../connect.php"); ?>
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
                <i class="mdi mdi-eye"></i>
              </span> View Employees
            </h3>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <!-- <h4 class="card-title">Bordered table</h4> -->
                  <div class="form-group">
                    <!-- <label for="exampleInputName1">Name</label> -->
                    <input type="text" class="form-control" id="search" placeholder="Search Employee ID & Name" onkeypress="searchid(this)" onkeyup="searchid(this)" onkeydown="searchid(this)">
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th> ID </th>
                          <th> NAME </th>
                          <th> Mobile NO. </th>
                          <th> Email ID </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody id="tabbody">
                        <?php
                        if ($conn) {
                          $cmd = "select * from employees";
                          $result = mysqli_query($conn, $cmd);

                          while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                              <td> <?php echo htmlentities($row["empId"]); ?> </td>
                              <td> <?php echo htmlentities($row["name"]); ?> </td>
                              <td> <?php echo htmlentities($row["mobileNo"]); ?> </td>
                              <td> <?php echo htmlentities($row["emailId"]); ?> </td>
                              <td>
                                <a href="detailemployee.php?id=<?php echo htmlentities($row["empId"]); ?>" class="btn btn-gradient-info">View</a>
                              </td>
                            </tr>
                        <?php
                          }
                        }

                        ?>
                      </tbody>
                    </table>
                  </div>
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
  <script>
    function searchid(search) {
      tbody = document.getElementById("tabbody");
      tr = tbody.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        // tr = tbody.getElementsByTagName("tr")[i];
        id = tr[i].getElementsByTagName("td")[0].innerText;
        name1 = tr[i].getElementsByTagName("td")[1].innerText;
        if (id.trim() == search.value.trim()) {
          tr[i].style.display = "";
        } else if (name1.trim().toLowerCase().match(search.value.trim().toLowerCase())) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  </script>
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