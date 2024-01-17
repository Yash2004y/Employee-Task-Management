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
                <i class="mdi mdi-briefcase"></i>
              </span> Completed Tasks
            </h3>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <!-- <h4 class="card-title"></h4> -->
                  <!-- <p class="card-description"> Add class <code>.table-bordered</code>
                    </p> -->
                  <div class="form-group">
                    <!-- <label for="exampleInputName1">Name</label> -->
                    <input type="text" class="form-control" id="search" placeholder="Search Task ID & Title" onkeypress="searchid(this)" onkeyup="searchid(this)" onkeydown="searchid(this)">
                  </div>
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th> ID </th>
                          <th> Task Title </th>
                          <th> Start Date </th>
                          <th> End Date </th>
                          <th> Task Status </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody id="tabbody">
                        <?php
                        if ($conn) {
                          // select task.taskId,task.taskTitle,task.startDate,task.endDate,task.status,atask.empId,atask.percentage from allocatetasks atask,tasks task where atask.empId = '$emp[empId]' and atask.percentage = '100' and atask.taskId = task.taskId
                          $result = mysqli_query($conn, "select task.*,atask.* from allocatetasks atask,tasks task where atask.empId = '$emp[empId]' and atask.percentage = '100' and atask.taskId = task.taskId");
                          $numrow = mysqli_num_rows($result);
                          if ($numrow > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                              <tr>
                                <td> <?php echo htmlentities($row["taskId"]); ?> </td>
                                <td> <?php echo htmlentities($row["taskTitle"]); ?> </td>
                                <td>
                                  <?php echo date("d\/m\/Y", strtotime(htmlentities($row["startDate"]))); ?>
                                </td>
                                <td> <?php echo date("d\/m\/Y", strtotime(htmlentities($row["endDate"]))); ?> </td>
                                <td> <?php echo htmlentities($row["status"]); ?> </td>
                                <td>
                                  <a href="detailcompletedtask.php?id=<?php echo htmlentities($row["taskId"]); ?>" class="btn btn-gradient-info">View</a>
                                </td>
                              </tr>
                        <?php
                            }
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
      //add tabbody id in <tbody> tag of <table>
      tbody = document.getElementById("tabbody");
      tr = tbody.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        // tr = tbody.getElementsByTagName("tr")[i];
        id = tr[i].getElementsByTagName("td")[0].innerText;
        title = tr[i].getElementsByTagName("td")[1].innerText;
        if (id.trim() == search.value.trim()) {
          tr[i].style.display = "";
        } else if (title.trim().toLowerCase().match(search.value.trim().toLowerCase())) {
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