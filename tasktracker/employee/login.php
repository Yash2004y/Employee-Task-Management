<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TaskTracker</title>
  <!-- plugins:css -->
  <script src="assets\sweetalert\package\dist\sweetalert.min.js"></script>

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
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="image/logo2.png">
              </div>
              <h4>Employee Login</h4>
              <!-- <h6 class="font-weight-light">Sign in to continue.</h6> -->
              <form class="pt-3" action="#" method="post" onsubmit="return valid()">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""; ?>" placeholder="Enter Email Address" autofocus>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="pass" value="<?php echo isset($_POST["pass"]) ? $_POST["pass"] : ""; ?>" name="pass" placeholder="Enter Password">
                </div>

                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check form-check-danger">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" onchange="showpassword()"> Show Password </label>
                  </div>
                  <!-- <a href="#" class="auth-link text-black">Forgot password?</a> -->
                </div>

                <div class="mt-3">
                  <input type="submit" name="submit" value="submit" style="width:100%;" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"/>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <a href="forgotpassword.php" class="auth-link text-black">Forgot password?</a>
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
    <?php
      if(isset($_POST["submit"]) && $conn)
      {
        $email = $_POST["email"];
        $pass = $_POST["pass"];

        $cmd = "select * from employees where emailId = '$email'";
        $result = mysqli_query($conn,$cmd);
        $numrow = mysqli_num_rows($result);
        if($numrow == 1)
        {
          $row = mysqli_fetch_array($result);
          if($row["password"] == $pass)
          {
            $_SESSION["empid"] = $row["empId"];
            echo "<script>window.location.href = 'index.php'</script>";
          }
          else
          {
            echo "<script>
            swal({
              title: 'Password Is Wrong',
              icon: 'error',
              button: {
                text: 'OK',
                className: 'btn btn-gradient-danger',
                value: true
              },
            })
            .then((value) => {
              document.getElementById('pass').focus()
            });</script>";
          }
        }
        else
        {
          echo "<script>
          swal({
            title: 'This Email Address Not Registered',
            icon: 'error',
            button: {
              text: 'OK',
              className: 'btn btn-gradient-danger',
              value: true
            },
          })
          .then((value) => {
            document.getElementById('email').focus()
          });</script>";
        }
      }

    ?>
  </div>
  <!-- container-scroller -->
  <script>
    function valid() {
      email = document.getElementById("email");
      pass = document.getElementById("pass");
      // email.style.backgroundColor = "red";
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