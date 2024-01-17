<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TaskTracker</title>
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
      if (isset($_SESSION["addtask"])) {
        $msg = $_SESSION["addtask"];
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
        unset($_SESSION["addtask"]);
      }

      ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-briefcase"></i>
              </span> Add Task
            </h3>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Enter Task Detail</h4>
                  <p class="card-description"> </p>
                  
                  <form class="forms-sample" action="action/addtasks.php" onsubmit="return valid()" method="post">

                    <div class="form-group">
                      <label for="project">
                        <h6>Projects</h6>
                      </label>
                      <select class="form-control form-select" name="project" id="project" autofocus>
                        <option value="">Select Project</option>
                        <?php
                        if ($conn) {
                          $cmd = "select * from projects";
                          $result = mysqli_query($conn, $cmd);

                          while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo htmlentities($row["projectId"]); ?>" sdate="<?php echo htmlentities($row["startDate"]); ?>" edate="<?php echo htmlentities($row["endDate"]); ?>"><?php echo htmlentities($row["projectId"]); ?> - <?php echo htmlentities($row["title"]); ?> (Duration <?php echo htmlentities($row["startDate"]); ?> To <?php echo htmlentities($row["endDate"]); ?>)</option>
                        <?php

                          }
                        }
                        ?>

                        <!-- value="project id" -->
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="title">
                        <h6>Task Title</h6>
                      </label>
                      <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                    </div>

                    <div class="form-group">
                      <label for="description">
                        <h6>Task Description</h6>
                      </label>
                      <textarea class="form-control" placeholder="Description" name="description" id="description" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                      <label for="sdate">
                        <h6>Task Start Date</h6>
                      </label>
                      <input type="date" class="form-control" id="sdate" name="sdate">
                    </div>

                    <div class="form-group">
                      <label for="edate">
                        <h6>Task End Date</h6>
                      </label>
                      <input type="date" class="form-control" id="edate" name="edate">
                    </div>
                    <button type="submit" value="submit" name="submit" class="btn btn-gradient-success me-2">ADD</button>
                    <button type="reset" class="btn btn-warning">Clear</button>
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
      project = document.getElementById("project");
      title = document.getElementById("title");
      description = document.getElementById("description");
      sdate = document.getElementById("sdate");
      edate = document.getElementById("edate");
      start = new Date(sdate.value);
      end = new Date(edate.value);

      projectStartDate = new Date(project.options[project.selectedIndex].getAttribute("sdate"));
      projectEndDate = new Date(project.options[project.selectedIndex].getAttribute("edate"));

      if (project.value == "") {
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
            project.focus();
          });
        return false;
      }
      /*else if (title.value == "") {
             swal({
                 text: "Plese Enter Task Title",
                 icon: "error",
                 button: {
                   text: "OK",
                   className: "btn btn-gradient-danger",
                   value: true
                 },
               })
               .then((value) => {
                 title.focus();
               });
             return false;
           }*/
      else if (sdate.value == "") {
        swal({
            text: "Please Enter Task Start Date",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            sdate.focus();
          });
        return false;
      } else if (!(start >= projectStartDate && start <= projectEndDate)) {
        swal({
            text: "Task Start Date Must Be Between Project Duration",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            sdate.focus();
          });
        return false;
      } else if (edate.value == "") {
        swal({
            text: "Please Enter Task End Date",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            edate.focus();
          });
        return false;
      } else if (!(end <= projectEndDate && end >= projectStartDate)) {
        swal({
            text: "Task End Date Must Be Between Project Duration",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            edate.focus();
          });
        return false;
      } else if (start > end) {
        swal({
            text: "Task End Date Must Be After Task Start Date",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            edate.focus();
          });
        return false;
      } else {
        return true;
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