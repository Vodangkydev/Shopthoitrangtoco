<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "demo_db";
$con = new mysqli($host, $user, $password, $database);
if ($con->connect_error){
    echo "Connection Fail: ".mysqli_connect_errno();exit;
}
