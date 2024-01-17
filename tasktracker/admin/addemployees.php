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
  <div class="container-scroller">
    <!-- partial:partials/_navbar.php -->
    <?php include "partials/_navbar.php"; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.php -->
      <?php include "partials/_sidebar.php"; ?>
      <?php
      if (isset($_SESSION["addemployee"])) {
        $msg = $_SESSION["addemployee"];
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
        unset($_SESSION["addemployee"]);
      }

      ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-account-plus"></i>
              </span> Add Employees
            </h3>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Enter Employee Details</h4>
                  <p class="card-description"> </p>
                  <!-- Basic form elements -->
                  <form class="forms-sample" onsubmit="return valid()" action="action/addemployees.php" method="post">

                    <div class="form-group">
                      <label for="empname">
                        <h6>Name</h6>
                      </label>
                      <input type="text" class="form-control" id="empname" name="empname" placeholder="Name" autofocus>
                    </div>

                    <div class="form-group">
                      <label for="mobno">
                        <h6>Mobile NO.</h6>
                      </label>
                      <input type="text" class="form-control" maxlength="10" id="mobno" name="mobno" placeholder="Mobile NO.">
                    </div>

                    <div class="form-group">
                      <label for="dob">
                        <h6>Date Of Birth</h6>
                      </label>
                      <?php $past = date("Y\-m\-d", strtotime("-16 year")); ?>

                      <input type="date" class="form-control" max="<?php echo $past; ?>" id="dob" name="dob">
                    </div>

                    <div class="form-group">
                      <label for="doj">
                        <h6>Date Of Joining</h6>
                      </label>
                      <input type="date" class="form-control" id="doj" min="<?php echo date("Y\-m\-d"); ?>" name="doj">
                    </div>

                    <div class="form-group">
                      <label for="email">
                        <h6>Email address</h6>
                      </label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>

                    <div class="form-group">
                      <label for="dname">
                        <h6>Department Name</h6>
                      </label>
                      <select class="form-control form-select" id="dname" name="dname">
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
                      <label for="salary">
                        <h6>Salary</h6>
                      </label>
                      <input type="text" class="form-control" id="salary" name="salary" placeholder="Salary">
                    </div>

                    <div class="form-group">
                      <label for="address">
                        <h6>Address</h6>
                      </label>
                      <textarea class="form-control" id="address" name="address" placeholder="Address" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                      <label for="pass">
                        <h6>Password</h6>
                      </label>
                      <input type="password" class="form-control" name="pass" id="pass" placeholder="Password">
                    </div>

                    <div class="form-group">
                      <label for="cpass">
                        <h6>Confirm Password</h6>
                      </label>
                      <input type="password" class="form-control" id="cpass" name="cpass" placeholder="Confirm Password">
                    </div>

                    <!-- <div class="form-group">
                      <div class="">
                        <label class="form-check-label" for="showpass">
                          <input type="checkbox" id="showpass" class="form-check-input" onclick="showpassword()" /> Show Password </label>
                      </div>
                    </div> -->

                    <div class="form-check form-check-flat form-check-danger" style="width:fit-content;">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" onclick="showpassword()"> Show Password </label>
                    </div>

                    <button type="submit" name="submit" value="submit" class="btn btn-gradient-success me-2">ADD</button>
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
      ename = document.getElementById("empname");
      mobno = document.getElementById("mobno");
      dob = document.getElementById("dob");
      doj = document.getElementById("doj");
      email = document.getElementById("email");
      dname = document.getElementById("dname");
      salary = document.getElementById("salary");
      address = document.getElementById("address");
      pass = document.getElementById("pass");
      cpass = document.getElementById("cpass");

      if (ename.value.trim() == "") {
        swal({
            text: "Please Enter Employee Name",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            ename.focus();
          });
        return false;
      } else if (!ename.value.trim().match(/^[a-zA-Z .]*$/)) {
        swal({
            text: "Employee Name Allow only Alphabets And Dot",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            ename.focus();
          });
        return false;
      } else if (mobno.value.trim() == "") {
        swal({
            text: "Please Enter Mobile NO.",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            mobno.focus();
          });
        return false;
      } else if (!mobno.value.match("[0-9]{10}")) {
        swal({
            text: "Please Enter Valid Mobile",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            mobno.focus();
          });
        return false;
      } else if (dob.value == "") {
        swal({
            text: "Please Enter Date Of Birth",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            dob.focus();
          });
        return false;
      } else if (doj.value == "") {
        swal({
            text: "Please Enter Date Of Joining",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            doj.focus();
          });
        return false;
      } else if (email.value.trim() == "") {
        swal({
            text: "Please Enter Email Address",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            email.focus();
          });
        return false;
      } else if (dname.value.trim() == "") {
        swal({
            text: "Please Select Department Name",
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
      } else if (pass.value.trim() == "") {
        swal({
            text: "Please Enter Password",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            pass.focus();
          });
        return false;
      } else if (pass.value.length < 8 || pass.value.length > 14) {
        swal({
            text: "Password Size Must Be Between 8 To 14",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            pass.focus();
          });
        return false;
      } else if (!pass.value.match(/[a-zA-z]/) || !pass.value.match(/[0-9]/) || !pass.value.match(/[!@#$%^&*]/)) {
        swal({
            text: "Password must contain at least \r\n- one character \r\n- one special character.like $,&,#,@,^,%,* \r\n- one number",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            pass.focus();
          });
        return false;
      } else if (cpass.value.trim() == "") {
        swal({
            text: "Please Enter Confirm Password",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            cpass.focus();
          });
        return false;
      } else if (pass.value != cpass.value) {
        swal({
            text: "Password And Confirm Password Must Be Same",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            cpass.focus();
          });
        return false;
      } else {
        return true;
      }
    }

    function showpassword() {
      pass = document.getElementById("pass");
      cpass = document.getElementById("cpass");
      if (pass.type == "password" || cpass.type == "password") {
        pass.type = "text";
        cpass.type = "text";
      } else {
        pass.type = "password";
        cpass.type = "password";
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