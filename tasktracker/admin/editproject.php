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
      if (isset($_SESSION["editproject"])) {
        $msg = $_SESSION["editproject"];
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
        unset($_SESSION["editproject"]);
      }

      ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-book"></i>
              </span> Edit Project
            </h3>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Enter Project Detail</h4>
                  <p class="card-description"> </p>
                  <!-- Basic form elements -->
                  <form class="forms-sample" onsubmit="return valid()" action="action/editproject.php?id=<?php echo $_REQUEST["id"]; ?>" method="post">
                    <?php
                    if ($conn && isset($_REQUEST["id"])) {
                      $id = $_REQUEST["id"];
                      $cmd = "select * from projects where projectId='$id'";
                      $result = mysqli_query($conn, $cmd);
                      $row = mysqli_fetch_array($result);
                    }
                    ?>
                    <div class="form-group">
                      <label for="title">
                        <h6>Project Title</h6>
                      </label>
                      <input type="text" class="form-control" name="title" id="title" value="<?php echo htmlentities($row["title"]); ?>" placeholder="Project Title" autofocus>
                    </div>

                    <div class="form-group">
                      <label for="description">
                        <h6>Project Description</h6>
                      </label>
                      <textarea class="form-control" id="description" name="description" rows="4" Placeholder="Project Description"><?php echo htmlentities($row["discription"]); ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="sdate">
                        <h6>Project Start Date</h6>
                      </label>
                      <input type="date" class="form-control" id="sdate" value="<?php echo htmlentities($row["startDate"]); ?>" name="sdate">
                    </div>

                    <div class="form-group">
                      <label for="edate">
                        <h6>Project End Date</h6>
                      </label>
                      <input type="date" class="form-control" id="edate" value="<?php echo htmlentities($row["endDate"]); ?>" name="edate">
                    </div>

                    <!-- <div class="form-group">
                        <label for="projectstatus"><h6>Project Status</h6></label>
                        <select class="form-control form-select" id="projectstatus" name="projectstatus">
                          <option value="Pendding">Pending</option>
                          <option value="Completed">Completed</option>
                          <script>
                            document.getElementById("projectstatus").value = "<?php echo htmlentities($row["status"]); ?>";
                          </script>
                        </select>
                      </div> -->

                    <div class="form-group">
                      <label for="plateform">
                        <h6>Project Platform</h6>
                      </label>
                      <input type="text" class="form-control" id="plateform" name="plateform" value="<?php echo htmlentities($row["plateform"]); ?>" placeholder="Project Plateform">
                    </div>
                    <button type="submit" value="submit" name="submit" class="btn btn-gradient-success me-2">Update</button>
                    <!-- <button type="reset" class="btn btn-warning">Clear</button> -->
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
      title = document.getElementById("title");
      discription = document.getElementById("discription");
      sdate = document.getElementById("sdate");
      edate = document.getElementById("edate");
      projectstatus = document.getElementById("projectstatus");
      plateform = document.getElementById("plateform");
      start = new Date(sdate.value);
      end = new Date(edate.value);
      if (title.value.trim() == "") {
        swal({
            text: "Please Enter Project Title",
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
      } else if (sdate.value.trim() == "") {
        swal({
            text: "Please Enter Project Start Date",
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
      } else if (edate.value.trim() == "") {
        swal({
            text: "Please Enter Project End Date",
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
            text: "Project End Date Must Be After Project Start Date",
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
      } else if (plateform.value.trim() == "") {
        swal({
            text: "Please Enter Project Plateform",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            plateform.focus();
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