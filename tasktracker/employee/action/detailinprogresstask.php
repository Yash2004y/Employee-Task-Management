<?php
    session_start();
    include ("../../connect.php");
    if(isset($_POST["submit"]) && $conn && isset($_REQUEST["id"]))
    {
        $id = $_REQUEST["id"];
        $remark = $_POST["msg"];
        $percentage = $_POST["per"];
        $status = $_POST["status"];

        // echo $remark . $percentage . $status;
        

        //code for update progress and status in allocatetasks
        $cmd = "update allocatetasks set remark = '$remark' , percentage = '$percentage' , status = '$status' where taskId = '$id'";
        $result = mysqli_query($conn,$cmd);
        if($result)
        {
                //code for update progress and status in tasks
            $cmd_task = "update tasks set status = '$status' where taskId = '$id'";
            $result_task = mysqli_query($conn,$cmd_task);
            if($result_task)
            {
                //code for update progress and status in Project
                //get all record of project of curret task from allocatetasks table 
                $cmd_pid = "select * from allocatetasks where projectId in (select projectId from allocatetasks where taskId = '$id')";
                $result_pid = mysqli_query($conn,$cmd_pid);
                //get total number of task of particular project
                $cmd_total_task = "select * from tasks where projectId in (select projectId from allocatetasks where taskId = '$id')";
                $result_total_task = mysqli_query($conn,$cmd_total_task);
                $numrow = mysqli_num_rows($result_total_task);
                //  echo $numrow;
                //here get all allocated task percentage and add average of percentage in projects table in completionPer column  
                if($numrow > 0)
                {
                    $total_progress = 0;
                    $project_id = "";
                    while($row = mysqli_fetch_array($result_pid))
                    {
                        $total_progress += $row["percentage"];
                        $project_id = $row["projectId"];
                    }
                    // echo $numrow ."<br>" ;
                    // echo $total_progress ."<br>" ;
                    $project_percentage = $total_progress / $numrow;
                    $project_status = $project_percentage == 100 ? "Completed" : "Pending";
                    // echo $project_percentage . " , " . $project_status . " , " . $project_id;
                    $cmd_project = "update projects set completionPer = '$project_percentage' , status = '$project_status' where projectId = '$project_id'";
                    $result_project = mysqli_query($conn,$cmd_project);
                    if($result_project)
                    {
                        //here check given task Progress Percentage which is between 0 to 100 then page redirect in inprogresstask detail page
                        // if task Progress Percentage which is 100 then page redirect in completed detail page
                        //other wise page redirect in newtask detail page
                        // echo "<script>alert('Successfully Status Changed')</script>";
                        $_SESSION["taskprogress"] = "Successfully Status Changed";
                        if($percentage > 0 && $percentage < 100)
                        {
                            echo "<script>window.location.href = '../detailinprogresstask.php?id=$id'</script>";
                        }
                        else if($percentage == 100)
                        {
                            echo "<script>window.location.href = '../detailcompletedtask.php?id=$id'</script>";
                        }
                        else
                        {
                            echo "<script>window.location.href = '../detailnewtask.php?id=$id'</script>";
                        }
                    }
                    else
                    {
                        echo mysqli_error($conn);
                        echo "<script>alert('Something Else in Project Status')</script>";
                   }
                }
                else
                {
                    echo mysqli_error($conn);
                    echo "<script>alert('Something Else In Project Id Getting')</script>";
                }
            }
            else
            {
                echo mysqli_error($conn);
                echo "<script>alert('Something Else In Task Status')</script>";
            }
        }
        else
        {
            echo mysqli_error($conn);
            echo "<script>alert('Something Else')</script>";
        }
    }
?>