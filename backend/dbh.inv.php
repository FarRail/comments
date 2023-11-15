<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "farreldb";

// Create connection
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>