<?php
    session_start();

    unset($_SESSION["empid"]);

    header("location:../index.php");

?>