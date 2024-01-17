<?php
include("../../connect.php");

if($conn)
{
    if(isset($_REQUEST["id"]))
    {
        $id = $_REQUEST["id"];
        $cmd = "delete from employees where empId='$id'";
        $result = mysqli_query($conn,$cmd);

        if($result)
        {
            // echo "<script>alert('Employee Successfully Deleted')</script>";
            echo "<script>window.location.href='../viewemployee.php'</script>";
        }
        else
        {
            echo "<script>alert('Something else')</script>";
        }
    }
}

?>