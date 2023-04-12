<?php
include  'connection.php';
$id = $_GET['id'];
$delete = "DELETE FROM employee WHERE employee_id = '$id'";
$sql = mysqli_query($connect,$delete);
header('location:employee.php');


