<?php
    session_start();
    include ("../../connect.php");
    if(isset($_POST["submit"]) && $conn && $_REQUEST["id"])
    {
        $id = $_REQUEST["id"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $pass = $_POST["pass"];

       
        // echo "email = $email" . "<br>";
        // echo "address = $address" . "<br>";
        // echo "password = $pass" . "<br>";
        // echo "employee id = $id" . "<br>";
        
        $cmd = "update employees set emailId='$email' , address='$address' , password='$pass' where empId='$id'";
        $result = mysqli_query($conn,$cmd);

        if($result)
        {
            // echo "<script>alert('Profile Successfully Updated')</script>";
            $_SESSION["editeprofile"] = "Profile Successfully Updated";
            echo "<script>window.location.href = '../editemployeeprofile.php?id=$id'</script>";
        }
        else
        {
            echo mysqli_error($conn);
            echo "<script>alert('Something Else')</script>";
        }
    }

?>