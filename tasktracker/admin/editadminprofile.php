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
      if (isset($_SESSION["editadminprofile"])) {
        $msg = $_SESSION["editadminprofile"];
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
        unset($_SESSION["editadminprofile"]);
      }

      ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi mdi-account-convert"></i>
              </span> Edit Admin Profile
            </h3>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Enter Admin Details</h4>
                  <p class="card-description"> </p>
                  <!-- Basic form elements -->
                  
                  <form class="forms-sample" action="action/editadminprofile.php?id=<?php echo $admin["adminId"]; ?>" onsubmit="return valid()" method="post">

                    <div class="form-group">
                      <label for="name">
                        <h6>Name</h6>
                      </label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Name" autofocus value="<?php echo htmlentities($admin["name"]); ?>">
                    </div>


                    <div class="form-group">
                      <label for="email">
                        <h6>Email address</h6>
                      </label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo htmlentities($admin["emailId"]); ?>">
                    </div>

                    <div class="form-group">
                      <label for="pass">
                        <h6>Password</h6>
                      </label>
                      <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" value="<?php echo htmlentities($admin["password"]); ?>">
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

                    <button type="submit" name="submit" value="submit" class="btn btn-gradient-success me-2">Save Changes</button>
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
      aname = document.getElementById("name");
      email = document.getElementById("email");
      pass = document.getElementById("pass");

      if (aname.value.trim() == "") {
        swal({
            text: "Please Enter Admin Name",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            aname.focus();
          });
        return false;
      } else if (!aname.value.trim().match(/^[a-zA-Z .]*$/)) {
        swal({
            text: "Admin Name Allow only Alphabets And Dot",
            icon: "error",
            button: {
              text: "OK",
              className: "btn btn-gradient-danger",
              value: true
            },
          })
          .then((value) => {
            aname.focus();
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
            text: "Password Size Must Be 8 To 14 Characters",
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
      } else {
        return true;
      }

    }

    function showpassword() {
      pass = document.getElementById("pass");
      if (pass.type == "password") {
        pass.type = "text";
      } else {
        pass.type = "password";
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