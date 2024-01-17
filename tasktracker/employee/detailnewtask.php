<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TaskTracker</title>

  <!-- JQuery -->
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

  <div class="container-scroller">

    <!-- partial:partials/_navbar.php -->
    <?php include "partials/_navbar.php"; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.php -->
      <?php include "partials/_sidebar.php"; ?>
      <?php
      if (isset($_SESSION["taskprogress"])) {
        $msg = $_SESSION["taskprogress"];
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
        unset($_SESSION["taskprogress"]);
      }

      ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-briefcase"></i>
              </span> New Task Detail
            </h3>
          </div>
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Task Details</h4>
                <!-- <p class="card-description"> Add class <code>.table-bordered</code>
                    </p> -->
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <!-- <thead>
                        <tr>
                          <th> # </th>
                          <th> First name </th>
                          <th> Progress </th>
                          <th> Amount </th>
                          <th> Deadline </th>
                        </tr>
                      </thead> -->
                    <tbody>
                      <?php
                      if ($conn && isset($_REQUEST["id"])) {
                        $cmd =  "select atask.*,task.* from allocatetasks atask,tasks task where atask.empId = '$emp[empId]' and atask.percentage = '0' and atask.taskId = task.taskId and task.taskId = '$_REQUEST[id]'";
                        $result = mysqli_query($conn,$cmd);
                        $numrow = mysqli_num_rows($result);
                        if ($numrow > 0) {
                          while ($row = mysqli_fetch_array($result)) {
                      ?>
                            <tr>
                              <th>Task ID</th>
                              <td> <?php echo htmlentities($row["taskId"]); ?> </td>
                            </tr>

                            <tr>
                              <th>Project Title</th>
                              <td> 
                                  <?php
                                      $cmd_project = "select * from projects where projectId = '$row[projectId]'";
                                      $result_project = mysqli_query($conn,$cmd_project);
                                      if($result_project)
                                      {
                                        $project = mysqli_fetch_array($result_project);
                                        echo $project["title"];
                                      }

                                  ?>
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
                              <td>
                                <?php echo date("d\/m\/Y", strtotime(htmlentities($row["startDate"]))); ?>
                              </td>
                            </tr>

                            <tr>
                              <th>End Date</th>
                              <td> <?php echo date("d\/m\/Y", strtotime(htmlentities($row["endDate"]))); ?> </td>
                            </tr>

                            <tr>
                              <th>Task Status</th>
                              <td> <?php echo htmlentities($row["status"]); ?> </td>
                            </tr>

                            <tr>
                              <th>Remark</th>
                              <td><?php echo htmlentities($row["remark"]); ?></td>
                            </tr>

                            <tr>
                              <th>Progress</th>
                              <td>
                                <div class="progress" style="height:15px;">
                                  <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo htmlentities($row["percentage"]); ?>%;height:15px;" aria-valuenow="<?php echo htmlentities($row["percentage"]); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo htmlentities($row["percentage"]); ?>%</div>
                                </div>
                              </td>
                            </tr>

                            <tr>
                              <th>Action</th>
                              <td>
                                <button id='chgstatus' class='btn btn-gradient-warning text-dark'>Change Status</button>
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

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.php -->
        <?php include "partials/_footer.php"; ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    <div class="row chgform">
      <div class="col-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <h4 class="card-title col-10">Change Task Status</h4>
              <button id="formclose" class="btn btn-gradient-danger col-1" style="display:block;width:100px;margin-left:35px;"><i class="mdi mdi-close"></i></button>
            </div>
            <!-- <p class="card-description"> Basic form elements </p> -->
            
            <form class="forms-sample" onsubmit="return valid()" action="action/detailnewtask.php?id=<?php echo $_REQUEST["id"]; ?>" method="post">

              <div class="form-group">
                <label for="msg">Remark</label>
                <textarea class="form-control" id="msg" name="msg" placeholder="Remark" rows="4"></textarea>
              </div>

              <div class="form-group">
                <label for="per">Task Progress Percentage</label>
                <input type="text" class="form-control" id="per" placeholder="Progress Percentage" onkeyup="chgstatus(this)" onkeydown="chgstatus(this)" name="per">
              </div>

              <div class="form-group">
                <label for="status">Task Status</label>
                <select class="form-control form-select" id="status" name="status">
                  <option selected value="Pending">Pending</option>
                  <option value="Completed">Completed</option>
                </select>
              </div>
              <button type="submit" name="submit" value="submit" class="btn btn-gradient-success me-2">Update Status</button>
              <!-- <input type="reset" class="btn btn-light"></input> -->
              <button type="reset" class="btn btn-warning">Clear</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- container-scroller -->

  <script>
    $(document).ready(function() {

      //open form for change status
      $("button#chgstatus").on("click", function() {
        $("div.chgform").fadeIn("50");
      })

      //close form for change status
      $("button#formclose").on("click", function() {
        $("div.chgform").fadeOut("50");
      })
    })

    function valid() {
      per = document.getElementById("per");
      status1 = document.getElementById("status");

      if (per.value.trim() == "") {
        swal({
            text: "Please Enter Completion Percentage",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            per.focus();
          });
        return false;
      } else if (!per.value.match("[0-9]")) {
        swal({
            text: "Please Enter Valid Percentage",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            per.focus();
          });
        return false;
      } else if (parseInt(per.value) > 100 || parseInt(per.value) < 1) {
        swal({
            text: "Percentage Must Be Between 1 To 100",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            per.focus();
          });
        return false;
      } else if ((parseInt(per.value) < 100 && status1.value == "Completed") || (parseInt(per.value) == 100 && status1.value != "Completed")) {
        swal({
            text: "Please Select Valid Task Status",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            status1.focus();
          });
        return false;
      } else {
        return true;
      }
    }
    function chgstatus(per)
    {
      
        if(parseInt(per.value) == 100)
        {
          $("#status").val("Completed");
        }
        else
        {
          $("#status").val("Pending");
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