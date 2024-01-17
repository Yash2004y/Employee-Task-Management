<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TaskTracker</title>
  <script src="assets/jquery/jquery.min.js"></script>
  <script src="assets\sweetalert\package\dist\sweetalert.min.js"></script>
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
      <?php
      if (isset($_SESSION["allocatetask"])) {
        $msg = $_SESSION["allocatetask"];
        echo "<script>
                          swal({
                            title : '$msg',
                            icon : 'success',
                            button:{
                              text: 'OK',
                              className : 'btn btn-gradient-info',
                            },
                          })
              </script>";
        unset($_SESSION["allocatetask"]);
      }

      ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-briefcase-upload"></i>
              </span> Allocate Task
            </h3>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Enter Allocation Details</h4>
                  <p class="card-description"> </p>
                  
                  <form class="forms-sample" action="action/allocatetask.php" onsubmit="return valid()" method="post">
                    <div class="form-group">
                      <label for="projectid">
                        <h6>Projects</h6>
                      </label>
                      <select class="form-control form-select" name="projectid" id="projectid" onchange="gettask(this)" autofocus>
                        <option value="">Select Project</option>
                        <?php
                        if ($conn) {
                          $cmd = "select * from projects where projectId in (select projectId from tasks where taskId not in (select taskId from allocatetasks))";
                          $result = mysqli_query($conn, $cmd);

                          while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo htmlentities($row["projectId"]); ?>"><?php echo htmlentities($row["projectId"]); ?> - <?php echo htmlentities($row["title"]); ?> (Duration <?php echo htmlentities($row["startDate"]); ?> To <?php echo htmlentities($row["endDate"]); ?>)</option>
                        <?php

                          }
                        }
                        ?>
                        <!-- value="project id" -->
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="taskid">
                        <h6>Tasks</h6>
                      </label>
                      <select class="form-control form-select" name="taskid" id="taskid">
                        <option value="">Select Task</option>
                        <!-- value="task id" -->
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="dname">
                        <h6>Department Name</h6>
                      </label>
                      <select class="form-control form-select" id="dname" onchange="getemp(this)" name="dname">
                        <option value="" selected>Select Department</option>
                        <option value="Programming">Programming</option>
                        <option value="Designing">Designing</option>
                        <option value="Testing">Testing</option>
                        <option value="System Analyst">System Analyst</option>
                        <option value="Maintenance">Maintenance</option>
                      </select>
                      <!-- <input type="text" class="form-control" id="dname" name="dname" placeholder="Department Name"> -->
                    </div>

                    <div class="form-group">
                      <label for="empid">
                        <h6>Employees</h6>
                      </label>
                      <select class="form-control form-select" name="empid" id="empid">
                        <option value="">Select Employee</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="allocatedate">
                        <h6>Allocation Date</h6>
                      </label>
                      <input type="date" class="form-control" id="allocatedate" name="allocatedate" placeholder="Allocation Date">
                    </div>

                    <button type="submit" name="submit" value="submit" class="btn btn-gradient-success me-2">Allocate</button>
                    <button class="btn btn-warning">Cancel</button>
                  </form>
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
    function valid() {
      projectid = document.getElementById("projectid");
      taskid = document.getElementById("taskid");
      dname = document.getElementById("dname");
      empid = document.getElementById("empid");
      allocatedate = document.getElementById("allocatedate");

      taskStartDate = new Date(taskid.options[taskid.selectedIndex].getAttribute("sdate"));
      taskEndDate = new Date(taskid.options[taskid.selectedIndex].getAttribute("edate"));

      today = new Date();
      date = new Date(allocatedate.value);


      if (projectid.value.trim() == "") {
        swal({
            text: "Please Select Project",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            projectid.focus();
          });
        return false;
      } else if (taskid.value.trim() == "") {
        swal({
            text: "Please Select Task",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            taskid.focus();
          });
        return false;
      } else if (dname.value.trim() == "") {
        swal({
            text: "Please Select Department Of Employee",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            dname.focus();
          });
        return false;
      } else if (empid.value.trim() == "") {
        swal({
            text: "Please Select Employee",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            empid.focus();
          });
        return false;
      } else if (allocatedate.value.trim() == "") {
        swal({
            text: "Please Enter Allocation Date",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            allocatedate.focus();
          });
        return false;
      } else if (!(date >= taskStartDate && date <= taskEndDate)) {
        swal({
            text: "Allocation Date Must Be Between Task Duration",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            allocatedate.focus();
          });
        return false;
      } else if (!(date >= today)) {
        swal({
            text: "Allocation Date Must Be After The Today",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            allocatedate.focus();
          });
        return false;
      } else {
        return true;
      }
    }

    function gettask(project) {
      projectid = project.value;
      $.ajax({
        url: "action/gettask.php?id=" + projectid,
        method: "post",
        async: true,
        success: function(response) {
          $("#taskid").html(response);
        }
      });
    }

    function getemp(dept) {

      dept = dept.value;
      $.ajax({
        url: "action/getemp.php?dname=" + dept,
        method: "post",
        async: true,
        success: function(response) {
          $("#empid").html(response);
        }
      });
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