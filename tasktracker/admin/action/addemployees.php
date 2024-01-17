<?php
session_start();
include("../../connect.php");
if ($conn) {
    if (isset($_POST["submit"])) {
        $empname = $_POST["empname"];
        $mobno = $_POST["mobno"];
        $dob = $_POST["dob"];
        $doj = $_POST["doj"];
        $email = $_POST["email"];
        $dname = $_POST["dname"];
        $salary = $_POST["salary"];
        $address = $_POST["address"];
        $pass = $_POST["pass"];

        // echo "empname = $empname" . "<br>";
        // echo "mobile No. = $mobno" . "<br>";
        // echo "Date Of Birth = $dob" . "<br>";
        // echo "doj = $doj" . "<br>";
        // echo "email = $email" . "<br>";
        // echo "dname = $dname" . "<br>";
        // echo "salary = $salary" . "<br>";
        // echo "address = $address" . "<br>";
        // echo "password = $pass" . "<br>";

        $cmd_check = "select * from employees where emailId='$email'";
        $result_check = mysqli_query($conn, $cmd_check);

        $numrow = mysqli_num_rows($result_check);
        if ($numrow > 0) {
            echo "<script>alert('$email Email Id All Ready Available')</script>";
            echo "<script>window.location.href = '../addemployees.php'</script>";
        
        }
        else
        {
            
            $cmd = "insert into employees(name,birthDate,joiningDate,password,mobileNo,address,salary,emailId,deptName) values('$empname','$dob','$doj','$pass','$mobno','$address','$salary','$email','$dname')";
            $result = mysqli_query($conn, $cmd);

            if ($result) {
                // echo "<script>alert('Employee Successfully Added')</script>";
                $_SESSION["addemployee"] = "Employee Successfully Added";
                echo "<script>window.location.href = '../addemployees.php'</script>";
            } else {
                $error = "Error = " . mysqli_error($conn);
                echo $error;
                echo "<script>alert('Something else')</script>";
            }
        }
    }
}
?>