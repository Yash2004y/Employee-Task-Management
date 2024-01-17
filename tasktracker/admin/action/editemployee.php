<?php
session_start();
include("../../connect.php");
if($conn)
{
    if(isset($_POST["submit"]) && isset($_REQUEST["id"]))
    {
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

        $id = $_REQUEST["id"];

        
    $cmd_check = "select * from employees where emailId = '$email'";
    $result_check = mysqli_query($conn,$cmd_check);
    $numrow_check = mysqli_num_rows($result_check);
    if($numrow_check == 1)
    {
        $row = mysqli_fetch_array($result_check);
        // echo $row["adminId"] . $id;
        if($row["empId"] == $id)
        {
            $cmd = "update employees set name='$empname',birthDate='$dob',joiningDate='$doj',password='$pass',mobileNo='$mobno',address='$address',salary='$salary',emailId='$email',deptName='$dname' where empId='$id'";
        
            $result = mysqli_query($conn,$cmd);
    
            if($result)
            {
                // echo "<script>alert('Employee Successfully Updated')</script>";
                $_SESSION["editemp"] = "Employee Successfully Updated";
                echo "<script>window.location.href = '../editemployee.php?id=$id'</script>";
            }
            else
            {
                echo "error : " . mysqli_error($conn);
                echo "<script>alert('Something Else')</script>";
            }
    
        }
        else
        {
            echo "<script>alert('Email Address Already Available')</script>";
            echo "<script>window.location.href = '../editemployee.php?id=$id'</script>";
        }

    }
    else
    {
        $cmd = "update employees set name='$empname',birthDate='$dob',joiningDate='$doj',password='$pass',mobileNo='$mobno',address='$address',salary='$salary',emailId='$email',deptName='$dname' where empId='$id'";
        
        $result = mysqli_query($conn,$cmd);

        if($result)
        {
            echo "<script>alert('Employee Successfully Updated')</script>";
            echo "<script>window.location.href = '../editemployee.php?id=$id'</script>";
        }
        else
        {
            echo "error : " . mysqli_error($conn);
            echo "<script>alert('Something Else')</script>";
        }
        
    }
    }
}
