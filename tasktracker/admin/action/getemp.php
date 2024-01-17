<?php
include_once("../../connect.php");
if ($conn) {
    if (isset($_REQUEST["dname"])) {
        $dname = $_REQUEST["dname"];

        $cmd = "select * from employees where deptName = '$dname'";
        $result = mysqli_query($conn, $cmd);
        if($result)
        {
        echo "<option value=''>Select Employee</option>";
        while ($row = mysqli_fetch_array($result)) {

            echo "<option value = '$row[empId]' >$row[empId] - $row[name] ($row[deptName])</option>";

        }
    }
    }
}
?>