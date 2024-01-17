<?php 
    session_start();
    include ("../../connect.php");
    if(isset($_POST["submit"]) && isset($_REQUEST["id"]))
    {
        $title = $_POST["title"];
        $desc = $_POST["description"];
        $start_date = $_POST["sdate"];
        $end_date = $_POST["edate"];
        $plateform = $_POST["plateform"];

        // echo $title. " , " .$disc. " , " .$start_date. " , " .$end_date. " , " .$status. " , " .$plateform;
    
        $id = $_REQUEST["id"];
        $cmd = "update projects set discription='$desc',title='$title',startDate='$start_date',endDate='$end_date',plateform='$plateform' where projectId='$id'";
        
        $result = mysqli_query($conn,$cmd);

        if($result)
        {
            // echo "<script>alert('Project Successfully Updated')</script>";
            $_SESSION["editproject"] = "Project Successfully Updated";
            echo "<script>window.location.href = '../editproject.php?id=$id'</script>";
        }
        else
        {
            echo "<script>alert('Something Else')</script>";
        }
    }
