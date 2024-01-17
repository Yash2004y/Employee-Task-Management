<?php
include("../../connect.php");

if($conn)
{
    if(isset($_REQUEST["id"]))
    {
        $id = $_REQUEST["id"];
        $cmd = "delete from tasks where taskId='$id'";
        $result = mysqli_query($conn,$cmd);
        if($result)
        {
            $cmd_allocatetask = "delete from allocatetasks where taskId='$id'";
            $result_allocatetask = mysqli_query($conn,$cmd_allocatetask);
            if($result_allocatetask)
            {
                echo "<script>alert('Task Successfully Deleted')</script>";
                echo "<script>window.location.href='../viewtask.php'</script>";
            }
        }
        else
        {
            echo "<script>alert('Something else')</script>";
        }
    }
}
?>
