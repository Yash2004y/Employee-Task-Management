<?php
include("../../connect.php");

//It Send Only Not Allocated Tasks of particular project
if($conn)
{
    if(isset($_REQUEST["id"]))
    {
        $id = $_REQUEST["id"];
        $cmd = "select * from tasks where taskId not in (select taskId from allocatetasks where projectId='$id') and projectId = '$id'";
        $result = mysqli_query($conn,$cmd);
        $numrow = mysqli_num_rows($result);
        if($result)
        {
            echo "<option value=''>Select Task</option>";
            while($row = mysqli_fetch_array($result))
            {
                echo "<option value='$row[taskId]' sdate='$row[startDate]' edate='$row[endDate]'>$row[taskId] - $row[taskTitle] (Duration $row[startDate] To $row[endDate])</option>";
            }
        }
    }
}

//It Give All Task of particular project Which allocated or not 
/*if($conn)
{
    if(isset($_REQUEST["id"]))
    {
        $id = $_REQUEST["id"];
        $cmd = "select * from tasks where projectId = '$id' ";
        $result = mysqli_query($conn,$cmd);
        $numrow = mysqli_num_rows($result);
        if($result)
        {
            echo "<option value=''>Select Task</option>";
            while($row = mysqli_fetch_array($result))
            {
                echo "<option value='$row[taskId]'>$row[taskId] - $row[taskTitle] (Duration $row[startDate] To $row[endDate])</option>";
            }
        }
    }
}*/

?>