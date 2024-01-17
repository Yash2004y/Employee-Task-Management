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
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-briefcase"></i>
              </span> Task Detail
            </h3>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Task Details</h4>
                  <!-- <p class="card-description"> Add class <code>.table-bordered</code>
                    </p> -->
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                     
                      <tbody>
                        <?php
                        if ($conn) {
                          $id = $_REQUEST["id"];
                          $cmd = "select t.*,p.title from tasks t,projects p where t.projectId = p.projectId and t.taskId='$id'";
                          $result = mysqli_query($conn, $cmd);
                          if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_array($result);

                        ?>
                            <tr>
                              <th>Task ID</th>
                              <td> <?php echo htmlentities($row["taskId"]); ?> </td>
                            </tr>

                            <tr>
                              <th>Project Title</th>
                              <td>
                                <?php echo $row["title"]; ?>
                              </td>
                            </tr>

                            <tr>
                              <th>Task Title</th>
                              <td> <?php echo htmlentities($row["taskTitle"]); ?> </td>
                            </tr>

                            <tr>
                              <th>Task Discription</th>
                              <td> <?php echo htmlentities($row["discription"]); ?> </td>
                            </tr>

                            <tr>
                              <th>Start Date</th>
                              <td> <?php echo htmlentities($row["startDate"]); ?> </td>
                            </tr>

                            <tr>
                              <th>End Date</th>
                              <td> <?php echo htmlentities($row["endDate"]); ?> </td>
                            </tr>

                            <tr>
                              <th>Task Status</th>
                              <td> <?php echo htmlentities($row["status"]); ?> </td>
                            </tr>

                            <tr>
                              <th>Progress</th>
                              <td>
                                <?php
                                // echo $row["taskId"];
                                $percentage = 0;
                                $sum = 0;
                                $cmd_allocatetask = "select * from allocatetasks where taskId = '$row[taskId]'";
                                $result_allocatetask = mysqli_query($conn, $cmd_allocatetask);
                                $total_allocatetask = mysqli_num_rows($result_allocatetask);
                                if ($total_allocatetask == 1) {
                                  $row_allocatetask = mysqli_fetch_array($result_allocatetask);
                                  $percentage = $row_allocatetask["percentage"];
                                } else if ($total_allocatetask > 1) {
                                  while ($row_allocatetask = mysqli_fetch_array($result_allocatetask)) {
                                    $sum += $row_allocatetask["percentage"];
                                  }
                                  $percentage = $sum / $total_allocatetask;
                                }

                                ?>

                                <div class="progress" style="height:15px;">
                                  <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $percentage; ?>%;height:15px;" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $percentage; ?>%</div>
                                </div>
                              </td>
                            </tr>

                            <tr>
                              <th>Action</th>
                              <td>
                                <!-- return confirm('⚠️ Are You Sure You Want To Delete This Task');" -->
                                <a onclick="check('Are You Sure Remove This Task ?')" class="btn btn-gradient-danger">DELETE</a>
                                <a href="edittask.php?id=<?php echo $row["taskId"]; ?>" class="btn btn-gradient-warning text-dark">EDIT</a>
                              </td>
                            </tr>
                            <script>
                              function check(msg) {
                                // alert(msg);
                                swal({
                                    title: msg,
                                    icon: "warning",
                                    
                                    buttons:true,
                                  })
                                  .then((value) => {
                                    if(value)
                                      window.location.href="action/deletetask.php?id=<?php echo $row["taskId"]; ?>";
                                  });
                                 
                              }
                            </script>
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
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Task Allocation Detail</h4>
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th> ID </th>
                          <th> Employee Name </th>
                          <th> Allocation Date </th>
                          <th> Remark </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $cmd_allocatetask = "select * from allocatetasks where taskId = '$row[taskId]'";
                        $result_allocatetask = mysqli_query($conn, $cmd_allocatetask);
                        $total_allocatetask = mysqli_num_rows($result_allocatetask);
                        if ($total_allocatetask > 0) {
                          while ($row_allocatetask = mysqli_fetch_array($result_allocatetask)) {
                        ?>
                            <tr>
                              <td> <?php echo htmlentities($row_allocatetask["allocateId"]); ?> </td>
                              <td>
                                <?php
                                $cmd_emp = "select * from employees where empId='$row_allocatetask[empId]'";
                                $result_emp = mysqli_query($conn, $cmd_emp);
                                if ($result_emp) {
                                  $row_emp = mysqli_fetch_array($result_emp);

                                  echo $row_emp["name"];
                                }
                                ?>

                              </td>
                              <td><?php echo htmlentities($row_allocatetask["allocateDate"]); ?></td>
                              <td> <?php echo htmlentities($row_allocatetask["remark"]); ?> </td>

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