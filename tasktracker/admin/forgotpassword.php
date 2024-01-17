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
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="image/logo2.png">
              </div>
              <h4>Change Admin Password</h4>
              <!-- <h6 class="font-weight-light">Sign in to continue.</h6> -->
              <form class="pt-3" action="action/forgotpassword.php" method="post" onsubmit="return valid()">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Enter Email Address" autofocus>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="pass" name="pass" placeholder="Enter Password">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="cpass" name="cpass" placeholder="Enter Confirm Password">
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check form-check-danger">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" onchange="showpassword()"> Show Password </label>
                  </div>
                  <!-- <a href="#" class="auth-link text-black">Forgot password?</a> -->
                </div>
                <div class="mt-3">
                  <input type="submit" name="submit" style="width:100%" value="Change Password" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" />
                </div>
                <!-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="mdi mdi-facebook me-2"></i>Connect using facebook </button>
                </div> -->

              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <script>
    function valid() {
      email = document.getElementById("email");
      pass = document.getElementById("pass");
      cpass = document.getElementById("cpass");
      
      if (email.value.trim() == "") {
        swal({
            title: "Please Enter Email Address",
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
            title: "Please Enter Password",
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
            text: "Password Character Size Must Be Between 8 and 14",
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
      }else if (cpass.value.trim() == "") {
        swal({
            title: "Please Enter Confirm Password",
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
      }  else {
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