<?php
session_start();

include("../../connect.php");
    if(isset($_POST["submit"]) && isset($_REQUEST["id"]))
    {
        $project_id = $_POST["project"];
        $task_title = $_POST["title"];
        $disc = $_POST["description"];
        $start_date = $_POST["sdate"];
        $end_date = $_POST["edate"];

        // echo $project_id . " , " . $task_title . " , " . $disc . " , " . $start_date . " , " . $end_date;
        $id = $_REQUEST["id"];
        $cmd = "update tasks set projectId='$project_id',taskTitle='$task_title',startDate='$start_date',endDate='$end_date',discription='$disc' where taskId='$id'";
        
        $result = mysqli_query($conn,$cmd);

        if($result)
        {
            // echo "<script>alert('Task Successfully Updated')</script>";
            $_SESSION["edittask"] = "Task Successfully Updated";
            echo "<script>window.location.href = '../edittask.php?id=$id'</script>";
        }
        else
        {
            echo "<script>alert('Something Else')</script>";
        }
    }

?>