<?php
session_start();
include("../../connect.php");
if ($conn) {
    if (isset($_POST["submit"])) {
        $title = $_POST["title"];
        $disc = $_POST["description"];
        $start_date = $_POST["sdate"];
        $end_date = $_POST["edate"];
        $plateform = $_POST["plateform"];

        $cmd = "insert into projects(discription,title,startDate,endDate,plateform) values('$disc','$title','$start_date','$end_date','$plateform')";
        $result = mysqli_query($conn, $cmd);

        if ($result) {
            // echo "<script>alert('Project Successfully Added')</script>";
            $_SESSION["addproject"] = "Project Successfully Added";
            echo "<script>window.location.href = '../addprojects.php'</script>";
        } else {
            $error = "Error = " . mysqli_error($conn);
            echo "<script>alert('Something else')</script>";
        }
    }
}
?>