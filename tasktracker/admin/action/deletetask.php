<?php
include("../../connect.php");
if($conn)
{
    if(isset($_REQUEST["id"]))
    {
        $id = $_REQUEST["id"];


        $cmd_task = "select * from tasks where projectId in (select projectId from tasks where taskId = '$id')";
        $result_task = mysqli_query($conn,$cmd_task);
        $total_task = mysqli_num_rows($result_task) - 1 ;
        
        $cmd_project = "select * from allocatetasks where projectId in (select projectId from tasks where taskId = '$id')";
        $result_project = mysqli_query($conn,$cmd_project);
        if($result_project)
        {
                $percentage = 0;
                $projectId = "";
                
                while($row = mysqli_fetch_array($result_project))
                {
                    if($row["taskId"] != $id)
                    {
                        $percentage += $row["percentage"];
                    }
                    $projectId = $row["projectId"];
                }
                if($total_task > 0)
                {                
                    $total = $percentage / $total_task;
                    $status = $total == "100" ? "Completed" : "Pending";
                }
                else
                {
                    $total = 0;
                    $status = $total == "100" ? "Completed" : "Pending";
                }
                // echo $total . " " . $status;
                $cmd_update_project = "update projects set completionPer = '$total' , status = '$status' where projectId = '$projectId'";
                $result_update_project = mysqli_query($conn,$cmd_update_project);
            if($result_update_project)
            {   
                //delete task and allocation task detail
                $cmd = "delete from tasks where taskId='$id'";
                $result = mysqli_query($conn,$cmd);
                if($result)
                {
                    $cmd_allocatetask = "delete from allocatetasks where taskId='$id'";
                    $result_allocatetask = mysqli_query($conn,$cmd_allocatetask);
                    if($result_allocatetask)
                    {
                        // echo "<script>alert('Task Successfully Deleted')</script>";
                        echo "<script>window.location.href='../viewtask.php'</script>";
                    }
                    else
                    {
                        echo mysqli_error($conn);
                        echo "<script>alert('Something else')</script>";
                    }
    
                }
                else
                {
                    echo mysqli_error($conn);
                    echo "<script>alert('Something else')</script>";
                }
            }
        }
        else
        {
            echo mysqli_error($conn);
            echo "<script>alert('Something else')</script>";
        }
    }
}
?>