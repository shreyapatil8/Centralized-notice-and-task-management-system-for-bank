<?php
$con = mysqli_connect("localhost", "root", "", "demo_project");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($con, "utf8mb4");
?>