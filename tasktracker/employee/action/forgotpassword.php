<?php
include("../../connect.php");

if($conn)
{
    if(isset($_POST["submit"]))
    {
        $email = $_POST["email"];
        $pass = $_POST["pass"];

        // echo $email . $pass;
        $cmd = "select * from employees where emailId = '$email'";
        $result = mysqli_query($conn,$cmd);
        $numrow = mysqli_num_rows($result);
        if($numrow > 0)
        {
            $cmd = "update employees set password = '$pass' where emailId = '$email'";
            $result = mysqli_query($conn,$cmd);
            if($result)
            {
                echo "<script>alert('Password Successfully Updated')</script>";
                echo "<script>window.location.href = '../login.php'</script>";
            }
            else
            {
                echo "<script>alert('Something Else')</script>";
            }
        }
        else
        {
            echo "<script>alert('Email Not Registered')</script>";
            echo "<script>window.location.href = '../login.php'</script>";
        }
        
    }
}
?>