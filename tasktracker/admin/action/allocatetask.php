<?php
session_start();
include("../../connect.php");
if($conn)
{
    if(isset($_POST["submit"]))
    {
        $project_id = $_POST["projectid"];
        $task_id = $_POST["taskid"];
        $emp_id = $_POST["empid"];
        $allocatedate = $_POST["allocatedate"];

        // echo $project_id. " , " .$task_id. " , " .$emp_id. " , " .$allocatedate;

        $cmd = "insert into allocatetasks(taskId,empId,projectId,allocateDate) values('$task_id','$emp_id','$project_id','$allocatedate')";
        $result = mysqli_query($conn,$cmd);
        
        if($result)
        {
            // echo "<script>alert('Task Successfully Allocated')</script>";
            $_SESSION["allocatetask"] = "Task Successfully Allocated";
            echo "<script>window.location.href = '../allocatetask.php'</script>";
        }
        else
        {
            echo "error = " . mysqli_error($conn);
            echo "<script>alert('Something Else')</script>";
        }
        
    }
}
?>