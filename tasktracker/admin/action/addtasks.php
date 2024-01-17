<?php
session_start();
include ("../../connect.php");
if($conn)
{
    if(isset($_POST["submit"]))
    {
        $project_id = $_POST["project"];
        $task_title = $_POST["title"];
        $disc = $_POST["description"];
        $start_date = $_POST["sdate"];
        $end_date = $_POST["edate"];

        // echo $project_id . " , " . $task_title . " , " . $disc . " , " . $start_date . " , " . $end_date;
        
        $cmd = "insert into tasks(projectId,taskTitle,discription,startDate,endDate) values('$project_id','$task_title','$disc','$start_date','$end_date')";
        $result = mysqli_query($conn,$cmd);

        if($result)
        {
            //code to update completionPer of project
            $cmd = "select * from tasks where projectId = '$project_id'";
            $result = mysqli_query($conn,$cmd);
            $numrow = mysqli_num_rows($result);
            // echo $numrow;
            $cmd = "select * from allocatetasks where projectId = '$project_id'";
            $result = mysqli_query($conn,$cmd);
            if($result)
            {
                $per = 0;
                while($row = mysqli_fetch_array($result))
                {
                    $per += $row["percentage"];
                }
                $per = $per / $numrow;
                $status = $per == "100" ? "Completed" : "Pending";
                $cmd_update_project = "update projects set completionPer = '$per' , status = '$status' where projectId = '$project_id'";
                $result_update_project = mysqli_query($conn,$cmd_update_project);
                if($result_update_project)
                {   
                    //code for message
                    // echo "<script>alert('Task Successfully Added')</script>";
                    $_SESSION["addtask"] = "Task Successfully Added";
                    echo "<script>window.location.href = '../addtasks.php'</script>";
                }
            }
        }
        else
        {
            echo "error = " . mysqli_error($conn);
            echo "<script>alert('Something Else')</script>";
        }
    }
}

?>