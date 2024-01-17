<?php
include("../../connect.php");

if($conn)
{
    if(isset($_REQUEST["id"]))
    {
        $id = $_REQUEST["id"];
        $cmd = "delete from projects where projectId='$id'";
        $result = mysqli_query($conn,$cmd);

        if($result)
        {
            $cmd_task = "delete from tasks where projectId='$id'";
            $result_task = mysqli_query($conn,$cmd_task);
            if($result_task)
            {
                $cmd_allocatetask = "delete from allocatetasks where projectId='$id'";
                $result_allocatetask = mysqli_query($conn,$cmd_allocatetask);
                    if($result_allocatetask)
                    {
                        // echo "<script>alert('Project Successfully Deleted')</script>";
                        echo "<script>window.location.href='../viewproject.php'</script>";
                    }
            }
            
        }
        else
        {
            echo "<script>alert('Something else')</script>";
        }
    }
}

?>