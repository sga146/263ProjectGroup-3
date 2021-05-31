<?php
$host = "127.0.0.1"; // Server Hostname
$user = "root"; // Server User
$pass = "mysql"; // User Password
$datb = "tserver"; //Database Name


$conn = mysqli_connect($host, $user, $pass, $datb);

// Check Connection

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}