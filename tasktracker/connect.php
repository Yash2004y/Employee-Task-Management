<?php

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","tasktracker");
$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if(!$conn)
{
    echo "Error : " + mysqli_connect_error();
}


?>