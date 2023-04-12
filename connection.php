<?php
$server = 'localhost';
$user = 'root';
$password = '';
$database = 'megaconst';

if (!$connect = mysqli_connect($server,$user,$password,$database)) {
    die("Connection Error!");
}