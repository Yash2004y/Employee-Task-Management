<?php
include("../../connect.php");
session_start();
if($conn)
{
if(isset($_POST["submit"]) && isset($_REQUEST["id"]))
{
    $id = $_REQUEST["id"];
    $name = $_POST["name"];
    $password = $_POST["pass"];
    $email = $_POST["email"];

    // echo $name . $password . $email;
    
    $cmd_check = "select * from admins where emailId = '$email'";
    $result_check = mysqli_query($conn,$cmd_check);
    $numrow_check = mysqli_num_rows($result_check);
    if($numrow_check == 1)
    {
        $row = mysqli_fetch_array($result_check);
        // echo $row["adminId"] . $id;
        if($row["adminId"] == $id)
        {
            $cmd_update = "update admins set name='$name',emailId='$email',password='$password' where adminId='$id'";
            $result_update = mysqli_query($conn,$cmd_update);
            if($result_update)
            {
                // echo "<script>alert('Profile Successfully Updated')</script>";
                $_SESSION["editadminprofile"] = "Profile Successfully Updated";
                echo "<script>window.location.href = '../editadminprofile.php'</script>";              
            }
            else
            {
                echo "Error : " . mysqli_error($conn);
                echo "<script>alert('Something else')</script>";
            
            }
        }
        else
        {
            echo "<script>alert('Email Address Already Available')</script>";
            echo "<script>window.location.href = '../editadminprofile.php'</script>";
        }

    }
    else
    {
        $cmd_update = "update admins set name='$name',emailId='$email',password='$password' where adminId='$id'";
        $result_update = mysqli_query($conn,$cmd_update);
        if($result_update)
        {
            echo "<script>alert('Profile Successfully Updated')</script>";
            echo "<script>window.location.href = '../adminprofile.php'</script>";              
        }
        else
        {
            echo "Error : " . mysqli_error($conn);
            echo "<script>alert('Something else')</script>";
        
        }        
    }
}
}
?>
