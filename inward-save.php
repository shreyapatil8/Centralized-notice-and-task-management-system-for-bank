<?php
include 'config.php';

$inward_no = $_POST['inward_no'];
$letter_date = $_POST['letter_date'];
$inward_from = $_POST['inward_from'];
$details = $_POST['details'];

$query = "INSERT INTO inwards 
(inward_no, letter_date, inward_from, details)
VALUES 
('$inward_no','$letter_date','$inward_from','$details')";

mysqli_query($conn,$query);

header("Location: manage-inwards.php");
?>