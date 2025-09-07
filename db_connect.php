<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fb_db";
// Create connection
$conn =  mysqli_connect($servername, $username, $password , $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$connented = "Connected successfully";
echo "<script>console.log('".$connented."');</script>";
?>